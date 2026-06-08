<!DOCTYPE html>
<html dir="rtl" lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Contact Message - Qareeb</title>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Arabic:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'IBM Plex Sans Arabic', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f3f4f6;
            margin: 0;
            padding: 40px 16px;
            direction: rtl;
            -webkit-font-smoothing: antialiased;
        }
        .email-wrapper {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
            border: 1px solid #E5E7EB;
        }
        .cta-btn:hover {
            background-color: #6D20C3 !important;
            box-shadow: 0 8px 24px rgba(139, 44, 245, 0.35) !important;
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
        <!-- Top Brand Bar -->
        <table width="100%" cellpadding="0" cellspacing="0" style="background-color: #ffffff; padding: 18px 32px; border-bottom: 1px solid #f3f4f6;">
            <tr>
                <td class="brand-bar-td" align="right" valign="middle">
                    <div style="font-size: 18px; font-weight: 700; color: #8B2C55; color: #8B2CF5; font-family: 'IBM Plex Sans Arabic', sans-serif;">Qareeb | قريب</div>
                </td>
                <td class="brand-bar-td" align="left" valign="middle">
                    <div style="font-size: 12px; color: #6b7280; font-weight: 500; font-family: 'IBM Plex Sans Arabic', sans-serif; opacity: 0.8;">ربط المجتمعات بالمساحات الأساسية</div>
                </td>
            </tr>
        </table>

        <!-- Hero Section -->
        <div style="background: linear-gradient(135deg, #8B2CF5 0%, #6D20C3 100%); padding: 48px 24px; text-align: center; position: relative; overflow: hidden;">
            <!-- Dot matrix background -->
            <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; opacity: 0.15; background-image: radial-gradient(rgba(255,255,255,0.2) 1.5px, transparent 1.5px); background-size: 12px 12px;"></div>
            <!-- Hero Content -->
            <div style="position: relative; z-index: 2;">
                <div style="background-color: rgba(255, 255, 255, 0.2); border: 1px solid rgba(255, 255, 255, 0.3); width: 80px; height: 80px; border-radius: 16px; display: inline-block; line-height: 80px; text-align: center; margin-bottom: 24px;">
                    <svg class="h-10 w-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" style="width: 40px; height: 40px; color: #ffffff; display: inline-block; vertical-align: middle;">
                        <path d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                    </svg>
                </div>
                <h1 style="color: #ffffff; font-size: 24px; font-weight: 700; margin: 0 0 8px 0; font-family: 'IBM Plex Sans Arabic', sans-serif;">رسالة تواصل جديدة</h1>
                <p style="color: #e9d5ff; font-size: 14px; margin: 0; font-family: 'IBM Plex Sans Arabic', sans-serif;">وصلتك رسالة عبر نموذج التواصل الخاص بك 📧</p>
            </div>
        </div>

        <div style="padding: 32px 32px 40px 32px;">
            <!-- Introduction Text -->
            <p style="font-size: 14px; color: #374151; line-height: 1.8; margin: 0 0 24px 0; text-align: right; font-family: 'IBM Plex Sans Arabic', sans-serif;">
                السلام عليكم ورحمة الله وبركاته،<br/>
                لقد تلقيت للتو رسالة جديدة من أحد المستخدمين المهتمين. إليك تفاصيل الرسالة أدناه:
            </p>

            <!-- Message Details Card -->
            <div style="background-color: #F8F4FF; border-right: 4px solid #8B2CF5; border-radius: 16px; padding: 24px; margin-bottom: 24px;">
                <!-- Field: Name -->
                <table width="100%" cellpadding="0" cellspacing="0" style="border-bottom: 1px solid #e9d5ff; padding-bottom: 12px; margin-bottom: 12px;">
                    <tr>
                        <td align="right" valign="middle">
                            <span style="color: #8B2CF5; font-weight: 600; font-size: 14px; font-family: 'IBM Plex Sans Arabic', sans-serif;">الاسم الكامل</span>
                        </td>
                        <td align="left" valign="middle">
                            <span style="color: #1f2937; font-weight: 500; font-size: 14px; font-family: 'IBM Plex Sans Arabic', sans-serif;">{{ $contactData['name'] }}</span>
                        </td>
                    </tr>
                </table>

                <!-- Field: Email -->
                <table width="100%" cellpadding="0" cellspacing="0" style="border-bottom: 1px solid #e9d5ff; padding-bottom: 12px; margin-bottom: 12px;">
                    <tr>
                        <td align="right" valign="middle">
                            <span style="color: #8B2CF5; font-weight: 600; font-size: 14px; font-family: 'IBM Plex Sans Arabic', sans-serif;">البريد الإلكتروني</span>
                        </td>
                        <td align="left" valign="middle" dir="ltr">
                            <span style="color: #1f2937; font-weight: 500; font-size: 14px; font-family: 'IBM Plex Sans Arabic', sans-serif;">{{ $contactData['email'] }}</span>
                        </td>
                    </tr>
                </table>

                <!-- Field: Subject -->
                <table width="100%" cellpadding="0" cellspacing="0" style="border-bottom: 1px solid #e9d5ff; padding-bottom: 12px; margin-bottom: 12px;">
                    <tr>
                        <td align="right" valign="middle">
                            <span style="color: #8B2CF5; font-weight: 600; font-size: 14px; font-family: 'IBM Plex Sans Arabic', sans-serif;">موضوع الرسالة</span>
                        </td>
                        <td align="left" valign="middle">
                            <span style="color: #1f2937; font-weight: 500; font-size: 14px; font-family: 'IBM Plex Sans Arabic', sans-serif;">{{ $contactData['subject'] ?? 'غير محدد' }}</span>
                        </td>
                    </tr>
                </table>

                <!-- Field: Content Box -->
                <div style="margin-top: 20px; text-align: right;">
                    <label style="display: block; color: #8B2CF5; font-weight: 600; font-size: 14px; margin-bottom: 8px; font-family: 'IBM Plex Sans Arabic', sans-serif;">محتوى الرسالة</label>
                    <div style="background-color: #ffffff; border: 1px solid #e9d5ff; border-radius: 12px; padding: 16px; color: #374151; font-size: 14px; line-height: 1.8; min-height: 100px; font-family: 'IBM Plex Sans Arabic', sans-serif; text-align: right;">
                        {{ $contactData['message'] }}
                    </div>
                </div>
            </div>

            <!-- Action Button -->
            <div style="text-align: center; margin: 24px 0;">
                <a href="mailto:{{ $contactData['email'] }}" class="cta-btn" style="display: inline-block; background-color: #8B2CF5; color: #ffffff; padding: 14px 44px; border-radius: 12px; font-weight: 700; font-size: 16px; text-decoration: none; box-shadow: 0 6px 20px rgba(139, 44, 245, 0.25); transition: background-color 0.2s, box-shadow 0.2s;">
                    <table cellpadding="0" cellspacing="0" style="margin: 0 auto;">
                        <tr>
                            <td valign="middle" style="color: #ffffff; font-weight: 700; font-size: 16px; font-family: 'IBM Plex Sans Arabic', sans-serif;">
                                الرد على الرسالة
                            </td>
                            <td valign="middle" style="padding-right: 8px;">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" style="width: 20px; height: 20px; color: #ffffff; display: block; transform: rotate(180deg);">
                                    <path d="M10 19l-7-7m0 0l7-7m-7 7h18" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                                </svg>
                            </td>
                        </tr>
                    </table>
                </a>
            </div>

            <!-- Footer Help Box -->
            <div style="border: 2px dashed #E5E7EB; border-radius: 12px; padding: 16px; text-align: center; margin-top: 24px;">
                <p style="color: #6b7280; font-size: 12px; margin: 0; font-family: 'IBM Plex Sans Arabic', sans-serif;">
                    يرجى الرد على العميل في أقرب وقت ممكن لضمان جودة الخدمة. شكراً لاهتمامكم! 🙏
                </p>
            </div>

            <!-- Contact Buttons (Email, WhatsApp, Instagram) -->
            <div style="text-align: center; margin-top: 24px; padding-top: 24px; border-top: 1px solid #E5E7EB;">
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

            <!-- Main Footer -->
            <div style="margin-top: 40px; text-align: center; padding-top: 24px; border-top: 1px solid #E5E7EB;">
                <div style="margin-bottom: 20px;">
                    <a href="#" style="color: #8B2CF5; text-decoration: none; font-size: 14px; font-weight: 500; margin: 0 12px; font-family: 'IBM Plex Sans Arabic', sans-serif;">الرئيسية</a>
                    <a href="#" style="color: #8B2CF5; text-decoration: none; font-size: 14px; font-weight: 500; margin: 0 12px; font-family: 'IBM Plex Sans Arabic', sans-serif;">تواصل معنا</a>
                    <a href="#" style="color: #8B2CF5; text-decoration: none; font-size: 14px; font-weight: 500; margin: 0 12px; font-family: 'IBM Plex Sans Arabic', sans-serif;">سياسة الخصوصية</a>
                </div>
                <div style="margin-top: 16px;">
                    <p style="color: #9ca3af; font-size: 12px; margin: 0 0 8px 0; font-family: 'IBM Plex Sans Arabic', sans-serif;">© 2026 قريب | Qareeb — جميع الحقوق محفوظة</p>
                    <div style="color: #e11d48; font-size: 12px; font-weight: 700; display: inline-block;">
                        <span style="vertical-align: middle; font-family: 'IBM Plex Sans Arabic', sans-serif;">صُنع لأجل غزة</span>
                        <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" style="width: 14px; height: 14px; color: #e11d48; display: inline-block; vertical-align: middle; margin-right: 4px;">
                            <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
