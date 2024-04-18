<?php

namespace App\Jobs;

use App\Http\Controllers\NotificationController;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Http\Request;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class ProcessWebhookJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $message;
    protected $permalinkUrl;

    public function __construct($message, $permalinkUrl)
    {
        $this->message = $message;
        $this->permalinkUrl = $permalinkUrl;
    }

    public function handle(Request $request)
    {
        // Authenticate the request
        if ($request->header('X-Zapier-Secret') !== env('ZAPIER_SECRET')) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // Log the incoming webhook payload for inspection
        Log::info('Webhook received:', $request->all());

        // Extract message and permalink_url directly from the request
        $message = $request->input('message', 'Default message content');
        $permalinkUrl = $request->input('permalink_url', 'https://defaultlink.com');

        // For testing purposes, log a generic message
        $this->sendGenericMessage("Webhook received and processed: $message");

        // Forward the data to the NotificationController
        $notificationController = app(NotificationController::class);
        return $notificationController->send(new Request([
            'message' => $message,
            'permalink_url' => $permalinkUrl
        ]));
    }
}

