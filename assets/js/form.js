const alertPlaceholder = document.getElementById('liveAlertPlaceholder');

function appendAlert(message, type) {
    if (!alertPlaceholder) return;
    alertPlaceholder.innerHTML = '';
    const wrapper = document.createElement('div');
    wrapper.innerHTML = [
        `<div class="alert alert-${type} alert-dismissible fade show" role="alert">`,
        `   <div>${message}</div>`,
        '   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>',
        '</div>'
    ].join('');
    alertPlaceholder.append(wrapper);
}

function tampilkanError(input, pesan) {
    hapusError(input);
    const span = document.createElement('span');
    span.className = 'error text-danger small mt-1 d-block'; // Tambah class Bootstrap agar rapi
    span.textContent = pesan;
    input.insertAdjacentElement('afterend', span);
    input.classList.add('is-invalid');
}

function hapusError(input) {
    input.classList.remove('is-invalid');
    const next = input.nextElementSibling;
    if (next && next.classList.contains('error')) {
        next.remove();
    }
}

function validasiForm(form, aturan) {
    let valid = true;

    aturan.forEach(function (atur) {
        const input = form.querySelector(`[name='${atur.name}']`);
        if (!input) return;

        const nilai = input.value.trim();

        if (atur.wajib && nilai === '') {
            tampilkanError(input, `${atur.label} wajib diisi.`);
            valid = false;
            return;
        }

        if (nilai !== '' && atur.custom) {
            const pesanError = atur.custom(nilai);
            if (pesanError) {
                tampilkanError(input, pesanError);
                valid = false;
                return;
            }
        }

        hapusError(input);
    });

    return valid;
}

// Aturan Validasi per Halaman
const aturanBuku = [
    { name: 'judul', label: 'Judul buku', wajib: true },
    { name: 'pengarang', label: 'Pengarang', wajib: true },
    {
        name: 'tahun', label: 'Tahun terbit', wajib: true,
        custom: (nilai) => {
            const angka = Number(nilai);
            if (angka < 1900 || angka > 2026) return 'Tahun terbit harus antara 1900-2026.';
            return null;
        }
    },
    {
        name: 'stok', label: 'Stok', wajib: true,
        custom: (nilai) => (Number(nilai) < 0 ? 'Stok tidak boleh negatif.' : null)
    },
    {
        name: 'isbn', label: 'ISBN', wajib: false,
        custom: (nilai) => {
            const formatBenar = /^[0-9-]+$/.test(nilai);
            return formatBenar ? null : 'ISBN hanya boleh berisi angka dan tanda hubung (-).';
        }
    }
];

const aturanAnggota = [
    { name: 'nama', label: 'Nama Lengkap', wajib: true },
    { name: 'no_anggota', label: 'No. Anggota', wajib: true },
    { 
        name: 'no_hp', label: 'No. HP', wajib: false,
        custom: (nilai) => {
            const formatBenar = /^[0-9+]+$/.test(nilai); // Hanya angka dan '+'
            return formatBenar ? null : 'Nomor HP hanya boleh berisi angka.';
        }
    }
];

// Inisialisasi saat Halaman Dimuat
document.addEventListener("DOMContentLoaded", function() {
    const formTambah = document.getElementById('form-tambah');
    const judulHalaman = document.querySelector('h2');

    if (formTambah && judulHalaman) {
        let aturanPakai = [];
        let pesanSukses = "";

        if (judulHalaman.textContent.includes("Buku")) {
            aturanPakai = aturanBuku;
            pesanSukses = "Sukses! Data buku baru berhasil disimpan.";
        } else if (judulHalaman.textContent.includes("Anggota")) {
            aturanPakai = aturanAnggota;
            pesanSukses = "Sukses! Data anggota baru berhasil disimpan.";
        }

        formTambah.addEventListener('submit', function (e) {
            e.preventDefault();

            const isValid = validasiForm(formTambah, aturanPakai);

            if (isValid) {
                appendAlert(pesanSukses, 'success');
                formTambah.reset();
                formTambah.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));
            } else {
                appendAlert('Gagal! Silakan periksa kembali isian form.', 'danger');
            }
        });
    }
});