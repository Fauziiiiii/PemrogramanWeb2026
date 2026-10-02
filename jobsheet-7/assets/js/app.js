function initHapusConfirm() {
    document.addEventListener("click", function (e) {
        const btn = e.target.closest(".btn-hapus");
        if (!btn) return;

        const row = btn.closest("tr");
        const nama = row ? row.querySelector("td")?.textContent : "data ini";
        const yakin = confirm("Yakin ingin menghapus \"" + nama + "\"?");
        if (yakin && row) {
            row.remove();
            updateCounter(document.querySelector(".table-responsive table"));
        }
    });
}

function initTableFilter(kolomIndex) {
    const input = document.getElementById("search-input");
    const table = document.querySelector(".table-responsive table");
    if (!input || !table) return;

    input.addEventListener("keyup", function () {
        const keyword = input.value.toLowerCase();
        const rows = table.querySelectorAll("tbody tr");

        rows.forEach(function (row) {
            const sel = row.querySelectorAll("td")[kolomIndex];
            const teks = sel ? sel.textContent.toLowerCase() : "";
            row.style.display = teks.includes(keyword) ? "" : "none";
        });

        updateCounter(table);
    });
}

function updateCounter(table) {
    const counterEl = document.getElementById("row-counter");
    if (!counterEl) return;

    const rows = table.querySelectorAll("tbody tr");
    const total = rows.length;
    const tampil = Array.from(rows).filter(function (row) {
        return row.style.display !== "none";
    }).length;

    const sectionTitle = table.closest("section").querySelector("h2").textContent;
    const label = sectionTitle.includes("Buku") ? "buku" : "anggota";
    counterEl.textContent = `Menampilkan ${tampil} dari ${total} ${label}`;
}

document.addEventListener("DOMContentLoaded", function () {
    const sectionTitle = document.querySelector("h2");

    if (sectionTitle) {
        if (sectionTitle.textContent.includes("Buku")) {
            initTableFilter(0); // Index 0 untuk Judul Buku
        } else if (sectionTitle.textContent.includes("Anggota")) {
            initTableFilter(1); // Index 1 untuk Nama Anggota
        }
    }
});