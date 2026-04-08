<?php

namespace App\Http\Controllers;

use App\Http\Resources\BookingResource;
use App\Models\Booking;
use App\Models\Service;
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

        return new BookingResource(true, "Daftar Pesanan Pangkas Rambut Naninu", $bookings);
    }

    /**
     * Store a newly created resource in storage.
     */

    private function generateSlots()
    {
        $start = strtotime("10:00");
        $end = strtotime("21:00");

        $slots = [];

        while ($start < $end) {
            $slots[] = date("H:i", $start);

            $start = strtotime("+15 minutes", $start);
        }

        return $slots;
    }
    public function availableSlots(Request $request)
    {
        $barberId = $request->barber_id;
        $serviceId = $request->service_id;
        $date = $request->date;

        $service = Service::findOrFail($serviceId);
        $duration = $service->duration;

        $slots = $this->generateSlots();

        $bookings = Booking::where('barber_id', $barberId)
            ->where('booking_date', $date)
            ->get();

        $available = [];

        foreach ($slots as $slot) {
            $slotStart = strtotime($slot);
            $slotEnd = strtotime("+$duration minutes", $slotStart);

            $conflict = false;
            
            if ($slotEnd > strtotime("21:00")) {
                $conflict = true;
            } else {
                foreach ($bookings as $booking) {
                    $bookingStart = strtotime($booking->booking_time);

                    $bookingService = Service::find($booking->service_id);
                    $bookingEnd = strtotime("+{$bookingService->duration} minutes", $bookingStart);

                    if ($slotStart < $bookingEnd && $slotEnd > $bookingStart) {

                        $conflict = true;
                        break;
                    }
                }
            }
            if (!$conflict) {
                $available[] = $slot;
            }
        }

        return response()->json([
            "success" => true,
            "slots" => $available
        ]);
    }

    public function updateStatus(Request $request, Booking $booking)
    {
        $request->validate([
            'status' => 'required|in:pending,completed,canceled'
        ]);

        $booking->update([
            'status' => $request->status
        ]);

        if ($request->wantsJson()) {
            return response()->json(['success' => true, 'message' => 'Status pesanan berhasil diperbarui']);
        }

        return back()->with('success', 'Status pesanan berhasil diperbarui');
    }

    public function store(Request $request)
    {
        //
        $validator = Validator::make($request->all(), [
            'barber_id' => 'required|exists:barbers,id',
            'service_id' => 'required|exists:services,id',
            'customer_name' => 'required|string|max:255',
            'phone' => 'required|string|max:16',
            'booking_date' => 'required|date_format:Y-m-d',
            'booking_time' => 'required|date_format:H:i',
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
        $existing = Booking::where('barber_id', $request->barber_id)
            ->where('booking_date', $request->booking_date)
            ->where('booking_time', $request->booking_time)
            ->exists();

        if ($existing) {

            return response()->json([
                "message" => "Slot sudah dibooking"
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



        return new BookingResource(true, "Pesanan berhasil dibuat", $booking);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
        $booking = Booking::find($id);

        return new BookingResource(true, "Detail Pesanan", $booking);
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
            'service_id' => 'required|exists:services,id',
            'customer_name' => 'required|string|max:255',
            'phone' => 'required|string|max:16',
            'booking_date' => 'required|date_format:Y-m-d',
            'booking_time' => 'required|date_format:H:i',
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

        return new BookingResource(true, "Pesanan berhasil dihapus", null);
    }
}
