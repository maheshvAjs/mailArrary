<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\MyEmailWithAttachment;
use Illuminate\Support\Facades\Mail;


class TestController extends Controller
{
    public function sendEmail()
    {
        $data = [
            'message' => 'This is a test message.',
        ];
    
        $attachments = [
            [
                'file' => public_path('files/sample.pdf'),  // Path to your first attachment
                'options' => [
                    'as' => 'sample.pdf', // Optional: custom name for the attachment
                    'mime' => 'application/pdf', // Optional: specify the MIME type
                ],
            ],
            [
                'file' => public_path('files/images.jpeg'), // Path to your second attachment
                'options' => [
                    'as' => 'custom_images.jpeg',
                    'mime' => 'image/png',
                ],
            ],
        ];

        Mail::to('recipient@example.com')->send(new MyEmailWithAttachment($data, $attachments));
    
        return 'Email sent successfully!';
    }
}
