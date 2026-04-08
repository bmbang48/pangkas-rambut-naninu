<?php

namespace App\Http\Controllers;

use App\Http\Resources\ServiceResource;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $services = Service::latest()->paginate(10);

        if ($request->wantsJson() || $request->is('api/*')) {
            return new ServiceResource(true, 'Daftar Layanan Pangkas Rambut Naninu', $services);
        }

        return view('services.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('services.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'duration' => 'required|numeric',
            'price' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            if ($request->wantsJson() || $request->is('api/*')) {
                return response()->json($validator->errors(), 422);
            }
            return back()->withErrors($validator)->withInput();
        }

        $service = Service::create([
            'name' => $request->name,
            'duration' => $request->duration,
            'price' => $request->price,
        ]);

        if ($request->wantsJson() || $request->is('api/*')) {
            return new ServiceResource(true, 'Data Service Berhasil Ditambahkan', $service);
        }

        return redirect()->route('services.index')->with('success', 'Layanan berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $service = Service::find($id);

        return new ServiceResource(true, 'Menampilkan Detail Service', $service);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $service = Service::findOrFail($id);
        return view('services.edit', compact('service'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $service = Service::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'duration' => 'required|numeric',
            'price' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            if ($request->wantsJson() || $request->is('api/*')) {
                return response()->json($validator->errors(), 422);
            }
            return back()->withErrors($validator)->withInput();
        }

        $service->update([
            'name' => $request->name,
            'duration' => $request->duration,
            'price' => $request->price,
        ]);

        if ($request->wantsJson() || $request->is('api/*')) {
            return new ServiceResource(true, 'Data Service Berhasil Diubah', $service);
        }

        return redirect()->route('services.index')->with('success', 'Layanan berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        $service = Service::findOrFail($id);

        $service->delete();

        if ($request->wantsJson() || $request->is('api/*')) {
            return new ServiceResource(true, 'Data Service Berhasil Dihapus', null);
        }

        return redirect()->route('services.index')->with('success', 'Layanan berhasil dihapus!');
    }
}
