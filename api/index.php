<?php

// Handle static files
$uri = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

if ($uri !== '/' && file_exists(__DIR__ . '/../public' . $uri)) {
    $path = __DIR__ . '/../public' . $uri;
    $ext = pathinfo($path, PATHINFO_EXTENSION);
    
    $mime_types = [
        'css' => 'text/css',
        'js' => 'application/javascript',
        'png' => 'image/png',
        'jpg' => 'image/jpeg',
        'jpeg' => 'image/jpeg',
        'gif' => 'image/gif',
        'ico' => 'image/x-icon',
    ];
    
    if (isset($mime_types[$ext])) {
        header('Content-Type: ' . $mime_types[$ext]);
    }
    
    readfile($path);
    exit;
}

// Load composer
require __DIR__ . '/../vendor/autoload.php';

// Load Laravel
$app = require __DIR__ . '/../bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

$response->send();

$kernel->terminate($request, $response); 