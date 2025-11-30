<?php
// app/Http/Controllers/ServiceDemandController.php
namespace App\Http\Controllers;

use App\Models\ServiceDemand;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ServiceDemandController extends Controller
{
    public function index(): JsonResponse
    {
        $serviceDemands = ServiceDemand::with(['service'])
            ->get();

        return response()->json([
            'success' => true,
            'data' => $serviceDemands
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'service_id' => 'required|exists:services,service_id',
            'request_count' => 'required|integer|min:0',
            'percentage' => 'required|numeric|min:0|max:100',
            'ranking' => 'required|integer|min:1'
        ]);

        $serviceDemand = ServiceDemand::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Service demand created successfully',
            'data' => $serviceDemand->load(['service'])
        ], 201);
    }

    public function show(ServiceDemand $serviceDemand): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => $serviceDemand->load(['service'])
        ]);
    }

    public function update(Request $request, ServiceDemand $serviceDemand): JsonResponse
    {
        $validated = $request->validate([
            'service_id' => 'sometimes|exists:services,service_id',
            'request_count' => 'sometimes|integer|min:0',
            'percentage' => 'sometimes|numeric|min:0|max:100',
            'ranking' => 'sometimes|integer|min:1'
        ]);

        $serviceDemand->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Service demand updated successfully',
            'data' => $serviceDemand->load(['service'])
        ]);
    }

    public function destroy(ServiceDemand $serviceDemand): JsonResponse
    {
        $serviceDemand->delete();

        return response()->json([
            'success' => true,
            'message' => 'Service demand deleted successfully'
        ]);
    }
}
