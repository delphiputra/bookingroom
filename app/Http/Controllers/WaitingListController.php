<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\View\View;
use Illuminate\Http\Request;

class WaitingListController extends Controller
{

      public function index(Request $request)
    {
        $filterType = $request->input('filter_type');
        $bookings = Booking::with(['user', 'ruangan'])->latest();

        // Filter Dinamis
        if ($filterType === 'user' && $request->filled('user')) {
            $bookings->whereHas('user', function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->user . '%');
            });
        }

        if ($filterType === 'ruangan' && $request->filled('ruangan')) {
            $bookings->whereHas('ruangan', function ($query) use ($request) {
                $query->where('title', 'like', '%' . $request->ruangan . '%');
            });
        }

        if ($filterType === 'date' && $request->filled('date')) {
            $bookings->whereDate('booking_date', $request->date);
        }

        return view('user.waitinglist.index', [
            'bookings' => $bookings->get()
        ]);
    }

}