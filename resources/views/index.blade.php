<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attachments</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="container mt-5">
        <h2>Select an Attachment</h2>
        <select id="attachmentSelector" class="form-control">
            <option value="" disabled selected>Select an attachment</option>
            <option value="sample.pdf" data-type="application/pdf">Sample PDF</option>
            <option value="images.jpeg" data-type="image/jpeg">Image JPEG</option>
        </select>
    </div>

    <!-- Modal Structure -->
    <div id="attachmentModal" style="display:none; position:fixed; z-index:1000; left:0; top:0; width:100%; height:100%; background-color:rgba(0,0,0,0.5);">
        <div style="position:relative; margin:100px auto; padding:20px; background:#fff; width:80%; max-width:600px; border-radius:5px;">
            <span id="closeModal" style="cursor:pointer; float:right;">&times;</span>
            <h5>Attachment Preview</h5>
            <img id="attachmentImage" src="" alt="Attachment" style="display:none; width:100%;">
            <iframe id="attachmentPDF" src="" style="display:none; width:100%; height:400px;"></iframe>
            <p id="attachmentLink"></p>
        </div>
    </div>

<script>
    $(document).on('change', '#attachmentSelector', function() {
        var attachmentName = $(this).val();
        var attachmentType = $(this).find(':selected').data('type');

        // Make AJAX request to get the attachment
        $.ajax({
            url: '/attachments/' + attachmentName,
            method: 'GET',
            success: function(response) {
                var fileUrl = response.file_url;

                // Clear previous data
                $('#attachmentImage').hide();
                $('#attachmentPDF').hide();
                $('#attachmentLink').hide();

                // Determine how to display the attachment based on its type
                if (attachmentType.startsWith('image/')) {
                    $('#attachmentImage').attr('src', fileUrl).show();
                } else if (attachmentType === 'application/pdf') {
                    $('#attachmentPDF').attr('src', fileUrl).show();
                } else {
                    $('#attachmentLink').html('<a href="' + fileUrl + '" target="_blank">Download Attachment</a>').show();
                }

                // Show the modal
                $('#attachmentModal').fadeIn();
            },
            error: function() {
                alert('Could not load attachment details.');
            }
        });
    });

    // Close modal
    $('#closeModal').on('click', function() {
        $('#attachmentModal').fadeOut();
    });
</script>

</body>
</html>
