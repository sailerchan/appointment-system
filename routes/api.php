<?php
// routes/api.php
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

// Test 1: Plain text response - FIXED: removed unreachable code
Route::get('/test', function () {
    return "API IS WORKING - PLAIN TEXT";
});

// Test 2: JSON response
Route::get('/test-json', function () {
    return response()->json(['message' => 'API JSON is working']);
});

// Test 3: Simple array response
Route::get('/test-simple', function () {
    return ['status' => 'success', 'message' => 'Simple array works'];
});

// Test 4: Hello world
Route::get('/hello', function () {
    return "Hello World from API!";
});

// =====================
// API RESOURCE ROUTES
// =====================
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

// =====================
// CUSTOM API ROUTES
// =====================
Route::get('appointments/resident/{residentId}', [AppointmentController::class, 'getByResident']);
Route::get('appointments/status/{statusId}', [AppointmentController::class, 'getByStatus']);
Route::put('appointments/{appointment}/status', [AppointmentController::class, 'updateStatus']);

Route::get('notifications/resident/{residentId}', [NotificationController::class, 'getByResident']);
Route::put('notifications/{notification}/mark-read', [NotificationController::class, 'markAsRead']);

Route::get('roles/{role}/users', [RoleController::class, 'getUsersByRole']);

Route::post('reports/generate-appointment', [ReportController::class, 'generateAppointmentReport']);
Route::get('reports/generate-service-demand', [ReportController::class, 'generateServiceDemandReport']);

Route::put('settings/update-notifications', [SettingController::class, 'updateNotificationSettings']);

Route::post('public/appointments', [AppointmentController::class, 'store']);
Route::get('public/appointments/{reference_no}', [AppointmentController::class, 'showByReference']);
Route::get('public/services', [ServiceController::class, 'index']);
Route::get('public/time-slots/available', [TimeSlotController::class, 'getAvailableSlots']);

// =====================
// NEW CONFIG & HEALTH CHECK ROUTES - ADDED
// =====================

// Health check route
Route::get('/health-check', function () {
    return response()->json([
        'status' => 'healthy',
        'message' => 'Health check is working!',
        'app_name' => config('app.name', 'Laravel'),
        'app_env' => config('app.env', 'local'),
        'app_debug' => config('app.debug', false),
        'timestamp' => now()->toDateTimeString(),
        'laravel_version' => app()->version(),
        'php_version' => PHP_VERSION
    ]);
});

// Providers check route
Route::get('/check-providers', function () {
    $providers = config('app.providers', []);
    $hasBroadcast = false;
    
    foreach ($providers as $provider) {
        if (str_contains($provider, 'Broadcast')) {
            $hasBroadcast = true;
            break;
        }
    }
    
    return response()->json([
        'message' => 'Providers check route is working!',
        'total_providers' => count($providers),
        'broadcast_removed' => !$hasBroadcast,
        'first_5_providers' => array_slice($providers, 0, 5)
    ]);
});

// Database test route
Route::get('/test-db', function () {
    try {
        DB::connection()->getPdo();
        return response()->json([
            'database' => 'Connected successfully',
            'database_name' => DB::connection()->getDatabaseName(),
            'connection' => config('database.default')
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'database' => 'Connection failed',
            'error' => $e->getMessage()
        ], 500);
    }
});

// Config test route
Route::get('/config-test', function () {
    return response()->json([
        'app' => [
            'name' => config('app.name'),
            'env' => config('app.env'),
            'debug' => config('app.debug'),
            'url' => config('app.url'),
            'timezone' => config('app.timezone'),
            'locale' => config('app.locale')
        ],
        'services' => [
            'database' => config('database.default'),
            'cache' => config('cache.default'),
            'session' => config('session.driver'),
            'queue' => config('queue.default')
        ]
    ]);
});

// =====================
// FALLBACK ROUTE - UPDATED
// =====================
Route::fallback(function () {
    return response()->json([
        'error' => 'Route not found',
        'available_routes' => [
            '/api/test',
            '/api/test-json',
            '/api/test-simple',
            '/api/hello',
            '/api/health-check',
            '/api/check-providers',
            '/api/test-db',
            '/api/config-test'
        ],
        'message' => 'Please check the API documentation'
    ], 404);
});