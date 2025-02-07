<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): View
    {
        $users = User::all();
        return view('usuarios.index', [
            "users" => $users,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('usuarios.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nombre' => 'required|max:255',
            'email' => 'required|email',
            'password' => 'required',
            'confirmPassword' => 'required|same:password',
            'role' => 'required'
        ]);

        $result = User::factory()->createOne([
            'name' => $validated["nombre"],
            'email' => $validated["email"],
            'password' => Hash::make($validated['password'])
        ]);

        if ($result != null && $result->id != 0) {
            return redirect()->route('users.index');
        }
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
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
        $user = User::findOrFail($id);
        return view('usuarios.edit', array(
            'user' => $user
        ));
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
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'nombre' => 'required|max:255',
            'email' => 'required|email',
            'password' => '',
            'confirmPassword' => 'same:password',
            'role' => 'required'
        ]);

        $user->name = $validated["nombre"];
        $user->email = $validated["email"];

        if (!empty($validated['password'])){
            $user->password = Hash::make($validated['password']);
        }

        if ($user->save()){
            return redirect()->route('users.index');
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
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('users.index');
    }
}
