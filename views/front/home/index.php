<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ürünler</title>

    <!-- Harici CSS -->
    <link href="/public/css/homepage.css" rel="stylesheet">    
    <link href="../../../public/css/homepage.css" rel="stylesheet">    

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }
        .container {
            width: 100%;
            display: flex;
            justify-content: center;
        }
        .main-content {
            width: 80%;
            display: flex;
            gap: 2rem;
        }
        .sidebar {
            width: 25%;
            background-color: #343a40;
            color: white;
            padding: 15px;
            overflow-y: auto;
            max-height: 100vh;
            scrollbar-width: thin;              
            scrollbar-color: #888 #343a40;   
        }
        .menu {
            list-style: none;
            padding: 0;
        }
        .menu-item > a {
            color: white;
            font-weight: bold;
            text-decoration: none;
        }
        .submenu {
            list-style: none;
            padding-left: 10px;
            margin-top: 5px;
        }
        .submenu li a {
            color: #dcdcdc;
            text-decoration: none;
            font-size: 0.9em;
        }
        .card-grid {
            flex: 1;
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
        }
        .card-container {
            width: calc(33.333% - 1rem);
        }
        .card {
            background-color: white;
            border-radius: 6px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        .card img {
            width: 100%;
            height: auto;
        }
        .card-body {
            padding: 10px;
        }
        .card-body h5 {
            margin: 0 0 10px 0;
        }
        .btn {
            display: inline-block;
            padding: 5px 10px;
            background-color: #343a40;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            font-size: 0.9em;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="main-content">

        <!-- Menü -->
        <div class="sidebar">
            <ul class="menu">
                <?php 
               if(isset($categories->value) && is_array($categories->value)):?>
                <?php foreach($categories->value as $category):?>
                    <li class="menu-item">
                        <a href="/<?php echo htmlspecialchars(strtolower($category['name'])) ?>"><?php echo htmlspecialchars($category['name'] ?? ''); ?></a>
                        <ul class="submenu">
                            <?php if (isset($category['children']) && is_array($category['children'])): ?>
                                <?php foreach ($category['children'] as $subCategory): ?>
                                    <li><a href="/<?php echo htmlspecialchars (strtolower($category['name'])).'/'.htmlspecialchars(strtolower($subCategory['name']))?>" ><?php echo htmlspecialchars($subCategory['name'] ?? ''); ?></a></li>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </ul>
                    </li>
                    <?php endforeach; ?>
                   <?php
                else: ?>
                    <li class="menu-item">Kategori bulunamadı.</li>
                <?php endif; ?>
            </ul>
        </div>

        <!-- Kartlar -->
        <div class="card-grid">
            <?php for ($i = 0; $i < 9; $i++): ?>
                <div class="card-container">
                    <div class="card">
                        <img src="https://via.placeholder.com/300x180" alt="Ürün Görseli">
                        <div class="card-body">
                            <h5>Ürün <?php echo $i + 1; ?></h5>
                            <p>Kısa ürün açıklaması.</p>
                            <a href="#" class="btn">Detay</a>
                        </div>
                    </div>
                </div>
            <?php endfor; ?>
        </div>

    </div>
</div>

</body>
</html>
