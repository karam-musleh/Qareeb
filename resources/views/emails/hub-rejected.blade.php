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
            border-bottom: 3px solid #ef4444;
            padding-bottom: 20px;
            margin-bottom: 20px;
        }
        .header h1 {
            color: #ef4444;
            margin: 0;
            font-size: 24px;
        }
        .content {
            line-height: 1.8;
            color: #333;
        }
        .reason-box {
            background-color: #fef2f2;
            border-left: 4px solid #ef4444;
            padding: 15px;
            margin: 20px 0;
            border-radius: 5px;
        }
        .reason-box h3 {
            color: #ef4444;
            margin-top: 0;
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
            <h1>❌ تم رفض طلبك</h1>
        </div>

        <div class="content">
            <p>السلام عليكم ورحمة الله وبركاته</p>

            <p>السيد/السيدة <strong>{{ $ownerName }}</strong></p>

            <p>نأسف لإخبارك بأن طلب تسجيل هبك <strong>{{ $hubName }}</strong> لم يتم قبوله.</p>

            <div class="reason-box">
                <h3>سبب الرفض:</h3>
                <p>{{ $rejectionReason }}</p>
            </div>

            <p>يمكنك:</p>
            <ul>
                <li>تصحيح البيانات المطلوبة وإعادة التقديم</li>
                <li>التواصل معنا للحصول على مزيد من المساعدة</li>
            </ul>

            <p>نتطلع لسماع منك قريباً! 📞</p>
        </div>

        <div class="footer">
            <p>© جميع الحقوق محفوظة لمنصتنا</p>
        </div>
    </div>
</body>
</html>
