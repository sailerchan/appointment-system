<?php
// app/Http/Controllers/SettingController.php
namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index(): JsonResponse
    {
        $settings = Setting::first();

        if (!$settings) {
            return response()->json([
                'success' => false,
                'message' => 'Settings not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $settings
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'barangay_name' => 'required|string',
            'barangay_address' => 'required|string',
            'barangay_agtain' => 'required|string',
            'contact_number' => 'required|string',
            'office_hour_start' => 'required|date_format:H:i',
            'office_hours_end' => 'required|date_format:H:i',
            'office_days' => 'required|array',
            'max_daily_appointments' => 'required|integer',
            'appointment_duration' => 'required|integer',
            'email_notifications' => 'boolean',
            'sms_notifications' => 'boolean'
        ]);

        $settings = Setting::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Settings created successfully',
            'data' => $settings
        ], 201);
    }

    public function show(Setting $setting): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => $setting
        ]);
    }

    public function update(Request $request, Setting $setting): JsonResponse
    {
        $validated = $request->validate([
            'barangay_name' => 'sometimes|string',
            'barangay_address' => 'sometimes|string',
            'barangay_agtain' => 'sometimes|string',
            'contact_number' => 'sometimes|string',
            'office_hour_start' => 'sometimes|date_format:H:i',
            'office_hours_end' => 'sometimes|date_format:H:i',
            'office_days' => 'sometimes|array',
            'max_daily_appointments' => 'sometimes|integer',
            'appointment_duration' => 'sometimes|integer',
            'email_notifications' => 'boolean',
            'sms_notifications' => 'boolean'
        ]);

        $setting->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Settings updated successfully',
            'data' => $setting
        ]);
    }

    public function destroy(Setting $setting): JsonResponse
    {
        $setting->delete();

        return response()->json([
            'success' => true,
            'message' => 'Settings deleted successfully'
        ]);
    }
}
