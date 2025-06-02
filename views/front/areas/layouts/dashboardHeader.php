<?php 



?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sattın Sattın Profilim</title>
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
        }
        
        .header {
            background: linear-gradient(135deg, #ffffff, #f8fafc);
            backdrop-filter: blur(10px);
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1), 0 1px 2px rgba(0, 0, 0, 0.06);
            padding: 0;
            position: sticky;
            top: 0;
            z-index: 1000;
            border-bottom: 1px solid #e5e7eb;
            transition: all 0.3s ease;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 24px;
        }
        
        .header-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 72px;
        }
        
        .logo-container {
            display: flex;
            align-items: center;
        }
        
        .logo {
            font-size: 24px;
            font-weight: 700;
            color: #111827;
            text-decoration: none;
            display: flex;
            align-items: center;
            transition: all 0.3s ease;
        }
        
        .logo:hover {
            transform: translateY(-1px);
        }
        
        /* .logo-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #3b82f6, #1d4ed8);
            border-radius: 10px;
            margin-right: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 18px;
            font-weight: 700;
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
            transition: all 0.3s ease;
        }
        
        .logo:hover .logo-icon {
            transform: scale(1.05);
            box-shadow: 0 6px 16px rgba(59, 130, 246, 0.4);
        } */
        
        .nav-menu {
            display: flex;
            list-style: none;
            gap: 8px;
        }
        
        .nav-item {
            position: relative;
        }
        
        .nav-link {
            display: block;
            padding: 12px 16px;
            color: #6b7280;
            text-decoration: none;
            font-weight: 500;
            font-size: 14px;
            border-radius: 8px;
            transition: all 0.2s ease;
            position: relative;
        }
        
        .nav-link:hover {
            color: #3b82f6;
            background-color: rgba(59, 130, 246, 0.05);
        }
        
        .nav-link.active {
            color: #3b82f6;
            background-color: rgba(59, 130, 246, 0.1);
            font-weight: 600;
        }
        
        .user-actions {
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .search-container {
            position: relative;
            margin-right: 12px;
        }
        
        .search-input {
            padding: 10px 16px 10px 44px;
            border-radius: 12px;
            border: 1px solid #e5e7eb;
            background-color: #f9fafb;
            font-size: 14px;
            color: #1f2937;
            width: 240px;
            transition: all 0.3s ease;
        }
        
        .search-input:focus {
            outline: none;
            border-color: #3b82f6;
            background-color: #ffffff;
            width: 280px;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }
        
        .search-input::placeholder {
            color: #9ca3af;
        }
        
        .search-icon {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #6b7280;
            font-size: 16px;
        }
        
        .action-button {
            background: transparent;
            border: none;
            color: #6b7280;
            width: 40px;
            height: 40px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s ease;
            font-size: 18px;
            position: relative;
        }
        
        .action-button:hover {
            background-color: rgba(59, 130, 246, 0.05);
            color: #3b82f6;
            transform: translateY(-1px);
        }
        
        .notification-badge::after {
            content: '';
            position: absolute;
            top: 8px;
            right: 8px;
            width: 8px;
            height: 8px;
            background: linear-gradient(135deg, #ef4444, #dc2626);
            border-radius: 50%;
            border: 2px solid white;
        }
        
        .user-profile {
            display: flex;
            align-items: center;
            cursor: pointer;
            padding: 6px 12px;
            border-radius: 12px;
            transition: all 0.2s ease;
            margin-left: 8px;
            background-color: rgba(59, 130, 246, 0.05);
            border: 1px solid rgba(59, 130, 246, 0.1);
        }
        
        .user-profile:hover {
            background-color: rgba(59, 130, 246, 0.1);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.15);
        }
        
        .user-avatar {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            background: linear-gradient(135deg, #3b82f6, #1d4ed8);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 14px;
            margin-right: 8px;
            box-shadow: 0 2px 8px rgba(59, 130, 246, 0.3);
        }
        
        .user-name {
            font-weight: 500;
            color: #374151;
            margin-right: 4px;
            font-size: 14px;
        }
        
        .dropdown-icon {
            color: #9ca3af;
            font-size: 14px;
            transition: transform 0.3s ease;
        }
        
        .user-profile:hover .dropdown-icon {
            transform: rotate(180deg);
            color: #3b82f6;
        }
        
        .hamburger-menu {
            display: none;
            flex-direction: column;
            justify-content: space-between;
            width: 24px;
            height: 18px;
            cursor: pointer;
            margin-left: 16px;
        }
        
        .hamburger-menu span {
            display: block;
            height: 2px;
            width: 100%;
            background: linear-gradient(135deg, #3b82f6, #1d4ed8);
            border-radius: 2px;
            transition: all 0.3s ease;
        }
        
        .mobile-search-button {
            display: none;
            background: transparent;
            border: none;
            color: #6b7280;
            width: 40px;
            height: 40px;
            border-radius: 10px;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: 18px;
            transition: all 0.2s ease;
        }
        
        .mobile-search-button:hover {
            background-color: rgba(59, 130, 246, 0.05);
            color: #3b82f6;
        }
        
        /* Header scroll effect */
        .header.scrolled {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.07), 0 1px 3px rgba(0, 0, 0, 0.06);
        }
        
        /* Mobile Styles */
        @media (max-width: 992px) {
            .nav-menu {
                position: fixed;
                top: 72px;
                left: -100%;
                flex-direction: column;
                background: linear-gradient(135deg, #ffffff, #f8fafc);
                backdrop-filter: blur(10px);
                width: 280px;
                height: calc(100vh - 72px);
                box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
                padding: 24px 0;
                transition: all 0.3s ease;
                z-index: 1000;
                border-top: 1px solid #e5e7eb;
                gap: 4px;
            }
            
            .nav-menu.active {
                left: 0;
            }
            
            .nav-item {
                margin: 0 16px;
            }
            
            .nav-link {
                padding: 16px 20px;
                border-radius: 12px;
            }
            
            .nav-link.active {
                background: linear-gradient(135deg, rgba(59, 130, 246, 0.1), rgba(29, 78, 216, 0.1));
                border-left: 4px solid #3b82f6;
                border-radius: 0 12px 12px 0;
            }
            
            .hamburger-menu {
                display: flex;
                order: -1;
            }
            
            .hamburger-menu.active span:nth-child(1) {
                transform: translateY(8px) rotate(45deg);
            }
            
            .hamburger-menu.active span:nth-child(2) {
                opacity: 0;
            }
            
            .hamburger-menu.active span:nth-child(3) {
                transform: translateY(-8px) rotate(-45deg);
            }
            
            .user-name {
                display: none;
            }
            
            .search-container {
                display: none;
                position: absolute;
                top: 72px;
                left: 0;
                right: 0;
                padding: 16px 24px;
                background: linear-gradient(135deg, #ffffff, #f8fafc);
                backdrop-filter: blur(10px);
                z-index: 999;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.07);
                border-top: 1px solid #e5e7eb;
            }
            
            .search-container.active {
                display: block;
                animation: slideDown 0.3s ease;
            }
            
            .search-input {
                width: 100%;
            }
            
            .search-input:focus {
                width: 100%;
            }
            
            .mobile-search-button {
                display: flex;
            }
        }
        
        @media (max-width: 576px) {
            .container {
                padding: 0 16px;
            }
            
            .header-container {
                height: 64px;
            }
            
            .logo {
                font-size: 20px;
            }
            
            .logo-icon {
                width: 36px;
                height: 36px;
                font-size: 16px;
                margin-right: 8px;
            }
            
            .nav-menu {
                top: 64px;
                height: calc(100vh - 64px);
                width: 100%;
                padding: 20px 0;
            }
            
            .search-container {
                top: 64px;
                padding: 12px 16px;
            }
            
            .user-actions {
                gap: 4px;
            }
            
            .action-button {
                width: 36px;
                height: 36px;
                font-size: 16px;
            }
            
            .user-avatar {
                width: 32px;
                height: 32px;
                font-size: 12px;
            }
        }
        
        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        /* Add some content to show the page */
        .page-content {
            padding: 40px 0;
            min-height: calc(100vh - 72px);
        }
        
        .demo-content {
            background: linear-gradient(135deg, #f8fafc, #ffffff);
            border-radius: 16px;
            padding: 40px;
            text-align: center;
            margin: 20px 0;
            border: 1px solid #e5e7eb;
        }
        
        .demo-title {
            font-size: 28px;
            font-weight: 700;
            color: #111827;
            margin-bottom: 16px;
            background: linear-gradient(135deg, #3b82f6, #1d4ed8);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .demo-description {
            color: #6b7280;
            font-size: 16px;
            max-width: 600px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <header class="header" id="header">
        <div class="container">
            <div class="header-container">
                <div class="logo-container">
                    <a href="#" class="logo">
                        <span class="logo-icon"></span>
                        Sattınsattın.com
                    </a>
                </div>
                
                <nav>
                    <ul class="nav-menu" id="navMenu">
                         <li class="nav-item">
                            <a href="/" class="nav-link">Anasayfa</a>
                        </li>
                        <li class="nav-item">
                            <a href="/areas/user/UserDashboard" class="nav-link">Hesap Bilgileri</a>
                        </li>
                        
                        <li class="nav-item">
                            <a href="/areas/user/AddAdvert" class="nav-link">İlan Ver</a>
                        </li>
                    
                        <li class="nav-item">
                            <a href="#" class="nav-link">İletişim</a>
                        </li>
                        
                        <li class="nav-item">
                            <a href="#" class="nav-link">Mesajlar</a>
                        </li>
                    </ul>
                </nav>
                
                <div class="user-actions">
                    
                    <button class="action-button notification-badge">🔔</button>
                    <div class="user-profile">
                        <?php if(isset($userInformation) && $userInformation->username): ?>
                        <div class="user-avatar"> <?php echo strtoupper(substr($userInformation->username,0,1)) ?> </div>
                        <span class="user-name"><?php echo $userInformation->username ?></span>
                        <span class="dropdown-icon">▼</span>
                    </div>
                    <?php endif; ?>
                    <div class="hamburger-menu" id="hamburgerMenu">
                        <span>1</span>
                        <span>2</span>
                        <span>3</span>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <script>
        // DOM Elements
        const hamburgerMenu = document.getElementById('hamburgerMenu');
        const navMenu = document.getElementById('navMenu');
        const mobileSearchButton = document.getElementById('mobileSearchButton');
        const searchContainer = document.getElementById('searchContainer');
        const header = document.getElementById('header');
        
        // Hamburger menu toggle
        hamburgerMenu.addEventListener('click', function() {
            hamburgerMenu.classList.toggle('active');
            navMenu.classList.toggle('active');
            
            // Close search if open
            if (searchContainer.classList.contains('active')) {
                searchContainer.classList.remove('active');
            }
        });
        
        // Mobile search toggle
        mobileSearchButton.addEventListener('click', function() {
            searchContainer.classList.toggle('active');
            
            // Close navigation if open
            if (navMenu.classList.contains('active')) {
                navMenu.classList.remove('active');
                hamburgerMenu.classList.remove('active');
            }
            
            // Focus on search input when opened
            if (searchContainer.classList.contains('active')) {
                setTimeout(() => {
                    const searchInput = searchContainer.querySelector('.search-input');
                    searchInput.focus();
                }, 300);
            }
        });
        
        // Close mobile menu when clicking outside
        document.addEventListener('click', function(event) {
            const isClickInsideNav = navMenu.contains(event.target);
            const isClickInsideHamburger = hamburgerMenu.contains(event.target);
            const isClickInsideSearch = searchContainer.contains(event.target);
            const isClickInsideSearchButton = mobileSearchButton.contains(event.target);
            
            if (!isClickInsideNav && !isClickInsideHamburger && navMenu.classList.contains('active')) {
                navMenu.classList.remove('active');
                hamburgerMenu.classList.remove('active');
            }
            
            if (!isClickInsideSearch && !isClickInsideSearchButton && searchContainer.classList.contains('active')) {
                searchContainer.classList.remove('active');
            }
        });
        
        // Header scroll effect
        let lastScrollTop = 0;
        window.addEventListener('scroll', function() {
            const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
            
            // Add scrolled class for blur effect
            if (scrollTop > 10) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
            
            lastScrollTop = scrollTop;
        });
        
        // Active nav link handling
        const navLinks = document.querySelectorAll('.nav-link');
        navLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                
                // Remove active class from all links
                navLinks.forEach(l => l.classList.remove('active'));
                
                // Add active class to clicked link
                this.classList.add('active');
                
                // Close mobile menu after selection
                if (window.innerWidth <= 992) {
                    navMenu.classList.remove('active');
                    hamburgerMenu.classList.remove('active');
                }
            });
        });
        
        // Search functionality
        const searchInput = document.querySelector('.search-input');
        searchInput.addEventListener('input', function(e) {
            const searchTerm = e.target.value;
            // Implement search functionality here
            console.log('Searching for:', searchTerm);
        });
        
        // Keyboard shortcuts
        document.addEventListener('keydown', function(e) {
            // Escape key to close menus
            if (e.key === 'Escape') {
                if (navMenu.classList.contains('active')) {
                    navMenu.classList.remove('active');
                    hamburgerMenu.classList.remove('active');
                }
                if (searchContainer.classList.contains('active')) {
                    searchContainer.classList.remove('active');
                }
            }
            
            // Ctrl/Cmd + K to focus search
            if ((e.ctrlKey || e.metaKey) && e.key === 'k') {
                e.preventDefault();
                if (window.innerWidth > 992) {
                    searchInput.focus();
                } else {
                    searchContainer.classList.add('active');
                    setTimeout(() => searchInput.focus(), 300);
                }
            }
        });
    </script>
</body>
</html>