<!DOCTYPE html>
<html>
<head>
    <style>
        @page { size: A4 landscape; margin: 0; }
        body { font-family: 'Helvetica', sans-serif; background: #fff; margin: 0; padding: 20px; color: #333; }
        .border { border: 12px double {{ $siteSettings['certificate_border_color'] ?? '#cc0000' }}; padding: 10px; height: 504px; position: relative; border-radius: 4px; box-sizing: border-box; }
        .inner-border { border: 2pt solid #caa85b; padding: 15px; height: 460px; text-align: center; border-radius: 2px; box-sizing: border-box; background: #fff; }
        .cert-no { font-size: 8pt; color: #999; margin-bottom: 5px; text-align: left; }
        
        .header { margin-bottom: 12px; text-align: center; }
        .logo-img { max-height: 55px; display: block; margin: 0 auto 5px; }
        .ngo-name { font-size: 20pt; font-weight: bold; color: {{ $siteSettings['certificate_border_color'] ?? '#cc0000' }}; text-transform: uppercase; letter-spacing: 1px; margin: 0; }
        .tagline { font-size: 8pt; color: #777; font-style: italic; margin-top: 2px; }
        
        .title { font-size: 20pt; font-family: 'Georgia', serif; font-style: italic; color: #caa85b; margin: 10px 0 5px; }
        .subtitle { font-size: 10pt; margin-bottom: 12px; color: #555; text-transform: uppercase; letter-spacing: 1px; }
        
        .recipient { font-size: 24pt; font-weight: bold; border-bottom: 2pt solid #caa85b; display: inline-block; padding: 0 40px 3px; margin-bottom: 12px; color: #111; font-family: 'Times New Roman', serif; }
        
        .reason { font-size: 11pt; line-height: 1.4; max-width: 85%; margin: 0 auto 15px; color: #444; min-height: 40px; }
        
        .footer { width: 94%; margin: 5px auto 0; }
        .signature-table { width: 100%; border-collapse: collapse; }
        .signature-table td { vertical-align: bottom; text-align: center; width: 50%; }
        .sign-area { position: relative; padding: 0 10px; }
        .signature-img { height: 45px; margin-bottom: -10px; display: block; margin: 0 auto; position: relative; z-index: 2; }
        .stamp-img { height: 80px; margin: 0 auto; opacity: 0.9; display: block; }
        .sign-line { border-top: 1.5pt solid #333; width: 170px; margin: 0 auto; padding-top: 4px; font-weight: bold; font-size: 10pt; color: #333; }
        
        .qr-area { position: absolute; top: 25px; right: 40px; text-align: center; z-index: 10; }
        .qr-area img { width: 60px !important; height: 60px !important; border: 1pt solid #ddd; padding: 2px; background: #fff; }
    </style>
</head>
<body>
    <div class="border">
        <div class="inner-border">
            <div class="cert-no">NO: {{ $certificate->certificate_number }}</div>
            
            <div class="header">
                @php
                    $finalLogo = $siteSettings['certificate_logo'] ?? $siteSettings['logo'] ?? null;
                @endphp
                @if($finalLogo)
                    <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('storage/' . $finalLogo))) }}" class="logo-img">
                @endif
                <div class="ngo-name">{{ $siteSettings['site_name'] ?? 'Smart NGO' }}</div>
                <div class="tagline">{{ $siteSettings['certificate_tagline'] ?? 'Empowering Lives, Building Futures' }}</div>
            </div>
            
            <div class="title">Certificate of {{ ucfirst($certificate->type) }}</div>
            <div class="subtitle">This is proudly presented to</div>
            
            <div class="recipient">{{ $certificate->recipient_name }}</div>
            
            <div class="reason">
                {{ strtolower($certificate->metadata['description'] ?? '') ?: 'In recognition of outstanding dedication and service towards our mission and community development goals.' }}
            </div>
            
            <div class="footer">
                <table class="signature-table" border="0">
                    <tr>
                        <td>
                            <div class="sign-area">
                                @if(isset($siteSettings['certificate_signature']))
                                    <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('storage/' . $siteSettings['certificate_signature']))) }}" class="signature-img">
                                @else
                                    <div style="height: 45px;"></div>
                                @endif
                                <div class="sign-line">{{ $siteSettings['cert_sign_title_1'] ?? 'President' }}</div>
                            </div>
                        </td>
                        <td>
                            <div class="sign-area">
                                @if(isset($siteSettings['certificate_stamp']))
                                    <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('storage/' . $siteSettings['certificate_stamp']))) }}" class="stamp-img">
                                @else
                                    <div style="height: 45px;"></div>
                                @endif
                                <div class="sign-line">{{ $siteSettings['cert_sign_title_2'] ?? 'Secretary' }}</div>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
            
            <div class="qr-area">
                <img src="data:image/svg+xml;base64,{{ base64_encode($qrCode) }}" alt="QR">
                <div style="font-size:7pt; margin-top:3px; font-weight:bold; color:#666;">VERIFY</div>
            </div>
        </div>
    </div>
</body>
</html>
