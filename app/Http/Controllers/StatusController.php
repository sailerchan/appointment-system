<?php
// app/Http/Controllers/StatusController.php
namespace App\Http\Controllers;

use App\Models\Status;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    public function index(): JsonResponse
    {
        $statuses = Status::all();

        return response()->json([
            'success' => true,
            'data' => $statuses
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'status_name' => 'required|string',
            'status_type' => 'required|in:appointment,user,system',
            'description' => 'nullable|string'
        ]);

        $status = Status::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Status created successfully',
            'data' => $status
        ], 201);
    }

    public function show(Status $status): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => $status
        ]);
    }

    public function update(Request $request, Status $status): JsonResponse
    {
        $validated = $request->validate([
            'status_name' => 'sometimes|string',
            'status_type' => 'sometimes|in:appointment,user,system',
            'description' => 'nullable|string'
        ]);

        $status->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Status updated successfully',
            'data' => $status
        ]);
    }

    public function destroy(Status $status): JsonResponse
    {
        $status->delete();

        return response()->json([
            'success' => true,
            'message' => 'Status deleted successfully'
        ]);
    }
}
