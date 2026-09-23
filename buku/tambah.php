<?php
    $page_title = "Tambah Buku";
    include __DIR__ . '/../includes/header.php';

    $flash = $_SESSION['flash'] ?? null;
    unset($_SESSION['flash']);
?>
        <section>
            <h2>Tambah Buku</h2>

            <?php if ($flash): ?>
                <p class="flash flash-<?php echo $flash['type']; ?>"><?php echo $flash['pesan']; ?></p>
            <?php endif; ?>
            <div id="liveAlertPlaceholder"></div>

            <form id="form-tambah" method="post" action="proses_tambah.php" novalidate>
                <div class="form-group">
                    <label for="judul">Judul Buku</label>
                    <input type="text" id="judul" name="judul" placeholder="Masukkan judul buku" required>
                </div>
                <div class="form-group">
                    <label for="pengarang">Pengarang</label>
                    <input type="text" id="pengarang" name="pengarang" placeholder="Masukkan nama pengarang" required>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="tahun">Tahun Terbit</label>
                        <input type="number" id="tahun" name="tahun" min="1900" max="2026" placeholder="Contoh: 2024" required>
                    </div>
                    <div class="form-group">
                        <label for="isbn">ISBN</label>
                        <input type="text" id="isbn" name="isbn" placeholder="Contoh: 978-xxx-xxx">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="stok">Stok</label>
                        <input type="number" id="stok" name="stok" min="0" placeholder="Jumlah stok" required>
                    </div>
                    <div class="form-group">
                        <label for="kategori">Kategori</label>
                        <select id="kategori" name="kategori">
                            <option value="fiksi">Fiksi</option>
                            <option value="non-fiksi">Non-Fiksi</option>
                            <option value="referensi">Referensi</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit">Simpan</button>
                </div>
            </form>
        </section>
<?php include __DIR__ . '/../includes/footer.php'; ?>