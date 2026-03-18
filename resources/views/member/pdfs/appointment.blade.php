<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: 'Times New Roman', serif; background: #fff; margin: 40px; color: #333; line-height: 1.6; }
        .letter-header { border-bottom: 2pt solid #cc0000; padding-bottom: 20px; margin-bottom: 40px; display: flex; align-items: center; }
        .ngo-name { font-size: 20pt; font-weight: bold; color: #cc0000; margin-bottom: 5px; }
        .ngo-details { font-size: 9pt; color: #666; font-family: 'Helvetica', sans-serif; }
        .letter-date { margin-bottom: 40px; font-weight: bold; }
        .recipient-address { margin-bottom: 40px; }
        .subject { font-weight: bold; text-decoration: underline; margin-bottom: 40px; text-align: center; font-size: 14pt; }
        .letter-body { text-align: justify; margin-bottom: 50px; }
        .qr-section { margin-top: 50px; border-top: 1pt solid #eee; padding-top: 20px; display: flex; justify-content: space-between; align-items: center; }
        .qr-code { padding: 10px; border: 1px solid #eee; border-radius: 8px; }
        .signature-area { display: flex; justify-content: space-between; margin-top: 80px; }
        .signature-box { border-top: 0px solid #333; width: 150px; text-align: center; padding-top: 10px; font-size: 9pt; }
        .footer { position: absolute; bottom: 40px; width: 100%; font-size: 8pt; text-align: center; color: #999; }
    </style>
</head>
<body>
    <div class="letter-header">
        <div>
            <div class="ngo-name">SAMRAT FOUNDATION TRUST</div>
            <div class="ngo-details">Reg No: SFT/IN/2026/001 | Registered Charity</div>
            <div class="ngo-details">Sector 12, New Delhi - 110001 | Phone: +91 98765 43210</div>
        </div>
    </div>
    
    <div class="letter-date">Date: {{ date('d F, Y') }}</div>
    
    <div class="recipient-address">
        <strong>To,</strong><br>
        <strong>{{ $user->name }}</strong><br>
        <strong>Email:</strong> {{ $user->email }}<br>
        <strong>Phone:</strong> {{ $user->phone }}
    </div>
    
    <div class="subject">Sub: Appointment as {{ $user->designation->title ?? 'Member' }}</div>
    
    <div class="letter-body">
        <p>Dear {{ $user->name }},</p>
        
        <p>We are delighted to inform you that you have been formally appointed as a <strong>{{ $user->designation->title ?? 'General Member' }}</strong> of <strong>SAMRAT FOUNDATION TRUST</strong>, effective from <strong>{{ $user->created_at->format('d M, Y') }}</strong>.</p>
        
        <p>At Samrat Foundation, our mission is to drive sustainable change through education, health, and community empowerment. Your decision to join us reflects your commitment to these values, and we are confident that your contribution will be instrumental in achieving our collective goals.</p>
        
        <p>As a member, you are expected to adhere to the code of conduct and ethics of the organization. Your roles and responsibilities will be guided by the board, and you will have access to our member dashboard to track your engagement and impact.</p>
        
        <p>We welcome you to our growing community and look forward to working together for a better future.</p>
        
        <p>Sincerely,</p>
    </div>
    
    <div class="signature-area">
        <div class="signature-box" style="float: left;">
            <div style="margin-top: 30px; font-weight: bold; border-top: 1px solid #000; padding-top: 10px;">Executive Director</div>
            <div style="font-size: 8pt; color: #666;">Samrat Foundation Trust</div>
        </div>
    </div>
    
    <div class="qr-section">
        <table width="100%">
            <tr>
                <td width="20%">
                    <div class="qr-code">
                        {!! $qrCode !!}
                    </div>
                </td>
                <td width="80%" style="padding-left: 20px; font-family: 'Helvetica', sans-serif;">
                    <div style="font-size: 9pt; font-weight: bold; color: #cc0000; margin-bottom: 5px;">VERIFIED APPOINTMENT</div>
                    <div style="font-size: 8pt; color: #888;">This is a digitally verified appointment letter. Scan the QR code to verify the legal status of this membership on our official website.</div>
                </td>
            </tr>
        </table>
    </div>
    
    <div class="footer">
        Official Document Ref: APP/{{ date('Y') }}/{{ str_pad($user->id, 5, '0', STR_PAD_LEFT) }}
    </div>
</body>
</html>
