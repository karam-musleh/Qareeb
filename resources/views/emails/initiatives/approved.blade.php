<!DOCTYPE html>
<html dir="rtl" lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تمت الموافقة على مبادرتك! | قريب</title>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Arabic:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />
    <style>
        body {
            font-family: 'IBM Plex Sans Arabic', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #faf5ff 0%, #f5f3ff 50%, #eef2ff 100%);
            direction: rtl;
            padding: 40px 16px;
            margin: 0;
            min-height: 100vh;
            -webkit-font-smoothing: antialiased;
        }
        .email-wrapper {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(139,92,246,0.15), 0 4px 16px rgba(0,0,0,0.08);
            border: 1px solid #ffe9e6;
        }
        .cta-btn:hover {
            background-color: #9333ea !important;
            box-shadow: 0 8px 24px rgba(126, 34, 206, 0.35) !important;
        }
        @media only screen and (max-width: 480px) {
            .brand-bar-td {
                display: block !important;
                width: 100% !important;
                text-align: center !important;
                padding: 4px 0 !important;
            }
            .social-table, .social-table tr, .social-table td {
                display: block !important;
                width: 100% !important;
                text-align: center !important;
            }
            .social-cell {
                padding: 6px 0 !important;
            }
        }
    </style>
</head>
<body>
    <div class="email-wrapper">
        <!-- Brand Bar -->
        <table width="100%" cellpadding="0" cellspacing="0" style="background-color: #ffffff; padding: 18px 32px; border-bottom: 1px solid #ffe9e6;">
            <tr>
                <td class="brand-bar-td" align="right" valign="middle">
                    <div style="font-size: 20px; font-weight: 700; color: #7e22ce; font-family: 'IBM Plex Sans Arabic', sans-serif;">Qareeb | قريب</div>
                </td>
                <td class="brand-bar-td" align="left" valign="middle">
                    <div style="font-size: 12px; color: #5c403c; font-weight: 500; opacity: 0.8; font-family: 'IBM Plex Sans Arabic', sans-serif;">ربط المجتمعات بالمساحات الأساسية</div>
                </td>
            </tr>
        </table>

        <!-- Hero Section -->
        <div style="background: linear-gradient(135deg, #7e22ce 0%, #9333ea 100%); padding: 48px 32px; text-align: center; position: relative; overflow: hidden;">
            <!-- Dot Matrix Background -->
            <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; opacity: 0.15; background-image: radial-gradient(rgba(255,255,255,0.2) 1.5px, transparent 1.5px); background-size: 12px 12px;"></div>
            <!-- Hero Content -->
            <div style="position: relative; z-index: 2;">
                <div style="width: 80px; height: 80px; background-color: rgba(255,255,255,0.2); border: 1px solid rgba(255,255,255,0.3); border-radius: 50%; display: inline-block; line-height: 80px; font-size: 36px; box-shadow: 0px 4px 12px rgba(0,0,0,0.1); margin-bottom: 16px;">
                    ✅
                </div>
                <h1 style="color: #ffffff; font-size: 26px; font-weight: 700; margin: 0 0 8px 0; font-family: 'IBM Plex Sans Arabic', sans-serif;">تمت الموافقة على مبادرتك!</h1>
                <p style="color: rgba(255,255,255,0.95); font-size: 16px; margin: 0; font-family: 'IBM Plex Sans Arabic', sans-serif;">مرحباً بك في مجتمع قريب 🎉</p>
            </div>
        </div>

        <div style="padding: 40px 32px;">
            <!-- Greeting -->
            <p style="font-size: 18px; color: #281715; line-height: 1.8; margin: 0 0 24px 0;">
                السلام عليكم ورحمة الله وبركاته، السيد/السيدة <span style="font-weight: 700; color: #7e22ce;">{{ $initiative->creator->name }}</span>، يسعدنا الترحيب بك في منصة قريب ونبارك لك هذه الخطوة!
            </p>

            <!-- Initiative Badge Card -->
            <table width="100%" cellpadding="0" cellspacing="0" style="background-color: #fff0ee; border-right: 4px solid #7e22ce; border-radius: 12px; padding: 20px; margin: 24px 0;">
                <tr>
                    <td valign="middle" width="48">
                        <div style="width: 48px; height: 48px; background-color: #ffffff; border-radius: 8px; text-align: center; line-height: 48px;">
                            <span style="font-size: 26px; display: inline-block; vertical-align: middle;">🌟</span>
                        </div>
                    </td>
                    <td valign="middle" style="padding-right: 16px; text-align: right;">
                        <div style="font-size: 10px; color: #9333ea; font-weight: 700; letter-spacing: 0.8px; margin-bottom: 4px;">مبادرتك المعتمدة</div>
                        <h2 style="font-size: 18px; font-weight: 700; color: #281715; margin: 0;">{{ $initiative->title }}</h2>
                        <div style="font-size: 12px; color: #9ca3af; margin-top: 4px;">{{ $initiative->type->value }}</div>
                    </td>
                    <td valign="middle" align="left">
                        <div style="background-color: #d1fae5; color: #065f46; padding: 6px 14px; border-radius: 9999px; font-size: 13px; font-weight: 700; display: inline-block;">
                            <table cellpadding="0" cellspacing="0">
                                <tr>
                                    <td valign="middle">
                                        <span class="material-symbols-outlined" style="font-size: 16px; color: #065f46; display: block;">verified</span>
                                    </td>
                                    <td valign="middle" style="padding-right: 4px; font-family: 'IBM Plex Sans Arabic', sans-serif;">
                                        مقبولة
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </td>
                </tr>
            </table>

            <!-- Confirmation Text -->
            <p style="font-size: 16px; color: #5c403c; line-height: 1.6; margin: 0 0 32px 0;">
                مبادرتك <strong style="color: #7e22ce;">{{ $initiative->title }}</strong> أصبحت الآن ظاهرة للجميع على منصة قريب.
            </p>

            <!-- CTA -->
            <div style="text-align: center; margin: 32px 0 24px 0;">
                <a href="{{ config('app.frontend_url') }}/initiatives/{{ $initiative->slug }}" class="cta-btn" style="display: inline-block; background-color: #7e22ce; color: #ffffff; padding: 14px 44px; border-radius: 12px; font-weight: 700; font-size: 18px; text-decoration: none; box-shadow: 0 6px 20px rgba(126, 34, 206, 0.25); transition: background-color 0.2s, box-shadow 0.2s;">
                    <table cellpadding="0" cellspacing="0" style="margin: 0 auto;">
                        <tr>
                            <td valign="middle" style="color: #ffffff; font-weight: 700; font-size: 18px; font-family: 'IBM Plex Sans Arabic', sans-serif;">
                                عرض مبادرتك
                            </td>
                            <td valign="middle" style="padding-right: 8px;">
                                <span class="material-symbols-outlined" style="color: #ffffff; font-size: 20px; display: block;">arrow_back</span>
                            </td>
                        </tr>
                    </table>
                </a>
            </div>

            <!-- Help Text -->
            <div style="background-color: #ffffff; border: 1.5px dashed #e6bdb8; border-radius: 12px; padding: 24px; text-align: center; margin-top: 32px;">
                <p style="font-size: 14px; color: #5c403c; font-style: italic; line-height: 1.8; margin: 0;">
                    إذا كان لديك أي استفسار تواصل معنا مباشرة وسيكون فريقنا سعيداً بمساعدتك. شكراً لك على انضمامك إلى قريب! 🙏
                </p>
            </div>

            <!-- Contact Buttons (Email, WhatsApp, Instagram) -->
            <div style="text-align: center; margin-top: 24px; padding-top: 24px; border-top: 1px solid #ffe9e6;">
                <p style="font-size: 14px; font-weight: 700; color: #575e70; margin: 0 0 16px 0; font-family: 'IBM Plex Sans Arabic', sans-serif;">تواصل معنا عبر:</p>
                <table class="social-table" cellpadding="0" cellspacing="0" style="margin: 0 auto;">
                    <tr>
                        <td class="social-cell" valign="middle" style="padding: 0 6px;">
                            <a href="mailto:support@qareeb.cc" style="display: inline-block; background-color: #8b5cf6; color: #ffffff; padding: 8px 16px; border-radius: 20px; font-size: 12px; font-weight: 600; text-decoration: none; font-family: 'IBM Plex Sans Arabic', sans-serif;">
                                <table cellpadding="0" cellspacing="0">
                                    <tr>
                                        <td valign="middle" style="color: #ffffff; font-size: 12px;">البريد الإلكتروني</td>
                                        <td valign="middle" style="padding-right: 4px;">✉️</td>
                                    </tr>
                                </table>
                            </a>
                        </td>
                        <td class="social-cell" valign="middle" style="padding: 0 6px;">
                            <a href="https://api.whatsapp.com/send/?phone=970592135146&text&type=phone_number&app_absent=0" style="display: inline-block; background-color: #25D366; color: #ffffff; padding: 8px 16px; border-radius: 20px; font-size: 12px; font-weight: 600; text-decoration: none; font-family: 'IBM Plex Sans Arabic', sans-serif;">
                                <table cellpadding="0" cellspacing="0">
                                    <tr>
                                        <td valign="middle" style="color: #ffffff; font-size: 12px;">واتساب</td>
                                        <td valign="middle" style="padding-right: 4px;">💬</td>
                                    </tr>
                                </table>
                            </a>
                        </td>
                        <td class="social-cell" valign="middle" style="padding: 0 6px;">
                            <a href="https://www.instagram.com/qareeb_gaza" style="display: inline-block; background: linear-gradient(45deg, #f09433 0%, #e6683c 25%, #dc2743 50%, #cc2366 75%, #bc1888 100%); color: #ffffff; padding: 8px 16px; border-radius: 20px; font-size: 12px; font-weight: 600; text-decoration: none; font-family: 'IBM Plex Sans Arabic', sans-serif;">
                                <table cellpadding="0" cellspacing="0">
                                    <tr>
                                        <td valign="middle" style="color: #ffffff; font-size: 12px;">إنستغرام</td>
                                        <td valign="middle" style="padding-right: 4px;">📸</td>
                                    </tr>
                                </table>
                            </a>
                        </td>
                    </tr>
                </table>
            </div>

            <!-- Footer -->
            <div style="margin-top: 32px; text-align: center; padding-top: 24px; border-top: 1px solid #ffe9e6;">
                <div style="margin-bottom: 20px;">
                    <a href="{{ config('app.frontend_url') }}" style="color: #5c403c; text-decoration: none; font-size: 14px; font-weight: 500; margin: 0 12px;">الرئيسية</a>
                    <a href="{{ config('app.frontend_url') }}/contact" style="color: #5c403c; text-decoration: none; font-size: 14px; font-weight: 500; margin: 0 12px;">تواصل معنا</a>
                </div>
                <div style="margin-top: 16px;">
                    <p style="color: #916f6b; font-size: 12px; margin: 0 0 8px 0;">© 2026 قريب | Qareeb — جميع الحقوق محفوظة</p>
                    <div style="color: #ba1a1a; font-size: 14px; font-weight: 700; display: inline-block;">
                        <span style="vertical-align: middle;">صُنع لأجل غزة</span>
                        <span class="material-symbols-outlined" style="font-size: 16px; color: #ba1a1a; vertical-align: middle; font-variation-settings: 'FILL' 1;">favorite</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
