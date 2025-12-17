/* ============================================================
 * RIWAYAT PASIEN – VERSI FINAL (layout v4)
 * - Hanya tampilkan card ketika ada data
 * - Urutan: 1.SOAP 2.Diagnosa 3.Prosedur 4.Tindakan 5.Resep 6.Lab 7.Radiologi 8.Berkas 9.Resume
 * - Default range: HARI INI
 * - Badge tambahan: SOAP & Tindakan (list + header)
 * - Klik badge => spotlight card terkait
 * - Radiologi: grid thumbnail untuk image + fallback non-image
 * - Robust JSON parsing & null-guard
 * ============================================================ */

$(function () {

    // PRE-FETCH PATIENT & HOSPITAL INFO FOR PRINT HEADERS
    if (typeof API_URLS !== 'undefined' && API_URLS.RP_INFO) {
        $.getJSON(API_URLS.RP_INFO, { no_rkm_medis: $('#rp_no_rkm_medis').val() }, function (res) {
            window.globalInfo = res;
        });
    }

    /* ================== STYLE (sekali saja) ================== */
    if (!document.getElementById('rp-styles-v4')) {
        const css = `
    .rp-detail-grid{display:grid;grid-template-columns:1fr;gap:10px}
    #rp_detail_content, .rp-scroll-all {max-height:75vh;overflow-y:auto;overflow-x:hidden;padding-right:4px}
    #rp_detail_content::-webkit-scrollbar, .rp-scroll-all::-webkit-scrollbar {width:8px}
    #rp_detail_content::-webkit-scrollbar-track, .rp-scroll-all::-webkit-scrollbar-track {background:transparent}
    #rp_detail_content::-webkit-scrollbar-thumb, .rp-scroll-all::-webkit-scrollbar-thumb {background:#bfc7d1;border-radius:4px}
    #rp_detail_content::-webkit-scrollbar-thumb:hover, .rp-scroll-all::-webkit-scrollbar-thumb:hover {background:#aeb6bf}
    .rp-card{border-radius:10px;border:1px solid #e6e6e6;background:#fff;box-shadow:0 1px 2px rgba(0,0,0,.03)}
    .rp-card .rp-card-head{padding:10px 12px;border-bottom:1px solid #eee;display:flex;align-items:center;justify-content:space-between;border-top-left-radius:10px;border-top-right-radius:10px}
    .rp-card .rp-card-title{font-weight:700;letter-spacing:.3px}
    .rp-card .rp-card-body{padding:10px 12px}

    .card--soap .rp-card-head{background:#f6f7ff}
    .card--ttv  .rp-card-head{background:#f3fbff}
    .card--diag .rp-card-head{background:#f9f6ff}
    .card--proc .rp-card-head{background:#f6fff8}
    .card--tind .rp-card-head{background:#fffaf3}
    .card--resep .rp-card-head{background:#f5fff7}
    .card--lab  .rp-card-head{background:#f8fbff}
    .card--rad  .rp-card-head{background:#fff6f6}
    .card--berkas .rp-card-head{background:#f7f7f7}
    .card--penunjang .rp-card-head{background:#f0fff4}
    .card--laptind .rp-card-head{background:#fdf2f8}
    .card--kfr .rp-card-head{background:#ecfeff}
    .card--rehab .rp-card-head{background:#faf5ff}
    .card--resume .rp-card-head{background:#eefcf7}

    .rp-meta{color:#7a7a7a;font-size:12px}
    .rp-badge{display:inline-block;font-size:11px;padding:3px 6px;border-radius:6px;border:1px solid #e3e3e3;margin-right:6px;background:#fff}

    /* ===== HEADER ===== */
    .rp-hdr{padding:10px 12px;border-bottom:1px dashed #e5e5e5}
    .rp-hdr-grid{display:grid;grid-template-columns:auto 1fr auto;gap:10px;align-items:center}
    .rp-hdr-avatar{width:36px;height:36px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-weight:700;background:#eef2ff;color:#3b5bdb;border:1px solid #dfe3ff}
    .rp-hdr-top{display:flex;gap:10px;align-items:center;flex-wrap:wrap}
    .rp-time{font-weight:600}
    .rp-pj{margin-left:auto;color:#8f8f8f}
    .rp-hdr-mid{display:flex;gap:8px;align-items:center;flex-wrap:wrap;margin-top:2px}
    .rp-pill{background:#f3f6ff;border:1px solid #e3e8ff;color:#2b4ad1;border-radius:999px;padding:2px 10px;font-weight:600}
    .rp-doc{color:#444}
    .rp-hdr-meta{display:flex;gap:12px;align-items:center;flex-wrap:wrap;color:#666;margin-top:4px}
    .rp-norawat{font-family:ui-monospace,Menlo,Consolas,monospace;background:#fafafa;border:1px dashed #e5e5e5;border-radius:6px;padding:2px 6px}
    .rp-diag b{color:#444}
    .rp-hdr-badges{margin-top:6px}

    .rp-kv{display:grid;grid-template-columns:repeat(2,1fr);gap:6px}
    .rp-kv .kv{display:flex;justify-content:space-between;border:1px dashed #eaeaea;border-radius:8px;padding:6px 8px;background:#fff}
    .rp-spark{width:100%;height:44px;display:block}

    .rp-all-card{border:1px solid #e6e6e6;border-radius:10px;margin:10px 0;background:#fff}
    .rp-all-body{padding:10px 12px}
    .table.table-condensed>thead>tr>th{background:#fafafa}

    /* Radiologi gallery */
    .rp-grid{display:grid;grid-template-columns:repeat(2,1fr);gap:8px}
    @media(min-width:992px){.rp-grid{grid-template-columns:repeat(3,1fr)}}
    .rp-thumb{border:1px solid #eee;border-radius:8px;overflow:hidden;background:#fff}
    .rp-thumb a{display:block}
    .rp-thumb img{display:block;width:100%;height:160px;object-fit:cover}
    .rp-thumb .cap{padding:6px 8px;font-size:12px;color:#555;border-top:1px solid #f0f0f0;background:#fafafa}

    /* Berkas Digital gallery */
    .bk-grid{display:grid;grid-template-columns:repeat(2,1fr);gap:8px}
    @media(min-width:992px){.bk-grid{grid-template-columns:repeat(3,1fr)}}
    .bk-thumb{border:1px solid #eee;border-radius:8px;overflow:hidden;background:#fff}
    .bk-thumb a{display:block}
    .bk-thumb img{display:block;width:100%;max-width:100%;height:160px;object-fit:cover}
    .bk-thumb .cap{padding:6px 8px;font-size:12px;color:#555;border-top:1px solid #f0f0f0;background:#fafafa}

    /* Badge clickable styles */
    .rp-badge-click{cursor:pointer;transition:all 0.2s ease}
    .rp-badge-click:hover{transform:translateY(-1px);box-shadow:0 2px 4px rgba(0,0,0,0.1)}
    .rp-badge-click:active{transform:translateY(0)}

    @media (min-width:992px){
      .rp-detail-grid{grid-template-columns:1fr 1fr}
      .card--soap, .card--ttv{grid-column:1 / -1}
    }
    @media print {
        @page { size: A4; margin: 1.5cm; }
        body > * { display: none !important; }
    #print_target, #print_target * { visibility: visible !important; }
        #print_target { display: block !important; position: absolute; left: 0; top: 0; width: 100%; min-height: 100%; background: white; z-index: 9999; margin: 0; padding: 0; font-family: "Times New Roman", Times, serif; color: #000; }
        
        /* HIDE internal scripts/styles if they somehow get inside */
        #print_target style, #print_target script, #print_target .no-print { display: none !important; }

        /* Print Specific Styles */
        #print_target .print-container { padding: 0 20px; }
        #print_target .print-header { display: flex; align-items: center; border-bottom: 3px double #000; padding-bottom: 1px; margin-bottom: 10px; }
        #print_target .print-logo { width: 70px; height: 70px; object-fit: contain; margin-right: 15px; }
        #print_target .print-instansi { flex: 1; text-align: center; }
        #print_target .print-instansi h2 { font-size: 18px; margin: 0 0 2px 0; font-weight: bold; text-transform: uppercase; }
        #print_target .print-instansi p { margin: 1px 0; font-size: 11px; }
        
        #print_target .print-subhead { text-align: center; font-size: 14px; font-weight: bold; margin-bottom: 10px; text-decoration: underline; text-transform: uppercase; padding-top: 5px;}
        
        #print_target .patient-info-table { width: 100%; margin-bottom: 15px; font-size: 11px; border: 1px solid #000; border-collapse: collapse; }
        #print_target .patient-info-table td { padding: 3px 6px; border: 1px solid #000; vertical-align: top; }
        #print_target .patient-info-table .label-cell { background-color: #f4f4f4; font-weight: bold; width: 14%; }
        
        #print_target .print-section { margin-bottom: 15px; break-inside: avoid; page-break-inside: avoid; }
        #print_target .section-title { font-size: 12px; font-weight: bold; background: #e0e0e0; border: 1px solid #000; padding: 4px 6px; margin-bottom: 0; text-transform: uppercase; border-bottom: none;}
        #print_target .section-body { border: 1px solid #000; padding: 8px; font-size: 11px; }
        
        #print_target .print-table { width: 100%; border-collapse: collapse; font-size: 10px; margin-top: 5px; }
        #print_target .print-table th, #print_target .print-table td { border: 1px solid #000; padding: 3px; }
        #print_target .print-table th { background-color: #f0f0f0; font-weight: bold; text-align: left; }
        
        #print_target .ttv-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 5px; margin-bottom: 8px; }
        #print_target .ttv-item { border: 1px solid #999; padding: 3px; text-align: center; font-size: 10px; }
        #print_target .ttv-label { font-weight: bold; font-size: 9px; color: #333; text-transform: uppercase; }
        
        /* Helpers */
        #print_target .text-center { text-align: center; }
        #print_target .text-right { text-align: right; }
        #print_target .text-bold { font-weight: bold; }
        #print_target .mt-2 { margin-top: 10px; }
        #print_target .mb-1 { margin-bottom: 5px; }

        /* Grid for 2 signatures */
        #print_target .sig-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-top: 30px; }
        #print_target .sig-box { text-align: center; font-size: 11px; }
        #print_target .sig-box .role { margin-bottom: 50px; }
    }`;;
        const s = document.createElement('style');
        s.id = 'rp-styles-v4';
        s.innerHTML = css;
        document.head.appendChild(s);
    }

    /* ================== STATE & ELEMENTS ================== */
    const state = {
        page: 1, per_page: 50, loading: false, finished: false,
        selected_no_rawat: null, cache_rows: [],
        showAllAfterReload: true,
        badgeSpotlight: null
    };

    const el = {
        norm: $('#rp_no_rkm_medis'),
        currNoRawat: $('#rp_no_rawat'),
        q: $('#rp_q'), dateFrom: $('#rp_date_from'), dateTo: $('#rp_date_to'),
        btnApply: $('#rp_btn_apply'), btnReset: $('#rp_btn_reset'),
        btnAll: $('#rp_btn_all'),
        chips: $('.rp-chip'),
        timeline: $('#rp_timeline'), count: $('#rp_count_rows'),
        loader: $('#rp_loader'),
        detSingle: $('#rp_detail_single'),
        detAll: $('#rp_detail_all'),
        detContent: $('#rp_detail_content'),
        allContent: $('#rp_all_content'),
        detNo: $('#det_norawat'), detTgl: $('#det_tgl'), detJam: $('#det_jam'),
        detPoli: $('#det_poli'), detDokter: $('#det_dokter'), detPj: $('#det_penjamin'),
    };

    /* ================== UTILITIES ================== */
    const esc = s => String(s ?? '');
    const escHtml = s => esc(s).replace(/&/g, '&amp;').replace(/</g, '&lt;')
        .replace(/>/g, '&gt;').replace(/"/g, '&quot;')
        .replace(/'/g, '&#39;');
    const parseJSON = x => { try { return typeof x === 'string' ? JSON.parse(x) : x; } catch { return {}; } };
    const fmtDiag = d => !d ? '-' : (String(d).includes('|') ? d.split('|').join(' — ') : d);
    const setText = ($el, v) => $el && $el.text && $el.text((v == null || String(v).trim() === '') ? '-' : String(v));

    const pick = (obj, keys, def = '') => {
        for (let i = 0; i < keys.length; i++) {
            const k = keys[i];
            if (obj && obj[k] != null && String(obj[k]).trim() !== '') return String(obj[k]);
        }
        return def;
    };

    // Improved hasAny to check for non-empty values recursively or at least one meaningful field
    const hasAny = (obj) => {
        if (!obj) return false;
        if (Array.isArray(obj)) return obj.length > 0;
        if (typeof obj === 'object') {
            // If it has 'data' property, check that
            if (obj.data && Object.keys(obj).length === 1) return hasAny(obj.data);

            return Object.values(obj).some(v => {
                if (v == null) return false;
                if (typeof v === 'string') return v.trim() !== '' && v !== '-';
                if (Array.isArray(v)) return v.length > 0;
                if (typeof v === 'object') return hasAny(v); // Recursive
                return true; // Numbers, booleans
            });
        }
        return false;
    };

    // Helper to check if specific critical keys exist and are not empty
    const hasKeys = (obj, keys) => {
        if (!obj) return false;
        return keys.some(k => obj[k] && String(obj[k]).trim() !== '' && String(obj[k]).trim() !== '-');
    };

    // Restore hasData helper (compatibility)
    const hasData = (data, checkKeys = null) => {
        if (!data) return false;
        if (Array.isArray(data)) return data.length > 0;
        if (checkKeys && Array.isArray(checkKeys)) {
            return hasKeys(data, checkKeys);
        }
        return hasAny(data);
    };

    function iconFor(kind) {
        const map = {
            soap: 'fa-clipboard', ttv: 'fa-heartbeat', diag: 'fa-stethoscope',
            proc: 'fa-cogs', tind: 'fa-user-md', resep: 'fa-medkit',
            lab: 'fa-flask', rad: 'fa-film', berkas: 'fa-file-o', resume: 'fa-file-text-o',
            penunjang: 'fa-user-md', laptind: 'fa-file-text', kfr: 'fa-file-medical', rehab: 'fa-heartbeat'

        };
        return map[kind] || 'fa-file-o';
    }

    function badge(name, on) {
        const c = on ? 'label-success' : 'label-default';
        const iconMap = {
            SOAP: 'fa-clipboard',
            Tindakan: 'fa-user-md',
            Resep: 'fa-medkit',
            Lab: 'fa-flask',
            Rad: 'fa-x-ray',
            Resume: 'fa-file-text-o',
            Operasi: 'fa-stethoscope'
        };
        const i = iconMap[name] || 'fa-check';
        return `<span class="label ${c} rp-badge-click" data-badge="${name}" style="margin-right:4px"><i class="fa ${i}"></i> ${name}</span>`;
    }

    function isImageExt(extOrUrl) {
        const s = String(extOrUrl || '').toLowerCase();
        const byExt = s.replace(/^.*\./, '');
        const ext = (s.includes('.') ? byExt : s);
        return ['jpg', 'jpeg', 'png', 'gif', 'webp', 'bmp', 'svg'].includes(ext);
    }

    // Sparkline mini chart
    function sparkline(points, w = 280, h = 44, pad = 4) {
        if (!Array.isArray(points) || points.length < 2) return '';
        const xs = points.map((_, i) => i), ys = points.map(v => Number(v));
        const ymin = Math.min(...ys), ymax = Math.max(...ys);
        const xr = (w - 2 * pad) / (xs.length - 1), yr = (ymax === ymin) ? 1 : ((h - 2 * pad) / (ymax - ymin));
        const path = xs.map((x, i) => {
            const px = pad + x * xr;
            const py = h - pad - ((ys[i] - ymin) * yr);
            return (i ? 'L' : 'M') + px.toFixed(1) + ' ' + py.toFixed(1);
        }).join(' ');
        const last = ys[ys.length - 1];
        return `
      <svg class="rp-spark" viewBox="0 0 ${w} ${h}" preserveAspectRatio="none" aria-label="sparkline">
        <path d="${path}" fill="none" stroke="#3b82f6" stroke-width="2"/>
        <circle cx="${(pad + (xs.length - 1) * xr).toFixed(1)}" cy="${(h - pad - ((last - ymin) * yr)).toFixed(1)}" r="3" fill="#3b82f6"/>
      </svg>`;
    }

    function parseTD(td) {
        if (!td) return [null, null];
        const m = String(td).match(/(\d+)\s*\/\s*(\d+)/);
        return m ? [Number(m[1]), Number(m[2])] : [Number(td) || null, null];
    }

    // ================== STYLES FOR SCREEN PRINTING (Ctrl+P on List View) ==================
    $('<style>')
        .prop('type', 'text/css')
        .html(`
            @media print {
                div.rp-all-card {
                    display: block !important;
                    position: static !important;
                    float: none !important;
                    clear: both !important;
                    page-break-after: always !important;
                    break-after: page !important;
                    margin-bottom: 0 !important;
                    border: none !important;
                }
                div.rp-all-card:last-child {
                    page-break-after: auto !important;
                    break-after: auto !important;
                }
                /* Hide screen-only elements */
                .rp-card-head, .btn, .no-print, .main-header, .main-sidebar, .content-header, .main-footer {
                    display: none !important;
                }
                /* Ensure body allows scrolling/printing */
                body, html, .content-wrapper {
                    height: auto !important;
                    overflow: visible !important;
                    background: white !important;
                }
                 .content-wrapper {
                    margin-left: 0 !important;
                    padding: 0 !important;
                }
            }
        `)
        .appendTo('head');

    /* ================== NORMALIZER LIST ================== */
    const normalize = r => ({
        no_rawat: r.no_rawat || r.norawat || '',
        tgl: r.tgl_registrasi || r.tgl_perawatan || r.tgl || '',
        jam: r.jam_reg || r.jam_rawat || r.jam || '',
        poli: r.poli || r.nm_poli || '-',
        dokter: r.dokter || r.nm_dokter || '-',
        penjamin: r.penjamin || r.png_jawab || '-',
        diagnosa_utama: r.diagnosa_utama || r.diag_utama || r.diagnosa || '',
        has_resep: Number(r.has_resep || r.resep || 0),
        has_lab: Number(r.has_lab || r.lab || 0),
        has_rad: Number(r.has_rad || r.rad || 0),
        has_resume: Number(r.has_resume || r.resume || 0),
        has_soap: Number(r.has_soap || 0),
        has_tind: Number(r.has_tind || 0)
    });

    /* ================== QUERY & LIST ================== */
    function buildQuery() {
        const p = new URLSearchParams();
        p.append('no_rkm_medis', el.norm.val() || '');
        if (el.q.val()) p.append('q', el.q.val());
        if (el.dateFrom.val()) p.append('date_from', el.dateFrom.val());
        if (el.dateTo.val()) p.append('date_to', el.dateTo.val());
        el.chips.filter('.active').each(function () {
            const key = $(this).data('flag');
            if (key) p.append(key, '1');
        });
        p.append('page', state.page);
        p.append('per_page', state.per_page);
        return p.toString();
    }

    function reloadList(openAll = true) {
        state.page = 1; state.finished = false; state.cache_rows = [];
        state.showAllAfterReload = !!openAll;
        el.timeline.empty();
        fetchList(true);
    }

    function fetchList(autoLoad = false) {
        if (state.loading || state.finished) return;

        // Safety Check
        if (typeof API_URLS === 'undefined' || !API_URLS.RP_LIST) {
            console.error('API_URLS.RP_LIST is undefined');
            state.finished = true;
            el.timeline.html('<li class="text-center text-danger">Konfigurasi URL Error.</li>');
            return;
        }

        state.loading = true;
        if (el.loader && el.loader.show) el.loader.show();

        $.get(`${API_URLS.RP_LIST}?${buildQuery()}`, res => {
            const j = parseJSON(res);
            const rows = (j?.data?.rows ?? j?.data ?? j ?? []);
            const meta = (j?.data?.meta ?? j?.meta ?? {});
            const list = Array.isArray(rows) ? rows.map(normalize) : [];

            const total = Number(meta.total || 0);
            if (el.count && el.count.text) el.count.text((total || list.length) + ' data');

            if (state.page === 1 && !list.length) {
                el.timeline.html('<li class="text-center text-muted">Tidak ada data riwayat.</li>');
            } else {
                list.forEach(r => renderTimeline(r));
                state.cache_rows.push(...list);
            }

            state.page++;
            state.finished = total ? (((state.page - 1) * state.per_page) >= total) : (list.length < state.per_page);

            if (state.finished && state.showAllAfterReload) {
                renderAllFromCache(true);
                state.showAllAfterReload = false;
            } else if (state.page === 2 && state.cache_rows.length > 0 && !state.showAllAfterReload) {
                const prefer = el.currNoRawat.val();
                const first = state.cache_rows.find(x => x.no_rawat === prefer) || state.cache_rows[0];
                if (first) selectKunjungan(first);
            }
        }).fail(() => {
            el.timeline.html('<li class="text-center text-danger">Gagal memuat data.</li>');
            state.finished = true; // Stop infinite loop
        }).always(() => {
            state.loading = false;
            if (el.loader && el.loader.hide) el.loader.hide();
            if (autoLoad && !state.finished) setTimeout(() => fetchList(true), 0);
        });
    }

    function renderTimeline(r) {
        const li = $('<li/>');
        li.html(`
      <i class="fa fa-circle bg-purple"></i>
      <div class="timeline-item" style="cursor:pointer" data-norawat="${escHtml(r.no_rawat)}">
        <span class="time"><i class="fa fa-clock-o"></i> ${escHtml(r.tgl)} ${escHtml(r.jam)}</span>
        <h3 class="timeline-header">
          <b>${escHtml(r.poli)}</b> • ${escHtml(r.dokter)} • <span class="text-muted">${escHtml(r.penjamin)}</span>
        </h3>
        <div class="timeline-body">
          <small>Diag. Utama:</small> <b>${fmtDiag(r.diagnosa_utama)}</b><br>
          ${badge('SOAP', r.has_soap)} ${badge('Tindakan', r.has_tind)} ${badge('Resep', r.has_resep)} ${badge('Lab', r.has_lab)} ${badge('Rad', r.has_rad)} ${badge('Resume', r.has_resume)}
        </div>
      </div>
    `);

        const timelineItem = li.find('.timeline-item');
        timelineItem.on('click', () => selectKunjungan(r));

        // FIX: Event handler untuk badge di timeline
        timelineItem.find('.rp-badge-click').on('click', function (e) {
            e.stopPropagation();
            const badgeName = $(this).data('badge');
            state.badgeSpotlight = badgeName;
            selectKunjungan(r);
        });

        el.timeline.append(li);
    }

    /* ================== DETAIL (SINGLE MODE) ================== */
    function selectKunjungan(r) {
        state.selected_no_rawat = r.no_rawat;
        setText(el.detNo, r.no_rawat);
        setText(el.detTgl, r.tgl);
        setText(el.detJam, r.jam);
        setText(el.detPoli, r.poli);
        setText(el.detDokter, r.dokter);
        setText(el.detPj, r.penjamin);

        el.detAll.hide(); el.detSingle.show();
        el.detContent.html(`<div class="rp-detail-grid" id="rp_detail_grid"></div>`);
        loadFullDetailInto($('#rp_detail_grid'), r);
    }

    /* ================== RENDER HELPERS ================== */
    function headerBlock(r) {
        const initial = escHtml((r.poli || '?').trim().charAt(0).toUpperCase());
        const dx = fmtDiag(r.diagnosa_utama);
        return `
      <div class="rp-hdr">
        <div class="rp-hdr-grid">
          <div class="rp-hdr-avatar" title="${escHtml(r.poli)}">${initial}</div>
          <div>
            <div class="rp-hdr-top">
              <span class="rp-time"><i class="fa fa-calendar"></i> ${escHtml(r.tgl)} • ${escHtml(r.jam)}</span>
              <span class="rp-pj">${escHtml(r.penjamin)}</span>
            </div>
            <div class="rp-hdr-mid">
              <span class="rp-pill">${escHtml(r.poli)}</span>
              <span class="rp-doc"><i class="fa fa-user-md"></i> ${escHtml(r.dokter)}</span>
            </div>
            <div class="rp-hdr-meta">
              <span class="rp-norawat" title="No. Rawat">${escHtml(r.no_rawat)}</span>
              ${dx ? `<span class="rp-diag"><b>Dx:</b> ${dx}</span>` : ''}
            </div>
          </div>
          <div>
            <button type="button" class="btn btn-default btn-sm text-primary btn-print-riwayat" title="Cetak Riwayat Pasien PDF">
                <i class="fa fa-print"></i> Cetak PDF
            </button>
          </div>
        </div>
        <div class="rp-hdr-badges">
          ${badge('SOAP', r.has_soap)} ${badge('Tindakan', r.has_tind)} ${badge('Resep', r.has_resep)} ${badge('Lab', r.has_lab)} ${badge('Rad', r.has_rad)} ${badge('Resume', r.has_resume)}
        </div>
      </div>`;
    }

    function cardWrap(kind, title, bodyHtml, rightMeta) {
        const icon = iconFor(kind);
        return (
            '<div class="rp-card card--' + kind + '" data-card-kind="' + kind + '">' +
            '<div class="rp-card-head" title="Klik untuk membuka/tutup">' +
            '<div class="rp-card-title"><i class="fa ' + icon + '"></i> &nbsp;' + escHtml(title) + '</div>' +
            '<div style="display:flex;align-items:center;gap:10px">' +
            (rightMeta ? ('<div class="rp-meta">' + escHtml(rightMeta) + '</div>') : '') +
            '<i class="fa fa-minus rp-toggle-icon text-muted" style="font-size:12px"></i>' +
            '</div>' +
            '</div>' +
            '<div class="rp-card-body">' + bodyHtml + '</div>' +
            '</div>'
        );
    }

    const kvRow = (label, value) => `<div class="kv"><span>${escHtml(label)}</span><b>${escHtml(value || '-')}</b></div>`;

    function renderTable(rows, cols) {
        if (!Array.isArray(rows) || rows.length === 0) return '<span class="text-muted">Tidak ada data.</span>';
        const thead = '<thead><tr>' + cols.map(c => `<th>${escHtml(c.title)}</th>`).join('') + '</tr></thead>';
        const tbody = '<tbody>' + rows.map(r => {
            return '<tr>' + cols.map(c => `<td>${escHtml(r[c.key] ?? '')}</td>`).join('') + '</tr>';
        }).join('') + '</tbody>';
        return `<div class="table-responsive"><table class="table table-condensed table-striped">${thead}${tbody}</table></div>`;
    }

    function applyBadgeSpotlight($container) {
        const k = state.badgeSpotlight;
        if (!k) return;

        const map = {
            'SOAP': 'soap',
            'Tindakan': 'tind',
            'Resep': 'resep',
            'Lab': 'lab',
            'Rad': 'rad',
            'Resume': 'resume',
            'Penunjang': 'penunjang',
            'Laporan Tindakan': 'laptind'
        };
        const want = map[k];
        if (!want) return;

        const $cards = $container.find('.rp-card');

        // Sembunyikan semua card dulu
        $cards.hide();

        // Tampilkan hanya card yang sesuai dengan badge yang diklik
        const $targetCards = $container.find(`.rp-card[data-card-kind="${want}"]`);
        if ($targetCards.length) {
            $targetCards.show();

            // Scroll ke card pertama yang sesuai
            setTimeout(() => {
                $targetCards.first()[0].scrollIntoView({ behavior: 'smooth', block: 'start' });
            }, 100);
        } else {
            // Jika tidak ada card yang sesuai, tampilkan semua
            $cards.show();
        }

        // Reset spotlight setelah diproses
        state.badgeSpotlight = null;
    }


    // ================== SHARED REPORT GENERATOR ==================
    // Expose generateReportHtml to window for bulk access
    window.generateReportHtml = (d) => {
        if (!d) return '';
        const g = window.globalInfo;
        const base = d.base || {};
        const patient = g.patient || {};
        const setting = g.setting || {};

        const txt = (v) => (v === null || v === undefined || v === 'null') ? '-' : String(v);
        const dateFmt = (v) => {
            if (!v || v === '0000-00-00') return '-';
            const d = new Date(v);
            if (isNaN(d.getTime())) return v;
            return d.toLocaleDateString('id-ID');
        };
        const fmtUang = (v) => 'Rp ' + (Number(v) || 0).toLocaleString('id-ID');

        // Helper HasData & HasContent (Reuse or redefine)
        const hasData = (data, checkKeys = null) => {
            if (!data) return false;
            if (Array.isArray(data)) return data.length > 0;
            if (checkKeys && Array.isArray(checkKeys)) {
                return checkKeys.some(k => data[k] && String(data[k]).trim() !== '' && String(data[k]).trim() !== '-' && String(data[k]).trim() !== 'null');
            }
            if (typeof data === 'object') {
                if (data.data && Object.keys(data).length === 1) return hasData(data.data); // Unwrap 'data' wrapper
                return Object.values(data).some(v => {
                    if (v == null) return false;
                    if (typeof v === 'string') return v.trim() !== '' && v !== '-';
                    if (Array.isArray(v)) return v.length > 0;
                    if (typeof v === 'object') return true;
                    return true;
                });
            }
            return false;
        };

        const hasContent = (obj, keys) => {
            if (!obj) return false;
            return keys.some(k => obj[k] && String(obj[k]).trim() !== '' && String(obj[k]).trim() !== '-' && String(obj[k]).trim() !== 'null');
        };

        const wrapSection = (title, content) => `
            <div class="print-section">
                <div class="section-title">${title}</div>
                <div class="section-body">${content}</div>
            </div>`;


        const renderTTV = (obj) => {
            if (!obj) return '';
            const t = (l, v, u = '') => `<div class="ttv-item"><div class="ttv-label">${l}</div><div>${txt(v)} ${u}</div></div>`;
            return `<div class="ttv-grid">
            ${t('Tensi', obj.tensi, 'mmHg')} ${t('Nadi', obj.nadi, 'x/m')} ${t('RR', obj.respirasi, 'x/m')} ${t('Suhu', obj.suhu_tubuh, '°C')}
                ${t('SpO2', obj.spo2, '%')} ${t('BB', obj.berat, 'Kg')} ${t('TB', obj.tinggi, 'Cm')} ${t('GCS', obj.gcs, '')}
            </div>`;
        };

        let htmlAssess = '', htmlICD = '', htmlSoap = '', htmlTind = '', htmlResep = '', htmlLab = '', htmlRad = '', htmlBerkas = '', htmlOperasi = '', htmlResume = '', htmlLapTind = '', htmlLapPenunjang = '', htmlPenunjang = '', htmlKfr = '', htmlRehab = '';

        // === 1. ASESMEN ===
        if (hasData(d.igd)) {
            const i = d.igd.data || d.igd;
            if (hasContent(i, ['keluhan_utama', 'diagnosis', 'rps', 'ket_lokalis', 'tata_laksana', 'tata'])) {
                const fisikRowIGD = (lbl, stt) => `<tr><td>${lbl}</td><td>${txt(stt)}</td></tr>`;
                const content = `
            <div class="mb-1"><b>A. ANAMNESIS</b></div>
                 <table class="print-table" style="border:none">
                     <tr><td width="20%" style="border:none"><b>Keluhan Utama</b></td><td style="border:none">: ${txt(i.keluhan_utama)}</td></tr>
                     <tr><td style="border:none"><b>RPS</b></td><td style="border:none">: ${txt(i.rps)}</td></tr>
                     <tr><td style="border:none"><b>RPD</b></td><td style="border:none">: ${txt(i.rpd)} (<b>RPK:</b> ${txt(i.rpk || '-')})</td></tr>
                     <tr><td style="border:none"><b>Alergi</b></td><td style="border:none">: ${txt(i.alergi)}</td></tr>
                 </table>
                 <div class="mb-1 mt-2"><b>B. PEMERIKSAAN FISIK & TTV</b></div>
                 ${renderTTV(i)}
                 <div class="mb-1"><b>Keadaan Umum:</b> ${txt(i.keadaan)} | <b>Kesadaran:</b> ${txt(i.kesadaran)}</div>
                 <table class="print-table" style="width:100%;table-layout:fixed;margin-bottom:10px;">
                     <tr>
                          <td style="width:50%;vertical-align:top;padding:0;border:none;">
                              <table class="print-table" style="width:100%;margin:0;">
                                  <thead><tr><th>Area</th><th>Status</th></tr></thead>
                                  ${fisikRowIGD('Kepala', i.kepala)}
                                  ${fisikRowIGD('Mata', i.mata)}
                                  ${fisikRowIGD('Gigi & Mulut', i.gigi)}
                                  ${fisikRowIGD('Leher', i.leher)}
                                  ${fisikRowIGD('Thoraks', i.thoraks)}
                              </table>
                          </td>
                          <td style="width:50%;vertical-align:top;padding:0;border:none;">
                               <table class="print-table" style="width:100%;margin:0;">
                                  <thead><tr><th>Area</th><th>Status</th></tr></thead>
                                  ${fisikRowIGD('Abdomen', i.abdomen)}
                                  ${fisikRowIGD('Genital', i.genital)}
                                  ${fisikRowIGD('Ekstremitas', i.ekstremitas)}
                                  <tr><td colspan="2"><b>Ket. Fisik:</b> ${txt(i.ket_fisik)}</td></tr>
                               </table>
                          </td>
                     </tr>
                 </table>
                 ${i.lokalis_url ? `<div style="text-align:center;margin:5px 0;"><b>Status Lokalis:</b><br><img src="${i.lokalis_url}" style="max-height:150px;width:auto;border:1px solid #ccc;"><br>${txt(i.ket_lokalis)}</div>` : (!i.ket_lokalis ? '' : `<div class="mb-1"><b>Status Lokalis:</b> ${txt(i.ket_lokalis)}</div>`)}
                 <div class="mb-1 mt-2"><b>D. DIAGNOSIS & TERAPI</b></div>
                 <table class="print-table" style="border:none">
                     <tr><td width="20%" style="border:none;vertical-align:top"><b>Diagnosis Kerja</b></td><td style="border:none">: ${txt(i.diagnosis)}</td></tr>
                     <tr><td style="border:none;vertical-align:top"><b>Tatalaksana</b></td><td style="border:none">: ${txt(i.tata_laksana || i.tata)}</td></tr>
                 </table>`;
                htmlAssess += wrapSection('ASESMEN GAWAT DARURAT (IGD)', content);
            }
        }

        // === 2. DIAGNOSA & PROSEDUR ===
        // Only show if there's actual data
        const hasDiagData = hasData(d.diag) && (Array.isArray(d.diag) ? d.diag : (d.diag.data || [])).length > 0;
        const hasProcData = hasData(d.proc) && (Array.isArray(d.proc) ? d.proc : (d.proc.data || [])).length > 0;

        if (hasDiagData || hasProcData) {
            let diagCol = '<div style="font-size:10px;color:#888;">- Tidak ada diagnosa ICD-10 -</div>';
            if (hasDiagData) {
                const ds = Array.isArray(d.diag) ? d.diag : (d.diag.data || []);
                diagCol = `<div style="font-weight:bold;font-size:11px;border-bottom:1px solid #ccc;">Diagnosa (ICD-10)</div><ul style="margin:0;padding-left:15px;font-size:10px;">${ds.map(x => `<li><b>${x.kd_penyakit}</b> - ${x.nm_penyakit}</li>`).join('')}</ul>`;
            }
            let procCol = '<div style="font-size:10px;color:#888;">- Tidak ada prosedur ICD-9 -</div>';
            if (hasProcData) {
                const ps = Array.isArray(d.proc) ? d.proc : (d.proc.data || []);
                procCol = `<div style="font-weight:bold;font-size:11px;border-bottom:1px solid #ccc;">Prosedur (ICD-9)</div><ul style="margin:0;padding-left:15px;font-size:10px;">${ps.map(x => `<li><b>${x.kode}</b> - ${x.nama || x.deskripsi_panjang}</li>`).join('')}</ul>`;
            }
            htmlICD += wrapSection('DIAGNOSA & PROSEDUR', `<table style="width:100%;table-layout:fixed;"><tr><td style="width:50%;vertical-align:top;border:none;">${diagCol}</td><td style="width:50%;vertical-align:top;border:none;">${procCol}</td></tr></table>`);
        }

        // === 2.5 FORMULIR RAWAT JALAN KFR ===
        console.log('Checking KFR data in generateReportHtml:', d.kfr);
        if (d.kfr) {
            const kfrData = d.kfr.data || d.kfr || [];
            const kfrList = Array.isArray(kfrData) ? kfrData : [];

            if (kfrList.length > 0) {
                let kfrContent = '';
                kfrList.forEach((item, idx) => {
                    const tglFmt = item.tgl_perawatan ? dateFmt(item.tgl_perawatan) : '-';
                    kfrContent += `
                    <div style="margin-bottom:${idx < kfrList.length - 1 ? '15px' : '0'}; border:1px solid #ccc; padding:8px; page-break-inside:avoid;">
                        <div style="background:#f0f0f0; padding:4px 6px; margin:-8px -8px 8px -8px; border-bottom:1px solid #ccc;">
                            <strong>Tanggal:</strong> ${tglFmt} ${item.jam_rawat || '-'} | <strong>Dokter Sp.KFR:</strong> ${txt(item.nm_dokter)}
                        </div>
                        <table class="print-table" style="width:100%; border:none; margin-bottom:8px;">
                            <tr><td width="15%" style="border:none; vertical-align:top;"><strong>S</strong></td><td style="border:none;">: ${txt(item.subjective)}</td></tr>
                            <tr><td style="border:none; vertical-align:top;"><strong>O</strong></td><td style="border:none;">: ${txt(item.objective)}</td></tr>
                            <tr><td style="border:none; vertical-align:top;"><strong>A</strong></td><td style="border:none;">: ${txt(item.assessment)}</td></tr>
                        </table>
                        <div style="background:#fef3c7; padding:6px; border:1px solid #fde047; border-radius:4px;">
                            <div style="font-weight:bold; margin-bottom:4px;">PLANNING / PROTOKOL TERAPI:</div>
                            <table class="print-table" style="width:100%; border:none; font-size:10px;">
                                <tr><td width="30%" style="border:none;">a. Goal of Treatment</td><td style="border:none;">: ${txt(item.goal_of_treatment)}</td></tr>
                                <tr><td style="border:none;">b. Tindakan/Program Rehab</td><td style="border:none;">: ${txt(item.tindakan_rehab)}</td></tr>
                                <tr><td style="border:none;">c. Edukasi</td><td style="border:none;">: ${txt(item.edukasi)}</td></tr>
                                <tr><td style="border:none;">d. Frekuensi Kunjungan</td><td style="border:none;">: ${txt(item.frekuensi_kunjungan)}</td></tr>
                                <tr><td style="border:none; vertical-align:top;">Rencana Tindak Lanjut</td><td style="border:none;">: ${txt(item.rencana_tindak_lanjut)}</td></tr>
                            </table>
                        </div>
                    </div>`;
                });
                htmlKfr += wrapSection('FORMULIR RAWAT JALAN KFR', kfrContent);
            }
        }

        // === 2.6 PROGRAM TERAPI REHAB MEDIK ===
        console.log('Checking Rehab data in generateReportHtml:', d.rehab);
        if (d.rehab) {
            const rehabData = d.rehab.data || d.rehab || [];
            const rehabList = Array.isArray(rehabData) ? rehabData : [];

            if (rehabList.length > 0) {
                let rehabContent = '';
                rehabList.forEach((item, idx) => {
                    const tglFmt = item.tgl_perawatan ? dateFmt(item.tgl_perawatan) : '-';
                    rehabContent += `
                    <div style="margin-bottom:${idx < rehabList.length - 1 ? '15px' : '0'}; border:1px solid #ccc; padding:8px; page-break-inside:avoid;">
                        <div style="background:#f0f0f0; padding:4px 6px; margin:-8px -8px 8px -8px; border-bottom:1px solid #ccc;">
                            <strong>Tanggal:</strong> ${tglFmt} ${item.jam_rawat || '-'} | <strong>Dokter:</strong> ${txt(item.nm_dokter)} | <strong>Tim Rehab:</strong> ${txt(item.nm_petugas)}
                        </div>
                        <table class="print-table" style="width:100%; border:none; margin-bottom:8px;">
                            <tr><td width="15%" style="border:none; vertical-align:top;"><strong>S</strong></td><td style="border:none;">: ${txt(item.subjective)}</td></tr>
                            <tr><td style="border:none; vertical-align:top;"><strong>O</strong></td><td style="border:none;">: ${txt(item.objective)}</td></tr>
                            <tr><td style="border:none; vertical-align:top;"><strong>A</strong></td><td style="border:none;">: ${txt(item.assessment)}</td></tr>
                        </table>
                        <div style="background:#f5f3ff; padding:6px; border:1px solid #e9d5ff; border-radius:4px;">
                            <div style="font-weight:bold; margin-bottom:4px;">PROCEDURE / PROGRAM TERAPI (P):</div>
                            <div style="font-size:10px; white-space:pre-wrap; line-height:1.4;">${txt(item.procedure_text)}</div>
                        </div>
                    </div>`;
                });
                htmlRehab += wrapSection('PROGRAM TERAPI REHAB MEDIK', rehabContent);
            }
        }

        // === 3. RESUME (Jika ada) ===
        const resumeData = d.summary?.resume || d.summary?.data?.resume || {};

        // Priority: Resume Data -> Fallback to General Data
        let diagUtama = txt(resumeData.diagnosa_utama);
        let diagSekunder = txt(resumeData.diagnosa_sekunder);
        let procUtama = txt(resumeData.prosedur_utama);

        // Fallback: If Resume is empty, try to pull from General Diagnosis
        if (!diagUtama && hasData(d.diag)) {
            const ds = Array.isArray(d.diag) ? d.diag : (d.diag.data || []);
            const prim = ds.find(x => String(x.prioritas) === '1') || ds[0];
            if (prim) diagUtama = `${prim.kd_penyakit} - ${prim.nm_penyakit} `;

            // Try to get secondary diagnoses from general list
            const seconds = ds.filter(x => String(x.prioritas) !== '1' && x !== prim).map(x => `${x.kd_penyakit} - ${x.nm_penyakit} `).join(', ');
            if (!diagSekunder && seconds) diagSekunder = seconds;
        }

        // Fallback: If Resume Procedure is empty, try to pull from General Procedures
        if (!procUtama && hasData(d.proc)) {
            const ps = Array.isArray(d.proc) ? d.proc : (d.proc.data || []);
            const prim = ps.find(x => String(x.prioritas) === '1') || ps[0];
            if (prim) procUtama = `${prim.kode} - ${prim.nama || prim.deskripsi_panjang} `;
        }

        // Check if ANY displayable data exists for Resume
        // Only show if there's actual data, not just empty fields or '-'
        const isRealValue = (val) => val && val !== '-' && String(val).trim() !== '';

        const hasResumeContent = !!(
            isRealValue(resumeData.keluhan_utama) ||
            isRealValue(diagUtama) ||
            isRealValue(diagSekunder) ||
            isRealValue(procUtama) ||
            isRealValue(resumeData.kondisi_pulang) ||
            isRealValue(resumeData.obat_pulang) ||
            isRealValue(resumeData.instruksi_pulang) ||
            isRealValue(resumeData.diagnosa_sekunder) ||
            isRealValue(resumeData.diagnosa_sekunder2) ||
            isRealValue(resumeData.diagnosa_sekunder3) ||
            isRealValue(resumeData.diagnosa_sekunder4) ||
            isRealValue(resumeData.prosedur_sekunder) ||
            isRealValue(resumeData.prosedur_sekunder2) ||
            isRealValue(resumeData.prosedur_sekunder3)
        );

        if (hasResumeContent) {
            // Helper to handle Sekunder Lists
            const listItems = (prefix, max) => {
                let items = [];
                for (let i = 0; i < max; i++) {
                    let key = i === 0 ? prefix : (prefix + (i + 1)); // diagnosa_sekunder, diagnosa_sekunder2...
                    // Wait, typical key naming in model might be diagnosa_sekunder, diagnosa_sekunder2, etc.
                    // The renderResume card logic uses: diagnosa_sekunder, diagnosa_sekunder2, diagnosa_sekunder3, diagnosa_sekunder4
                    let val = resumeData[key];
                    if (val && val !== '-' && val !== '') items.push(txt(val));
                    else items.push('-'); // Force hyphen if requested to be "lengkap" or just omit? 
                    // User's screenshot shows "Sekunder 1 : - (-)" implying they want the placeholder.
                    // Let's output hyphens.
                }
                return items;
            };

            const diagSekunders = listItems('diagnosa_sekunder', 4);
            const procSekunders = listItems('prosedur_sekunder', 3);

            let resumeTbl = `
            <div style="margin-top:5px;">
                <!-- KELUHAN -->
                <div style="margin-bottom:8px;">
                    <div style="font-weight:bold;font-size:10px;">Keluhan Utama</div>
                    <div style="border-bottom:1px dashed #ccc;padding-bottom:2px;">${txt(resumeData.keluhan_utama) || '-'}</div>
                </div>

                <!-- DIAGNOSA -->
                <div style="margin-bottom:8px;">
                    <div style="font-weight:bold;font-size:10px;margin-bottom:2px;">Diagnosa</div>
                    <table class="print-table" style="width:100%;border:none;">
                        <tr><td width="20%" style="border:none;">Utama</td><td style="border:none;">: ${diagUtama || '-'}</td></tr>
                        ${diagSekunders.map((v, i) => `<tr><td style="border:none;">Sekunder ${i + 1}</td><td style="border:none;">: ${v}</td></tr>`).join('')}
                    </table>
                </div>

                <!-- PROSEDUR -->
                <div style="margin-bottom:8px;">
                     <div style="font-weight:bold;font-size:10px;margin-bottom:2px;">Prosedur</div>
                     <table class="print-table" style="width:100%;border:none;">
                        <tr><td width="20%" style="border:none;">Utama</td><td style="border:none;">: ${procUtama || '-'}</td></tr>
                        ${procSekunders.map((v, i) => `<tr><td style="border:none;">Sekunder ${i + 1}</td><td style="border:none;">: ${v}</td></tr>`).join('')}
                    </table>
                </div>

                <!-- KONDISI & OBAT PULANG -->
                 <div style="margin-bottom:5px;">
                    <div style="font-weight:bold;font-size:10px;">Kondisi Pulang</div>
                    <div style="border-bottom:1px dashed #ccc;padding-bottom:2px;">${txt(resumeData.kondisi_pulang) || '-'}</div>
                </div>
                <div>
                    <div style="font-weight:bold;font-size:10px;">Obat Pulang / Instruksi</div>
                    <div style="border:1px solid #eee;padding:4px;min-height:20px;">${txt(resumeData.obat_pulang || resumeData.instruksi_pulang) || '-'}</div>
                </div>
            </div>`;

            htmlResume += wrapSection('RESUME MEDIS', resumeTbl);
        }

        // === 4. SOAP (PERKEMBANGAN PASIEN) ===
        if (d.soapRaw) {
            let soapItems = [];
            const sr = d.soapRaw;
            if (Array.isArray(sr.data?.items)) soapItems = sr.data.items;
            else if (Array.isArray(sr.items)) soapItems = sr.items;
            else if (sr.soap) soapItems = [sr.soap];
            else if (Array.isArray(sr)) soapItems = sr;

            if (soapItems.length > 0) {
                const soapContent = soapItems.map((s, idx) => `
            <div style="margin-bottom:10px; border-bottom:1px dashed #ccc; padding-bottom:5px;">
                        <div style="font-weight:bold; font-size:10px; background:#f0f0f0; padding:2px;">
                            ${dateFmt(s.tgl_perawatan)} ${s.jam_rawat} - ${txt(s.nm_petugas)}
                        </div>
                        <table class="print-table" style="width:100%; border:none; margin-top:3px;">
                           <tr><td width="10%" style="border:none;vertical-align:top"><b>S</b></td><td style="border:none">: ${txt(s.keluhan)}</td></tr>
                           <tr><td width="10%" style="border:none;vertical-align:top"><b>O</b></td><td style="border:none">: ${txt(s.pemeriksaan)}</td></tr>
                           <tr><td width="10%" style="border:none;vertical-align:top"><b>A</b></td><td style="border:none">: ${txt(s.penilaian)}</td></tr>
                           <tr><td width="10%" style="border:none;vertical-align:top"><b>P</b></td><td style="border:none">: ${txt(s.rtl)}</td></tr>
                        </table>
                    </div>
            `).join('');
                htmlSoap += wrapSection('CATATAN PERKEMBANGAN PASIEN (SOAP)', soapContent);
            }
        }

        // === 5. TINDAKAN/PROSEDUR ===
        if (hasData(d.tind)) {
            const tData = Array.isArray(d.tind) ? d.tind : (d.tind.data || []);
            if (tData.length > 0) {
                let totalTind = 0;
                const tRows = tData.map(t => {
                    const biaya = Number(t.biaya_rawat) || 0;
                    totalTind += biaya;
                    return `
            <tr>
                        <td>${dateFmt(t.tgl_perawatan || t.tgl)} ${t.jam_rawat || t.jam || ''}</td>
                        <td>${txt(t.nm_perawatan || t.nama_tindakan)}</td>
                        <td>${txt(t.nm_dokter || t.operator || t.dokter || '-')}</td>
                        <td align="right">Rp ${biaya.toLocaleString('id-ID')}</td>
                    </tr>
            `;
                }).join('');

                htmlTind += wrapSection('TINDAKAN / PROSEDUR', `
            <table class="print-table">
                        <thead><tr><th>Waktu</th><th>Nama Tindakan</th><th>Dokter/Petugas</th><th width="15%">Biaya</th></tr></thead>
                        <tbody>${tRows}</tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3" align="right" class="text-bold">Total Biaya Tindakan:</td>
                                <td align="right" class="text-bold">Rp ${totalTind.toLocaleString('id-ID')}</td>
                            </tr>
                        </tfoot>
                    </table>
            `);
            }
        }

        // === 6. RESEP OBAT ===
        if (hasData(d.resep)) {
            const rData = Array.isArray(d.resep) ? d.resep : (d.resep.data || []);
            if (rData.length > 0) {
                let totalResep = 0;
                const rRows = rData.map(r => {
                    const biaya = Number(r.total_biaya) || 0;
                    totalResep += biaya;
                    // Format date/time
                    const tglJam = (r.tgl_perawatan ? dateFmt(r.tgl_perawatan) : '') + (r.jam ? ' ' + r.jam : '');

                    return `
            <tr>
                         <td>${tglJam}</td>
                         <td>${txt(r.nama_obat || r.nama_brng)}</td>
                         <td align="center">${txt(r.jml || r.jumlah)}</td>
                         <td>${txt(r.aturan_pakai || r.aturan)}</td>
                         <td>${txt(r.nm_dokter || '-')}</td>
                         <td align="right">Rp ${biaya.toLocaleString('id-ID')}</td>
                    </tr>
            `;
                }).join('');

                htmlResep += wrapSection('RESEP OBAT', `
            <table class="print-table">
                        <thead><tr><th>Waktu</th><th>Nama Obat</th><th width="8%">Jml</th><th width="20%">Aturan Pakai</th><th width="20%">Dokter</th><th width="15%">Biaya</th></tr></thead>
                        <tbody>${rRows}</tbody>
                        <tfoot>
                            <tr>
                                <td colspan="5" align="right" class="text-bold">Total Biaya Obat:</td>
                                <td align="right" class="text-bold">Rp ${totalResep.toLocaleString('id-ID')}</td>
                            </tr>
                        </tfoot>
                    </table>
            `);
            }
        }

        // === 7. LABORATORIUM ===
        if (hasData(d.lab)) {
            const lData = Array.isArray(d.lab) ? d.lab : (d.lab.data || []);
            if (lData.length > 0) {
                // Group by lab request (tgl_periksa + jam)
                const labGroups = {};
                lData.forEach(l => {
                    const key = `${l.tgl_periksa}_${l.jam}`;
                    if (!labGroups[key]) {
                        labGroups[key] = {
                            tgl: l.tgl_periksa,
                            jam: l.jam,
                            dokter: l.nm_dokter || '-',
                            petugas: l.petugas_lab || '-',
                            biaya: Number(l.biaya) || 0,
                            items: []
                        };
                    }
                    labGroups[key].items.push(l);
                });

                // Render each group
                Object.values(labGroups).forEach(group => {
                    const headerInfo = `
                        <div style="background:#f8fafc; padding:8px; margin-bottom:8px; border:1px solid #e2e8f0; border-radius:4px;">
                            <table style="width:100%; font-size:10px; border:none;">
                                <tr>
                                    <td style="border:none; width:50%;"><b>Tanggal Pemeriksaan:</b> ${dateFmt(group.tgl)} ${group.jam}</td>
                                    <td style="border:none; width:50%;"><b>Dokter Perujuk:</b> ${group.dokter}</td>
                                </tr>
                            </table>
                        </div>
                    `;

                    const detailRows = group.items.map(l => `
                        <tr>
                            <td>${txt(l.pemeriksaan || l.Pemeriksaan || l.nm_perawatan || l.panel)}</td>
                            <td align="center">${txt(l.rujukan || l.nilai_rujukan || l.nilai_normal)}</td>
                            <td align="center">${txt(l.satuan)}</td>
                            <td align="center" style="font-weight:bold">${txt(l.hasil || l.nilai)}</td>
                        </tr>
                    `).join('');

                    htmlLab += wrapSection('HASIL LABORATORIUM', `
                        ${headerInfo}
                        <table class="print-table">
                            <thead><tr><th>Pemeriksaan</th><th width="15%">Rujukan</th><th width="10%">Satuan</th><th width="15%">Hasil</th></tr></thead>
                            <tbody>${detailRows}</tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="3" align="right" class="text-bold">Total Biaya:</td>
                                    <td align="right" class="text-bold">Rp ${group.biaya.toLocaleString('id-ID')}</td>
                                </tr>
                            </tfoot>
                        </table>
                    `);
                });
            }
        }




        // === 8. RADIOLOGI ===
        if (hasData(d.rad)) {
            const radData = Array.isArray(d.rad) ? d.rad : (d.rad.data || []);
            // Handle nested structure: rdocs can be {data: {files: [...]}} or {files: [...]} or [...]
            const rdocsData = d.rdocs?.data?.files || d.rdocs?.files || (Array.isArray(d.rdocs) ? d.rdocs : []);

            console.log('Radiology data:', radData);
            console.log('Radiology images (rdocs):', rdocsData);

            if (radData.length > 0) {
                // Group by radiology request (tgl_periksa + jam)
                const radGroups = {};
                radData.forEach(r => {
                    const key = `${r.tgl_periksa}_${r.jam}`;
                    if (!radGroups[key]) {
                        radGroups[key] = {
                            tgl: r.tgl_periksa,
                            jam: r.jam,
                            dokter: r.dokter || r.nm_dokter || '-',
                            items: []
                        };
                    }
                    radGroups[key].items.push(r);
                });

                // Render each group
                Object.values(radGroups).forEach(group => {
                    // Calculate total biaya from all items
                    const totalBiaya = group.items.reduce((sum, item) => sum + (Number(item.biaya) || 0), 0);

                    const headerInfo = `
                        <div style="background:#f8fafc; padding:8px; margin-bottom:8px; border:1px solid #e2e8f0; border-radius:4px;">
                            <table style="width:100%; font-size:10px; border:none;">
                                <tr>
                                    <td style="border:none; width:50%;"><b>Tanggal Pemeriksaan:</b> ${dateFmt(group.tgl)} ${group.jam}</td>
                                    <td style="border:none; width:50%;"><b>Dokter:</b> ${group.dokter}</td>
                                </tr>
                            </table>
                        </div>
                    `;

                    // Build examination table with prices
                    const examRows = group.items.map(r => {
                        const biaya = Number(r.biaya) || 0;
                        return `
                            <tr>
                                <td style="padding:8px; vertical-align:top;">
                                    <b>${txt(r.nm_perawatan || r.nama_pemeriksaan)}</b>
                                    <div style="margin-top:4px; font-size:10px; color:#666; white-space:pre-wrap; line-height:1.4;">${txt(r.hasil || '-')}</div>
                                </td>
                                <td style="padding:8px; text-align:right; vertical-align:top; white-space:nowrap; font-family:monospace; font-weight:bold;">
                                    Rp ${biaya.toLocaleString('id-ID')}
                                </td>
                            </tr>
                        `;
                    }).join('');

                    // Display all available images
                    let imgHtml = '';
                    if (rdocsData && rdocsData.length > 0) {
                        const imgs = rdocsData.map(x => {
                            const imgSrc = x.url || x.file || x.lokasi_file || x.path;
                            if (!imgSrc) return '';

                            return `
                                <div style="display:inline-block; margin:8px; text-align:center; vertical-align:top; border:1px solid #ddd; padding:8px; background:#fff; border-radius:4px; max-width:300px;">
                                    <img src="${imgSrc}" style="max-width:280px; max-height:280px; width:auto; height:auto; display:block; margin:0 auto; border:1px solid #ccc;">
                                    <div style="font-size:9px; color:#666; margin-top:6px; padding-top:6px; border-top:1px solid #eee;">${x.label || x.nama || x.tgl || ''}</div>
                                </div>
                            `;
                        }).filter(x => x).join('');

                        if (imgs) {
                            imgHtml = `
                                <div style="margin-top:15px; padding:15px; background:#f9fafb; border:1px solid #e5e7eb; border-radius:4px;">
                                    <div style="font-weight:bold; margin-bottom:10px; color:#374151; font-size:11px;">
                                        <i class="fa fa-image"></i> GAMBAR RADIOLOGI:
                                    </div>
                                    <div style="text-align:center;">
                                        ${imgs}
                                    </div>
                                </div>
                            `;
                        }
                    }

                    htmlRad += wrapSection('HASIL RADIOLOGI', `
                        ${headerInfo}
                        <table class="print-table" style="margin-bottom:0;">
                            <thead>
                                <tr>
                                    <th style="width:70%;">Pemeriksaan & Hasil</th>
                                    <th style="width:30%; text-align:right;">Biaya</th>
                                </tr>
                            </thead>
                            <tbody>${examRows}</tbody>
                            <tfoot>
                                <tr style="background:#fffbeb; border-top:2px solid #fbbf24;">
                                    <td align="right" class="text-bold" style="padding:10px;">Total Biaya:</td>
                                    <td align="right" class="text-bold" style="padding:10px; font-size:13px; color:#92400e;">Rp ${totalBiaya.toLocaleString('id-ID')}</td>
                                </tr>
                            </tfoot>
                        </table>
                        ${imgHtml}
                    `);
                });
            }
        }

        // === 8b. BERKAS RADIOLOGI (GLOBAL) ===
        if (hasData(d.rdocs)) {
            const rdocs = d.rdocs?.data?.files || d.rdocs?.files || (Array.isArray(d.rdocs) ? d.rdocs : []);
            if (rdocs.length > 0) {
                const imgs = rdocs.filter(x => x).map(x => `
            <div style="display:inline-block; margin:8px; text-align:center; vertical-align:top; border:1px solid #ddd; padding:8px; background:#fff; border-radius:4px; max-width:300px;">
                <img src="${x.url || x.file || x.lokasi_file}" style="max-width:280px; max-height:280px; width:auto; height:auto; display:block; margin:0 auto; border:1px solid #ccc;">
                <div style="font-size:9px; color:#666; margin-top:6px; padding-top:6px; border-top:1px solid #eee;">${x.label || x.nama || ''}</div>
            </div>
        `).join('');
                if (imgs) {
                    htmlBerkas += wrapSection('BERKAS RADIOLOGI (GAMBAR)', `
                        <div style="text-align:center;">
                            ${imgs}
                        </div>
                    `);
                }
            }
        }

        // === 8c. BERKAS DIGITAL ===
        if (hasData(d.berkas_digital)) {
            const bDigital = d.berkas_digital?.data?.files || d.berkas_digital?.files || (Array.isArray(d.berkas_digital) ? d.berkas_digital : []);
            if (bDigital.length > 0) {
                const imgs = bDigital.filter(x => x && x.is_image).map(x => `
            <div style="display:inline-block; margin:8px; text-align:center; vertical-align:top; border:1px solid #ddd; padding:8px; background:#fff; border-radius:4px; max-width:300px;">
                <img src="${x.url || x.file || x.lokasi_file}" style="max-width:280px; max-height:280px; width:auto; height:auto; display:block; margin:0 auto; border:1px solid #ccc;">
                <div style="font-size:9px; color:#666; margin-top:6px; padding-top:6px; border-top:1px solid #eee;">${x.label || x.nama || x.kode || ''}</div>
            </div>
        `).join('');

                if (imgs) {
                    htmlBerkas += wrapSection('BERKAS DIGITAL', `
                        <div style="text-align:center;">
                            ${imgs}
                        </div>
                    `);
                }
            }
        }

        // === 9. LAPORAN OPERASI ===
        if (hasData(d.operasi)) {
            const ops = Array.isArray(d.operasi) ? d.operasi : (d.operasi.data || []);
            if (ops.length > 0) {
                const opHtml = ops.map(o => `
            <table class="print-table" style="border:none; margin-bottom:10px;">
                     <tr><td width="20%" style="border:none"><b>Tanggal</b></td><td style="border:none">: ${dateFmt(o.tgl_operasi)}</td></tr>
                     <tr><td style="border:none"><b>Jenis Operasi</b></td><td style="border:none">: ${txt(o.nm_paket_operasi)}</td></tr>
                     <tr><td style="border:none"><b>Operator</b></td><td style="border:none">: ${txt(o.nm_operator1)}</td></tr>
                     <tr><td style="border:none"><b>Diagnosa Pre-Op</b></td><td style="border:none">: ${txt(o.diagnosa_preop)}</td></tr>
                     <tr><td style="border:none"><b>Diagnosa Post-Op</b></td><td style="border:none">: ${txt(o.diagnosa_postop)}</td></tr>
                     <tr><td style="border:none"><b>Total Biaya</b></td><td style="border:none">: <b>Rp ${Number(o.total_biaya || 0).toLocaleString('id-ID')}</b></td></tr>
                     <tr><td colspan="2" style="border:none; padding-top:5px;"><b>Laporan Operasi:</b><br><div style="border:1px solid #ccc; padding:3px; white-space:pre-wrap;">${txt(o.laporan_operasi)}</div></td></tr>
                 </table>
            `).join('<hr style="border-top:1px dashed #ccc;">');
                htmlOperasi += wrapSection('LAPORAN OPERASI', opHtml);
            }
        }

        // === 10. LAPORAN TINDAKAN (Detailed) ===
        if (hasData(d.laptind)) {
            const lt = d.laptind.data || d.laptind;
            if (lt && (lt.laporan_tindakan || lt.laporan)) {
                const htmlLT = `
            <table class="print-table" style="border:none;">
                     <tr><td width="20%" style="border:none"><b>Tanggal</b></td><td style="border:none">: ${dateFmt(lt.tanggal)}</td></tr>
                     <tr><td style="border:none"><b>Tindakan</b></td><td style="border:none">: ${txt(lt.nama_tindakan || lt.nm_tindakan || 'Laporan Tindakan')}</td></tr>
                     <tr><td style="border:none"><b>Operator</b></td><td style="border:none">: ${txt(lt.operator || lt.nm_dokter)}</td></tr>
                     <tr><td colspan="2" style="border:none; padding-top:5px;"><b>Isi Laporan:</b><br><div style="border:1px solid #ccc; padding:3px; white-space:pre-wrap;">${txt(lt.laporan_tindakan || lt.laporan)}</div></td></tr>
                 </table>
            `;
                htmlLapTind += wrapSection('LAPORAN TINDAKAN', htmlLT);
            }
        }

        // === 11. PENUNJANG LAIN (USG/EKG dll) ===
        if (hasData(d.penunjang)) {
            const pData = Array.isArray(d.penunjang) ? d.penunjang : (d.penunjang.data || []);
            if (pData.length > 0) {
                const pHtml = pData.map(p => `
            <div style="margin-bottom:10px; border-bottom:1px dashed #ccc;">
                    <div style="font-weight:bold;">${dateFmt(p.tgl_periksa)} - ${txt(p.nm_dokter)}</div>
                    <div style="white-space:pre-wrap; font-size:10px;">${txt(p.hasil_pemeriksaan)}</div>
                 </div>
            `).join('');
                htmlPenunjang += wrapSection('LAPORAN PENUNJANG MEDIS', pHtml);
            }
        }

        // === 12. ASESMEN SPESIALIS (ORTHOPEDI & PENYAKIT DALAM) ===
        function renderDetailedSpesialisAssess(dAssess, title, isOrtho = false) {
            const i = dAssess.data || dAssess;
            if (!i || !hasContent(i, ['keluhan_utama', 'diagnosa', 'rps', 'rpd', 'terapi', 'tindakan', 'diagnosis'])) return '';

            const fisikRow = (lbl, stt) => `<tr><td style="width:100px;font-weight:bold;">${lbl}</td><td>: ${txt(stt)}</td></tr>`;

            // 1. Anamnesis
            const anamnesis = `
            <div class="mb-1"><b>A. ANAMNESIS</b></div>
                <table class="print-table" style="border:none; margin-bottom:10px;">
                    <tr><td width="20%" style="border:none"><b>Keluhan Utama</b></td><td style="border:none">: ${txt(i.keluhan_utama)}</td></tr>
                    <tr><td style="border:none"><b>RPS</b></td><td style="border:none">: ${txt(i.rps)}</td></tr>
                    <tr><td style="border:none"><b>RPD</b></td><td style="border:none">: ${txt(i.rpd)}</td></tr>
                    <tr><td style="border:none"><b>RPO</b></td><td style="border:none">: ${txt(i.rpo)}</td></tr>
                    <tr><td style="border:none"><b>Alergi</b></td><td style="border:none">: ${txt(i.alergi)}</td></tr>
                </table>`;

            // 2. Fisik & Vital
            const vital = `
                    <div class="mb-1"><b>B. PEMERIKSAAN FISIK & TTV</b></div>
             <div class="ttv-grid">
                 <div class="ttv-item"><div class="ttv-label">TD</div><div>${txt(i.td)} mmHg</div></div>
                 <div class="ttv-item"><div class="ttv-label">Nadi</div><div>${txt(i.nadi)} x/m</div></div>
                 <div class="ttv-item"><div class="ttv-label">Suhu</div><div>${txt(i.suhu)} °C</div></div>
                 <div class="ttv-item"><div class="ttv-label">RR</div><div>${txt(i.rr)} x/m</div></div>
                 <div class="ttv-item"><div class="ttv-label">GCS</div><div>${txt(i.gcs)}</div></div>
                 <div class="ttv-item"><div class="ttv-label">Kesadaran</div><div>${txt(i.kesadaran)}</div></div>
             </div>
             <div style="margin-top:5px; border:1px solid #ccc; padding:5px;">
                <table style="width:100%; font-size:10px;">
                    ${fisikRow('Kepala', i.kepala)}
                    ${fisikRow('Thoraks', i.thoraks)}
                    ${fisikRow('Abdomen', i.abdomen)}
                    ${fisikRow('Ekstremitas', i.ekstremitas)}
                </table>
             </div>
        `;

            // 3. Status Lokalis (Ortho Only)
            let lokalis = '';
            if (isOrtho && i.lokalis_url) {
                lokalis = `
            <div style="margin-top:10px; text-align:center;">
                    <b>STATUS LOKALIS:</b><br>
                    <img src="${i.lokalis_url}" style="max-height:150px; border:1px solid #ccc; margin:5px 0;"><br>
                    <i>${txt(i.ket_lokalis)}</i>
                </div>`;
            }

            // 4. Diagnosis & Plan
            const plan = `
             <div class="mb-1 mt-2"><b>D. DIAGNOSIS & TERAPI</b></div>
             <div style="border:1px solid #ccc; padding:5px; background:#f9f9f9;">
                 <div style="font-weight:bold; color:#000; margin-bottom:3px; text-decoration:underline;">DIAGNOSIS:</div>
                 <div style="margin-bottom:5px;">${txt(i.diagnosis)}</div>
                 ${i.diagnosis2 ? `<div style="font-size:10px;"><b>Sekunder:</b> ${txt(i.diagnosis2)}</div>` : ''}
                 
                 <div style="font-weight:bold; color:#000; margin-bottom:3px; margin-top:5px; text-decoration:underline;">TATALAKSANA:</div>
                 <ul style="margin:0; padding-left:15px;">
                    <li><b>Terapi:</b> ${txt(i.terapi)}</li>
                    <li><b>Tindakan:</b> ${txt(i.tindakan)}</li>
                    <li><b>Edukasi:</b> ${txt(i.edukasi)}</li>
                 </ul>
             </div>
         `;

            return wrapSection(title, anamnesis + vital + lokalis + plan);
        }

        // Render Ortho
        if (hasData(d.ortho)) {
            htmlAssess += renderDetailedSpesialisAssess(d.ortho, 'ASESMEN SPESIALIS ORTHOPEDI', true);
        }
        // Render PD
        if (hasData(d.pd)) {
            htmlAssess += renderDetailedSpesialisAssess(d.pd, 'ASESMEN SPESIALIS PENYAKIT DALAM', false);
        }

        // Combine all sections (Ordered: Asesmen, ICD/Diagnosa, Prosedur, SOAP, Tindakan, Resep, Lab, Rad, Berkas, dll, KFR, Rehab, Resume di akhir)
        const sectionsHtml = htmlAssess + htmlICD + htmlSoap + htmlTind + htmlLapTind + htmlResep + htmlLab + htmlRad + htmlBerkas + htmlPenunjang + htmlOperasi + htmlKfr + htmlRehab + htmlResume;
        const printTime = new Date().toLocaleString('id-ID');

        const headerHtml = `
            <div class="print-header">
                <img src="data:image/jpeg;base64,${setting.logo || ''}" class="print-logo" alt="Logo">
                <div class="print-instansi">
                    <h2>${txt(setting.nama_instansi)}</h2>
                    <p>${txt(setting.alamat_instansi)}, ${txt(setting.kabupaten)}, ${txt(setting.propinsi)}</p>
                    <p>Kontak: ${txt(setting.kontak)} | Email: ${txt(setting.email)}</p>
                </div>
            </div>`;

        const infoHtml = `
            <div class="print-subhead">Riwayat Rawat Jalan</div>
            <table class="patient-info-table">
                <tr><td class="label-cell">No. RM</td><td>: ${txt(g.patient.no_rkm_medis)}</td><td class="label-cell">No. Rawat</td><td>: ${txt(base.no_rawat)}</td></tr>
                <tr><td class="label-cell">Nama Pasien</td><td>: ${txt(g.patient.nm_pasien)}</td><td class="label-cell">Tgl. Kunjungan</td><td>: ${dateFmt(base.tgl)} ${txt(base.jam)}</td></tr>
                <tr><td class="label-cell">Tgl. Lahir</td><td>: ${dateFmt(g.patient.tgl_lahir)}</td><td class="label-cell">Poli / Dokter</td><td>: ${txt(base.poli)} / ${txt(base.dokter)}</td></tr>
            </table>`;

        const footerHtml = `
            <div class="footer-sig">
                <div class="sig-box">
                    <p>${txt(setting.kabupaten)}, ${dateFmt(base.tgl)}</p>
                    <p>Dokter Penanggung Jawab</p>
                    <div style="height:40px;"></div>
                    <p class="text-bold">(${txt(base.dokter)})</p>
                </div>
            </div>
            <div style="font-size:9px;text-align:right;margin-top:10px;border-top:1px dotted #ccc;">Dicetak pada ${printTime}</div>
        `;

        return `
            <div class="print-wrapper">
                ${headerHtml}
                ${infoHtml}
                ${sectionsHtml || '<div class="text-center">Data belum tersedia lengkap di riwayat ini.</div>'}
                ${footerHtml}
            </div>
        `;
    };

    // ================== UNIFIED PRINT FUNCTION (Refactored) ==================
    // ================== UNIFIED PRINT FUNCTION (Refactored) ==================
    window.printRiwayat = function (dataOverride) {
        console.log('printRiwayat called with data:', dataOverride);

        // Guard against double printing
        if (window.printInProgress) {
            console.warn('Print already in progress, ignoring duplicate call');
            return;
        }

        const d = dataOverride;
        if (!d || !d.base) {
            console.error('printRiwayat: Invalid data', d);
            return alert('Data belum siap. Silakan buka detail kunjungan terlebih dahulu.');
        }

        // Set flag to prevent double printing
        window.printInProgress = true;

        const content = generateReportHtml(d);

        const printWindow = window.open('', '_blank');

        // Reset flag after window opens
        setTimeout(() => {
            window.printInProgress = false;
        }, 1000);
        printWindow.document.write(`
            <!DOCTYPE html>
            <html>
                <head><title>Cetak Riwayat PDF</title>
                    <style>
                        @page { size: A4; margin: 10mm 15mm; }
                        body { font-family: "Times New Roman", Times, serif; font-size: 11px; margin: 0; padding: 10px; }
                        .text-center { text-align: center; } .text-right { text-align: right; } .text-bold { font-weight: bold; }
                        .print-header { display: flex; align-items: center; border-bottom: 3px double #000; padding-bottom: 5px; margin-bottom: 10px; }
                        .print-logo { width: 60px; height: 60px; object-fit: contain; margin-right: 15px; }
                        .print-instansi { flex: 1; text-align: center; }
                        .print-instansi h2 { font-size: 16px; margin: 0; font-weight: bold; }
                        .print-instansi p { margin: 1px 0; font-size: 10px; }
                        .print-subhead { text-align: center; font-size: 13px; font-weight: bold; margin-bottom: 10px; text-decoration: underline; text-transform: uppercase; }
                        .patient-info-table { width: 100%; margin-bottom: 15px; border-collapse: collapse; font-size: 11px; }
                        .patient-info-table td { padding: 2px; vertical-align: top; }
                        .label-cell { font-weight: bold; width: 15%; white-space: nowrap; }
                        .print-section { margin-bottom: 15px; break-inside: avoid; }
                        .section-title { font-size: 11px; font-weight: bold; background: #eee; border: 1px solid #000; padding: 3px 5px; margin-bottom: 0; text-transform: uppercase; }
                        .section-body { border: 1px solid #000; padding: 5px; }
                        .print-table { width: 100%; border-collapse: collapse; font-size: 10px; }
                        .print-table th, .print-table td { border: 1px solid #ccc; padding: 3px; }
                        .print-table th { background: #f8f8f8; text-align: left; }
                        .ttv-grid { display: grid; grid-template-columns: repeat(8, 1fr); gap: 2px; margin-bottom: 5px; }
                        .ttv-item { border: 1px solid #ccc; padding: 2px; text-align: center; font-size: 10px; }
                        .ttv-label { font-weight: bold; font-size: 9px; color: #555; }
                        .footer-sig { margin-top: 20px; display: flex; justify-content: flex-end; break-inside: avoid; }
                        .sig-box { text-align: center; width: 200px; font-size: 11px; }
                        .print-wrapper { page-break-after: always; display: block; }
                        .print-wrapper:last-child { page-break-after: auto; }
                    </style>
                </head>
                <body onload="window.print()">${content}</body>
            </html>
        `);
        printWindow.document.close();
    };

    // ================== BULK PRINT FUNCTION ==================
    // NOTE: Bulk print is now handled by printBulkRiwayat() function (see bottom of file)
    // Event handler is at line ~3048



    // End of Bulk Print Logic

    // Continue with other functions...
    /* ================== LOAD DETAIL (Reusable) ================== */
    function loadFullDetailInto($container, base) {
        const norawat = base.no_rawat;
        $container.append(headerBlock(base));

        // Event handler untuk badge di header detail
        $container.off('click', '.rp-badge-click').on('click', '.rp-badge-click', function (e) {
            e.stopPropagation();
            state.badgeSpotlight = $(this).data('badge');
            applyBadgeSpotlight($container);
        });

        // ================== LOAD ALL DATA PARALLEL ==================
        // ================== LOAD ALL DATA PARALLEL ==================
        $.when(
            $.get(API_URLS.RP_SUMMARY, { no_rawat: norawat }),
            $.get(API_URLS.RP_SOAP, { no_rawat: norawat }),
            $.get(API_URLS.RP_DIAG, { no_rawat: norawat }),
            $.get(API_URLS.RP_PROC, { no_rawat: norawat }),
            $.get(API_URLS.RP_TIND, { no_rawat: norawat }),
            $.get(API_URLS.RP_RESEP, { no_rawat: norawat }),
            $.get(API_URLS.RP_LAB, { no_rawat: norawat }),
            $.get(API_URLS.RP_RAD, { no_rawat: norawat }),
            $.get(API_URLS.RP_RAD_DOCS, { no_rawat: norawat }),
            $.get(API_URLS.RP_BERKAS, { no_rawat: norawat }),
            $.get(API_URLS.RP_OPERASI, { no_rawat: norawat }),
            $.get(API_URLS.RP_PENUNJANG, { no_rawat: norawat }),
            $.get(API_URLS.RP_LAPORAN_TINDAKAN, { no_rawat: norawat }),
            $.get(API_URLS.RP_KD_IGD, { no_rawat: norawat }),
            $.get(API_URLS.RP_ASESMEN_PD, { no_rawat: norawat }),
            $.get(API_URLS.RP_ASESMEN_ORTHO, { no_rawat: norawat }),
            $.get(API_URLS.RP_FORMULIR_KFR, { no_rawat: norawat }),
            $.get(API_URLS.RP_PROGRAM_REHAB_MEDIK, { no_rawat: norawat })
        ).done(function (
            summaryRes, soapRes, diagRes, procRes, tindRes, resepRes,
            labRes, radRes, rdocsRes, berkasRes, operasiRes, penunjangRes, laptindRes, igdRes, pdRes, orthoRes, kfrRes, rehabRes
        ) {
            // ================== PARSE JSON RESPONSE ==================
            const J = x => { try { return (typeof x[0] === 'string') ? JSON.parse(x[0]) : x[0]; } catch (_) { return {}; } };

            const summary = J(summaryRes), soapRaw = J(soapRes);
            const diag = J(diagRes), proc = J(procRes), tind = J(tindRes), resep = J(resepRes);
            const lab = J(labRes), rad = J(radRes), rdocs = J(rdocsRes), berkas = J(berkasRes);
            const operasi = J(operasiRes), penunjang = J(penunjangRes), laptind = J(laptindRes);
            const igd = J(igdRes), pd = J(pdRes), ortho = J(orthoRes), kfr = J(kfrRes), rehab = J(rehabRes);

            // Debug: Check if KFR and Rehab data exist
            console.log('KFR Data:', kfr);
            console.log('Rehab Data:', rehab);

            // SAVE DATA FOR PRINT (Localized & Global - Global updated just in case)
            const printPayload = {
                summary, soapRaw, diag, proc, tind, resep, lab, rad,
                rdocs, berkas, operasi, penunjang, laptind, igd, pd, ortho, kfr, rehab,
                base: base
            };
            window.currentPrintData = printPayload;

            // DIRECT CLICK HANDLER (Closure Scope)
            // Fixes "merged data" issues by ensuring this specific button uses this specific data.
            // ALSO ATTACH DATA for Bulk Print
            $container.find('.btn-print-riwayat')
                .data('printPayload', printPayload)
                .off('click').on('click', function (e) {
                    e.preventDefault();
                    console.log('Print button clicked, payload:', printPayload);
                    window.printRiwayat(printPayload);
                });

            const data = summary.data || summary || {};
            const resume = data.resume || null;
            const ttvSum = data.ttv_terakhir || {};

            // Array untuk menampung card yang akan ditampilkan
            const cardsToShow = [];

            // Helper function untuk warna kesadaran
            function getKesadaranColor(kesadaran) {
                const k = (kesadaran || '').toLowerCase();
                if (k.includes('compos')) return '#10b981'; // Green
                if (k.includes('apatis')) return '#f59e0b'; // Amber
                if (k.includes('delirium')) return '#f97316'; // Orange
                if (k.includes('somnolen')) return '#f43f5e'; // Rose
                if (k.includes('sopor')) return '#d946ef'; // Fuchsia
                if (k.includes('coma') || k.includes('koma')) return '#ef4444'; // Red
                return '#64748b'; // Slate
            }

            // ================== SHARED HELPERS ==================
            // Helper untuk Box Tanda Vital
            const ttvBox = (label, val, unit = '') => {
                const v = (val || '-').toString().trim();
                const isSet = v !== '-' && v !== '';
                return `
                <div style="background:#f8f9fa; border:1px solid #e9ecef; border-radius:4px; padding:6px 8px; text-align:center;" >
                        <div style="font-size:10px; text-transform:uppercase; color:#8898aa; letter-spacing:0.5px; margin-bottom:2px;">${escHtml(label)}</div>
                        <div style="font-weight:700; color:#32325d; font-size:13px;">
                            ${escHtml(v)} <span style="font-weight:400; font-size:11px; color:#888;">${unit}</span>
                        </div>
                    </div > `;
            };

            // Helper untuk Row Tabel Anamnesis
            const row = (label, val) => `
                <tr >
                        <td style="width:130px; color:#525f7f; padding:5px 0; vertical-align:top; border-bottom:1px solid #f6f9fc;">${escHtml(label)}</td>
                        <td style="padding:5px 0 5px 15px; vertical-align:top; color:#32325d; font-weight:500; border-bottom:1px solid #f6f9fc; line-height:1.5;">${escHtml(val || '-')}</td>
                    </tr > `;

            // ================== RENDER ASESMEN SPESIALIS (Common Logic) ==================
            function renderSpesialis(dataObj, title, icon, colorTheme, isOrtho = false) {
                const d = dataObj.data || dataObj || {};
                // Cek data valid (harus ada tanggal/keluhan/diagnosa)
                // Strict check: Must have at least one meaningful field
                if (!hasKeys(d, ['keluhan_utama', 'rps', 'rpd', 'diagnosa', 'terapi'])) return;

                let html = `<div style="display:flex; flex-wrap:wrap; gap:24px;" > `;

                // --- KOLOM KIRI: DATA MEDIS ---
                html += `<div style="flex:1; min-width:320px;" > `;

                // 1. ANAMNESIS
                html += `<div style="margin-bottom:20px;" >
                            <h5 style="font-size:12px; font-weight:700; color:${colorTheme}; text-transform:uppercase; letter-spacing:1px; margin-bottom:12px; border-bottom:2px solid ${colorTheme}; display:inline-block; padding-bottom:4px;">
                                <i class="fa fa-history"></i> Anamnesis
                            </h5>
                            <table style="width:100%; font-size:13px; border-collapse:collapse;">
                                ${row('Keluhan Utama', d.keluhan_utama)}
                                ${row('RPS', d.rps)}
                                ${row('RPD', d.rpd)}
                                ${row('RPO', d.rpo)}
                                ${row('Alergi', d.alergi)}
                            </table>
                        </div > `;

                // 2. FISIK & VITAL
                html += `<div style="margin-bottom:20px;" >
                             <h5 style="font-size:12px; font-weight:700; color:#2dce89; text-transform:uppercase; letter-spacing:1px; margin-bottom:12px; border-bottom:2px solid #2dce89; display:inline-block; padding-bottom:4px;">
                                <i class="fa fa-heartbeat"></i> Status Fisik
                            </h5>
                            <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(80px, 1fr)); gap:10px; margin-bottom:12px;">
                                ${ttvBox('TD', d.td, 'mmHg')}
                                ${ttvBox('Nadi', d.nadi, 'x/m')}
                                ${ttvBox('Suhu', d.suhu, '°C')}
                                ${ttvBox('RR', d.rr, 'x/m')}
                                ${ttvBox('GCS', d.gcs)}
                                ${ttvBox('Kesadaran', d.kesadaran)}
                            </div>
                            <!--Fisik Organ Simple-- >
                <div style="background:#f9fafb; padding:10px; border-radius:6px; font-size:13px; border:1px solid #eee;">
                    <strong>Kepala:</strong> ${escHtml(d.kepala || '-')} &bull;
                    <strong>Thoraks:</strong> ${escHtml(d.thoraks || '-')} &bull;
                    <strong>Abdomen:</strong> ${escHtml(d.abdomen || '-')} &bull;
                    <strong>Ekstremitas:</strong> ${escHtml(d.ekstremitas || '-')}
                </div>
                        </div > `;

                // 3. DIAGNOSA & PLAN
                html += `<div >
                            <h5 style="font-size:12px; font-weight:700; color:#f5365c; text-transform:uppercase; letter-spacing:1px; margin-bottom:12px; border-bottom:2px solid #f5365c; display:inline-block; padding-bottom:4px;">
                                <i class="fa fa-stethoscope"></i> Diagnosis & Plan
                            </h5>
                            
                            <div style="background:#fff5f5; border-left:4px solid #f5365c; padding:12px; border-radius:4px; margin-bottom:12px;">
                                <div style="font-size:11px; color:#f5365c; font-weight:700; text-transform:uppercase; margin-bottom:4px;">Diagnosis Utama</div>
                                <div style="font-size:14px; font-weight:600; color:#32325d;">${escHtml(d.diagnosis || '-')}</div>
                                ${d.diagnosis2 ? `<hr style="border-top:1px dashed #fcd34d; margin:8px 0;"><div style="font-size:11px; color:#888;"><b>Banding/Sekunder:</b> ${escHtml(d.diagnosis2)}</div>` : ''}
                            </div>

                            <div style="background:#f6f9fc; border-left:4px solid ${colorTheme}; padding:12px; border-radius:4px;">
                                <div style="font-size:11px; color:${colorTheme}; font-weight:700; text-transform:uppercase; margin-bottom:4px;">Tatalaksana / Tindakan</div>
                                <ul style="margin:0; padding-left:16px; font-size:13px; color:#525f7f; line-height:1.6;">
                                    ${d.terapi ? `<li><b>Terapi:</b> ${escHtml(d.terapi)}</li>` : ''}
                                    ${d.tindakan ? `<li><b>Tindakan:</b> ${escHtml(d.tindakan)}</li>` : ''}
                                    ${d.edukasi ? `<li><b>Edukasi:</b> ${escHtml(d.edukasi)}</li>` : ''}
                                </ul>
                            </div>
                        </div > `;
                html += `</div > `; // End Left Col

                // --- KOLOM KANAN: LOKALIS (Only if Ortho or specific data exists) ---
                if (isOrtho && d.lokalis_url) {
                    html += `<div style="width:300px; flex-shrink:0;" >
                            <h5 style="font-size:12px; font-weight:700; color:#11cdef; text-transform:uppercase; letter-spacing:1px; margin-bottom:12px; border-bottom:2px solid #11cdef; display:inline-block; padding-bottom:4px;">
                                <i class="fa fa-universal-access"></i> Status Lokalis
                            </h5>
                            <div style="background:#fff; border:1px solid #e9ecef; border-radius:8px; padding:4px; box-shadow:0 4px 6px rgba(50,50,93,.11), 0 1px 3px rgba(0,0,0,.08);">
                                <a href="${d.lokalis_url}?t=${new Date().getTime()}" target="_blank" title="Klik untuk memperbesar">
                                    <img src="${d.lokalis_url}?t=${new Date().getTime()}" style="width:100%; height:auto; display:block; border-radius:4px;" alt="Anatomi">
                                </a>
                                <div style="padding:10px; background:#f6f9fc; border-top:1px solid #e9ecef; margin-top:4px; border-radius:0 0 4px 4px;">
                                    <div style="font-size:10px; color:#8898aa; text-transform:uppercase; margin-bottom:2px;">Keterangan:</div>
                                    <div style="font-size:12px; font-style:italic; color:#525f7f;">${escHtml(d.ket_lokalis || '-')}</div>
                                </div>
                            </div>
                        </div > `;
                }

                html += `</div > `; // End Flex

                // Meta Footer
                html += `<div style="margin-top:20px; padding-top:10px; border-top:1px dashed #e9ecef; display:flex; justify-content:space-between; align-items:center;" >
                <div style="font-size:12px; color:#525f7f;">
                    <i class="fa fa-user-md"></i> <b>${escHtml(d.nm_dokter)}</b>
                    <span style="color:#8898aa; margin:0 5px;">&bull;</span>
                    <i class="fa fa-clock-o"></i> ${escHtml(d.tanggal)}
                </div>
                        </div > `;

                cardsToShow.push(cardWrap('soap', title, html));
            }

            // ================== RENDER FUNCTIONS ==================

            function renderAsesmenOrtho() { renderSpesialis(ortho, 'Asesmen Awal Orthopedi', 'fa-wheelchair', '#5e72e4', true); }
            function renderAsesmenPD() { renderSpesialis(pd, 'Asesmen Awal Penyakit Dalam', 'fa-stethoscope', '#11cdef', false); }

            // === 0. RENDER ASESMEN IGD PEMERIKSAAN MEDIS (CLEAN LAYOUT) ===
            function renderIGD() {
                const data = igd.data || igd || {};

                if (hasKeys(data, ['keluhan_utama', 'rpd', 'rps', 'ket_lokalis', 'diagnosis', 'terapi'])) {
                    let html = `<div style="display:flex; flex-wrap:wrap; gap:24px;" > `;

                    // --- KOLOM KIRI: DATA MEDIS (Flex Grow) ---
                    html += `<div style="flex:1; min-width:320px;" > `;

                    // 1. ANAMNESIS
                    html += `<div style="margin-bottom:20px;" >
                            <h5 style="font-size:12px; font-weight:700; color:#5e72e4; text-transform:uppercase; letter-spacing:1px; margin-bottom:12px; border-bottom:2px solid #5e72e4; display:inline-block; padding-bottom:4px;">
                                <i class="fa fa-history"></i> Anamnesis
                            </h5>
                            <table style="width:100%; font-size:13px; border-collapse:collapse;">
                                ${row('Keluhan Utama', data.keluhan_utama)}
                                ${row('Riwayat Penyakit Skrg', data.rps)}
                                ${row('Riwayat Penyakit Dhl', data.rpd)}
                                ${row('Alergi', data.alergi)}
                            </table>
                        </div > `;

                    // 2. TANDA VITAL (Modern Grid)
                    html += `<div style="margin-bottom:20px;" >
                             <h5 style="font-size:12px; font-weight:700; color:#2dce89; text-transform:uppercase; letter-spacing:1px; margin-bottom:12px; border-bottom:2px solid #2dce89; display:inline-block; padding-bottom:4px;">
                                <i class="fa fa-heartbeat"></i> Tanda Vital & Fisik
                            </h5>
                            <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(80px, 1fr)); gap:10px;">
                                ${ttvBox('GCS', data.gcs)}
                                ${ttvBox('Kesadaran', data.kesadaran)}
                                ${ttvBox('TD', data.td, 'mmHg')}
                                ${ttvBox('Nadi', data.nadi, 'x/m')}
                                ${ttvBox('RR', data.rr, 'x/m')}
                                ${ttvBox('Suhu', data.suhu, '°C')}
                                ${ttvBox('SpO2', (data.spo || data.spo2), '%')}
                                ${ttvBox('Keadaan', data.keadaan)}
                            </div>
                        </div > `;

                    // 3. DIAGNOSIS & TERAPI
                    html += `<div >
                            <h5 style="font-size:12px; font-weight:700; color:#f5365c; text-transform:uppercase; letter-spacing:1px; margin-bottom:12px; border-bottom:2px solid #f5365c; display:inline-block; padding-bottom:4px;">
                                <i class="fa fa-stethoscope"></i> Diagnosis & Tindakan
                            </h5>
                            
                            <div style="background:#fff5f5; border-left:4px solid #f5365c; padding:12px; border-radius:4px; margin-bottom:12px;">
                                <div style="font-size:11px; color:#f5365c; font-weight:700; text-transform:uppercase; margin-bottom:4px;">Diagnosis Utama</div>
                                <div style="font-size:14px; font-weight:600; color:#32325d;">${escHtml(data.diagnosis || '-')}</div>
                            </div>
                            
                            <div style="background:#f6f9fc; border-left:4px solid #5e72e4; padding:12px; border-radius:4px;">
                                <div style="font-size:11px; color:#5e72e4; font-weight:700; text-transform:uppercase; margin-bottom:4px;">Tatalaksana / Terapi</div>
                                <div style="font-size:13px; color:#525f7f; white-space:pre-wrap; line-height:1.6;">${escHtml(data.tata || data.tata_laksana || '-')}</div>
                            </div>
                        </div > `;

                    html += `</div > `; // END KOLOM KIRI

                    // --- KOLOM KANAN: LOKALIS (Fixed Width if Image exists) ---
                    if (data.lokalis_url) {
                        html += `<div style="width:300px; flex-shrink:0;" >
                            <h5 style="font-size:12px; font-weight:700; color:#11cdef; text-transform:uppercase; letter-spacing:1px; margin-bottom:12px; border-bottom:2px solid #11cdef; display:inline-block; padding-bottom:4px;">
                                <i class="fa fa-universal-access"></i> Status Lokalis
                            </h5>
                            <div style="background:#fff; border:1px solid #e9ecef; border-radius:8px; padding:4px; box-shadow:0 4px 6px rgba(50,50,93,.11), 0 1px 3px rgba(0,0,0,.08); transition:all .15s ease;">
                                <a href="${data.lokalis_url}?t=${new Date().getTime()}" target="_blank" title="Klik untuk memperbesar">
                                    <img src="${data.lokalis_url}?t=${new Date().getTime()}" style="width:100%; height:auto; display:block; border-radius:4px;" alt="Anatomi">
                                </a>
                                <div style="padding:10px; background:#f6f9fc; border-top:1px solid #e9ecef; margin-top:4px; border-radius:0 0 4px 4px;">
                                    <div style="font-size:10px; color:#8898aa; text-transform:uppercase; margin-bottom:2px;">Keterangan:</div>
                                    <div style="font-size:12px; font-style:italic; color:#525f7f;">${escHtml(data.ket_lokalis || '-')}</div>
                                </div>
                            </div>
                        </div > `;
                    }

                    html += `</div > `; // END FLEX CONTAINER

                    // FOOTER META
                    html += `<div style="margin-top:20px; padding-top:10px; border-top:1px dashed #e9ecef; display:flex; justify-content:space-between; align-items:center;" >
                        <span class="badge badge-default" style="font-weight:400; color:#8898aa; background:transparent; font-size:11px;">
                            ID: ${escHtml(data.no_rawat)}
                        </span>
                        <div style="font-size:12px; color:#525f7f;">
                            <i class="fa fa-user-md"></i> <b>${escHtml(data.nm_dokter)}</b> 
                            <span style="color:#8898aa; margin:0 5px;">&bull;</span> 
                            <i class="fa fa-clock-o"></i> ${escHtml(data.tanggal)}
                        </div>
                    </div > `;

                    cardsToShow.push(cardWrap('soap', 'Asesmen Awal IGD', html));
                }
            }

            // === 1. RENDER SOAP (VERSI CARD - LEBIH RAPI) ===
            function renderSOAP() {
                let soapItems = [];
                if (Array.isArray(soapRaw?.data?.items)) soapItems = soapRaw.data.items.slice();
                else if (Array.isArray(soapRaw?.items)) soapItems = soapRaw.items.slice();
                else if (soapRaw?.soap) soapItems = [soapRaw.soap];
                else if (Array.isArray(soapRaw)) soapItems = soapRaw.slice();

                // Sort by datetime descending (newest first)
                soapItems.sort((a, b) => {
                    const ta = (a.tgl_perawatan || '') + ' ' + (a.jam_rawat || '');
                    const tb = (b.tgl_perawatan || '') + ' ' + (b.jam_rawat || '');
                    return ta < tb ? 1 : ta > tb ? -1 : 0;
                });

                if (soapItems.length > 0) {
                    const soapHtml = soapItems.map((item, index) => {
                        const tgl = item.tgl_perawatan ? new Date(item.tgl_perawatan).toLocaleDateString('id-ID') : '-';
                        const jam = item.jam_rawat || '-';
                        const petugas = item.nm_petugas || '-';

                        // Data SOAP lengkap dari pemeriksaan_ralan
                        const keluhan = item.keluhan || '-';
                        const pemeriksaan = item.pemeriksaan || '-';
                        const penilaian = item.penilaian || '-';
                        const rtl = item.rtl || '-';
                        const instruksi = item.instruksi || '-';
                        const evaluasi = item.evaluasi || '-';
                        const alergi = item.alergi || '-';
                        const lingkarPerut = item.lingkar_perut || '-';

                        return `
                <div class="soap-card" style="margin-bottom: 16px; padding: 16px; border: 1px solid #e2e8f0; border-radius: 8px; background: white; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
                                <!--Header-->
                                <div style="display: flex; justify-content: between; align-items: start; margin-bottom: 12px; padding-bottom: 12px; border-bottom: 1px solid #f1f5f9;">
                                    <div style="flex: 1;">
                                        <div style="font-weight: 600; color: #1e293b; font-size: 14px;">${tgl} • ${jam}</div>
                                        <div style="color: #64748b; font-size: 12px; margin-top: 2px;">Oleh: ${escHtml(petugas)}</div>
                                    </div>
                                    <div style="font-size: 12px; color: #64748b; background: #f8fafc; padding: 4px 8px; border-radius: 4px;">
                                        Entri ${index + 1}
                                    </div>
                                </div>
                                
                                <!--SOAP Content dalam grid-->
                                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                                    <!-- Kolom Kiri -->
                                    <div style="display: flex; flex-direction: column; gap: 12px;">
                                        <div>
                                            <div style="font-weight: 600; color: #dc2626; font-size: 12px; margin-bottom: 4px;">SUBJEKTIF (Keluhan)</div>
                                            <div style="color: #374151; font-size: 13px; line-height: 1.4; background: #fef2f2; padding: 8px; border-radius: 4px; min-height: 40px; max-height: 120px; overflow-y: auto;">
                                                ${escHtml(keluhan)}
                                            </div>
                                        </div>
                                        
                                        <div>
                                            <div style="font-weight: 600; color: #059669; font-size: 12px; margin-bottom: 4px;">ASESMEN (Penilaian)</div>
                                            <div style="color: #374151; font-size: 13px; line-height: 1.4; background: #f0fdf4; padding: 8px; border-radius: 4px; min-height: 40px; max-height: 120px; overflow-y: auto;">
                                                ${escHtml(penilaian)}
                                            </div>
                                        </div>
                                        
                                        <div>
                                            <div style="font-weight: 600; color: #7c3aed; font-size: 12px; margin-bottom: 4px;">INSTRUKSI</div>
                                            <div style="color: #374151; font-size: 13px; line-height: 1.4; background: #faf5ff; padding: 8px; border-radius: 4px; min-height: 40px; max-height: 120px; overflow-y: auto;">
                                                ${escHtml(instruksi)}
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Kolom Kanan -->
                                    <div style="display: flex; flex-direction: column; gap: 12px;">
                                        <div>
                                            <div style="font-weight: 600; color: #d97706; font-size: 12px; margin-bottom: 4px;">OBJEKTIF (Pemeriksaan)</div>
                                            <div style="color: #374151; font-size: 13px; line-height: 1.4; background: #fffbeb; padding: 8px; border-radius: 4px; min-height: 40px; max-height: 120px; overflow-y: auto;">
                                                ${escHtml(pemeriksaan)}
                                            </div>
                                        </div>
                                        
                                        <div>
                                            <div style="font-weight: 600; color: #0369a1; font-size: 12px; margin-bottom: 4px;">PLAN (RTL)</div>
                                            <div style="color: #374151; font-size: 13px; line-height: 1.4; background: #f0f9ff; padding: 8px; border-radius: 4px; min-height: 40px; max-height: 120px; overflow-y: auto;">
                                                ${escHtml(rtl)}
                                            </div>
                                        </div>
                                        
                                        <div>
                                            <div style="font-weight: 600; color: #475569; font-size: 12px; margin-bottom: 4px;">EVALUASI</div>
                                            <div style="color: #374151; font-size: 13px; line-height: 1.4; background: #f8fafc; padding: 8px; border-radius: 4px; min-height: 40px; max-height: 120px; overflow-y: auto;">
                                                ${escHtml(evaluasi)}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!--Informasi Tambahan-- >
                <div style="display: flex; gap: 16px; margin-top: 12px; padding-top: 12px; border-top: 1px solid #f1f5f9;">
                    <div style="flex: 1;">
                        <div style="font-weight: 600; color: #475569; font-size: 12px; margin-bottom: 2px;">Alergi</div>
                        <div style="color: #374151; font-size: 13px;">${escHtml(alergi)}</div>
                    </div>
                    <div>
                        <div style="font-weight: 600; color: #475569; font-size: 12px; margin-bottom: 2px;">Lingkar Perut</div>
                        <div style="color: #374151; font-size: 13px;">${lingkarPerut} cm</div>
                    </div>
                </div>
                            </div >
                `;
                    }).join('');

                    cardsToShow.push(cardWrap('soap', `SOAP(${soapItems.length} entri)`, soapHtml));
                }
            }

            // === 2. RENDER TANDA VITAL (VERSI TABEL + GRAFIK) ===
            function renderTandaVital() {
                let soapItems = [];
                if (Array.isArray(soapRaw?.data?.items)) soapItems = soapRaw.data.items.slice();
                else if (Array.isArray(soapRaw?.items)) soapItems = soapRaw.items.slice();
                else if (soapRaw?.soap) soapItems = [soapRaw.soap];
                else if (Array.isArray(soapRaw)) soapItems = soapRaw.slice();

                // Sort by datetime descending (newest first)
                soapItems.sort((a, b) => {
                    const ta = (a.tgl_perawatan || '') + ' ' + (a.jam_rawat || '');
                    const tb = (b.tgl_perawatan || '') + ' ' + (b.jam_rawat || '');
                    return ta < tb ? 1 : ta > tb ? -1 : 0;
                });

                if (soapItems.length > 0) {
                    const ttvTable = `
                <div style="overflow-x: auto; margin-bottom: 20px;" >
                    <table style="width: 100%; border-collapse: collapse; font-size: 14px;">
                        <thead>
                            <tr style="background: #f8fafc; border-bottom: 2px solid #e2e8f0;">
                                <th style="padding: 12px 8px; text-align: left; font-weight: 600; color: #475569; min-width: 140px;">Tanggal & Waktu</th>
                                <th style="padding: 12px 8px; text-align: left; font-weight: 600; color: #475569; min-width: 150px;">Petugas</th>
                                <th style="padding: 12px 8px; text-align: center; font-weight: 600; color: #475569;">TD</th>
                                <th style="padding: 12px 8px; text-align: center; font-weight: 600; color: #475569;">Nadi</th>
                                <th style="padding: 12px 8px; text-align: center; font-weight: 600; color: #475569;">RR</th>
                                <th style="padding: 12px 8px; text-align: center; font-weight: 600; color: #475569;">Suhu</th>
                                <th style="padding: 12px 8px; text-align: center; font-weight: 600; color: #475569;">SpO₂</th>
                                <th style="padding: 12px 8px; text-align: center; font-weight: 600; color: #475569;">Berat</th>
                                <th style="padding: 12px 8px; text-align: center; font-weight: 600; color: #475569;">Tinggi</th>
                                <th style="padding: 12px 8px; text-align: center; font-weight: 600; color: #475569;">GCS</th>
                                <th style="padding: 12px 8px; text-align: center; font-weight: 600; color: #475569;">Kesadaran</th>
                            </tr>
                        </thead>
                        <tbody>
                            ${soapItems.map((item, index) => {
                        const tgl = item.tgl_perawatan ? new Date(item.tgl_perawatan).toLocaleDateString('id-ID') : '-';
                        const jam = item.jam_rawat || '-';
                        const petugas = item.nm_petugas || '-';

                        const tensi = item.tensi || '-';
                        const nadi = item.nadi || '-';
                        const respirasi = item.respirasi || '-';
                        const suhu = item.suhu_tubuh || '-';
                        const spo2 = item.spo2 || '-';
                        const berat = item.berat || '-';
                        const tinggi = item.tinggi || '-';
                        const gcs = item.gcs || '-';
                        const kesadaran = item.kesadaran || '-';

                        return `
                                            <tr style="border-bottom: 1px solid #f1f5f9; ${index % 2 === 0 ? 'background: #fafbfc;' : ''}">
                                                <td style="padding: 12px 8px; vertical-align: top;">
                                                    <div style="font-weight: 500; color: #1e293b;">${tgl}</div>
                                                    <div style="font-size: 12px; color: #64748b;">${jam}</div>
                                                </td>
                                                <td style="padding: 12px 8px; vertical-align: top;">
                                                    <div style="font-weight: 500; color: #1e293b;">${escHtml(petugas)}</div>
                                                    <div style="font-size: 12px; color: #64748b;">Petugas</div>
                                                </td>
                                                <td style="padding: 12px 8px; text-align: center; vertical-align: top; color: #334155; font-weight: 500;">${tensi}</td>
                                                <td style="padding: 12px 8px; text-align: center; vertical-align: top; color: #334155;">
                                                    ${nadi !== '-' ? `<span style="color: ${nadi < 60 || nadi > 100 ? '#dc2626' : '#059669'}">${nadi}</span>` : '-'}
                                                </td>
                                                <td style="padding: 12px 8px; text-align: center; vertical-align: top; color: #334155;">
                                                    ${respirasi !== '-' ? `<span style="color: ${respirasi < 12 || respirasi > 20 ? '#dc2626' : '#059669'}">${respirasi}</span>` : '-'}
                                                </td>
                                                <td style="padding: 12px 8px; text-align: center; vertical-align: top; color: #334155;">
                                                    ${suhu !== '-' ? `<span style="color: ${suhu < 36.5 || suhu > 37.5 ? '#dc2626' : '#059669'}">${suhu}°C</span>` : '-'}
                                                </td>
                                                <td style="padding: 12px 8px; text-align: center; vertical-align: top; color: #334155;">
                                                    ${spo2 !== '-' ? `<span style="color: ${spo2 < 95 ? '#dc2626' : '#059669'}">${spo2}%</span>` : '-'}
                                                </td>
                                                <td style="padding: 12px 8px; text-align: center; vertical-align: top; color: #334155;">${berat} kg</td>
                                                <td style="padding: 12px 8px; text-align: center; vertical-align: top; color: #334155;">${tinggi} cm</td>
                                                <td style="padding: 12px 8px; text-align: center; vertical-align: top; color: #334155; font-weight: ${gcs !== '-' ? '600' : 'normal'}">${gcs}</td>
                                                <td style="padding: 12px 8px; text-align: center; vertical-align: top; color: #334155;">
                                                    <span style="padding: 4px 8px; border-radius: 4px; font-size: 12px; background: ${getKesadaranColor(kesadaran)}; color: white;">
                                                        ${kesadaran}
                                                    </span>
                                                </td>
                                            </tr>
                                        `;
                    }).join('')}
                        </tbody>
                    </table>
                        </div >

                ${renderTTVTrendsChart(soapItems)}
            `;

                    cardsToShow.push(cardWrap('ttv', `Tanda Vital(${soapItems.length} pengukuran)`, ttvTable));
                }
            }

            // === TREND CHART FOR TTV (COMPACT VERSION) ===
            function renderTTVTrendsChart(soapItems) {
                // Siapkan data untuk chart - selalu render meski hanya 1 data
                const validData = soapItems
                    .map(item => {
                        const dateTime = new Date(`${item.tgl_perawatan} ${item.jam_rawat} `);
                        const tensiParsed = parseTD(item.tensi);

                        return {
                            timestamp: dateTime.getTime(),
                            dateTime,
                            label: dateTime.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' }),
                            dateLabel: dateTime.toLocaleDateString('id-ID'),
                            tensi: item.tensi || '-',
                            tensiSys: tensiParsed[0],
                            tensiDia: tensiParsed[1],
                            nadi: Number(item.nadi) || null,
                            respirasi: Number(item.respirasi) || null,
                            suhu: Number(item.suhu_tubuh) || null,
                            spo2: Number(item.spo2) || null
                        };
                    })
                    .filter(item => item.tensiSys !== null || item.nadi !== null || item.respirasi !== null || item.suhu !== null || item.spo2 !== null)
                    .sort((a, b) => a.timestamp - b.timestamp);

                // Jika tidak ada data TTV sama sekali, jangan render chart
                if (validData.length === 0) return '';

                return `
                <div style="margin-top: 16px; padding-top: 12px; border-top: 1px solid #e2e8f0;" >
            <h4 style="color: #374151; margin-bottom: 12px; font-size: 14px;">Trend Tanda Vital</h4>
            <div style="display: grid; grid-template-columns: repeat(5, 1fr); gap: 8px;">
                ${renderCompactBloodPressureChart(validData)}
                ${renderCompactMetricChart(validData, 'nadi', 'Nadi', 'bpm', '#059669', { min: 60, max: 100 })}
                ${renderCompactMetricChart(validData, 'respirasi', 'RR', 'rpm', '#7c3aed', { min: 12, max: 20 })}
                ${renderCompactMetricChart(validData, 'suhu', 'Suhu', '°C', '#d97706', { min: 36.5, max: 37.5 })}
                ${renderCompactMetricChart(validData, 'spo2', 'SpO₂', '%', '#ec4899', { min: 95, max: 100 })}
            </div>
            
            ${validData.length === 1 ? `
                <div style="margin-top: 8px; padding: 8px; background: #fef3c7; border-radius: 4px; border: 1px solid #f59e0b;">
                    <div style="display: flex; align-items: center; gap: 6px; color: #92400e; font-size: 11px;">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/>
                        </svg>
                        Grafik akan menunjukkan trend ketika ada lebih dari 1 pengukuran
                    </div>
                </div>
            ` : ''
                    }
        </div >
                `;
            }

            // Chart compact untuk Tekanan Darah
            function renderCompactBloodPressureChart(data) {
                const hasData = data.some(d => d.tensiSys !== null && d.tensiDia !== null);
                if (!hasData) return '';

                return `
                <div style="background: white; padding: 8px; border-radius: 6px; border: 1px solid #e2e8f0; height: 120px;" >
            <div style="text-align: center; margin-bottom: 8px;">
                <div style="font-weight: 600; color: #374151; font-size: 11px; margin-bottom: 2px;">TD</div>
                <div style="font-size: 9px; color: #64748b;">mmHg</div>
            </div>
            <div style="height: 70px; position: relative;">
                <div style="display: flex; height: 100%; align-items: end; gap: ${data.length > 4 ? '2px' : '3px'}; padding: 0 4px; justify-content: center;">
                    ${data.map((item, index) => {
                    if (item.tensiSys === null || item.tensiDia === null) return '';

                    const heightSys = calculateCompactHeight(item.tensiSys, 'tensiSys', { min: 90, max: 120 });
                    const heightDia = calculateCompactHeight(item.tensiDia, 'tensiDia', { min: 60, max: 80 });

                    return `
                            <div style="display: flex; flex-direction: column; align-items: center; flex: 1;">
                                <div style="display: flex; align-items: end; justify-content: center; height: 50px; gap: 1px;">
                                    <div style="width: ${data.length > 4 ? '6px' : '8px'}; background: #dc2626; height: ${heightSys}px; border-radius: 1px 1px 0 0; position: relative;">
                                        <div style="position: absolute; top: -16px; left: 50%; transform: translateX(-50%); font-size: 8px; font-weight: 500; color: #374151; white-space: nowrap;">
                                            ${item.tensiSys}
                                        </div>
                                    </div>
                                    <div style="width: ${data.length > 4 ? '6px' : '8px'}; background: #3b82f6; height: ${heightDia}px; border-radius: 1px 1px 0 0; position: relative;">
                                        <div style="position: absolute; top: -16px; left: 50%; transform: translateX(-50%); font-size: 8px; font-weight: 500; color: #374151; white-space: nowrap;">
                                            ${item.tensiDia}
                                        </div>
                                    </div>
                                </div>
                                <div style="font-size: 8px; color: #64748b; margin-top: 4px; text-align: center;">
                                    ${item.label}
                                </div>
                            </div>
                        `;
                }).join('')}
                </div>
            </div>
        </div >
                `;
            }

            // Chart compact untuk metric tunggal
            function renderCompactMetricChart(data, field, title, unit, color, normalRange = null) {
                const hasData = data.some(d => d[field] !== null);
                if (!hasData) return '';

                return `
                <div style="background: white; padding: 8px; border-radius: 6px; border: 1px solid #e2e8f0; height: 120px;" >
            <div style="text-align: center; margin-bottom: 8px;">
                <div style="font-weight: 600; color: #374151; font-size: 11px; margin-bottom: 2px;">${title}</div>
                <div style="font-size: 9px; color: #64748b;">${unit}</div>
            </div>
            <div style="height: 70px; position: relative;">
                <div style="display: flex; height: 100%; align-items: end; gap: ${data.length > 4 ? '2px' : '3px'}; padding: 0 4px; justify-content: center;">
                    ${data.map((item, index) => {
                    const value = item[field];
                    if (value === null) return '';

                    const height = calculateCompactHeight(value, field, normalRange);

                    return `
                            <div style="display: flex; flex-direction: column; align-items: center; flex: 1;">
                                <div style="display: flex; align-items: end; justify-content: center; height: 50px; gap: 1px;">
                                    <div style="width: ${data.length > 4 ? '6px' : '8px'}; background: ${color}; height: ${height}px; border-radius: 1px 1px 0 0; position: relative;">
                                        <div style="position: absolute; top: -16px; left: 50%; transform: translateX(-50%); font-size: 8px; font-weight: 500; color: #374151; white-space: nowrap;">
                                            ${value}
                                        </div>
                                    </div>
                                </div>
                                <div style="font-size: 8px; color: #64748b; margin-top: 4px; text-align: center;">
                                    ${item.label}
                                </div>
                            </div>
                        `;
                }).join('')}
                </div>
            </div>
        </div >
                `;
            }

            // Helper function untuk menghitung tinggi bar compact
            function calculateCompactHeight(value, field, normalRange) {
                if (!normalRange) {
                    return Math.min((value / 200) * 50, 50);
                }

                const range = normalRange.max - normalRange.min;
                const buffer = range * 0.3;
                const minDisplay = Math.max(0, normalRange.min - buffer);
                const maxDisplay = normalRange.max + buffer;
                const displayRange = maxDisplay - minDisplay;

                const safeValue = Math.max(minDisplay, Math.min(maxDisplay, value));
                const normalized = (safeValue - minDisplay) / displayRange;

                return 10 + (normalized * 40); // Minimum 10px, maximum 50px
            }



            // === 3. RENDER DIAGNOSA ===
            function renderDiagnosa() {
                const diagRows = (diag.data?.rows || diag.data || diag || []);
                if (hasData(diagRows)) {
                    cardsToShow.push(cardWrap('diag', 'Diagnosa (ICD-10)',
                        renderTable(diagRows, [
                            { key: 'kd_penyakit', title: 'Kode' }, { key: 'nm_penyakit', title: 'Nama' },
                            { key: 'status', title: 'Status' }, { key: 'prioritas', title: 'Prioritas' }
                        ])
                    ));
                }
            }

            // === 4. RENDER PROSEDUR ===
            function renderProsedur() {
                const procRows = (proc.data?.rows || proc.data || proc || []);
                if (hasData(procRows)) {
                    cardsToShow.push(cardWrap('proc', 'Prosedur (ICD-9)',
                        renderTable(procRows, [
                            { key: 'kode', title: 'Kode' }, { key: 'nama', title: 'Prosedur' }, { key: 'prioritas', title: 'Prioritas' }
                        ])
                    ));
                }
            }

            // === 5. RENDER TINDAKAN ===
            // === 5. RENDER TINDAKAN ===
            function renderTindakan() {
                const tindRows = (tind.data?.rows || tind.data || tind || []);
                if (hasData(tindRows)) {
                    let total = 0;
                    const rowsWithCost = tindRows.map(r => {
                        const cost = Number(r.biaya_rawat) || 0;
                        total += cost;
                        return { ...r, formattedCost: 'Rp ' + cost.toLocaleString('id-ID') };
                    });

                    const tbl = renderTable(rowsWithCost, [
                        { key: 'tgl_perawatan', title: 'Tanggal' },
                        { key: 'jam_rawat', title: 'Jam' },
                        { key: 'nm_perawatan', title: 'Tindakan' },
                        { key: 'operator', title: 'Oleh' },
                        { key: 'formattedCost', title: 'Biaya' }
                    ]);

                    const grandTotal = `<div style="text-align:right;font-weight:bold;margin-top:0;padding:12px;background:#f8fafc;border-top:1px solid #e2e8f0;color:#0f172a;border-bottom-left-radius:8px;border-bottom-right-radius:8px" > Total Tindakan: Rp ${total.toLocaleString('id-ID')}</div > `;

                    cardsToShow.push(cardWrap('tind', 'Tindakan', tbl + grandTotal));
                }
            }

            // === 6. RENDER RESEP ===
            // === 6. RENDER RESEP ===
            function renderResep() {
                const resepRows = (resep.data?.rows || resep.data || resep || []);
                if (hasData(resepRows)) {
                    // Group by No Resep
                    const prescriptions = {};
                    resepRows.forEach(row => {
                        const k = row.no_resep || 'UNKNOWN';
                        if (!prescriptions[k]) {
                            prescriptions[k] = {
                                no_resep: k,
                                tgl: row.tgl_perawatan,
                                jam: row.jam || '',
                                dokter: row.nm_dokter || '-',
                                items: []
                            };
                        }
                        prescriptions[k].items.push(row);
                    });

                    // Sort groups by time (descending)
                    const sortedKeys = Object.keys(prescriptions).sort((a, b) => {
                        const timeA = (prescriptions[a].tgl || '') + (prescriptions[a].jam || '');
                        const timeB = (prescriptions[b].tgl || '') + (prescriptions[b].jam || '');
                        // If dates missing, rely on key order logic or just standard sort
                        return timeB.localeCompare(timeA);
                    });

                    let html = '';

                    sortedKeys.forEach(key => {
                        const p = prescriptions[key];
                        let total = 0;
                        const dateFmt = p.tgl ? new Date(p.tgl).toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' }) : '-';

                        html += `<div class="resep-card" style="margin-bottom:16px; border:1px solid #e2e8f0; border-radius:8px; overflow:hidden;" >
                             <div style="background:#f0fdf4; padding:12px; border-bottom:1px solid #dcfce7;">
                                <div style="display:flex; justify-content:space-between; align-items:start;">
                                   <div>
                                       <div style="font-weight:700; color:#166534; font-size:14px; margin-bottom:2px;">
                                            <i class="fa fa-medkit"></i> &nbsp; Resep Obat
                                       </div>
                                       <div style="font-size:12px; color:#15803d;">
                                          <span><i class="fa fa-calendar"></i> ${dateFmt}</span>
                                          <span style="margin:0 6px">&bull;</span>
                                          <span><i class="fa fa-clock-o"></i> ${escHtml(p.jam)}</span>
                                       </div>
                                   </div>
                                   <div style="text-align:right; font-size:12px;">
                                       <div style="color:#15803d; font-size:11px;">Dokter Peresep</div>
                                       <div style="font-weight:600; color:#14532d;">${escHtml(p.dokter)}</div>
                                       <div style="font-family:monospace; margin-top:2px; color:#16a34a">${escHtml(p.no_resep)}</div>
                                   </div>
                                </div>
                             </div>
                             <div class="table-responsive">
                               <table class="table table-striped mb-0">
                                 <thead style="background:#fff; color:#475569; font-size:12px; border-bottom:2px solid #f1f5f9;">
                                   <tr>
                                      <th style="padding:10px 12px; font-weight:600;">Nama Obat</th>
                                      <th style="padding:10px 12px; font-weight:600; text-align:center;">Jml</th>
                                      <th style="padding:10px 12px; font-weight:600; text-align:right;">Biaya</th>
                                   </tr>
                                 </thead>
                                 <tbody style="font-size:13px;">`;

                        p.items.forEach(r => {
                            const sub = Number(r.total_biaya) || 0;
                            total += sub;
                            html += `<tr>
                                <td style="padding:10px 12px;">
                                    <div style="font-weight:500; color:#1e293b;">${escHtml(r.nama_obat)}</div>
                                    <div style="font-size:11px; color:#64748b; margin-top:2px;">${escHtml(r.aturan_pakai)}</div>
                                </td>
                                <td style="padding:10px 12px; text-align:center;">${escHtml(r.jml)}</td>
                                <td style="padding:10px 12px; text-align:right; font-family:monospace;">Rp ${sub.toLocaleString('id-ID')}</td>
                            </tr>`;
                        });

                        html += `</tbody></table></div>`;

                        html += `<div style="background:#f0fdf4; padding:8px 12px; text-align:right; border-top:1px solid #dcfce7; font-weight:700; color:#14532d; font-size:13px;" >
                Total Resep: Rp ${total.toLocaleString('id-ID')}
                                </div > `;
                        html += `</div > `;
                    });

                    cardsToShow.push(cardWrap('resep', 'Resep Obat', html));
                }
            }

            // === 7. RENDER LABORATORIUM ===
            function renderLaboratorium() {
                const orders = lab.data?.orders || lab.orders || [];
                const labRows = lab.data?.rows || lab.data || [];

                if ((Array.isArray(orders) && orders.length) || (Array.isArray(labRows) && labRows.length)) {
                    let labHtml = '';

                    // CASE 1: Data grouped by Order (usually if using new API structure)
                    if (Array.isArray(orders) && orders.length) {
                        labHtml += orders.map(o => {
                            // Group items by Panel/Category inside the order
                            const groupedItems = {};
                            (o.pemeriksaan || []).forEach(it => {
                                const cat = it.panel || it.nm_perawatan || 'Pemeriksaan';
                                if (!groupedItems[cat]) groupedItems[cat] = [];
                                groupedItems[cat].push(it);
                            });

                            let tBodyHtml = '';
                            for (const [cat, items] of Object.entries(groupedItems)) {
                                if (cat !== 'Pemeriksaan') {
                                    tBodyHtml += `<tr style="background:#f8f9fa;" > <td colspan="4" style="font-weight:600; color:#495057;">${escHtml(cat)}</td></tr > `;
                                }
                                items.forEach(it => {
                                    tBodyHtml += `
                <tr >
                                        <td style="${cat !== 'Pemeriksaan' ? 'padding-left:20px' : ''}">${escHtml(it.nama || it.pemeriksaan || '-')}</td>
                                        <td>${escHtml(it.hasil || '-')}</td>
                                        <td>${escHtml(it.satuan || '-')}</td>
                                        <td>${escHtml(it.rujukan || '-')}</td>
                                    </tr > `;
                                });
                            }

                            return `
                <div class="panel panel-default" style="margin-bottom:10px; border-color:#e9ecef;" >
                                    <div class="panel-heading" style="background:#fff; border-bottom:1px solid #e9ecef;">
                                        <b>Order:</b> ${escHtml(o.noorder || '-')} 
                                        ${o.tanggal ? (' | <span class="text-muted">' + escHtml(o.tanggal) + '</span>') : ''}
                                    </div>
                                    <div class="panel-body" style="padding:0">
                                        <div class="table-responsive">
                                            <table class="table table-striped mb-0">
                                                <thead style="background:#f1f5f9; color:#475569;">
                                                    <tr>
                                                        <th>Pemeriksaan</th>
                                                        <th>Hasil</th>
                                                        <th>Satuan</th>
                                                        <th>Rujukan</th>
                                                    </tr>
                                                </thead>
                                                <tbody>${tBodyHtml}</tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div > `;
                        }).join('');

                        // CASE 2: Flat List Data (Standard from Model)
                    } else {
                        // Group by REQUEST (Date + Time)
                        const requests = {};
                        labRows.forEach(row => {
                            const k = (row.tgl_periksa || '') + '_' + (row.jam || '');
                            if (!requests[k]) {
                                requests[k] = {
                                    tgl: row.tgl_periksa,
                                    jam: row.jam || '',
                                    no_rawat: row.no_rawat || '',
                                    dokter: row.nm_dokter || row.dokter_perujuk || '-',
                                    items: []
                                };
                            }
                            requests[k].items.push(row);
                        });

                        // Render each Request
                        let hasRequests = false;
                        const sortedKeys = Object.keys(requests).sort().reverse(); // Newest first

                        for (const key of sortedKeys) {
                            hasRequests = true;
                            const req = requests[key];

                            // Group items by Panel
                            const grouped = {};
                            const costs = new Map();
                            req.items.forEach(it => {
                                const cat = it.panel || it.nm_perawatan || 'Pemeriksaan';
                                if (!grouped[cat]) grouped[cat] = [];
                                grouped[cat].push(it);
                                // Cost per panel
                                costs.set(cat, Number(it.biaya) || 0);
                            });

                            let totalReqCost = 0;
                            costs.forEach(c => totalReqCost += c);

                            // Format Date Time
                            const dateFmt = req.tgl ? new Date(req.tgl).toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' }) : '-';

                            labHtml += `<div class="lab-request" style="margin-bottom:16px; border:1px solid #e2e8f0; border-radius:8px; overflow:hidden;" >
                             <div style="background:#f8fafc; padding:12px; border-bottom:1px solid #e2e8f0;">
                                <div style="display:flex; justify-content:space-between; align-items:start;">
                                   <div>
                                       <div style="font-weight:700; color:#334155; font-size:14px; margin-bottom:2px;">
                                            <i class="fa fa-flask" style="color:#3b82f6"></i> &nbsp; Laboratorium
                                       </div>
                                       <div style="font-size:12px; color:#64748b;">
                                          <span><i class="fa fa-calendar"></i> ${dateFmt}</span>
                                          <span style="margin:0 6px">&bull;</span>
                                          <span><i class="fa fa-clock-o"></i> ${escHtml(req.jam)}</span>
                                       </div>
                                   </div>
                                   <div style="text-align:right; font-size:12px;">
                                       <div style="color:#64748b; font-size:11px;">Dokter Pengirim</div>
                                       <div style="font-weight:600; color:#475569;">${escHtml(req.dokter)}</div>
                                       <div style="color:#94a3b8; font-family:monospace; margin-top:2px;">${escHtml(req.no_rawat)}</div>
                                   </div>
                                </div>
                             </div>
                             <div class="table-responsive">
                               <table class="table table-striped mb-0">
                                 <thead style="background:#fff; color:#64748b; font-size:12px; border-bottom:2px solid #f1f5f9;">
                                   <tr>
                                      <th style="padding:10px 12px; font-weight:600; border:none;">Pemeriksaan</th>
                                      <th style="padding:10px 12px; font-weight:600; border:none;">Hasil</th>
                                      <th style="padding:10px 12px; font-weight:600; border:none;">Satuan</th>
                                      <th style="padding:10px 12px; font-weight:600; border:none;">Rujukan</th>
                                   </tr>
                                 </thead>
                                 <tbody style="font-size:13px;">`;

                            // Render Panels
                            for (const [cat, items] of Object.entries(grouped)) {
                                const panelCost = costs.get(cat);
                                labHtml += `<tr style="background:#f1f9ff;">
                                    <td colspan="4" style="font-weight:700; color:#0369a1; padding:8px 12px; border-top:1px solid #e2e8f0;">
                                        <div style="display:flex; justify-content:space-between;">
                                            <span>${escHtml(cat)}</span>
                                            ${panelCost > 0 ? `<span style="font-weight:600;">Rp ${panelCost.toLocaleString('id-ID')}</span>` : ''}
                                        </div>
                                    </td>
                               </tr>`;

                                items.forEach(it => {
                                    let color = '#334155';
                                    let weight = '400';
                                    // Simple highlight if H/L usually in 'keterangan' or checked against 'rujukan', 
                                    // but logic for parsing rujukan is complex. Using generic style.

                                    labHtml += `<tr>
                                       <td style="padding:8px 12px 8px 24px; color:#475569;">${escHtml(it.pemeriksaan || it.nama || '-')}</td>
                                       <td style="padding:8px 12px; font-weight:600; color:${color};">${escHtml(it.hasil || '-')}</td>
                                       <td style="padding:8px 12px; color:#64748b;">${escHtml(it.satuan || '-')}</td>
                                       <td style="padding:8px 12px; color:#94a3b8; font-size:12px;">${escHtml(it.rujukan || '-')}</td>
                                   </tr>`;
                                });
                            }

                            labHtml += `</tbody></table></div>`;
                            if (totalReqCost > 0) {
                                labHtml += `<div style="background:#f8fafc; padding:8px 12px; text-align:right; border-top:1px solid #e2e8f0; font-weight:700; color:#334155; font-size:13px;" >
                Total Biaya: Rp ${totalReqCost.toLocaleString('id-ID')}
                                </div > `;
                            }
                            labHtml += `</div > `;
                        }
                    }
                    cardsToShow.push(cardWrap('lab', 'Laboratorium', labHtml));
                }
            }

            // === 8. RENDER RADIOLOGI ===
            function renderRadiologi() {
                const radRows = (rad.data?.rows || rad.data || rad || []);
                const radFilesRaw = rdocs?.data ?? rdocs ?? [];
                const radFiles = Array.isArray(radFilesRaw) ? radFilesRaw : (radFilesRaw.files || []);

                if (hasData(radRows) || hasData(radFiles)) {
                    let radTbl = '';
                    let totalRad = 0;

                    if (hasData(radRows)) {
                        radTbl = `<div class="table-responsive" > <table class="table table-striped mb-0">
                <thead style="background:#f1f5f9;color:#475569"><tr>
                    <th style="padding:10px">Waktu</th>
                    <th style="padding:10px">Tindakan</th>
                    <th style="padding:10px">Hasil</th>
                    <th style="padding:10px">Dokter</th>
                    <th style="padding:10px;text-align:right">Biaya</th>
                </tr></thead><tbody>`;

                        radTbl += radRows.map(r => {
                            const biaya = Number(r.biaya) || 0;
                            totalRad += biaya;
                            return `<tr>
                        <td style="padding:10px">${escHtml(r.tgl_periksa)} ${escHtml(r.jam)}</td>
                        <td style="padding:10px;font-weight:500">${escHtml(r.nm_perawatan)}</td>
                        <td style="padding:10px">${escHtml(r.hasil)}</td>
                        <td style="padding:10px;font-size:12px;color:#666">${escHtml(r.dokter)}</td>
                        <td style="padding:10px;text-align:right;font-family:monospace">Rp ${biaya.toLocaleString('id-ID')}</td>
                    </tr>`;
                        }).join('') + `</tbody></table></div>`;

                        radTbl += `<div style="text-align:right;font-weight:bold;margin-top:0;padding:12px;background:#fff7ed;color:#9a3412;border-top:1px solid #ffedd5">Total Radiologi: Rp ${totalRad.toLocaleString('id-ID')}</div>`;
                    } else {
                        radTbl = '<span class="text-muted">Tidak ada tindakan radiologi.</span>';
                    }

                    let radFileHtml = '<span class="text-muted">Tidak ada file radiologi.</span>';

                    if (Array.isArray(radFiles) && radFiles.length) {
                        const imgs = radFiles.filter(f => String(f.is_image) === '1' || f.is_image === 1);
                        const others = radFiles.filter(f => !(String(f.is_image) === '1' || f.is_image === 1));
                        const imgGrid = imgs.length ? (
                            '<div class="rp-grid">' + imgs.map(f => {
                                const cap = escHtml(f.label || f.nama || `${f.tgl || ''} `.trim());
                                if (String(f.exists) === '1' || f.exists === 1) {
                                    return `<div class="rp-thumb"><a href="${escHtml(f.url)}" target="_blank" rel="noopener"><img src="${escHtml(f.url)}" alt="RAD"><div class="cap">${cap}</div></a></div>`;
                                }
                                return `<div class="rp-thumb"><div class="cap text-danger">File tidak ditemukan</div></div>`;
                            }).join('') + '</div>'
                        ) : '';

                        const otherList = others.length ? (
                            '<ul style="margin:6px 0 0 18px">' + others.map(f => {
                                const lbl = f.label || f.nama || 'Berkas';
                                if (String(f.exists) === '1' || f.exists === 1) {
                                    return `<li><a href="${escHtml(f.url || '#')}" target="_blank" rel="noopener">${escHtml(lbl)}</a></li>`;
                                }
                                return `<li class="text-danger">${escHtml(lbl)} (file tidak ada)</li>`;
                            }).join('') + '</ul>'
                        ) : '';

                        radFileHtml = (imgGrid || otherList) ? (imgGrid + (otherList ? `<div style="margin-top:6px"><b>File lainnya</b>${otherList}</div>` : '')) : radFileHtml;
                    }

                    cardsToShow.push(cardWrap('rad', 'Radiologi', `${radTbl} <div style="margin-top:8px"><b>Berkas Hasil</b><br>${radFileHtml}</div>`));
                }
            }

            // === 9. RENDER BERKAS DIGITAL ===
            function renderBerkasDigital() {
                const rawFiles = (berkas.data?.files || berkas.files || berkas.data || berkas || []);
                const files = Array.isArray(rawFiles) ? rawFiles : [];
                if (files.length) {
                    const imgs = [], others = [];
                    files.forEach(f => {
                        const ext = (f.ext || (f.url || '').split('.').pop() || '').toLowerCase();
                        const isImg = isImageExt(ext || f.url);
                        const exists = String(f.exists) === '1' || f.exists === 1;
                        const label = f.label || f.nama || f.tipe || 'Berkas';
                        const item = { label, url: f.url || '#', exists, tgl: f.tgl || '', ext, isImg };
                        (isImg ? imgs : others).push(item);
                    });

                    const imgGrid = imgs.length ? (
                        '<div class="bk-grid">' + imgs.map(f => {
                            if (!f.exists) return `<div class="bk-thumb"><div class="cap text-danger">${escHtml(f.label)} (file tidak ada)</div></div>`;
                            return `<div class="bk-thumb">
    <a href="${escHtml(f.url)}" target="_blank" rel="noopener">
        <img loading="lazy" src="${escHtml(f.url)}" alt="Berkas">
            <div class="cap">${escHtml(f.label)}${f.tgl ? ` <small class="text-muted">${escHtml(f.tgl)}</small>` : ''}</div>
    </a>
                                    </div>`;
                        }).join('') + '</div>'
                    ) : '';

                    const otherList = others.length ? (
                        '<ul style="margin:6px 0 0 18px">' + others.map(f => {
                            if (!f.exists) return `<li class="text-danger">${escHtml(f.label)} (file tidak ada)</li>`;
                            return `<li><a href="${escHtml(f.url)}" target="_blank" rel="noopener">${escHtml(f.label)}</a>${f.tgl ? ` <small class="text-muted">${escHtml(f.tgl)}</small>` : ''}</li>`;
                        }).join('') + '</ul>'
                    ) : '';

                    const html = (imgGrid || otherList)
                        ? (imgGrid + (otherList ? `<div style="margin-top:6px"><b>File lainnya</b>${otherList}</div>` : ''))
                        : '<span class="text-muted">Tidak ada berkas.</span>';

                    cardsToShow.push(cardWrap('berkas', 'Berkas Digital', html));
                }
            }

            // === 10. RENDER OPERASI === 
            function renderOperasi() {
                const operasiRows = operasi.data?.rows || operasi.data || operasi || [];
                if (hasData(operasiRows)) {
                    const operasiHtml = operasiRows.map(op => {
                        const tgl = op.tgl_operasi ? new Date(op.tgl_operasi).toLocaleDateString('id-ID') : '-';
                        const jam = op.tgl_operasi ? new Date(op.tgl_operasi).toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' }) : '-';
                        const biaya = op.total_biaya ? 'Rp ' + Number(op.total_biaya).toLocaleString('id-ID') : '-';

                        // Status Badge
                        let statusColor = '#6b7280';
                        if (op.status?.toLowerCase() === 'selesai') statusColor = '#10b981';
                        else if (op.status?.toLowerCase() === 'proses') statusColor = '#f59e0b';
                        const statusBadge = `<span style="padding:4px 8px;background:${statusColor}15;color:${statusColor};border-radius:4px;font-size:12px;font-weight:600;display:inline-block">${escHtml(op.status || '-')}</span>`;

                        // Helper Render Tim
                        const renderTim = (label, nama) => {
                            if (!nama || nama === '-' || nama === '') return '';
                            return `<div style="margin-bottom:4px"><span style="color:#666;font-size:11px">${label}:</span> <span style="font-weight:500;color:#333">${escHtml(nama)}</span></div>`;
                        };

                        // Helper Laporan
                        const laporan = op.laporan_operasi ?
                            `<div style="margin-top:12px;padding:12px;background:#f9fafb;border:1px dashed #cbd5e1;border-radius:6px">
                                <div style="font-size:11px;font-weight:700;color:#475569;margin-bottom:6px;letter-spacing:0.5px">LAPORAN OPERASI</div>
                                <div style="font-size:13px;color:#334155;white-space:pre-wrap;line-height:1.6;max-height:300px;overflow-y:auto;font-family:inherit">${escHtml(op.laporan_operasi)}</div>
                            </div>` : '';

                        // Extra Infos
                        const extras = [];
                        if (op.jaringan_dieksekusi) extras.push({ k: 'Jaringan', v: op.jaringan_dieksekusi });
                        if (op.permintaan_pa) extras.push({ k: 'Permintaan PA', v: op.permintaan_pa });
                        if (op.nomor_implan) extras.push({ k: 'No. Implan', v: op.nomor_implan });

                        const extraHtml = extras.length ?
                            `<div style="display:flex;flex-wrap:wrap;gap:12px;margin-top:12px;padding-top:12px;border-top:1px solid #f1f5f9">
    ${extras.map(e => `
                                    <div style="background:#f0f9ff;padding:4px 10px;border-radius:6px;border:1px solid #bae6fd;font-size:12px;display:flex;align-items:center;gap:6px">
                                        <span style="color:#0284c7;font-weight:600">${e.k}:</span> <span style="color:#0f172a">${escHtml(e.v)}</span>
                                    </div>
                                `).join('')
                            }
                            </div>` : '';

                        return `
    <div class="operasi-item" style="margin-bottom:16px;padding:20px;border:1px solid #e2e8f0;border-radius:12px;background:#fff;box-shadow:0 2px 4px rgba(0,0,0,0.02)">
                            <!--HEADER-->
                            <div style="display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:16px;border-bottom:1px solid #f1f5f9;padding-bottom:12px">
                                <div>
                                    <div style="font-size:18px;font-weight:700;color:#1e293b;margin-bottom:6px;line-height:1.3">${escHtml(op.nm_paket_operasi || 'Operasi')}</div>
                                    <div style="font-size:13px;color:#64748b;display:flex;align-items:center;gap:8px">
                                        <i class="fa fa-clock-o"></i> ${tgl} ${jam} 
                                        ${op.kategori ? `<span style="background:#f1f5f9;padding:2px 8px;border-radius:4px;font-size:11px">${escHtml(op.kategori)}</span>` : ''}
                                        ${statusBadge}
                                    </div>
                                </div>
                                <div style="text-align:right">
                                    <div style="font-weight:700;color:#059669;font-size:16px">${biaya}</div>
                                    <small style="color:#94a3b8;font-size:11px">Total Biaya</small>
                                </div>
                            </div>

                            <!--CONTENT GRID-->
    <div style="display:flex;flex-wrap:wrap;gap:20px">
        <!-- KOLOM KIRI: TIM & DIAGNOSA -->
        <div style="flex:1;min-width:300px">
            <div style="background:#fff1f2;padding:12px;border-radius:8px;border:1px solid #fecdd3;margin-bottom:12px">
                <div style="font-size:11px;font-weight:700;color:#be123c;margin-bottom:8px;text-transform:uppercase;letter-spacing:0.5px">
                    <i class="fa fa-user-md"></i> Tim Operasi
                </div>
                <div>
                    ${renderTim('Operator 1', op.nm_operator1)}
                    ${renderTim('Operator 2', op.nm_operator2)}
                    ${renderTim('Operator 3', op.nm_operator3)}
                    ${renderTim('Anestesi', op.nm_dokter_anestesi)}
                </div>
            </div>

            <div style="margin-bottom:12px">
                <div style="font-size:11px;font-weight:700;color:#b45309;margin-bottom:4px">DIAGNOSA PRE-OP</div>
                <div style="font-size:13px;color:#451a03;background:#fffbeb;padding:8px;border-radius:6px;border:1px solid #fde68a;line-height:1.4">
                    ${escHtml(op.diagnosa_preop || '-')}
                </div>
            </div>

            <div>
                <div style="font-size:11px;font-weight:700;color:#047857;margin-bottom:4px">DIAGNOSA POST-OP</div>
                <div style="font-size:13px;color:#064e3b;background:#ecfdf5;padding:8px;border-radius:6px;border:1px solid #a7f3d0;line-height:1.4">
                    ${escHtml(op.diagnosa_postop || '-')}
                </div>
            </div>
        </div>

        <!-- KOLOM KANAN: LAPORAN -->
        <div style="flex:1;min-width:300px">
            ${laporan || '<div class="text-muted text-center" style="padding:20px;font-style:italic">Belum ada laporan operasi.</div>'}
        </div>
    </div>

                            ${extraHtml}

                        </div>`;
                    }).join('');

                    cardsToShow.push(cardWrap('operasi', `Riwayat Operasi(${operasiRows.length})`, operasiHtml));
                }
            }


            // === 10.5 RENDER PENUNJANG (DOKTER) ===
            function renderPenunjang() {
                const rows = penunjang.data?.rows || penunjang.data || penunjang || [];
                if (hasData(rows)) {
                    const html = rows.map(p => {
                        const tgl = p.tgl_periksa ? new Date(p.tgl_periksa).toLocaleDateString('id-ID') : '-';
                        const jam = p.jam_periksa || '-';
                        return `
    <div style="background:#fff;border:1px solid #e2e8f0;border-radius:8px;padding:16px;margin-bottom:12px;box-shadow:0 1px 2px rgba(0,0,0,0.05)">
                            <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:10px;border-bottom:1px solid #f1f5f9;padding-bottom:8px">
                                <div style="font-weight:600;color:#1e293b;font-size:14px">
                                    <i class="fa fa-user-md text-success"></i> ${escHtml(p.nm_dokter || 'Dokter')}
                                </div>
                                <div style="font-size:12px;color:#64748b">
                                    <i class="fa fa-clock-o"></i> ${tgl} ${jam}
                                </div>
                            </div>
                            <div style="font-size:13px;color:#334155;line-height:1.6;white-space:pre-wrap;background:#f8fafc;padding:12px;border-radius:6px;border:1px dashed #cbd5e1">${escHtml(p.hasil_pemeriksaan)}</div>
                        </div>`;
                    }).join('');
                    cardsToShow.push(cardWrap('penunjang', 'Penunjang Medis (Dokter)', html));
                }
            }

            // === 10.6 RENDER LAPORAN TINDAKAN (DOKTER) ===
            function renderLaporanTindakan() {
                const data = laptind.data || laptind || {};
                if (hasAny(data) && data.nama_tindakan) {
                    const row = (label, val) => `
    <div style="margin-bottom:8px">
                            <div style="font-size:11px;color:#64748b;text-transform:uppercase;letter-spacing:0.5px">${label}</div>
                            <div style="font-weight:500;color:#334155;font-size:13px">${escHtml(val || '-')}</div>
                        </div>`;

                    const tgl = data.tgl_input ? new Date(data.tgl_input).toLocaleDateString('id-ID') : '-';
                    const jam = `${data.jam_mulai || '-'} s / d ${data.jam_selesai || '-'} `;

                    const html = `
    <div style="padding:16px;background:#fff;border:1px solid #e2e8f0;border-radius:8px">
                        <div style="display:flex;justify-content:space-between;align-items:start;margin-bottom:16px;border-bottom:1px solid #f1f5f9;padding-bottom:12px">
                            <div>
                                <div style="font-size:16px;font-weight:700;color:#0f172a">${escHtml(data.nama_tindakan)}</div>
                                <div style="font-size:12px;color:#64748b;margin-top:2px"><i class="fa fa-clock-o"></i> ${tgl} &bull; ${jam}</div>
                            </div>
                            <div style="background:#f0f9ff;color:#0369a1;padding:4px 8px;border-radius:4px;font-size:11px;font-weight:600;border:1px solid #bae6fd">
                                ${escHtml(data.nm_dokter || data.kd_dokter)}
                            </div>
                        </div>

                        <div style="display:flex;flex-wrap:wrap;gap:20px;margin-bottom:16px">
                            <div style="flex:1;min-width:140px">
                                ${row('Diagnosa', data.diagnosa)}
                                ${row('Jenis Anestesi', data.jenis_anastesi)}
                            </div>
                            <div style="flex:1;min-width:140px">
                                ${row('Ruangan', data.ruangan)}
                            </div>
                        </div>

                        <div style="background:#fdf2f8;padding:12px;border-radius:6px;border:1px solid #fbcfe8">
                            <div style="font-size:11px;font-weight:700;color:#db2777;margin-bottom:6px;text-transform:uppercase">Prosedur / Laporan</div>
                            <div style="font-size:13px;color:#374151;white-space:pre-wrap;line-height:1.6">${escHtml(data.prosedur_tindakan)}</div>
                        </div>
                    </div>`;

                    cardsToShow.push(cardWrap('laptind', 'Laporan Tindakan Dokter', html));
                }
            }

            // === 11. RENDER RESUME ===
            function renderResume() {
                if (resume && (Object.keys(resume).length > 0)) {
                    // Helper simple check
                    const val = (k) => escHtml(resume[k] || resume[k] === 0 ? resume[k] : '-');
                    const has = (k) => resume[k] && resume[k] !== '-' && resume[k] !== '';
                    const ttv = resume.ttv || {};
                    const valTtv = (k, suffix = '') => ttv[k] ? (escHtml(ttv[k]) + suffix) : '-';

                    // Check if there's any meaningful data
                    const hasAnyData = has('keluhan_utama') || has('jalannya_penyakit') ||
                        has('diagnosa_utama') || has('diagnosa_sekunder') ||
                        has('prosedur_utama') || has('prosedur_sekunder') ||
                        has('kondisi_pulang') || has('obat_pulang') || has('instruksi_pulang') ||
                        (ttv.tensi || ttv.nadi || ttv.suhu_tubuh || ttv.respirasi || ttv.spo2 || ttv.berat || ttv.gcs);

                    // Only render if there's actual data
                    if (!hasAnyData) {
                        return;
                    }

                    // === TTV ITEM RENDERER ===
                    const renderTtvInfo = (label, value, icon, color = '#64748b') => `
    <div style="flex:1;min-width:80px;text-align:center;padding:12px 8px;background:#fff;border:1px solid #e2e8f0;border-radius:8px;box-shadow:0 1px 2px rgba(0,0,0,0.02)">
                            <div style="color:${color};font-size:16px;margin-bottom:6px"><i class="fa ${icon}"></i></div>
                            <div style="font-size:10px;color:#64748b;font-weight:700;text-transform:uppercase;margin-bottom:2px">${label}</div>
                            <div style="font-size:13px;font-weight:700;color:#0f172a">${value}</div>
                        </div>`;

                    const html = `
    <div style="padding:24px;background:#fff;border:1px solid #e2e8f0;border-radius:16px;box-shadow:0 4px 6px -1px rgba(0,0,0,0.05)">
                        <!--HEADER / TTV-->
                        <div style="margin-bottom:24px;background:#f8fafc;padding:16px;border-radius:12px;border:1px solid #f1f5f9">
                            <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:12px">
                                <div style="font-size:12px;font-weight:800;color:#334155;text-transform:uppercase;letter-spacing:0.5px;display:flex;align-items:center;gap:8px">
                                    <i class="fa fa-heartbeat" style="color:#ef4444;font-size:14px"></i> Tanda Tanda Vital (Terakhir)
                                </div>
                                ${resume.updated_at ? `<div style="font-size:11px;color:#94a3b8"><i class="fa fa-clock-o"></i> Update: ${val('updated_at')}</div>` : ''}
                            </div>
                            <div style="display:flex;flex-wrap:wrap;gap:12px">
                                ${renderTtvInfo('Tensi', valTtv('tensi', ' mmHg'), 'fa-tachometer', '#ef4444')}
                                ${renderTtvInfo('Nadi', valTtv('nadi', ' x/mnt'), 'fa-heartbeat', '#ec4899')}
                                ${renderTtvInfo('Suhu', valTtv('suhu_tubuh', ' °C'), 'fa-thermometer-half', '#f59e0b')}
                                ${renderTtvInfo('RR', valTtv('respirasi', ' x/mnt'), 'fa-leaf', '#10b981')}
                                ${renderTtvInfo('SpO2', valTtv('spo2', ' %'), 'fa-percent', '#3b82f6')}
                                ${renderTtvInfo('Berat', valTtv('berat', ' Kg'), 'fa-balance-scale', '#6366f1')}
                                ${renderTtvInfo('GCS', valTtv('gcs'), 'fa-eye', '#8b5cf6')}
                            </div>
                        </div>

                        <!--KELUHAN & RIWAYAT(ANAMNESIS)-->
                        <div style="margin-bottom:24px;border:1px solid #e2e8f0;border-radius:12px;overflow:hidden">
                            <div style="background:#f1f5f9;padding:12px 16px;font-size:12px;font-weight:700;color:#475569;border-bottom:1px solid #e2e8f0;text-transform:uppercase;letter-spacing:0.5px">Anamnesis</div>
                            <div style="padding:16px;display:flex;flex-wrap:wrap;gap:24px">
                                <div style="flex:1;min-width:300px">
                                    <div style="font-size:11px;color:#64748b;font-weight:700;margin-bottom:6px;text-transform:uppercase">Keluhan Utama</div>
                                    <div style="font-size:14px;color:#1e293b;line-height:1.5">${val('keluhan_utama')}</div>
                                </div>
                                <div style="flex:1;min-width:300px">
                                    <div style="font-size:11px;color:#64748b;font-weight:700;margin-bottom:6px;text-transform:uppercase">Jalannya Penyakit</div>
                                    <div style="font-size:14px;color:#1e293b;line-height:1.5">${val('jalannya_penyakit')}</div>
                                </div>
                            </div>
                        </div>

                        <!--KONDISI & OBAT PULANG-->
                        <div style="display:flex;flex-wrap:wrap;gap:20px;margin-bottom:24px">
                            <div style="flex:1;min-width:250px;background:#ffffff;border:1px solid #cbd5e1;border-radius:12px;padding:16px">
                                <div style="font-size:11px;font-weight:700;color:#475569;margin-bottom:8px;text-transform:uppercase;letter-spacing:0.5px;display:flex;align-items:center;gap:6px">
                                    <i class="fa fa-bed" style="color:#64748b"></i> Kondisi Pulang
                                </div>
                                <div style="font-size:15px;color:#1e293b;font-weight:600">${val('kondisi_pulang')}</div>
                            </div>
                            <div style="flex:2;min-width:300px;background:#f8fafc;border:1px solid #cbd5e1;border-radius:12px;padding:16px">
                                <div style="font-size:11px;font-weight:700;color:#475569;margin-bottom:8px;text-transform:uppercase;letter-spacing:0.5px;display:flex;align-items:center;gap:6px">
                                    <i class="fa fa-medkit" style="color:#64748b"></i> Obat Pulang / Instruksi
                                </div>
                                <div style="font-size:14px;color:#334155;white-space:pre-wrap;line-height:1.6">${val('obat_pulang')}</div>
                            </div>
                        </div>

                        <!--GRID DIAGNOSA & PROSEDUR-->
    <div style="display:flex;flex-wrap:wrap;gap:20px">
        <!-- DIAGNOSA -->
        <div style="flex:1;min-width:300px">
            <div style="margin-bottom:12px;color:#b45309;font-weight:700;border-bottom:2px solid #fcd34d;padding-bottom:6px;display:flex;align-items:center;gap:8px">
                <i class="fa fa-stethoscope"></i> DIAGNOSA
            </div>
            <div style="background:#fffbeb;padding:16px;border-radius:12px;border:1px solid #fde68a;color:#78350f">
                <div style="font-size:11px;font-weight:700;opacity:0.8;margin-bottom:4px;text-transform:uppercase">Diagnosa Utama</div>
                <div style="font-size:15px;font-weight:700;margin-bottom:16px;line-height:1.4">${val('diagnosa_utama')}</div>

                ${(has('diagnosa_sekunder') || has('diagnosa_sekunder2')) ? `
                                    <div style="border-top:1px dashed #f59e0b;padding-top:12px">
                                        <div style="font-size:11px;font-weight:700;opacity:0.8;margin-bottom:8px;text-transform:uppercase">Diagnosa Sekunder</div>
                                        <ul style="margin:0;padding-left:20px;font-size:13px;line-height:1.6">
                                            ${has('diagnosa_sekunder') ? `<li>${val('diagnosa_sekunder')}</li>` : ''}
                                            ${has('diagnosa_sekunder2') ? `<li>${val('diagnosa_sekunder2')}</li>` : ''}
                                            ${has('diagnosa_sekunder3') ? `<li>${val('diagnosa_sekunder3')}</li>` : ''}
                                            ${has('diagnosa_sekunder4') ? `<li>${val('diagnosa_sekunder4')}</li>` : ''}
                                        </ul>
                                    </div>` : ''}
            </div>
        </div>

        <!-- PROSEDUR -->
        <div style="flex:1;min-width:300px">
            <div style="margin-bottom:12px;color:#0369a1;font-weight:700;border-bottom:2px solid #bae6fd;padding-bottom:6px;display:flex;align-items:center;gap:8px">
                <i class="fa fa-cogs"></i> PROSEDUR
            </div>
            <div style="background:#f0f9ff;padding:16px;border-radius:12px;border:1px solid #bae6fd;color:#0c4a6e">
                <div style="font-size:11px;font-weight:700;opacity:0.8;margin-bottom:4px;text-transform:uppercase">Prosedur Utama</div>
                <div style="font-size:15px;font-weight:700;margin-bottom:16px;line-height:1.4">${val('prosedur_utama')}</div>

                ${(has('prosedur_sekunder') || has('prosedur_sekunder2')) ? `
                                    <div style="border-top:1px dashed #0284c7;padding-top:12px">
                                        <div style="font-size:11px;font-weight:700;opacity:0.8;margin-bottom:8px;text-transform:uppercase">Prosedur Sekunder</div>
                                        <ul style="margin:0;padding-left:20px;font-size:13px;line-height:1.6">
                                            ${has('prosedur_sekunder') ? `<li>${val('prosedur_sekunder')}</li>` : ''}
                                            ${has('prosedur_sekunder2') ? `<li>${val('prosedur_sekunder2')}</li>` : ''}
                                            ${has('prosedur_sekunder3') ? `<li>${val('prosedur_sekunder3')}</li>` : ''}
                                        </ul>
                                    </div>` : ''}
            </div>
        </div>
    </div>
                    </div>`;

                    cardsToShow.push(cardWrap('resume', 'Resume Medis', html));
                }
            }

            // === 11.5 RENDER FORMULIR KFR ===
            function renderFormulirKFR() {
                const kfrData = kfr.data || kfr || [];
                const kfrList = Array.isArray(kfrData) ? kfrData : [];

                if (kfrList.length > 0) {
                    let html = '';
                    kfrList.forEach((item, idx) => {
                        const tglFmt = item.tgl_perawatan ? new Date(item.tgl_perawatan).toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' }) : '-';

                        html += `
                        <div style="margin-bottom:${idx < kfrList.length - 1 ? '20px' : '0'}; border:1px solid #e2e8f0; border-radius:8px; overflow:hidden; border-left:4px solid #0891b2">
                            <div style="background:linear-gradient(135deg, #f0fdfa 0%, #ccfbf1 100%); padding:12px; border-bottom:1px solid #e2e8f0">
                                <div style="display:flex; justify-content:space-between; align-items:center">
                                    <div>
                                        <div style="font-size:14px; font-weight:700; color:#0f172a">
                                            <i class="fa fa-calendar"></i> ${tglFmt} <span style="color:#64748b; font-weight:400; font-size:13px">• ${item.jam_rawat || '-'}</span>
                                        </div>
                                        <div style="font-size:12px; color:#0891b2; margin-top:4px">
                                            <i class="fa fa-user-md"></i> ${escHtml(item.nm_dokter || '-')}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div style="padding:16px; background:#fff">
                                <!-- SOAP Section -->
                                <div style="display:grid; grid-template-columns:1fr 1fr; gap:12px; margin-bottom:16px">
                                    <div>
                                        <div style="font-size:11px; font-weight:700; color:#dc2626; text-transform:uppercase; margin-bottom:4px">
                                            <i class="fa fa-user"></i> Subjective (S)
                                        </div>
                                        <div style="font-size:13px; color:#374151; line-height:1.6; padding:8px; background:#fef2f2; border-radius:6px; border:1px solid #fee2e2">
                                            ${escHtml(item.subjective || '-')}
                                        </div>
                                    </div>
                                    <div>
                                        <div style="font-size:11px; font-weight:700; color:#2563eb; text-transform:uppercase; margin-bottom:4px">
                                            <i class="fa fa-stethoscope"></i> Objective (O)
                                        </div>
                                        <div style="font-size:13px; color:#374151; line-height:1.6; padding:8px; background:#eff6ff; border-radius:6px; border:1px solid #dbeafe">
                                            ${escHtml(item.objective || '-')}
                                        </div>
                                    </div>
                                </div>
                                
                                <div style="margin-bottom:16px">
                                    <div style="font-size:11px; font-weight:700; color:#16a34a; text-transform:uppercase; margin-bottom:4px">
                                        <i class="fa fa-notes-medical"></i> Assessment (A)
                                    </div>
                                    <div style="font-size:13px; color:#374151; line-height:1.6; padding:8px; background:#f0fdf4; border-radius:6px; border:1px solid #dcfce7">
                                        ${escHtml(item.assessment || '-')}
                                    </div>
                                </div>
                                
                                <!-- Planning Section -->
                                <div style="background:#fef3c7; padding:12px; border-radius:8px; border:1px solid #fde047">
                                    <div style="font-size:12px; font-weight:700; color:#92400e; margin-bottom:12px; text-transform:uppercase">
                                        <i class="fa fa-list-alt"></i> Planning / Protokol Terapi
                                    </div>
                                    
                                    <div style="display:grid; grid-template-columns:1fr 1fr; gap:12px; margin-bottom:8px">
                                        <div>
                                            <div style="font-size:10px; font-weight:600; color:#78350f; margin-bottom:2px">a. Goal of Treatment</div>
                                            <div style="font-size:12px; color:#451a03; background:#fef9c3; padding:6px; border-radius:4px">
                                                ${escHtml(item.goal_of_treatment || '-')}
                                            </div>
                                        </div>
                                        <div>
                                            <div style="font-size:10px; font-weight:600; color:#78350f; margin-bottom:2px">b. Tindakan / Program Rehab</div>
                                            <div style="font-size:12px; color:#451a03; background:#fef9c3; padding:6px; border-radius:4px">
                                                ${escHtml(item.tindakan_rehab || '-')}
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div style="display:grid; grid-template-columns:1fr 1fr; gap:12px; margin-bottom:8px">
                                        <div>
                                            <div style="font-size:10px; font-weight:600; color:#78350f; margin-bottom:2px">c. Edukasi</div>
                                            <div style="font-size:12px; color:#451a03; background:#fef9c3; padding:6px; border-radius:4px">
                                                ${escHtml(item.edukasi || '-')}
                                            </div>
                                        </div>
                                        <div>
                                            <div style="font-size:10px; font-weight:600; color:#78350f; margin-bottom:2px">d. Frekuensi Kunjungan</div>
                                            <div style="font-size:12px; color:#451a03; background:#fef9c3; padding:6px; border-radius:4px">
                                                ${escHtml(item.frekuensi_kunjungan || '-')}
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div>
                                        <div style="font-size:10px; font-weight:600; color:#78350f; margin-bottom:2px">Rencana Tindak Lanjut</div>
                                        <div style="font-size:12px; color:#451a03; background:#fef9c3; padding:6px; border-radius:4px">
                                            ${escHtml(item.rencana_tindak_lanjut || '-')}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>`;
                    });

                    cardsToShow.push(cardWrap('kfr', 'Formulir Rawat Jalan KFR', html));
                }
            }

            // === 11.6 RENDER PROGRAM REHAB MEDIK ===
            function renderProgramRehabMedik() {
                const rehabData = rehab.data || rehab || [];
                const rehabList = Array.isArray(rehabData) ? rehabData : [];

                if (rehabList.length > 0) {
                    let html = '';
                    rehabList.forEach((item, idx) => {
                        const tglFmt = item.tgl_perawatan ? new Date(item.tgl_perawatan).toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' }) : '-';

                        html += `
                        <div style="margin-bottom:${idx < rehabList.length - 1 ? '20px' : '0'}; border:1px solid #e2e8f0; border-radius:8px; overflow:hidden; border-left:4px solid #8b5cf6">
                            <div style="background:linear-gradient(135deg, #faf5ff 0%, #f3e8ff 100%); padding:12px; border-bottom:1px solid #e2e8f0">
                                <div style="display:flex; justify-content:space-between; align-items:center">
                                    <div>
                                        <div style="font-size:14px; font-weight:700; color:#0f172a">
                                            <i class="fa fa-calendar"></i> ${tglFmt} <span style="color:#64748b; font-weight:400; font-size:13px">• ${item.jam_rawat || '-'}</span>
                                        </div>
                                        <div style="font-size:12px; color:#8b5cf6; margin-top:4px">
                                            <i class="fa fa-user-md"></i> ${escHtml(item.nm_dokter || '-')} 
                                            <span style="margin-left:12px"><i class="fa fa-users"></i> Tim: ${escHtml(item.nm_petugas || '-')}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div style="padding:16px; background:#fff">
                                <!-- SOAP Section -->
                                <div style="display:grid; grid-template-columns:1fr 1fr; gap:12px; margin-bottom:16px">
                                    <div>
                                        <div style="font-size:11px; font-weight:700; color:#dc2626; text-transform:uppercase; margin-bottom:4px">
                                            <i class="fa fa-user"></i> Subjective (S)
                                        </div>
                                        <div style="font-size:13px; color:#374151; line-height:1.6; padding:8px; background:#fef2f2; border-radius:6px; border:1px solid #fee2e2">
                                            ${escHtml(item.subjective || '-')}
                                        </div>
                                    </div>
                                    <div>
                                        <div style="font-size:11px; font-weight:700; color:#2563eb; text-transform:uppercase; margin-bottom:4px">
                                            <i class="fa fa-stethoscope"></i> Objective (O)
                                        </div>
                                        <div style="font-size:13px; color:#374151; line-height:1.6; padding:8px; background:#eff6ff; border-radius:6px; border:1px solid #dbeafe">
                                            ${escHtml(item.objective || '-')}
                                        </div>
                                    </div>
                                </div>
                                
                                <div style="margin-bottom:16px">
                                    <div style="font-size:11px; font-weight:700; color:#16a34a; text-transform:uppercase; margin-bottom:4px">
                                        <i class="fa fa-notes-medical"></i> Assessment (A)
                                    </div>
                                    <div style="font-size:13px; color:#374151; line-height:1.6; padding:8px; background:#f0fdf4; border-radius:6px; border:1px solid #dcfce7">
                                        ${escHtml(item.assessment || '-')}
                                    </div>
                                </div>
                                
                                <!-- Procedure Section -->
                                <div style="background:#f5f3ff; padding:12px; border-radius:8px; border:1px solid #e9d5ff">
                                    <div style="font-size:12px; font-weight:700; color:#7c3aed; margin-bottom:8px; text-transform:uppercase">
                                        <i class="fa fa-clipboard-list"></i> Procedure / Program Terapi (P)
                                    </div>
                                    <div style="font-size:13px; color:#374151; line-height:1.6; white-space:pre-wrap">
                                        ${escHtml(item.procedure_text || '-')}
                                    </div>
                                </div>
                            </div>
                        </div>`;
                    });

                    cardsToShow.push(cardWrap('rehab', 'Program Terapi Rehab Medik', html));
                }
            }

            // ================== EXECUTE ALL RENDER FUNCTIONS ==================
            renderAsesmenPD();
            renderAsesmenOrtho();
            renderIGD();
            renderTandaVital();
            renderDiagnosa();
            renderProsedur();
            renderSOAP();
            renderTindakan();
            renderResep();
            renderLaboratorium();
            renderRadiologi();
            renderBerkasDigital();
            renderOperasi();
            renderPenunjang();
            renderLaporanTindakan();
            renderFormulirKFR();
            renderProgramRehabMedik();
            renderResume();

            // ================== DISPLAY ALL CARDS ==================
            if (cardsToShow.length > 0) {
                cardsToShow.forEach(cardHtml => {
                    $container.append(cardHtml);
                });
            } else {
                $container.append('<div class="text-center text-muted" style="padding:20px">Tidak ada data detail untuk kunjungan ini.</div>');
            }

            // Terapkan spotlight bila datang dari klik badge
            applyBadgeSpotlight($container);

        }).fail(function () {
            $container.append('<div class="text-danger">Gagal memuat detail riwayat.</div>');
        });
    }

    /* ================== MODE GABUNGAN ================== */
    function renderAllFromCache() {
        const list = state.cache_rows.slice();
        el.detSingle.hide(); el.detAll.show();

        if (!list.length) {
            el.allContent.html('<p class="text-center text-danger">Tidak ada riwayat ditemukan.</p>');
            return;
        }

        const container = $('<div/>');
        list.forEach(r => {
            const inner = $('<div class="rp-all-card rp-all-body"></div>');
            container.append(inner);
            loadFullDetailInto(inner, r);
        });
        el.allContent.html(container);
    }

    el.btnAll.off('click').on('click', () => {
        if (!state.cache_rows.length) { reloadList(true); return; }
        renderAllFromCache(true);
    });
    $('#btn_close_all').off('click').on('click', () => { el.detAll.hide(); el.detSingle.show(); });

    /* ================== QUICK RANGE & FILTER ================== */
    $('.rp-qrange').off('click').on('click', function () {
        const r = $(this).data('range');
        const now = new Date();
        const fmt = d => d.toISOString().slice(0, 10);
        if (r === 'all') { el.dateFrom.val(''); el.dateTo.val(''); }
        else {
            const days = (r === '180') ? 180 : (r === '365') ? 365 : Number(r || 0);
            const s = new Date(now);
            if (days !== 0) s.setDate(s.getDate() - days);
            el.dateFrom.val(fmt(s)); el.dateTo.val(fmt(now));
        }
        $('.rp-qrange').removeClass('btn-primary').addClass('btn-default');
        $(this).addClass('btn-primary');
        reloadList(true);
    });

    el.chips.off('click').on('click', function () { $(this).toggleClass('active'); });
    el.btnApply.off('click').on('click', () => reloadList(true));
    el.btnReset.off('click').on('click', () => {
        el.q.val(''); el.dateFrom.val(''); el.dateTo.val('');
        $('.rp-qrange').removeClass('btn-primary').addClass('btn-default');
        el.chips.removeClass('active');
        reloadList(true);
    });

    /* ================== INIT (DEFAULT: HARI INI) ================== */
    (function initRiwayat() {
        const now = new Date();
        const fmt = d => d.toISOString().slice(0, 10);
        el.dateFrom.val(fmt(now));
        el.dateTo.val(fmt(now));
        $('.rp-qrange').removeClass('btn-primary').addClass('btn-default');
        $('.rp-qrange[data-range="0"]').addClass('btn-primary'); // Hari Ini
        reloadList(true);
    })();

    /* ================== COLLAPSE HANDLER ================== */
    $(document).off('click', '.rp-card-head').on('click', '.rp-card-head', function (e) {
        // Jangan trigger jika klik elemen interaktif lain di header
        if ($(e.target).closest('a, button, .badge, .label, .rp-badge-click').length) return;

        const $body = $(this).next('.rp-card-body');
        const $icon = $(this).find('.rp-toggle-icon');

        $body.slideToggle(200);

        if ($icon.length) {
            if ($icon.hasClass('fa-minus')) {
                $icon.removeClass('fa-minus').addClass('fa-plus');
            } else {
                $icon.removeClass('fa-plus').addClass('fa-minus');
            }
        }
    });

    // Inject styles for collapse
    if (!document.getElementById('rp-collapse-style')) {
        $('<style id="rp-collapse-style">.rp-card-head{cursor:pointer;user-select:none;transition:background .2s}.rp-card-head:hover{filter:brightness(0.98)}</style>').appendTo('head');
    }

















    // --- BULK PRINT IMPL ---
    window.printBulkRiwayat = async function () {
        console.log("printBulkRiwayat: Starting...");

        // Get all visit records from cache
        const list = state.cache_rows.slice();

        if (!list.length) {
            alert('Tidak ada data riwayat yang tersedia untuk dicetak.');
            return;
        }

        console.log(`printBulkRiwayat: Found ${list.length} visit(s) to print.`);

        try {
            // Show loading indicator
            const loadingMsg = 'Memuat data untuk ' + list.length + ' kunjungan...';
            if (typeof Swal !== 'undefined') {
                Swal.fire({
                    title: 'Memproses...',
                    text: loadingMsg,
                    allowOutsideClick: false,
                    didOpen: () => { Swal.showLoading(); }
                });
            }

            // Fetch full details for each visit
            const payloads = [];
            for (const row of list) {
                try {
                    const response = await $.ajax({
                        url: BASE_URL + 'RiwayatPasien/get_detail',
                        method: 'POST',
                        data: { no_rawat: row.no_rawat },
                        dataType: 'json'
                    });

                    console.log(`Response for ${row.no_rawat}:`, response);

                    if (response && response.success && response.data) {
                        payloads.push(response.data);
                    } else {
                        console.warn(`Invalid response for ${row.no_rawat}:`, response);
                    }
                } catch (err) {
                    console.error(`Failed to load details for ${row.no_rawat}:`, err);
                    console.error('Error details:', err.responseText);
                }
            }

            if (typeof Swal !== 'undefined') {
                Swal.close();
            }

            if (payloads.length === 0) {
                alert('Gagal memuat data riwayat. Silakan coba lagi.');
                return;
            }

            console.log(`printBulkRiwayat: Successfully loaded ${payloads.length} visit details.`);

            // Generate Report
            let combinedHtml = '';
            payloads.forEach((data, index) => {
                if (typeof generateReportHtml !== 'function') {
                    throw new Error("generateReportHtml is not defined");
                }
                combinedHtml += generateReportHtml(data);
            });

            console.log("printBulkRiwayat: HTML generated. Opening window...");

            // Open Print Window
            const printWindow = window.open('', '_blank');
            if (!printWindow) {
                alert('Popup blocked! Please allow popups for this site.');
                return;
            }

            printWindow.document.write(`
    <!DOCTYPE html>
        <html>
            <head>
                <title>Cetak Riwayat Bulk - ${payloads[0]?.summary?.header?.nm_pasien || 'Pasien'}</title>
                <style>
                    @page {size: A4; margin: 10mm 15mm; }
                    body {font-family: "Times New Roman", Times, serif; font-size: 11px; margin: 0; padding: 10px; color: #000; }
                    .text-center {text-align: center; } .text-right {text-align: right; } .text-bold {font-weight: bold; }

                    .print-header {display: flex; align-items: center; border-bottom: 3px double #000; padding-bottom: 5px; margin-bottom: 10px; }
                    .print-logo {width: 60px; height: 60px; object-fit: contain; margin-right: 15px; }
                    .print-instansi {flex: 1; text-align: center; }
                    .print-instansi h2 {font-size: 16px; margin: 0; font-weight: bold; text-transform: uppercase; }
                    .print-instansi p {margin: 1px 0; font-size: 10px; }

                    .print-subhead {text-align: center; font-size: 14px; font-weight: bold; margin-bottom: 10px; text-decoration: underline; text-transform: uppercase; }
                    .patient-info-table {width: 100%; margin-bottom: 15px; border-collapse: collapse; font-size: 11px; border: 1px solid #000; }
                    .patient-info-table td {padding: 3px 5px; border: 1px solid #000; vertical-align: top; }
                    .label-cell {font-weight: bold; width: 15%; background: #f0f0f0; white-space: nowrap; }

                    .print-section {margin-bottom: 15px; break-inside: avoid; page-break-inside: avoid; border: 1px solid #000; }
                    .section-title {font-size: 11px; font-weight: bold; background: #ddd; border-bottom: 1px solid #000; padding: 3px 5px; text-transform: uppercase; }
                    .section-body {padding: 5px; }

                    .print-table {width: 100%; border-collapse: collapse; font-size: 10px; width: 100%; }
                    .print-table th, .print-table td {border: 1px solid #ccc; padding: 3px; }
                    .print-table th {background: #f8f8f8; text-align: left; }

                    .ttv-grid {display: grid; grid-template-columns: repeat(4, 1fr); gap: 0; border: 1px solid #ccc; margin: 5px 0; }
                    .ttv-item {border: 1px solid #ccc; padding: 3px; text-align: center; font-size: 10px; }
                    .ttv-label {font-weight: bold; font-size: 9px; color: #555; text-transform: uppercase; display: block; }

                    .footer-sig {margin-top: 20px; display: flex; justify-content: flex-end; break-inside: avoid; }
                    .sig-box {text-align: center; width: 220px; font-size: 11px; }

                    /* Ensure each record starts on new page */
                    .print-wrapper {page-break-after: always; display: block; min-height: 90vh; position: relative; padding-bottom: 20px; }
                    .print-wrapper:last-child {page-break-after: auto; }

                    img {max-width: 100%; height: auto; }
                </style>
            </head>
            <body onload="console.log('Print Loaded'); window.print();">
                ${combinedHtml}
            </body>
        </html>
`);
            printWindow.document.close();
            console.log("printBulkRiwayat: Document write done.");

            // Close the modal after a short delay to allow print window to open
            setTimeout(() => {
                $('#modal_all_riwayat').modal('hide');
            }, 500);
        } catch (err) {
            console.error("Error in printBulkRiwayat:", err);
            alert("Terjadi kesalahan saat mencetak: " + err.message);
            if (typeof Swal !== 'undefined') {
                Swal.close();
            }
        }
    };

    // Bind the bulk print button
    // Bind the bulk print button (Delegated)
    $(document).on('click', '#btn_print_all', function (e) {
        e.preventDefault();
        console.log('Button Cetak Semua clicked');
        if (typeof window.printBulkRiwayat === 'function') {
            window.printBulkRiwayat();
        } else {
            console.error('window.printBulkRiwayat is not defined');
            alert('Fungsi cetak belum siap. Silakan refresh halaman.');
        }
    });


});