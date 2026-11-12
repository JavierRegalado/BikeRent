<?php

namespace App\Http\Controllers;

use App\Models\Bike;
use App\Models\Booking;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\support\Facades\Auth;
use carbon\Carbon;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bookings = Booking::with('bike')->where('user_id', Auth::id())->orderBy('created_at', 'desc')->get();
        return view('bookings.index', compact('bookings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Bike $bike)
    {
        if ($bike->status !== 'available') {
            return redirect()->route('bikes.index')->with('error', 'Esta bicicleta no se encuentra disponible para alquilar.');
        }
        $users = User::all();

        return view('bookings.create', compact('bike', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'bike_id' => 'required|exists:bikes,id',
            'start_time' => 'required|date|after_or_equal:now',
            'end_time' => 'required|date|after:start_time',
        ]);

        $bike = Bike::findOrFail($request->bike_id);

        if ($bike->status !== 'available') {
            return back()->withErrors(['bike_id' => 'La bicicleta seleccionada no está disponible para alquilar.']);
        }

        $startTime = Carbon::parse($request->start_time);
        $endTime = Carbon::parse($request->end_time);

        $hasOverlap = Booking::where('bike_id', $bike->id)
            ->whereIn('status', ['pending', 'active'])
            ->where(function ($query) use ($startTime, $endTime) {
                $query->whereBetween('start_time', [$startTime, $endTime])
                        ->orwhereBetween('end_time', [$startTime, $endTime])
                        ->orwhere(function ($query) use ($startTime, $endTime){
                            $query->where('start_time', '<=', $startTime)
                                  ->where('end_time', '>=', $endTime);
                        });
            })
            ->exists();

        if ($hasOverlap) {
            return back()->withInput()->withErrors(['start_time' => 'La bicicleta seleccionada ya está reservada para el período de tiempo especificado.']);
        }

        $hours = $startTime->diffInHours($endTime);
        $hours = $hours > 0 ? $hours : 1;
        $totalPrice = $hours * $bike->price_per_hour;

        $booking = Booking::create([
            'user_id' => Auth::id(),
            'bike_id' => $bike->id,
            'start_time' => $startTime,
            'end_time' => $endTime,
            'total_price' => $totalPrice,
        ]);

        return redirect()->route('bookings.index')->with('success', 'Reserva creada exitosamente.');

    }

    /**
     * Display the specified resource.
     */
    public function show(Booking $booking)
    {
        if($booking->user_id !== Auth::id()){
            abort(403, 'No tienes permiso para ver esta reserva.');
        }
        $booking->load('bike');
        return view('bookings.show', compact('booking'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Booking $booking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Booking $booking)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booking $booking)
    {
        //
    }

    public function cancel(Booking $booking)
    {
        if ($booking->user_id !== Auth::id()) {
            abort(403, 'No tienes permiso para cancelar esta reserva.');
        }

        if ($booking->status !== 'pending') {
            return back()->with('error', 'Solo se pueden cancelar reservas pendientes.');
        }
        $booking->update(['status' => 'cancelled']);
        return redirect()->route('bookings.index')->with('success', 'Reserva cancelada exitosamente.');
    }
}
