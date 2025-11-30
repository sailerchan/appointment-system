<?php
// app/Http/Controllers/PositionController.php
namespace App\Http\Controllers;

use App\Models\Position;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    public function index(): JsonResponse
    {
        $positions = Position::all();

        return response()->json([
            'success' => true,
            'data' => $positions
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'position_name' => 'required|string|unique:positions',
            'description' => 'nullable|string'
        ]);

        $position = Position::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Position created successfully',
            'data' => $position
        ], 201);
    }

    public function show(Position $position): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => $position
        ]);
    }

    public function update(Request $request, Position $position): JsonResponse
    {
        $validated = $request->validate([
            'position_name' => 'sometimes|string|unique:positions,position_name,' . $position->position_id . ',position_id',
            'description' => 'nullable|string'
        ]);

        $position->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Position updated successfully',
            'data' => $position
        ]);
    }

    public function destroy(Position $position): JsonResponse
    {
        $position->delete();

        return response()->json([
            'success' => true,
            'message' => 'Position deleted successfully'
        ]);
    }
}
