<?php
// app/Http/Controllers/ServiceController.php
namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index(): JsonResponse
    {
        $services = Service::with(['appointments', 'serviceDemands', 'category'])
            ->get();

        return response()->json([
            'success' => true,
            'data' => $services
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'service_name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,category_id'
        ]);

        $service = Service::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Service created successfully',
            'data' => $service->load(['category'])
        ], 201);
    }

    public function show(Service $service): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => $service->load(['appointments', 'serviceDemands', 'category'])
        ]);
    }

    public function update(Request $request, Service $service): JsonResponse
    {
        $validated = $request->validate([
            'service_name' => 'sometimes|string|max:255',
            'category_id' => 'sometimes|exists:categories,category_id'
        ]);

        $service->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Service updated successfully',
            'data' => $service->load(['category'])
        ]);
    }

    public function destroy(Service $service): JsonResponse
    {
        $service->delete();

        return response()->json([
            'success' => true,
            'message' => 'Service deleted successfully'
        ]);
    }
}
