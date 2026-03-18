<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: 'Helvetica', sans-serif; background: #fff; margin: 0; padding: 40px; color: #333; }
        .border { border: 15px solid #cc0000; padding: 40px; height: 90%; position: relative; }
        .inner-border { border: 2px solid #caa85b; padding: 50px; height: 100%; text-align: center; }
        .logo { font-size: 28pt; font-weight: bold; color: #cc0000; margin-bottom: 10px; text-transform: uppercase; letter-spacing: 3px; }
        .title { font-size: 40pt; font-family: 'Georgia', serif; font-style: italic; color: #caa85b; margin: 30px 0; }
        .subtitle { font-size: 14pt; margin-bottom: 40px; }
        .recipient { font-size: 32pt; font-weight: bold; border-bottom: 2px solid #ccc; display: inline-block; padding: 0 50px 10px; margin-bottom: 30px; }
        .reason { font-size: 14pt; line-height: 1.6; max-width: 80%; margin: 0 auto; color: #555; }
        .footer { position: absolute; bottom: 50px; width: 100%; display: flex; justify-content: space-between; padding: 0 40px; box-sizing: border-box; }
        .signature { border-top: 1px solid #333; width: 200px; padding-top: 10px; text-align: center; font-weight: bold; }
        .qr-area { position: absolute; bottom: 40px; right: 40px; }
        .cert-no { position: absolute; top: 40px; right: 40px; font-size: 10pt; color: #999; }
    </style>
</head>
<body>
    <div class="border">
        <div class="inner-border">
            <div class="cert-no">{{ $certificate->certificate_number }}</div>
            <div class="logo">SAMRAT FOUNDATION TRUST</div>
            
            <div class="title">Certificate of {{ ucfirst($certificate->type) }}</div>
            
            <div class="subtitle">This is proudly presented to</div>
            
            <div class="recipient">{{ $certificate->recipient_name }}</div>
            
            <div class="reason">
                In recognition of {{ strtolower($certificate->metadata['description']) ?? 'outstanding dedication and service.' }}
            </div>
            
            <div class="footer">
                <div class="signature" style="float: left;">
                    President
                </div>
                <div class="signature" style="float: right; margin-right: 150px;">
                    Secretary
                </div>
            </div>
            
            <div class="qr-area">
                {!! $qrCode !!}
                <div style="font-size:8pt; margin-top:5px;">Scan to Verify</div>
            </div>
        </div>
    </div>
</body>
</html>
