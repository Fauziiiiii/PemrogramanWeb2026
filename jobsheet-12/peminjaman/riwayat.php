<?php
require __DIR__ . '/../includes/auth.php';
$page_title = "Riwayat Peminjaman";
include __DIR__ . '/../includes/header.php';
require __DIR__ . '/../includes/koneksi.php';

$anggotaId = (int) ($_GET['anggota_id'] ?? 0);
$daftarAnggota = $pdo->query("SELECT * FROM anggota ORDER BY nama ASC")->fetchAll(PDO::FETCH_ASSOC);

$riwayat = [];
$anggotaTerpilih = null;

if ($anggotaId > 0) {
    $stmtA = $pdo->prepare("SELECT * FROM anggota WHERE id = :id");
    $stmtA->execute(['id' => $anggotaId]);
    $anggotaTerpilih = $stmtA->fetch(PDO::FETCH_ASSOC);

    if ($anggotaTerpilih) {
        $stmt = $pdo->prepare(
            "SELECT b.judul, b.pengarang, p.tanggal_pinjam, p.tanggal_kembali, p.status
             FROM peminjaman p
             JOIN buku b ON b.id = p.buku_id
             WHERE p.anggota_id = :id
             ORDER BY p.tanggal_pinjam DESC, p.id DESC"
        );
        $stmt->execute(['id' => $anggotaId]);
        $riwayat = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
        <section>
            <h2>Riwayat Peminjaman per Anggota</h2>

            <form method="get" action="riwayat.php" style="margin-bottom: 1.5rem;">
                <div class="form-group">
                    <label for="anggota_id">Pilih Anggota</label>
                    <div style="display: flex; gap: 0.5rem; max-width: 450px;">
                        <select id="anggota_id" name="anggota_id" required style="flex: 1;">
                            <option value="">-- Pilih Anggota --</option>
                            <?php foreach ($daftarAnggota as $anggota): ?>
                            <option value="<?php echo $anggota['id']; ?>" <?php echo $anggotaId === (int) $anggota['id'] ? 'selected' : ''; ?>>
                                <?php echo e($anggota['nama']); ?> (<?php echo e($anggota['no_anggota']); ?>)
                            </option>
                            <?php endforeach; ?>
                        </select>
                        <button type="submit" style="padding: 0.55rem 1rem;">Lihat</button>
                    </div>
                </div>
            </form>

            <?php if ($anggotaTerpilih): ?>
                <div style="margin-bottom: 1rem; padding: 0.75rem 1rem; background-color: #f7f9fb; border-left: 4px solid #0f4c5c; border-radius: 4px;">
                    <p style="margin: 0;"><strong>Anggota:</strong> <?php echo e($anggotaTerpilih['nama']); ?> &bull; <strong>No. Anggota:</strong> <?php echo e($anggotaTerpilih['no_anggota']); ?></p>
                </div>

                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>Buku</th>
                                <th>Pengarang</th>
                                <th>Tgl Pinjam</th>
                                <th>Tgl Kembali</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($riwayat)): ?>
                            <tr>
                                <td colspan="5">Belum ada catatan transaksi peminjaman untuk anggota ini.</td>
                            </tr>
                            <?php else: ?>
                                <?php foreach ($riwayat as $r): ?>
                                <tr>
                                    <td><strong><?php echo e($r['judul']); ?></strong></td>
                                    <td><?php echo e($r['pengarang']); ?></td>
                                    <td><?php echo e($r['tanggal_pinjam']); ?></td>
                                    <td><?php echo $r['tanggal_kembali'] ? e($r['tanggal_kembali']) : '<span style="color: #999;">-</span>'; ?></td>
                                    <td>
                                        <?php if ($r['status'] === 'dipinjam'): ?>
                                            <span class="badge badge-pinjam" style="background-color: #f0ad4e; color: #fff; padding: 0.2rem 0.5rem; border-radius: 4px; font-size: 0.8rem;">Dipinjam</span>
                                        <?php else: ?>
                                            <span class="badge badge-tersedia">Selesai</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </section>
<?php include __DIR__ . '/../includes/footer.php'; ?>
