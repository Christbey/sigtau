<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function send(Request $request)
    {
        // Assuming 'data' is the key under which the payload is nested
        $message = $request->input('message', 'Default message content');
        $permalinkUrl = $request->input('permalink_url', 'https://defaultlink.com');

        $webhookUrl = 'https://discord.com/api/webhooks/1229621577872703540/9Jrv2KXlBKkTVJ5xGCT-bD2Dztpr_htT7tBQX8oq5FB0hhM3QtG9-Zc8IY8VPx0WsC4H'; // Your Discord webhook URL

        $response = Http::post($webhookUrl, [
            'username' => 'Housing Corporation Bot', // Optional: Customize the name of the webhook bot
            'avatar_url' => 'https://pngimg.com/uploads/meta/meta_PNG1.png', // Optional: Customize the avatar of the webhook bot
            'embeds' => [
                [
                    'title' => 'New Facebook Post!',
                    'description' => 'Click below to view the post on Facebook.',
                    'color' => hexdec('4A90E2'), // Discord embed side color, a hex code in decimal
                    'fields' => [
                        ['name' => 'Message', 'value' => $message, 'inline' => false],
                        ['name' => 'Link', 'value' => $permalinkUrl, 'inline' => false],
                    ],
                    'image' => [
                        'url' => 'https://example.com/path_to_banner_image.jpg' // URL to the banner image
                    ]
                ]
            ]
        ]);

        if ($response->successful()) {
            return response()->json(['message' => 'Notification sent successfully!'], 200);
        } else {
            return response()->json(['error' => 'Failed to send notification.', 'details' => $response->body()], 500);
        }
    }
}
