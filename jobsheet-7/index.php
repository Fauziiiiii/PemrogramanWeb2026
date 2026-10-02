<?php
    $page_title = "Beranda";
    include __DIR__ . '/includes/header.php';

    $totalBuku = count($_SESSION['buku'] ?? []);
    $totalAnggota = count($_SESSION['anggota'] ?? []);
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
                </article>
            </div>
        </section>
<?php include __DIR__ . '/includes/footer.php'; ?>