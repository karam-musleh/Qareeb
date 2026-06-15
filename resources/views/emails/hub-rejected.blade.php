<!DOCTYPE html>
<html dir="rtl" lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إشعار تحديث الطلب</title>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Arabic:wght@400;500;600;700&display=swap" rel="stylesheet" />
    <style>
        body {
            font-family: 'IBM Plex Sans Arabic', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #fff8f7;
            color: #281715;
            margin: 0;
            padding: 0;
            direction: rtl;
            -webkit-font-smoothing: antialiased;
        }
        table {
            border-collapse: collapse;
            mso-table-lspace: 0pt;
            mso-table-rspace: 0pt;
        }
        .email-wrapper {
            max-width: 600px !important;
            width: 100%;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.04);
            overflow: hidden;
            border: 1px solid #ffe9e6;
        }
        .cta-btn:hover {
            background-color: #b70011 !important;
        }
        @media only screen and (max-width: 480px) {
            .next-steps-table, 
            .next-steps-table tbody, 
            .next-steps-table tr, 
            .next-steps-table td {
                display: block !important;
                width: 100% !important;
            }
            .next-steps-spacer {
                height: 12px !important;
                display: block !important;
            }
            .social-table, .social-table tr, .social-table td {
                display: block !important;
                width: 100% !important;
                text-align: center !important;
            }
            .social-cell {
                padding: 6px 0 !important;
            }
            .content-pad {
                padding: 20px 16px !important;
            }
        }
    </style>
</head>
<body style="background-color: #fff8f7; margin: 0; padding: 0;">
    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="background-color: #fff8f7; padding: 40px 16px;">
        <tr>
            <td align="center">
                <table role="presentation" class="email-wrapper" width="100%" cellspacing="0" cellpadding="0" border="0" style="max-width: 600px; background-color: #ffffff; border-radius: 12px; overflow: hidden; border: 1px solid #ffe9e6;">
                    
                    <!-- Visual Anchor Header -->
                    <tr>
                        <td style="background-color: #fff0ee; text-align: center; padding: 24px 0;">
                            <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0">
                                <tr>
                                    <td align="center">
                                        <div style="display: inline-block; background-color: #ffffff; padding: 16px; border-radius: 50%; box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.05); margin-top: 24px;">
                                            <span style="font-size: 48px; display: block;">⚠️</span>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Main Content -->
                    <tr>
                        <td class="content-pad" style="padding: 40px 32px;">
                            <!-- Title -->
                            <h2 style="font-size: 24px; font-weight: 700; color: #281715; text-align: center; margin: 0 0 24px 0;">تم رفض طلبك</h2>

                            <!-- Greetings & Context -->
                            <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-bottom: 24px;">
                                <tr>
                                    <td align="right">
                                        <p style="font-size: 18px; color: #5c403c; line-height: 1.6; margin: 0 0 12px 0;">
                                            السلام عليكم ورحمة الله وبركاته، السيد/السيدة {{ $ownerName }}
                                        </p>
                                        <p style="font-size: 16px; color: #281715; line-height: 1.6; margin: 0;">
                                            نأسف لإخبارك بأن طلب تسجيل هبك <strong>{{ $hubName }}</strong> لم يتم قبوله.
                                        </p>
                                    </td>
                                </tr>
                            </table>

                            <!-- Rejection Reason Card -->
                            <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="background-color: #fdf2f2; border-right: 4px solid #b70011; padding: 20px; border-radius: 8px; margin: 24px 0; text-align: right;">
                                <tr>
                                    <td>
                                        <div style="margin-bottom: 8px;">
                                            <span style="font-size: 20px; vertical-align: middle; margin-left: 6px;">ℹ️</span>
                                            <strong style="color: #b70011; font-size: 14px; font-weight: 700; vertical-align: middle;">سبب الرفض:</strong>
                                        </div>
                                        <p style="font-size: 15px; color: #93000a; font-style: italic; line-height: 1.6; margin: 0; padding-right: 4px;">
                                            "{{ $rejectionReason }}"
                                        </p>
                                    </td>
                                </tr>
                            </table>

                            <!-- Next Steps -->
                            <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0">
                                <tr>
                                    <td align="right">
                                        <h3 style="font-size: 12px; font-weight: 700; color: #575e70; text-transform: uppercase; letter-spacing: 1px; margin: 24px 0 16px 0;">الخطوات التالية</h3>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <table role="presentation" class="next-steps-table" width="100%" cellpadding="0" cellspacing="0" border="0" style="margin-bottom: 24px;">
                                            <tr>
                                                <td width="48%" valign="top">
                                                    <a href="{{ $editUrl ?? ($dashboardUrl ?? '#') }}" style="display: block; text-decoration: none; background-color: #ffe9e6; border: 1px solid #ffe9e6; border-radius: 8px; padding: 16px;">
                                                        <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0">
                                                            <tr>
                                                                <td width="36" valign="middle">
                                                                    <span style="font-size: 24px; display: block;">📝</span>
                                                                </td>
                                                                <td valign="middle" style="padding-right: 8px;">
                                                                    <span style="font-size: 14px; color: #281715; font-weight: 500;">تصحيح البيانات وإعادة التقديم</span>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </a>
                                                </td>
                                                <td class="next-steps-spacer" width="4%"></td>
                                                <td width="48%" valign="top">
                                                    <a href="{{ $contactUrl ?? '#' }}" style="display: block; text-decoration: none; background-color: #ffe9e6; border: 1px solid #ffe9e6; border-radius: 8px; padding: 16px;">
                                                        <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0">
                                                            <tr>
                                                                <td width="36" valign="middle">
                                                                    <span style="font-size: 24px; display: block;">🎧</span>
                                                                </td>
                                                                <td valign="middle" style="padding-right: 8px;">
                                                                    <span style="font-size: 14px; color: #281715; font-weight: 500;">التواصل مع الدعم الفني</span>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </a>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>

                            <!-- Closing -->
                            <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top: 24px; border-top: 1px solid #ffe9e6; padding: 16px 0;">
                                <tr>
                                    <td align="center">
                                        <p style="font-size: 14px; color: #575e70; margin: 0; padding-top: 16px;">نتطلع لسماع منك قريباً!</p>
                                    </td>
                                </tr>
                            </table>

                            <!-- CTA Button -->
                            <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top: 24px; margin-bottom: 8px;">
                                <tr>
                                    <td align="center">
                                        <a href="{{ $requestUrl ?? ($dashboardUrl ?? '#') }}" class="cta-btn" style="display: inline-block; background-color: #dc2626; color: #fff6f5; padding: 14px 40px; border-radius: 8px; font-weight: 600; font-size: 20px; text-decoration: none; box-shadow: 0 4px 12px rgba(220, 38, 38, 0.2);">
                                            عرض الطلب
                                        </a>
                                    </td>
                                </tr>
                            </table>

                            <!-- Illustrative Graphic -->
                            <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top: 32px; border-radius: 12px; overflow: hidden; opacity: 0.9;">
                                <tr>
                                    <td align="center">
                                        <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuCATVKIl65sZntq_3GXTA9h5kAQH2m39d24YUd2Rv-bCgSrn5uy5vlc6lIueKCC1YLYztN7s9t16UgwLst0ih91tAIYX9Sue9NNC5I31ihXR4WOLVV1-Ez7wb6Li-Xw6xA1LzxDwzJKjSp3Mxal76dEutjS71fbsliqEO6LGLuBfcnoknD9OZh6eNcSmDaC054005jdyFr96vzc74LgoUCKFXL6rnBOgn91X6m3yteBluiWT1JLh1oGCXeYbESyBKDyrjSMnPulLon2" alt="Office Workspace" style="width: 100%; max-width: 536px; height: auto; display: block; border-radius: 12px;" />
                                    </td>
                                </tr>
                            </table>

                            <!-- Contact Buttons -->
                            <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top: 24px; padding-top: 24px; border-top: 1px solid #ffe9e6;">
                                <tr>
                                    <td align="center">
                                        <p style="font-size: 14px; font-weight: 700; color: #575e70; margin: 0 0 16px 0; font-family: 'IBM Plex Sans Arabic', sans-serif;">تواصل معنا عبر:</p>
                                        <table role="presentation" class="social-table" cellpadding="0" cellspacing="0" border="0" style="margin: 0 auto;">
                                            <tr>
                                                <td class="social-cell" valign="middle" style="padding: 0 6px;">
                                                    <a href="mailto:support@qareeb.cc" style="display: inline-block; background-color: #8b5cf6; color: #ffffff; padding: 8px 16px; border-radius: 20px; font-size: 12px; font-weight: 600; text-decoration: none; font-family: 'IBM Plex Sans Arabic', sans-serif;">البريد الإلكتروني ✉️</a>
                                                </td>
                                                <td class="social-cell" valign="middle" style="padding: 0 6px;">
                                                    <a href="https://api.whatsapp.com/send/?phone=970592135146&text&type=phone_number&app_absent=0" style="display: inline-block; background-color: #25D366; color: #ffffff; padding: 8px 16px; border-radius: 20px; font-size: 12px; font-weight: 600; text-decoration: none; font-family: 'IBM Plex Sans Arabic', sans-serif;">واتساب 💬</a>
                                                </td>
                                                <td class="social-cell" valign="middle" style="padding: 0 6px;">
                                                    <a href="https://www.instagram.com/qareeb_gaza" style="display: inline-block; background-color: #E1306C; color: #ffffff; padding: 8px 16px; border-radius: 20px; font-size: 12px; font-weight: 600; text-decoration: none; font-family: 'IBM Plex Sans Arabic', sans-serif;">إنستغرام 📸</a>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>

                            <!-- Footer Section -->
                            <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top: 40px; text-align: center; padding-top: 24px; border-top: 1px solid #ffe9e6;">
                                <tr>
                                    <td align="center">
                                        <div style="margin-bottom: 16px;">
                                            <a href="{{ $helpUrl ?? '#' }}" style="color: #5c403c; text-decoration: none; font-size: 12px; font-weight: 500; margin: 0 12px;">مركز المساعدة</a>
                                            <a href="{{ $privacyUrl ?? '#' }}" style="color: #5c403c; text-decoration: none; font-size: 12px; font-weight: 500; margin: 0 12px;">سياسة الخصوصية</a>
                                            <a href="{{ $contactUrl ?? '#' }}" style="color: #5c403c; text-decoration: none; font-size: 12px; font-weight: 500; margin: 0 12px;">اتصل بنا</a>
                                        </div>
                                        <p style="color: #575e70; font-size: 12px; margin: 0 0 8px 0;">جميع الحقوق محفوظة لمنصتنا © ٢٠٢٦</p>
                                        <p style="color: #916f6b; font-size: 11px; margin: 0 0 16px 0;">صُنع لأجل غزة ❤️</p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
