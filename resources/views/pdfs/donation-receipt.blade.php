<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: 'Helvetica', 'Arial', sans-serif; padding: 20px; color: #333; line-height: 1.4; font-size: 8pt; }
        .receipt-container { border: 2px solid #28a745; padding: 15px; border-radius: 12px; background: #fff; position: relative; }
        
        .header-table { width: 100%; border-bottom: 3px solid #28a745; padding-bottom: 10px; margin-bottom: 20px; }
        .ngo-name { color: #28a745; margin: 0; font-size: 20pt; font-weight: bold; }
        .ngo-info p { margin: 1px 0; font-size: 8pt; color: #666; }
        
        .receipt-title { font-size: 16pt; font-weight: bold; color: #333; margin: 0; }
        .receipt-meta p { margin: 2px 0; font-size: 8pt; text-align: right; }
        
        .qr-section { text-align: center; padding: 10px 0; }
        .qr-section img { border: 1px solid #ddd; padding: 5px; border-radius: 5px; width: 65px; height: 65px; }
        .qr-section p { font-size: 6pt; color: #28a745; font-weight: bold; margin-top: 3px; }
        
        .content { margin-top: 10px; }
        .donor-box { background: #f8f9fa; padding: 15px; border-radius: 8px; margin-bottom: 15px; border-left: 5px solid #28a745; }
        .donor-box h3 { margin-top: 0; color: #28a745; font-size: 11pt; margin-bottom: 8px; }
        .donor-box p { margin: 3px 0; font-size: 9pt; }
        
        .item-table { width: 100%; border-collapse: collapse; margin-bottom: 15px; }
        .item-table th { background: #28a745; color: #fff; padding: 10px; text-align: left; font-size: 9pt; }
        .item-table td { padding: 10px; border-bottom: 1px solid #eee; font-size: 10pt; }
        .total-row { background: #f8f9fa; font-weight: bold; }
        .amount-big { font-size: 14pt; color: #28a745; }
        
        .amount-words { background: #fffde7; padding: 10px; border-radius: 5px; border-left: 4px solid #fbc02d; margin: 10px 0; font-style: italic; font-size: 8pt; }
        
        .tax-info { background: #e3f2fd; padding: 10px; border-radius: 5px; border-left: 4px solid #1e88e5; margin: 10px 0; font-size: 8pt; }
        
        .footer { margin-top: 30px; text-align: center; font-size: 7pt; color: #888; border-top: 1px solid #eee; padding-top: 10px; }
        .sig-container { margin-top: 30px; }
        .sig-line { border-top: 2px solid #444; width: 150px; text-align: center; padding-top: 5px; font-weight: bold; font-size: 9pt; }
    </style>
</head>
<body>
    <div class="receipt-container">
        
        <div class="qr-section">
            <img src="data:image/svg+xml;base64,{{ base64_encode(\SimpleSoftwareIO\QrCode\Facades\QrCode::size(80)->format('svg')->generate(url('/verify/donation/' . $donation->receipt_number))) }}" alt="QR">
            <p>SCAN TO VERIFY</p>
        </div>

        <table class="header-table" cellpadding="0" cellspacing="0">
            <tr>
                <td width="60%" valign="top" class="ngo-info">
                    <h1 class="ngo-name">SMART NGO</h1>
                    <p><strong>Reg No:</strong> NGO/DEL/2026/01</p>
                    <p><strong>Address:</strong> 123 NGO Street, City - 123456</p>
                    <p><strong>Email:</strong> info@smartngo.org | <strong>Phone:</strong> +91-9876543210</p>
                    <p><strong>Website:</strong> www.smartngo.org</p>
                </td>
                <td width="40%" valign="top" class="receipt-meta">
                    <h2 class="receipt-title">DONATION RECEIPT</h2>
                    <p><strong>Receipt No:</strong> {{ $donation->receipt_number }}</p>
                    <p><strong>Date:</strong> {{ $donation->created_at->format('d M, Y') }}</p>
                    <p style="margin-top: 5px;"><strong>Status:</strong> <span style="color: #28a745; font-weight: bold; background: #e8f5e9; padding: 2px 8px; border-radius: 4px;">COMPLETED</span></p>
                </td>
            </tr>
        </table>

        <div class="content">
            <div class="donor-box">
                <h3>Donor Information</h3>
                <p><strong>Name:</strong> {{ $donation->donor_name }}</p>
                <p><strong>Email:</strong> {{ $donation->donor_email }}</p>
                @if($donation->donor_phone)
                    <p><strong>Phone:</strong> {{ $donation->donor_phone }}</p>
                @endif
                @if($donation->user)
                    <p><strong>Member ID:</strong> #{{ str_pad($donation->user->id, 6, '0', STR_PAD_LEFT) }}</p>
                @endif
            </div>

            <table class="item-table">
                <thead>
                    <tr>
                        <th width="70%">Description</th>
                        <th width="30%" style="text-align: right;">Amount (INR)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <div style="font-weight: bold; font-size: 11pt;">{{ $donation->campaign->title ?? 'General Donation' }}</div>
                            <div style="color: #777; font-size: 8pt; margin-top: 4px;">Payment Method: {{ strtoupper($donation->payment_method) }}</div>
                        </td>
                        <td style="text-align: right;" class="amount-big">₹ {{ number_format($donation->amount, 2) }}</td>
                    </tr>
                    <tr class="total-row">
                        <td style="text-align: right; font-weight: bold;">TOTAL CONTRIBUTION:</td>
                        <td style="text-align: right;" class="amount-big">₹ {{ number_format($donation->amount, 2) }}</td>
                    </tr>
                </tbody>
            </table>

            <div class="amount-words">
                <strong>Amount in words:</strong> {{ \App\Helpers\NumberHelper::convertToWords($donation->amount) }} Rupees Only
            </div>

            @if($donation->is_80G)
            <div class="tax-info">
                <div style="font-weight: bold; color: #1e88e5; margin-bottom: 3px;">📋 80G Tax Benefit Info</div>
                This donation is eligible for tax deduction under Section 80G of the Income Tax Act, 1961. 
                Keep this receipt for your tax filings.
            </div>
            @endif

            <table width="100%" class="sig-container">
                <tr>
                    <td width="30%">
                        <div class="sig-line">Authorized Signatory</div>
                        <div style="font-size: 7pt; color: #666; margin-top: 2px;">Smart NGO Official</div>
                    </td>
                    <td></td>
                </tr>
            </table>
        </div>

        <div class="footer">
            <strong>Smart NGO</strong> | Making a Positive Impact in Communities<br>
            Email: info@smartngo.org | Phone: +91-9876543210 | Website: www.smartngo.org<br>
            &copy; {{ date('Y') }} Smart NGO. All rights reserved.
        </div>
    </div>
</body>
</html>
