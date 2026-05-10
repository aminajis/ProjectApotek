<?php 
include '../includes/header.php'; 
include '../config/database.php'; 

$stats_total = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(sisa_stok) as total FROM inventaris"));
$total_item = $stats_total['total'] ?? 0; 

$stok_menipis = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM inventaris WHERE sisa_stok <= 10"));
$tgl_3_bulan = date('Y-m-d', strtotime('+3 month'));
$mendekati_ed = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM inventaris WHERE expired <= '$tgl_3_bulan'"));
$update_terakhir = date("H:i");

$query = mysqli_query($conn, "SELECT * FROM inventaris ORDER BY nama_obat ASC");
?>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
    :root { --primary: #2B5B7C; --bg-light: #f8fafc; --border-color: #e2e8f0; --text-main: #1e293b; --text-muted: #64748b; }
    .main-wrapper { padding: 30px; background: var(--bg-light); min-height: 100vh; font-family: 'Inter', sans-serif; }
    .page-header { display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 25px; }
    .btn-tambah { background: var(--primary); color: white; text-decoration: none; padding: 10px 20px; border-radius: 8px; font-weight: 600; font-size: 14px; display: flex; align-items: center; gap: 8px; }
    .stats-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; margin-bottom: 30px; }
    .stat-card { background: white; padding: 20px; border-radius: 16px; border: 1px solid var(--border-color); border-left: 5px solid #cbd5e1; }
    .stat-card.blue { border-left-color: #3b82f6; }
    .stat-card.red { border-left-color: #ef4444; }
    .stat-card.orange { border-left-color: #f59e0b; }
    .stat-card.green { border-left-color: #10b981; }
    .stat-label { font-size: 11px; font-weight: 800; color: var(--text-muted); text-transform: uppercase; margin-bottom: 8px; }
    .stat-value { font-size: 24px; font-weight: 800; color: var(--text-main); }
    .stat-unit { font-size: 14px; color: var(--text-muted); font-weight: 400; }
    .content-card { background: white; border-radius: 16px; border: 1px solid var(--border-color); overflow: hidden; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); }
    .table-header { display: grid; grid-template-columns: 2.5fr 1.5fr 1fr 1fr 1fr 0.8fr; background: #f8fafc; padding: 15px 25px; border-bottom: 1px solid var(--border-color); font-size: 11px; font-weight: 800; color: var(--text-muted); text-transform: uppercase; }
    .table-row { display: grid; grid-template-columns: 2.5fr 1.5fr 1fr 1fr 1fr 0.8fr; padding: 15px 25px; align-items: center; border-bottom: 1px solid #f1f5f9; transition: 0.2s; }
    .pill { padding: 4px 12px; border-radius: 20px; font-size: 11px; font-weight: 700; background: #f1f5f9; color: var(--text-muted); }
    .btn-action { width: 32px; height: 32px; border-radius: 8px; display: inline-flex; align-items: center; justify-content: center; text-decoration: none; }
</style>

<div class="main-wrapper">
    <?php if(isset($_GET['pesan'])): ?>
        <script>
            const pesan = "<?= $_GET['pesan'] ?>";
            if(pesan === "tambah_berhasil") Swal.fire('Berhasil!', 'Data obat ditambahkan.', 'success');
            if(pesan === "update_berhasil") Swal.fire('Berhasil!', 'Data obat diperbarui.', 'success');
            if(pesan === "hapus_berhasil") Swal.fire('Terhapus!', 'Data obat telah dihapus.', 'success');
        </script>
    <?php endif; ?>

    <div class="page-header">
        <div>
            <h1 style="margin:0; font-size: 26px; font-weight: 800; color: var(--text-main);">Inventaris Obat</h1>
            <p style="margin:5px 0 0; color: var(--text-muted); font-size: 14px;">Kelola stok obat, pantau masa berlaku, dan organisasi penyimpanan.</p>
        </div>
        <a href="tambah.php" class="btn-tambah">Tambah Obat Baru</a>
    </div>

    <div class="stats-grid">
        <div class="stat-card blue"><div class="stat-label">Total Stok</div><div class="stat-value"><?= number_format($total_item); ?> <span class="stat-unit">Unit</span></div></div>
        <div class="stat-card red"><div class="stat-label">Stok Menipis</div><div class="stat-value" style="color:#ef4444;"><?= $stok_menipis; ?> <span class="stat-unit">Item</span></div></div>
        <div class="stat-card orange"><div class="stat-label">Mendekati ED</div><div class="stat-value" style="color:#f59e0b;"><?= $mendekati_ed; ?> <span class="stat-unit">Item</span></div></div>
        <div class="stat-card green"><div class="stat-label">Update</div><div class="stat-value"><?= $update_terakhir; ?> <span class="stat-unit">WIB</span></div></div>
    </div>

    <div class="content-card">
        <div class="table-header">
            <div>Nama Obat & Sediaan</div><div>No Batch</div><div>Stok</div><div>Lokasi</div><div>Supplier</div><div style="text-align: right;">Aksi</div>
        </div>

        <?php while($row = mysqli_fetch_array($query)) { ?>
        <div class="table-row">
            <div style="display: flex; align-items: center; gap: 12px;">
                <div style="font-weight: 700; color: var(--text-main); font-size: 14px;">
                    <?= $row['nama_obat']; ?><br>
                    <small style="font-weight:400; color:var(--text-muted)"><?= $row['kategori']; ?></small>
                </div>
            </div>
            <div style="font-family: monospace; color: var(--text-muted);"><?= $row['no_batch']; ?></div>
            <div style="font-weight: 700;"><?= $row['sisa_stok']; ?> <span style="font-size: 12px; color: var(--text-muted);">Unit</span></div>
            
            <div><span class="pill"><?= !empty($row['lokasi']) ? $row['lokasi'] : 'Belum Atur'; ?></span></div>
            
            <div style="color: var(--text-muted); font-size: 13px;"><?= !empty($row['supplier']) ? $row['supplier'] : '-'; ?></div>

            <div style="text-align: right;">
                <a href="edit.php?id=<?= $row['id']; ?>" style="color:#64748b; margin-right:10px;">✎</a>
                <a href="hapus.php?id=<?= $row['id']; ?>" onclick="return confirm('Hapus data?')" style="color:#ef4444;">🗑</a>
            </div>
        </div>
        <?php } ?>
    </div>
</div>

<?php include '../includes/footer.php'; ?>