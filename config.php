<?php
// Database configuration (not used in this version since we're using in-memory storage)
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'inventory_system');

// Application settings
define('APP_NAME', 'Inventory Management System');
define('APP_VERSION', '1.0.0');
define('ADMIN_EMAIL', 'admin@example.com');

// Time zone settings
date_default_timezone_set('UTC');

// Error reporting in development environment
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Session timeout (in seconds)
define('SESSION_TIMEOUT', 3600); // 1 hour

// Page size for pagination
define('PAGE_SIZE', 10);
?>
