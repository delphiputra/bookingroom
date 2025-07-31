<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\User;
use App\Models\Ruangan;
use Illuminate\Http\Request;

class AdminHomeController extends Controller
{
    public function index(Request $request)
{
    $query = Booking::with(['user', 'ruangan']);

    if ($request->filter_type === 'date' && $request->date) {
        $query->whereDate('booking_date', '=', $request->date);
    }

    if ($request->filter_type === 'user' && $request->user) {
        $query->whereHas('user', function ($q) use ($request) {
            $q->where('name', 'like', '%' . $request->user . '%');
        });
    }

    if ($request->filter_type === 'ruangan' && $request->ruangan) {
        $query->whereHas('ruangan', function ($q) use ($request) {
            $q->where('title', 'like', '%' . $request->ruangan . '%');
        });
    }

    return view('admin.home', [
        'bookings' => $query->latest()->get(),
        'totalUsers' => \App\Models\User::count(),
        'totalRuangans' => \App\Models\Ruangan::count(),
        'totalBookings' => \App\Models\Booking::count(),
    ]);
}

}
