<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class NotificationController extends Controller
{
    public function send(Request $request)
    {
        // Directly accessing 'message' and 'permalink_url' from request input
        $message = $request->input('message', 'Default message content');
        $permalinkUrl = $request->input('permalink_url', 'https://defaultlink.com');

        $webhookUrl = 'https://discord.com/api/webhooks/1229621577872703540/9Jrv2KXlBKkTVJ5xGCT-bD2Dztpr_htT7tBQX8oq5FB0hhM3QtG9-Zc8IY8VPx0WsC4H';

        try {
            $response = Http::post($webhookUrl, [
                'username' => 'Housing Corporation Bot', // Customize the webhook bot's name
                'avatar_url' => 'https://pngimg.com/uploads/meta/meta_PNG1.png', // Customize the avatar
                'embeds' => [
                    [
                        'title' => 'New Facebook Post!',
                        'description' => 'Click below to view the post on Facebook.',
                        'color' => hexdec('4A90E2'), // Discord embed side color
                        'fields' => [
                            ['name' => 'Message', 'value' => $message, 'inline' => false],
                            ['name' => 'Link', 'value' => $permalinkUrl, 'inline' => false],
                        ],
                        'image' => [
                            'url' => 'https://example.com/path_to_banner_image.jpg' // Banner image URL
                        ]
                    ]
                ]
            ]);

            // Correct logging with context
            Log::info('Webhook response', ['response' => $response->json()]);
            if ($response->successful()) {
                return response()->json(['message' => 'Notification sent successfully!'], 200);
            } else {
                Log::error('Failed to send notification', ['response' => $response->body()]);
                return response()->json(['error' => 'Failed to send notification.', 'details' => $response->body()], 500);
            }
        } catch (\Exception $e) {
            // Log exception details
            Log::error('Error sending notification', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json(['error' => 'Server error occurred.', 'details' => $e->getMessage()], 500);
        }
    }
}
