<?php
// app/Http/Controllers/NotificationController.php
namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index(): JsonResponse
    {
        $notifications = Notification::with(['resident', 'appointment'])
            ->get();

        return response()->json([
            'success' => true,
            'data' => $notifications
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'resident_id' => 'required|exists:residents,resident_id',
            'appointment_id' => 'required|exists:appointments,appointment_id',
            'message' => 'required|string',
            'sent_at' => 'required|date',
            'is_read' => 'boolean'
        ]);

        $notification = Notification::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Notification created successfully',
            'data' => $notification->load(['resident', 'appointment'])
        ], 201);
    }

    public function show(Notification $notification): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => $notification->load(['resident', 'appointment'])
        ]);
    }

    public function update(Request $request, Notification $notification): JsonResponse
    {
        $validated = $request->validate([
            'resident_id' => 'sometimes|exists:residents,resident_id',
            'appointment_id' => 'sometimes|exists:appointments,appointment_id',
            'message' => 'sometimes|string',
            'sent_at' => 'sometimes|date',
            'is_read' => 'boolean'
        ]);

        $notification->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Notification updated successfully',
            'data' => $notification->load(['resident', 'appointment'])
        ]);
    }

    public function destroy(Notification $notification): JsonResponse
    {
        $notification->delete();

        return response()->json([
            'success' => true,
            'message' => 'Notification deleted successfully'
        ]);
    }

    public function getByResident($residentId): JsonResponse
    {
        $notifications = Notification::with(['appointment'])
            ->where('resident_id', $residentId)
            ->get();

        return response()->json([
            'success' => true,
            'data' => $notifications
        ]);
    }

    public function markAsRead(Notification $notification): JsonResponse
    {
        $notification->update(['is_read' => true]);

        return response()->json([
            'success' => true,
            'message' => 'Notification marked as read',
            'data' => $notification
        ]);
    }
}
