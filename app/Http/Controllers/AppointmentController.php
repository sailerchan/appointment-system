<?php
// app/Http/Controllers/AppointmentController.php
namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    // GET /api/appointments
    public function index(): JsonResponse
    {
        $appointments = Appointment::with([
            'resident',
            'service',
            'timeSlot',
            'status'
        ])->get();

        return response()->json([
            'success' => true,
            'data' => $appointments
        ]);
    }

    // POST /api/appointments
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'resident_id' => 'required|exists:residents,resident_id',
            'service_id' => 'required|exists:services,service_id',
            'timeslot_id' => 'required|exists:time_slots,timeslot_id',
            'status_id' => 'nullable||exists:status,status_id',
            'purpose_notes' => 'sometimes|nullable|string|max:500',
        ]);

        $appointment = Appointment::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Appointment created successfully',
            'data' => $appointment->load(['resident', 'service', 'timeSlot', 'status'])
        ], 201);
    }

    // GET /api/appointments/{id}
    public function show(Appointment $appointment): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => $appointment->load(['resident', 'service', 'role', 'timeSlot', 'status'])
        ]);
    }

    // PUT/PATCH /api/appointments/{id}
    public function update(Request $request, Appointment $appointment): JsonResponse
    {
        $validated = $request->validate([
            'resident_id' => 'sometimes|exists:residents,resident_id',
            'service_id' => 'sometimes|exists:services,service_id',
            'timeslot_id' => 'sometimes|exists:time_slots,timestop_id', // ⚠️ FIXED
            'status_id' => 'sometimes|exists:status,status_id',
            'purpose_notes' => 'sometimes|string|max:500',
        ]);

        $appointment->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Appointment updated successfully',
            'data' => $appointment->load(['resident', 'service', 'role', 'timeSlot', 'status'])
        ]);
    }

    // DELETE /api/appointments/{id}
    public function destroy(Appointment $appointment): JsonResponse
    {
        $appointment->delete();

        return response()->json([
            'success' => true,
            'message' => 'Appointment deleted successfully'
        ]);
    }

    // GET /api/appointments/resident/{residentId}
    public function getByResident($residentId): JsonResponse
    {
        $appointments = Appointment::with(['service', 'timeSlot', 'status'])
            ->where('resident_id', $residentId)
            ->get();

        return response()->json([
            'success' => true,
            'data' => $appointments
        ]);
    }

    // GET /api/appointments/status/{statusId}
    public function getByStatus($statusId): JsonResponse
    {
        $appointments = Appointment::with(['resident', 'service', 'timeSlot'])
            ->where('status_id', $statusId)
            ->get();

        return response()->json([
            'success' => true,
            'data' => $appointments
        ]);
    }

    // PUT /api/appointments/{id}/status
    public function updateStatus(Appointment $appointment, Request $request): JsonResponse
    {
        $request->validate([
            'status_id' => 'required|exists:status,status_id'
        ]);

        $appointment->update(['status_id' => $request->status_id]);

        return response()->json([
            'success' => true,
            'message' => 'Appointment status updated successfully',
            'data' => $appointment->load('status')
        ]);
    }
}
