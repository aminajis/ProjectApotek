<?php 
include '../includes/header.php'; 
include '../config/database.php'; 

$tgl_sekarang = date('Y-m-d');
$tgl_3_bulan  = date('Y-m-d', strtotime('+3 month'));

$range = $_GET['range'] ?? 'all';

$count_expired = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM inventaris WHERE expired <= '$tgl_sekarang'"));
$count_warning = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM inventaris WHERE expired > '$tgl_sekarang' AND expired <= '$tgl_3_bulan'"));
$count_aman    = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM inventaris WHERE expired > '$tgl_3_bulan'"));
?>

<style>
    .main-wrapper { padding: 30px; background: #f8fafc; min-height: 100vh; font-family: 'Inter', sans-serif; }
    .header-section { display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 25px; }
    .filter-box { background: white; padding: 15px 20px; border-radius: 12px; border: 1px solid #eef2f6; display: flex; align-items: center; gap: 10px; }
    .filter-box select { padding: 8px 12px; border-radius: 8px; border: 1px solid #e2e8f0; font-size: 14px; outline: none; }
    .btn-filter { background: #2B5B7C; color: white; border: none; padding: 8px 20px; border-radius: 8px; font-weight: 600; cursor: pointer; }

    .stats-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; margin-bottom: 30px; }
    .card-stat { background: white; padding: 20px; border-radius: 15px; border-left: 5px solid #2B5B7C; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); display: flex; justify-content: space-between; align-items: center; }
    .stat-val { font-size: 28px; font-weight: 800; color: #1e293b; margin: 0; }
    .stat-label { font-size: 13px; color: #64748b; margin-top: 5px; }

    .status-title { font-size: 15px; font-weight: 700; margin: 30px 0 15px; display: flex; align-items: center; gap: 10px; }
    .table-card { background: white; border-radius: 15px; border: 1px solid #eef2f6; overflow: hidden; margin-bottom: 25px; }
    table { width: 100%; border-collapse: collapse; }
    th { background: #f8fafc; padding: 12px 20px; text-align: left; font-size: 11px; color: #64748b; text-transform: uppercase; border-bottom: 1px solid #eef2f6; }
    td { padding: 15px 20px; font-size: 14px; border-bottom: 1px solid #f8fafc; }

    .dot { width: 10px; height: 10px; border-radius: 50%; display: inline-block; }
    .dot-red { background: #ef4444; box-shadow: 0 0 0 4px rgba(239, 68, 68, 0.1); }
    .dot-yellow { background: #f59e0b; box-shadow: 0 0 0 4px rgba(245, 158, 11, 0.1); }
    .dot-green { background: #10b981; box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.1); }
    
    .badge-date { padding: 6px 12px; border-radius: 20px; font-weight: 600; font-size: 12px; }
    .bg-red { background: #fee2e2; color: #ef4444; }
    .bg-yellow { background: #fef3c7; color: #d97706; }
    .bg-green { background: #f0fdf4; color: #16a34a; }
</style>

<div class="main-wrapper">
    <div class="header-section">
        <div>
            <h1 style="margin:0; font-size: 24px; font-weight: 800; color: #1e293b;">Monitoring Expiry Date</h1>
            <p style="color: #64748b; font-size: 14px; margin: 5px 0 0;">Kelola keamanan obat berdasarkan masa berlaku.</p>
        </div>
        
        <div class="filter-box">
            <form method="GET" style="display: flex; gap: 10px; align-items: center;">
                <span style="font-size: 13px; font-weight: 700;">Filter:</span>
                <select name="range">
                    <option value="all" <?= $range == 'all' ? 'selected' : '' ?>>Semua Status</option>
                    <option value="expired" <?= $range == 'expired' ? 'selected' : '' ?>>Sudah Expired</option>
                    <option value="warning" <?= $range == 'warning' ? 'selected' : '' ?>>Segera Expired (3 Bln)</option>
                </select>
                <button type="submit" class="btn-filter">Terapkan</button>
            </form>
        </div>
    </div>

    <div class="stats-grid">
        <div class="card-stat" style="border-left-color: #ef4444;">
            <div><p class="stat-val"><?= $count_expired ?></p><p class="stat-label">Kedaluwarsa</p></div>
            <span style="font-size: 10px; font-weight: 800; color: #ef4444; background: #fee2e2; padding: 4px 8px; border-radius: 5px;">MENDESAK</span>
        </div>
        <div class="card-stat" style="border-left-color: #f59e0b;">
            <div><p class="stat-val"><?= $count_warning ?></p><p class="stat-label">Segera Expired</p></div>
            <span style="font-size: 10px; font-weight: 800; color: #d97706; background: #fef3c7; padding: 4px 8px; border-radius: 5px;">PERINGATAN</span>
        </div>
        <div class="card-stat" style="border-left-color: #10b981;">
            <div><p class="stat-val"><?= $count_aman ?></p><p class="stat-label">Status Aman</p></div>
            <span style="font-size: 10px; font-weight: 800; color: #16a34a; background: #f0fdf4; padding: 4px 8px; border-radius: 5px;">OPTIMAL</span>
        </div>
    </div>

    <?php if($range == 'all' || $range == 'expired'): ?>
    <div class="status-title" style="color: #ef4444;"><span class="dot dot-red"></span> Status: Kedaluwarsa</div>
    <div class="table-card">
        <table>
            <thead>
                <tr><th>Nama Produk & Batch</th><th>Kategori</th><th>Stok</th><th>Tanggal ED</th><th>Aksi</th></tr>
            </thead>
            <tbody>
                <?php 
                $q1 = mysqli_query($conn, "SELECT * FROM inventaris WHERE expired <= '$tgl_sekarang' ORDER BY expired ASC");
                if(mysqli_num_rows($q1) == 0) echo "<tr><td colspan='5' style='text-align:center; padding:20px; color:#94a3b8;'>Data tidak ditemukan</td></tr>";
                while($r = mysqli_fetch_array($q1)) { ?>
                <tr>
                    <td width="30%"><strong><?= $r['nama_obat'] ?></strong><br><small style="color:#94a3b8"><?= $r['no_batch'] ?></small></td>
                    <td width="20%"><?= $r['kategori'] ?></td>
                    <td width="15%"><?= $r['sisa_stok'] ?> Unit</td>
                    <td width="25%"><span class="badge-date bg-red"><?= date('d M Y', strtotime($r['expired'])) ?></span></td>
                    <td>🗑️</td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <?php endif; ?>

    <?php if($range == 'all' || $range == 'warning'): ?>
    <div class="status-title" style="color: #f59e0b;"><span class="dot dot-yellow"></span> Status: Segera Kedaluwarsa (Dalam 3 Bulan)</div>
    <div class="table-card">
        <table>
            <tbody>
                <?php 
                $q2 = mysqli_query($conn, "SELECT * FROM inventaris WHERE expired > '$tgl_sekarang' AND expired <= '$tgl_3_bulan' ORDER BY expired ASC");
                if(mysqli_num_rows($q2) == 0) echo "<tr><td colspan='5' style='text-align:center; padding:20px; color:#94a3b8;'>Data tidak ditemukan</td></tr>";
                while($r = mysqli_fetch_array($q2)) { ?>
                <tr>
                    <td width="30%"><strong><?= $r['nama_obat'] ?></strong><br><small style="color:#94a3b8"><?= $r['no_batch'] ?></small></td>
                    <td width="20%"><?= $r['kategori'] ?></td>
                    <td width="15%"><?= $r['sisa_stok'] ?> Unit</td>
                    <td width="25%"><span class="badge-date bg-yellow"><?= date('d M Y', strtotime($r['expired'])) ?></span></td>
                    <td>⚡</td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <?php endif; ?>

    <?php if($range == 'all'): ?>
    <div class="status-title" style="color: #10b981;"><span class="dot dot-green"></span> Status: Aman</div>
    <div class="table-card">
        <table>
            <tbody>
                <?php 
                $q3 = mysqli_query($conn, "SELECT * FROM inventaris WHERE expired > '$tgl_3_bulan' ORDER BY expired ASC");
                if(mysqli_num_rows($q3) == 0) echo "<tr><td colspan='5' style='text-align:center; padding:20px; color:#94a3b8;'>Data tidak ditemukan</td></tr>";
                while($r = mysqli_fetch_array($q3)) { ?>
                <tr>
                    <td width="30%"><strong><?= $r['nama_obat'] ?></strong><br><small style="color:#94a3b8"><?= $r['no_batch'] ?></small></td>
                    <td width="20%"><?= $r['kategori'] ?></td>
                    <td width="15%"><?= $r['sisa_stok'] ?> Unit</td>
                    <td width="25%"><span class="badge-date bg-green"><?= date('d M Y', strtotime($r['expired'])) ?></span></td>
                    <td>✅</td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <?php endif; ?>
</div>

<?php include '../includes/footer.php'; ?>