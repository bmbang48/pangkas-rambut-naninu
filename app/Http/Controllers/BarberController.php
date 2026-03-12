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
    public function index()
    {
        //
        $barbers = Barber::latest()->paginate(4);

        return new BarberResource(true, 'Data Babers Naninu', $barbers);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'photo' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'experience' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        if ($request->hasFile('photo')) {
            $image = $request->file('image');
            $image->storeAs('barbers', $image->hashName(), 'public');
        }

        $barber = Barber::create([
            'name' => $request->name,
            'photo' => $request->photo,
            'experience' => $request->experience
        ]);

        return new BarberResource(true, 'Barber berhasil ditambahkan', $barber);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
        $barber = Barber::find($id);

        return new BarberResource(true, 'Detail Data Barber', $barber);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        $barber = Barber::find($id);
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'photo' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'experience' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $image->storeAs('public/barbers', $image->hashName());

            Storage::delete('public/barbers' . basename($barber->photo));

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

        Log::info($request->all());

        return new BarberResource(true, 'Data Berhasil Diubah', $barber);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $barber = Barber::find($id);

        $barber->delete();

        return new BarberResource(true, 'Data Barber berhasil dihapus', null);
    }
}
