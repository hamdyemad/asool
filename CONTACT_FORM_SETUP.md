# Contact Form Email Setup - FIXED ✅

## ⚠️ ISSUE RESOLVED

**Problem**: Contact form was returning 500 error when sending emails.

**Root Cause**: `.env` file had `MAIL_ENCRYPTION=null` but SMTP on port 587 requires TLS encryption.

**Solution**: Changed `MAIL_ENCRYPTION=null` to `MAIL_ENCRYPTION=tls` and cleared config cache.

### What Was Changed:
1. ✅ Updated `.env`: `MAIL_ENCRYPTION=tls` (was `null`)
2. ✅ Added error logging to `ContactController.php`
3. ✅ Cleared config cache: `php artisan config:clear`
4. ✅ Added test route at `/test-mail` for debugging

### Quick Test:
Visit `http://127.0.0.1:8000/test-mail` to verify mail configuration is working.

---

## Overview
Contact form that sends emails to `info@osool1.com` with all form data.

## Files Created

### 1. Controller
**File:** `app/Http/Controllers/ContactController.php`
- Handles form submission
- Validates input data
- Sends email
- Returns JSON response

### 2. Email Template
**File:** `resources/views/emails/contact.blade.php`
- Beautiful HTML email template
- RTL support
- Displays all form data:
  - Name
  - Phone
  - Email
  - Message
- Branded with company colors

### 3. Updated Contact Form
**File:** `resources/views/front/components/contact.blade.php`
- Added form fields with names
- Added AJAX submission
- Added success/error messages
- Added loading state

### 4. Route
**File:** `routes/web.php`
- Added POST route: `/contact/send`

## Email Configuration

### Step 1: Update `.env` File

You need to configure your email settings in the `.env` file. Here are the options:

#### Option 1: Gmail (Recommended for Testing)
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-app-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=your-email@gmail.com
MAIL_FROM_NAME="أصول الزراعة"
```

**Note:** For Gmail, you need to:
1. Enable 2-Factor Authentication
2. Generate an "App Password" from Google Account settings
3. Use the App Password (not your regular password)

#### Option 2: Mailtrap (For Testing)
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your-mailtrap-username
MAIL_PASSWORD=your-mailtrap-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@osool1.com
MAIL_FROM_NAME="أصول الزراعة"
```

#### Option 3: SendGrid (Production)
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.sendgrid.net
MAIL_PORT=587
MAIL_USERNAME=apikey
MAIL_PASSWORD=your-sendgrid-api-key
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@osool1.com
MAIL_FROM_NAME="أصول الزراعة"
```

#### Option 4: Your Domain Email (cPanel/Hosting)
```env
MAIL_MAILER=smtp
MAIL_HOST=mail.osool1.com
MAIL_PORT=587
MAIL_USERNAME=noreply@osool1.com
MAIL_PASSWORD=your-email-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@osool1.com
MAIL_FROM_NAME="أصول الزراعة"
```

### Step 2: Clear Config Cache
After updating `.env`, run:
```bash
php artisan config:clear
php artisan cache:clear
```

## Testing

### 1. Test the Form
1. Go to: `http://127.0.0.1:8000/#contact`
2. Fill in the form:
   - Name: محمد أحمد
   - Phone: 0501234567
   - Email: test@example.com
   - Message: رسالة تجريبية
3. Click "ارسال"
4. You should see success message
5. Check email at `info@osool1.com`

### 2. Test with Mailtrap (Recommended for Development)
1. Sign up at https://mailtrap.io (free)
2. Get SMTP credentials
3. Update `.env` with Mailtrap settings
4. Send test email
5. Check inbox in Mailtrap dashboard

## Features

### Form Validation
- ✅ Name: Required, max 255 characters
- ✅ Phone: Required, max 20 characters
- ✅ Email: Required, valid email format
- ✅ Message: Required, max 1000 characters

### User Experience
- ✅ AJAX submission (no page reload)
- ✅ Loading state while sending
- ✅ Success message (green)
- ✅ Error message (red)
- ✅ Form reset after success
- ✅ Auto-hide success message after 5 seconds
- ✅ Smooth scroll to message

### Email Features
- ✅ Beautiful HTML template
- ✅ RTL support
- ✅ Company branding
- ✅ All form data included
- ✅ Reply-to sender's email
- ✅ Mobile responsive

## Troubleshooting

### Email Not Sending

#### 1. Check `.env` Configuration
```bash
php artisan config:clear
```

#### 2. Check Mail Driver
In `.env`, make sure:
```env
MAIL_MAILER=smtp
```

#### 3. Test Email Configuration
Create a test route in `routes/web.php`:
```php
Route::get('/test-email', function() {
    try {
        Mail::raw('Test email from Laravel', function($message) {
            $message->to('info@osool1.com')
                ->subject('Test Email');
        });
        return 'Email sent!';
    } catch (\Exception $e) {
        return 'Error: ' . $e->getMessage();
    }
});
```

Visit: `http://127.0.0.1:8000/test-email`

#### 4. Check Logs
Check `storage/logs/laravel.log` for errors

#### 5. Gmail Specific Issues
- Enable "Less secure app access" (not recommended)
- OR use App Password (recommended)
- OR use OAuth2

### Form Not Submitting

#### 1. Check Console for Errors
Open browser console (F12) and check for JavaScript errors

#### 2. Check CSRF Token
Make sure `@csrf` is in the form

#### 3. Check Route
```bash
php artisan route:list | grep contact
```

Should show:
```
POST | contact/send | contact.send
```

## Customization

### Change Recipient Email
In `ContactController.php`, line 35:
```php
$message->to('your-new-email@example.com')
```

### Change Email Subject
In `ContactController.php`, line 36:
```php
->subject('Your Custom Subject - ' . $data['name'])
```

### Customize Email Template
Edit `resources/views/emails/contact.blade.php`

### Add More Fields
1. Add field to form in `contact.blade.php`:
```html
<input type="text" name="company" placeholder="اسم الشركة">
```

2. Add validation in `ContactController.php`:
```php
'company' => 'nullable|string|max:255',
```

3. Add to email template:
```html
<div class="info-row">
    <span class="info-label">🏢 الشركة:</span>
    <span class="info-value">{{ $company ?? 'غير محدد' }}</span>
</div>
```

### Add CC/BCC
In `ContactController.php`:
```php
$message->to('info@osool1.com')
    ->cc('sales@osool1.com')
    ->bcc('admin@osool1.com')
```

### Add Attachments
If you want to allow file uploads:

1. Update form:
```html
<form id="contactForm" enctype="multipart/form-data">
    <input type="file" name="attachment">
</form>
```

2. Update controller:
```php
if ($request->hasFile('attachment')) {
    $message->attach($request->file('attachment')->getRealPath(), [
        'as' => $request->file('attachment')->getClientOriginalName(),
        'mime' => $request->file('attachment')->getMimeType(),
    ]);
}
```

## Production Checklist

Before going live:

- [ ] Update `.env` with production email settings
- [ ] Test email sending
- [ ] Add rate limiting to prevent spam
- [ ] Add Google reCAPTCHA
- [ ] Set up email queue for better performance
- [ ] Monitor email logs
- [ ] Set up email notifications for failed sends

## Rate Limiting (Recommended)

Add to `ContactController.php`:
```php
use Illuminate\Support\Facades\RateLimiter;

public function send(Request $request)
{
    $key = 'contact-form:' . $request->ip();
    
    if (RateLimiter::tooManyAttempts($key, 3)) {
        return response()->json([
            'success' => false,
            'message' => 'تم إرسال عدد كبير من الرسائل. يرجى المحاولة بعد قليل.'
        ], 429);
    }
    
    RateLimiter::hit($key, 60); // 3 attempts per 60 seconds
    
    // ... rest of code
}
```

## Queue Setup (Optional, for Better Performance)

1. Update `.env`:
```env
QUEUE_CONNECTION=database
```

2. Create queue table:
```bash
php artisan queue:table
php artisan migrate
```

3. Update controller to use queue:
```php
Mail::queue('emails.contact', $data, function ($message) use ($data) {
    // ...
});
```

4. Run queue worker:
```bash
php artisan queue:work
```

## Support

If you encounter issues:
1. Check `storage/logs/laravel.log`
2. Test with Mailtrap first
3. Verify `.env` settings
4. Clear config cache
5. Check email provider documentation
