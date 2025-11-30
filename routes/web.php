<?php
// routes/web.php
use Illuminate\Support\Facades\Route;

Route::get('/test-web', function () {
    return "WEB ROUTE IS WORKING!";
});

Route::get('/test-api-from-web', function () {
    return "This is a web route that mimics API";
});
