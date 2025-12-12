<?php
require __DIR__ . '/vendor/autoload.php';
\ = require_once __DIR__ . '/bootstrap/app.php';
\->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

echo "=== Controller Method Check ===\n\n";

// Check if controllers have basic methods
\ = [
    'App\Http\Controllers\AppointmentController',
    'App\Http\Controllers\ServiceController',
    'App\Http\Controllers\CategoryController'
];

foreach (\ as \) {
    if (class_exists(\)) {
        echo "✅ " . class_basename(\) . " exists\n";
        
        \ = get_class_methods(\);
        \ = ['index', 'store', 'show', 'update', 'destroy'];
        \ = array_intersect(\, \);
        
        if (count(\) > 0) {
            echo "   Has methods: " . implode(', ', \) . "\n";
        } else {
            echo "   ⚠️ Missing standard REST methods\n";
        }
    } else {
        echo "❌ " . class_basename(\) . " not found\n";
    }
    echo "\n";
}

echo "=== End Check ===\n";
?>
