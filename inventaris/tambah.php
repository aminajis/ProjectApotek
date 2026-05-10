<?php 
include '../includes/header.php'; 
include '../config/database.php'; 
?>

<div class="content-wrapper" style="padding: 40px; background: #f8fafc; min-height: 100vh; font-family: 'Inter', sans-serif;">
    
    <div style="margin-bottom: 35px; max-width: 1000px; margin-left: auto; margin-right: auto;">
        <a href="index.php" style="text-decoration: none; color: #64748b; font-size: 13px; font-weight: 700; text-transform: uppercase; display: flex; align-items: center; gap: 8px;">
            <i class="fa fa-arrow-left"></i> Kembali ke Inventaris
        </a>
        <h1 style="margin: 15px 0 5px; color: #1e293b; font-size: 32px; font-weight: 800;">Tambah Stok</h1>
        <p style="color: #64748b; font-size: 14px;">Pastikan informasi sesuai dengan dokumen fisik untuk akurasi data.</p>
    </div>

    <div style="background: white; padding: 40px; border-radius: 20px; border: 1px solid #e2e8f0; box-shadow: 0 4px 20px rgba(0,0,0,0.03); max-width: 1000px; margin: 0 auto 40px;">
        <form action="proses_tambah.php" method="POST">
            
            <div style="display: grid; grid-template-columns: 1.5fr 1fr; gap: 30px; margin-bottom: 30px;">
                <div style="display: flex; flex-direction: column;">
                    <label style="font-weight: 800; color: #475569; font-size: 11px; text-transform: uppercase; margin-bottom: 10px; letter-spacing: 0.5px;">Nama Obat</label>
                    <input type="text" name="nama_obat" placeholder="Masukkan nama obat..." required 
                           style="width: 100%; padding: 15px; border-radius: 12px; border: 1px solid #e2e8f0; background: #f8fafc; font-size: 14px; box-sizing: border-box;">
                </div>
                <div style="display: flex; flex-direction: column;">
                    <label style="font-weight: 800; color: #475569; font-size: 11px; text-transform: uppercase; margin-bottom: 10px; letter-spacing: 0.5px;">Kategori</label>
                    <select name="kategori" style="width: 100%; padding: 15px; border-radius: 12px; border: 1px solid #e2e8f0; background: #f8fafc; font-size: 14px; height: 50px; cursor: pointer;">
                        <option>Tablet & Kapsul</option>
                        <option>Sirup & Cairan</option>
                        <option>Salep & Krim</option>
                    </select>
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 30px; margin-bottom: 30px;">
                <div style="display: flex; flex-direction: column;">
                    <label style="font-weight: 800; color: #475569; font-size: 11px; text-transform: uppercase; margin-bottom: 10px;">No Batch</label>
                    <input type="text" name="no_batch" placeholder="e.g. B23049X" required 
                           style="width: 100%; padding: 15px; border-radius: 12px; border: 1px solid #e2e8f0; background: #f8fafc; font-size: 14px; box-sizing: border-box;">
                </div>
                <div style="display: flex; flex-direction: column;">
                    <label style="font-weight: 800; color: #475569; font-size: 11px; text-transform: uppercase; margin-bottom: 10px;">Expiry Date</label>
                    <input type="date" name="expiry_date" required 
                           style="width: 100%; padding: 15px; border-radius: 12px; border: 1px solid #e2e8f0; background: #f8fafc; font-size: 14px; height: 50px; box-sizing: border-box;">
                </div>
                <div style="display: flex; flex-direction: column;">
                    <label style="font-weight: 800; color: #475569; font-size: 11px; text-transform: uppercase; margin-bottom: 10px;">Jumlah Stok</label>
                    <input type="number" name="sisa_stok" placeholder="0" required 
                           style="width: 100%; padding: 15px; border-radius: 12px; border: 1px solid #e2e8f0; background: #f8fafc; font-size: 14px; box-sizing: border-box;">
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 30px; margin-bottom: 40px;">
                <div style="display: flex; flex-direction: column;">
                    <label style="font-weight: 800; color: #475569; font-size: 11px; text-transform: uppercase; margin-bottom: 10px;">Lokasi Penyimpanan</label>
                    <input type="text" name="lokasi" placeholder="e.g. Rak A, Lemari 2" 
                           style="width: 100%; padding: 15px; border-radius: 12px; border: 1px solid #e2e8f0; background: #f8fafc; font-size: 14px; box-sizing: border-box;">
                </div>
                <div style="display: flex; flex-direction: column;">
                    <label style="font-weight: 800; color: #475569; font-size: 11px; text-transform: uppercase; margin-bottom: 10px;">Supplier</label>
                    <input type="text" name="supplier" placeholder="Nama distributor..." 
                           style="width: 100%; padding: 15px; border-radius: 12px; border: 1px solid #e2e8f0; background: #f8fafc; font-size: 14px; box-sizing: border-box;">
                </div>
            </div>

            <div style="display: flex; justify-content: flex-end; gap: 15px; padding-top: 20px; border-top: 1px solid #f1f5f9;">
                <button type="button" onclick="history.back()" style="padding: 14px 30px; border-radius: 10px; border: none; background: #f1f5f9; color: #475569; font-weight: 700; cursor: pointer;">Batal</button>
                <button type="submit" style="padding: 14px 40px; border-radius: 10px; border: none; background: #2B5B7C; color: white; font-weight: 700; cursor: pointer; box-shadow: 0 4px 12px rgba(43,91,124,0.2);">Simpan Stok</button>
            </div>
        </form>
    </div>
</div>

    <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 25px; max-width: 1000px; margin: 0 auto; padding-bottom: 50px;">
        
        <div style="background: white; padding: 25px; border-radius: 16px; border: 1px solid #e2e8f0; display: flex; flex-direction: column; gap: 12px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.02);">
             <div style="background: #eff6ff; width: 40px; height: 40px; border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                <i class="fa fa-shield-alt" style="color: #2B5B7C; font-size: 18px;"></i>
             </div>
             <div>
                 <h4 style="margin: 0 0 5px; font-size: 14px; color: #1e293b; font-weight: 700;">Validasi Otomatis</h4>
                 <p style="margin: 0; font-size: 12px; color: #64748b; line-height: 1.6;">Sistem memvalidasi nomor batch untuk mencegah duplikasi data.</p>
             </div>
        </div>

        <div style="background: white; padding: 25px; border-radius: 16px; border: 1px solid #e2e8f0; display: flex; flex-direction: column; gap: 12px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.02);">
             <div style="background: #fff7ed; width: 40px; height: 40px; border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                <i class="fa fa-bell" style="color: #ea580c; font-size: 18px;"></i>
             </div>
             <div>
                 <h4 style="margin: 0 0 5px; font-size: 14px; color: #1e293b; font-weight: 700;">Alert Kadaluarsa</h4>
                 <p style="margin: 0; font-size: 12px; color: #64748b; line-height: 1.6;">Notifikasi aktif otomatis 6 bulan sebelum tanggal expiry.</p>
             </div>
        </div>

        <div style="background: white; padding: 25px; border-radius: 16px; border: 1px solid #e2e8f0; display: flex; flex-direction: column; gap: 12px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.02);">
             <div style="background: #f1f5f9; width: 40px; height: 40px; border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                <i class="fa fa-history" style="color: #475569; font-size: 18px;"></i>
             </div>
             <div>
                 <h4 style="margin: 0 0 5px; font-size: 14px; color: #1e293b; font-weight: 700;">Riwayat Audit</h4>
                 <p style="margin: 0; font-size: 12px; color: #64748b; line-height: 1.6;">Setiap penambahan stok dicatat otomatis dalam log aktivitas.</p>
             </div>
        </div>

    </div>

</div>

<?php include '../includes/footer.php'; ?>