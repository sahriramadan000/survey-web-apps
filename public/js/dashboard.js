document.addEventListener("DOMContentLoaded", function () {
    if (document.getElementById("table-loading-state")) {
        new gridjs.Grid({
            columns: [
                {
                    name: "No",
                    width: "100px",
                },
                "Lokasi",
                "Produk",
            ],
            pagination: {
                buttonsCount: 10,
                limit: 10,
                summary: true
            },
            sort: true,
            search: true,
            server: {
                url: "/track-stock-list", // Gantilah dengan URL API yang sesuai
                then: data => {
                    const stockData = Array.isArray(data.data) ? data.data : [];
                    return stockData.map((item, index) => {
                        const produkList = item.produk.map(product => `
                            <div style="padding-bottom: 4px; border-bottom: 1px dashed #ccc;">
                                <div style="font-weight: bold;">${product.name}</div>
                                <div style="font-size: 12px; color: #666;">
                                    Qty: ${product.quantity}
                                </div>
                            </div>
                        `).join('');
                        return [
                            index + 1,  // Nomor urut
                            item.lokasi,  // Lokasi
                            gridjs.html(`
                                <div style="display: flex; flex-direction: column; gap: 6px;">
                                    ${produkList}
                                </div>
                            `),
                        ];
                    });
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
