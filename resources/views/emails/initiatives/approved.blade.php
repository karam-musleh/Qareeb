<!DOCTYPE html>
<html dir="rtl" lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Arabic:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'IBM Plex Sans Arabic', sans-serif;
            background: linear-gradient(135deg, #faf5ff 0%, #f5f3ff 50%, #eef2ff 100%);
            direction: rtl;
            padding: 40px 16px;
            min-height: 100vh;
        }
        .email-wrapper {
            max-width: 600px;
            margin: 0 auto;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(139,92,246,0.15), 0 4px 16px rgba(0,0,0,0.08);
        }
    </style>
</head>
<body>
<div class="email-wrapper">

    {{-- Brand Bar --}}
    <div style="background: linear-gradient(135deg, #7e22ce, #7c3aed, #6366f1); padding: 18px 32px; display: flex; align-items: center; justify-content: space-between;">
        <div>
            <div style="color:#fff; font-size:20px; font-weight:700;">قريب <span style="color:#d8b4fe; font-weight:300;">|</span> Qareeb</div>
            <div style="color:#c4b5fd; font-size:11px; margin-top:2px;">ربط المجتمعات بالمساحات الأساسية</div>
        </div>
    </div>

    {{-- Hero --}}
    <div style="background: linear-gradient(135deg, #a855f7 0%, #8b5cf6 55%, #6366f1 100%); padding: 52px 32px 48px; text-align: center; position: relative; overflow: hidden;">
        <div style="position:absolute; top:-60px; right:-60px; width:240px; height:240px; border-radius:50%; background:rgba(255,255,255,0.06);"></div>
        <div style="width:88px; height:88px; background:rgba(255,255,255,0.18); border:2.5px solid rgba(255,255,255,0.35); border-radius:50%; display:flex; align-items:center; justify-content:center; margin:0 auto 22px; font-size:40px; position:relative; z-index:1;">✅</div>
        <h1 style="color:#fff; font-size:26px; font-weight:700; margin-bottom:10px; position:relative; z-index:1;">تمت الموافقة على مبادرتك!</h1>
        <p style="color:#e9d5ff; font-size:14px; position:relative; z-index:1;">مرحباً بك في مجتمع قريب 🎉</p>
    </div>

    {{-- Content --}}
    <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td width="5" style="background:#a855f7;"></td>
            <td style="background:#fff; padding:40px 36px;">

                <p style="font-size:15px; color:#374151; line-height:2; margin-bottom:28px;">
                    السلام عليكم ورحمة الله وبركاته،<br><br>
                    السيد/السيدة <strong style="color:#7e22ce; font-weight:600;">{{ $initiative->creator->name }}</strong>،<br>
                    يسعدنا إخبارك بأن مبادرتك قد تمت مراجعتها والموافقة عليها!
                </p>

                {{-- Initiative Badge --}}
                <div style="background:#faf5ff; border:1.5px solid #d8b4fe; border-radius:14px; padding:20px 22px; margin:24px 0; display:flex; align-items:center; gap:16px;">
                    <div style="width:52px; height:52px; background:linear-gradient(135deg,#a855f7,#7c3aed); border-radius:12px; display:flex; align-items:center; justify-content:center; flex-shrink:0; box-shadow:0 4px 12px rgba(168,85,247,0.3); font-size:26px;">
                        🌟
                    </div>
                    <div style="flex:1; min-width:0;">
                        <div style="font-size:10px; color:#9333ea; font-weight:700; letter-spacing:0.8px; margin-bottom:4px;">مبادرتك المعتمدة</div>
                        <div style="font-size:18px; font-weight:700; color:#7e22ce;">{{ $initiative->title }}</div>
                        <div style="font-size:12px; color:#9ca3af; margin-top:4px;">{{ $initiative->type->value }}</div>
                    </div>
                    <div style="background:linear-gradient(135deg,#a855f7,#8b5cf6); color:#fff; font-size:11px; font-weight:600; padding:5px 12px; border-radius:20px; white-space:nowrap;">✓ مقبولة</div>
                </div>

                <p style="font-size:14px; color:#374151; line-height:1.9; margin:16px 0;">
                    مبادرتك <strong style="color:#7e22ce;">{{ $initiative->title }}</strong>
                    أصبحت الآن ظاهرة للجميع على منصة قريب.
                </p>

                <div style="height:1px; background:#e9d5ff; margin:28px 0;"></div>

                {{-- CTA --}}
                <div style="text-align:center; margin:8px 0 28px;">
                    <a href="{{ config('app.frontend_url') }}/initiatives/{{ $initiative->slug }}"
                    style="display:inline-block; background:linear-gradient(135deg,#9333ea,#8b5cf6); color:#fff; text-decoration:none; padding:14px 44px; border-radius:12px; font-weight:600; font-size:15px; font-family:inherit; box-shadow:0 6px 20px rgba(168,85,247,0.38);">
                        عرض مبادرتك ←
                    </a>
                </div>

                <div style="height:1px; background:#e9d5ff; margin:28px 0;"></div>

                <p style="font-size:14px; color:#4b5563; line-height:2;">
                    إذا كان لديك أي استفسار تواصل معنا وسيكون فريقنا سعيداً بمساعدتك.<br><br>
                    شكراً لك على مساهمتك في مجتمع قريب! 🙏
                </p>

            </td>
        </tr>
    </table>

    {{-- Footer --}}
    <div style="background:#f9fafb; border-top:1px solid #ede9fe; padding:24px 32px; text-align:center;">
        <div style="display:flex; justify-content:center; gap:22px; flex-wrap:wrap; margin-bottom:14px;">
            <a href="{{ config('app.frontend_url') }}" style="color:#9333ea; text-decoration:none; font-size:12px; font-weight:500;">الرئيسية</a>
            <a href="{{ config('app.frontend_url') }}/contact" style="color:#9333ea; text-decoration:none; font-size:12px; font-weight:500;">تواصل معنا</a>
        </div>
        <p style="color:#9ca3af; font-size:11px; line-height:1.8;">
            © 2026 <strong style="color:#7e22ce;">قريب | Qareeb</strong> — جميع الحقوق محفوظة<br>
            صُنع لأجل غزة ❤️
        </p>
    </div>

</div>
</body>
</html>
