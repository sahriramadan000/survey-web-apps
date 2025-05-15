document.addEventListener("DOMContentLoaded", function () {
    if (document.getElementById("table-loading-state")) {
        new gridjs.Grid({
            columns: [
                { name: "No", width: "100px" },
                { name: "Product Name", hidden: true },
                { name: "Product Image", hidden: true },
                { name: "Product Id", hidden: true },
                { name: "Date", width: "200px" },
                {
                    name: "Product",
                    data: (row) => {
                        // Ini buat search
                        const productCode = row[1];
                        const productName = row[2];
                        return `${productCode} ${productName}`;
                    },
                    formatter: (cell, row) => {
                        const productCode = row.cells[1].data;
                        const productName = row.cells[2].data;
                        const imageName = row.cells[3].data ? row.cells[3].data : 'default.png';
                        const imageUrl = imageProductUrl.replace(":name", imageName);

                        return gridjs.html(`
                            <div style="display: flex; align-items: center; gap: 10px;">
                                <img src="${imageUrl}" width="40" height="40" style="border-radius: 5px;"/>
                                <div>
                                    <div style="margin-bottom: 5px;">
                                        <small><strong>${productCode}</strong></small><br/>
                                        <h5 style="margin: 0;">${productName}</h5>
                                    </div>
                                </div>
                            </div>
                        `);
                    }
                },
                {
                    name: "Batch",
                    width: "150px",
                    formatter: (cell) => {
                        return cell ?? "-";
                    }
                },
                {
                    name: "Quantity",
                    width: "100px",
                    formatter: (cell) => {
                        return cell ?? "-";
                    }
                },
                {
                    name: "Price/Item",
                    width: "220px",
                    formatter: (cell) => {
                        return cell ? `Rp${Number(cell).toLocaleString('id-ID')}` : "-";
                    }
                },
                {
                    name: "Action",
                    width: "130px",
                    formatter: (_, row) => {
                        const incomingId = row.cells[9].data;

                        return gridjs.html(`
                            <button onclick="editBaseToAgentIncoming('${incomingId}')" class="btn btn-sm btn-soft-secondary me-1">
                                <i class="bx bx-edit fs-16"></i>
                            </button>
                            <button onclick="deleteBaseToAgentIncoming('${incomingId}')" class="btn btn-sm btn-soft-danger">
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
                url: "/base-to-agent-incoming-list",
                then: data => {
                    const incoming = Array.isArray(data.data) ? data.data : [];
                    return incoming.map((incom, index) => [
                        index + 1,
                        incom.product.product_code,
                        incom.product.product_name,
                        incom.product.product_image,
                        incom.incoming_date,
                        incom.batch,
                        incom.quantity,
                        incom.price_per_item,
                        incom.id,
                    ]);
                },
                handle: (res) => {
                    if (!res.ok) {
                        Swal.fire({
                            title: "Gagal!",
                            text: "Tidak dapat mengambil data produk masuk. Silakan coba lagi.",
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
function editBaseToAgentIncoming(incomingId) {
    let editUrl = editIncomingProductUrl.replace(":id", incomingId);
    window.location.href = editUrl;
}

// Fungsi Delete Product
function deleteBaseToAgentIncoming(incomingId) {
    Swal.fire({
        title: "Konfirmasi Hapus",
        text: "Apakah Anda yakin ingin menghapus data ini incoming product?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Ya, Hapus!"
    }).then((result) => {
        if (result.isConfirmed) {
            let deleteUrl = deleteIncomingProductUrl.replace(":id", incomingId);

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
                Swal.fire("Error!", "Tidak dapat menghapus produk masuk.", "error");
            });
        }
    });
}
