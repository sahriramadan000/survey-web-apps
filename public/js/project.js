
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
                "Nama Proyek",
                "Kategori",
                {
                    name: "Aksi",
                    width: "130px",
                    formatter: (_, row) => {
                        const id = row.cells[4].data;
                        return gridjs.html(`
                            <button onclick="editDAta('${id}')" class="btn btn-sm btn-soft-secondary me-1">
                                <i class="bx bx-edit fs-16"></i>
                            </button>
                            <button onclick="deleteDAta('${id}')" class="btn btn-sm btn-soft-danger">
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
                url: "/cms/project-list",
                then: data => {
                    const projects = Array.isArray(data.data) ? data.data : [];
                    return projects.map((project, index) => [
                        index + 1,
                        project.image,
                        project.name,
                        project.category,
                        project.id,
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

// Fungsi Edit DAta
function editDAta(id) {
    let editUrl = editRoute.replace(":id", id);
    window.location.href = editUrl;
}

// Fungsi Delete DAta
function deleteDAta(id) {
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
