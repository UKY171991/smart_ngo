@php
    $receiptSettings = \App\Models\Setting::pluck('value', 'setting_key')->toArray();
    $primaryColor = $receiptSettings['receipt_primary_color'] ?? '#28a745';
@endphp
<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: 'Helvetica', 'Arial', sans-serif; padding: 20px; color: #333; line-height: 1.4; font-size: 8pt; }
        .receipt-container { border: 2px solid {{ $primaryColor }}; padding: 15px; border-radius: 12px; background: #fff; position: relative; }
        
        .header-table { width: 100%; border-bottom: 3px solid {{ $primaryColor }}; padding-bottom: 10px; margin-bottom: 20px; }
        .ngo-name { color: {{ $primaryColor }}; margin: 0; font-size: 18pt; font-weight: bold; text-transform: uppercase; }
        .ngo-info p { margin: 1px 0; font-size: 8pt; color: #666; }
        
        .receipt-title { font-size: 16pt; font-weight: bold; color: #333; margin: 0; }
        .receipt-meta p { margin: 2px 0; font-size: 8pt; text-align: right; }
        
        .content { margin-top: 10px; }
        .donor-box { background: #f8f9fa; padding: 15px; border-radius: 8px; margin-bottom: 15px; border-left: 5px solid {{ $primaryColor }}; }
        .donor-box h3 { margin-top: 0; color: {{ $primaryColor }}; font-size: 11pt; margin-bottom: 8px; }
        .donor-box p { margin: 3px 0; font-size: 9pt; }
        
        .item-table { width: 100%; border-collapse: collapse; margin-bottom: 15px; }
        .item-table th { background: {{ $primaryColor }}; color: #fff; padding: 10px; text-align: left; font-size: 9pt; }
        .item-table td { padding: 10px; border-bottom: 1px solid #eee; font-size: 10pt; }
        .total-row { background: #f8f9fa; font-weight: bold; }
        .amount-big { font-size: 14pt; color: {{ $primaryColor }}; }
        
        .amount-words { background: #fffde7; padding: 10px; border-radius: 5px; border-left: 4px solid #fbc02d; margin: 10px 0; font-style: italic; font-size: 8pt; }
        
        .tax-info { background: #e3f2fd; padding: 10px; border-radius: 5px; border-left: 4px solid #1e88e5; margin: 10px 0; font-size: 8pt; }
        
        .footer { margin-top: 30px; text-align: center; font-size: 7pt; color: #888; border-top: 1px solid #eee; padding-top: 10px; }
        .sig-container { margin-top: 50px; position: relative; }
        .sig-block { text-align: center; width: 300px; float: right; position: relative; }
        .sig-image-container { height: 85px; margin-bottom: 5px; position: relative; width: 100%; }
        .sig-image { position: absolute; top: 15px; right: 10px; max-height: 65px; z-index: 20; }
        .stamp-image { position: absolute; top: -5px; left: 10px; height: 90px; opacity: 1; z-index: 10; }
        .sig-line { border-top: 1.5px solid #444; padding-top: 5px; font-weight: bold; font-size: 9pt; }
        .sig-title { font-size: 8pt; color: #444; margin-top: 2px; }
        .sig-dept { font-size: 7pt; color: #888; }
        .clearfix { clear: both; }
    </style>
</head>
<body>
    <div class="receipt-container">
        
        <table class="header-table" cellpadding="0" cellspacing="0">
            <tr>
                <td width="65%" valign="top" class="ngo-info">
                    @if(isset($receiptSettings['receipt_logo']))
                        <img src="{{ public_path('storage/' . $receiptSettings['receipt_logo']) }}" style="max-height: 50px; margin-bottom: 10px;">
                    @endif
                    <h1 class="ngo-name">{{ $receiptSettings['receipt_ngo_name'] ?? $receiptSettings['ngo_name'] ?? 'SMART NGO' }}</h1>
                    <p><strong>Reg No:</strong> {{ $receiptSettings['receipt_reg_no'] ?? 'NGO/DEL/2026/01' }}</p>
                    <p><strong>Address:</strong> {{ $receiptSettings['contact_address'] ?? '123 NGO Street, City - 123456' }}</p>
                    <p><strong>Email:</strong> {{ $receiptSettings['contact_email'] ?? 'info@smartngo.org' }} | <strong>Phone:</strong> {{ $receiptSettings['contact_phone'] ?? '+91-9876543210' }}</p>
                </td>
                <td width="35%" valign="top" class="receipt-meta">
                    <div style="text-align: right; margin-bottom: 10px;">
                        <img src="data:image/svg+xml;base64,{{ base64_encode(\SimpleSoftwareIO\QrCode\Facades\QrCode::size(80)->format('svg')->generate(url('/verify/donation/' . $donation->receipt_number))) }}" style="border: 1px solid #ddd; padding: 4px; border-radius: 5px; width: 60px; height: 60px;">
                        <p style="font-size: 6pt; color: {{ $primaryColor }}; font-weight: bold; margin-top: 2px; margin-bottom: 0;">SCAN TO VERIFY</p>
                    </div>
                    <h2 class="receipt-title">DONATION</h2>
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
                        <th width="75%">Description</th>
                        <th width="25%" style="text-align: right;">Amount (INR)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td valign="top">
                            <div style="font-weight: bold; font-size: 11pt;">{{ $donation->campaign->title ?? 'General Donation' }}</div>
                            <div style="color: #777; font-size: 8pt; margin-top: 4px;">Payment Method: {{ strtoupper($donation->payment_method) }}</div>
                        </td>
                        <td valign="top" style="text-align: right;" class="amount-big">₹ {{ number_format($donation->amount, 2) }}</td>
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

            <div class="sig-container">
                <div class="sig-block">
                    <div class="sig-image-container">
                        @if(isset($receiptSettings['receipt_stamp']))
                            <img src="{{ public_path('storage/' . $receiptSettings['receipt_stamp']) }}" class="stamp-image">
                        @endif
                        @if(isset($receiptSettings['receipt_signature']))
                            <img src="{{ public_path('storage/' . $receiptSettings['receipt_signature']) }}" class="sig-image">
                        @endif
                    </div>
                    <div class="sig-line">{{ $receiptSettings['receipt_sign_title'] ?? 'Authorized Signatory' }}</div>
                    <div class="sig-dept">{{ $receiptSettings['receipt_sign_dept'] ?? 'Smart NGO Official' }}</div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>

        <div class="footer">
            <strong>{{ $receiptSettings['receipt_ngo_name'] ?? $receiptSettings['ngo_name'] ?? 'Smart NGO' }}</strong> | {{ $receiptSettings['receipt_footer_note'] ?? 'Making a Positive Impact in Communities' }}<br>
            Email: {{ $receiptSettings['contact_email'] ?? 'info@smartngo.org' }} | Website: {{ $receiptSettings['website_url'] ?? 'www.smartngo.org' }}<br>
            &copy; {{ date('Y') }} {{ $receiptSettings['ngo_name'] ?? 'Smart NGO' }}. All rights reserved.
        </div>
    </div>
</body>
</html>
