<!DOCTYPE html>
<html dir="rtl" lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            background-color: white;
            margin: 0 auto;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .header {
            text-align: center;
            border-bottom: 3px solid #10b981;
            padding-bottom: 20px;
            margin-bottom: 20px;
        }
        .header h1 {
            color: #10b981;
            margin: 0;
            font-size: 24px;
        }
        .content {
            line-height: 1.8;
            color: #333;
        }
        .success-badge {
            display: inline-block;
            background-color: #10b981;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            margin: 20px 0;
            font-weight: bold;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #eee;
            color: #999;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>✅ تم قبول هبك</h1>
        </div>

        <div class="content">
            <p>السلام عليكم ورحمة الله وبركاته</p>

            <p>السيد/السيدة <strong>{{ $ownerName }}</strong></p>

            <p>نرحب بك في منصتنا! 🎉</p>

            <div class="success-badge">
                تم قبول هبك: {{ $hubName }}
            </div>

            <p>يسعدنا إخبارك بأن 'طلبك ' <strong>{{ $hubName }}</strong> قد تم قبوله والموافقة عليه بنجاح!</p>

            <p>يمكنك الآن:</p>
            <ul>
                <li>إضافة العروض والخدمات</li>
                <li>إدارة حجوزاتك</li>
                <li>متابعة طلباتك</li>
            </ul>

            <p>إذا كان لديك أي استفسار، تواصل معنا مباشرة.</p>

            <p>شكراً لك على الانضمام إلينا! 🙏</p>
        </div>

        <div class="footer">
            <p>© جميع الحقوق محفوظة لمنصتنا</p>
        </div>
    </div>
</body>
</html>
