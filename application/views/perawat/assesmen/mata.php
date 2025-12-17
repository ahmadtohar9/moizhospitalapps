<?php
// VIEW: Assessment Awal Perawat – Poli Mata
// Tips: jika kamu ingin mewarisi default, tidak apa-apa. Di sini aku buat layout lengkap langsung.
?>
<style>
  .pill { border:1.6px solid #cbd5e1; border-radius:20px; padding:4px 10px; min-height:32px; }
  .sec-title { font-weight:600; background:#f3f4f6; padding:6px 10px; border-left:4px solid #0ea5e9; margin:14px 0 10px; }
  .hint { font-size:12px; color:#6b7280 }
  .grid-2 { display:grid; grid-template-columns:1fr 1fr; gap:10px 16px; }
  .grid-3 { display:grid; grid-template-columns:repeat(3,1fr); gap:10px 16px; }
  .grid-4 { display:grid; grid-template-columns:repeat(4,1fr); gap:10px 16px; }
  .table-compact td, .table-compact th { padding:6px 8px !important; }
</style>
<style>
  <style>
  .pain-widget{display:flex;flex-direction:column;gap:6px;max-width:520px}
  .pain-face{display:flex;align-items:center;gap:8px;font-weight:600}
  .pain-face .emoji{font-size:28px;line-height:1}
  .pain-range{width:100%; -webkit-appearance:none; height:10px; border-radius:10px;
    background: linear-gradient(90deg,#16a34a, #f59e0b 50%, #ef4444)}
  .pain-range::-webkit-slider-thumb{ -webkit-appearance:none; width:22px;height:22px;border-radius:50%;background:#fff;border:2px solid #111}
  .pain-range::-moz-range-thumb{ width:22px;height:22px;border-radius:50%;background:#fff;border:2px solid #111}
  .pain-ticks{display:grid;grid-template-columns:repeat(11,1fr);font-size:11px;color:#6b7280}
  .pain-ticks span{justify-self:center}
  /* smoother feel */
  .pain-face .emoji{ transition: transform .15s ease, color .2s ease; }
  .pain-face.pulse .emoji{ animation: painPulse .18s ease; }
  @keyframes painPulse { 0%{transform:scale(1)} 50%{transform:scale(1.12)} 100%{transform:scale(1)} }
  .pain-range{ transition: background-size .15s ease; }

  /* gambar skala + marker */
  .pain-scale-imgwrap{ position:relative; max-width:600px }
  .pain-scale-imgwrap img{ width:100%; height:auto; display:block; border:1px solid #e5e7eb; border-radius:8px }
  #pain_marker{
    position:absolute; bottom:-10px; left:0; transform:translateX(-50%);
    width:0; height:0; border-left:7px solid transparent; border-right:7px solid transparent;
    border-top:12px solid #111; transition:left .2s ease;
  }
</style>

</style>

<div class="box box-success">
  <div class="box-header">
    <h3 class="box-title">Assessment Awal Perawat – Poli Mata</h3>
  </div>

  <div class="box-body">
    <form id="formAssesmenPerawatMata" class="form" autocomplete="off">
      <!-- hidden context -->
      <input type="hidden" id="no_rawat" value="<?= html_escape($no_rawat) ?>">
      <input type="hidden" id="kd_poli"  value="<?= html_escape($kd_poli ?? ($detail_pasien['kd_poli'] ?? '')) ?>">
      <input type="hidden" id="nip"      value="<?= html_escape($nip_perawat ?? '') ?>">

      <!-- HEADER BARIS IDENTITAS SINGKAT (readonly) -->
      <div class="grid-4">
        <div class="form-group">
          <label>Petugas</label>
          <input class="form-control pill" readonly value="<?= html_escape($this->session->userdata('nama_user') ?? '') ?>">
        </div>
        <div class="form-group">
          <label>Tanggal</label>
          <input id="tgl_perawatan" class="form-control pill">
        </div>
        <div class="form-group">
          <label>Jam</label>
          <input id="jam_rawat" class="form-control pill">
        </div>
        <div class="form-group">
          <label>Informasi didapat dari</label>
          <select class="form-control pill dyn-field" data-key="info_sumber">
            <option>Autoanamnesis</option>
            <option>Alloanamnesis</option>
          </select>
        </div>
      </div>

      <!-- I. KEADAAN UMUM -->
      <div class="sec-title">I. Keadaan Umum</div>
      <div class="grid-4">
        <div class="form-group">
          <label>TD</label>
          <div class="input-group">
            <input id="tensi" class="form-control pill" placeholder="120/80">
            <span class="input-group-addon">mmHg</span>
          </div>
        </div>

        <div class="form-group">
          <label>Nadi</label>
          <div class="input-group">
            <input id="nadi" type="number" min="0" class="form-control pill">
            <span class="input-group-addon">x/menit</span>
          </div>
        </div>

        <div class="form-group">
          <label>RR</label>
          <div class="input-group">
            <input id="respirasi" type="number" min="0" class="form-control pill">
            <span class="input-group-addon">x/menit</span>
          </div>
        </div>

        <div class="form-group">
          <label>Suhu</label>
          <div class="input-group">
            <input id="suhu" type="number" step="0.1" class="form-control pill">
            <span class="input-group-addon">°C</span>
          </div>
        </div>

        <div class="form-group">
          <label>GCS(E,V,M)</label>
          <div class="input-group">
          <input id="gcs" class="form-control pill dyn-field" data-key="gcs">
          </div>
        </div>
      </div>

      <!-- II. STATUS NUTRISI -->
      <div class="sec-title">II. Status Nutrisi</div>
      <div class="grid-3">
        <div class="form-group">
          <label>BB</label>
          <div class="input-group">
            <input id="bb" type="number" step="0.1" class="form-control pill">
            <span class="input-group-addon">Kg</span>
          </div>
        </div>

        <div class="form-group">
          <label>TB</label>
          <div class="input-group">
            <input id="tb" type="number" step="0.1" class="form-control pill">
            <span class="input-group-addon">cm</span>
          </div>
        </div>

        <div class="form-group">
          <label>BMI</label>
          <div class="input-group">
            <input id="imt" class="form-control pill" readonly>
            <span class="input-group-addon">Kg/m²</span>
          </div>
        </div>
      </div>

      <!-- III. RIWAYAT KESEHATAN -->
      <div class="sec-title">III. Riwayat Kesehatan</div>
      <div class="grid-2">
        <div class="form-group">
          <label>Keluhan Utama</label>
          <textarea id="keluhan_utama" rows="2" class="form-control pill"></textarea>
        </div>
        <div class="form-group">
          <label>Riwayat Penyakit Keluarga</label>
          <textarea class="form-control pill dyn-field" data-key="riwayat_keluarga" rows="2"></textarea>
        </div>

        <div class="form-group">
          <label>Riwayat Penyakit Dahulu</label>
          <textarea class="form-control pill dyn-field" data-key="riwayat_dahulu" rows="2"></textarea>
        </div>
        <div class="form-group">
          <label>Riwayat Pengobatan</label>
          <textarea class="form-control pill dyn-field" data-key="riwayat_pengobatan" rows="2"></textarea>
        </div>
      </div>

      <div class="grid-2">
        <div class="form-group">
          <label>Riwayat Alergi</label>
          <input id="alergi" class="form-control pill" placeholder="Obat, makanan, lainnya">
        </div>
        <div></div>
      </div>

      <!-- IV. FUNGSIONAL -->
      <div class="sec-title">IV. Fungsional</div>
      <div class="grid-3">
        <!-- Alat Bantu -->
        <div class="form-group">
          <label>Alat Bantu</label>
          <select id="alat_bantu" class="form-control pill dyn-field" data-key="alat_bantu">
            <option>Tidak</option>
            <option>Kursi roda</option>
            <option>Tripod/Kruk</option>
            <option>Lainnya</option>
          </select>
          <!-- muncul kalau ≠ 'Tidak' -->
          <input id="ket_bantu" class="form-control pill dyn-field" data-key="ket_bantu"
                 placeholder="nama/jenis alat bantu" style="margin-top:6px; display:none">
        </div>

        <!-- Prothesa -->
        <div class="form-group">
          <label>Prothesa</label>
          <select id="prothesa" class="form-control pill dyn-field" data-key="prothesa">
            <option>Tidak</option>
            <option>Ya</option>
          </select>
          <!-- muncul kalau Prothesa=Ya -->
          <input id="ket_pro" class="form-control pill dyn-field" data-key="ket_pro"
                 placeholder="jenis prothesa" style="margin-top:6px; display:none">
        </div>

        <!-- ADL -->
        <div class="form-group">
          <label>ADL</label>
          <select class="form-control pill dyn-field" data-key="adl">
            <option>Mandiri</option>
            <option>Dibantu</option>
          </select>
        </div>
      </div>

      <div class="form-group">
        <label>Cacat Fisik</label>
        <input class="form-control pill dyn-field" data-key="cacat_fisik" value="TIDAK ADA">
      </div>


      <!-- V. PSIKO-SOSIAL, SPIRITUAL & BUDAYA -->
      <div class="sec-title">V. Riwayat Psiko-Sosial, Spiritual & Budaya</div>

      <div class="grid-3">
        <div class="form-group">
          <label>Status Psikologis</label>
          <select id="psikologis" class="form-control pill dyn-field" data-key="psikologis">
            <option>Tenang</option>
            <option>Takut</option>
            <option>Cemas</option>
            <option>Depresi</option>
            <option>Lain-lain</option>
          </select>
          <input id="psikologis_lain" class="form-control pill dyn-field" data-key="ket_psiko"
                 placeholder="Sebutkan…" style="margin-top:6px; display:none">
        </div>

        <div class="form-group">
          <label>Bahasa yang digunakan sehari-hari</label>
          <!-- hanya prefill dari pasien, TIDAK ikut diserialisasi -->
          <input id="bahasa_pasien" class="form-control pill" readonly value="">
        </div>

       <div class="form-group">
          <label>Agama</label>
          <input id="agama_pasien" class="form-control pill" readonly value="">
        </div>

      </div>

      <div class="grid-3">
        <div class="form-group">
          <label>a. Hubungan pasien dengan anggota keluarga</label>
          <select class="form-control pill dyn-field" data-key="hub_keluarga">
            <option>Baik</option>
            <option>Tidak Baik</option>
          </select>
        </div>

        <div class="form-group">
          <label>b. Tinggal dengan</label>
          <select id="tinggal_dengan" class="form-control pill dyn-field" data-key="tinggal_dengan">
            <option>Sendiri</option>
            <option>Orang Tua</option>
            <option>Suami / Istri</option>
            <option>Lainnya</option>
          </select>
          <input id="tinggal_lain" class="form-control pill dyn-field" data-key="ket_tinggal"
                 placeholder="contoh: sepupu" style="margin-top:6px; display:none">
        </div>

        <div class="form-group">
          <label>c. Ekonomi</label>
          <select class="form-control pill dyn-field" data-key="ekonomi">
            <option>Baik</option>
            <option>Cukup</option>
            <option>Kurang</option>
          </select>
        </div>
      </div>

      <div class="grid-3">
        <div class="form-group">
          <label>Kepercayaan / Budaya / Nilai khusus yang perlu diperhatikan</label>
          <select id="budaya_flag" class="form-control pill dyn-field" data-key="budaya">
            <option>Tidak Ada</option>
            <option>Ada</option>
          </select>
          <input id="budaya_detail" class="form-control pill dyn-field"
                 data-key="ket_budaya" placeholder="Jelaskan…" style="margin-top:6px; display:none">
        </div>

        <div class="form-group">
          <label>Edukasi diberikan kepada</label>
          <select id="edukasi_kepada" class="form-control pill dyn-field" data-key="edukasi">
            <option>Pasien</option>
            <option>Keluarga</option>
          </select>
          <input id="edukasi_nama" class="form-control pill dyn-field" data-key="ket_edukasi"
                 placeholder="nama penerima edukasi" style="margin-top:6px;">
        </div>

        <div></div>
      </div>


      <!-- VI. PENGKAJIAN RESIKO JATUH -->
      <div class="sec-title">VI. Pengkajian Resiko Jatuh</div>

      <div class="form-group"><b>a. Cara Berjalan :</b></div>
      <div class="grid-3">
        <div class="form-group">
          <label>1. Tidak seimbang / sempoyongan / limbung</label>
          <select class="form-control pill dyn-field fall-q"
                  data-key="fall_gait_unsteady" data-flag="a1">
            <option value="tidak">Tidak</option>
            <option value="ya">Ya</option>
          </select>
        </div>
        <div class="form-group">
          <label>2. Jalan dengan menggunakan alat bantu (kruk, tripot, kursi roda, orang lain)</label>
          <select class="form-control pill dyn-field fall-q"
                  data-key="fall_aid" data-flag="a2">
            <option value="tidak">Tidak</option>
            <option value="ya">Ya</option>
          </select>
        </div>
      </div>

      <div class="form-group" style="margin-top:6px"><b>b.</b>
        Menopang saat akan duduk, tampak memegang pinggiran kursi atau meja / benda lain sebagai penopang
      </div>
      <div class="grid-3">
        <div class="form-group">
          <select class="form-control pill dyn-field fall-q"
                  data-key="fall_support" data-flag="b">
            <option value="tidak">Tidak</option>
            <option value="ya">Ya</option>
          </select>
        </div>
      </div>

      <div class="grid-3">
        <div class="form-group">
          <label>Hasil</label>
          <select class="form-control pill dyn-field" id="fall_result" data-key="fall_result">
            <option>Tidak beresiko (tidak ditemukan a dan b)</option>
            <option>Risiko Renda (ditemukan a/b)</option>
            <option>Risiko tinggi (ditemukan a dan b)</option>
          </select>
        </div>

        <div class="form-group">
          <label>Dilaporkan kepada dokter?</label>
          <select class="form-control pill dyn-field" id="fall_reported" data-key="fall_reported">
            <option>Tidak</option><option>Ya</option>
          </select>
        </div>

        <div class="form-group">
          <label>Jam dilaporkan</label>
          <input class="form-control pill dyn-field" id="fall_report_time"
                 data-key="fall_report_time" placeholder="hh:mm:ss" disabled>
        </div>
      </div>

      <!-- VII. SKRINING GIZI -->
      <div class="sec-title">VII. Skrining Gizi</div>

      <!-- 2 kolom: kiri pertanyaan, kanan nilai -->
      <div class="grid-2">
        <!-- Q1 kiri -->
        <div class="form-group">
          <label>1) Apakah ada penurunan berat badan yang tidak diinginkan selama 6 bulan terakhir?</label>
          <select id="nutr_q1" class="form-control pill dyn-field" data-key="nutr_q1">
            <option value="0">Tidak</option>
            <option value="2">Tidak Yakin</option>
            <option value="1">Ya, 1–5 Kg</option>
            <option value="2">Ya, 6–10 Kg</option>
            <option value="3">Ya, 11–15 Kg</option>
            <option value="4">Ya, &gt;15 Kg</option>
          </select>
        </div>
        <!-- Q1 kanan (nilai) -->
        <div class="form-group">
          <label>Nilai</label>
          <input id="nutr_q1_score" class="form-control pill dyn-field" data-key="nutr_q1_score" readonly value="0">
        </div>

        <!-- Q2 kiri -->
        <div class="form-group">
          <label>2) Apakah nafsu makan berkurang karena tidak nafsu makan?</label>
          <select id="nutr_q2" class="form-control pill dyn-field" data-key="nutr_q2">
            <option value="0">Tidak</option>
            <option value="1">Ya</option>
          </select>
        </div>
        <!-- Q2 kanan (nilai) -->
        <div class="form-group">
          <label>Nilai</label>
          <input id="nutr_q2_score" class="form-control pill dyn-field" data-key="nutr_q2_score" readonly value="0">
        </div>
      </div>

      <!-- total di bawah -->
      <div class="form-group" style="max-width:280px; margin-top:6px">
        <label>Total Skor</label>
        <input id="nutr_score" class="form-control pill dyn-field" data-key="nutr_score" readonly value="0">
      </div>


      <!-- VIII. PENGKAJIAN TINGKAT NYERI -->
      <div class="sec-title">VIII. Pengkajian Tingkat Nyeri</div>

      <!-- Baris 1: status, penyebab, kualitas -->
      <div class="grid-3">
        <div class="form-group">
          <label>Status Nyeri</label>
          <select class="form-control pill dyn-field pain-toggle" data-key="pain_status">
            <option>Tidak Ada Nyeri</option>
            <option>Ada Nyeri</option>
          </select>
        </div>
        <div class="form-group">
          <label>Penyebab</label>
          <select class="form-control pill dyn-field" data-key="pain_cause">
            <option>Proses Penyakit</option>
            <option>Trauma</option>
            <option>Pascabedah</option>
            <option>Lainnya</option>
          </select>
        </div>
        <div class="form-group">
          <label>Kualitas</label>
          <select class="form-control pill dyn-field" data-key="pain_quality">
            <option>Seperti Tertusuk</option>
            <option>Tumpul</option>
            <option>Terbakar</option>
            <option>Berdenyut</option>
          </select>
        </div>
      </div>

      <!-- Baris 2: wilayah, lokasi, menyebar -->
      <div class="grid-3">
        <div class="form-group">
          <label>Wilayah</label>
          <input class="form-control pill dyn-field" data-key="pain_region" placeholder="mis. mata kanan / sekitar alis">
        </div>
        <div class="form-group">
          <label>Lokasi</label>
          <input class="form-control pill dyn-field" data-key="pain_location">
        </div>
        <div class="form-group">
          <label>Menyebar</label>
          <select class="form-control pill dyn-field" data-key="pain_radiating">
            <option>Tidak</option>
            <option>Ya</option>
          </select>
        </div>
      </div>

      <!-- Blok utama: slider tepat di atas gambar -->
      <div class="form-group" style="grid-column: 1 / -1;">
        <label style="display:block;margin-bottom:6px">Severity – Skala Nyeri (0–10)</label>

        <!-- header: emoji/label kiri, nilai kanan -->
        <div style="display:flex; align-items:center; justify-content:space-between; gap:10px; margin-bottom:6px">
          <div class="pain-face" id="pain_face" aria-live="polite" style="display:flex; align-items:center; gap:8px">
            <span class="emoji">😃</span>
            <span class="label" id="pain_label">Tidak nyeri (0)</span>
          </div>
          <!-- nilai tersimpan, sinkron dengan slider -->
          <input id="pain_score" type="number" min="0" max="10"
                 class="form-control pill dyn-field" data-key="pain_score"
                 value="0" readonly style="max-width:90px">
        </div>

        <!-- slider + ticks -->
        <div class="pain-widget" style="margin-bottom:6px">
          <input type="range" id="pain_spinner" min="0" max="10" step="1" value="0" class="pain-range">
          <div class="pain-ticks">
            <span>0</span><span>1</span><span>2</span><span>3</span><span>4</span>
            <span>5</span><span>6</span><span>7</span><span>8</span><span>9</span><span>10</span>
          </div>
        </div>

        <!-- gambar skala tepat di bawah slider (dengan marker) -->
        <div class="pain-scale-imgwrap">
          <img id="pain_scale_image"
               src="<?= base_url('assets/img/pain/wong-baker-0-10.png') ?>"
               alt="Wong-Baker Faces Pain Rating Scale">
          <div id="pain_marker" title="Nilai nyeri"></div>
        </div>
      </div>

      <!-- Baris 3: durasi & relief -->
      <div class="grid-3" style="margin-top:10px">
        <div class="form-group">
          <label>Waktu/Durasi (menit)</label>
          <input type="number" min="0" class="form-control pill dyn-field" data-key="pain_duration">
        </div>
        <div class="form-group">
          <label>Nyeri hilang bila</label>
          <select class="form-control pill dyn-field" data-key="pain_relief">
            <option>Istirahat</option>
            <option>Kompress</option>
            <option>Analgesik</option>
            <option>Lainnya</option>
          </select>
        </div>
        <div></div>
      </div>

      <!-- Baris 4: pelaporan -->
      <div class="grid-3">
        <div class="form-group">
          <label>Diberitahukan pada dokter?</label>
          <select class="form-control pill dyn-field" data-key="pain_reported" id="pain_reported">
            <option>Tidak</option><option>Ya</option>
          </select>
        </div>
        <div class="form-group">
          <label>Jam</label>
          <input class="form-control pill dyn-field" data-key="pain_report_time"
                 id="pain_report_time" placeholder="hh:mm:ss">
        </div>
        <div></div>
      </div>



     <!-- IX. MASALAH & RENCANA KEPERAWATAN -->
      <div class="sec-title">Masalah & Rencana Keperawatan</div>

      <div class="grid-2">
        <!-- KIRI: Checklist Masalah -->
        <div class="form-group">
          <label>Masalah Keperawatan</label>
          <input type="text" id="mk_search" class="form-control pill" placeholder="Cari masalah…">
          <div id="mk_list" class="mk-list" style="max-height:320px; overflow:auto; margin-top:6px">
            <!-- diisi via JS -->
            <div class="text-muted">Memuat master masalah…</div>
          </div>
        </div>

        <!-- KANAN: Checklist Rencana untuk Masalah terpilih -->
        <div class="form-group">
          <label>Rencana Keperawatan</label>
          <div id="rk_panel" class="rk-panel" style="max-height:320px; overflow:auto">
            <div class="text-muted">Pilih masalah di kiri terlebih dahulu.</div>
          </div>
        </div>
      </div>

      <!-- Catatan opsional -->
      <div class="grid-2" style="margin-top:8px">
        <div class="form-group">
          <label>Catatan Masalah (opsional)</label>
          <textarea id="mk_note" class="form-control pill dyn-field" data-key="mk_note"
                    rows="3" placeholder="Tambahan catatan…"></textarea>
        </div>
        <div class="form-group">
          <label>Catatan Rencana (opsional)</label>
          <textarea id="rk_note" class="form-control pill dyn-field" data-key="rk_note"
                    rows="3" placeholder="Tambahan catatan…"></textarea>
        </div>
      </div>


      <div class="text-right" style="margin-top:12px">
        <button type="button" id="btnSaveAssesmen" class="btn btn-success">
          <i class="fa fa-save"></i> Simpan
        </button>
      </div>
    </form>
  </div>
</div>

<script>
  window.APP_BASE = '<?= rtrim(site_url(),"/") ?>/';
</script>
<script src="<?= base_url('assets/js/perawat/assesmen_mata.js') ?>"></script>
