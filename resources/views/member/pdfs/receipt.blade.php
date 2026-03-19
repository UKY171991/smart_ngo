<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: 'Helvetica', 'Arial', sans-serif; background: #fff; margin: 40px; color: #333; line-height: 1.6; }
        .receipt-header { border-bottom: 3pt solid #cc0000; padding-bottom: 20px; margin-bottom: 30px; display: flex; align-items: center; }
        .ngo-name { font-size: 24pt; font-weight: bold; color: #cc0000; margin-bottom: 5px; }
        .ngo-details { font-size: 9pt; color: #666; }
        .receipt-title { font-size: 18pt; font-weight: bold; color: #333; text-align: center; margin-bottom: 40px; text-transform: uppercase; letter-spacing: 2px; }
        .receipt-body { font-size: 11pt; margin-bottom: 50px; }
        .user-info { margin-bottom: 40px; background: #f9f9f9; padding: 20px; border-radius: 8px; }
        .info-row { display: flex; justify-content: space-between; margin-bottom: 10px; border-bottom: 1px dotted #ccc; padding-bottom: 5px; }
        .info-label { font-weight: bold; color: #555; }
        .info-value { color: #000; }
        .payment-summary { margin-bottom: 50px; }
        .summary-table { width: 100%; border-collapse: collapse; }
        .summary-th { background: #cc0000; color: #fff; padding: 12px; text-align: left; font-size: 10pt; }
        .summary-td { padding: 15px; border-bottom: 1px solid #eee; }
        .amount-cell { font-size: 18pt; font-weight: bold; color: #cc0000; }
        .qr-section { margin-top: 50px; border-top: 1pt solid #eee; padding-top: 20px; display: flex; justify-content: space-between; align-items: center; }
        .qr-code { padding: 10px; border: 1px solid #eee; border-radius: 8px; }
        .footer { position: absolute; bottom: 40px; width: 100%; font-size: 8pt; text-align: center; color: #999; }
        .signature-area { display: flex; justify-content: space-between; margin-top: 80px; }
        .signature-box { border-top: 1px solid #333; width: 150px; text-align: center; padding-top: 10px; font-size: 9pt; }
    </style>
</head>
<body>
    <div class="receipt-header">
        <div>
            <div class="ngo-name">SAMRAT FOUNDATION TRUST</div>
            <div class="ngo-details">Reg No: SFT/IN/2026/001 | 80G Compliant</div>
            <div class="ngo-details">Address: Sector 12, New Delhi - 110001 | Phone: +91 98765 43210</div>
        </div>
    </div>
    
    <div class="receipt-title">Membership Payment Receipt</div>
    
    <div class="user-info">
        <table width="100%">
            <tr>
                <td width="50%">
                    <div class="info-row"><span class="info-label">Member Name:</span> <span class="info-value">{{ $user->name }}</span></div>
                    <div class="info-row"><span class="info-label">Email:</span> <span class="info-value">{{ $user->email }}</span></div>
                    <div class="info-row"><span class="info-label">Phone:</span> <span class="info-value">{{ $user->phone }}</span></div>
                </td>
                <td width="50%" style="padding-left: 40px;">
                    <div class="info-row"><span class="info-label">Receipt No:</span> <span class="info-value">RCP/{{ date('Y') }}/{{ str_pad($user->id, 4, '0', STR_PAD_LEFT) }}</span></div>
                    <div class="info-row"><span class="info-label">Date:</span> <span class="info-value">{{ date('d M, Y') }}</span></div>
                    <div class="info-row"><span class="info-label">Designation:</span> <span class="info-value">{{ $user->designation->title ?? 'Member' }}</span></div>
                </td>
            </tr>
        </table>
    </div>
    
    <div class="payment-summary">
        <table class="summary-table">
            <thead>
                <tr>
                    <th class="summary-th" width="70%">Description</th>
                    <th class="summary-th" width="30%" style="text-align: right;">Amount (INR)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="summary-td">One-time Membership Fee for {{ $user->designation->title ?? 'General Membership' }}</td>
                    <td class="summary-td amount-cell" style="text-align: right;">INR {{ number_format($user->designation->fees ?? 0, 2) }}</td>
                </tr>
            </tbody>
        </table>
    </div>
    
    <p style="font-size: 10pt; color: #666; margin-top: 20px;">
        <em>Note: This is a computer-generated receipt, and no physical signature is required. You can verify this receipt by scanning the QR code below.</em>
    </p>
    
    <div class="qr-section">
        <table width="100%">
            <tr>
                <td width="20%">
                    <div class="qr-code">
                        {!! $qrCode !!}
                    </div>
                </td>
                <td width="80%" style="padding-left: 20px;">
                    <div style="font-size: 9pt; font-weight: bold; color: #cc0000; margin-bottom: 5px;">QR VERIFIED RECEIPT</div>
                    <div style="font-size: 8pt; color: #888;">Scan to verify the authenticity of this document. This receipt is valid for tax exemption benefits under 80G.</div>
                </td>
            </tr>
        </table>
    </div>
    
    <div class="signature-area">
        <div class="signature-box" style="float: left;">NGO Treasurer</div>
        <div class="signature-box" style="float: right;">Direct Authorized Signatory</div>
    </div>
    
    <div class="footer">
        © {{ date('Y') }} SAMRAT FOUNDATION TRUST. All Rights Reserved. Thank you for your support.
    </div>
</body>
</html>
