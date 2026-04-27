<!DOCTYPE html>
<html dir="rtl" lang="ar">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Arabic:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <style>
        :root {
            --purple-500: #a855f7;
            --purple-600: #9333ea;
            --purple-700: #7e22ce;
            --violet-500: #8b5cf6;
            --violet-600: #7c3aed;
            --indigo-500: #6366f1;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

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
            box-shadow: 0 20px 60px rgba(139, 92, 246, 0.15), 0 4px 16px rgba(0, 0, 0, 0.08);
        }

        .brand-bar {
            background: linear-gradient(135deg, var(--purple-700), var(--violet-600), var(--indigo-500));
            padding: 18px 32px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .brand-logo-text {
            color: #fff;
            font-size: 20px;
            font-weight: 700;
        }

        .brand-logo-text span {
            color: #d8b4fe;
            font-weight: 300;
        }

        .brand-sub {
            color: #c4b5fd;
            font-size: 11px;
            margin-top: 2px;
        }

        .hero {
            background: linear-gradient(135deg, var(--purple-500) 0%, var(--violet-500) 55%, var(--indigo-500) 100%);
            padding: 44px 32px 40px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: -60px;
            right: -60px;
            width: 240px;
            height: 240px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.06);
        }

        .hero-icon {
            width: 80px;
            height: 80px;
            background: rgba(255, 255, 255, 0.18);
            border: 2.5px solid rgba(255, 255, 255, 0.35);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 18px;
            font-size: 36px;
            position: relative;
            z-index: 1;
        }

        .hero h1 {
            color: #fff;
            font-size: 22px;
            font-weight: 700;
            position: relative;
            z-index: 1;
        }

        .hero-sub {
            color: #e9d5ff;
            font-size: 13px;
            margin-top: 8px;
            position: relative;
            z-index: 1;
        }

        .content-card {
            background: #fff;
            padding: 36px;
            border-right: 5px solid var(--purple-500);
        }

        .field {
            margin: 18px 0;
        }

        .label {
            font-size: 11px;
            font-weight: 700;
            color: var(--purple-600);
            letter-spacing: 0.8px;
            text-transform: uppercase;
            margin-bottom: 6px;
        }

        .value {
            font-size: 14px;
            color: #374151;
        }

        .message-box {
            background: linear-gradient(135deg, #faf5ff, #f5f3ff);
            border: 1.5px solid #d8b4fe;
            border-radius: 12px;
            padding: 16px;
            font-size: 14px;
            color: #374151;
            line-height: 1.8;
        }

        .divider {
            height: 1px;
            background: linear-gradient(to left, transparent, #e9d5ff, transparent);
            margin: 24px 0;
        }

        .footer {
            background: #f9fafb;
            border-top: 1px solid #ede9fe;
            padding: 24px 32px;
            text-align: center;
        }

        .footer-links {
            display: flex;
            justify-content: center;
            gap: 22px;
            flex-wrap: wrap;
            margin-bottom: 14px;
        }

        .footer-link {
            color: var(--purple-600);
            text-decoration: none;
            font-size: 12px;
            font-weight: 500;
        }

        .footer-copy {
            color: #9ca3af;
            font-size: 11px;
            line-height: 1.8;
        }

        .footer-copy strong {
            color: var(--purple-700);
        }

        @media (max-width: 480px) {
            .content-card {
                padding: 24px 18px;
            }
        }
    </style>
</head>

<body>
    <div class="email-wrapper">

        {{-- Brand Bar --}}
        <div class="brand-bar">
            <div>
                <div class="brand-logo-text">قريب <span>|</span> Qareeb</div>
                <div class="brand-sub">ربط المجتمعات بالمساحات الأساسية</div>
            </div>
            <img src="{{ asset('Images/Gemini_Generated_Image_rj71u5rj71u5rj71.png') }}" alt="logo"
                style="width:40px; height:40px; object-fit:contain; filter:brightness(0) invert(1); opacity:0.85;">
        </div>

        {{-- Hero --}}
        <div class="hero">
            <div class="hero-icon">✉️</div>
            <h1>رسالة تواصل جديدة</h1>
            <p class="hero-sub">وصلتك رسالة عبر نموذج التواصل</p>
        </div>

        {{-- Content --}}
        <div class="content-card">

            <div class="field">
                <div class="label">الاسم</div>
                <div class="value">{{ $contactData['name'] }}</div>
            </div>

            <div class="divider"></div>

            <div class="field">
                <div class="label">البريد الإلكتروني</div>
                <div class="value">{{ $contactData['email'] }}</div>
            </div>

            <div class="divider"></div>

            <div class="field">
                <div class="label">الموضوع</div>
                <div class="value">{{ $contactData['subject'] ?? 'غير محدد' }}</div>
            </div>

            <div class="divider"></div>

            <div class="field">
                <div class="label">الرسالة</div>
                <div class="message-box">{{ $contactData['message'] }}</div>
            </div>

        </div>

        {{-- Footer --}}
        <div class="footer">
            <div class="footer-links">
                <a href="#" class="footer-link">الرئيسية</a>
                <a href="#" class="footer-link">تواصل معنا</a>
                <a href="#" class="footer-link">سياسة الخصوصية</a>
            </div>
            <p class="footer-copy">
                © 2026 <strong>قريب | Qareeb</strong> — جميع الحقوق محفوظة<br>
                صُنع لأجل غزة ❤️
            </p>
        </div>

    </div>
</body>

</html>
