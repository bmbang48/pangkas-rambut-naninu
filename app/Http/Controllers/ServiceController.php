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
    public function index()
    {
        //
        $services = Service::latest()->paginate(10);

        return new ServiceResource(true, 'Menampilkan Data Services', $services);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'duration' => 'required|number',
            'price' => 'required|number'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $service = Service::create([
            'name' => $request->name,
            'duration' => $request->duration,
            'price' => $request->price,
        ]);

        return new ServiceResource(true, 'Data Service Berhasil Ditambahkan', $service);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
        $service = Service::find($id);

        return new ServiceResource(true, 'Menampilkan Detail Service', $service);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        $service = Service::find($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'duration' => 'required|number',
            'price' => 'required|number'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $service->update([
            'name' => $request->name,
            'duration' => $request->duration,
            'price' => $request->price,
        ]);

        return new ServiceResource(true, 'Data Service Berhasil Diubah', $service);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $service = Service::find($id);

        $service->delete();

        return new ServiceResource(true, 'Data Service Berhasil Dihapus', null);
    }
}
