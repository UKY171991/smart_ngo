<!DOCTYPE html>
<html>
<head>
    <style>
        @page { margin: 0; }
        body { font-family: 'Helvetica', 'Arial', sans-serif; background: #fff; margin: 0; padding: 0; }
        .id-card {
            width: 240pt;
            height: 380pt;
            background: linear-gradient(135deg, #cc0000 0%, #880000 100%);
            color: #fff;
            position: relative;
            overflow: hidden;
            border: 2px solid #550000;
        }
        .header {
            text-align: center;
            padding: 20pt 10pt;
            background: rgba(0, 0, 0, 0.2);
        }
        .logo { font-size: 18pt; font-weight: bold; letter-spacing: 2pt; }
        .tagline { font-size: 8pt; opacity: 0.8; margin-top: 5pt; }
        .photo-area {
            margin-top: 20pt;
            text-align: center;
        }
        .photo {
            width: 100pt;
            height: 100pt;
            border-radius: 50%;
            border: 4pt solid #fff;
            background: #fff;
            object-fit: cover;
        }
        .info {
            text-align: center;
            margin-top: 15pt;
            padding: 0 10pt;
        }
        .name { font-size: 16pt; font-weight: bold; margin-bottom: 5pt; }
        .designation { 
            font-size: 10pt; 
            background: #fff; 
            color: #cc0000; 
            display: inline-block; 
            padding: 3pt 10pt; 
            border-radius: 15pt;
            font-weight: bold;
            margin-bottom: 15pt;
        }
        .details {
            font-size: 8pt;
            text-align: left;
            padding: 10pt;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10pt;
            margin: 0 15pt;
        }
        .detail-row { margin-bottom: 5pt; border-bottom: 1pt solid rgba(255, 255, 255, 0.1); padding-bottom: 2pt; }
        .qr-area {
            position: absolute;
            bottom: 20pt;
            right: 20pt;
            background: #fff;
            padding: 5pt;
            border-radius: 5pt;
        }
        .footer {
            position: absolute;
            bottom: 0;
            width: 100%;
            text-align: center;
            padding: 5pt 0;
            background: #000;
            font-size: 7pt;
            letter-spacing: 1pt;
        }
    </style>
</head>
<body>
    <div class="id-card">
        <div class="header">
            <div class="logo">SAMRAT FOUNDATION</div>
            <div class="tagline">Empowering Lives, Building Futures</div>
        </div>
        
        <div class="photo-area">
            <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&size=200&background=fff&color=cc0000&bold=true" class="photo">
        </div>
        
        <div class="info">
            <div class="name">{{ strtoupper($user->name) }}</div>
            <div class="designation">{{ strtoupper($user->designation->title ?? 'MEMBER') }}</div>
        </div>
        
        <div class="details">
            <div class="detail-row"><strong>ID:</strong> NGO-{{ str_pad($user->id, 5, '0', STR_PAD_LEFT) }}</div>
            <div class="detail-row"><strong>PHONE:</strong> {{ $user->phone }}</div>
            <div class="detail-row"><strong>JOINED:</strong> {{ $user->created_at->format('M Y') }}</div>
        </div>
        
        <div class="qr-area">
            {!! $qrCode !!}
        </div>
        
        <div class="footer">
            OFFICIAL IDENTITY CARD
        </div>
    </div>
</body>
</html>
