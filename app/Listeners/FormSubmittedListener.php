<?php
/*
namespace App\Listeners;

use Statamic\Events\FormSubmitted;

class FormSubmittedListener
{
    public function handle(FormSubmitted $event)
    {
        $submission = $event->submission;

        // Format the data for Discord
        $data = [
            'content' => 'A new form submission has been received.',
            'embeds' => [
                [
                    'title' => 'New Submission Details',
                    'fields' => [
                        [
                            'name' => 'Name',
                            'value' => $submission->get('name'),
                            'inline' => true,
                        ],
                        [
                            'name' => 'Email',
                            'value' => $submission->get('email'),
                            'inline' => true,
                        ],
                        [
                            'name' => 'Phone Number',
                            'value' => $submission->get('phoneNumber'),
                            'inline' => true,
                        ],
                        [
                            'name' => 'Membership',
                            'value' => $submission->get('membership'),
                            'inline' => true,
                        ],
                        [
                            'name' => 'Active Number',
                            'value' => $submission->get('activeNumber') ?: 'N/A', // Handle empty values
                            'inline' => true,
                        ],
                        // Include additional fields as needed
                    ],
                ],
            ],
        ];

        // Your webhook URL
        $webhookUrl = env('DISCORD_WEBHOOK_URL');

        // Set up and send the notification to Discord
        $options = [
            'http' => [
                'method' => 'POST',
                'header' => 'Content-Type: application/json',
                'content' => json_encode($data),
            ],
        ];

        $context = stream_context_create($options);
        file_get_contents($webhookUrl, false, $context);
    }
}*/
