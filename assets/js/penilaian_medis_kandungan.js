/**
 * JavaScript untuk Penilaian Medis Kandungan
 * Author: Ahmad Tohar
 * Date: 2025-12-18
 * Version: 3.0 - Perfect Card Detail
 */
(function() {

$(document).ready(function () {
    const baseUrl = window.BASE_URL || (window.location.origin + "/moizhospitalapps/");
    const noRawat = $('#no_rawat').val();
    const noRM = $('#no_rkm_medis').val();

    const API = {
        save: baseUrl + 'PenilaianMedisKandunganController/save',
        update: baseUrl + 'PenilaianMedisKandunganController/update',
        delete: baseUrl + 'PenilaianMedisKandunganController/delete',
        getHasil: baseUrl + 'PenilaianMedisKandunganController/get_hasil',
        getDetail: baseUrl + 'PenilaianMedisKandunganController/get_detail',
        getLast: baseUrl + 'PenilaianMedisKandunganController/get_last',
        cetak: baseUrl + 'PenilaianMedisKandunganController/cetak'
    };

    let isEditModeKandunganKandungan = false;
    let currentTanggalKandunganKandungan = null;

    loadHasilPenilaian();

    /**
     * Show Alert dengan Auto-Hide
     */
    function showAlert(message, type = 'success') {
        const alertClass = type === 'success' ? 'alert-success' : 'alert-danger';
        const iconClass = type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle';

        const alertHtml = `
            <div class="alert ${alertClass} alert-custom alert-dismissible">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <i class="fa ${iconClass}"></i> ${message}
            </div>
        `;

        $('#alertContainer').html(alertHtml);

        setTimeout(function () {
            $('#alertContainer .alert').fadeOut(300, function () {
                $(this).remove();
            });
        }, 3000);
    }

    /**
     * Validasi Form
     */
    function validateForm() {
        let isValid = true;
        let firstInvalidField = null;

        $('#formPenilaianKandungan [required]').each(function () {
            if (!$(this).val()) {
                isValid = false;
                $(this).addClass('border-danger');
                if (!firstInvalidField) {
                    firstInvalidField = $(this);
                }
            } else {
                $(this).removeClass('border-danger');
            }
        });

        if (!isValid && firstInvalidField) {
            firstInvalidField.focus();
            showAlert('Mohon lengkapi semua field yang wajib diisi (bertanda *)', 'error');
        }

        return isValid;
    }

    /**
     * Submit Form
     */
    $('#formPenilaianKandungan').submit(function (e) {
        e.preventDefault();

        if (!validateForm()) {
            return false;
        }

        const tgl = $('#tanggal_only').val();
        const jam = $('#jam_only').val();
        const tanggal = tgl + ' ' + jam;

        let formData = $(this).serialize();
        formData += '&tanggal=' + encodeURIComponent(tanggal);

        const url = isEditModeKandungan ? API.update : API.save;
        const action = isEditModeKandungan ? 'diupdate' : 'disimpan';

        $.ajax({
            url: url,
            type: 'POST',
            data: formData,
            dataType: 'json',
            beforeSend: function () {
                $('#btnSimpan').prop('disabled', true)
                    .html('<i class="fa fa-spinner fa-spin"></i> Menyimpan...');
            },
            success: function (response) {
                if (response.status === 'success') {
                    showAlert('Data berhasil ' + action + '!', 'success');
                    resetForm();
                    loadHasilPenilaian();
                } else {
                    showAlert(response.message || 'Gagal menyimpan data', 'error');
                }
            },
            error: function (xhr) {
                showAlert('Terjadi kesalahan: ' + xhr.statusText, 'error');
            },
            complete: function () {
                $('#btnSimpan').prop('disabled', false)
                    .html('<i class="fa fa-save"></i> Simpan');
            }
        });
    });

    /**
     * Load Hasil Penilaian
     */
    function loadHasilPenilaian() {
        $.ajax({
            url: API.getHasil,
            type: 'GET',
            data: { no_rawat: noRawat },
            dataType: 'json',
            success: function (response) {
                if (response.status === 'success') {
                    renderTable(response.data);
                }
            }
        });
    }

    /**
     * Render Table
     */
    function renderTable(data) {
        const tbody = $('#tblHasil tbody');
        tbody.empty();

        if (!data || data.length === 0) {
            tbody.append('<tr><td colspan="4" class="text-center text-muted">Belum ada data penilaian</td></tr>');
            return;
        }

        data.forEach(function (item) {
            const row = `
                <tr>
                    <td>${formatDateTime(item.tanggal)}</td>
                    <td>${item.nm_dokter || '-'}</td>
                    <td>${item.diagnosis || '-'}</td>
                    <td>
                        <div class="btn-group">
                            <button class="btn btn-xs btn-info btn-detail" data-tanggal="${item.tanggal}">
                                <i class="fa fa-eye"></i> Detail
                            </button>
                            <button class="btn btn-xs btn-warning btn-edit" data-tanggal="${item.tanggal}">
                                <i class="fa fa-edit"></i> Edit
                            </button>
                            <button class="btn btn-xs btn-danger btn-delete" data-tanggal="${item.tanggal}">
                                <i class="fa fa-trash"></i> Hapus
                            </button>
                            <a href="${API.cetak}?no_rawat=${noRawat}&tanggal=${item.tanggal}" 
                               target="_blank" class="btn btn-xs btn-success">
                                <i class="fa fa-print"></i> Cetak
                            </a>
                        </div>
                    </td>
                </tr>
            `;
            tbody.append(row);
        });

        bindTableEvents();
    }

    /**
     * Bind Table Events
     */
    function bindTableEvents() {
        $('.btn-detail').off('click').on('click', function () {
            showDetail($(this).data('tanggal'));
        });

        $('.btn-edit').off('click').on('click', function () {
            loadForEdit($(this).data('tanggal'));
        });

        $('.btn-delete').off('click').on('click', function () {
            deleteData($(this).data('tanggal'));
        });
    }

    /**
     * Show Detail
     */
    function showDetail(tanggal) {
        $.ajax({
            url: API.getDetail,
            type: 'GET',
            data: { no_rawat: noRawat, tanggal: tanggal },
            dataType: 'json',
            success: function (response) {
                if (response.status === 'success') {
                    renderDetailModal(response.data);
                    $('#modalDetail').modal('show');
                }
            }
        });
    }

    /**
     * Render Detail Modal - PERFECT CARD
     */
    function renderDetailModal(data) {
        const html = `
            <style>
                .detail-section {
                    margin-bottom: 20px;
                }
                .detail-section-title {
                    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                    color: white;
                    padding: 8px 15px;
                    border-radius: 5px;
                    margin-bottom: 10px;
                    font-weight: bold;
                }
                .detail-row {
                    display: flex;
                    padding: 8px 0;
                    border-bottom: 1px solid #f0f0f0;
                }
                .detail-row:last-child {
                    border-bottom: none;
                }
                .detail-label {
                    width: 35%;
                    font-weight: 600;
                    color: #555;
                }
                .detail-value {
                    width: 65%;
                    color: #333;
                }
                .badge-custom {
                    display: inline-block;
                    padding: 3px 8px;
                    border-radius: 3px;
                    font-size: 11px;
                    font-weight: 600;
                }
                .badge-info { background: #3c8dbc; color: white; }
                .badge-success { background: #00a65a; color: white; }
                .badge-warning { background: #f39c12; color: white; }
            </style>

            <!-- Header Info -->
            <div class="detail-section">
                <div class="detail-section-title">
                    <i class="fa fa-info-circle"></i> Informasi Pemeriksaan
                </div>
                <div class="detail-row">
                    <div class="detail-label">Tanggal</div>
                    <div class="detail-value"><strong>${formatDateTime(data.tanggal)}</strong></div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Dokter Pemeriksa</div>
                    <div class="detail-value">${data.nm_dokter || '-'}</div>
                </div>
            </div>

            <!-- Anamnesis -->
            <div class="detail-section">
                <div class="detail-section-title">
                    <i class="fa fa-stethoscope"></i> Anamnesis
                </div>
                <div class="detail-row">
                    <div class="detail-label">Jenis Anamnesis</div>
                    <div class="detail-value">
                        <span class="badge-custom badge-info">${data.anamnesis || '-'}</span>
                        ${data.hubungan ? ' - ' + data.hubungan : ''}
                    </div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Keluhan Utama</div>
                    <div class="detail-value">${data.keluhan_utama || '-'}</div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">RPS</div>
                    <div class="detail-value">${data.rps || '-'}</div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">RPD</div>
                    <div class="detail-value">${data.rpd || '-'}</div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Alergi</div>
                    <div class="detail-value">
                        <span class="badge-custom badge-warning">${data.alergi || '-'}</span>
                    </div>
                </div>
            </div>

            <!-- Tanda Vital -->
            <div class="detail-section">
                <div class="detail-section-title">
                    <i class="fa fa-heartbeat"></i> Tanda Vital & Kesadaran
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="detail-row">
                            <div class="detail-label">Keadaan Umum</div>
                            <div class="detail-value"><span class="badge-custom badge-info">${data.keadaan || '-'}</span></div>
                        </div>
                        <div class="detail-row">
                            <div class="detail-label">Kesadaran</div>
                            <div class="detail-value"><span class="badge-custom badge-success">${data.kesadaran || '-'}</span></div>
                        </div>
                        <div class="detail-row">
                            <div class="detail-label">GCS</div>
                            <div class="detail-value">${data.gcs || '-'}</div>
                        </div>
                        <div class="detail-row">
                            <div class="detail-label">TD</div>
                            <div class="detail-value"><strong>${data.td || '-'}</strong> mmHg</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="detail-row">
                            <div class="detail-label">Nadi</div>
                            <div class="detail-value"><strong>${data.nadi || '-'}</strong> x/mnt</div>
                        </div>
                        <div class="detail-row">
                            <div class="detail-label">RR</div>
                            <div class="detail-value"><strong>${data.rr || '-'}</strong> x/mnt</div>
                        </div>
                        <div class="detail-row">
                            <div class="detail-label">Suhu</div>
                            <div class="detail-value"><strong>${data.suhu || '-'}</strong> °C</div>
                        </div>
                        <div class="detail-row">
                            <div class="detail-label">BB / TB</div>
                            <div class="detail-value"><strong>${data.bb || '-'}</strong> kg / <strong>${data.tb || '-'}</strong> cm</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pemeriksaan Fisik -->
            <div class="detail-section">
                <div class="detail-section-title">
                    <i class="fa fa-user-md"></i> Pemeriksaan Fisik
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="detail-row">
                            <div class="detail-label">Kepala</div>
                            <div class="detail-value">${getBadgeStatus(data.kepala)}</div>
                        </div>
                        <div class="detail-row">
                            <div class="detail-label">Mata</div>
                            <div class="detail-value">${getBadgeStatus(data.mata)}</div>
                        </div>
                        <div class="detail-row">
                            <div class="detail-label">THT</div>
                            <div class="detail-value">${getBadgeStatus(data.tht)}</div>
                        </div>
                        <div class="detail-row">
                            <div class="detail-label">Thoraks</div>
                            <div class="detail-value">${getBadgeStatus(data.thoraks)}</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="detail-row">
                            <div class="detail-label">Abdomen</div>
                            <div class="detail-value">${getBadgeStatus(data.abdomen)}</div>
                        </div>
                        <div class="detail-row">
                            <div class="detail-label">Genital</div>
                            <div class="detail-value">${getBadgeStatus(data.genital)}</div>
                        </div>
                        <div class="detail-row">
                            <div class="detail-label">Ekstremitas</div>
                            <div class="detail-value">${getBadgeStatus(data.ekstremitas)}</div>
                        </div>
                    </div>
                </div>
                ${data.ket_fisik ? `
                    <div class="detail-row">
                        <div class="detail-label">Keterangan</div>
                        <div class="detail-value">${data.ket_fisik}</div>
                    </div>
                ` : ''}
            </div>

            <!-- Pemeriksaan Obstetri -->
            ${(data.tfu || data.djj) ? `
                <div class="detail-section">
                    <div class="detail-section-title">
                        <i class="fa fa-female"></i> Pemeriksaan Obstetri
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="detail-row">
                                <div class="detail-label">TFU</div>
                                <div class="detail-value"><strong>${data.tfu || '-'}</strong> cm</div>
                            </div>
                            <div class="detail-row">
                                <div class="detail-label">TBJ</div>
                                <div class="detail-value"><strong>${data.tbj || '-'}</strong> gram</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="detail-row">
                                <div class="detail-label">DJJ</div>
                                <div class="detail-value"><strong>${data.djj || '-'}</strong> x/mnt</div>
                            </div>
                            <div class="detail-row">
                                <div class="detail-label">Kontraksi</div>
                                <div class="detail-value">${data.kontraksi || '-'}</div>
                            </div>
                        </div>
                    </div>
                    ${data.his ? `
                        <div class="detail-row">
                            <div class="detail-label">His</div>
                            <div class="detail-value">${data.his}</div>
                        </div>
                    ` : ''}
                </div>
            ` : ''}

            <!-- Pemeriksaan Ginekologi -->
            ${(data.inspeksi || data.inspekulo || data.vt) ? `
                <div class="detail-section">
                    <div class="detail-section-title">
                        <i class="fa fa-venus"></i> Pemeriksaan Ginekologi
                    </div>
                    ${data.inspeksi ? `
                        <div class="detail-row">
                            <div class="detail-label">Inspeksi Vulva</div>
                            <div class="detail-value">${data.inspeksi}</div>
                        </div>
                    ` : ''}
                    ${data.inspekulo ? `
                        <div class="detail-row">
                            <div class="detail-label">Inspekulo</div>
                            <div class="detail-value">${data.inspekulo}</div>
                        </div>
                    ` : ''}
                    ${data.vt ? `
                        <div class="detail-row">
                            <div class="detail-label">VT</div>
                            <div class="detail-value">${data.vt}</div>
                        </div>
                    ` : ''}
                    ${data.rt ? `
                        <div class="detail-row">
                            <div class="detail-label">RT</div>
                            <div class="detail-value">${data.rt}</div>
                        </div>
                    ` : ''}
                </div>
            ` : ''}

            <!-- Pemeriksaan Penunjang -->
            ${(data.ultra || data.kardio || data.lab) ? `
                <div class="detail-section">
                    <div class="detail-section-title">
                        <i class="fa fa-flask"></i> Pemeriksaan Penunjang
                    </div>
                    ${data.ultra ? `
                        <div class="detail-row">
                            <div class="detail-label">USG</div>
                            <div class="detail-value">${data.ultra}</div>
                        </div>
                    ` : ''}
                    ${data.kardio ? `
                        <div class="detail-row">
                            <div class="detail-label">Kardiotokografi</div>
                            <div class="detail-value">${data.kardio}</div>
                        </div>
                    ` : ''}
                    ${data.lab ? `
                        <div class="detail-row">
                            <div class="detail-label">Laboratorium</div>
                            <div class="detail-value">${data.lab}</div>
                        </div>
                    ` : ''}
                </div>
            ` : ''}

            <!-- Diagnosis & Tatalaksana -->
            <div class="detail-section">
                <div class="detail-section-title">
                    <i class="fa fa-medkit"></i> Diagnosis & Tatalaksana
                </div>
                <div class="detail-row">
                    <div class="detail-label">Diagnosis</div>
                    <div class="detail-value"><strong>${data.diagnosis || '-'}</strong></div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Tatalaksana</div>
                    <div class="detail-value">${data.tata || '-'}</div>
                </div>
                ${data.konsul ? `
                    <div class="detail-row">
                        <div class="detail-label">Konsultasi</div>
                        <div class="detail-value">${data.konsul}</div>
                    </div>
                ` : ''}
            </div>
        `;
        $('#detailContent').html(html);
    }

    /**
     * Get Badge Status
     */
    function getBadgeStatus(status) {
        if (!status) return '-';

        let badgeClass = 'badge-info';
        if (status === 'Normal') badgeClass = 'badge-success';
        else if (status === 'Abnormal') badgeClass = 'badge-warning';

        return `<span class="badge-custom ${badgeClass}">${status}</span>`;
    }

    /**
     * Load For Edit
     */
    function loadForEdit(tanggal) {
        $.ajax({
            url: API.getDetail,
            type: 'GET',
            data: { no_rawat: noRawat, tanggal: tanggal },
            dataType: 'json',
            success: function (response) {
                if (response.status === 'success') {
                    fillForm(response.data);
                    isEditModeKandungan = true;
                    currentTanggalKandungan = tanggal;
                    $('#btnSimpan').html('<i class="fa fa-save"></i> Update');
                    showAlert('Mode Edit. Ubah data lalu klik Update.', 'success');
                    $('html, body').animate({ scrollTop: 0 }, 500);
                }
            }
        });
    }

    /**
     * Fill Form
     */
    function fillForm(data) {
        const dt = data.tanggal.split(' ');
        $('#tanggal_only').val(dt[0]);
        $('#jam_only').val(dt[1]);

        Object.keys(data).forEach(function (key) {
            const input = $('[name="' + key + '"]');
            if (input.length) {
                input.val(data[key]).removeClass('border-danger');
            }
        });
    }

    /**
     * Delete Data
     */
    function deleteData(tanggal) {
        if (!confirm('Yakin ingin menghapus data ini?')) {
            return;
        }

        $.ajax({
            url: API.delete,
            type: 'POST',
            data: { no_rawat: noRawat, tanggal: tanggal },
            dataType: 'json',
            success: function (response) {
                if (response.status === 'success') {
                    showAlert('Data berhasil dihapus!', 'success');
                    loadHasilPenilaian();
                } else {
                    showAlert(response.message || 'Gagal menghapus data', 'error');
                }
            }
        });
    }

    /**
     * Copy Last Data
     */
    $('#btnCopyLast').click(function () {
        $.ajax({
            url: API.getLast,
            type: 'GET',
            data: { no_rkm_medis: noRM },
            dataType: 'json',
            success: function (response) {
                if (response.status === 'success') {
                    fillForm(response.data);
                    showAlert('Data terakhir berhasil di-copy!', 'success');
                } else {
                    showAlert('Tidak ada data sebelumnya', 'error');
                }
            }
        });
    });

    /**
     * Reset Form
     */
    $('#btnReset').click(function () {
        if (confirm('Reset form? Data yang belum disimpan akan hilang.')) {
            resetForm();
        }
    });

    function resetForm() {
        $('#formPenilaianKandungan')[0].reset();
        $('#formPenilaianKandungan [required]').removeClass('border-danger');
        isEditModeKandungan = false;
        currentTanggalKandungan = null;
        $('#btnSimpan').html('<i class="fa fa-save"></i> Simpan');
    }

    /**
     * Format DateTime
     */
    function formatDateTime(datetime) {
        if (!datetime) return '-';
        const d = new Date(datetime);
        const date = d.toLocaleDateString('id-ID');
        const time = d.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' });
        return `${date} ${time}`;
    }
});
})();
