<?php
    $page_title = "Beranda";
<<<<<<< HEAD
    require __DIR__ . '/includes/koneksi.php';
    include __DIR__ . '/includes/header.php';

    $totalBuku = $pdo->query("SELECT COUNT(*) FROM buku")->fetchColumn();
    $totalAnggota = $pdo->query("SELECT COUNT(*) FROM anggota")->fetchColumn();
=======
    include __DIR__ . '/includes/header.php';

    $totalBuku = count($_SESSION['buku'] ?? []);
    $totalAnggota = count($_SESSION['anggota'] ?? []);
>>>>>>> a0dcd3308ae97dc9e17ac9255edd2940140e1799
?>
        <section>
            <h2>Selamat Datang di Sistem Perpustakaan Mini</h2>
            <p>Aplikasi sederhana untuk mengelola data buku dan anggota perpustakaan.</p>
        </section>

        <section>
            <h2>Ringkasan</h2>

            <div class="kartu-statistik">
                <article>
                    <h3>Total Buku</h3>
<<<<<<< HEAD
                    <p><?php echo $totalBuku; ?></p>
                </article>
                <article>
                    <h3>Total Anggota</h3>
                    <p><?php echo $totalAnggota; ?></p>
                </article>
                <article>
                    <h3>Sedang Dipinjam</h3>
                    <p>0</p>
                </article>
                <article>
                    <h3>Buku Terlambat</h3>
                    <p>0</p>
=======
                    <p>12</p>
                </article>
                <article>
                    <h3>Total Anggota</h3>
                    <p>8</p>
                </article>
                <article>
                    <h3>Sedang Dipinjam</h3>
                    <p>3</p>
                </article>
                <article>
                    <h3>Buku Terlambat</h3>
                    <p>3</p>
>>>>>>> a0dcd3308ae97dc9e17ac9255edd2940140e1799
                </article>
            </div>
        </section>
<?php include __DIR__ . '/includes/footer.php'; ?>