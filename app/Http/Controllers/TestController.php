<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\MyEmailWithAttachment;
use Illuminate\Support\Facades\Mail;
use App\Models\Attachment; // Assuming you have an Attachment model



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

    public function index()
    {
        // Return the view with the attachment selector
        return view('index'); // Create this view
    }

    public function getAttachment($filename)
    {
        // Define the path to your files
        $filePath = public_path('files/' . $filename);

        // Check if the file exists
        if (file_exists($filePath)) {
            return response()->json([
                'file_url' => asset('files/' . $filename),
                'file_type' => mime_content_type($filePath),
            ]);
        }

        return response()->json(['error' => 'File not found'], 404);
    }
}
