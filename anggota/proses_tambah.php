<?php
<<<<<<< HEAD
require __DIR__ . '/../includes/koneksi.php';
=======
>>>>>>> a0dcd3308ae97dc9e17ac9255edd2940140e1799
session_start();

$nama = trim($_POST['nama'] ?? '');
$noAnggota = trim($_POST['no_anggota'] ?? '');
$alamat = trim($_POST['alamat'] ?? '');
$noHp = trim($_POST['no_hp'] ?? '');

$errors = [];
if ($nama === '') {
    $errors[] = "Nama wajib diisi.";
}
if ($noAnggota === '') {
    $errors[] = "No. Anggota wajib diisi.";
}

if (!empty($errors)) {
    $_SESSION['flash'] = ['type' => 'error', 'pesan' => implode(' ', $errors)];
    header('Location: tambah.php');
    exit;
}

<<<<<<< HEAD
// if (!isset($_SESSION['anggota'])) {
//     $_SESSION['anggota'] = [];
// }

// $_SESSION['anggota'][] = [
//     'nama' => $nama,
//     'no_anggota' => $noAnggota,
//     'alamat' => $alamat,
//     'no_hp' => $noHp,
// ];

$stmt = $pdo->prepare(
    "INSERT INTO anggota (nama, no_anggota, alamat, no_hp)
    VALUES (:nama, :no_anggota, :alamat, :no_hp)
    RETURNING id"
);
$stmt->execute([
    'nama' => $nama,
    'no_anggota' => $noAnggota,
    'alamat' => $alamat,
    'no_hp' => $noHp
]);
=======
if (!isset($_SESSION['anggota'])) {
    $_SESSION['anggota'] = [];
}

$_SESSION['anggota'][] = [
    'nama' => $nama,
    'no_anggota' => $noAnggota,
    'alamat' => $alamat,
    'no_hp' => $noHp,
];
>>>>>>> a0dcd3308ae97dc9e17ac9255edd2940140e1799

$_SESSION['flash'] = ['type' => 'success', 'pesan' => 'Anggota berhasil ditambahkan.'];
header('Location: list.php');
exit;