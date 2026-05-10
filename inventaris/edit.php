<?php 
include '../includes/header.php'; 
include '../config/database.php'; 

$id = $_GET['id'];
$query = mysqli_query($conn, "SELECT * FROM inventaris WHERE id = '$id'");
$data = mysqli_fetch_array($query);

$nama = $data['nama_obat'];
$kat  = $data['kategori'];
$batch = $data['no_batch'];
$tgl  = $data['expired'];
$stok = $data['sisa_stok'];
$lok  = $data['lokasi'];
$sup  = $data['supplier'];
?>

<style>
    .main-wrapper { padding: 40px; background: #f8fafc; min-height: 100vh; font-family: 'Inter', sans-serif; }
    .form-container { 
        background: white; padding: 40px; border-radius: 24px; 
        border: 1px solid #eef2f6; max-width: 950px; margin: 0 auto;
        box-shadow: 0 10px 25px -5px rgba(0,0,0,0.02);
    }
    .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 25px; }
    .form-group { margin-bottom: 5px; }
    .form-group label { 
        display: block; font-size: 11px; font-weight: 800; color: #1e293b; 
        margin-bottom: 10px; text-transform: uppercase; letter-spacing: 0.5px;
    }
    .form-control { 
        width: 100%; padding: 14px 18px; border-radius: 12px; border: 1px solid #e2e8f0; 
        background: #fcfdfe; font-size: 14px; color: #334155; box-sizing: border-box;
    }
    .form-control:focus { border-color: #2B5B7C; outline: none; box-shadow: 0 0 0 4px rgba(43, 91, 124, 0.08); }
    .button-group { margin-top: 40px; display: flex; justify-content: flex-end; align-items: center; gap: 15px; }
    .btn-save { background: #2B5B7C; color: white; border: none; padding: 14px 35px; border-radius: 12px; font-weight: 700; cursor: pointer; }
    .btn-cancel { color: #64748b; background: #f1f5f9; padding: 14px 25px; border-radius: 12px; text-decoration: none; font-weight: 600; font-size: 14px; }
</style>

<div class="main-wrapper">
    <div style="max-width: 950px; margin: 0 auto 30px;">
        <h1 style="margin:0; font-size: 26px; font-weight: 800; color: #1e293b;">Edit Inventaris Obat</h1>
        <p style="margin:8px 0 0; color: #64748b; font-size: 15px;">Sesuaikan data obat dengan benar untuk pemantauan stok.</p>
    </div>

    <div class="form-container">
        <form action="proses_edit.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $id; ?>">

            <div class="form-grid">
                <div class="form-group">
                    <label>Nama Obat</label>
                    <input type="text" name="nama_obat" class="form-control" value="<?php echo $nama; ?>" required>
                </div>

                <div class="form-group">
                    <label>Kategori</label>
                    <select name="kategori" class="form-control">
                        <option value="Tablet & Kapsul" <?php if($kat == 'Tablet & Kapsul') echo 'selected'; ?>>Tablet & Kapsul</option>
                        <option value="Sirup" <?php if($kat == 'Sirup') echo 'selected'; ?>>Sirup</option>
                        <option value="Alat Kesehatan" <?php if($kat == 'Alat Kesehatan') echo 'selected'; ?>>Alat Kesehatan</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>No Batch</label>
                    <input type="text" name="no_batch" class="form-control" value="<?php echo $batch; ?>" required>
                </div>

                <div class="form-group">
                    <label>Expiry Date</label>
                    <input type="date" name="tgl_kadaluarsa" class="form-control" value="<?php echo $tgl; ?>" required>
                </div>

                <div class="form-group">
                    <label>Jumlah Stok</label>
                    <input type="number" name="sisa_stok" class="form-control" value="<?php echo $stok; ?>" required>
                </div>

                <div class="form-group">
                    <label>Lokasi Penyimpanan</label>
                    <input type="text" name="lokasi" class="form-control" value="<?php echo $lok; ?>">
                </div>

                <div class="form-group" style="grid-column: span 2;">
                    <label>Supplier</label>
                    <input type="text" name="supplier" class="form-control" value="<?php echo $sup; ?>">
                </div>
            </div>

            <div class="button-group">
                <a href="index.php" class="btn-cancel">Batal</a>
                <button type="submit" class="btn-save">Update Data Obat</button>
                
            </div>
        </form>
    </div>
</div>

<?php include '../includes/footer.php'; ?>