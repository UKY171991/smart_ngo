<!DOCTYPE html>
<html>
<head>
    <style>
        @page { size: A4 landscape; margin: 0; }
        body { font-family: 'Helvetica', sans-serif; background: #fff; margin: 0; padding: 15px; color: #333; overflow: hidden; }
        .border { border: 8px solid #cc0000; padding: 10px; height: 530px; position: relative; border-radius: 8px; box-sizing: border-box; }
        .inner-border { border: 1px solid #caa85b; padding: 25px; height: 508px; text-align: center; border-radius: 4px; box-sizing: border-box; }
        .cert-no { font-size: 8pt; color: #999; margin-bottom: 10px; text-align: right; }
        .logo { font-size: 16pt; font-weight: bold; color: #cc0000; margin-bottom: 5px; text-transform: uppercase; letter-spacing: 1.5px; }
        .title { font-size: 20pt; font-family: 'Georgia', serif; font-style: italic; color: #caa85b; margin: 15px 0; }
        .subtitle { font-size: 10pt; margin-bottom: 25px; color: #666; }
        .recipient { font-size: 18pt; font-weight: bold; border-bottom: 1px solid #caa85b; display: inline-block; padding: 0 30px 3px; margin-bottom: 15px; color: #222; }
        .reason { font-size: 10pt; line-height: 1.4; max-width: 80%; margin: 0 auto; color: #444; height: 45px; }
        .footer { position: absolute; bottom: 80px; width: 100%; left: 0; }
        .signature-table { width: 80%; margin: 0 auto; }
        .sign-line { border-top: 1px solid #333; width: 140px; margin: 0 auto; padding-top: 5px; font-weight: bold; font-size: 9pt; }
        .qr-area { position: absolute; bottom: 30px; right: 40px; text-align: center; }
        .qr-area img { width: 55px !important; height: 55px !important; }
    </style>
</head>
<body>
    <div class="border">
        <div class="inner-border">
            <div class="cert-no">NO: {{ $certificate->certificate_number }}</div>
            <div class="logo">SAMRAT FOUNDATION TRUST</div>
            
            <div class="title">Certificate of {{ ucfirst($certificate->type) }}</div>
            
            <div class="subtitle">This is proudly presented to</div>
            
            <div class="recipient">{{ $certificate->recipient_name }}</div>
            
            <div class="reason">
                In recognition of {{ strtolower($certificate->metadata['description'] ?? '') ?: 'outstanding dedication and service.' }}
            </div>
            
            <div class="footer">
                <table class="signature-table" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td align="center"><div class="sign-line">President</div></td>
                        <td align="center"><div class="sign-line">Secretary</div></td>
                    </tr>
                </table>
            </div>
            
            <div class="qr-area">
                <img src="data:image/svg+xml;base64,{{ base64_encode($qrCode) }}" alt="QR">
                <div style="font-size:6pt; margin-top:2px;">VERIFY</div>
            </div>
        </div>
    </div>
</body>
</html>
