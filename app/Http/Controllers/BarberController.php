<?php

namespace App\Http\Controllers;

use App\Http\Resources\BarberResource;
use App\Models\Barber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class BarberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $barbers = Barber::latest()->paginate(10);

        if ($request->wantsJson() || $request->is('api/*')) {
            return new BarberResource(true, 'Data Barber Pangkas Rambut Naninu', $barbers);
        }

        return view('barbers.index', compact('barbers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('barbers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'photo' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'experience' => 'required',
        ]);

        if ($validator->fails()) {
            if ($request->wantsJson() || $request->is('api/*')) {
                return response()->json($validator->errors(), 422);
            }
            return back()->withErrors($validator)->withInput();
        }

        $photoPath = null;
        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $image->storeAs('barbers', $image->hashName(), 'public');
            $photoPath = $image->hashName();
        }

        $barber = Barber::create([
            'name' => $request->name,
            'photo' => $photoPath,
            'experience' => $request->experience
        ]);

        if ($request->wantsJson() || $request->is('api/*')) {
            return new BarberResource(true, 'Barber berhasil ditambahkan', $barber);
        }

        return redirect()->route('barbers.index')->with('success', 'Barber berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $barber = Barber::find($id);

        return new BarberResource(true, 'Detail Data Barber', $barber);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $barber = Barber::findOrFail($id);
        return view('barbers.edit', compact('barber'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $barber = Barber::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'photo' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'experience' => 'required',
        ]);

        if ($validator->fails()) {
            if ($request->wantsJson() || $request->is('api/*')) {
                return response()->json($validator->errors(), 422);
            }
            return back()->withErrors($validator)->withInput();
        }

        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $image->storeAs('barbers', $image->hashName(), 'public');

            if ($barber->photo) {
                Storage::disk('public')->delete('barbers/' . $barber->photo);
            }

            $barber->update([
                'name' => $request->name,
                'experience' => $request->experience,
                'photo' => $image->hashName()
            ]);
        } else {
            $barber->update([
                'name' => $request->name,
                'experience' => $request->experience,
            ]);
        }

        if ($request->wantsJson() || $request->is('api/*')) {
            return new BarberResource(true, 'Data Berhasil Diubah', $barber);
        }

        return redirect()->route('barbers.index')->with('success', 'Barber berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        $barber = Barber::findOrFail($id);

        if ($barber->photo) {
            Storage::disk('public')->delete('barbers/' . $barber->photo);
        }

        $barber->delete();

        if ($request->wantsJson() || $request->is('api/*')) {
            return new BarberResource(true, 'Data Barber berhasil dihapus', null);
        }

        return redirect()->route('barbers.index')->with('success', 'Barber berhasil dihapus!');
    }
}
