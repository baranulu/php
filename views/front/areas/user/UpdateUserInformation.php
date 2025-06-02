<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kullanıcı Bilgilerini Güncelle</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        }
        
        body {
            background-color: #ffffff;
            color: #1f2937;
            line-height: 1.6;
            min-height: 100vh;
        }
        
        .container {
            max-width: 1000px;
            margin: 40px auto;
            padding: 0 24px;
        }
        
        .page-header {
            margin-bottom: 32px;
        }
        
        .page-title {
            font-size: 28px;
            font-weight: 700;
            color: #111827;
            margin-bottom: 8px;
            background: linear-gradient(135deg, #3b82f6, #1d4ed8);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .page-description {
            color: #6b7280;
            font-size: 16px;
        }
        
        .update-card {
            background: #ffffff;
            border-radius: 16px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1), 0 1px 2px rgba(0, 0, 0, 0.06);
            border: 1px solid #f3f4f6;
            overflow: hidden;
            transition: all 0.3s ease;
        }
        
        .update-card:hover {
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08), 0 4px 6px rgba(0, 0, 0, 0.04);
        }
        
        .card-header {
            padding: 24px 32px;
            border-bottom: 1px solid #f3f4f6;
            background: linear-gradient(135deg, #fafbff, #f8fafc);
        }
        
        .card-title {
            font-size: 20px;
            font-weight: 600;
            color: #111827;
        }
        
        .form-content {
            padding: 32px;
        }
        
        .form-row {
            margin-bottom: 24px;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-group:last-child {
            margin-bottom: 0;
        }
        
        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #374151;
            font-size: 14px;
        }
        
        .form-input {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 14px;
            color: #1f2937;
            background-color: #ffffff;
            transition: all 0.2s ease;
        }
        
        .form-input:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
            background-color: #ffffff;
        }
        
        .form-input::placeholder {
            color: #9ca3af;
        }
        
        .form-input:disabled {
            background-color: #f9fafb;
            color: #9ca3af;
            cursor: not-allowed;
        }
        
        textarea.form-input {
            min-height: 100px;
            resize: vertical;
        }
        
        .form-hint {
            display: block;
            margin-top: 6px;
            font-size: 12px;
            color: #6b7280;
        }
        
        .form-row {
            display: flex;
            flex-wrap: wrap;
            margin-left: -12px;
            margin-right: -12px;
        }
        
        .form-col {
            flex: 1;
            padding-left: 12px;
            padding-right: 12px;
            min-width: 200px;
        }
        
        .form-section {
            margin-bottom: 32px;
            padding-bottom: 24px;
            border-bottom: 1px solid #f3f4f6;
        }
        
        .form-section:last-child {
            margin-bottom: 0;
            padding-bottom: 0;
            border-bottom: none;
        }
        
        .section-title {
            font-size: 18px;
            font-weight: 600;
            color: #111827;
            margin-bottom: 20px;
            padding-bottom: 12px;
            border-bottom: 2px solid #f3f4f6;
            position: relative;
        }
        
        .section-title::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 60px;
            height: 2px;
            background: linear-gradient(135deg, #3b82f6, #1d4ed8);
            border-radius: 1px;
        }
        
        .form-actions {
            display: flex;
            justify-content: flex-end;
            margin-top: 32px;
            gap: 12px;
        }
        
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #3b82f6, #1d4ed8);
            color: white;
            padding: 12px 24px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            border: none;
            cursor: pointer;
            transition: all 0.2s ease;
            box-shadow: 0 2px 4px rgba(59, 130, 246, 0.2);
            min-width: 140px;
        }
        
        .btn:hover {
            background: linear-gradient(135deg, #2563eb, #1e40af);
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(59, 130, 246, 0.3);
        }
        
        .btn-outline {
            background: transparent;
            border: 1px solid #d1d5db;
            color: #6b7280;
            box-shadow: none;
        }
        
        .btn-outline:hover {
            background: #f9fafb;
            border-color: #9ca3af;
            color: #374151;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }
        
        .profile-image-container {
            display: flex;
            align-items: center;
            margin-bottom: 24px;
            padding: 20px;
            background: linear-gradient(135deg, #fafbff, #f8fafc);
            border-radius: 12px;
            border: 1px solid #f3f4f6;
        }
        
        .profile-image {
            width: 100px;
            height: 100px;
            border-radius: 12px;
            background: linear-gradient(135deg, #f3f4f6, #e5e7eb);
            margin-right: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 36px;
            color: #9ca3af;
            overflow: hidden;
            position: relative;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }
        
        .profile-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .profile-image-placeholder {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            height: 100%;
        }
        
        .profile-image-actions {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }
        
        .file-upload-container {
            position: relative;
        }
        
        .file-upload-input {
            position: absolute;
            left: -9999px;
        }
        
        .file-upload-label {
            display: inline-block;
            padding: 10px 16px;
            background: #ffffff;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            color: #374151;
            cursor: pointer;
            transition: all 0.2s ease;
            font-size: 14px;
            text-align: center;
            font-weight: 500;
        }
        
        .file-upload-label:hover {
            background: #f9fafb;
            border-color: #9ca3af;
            color: #1f2937;
        }
        
        .remove-image-btn {
            background: none;
            border: none;
            color: #ef4444;
            text-decoration: underline;
            cursor: pointer;
            font-size: 14px;
            padding: 0;
            text-align: left;
            font-weight: 500;
        }
        
        .remove-image-btn:hover {
            color: #dc2626;
        }
        
        .checkbox-container {
            display: flex;
            align-items: center;
            margin-bottom: 12px;
            padding: 12px 16px;
            background: #f9fafb;
            border-radius: 8px;
            border: 1px solid #f3f4f6;
            transition: all 0.2s ease;
        }
        
        .checkbox-container:hover {
            background: #f3f4f6;
        }
        
        .checkbox-input {
            margin-right: 12px;
            cursor: pointer;
            width: 18px;
            height: 18px;
            accent-color: #3b82f6;
        }
        
        .checkbox-label {
            cursor: pointer;
            user-select: none;
            font-size: 14px;
            color: #374151;
        }
        
        .password-toggle {
            position: relative;
        }
        
        .password-toggle .form-input {
            padding-right: 44px;
        }
        
        .toggle-password {
            position: absolute;
            top: 50%;
            right: 12px;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #6b7280;
            cursor: pointer;
            font-size: 16px;
            padding: 4px;
            border-radius: 4px;
            transition: all 0.2s ease;
        }
        
        .toggle-password:hover {
            color: #3b82f6;
            background: rgba(59, 130, 246, 0.1);
        }
        
        .toggle-password:focus {
            outline: none;
        }
        
        .required-field::after {
            content: "*";
            color: #ef4444;
            margin-left: 4px;
        }
        
        .form-error {
            color: #ef4444;
            font-size: 12px;
            margin-top: 6px;
            display: none;
            font-weight: 500;
        }
        
        .form-input.error {
            border-color: #ef4444;
            box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1);
        }
        
        .form-input.error + .form-error {
            display: block;
        }
        
        .success-message {
            background: linear-gradient(135deg, #dcfce7, #bbf7d0);
            color: #16a34a;
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
            font-weight: 500;
            border: 1px solid #bbf7d0;
        }
        
        .error-message {
            background: linear-gradient(135deg, #fecaca, #fca5a5);
            color: #dc2626;
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
            font-weight: 500;
            border: 1px solid #fca5a5;
        }
        
        /* Mobile Styles */
        @media (max-width: 768px) {
            .container {
                padding: 0 16px;
                margin: 20px auto;
            }
            
            .card-header {
                padding: 20px;
            }
            
            .form-content {
                padding: 24px 20px;
            }
            
            .form-row {
                flex-direction: column;
                margin-left: 0;
                margin-right: 0;
            }
            
            .form-col {
                min-width: 100%;
                margin-bottom: 16px;
                padding-left: 0;
                padding-right: 0;
            }
            
            .form-col:last-child {
                margin-bottom: 0;
            }
            
            .form-actions {
                flex-direction: column;
            }
            
            .btn {
                width: 100%;
                margin-bottom: 8px;
                text-align: center;
            }
            
            .profile-image-container {
                flex-direction: column;
                align-items: center;
                text-align: center;
                padding: 20px;
            }
            
            .profile-image {
                margin-right: 0;
                margin-bottom: 16px;
            }
            
            .profile-image-actions {
                align-items: center;
                width: 100%;
            }
            
            .file-upload-label {
                width: 100%;
            }
            
            .remove-image-btn {
                text-align: center;
            }
        }
        
        @media (max-width: 480px) {
            .page-title {
                font-size: 24px;
            }
            
            .section-title {
                font-size: 16px;
            }
            
            .profile-image {
                width: 80px;
                height: 80px;
                font-size: 28px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="page-header">
            <h1 class="page-title">Hesap Bilgilerimi Güncelle</h1>
            <p class="page-description">Kişisel bilgilerinizi düzenleyebilir ve hesap ayarlarınızı güncelleyebilirsiniz.</p>
        </div>
        
        <div class="update-card">
            <div class="card-header">
                <h2 class="card-title">Profil Bilgileri</h2>
            </div>
            
            <div class="form-content">
                <form id="updateProfileForm" method="POST">

                    <!-- Kişisel Bilgiler Bölümü -->    
                    <div class="form-section">
                        <h3 class="section-title">Kişisel Bilgiler</h3>
                        
                        <div class="form-row">
                            <div class="form-col">
                                <div class="form-group">
                                    <label for="username" class="form-label required-field">Kullanıcı Adı</label>
                                    <input type="text" id="username" name="username" class="form-input" value="<? echo $userInformation->username?>" required>
                                    <span class="form-error">Kullanıcı adı gereklidir.</span>
                                </div>
                            </div>
                            
                            <div class="form-col">
                                <div class="form-group">
                                    <label for="email" class="form-label required-field">E-posta Adresi</label>
                                    <input type="email" id="email" name="email" class="form-input" value="<? echo $userInformation->email?>" required>
                                    <span class="form-error">Geçerli bir e-posta adresi giriniz.</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-col">
                                <div class="form-group">
                                    <label for="name" class="form-label required-field">Ad</label>
                                    <input type="text" id="name" name="name" class="form-input" value="<? echo $userInformation->name?>" required>
                                    <span class="form-error">Ad alanı gereklidir.</span>
                                </div>
                            </div>
                            
                            <div class="form-col">
                                <div class="form-group">
                                    <label for="surname" class="form-label required-field">Soyad</label>
                                    <input type="text" id="surname" name="surname" class="form-input" value="<? echo $userInformation->surname?>" required>
                                    <span class="form-error">Soyad alanı gereklidir.</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-col">
                                <div class="form-group">
                                    <label for="phone" class="form-label">Telefon</label>
                                    <input type="tel" id="phone" name="phone" class="form-input" value="<? echo $userInformation->phone?>" placeholder="Örn: 555 123 4567">
                                    <span class="form-hint">İlanlarınızda görünecek iletişim numaranız</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Bildirim Tercihleri Bölümü -->
                    <!-- <div class="form-section">
                        <h3 class="section-title">Bildirim Tercihleri</h3>
                        
                        <div class="checkbox-container">
                            <input type="checkbox" id="emailNotifications" name="emailNotifications" class="checkbox-input" checked>
                            <label for="emailNotifications" class="checkbox-label">E-posta bildirimleri almak istiyorum</label>
                        </div>
                        
                        <div class="checkbox-container">
                            <input type="checkbox" id="smsNotifications" name="smsNotifications" class="checkbox-input" checked>
                            <label for="smsNotifications" class="checkbox-label">SMS bildirimleri almak istiyorum</label>
                        </div>
                        
                        <div class="checkbox-container">
                            <input type="checkbox" id="marketingEmails" name="marketingEmails" class="checkbox-input">
                            <label for="marketingEmails" class="checkbox-label">Pazarlama amaçlı e-postalar almak istiyorum</label>
                        </div>
                    </div> -->
                    
                    <!-- Form Butonları -->
                    <div class="form-actions">
                        <a class="btn btn-outline" href="/areas/user/UserDashboard">İptal</a>
                        <button type="submit" class="btn">Değişiklikleri Kaydet</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <script>
        // Şifre değiştirme alanlarını gösterme/gizleme
        const changePasswordCheckbox = document.getElementById('changePassword');
        const passwordFields = document.getElementById('passwordFields');
        
        if (changePasswordCheckbox && passwordFields) {
            const passwordInputs = passwordFields.querySelectorAll('input[type="password"]');
            
            changePasswordCheckbox.addEventListener('change', function() {
                if (this.checked) {
                    passwordFields.style.display = 'block';
                    passwordInputs.forEach(input => {
                        input.disabled = false;
                        input.required = true;
                    });
                } else {
                    passwordFields.style.display = 'none';
                    passwordInputs.forEach(input => {
                        input.disabled = true;
                        input.required = false;
                    });
                }
            });
        }
        
        // Şifre görünürlük toggle
        function togglePasswordVisibility(inputId) {
            const input = document.getElementById(inputId);
            if (input.type === 'password') {
                input.type = 'text';
            } else {
                input.type = 'password';
            }
        }
        
        // Profil resmi yükleme önizlemesi
        const profileImageInput = document.getElementById('profileImage');
        const profileImageContainer = document.querySelector('.profile-image');
        const profileImagePlaceholder = document.querySelector('.profile-image-placeholder');
        const removeImageBtn = document.querySelector('.remove-image-btn');
        
        if (profileImageInput && profileImageContainer) {
            profileImageInput.addEventListener('change', function(e) {
                if (e.target.files && e.target.files[0]) {
                    const reader = new FileReader();
                    
                    reader.onload = function(e) {
                        // Placeholder'ı kaldır
                        if (profileImagePlaceholder) {
                            profileImagePlaceholder.style.display = 'none';
                        }
                        
                        // Mevcut bir resim varsa kaldır
                        const existingImg = profileImageContainer.querySelector('img');
                        if (existingImg) {
                            existingImg.remove();
                        }
                        
                        // Yeni resmi ekle
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        profileImageContainer.appendChild(img);
                    }
                    
                    reader.readAsDataURL(e.target.files[0]);
                }
            });
        }
        
        // Resmi kaldır butonu
        if (removeImageBtn && profileImageContainer) {
            removeImageBtn.addEventListener('click', function() {
                const img = profileImageContainer.querySelector('img');
                if (img) {
                    img.remove();
                }
                
                // Placeholder'ı göster
                if (profileImagePlaceholder) {
                    profileImagePlaceholder.style.display = 'flex';
                }
                
                // Input değerini sıfırla
                if (profileImageInput) {
                    profileImageInput.value = '';
                }
            });
        }
        
        // Form gönderimi
        document.getElementById('updateProfileForm').addEventListener('submit', function(e) {

            // e.preventDefault();
            
            // Basit form doğrulama
            let isValid = true;
            const requiredInputs = this.querySelectorAll('input[required]:not([disabled])');
            
            requiredInputs.forEach(input => {
                if (input.value.trim() === '') {
                    input.classList.add('error');
                    isValid = false;
                } else {
                    input.classList.remove('error');
                }
            });
            
            // Email doğrulama
            const emailInput = document.getElementById('email');
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (emailInput.value && !emailRegex.test(emailInput.value)) {
                emailInput.classList.add('error');
                isValid = false;
            }
            
            // Şifre eşleşme kontrolü
            // if (changePasswordCheckbox.checked) {
            //     const newPassword = document.getElementById('newPassword');
            //     const confirmPassword = document.getElementById('confirmPassword');
                
            //     if (newPassword.value !== confirmPassword.value) {
            //         confirmPassword.classList.add('error');
            //         isValid = false;
            //         // Şifre hatası için özel mesaj
            //         const errorMsg = confirmPassword.nextElementSibling || document.createElement('span');
            //         errorMsg.className = 'form-error';
            //         errorMsg.textContent = 'Şifreler eşleşmiyor.';
            //         errorMsg.style.display = 'block';
                    
            //         if (!confirmPassword.nextElementSibling) {
            //             confirmPassword.parentNode.appendChild(errorMsg);
            //         }
            //     }
            // }
            
            // if (isValid) {
            //     // Form geçerliyse burada form submit işlemi yapılabilir
            //     alert('Form başarıyla gönderildi! Gerçek bir uygulamada burada form verileri sunucuya gönderilir.');
            //     // window.location.href = 'dashboard.html'; // Başarılı submit sonrası yönlendirme
            // } else {
            //     // Hata durumunda sayfa tepesine kaydır
            //     window.scrollTo({ top: 0, behavior: 'smooth' });
            // }
        });
    </script>
</body>
</html>