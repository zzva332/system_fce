<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Inventory;
use App\Models\Invoice;
use App\Models\InvoiceProduct;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invoices = Invoice::with(['products'])->simplePaginate(30);
        return view('invoices.index', [
            'invoices' => $invoices,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clients = Client::all();
        return view('invoices.create', [
            'products' => $this->product_list(),
            'clients' => $clients,
            'categories' => $this->get_category_list()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $bool = true;
        $validated = $request->validate([
            'categoria' => 'required|max:255',
            'cliente' => ''
        ]);
        $action = $request->input('action');
        DB::beginTransaction();
        try {

            $result = new Invoice([
                'categoria_name' => $validated['categoria'],
                'reference' => Str::uuid(),
                'client_id' => $validated['cliente']
            ]);

            if (!$result->save()) throw new Exception("Hubo un error al insertar el registro");

            $this->create_products(
                $result->id,
                $request->input('productos_id'),
                $request->input('productos_count')
            );
            
            
            DB::commit();
            $bool = true;
        } catch (\Exception $e) {
            DB::rollback();
            $bool = false;
            return back()->withErrors([
                'categoria' => $e->getMessage(),
            ])->onlyInput('categoria');
        }

        if ($bool) {
            if($action == 'g')
                return redirect()->route('invoices.index');
            else
                return redirect()->route('invoices.show', [$result->id]);
        }
        return back()->withErrors([
            'email' => 'Hubo un problema con este registro.',
        ])->onlyInput('nombre');
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $clients = Client::all();
        $item = Invoice::findOrFail($id);
        $item->loadMissing(['products']);
        return view('invoices.edit', [
            'item' => $item,
            'products' => $this->product_list(),
            'has_products' => $item->products->isNotEmpty(),
            'clients' => $clients,
            'categories' => $this->get_category_list(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'categoria' => 'required|max:255',
            'cliente' => ''
        ]);
        $action = $request->input('action');

        DB::beginTransaction();
        try {
            $invoice = Invoice::findOrFail($id);
            $invoice->client_id = $request->input('cliente');
            $invoice->category_name = $request->input('categoria');

            if (!$invoice->save()) throw new Exception("Hubo un error al insertar el registro");

        
            $this->update_product(
                $id,
                $request->input('productos_id'),
                $request->input('productos_count')
            );
            DB::commit();
            $bool = true;
        } catch (\Exception $e) {
            DB::rollback();
            $bool = false;
            return back()->withErrors([
                'categoria' => $e->getMessage(),
            ])->onlyInput('categoria');
        }
        
        if($bool) {
            if ($action == 'g') return redirect()->route('invoices.index');
            else return redirect()->route('invoices.show', [$invoice->id]);    
        }

        return back()->withErrors([
            'categoria' => 'Hubo un problema con este registro.',
        ])->onlyInput('categoria');
        return "";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Invoice::findOrFail($id);
        $item->loadMissing(['products']);

        // solo permite eliminar si la factura no tiene productos asignados
        if ($item->products->isNotEmpty()){
            return redirect()->back();
        }
        $item->delete();

        return redirect()->route('invoices.index');
    }

    public function show($id) {
        $invoices = Invoice::findOrFail($id);
        $invoices->loadMissing(['products']);
        
        $total_products = 0;
        $total_iva = 0;
        $total_discount = 0;
        $count_products = 0;
        foreach($invoices->products as $product) {
            // total producto
            $total_products += $product->gross_value;
            $count_products += $product->count;
            // descuento por producto
            $discount = $product->gross_value * ($product->discount / 100);
            $total_iva += ($product->gross_value - $discount) * ($product->iva / 100); 
            $total_discount +=  $discount;
        }

        $total = $total_products + $total_iva + $total_discount;

        return view('invoices.show', [
            'invoice' => $invoices,
            'count_products' => $count_products,
            'total_discount' => number_format($total_discount, 0, ',', '.'),
            'total_gross' => number_format($total_products, 0, ',', '.'),
            'total_iva' => number_format($total_iva, 0, ',', '.'),
            'total' => number_format($total, 0, ',', '.')
        ]);
    }

    public function product_list(){
        $products = Inventory::all();
        return $products;
    }
    public function get_category_list() {
        return [
            "Alimentos",
            "Bebidas",
            "Ropa",
            "Calzado",
            "Electrónica",
            "Hogar",
            "Muebles",
            "Papelería",
            "Servicios",
            "Otros"
        ];
    }
    public function create_products($invoice_id, $products, $counts) {

        if ($products == null || count($products) == 0) return;

        for($i = 0; $i < count($products); $i++) {
            
            $inventory = Inventory::findOrFail($products[$i]);
            $inventory->loadMissing(['product']);

            $price = doubleval($inventory->product->price);
            $iva = intval($inventory->iva) / 100;
            $discount = intval($inventory->discount) / 100;
            $total = $price - ($price * $discount); // descuento
            $total += $total * $iva; // iva

            $item = new InvoiceProduct([
                'product_id' => $inventory->product->id,
                'invoice_id' => $invoice_id,
                'count' => $counts[$i],
                'gross_value' => $price,
                'iva' => $inventory->iva,
                'discount' => $inventory->discount,
                'net_value' => $total
            ]);
            $item->save();
        }
    }
    public function update_product($invoice_id, $products, $counts) {

        // remueve los productos que ya no van a estar
        InvoiceProduct::where('invoice_id', '=',$invoice_id)->whereNotIn('product_id', $products)->delete();

        for($i = 0; $i < count($products); $i++) {
            
            $item = InvoiceProduct::where('invoice_id', '=',$invoice_id)->where('product_id', '=', $products[$i])->first();
            $inventory = Inventory::findOrFail($products[$i]);
            $inventory->loadMissing(['product']);
            $price = doubleval($inventory->product->price);
            $iva = intval($inventory->iva) / 100;
            $discount = intval($inventory->discount) / 100;
            $total = $price - ($price * $discount); // descuento
            $total += $total * $iva; // iva

            if (!$item){ // si esta vacio
                $item = new InvoiceProduct();
                $item->invoice_id = $invoice_id;
                $item->product_id = $inventory->product->id;
                $item->iva = $inventory->iva;
                $item->discount = $inventory->discount;
            }
            $item->count = $counts[$i];
            $item->gross_value = $price;
            $item->net_value = $total * $inventory->iva;
            
            $item->save();
        }

    }
}
