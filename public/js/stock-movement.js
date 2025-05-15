document.addEventListener("DOMContentLoaded", function () {
    if (document.getElementById("table-loading-state")) {
        new gridjs.Grid({
            columns: [
                { name: "No", width: "50px" },
                { name: "Dari", width: "200px" },
                { name: "Ke", width: "200px" },
                { name: "Produk", width: "400px" }, // Produk + Qty + Harga + Total
                { name: "Tanggal Perpindahan", width: "180px" },
                { name: "Status", width: "150px" },
                { name: "Catatan", width: "200px" },
                {
                    name: "Aksi",
                    width: "130px",
                    formatter: (_, row) => {
                        const stockMoveId = row.cells[7].data;

                        return gridjs.html(`
                            <button onclick="editStockMove('${stockMoveId}')" class="btn btn-sm btn-soft-secondary me-1">
                                <i class="bx bx-edit fs-16"></i>
                            </button>
                            <button onclick="deleteStockMove('${stockMoveId}')" class="btn btn-sm btn-soft-danger">
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
                url: "/stock-movement-list",
                then: data => {
                    const stocks = Array.isArray(data.data) ? data.data : [];
                    return stocks.map((item, index) => [
                        index + 1,
                        item.from_type === 'pelanggan' ? getCustomerInfo(item.from_id) : `${item.from_type.toUpperCase()}`,
                        item.to_type === 'pelanggan' ? getCustomerInfo(item.to_id) : `${item.to_type.toUpperCase()}`,
                        gridjs.html(
                            `<div style="display: flex; flex-direction: column; gap: 6px;">
                                ${item.items.map(prod => `
                                    <div style="padding-bottom: 4px; border-bottom: 1px dashed #ccc;">
                                        <div style="font-weight: bold;">${prod.product.name}</div>
                                        <div style="font-size: 12px; color: #666;">
                                            Qty: ${prod.quantity} |
                                            Harga: Rp${Number(prod.price).toLocaleString('id-ID')} |
                                            Total: Rp${Number(prod.total_price).toLocaleString('id-ID')}
                                        </div>
                                    </div>
                                `).join('')}
                            </div>`
                        ),
                        new Date(item.movement_date).toLocaleString('id-ID', {
                            day: '2-digit', month: '2-digit', year: 'numeric',
                            hour: '2-digit', minute: '2-digit'
                        }),
                        gridjs.html(
                            `<div style="display: flex; flex-direction: column; gap: 6px;">
                                <div>
                                    ${item.status === 'masuk'
                                        ? '<span class="badge bg-success">Masuk</span>'
                                        : '<span class="badge bg-danger">Keluar</span>'
                                    }
                                </div>
                            </div>`
                        ),
                        item.notes ?? '-',
                        item.id // buat aksi (edit/delete)
                    ]);
                }
            }
        }).render(document.getElementById("table-loading-state"));
    }
});

// Fungsi Edit Product
function editStockMove(stockMoveId) {
    let editUrl = editStockMoveUrl.replace(":id", stockMoveId);
    window.location.href = editUrl;
}

// Fungsi Delete Product
function deleteStockMove(stockMoveId) {
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
            let deleteUrl = deleteStockMoveUrl.replace(":id", stockMoveId);
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
