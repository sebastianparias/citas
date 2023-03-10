<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pet;
// use App\Models\Customer;
use App\Models\Appointment;
use Illuminate\Validation\Rule;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->fecha) {
            $appointments = Appointment::with('pet.customer')
                ->where(
                    'inicio',
                    'like',
                    $request->fecha . '%'
                )
                ->get();
        } else {
            $appointments = Appointment::with('pet.customer')->get();
        }

        return view('appointments.index', ['citas' => $appointments]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($mascota = null)
    {
        $pets = Pet::all();
        return view('appointments.create', ['mascotas' => $pets, 'mascota_id' => $mascota]);
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
            'inicio' => 'required',
            'fin' => 'required',
            'mascota_id' => 'required',
        ]);

        $timestamp1 = strtotime(date('Y-m-d H:i'));
        $timestamp2 = strtotime($request->inicio);

        $citaExistente = Appointment::where('inicio', '<', $request->fin)
            ->where('fin', '>', $request->inicio)
            ->first();

        if ($citaExistente) {
            $request->flash();
            return redirect()->back()->withErrors(["error" => "Ya existe una cita en esta fecha y hora"]);
        } elseif ($request->inicio > $request->fin) {
            $request->flash();
            return redirect()->back()->withErrors(["error" => "La fecha de inicio debe ser anterior a la fecha final"]);
        } elseif ($timestamp2 < $timestamp1) {
            $request->flash();
            return redirect()->back()->withErrors(["error" => "La fecha de inicio debe ser posterior a la fecha actual"]);
        }

        Appointment::create($request->all());
        return redirect()->route('appointments.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pets = Pet::all();
        $customers = Appointment::all();
        $appointment = Appointment::find($id);
        return view('appointments.create', [
            'mascotas' => $pets,
            'clientes' => $customers,
            'cita' => $appointment,
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
            'inicio' => 'required',
            'fin' => 'required',
            'mascota_id' => 'required',
        ]);

        $timestamp1 = strtotime(date('Y-m-d H:i'));
        $timestamp2 = strtotime($request->inicio);

        $citaExistente = Appointment::where('inicio', '<', $request->fin)
            ->where('fin', '>', $request->inicio)
            ->first();

        if ($citaExistente && $id != $citaExistente->id) {
            $request->flash();
            return redirect()->back()->withErrors(["error" => "Ya existe una cita en esta fecha y hora"]);
        } elseif ($request->inicio > $request->fin) {
            $request->flash();
            return redirect()->back()->withErrors(["error" => "La fecha de inicio debe ser anterior a la fecha final"]);
        } elseif ($timestamp2 < $timestamp1) {
            $request->flash();
            return redirect()->back()->withErrors(["error" => "La fecha de inicio debe ser posterior a la fecha actual"]);
        }

        $appointment = Appointment::find($id);
        $appointment->inicio = $request->inicio;
        $appointment->fin = $request->fin;
        $appointment->mascota_id = $request->mascota_id;
        $appointment->save();
        return redirect()->route('appointments.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $appointment = Appointment::find($id);
        $appointment->delete();
        return redirect()->route('appointments.index');
    }

    public function getAll() //datos el calendario de fullcalendar
    {
        $eventos = Appointment::with('pet')->get();
        $eventosConFormato = $eventos->map(function ($evento) {
            return [
                'title' => $evento->pet->nombre,
                'start' => $evento->inicio,
                'end' => $evento->fin,
                'id' => $evento->updated_at
            ];
        });
        return response()->json($eventosConFormato);
    }
}
