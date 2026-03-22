<!DOCTYPE html>
<html>
<head>
    <style>
        @page { size: A4 landscape; margin: 0; }
        body { font-family: 'Times New Roman', serif; background: #fff8eb; margin: 0; padding: 0; color: #432; }
        .canvas { border: 20pt solid #432; height: 580px; width: 842px; padding: 40px; box-sizing: border-box; background: url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNDAiIGhlaWdodD0iNDAiIHZpZXdCb3g9IjAgMCA0MCA0MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48cGF0aCBkPSJNMjAgMDBMMjAgMjBNMCAyMEwyMCAyME0yMCAyME0yMCAyMEwwIDQwTTQwIDBMMjAgMjBNMjAgMjBMNDAgNDAiIHN0cm9rZT0iI2YyZTBjOCIgc3Ryb2tlLXdpZHRoPSIxIiBmaWxsPSJub25lIi8+PC9zdmc+'); position: relative; }
        .inner-canvas { border: 3pt solid #caa85b; height: 460px; padding: 30px 40px; box-sizing: border-box; text-align: center; background: rgba(255,248,235,0.9); }
        .cert-no { position: absolute; top: 15px; left: 15px; font-size: 8pt; color: #432; font-weight: bold; z-index: 100; }
        
        .header { margin-bottom: 5px; text-align: center; }
        .logo-img { height: 60px; margin-bottom: 5px; border-radius: 50%; border: 2pt solid #caa85b; padding: 3px; background: #fff; }
        .ngo-name { font-size: 20pt; font-weight: bold; color: #432; margin: 0; text-shadow: 0.5pt 0.5pt #fff; }
        .tagline { font-size: 8pt; color: #caa85b; font-weight: bold; text-transform: uppercase; letter-spacing: 2px; border-top: 1pt solid #caa85b; border-bottom: 1pt solid #caa85b; display: inline-block; padding: 3px 15px; margin-top: 2px; }
        
        .title { font-size: 22pt; font-family: 'Georgia', serif; font-style: italic; color: #caa85b; margin: 10px 0 5px; }
        .subtitle { font-size: 11pt; margin-bottom: 8px; color: #444; text-transform: uppercase; font-weight: normal; }
        
        .recipient { font-size: 24pt; font-weight: 900; color: #000; font-family: 'Times New Roman', serif; display: inline-block; border-bottom: 3pt double #caa85b; padding: 0 60px 2px; margin-bottom: 10px; }
        
        .reason { font-size: 12pt; line-height: 1.4; max-width: 85%; margin: 5px auto 10px; color: #333; min-height: 40px; font-style: italic; }
        
        .footer { width: 95%; margin: 20px auto 0; }
        .signature-table { width: 100%; }
        .signature-table td { vertical-align: bottom; text-align: center; width: 50%; }
        .signature-img { height: 60px; margin-bottom: -15px; display: block; margin: 0 auto; position: relative; z-index: 2; }
        .stamp-img { height: 100px; margin: 0 auto; opacity: 1; display: block; filter: contrast(1.2); }
        .sign-line { border-top: 2.5pt solid #432; width: 220px; margin: 0 auto; padding-top: 8px; font-weight: bold; font-size: 13pt; color: #432; }
        
        .qr-area { position: absolute; top: 25px; right: 55px; text-align: center; border: 1.5pt solid #caa85b; padding: 3px; background: #fff; }
        .qr-area img { width: 65px !important; height: 65px !important; }
    </style>
</head>
<body>
    <div class="canvas">
        <div class="cert-no">ORD: {{ $certificate->certificate_number }}</div>
        
        <div class="inner-canvas">
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
            
            <div class="title">Letter of Distinction</div>
            <div class="subtitle">Bestowed Upon</div>
            
            <div class="recipient">{{ $certificate->recipient_name }}</div>
            
            <div class="reason">
                {{ strtolower($certificate->metadata['description'] ?? '') ?: 'For demonstrating extraordinary proficiency, diligent effort, and significant accomplishment in all facets of your professional engagement with our institution.' }}
            </div>
            
            <div class="footer">
                <table class="signature-table" border="0">
                    <tr>
                        <td>
                            <div class="sign-area">
                                @if(isset($siteSettings['certificate_signature']))
                                    <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('storage/' . $siteSettings['certificate_signature']))) }}" class="signature-img">
                                @else
                                    <div style="height: 60px;"></div>
                                @endif
                                <div class="sign-line">{{ $siteSettings['cert_sign_title_1'] ?? 'President' }}</div>
                            </div>
                        </td>
                        <td>
                            <div class="sign-area">
                                @if(isset($siteSettings['certificate_stamp']))
                                    <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('storage/' . $siteSettings['certificate_stamp']))) }}" class="stamp-img">
                                @else
                                    <div style="height: 60px;"></div>
                                @endif
                                <div class="sign-line">{{ $siteSettings['cert_sign_title_2'] ?? 'Secretary' }}</div>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
            
            <div class="qr-area">
                <img src="data:image/svg+xml;base64,{{ base64_encode($qrCode) }}" alt="QR">
                <div style="font-size:8pt; margin-top:5px; font-weight:bold; color:#caa85b;">VERIFIED</div>
            </div>
        </div>
    </div>
</body>
</html>
