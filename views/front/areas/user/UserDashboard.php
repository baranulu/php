<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
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
        
        .header {
            background: linear-gradient(135deg, #ffffff, #f8fafc);
            backdrop-filter: blur(10px);
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1), 0 1px 2px rgba(0, 0, 0, 0.06);
            padding: 20px 0;
            position: sticky;
            top: 0;
            z-index: 100;
            border-bottom: 1px solid #e5e7eb;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 24px;
        }
        
        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .logo {
            font-size: 24px;
            font-weight: 700;
            background: linear-gradient(135deg, #3b82f6, #1d4ed8);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .user-profile {
            display: flex;
            align-items: center;
            cursor: pointer;
            padding: 8px 16px;
            border-radius: 12px;
            transition: all 0.2s ease;
            background-color: rgba(59, 130, 246, 0.05);
            border: 1px solid rgba(59, 130, 246, 0.1);
        }
        
        .user-profile:hover {
            background-color: rgba(59, 130, 246, 0.1);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.15);
        }
        
        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            background: linear-gradient(135deg, #3b82f6, #1d4ed8);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            margin-right: 12px;
            box-shadow: 0 2px 8px rgba(59, 130, 246, 0.3);
        }
        
        .main-content {
            max-width: 1200px;
            margin: 40px auto;
            padding: 0 24px;
        }
        
        .dashboard-card {
            background: #ffffff;
            border-radius: 16px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1), 0 1px 2px rgba(0, 0, 0, 0.06);
            border: 1px solid #f3f4f6;
            overflow: hidden;
            transition: all 0.3s ease;
        }
        
        .dashboard-card:hover {
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08), 0 4px 6px rgba(0, 0, 0, 0.04);
        }
        
        .dashboard-header {
            padding: 24px 32px;
            border-bottom: 1px solid #f3f4f6;
            background: linear-gradient(135deg, #fafbff, #f8fafc);
        }
        
        .dashboard-header h1 {
            font-size: 24px;
            font-weight: 700;
            color: #111827;
            background: linear-gradient(135deg, #3b82f6, #1d4ed8);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .tabs {
            display: flex;
            border-bottom: 1px solid #f3f4f6;
            background: linear-gradient(135deg, #fafbff, #f8fafc);
            padding: 0 20px;
        }
        
        .tab-button {
            padding: 16px 24px;
            background: none;
            border: none;
            border-bottom: 2px solid transparent;
            font-size: 14px;
            font-weight: 500;
            color: #6b7280;
            cursor: pointer;
            transition: all 0.2s ease;
            margin: 0 4px;
            border-radius: 8px 8px 0 0;
            position: relative;
        }
        
        .tab-button:hover {
            color: #3b82f6;
            background-color: rgba(59, 130, 246, 0.05);
        }
        
        .tab-button.active {
            color: #3b82f6;
            border-bottom-color: #3b82f6;
            font-weight: 600;
            background-color: rgba(59, 130, 246, 0.1);
        }
        
        .tab-content {
            padding: 32px;
        }
        
        .tab-pane {
            display: none;
        }
        
        .tab-pane.active {
            display: block;
            animation: fadeIn 0.3s ease-in-out;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .section-title {
            font-size: 20px;
            margin-bottom: 24px;
            color: #111827;
            font-weight: 600;
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
        
        .info-table {
            width: 100%;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            border: 1px solid #f3f4f6;
        }
        
        .info-table .row {
            display: flex;
            border-bottom: 1px solid #f3f4f6;
        }
        
        .info-table .row:last-child {
            border-bottom: none;
        }
        
        .info-table .row:nth-child(odd) {
            background: linear-gradient(135deg, #fafbff, #f8fafc);
        }
        
        .info-table .label {
            width: 30%;
            padding: 16px 20px;
            font-weight: 500;
            color: #374151;
            background-color: rgba(59, 130, 246, 0.02);
        }
        
        .info-table .value {
            width: 70%;
            padding: 16px 20px;
            color: #1f2937;
        }
        
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #3b82f6, #1d4ed8);
            color: white;
            padding: 12px 20px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            border: none;
            cursor: pointer;
            transition: all 0.2s ease;
            box-shadow: 0 2px 4px rgba(59, 130, 246, 0.2);
            min-width: 120px;
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
        
        .mt-4 {
            margin-top: 24px;
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }
        
        .listing-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 24px;
        }
        
        .listing-card {
            border: 1px solid #f3f4f6;
            border-radius: 12px;
            overflow: hidden;
            transition: all 0.3s ease;
            background: #ffffff;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }
        
        .listing-card:hover {
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
            transform: translateY(-4px);
        }
        
        .listing-image {
            height: 200px;
            background: linear-gradient(135deg, #f3f4f6, #e5e7eb);
            position: relative;
            overflow: hidden;
        }
        
        .listing-details {
            padding: 20px;
        }
        
        .listing-title {
            font-weight: 600;
            margin-bottom: 8px;
            color: #111827;
            font-size: 16px;
        }
        
        .listing-location {
            color: #6b7280;
            font-size: 14px;
            display: flex;
            align-items: center;
        }
        
        .listing-location:before {
            content: "📍";
            margin-right: 6px;
            font-size: 14px;
        }
        
        .listing-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 16px;
            padding-top: 16px;
            border-top: 1px solid #f3f4f6;
        }
        
        .listing-price {
            font-weight: 700;
            font-size: 18px;
            color: #111827;
        }
        
        .listing-status {
            font-size: 12px;
            padding: 6px 12px;
            border-radius: 20px;
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
            font-weight: 500;
        }
        
        .listing-actions {
            display: flex;
            gap: 8px;
            margin-top: 16px;
        }
        
        .listing-actions .btn {
            flex: 1;
            min-width: auto;
            font-size: 13px;
            padding: 10px 16px;
        }
        
        .history-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            border: 1px solid #f3f4f6;
        }
        
        .history-table th {
            text-align: left;
            padding: 16px;
            background: linear-gradient(135deg, #fafbff, #f8fafc);
            font-weight: 600;
            color: #374151;
            text-transform: uppercase;
            font-size: 12px;
            letter-spacing: 0.5px;
            border-bottom: 2px solid #f3f4f6;
        }
        
        .history-table td {
            padding: 16px;
            border-bottom: 1px solid #f3f4f6;
            color: #1f2937;
        }
        
        .history-table tr:last-child td {
            border-bottom: none;
        }
        
        .history-table tr:hover {
            background: linear-gradient(135deg, #fafbff, #f8fafc);
        }
        
        .history-table tr:nth-child(even) {
            background-color: rgba(59, 130, 246, 0.01);
        }
        
        .status-badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
        }
        
        .status-completed {
            background: linear-gradient(135deg, #dcfce7, #bbf7d0);
            color: #16a34a;
        }
        
        .status-expired {
            background: linear-gradient(135deg, #fef3c7, #fde68a);
            color: #d97706;
        }
        
        .status-canceled {
            background: linear-gradient(135deg, #fecaca, #fca5a5);
            color: #dc2626;
        }
        
        /* Empty state styles */
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #6b7280;
        }
        
        .empty-state h3 {
            font-size: 18px;
            margin-bottom: 8px;
            color: #374151;
        }
        
        .empty-state p {
            font-size: 14px;
            margin-bottom: 24px;
        }
        
        /* Mobile Styles */
        @media (max-width: 768px) {
            .container {
                padding: 0 16px;
            }
            
            .main-content {
                padding: 0 16px;
                margin: 20px auto;
            }
            
            .dashboard-header {
                padding: 20px;
            }
            
            .tab-content {
                padding: 24px 20px;
            }
            
            .tabs {
                flex-wrap: wrap;
                padding: 0;
            }
            
            .tab-button {
                padding: 12px 16px;
                margin: 0;
                flex-grow: 1;
                text-align: center;
                font-size: 13px;
            }
            
            .info-table .row {
                flex-direction: column;
            }
            
            .info-table .label,
            .info-table .value {
                width: 100%;
                padding: 12px 16px;
            }
            
            .info-table .label {
                background: linear-gradient(135deg, #fafbff, #f8fafc);
                border-bottom: 1px solid #f3f4f6;
                font-weight: 600;
            }
            
            .listing-grid {
                grid-template-columns: 1fr;
            }
            
            .history-table {
                display: block;
                overflow-x: auto;
                white-space: nowrap;
            }
            
            .mt-4 {
                flex-direction: column;
            }
            
            .btn {
                width: 100%;
                text-align: center;
                margin-bottom: 8px;
            }
            
            .listing-actions {
                flex-direction: column;
            }
            
            .listing-actions .btn {
                width: 100%;
            }
        }
        
        @media (max-width: 480px) {
            .dashboard-header h1 {
                font-size: 20px;
            }
            
            .section-title {
                font-size: 18px;
            }
            
            .listing-image {
                height: 160px;
            }
            
            .listing-details {
                padding: 16px;
            }
        }
    </style>
</head>
<body>
    <main class="main-content">
        <div class="dashboard-card">
            <div class="dashboard-header">
                <h1>Hesap Detayları</h1>
            </div>
            
            <div class="tabs">
                <button class="tab-button active" onclick="openTab(event, 'hesap')">Hesap bilgilerim</button>
                <button class="tab-button" onclick="openTab(event, 'aktif')">Aktif ilanlarım</button>
                <button class="tab-button" onclick="openTab(event, 'gecmis')">Geçmiş ilanlar</button>
                <button class="tab-button" onclick="openTab(event, 'arsiv')">Arşiv ilanlar</button>
            </div>
            
            <div class="tab-content">
                <div id="hesap" class="tab-pane active">
                    <h2 class="section-title">Hesap Bilgilerim</h2>
                    <?php if(isset($userInformation)):?>
                    <div class="info-table">
                        <div class="row">
                            <div class="label">Kullanıcı adı</div>
                            <div class="value"><?php echo htmlspecialchars($userInformation->username) ?></div>
                        </div>
                        <div class="row">
                            <div class="label">Ad</div>
                            <div class="value"><?php echo htmlspecialchars($userInformation->name) ?></div>
                        </div>
                        <div class="row">
                            <div class="label">Soyad</div>
                            <div class="value"><?php echo htmlspecialchars($userInformation->surname) ?></div>
                        </div>
                        <div class="row">
                            <div class="label">Email</div>
                            <div class="value"><?php echo htmlspecialchars($userInformation->email) ?></div>
                        </div>
                        <div class="row">
                            <div class="label">Telefon Numarası</div>
                            <div class="value"><?php echo htmlspecialchars($userInformation->phone) ?></div>
                        </div>
                        <div class="row">
                            <div class="label">Hesap oluşturulma tarihi</div>
                            <div class="value"><?php echo htmlspecialchars($userInformation->created_at) ?></div>
                        </div>
                    </div>
                    <div class="mt-4">
                        <a href="/areas/user/UpdateUserInformation" class="btn">Bilgilerimi Güncelle</a>      
                        <button class="btn btn-outline">Şifremi Değiştir</button>
                    </div>
                    <?php else: ?>
                    <div class="empty-state">
                        <h3>Kullanıcı bilgileri bulunamadı</h3>
                        <p>Hesap bilgilerinizi görüntülemek için lütfen tekrar giriş yapın.</p>
                    </div>
                    <?php endif; ?>
                </div>
               
                <div id="aktif" class="tab-pane">
                    <h2 class="section-title">Aktif İlanlarım</h2>
                    <div class="listing-grid">
                        <div class="listing-card">
                            <div class="listing-image"></div>
                            <div class="listing-details">
                                <h3 class="listing-title">İlan Başlığı #1</h3>
                                <p class="listing-location">Ankara, Çankaya</p>
                                <div class="listing-footer">
                                    <span class="listing-price">₺5,400</span>
                                    <span class="listing-status">Aktif</span>
                                </div>
                                <div class="listing-actions">
                                    <button class="btn">Düzenle</button>
                                    <button class="btn btn-outline">Arşivle</button>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
                <div id="gecmis" class="tab-pane">
                    <h2 class="section-title">Geçmiş İlanlar</h2>
                    <table class="history-table">
                        <thead>
                            <tr>
                                <th>İlan No</th>
                                <th>Başlık</th>
                                <th>Fiyat</th>
                                <th>Tarih</th>
                                <th>Durum</th>
                                <th>İşlem</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>#12345</td>
                                <td>Satılık Daire</td>
                                <td>₺750,000</td>
                                <td>15.04.2025</td>
                                <td><span class="status-badge status-completed">Tamamlandı</span></td>
                                <td><button class="btn btn-outline">Detay</button></td>
                            </tr>
                            <tr>
                                <td>#12346</td>
                                <td>Kiralık Ofis</td>
                                <td>₺8,500</td>
                                <td>03.03.2025</td>
                                <td><span class="status-badge status-expired">Süresi Doldu</span></td>
                                <td><button class="btn btn-outline">Detay</button></td>
                            </tr>
                            <tr>
                                <td>#12347</td>
                                <td>Satılık Araba</td>
                                <td>₺385,000</td>
                                <td>28.02.2025</td>
                                <td><span class="status-badge status-canceled">İptal Edildi</span></td>
                                <td><button class="btn btn-outline">Detay</button></td>
                            </tr>
                            <tr>
                                <td>#12348</td>
                                <td>Kiralık Daire</td>
                                <td>₺5,200</td>
                                <td>12.02.2025</td>
                                <td><span class="status-badge status-completed">Tamamlandı</span></td>
                                <td><button class="btn btn-outline">Detay</button></td>
                            </tr>
                            <tr>
                                <td>#12349</td>
                                <td>İkinci El Laptop</td>
                                <td>₺8,750</td>
                                <td>05.01.2025</td>
                                <td><span class="status-badge status-completed">Tamamlandı</span></td>
                                <td><button class="btn btn-outline">Detay</button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                
                <!-- Arşiv İlanlar Tab -->
                <div id="arsiv" class="tab-pane">
                    <h2 class="section-title">Arşiv İlanlar</h2>
                    <table class="history-table">
                        <thead>
                            <tr>
                                <th>İlan No</th>
                                <th>Başlık</th>
                                <th>Fiyat</th>
                                <th>Arşiv Tarihi</th>
                                <th>İşlem</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>#12350</td>
                                <td>Fotoğraf Makinesi</td>
                                <td>₺12,500</td>
                                <td>20.04.2025</td>
                                <td>
                                    <button class="btn">Aktive Et</button>
                                    <button class="btn btn-outline">Sil</button>
                                </td>
                            </tr>
                            <tr>
                                <td>#12351</td>
                                <td>Yazlık Daire</td>
                                <td>₺1,450,000</td>
                                <td>10.04.2025</td>
                                <td>
                                    <button class="btn">Aktive Et</button>
                                    <button class="btn btn-outline">Sil</button>
                                </td>
                            </tr>
                            <tr>
                                <td>#12352</td>
                                <td>Elektrikli Bisiklet</td>
                                <td>₺18,900</td>
                                <td>05.04.2025</td>
                                <td>
                                    <button class="btn">Aktive Et</button>
                                    <button class="btn btn-outline">Sil</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <script>
        function openTab(evt, tabId) {
            // Tüm tab içeriklerini gizle
            var tabPanes = document.getElementsByClassName("tab-pane");
            for (var i = 0; i < tabPanes.length; i++) {
                tabPanes[i].classList.remove("active");
            }
            
            // Tüm tabları pasif yap
            var tabButtons = document.getElementsByClassName("tab-button");
            for (var i = 0; i < tabButtons.length; i++) {
                tabButtons[i].classList.remove("active");
            }
            
            // Seçili tabı ve içeriğini aktif yap
            document.getElementById(tabId).classList.add("active");
            evt.currentTarget.classList.add("active");
        }
        
        // Enhanced interactions
        document.addEventListener('DOMContentLoaded', function() {
            // Add hover effects to listing cards
            const listingCards = document.querySelectorAll('.listing-card');
            listingCards.forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-4px)';
                });
                
                card.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
                });
            });
            
            // Add loading states to buttons
            const buttons = document.querySelectorAll('.btn');
            buttons.forEach(button => {
                button.addEventListener('click', function() {
                    if (!this.classList.contains('btn-outline')) {
                        const originalText = this.textContent;
                        this.textContent = 'İşleniyor...';
                        this.disabled = true;
                        
                        // Simulate loading (remove in production)
                        setTimeout(() => {
                            this.textContent = originalText;
                            this.disabled = false;
                        }, 1000);
                    }
                });
            });
        });
    </script>
</body>
</html>