<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Inventory;
use App\Models\Invoice;
use Illuminate\Http\Request;
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
        $invoices = Invoice::all();
        return view('invoices.index', [
            'invoices' => $invoices
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
        $validated = $request->validate([
            'categoria' => 'required|max:255',
        ]);

        $result = new Invoice([
            'categoria_name' => $validated['categoria'],
            'reference' => Str::uuid(),
            'client_id' => $validated['cliente']
        ]);

        if ($result->save()) {
            if($action = 'g')
                return redirect()->route('invoices.index');
            else
                return redirect()->route('invoices.show', [$result->id]);
        }
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('nombre');

        return ;
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
        return view('invoices.edit', [
            'item' => $item,
            'products' => $this->product_list(),
            'clients' => $clients,
            'categories' => $this->get_category_list()
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
        $invoice = Invoice::findOrFail($id);

        $validated = $request->validate([
            'categoria' => 'required|max:255',
            'cliente' => 'required'
        ]);
        $action = $request->input('action');

        $invoice->client_id = $request->input('cliente');
        $invoice->category_name = $request->input('categoria');

        
        if ($invoice->save()) {
            if ($action == 'g')
                return redirect()->route('invoices.index');
            else
                return redirect()->route('invoices.show', [$invoice->id]);
        }
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('nombre');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //$product = Invi::findOrFail($id);
        //$product->delete();
        return redirect()->route('invoices.index');
    }

    public function show($id) {
        $invoices = Invoice::findOrFail($id);
        return view('invoices.show', [
            'invoice' => $invoices
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
}
