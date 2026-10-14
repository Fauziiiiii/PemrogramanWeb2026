<?php
require __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/csrf.php';
require __DIR__ . '/../includes/koneksi.php';

csrf_verify();

$anggotaId = (int) ($_POST['anggota_id'] ?? 0);
$bukuId = (int) ($_POST['buku_id'] ?? 0);

if ($anggotaId <= 0 || $bukuId <= 0) {
    $_SESSION['flash'] = ['type' => 'error', 'pesan' => 'Anggota dan buku wajib dipilih.'];
    header('Location: tambah.php');
    exit;
}

try {
    $pdo->beginTransaction();

    // Kunci baris buku (FOR UPDATE) agar stok tidak berubah oleh transaksi lain secara bersamaan
    // Mencegah race condition yang dapat menyebabkan stok negatif
    $cek = $pdo->prepare("SELECT stok FROM buku WHERE id = :id FOR UPDATE");
    $cek->execute(['id' => $bukuId]);
    $buku = $cek->fetch(PDO::FETCH_ASSOC);

    if (!$buku || (int) $buku['stok'] < 1) {
        throw new Exception('Stok buku tidak tersedia.');
    }

    $insert = $pdo->prepare(
        "INSERT INTO peminjaman (buku_id, anggota_id, tanggal_pinjam, status)
         VALUES (:buku_id, :anggota_id, CURRENT_DATE, 'dipinjam')"
    );
    $insert->execute([
        'buku_id' => $bukuId,
        'anggota_id' => $anggotaId
    ]);

    $update = $pdo->prepare("UPDATE buku SET stok = stok - 1 WHERE id = :id");
    $update->execute(['id' => $bukuId]);

    $pdo->commit();

    $_SESSION['flash'] = ['type' => 'success', 'pesan' => 'Peminjaman buku berhasil dicatat.'];
    header('Location: ../index.php');
    exit;
} catch (Exception $e) {
    if ($pdo->inTransaction()) {
        $pdo->rollBack();
    }
    $_SESSION['flash'] = ['type' => 'error', 'pesan' => 'Gagal mencatat peminjaman: ' . $e->getMessage()];
    header('Location: tambah.php');
    exit;
}
