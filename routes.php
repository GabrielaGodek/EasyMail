<?php
require_once __DIR__ . '/router.php';

// Encode the URL to replace special characters with percent-encoded values
$dirname = urlencode(dirname($_SERVER["REQUEST_URI"]));

get($dirname . '/index', '/index.php');
get($dirname . '/users', '/src/views/users.php');
get($dirname . '/categories', '/src/views/categories.php');
get($dirname . '/form', '/src/views/form.php');

any('/404', '/src/views/404.php');
