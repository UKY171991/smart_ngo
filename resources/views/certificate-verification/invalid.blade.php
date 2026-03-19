<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificate Not Found - Smart NGO</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .error-header {
            background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
            color: white;
            padding: 60px 0;
            text-align: center;
        }
        .error-card {
            max-width: 600px;
            margin: -30px auto 0;
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            padding: 40px;
            text-align: center;
        }
        .error-icon {
            font-size: 80px;
            color: #dc3545;
            margin-bottom: 20px;
        }
        .certificate-code {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
            font-family: monospace;
            font-size: 18px;
            color: #666;
            margin: 20px 0;
        }
        .btn-home {
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
            color: white;
            padding: 12px 30px;
            border: none;
            border-radius: 25px;
            text-decoration: none;
            display: inline-block;
            margin: 20px 0;
        }
        .btn-home:hover {
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(40, 167, 69, 0.3);
        }
        .footer {
            background: #f8f9fa;
            padding: 30px;
            text-align: center;
            color: #666;
            margin-top: 50px;
        }
    </style>
</head>
<body>
    <div class="error-header">
        <div class="container">
            <i class="fas fa-times-circle fa-4x mb-3"></i>
            <h1 class="display-4 fw-bold">Certificate Not Found</h1>
            <p class="lead">The certificate you're looking for could not be verified</p>
        </div>
    </div>

    <div class="container my-5">
        <div class="error-card">
            <i class="fas fa-exclamation-triangle error-icon"></i>
            
            <h3 class="mb-3">Invalid Certificate</h3>
            
            <p class="text-muted mb-4">
                We couldn't find a certificate with the number you provided. This could mean:
            </p>
            
            <div class="text-start mb-4">
                <ul class="list-unstyled">
                    <li><i class="fas fa-times text-danger me-2"></i> The certificate number is incorrect</li>
                    <li><i class="fas fa-times text-danger me-2"></i> The certificate has been revoked</li>
                    <li><i class="fas fa-times text-danger me-2"></i> The certificate doesn't exist in our system</li>
                </ul>
            </div>
            
            <div class="certificate-code">
                <strong>Certificate Number Checked:</strong><br>
                {{ $certificate_number }}
            </div>
            
            <h5 class="mt-4 mb-3">What to do next?</h5>
            <p class="text-muted">
                Please double-check the certificate number and try again. If you believe this is an error, contact our support team.
            </p>
            
            <div class="mt-4">
                <a href="{{ url('/') }}" class="btn-home">
                    <i class="fas fa-home me-2"></i> Return to Homepage
                </a>
            </div>
            
            <div class="mt-4">
                <small class="text-muted">
                    <strong>Need Help?</strong><br>
                    Email: <a href="mailto:info@smartngo.org">info@smartngo.org</a><br>
                    Phone: +91-9876543210
                </small>
            </div>
        </div>
    </div>

    <div class="footer">
        <div class="container">
            <h4 class="mb-3">About Smart NGO</h4>
            <p class="mb-2">Smart NGO is dedicated to making a positive impact in communities through education, healthcare, and social welfare initiatives.</p>
            <p class="mb-0">
                <strong>Contact:</strong> info@smartngo.org | 
                <strong>Website:</strong> <a href="{{ url('/') }}" class="text-decoration-none">{{ url('/') }}</a>
            </p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
