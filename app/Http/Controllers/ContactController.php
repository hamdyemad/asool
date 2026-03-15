<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    public function send(Request $request)
    {
        // Validate the form data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'message' => 'required|string|max:1000',
        ], [
            'name.required' => 'الاسم مطلوب',
            'phone.required' => 'رقم الهاتف مطلوب',
            'email.required' => 'البريد الإلكتروني مطلوب',
            'email.email' => 'البريد الإلكتروني غير صحيح',
            'message.required' => 'محتوى الرسالة مطلوب',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $data = $request->only(['name', 'phone', 'email', 'message']);

        try {
            // Send email with proper data passing
            Mail::send('emails.contact', [
                'name' => $data['name'],
                'phone' => $data['phone'],
                'email' => $data['email'],
                'messageContent' => $data['message']  // Renamed to avoid conflict with $message in Mail closure
            ], function ($message) use ($data) {
                $message->to('info@osool1.com')
                    ->subject('رسالة جديدة من موقع أصول الزراعة - ' . $data['name'])
                    ->replyTo($data['email'], $data['name']);
            });

            return response()->json([
                'success' => true,
                'message' => 'تم إرسال رسالتك بنجاح! سنتواصل معك قريباً.'
            ]);

        } catch (\Exception $e) {
            // Log the actual error for debugging
            Log::error('Contact form email error: ' . $e->getMessage(), [
                'exception' => $e,
                'data' => $data
            ]);

            return response()->json([
                'success' => false,
                'message' => 'حدث خطأ أثناء إرسال الرسالة. يرجى المحاولة مرة أخرى.',
                'error' => config('app.debug') ? $e->getMessage() : null
            ], 500);
        }
    }
}
