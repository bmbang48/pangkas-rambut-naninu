<?php

namespace App\Http\Controllers;

use App\Http\Resources\BookingResource;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $bookings = Booking::with(['barbers', 'services'])->latest()->paginate(10);

        return new BookingResource(true, "Menampilkan Data Bookings", $bookings);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validator = Validator::make($request->all(), [
            'barber_id' => 'required|exists:barbers,id',
            'service_id' => 'required|exists:materials,id',
            'customer_name' => 'required|string|max:255',
            'phone' => 'required|string|max:16',
            'booking_date' => 'required',
            'booking_time' => 'required',
            'notes' => 'nullable|string',
            'status' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $existingBooking = Booking::where('barber_id', $request->barber_id)
            ->where('booking_date', $request->booking_date)
            ->where('booking_time', $request->booking_time)
            ->first();

        if ($existingBooking) {
            return response()->json([
                'message' => 'Slot waktu sudah dibooking'
            ], 409);
        }

        $booking = Booking::create([
            'barber_id' => $request->barber_id,
            'service_id' => $request->service_id,
            'customer_name' => $request->customer_name,
            'phone' => $request->phone,
            'booking_date' => $request->booking_date,
            'booking_time' => $request->booking_time,
            'notes' => $request->notes,
            'status' => $request->status
        ]);

        return new BookingResource(true, "Data Booking Berhasil Ditambahkan", $booking);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
        $booking = Booking::find($id);

        return new BookingResource(true, "Detail Data Booking", $booking);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        $booking = Booking::find($id);
        $validator = Validator::make($request->all(), [
            'barber_id' => 'required|exists:barbers,id',
            'service_id' => 'required|exists:materials,id',
            'customer_name' => 'required|string|max:255',
            'phone' => 'required|string|max:16',
            'booking_date' => 'required',
            'booking_time' => 'required',
            'notes' => 'nullable|string',
            'status' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $booking->update([
            'barber_id' => $request->barber_id,
            'service_id' => $request->service_id,
            'customer_name' => $request->customer_name,
            'phone' => $request->phone,
            'booking_date' => $request->booking_date,
            'booking_time' => $request->booking_time,
            'notes' => $request->notes,
            'status' => $request->status
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $booking = Booking::find($id);

        $booking->delete();

        return new BookingResource(true, "Data Booking Berhasil Dihapus", null);
    }
}
