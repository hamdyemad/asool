# Mail Configuration Testing Guide

## Current Configuration

The mail system is now configured with:
- **Mail Driver**: SMTP (Mailtrap for testing)
- **Host**: smtp.mailtrap.io
- **Port**: 587
- **Encryption**: TLS
- **From Address**: info@osool1.com

## Changes Made

1. ✅ Updated `.env` file - Changed `MAIL_ENCRYPTION=null` to `MAIL_ENCRYPTION=tls`
2. ✅ Added error logging to `ContactController.php`
3. ✅ Cleared config cache
4. ✅ Added test route at `/test-mail`

## Testing Steps

### Step 1: Test Basic Mail Configuration
Visit: `http://127.0.0.1:8000/test-mail`

**Expected Results:**
- ✅ Success: "Email sent successfully! Check your inbox."
- ❌ Error: Will show the specific error message

### Step 2: Check Mailtrap Inbox
1. Login to Mailtrap: https://mailtrap.io/
2. Go to your inbox
3. You should see the test email

### Step 3: Test Contact Form
1. Go to: `http://127.0.0.1:8000/#contact`
2. Fill in the form:
   - Name: Test User
   - Phone: 0123456789
   - Email: test@example.com
   - Message: This is a test message
3. Click "إرسال الرسالة"

**Expected Results:**
- ✅ Success message: "تم إرسال رسالتك بنجاح! سنتواصل معك قريباً."
- Form should clear
- Email should appear in Mailtrap inbox

### Step 4: Check Logs (if errors occur)
If you get errors, check:
```bash
tail -f storage/logs/laravel.log
```

## Common Issues & Solutions

### Issue 1: Connection Timeout
**Error**: "Connection could not be established with host smtp.mailtrap.io"
**Solution**: 
- Check if port 587 is blocked by firewall
- Try port 2525 instead in `.env`

### Issue 2: Authentication Failed
**Error**: "Failed to authenticate on SMTP server"
**Solution**:
- Verify Mailtrap credentials are correct
- Get new credentials from Mailtrap dashboard

### Issue 3: TLS/SSL Error
**Error**: "stream_socket_enable_crypto(): SSL operation failed"
**Solution**:
- Change `MAIL_ENCRYPTION=tls` to `MAIL_ENCRYPTION=ssl`
- Or try `MAIL_ENCRYPTION=null` with port 2525

## Using Real Email (Production)

When ready to use real email instead of Mailtrap, update `.env`:

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com  # or your email provider
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-app-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=info@osool1.com
MAIL_FROM_NAME="Asool"
```

**Note**: For Gmail, you need to use an "App Password", not your regular password.

## Remove Test Route

After testing is complete, remove the test route from `routes/web.php`:
```php
// Remove these lines:
Route::get('/test-mail', function () { ... });
```

## Debug Mode

The contact form will show detailed error messages when `APP_DEBUG=true` in `.env`.
For production, set `APP_DEBUG=false` to hide error details from users.
