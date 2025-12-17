$(document).ready(function () {
    const BASE_URL = `${window.location.origin}/${window.location.pathname.split('/')[1]}/`;
    const no_rawat = $('#no_rawat').val();
    const kd_dokter = $('#kd_dokter').val();
    const selectedTindakan = new Map();

    // Capitalize otomatis
    $('#informasi_tambahan, #diagnosa_klinis').on('input', function () {
        $(this).val($(this).val().toUpperCase());
    });

    // ✅ Tampilkan tindakan terpilih
    function updateTindakanTerpilih() {
        let html = '';

        if (selectedTindakan.size === 0) {
            html = '<p class="text-muted">Belum ada tindakan dipilih.</p>';
        } else {
            html = `
                <table class="table table-bordered table-sm">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Pemeriksaan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
            `;

            let index = 1;
            selectedTindakan.forEach((val, kode) => {
                html += `
                    <tr>
                        <td>${index++}</td>
                        <td>${val}</td>
                        <td>
                            <button class="btn btn-sm btn-danger" onclick="hapusTindakanTerpilih('${kode}')">
                                <i class="fa fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                `;
            });

            html += '</tbody></table>';
        }

        $('#tabelTindakanRadiologiTerpilih').html(html);
    }

    // ✅ Tambah tindakan
    window.tambahTindakanTerpilih = function (kode, nama) {
        selectedTindakan.set(kode, nama);
        updateTindakanTerpilih();
        $('#cariRadiologi').val('');
        $('#hasilPencarianRadiologi').html('');
    };

    // ✅ Hapus tindakan
    window.hapusTindakanTerpilih = function (kode) {
        selectedTindakan.delete(kode);
        updateTindakanTerpilih();
    };

    // ✅ Copy dari riwayat
    window.copyRadiologi = function (kd_jenis_prw, informasi_tambahan, diagnosa_klinis, nm_perawatan) {
        selectedTindakan.set(kd_jenis_prw, nm_perawatan);
        $('#informasi_tambahan').val(informasi_tambahan);
        $('#diagnosa_klinis').val(diagnosa_klinis);
        updateTindakanTerpilih();
    };

    // ✅ Delete dari riwayat
    window.deleteRadiologi = function (noorder, kd_jenis_prw) {
        Swal.fire({
            title: 'Yakin ingin menghapus?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, hapus!'
        }).then(result => {
            if (result.isConfirmed) {
                $.post(BASE_URL + 'PermintaanRadiologiController/deleteRadiologi', {
                    noorder,
                    kd_jenis_prw
                }, function (res) {
                    if (res.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil dihapus',
                            timer: 2000,
                            showConfirmButton: false
                        });
                        loadRiwayatPermintaanRadiologi();
                    }
                }, 'json');
            }
        });
    };

    // ✅ Simpan permintaan
    $('#btnSimpanRadiologi').on('click', function () {
        const informasi_tambahan = String($('#informasi_tambahan').val() || '').trim().toUpperCase();
        const diagnosa_klinis = String($('#diagnosa_klinis').val() || '').trim().toUpperCase();
        $('#informasi_tambahan').val(informasi_tambahan);
        $('#diagnosa_klinis').val(diagnosa_klinis);

        const tgl_permintaan = new Date().toISOString().slice(0, 10);
        const jam_permintaan = new Date().toTimeString().slice(0, 8);
        const kd_jenis_prw = Array.from(selectedTindakan.keys());

        if (!informasi_tambahan || !diagnosa_klinis) {
            Swal.fire({
                icon: 'warning',
                title: 'Form belum lengkap!',
                text: 'Isi informasi tambahan dan diagnosa klinis.',
                timer: 3000,
                showConfirmButton: false
            });
            return;
        }

        if (kd_jenis_prw.length === 0) {
            Swal.fire({
                icon: 'warning',
                title: 'Tindakan belum dipilih!',
                text: 'Pilih minimal satu tindakan.',
                timer: 3000,
                showConfirmButton: false
            });
            return;
        }

        $.post(BASE_URL + 'PermintaanRadiologiController/save', {
            no_rawat,
            kd_dokter,
            tgl_permintaan,
            jam_permintaan,
            informasi_tambahan,
            diagnosa_klinis,
            kd_jenis_prw
        }, function (res) {
            if (res.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: 'Permintaan berhasil disimpan.',
                    timer: 2000,
                    showConfirmButton: false
                });

                $('#informasi_tambahan').val('');
                $('#diagnosa_klinis').val('');
                selectedTindakan.clear();
                updateTindakanTerpilih();
                loadRiwayatPermintaanRadiologi();
            }
        }, 'json');
    });

    // ✅ Cari tindakan
    $('#cariRadiologi').on('keyup', function () {
        const keyword = $(this).val().toLowerCase();
        if (!keyword) {
            $('#hasilPencarianRadiologi').html('');
            return;
        }

        $.getJSON(BASE_URL + 'PermintaanRadiologiController/get_list_radiologi', function (data) {
            const filtered = data.filter(item =>
                item.kd_jenis_prw.toLowerCase().includes(keyword) ||
                item.nm_perawatan.toLowerCase().includes(keyword)
            );

            let html = '';
            if (filtered.length === 0) {
                html = '<p class="text-center text-danger">Tindakan tidak ditemukan.</p>';
            } else {
                html = `
                    <table class="table table-bordered table-sm">
                        <thead><tr><th>No</th><th>Pemeriksaan</th><th>Aksi</th></tr></thead>
                        <tbody>
                `;
                filtered.forEach((item, i) => {
                    const namaSafe = item.nm_perawatan.replace(/'/g, "\\'");
                    html += `
                        <tr>
                            <td>${i + 1}</td>
                            <td>${item.nm_perawatan}</td>
                            <td>
                                <button class="btn btn-sm btn-primary" 
                                    onclick="tambahTindakanTerpilih('${item.kd_jenis_prw}', '${namaSafe}')">
                                    <i class="fa fa-plus"></i> Pilih
                                </button>
                            </td>
                        </tr>
                    `;
                });
                html += '</tbody></table>';
            }

            $('#hasilPencarianRadiologi').html(html);
        });
    });

    // ✅ Load riwayat
    function loadRiwayatPermintaanRadiologi() {
        $.getJSON(BASE_URL + 'PermintaanRadiologiController/getRiwayatRadiologiByNorm', {
            no_rkm_medis: $('#no_rkm_medis').val()
        }, function (data) {
            if (data.length === 0) {
                $('#riwayatPermintaanRadiologi').html('<p class="text-muted">Belum ada riwayat permintaan.</p>');
                return;
            }

            let grouped = {};
            data.forEach(item => {
                if (!grouped[item.noorder]) grouped[item.noorder] = [];
                grouped[item.noorder].push(item);
            });

            let html = '';
            for (const [noorder, items] of Object.entries(grouped)) {
                const tgl = items[0].tgl_permintaan || '-';
                const jam = items[0].jam_permintaan || '-';

                html += `
                    <div class="mb-3 border p-2 rounded">
                        <div><span class="badge bg-danger">No. Order: ${noorder}</span><br>
                        <small class="text-muted">Tanggal: ${tgl} | Jam: ${jam}</small></div>
                        <table class="table table-sm table-bordered mt-2">
                            <thead><tr>
                                <th>No</th><th>Kode</th><th>Pemeriksaan</th>
                                <th>Informasi Tambahan</th><th>Diagnosa Klinis</th>
                                <th>Poli</th><th>Dokter</th><th>Status</th><th>Aksi</th>
                            </tr></thead><tbody>
                `;

                items.forEach((item, i) => {
                    const validated = item.tgl_hasil !== '0000-00-00' && item.jam_hasil !== '00:00:00';
                    const status = validated
                        ? '<span class="badge bg-success">Tervalidasi</span>'
                        : '<span class="badge bg-warning text-dark">Belum</span>';

                    html += `
                        <tr>
                            <td>${i + 1}</td>
                            <td>${item.kd_jenis_prw}</td>
                            <td>${item.nm_perawatan}</td>
                            <td>${item.informasi_tambahan}</td>
                            <td>${item.diagnosa_klinis}</td>
                            <td>${item.nm_poli}</td>
                            <td>${item.nm_dokter}</td>
                            <td>${status}</td>
                            <td>
                                <button class="btn btn-sm btn-success" 
                                    onclick="copyRadiologi('${item.kd_jenis_prw}', '${item.informasi_tambahan}', '${item.diagnosa_klinis}', '${item.nm_perawatan}')">
                                    <i class="fa fa-copy"></i>
                                </button>
                                ${!validated ? `
                                <button class="btn btn-sm btn-danger" 
                                    onclick="deleteRadiologi('${item.noorder}', '${item.kd_jenis_prw}')">
                                    <i class="fa fa-trash"></i>
                                </button>` : ''}
                            </td>
                        </tr>
                    `;
                });

                html += '</tbody></table></div>';
            }

            $('#riwayatPermintaanRadiologi').html(html);
        });
    }

    // Inisialisasi awal
    updateTindakanTerpilih();
    loadRiwayatPermintaanRadiologi();
});
