<?php
// app/Http/Controllers/TimeSlotController.php
namespace App\Http\Controllers;

use App\Models\TimeSlot;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TimeSlotController extends Controller
{
    public function index(): JsonResponse
    {
        $timeSlots = TimeSlot::with(['appointments'])
            ->get();

        return response()->json([
            'success' => true,
            'data' => $timeSlots
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'slot_date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'max_capacity' => 'required|integer|min:1',
            'available_slots' => 'required|integer|min:0'
        ]);

        $timeSlot = TimeSlot::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Time slot created successfully',
            'data' => $timeSlot
        ], 201);
    }

    public function show(TimeSlot $timeSlot): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => $timeSlot->load(['appointments'])
        ]);
    }

    public function update(Request $request, TimeSlot $timeSlot): JsonResponse
    {
        $validated = $request->validate([
            'slot_date' => 'sometimes|date',
            'start_time' => 'sometimes|date_format:H:i',
            'end_time' => 'sometimes|date_format:H:i|after:start_time',
            'max_capacity' => 'sometimes|integer|min:1',
            'available_slots' => 'sometimes|integer|min:0'
        ]);

        $timeSlot->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Time slot updated successfully',
            'data' => $timeSlot
        ]);
    }

    public function destroy(TimeSlot $timeSlot): JsonResponse
    {
        $timeSlot->delete();

        return response()->json([
            'success' => true,
            'message' => 'Time slot deleted successfully'
        ]);
    }
    public function getAvailableSlots(): JsonResponse
{
    $availableSlots = TimeSlot::where('available_slots', '>', 0)
        ->where('slot_date', '>=', now()->toDateString()) // Future slots only
        ->orderBy('slot_date')
        ->orderBy('start_time')
        ->get();

    return response()->json([
        'success' => true,
        'data' => $availableSlots
    ]);
}
}
