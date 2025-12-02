<?php
use Illuminate\Support\Facades\Route;

// Homepage/root route
Route::get('/', function () {
    return "Welcome to Laravel! Homepage is working.";
});

// Your existing routes
Route::get('/test-web', function () {
    return "WEB ROUTE IS WORKING!";
});

Route::get('/test-api-from-web', function () {
    return "This is a web route that mimics API";
});
