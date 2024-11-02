<!DOCTYPE html>
<html>
<head>
    <title>Email Subject</title>
</head>
<body>
    <h1>Email Content</h1>
    <p>{{ $data['message'] }}</p>
    <!-- Add more content based on the array -->

    @if(!empty($attachments))
        <h2>Attachments:</h2>
        <ul>
            @foreach($attachments as $attachment)
                <li>
                    <a href="{{ asset('files/' . basename($attachment['file'])) }}">
                        {{ basename($attachment['file']) }}
                    </a>
                </li>
            @endforeach
        </ul>
    @endif
</body>
</html>
