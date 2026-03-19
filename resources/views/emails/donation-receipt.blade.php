<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You for Your Donation - Smart NGO</title>
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
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
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
        .donation-info {
            background: white;
            padding: 20px;
            border-left: 4px solid #28a745;
            margin: 20px 0;
            border-radius: 5px;
        }
        .receipt-details {
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
            background: #28a745;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin: 10px 0;
        }
        .amount {
            font-size: 24px;
            font-weight: bold;
            color: #28a745;
        }
        .receipt-badge {
            background: #28a745;
            color: white;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .payment-method {
            background: #f8f9fa;
            padding: 8px 16px;
            border-radius: 5px;
            display: inline-block;
            margin: 5px 0;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>🙏 Thank You!</h1>
        <p>Your Generous Donation Makes a Difference</p>
    </div>

    <div class="content">
        <p>Dear <strong>{{ $donation->donor_name }}</strong>,</p>
        
        <p>On behalf of Smart NGO, I want to express our sincere gratitude for your generous donation. Your contribution will help us continue our mission of making a positive impact in communities through education, healthcare, and social welfare initiatives.</p>
        
        <div class="donation-info">
            <h3>Donation Details:</h3>
            <p><strong>Receipt Number:</strong> <span class="receipt-badge">{{ $donation->receipt_number }}</span></p>
            <p><strong>Donation Amount:</strong> <span class="amount">INR {{ number_format($donation->amount, 2) }}</span></p>
            <p><strong>Payment Method:</strong> <span class="payment-method">{{ ucfirst($donation->payment_method) }}</span></p>
            <p><strong>Date:</strong> {{ $donation->created_at->format('d M Y') }}</p>
            
            @if($donation->is_80G)
            <p><strong>Tax Benefit:</strong> <span class="receipt-badge">80G Eligible</span></p>
            @endif
            
            @if($donation->campaign)
            <p><strong>Campaign:</strong> {{ $donation->campaign->title }}</p>
            @endif
        </div>

        <div class="receipt-details">
            <h3>📄 Your Donation Receipt</h3>
            <p>Your official donation receipt is attached to this email as a PDF file. This receipt contains:</p>
            <ul style="text-align: left; max-width: 400px; margin: 0 auto;">
                <li>Official donation details</li>
                <li>Receipt number for your records</li>
                <li>QR code for instant verification</li>
                <li>80G tax benefit information (if applicable)</li>
            </ul>
            
            <p style="margin-top: 20px;">
                <small>
                    Verification URL: <br>
                    <code>{{ url('/verify/donation/' . $donation->receipt_number) }}</code>
                </small>
            </p>
        </div>

        <p>Your donation will directly support our ongoing projects and initiatives. Together, we are creating lasting change in the communities we serve.</p>

        <p>Once again, thank you for your kindness and generosity. Your support means the world to us and to those we serve.</p>

        <div class="footer">
            <p><strong>Smart NGO</strong><br>
            Making a Positive Impact in Communities<br>
            <a href="mailto:info@smartngo.org">info@smartngo.org</a> | 
            <a href="{{ url('/') }}">{{ url('/') }}</a></p>
            
            @if($donation->is_80G)
            <p style="margin-top: 15px; font-size: 12px;">
                <strong>80G Tax Benefit:</strong> This donation is eligible for tax deduction under section 80G of the Income Tax Act, 1961.
            </p>
            @endif
        </div>
    </div>
</body>
</html>
