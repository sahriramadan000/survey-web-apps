
document.addEventListener("DOMContentLoaded", function () {
    if (document.getElementById("table-loading-state")) {
        new gridjs.Grid({
            columns: [
                {
                    name: "No",
                    width: "60px",
                },
                {
                    name: "Gambar",
                    formatter: (cell) => {
                        let imageName = cell || 'default.png';
                        let imageUrl = imageRoute.replace(":name", imageName);
                        return gridjs.html(`<img src="${imageUrl}" width="40" height="40"/>`);
                    }
                },
                "Nama Layanan",
                {
                    name: "Deskripsi",
                    formatter: (cell) => {
                        const maxLength = 50;
                        return cell && cell.length > maxLength
                            ? cell.substring(0, maxLength) + "..."
                            : cell;
                    }
                },
                {
                    name: "Aksi",
                    width: "130px",
                    formatter: (_, row) => {
                        const id = row.cells[4].data;
                        return gridjs.html(`
                            <button onclick="editData('${id}')" class="btn btn-sm btn-soft-secondary me-1">
                                <i class="bx bx-edit fs-16"></i>
                            </button>
                            <button onclick="deleteData('${id}')" class="btn btn-sm btn-soft-danger">
                                <i class="bx bx-trash fs-16"></i>
                            </button>
                        `);
                    }
                }
            ],
            pagination: {
                buttonsCount: 10,
                limit: 10,
                summary: true
            },
            sort: true,
            search: true,
            server: {
                url: "/cms/service-list",
                then: data => {
                    const services = Array.isArray(data.data) ? data.data : [];
                    return services.map((service, index) => [
                        index + 1,
                        service.image,
                        service.name,
                        service.description,
                        service.id,
                    ]);
                },
                handle: (res) => {
                    if (!res.ok) {
                        Swal.fire({
                            title: "Gagal!",
                            text: "Tidak dapat mengambil data. Silakan coba lagi.",
                            icon: "error",
                            confirmButtonText: "OK"
                        });

                        return res.json().then(() => []);
                    }
                    return res.json();
                }
            },
            className: {
                table: "gridjs-table",
                tr: "gridjs-tr",
                td: "gridjs-td",
                th: "gridjs-th"
            },
            style: {
                table: {
                    "white-space": "nowrap"
                }
            }
        }).render(document.getElementById("table-loading-state"));
    }
});

// Fungsi Edit Data
function editData(id) {
    let editUrl = editRoute.replace(":id", id);
    window.location.href = editUrl;
}

// Fungsi Delete Data
function deleteData(id) {
    Swal.fire({
        title: "Konfirmasi Hapus",
        text: "Apakah Anda yakin ingin menghapus data ini?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Ya, Hapus!"
    }).then((result) => {
        if (result.isConfirmed) {
            let deleteUrl = deleteRoute.replace(":id", id);
            fetch(deleteUrl, {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": document.querySelector("meta[name='csrf-token']").content,
                    "Content-Type": "application/json",
                    "X-HTTP-Method-Override": "DELETE"
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire("Berhasil!", data.message, "success")
                        .then(() => window.location.reload());
                } else {
                    Swal.fire("Gagal!", data.message || "Terjadi kesalahan.", "error");
                }
            })
            .catch(error => {
                Swal.fire("Error!", "Tidak dapat menghapus data.", "error");
            });
        }
    });
}
