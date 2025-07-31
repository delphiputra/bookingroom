<?php

namespace App\Http\Controllers;

use App\Models\Ruangan;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class RuanganController extends Controller
{
    public function index(): View|RedirectResponse
    {
        if (!session()->has('user_id')) {
            return redirect('/login');
        }

        $ruangans = Ruangan::orderBy('id', 'asc')->get();
        return view('admin.ruangans.index', compact('ruangans'));
    }

    public function create(): View|RedirectResponse
    {
        if (!session()->has('user_id')) {
            return redirect('/login');
        }

        return view('admin.ruangans.create');
    }

    public function store(Request $request): RedirectResponse
    {
        if (!session()->has('user_id')) {
            return redirect('/login');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'capacity' => 'required|integer',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:5000',
        ]);

        $image = $request->file('image')->store('public/ruangans');
        $filename = basename($image);

        Ruangan::create([
            'title' => $request->title,
            'capacity' => $request->capacity,
            'description' => $request->description,
            'image' => $filename,
        ]);

        return redirect()->route('admin.ruangans.index')->with('success', 'Data ruangan berhasil ditambahkan!');
    }

    public function show(string $id): View|RedirectResponse
    {
        if (!session()->has('user_id')) {
            return redirect('/login');
        }

        $ruangan = Ruangan::findOrFail($id);
        return view('admin.ruangans.show', compact('ruangan'));
    }

    public function edit(string $id): View|RedirectResponse
    {
        if (!session()->has('user_id')) {
            return redirect('/login');
        }

        $ruangan = Ruangan::findOrFail($id);
        return view('admin.ruangans.edit', compact('ruangan'));
    }

    public function update(Request $request, string $id): RedirectResponse
    {
        if (!session()->has('user_id')) {
            return redirect('/login');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'capacity' => 'required|integer',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5000',
        ]);

        $ruangan = Ruangan::findOrFail($id);

        $data = $request->only(['title', 'capacity', 'description']);

        if ($request->hasFile('image')) {
            $newImage = $request->file('image')->store('public/ruangans');
            $filename = basename($newImage);

            // Hapus gambar lama
            if ($ruangan->image && Storage::exists('public/ruangans/' . $ruangan->image)) {
                Storage::delete('public/ruangans/' . $ruangan->image);
            }

            $data['image'] = $filename;
        }

        $ruangan->update($data);

        return redirect()->route('admin.ruangans.index')->with('success', 'Data berhasil diubah.');
    }

    public function destroy(string $id): RedirectResponse
    {
        if (!session()->has('user_id')) {
            return redirect('/login');
        }

        $ruangan = Ruangan::findOrFail($id);

        if ($ruangan->image && Storage::exists('public/ruangans/' . $ruangan->image)) {
            Storage::delete('public/ruangans/' . $ruangan->image);
        }

        $ruangan->delete();

        return redirect()->route('admin.ruangans.index')->with('success', 'Data berhasil dihapus.');
    }
}
