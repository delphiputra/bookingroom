<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Ruangan;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        $userId = session('user_id'); // pakai session manual

        $bookings = Booking::with('ruangan')
            ->where('user_id', $userId)
            ->get();

        return view('user.booking.index', compact('bookings'));
    }

    public function create()
    {
        $ruangans = Ruangan::all();
        return view('user.booking.create', compact('ruangans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'ruangan_id' => 'required|exists:ruangans,id',
            'booking_date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required|after:start_time',
        ]);

        // Validasi konflik booking
        $conflict = Booking::where('ruangan_id', $request->ruangan_id)
            ->where('booking_date', $request->booking_date)
            ->where(function ($query) use ($request) {
                $query->whereBetween('start_time', [$request->start_time, $request->end_time])
                      ->orWhereBetween('end_time', [$request->start_time, $request->end_time])
                      ->orWhere(function ($query) use ($request) {
                          $query->where('start_time', '<=', $request->start_time)
                                ->where('end_time', '>=', $request->end_time);
                      });
            })
            ->exists();

        if ($conflict) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['conflict' => 'Ruangan sudah dibooking pada waktu tersebut. Silakan pilih waktu lain.']);
        }

        Booking::create([
            'user_id' => session('user_id'),
            'ruangan_id' => $request->ruangan_id,
            'booking_date' => $request->booking_date,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'description' => $request->description ?? null,
        ]);

        return redirect()->route('user.booking.index')->with('success', 'Booking berhasil dibuat.');
    }

    public function edit(Booking $booking)
    {
        if ($booking->user_id !== session('user_id')) {
            abort(403, 'Unauthorized action.');
        }

        $ruangans = Ruangan::all();
        return view('user.booking.edit', compact('booking', 'ruangans'));
    }

    public function update(Request $request, Booking $booking)
    {
        if ($booking->user_id !== session('user_id')) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'ruangan_id' => 'required|exists:ruangans,id',
            'booking_date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required|after:start_time',
        ]);

        // Cek konflik saat update (tidak menghitung booking itu sendiri)
        $conflict = Booking::where('id', '!=', $booking->id)
            ->where('ruangan_id', $request->ruangan_id)
            ->where('booking_date', $request->booking_date)
            ->where(function ($query) use ($request) {
                $query->whereBetween('start_time', [$request->start_time, $request->end_time])
                      ->orWhereBetween('end_time', [$request->start_time, $request->end_time])
                      ->orWhere(function ($query) use ($request) {
                          $query->where('start_time', '<=', $request->start_time)
                                ->where('end_time', '>=', $request->end_time);
                      });
            })
            ->exists();

        if ($conflict) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['conflict' => 'Ruangan sudah dibooking pada waktu tersebut. Silakan pilih waktu lain.']);
        }

        $booking->update([
            'ruangan_id' => $request->ruangan_id,
            'booking_date' => $request->booking_date,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'description' => $request->description ?? null,
        ]);

        return redirect()->route('user.booking.index')->with('success', 'Booking berhasil diperbarui.');
    }

    public function destroy(Booking $booking)
    {
        if ($booking->user_id !== session('user_id')) {
            abort(403, 'Unauthorized action.');
        }

        $booking->delete();
        return redirect()->route('user.booking.index')->with('success', 'Booking dihapus.');
    }
}
