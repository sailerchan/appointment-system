<?php
require __DIR__ . "/vendor/autoload.php";
$app = require_once __DIR__ . "/bootstrap/app.php";
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

echo "=== Controller Method Check ===\n\n";

$controllers = [
    "App\\Http\\Controllers\\AppointmentController",
    "App\\Http\\Controllers\\ServiceController", 
    "App\\Http\\Controllers\\CategoryController"
];

foreach ($controllers as $controller) {
    if (class_exists($controller)) {
        echo "✅ " . class_basename($controller) . " exists\n";
        
        $methods = get_class_methods($controller);
        $requiredMethods = ["index", "store", "show", "update", "destroy"];
        $foundMethods = array_intersect($requiredMethods, $methods);
        
        if (count($foundMethods) > 0) {
            echo "   Has methods: " . implode(", ", $foundMethods) . "\n";
        } else {
            echo "   ⚠️ Missing standard REST methods\n";
        }
    } else {
        echo "❌ " . class_basename($controller) . " not found\n";
    }
    echo "\n";
}

echo "=== End Check ===\n";
?>
