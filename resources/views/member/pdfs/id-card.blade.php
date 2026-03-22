<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
        @page { margin: 0; }
        body { 
            font-family: 'Helvetica', 'Arial', sans-serif; 
            background: #fff; 
            margin: 0; 
            padding: 0;
            color: #333;
        }
        .id-card {
            width: 242pt;
            height: 382pt;
            background: #ffffff;
            position: relative;
            overflow: hidden;
            border: 1pt solid #ddd;
            margin: 20pt auto;
        }
        .header {
            text-align: center;
            padding: 15pt 10pt;
            background-color: #0156b3; 
            color: #ffffff;
        }
        .logo { font-size: 18pt; font-weight: bold; letter-spacing: 1pt; }
        .tagline { font-size: 8pt; opacity: 0.9; margin-top: 5pt; }
        
        .photo-area {
            margin-top: 15pt;
            text-align: center;
        }
        .photo {
            width: 85pt;
            height: 85pt;
            border-radius: 50%;
            border: 3pt solid #0156b3;
            background: #eee;
        }
        
        .info {
            text-align: center;
            margin-top: 10pt;
            padding: 0 10pt;
        }
        .name { 
            font-size: 16pt; 
            font-weight: bold; 
            margin-bottom: 5pt; 
            color: #000;
        }
        .designation { 
            font-size: 10pt; 
            background: #0156b3; 
            color: #ffffff; 
            display: inline-block; 
            padding: 3pt 15pt; 
            border-radius: 20pt;
            font-weight: bold;
            margin-bottom: 15pt;
            text-transform: uppercase;
        }
        
        .details {
            font-size: 9pt;
            text-align: left;
            padding: 10pt;
            background: #f8f9fa;
            border-radius: 10pt;
            margin: 0 15pt;
            border: 1pt solid #eee;
        }
        .detail-row { 
            margin-bottom: 6pt; 
            border-bottom: 0.5pt solid #eee; 
            padding-bottom: 3pt; 
        }
        .detail-row:last-child { border-bottom: none; }
        .label { color: #666; font-weight: bold; width: 60pt; display: inline-block; }
        .value { color: #000; font-weight: bold; }
        
        .qr-area {
            position: absolute;
            bottom: 30pt;
            right: 20pt;
            background: #fff;
            padding: 4pt;
            border: 1pt solid #eee;
        }
        
        .footer {
            position: absolute;
            bottom: 0;
            width: 100%;
            text-align: center;
            padding: 8pt 0;
            background: #333;
            color: #ffffff;
            font-size: 8pt;
            font-weight: bold;
            letter-spacing: 1pt;
        }
        
        .accent {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5pt;
            background: #0d6efd;
        }
    </style>
</head>
<body>
    <div class="id-card">
        <div class="accent"></div>
        <div class="header">
            <div class="logo">{{ $siteSettings['site_name'] ?? 'Smart NGO' }}</div>
            <div class="tagline">{{ $siteSettings['site_tagline'] ?? 'Empowering Lives, Building Futures' }}</div>
        </div>
        
        <div class="photo-area">
            @php
                $avatarUrl = $user->avatar ? (filter_var($user->avatar, FILTER_VALIDATE_URL) ? $user->avatar : public_path('storage/' . $user->avatar)) : null;
                if ($user->avatar && !filter_var($user->avatar, FILTER_VALIDATE_URL) && !file_exists($avatarUrl)) {
                    $avatarUrl = null;
                }
            @endphp
            
            @if($avatarUrl && !filter_var($user->avatar, FILTER_VALIDATE_URL))
                <img src="data:image/png;base64,{{ base64_encode(file_get_contents($avatarUrl)) }}" class="photo">
            @else
                <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&size=200&background=0d6efd&color=fff&bold=true" class="photo">
            @endif
        </div>
        
        <div class="info">
            <div class="name">{{ strtoupper($user->name) }}</div>
            <div class="designation">{{ strtoupper($user->designation->title ?? 'MEMBER') }}</div>
        </div>
        
        <div class="details">
            <div class="detail-row"><span class="label">MEMBER ID:</span> <span class="value">NGO-{{ str_pad($user->id, 5, '0', STR_PAD_LEFT) }}</span></div>
            <div class="detail-row"><span class="label">PHONE:</span> <span class="value">{{ $user->phone ?? 'N/A' }}</span></div>
            <div class="detail-row"><span class="label">EMAIL:</span> <span class="value" style="font-size: 8pt;">{{ $user->email }}</span></div>
            <div class="detail-row"><span class="label">JOINED:</span> <span class="value">{{ $user->created_at->format('d M, Y') }}</span></div>
        </div>
        
        <div class="qr-area">
            {!! $qrCode !!}
        </div>
        
        <div class="footer">
            OFFICIAL MEMBER IDENTITY CARD
        </div>
    </div>
</body>
</html>
