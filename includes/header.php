<?php
$base_url = "http://localhost/ProjectApotek/";
$current_page = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SMART ED - Apotek Bintang Surya</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        body { margin: 0; font-family: 'Inter', sans-serif; background: #f8fafc; overflow-x: hidden; }
        .dashboard-container { display: flex; min-height: 100vh; width: 100%; }
        
        .sidebar { 
            width: 260px; 
            background: white; 
            border-right: 1px solid #e2e8f0; 
            flex-shrink: 0; 
            position: fixed; 
            top: 0; 
            left: 0;
            height: 100vh; 
            display: flex; 
            flex-direction: column; 
            z-index: 1000;
        }


        .main-content { 
            flex: 1; 
            margin-left: 260px; 
            min-width: 0; 
            display: flex; 
            flex-direction: column; 
            background: #f8fafc;
        }

        .nav-item { padding: 12px 25px; margin: 4px 15px; color: #64748b; text-decoration: none; border-radius: 10px; display: flex; align-items: center; gap: 12px; font-weight: 500; transition: 0.3s; }
        .nav-item:hover { background: #f8fafc; color: #2B5B7C; }
        .nav-item.active { background: #f1f5f9; color: #2B5B7C; font-weight: 700; border-left: 4px solid #2B5B7C; border-radius: 4px 10px 10px 4px; }
        
        .top-bar { 
            background: white; 
            padding: 15px 40px; 
            border-bottom: 1px solid #e2e8f0; 
            display: flex; 
            justify-content: space-between; 
            align-items: center; 
            position: sticky;
            top: 0;
            z-index: 999;
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <aside class="sidebar">
            <div style="padding: 30px 25px;">
                <strong style="font-size: 18px; color: #1e293b; display: block;">Apotek Bintang Surya</strong>
                <span style="font-size: 10px; color: #94a3b8; font-weight: 700; letter-spacing: 1px;">SMART ED</span>
            </div>
            
            <nav style="flex: 1;">
    <a href="<?= $base_url; ?>index.php" class="nav-item <?= ($current_page == 'index.php' && !strpos($_SERVER['REQUEST_URI'], 'inventaris') && !strpos($_SERVER['REQUEST_URI'], 'monitoring')) ? 'active' : '' ?>">
        <i class="fa fa-home"></i> Home
    </a>

    <a href="<?= $base_url; ?>inventaris/index.php" class="nav-item <?= (strpos($_SERVER['REQUEST_URI'], 'inventaris')) ? 'active' : '' ?>">
        <i class="fa fa-box"></i> Inventaris
    </a>

    <a href="<?= $base_url; ?>monitoring/index.php" class="nav-item <?= (strpos($_SERVER['REQUEST_URI'], 'monitoring')) ? 'active' : '' ?>">
        <i class="fa fa-clock"></i> Monitoring ED
    </a>

    <a href="#" class="nav-item"><i class="fa fa-file-alt"></i> Laporan</a>
    <a href="#" class="nav-item"><i class="fa fa-cog"></i> Pengaturan</a>
</nav>

            <div style="padding: 20px; border-top: 1px solid #e2e8f0;">
                <a href="<?= $base_url; ?>logout.php" class="nav-item" style="color: #ef4444;"><i class="fa fa-sign-out-alt"></i> Logout</a>
            </div>
        </aside>

        <main class="main-content">
            <header class="top-bar">
                <div style="position: relative;">
                    <i class="fa fa-search" style="position: absolute; left: 15px; top: 13px; color: #94a3b8;"></i>
                    <input type="text" placeholder="Cari obat..." style="padding: 10px 15px 10px 45px; width: 300px; background: #f1f5f9; border: none; border-radius: 8px;">
                </div>
                <div style="display: flex; align-items: center; gap: 15px;">
                    <div style="text-align: right;">
                        <span style="font-weight: 700; font-size: 14px;">admin_ajis01</span>
                    </div>
                    <div style="width: 35px; height: 35px; background: #cbd5e1; border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                         <i class="fa fa-user" style="color: white;"></i>
                    </div>
                </div>
            </header>