<?php
    $page_title = "Tambah Anggota";
    include __DIR__ . '/../includes/header.php';

    $flash = $_SESSION['flash'] ?? null;
    unset($_SESSION['flash']);
?>
        <section>
            <h2>Tambah Anggota</h2>

            <?php if ($flash): ?>
                <p class="flash flash-<?php echo $flash['type']; ?>"><?php echo $flash['pesan']; ?></p>
            <?php endif; ?>
            <div id="liveAlertPlaceholder"></div>

            <form id="form-tambah" method="post" action="proses_tambah.php" novalidate>
                <div class="form-group">
                    <label for="nama">Nama Lengkap</label>
                    <input type="text" id="nama" name="nama" placeholder="Masukkan nama lengkap" required>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="no_anggota">No. Anggota</label>
                        <input type="text" id="no_anggota" name="no_anggota" placeholder="Contoh: A001" required>
                    </div>
                    <div class="form-group">
                        <label for="no_hp">No. HP</label>
                        <input type="text" id="no_hp" name="no_hp" placeholder="Contoh: 08123456789">
                    </div>
                </div>

                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <textarea id="alamat" name="alamat" rows="3" placeholder="Masukkan alamat domisili lengkap"></textarea>
                </div>

                <div class="form-group">
                    <button type="submit">Simpan</button>
                </div>
            </form>
        </section>
    </main>

    <footer>
        <p>&copy; 2026 SIMPUS-Mini &mdash; Jobsheet 1</p>
    </footer>

    <script src="../assets/js/form.js"></script>
</body>
</html>