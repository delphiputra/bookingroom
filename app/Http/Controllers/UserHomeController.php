<?php

namespace App\Http\Controllers;

use App\Models\Ruangan;
use Illuminate\Http\Request;

class UserHomeController extends Controller
{
    public function index()
    {
        $ruangans = Ruangan::all();
        return view('user.home', compact('ruangans'));
    }

    public function show($id)
    {
        $ruangan = Ruangan::findOrFail($id);
        return view('user.ruangans.show', compact('ruangan'));
    }
}
