<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: 'Helvetica', 'Arial', sans-serif; padding: 40px; color: #333; line-height: 1.6; }
        .receipt-container { border: 1px solid #eee; padding: 30px; border-radius: 15px; }
        .header { display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 40px; border-bottom: 3px solid #cc0000; padding-bottom: 20px; }
        .ngo-info h1 { color: #cc0000; margin: 0; font-size: 24pt; font-weight: bold; }
        .ngo-info p { margin: 2px 0; font-size: 10pt; color: #666; }
        .receipt-details { text-align: right; }
        .receipt-details h2 { margin: 0; color: #333; }
        .content { margin-top: 30px; }
        .donor-box { background: #f9f9f9; padding: 20px; border-radius: 10px; margin-bottom: 30px; }
        .donor-box p { margin: 5px 0; }
        .table { width: 100%; border-collapse: collapse; margin-bottom: 30px; }
        .table th { background: #cc0000; color: #fff; padding: 12px; text-align: left; }
        .table td { padding: 15px; border-bottom: 1px solid #eee; }
        .total-row td { font-weight: bold; font-size: 14pt; color: #cc0000; }
        .qr-section { margin-top: 50px; border-top: 1px solid #eee; padding-top: 20px; display: flex; align-items: center; }
        .qr-code { float: right; margin-left: 20px; }
        .footer { margin-top: 100px; text-align: center; font-size: 9pt; color: #999; }
        .signature-box { border-top: 1px solid #333; width: 150px; text-align: center; padding-top: 5px; font-weight: bold; }
    </style>
</head>
<body>
    <div class="receipt-container">
        <div class="header">
            <div class="ngo-info">
                <h1>SAMRAT FOUNDATION</h1>
                <p>Registration No: NGO/DEL/2026/01</p>
                <p>Address: 123, Vikas Marg, New Delhi - 110092</p>
                <p>Email: contact@samratfoundation.in | Phone: +91 99999 99999</p>
            </div>
            <div class="receipt-details">
                <h2>DONATION RECEIPT</h2>
                <p><strong>Receipt #:</strong> {{ $donation->receipt_number }}</p>
                <p><strong>Date:</strong> {{ $donation->created_at->format('d M, Y') }}</p>
            </div>
        </div>

        <div class="content">
            <div class="donor-box">
                <p><strong>Donor Name:</strong> {{ $donation->donor_name }}</p>
                <p><strong>Donor Email:</strong> {{ $donation->donor_email }}</p>
                @if($donation->donor_phone)
                    <p><strong>Donor Phone:</strong> {{ $donation->donor_phone }}</p>
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
                            Donation for {{ $donation->campaign->title ?? 'General Fund' }}
                            <br><small>Payment Method: {{ ucfirst($donation->payment_method) }}</small>
                        </td>
                        <td style="text-align: right;">₹ {{ number_format($donation->amount, 2) }}</td>
                    </tr>
                    <tr class="total-row">
                        <td style="text-align: right;">TOTAL:</td>
                        <td style="text-align: right;">₹ {{ number_format($donation->amount, 2) }}</td>
                    </tr>
                </tbody>
            </table>

            <p style="font-size: 11pt; color: #555;">
                <strong>Amount in words:</strong> Rupee One Thousand Five Hundred Only (Simulated example)
            </p>
        </div>

        <div class="qr-section">
            <div style="width: 70%; float: left;">
                <p style="font-size: 10pt; color: #666;">
                    * This is a computer-generated receipt, no signature required.
                    <br>* Donations to Samrat Foundation are tax-exempt under Section 80G of the IT Act.
                    <br>* Your contribution helps us empower lives. Thank you!
                </p>
                <div style="margin-top: 40px;">
                    <div class="signature-box">Authorized Signatory</div>
                </div>
            </div>
            <div class="qr-code">
                {!! $qrCode !!}
                <p style="font-size: 8pt; text-align: center; margin-top: 5px;">Scan to Verify</p>
            </div>
        </div>

        <div style="clear: both;"></div>
        
        <div class="footer">
            © 2026 Samrat Foundation. All rights reserved. | Visit us at www.samratfoundation.in
        </div>
    </div>
</body>
</html>
