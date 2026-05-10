<?php 
include 'includes/header.php'; 
include 'config/database.php'; 

$query_total = mysqli_query($conn, "SELECT id FROM inventaris");
$total_obat  = mysqli_num_rows($query_total);

$hampir_ed  = 42; 
$stok_habis = 8;
?>

<div class="content-wrapper" style="padding: 30px; background: #f8fafc; min-height: 100vh;">
    
    <div style="margin-bottom: 30px;">
        <h2 style="margin: 0; color: #1e293b; font-weight: 700;">Ringkasan Operasional</h2>
        <p style="margin: 5px 0 0; color: #64748b; font-size: 14px;">Status inventaris terkini untuk Apotek Bintang Surya.</p>
    </div>

    <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 25px; margin-bottom: 40px;">
        
        <div style="background: white; padding: 25px; border-radius: 15px; border: 1px solid #e2e8f0; box-shadow: 0 4px 6px rgba(0,0,0,0.02);">
            <div style="display: flex; justify-content: space-between; color: #64748b; font-size: 11px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.5px;">
                Total Stok Items <i class="fa fa-box" style="color: #2B5B7C;"></i>
            </div>
            <h1 style="margin: 15px 0 0; font-size: 32px; color: #1e293b;"><?= number_format($total_obat); ?></h1>
        </div>

        <div style="background: white; padding: 25px; border-radius: 15px; border: 1px solid #e2e8f0; box-shadow: 0 4px 6px rgba(0,0,0,0.02);">
            <div style="display: flex; justify-content: space-between; color: #64748b; font-size: 11px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.5px;">
                Mendekati Kadaluarsa <i class="fa fa-hourglass-half" style="color: #f59e0b;"></i>
            </div>
            <h1 style="margin: 15px 0 0; font-size: 32px; color: #1e293b;"><?= $hampir_ed; ?></h1>
            <div style="margin-top: 10px; font-size: 11px; color: #2563eb; font-weight: 700; cursor: pointer;">TINDAKAN DIPERLUKAN →</div>
        </div>

        <div style="background: white; padding: 25px; border-radius: 15px; border: 1px solid #e2e8f0; box-shadow: 0 4px 6px rgba(0,0,0,0.02);">
            <div style="display: flex; justify-content: space-between; color: #64748b; font-size: 11px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.5px;">
                Stok Kadaluarsa <i class="fa fa-ban" style="color: #ef4444;"></i>
            </div>
            <h1 style="margin: 15px 0 0; font-size: 32px; color: #ef4444;"><?= $stok_habis; ?></h1>
            <div style="margin-top: 10px; font-size: 11px; color: #ef4444; font-weight: 700;">8 ITEM PERLU DIPINDAHKAN</div>
        </div>

    </div>

    <div style="background: white; border-radius: 20px; padding: 30px; border: 1px solid #e2e8f0; margin-bottom: 35px;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px;">
            <h3 style="margin: 0; color: #1e293b; font-size: 18px;">Peringatan Prioritas Tinggi</h3>
            <a href="inventaris/index.php" style="color: #2563eb; font-size: 13px; text-decoration: none; font-weight: 600;">Lihat Semua →</a>
        </div>

        <?php 
        $list = mysqli_query($conn, "SELECT * FROM inventaris ORDER BY id DESC LIMIT 3");
        if(mysqli_num_rows($list) > 0) {
            while($row = mysqli_fetch_array($list)) { 
        ?>
            <div style="display: grid; grid-template-columns: 60px 2fr 1fr 1.5fr 1fr; align-items: center; padding: 18px 0; border-bottom: 1px solid #f1f5f9;">
                <div style="width: 45px; height: 45px; background: #fff1f2; border-radius: 12px; display: flex; align-items: center; justify-content: center; color: #e11d48;">
                    <i class="fa fa-exclamation-circle"></i>
                </div>
                <div>
                    <span style="font-size: 10px; color: #94a3b8; font-weight: 800; text-transform: uppercase;">Nama Obat</span>
                    <div style="font-weight: 600; color: #1e293b; font-size: 15px;"><?= $row['nama_obat']; ?></div>
                </div>
                <div>
                    <span style="font-size: 10px; color: #94a3b8; font-weight: 800; text-transform: uppercase;">Batch Number</span>
                    <div style="color: #64748b; font-size: 14px;"><?= $row['no_batch']; ?></div>
                </div>
                <div>
                    <span style="font-size: 10px; color: #94a3b8; font-weight: 800; text-transform: uppercase;">Status</span>
                    <div><span style="background: #fee2e2; color: #b91c1c; padding: 4px 12px; border-radius: 20px; font-size: 10px; font-weight: 800;">SANGAT BERESIKO</span></div>
                </div>
                <div style="text-align: right;">
                    <button style="background: white; border: 1px solid #e2e8f0; padding: 8px 15px; border-radius: 10px; font-size: 12px; font-weight: 700; color: #475569; cursor: pointer; transition: 0.3s;">Karantina</button>
                </div>
            </div>
        <?php 
            }
        } else {
            echo "<p style='color: #94a3b8; text-align: center; padding: 20px;'>Belum ada data inventaris.</p>";
        }
        ?>
    </div>

    <div style="display: grid; grid-template-columns: 1.6fr 1fr; gap: 25px;">
        
        <div style="background: white; border-radius: 20px; padding: 35px; border: 1px solid #e2e8f0; display: flex; flex-direction: column; justify-content: center; box-shadow: 0 4px 6px rgba(0,0,0,0.02);">
            <h3 style="margin: 0 0 12px; color: #1e293b; font-size: 20px;">Optimasi Inventaris</h3>
            <p style="color: #64748b; font-size: 14px; margin-bottom: 25px; line-height: 1.6; max-width: 90%;">
                Lakukan audit mandiri pada obat yang akan segera kadaluarsa untuk meminimalisir kerugian stok.
            </p>
            <a href="inventaris/index.php" style="color: #2B5B7C; text-decoration: none; font-weight: 800; font-size: 12px; letter-spacing: 1px;">
                MULAI AUDIT <i class="fa fa-arrow-right" style="margin-left: 8px; font-size: 10px;"></i>
            </a>
        </div>

        <div style="background: #2B5B7C; border-radius: 20px; padding: 35px; color: white; box-shadow: 0 10px 15px -3px rgba(43, 91, 124, 0.2);">
            <h3 style="margin: 0 0 12px; font-size: 20px;">Input Obat Baru</h3>
            <p style="color: rgba(255,255,255,0.8); font-size: 14px; margin-bottom: 30px; line-height: 1.6;">
                Tambahkan stok baru dengan nomor batch yang akurat.
            </p>
            <a href="inventaris/tambah.php" style="background: white; color: #2B5B7C; padding: 12px 28px; border-radius: 12px; text-decoration: none; font-weight: 700; display: inline-block; font-size: 14px; transition: 0.3s;">
                Tambah Inventaris
            </a>
        </div>

    </div>

</div>

<?php include 'includes/footer.php'; ?>