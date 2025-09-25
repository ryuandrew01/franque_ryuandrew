<?php
// Router for PHP built-in server
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// If it's a file that exists, serve it directly
if (file_exists(__DIR__ . $uri) && $uri !== '/') {
    return false;
}

// Otherwise, route everything through index.php
require_once __DIR__ . '/index.php';
