<?php
// app/Http/Controllers/ResidentController.php
namespace App\Http\Controllers;

use App\Models\Resident;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ResidentController extends Controller
{
    public function index(): JsonResponse
    {
        $residents = Resident::with(['appointments'])
            ->get();

        return response()->json([
            'success' => true,
            'data' => $residents
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'email_address' => 'required|email',
            'phone_number' => 'required|string|max:20'
        ]);

        $resident = Resident::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Resident created successfully',
            'data' => $resident
        ], 201);
    }

    public function show(Resident $resident): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => $resident->load(['appointments'])
        ]);
    }

    public function update(Request $request, Resident $resident): JsonResponse
    {
        $validated = $request->validate([
            'full_name' => 'sometimes|string|max:255',
            'email_address' => 'sometimes|email',
            'phone_number' => 'sometimes|string|max:20'
        ]);

        $resident->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Resident updated successfully',
            'data' => $resident
        ]);
    }

    public function destroy(Resident $resident): JsonResponse
    {
        $resident->delete();

        return response()->json([
            'success' => true,
            'message' => 'Resident deleted successfully'
        ]);
    }
}
