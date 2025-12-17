document.addEventListener('DOMContentLoaded', function () 
    {
        const table = $('#rawatJalanTable').DataTable({
        paging: true,
        searching: true,
        responsive: true,
        autoWidth: false,
        processing: true,
        serverSide: true,
        ajax: {
             //url: 'http://localhost/mekariapps/admin/rawatJalanController/fetch_data',
            url: `${BASE_URL}admin/rawatJalanController/fetch_data`,
            type: 'POST',
            data: function (d) {
                // Kirim parameter tanggal ke server-side
                d.startDate = $('#startDate').val(); // ID input tanggal awal
                d.endDate = $('#endDate').val(); // ID input tanggal akhir
            },
            dataSrc: function (json) {
                console.log('Data dari server:', json); // Debugging data
                return json.data || []; // Pastikan array data
            },
        },
        columns: [
            { data: null, render: (data, type, row, meta) => meta.row + 1 }, // Nomor
            { data: 'no_rawat' }, // Nomor Rawat
            { data: 'no_rkm_medis' }, // Nomor RM
            { data: 'nm_pasien' }, // Nama Pasien
            { data: 'nm_dokter' }, // Nama Dokter
            { data: 'email' }, // Email Dokter
            { data: 'nm_poli' }, // Nama Poliklinik
            {
                data: 'lokasi_file',
                render: (data) =>
                    data
                        ? `<a href="${data}" target="_blank" class="badge badge-success">Lihat File</a>`
                        : '<span class="badge badge-danger">Tidak Ada File</span>',
            },
            {
                data: 'doc_id',
                render: (data) =>
                    data
                        ? '<span class="badge badge-success">Berhasil Dikirim</span>'
                        : '<span class="badge badge-warning">Belum Dikirim</span>',
            },
            {
                data: null,
                render: (data, type, row) => {
                    let actionButtons = `
                        <button class="btn btn-info btn-sm preview-json" 
                            data-no_rawat="${row.no_rawat}" 
                            data-nm_dokter="${row.nm_dokter}" 
                            data-email="${row.email}">
                            Kirim TTE
                        </button>`;

                    if (row.doc_id) {
                        actionButtons += `
                            <button class="btn btn-primary btn-sm download-doc" 
                                data-doc_id="${row.doc_id}">
                                Download
                            </button>
                            <button class="btn btn-danger btn-sm delete-doc" 
                                data-doc_id="${row.doc_id}">
                                Hapus
                            </button>`;
                    }

                    return actionButtons;
                },
            },
        ],
        order: [[1, 'asc']],
    });


    // Event Listener untuk Kirim TTE
    $('#rawatJalanTable').on('click', '.preview-json', function () {
        const noRawat = $(this).data('no_rawat');
        const nmDokter = $(this).data('nm_dokter');
        const email = $(this).data('email');

        if (!noRawat || !nmDokter || !email) {
            Swal.fire('Error', 'Data tidak lengkap untuk mengirim TTE.', 'error');
            return;
        }

        $.ajax({
            // url: 'http://localhost/mekariapps/admin/MekariController/send_request_tte',
            url: BASE_URL + 'admin/MekariController/send_request_tte',
            type: 'POST',
            data: { no_rawat: noRawat, email: email, nm_dokter: nmDokter },
            beforeSend: function () {
                Swal.fire({
                    title: 'Mengirim Request TTE...',
                    allowOutsideClick: false,
                    didOpen: () => Swal.showLoading(),
                });
            },
            success: function (response) {
                Swal.close();
                let res;
                try {
                    res = JSON.parse(response);
                } catch (e) {
                    console.error('Error parsing response:', e);
                    Swal.fire('Error', 'Respons server tidak valid.', 'error');
                    return;
                }

                if (res.status) {
                    saveDataToDatabase(noRawat, res.data);
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        html: `<pre>${JSON.stringify(res, null, 2)}</pre>`,
                        confirmButtonText: 'OK',
                    });
                }
            },
            error: function () {
                Swal.fire('Error', 'Terjadi kesalahan saat mengirim request TTE.', 'error');
            },
        });
    });

    // Event Listener untuk Hapus Dokumen
    $('#rawatJalanTable').on('click', '.delete-doc', function () 
        {
        const docId = $(this).data('doc_id');

        if (!docId) {
            Swal.fire('Error', 'Document ID tidak ditemukan.', 'error');
            return;
        }

        Swal.fire({
            title: 'Yakin ingin menghapus dokumen ini?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, Hapus',
            cancelButtonText: 'Batal',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: BASE_URL + 'admin/MekariController/delete_document_data',
                    type: 'POST',
                    data: { doc_id: docId },
                    beforeSend: function () {
                        Swal.fire({
                            title: 'Menghapus Dokumen...',
                            allowOutsideClick: false,
                            didOpen: () => Swal.showLoading(),
                        });
                    },
                    success: function (response) {
                        let res;
                        try {
                            res = JSON.parse(response);
                        } catch (e) {
                            Swal.fire('Error', 'Respons server tidak valid.', 'error');
                            return;
                        }

                        if (res.status) {
                            Swal.fire('Sukses', 'Dokumen berhasil dihapus.', 'success');
                            $('#rawatJalanTable').DataTable().ajax.reload();
                        } else {
                            Swal.fire('Error', res.message, 'error');
                        }
                    },
                    error: function () {
                        Swal.fire('Error', 'Terjadi kesalahan saat menghapus dokumen.', 'error');
                    },
                });
            }
        });
    });

    $('#rawatJalanTable').on('click', '.download-doc', function () {
    const docId = $(this).data('doc_id');

    if (!docId) {
        Swal.fire('Error', 'Document ID tidak ditemukan.', 'error');
        return;
    }

    $.ajax({
        url: BASE_URL + 'admin/MekariController/download_document',
        type: 'POST',
        data: { doc_id: docId },
        beforeSend: function () {
            Swal.fire({
                title: 'Mengunduh dan Mengganti Dokumen...',
                allowOutsideClick: false,
                didOpen: () => Swal.showLoading(),
            });
        },
        success: function (response) {
            Swal.close();

            let res;
            try {
                res = typeof response === 'string' ? JSON.parse(response) : response;
            } catch (e) {
                console.error('Error parsing response:', e);
                Swal.fire('Error', 'Respons server tidak valid.', 'error');
                return;
            }

            if (res.status) {
                Swal.fire('Sukses', res.message, 'success');

                // Jika URL file tersedia, arahkan pengguna ke file
                if (res.file_url) {
                    window.open(res.file_url, '_blank');
                }
            } else {
                Swal.fire('Error', res.message, 'error');
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            Swal.fire('Error', 'Terjadi kesalahan saat mengunduh dan mengganti dokumen.', 'error');
            console.error('AJAX Error:', textStatus, errorThrown);
        },
    });
});

    // Fungsi untuk Menyimpan Data ke Database
    function saveDataToDatabase(noRawat, responseData) {
        const documentId = responseData.data?.id;

        if (!documentId) {
            Swal.fire('Error', 'Data dokumen tidak valid.', 'error');
            return;
        }

        $.ajax({
            url: BASE_URL + 'admin/MekariController/save_document_data',
            type: 'POST',
            data: { no_rawat: noRawat, doc_id: documentId },
            success: function (response) {
                let res;
                try {
                    res = JSON.parse(response);
                } catch (e) {
                    Swal.fire('Error', 'Respons server tidak valid.', 'error');
                    return;
                }

                if (res.status) {
                    Swal.fire('Sukses', 'Data berhasil disimpan.', 'success');
                    table.ajax.reload();
                } else {
                    Swal.fire('Gagal', res.message, 'error');
                }
            },
            error: function () {
                Swal.fire('Error', 'Terjadi kesalahan saat menyimpan data.', 'error');
            },
        });
    }
});
