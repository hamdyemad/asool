<!-- Contact Section -->
<section class="contact-section" id="contact">
    <div class="contact-header">
        <span class="badge">
            <img src="{{ asset('front/ketatna/Icon (5).png') }}" class="badge-leaf" alt="">
            أصول
        </span>
        <h2>تواصل معنا</h2>
        <p>يسعدنا استقبال استفساراتكم وطلباتكم على مدار الساعة، فريقنا جاهز لدعمك وتقديم أفضل الحلول والخدمات في أسرع وقت ممكن.</p>
    </div>

    <div class="contact-container">
        <!-- Image (RTL so it appears on the Right) -->
        <div class="contact-image-col">
            <img src="{{ asset('front/54ef89689e971d2970cf8121d2d4f800663a5599.jpg') }}" alt="مزرعة أصول">
        </div>

        <!-- Form (Appears on the Left) -->
        <div class="contact-form-col">
            <form id="contactForm">
                @csrf
                <div class="form-group custom-input">
                    <input type="text" name="name" id="name" placeholder="الاسم" required>
                    <span class="input-icon"><i class="fas fa-user" style="color: #0c6a3a;"></i></span>
                </div>
                <div class="form-group custom-input">
                    <input type="tel" name="phone" id="phone" placeholder="الهاتف" required>
                    <span class="input-icon"><i class="fas fa-phone-alt" style="color: #0c6a3a;"></i></span>
                </div>
                <div class="form-group custom-input">
                    <input type="email" name="email" id="email" placeholder="البريد الالكتروني" required>
                    <span class="input-icon"><i class="fas fa-envelope" style="color: #0c6a3a;"></i></span>
                </div>
                <div class="form-group custom-input">
                    <textarea name="message" id="message" rows="5" placeholder="محتوى الرسالة" required></textarea>
                </div>
                
                <!-- Success Message -->
                <div id="successMessage" style="display: none; padding: 15px; background: #d4edda; color: #155724; border-radius: 8px; margin-bottom: 15px; border: 1px solid #c3e6cb;">
                    <i class="fas fa-check-circle"></i> <span id="successText"></span>
                </div>
                
                <!-- Error Message -->
                <div id="errorMessage" style="display: none; padding: 15px; background: #f8d7da; color: #721c24; border-radius: 8px; margin-bottom: 15px; border: 1px solid #f5c6cb;">
                    <i class="fas fa-exclamation-circle"></i> <span id="errorText"></span>
                </div>
                
                <button type="submit" id="submitBtn" class="submit-btn" style="background:#8fc945; color: white;">
                    <span class="submit-icon" style="transform: scaleX(-1); display:inline-block;"><i class="far fa-paper-plane"></i></span>
                    <span id="btnText">ارسال</span>
                </button>
            </form>
        </div>
    </div>
    <div class="grass-bottom"></div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const contactForm = document.getElementById('contactForm');
    
    if (contactForm) {
        contactForm.addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const form = this;
            const submitBtn = document.getElementById('submitBtn');
            const btnText = document.getElementById('btnText');
            const successMessage = document.getElementById('successMessage');
            const errorMessage = document.getElementById('errorMessage');
            const successText = document.getElementById('successText');
            const errorText = document.getElementById('errorText');
            
            // Hide previous messages
            successMessage.style.display = 'none';
            errorMessage.style.display = 'none';
            
            // Disable button and show loading
            submitBtn.disabled = true;
            btnText.textContent = 'جاري الإرسال...';
            submitBtn.style.opacity = '0.7';
            
            // Get form data
            const formData = new FormData(form);
            
            try {
                const response = await fetch('{{ route("contact.send") }}', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    }
                });
                
                const data = await response.json();
                
                if (data.success) {
                    // Show success message
                    successText.textContent = data.message;
                    successMessage.style.display = 'block';
                    
                    // Reset form
                    form.reset();
                    
                    // Scroll to message
                    successMessage.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    
                    // Hide success message after 5 seconds
                    setTimeout(() => {
                        successMessage.style.display = 'none';
                    }, 5000);
                } else {
                    // Show error message
                    if (data.errors) {
                        const errors = Object.values(data.errors).flat();
                        errorText.textContent = errors.join(', ');
                    } else {
                        errorText.textContent = data.message || 'حدث خطأ أثناء إرسال الرسالة';
                    }
                    errorMessage.style.display = 'block';
                    
                    // Scroll to message
                    errorMessage.scrollIntoView({ behavior: 'smooth', block: 'center' });
                }
            } catch (error) {
                console.error('Error:', error);
                errorText.textContent = 'حدث خطأ في الاتصال. يرجى المحاولة مرة أخرى.';
                errorMessage.style.display = 'block';
            } finally {
                // Re-enable button
                submitBtn.disabled = false;
                btnText.textContent = 'ارسال';
                submitBtn.style.opacity = '1';
            }
        });
    }
});
</script>
