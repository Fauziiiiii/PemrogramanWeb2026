# Wireframe & User Flow — SIMPUS-Mini

> Nama   : Muhammad Fauzi Fadillah
>
> NIM    : 254107020085
>
> Kelas  : TI_2G

Halaman yang sudah ada (Beranda, Daftar/Tambah Buku, Daftar/Tambah Anggota — Jobsheet 1-3) belum mencakup fitur **Login**, **Dashboard Petugas**, dan **Peminjaman/Pengembalian/Riwayat**. Dokumen ini merancang wireframe teks dan user flow untuk halaman-halaman tersebut sebelum diimplementasikan di jobsheet-jobsheet berikutnya (interaktivitas JS, lalu PHP/database untuk data sungguhan).

## Aktor

- **Tamu**: hanya bisa melihat katalog buku (Beranda, Daftar Buku) tanpa login.
- **Petugas**: login untuk mengakses seluruh fitur CRUD dan transaksi peminjaman/pengembalian.

## User Flow — Peminjaman Buku

```
[Petugas Login] -> [Dashboard] -> [Klik "+ Peminjaman Baru"]
        -> [Pilih Anggota] -> [Pilih Buku (stok > 0)]
        -> [Simpan] -> [Stok buku berkurang 1] -> [Kembali ke Dashboard]
```

## User Flow — Pengembalian Buku

```
[Dashboard] -> [Klik "+ Pengembalian"] -> [Cari transaksi aktif (nama anggota / judul buku)]
        -> [Tandai "Dikembalikan"] -> [Stok buku bertambah 1]
        -> [Kembali ke Dashboard]
```

## User Flow — Melihat Riwayat Peminjaman

```
[Dashboard] -> [Buka Daftar Anggota] -> [Klik "Riwayat" pada salah satu anggota]
        -> [Tampil Riwayat Peminjaman Anggota tersebut]
```

## Wireframe: Halaman Login

```
+--------------------------------------+
|              SIMPUS-Mini             |
|--------------------------------------|
|                                      |
|        [ Login Petugas ]            |
|                                      |
|   Username : [______________]       |
|   Password : [______________]       |
|                                      |
|          [   Masuk   ]              |
|                                      |
+--------------------------------------+
```

## Wireframe: Dashboard Petugas

```
+-----------------------------------------------------------------+
| SIMPUS-Mini   Beranda | Daftar Buku | Daftar Anggota | Peminjaman  (Nama Petugas) Logout |
|-------------------------------------------------------------------|
| [Total Buku] [Total Anggota] [Sedang Dipinjam] [Buku Terlambat]   |
|                                                                     |
|  Aksi Cepat:                                                       |
|  [ + Peminjaman Baru ]   [ + Pengembalian ]                        |
|                                                                     |
|  Transaksi Terbaru                                                 |
|  ----------------------------------------------------------------  |
|  Anggota        | Buku            | Tgl Pinjam | Status            |
+-----------------------------------------------------------------+
```

Baris navigasi dan 4 kartu statistik (Total Buku, Total Anggota, Sedang Dipinjam, Buku Terlambat) mengikuti langsung yang sudah ada di `index.html` saat ini, hanya ditambah menu **Peminjaman** dan indikator login di kanan.

## Wireframe: Form Peminjaman

```
+--------------------------------------+
|  Form Peminjaman Buku                |
|--------------------------------------|
|  Anggota : [ dropdown pilih anggota ]|
|  Buku    : [ dropdown, hanya stok>0 ]|
|  Tanggal Pinjam : [ auto: hari ini ] |
|                                      |
|          [  Simpan Peminjaman  ]    |
+--------------------------------------+
```

## Wireframe: Form Pengembalian

```
+--------------------------------------+
|  Pengembalian Buku                   |
|--------------------------------------|
|  Cari transaksi aktif:               |
|  [ nama anggota / judul buku ______ ]|
|                                      |
|  Anggota | Buku | Tgl Pinjam | [Kembalikan] |
+--------------------------------------+
```

## Wireframe: Riwayat Peminjaman per Anggota

```
+--------------------------------------------------+
|  Riwayat Peminjaman — Siti Aminah (A001)         |
|----------------------------------------------------|
|  Buku            | Pinjam   | Kembali | Status      |
|  Laskar Pelangi  | 01/07    | 10/07   | Selesai     |
|  Bumi Manusia    | 15/07    | -       | Dipinjam    |
+--------------------------------------------------+
```

## Konsistensi dengan Desain yang Sudah Berjalan

- Warna aksen hijau (`#065c15`), tipografi navbar, dan gaya tabel/kartu mengikuti `assets/css/style.css` yang sudah dibangun.
- Navbar akan ditambah menu **Peminjaman** dan indikator status login (nama petugas / tombol Logout) — cukup menambah `<li><a>` baru karena navbar sudah pakai Flexbox, tanpa perlu ubah CSS.
- Form Login dan Form Peminjaman/Pengembalian memakai pola `<label>` + `<input>` yang sama seperti form Tambah Buku/Tambah Anggota yang sudah ada, sehingga otomatis mendapat gaya `form label` dan `form input` dari `style.css`.
- Kartu statistik Dashboard Petugas memakai ulang komponen `.kartu-statistik` (CSS Grid) yang sama persis dengan Beranda, hanya beda konteks halaman.

## Edge Case yang Perlu Ditangani Saat Implementasi

- Buku dengan stok 0 tidak boleh muncul sebagai pilihan di form Peminjaman.
- Tamu yang mencoba mengakses URL Dashboard/Peminjaman/Pengembalian secara langsung tanpa login harus dialihkan ke halaman Login.
- Anggota dengan tunggakan/keterlambatan pengembalian perlu validasi tambahan sebelum boleh meminjam lagi (menyusul di jobsheet berikutnya).