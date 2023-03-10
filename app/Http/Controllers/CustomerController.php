<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;

use Illuminate\Database\QueryException;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::all();
        return view('customers.index', ['clientes' => $customers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('customers.create');
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
            'email' => 'required|email',
            'cedula' => 'required|numeric|unique',
            'nombres' => 'required',
            'apellidos' => 'required',
            'celular' => 'required|numeric',
        ]);

        Customer::create($request->all());
        return redirect()->route('customers.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $customer = Customer::find($id);
        return view('customers.create', ['cliente' => $customer]);
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
            'email' => 'required|email',
            'cedula' => 'required|numeric|unique:clientes',
            'nombres' => 'required',
            'apellidos' => 'required',
            'celular' => 'required|numeric',
        ]);

        $customer = Customer::find($id);
        $customer->cedula = $request->cedula;
        $customer->nombres = $request->nombres;
        $customer->apellidos = $request->apellidos;
        $customer->celular = $request->celular;
        $customer->email = $request->email;
        $customer->save();
        return redirect()->route('customers.index');
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
            $customer = Customer::find($id);
            $customer->delete();
            return redirect()->route('customers.index');
        } catch (QueryException $e) {
            return redirect()->back()->withErrors(['error' => 'No se pudo borrar el cliente, verifique que no tenga mascotas asociadas.']);
        }

      
    }
}
