<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>رسالة جديدة من موقع أصول الزراعة</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            direction: rtl;
        }
        .email-container {
            max-width: 600px;
            margin: 30px auto;
            background-color: #ffffff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .email-header {
            background: linear-gradient(135deg, #034f31 0%, #91c744 100%);
            color: #ffffff;
            padding: 30px;
            text-align: center;
        }
        .email-header h1 {
            margin: 0;
            font-size: 24px;
            font-weight: bold;
        }
        .email-header p {
            margin: 10px 0 0;
            font-size: 14px;
            opacity: 0.9;
        }
        .email-body {
            padding: 30px;
        }
        .info-row {
            margin-bottom: 20px;
            padding: 15px;
            background-color: #f8fcf8;
            border-right: 4px solid #91c744;
            border-radius: 5px;
        }
        .info-label {
            font-weight: bold;
            color: #034f31;
            font-size: 14px;
            margin-bottom: 5px;
            display: block;
        }
        .info-value {
            color: #333;
            font-size: 16px;
            word-wrap: break-word;
        }
        .message-box {
            background-color: #f0f8e8;
            padding: 20px;
            border-radius: 8px;
            border: 2px solid #91c744;
            margin-top: 20px;
        }
        .message-box .info-label {
            margin-bottom: 10px;
        }
        .message-box .info-value {
            line-height: 1.6;
            white-space: pre-wrap;
        }
        .email-footer {
            background-color: #f8f9fa;
            padding: 20px;
            text-align: center;
            color: #666;
            font-size: 12px;
            border-top: 1px solid #e0e0e0;
        }
        .email-footer a {
            color: #91c744;
            text-decoration: none;
        }
        .icon {
            display: inline-block;
            width: 20px;
            height: 20px;
            margin-left: 8px;
            vertical-align: middle;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <!-- Header -->
        <div class="email-header">
            <h1>📧 رسالة جديدة من موقع أصول الزراعة</h1>
            <p>تم استلام رسالة جديدة من نموذج التواصل</p>
        </div>

        <!-- Body -->
        <div class="email-body">
            <div class="info-row">
                <span class="info-label">👤 الاسم:</span>
                <span class="info-value">{{ $name }}</span>
            </div>

            <div class="info-row">
                <span class="info-label">📱 رقم الهاتف:</span>
                <span class="info-value">{{ $phone }}</span>
            </div>

            <div class="info-row">
                <span class="info-label">✉️ البريد الإلكتروني:</span>
                <span class="info-value">
                    <a href="mailto:{{ $email }}" style="color: #91c744; text-decoration: none;">{{ $email }}</a>
                </span>
            </div>

            <div class="message-box">
                <span class="info-label">💬 محتوى الرسالة:</span>
                <div class="info-value">{{ $messageContent }}</div>
            </div>
        </div>

        <!-- Footer -->
        <div class="email-footer">
            <p>هذه الرسالة تم إرسالها من نموذج التواصل في موقع <a href="http://127.0.0.1:8000">أصول الزراعة</a></p>
            <p>للرد على هذه الرسالة، يمكنك الرد مباشرة على هذا الإيميل أو التواصل عبر: {{ $email }}</p>
            <p style="margin-top: 15px; color: #999;">© {{ date('Y') }} أصول الزراعة - جميع الحقوق محفوظة</p>
        </div>
    </div>
</body>
</html>
