// Mengambil & menampilkan Daftar Buku secara asinkron dari data/buku.json
async function muatDaftarBuku() {
    const tbody = document.querySelector(".table-responsive table tbody");
    const loading = document.getElementById("loading-indicator");
    if (!tbody) return;

    loading.style.display = "block";
    tbody.innerHTML = "";

    try {
        // simulasi delay jaringan agar loading indicator terlihat
        await new Promise((resolve) => setTimeout(resolve, 600));

        const res = await fetch("../data/buku.json");
        if (!res.ok) {
            throw new Error("Gagal mengambil data (status " + res.status + ")");
        }
        const daftarBuku = await res.json();

        daftarBuku.forEach(function (buku) {
            const tr = document.createElement("tr");

            const badgeStok = buku.stok > 0
                ? "<span class=\"badge badge-tersedia\">Tersedia: " + buku.stok + "</span>"
                : "<span class=\"badge badge-kosong\">Kosong</span>";

            tr.innerHTML =
                "<td>" + buku.judul + "</td>" +
                "<td>" + buku.pengarang + "</td>" +
                "<td>" + buku.tahun + "</td>" +
                "<td>" + badgeStok + "</td>" +
                "<td class=\"action-column\">" +
                    "<div class=\"action-buttons\">" +
                        "<button type=\"button\" class=\"btn-detail\">Detail</button>" +
                        "<button type=\"button\" class=\"btn-edit\">Edit</button>" +
                        "<button type=\"button\" class=\"btn-hapus\">Hapus</button>" +
                    "</div>" +
                "</td>";
            tbody.appendChild(tr);
        });

        if (typeof updateCounter === "function") updateCounter(document.querySelector(".table-responsive table"));
        if (typeof initHapusConfirm === "function") initHapusConfirm();
    } catch (err) {
        tbody.innerHTML =
            "<tr><td colspan=\"5\">Gagal memuat data: " + err.message + "</td></tr>";
    } finally {
        loading.style.display = "none";
    }
}

document.addEventListener("DOMContentLoaded", muatDaftarBuku);