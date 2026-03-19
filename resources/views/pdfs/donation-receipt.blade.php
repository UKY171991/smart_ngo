<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: 'Helvetica', 'Arial', sans-serif; padding: 30px; color: #333; line-height: 1.4; font-size: 8pt; }
        .receipt-container { border: 2px solid #28a745; padding: 20px; padding-top: 80px; border-radius: 15px; background: #fff; position: relative; }
        .header { display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 15px; border-bottom: 3px solid #28a745; padding-bottom: 10px; position: relative; }
        .ngo-info { flex: 1; }
        .ngo-info h1 { color: #28a745; margin: 0; font-size: 18pt; font-weight: bold; }
        .ngo-info p { margin: 1px 0; font-size: 8pt; color: #666; }
        .receipt-details { text-align: right; min-width: 180px; position: absolute; top: 20px; right: 20px; }
        .receipt-details h2 { margin: 0; color: #333; font-size: 16pt; font-weight: bold; }
        .qr-top-right { position: absolute; top: -60px; left: 50%; transform: translateX(-50%); text-align: center; width: 100px; z-index: 10; }
        .qr-top-right img { border: 2px solid #28a745; border-radius: 8px; padding: 3px; background: white; width: 70px !important; height: 70px !important; }
        .qr-top-right p { font-size: 6pt; text-align: center; margin-top: 2px; color: #28a745; font-weight: bold; line-height: 1.2; }
        .content { margin-top: 20px; }
        .donor-box { background: #f8f9fa; padding: 12px; border-radius: 10px; margin-bottom: 15px; border-left: 4px solid #28a745; }
        .donor-box h3 { margin-top: 0; color: #28a745; font-size: 12pt; }
        .donor-box p { margin: 2px 0; font-size: 8pt; }
        .table { width: 100%; border-collapse: collapse; margin-bottom: 15px; }
        .table th { background: #28a745; color: #fff; padding: 8px; text-align: left; font-weight: bold; font-size: 9pt; }
        .table td { padding: 8px; border-bottom: 1px solid #eee; font-size: 9pt; }
        .total-row td { font-weight: bold; font-size: 12pt; color: #28a745; background: #f8f9fa; }
        .amount-words { background: #fff3cd; padding: 8px; border-radius: 8px; border-left: 4px solid #ffc107; margin: 10px 0; font-style: italic; font-size: 8pt; }
        .tax-benefit { background: #d1ecf1; padding: 8px; border-radius: 8px; border-left: 4px solid #17a2b8; margin: 10px 0; font-size: 8pt; }
        .tax-benefit h4 { margin-top: 0; color: #17a2b8; font-size: 10pt; }
        .footer { margin-top: 20px; text-align: center; font-size: 7pt; color: #999; border-top: 1px solid #eee; padding-top: 10px; }
        .signature-box { border-top: 2px solid #333; width: 120px; text-align: center; padding-top: 5px; font-weight: bold; margin-top: 15px; font-size: 8pt; }
    </style>
</head>
<body>
    <div class="receipt-container">
        <div class="header">
            <div class="ngo-info">
                <h1>SMART NGO</h1>
                <p><strong>Registration No:</strong> NGO/DEL/2026/01</p>
                <p><strong>Address:</strong> 123 NGO Street, City - 123456</p>
                <p><strong>Email:</strong> info@smartngo.org | <strong>Phone:</strong> +91-9876543210</p>
                <p><strong>Website:</strong> www.smartngo.org</p>
            </div>
            <div class="receipt-details">
                <h2>DONATION RECEIPT</h2>
                <p><strong>Receipt No:</strong> {{ $donation->receipt_number }}</p>
                <p><strong>Date:</strong> {{ $donation->created_at->format('d M, Y') }}</p>
                <p><strong>Status:</strong> <span style="color: #28a745; font-weight: bold;">COMPLETED</span></p>
            </div>
        </div>

        <div class="qr-top-right">
            <img src="data:image/svg+xml;base64,{{ base64_encode(\SimpleSoftwareIO\QrCode\Facades\QrCode::size(70)->format('svg')->generate(url('/verify/donation/' . $donation->receipt_number))) }}" 
                 alt="Verification QR Code" style="width: 70px; height: 70px;">
            <p>SCAN TO VERIFY</p>
        </div>

        <div class="content">
            <div class="donor-box">
                <h3 style="margin-top: 0; color: #28a745;">Donor Information</h3>
                <p><strong>Name:</strong> {{ $donation->donor_name }}</p>
                <p><strong>Email:</strong> {{ $donation->donor_email }}</p>
                @if($donation->donor_phone)
                    <p><strong>Phone:</strong> {{ $donation->donor_phone }}</p>
                @endif
                @if($donation->user)
                    <p><strong>Member ID:</strong> #{{ str_pad($donation->user->id, 6, '0', STR_PAD_LEFT) }}</p>
                @endif
            </div>

            <table class="table">
                <thead>
                    <tr>
                        <th>Description</th>
                        <th style="text-align: right;">Amount (INR)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <strong>{{ $donation->campaign->title ?? 'General Donation' }}</strong>
                            <br><small style="color: #666;">Payment Method: {{ ucfirst($donation->payment_method) }}</small>
                        </td>
                        <td style="text-align: right; font-size: 16pt; font-weight: bold;">INR {{ number_format($donation->amount, 2) }}</td>
                    </tr>
                    <tr class="total-row">
                        <td style="text-align: right; font-size: 12pt; font-weight: bold;">TOTAL AMOUNT:</td>
                        <td style="text-align: right; font-size: 16pt; font-weight: bold;">INR {{ number_format($donation->amount, 2) }}</td>
                    </tr>
                </tbody>
            </table>

            <div class="amount-words">
                <p><strong>Amount in words:</strong> {{ \App\Helpers\NumberHelper::convertToWords($donation->amount) }} Rupees Only</p>
            </div>

            @if($donation->is_80G)
            <div class="tax-benefit">
                <h4 style="margin-top: 0; color: #17a2b8;">📋 80G Tax Benefit</h4>
                <p style="margin-bottom: 0;">This donation is eligible for tax deduction under Section 80G of the Income Tax Act, 1961. Donation Receipt Number: {{ $donation->receipt_number }}</p>
            </div>
            @endif

            <div style="margin-top: 20px;">
                <div class="signature-box">
                    Authorized Signatory<br>
                    <small style="font-weight: normal;">Smart NGO</small>
                </div>
            </div>
        </div>

        <div style="clear: both;"></div>
        
        <div class="footer">
            <strong>Smart NGO</strong> | Making a Positive Impact in Communities<br>
            Email: info@smartngo.org | Phone: +91-9876543210 | Website: www.smartngo.org<br>
            &copy; {{ date('Y') }} Smart NGO. All rights reserved.
        </div>
    </div>
</body>
</html>
