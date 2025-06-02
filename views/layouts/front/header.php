<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sattın Sattın v1.0 </title>
    <!-- <?php echo $settings['site_title']; ?> -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="/css/styles.css">
</head>

<body>

    <div class="text-center" id="loading">
    </div>
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm box-shadow: 12px 21px 8px rgba(0, 0, 0, 0.1);">
        <div class="container">

            <a class="navbar-brand" href="/" style="line-height: 0.7; margin-top: 10px;">
                 <span style="font-weight:bold;">Sattınsattın.com</span><br><br>
                <small style="font-size: 0.5em;">Satmazsan satarlar.</small>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link active text-decoration-none" aria-current="page" href="/"><i class="fas fa-home"></i> Anasayfa</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-decoration-none" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-th-list"></i> Kategoriler
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <?php if (!empty($categories->value) && is_array($categories->value)): ?>
                                <?php foreach ($categories->value as $category): ?>
                                    <li>
                                        <a class="dropdown-item text-decoration-none" href="/category/<?php echo htmlspecialchars($category['slug'] ?? ''); ?>">
                                            <?php echo htmlspecialchars($category['name'] ?? ''); ?>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <li>Kategori bulunamadı.</li>
                            <?php endif; ?>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-decoration-none" href="/abouts"><i class="fas fa-building"></i> Kurumsal</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-decoration-none" href="/blog"><i class="fas fa-blog"></i> Blog</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-decoration-none" href="/contact"><i class="fas fa-envelope"></i> İletişim</a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <?php if (isset($session['user_id'])): ?>
                            <?php if ($cartItemCount > 0): ?>
                                <a class="nav-link text-decoration-none" href="/cart"><i class="fas fa-shopping-cart"></i> Sepetim (<?php echo $cartItemCount; ?>)</a>
                            <?php else: ?>
                                <a class="nav-link text-decoration-none" href="/cart"><i class="fas fa-shopping-cart"></i> Sepet Boş</a>
                            <?php endif; ?>
                        <?php else: ?>
                            <a class="nav-link text-decoration-none" href="/cart"><i class="fas fa-shopping-cart"></i> Sepet Boş</a>
                        <?php endif; ?>
                    </li>
                    
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <?php
                        $username =  $_SESSION['username'];
                        ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-decoration-none" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user"></i> <?php echo $username ?>
                            </a>
                            <?php if (isset($_SESSION['role_id']) && $_SESSION['role_id'] === 1): ?>
                                <ul class="dropdown-menu" aria-labelledby="userDropdown">
                                <li><a class="dropdown-item text-decoration-none" href="/customer"><i class="fas fa-cog"></i> Yönetim Paneli</a></li>
                                <li><a class="dropdown-item text-decoration-none" href="auth/login"><i class="fas fa-sign-out-alt"></i> Çıkış Yap</a></li>
                                </ul>
                                <?php else:?>
                            <ul class="dropdown-menu" aria-labelledby="userDropdown">
                                <li><a class="dropdown-item text-decoration-none" href="/areas/user/UserDashboard"><i class="fas fa-user"></i> Profil</a></li>
                                <li><a class="dropdown-item text-decoration-none" href="/order"><i class="fas fa-receipt"></i> Siparişlerim</a></li>
                                <li><a class="dropdown-item text-decoration-none" href="/cart"><i class="fas fa-shopping-cart"></i> Sepetim</a></li>
                                <li><a class="dropdown-item text-decoration-none" href="auth/login"><i class="fas fa-sign-out-alt"></i> Çıkış Yap</a></li>
                            </ul>
                        <?php endif; ?>
                        </li>
                    <?php else: ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-decoration-none" href="#" id="loginDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user"></i> Giriş Yap
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="loginDropdown">
                                <li><a class="dropdown-item text-decoration-none" href="auth/login"><i class="fas fa-sign-in-alt"></i> Giriş Yap</a></li>
                                <li><a class="dropdown-item text-decoration-none" href="auth/register"><i class="fas fa-user-plus"></i> Üye Ol</a></li>
                                <li><a class="dropdown-item text-decoration-none" href="/cart"><i class="fas fa-shopping-cart"></i> Sepetim</a></li>
                            </ul>


                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
</body>