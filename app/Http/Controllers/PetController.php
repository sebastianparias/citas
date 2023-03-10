<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pet;
use App\Models\Customer;

use Illuminate\Database\QueryException;

class PetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pets = Pet::with('customer')->get();
        return view('pets.index', ['mascotas' => $pets]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customers = Customer::all();
        return view('pets.create', ['clientes' => $customers]);
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
            'nombre' => 'required',
            'tipo' => 'required',
            'cliente_id' => 'required',
        ]);

        Pet::create($request->all());
        return redirect()->route('pets.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $customers = Customer::all();
        $pet = Pet::find($id);
        return view('pets.create', ['mascota' => $pet, 'clientes' => $customers]);
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
            'nombre' => 'required',
            'tipo' => 'required',
            'cliente_id' => 'required',
        ]);

        $pet = Pet::find($id);
        $pet->cliente_id = $request->cliente_id;
        $pet->nombre = $request->nombre;
        $pet->tipo = $request->tipo;
        $pet->save();
        return redirect()->route('pets.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $pet = Pet::find($id);
            $pet->delete();
            return redirect()->route('pets.index');
        } catch (QueryException $e) {
            return redirect()->back()->withErrors(['error' => 'No se pudo borrar la mascota, verifique que no tenga citas asociadas.']);
        }
    }
}
