<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::statamic('example', 'example-view', [
//    'title' => 'Example'
// ]);

use App\Http\Controllers\NotificationController;

Route::get('/send-notification', [NotificationController::class, 'send']);

// In routes/web.php or routes/api.php
use App\Http\Controllers\WebhookController;

Route::post('/webhook/zapier', [WebhookController::class, 'handle']);
