<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 20px auto; padding: 20px; border: 1px solid #eee; border-radius: 10px; }
        .header { background: #0d6efd; color: #fff; padding: 15px; border-radius: 10px 10px 0 0; text-align: center; }
        .content { padding: 20px; }
        .footer { font-size: 12px; color: #777; text-align: center; padding: 15px; }
        .label { font-weight: bold; color: #555; }
        .message-box { background: #f8f9fa; padding: 15px; border-radius: 5px; margin-top: 10px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>New Website Enquiry</h2>
        </div>
        <div class="content">
            <p>You have received a new enquiry through the website contact form.</p>
            <hr>
            <p><span class="label">Name:</span> {{ $enquiry->name }}</p>
            <p><span class="label">Email:</span> {{ $enquiry->email }}</p>
            <p><span class="label">Subject:</span> {{ $enquiry->subject ?? 'N/A' }}</p>
            <p><span class="label">Message:</span></p>
            <div class="message-box">
                {{ $enquiry->message }}
            </div>
        </div>
        <div class="footer">
            <p>This email was sent automatically from Smart NGO Platform.</p>
        </div>
    </div>
</body>
</html>
