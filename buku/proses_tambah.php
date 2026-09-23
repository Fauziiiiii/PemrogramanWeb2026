<?php
<<<<<<< HEAD
require __DIR__ . '/../includes/koneksi.php';
=======
>>>>>>> a0dcd3308ae97dc9e17ac9255edd2940140e1799
session_start();

$judul = trim($_POST['judul'] ?? '');
$pengarang = trim($_POST['pengarang'] ?? '');
$tahun = $_POST['tahun'] ?? '';
$isbn = trim($_POST['isbn'] ?? '');
$stok = $_POST['stok'] ?? '';
$kategori = trim($_POST['kategori'] ?? '');

$errors = [];
if ($judul === '') {
    $errors[] = "Judul wajib diisi.";
}
if ($pengarang === '') {
    $errors[] = "Pengarang wajib diisi.";
}
if ($isbn !== '' && !preg_match('/^[0-9-]+$/', $isbn)) {
    $errors[] = "ISBN hanya boleh berisi angka dan tanda strip (-).";
}
if (!is_numeric($tahun) || $tahun < 1900 || $tahun > 2026) {
    $errors[] = "Tahun harus di antara 1900-2026.";
}
if (!is_numeric($stok) || $stok < 0) {
    $errors[] = "Stok tidak boleh negatif.";
}

if (!empty($errors)) {
    $_SESSION['flash'] = ['type' => 'error', 'pesan' => implode(' ', $errors)];
    header('Location: tambah.php');
    exit;
}

<<<<<<< HEAD
// if (!isset($_SESSION['buku'])) {
//     $_SESSION['buku'] = [];
// }

// $_SESSION['buku'][] = [
//     'judul' => $judul,
//     'pengarang' => $pengarang,
//     'tahun' => (int) $tahun,
//     'isbn' => $isbn,
//     'stok' => (int) $stok,
//     'kategori' => $kategori,
// ];

$stmt = $pdo->prepare(
    "INSERT INTO buku (judul, pengarang, tahun, isbn, stok, kategori)
     VALUES (:judul, :pengarang, :tahun, :isbn, :stok, :kategori)
     RETURNING id"
);
$stmt->execute([
=======
if (!isset($_SESSION['buku'])) {
    $_SESSION['buku'] = [];
}

$_SESSION['buku'][] = [
>>>>>>> a0dcd3308ae97dc9e17ac9255edd2940140e1799
    'judul' => $judul,
    'pengarang' => $pengarang,
    'tahun' => (int) $tahun,
    'isbn' => $isbn,
    'stok' => (int) $stok,
    'kategori' => $kategori,
<<<<<<< HEAD
]);
=======
];
>>>>>>> a0dcd3308ae97dc9e17ac9255edd2940140e1799

$_SESSION['flash'] = ['type' => 'success', 'pesan' => 'Buku berhasil ditambahkan.'];
header('Location: list.php');
exit;