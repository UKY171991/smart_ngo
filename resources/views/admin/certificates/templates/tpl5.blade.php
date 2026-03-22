<!DOCTYPE html>
<html>
<head>
    <style>
        @page { size: A4 landscape; margin: 0; }
        body { font-family: 'Times New Roman', Times, serif; background: #fff; margin: 0; padding: 20px; color: #1a1a1a; }
        .main-frame { border: 12px double {{ $siteSettings['certificate_border_color'] ?? '#cc0000' }}; height: 535px; padding: 10px; box-sizing: border-box; background: #fff; position: relative; }
        .inner-canvas { border: 1pt solid {{ $siteSettings['certificate_border_color'] ?? '#cc0000' }}; height: 475px; padding: 25px 35px; box-sizing: border-box; text-align: center; }
        .cert-no { font-size: 8pt; color: #aaa; margin-bottom: 2px; text-align: left; }
        
        .header { margin-bottom: 8px; }
        .logo-img { height: 45px; margin-bottom: 3px; }
        .ngo-name { font-size: 18pt; font-weight: bold; color: {{ $siteSettings['certificate_border_color'] ?? '#cc0000' }}; margin: 0; text-transform: uppercase; letter-spacing: 1.5px; }
        .tagline { font-size: 8pt; color: #666; font-style: italic; margin-top: 1px; }
        
        .title { font-size: 20pt; font-style: italic; color: #caa85b; margin: 10px 0 5px; font-weight: normal; }
        .subtitle { font-size: 10pt; margin-bottom: 10px; color: #333; text-transform: uppercase; letter-spacing: 1.5px; }
        
        .recipient { font-size: 24pt; font-weight: bold; color: #000; border-bottom: 2pt solid #caa85b; display: inline-block; padding: 0 40px 1px; margin-bottom: 10px; }
        
        .reason { font-size: 11pt; line-height: 1.4; max-width: 85%; margin: 5px auto 10px; color: #444; min-height: 40px; }
        
        .footer { width: 95%; margin: 5px auto 0; }
        .signature-table { width: 100%; }
        .signature-table td { vertical-align: bottom; text-align: center; width: 50%; }
        .signature-img { height: 45px; margin-bottom: -10px; display: block; margin: 0 auto; position: relative; z-index: 2; }
        .stamp-img { height: 85px; margin: 0 auto; opacity: 1; display: block; }
        .sign-line { border-top: 1.5pt solid #1a1a1a; width: 180px; margin: 0 auto; padding-top: 5px; font-weight: bold; font-size: 11pt; color: #1a1a1a; }
        
        .qr-area { position: absolute; top: 30px; right: 45px; text-align: center; z-index: 10; }
        .qr-area img { width: 60px !important; height: 60px !important; border: 1pt solid #ddd; padding: 2px; background: #fff; }
    </style>
</head>
<body>
    <div class="main-frame">
        <div class="inner-canvas">
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
            
            <div class="title">Letter of Commendation</div>
            <div class="subtitle">Awarded unto</div>
            
            <div class="recipient">{{ $certificate->recipient_name }}</div>
            
            <div class="reason">
                {{ strtolower($certificate->metadata['description'] ?? '') ?: 'In recognition of superlative achievement and meritorious service rendered during the current tenure of association with our institution.' }}
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
