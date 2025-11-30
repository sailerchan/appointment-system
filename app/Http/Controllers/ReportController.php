<?php
// app/Http/Controllers/ReportController.php
namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(): JsonResponse
    {
        $reports = Report::all();

        return response()->json([
            'success' => true,
            'data' => $reports
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'total_appointments' => 'required|integer',
            'no_show_rate' => 'required|numeric|min:0|max:100',
            'average_processing_time' => 'required|integer|min:0',
            'generated_at' => 'required|date'
        ]);

        $report = Report::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Report created successfully',
            'data' => $report
        ], 201);
    }

    public function show(Report $report): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => $report
        ]);
    }

    public function update(Request $request, Report $report): JsonResponse
    {
        $validated = $request->validate([
            'total_appointments' => 'sometimes|integer',
            'no_show_rate' => 'sometimes|numeric|min:0|max:100',
            'average_processing_time' => 'sometimes|integer|min:0',
            'generated_at' => 'sometimes|date'
        ]);

        $report->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Report updated successfully',
            'data' => $report
        ]);
    }

    public function destroy(Report $report): JsonResponse
    {
        $report->delete();

        return response()->json([
            'success' => true,
            'message' => 'Report deleted successfully'
        ]);
    }

    // Custom method to generate appointment statistics report
    public function generateAppointmentReport(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date'
        ]);

        // This would typically contain complex query logic
        // For now, we'll return a placeholder response
        $reportData = [
            'period' => $validated['start_date'] . ' to ' . $validated['end_date'],
            'total_appointments' => 0,
            'completed_appointments' => 0,
            'cancelled_appointments' => 0,
            'no_show_count' => 0,
            'completion_rate' => 0
        ];

        return response()->json([
            'success' => true,
            'message' => 'Appointment report generated successfully',
            'data' => $reportData
        ]);
    }

    // Custom method to generate service demand report
    public function generateServiceDemandReport(): JsonResponse
    {
        // This would contain logic to analyze service demands
        $serviceDemandData = [
            'most_requested_service' => null,
            'least_requested_service' => null,
            'average_demand_per_service' => 0,
            'services' => []
        ];

        return response()->json([
            'success' => true,
            'message' => 'Service demand report generated successfully',
            'data' => $serviceDemandData
        ]);
    }
}
