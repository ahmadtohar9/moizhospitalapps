$(document).ready(function () {
    const no_rawat = $('#no_rawat').val();
    const no_rkm_medis = $('#no_rkm_medis').val();

    initDiagnosaAutocomplete();
    initProsedurAutocomplete();

    loadHasilDiagnosa();
    loadRiwayatDiagnosa();
    loadHasilProsedur();
    loadRiwayatProsedur();

    $('#btnSimpanDiagnosa').on('click', function () {
        const kode = $('#diagnosaInput').data('kode');

        if (!kode) {
            Swal.fire({
                icon: 'warning',
                title: 'Diagnosa belum dipilih!',
                text: 'Silakan cari dan pilih diagnosa terlebih dahulu.',
                timer: 3000,
                showConfirmButton: false
            });
            return;
        }

        $.post(BASE_URL + 'DiagnosaProsedurRalanController/saveDiagnosa', {
            no_rawat: no_rawat,
            kd_penyakit: kode
        }, function (response) {
            if (response.success) {
                $('#diagnosaInput').val('').removeData('kode');
                loadHasilDiagnosa();
                loadRiwayatDiagnosa();

                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: 'Diagnosa berhasil disimpan.',
                    timer: 3000,
                    showConfirmButton: false
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: response.message || 'Terjadi kesalahan saat menyimpan.',
                    timer: 3000,
                    showConfirmButton: false
                });
            }
        }, 'json');
    });

    $('#btnSimpanProsedur').on('click', function () {
        const kode = $('#prosedurInput').data('kode');

        if (!kode) {
            Swal.fire({
                icon: 'warning',
                title: 'Prosedur belum dipilih!',
                text: 'Silakan cari dan pilih prosedur terlebih dahulu.',
                timer: 3000,
                showConfirmButton: false
            });
            return;
        }

        $.post(BASE_URL + 'DiagnosaProsedurRalanController/saveProsedur', {
            no_rawat: no_rawat,
            kode: kode
        }, function (response) {
            if (response.success) {
                $('#prosedurInput').val('').removeData('kode');
                loadHasilProsedur();
                loadRiwayatProsedur();

                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: 'Prosedur berhasil disimpan.',
                    timer: 3000,
                    showConfirmButton: false
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: response.message || 'Terjadi kesalahan saat menyimpan.',
                    timer: 3000,
                    showConfirmButton: false
                });
            }
        }, 'json');
    });

    function initDiagnosaAutocomplete() {
        $('#diagnosaInput').autocomplete({
            source: function (request, response) {
                $.ajax({
                    url: BASE_URL + 'DiagnosaProsedurRalanController/getDiagnosa',
                    dataType: 'json',
                    data: { term: request.term },
                    success: function (data) {
                        response(data.map(function (item) {
                            return {
                                label: item.kode + ' - ' + item.nama,
                                value: item.nama,
                                kode: item.kode
                            };
                        }));
                    }
                });
            },
            minLength: 2,
            select: function (event, ui) {
                $('#diagnosaInput').val(ui.item.label);
                $('#diagnosaInput').data('kode', ui.item.kode);
                return false;
            }
        });
    }

    function initProsedurAutocomplete() {
        $('#prosedurInput').autocomplete({
            source: function (request, response) {
                $.ajax({
                    url: BASE_URL + 'DiagnosaProsedurRalanController/getProsedur',
                    dataType: 'json',
                    data: { term: request.term },
                    success: function (data) {
                        response(data.map(function (item) {
                            return {
                                label: item.kode + ' - ' + item.deskripsi_panjang,
                                value: item.deskripsi_panjang,
                                kode: item.kode
                            };
                        }));
                    }
                });
            },
            minLength: 2,
            select: function (event, ui) {
                $('#prosedurInput').val(ui.item.label);
                $('#prosedurInput').data('kode', ui.item.kode);
                return false;
            }
        });
    }

    function loadHasilDiagnosa() {
        $.getJSON(BASE_URL + 'DiagnosaProsedurRalanController/getHasilDiagnosa', { no_rawat: no_rawat }, function (data) {
            let html = `
                <table class="table table-bordered table-sm">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
            `;

            if (data.length === 0) {
                html += `<tr><td colspan="4" class="text-center">Belum ada diagnosa.</td></tr>`;
            } else {
                data.forEach(function (item, index) {
                    html += `
                        <tr>
                            <td>${index + 1}</td>
                            <td>${item.kd_penyakit}</td>
                            <td>
                                <button class="btn btn-sm btn-danger" onclick="deleteDiagnosa('${item.no_rawat}', '${item.kd_penyakit}')">Hapus</button>
                            </td>
                        </tr>
                    `;
                });
            }

            html += '</tbody></table>';
            $('#hasilDiagnosa').html(html);
        });
    }

    function loadHasilProsedur() {
        $.getJSON(BASE_URL + 'DiagnosaProsedurRalanController/getHasilProsedur', { no_rawat: no_rawat }, function (data) {
            let html = `
                <table class="table table-bordered table-sm">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
            `;

            if (data.length === 0) {
                html += `<tr><td colspan="3" class="text-center">Belum ada prosedur.</td></tr>`;
            } else {
                data.forEach(function (item, index) {
                    html += `
                        <tr>
                            <td>${index + 1}</td>
                            <td>${item.kode}</td>
                            <td>
                                <button class="btn btn-sm btn-danger" onclick="deleteProsedur('${item.no_rawat}', '${item.kode}')">Hapus</button>
                            </td>
                        </tr>
                    `;
                });
            }

            html += '</tbody></table>';
            $('#hasilProsedur').html(html);
        });
    }

    function loadRiwayatDiagnosa() 
    {
        $.getJSON(BASE_URL + 'DiagnosaProsedurRalanController/getRiwayatDiagnosaByNorm', { no_rkm_medis: no_rkm_medis }, function (data) {
            if (data.length === 0) {
                $('#riwayatDiagnosa').html('<div class="text-center">Belum ada riwayat diagnosa.</div>');
                return;
            }

            // Group data berdasarkan no_rawat
            const grouped = {};
            data.forEach(item => {
                if (!grouped[item.no_rawat]) {
                    grouped[item.no_rawat] = [];
                }
                grouped[item.no_rawat].push(item);
            });

            let html = '';
            const keys = Object.keys(grouped);
            const maxVisible = 3;

            keys.forEach((no_rawat, groupIndex) => {
                const isHidden = groupIndex >= maxVisible ? 'd-none riwayatDiagnosaGroup' : '';
                const rows = grouped[no_rawat];

                html += `
                    <div class="${isHidden} mb-3">
                        <table class="table table-bordered table-sm">
                            <thead class="bg-light">
                                <tr>
                                    <th colspan="6">
                                        <span class="badge bg-danger text-white">No. Rawat: ${no_rawat}</span>
                                    </th>
                                </tr>
                                <tr>
                                    <th>No</th>
                                    <th>Kode Diagnosa</th>
                                    <th>Nama Diagnosa</th>
                                    <th>Poli</th>
                                    <th>Dokter</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                `;

                rows.forEach((item, index) => {
                    html += `
                        <tr>
                            <td>${index + 1}</td>
                            <td>${item.kd_penyakit}</td>
                            <td>${item.nm_penyakit}</td>
                            <td>${item.nm_poli || '-'}</td>
                            <td>${item.nm_dokter || '-'}</td>
                            <td>
                                <button class="btn btn-sm btn-success" onclick="copyDiagnosa('${item.kd_penyakit}')">
                                    <i class="fa fa-copy"></i> Copy
                                </button>
                            </td>
                        </tr>
                    `;
                });

                html += `</tbody></table></div>`;
            });

            // Tombol tampilkan semua jika lebih dari 3 grup
            if (keys.length > maxVisible) {
                html += `
                    <div class="text-center">
                        <button id="showAllDiagnosaBtn" class="btn btn-sm btn-link">Tampilkan Semua</button>
                    </div>
                `;
            }

            $('#riwayatDiagnosa').html(html);

            // Event show more
            $('#showAllDiagnosaBtn').on('click', function () {
                $('.riwayatDiagnosaGroup').removeClass('d-none');
                $(this).remove();
            });
        });
    }

    window.copyDiagnosa = function (kd_penyakit) {
        const no_rawat = $('#no_rawat').val();
        if (!no_rawat || !kd_penyakit) {
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: 'No. Rawat atau Kode Diagnosa tidak valid.',
                timer: 3000,
                showConfirmButton: false
            });
            return;
        }

        $.post(BASE_URL + 'DiagnosaProsedurRalanController/saveDiagnosa', {
            no_rawat: no_rawat,
            kd_penyakit: kd_penyakit
        }, function (response) {
            if (response.success) {
                loadHasilDiagnosa();
                loadRiwayatDiagnosa();
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: 'Diagnosa berhasil disalin.',
                    timer: 2000,
                    showConfirmButton: false
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: response.message || 'Diagnosa gagal disalin.',
                    timer: 3000,
                    showConfirmButton: false
                });
            }
        }, 'json');
    };




    function loadRiwayatProsedur() {
    $.getJSON(BASE_URL + 'DiagnosaProsedurRalanController/getRiwayatProsedurByNorm', { no_rkm_medis: no_rkm_medis }, function (data) {
        if (data.length === 0) {
            $('#riwayatProsedur').html('<div class="text-center">Belum ada riwayat prosedur.</div>');
            return;
        }

        const grouped = {};
        data.forEach(item => {
            if (!grouped[item.no_rawat]) {
                grouped[item.no_rawat] = [];
            }
            grouped[item.no_rawat].push(item);
        });

        let html = '';
        const keys = Object.keys(grouped);
        const maxVisible = 3;

        keys.forEach((no_rawat, index) => {
            const hiddenClass = index >= maxVisible ? 'd-none' : '';
            const rows = grouped[no_rawat];

            html += `
                <div class="riwayatProsedurGroup ${hiddenClass}">
                    <table class="table table-bordered table-sm">
                        <thead class="bg-light">
                            <tr>
                                <th colspan="7">
                                    <strong>No. Rawat:</strong>
                                    <span class="badge bg-danger text-white">${no_rawat}</span>
                                </th>
                            </tr>
                            <tr>
                                <th>No</th>
                                <th>Kode Prosedur</th>
                                <th>Nama Prosedur</th>
                                <th>Poli</th>
                                <th>Dokter</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
            `;

            rows.forEach((item, i) => {
                html += `
                    <tr>
                        <td>${i + 1}</td>
                        <td>${item.kode}</td>
                        <td>${item.deskripsi_panjang}</td>
                        <td>${item.nm_poli || '-'}</td>
                        <td>${item.nm_dokter || '-'}</td>
                        <td>
                            <button class="btn btn-sm btn-success" onclick="copyProsedur('${item.kode}')">
                                <i class="fa fa-copy"></i> Copy
                            </button>
                        </td>
                    </tr>
                `;
            });

            html += '</tbody></table></div>';
        });
        if (keys.length > maxVisible) {
            html += `
                <div class="text-center mt-2" id="showMoreRowProsedur">
                    <button class="btn btn-sm btn-link" id="showMoreProsedurBtn">Tampilkan Semua</button>
                </div>
            `;
        }

        $('#riwayatProsedur').html(html);

        // Event tombol tampilkan semua
        $('#showMoreProsedurBtn').on('click', function () {
            $('.riwayatProsedurGroup').removeClass('d-none');
            $('#showMoreRowProsedur').remove();
        });
    });
}



    window.copyProsedur = function (kode) {
        const no_rawat = $('#no_rawat').val();

        if (!no_rawat || !kode) {
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: 'No. Rawat atau Kode Prosedur tidak valid.',
                timer: 3000,
                showConfirmButton: false
            });
            return;
        }

        $.post(BASE_URL + 'DiagnosaProsedurRalanController/saveProsedur', {
            no_rawat: no_rawat,
            kode: kode
        }, function (response) {
            if (response.success) {
                loadHasilProsedur();
                loadRiwayatProsedur();
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: 'Prosedur berhasil disalin.',
                    timer: 2000,
                    showConfirmButton: false
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: response.message || 'Prosedur gagal disalin.',
                    timer: 3000,
                    showConfirmButton: false
                });
            }
        }, 'json');
    };


    window.deleteDiagnosa = function (no_rawat, kd_penyakit) {
        Swal.fire({
            title: 'Yakin ingin menghapus?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.post(BASE_URL + 'DiagnosaProsedurRalanController/deleteDiagnosa', {
                    no_rawat: no_rawat,
                    kd_penyakit: kd_penyakit
                }, function (response) {
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.message,
                            timer: 2000,
                            showConfirmButton: false
                        });
                        loadHasilDiagnosa();
                        loadRiwayatDiagnosa();
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: response.message,
                            timer: 3000,
                            showConfirmButton: false
                        });
                    }
                }, 'json');
            }
        });
    };


    window.deleteProsedur = function (no_rawat, kode) {
        Swal.fire({
            title: 'Yakin ingin menghapus?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.post(BASE_URL + 'DiagnosaProsedurRalanController/deleteProsedur', {
                    no_rawat: no_rawat,
                    kode: kode
                }, function (response) {
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.message,
                            timer: 2000,
                            showConfirmButton: false
                        });
                        loadHasilProsedur();
                        loadRiwayatProsedur();
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: response.message,
                            timer: 3000,
                            showConfirmButton: false
                        });
                    }
                }, 'json');
            }
        });
    };
});
