<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Certificate from Smart NGO</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px;
            text-align: center;
            border-radius: 10px 10px 0 0;
        }
        .content {
            background: #f9f9f9;
            padding: 30px;
            border-radius: 0 0 10px 10px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        .certificate-info {
            background: white;
            padding: 20px;
            border-left: 4px solid #667eea;
            margin: 20px 0;
            border-radius: 5px;
        }
        .verification-link {
            background: #e8f5e8;
            padding: 15px;
            border-radius: 5px;
            text-align: center;
            margin: 20px 0;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #ddd;
            color: #666;
            font-size: 14px;
        }
        .btn {
            display: inline-block;
            padding: 12px 24px;
            background: #667eea;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin: 10px 0;
        }
        .certificate-type {
            background: #667eea;
            color: white;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>🏆 Congratulations!</h1>
        <p>Your Certificate is Ready</p>
    </div>

    <div class="content">
        <p>Dear <strong>{{ $certificate->recipient_name }}</strong>,</p>
        
        <p>We are pleased to present your certificate from Smart NGO. Your dedication and contribution have been recognized, and we hope this certificate serves as a testament to your valuable involvement.</p>
        
        <div class="certificate-info">
            <h3>Certificate Details:</h3>
            <p><strong>Certificate Number:</strong> {{ $certificate->certificate_number }}</p>
            <p><strong>Type:</strong> <span class="certificate-type">{{ $certificate->type }}</span></p>
            <p><strong>Issue Date:</strong> {{ $certificate->created_at->format('d M Y') }}</p>
            @if($certificate->metadata && isset($certificate->metadata['description']))
            <p><strong>Description:</strong> {{ $certificate->metadata['description'] }}</p>
            @endif
        </div>

        <div class="verification-link">
            <h3>🔍 Verify Your Certificate</h3>
            <p>Your certificate contains a unique QR code for instant verification. You can also verify it online using the link below:</p>
            <a href="{{ url('/verify/certificate/' . $certificate->certificate_number) }}" class="btn">
                Verify Certificate Online
            </a>
            <p><small>{{ url('/verify/certificate/' . $certificate->certificate_number) }}</small></p>
        </div>

        <p>Your certificate is attached to this email as a PDF file. You can download, print, or share it as needed.</p>

        <p>Thank you for being part of our mission at Smart NGO. Together, we are making a difference!</p>

        <div class="footer">
            <p><strong>Smart NGO</strong><br>
            Making a Positive Impact in Communities<br>
            <a href="mailto:info@smartngo.org">info@smartngo.org</a></p>
        </div>
    </div>
</body>
</html>
