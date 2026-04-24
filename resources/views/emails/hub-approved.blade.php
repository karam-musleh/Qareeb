{{-- <!DOCTYPE html>
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
            padding: 52px 32px 48px;
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
            width: 88px;
            height: 88px;
            background: rgba(255, 255, 255, 0.18);
            border: 2.5px solid rgba(255, 255, 255, 0.35);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 22px;
            font-size: 40px;
            position: relative;
            z-index: 1;
        }

        .hero h1 {
            color: #fff;
            font-size: 26px;
            font-weight: 700;
            margin-bottom: 10px;
            position: relative;
            z-index: 1;
        }

        .hero-sub {
            color: #e9d5ff;
            font-size: 14px;
            position: relative;
            z-index: 1;
        }

        .content-card {
            background: #fff;
            padding: 40px 36px;
            border-right: 5px solid var(--purple-500);
        }

        .greeting {
            font-size: 15px;
            color: #374151;
            line-height: 2;
            margin-bottom: 28px;
        }

        .greeting strong {
            color: var(--purple-700);
            font-weight: 600;
        }

        .hub-badge {
            background: linear-gradient(135deg, #faf5ff, #f5f3ff);
            border: 1.5px solid #d8b4fe;
            border-radius: 14px;
            padding: 20px 22px;
            margin: 24px 0;
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .hub-icon-wrap {
            width: 52px;
            height: 52px;
            background: linear-gradient(135deg, var(--purple-500), var(--violet-600));
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            flex-shrink: 0;
            box-shadow: 0 4px 12px rgba(168, 85, 247, 0.3);
        }

        .hub-label {
            font-size: 10px;
            color: var(--purple-600);
            font-weight: 700;
            letter-spacing: 0.8px;
            text-transform: uppercase;
            margin-bottom: 4px;
        }

        .hub-name {
            font-size: 18px;
            font-weight: 700;
            color: var(--purple-700);
        }

        .status-pill {
            background: linear-gradient(135deg, var(--purple-500), var(--violet-500));
            color: #fff;
            font-size: 11px;
            font-weight: 600;
            padding: 5px 12px;
            border-radius: 20px;
            white-space: nowrap;
        }

        .body-text {
            font-size: 14px;
            color: #374151;
            line-height: 1.9;
            margin: 16px 0;
        }

        .body-text strong {
            color: var(--purple-700);
        }

        .divider {
            height: 1px;
            background: linear-gradient(to left, transparent, #e9d5ff, transparent);
            margin: 28px 0;
        }

        .section-heading {
            font-size: 14px;
            font-weight: 600;
            color: #374151;
            margin-bottom: 14px;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 12px;
            margin-bottom: 32px;
        }

        .feature-card {
            background: #f9fafb;
            border: 1px solid #ede9fe;
            border-radius: 12px;
            padding: 16px 10px;
            text-align: center;
        }

        .feature-emoji {
            font-size: 26px;
            margin-bottom: 8px;
        }

        .feature-text {
            font-size: 12px;
            color: #4b5563;
            font-weight: 500;
            line-height: 1.5;
        }

        .cta-wrap {
            text-align: center;
            margin: 8px 0 28px;
        }

        .cta-btn {
            display: inline-block;
            background: linear-gradient(135deg, var(--purple-600), var(--violet-500));
            color: #fff;
            text-decoration: none;
            padding: 14px 44px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 15px;
            font-family: inherit;
            box-shadow: 0 6px 20px rgba(168, 85, 247, 0.38);
        }

        .closing {
            font-size: 14px;
            color: #4b5563;
            line-height: 2;
            padding-top: 20px;
            border-top: 1px solid #f3f4f6;
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
                padding: 28px 18px;
            }

            .features-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .hub-badge {
                flex-direction: column;
                text-align: center;
            }
        }
    </style>
</head>

<body>
    <div class="email-wrapper">

        <div class="brand-bar">
            <div>
                <div class="brand-logo-text">قريب <span>|</span> Qareeb</div>
                <div class="brand-sub">ربط المجتمعات بالمساحات الأساسية</div>
            </div>
            <div style="font-size:28px; opacity:0.85;">🏢</div>
        </div>

        <div class="hero">
            <div class="hero-icon">✅</div>
            <h1>تم قبول مساحة عملك بنجاح!</h1>
            <p class="hero-sub">مرحباً بك في مجتمع قريب 🎉</p>
        </div>

        <div class="content-card">
            <p class="greeting">
                السلام عليكم ورحمة الله وبركاته،<br><br>
                السيد/السيدة <strong>{{ $ownerName }}</strong>،<br>
                يسعدنا الترحيب بك في منصة قريب ونبارك لك هذه الخطوة!
            </p>

            <div class="hub-badge">
                <div class="hub-icon-wrap">
                    <img src="{{ asset('Images/Gemini_Generated_Image_rj71u5rj71u5rj71.png') }}" alt="logo"
                        style="width: 32px; height: 32px; object-fit: contain; filter: brightness(0) invert(1);">

                </div>
                <div style="flex:1; min-width:0;">
                    <div class="hub-label">مركزك المعتمد</div>
                    <div class="hub-name">{{ $hubName }}</div>
                </div>
                <div class="status-pill">✓ مقبول</div>
            </div>

            <p class="body-text">
                يسعدنا إخبارك بأن طلبك لإضافة مركز <strong>{{ $hubName }}</strong> قد تمّت مراجعته والموافقة عليه
                من فريق قريب.
            </p>

            <div class="divider"></div>

            <p class="section-heading">🚀 ما يمكنك فعله الآن:</p>

            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-emoji">🏷️</div>
                    <div class="feature-text">إضافة العروض والخدمات</div>
                </div>
                <div class="feature-card">
                    <div class="feature-emoji">📊</div>
                    <div class="feature-text">متابعة أداء مركزك</div>
                </div>


                <div class="cta-wrap">
                    <a href="{{ $dashboardUrl ?? '#' }}" class="cta-btn">ابدأ إدارة مركزك ←</a>
                </div>

                <div class="divider"></div>

                <p class="closing">
                    إذا كان لديك أي استفسار تواصل معنا مباشرة وسيكون فريقنا سعيداً بمساعدتك.<br><br>
                    شكراً لك على انضمامك إلى قريب! 🙏
                </p>
            </div>

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

</html> --}}
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
            padding: 52px 32px 48px;
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
            width: 88px;
            height: 88px;
            background: rgba(255, 255, 255, 0.18);
            border: 2.5px solid rgba(255, 255, 255, 0.35);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 22px;
            font-size: 40px;
            position: relative;
            z-index: 1;
        }

        .hero h1 {
            color: #fff;
            font-size: 26px;
            font-weight: 700;
            margin-bottom: 10px;
            position: relative;
            z-index: 1;
        }

        .hero-sub {
            color: #e9d5ff;
            font-size: 14px;
            position: relative;
            z-index: 1;
        }

        .content-card {
            background: #fff;
            padding: 40px 36px;
            border-right: 5px solid var(--purple-500);
        }

        .greeting {
            font-size: 15px;
            color: #374151;
            line-height: 2;
            margin-bottom: 28px;
        }

        .greeting strong {
            color: var(--purple-700);
            font-weight: 600;
        }

        .hub-badge {
            background: linear-gradient(135deg, #faf5ff, #f5f3ff);
            border: 1.5px solid #d8b4fe;
            border-radius: 14px;
            padding: 20px 22px;
            margin: 24px 0;
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .hub-icon-wrap {
            width: 52px;
            height: 52px;
            background: linear-gradient(135deg, var(--purple-500), var(--violet-600));
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            flex-shrink: 0;
            box-shadow: 0 4px 12px rgba(168, 85, 247, 0.3);
        }

        .hub-label {
            font-size: 10px;
            color: var(--purple-600);
            font-weight: 700;
            letter-spacing: 0.8px;
            text-transform: uppercase;
            margin-bottom: 4px;
        }

        .hub-name {
            font-size: 18px;
            font-weight: 700;
            color: var(--purple-700);
        }

        .status-pill {
            background: linear-gradient(135deg, var(--purple-500), var(--violet-500));
            color: #fff;
            font-size: 11px;
            font-weight: 600;
            padding: 5px 12px;
            border-radius: 20px;
            white-space: nowrap;
        }

        .body-text {
            font-size: 14px;
            color: #374151;
            line-height: 1.9;
            margin: 16px 0;
        }

        .body-text strong {
            color: var(--purple-700);
        }

        .divider {
            height: 1px;
            background: linear-gradient(to left, transparent, #e9d5ff, transparent);
            margin: 28px 0;
        }

        .section-heading {
            font-size: 14px;
            font-weight: 600;
            color: #374151;
            margin-bottom: 14px;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 12px;
            margin-bottom: 32px;
        }

        .feature-card {
            background: #f9fafb;
            border: 1px solid #ede9fe;
            border-radius: 12px;
            padding: 16px 10px;
            text-align: center;
        }

        .feature-emoji {
            font-size: 26px;
            margin-bottom: 8px;
        }

        .feature-text {
            font-size: 12px;
            color: #4b5563;
            font-weight: 500;
            line-height: 1.5;
        }

        .cta-wrap {
            text-align: center;
            margin: 8px 0 28px;
        }

        .cta-btn {
            display: inline-block;
            background: linear-gradient(135deg, var(--purple-600), var(--violet-500));
            color: #fff;
            text-decoration: none;
            padding: 14px 44px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 15px;
            font-family: inherit;
            box-shadow: 0 6px 20px rgba(168, 85, 247, 0.38);
        }

        .closing {
            font-size: 14px;
            color: #4b5563;
            line-height: 2;
            padding-top: 20px;
            border-top: 1px solid #f3f4f6;
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
                padding: 28px 18px;
            }

            .features-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .hub-badge {
                flex-direction: column;
                text-align: center;
            }
        }
    </style>
</head>

<body>
    <div class="email-wrapper">

        <div class="brand-bar">
            <div>
                <div class="brand-logo-text">قريب <span>|</span> Qareeb</div>
                <div class="brand-sub">ربط المجتمعات بالمساحات الأساسية</div>
            </div>
            <div style="font-size:28px; opacity:0.85;">🏢</div>
        </div>

        <div class="hero">
            <div class="hero-icon">✅</div>
            <h1>تم قبول مساحة عملك بنجاح!</h1>
            <p class="hero-sub">مرحباً بك في مجتمع قريب 🎉</p>
        </div>

        <div class="content-card">
            <p class="greeting">
                السلام عليكم ورحمة الله وبركاته،<br><br>
                السيد/السيدة <strong>{{ $ownerName }}</strong>،<br>
                يسعدنا الترحيب بك في منصة قريب ونبارك لك هذه الخطوة!
            </p>

            <div class="hub-badge">
                <div class="hub-icon-wrap">
                    <img src="{{ asset('Images/Gemini_Generated_Image_rj71u5rj71u5rj71.png') }}" alt="logo"
                        style="width: 32px; height: 32px; object-fit: contain; filter: brightness(0) invert(1);">

                </div>
                <div style="flex:1; min-width:0;">
                    <div class="hub-label">مركزك المعتمد</div>
                    <div class="hub-name">{{ $hubName }}</div>
                </div>
                <div class="status-pill">✓ مقبول</div>
            </div>

            <p class="body-text">
                يسعدنا إخبارك بأن طلبك لإضافة مركز <strong>{{ $hubName }}</strong> قد تمّت مراجعته والموافقة عليه
                من فريق قريب.
            </p>

            <div class="divider"></div>

            <p class="section-heading">🚀 ما يمكنك فعله الآن:</p>

            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-emoji">🏷️</div>
                    <div class="feature-text">إضافة العروض والخدمات</div>
                </div>
                <div class="feature-card">
                    <div class="feature-emoji">📊</div>
                    <div class="feature-text">متابعة أداء مركزك</div>
                </div>


                <div class="cta-wrap">
                    <a href="{{ $dashboardUrl ?? '#' }}" class="cta-btn">ابدأ إدارة مركزك ←</a>
                </div>

                <div class="divider"></div>

                <p class="closing">
                    إذا كان لديك أي استفسار تواصل معنا مباشرة وسيكون فريقنا سعيداً بمساعدتك.<br><br>
                    شكراً لك على انضمامك إلى قريب! 🙏
                </p>
            </div>

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
