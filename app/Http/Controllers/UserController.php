<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;

class UserController extends Controller
{
    public function index(): View|RedirectResponse
    {
        if (!session()->has('user_id')) {
            return redirect('/login');
        }

        $users = User::latest()->get();
        return view('admin.users.index', compact('users'));
    }

    public function create(): View|RedirectResponse
    {
        if (!session()->has('user_id')) {
            return redirect('/login');
        }

        return view('admin.users.create');
    }

    public function store(Request $request): RedirectResponse
    {
        if (!session()->has('user_id')) {
            return redirect('/login');
        }

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'role' => 'required',
            'password' => 'required|min:8',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.users.index')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit(string $id): View|RedirectResponse
    {
        if (!session()->has('user_id')) {
            return redirect('/login');
        }

        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, string $id): RedirectResponse
    {
        if (!session()->has('user_id')) {
            return redirect('/login');
        }

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'role' => 'required',
            'password' => 'nullable|min:8',
        ]);

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->role = $request->role;
        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('admin.users.index')->with('success', 'Data berhasil diperbarui');
    }

    public function destroy(string $id): RedirectResponse
    {
        if (!session()->has('user_id')) {
            return redirect('/login');
        }

        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'Data berhasil dihapus');
    }
}
    