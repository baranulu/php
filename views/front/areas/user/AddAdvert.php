<?php

$selectedCategoryId = 0;

?>

<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>İlan Ekle - Aşama 1/3</title>
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
            margin: 0 auto;
            padding: 40px 20px;
        }

        .page-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .page-title {
            font-size: 32px;
            font-weight: 700;
            color: #111827;
            margin-bottom: 12px;
            background: linear-gradient(135deg, #3b82f6, #1d4ed8);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .page-description {
            color: #6b7280;
            font-size: 16px;
            font-weight: 400;
        }

        /* Step Indicator */
        .step-indicator {
            display: flex;
            justify-content: space-between;
            margin-bottom: 48px;
            position: relative;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        .step-indicator::before {
            content: '';
            position: absolute;
            top: 20px;
            left: 0;
            right: 0;
            height: 2px;
            background: linear-gradient(to right, #e5e7eb, #e5e7eb);
            z-index: 1;
        }

        .step {
            display: flex;
            flex-direction: column;
            align-items: center;
            position: relative;
            z-index: 2;
            background: white;
            padding: 0 12px;
        }

        .step-number {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, #f3f4f6, #e5e7eb);
            color: #9ca3af;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 12px;
            font-weight: 600;
            font-size: 16px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border: 2px solid #e5e7eb;
        }

        .step-title {
            font-size: 14px;
            color: #9ca3af;
            text-align: center;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .step.active .step-number {
            background: linear-gradient(135deg, #3b82f6, #1d4ed8);
            color: white;
            border-color: #3b82f6;
            transform: scale(1.1);
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
        }

        .step.active .step-title {
            color: #3b82f6;
            font-weight: 600;
        }

        .step.completed .step-number {
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
            border-color: #10b981;
        }

        .step.completed .step-title {
            color: #10b981;
            font-weight: 600;
        }

        /* Main Card */
        .listing-card {
            background: #ffffff;
            border-radius: 16px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1), 0 1px 2px rgba(0, 0, 0, 0.06);
            border: 1px solid #f3f4f6;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .listing-card:hover {
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
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 24px;
            margin-bottom: 24px;
        }

        .form-group {
            margin-bottom: 24px;
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

        .form-input,
        .form-select,
        .form-textarea {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 14px;
            color: #1f2937;
            background-color: #ffffff;
            transition: all 0.2s ease;
        }

        .form-input:focus,
        .form-select:focus,
        .form-textarea:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
            background-color: #fefefe;
        }

        .form-input::placeholder,
        .form-textarea::placeholder {
            color: #9ca3af;
        }

        .form-textarea {
            min-height: 120px;
            resize: vertical;
        }

        .form-hint {
            display: block;
            margin-top: 6px;
            font-size: 12px;
            color: #6b7280;
        }

        .required-field::after {
            content: "*";
            color: #ef4444;
            margin-left: 4px;
        }

        .price-input-group {
            position: relative;
        }

        .price-input-group .form-input {
            padding-left: 40px;
        }

        .price-symbol {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #6b7280;
            font-weight: 500;
        }

        /* Form Actions */
        .form-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 32px;
            padding-top: 24px;
            border-top: 1px solid #f3f4f6;
        }

        .form-actions-right {
            display: flex;
            gap: 12px;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 12px 24px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
            border: none;
            cursor: pointer;
            transition: all 0.2s ease;
            text-decoration: none;
            min-width: 120px;
        }

        .btn:hover {
            transform: translateY(-1px);
        }

        .btn:active {
            transform: translateY(0);
        }

        .btn-primary {
            background: linear-gradient(135deg, #3b82f6, #1d4ed8);
            color: white;
            box-shadow: 0 2px 4px rgba(59, 130, 246, 0.2);
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #2563eb, #1e40af);
            box-shadow: 0 4px 8px rgba(59, 130, 246, 0.3);
        }

        .btn-outline {
            background: transparent;
            border: 1px solid #d1d5db;
            color: #6b7280;
        }

        .btn-outline:hover {
            background: #f9fafb;
            border-color: #9ca3af;
            color: #374151;
        }

        /* Alert Messages */
        .alert {
            padding: 16px;
            margin-bottom: 24px;
            border-radius: 8px;
            font-size: 14px;
            border: 1px solid;
        }

        .alert-danger {
            background: linear-gradient(135deg, #fef2f2, #fee2e2);
            border-color: #fecaca;
            color: #dc2626;
        }

        .alert-success {
            background: linear-gradient(135deg, #f0fdf4, #dcfce7);
            border-color: #bbf7d0;
            color: #16a34a;
        }

        /* Tab Content */
        .tab-content {
            display: none;
            animation: fadeIn 0.3s ease;
        }

        .tab-content.active {
            display: block;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .container {
                padding: 20px 16px;
            }

            .page-title {
                font-size: 24px;
            }

            .form-row {
                grid-template-columns: 1fr;
                gap: 16px;
            }

            .form-content {
                padding: 24px 20px;
            }

            .card-header {
                padding: 20px;
            }

            .form-actions {
                flex-direction: column;
                gap: 16px;
            }

            .form-actions-right {
                width: 100%;
                justify-content: space-between;
            }

            .btn {
                min-width: 100px;
                padding: 10px 16px;
            }

            .step-title {
                font-size: 12px;
            }

            .step-indicator {
                margin-bottom: 32px;
            }
        }

        @media (max-width: 480px) {
            .step {
                padding: 0 8px;
            }

            .step-number {
                width: 32px;
                height: 32px;
                font-size: 14px;
            }

            .step-title {
                font-size: 11px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="page-header">
            <h1 class="page-title">Yeni İlan Ekle</h1>
            <p class="page-description">İlanınızı oluşturmak için adımları takip edin.</p>
        </div>

        <!-- Hata mesajları için yer tutucu -->
        <div id="alert-container"></div>

        <!-- Aşama Göstergesi -->
        <div class="step-indicator">
            <div class="step active" data-step="1">
                <div class="step-number">1</div>
                <div class="step-title">Kategori Seçimi</div>
            </div>
            <div class="step" data-step="2">
                <div class="step-number">2</div>
                <div class="step-title">Marka & Model</div>
            </div>
            <div class="step" data-step="3">
                <div class="step-number">3</div>
                <div class="step-title">İlan Detayları</div>
            </div>
        </div>

        <div class="listing-card">
            <div class="card-header">
                <h2 class="card-title" id="step-title">Kategori Seçimi</h2>
            </div>

            <div class="form-content">
                <form id="listingForm" method="POST">
                    <input type="hidden" name="step" id="current-step" value="1">
                    <!-- Aşama 1: Kategori ve Alt Kategori Seçimi -->
                    <div id="step-1-content" class="tab-content active">
                        <div class="form-row">
                            <div class="form-group">
                                <!-- <?php print_r($data['categories']); ?> -->

                                <label for="category_id" class="form-label required-field">Kategori</label>
                                <select id="category_id" name="category_id" class="form-select" required>
                                    <option>Kategori Seçiniz</option>
                                    <?php if (isset($data['categories'])): ?>

                                        <? foreach ($data['categories'] as $category) { ?>
                                            <option value="<? echo $category['id'] ?>"><? echo $category['name'] ?> </option>

                                        <?php } ?>


                                    <?php endif; ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="subcategory_id" class="form-label required-field">Alt Kategori</label>
                                <select id="subcategory_id" name="subcategory_id" class="form-select" required>
                                    <option value="">Önce kategori seçin</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Aşama 2: Marka ve Model Seçimi -->
                    <div id="step-2-content" class="tab-content">
                        <div class="form-row">
                            <div class="form-group">
                                <label for="brand_id" class="form-label required-field">Marka</label>
                                <select id="brand_id" name="brand_id" class="form-select" required>
                                    <option value="">Marka seçin</option>

                                </select>
                            </div>

                            <div class="form-group">
                                <label for="model_id" class="form-label required-field">Model</label>
                                <select id="model_id" name="model_id" class="form-select" required>
                                    <option value="">Önce marka seçin</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Aşama 3: İlan Detayları -->
                    <div id="step-3-content" class="tab-content">
                        <div class="form-group">
                            <label for="title" class="form-label required-field">İlan Başlığı</label>
                            <input type="text" id="title" name="title" class="form-input" placeholder="İlan başlığını girin" required>
                            <span class="form-hint">Başlık en az 10, en fazla 100 karakter olmalı</span>
                        </div>

                        <div class="form-group">
                            <label for="description" class="form-label required-field">İlan Açıklaması</label>
                            <textarea id="description" name="description" class="form-textarea" placeholder="İlanınız hakkında detaylı bilgi verin" required></textarea>
                            <span class="form-hint">Ürün özellikleri, durumu, garantisi gibi önemli detayları belirtin</span>
                        </div>

                        <div class="form-group">
                            <label for="budget" class="form-label required-field">Bütçe Tutarı</label>
                            <div class="price-input-group">
                                <span class="price-symbol">₺</span>
                                <input type="number" id="budget" name="budget" class="form-input" placeholder="0.00" step="0.01" min="0" required>
                            </div>
                        </div>
                    </div>

                    <!-- Form Butonları -->
                    <div class="form-actions">
                        <div>
                            <button type="button" class="btn btn-outline" id="prevStepBtn" style="display: none;">← Geri</button>
                            <a href="/dashboard" class="btn btn-outline" id="cancelBtn">İptal</a>
                        </div>

                        <div class="form-actions-right">
                            <button type="button" class="btn btn-primary" id="nextStepBtn">Devam Et →</button>
                            <button type="submit" class="btn btn-primary" id="submitBtn" style="display: none;">İlanı Yayınla</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        const categoryData = <?php echo json_encode($data['categories']); ?>



        // Form elementleri
        const listingForm = document.getElementById('listingForm');
        const nextStepBtn = document.getElementById('nextStepBtn');
        const prevStepBtn = document.getElementById('prevStepBtn');
        const submitBtn = document.getElementById('submitBtn');
        const cancelBtn = document.getElementById('cancelBtn');
        const currentStepInput = document.getElementById('current-step');
        const stepTitle = document.getElementById('step-title');
        const alertContainer = document.getElementById('alert-container');

        // İlişkili alanlar
        const categorySelect = document.getElementById('category_id');
        const subcategorySelect = document.getElementById('subcategory_id');
        const brandSelect = document.getElementById('brand_id');
        const modelSelect = document.getElementById('model_id');

        // Tüm sekme içerikleri
        const tabContents = document.querySelectorAll('.tab-content');

        // Adım göstergeleri
        const stepIndicators = document.querySelectorAll('.step');

        // Mevcut adım
        let currentStep = 1;


        nextStepBtn.addEventListener('click', function() {
            if (validateCurrentStep()) {
                goToNextStep();
            }
        });

        prevStepBtn.addEventListener('click', function() {
            goToPrevStep();
        });

        categorySelect.addEventListener('change', function() {
            updateSubcategories();
        });

        subcategorySelect.addEventListener('change', function() {
            goToNextStep();
        });

        brandSelect.addEventListener('change', function() {
            updateModels();
        });

        // Functions
        function validateCurrentStep() {
            let isValid = true;

            if (currentStep === 1) {
                if (!categorySelect.value) {
                    showError('Lütfen bir kategori seçin.');
                    isValid = false;
                } else if (!subcategorySelect.value) {
                    showError('Lütfen bir alt kategori seçin.');
                    isValid = false;
                }
            } else if (currentStep === 2) {
                if (!brandSelect.value) {
                    showError('Lütfen bir marka seçin.');
                    isValid = false;
                } else if (!modelSelect.value) {
                    showError('Lütfen bir model seçin.');
                    isValid = false;
                }
            } else if (currentStep === 3) {
                const title = document.getElementById('title').value;
                const description = document.getElementById('description').value;
                const budget = document.getElementById('budget').value;

                if (!title || title.length < 10 || title.length > 100) {
                    showError('Başlık en az 10, en fazla 100 karakter olmalıdır.');
                    isValid = false;
                } else if (!description || description.length < 20) {
                    showError('Açıklama en az 20 karakter olmalıdır.');
                    isValid = false;
                } else if (!budget || parseFloat(budget) <= 0) {
                    showError('Geçerli bir bütçe tutarı girilmelidir.');
                    isValid = false;
                }
            }

            return isValid;
        }

        function goToNextStep() {
            if (currentStep < 3) {
                currentStep++;
                updateStepUI();

                if (currentStep === 2) {
                    updateBrands();
                }
            }
        }

        function goToPrevStep() {
            if (currentStep > 1) {
                currentStep--;
                updateStepUI();
            }
        }

        function updateStepUI() {
            // Adım başlığını güncelle
            const titles = {
                1: 'Kategori Seçimi',
                2: 'Marka ve Model Seçimi',
                3: 'İlan Detayları'
            };
            stepTitle.textContent = titles[currentStep];

            // Adım göstergelerini güncelle
            stepIndicators.forEach(step => {
                const stepNumber = parseInt(step.getAttribute('data-step'));
                step.classList.remove('active', 'completed');

                if (stepNumber === currentStep) {
                    step.classList.add('active');
                } else if (stepNumber < currentStep) {
                    step.classList.add('completed');
                    step.querySelector('.step-number').textContent = '✓';
                } else {
                    step.querySelector('.step-number').textContent = stepNumber;
                }
            });

            // Sekme içeriklerini güncelle
            tabContents.forEach(content => {
                content.classList.remove('active');
            });
            document.getElementById(`step-${currentStep}-content`).classList.add('active');

            // Butonları güncelle
            prevStepBtn.style.display = currentStep === 1 ? 'none' : 'inline-block';
            cancelBtn.style.display = currentStep === 1 ? 'inline-block' : 'none';
            nextStepBtn.style.display = currentStep === 3 ? 'none' : 'inline-block';
            submitBtn.style.display = currentStep === 3 ? 'inline-block' : 'none';

            // Hidden input'u güncelle
            currentStepInput.value = currentStep;

            // Hata mesajını temizle
            clearErrors();
        }

        function updateSubcategories() {
            const categoryId = categorySelect.value;
            subcategorySelect.innerHTML = '<option value="">Alt kategori seçin</option>';

            if (!categoryId) return;

            const subsOfSelectedCategory = categoryData.find(x => x.id == categoryId).children;

            subsOfSelectedCategory.forEach(subcategory => {
                const option = document.createElement('option');
                option.value = subcategory.id;
                option.textContent = subcategory.name;
                subcategorySelect.appendChild(option);
            });
        }

function updateBrands() {
    const subcategoryId = subcategorySelect?.value?.trim();
    if (!subcategoryId || isNaN(subcategoryId)) {
        console.warn("Geçersiz subcategoryId:", subcategoryId);
        return;
    }

    const url = `/areas/user/api/getBrandAndProductsBySubCategoryId?subCatId=${encodeURIComponent(subcategoryId)}`;
    console.log("İstek URL:", url);

    fetch(url)
        .then(res => {
            console.log("🔍 Status:", res.status);
            console.log("🔍 Headers:", res.headers.get('content-type'));
            console.log("🔍 Response OK:", res.ok);
            
            // ÖNCE TEXT OLARAK AL
            return res.text();
        })
        .then(text => {
            console.log("📝 RAW RESPONSE:");
            console.log(text);
            console.log("📝 Response Length:", text.length);
            console.log("📝 First 100 chars:", text.substring(0, 100));
            console.log("📝 Last 100 chars:", text.substring(text.length - 100));
            
            // MANUEL PARSE ET
            try {
                const data = JSON.parse(text);
                console.log("✅ BAŞARILI PARSE:", data);
                
                if (!data.success) {
                    console.warn("API başarısız:", data.message);
                    return;
                }
                
                console.log("Markalar:", data.data);
                
            } catch (parseError) {
                console.error("❌ JSON PARSE HATASI:", parseError);
                console.log("🔍 Parse edilmeye çalışılan text:", text);
            }
        })
        .catch(err => {
            console.error("💥 FETCH HATASI:", err);
        });
}



        function updateModels() {
            const brandId = brandSelect.value;
            modelSelect.innerHTML = '<option value="">Model seçin</option>';

            if (!brandId) return;

            const modelList = models[brandId] || [];
            modelList.forEach(model => {
                const option = document.createElement('option');
                option.value = model.id;
                option.textContent = model.name;
                modelSelect.appendChild(option);
            });
        }

        function showError(message) {
            clearErrors();
            const alertDiv = document.createElement('div');
            alertDiv.className = 'alert alert-danger';
            alertDiv.textContent = message;
            alertContainer.appendChild(alertDiv);
        }

        function clearErrors() {
            alertContainer.innerHTML = '';
        }

        // Form submit
        listingForm.addEventListener('submit', function(e) {
            if (currentStep !== 3 || !validateCurrentStep()) {
                e.preventDefault();
            }
        });
    </script>
</body>

</html>