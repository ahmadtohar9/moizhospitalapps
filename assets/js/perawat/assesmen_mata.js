/* assets/js/perawat/assesmen_mata.js */
(function ($) {
  'use strict';

  /* ======================
   * Config Endpoints
   * ====================== */
  const API = {
    MASTER: 'perawat/assessment/master-masalah-rencana',
    GET:    'perawat/assessment/get',
    SAVE:   'perawat/assessment/save',
    DEL:    'perawat/assessment/delete'
  };

  /* ======================
   * Utilities
   * ====================== */
  function site_url(path) {
    const base = (window.APP_BASE || window.SITE_URL || window.base_url || '/');
    const b = String(base).replace(/\/+$/, '') + '/';
    const p = String(path || '').replace(/^\/+/, '');
    return b + p;
  }
  function nowDate(){ const d=new Date(); return d.toISOString().slice(0,10); }
  function nowTime(){ const d=new Date(); return d.toTimeString().split(' ')[0]; }
  function calcIMT(bb,tb){
    const w=parseFloat(bb||0), hcm=parseFloat(tb||0);
    if(!w||!hcm) return '';
    const h=hcm/100, imt=w/(h*h);
    return isFinite(imt)?imt.toFixed(2):'';
  }
  function toastOK(msg){ if(window.Swal) Swal.fire('OK',msg||'Berhasil','success'); else alert(msg||'Berhasil'); }
  function toastErr(msg){ if(window.Swal) Swal.fire('Gagal',msg||'Terjadi kesalahan','error'); else alert(msg||'Terjadi kesalahan'); }

  /* ======================
   * Prefill & basic binds
   * ====================== */
  function initBasics() 
  {
    // tanggal/jam default
    if (!$('#tgl_perawatan').val()) $('#tgl_perawatan').val(nowDate());
    if (!$('#jam_rawat').val())     $('#jam_rawat').val(nowTime());

    // IMT realtime + seed awal
    const setIMT = () => $('#imt').val(calcIMT($('#bb').val(), $('#tb').val()));
    $('#bb,#tb').on('input', setIMT);
    setIMT();

    // ===== Psikologis "Lain-lain"
    $('#psikologis').on('change', function(){
      const other = String($(this).val() || '').toLowerCase().includes('lain');
      $('#psikologis_lain').toggle(other);
      if (!other) $('#psikologis_lain').val('');
    }).trigger('change');

    // ===== Tinggal dengan "Lainnya"
    $('#tinggal_dengan').on('change', function(){
      const other = String($(this).val() || '').toLowerCase().includes('lain');
      $('#tinggal_lain').toggle(other);
      if (!other) $('#tinggal_lain').val('');
    }).trigger('change');

    // ===== Budaya detail (Ada)
    $('#budaya_flag').on('change', function(){
      const ada = String($(this).val() || '').toLowerCase() === 'ada';
      $('#budaya_detail').toggle(ada);
      if (!ada) $('#budaya_detail').val('');
    }).trigger('change');

    // ===== Alat Bantu: tampilkan ket_bantu jika ≠ 'Tidak'
    $('#alat_bantu').on('change', function(){
      const val  = String($(this).val() || '').toLowerCase();
      const show = val !== 'tidak' && val !== '';
      $('#ket_bantu').toggle(show);
      // auto-prefill dari opsi yang jelas
      if (show && !$('#ket_bantu').val()) {
        if (val === 'kursi roda' || val === 'tripod/kruk' || val === 'lainnya') {
          $('#ket_bantu').val($(this).val());
        }
      }
      if (!show) $('#ket_bantu').val('');
    }).trigger('change');

    // ===== Prothesa: tampilkan ket_pro jika 'Ya'
    $('#prothesa').on('change', function(){
      const ya = String($(this).val() || '').toLowerCase() === 'ya';
      $('#ket_pro').toggle(ya);
      if (!ya) $('#ket_pro').val('');
    }).trigger('change');

    // ===== Tambah tombol Hapus jika belum ada
    const $wrap = $('#formAssesmenPerawatMata .text-right');
    if ($wrap.find('#btnDeleteAssesmen').length === 0) {
      $('<button type="button" id="btnDeleteAssesmen" class="btn btn-danger" style="margin-right:8px">' +
          '<i class="fa fa-trash"></i> Hapus' +
        '</button>').prependTo($wrap);
    }
  }


  /* ======================
   * Risiko Jatuh
   * ====================== */
  function initFall(){
    function recalcFall(){
      let yes=0;
      $('.fall-q').each(function(){ if(String($(this).val()).toLowerCase()==='ya') yes++; });
      const txt = (yes===0)
        ? 'Tidak beresiko (tidak ditemukan a dan b)'
        : (yes===1 ? 'Risiko Rendah (ditemukan a/b)' : 'Risiko tinggi (ditemukan a dan b)');
      $('#fall_result').val(txt);
    }
    $('.fall-q').on('change', recalcFall);
    recalcFall();

    $('#fall_reported').on('change', function(){
      const ya = String($(this).val()).toLowerCase()==='ya';
      $('#fall_report_time').prop('disabled', !ya);
      if(ya && !$('#fall_report_time').val()) $('#fall_report_time').val(nowTime());
      if(!ya) $('#fall_report_time').val('');
    }).trigger('change');
  }

  /* ======================
   * Skrining Gizi
   * ====================== */
  function initNutrition(){
    function recalc(){
      const s1=parseInt($('#nutr_q1').val(),10)||0;
      const s2=parseInt($('#nutr_q2').val(),10)||0;
      $('#nutr_q1_score').val(s1);
      $('#nutr_q2_score').val(s2);
      $('#nutr_score').val(s1+s2);
    }
    $('#nutr_q1,#nutr_q2').on('change', recalc);
    recalc();
  }

  /* ======================
   * Pain slider + image marker
   * ====================== */
  function initPain(){
    const $slider=$('#pain_spinner'); if(!$slider.length) return;

    const MAP=[
      {max:0,  emoji:'😃', label:'Tidak nyeri',  color:'#16a34a'},
      {max:3,  emoji:'🙂', label:'Nyeri ringan', color:'#84cc16'},
      {max:6,  emoji:'😕', label:'Nyeri sedang', color:'#f59e0b'},
      {max:8,  emoji:'😣', label:'Nyeri berat',  color:'#ef4444'},
      {max:10, emoji:'😭', label:'Sangat berat', color:'#b91c1c'}
    ];

    function setUI(val){
      const v=Math.max(0,Math.min(10,parseInt(val||0,10)));
      $('#pain_score').val(v);
      const cfg = MAP.find(c=>v<=c.max) || MAP[MAP.length-1];
      $('#pain_face .emoji').text(cfg.emoji);
      $('#pain_label').text(`${cfg.label} (${v})`);
      $('#pain_face').css('color',cfg.color).addClass('pulse');
      setTimeout(()=>$('#pain_face').removeClass('pulse'),180);
      const pct=(v/10)*100;
      $slider.css({background:'linear-gradient(90deg,#16a34a, #f59e0b 50%, #ef4444)',
                   'background-size':`${pct}% 100%`,'background-repeat':'no-repeat'});
      $('#pain_marker').css('left',`${pct}%`);
      $('[data-key="pain_status"]').val(v>0?'Ada Nyeri':'Tidak Ada Nyeri');
    }

    const initVal=parseInt($('#pain_score').val(),10);
    if(!isNaN(initVal)) $slider.val(initVal);
    setUI($slider.val());

    $slider.on('input change', function(){ setUI(this.value); });

    $('[data-key="pain_status"]').on('change', function(){
      const on=String($(this).val()).toLowerCase().includes('ada');
      $slider.prop('disabled', !on);
      if(!on){ $slider.val(0); setUI(0); }
    }).trigger('change');

    $('#pain_reported').on('change', function(){
      const ya = String($(this).val()).toLowerCase()==='ya';
      $('#pain_report_time').prop('disabled', !ya);
      if(ya && !$('#pain_report_time').val()) $('#pain_report_time').val(nowTime());
      if(!ya) $('#pain_report_time').val('');
    }).trigger('change');
  }

  /* ======================
   * Master Masalah & Rencana
   * ====================== */
  const MK = {
    API_MASTER: site_url(API.MASTER),
    tree: [],
    byKode: {},
    selectedMasalah: new Set(),
    selectedRencana: {}, // { kode_masalah: Set(kode_rencana) }
    ready: $.Deferred()
  };

  function normKode(x){ return String(x==null?'':x).trim(); }
  function normText(x){ return String(x==null?'':x).trim(); }

  function normalizeTree(raw){
    return {
      kode_masalah: normKode(raw.kode_masalah),
      nama_masalah: normText(raw.nama_masalah),
      rencana: Array.isArray(raw.rencana)? raw.rencana.map(r=>({
        kode_rencana: normKode(r.kode_rencana),
        rencana_keperawatan: normText(r.rencana_keperawatan)
      })):[]
    };
  }

  function renderMasalahList(list){
    const box=$('#mk_list').empty();
    if(!list || !list.length){ box.html('<div class="text-muted">Master masalah kosong.</div>'); return; }
    list.forEach(m=>{
      const id=`mk_${m.kode_masalah}`;
      const checked = MK.selectedMasalah.has(m.kode_masalah)?'checked':'';
      box.append(
        `<label for="${id}" class="mk-item" style="display:flex;align-items:center;gap:8px;margin-bottom:6px;cursor:pointer">
           <input type="checkbox" class="mk-checkbox" id="${id}" data-km="${m.kode_masalah}" ${checked}>
           <span><b>${m.kode_masalah}</b> — ${m.nama_masalah||'-'}</span>
         </label>`
      );
    });
  }

  function renderRencanaPanel(){
    const panel=$('#rk_panel').empty();
    if(MK.selectedMasalah.size===0){
      panel.html('<div class="text-muted">Pilih masalah di kiri terlebih dahulu.</div>');
      return;
    }
    const selected = Array.from(MK.selectedMasalah).map(normKode).sort();
    selected.forEach(km=>{
      const m=MK.byKode[km]; if(!m) return;
      const $group=$(`
        <div class="panel panel-default" style="margin-bottom:8px">
          <div class="panel-heading" style="display:flex;justify-content:space-between;align-items:center;cursor:pointer">
            <strong>${m.kode_masalah} — ${m.nama_masalah||'-'}</strong>
            <span class="toggle">▼</span>
          </div>
          <div class="panel-body" style="display:block;padding-top:8px"></div>
        </div>
      `);
      const body=$group.find('.panel-body');
      if(!m.rencana || m.rencana.length===0){
        body.html('<div class="text-muted">Belum ada rencana tersusun.</div>');
      }else{
        m.rencana.forEach(r=>{
          const chkId=`rk_${m.kode_masalah}_${r.kode_rencana}`;
          const chosen = MK.selectedRencana[m.kode_masalah]?.has(r.kode_rencana);
          body.append(
            `<label for="${chkId}" style="display:flex;gap:8px;margin-bottom:6px">
               <input type="checkbox" class="rk-checkbox" id="${chkId}"
                      data-km="${m.kode_masalah}" data-kr="${r.kode_rencana}" ${chosen?'checked':''}>
               <span><b>${r.kode_rencana}</b> — ${r.rencana_keperawatan}</span>
             </label>`
          );
        });
      }
      $group.find('.panel-heading').on('click', function(){
        const b=$group.find('.panel-body'); const open=b.is(':visible');
        b.toggle(!open); $group.find('.toggle').text(open?'►':'▼');
      });
      panel.append($group);
    });
  }

  function initMK(){
    $('#mk_list').html('<div class="text-muted">Memuat master masalah…</div>');
    $('#rk_panel').html('<div class="text-muted">Pilih masalah di kiri terlebih dahulu.</div>');

    $.getJSON(MK.API_MASTER)
      .done(function(resp){
        if(!resp || resp.status!=='ok'){ $('#mk_list').html('<div class="text-danger">Gagal memuat master.</div>'); MK.ready.resolve(); return; }
        MK.tree=(resp.data||[]).map(normalizeTree);
        MK.byKode={};
        MK.tree.forEach(m=>{
          MK.byKode[m.kode_masalah]=m;
          if(!MK.selectedRencana[m.kode_masalah]) MK.selectedRencana[m.kode_masalah]=new Set();
        });
        renderMasalahList(MK.tree);
        MK.ready.resolve();
      })
      .fail(function(){ $('#mk_list').html('<div class="text-danger">Tidak bisa menghubungi server.</div>'); MK.ready.resolve(); });

    // search (debounce)
    let t=null;
    $('#mk_search').on('input', function(){
      clearTimeout(t);
      const q=$(this).val().toLowerCase().trim();
      t=setTimeout(function(){
        const filtered = MK.tree.filter(m =>
          (m.nama_masalah||'').toLowerCase().includes(q) ||
          (m.kode_masalah||'').toLowerCase().includes(q)
        );
        renderMasalahList(filtered);
      },120);
    });

    // pilih masalah
    $('#mk_list').on('change','.mk-checkbox', function(){
      const km=normKode($(this).data('km')); if(!km) return;
      if(this.checked) MK.selectedMasalah.add(km);
      else{ MK.selectedMasalah.delete(km); MK.selectedRencana[km]=new Set(); }
      renderRencanaPanel();
    });

    // pilih rencana
    $('#rk_panel').on('change','.rk-checkbox', function(){
      const km=normKode($(this).data('km')); const kr=normKode($(this).data('kr')); if(!km||!kr) return;
      if(!MK.selectedRencana[km]) MK.selectedRencana[km]=new Set();
      if(this.checked) MK.selectedRencana[km].add(kr);
      else MK.selectedRencana[km].delete(kr);
    });

    return MK.ready.promise();
  }

  /* ======================
   * Terapkan seleksi MK dari data existing
   * ====================== */
  function applyMKSelectionsFromData(raw){
    // bentuk data bisa:
    // 1) { asesmen: {...}, demografi: {...} }
    // 2) { ...kolom_tabel, asesmen_json:{mk_selected, rk_map,...}, demografi:? }
    const data = raw?.asesmen ? raw.asesmen : raw;
    const aj = data?.asesmen_json || {};

    // reset dulu
    MK.selectedMasalah = new Set();
    MK.selectedRencana = {};

    // isi selected masalah
    const listMasalah = Array.isArray(aj.mk_selected) ? aj.mk_selected : [];
    listMasalah.forEach(km => {
      const kode = normKode(km);
      if(!kode) return;
      MK.selectedMasalah.add(kode);
      if(!MK.selectedRencana[kode]) MK.selectedRencana[kode] = new Set();
    });

    // isi selected rencana
    const rmap = aj.rk_map && typeof aj.rk_map === 'object' ? aj.rk_map : {};
    Object.keys(rmap).forEach(km=>{
      const kode = normKode(km);
      if(!MK.selectedRencana[kode]) MK.selectedRencana[kode] = new Set();
      (rmap[km]||[]).forEach(kr => MK.selectedRencana[kode].add(normKode(kr)));
    });

    // render ulang UI berdasarkan pilihan
    renderMasalahList(MK.tree);
    renderRencanaPanel();

    // ceklis yang sudah terpilih di list kiri
    MK.selectedMasalah.forEach(km => {
      $('#mk_list .mk-checkbox[data-km="'+km+'"]').prop('checked', true);
    });
  }

  /* ======================
   * Serialize & Fill
   * ====================== */
  function buildPayload(){
    const payload={
      no_rawat: $('#no_rawat').val(),
      kd_poli:  $('#kd_poli').val(),
      nip:      $('#nip').val(),
      tgl_perawatan: $('#tgl_perawatan').val()||nowDate(),
      jam_rawat:     $('#jam_rawat').val()||nowTime(),

      tensi: $('#tensi').val(),
      nadi: $('#nadi').val(),
      respirasi: $('#respirasi').val(),
      suhu: $('#suhu').val(),
      gcs: $('#gcs').val(),
      bb: $('#bb').val(),
      tb: $('#tb').val(),
      imt: $('#imt').val(),

      keluhan_utama: $('#keluhan_utama').val(),
      alergi: $('#alergi').val(),

      asesmen_json: {}
    };

    // semua dyn-field (kecuali bahasa/agama readonly)
    $('.dyn-field').each(function () {
      const k=$(this).data('key'); if(!k) return;
      payload.asesmen_json[k] = $(this).val();
    });

    // Masalah & Rencana
    payload.asesmen_json['mk_selected'] = Array.from(MK.selectedMasalah);
    const rmap={};
    Object.keys(MK.selectedRencana).forEach(km => rmap[km]=Array.from(MK.selectedRencana[km]||[]));
    payload.asesmen_json['rk_map'] = rmap;

    // ringkas rencana (opsional)
    const flat=[];
    MK.tree.forEach(m=>{
      if(!MK.selectedMasalah.has(m.kode_masalah)) return;
      const chosen=rmap[m.kode_masalah]||[];
      const txts=(m.rencana||[]).filter(r=>chosen.includes(r.kode_rencana)).map(r=>r.rencana_keperawatan);
      flat.push(`- ${m.nama_masalah}${txts.length?': '+txts.join('; '):''}`);
    });
    payload.asesmen_json['rk_flat']=flat.join('\n');

    return payload;
  }

  function fillForm(raw){
    const data = raw?.asesmen ? raw.asesmen : raw;
    if(!data) return;

    $('#tgl_perawatan').val(data.tgl_perawatan||nowDate());
    $('#jam_rawat').val(data.jam_rawat||nowTime());

    $('#tensi').val(data.tensi||'');
    $('#nadi').val(data.nadi||'');
    $('#respirasi').val(data.rr||data.respirasi||''); // kompatibel
    $('#suhu').val(data.suhu||'');
    $('#gcs').val(data.gcs||'');
    $('#bb').val(data.bb||'');
    $('#tb').val(data.tb||'');
    $('#imt').val(data.bmi||data.imt||'');

    $('#keluhan_utama').val(data.keluhan_utama||'');
    $('#alergi').val(data.alergi||'');

    const aj=data.asesmen_json||{};
    $('.dyn-field').each(function(){
      const k=$(this).data('key'); if(!k) return;
      if(aj.hasOwnProperty(k)) $(this).val(aj[k]);
    });

    // trigger UI yg bergantung
    $('#psikologis').trigger('change');
    $('#tinggal_dengan').trigger('change');
    $('#budaya_flag').trigger('change');
    $('#pain_reported').trigger('change');
    $('#fall_reported').trigger('change');

    const sc=parseInt(aj.pain_score||data.skala_nyeri||0,10);
    if(!isNaN(sc)){ $('#pain_score').val(sc); $('#pain_spinner').val(sc).trigger('input'); }
  }

  /* ======================
   * Save, Delete, Load
   * ====================== */
  function initSave(){
    $('#btnSaveAssesmen').off('.assess').on('click.assess', function(){
      const warn=[];
      if(!$('#keluhan_utama').val()) warn.push('• Keluhan utama belum diisi');
      if(!$('#tensi').val()) warn.push('• TD belum diisi');
      if(!$('#nadi').val()) warn.push('• Nadi belum diisi');
      if(warn.length && !confirm('Periksa isian berikut:\n'+warn.join('\n')+'\n\nTetap simpan?')) return;

      const payload=buildPayload();
      $.post(site_url(API.SAVE), payload, function(r){
        if(r && r.status==='success') toastOK('Assessment tersimpan');
        else toastErr(r?.message||'Tidak bisa menyimpan');
      },'json').fail(function(){ toastErr('Masalah jaringan/server'); });
    });
  }

  function initDelete(){
    $('#btnDeleteAssesmen').off('.assess').on('click.assess', function(){
      const no_rawat=$('#no_rawat').val(), tgl=$('#tgl_perawatan').val(), jam=$('#jam_rawat').val();
      if(!no_rawat||!tgl||!jam){ toastErr('Tidak bisa hapus: no_rawat/tanggal/jam kosong.'); return; }
      if(!confirm('Yakin mau menghapus asesmen ini?')) return;

      $.post(site_url(API.DEL), { no_rawat:no_rawat, tgl_perawatan:tgl, jam_rawat:jam }, function(r){
        if(r && r.status==='success'){
          toastOK('Asesmen terhapus');
          $('#formAssesmenPerawatMata')[0].reset();
          initBasics(); initFall(); initNutrition(); initPain();
          renderMasalahList(MK.tree);
          $('#rk_panel').html('<div class="text-muted">Pilih masalah di kiri terlebih dahulu.</div>');
        }else{
          toastErr(r?.message||'Gagal menghapus.');
        }
      },'json').fail(function(){ toastErr('Masalah jaringan/server'); });
    });
  }

  function loadExisting(){
    const params = {
      no_rawat:      $('#no_rawat').val(),
      tgl_perawatan: $('#tgl_perawatan').val() || undefined,
      jam_rawat:     $('#jam_rawat').val() || undefined
    };

    return $.getJSON(site_url(API.GET), params)
      .done(function(r){
        if (!r || r.status !== 'success') return;

        // --- Prefill demografi (readonly, tidak di-serialize)
        const demo = (r.data && r.data.demografi) ? r.data.demografi : {};
        if (demo.bahasa != null) $('#bahasa_pasien').val(String(demo.bahasa));
        if (demo.agama  != null) $('#agama_pasien').val(String(demo.agama)); // <- pastikan id input di view: #agama_pasien

        // --- Ambil payload asesmen (bisa di bawah data.asesmen, atau langsung data)
        const asesmen = (r.data && r.data.asesmen) ? r.data.asesmen : (r.data || null);
        if (asesmen){
          fillForm(asesmen);

          // Terapkan pilihan Masalah & Rencana jika fungsi tersedia
          if (typeof applyMKSelectionsFromData === 'function') {
            applyMKSelectionsFromData(asesmen);
          } else {
            // fallback ringan agar tidak error console
            console.warn('applyMKSelectionsFromData() tidak ditemukan — lewati.');
          }
        }
      })
      .fail(function(){
        // biarkan form tetap kosong kalau gagal fetch; bisa isi baru
        console.warn('Gagal memuat data asesmen/demografi.');
      });
  }



  /* ======================
   * Boot
   * ====================== */
  $(function(){
    if(!$('#formAssesmenPerawatMata').length) return;
    initBasics();
    initFall();
    initNutrition();
    initPain();
    $.when(initMK()).then(function(){
      $.when(loadExisting()).then(function(){ renderRencanaPanel(); });
    });
    initSave();
    initDelete();
  });

})(jQuery);
