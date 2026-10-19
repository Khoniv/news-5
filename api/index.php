<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

define('LARAVEL_START', microtime(true));

require __DIR__.'/../vendor/autoload.php';

$app = require __DIR__.'/../bootstrap/app.php';

// Vercel terminates TLS at the edge; the internal PHP server only sees http.
// Force https so asset()/url() generate https URLs (avoids mixed-content blocking).
URL::forceScheme('https');

$app->handleRequest(Request::capture());
