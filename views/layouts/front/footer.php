<footer class="modern-footer">
    <div class="footer-container">
        <div class="footer-content">
            <div class="footer-column">
                <div class="footer-brand">
                    <h5>Sattınsattın.com</h5>
                    <p>En iyi ürünleri en uygun fiyatlarla sunan online alışveriş platformu.</p>
                </div>
            </div>
            
            <div class="footer-column">
                <h5>Kategoriler</h5>
                <ul class="footer-links">
                    <?php if (!empty($categories->value) && is_array($categories->value)): ?>
                        <?php foreach ($categories->value as $category): ?>
                            <li>
                                <a href="/category/<?php echo htmlspecialchars($category['slug'] ?? ''); ?>">
                                    <i class="<?php echo htmlspecialchars($category['icon'] ?? 'fas fa-tag'); ?>"></i>
                                    <?php echo htmlspecialchars($category['name'] ?? ''); ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <li>Kategori bulunamadı.</li>
                    <?php endif; ?>
                </ul>
            </div>
            
            <div class="footer-column">
                <h5>Kurumsal</h5>
                <ul class="footer-links">
                    <li><a href="/abouts"><i class="fas fa-building"></i> Hakkımızda</a></li>
                    <li><a href="/blog"><i class="fas fa-blog"></i> Blog</a></li>
                    <li><a href="/page/gizlilik-politikasi"><i class="fas fa-shield-alt"></i> Gizlilik Politikası</a></li>
                    <li><a href="/page/mesafeli-satis-sozlemesi"><i class="fas fa-file-contract"></i> Mesafeli Satış Sözleşmesi</a></li>
                    <li><a href="/page/teslimat-ve-iade-sartlari"><i class="fas fa-truck"></i> Teslimat ve İade Şartları</a></li>
                    <li><a href="/page/kvkk-ve-aydinlatma-metni"><i class="fas fa-user-shield"></i> KVKK ve Aydınlatma Metni</a></li>
                </ul>
            </div>
            
            <div class="footer-column">
                <h5>İletişim</h5>
                <div class="contact-info">
                    <div class="contact-item">
                        <i class="fas fa-map-marker-alt"></i>
                        <span>Ankara/Gölbaşı</span>
                    </div>
                    <div class="contact-item">
                        <i class="fas fa-phone"></i>
                        <span>561 61 61 061</span>
                    </div>
                    <div class="contact-item">
                        <i class="fas fa-envelope"></i>
                        <span>iletisim@sattinsattin.com</span>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="footer-bottom">
            <p>&copy; 2025 Sattın Sattın LTD ŞTİ. Tüm hakları saklıdır.</p>
        </div>
    </div>

    <script src="/js/bootstrap.bundle.min.js"></script>
    <script src="/js/scripts.js"></script>

    <style>
        :root {
            --footer-bg: #2c3e50;
            --footer-text: #ecf0f1;
            --footer-text-light: #bdc3c7;
            --footer-accent: #3498db;
            --footer-hover: #34495e;
            --footer-border: #34495e;
        }

        /* Reset footer margins/paddings */
        .modern-footer {
            background: linear-gradient(135deg, var(--footer-bg) 0%, #34495e 100%) !important;
            color: var(--footer-text) !important;
            margin: 0 !important;
            padding: 0 !important;
            position: relative;
            border-top: 1px solid var(--footer-border);
        }

        .footer-container {
            max-width: 1200px;
            margin: 0 auto !important;
            padding: 40px 15px 0 15px !important;
        }

        .footer-content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
            margin-bottom: 30px;
        }

        /* Footer Columns */
        .footer-column {
            padding: 0 !important;
            margin: 0 !important;
        }

        .footer-column h5 {
            color: var(--footer-text) !important;
            font-size: 1.2rem !important;
            font-weight: 600 !important;
            margin: 0 0 15px 0 !important;
            padding: 0 0 8px 0 !important;
            border-bottom: 2px solid var(--footer-accent);
            position: relative;
        }

        /* Brand Section */
        .footer-brand h5 {
            font-size: 1.5rem !important;
            font-weight: 700 !important;
            background: linear-gradient(135deg, var(--footer-text), var(--footer-accent));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .footer-brand p {
            color: var(--footer-text-light) !important;
            line-height: 1.6 !important;
            margin: 10px 0 0 0 !important;
            font-size: 0.95rem !important;
        }

        /* Footer Links */
        .footer-links {
            list-style: none !important;
            padding: 0 !important;
            margin: 0 !important;
        }

        .footer-links li {
            margin-bottom: 8px !important;
        }

        .footer-links a {
            color: var(--footer-text-light) !important;
            text-decoration: none !important;
            font-size: 0.9rem !important;
            display: flex;
            align-items: center;
            padding: 6px 0 !important;
            transition: all 0.3s ease;
            border-radius: 4px;
        }

        .footer-links a:hover {
            color: var(--footer-accent) !important;
            padding-left: 8px !important;
            background-color: rgba(255, 255, 255, 0.05);
        }

        .footer-links a i {
            margin-right: 8px !important;
            width: 16px !important;
            text-align: center !important;
            font-size: 0.85rem !important;
        }

        /* Contact Info */
        .contact-info {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .contact-item {
            display: flex;
            align-items: center;
            color: var(--footer-text-light) !important;
            font-size: 0.9rem !important;
            padding: 8px 0 !important;
            border-radius: 4px;
            transition: all 0.3s ease;
        }

        .contact-item:hover {
            color: var(--footer-accent) !important;
            background-color: rgba(255, 255, 255, 0.05);
            padding-left: 8px !important;
        }

        .contact-item i {
            margin-right: 12px !important;
            width: 18px !important;
            text-align: center !important;
            color: var(--footer-accent) !important;
        }

        /* Footer Bottom */
        .footer-bottom {
            border-top: 1px solid var(--footer-border);
            padding: 20px 0 !important;
            text-align: center;
            margin-top: 20px !important;
        }

        .footer-bottom p {
            color: var(--footer-text-light) !important;
            font-size: 0.85rem !important;
            margin: 0 !important;
            opacity: 0.8;
        }

        /* Responsive Design */
        @media (max-width: 992px) {
            .footer-container {
                padding: 30px 15px 0 15px !important;
            }

            .footer-content {
                grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
                gap: 25px;
                margin-bottom: 25px;
            }

            .footer-column h5 {
                font-size: 1.1rem !important;
            }

            .footer-brand h5 {
                font-size: 1.3rem !important;
            }
        }

        @media (max-width: 768px) {
            .footer-container {
                padding: 25px 15px 0 15px !important;
            }

            .footer-content {
                grid-template-columns: 1fr;
                gap: 20px;
                margin-bottom: 20px;
            }

            .footer-column h5 {
                font-size: 1rem !important;
                margin-bottom: 12px !important;
            }

            .footer-brand h5 {
                font-size: 1.2rem !important;
            }

            .footer-links a,
            .contact-item {
                font-size: 0.85rem !important;
                padding: 5px 0 !important;
            }

            .footer-bottom {
                padding: 15px 0 !important;
            }

            .footer-bottom p {
                font-size: 0.8rem !important;
            }
        }

        @media (max-width: 576px) {
            .footer-container {
                padding: 20px 10px 0 10px !important;
            }

            .footer-content {
                gap: 15px;
                margin-bottom: 15px;
            }

            .contact-item {
                flex-direction: column;
                align-items: flex-start;
            }

            .contact-item i {
                margin-bottom: 4px !important;
            }

            .footer-bottom {
                padding: 12px 0 !important;
            }
        }

        /* Animation for links */
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .footer-links li {
            animation: slideIn 0.3s ease forwards;
        }

        .footer-links li:nth-child(1) { animation-delay: 0.1s; }
        .footer-links li:nth-child(2) { animation-delay: 0.2s; }
        .footer-links li:nth-child(3) { animation-delay: 0.3s; }
        .footer-links li:nth-child(4) { animation-delay: 0.4s; }
        .footer-links li:nth-child(5) { animation-delay: 0.5s; }
        .footer-links li:nth-child(6) { animation-delay: 0.6s; }

        /* Focus states for accessibility */
        .footer-links a:focus,
        .contact-item:focus {
            outline: 2px solid var(--footer-accent);
            outline-offset: 2px;
        }

        /* Print styles */
        @media print {
            .modern-footer {
                background: white !important;
                color: black !important;
            }

            .footer-links a,
            .contact-item {
                color: black !important;
            }
        }

        /* Smooth scroll */
        html {
            scroll-behavior: smooth;
        }

        /* Dark mode support */
        @media (prefers-color-scheme: dark) {
            .modern-footer {
                background: linear-gradient(135deg, #1a252f 0%, #2c3e50 100%) !important;
            }
        }
    </style>
</footer>