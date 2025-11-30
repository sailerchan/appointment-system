<?php
// routes/api.php
use Illuminate\Support\Facades\Route;

// =====================
// SUPER SIMPLE TEST ROUTES
// =====================

// Test 1: Plain text response
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
// BASIC CONTROLLER TEST (Optional)
// =====================
// Route::get('/users', function () {
//     return ['users' => []];
// });

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
        ]
    ], 404);
});
