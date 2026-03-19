<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificate Verification - Smart NGO</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .verification-header {
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
            color: white;
            padding: 60px 0;
            text-align: center;
        }
        .verification-card {
            max-width: 800px;
            margin: -30px auto 0;
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        .certificate-badge {
            background: #28a745;
            color: white;
            padding: 8px 20px;
            border-radius: 25px;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .verification-stamp {
            background: #e8f5e8;
            border: 3px solid #28a745;
            color: #28a745;
            padding: 15px;
            border-radius: 10px;
            text-align: center;
            font-weight: bold;
            margin: 20px 0;
        }
        .qr-section {
            background: #f8f9fa;
            padding: 30px;
            text-align: center;
        }
        .certificate-details {
            background: #fff;
            padding: 30px;
        }
        .detail-row {
            padding: 15px 0;
            border-bottom: 1px solid #eee;
        }
        .detail-row:last-child {
            border-bottom: none;
        }
        .detail-label {
            font-weight: 600;
            color: #666;
            width: 150px;
        }
        .footer {
            background: #f8f9fa;
            padding: 30px;
            text-align: center;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="verification-header">
        <div class="container">
            <i class="fas fa-certificate fa-4x mb-3"></i>
            <h1 class="display-4 fw-bold">Certificate Verification</h1>
            <p class="lead">Authentic Certificate from Smart NGO</p>
        </div>
    </div>

    <div class="container my-5">
        <div class="verification-card">
            <div class="verification-stamp mx-3 mt-3">
                <i class="fas fa-check-circle fa-2x mb-2"></i>
                <h4>✅ VERIFIED</h4>
                <p class="mb-0">This certificate is authentic and valid</p>
            </div>

            <div class="certificate-details">
                <h3 class="mb-4">Certificate Information</h3>
                
                <div class="detail-row d-flex">
                    <span class="detail-label">Certificate ID:</span>
                    <span class="fw-bold">{{ $certificate->certificate_number }}</span>
                </div>
                
                <div class="detail-row d-flex">
                    <span class="detail-label">Recipient:</span>
                    <span>{{ $certificate->recipient_name }}</span>
                </div>
                
                <div class="detail-row d-flex">
                    <span class="detail-label">Email:</span>
                    <span>{{ $certificate->recipient_email }}</span>
                </div>
                
                <div class="detail-row d-flex">
                    <span class="detail-label">Type:</span>
                    <span><span class="certificate-badge">{{ $certificate->type }}</span></span>
                </div>
                
                <div class="detail-row d-flex">
                    <span class="detail-label">Issue Date:</span>
                    <span>{{ $certificate->created_at->format('d F Y') }}</span>
                </div>
                
                @if($certificate->metadata && isset($certificate->metadata['description']))
                <div class="detail-row d-flex">
                    <span class="detail-label">Description:</span>
                    <span>{{ $certificate->metadata['description'] }}</span>
                </div>
                @endif
                
                @if($certificate->user)
                <div class="detail-row d-flex">
                    <span class="detail-label">Member ID:</span>
                    <span>#{{ str_pad($certificate->user->id, 6, '0', STR_PAD_LEFT) }}</span>
                </div>
                @endif
            </div>

            <div class="qr-section">
                <h4 class="mb-3">Scan QR Code for Verification</h4>
                <p class="text-muted mb-4">This QR code contains a direct link to this verification page</p>
                
                <div class="d-flex justify-content-center">
                    <img src="data:image/svg+xml;base64,{{ base64_encode(\SimpleSoftwareIO\QrCode\Facades\QrCode::size(200)->format('svg')->generate(url('/verify/certificate/' . $certificate->certificate_number))) }}" 
                         alt="QR Code" class="border rounded p-2 bg-white">
                </div>
                
                <div class="mt-4">
                    <small class="text-muted">
                        Verification URL: <br>
                        <code>{{ url('/verify/certificate/' . $certificate->certificate_number) }}</code>
                    </small>
                </div>
            </div>
        </div>

        <div class="footer mt-5">
            <div class="container">
                <h4 class="mb-3">About Smart NGO</h4>
                <p class="mb-2">Smart NGO is dedicated to making a positive impact in communities through education, healthcare, and social welfare initiatives.</p>
                <p class="mb-0">
                    <strong>Contact:</strong> info@smartngo.org | 
                    <strong>Website:</strong> <a href="{{ url('/') }}" class="text-decoration-none">{{ url('/') }}</a>
                </p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
