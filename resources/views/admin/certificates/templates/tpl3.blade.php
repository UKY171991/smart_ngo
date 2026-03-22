<!DOCTYPE html>
<html>
<head>
    <style>
        @page { size: A4 landscape; margin: 0; }
        body { font-family: 'Helvetica', 'Arial', sans-serif; background: #fff; margin: 0; padding: 25px; color: #1a1a1a; }
        .outer-wrapper { border: 15px solid {{ $siteSettings['certificate_border_color'] ?? '#0D6EFD' }}; height: 535px; padding: 5px; box-sizing: border-box; background: #fff; position: relative; }
        .inner-content { border: 2pt solid #caa85b; height: 495px; padding: 25px 35px; box-sizing: border-box; text-align: center; }
        .cert-no { font-size: 8pt; color: #999; margin-bottom: 2px; text-align: left; }
        
        .header { margin-bottom: 8px; }
        .logo-img { height: 50px; margin-bottom: 2px; }
        .ngo-name { font-size: 18pt; font-weight: 800; color: #111; margin: 0; text-transform: uppercase; }
        .tagline { font-size: 8pt; color: {{ $siteSettings['certificate_border_color'] ?? '#0D6EFD' }}; font-weight: bold; margin-top: 1px; text-transform: uppercase; letter-spacing: 1.5px; }
        
        .title { font-size: 20pt; font-weight: 300; color: #caa85b; margin: 10px 0 5px; font-family: 'Times New Roman', serif; text-transform: uppercase; letter-spacing: 2px; }
        .subtitle { font-size: 10pt; margin-bottom: 12px; color: #666; font-style: italic; }
        
        .recipient { font-size: 26pt; font-weight: 900; color: #000; border-bottom: 3pt solid #caa85b; display: inline-block; padding: 0 40px 1px; margin-bottom: 12px; }
        
        .reason { font-size: 11pt; line-height: 1.4; max-width: 85%; margin: 5px auto 10px; color: #444; min-height: 45px; font-weight: 300; }
        
        .footer { width: 95%; margin: 5px auto 0; }
        .signature-table { width: 100%; }
        .signature-table td { vertical-align: bottom; text-align: center; width: 50%; }
        .signature-img { height: 45px; margin-bottom: -10px; display: block; margin: 0 auto; position: relative; z-index: 2; }
        .stamp-img { height: 85px; margin: 0 auto; opacity: 1; display: block; }
        .sign-line { border-top: 2pt solid {{ $siteSettings['certificate_border_color'] ?? '#0D6EFD' }}; width: 170px; margin: 0 auto; padding-top: 5px; font-weight: bold; font-size: 10pt; color: #1a1a1a; text-transform: uppercase; }
        
        .qr-area { position: absolute; top: 30px; right: 40px; text-align: center; z-index: 10; }
        .qr-area img { width: 60px !important; height: 60px !important; border: 1pt solid #ddd; padding: 2px; background: #fff; }
    </style>
</head>
<body>
    <div class="outer-wrapper">
        <div class="inner-content">
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
            
            <div class="title">Certificate of Merit</div>
            <div class="subtitle">This certificate is proudly awarded to</div>
            
            <div class="recipient">{{ $certificate->recipient_name }}</div>
            
            <div class="reason">
                {{ strtolower($certificate->metadata['description'] ?? '') ?: 'In appreciation for your tireless commitment, remarkable energy, and high level of professionalism in serving the community through our various initiatives.' }}
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
