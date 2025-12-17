
(function () {
    'use strict';

    // State
    const state = {
        masterData: [],
        no_rawat: $('#plb_no_rawat').val(),
        kd_dokter: $('#plb_kd_dokter').val(),
        urls: {
            master: $('#plb_url_master').val(),
            simpan: $('#plb_url_simpan').val(),
            riwayat: $('#plb_url_riwayat').val(),
            hapus: $('#plb_url_hapus').val()
        }
    };

    // Elements
    const el = {
        tree: $('#plb_tree_container'),
        search: $('#plb_search'),
        btnSimpan: $('#plb_btn_simpan'),
        histContainer: $('#plb_history_container'),
        summary: $('#plb_summary'),
        inputDiag: $('#plb_diagnosa'),
        inputInfo: $('#plb_info')
    };

    // Init
    $(document).ready(function () {
        initEvents();
        loadMasterData();
        loadHistory();
    });

    function initEvents() {
        // Search
        el.search.on('keyup', function () {
            const kw = $(this).val().toLowerCase().trim();
            filterTree(kw);
        });

        // Toggle Category Expansion
        el.tree.on('click', '.lab-cat-header', function (e) {
            // Ignore if clicked on checkbox directly to prevent conflict
            if ($(e.target).hasClass('lab-cat-cb')) return;

            const catId = $(this).data('cat');
            const $container = $(`.lab-items-container[data-cat="${catId}"]`);
            const $icon = $(this).find('.fa-chevron-right, .fa-chevron-down');

            if ($container.hasClass('show')) {
                $container.removeClass('show');
                $icon.removeClass('fa-chevron-down').addClass('fa-chevron-right');
            } else {
                $container.addClass('show');
                $icon.removeClass('fa-chevron-right').addClass('fa-chevron-down');
            }
        });

        // Category Checkbox
        el.tree.on('change', '.lab-cat-cb', function () {
            const catId = $(this).data('cat');
            const isChecked = $(this).is(':checked');

            // Find all visible children
            const $children = $(`.lab-items-container[data-cat="${catId}"]`).find('.lab-cb:visible');
            $children.prop('checked', isChecked);
            updateSummary();
        });

        // Item Checkbox
        el.tree.on('change', '.lab-cb', function () {
            updateSummary();
        });

        // Simpan
        el.btnSimpan.on('click', savePermintaan);

        // Delete History
        el.histContainer.on('click', '.btn-delete-order', function (e) {
            e.stopPropagation();
            const noorder = $(this).data('noorder');
            deleteOrder(noorder);
        });

        // Expand History
        el.histContainer.on('click', '.hist-header', function () {
            const $body = $(this).next('.hist-body');
            $body.slideToggle('fast');
        });

        // Textarea Uppercase
        el.inputDiag.on('input', function () { $(this).val($(this).val().toUpperCase()); });
        el.inputInfo.on('input', function () { $(this).val($(this).val().toUpperCase()); });
    }

    function loadMasterData() {
        $.get(state.urls.master, function (data) {
            state.masterData = data;
            renderTree(data);
        }).fail(function () {
            el.tree.html('<div class="text-danger text-center p-3">Gagal memuat data master laboratorium.</div>');
        });
    }

    function formatRupiah(angka) {
        if (angka == null) return '0';
        return new Intl.NumberFormat('id-ID').format(angka);
    }

    function renderTree(data) {
        if (!data || data.length === 0) {
            el.tree.html('<div class="text-muted text-center p-3">Data tidak ditemukan.</div>');
            return;
        }

        let html = '';
        data.forEach(cat => {
            const items = cat.items || [];
            const tarif = cat.total_byr || 0;
            const catId = cat.kd_jenis_prw;

            // BPJS-like Header Style: Solid Green/Teal, White Text
            html += `
            <div class="lab-category-wrapper" data-cat-name="${cat.nm_perawatan.toLowerCase()}" style="margin-bottom: 10px; border-radius: 4px; overflow: hidden; border: 1px solid #00a65a;">
                <div class="lab-cat-header" data-cat="${catId}" style="background-color: #00a65a; color: white; padding: 10px 15px; cursor: pointer; display: flex; align-items: center; justify-content: space-between;">
                    
                    <div style="display: flex; align-items: center;">
                         <input type="checkbox" class="lab-cat-cb mr-2" 
                           data-cat="${catId}" 
                           data-tarif="${tarif}"
                           data-nama="${cat.nm_perawatan}"
                           style="width: 18px; height: 18px; margin-top: 0; margin-right: 10px; cursor: pointer;">
                        <span class="lab-cat-title" style="font-weight: bold; font-size: 14px;">${cat.nm_perawatan}</span>
                    </div>

                    <div style="display: flex; align-items: center;">
                        <span class="badge" style="background: rgba(0,0,0,0.2); font-weight: normal; margin-right: 10px;">${formatRupiah(tarif)}</span>
                        <i class="fa fa-chevron-down transition-icon"></i>
                    </div>
                </div>
                
                <div class="lab-items-container" data-cat="${catId}" style="display: none; background: #fff; padding: 0;">`;

            // Table with Number Column
            html += `<table class="table table-bordered table-striped table-hover mb-0 lab-table">
                        <thead style="background: #f1f8e9;">
                            <tr>
                                <th class="text-center" width="40">No</th>
                                <th class="text-center" width="40"><i class="fa fa-check"></i></th>
                                <th>Pemeriksaan</th>
                                <th width="100">Satuan</th>
                                <th>Nilai Rujukan</th>
                                <th width="120" class="text-right">Biaya Item</th>
                            </tr>
                        </thead>
                        <tbody>`;

            if (items.length > 0) {
                items.forEach((item, index) => {
                    let refStr = '';
                    const refs = [];
                    if (item.nilai_rujukan_ld && item.nilai_rujukan_ld !== '-') refs.push(`LD: ${item.nilai_rujukan_ld}`);
                    if (item.nilai_rujukan_la && item.nilai_rujukan_la !== '-') refs.push(`LA: ${item.nilai_rujukan_la}`);
                    if (item.nilai_rujukan_pd && item.nilai_rujukan_pd !== '-') refs.push(`PD: ${item.nilai_rujukan_pd}`);
                    if (item.nilai_rujukan_pa && item.nilai_rujukan_pa !== '-') refs.push(`PA: ${item.nilai_rujukan_pa}`);

                    refStr = refs.join('<br>');
                    if (!refStr) refStr = '-';

                    html += `
                    <tr class="lab-item-row" data-item-name="${item.Pemeriksaan.toLowerCase()}">
                        <td class="text-center" style="vertical-align: middle;">${index + 1}</td>
                        <td class="text-center" style="vertical-align: middle;">
                             <input type="checkbox" class="lab-cb" 
                                value="${item.id_template}" 
                                data-cat="${cat.kd_jenis_prw}"
                                data-cat-name="${cat.nm_perawatan}"
                                data-tarif="0"
                                style="width: 16px; height: 16px;">
                        </td>
                        <td onclick="$(this).closest('tr').find('.lab-cb').click()" style="cursor:pointer; vertical-align: middle;">
                            <span class="text-dark font-weight-bold" style="font-size: 13px;">${item.Pemeriksaan}</span>
                        </td>
                        <td style="vertical-align: middle;">${item.satuan || '-'}</td>
                        <td style="vertical-align: middle;"><small class="text-muted" style="font-size: 0.85em;">${refStr}</small></td>
                        <td class="text-right" style="vertical-align: middle;">0</td>
                    </tr>`;
                });
            } else {
                html += `<tr><td colspan="6" class="p-4 text-center text-muted"><em>Pilih Header untuk tes ini (Tanpa detail template)</em></td></tr>`;
            }

            html += `</tbody></table></div></div>`;
        });

        el.tree.html(html);
    }

    function filterTree(kw) {
        if (!kw) {
            // Reset
            $('.lab-category-wrapper').show();
            $('.lab-item-row').show();
            $('.lab-items-container').removeClass('show').prev().find('.fa-chevron-down').removeClass('fa-chevron-down').addClass('fa-chevron-right');
            return;
        }

        $('.lab-category-wrapper').each(function () {
            const $cat = $(this);
            const catName = $cat.data('cat-name');
            const catMatch = catName.includes(kw);

            let hasChildMatch = false;

            // Check Children
            $cat.find('.lab-item-row').each(function () {
                const $item = $(this);
                const itemName = $item.data('item-name');
                if (itemName.includes(kw) || catMatch) {
                    $item.show();
                    hasChildMatch = true;
                } else {
                    $item.hide();
                }
            });

            if (catMatch || hasChildMatch) {
                $cat.show();
                // Auto expand if there's a match
                $cat.find('.lab-items-container').addClass('show');
                $cat.find('.fa-chevron-right').removeClass('fa-chevron-right').addClass('fa-chevron-down');
            } else {
                $cat.hide();
            }
        });
    }

    // Logic to select checkboxes:
    // If Category CB is checked -> Check all visible children.
    // If Child CB is checked -> Auto check Category CB (because in Khanza you need the parent to order).

    // Override initEvents checkbox logic more strictly
    // Move logic inside renderSelectedItems for display.

    function updateSummary() {
        renderSelectedItems();
    }

    function renderSelectedItems() {
        const $tbody = $('#table-selected-items tbody');
        $tbody.empty();

        let totalCount = 0;
        let totalBiaya = 0;

        const checkedCats = {};

        // 1. Get Checked Categories
        el.tree.find('.lab-cat-cb:checked').each(function () {
            const catId = $(this).data('cat');
            checkedCats[catId] = {
                name: $(this).data('nama'),
                tarif: parseInt($(this).data('tarif')) || 0,
                items: []
            };
        });

        // 2. Get Checked Items
        el.tree.find('.lab-cb:checked').each(function () {
            const catId = $(this).data('cat');
            if (!checkedCats[catId]) {
                const $catCb = $(`.lab-cat-cb[data-cat="${catId}"]`);
                checkedCats[catId] = {
                    name: $catCb.data('nama'),
                    tarif: parseInt($catCb.data('tarif')) || 0,
                    items: []
                };
                if (!$catCb.prop('checked')) $catCb.prop('checked', true);
            }
            const row = $(this).closest('tr');
            checkedCats[catId].items.push({
                id: $(this).val(),
                name: row.find('td:eq(1)').text().trim(),
                tarif: 0
            });
        });

        // 3. Render Simplified Table (Right Side)
        for (const [catId, catData] of Object.entries(checkedCats)) {
            totalCount++;
            totalBiaya += catData.tarif;

            // Paket Row
            $tbody.append(`
                <tr style="background:#f4f4f4">
                    <td><b>${catData.name}</b></td>
                    <td class="text-right">${formatRupiah(catData.tarif)}</td>
                    <td class="text-center">
                        <button class="btn btn-xs btn-danger btn-remove-cat" data-cat="${catId}"><i class="fa fa-times"></i></button>
                    </td>
                </tr>
            `);

            // Item Rows
            catData.items.forEach(item => {
                $tbody.append(`
                    <tr>
                        <td style="padding-left:20px"><i class="fa fa-angle-right"></i> ${item.name}</td>
                        <td class="text-right">0</td>
                        <td class="text-center">
                             <button class="btn btn-xs btn-default text-red btn-remove-item" data-id="${item.id}"><i class="fa fa-times"></i></button>
                        </td>
                    </tr>
                `);
            });
        }

        $('#selected-count-badge').text(`${totalCount} Paket (${formatRupiah(totalBiaya)})`);

        if (totalCount > 0) {
            $('#section-selected-items').fadeIn('fast');
        } else {
            $('#section-selected-items').fadeOut('fast');
        }
    }

    // Remove Item Event from Top Table
    $(document).on('click', '.btn-remove-item', function () {
        const id = $(this).data('id');
        // Uncheck the original checkbox
        el.tree.find(`.lab-cb[value="${id}"]`).prop('checked', false).trigger('change');
    });

    // Remove Category Event
    $(document).on('click', '.btn-remove-cat', function () {
        const catId = $(this).data('cat');
        // Uncheck Category and all its items
        const $catCb = el.tree.find(`.lab-cat-cb[data-cat="${catId}"]`);
        $catCb.prop('checked', false);
        el.tree.find(`.lab-cb[data-cat="${catId}"]`).prop('checked', false);
        updateSummary();
    });

    function savePermintaan() {
        if (!el.inputDiag.val().trim()) {
            Swal.fire('Peringatan', 'Diagnosa Klinis wajib diisi', 'warning');
            return;
        }

        // Collect Data
        // Structure: items: [ {kd_jenis_prw: '...', templates: [id, id] } ]
        const selectionMap = {};

        // 1. Check direct items
        el.tree.find('.lab-cb:checked').each(function () {
            const cat = $(this).data('cat');
            const id = $(this).val();
            if (!selectionMap[cat]) selectionMap[cat] = [];
            selectionMap[cat].push(id);
        });

        // 2. Check categories that might be checked but have no items (rare case, but safe to handle)
        // or ensure categories are included even if items are selected
        el.tree.find('.lab-cat-cb:checked').each(function () {
            const cat = $(this).data('cat');
            if (!selectionMap[cat]) selectionMap[cat] = [];
        });

        if (Object.keys(selectionMap).length === 0) {
            Swal.fire('Peringatan', 'Belum ada pemeriksaan yang dipilih', 'warning');
            return;
        }

        const itemsPayload = [];
        for (const [key, value] of Object.entries(selectionMap)) {
            itemsPayload.push({
                kd_jenis_prw: key,
                templates: value
            });
        }

        const payload = {
            no_rawat: state.no_rawat,
            kd_dokter: state.kd_dokter,
            diagnosa_klinis: el.inputDiag.val(),
            informasi_tambahan: el.inputInfo.val(),
            items: itemsPayload
        };

        // Disable button
        el.btnSimpan.prop('disabled', true).html('<i class="fa fa-spin fa-spinner"></i> Menyimpan...');

        $.ajax({
            url: state.urls.simpan,
            method: 'POST',
            contentType: 'application/json',
            data: JSON.stringify(payload),
            success: function (res) {
                if (res.status) {
                    Swal.fire({
                        title: 'Berhasil',
                        text: 'Permintaan Lab berhasil dikirim. No Order: ' + res.noorder,
                        icon: 'success',
                        timer: 5000,
                        showConfirmButton: false
                    });
                    // Reset Form
                    el.tree.find('input:checkbox').prop('checked', false);
                    el.inputDiag.val('');
                    el.inputInfo.val('');
                    updateSummary();
                    // Close all expansions
                    filterTree('');
                    loadHistory();
                } else {
                    Swal.fire('Gagal', res.message, 'error');
                }
            },
            error: function () {
                Swal.fire('Error', 'Terjadi kesalahan sistem', 'error');
            },
            complete: function () {
                el.btnSimpan.prop('disabled', false).html('<i class="fa fa-save"></i> Kirim Permintaan');
            }
        });
    }

    function loadHistory() {
        const $wrapper = $('#lab-history-wrapper');
        $wrapper.html('<div class="text-center p-5"><i class="fa fa-spin fa-refresh fa-2x"></i> Memuat Riwayat...</div>');

        $.get(state.urls.riwayat, { no_rawat: state.no_rawat }, function (data) {
            if (!data || data.length === 0) {
                $wrapper.html('<div class="text-center p-5 text-muted">Belum ada riwayat permintaan.</div>');
                return;
            }

            let html = '';
            data.forEach(order => {
                const dateParts = order.tgl_permintaan.split('-');
                const tglIndo = `${dateParts[2]}/${dateParts[1]}/${dateParts[0]}`;

                // Status Logic: Check if tgl_hasil is set (not 0000-00-00)
                const isVal = (order.tgl_hasil && order.tgl_hasil !== '0000-00-00');
                const statusLabel = isVal ? '<span class="label label-success">Tervalidasi</span>' : '<span class="label label-warning">Belum Validasi</span>';

                // Delete Button Logic (Hide if validated)
                let btnDelete = '';
                if (!isVal) {
                    btnDelete = `<button type="button" class="btn btn-box-tool text-red btn-delete-order" data-noorder="${order.noorder}" title="Hapus Permintaan"><i class="fa fa-trash"></i> Hapus</button>`;
                } else {
                    btnDelete = `<span class="text-muted text-sm italic mr-2"><i class="fa fa-lock"></i> Locked</span>`;
                }

                // Header Block
                html += `
                <div class="box box-solid" style="border: 1px solid #d2d6de; margin-bottom: 20px; box-shadow: none;">
                    <div class="box-header with-border" style="background: #f4f4f4; padding: 10px;">
                        <h3 class="box-title" style="font-size: 14px; font-weight: bold; color: #444;">
                            <span class="label label-primary" style="margin-right: 5px;">${order.noorder}</span>
                            <span class="text-muted" style="font-weight: normal; font-size: 13px;"><i class="fa fa-calendar"></i> ${tglIndo} ${order.jam_permintaan}</span>
                            <span style="font-size: 13px; font-weight: normal; margin-left: 10px; color: #333;"><i class="fa fa-user-md"></i> ${order.nm_dokter}</span>
                        </h3>
                        <div class="box-tools pull-right">
                             ${btnDelete}
                        </div>
                    </div>
                    <div class="box-body no-padding">
                        <table class="table table-striped table-hover" style="font-size: 13px; margin-bottom:0;">
                            <thead>
                                <tr>
                                    <th>Pemeriksaan</th>
                                    <th>Diagnosa</th>
                                    <th>Info Tambahan</th>
                                    <th width="120">Status</th>
                                </tr>
                            </thead>
                            <tbody>`;

                // List Categories / Panels
                const cats = order.list_pemeriksaan || {};
                let hasItems = false;
                for (const [kd, catGroup] of Object.entries(cats)) {
                    hasItems = true;
                    html += `
                        <tr>
                            <td><strong>${catGroup.nm_perawatan}</strong>
                                <div style="font-size: 11px; color: #888; padding-left: 10px;">
                                    ${catGroup.items ? catGroup.items.map(i => '- ' + i.nama_pemeriksaan).join('<br>') : ''}
                                </div>
                            </td>
                            <td>${order.diagnosa_klinis || '-'}</td>
                            <td>${order.informasi_tambahan || '-'}</td>
                            <td>${statusLabel}</td>
                        </tr>
                     `;
                }

                if (!hasItems) {
                    html += `<tr><td colspan="4" class="text-center text-muted">Tidak ada detail pemeriksaan.</td></tr>`;
                }

                html += `</tbody></table></div></div>`;
            });

            $wrapper.html(html);
        });
    }

    // Fix Delete Listener (Use Document delegation to catch dynamically added elements outside original container)
    $(document).off('click', '.btn-delete-order').on('click', '.btn-delete-order', function (e) {
        e.preventDefault();
        const noorder = $(this).data('noorder');
        deleteOrder(noorder);
    });

    function deleteOrder(noorder) {
        Swal.fire({
            title: 'Hapus Permintaan?',
            text: "Data yang dihapus tidak dapat dikembalikan",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Hapus'
        }).then((result) => {
            if (result.isConfirmed) {
                $.post(state.urls.hapus, { noorder: noorder }, function (res) {
                    if (res.status) {
                        Swal.fire({
                            title: 'Terhapus',
                            text: 'Data berhasil dihapus',
                            icon: 'success',
                            timer: 5000,
                            showConfirmButton: false
                        });
                        loadHistory();
                    } else {
                        Swal.fire('Gagal', res.message, 'error');
                    }
                }, 'json').fail(function () {
                    Swal.fire('Error', 'Gagal koneksi ke server', 'error');
                });
            }
        });
    }

})();
