<!DOCTYPE html>
<html dir="rtl" lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إشعار تحديث الطلب</title>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Arabic:wght@400;500;600;700&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@400,0..1&display=swap" rel="stylesheet" />
    <style>
        body {
            font-family: 'IBM Plex Sans Arabic', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #fff8f7;
            color: #281715;
            margin: 0;
            padding: 40px 16px;
            direction: rtl;
            -webkit-font-smoothing: antialiased;
        }
        .email-wrapper {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.04);
            overflow: hidden;
            border: 1px solid #ffe9e6;
        }
        .graphic-img {
            filter: grayscale(100%);
            transition: filter 0.5s ease;
        }
        .graphic-img:hover {
            filter: none !important;
        }
        .next-step-card:hover {
            background-color: #ffe2de !important;
        }
        .cta-btn:hover {
            background-color: #b70011 !important;
            box-shadow: 0 6px 16px rgba(220, 38, 38, 0.3) !important;
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
        }
    </style>
</head>
<body>
    <div class="email-wrapper">
        <!-- Visual Anchor Header -->
        <div style="background-color: #fff0ee; position: relative; height: 128px; text-align: center; overflow: hidden;">
            <!-- Dot pattern background -->
            <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; opacity: 0.1; background-image: radial-gradient(circle at 2px 2px, #b70011 1px, transparent 0); background-size: 24px 24px;"></div>
            <!-- Circle with icon -->
            <div style="display: inline-block; background-color: #ffffff; padding: 16px; border-radius: 50%; box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.05); margin-top: 24px; position: relative; z-index: 2;">
                <span class="material-symbols-outlined" style="color: #b70011; font-size: 48px; display: block; font-variation-settings: 'FILL' 0;">assignment_late</span>
            </div>
        </div>

        <div style="padding: 40px 32px;">
            <!-- Title -->
            <h2 style="font-size: 24px; font-weight: 700; color: #281715; text-align: center; margin: 0 0 24px 0;">تم رفض طلبك</h2>

            <!-- Greetings & Context -->
            <div style="margin-bottom: 24px;">
                <p style="font-size: 18px; color: #5c403c; line-height: 1.6; margin: 0 0 12px 0;">
                    السلام عليكم ورحمة الله وبركاته، السيد/السيدة {{ $ownerName }}
                </p>
                <p style="font-size: 16px; color: #281715; line-height: 1.6; margin: 0;">
                    نأسف لإخبارك بأن طلب تسجيل هبك <strong>{{ $hubName }}</strong> لم يتم قبوله.
                </p>
            </div>

            <!-- Rejection Reason Card -->
            <div id="reason-card" style="background-color: rgba(255, 218, 214, 0.3); border-right: 4px solid #b70011; padding: 20px; border-radius: 8px; margin: 24px 0; text-align: right; transition: transform 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);">
                <div style="margin-bottom: 8px;">
                    <span class="material-symbols-outlined" style="color: #b70011; font-size: 20px; vertical-align: middle; margin-left: 6px;">info</span>
                    <strong style="color: #b70011; font-size: 14px; font-weight: 700; vertical-align: middle;">سبب الرفض:</strong>
                </div>
                <p style="font-size: 15px; color: #93000a; font-style: italic; line-height: 1.6; margin: 0; padding-right: 4px;">
                    "{{ $rejectionReason }}"
                </p>
            </div>

            <!-- Next Steps -->
            <div>
                <h3 style="font-size: 12px; font-weight: 700; color: #575e70; text-transform: uppercase; letter-spacing: 1px; margin: 24px 0 16px 0; text-align: right;">الخطوات التالية</h3>
                
                <table class="next-steps-table" width="100%" cellpadding="0" cellspacing="0" style="margin-bottom: 24px;">
                    <tr>
                        <td width="48%" valign="top">
                            <a href="{{ $editUrl ?? ($dashboardUrl ?? '#') }}" class="next-step-card" style="display: block; text-decoration: none; background-color: #ffe9e6; border: 1px solid #ffe9e6; border-radius: 8px; padding: 16px; transition: background-color 0.2s;">
                                <table width="100%" cellpadding="0" cellspacing="0">
                                    <tr>
                                        <td width="36" valign="middle">
                                            <span class="material-symbols-outlined" style="color: #b70011; font-size: 24px; display: block;">edit_note</span>
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
                            <a href="{{ $contactUrl ?? '#' }}" class="next-step-card" style="display: block; text-decoration: none; background-color: #ffe9e6; border: 1px solid #ffe9e6; border-radius: 8px; padding: 16px; transition: background-color 0.2s;">
                                <table width="100%" cellpadding="0" cellspacing="0">
                                    <tr>
                                        <td width="36" valign="middle">
                                            <span class="material-symbols-outlined" style="color: #b70011; font-size: 24px; display: block;">support_agent</span>
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
            </div>

            <!-- Closing -->
            <div style="text-align: center; padding: 16px 0; border-top: 1px solid #ffe9e6; margin-top: 24px;">
                <p style="font-size: 14px; color: #575e70; margin: 0;">نتطلع لسماع منك قريباً!</p>
            </div>

            <!-- CTA Button -->
            <div style="text-align: center; margin-top: 24px; margin-bottom: 8px;">
                <a href="{{ $requestUrl ?? ($dashboardUrl ?? '#') }}" class="cta-btn" style="display: inline-block; background-color: #dc2626; color: #fff6f5; padding: 14px 40px; border-radius: 8px; font-weight: 600; font-size: 20px; text-decoration: none; box-shadow: 0 4px 12px rgba(220, 38, 38, 0.2); transition: background-color 0.2s, box-shadow 0.2s;">
                    عرض الطلب
                </a>
            </div>

            <!-- Illustrative Graphic -->
            <div style="margin-top: 32px; border-radius: 12px; overflow: hidden; opacity: 0.9;">
                <img class="graphic-img" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCATVKIl65sZntq_3GXTA9h5kAQH2m39d24YUd2Rv-bCgSrn5uy5vlc6lIueKCC1YLYztN7s9t16UgwLst0ih91tAIYX9Sue9NNC5I31ihXR4WOLVV1-Ez7wb6Li-Xw6xA1LzxDwzJKjSp3Mxal76dEutjS71fbsliqEO6LGLuBfcnoknD9OZh6eNcSmDaC054005jdyFr96vzc74LgoUCKFXL6rnBOgn91X6m3yteBluiWT1JLh1oGCXeYbESyBKDyrjSMnPulLon2" alt="Office Workspace" style="width: 100%; height: auto; display: block; border-radius: 12px;" />
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

            <!-- Footer Section -->
            <div style="margin-top: 40px; text-align: center; padding-top: 24px; border-top: 1px solid #ffe9e6;">
                <div style="margin-bottom: 16px;">
                    <a href="{{ $helpUrl ?? '#' }}" style="color: #5c403c; text-decoration: none; font-size: 12px; font-weight: 500; margin: 0 12px;">مركز المساعدة</a>
                    <a href="{{ $privacyUrl ?? '#' }}" style="color: #5c403c; text-decoration: none; font-size: 12px; font-weight: 500; margin: 0 12px;">سياسة الخصوصية</a>
                    <a href="{{ $contactUrl ?? '#' }}" style="color: #5c403c; text-decoration: none; font-size: 12px; font-weight: 500; margin: 0 12px;">اتصل بنا</a>
                </div>
                <p style="color: #575e70; font-size: 12px; margin: 0 0 8px 0;">جميع الحقوق محفوظة لمنصتنا © ٢٠٢٦</p>
                <p style="color: #916f6b; font-size: 11px; margin: 0 0 16px 0;">صُنع لأجل غزة ❤️</p>
                <div style="opacity: 0.3; display: inline-block;">
                    <span class="material-symbols-outlined" style="font-size: 20px; color: #281715; margin: 0 8px; vertical-align: middle;">language</span>
                    <span class="material-symbols-outlined" style="font-size: 20px; color: #281715; margin: 0 8px; vertical-align: middle;">verified_user</span>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Micro-interaction: Subtle hover effect for the rejection card
        const reasonCard = document.getElementById('reason-card');
        if (reasonCard) {
            reasonCard.addEventListener('mouseenter', () => {
                reasonCard.style.transform = 'translateX(-4px)';
            });
            reasonCard.addEventListener('mouseleave', () => {
                reasonCard.style.transform = 'translateX(0)';
            });
        }
    </script>
</body>
</html>
