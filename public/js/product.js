
document.addEventListener("DOMContentLoaded", function () {
    if (document.getElementById("table-loading-state")) {
        new gridjs.Grid({
            columns: [
                {
                    name: "No",
                    width: "60px",
                },
                "Nama Produk",
                {
                    name: "Kategori",
                    formatter: (cell) => cell || '-'
                },
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
                    name: "Gambar 1",
                    formatter: (cell) => {
                        let imageName = cell || 'default.png';
                        let imageUrl = imageProductUrl.replace(":name", imageName);
                        return gridjs.html(`<img src="${imageUrl}" width="40" height="40"/>`);
                    }
                },
                {
                    name: "Gambar 2",
                    formatter: (cell) => {
                        let imageName = cell || 'default.png';
                        let imageUrl = imageProductUrl.replace(":name", imageName);
                        return gridjs.html(`<img src="${imageUrl}" width="40" height="40"/>`);
                    }
                },
                {
                    name: "Gambar 3",
                    formatter: (cell) => {
                        let imageName = cell || 'default.png';
                        let imageUrl = imageProductUrl.replace(":name", imageName);
                        return gridjs.html(`<img src="${imageUrl}" width="40" height="40"/>`);
                    }
                },
                {
                    name: "Gambar 4",
                    formatter: (cell) => {
                        let imageName = cell || 'default.png';
                        let imageUrl = imageProductUrl.replace(":name", imageName);
                        return gridjs.html(`<img src="${imageUrl}" width="40" height="40"/>`);
                    }
                },
                {
                    name: "Tersedia",
                    formatter: (cell) => {
                        return gridjs.html(`
                            <span class="badge ${cell ? 'bg-success' : 'bg-danger'}">
                                ${cell ? 'Tersedia' : 'Kosong'}
                            </span>
                        `);
                    }
                },
                {
                    name: "Aktif",
                    formatter: (cell) => {
                        return gridjs.html(`
                            <span class="badge ${cell ? 'bg-primary' : 'bg-secondary'}">
                                ${cell ? 'Aktif' : 'Nonaktif'}
                            </span>
                        `);
                    }
                },
                {
                    name: "Aksi",
                    width: "130px",
                    formatter: (_, row) => {
                        const productId = row.cells[10].data;
                        return gridjs.html(`
                            <button onclick="editProduct('${productId}')" class="btn btn-sm btn-soft-secondary me-1">
                                <i class="bx bx-edit fs-16"></i>
                            </button>
                            <button onclick="deleteProduct('${productId}')" class="btn btn-sm btn-soft-danger">
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
                url: "/cms/product-list",
                then: data => {
                    const products = Array.isArray(data.data) ? data.data : [];
                    return products.map((product, index) => [
                        index + 1,
                        product.name,
                        product.category ? product.category.name : '-',
                        product.description,
                        product.image1,
                        product.image2,
                        product.image3,
                        product.image4,
                        product.is_available,
                        product.is_active,
                        product.id,
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

// Fungsi Edit Product
function editProduct(productId) {
    let editUrl = editProductUrl.replace(":id", productId);
    window.location.href = editUrl;
}

// Fungsi Delete Product
function deleteProduct(productId) {
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
            let deleteUrl = deleteProductUrl.replace(":id", productId);
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
