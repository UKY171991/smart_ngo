<!DOCTYPE html>
<html>
<head>
    <style>
        @page { size: A4 landscape; margin: 0; }
        body { font-family: 'Georgia', serif; background: #fdfdfd; margin: 0; padding: 25px; color: #1a1a1a; }
        .frame { border: 15px solid {{ $siteSettings['certificate_border_color'] ?? '#333' }}; height: 535px; padding: 15px; box-sizing: border-box; background: #fff; position: relative; }
        .inner-frame { border: 2pt solid #caa85b; height: 475px; padding: 20px 30px; box-sizing: border-box; text-align: center; }
        .cert-no { font-size: 8pt; color: #999; margin-bottom: 2px; text-align: left; }
        
        .header { margin-bottom: 15px; text-align: center; border-bottom: 1.5pt solid #eee; padding-bottom: 10px; }
        .logo-img { height: 55px; margin-bottom: 5px; }
        .ngo-name { font-size: 20pt; font-weight: bold; color: {{ $siteSettings['certificate_border_color'] ?? '#333' }}; margin: 0; }
        .tagline { font-size: 9pt; color: #555; text-transform: uppercase; letter-spacing: 2px; margin-top: 3px; }
        
        .title { font-size: 22pt; font-style: italic; color: #caa85b; margin: 15px 0 5px; }
        .subtitle { font-size: 11pt; margin-bottom: 15px; color: #333; text-transform: uppercase; font-weight: bold; }
        
        .recipient { font-size: 26pt; font-weight: 900; color: #000; display: inline-block; border-bottom: 4pt double #caa85b; padding: 0 50px 3px; margin-bottom: 15px; }
        
        .reason { font-size: 12pt; line-height: 1.5; max-width: 85%; margin: 5px auto 15px; color: #444; min-height: 50px; font-style: italic; font-family: 'Times New Roman', serif; }
        
        .footer { width: 90%; margin: 10px auto 0; }
        .signature-table { width: 100%; }
        .signature-table td { vertical-align: bottom; text-align: center; width: 50%; }
        .signature-img { height: 50px; margin-bottom: -15px; display: block; margin: 0 auto; position: relative; z-index: 2; }
        .stamp-img { height: 90px; margin: 0 auto; opacity: 1; display: block; }
        .sign-line { border-top: 2pt solid #000; width: 190px; margin: 0 auto; padding-top: 5px; font-weight: bold; font-size: 12pt; color: #000; }
        
        .qr-area { position: absolute; top: 35px; right: 45px; text-align: center; }
        .qr-area img { width: 65px !important; height: 65px !important; border: 1pt solid {{ $siteSettings['certificate_border_color'] ?? '#333' }}; padding: 3px; background: #fff; }
    </style>
</head>
<body>
    <div class="frame">
        <div class="inner-frame">
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
                                    <div style="height: 50px;"></div>
                                @endif
                                <div class="sign-line">{{ $siteSettings['cert_sign_title_1'] ?? 'President' }}</div>
                            </div>
                        </td>
                        <td>
                            <div class="sign-area">
                                @if(isset($siteSettings['certificate_stamp']))
                                    <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('storage/' . $siteSettings['certificate_stamp']))) }}" class="stamp-img">
                                @else
                                    <div style="height: 50px;"></div>
                                @endif
                                <div class="sign-line">{{ $siteSettings['cert_sign_title_2'] ?? 'Secretary' }}</div>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
            
            <div class="qr-area">
                <img src="data:image/svg+xml;base64,{{ base64_encode($qrCode) }}" alt="QR">
                <div style="font-size:8pt; margin-top:5px; font-weight:bold; color:#666;">VERIFY</div>
            </div>
        </div>
    </div>
</body>
</html>
