<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::all();
        return view('clients.index', [
            'clients' => $clients
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('clients.create',[
            'list_types_id' => $this->get_type_id_list()
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
            'nombre' => 'required|max:255',
            'email' => 'required|email',
            'tipo_id' => 'required',
            'documento' => 'required'
        ]);
        $result = new Client([
            'name' => $validated["nombre"],
            'email' => $validated["email"],
            'type_id' => $validated["tipo_id"],
            'document' => $validated["documento"],
        ]);

        if ($result->save()) {
            return redirect()->route('clients.index');
        }
        return back()->withErrors([
            'email' => 'Hubo un problema con este registro.',
        ])->onlyInput('nombre');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Client::findOrFail($id);
        return view('clients.edit', [
            'item' => $item,
            'list_types_id' => $this->get_type_id_list()
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
        $item = Client::findOrFail($id);

        $validated = $request->validate([
            'nombre' => 'required|max:255',
            'email' => 'required|email',
            'tipo_id' => 'required',
            'documento' => 'required'
        ]);

        $item->name = $validated["nombre"];
        $item->email = $validated["email"];
        $item->type_id = $validated["tipo_id"];
        $item->document = $validated["documento"];
        $item->updated_at = $item->freshTimestamp();

        if ($item->save()) {
            return redirect()->route('clients.index');
        }
        return back()->withErrors([
            'nombre' => 'Hubo un problema con este registro',
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
        $client = Client::findOrFail($id);
        $client->delete();
        return redirect()->route('clients.index');
    }

    public function get_type_id_list(){
        return [
            ['key' => 'CC', 'value' => 'Cedula ciudadania'],
            ['key' => 'CE', 'value' => 'Cedula extranjeria'],
            ['key' => 'TI', 'value' => 'Tarjeta de identidad'],
        ];
    }
}
