/**
 * Panel Pemanggilan Pasien - For Dokter Rawat Jalan
 * 
 * @package    MoizHospital
 * @subpackage Assets/JS
 * @author     Ahmad Tohar
 * @version    1.0.0
 */

const ANTRIAN_REFRESH_INTERVAL = 5000; // 5 seconds

/**
 * Initialize Panel Pemanggilan
 */
$(document).ready(function () {
    if (typeof ANTRIAN_API_URL !== 'undefined' && typeof KD_DOKTER !== 'undefined') {
        console.log('🚀 Panel Pemanggilan initialized for dokter:', KD_DOKTER);
        loadAntrianDokter();

        // Auto-refresh
        setInterval(loadAntrianDokter, ANTRIAN_REFRESH_INTERVAL);
    }
});

/**
 * Load antrian untuk dokter yang sedang login
 */
function loadAntrianDokter() {
    $.ajax({
        url: ANTRIAN_API_URL + 'get_antrian_data',
        method: 'GET',
        dataType: 'json',
        data: {
            kd_dokter: KD_DOKTER,
            status: '' // Semua status
        },
        success: function (response) {
            if (response.success && response.data && response.data.length > 0) {
                renderAntrianTable(response.data);
            } else {
                renderEmptyAntrianTable();
            }
        },
        error: function (xhr, status, error) {
            console.error('Error loading antrian:', error);
            renderErrorAntrianTable();
        }
    });
}

/**
 * Render antrian table
 */
function renderAntrianTable(data) {
    const tbody = $('#antrianTableBody');
    let html = '';

    data.forEach(function (item, index) {
        const statusBadge = getStatusBadge(item.status_panggil);
        const actionButtons = getActionButtons(item);
        const noRegBadge = item.no_reg ? `<span class="badge bg-blue">${item.no_reg}</span>` : '-';

        html += `
            <tr data-no-rawat="${item.no_rawat}">
                <td class="text-center"><strong>${item.no_antrian || '-'}</strong></td>
                <td class="text-center">${noRegBadge}</td>
                <td>${item.no_rkm_medis || '-'}</td>
                <td><strong>${item.nm_pasien || '-'}</strong></td>
                <td>${item.nm_poli || '-'}</td>
                <td class="text-center">${statusBadge}</td>
                <td class="text-center">${actionButtons}</td>
            </tr>
        `;
    });

    tbody.html(html);
}

/**
 * Render empty state
 */
function renderEmptyAntrianTable() {
    const tbody = $('#antrianTableBody');
    const html = `
        <tr>
            <td colspan="7" class="text-center text-muted">
                <i class="fa fa-inbox"></i> Tidak ada antrian untuk hari ini
            </td>
        </tr>
    `;
    tbody.html(html);
}

/**
 * Render error state
 */
function renderErrorAntrianTable() {
    const tbody = $('#antrianTableBody');
    const html = `
        <tr>
            <td colspan="7" class="text-center text-danger">
                <i class="fa fa-exclamation-triangle"></i> Gagal memuat data antrian
            </td>
        </tr>
    `;
    tbody.html(html);
}

/**
 * Get status badge HTML
 */
function getStatusBadge(status) {
    const badges = {
        'Menunggu': '<span class="label label-warning">Menunggu</span>',
        'Dipanggil': '<span class="label label-info">Dipanggil</span>',
        'Sedang Diperiksa': '<span class="label label-primary">Sedang Diperiksa</span>',
        'Selesai': '<span class="label label-success">Selesai</span>',
        'Batal': '<span class="label label-danger">Batal</span>',
        'Tidak Hadir': '<span class="label label-default">Tidak Hadir</span>'
    };

    return badges[status] || '<span class="label label-default">' + status + '</span>';
}

/**
 * Get action buttons based on status
 */
function getActionButtons(item) {
    const noRawat = item.no_rawat;
    const status = item.status_panggil;

    let buttons = '';

    // Tombol Panggil - hanya untuk status Menunggu
    if (status === 'Menunggu') {
        buttons += `
            <button class="btn btn-primary btn-sm btn-panggil" 
                    data-no-rawat="${noRawat}" 
                    data-nama="${item.nm_pasien}"
                    title="Panggil Pasien">
                <i class="fa fa-bullhorn"></i> Panggil
            </button>
        `;
    }

    // Tombol Panggil Ulang - untuk status Dipanggil
    if (status === 'Dipanggil') {
        buttons += `
            <button class="btn btn-warning btn-sm btn-panggil-ulang" 
                    data-no-rawat="${noRawat}" 
                    data-nama="${item.nm_pasien}"
                    title="Panggil Ulang">
                <i class="fa fa-repeat"></i> Panggil Ulang
            </button>
        `;
    }

    // Tombol Mulai Periksa - untuk status Dipanggil
    if (status === 'Dipanggil') {
        buttons += `
            <button class="btn btn-success btn-sm btn-mulai-periksa" 
                    data-no-rawat="${noRawat}"
                    title="Mulai Periksa">
                <i class="fa fa-stethoscope"></i>
            </button>
        `;
    }

    // Tombol Selesai - untuk status Sedang Diperiksa
    if (status === 'Sedang Diperiksa') {
        buttons += `
            <button class="btn btn-success btn-sm btn-selesai" 
                    data-no-rawat="${noRawat}"
                    title="Selesai Periksa">
                <i class="fa fa-check"></i> Selesai
            </button>
        `;
    }

    // Jika sudah selesai, tampilkan info
    if (status === 'Selesai') {
        buttons = '<span class="text-success"><i class="fa fa-check-circle"></i> Selesai</span>';
    }

    return buttons || '-';
}

/**
 * Event handler untuk tombol Panggil
 */
$(document).on('click', '.btn-panggil', function () {
    const btn = $(this);
    const noRawat = btn.data('no-rawat');
    const namaPasien = btn.data('nama');

    // Confirm
    if (!confirm(`Panggil pasien ${namaPasien}?`)) {
        return;
    }

    // Disable button
    btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Memanggil...');

    // Call API
    $.ajax({
        url: ANTRIAN_API_URL + 'panggil_pasien',
        method: 'POST',
        dataType: 'json',
        data: {
            no_rawat: noRawat
        },
        success: function (response) {
            if (response.success) {
                // Show success message
                showNotification('success', 'Pasien berhasil dipanggil!');

                // Reload antrian
                loadAntrianDokter();
            } else {
                showNotification('error', response.message || 'Gagal memanggil pasien');
                btn.prop('disabled', false).html('<i class="fa fa-bullhorn"></i> Panggil');
            }
        },
        error: function (xhr, status, error) {
            console.error('Error calling patient:', error);
            showNotification('error', 'Terjadi kesalahan saat memanggil pasien');
            btn.prop('disabled', false).html('<i class="fa fa-bullhorn"></i> Panggil');
        }
    });
});

/**
 * Event handler untuk tombol Panggil Ulang
 */
$(document).on('click', '.btn-panggil-ulang', function () {
    const btn = $(this);
    const noRawat = btn.data('no-rawat');
    const namaPasien = btn.data('nama');

    // Disable button
    btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Memanggil...');

    // Call API (sama seperti panggil biasa, tapi akan increment jumlah_panggil)
    $.ajax({
        url: ANTRIAN_API_URL + 'panggil_ulang',
        method: 'POST',
        dataType: 'json',
        data: {
            no_rawat: noRawat
        },
        success: function (response) {
            if (response.success) {
                showNotification('info', 'Pasien dipanggil ulang!');
                loadAntrianDokter();
            } else {
                showNotification('error', response.message || 'Gagal memanggil ulang');
                btn.prop('disabled', false).html('<i class="fa fa-repeat"></i> Panggil Ulang');
            }
        },
        error: function (xhr, status, error) {
            console.error('Error recalling patient:', error);
            showNotification('error', 'Terjadi kesalahan saat memanggil ulang');
            btn.prop('disabled', false).html('<i class="fa fa-repeat"></i> Panggil Ulang');
        }
    });
});

/**
 * Event handler untuk tombol Mulai Periksa
 */
$(document).on('click', '.btn-mulai-periksa', function () {
    const btn = $(this);
    const noRawat = btn.data('no-rawat');

    // Disable button
    btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i>');

    // Update status
    $.ajax({
        url: ANTRIAN_API_URL + 'update_status',
        method: 'POST',
        dataType: 'json',
        data: {
            no_rawat: noRawat,
            status: 'Sedang Diperiksa'
        },
        success: function (response) {
            if (response.success) {
                showNotification('success', 'Status diupdate: Sedang Diperiksa');
                loadAntrianDokter();
            } else {
                showNotification('error', response.message || 'Gagal update status');
                btn.prop('disabled', false).html('<i class="fa fa-stethoscope"></i>');
            }
        },
        error: function (xhr, status, error) {
            console.error('Error updating status:', error);
            showNotification('error', 'Terjadi kesalahan saat update status');
            btn.prop('disabled', false).html('<i class="fa fa-stethoscope"></i>');
        }
    });
});

/**
 * Event handler untuk tombol Selesai
 */
$(document).on('click', '.btn-selesai', function () {
    const btn = $(this);
    const noRawat = btn.data('no-rawat');

    // Confirm
    if (!confirm('Tandai pasien sudah selesai diperiksa?')) {
        return;
    }

    // Disable button
    btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i>');

    // Update status
    $.ajax({
        url: ANTRIAN_API_URL + 'update_status',
        method: 'POST',
        dataType: 'json',
        data: {
            no_rawat: noRawat,
            status: 'Selesai'
        },
        success: function (response) {
            if (response.success) {
                showNotification('success', 'Pasien selesai diperiksa!');
                loadAntrianDokter();
            } else {
                showNotification('error', response.message || 'Gagal update status');
                btn.prop('disabled', false).html('<i class="fa fa-check"></i> Selesai');
            }
        },
        error: function (xhr, status, error) {
            console.error('Error updating status:', error);
            showNotification('error', 'Terjadi kesalahan saat update status');
            btn.prop('disabled', false).html('<i class="fa fa-check"></i> Selesai');
        }
    });
});

/**
 * Show notification
 */
function showNotification(type, message) {
    // Using AdminLTE notification if available
    if (typeof toastr !== 'undefined') {
        toastr[type](message);
    } else {
        // Fallback to alert
        const icons = {
            'success': '✅',
            'error': '❌',
            'info': 'ℹ️',
            'warning': '⚠️'
        };
        alert((icons[type] || '') + ' ' + message);
    }
}
