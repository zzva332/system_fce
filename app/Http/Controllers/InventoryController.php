<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\Product;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $inventories = Inventory::simplePaginate(15);
        return view('inventories.index', [
            'inventories' => $inventories
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ids = Inventory::pluck('product_id')->all();
        $products = Product::all()->whereNotIn('id', $ids);

        return view('inventories.create', [
            'products' => $products
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
            'producto_id' => 'required',
            'stock' => 'required|max:255|integer',
            'iva' => 'required|max:11|integer',
            'descuento' => 'required|integer',
        ]);
        $result = new Inventory([
            'product_id' => $validated["producto_id"],
            'stock' => $validated["stock"],
            'iva' => $validated["iva"],
            'discount' => $validated["descuento"],
        ]);

        if ($result->save()) {
            return redirect()->route('inventories.index');
        }
        return back()->withErrors([
            'producto_id' => 'Hubo un problema con este registro.',
        ])->onlyInput('producto_id');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Inventory::findOrFail($id);
        return view('inventories.edit', [
            'item' => $item
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
        $item = Inventory::findOrFail($id);

        $validated = $request->validate([
            'stock' => 'required|max:255',
            'iva' => 'required|max:3|integer',
            'descuento' => 'required|max:3|integer'
        ]);

        $item->stock = $validated["stock"];
        $item->iva = $validated["iva"];
        $item->discount = $validated["descuento"];
        $item->updated_at = $item->freshTimestamp();

        if ($item->save()) {
            return redirect()->route('inventories.index');
        }
        return back()->withErrors([
            'producto_id' => 'Hubo un problema con este registro.',
        ])->onlyInput('producto_id');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Inventory::findOrFail($id);
        $product->delete();
        return redirect()->route('inventories.index');
    }
}
