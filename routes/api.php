<?php
// routes/api.php
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\CompanyController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ResidentController;
use App\Http\Controllers\TimeSlotController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ServiceDemandController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\CategoryController;


// =====================
// SUPER SIMPLE TEST ROUTES
// =====================

// Test 1: Plain text response
Route::get('/test', function () {
    return "API IS WORKING - PLAIN TEXT";
    return response()->json([
        'message' => 'API is working!',
        'endpoints' => [
            'GET /api/users' => 'List all users',
            'GET /api/appointments' => 'List all appointments',
            'GET /api/services' => 'List all services',
            'POST /api/appointments' => 'Create new appointment'
        ]
    ]);
});

// Test 2: JSON response
Route::get('/test-json', function () {
    return response()->json(['message' => 'API JSON is working']);
});
Route::apiResource('appointments', AppointmentController::class);
Route::apiResource('users', UserController::class);
Route::apiResource('residents', ResidentController::class);
Route::apiResource('time-slots', TimeSlotController::class);
Route::apiResource('services', ServiceController::class);
Route::apiResource('settings', SettingController::class);
Route::apiResource('status', StatusController::class);
Route::apiResource('roles', RoleController::class);
Route::apiResource('positions', PositionController::class);
Route::apiResource('categories', CategoryController::class);
Route::apiResource('notifications', NotificationController::class);
Route::apiResource('service-demands', ServiceDemandController::class);
Route::apiResource('reports', ReportController::class);

// Test 3: Simple array response
Route::get('/test-simple', function () {
    return ['status' => 'success', 'message' => 'Simple array works'];
});
Route::get('appointments/resident/{residentId}', [AppointmentController::class, 'getByResident']);
Route::get('appointments/status/{statusId}', [AppointmentController::class, 'getByStatus']);
Route::put('appointments/{appointment}/status', [AppointmentController::class, 'updateStatus']);

// Test 4: Hello world
Route::get('/hello', function () {
    return "Hello World from API!";
});
Route::get('notifications/resident/{residentId}', [NotificationController::class, 'getByResident']);
Route::put('notifications/{notification}/mark-read', [NotificationController::class, 'markAsRead']);

Route::get('roles/{role}/users', [RoleController::class, 'getUsersByRole']);

Route::post('reports/generate-appointment', [ReportController::class, 'generateAppointmentReport']);
Route::get('reports/generate-service-demand', [ReportController::class, 'generateServiceDemandReport']);

// =====================
// BASIC CONTROLLER TEST (Optional)
// =====================
// Route::get('/users', function () {
//     return ['users' => []];
// });
Route::put('settings/update-notifications', [SettingController::class, 'updateNotificationSettings']);

Route::post('public/appointments', [AppointmentController::class, 'store']);
Route::get('public/appointments/{reference_no}', [AppointmentController::class, 'showByReference']);
Route::get('public/services', [ServiceController::class, 'index']);
Route::get('public/time-slots/available', [TimeSlotController::class, 'getAvailableSlots']);

// =====================
// FALLBACK ROUTE
// =====================
Route::fallback(function () {
    return response()->json([
        'error' => 'Route not found',
        'available_routes' => [
            '/api/test',
            '/api/test-json',
            '/api/test-simple',
            '/api/hello'
        ],
        'message' => 'Please check the API documentation'
    ], 404);
});
