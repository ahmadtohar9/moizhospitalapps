(function(){
  $(function(){
    const $form   = $('#formAssesmenPerawat');
    if(!$form.length) return;

    // Tambahkan contoh section dinamis sederhana (bisa dihapus/ubah)
    const box = $('#dynamicFields');
    const p = $('<div class="panel panel-default" style="margin-bottom:10px;">\
      <div class="panel-heading"><strong>Tambahan Umum</strong></div>\
      <div class="panel-body"></div></div>');
    p.find('.panel-body').append(
      '<div class="form-group"><label>Status Psikososial</label><input class="form-control dyn-field" data-key="psikososial"></div>'+
      '<div class="form-group"><label>Catatan</label><textarea class="form-control dyn-field" data-key="catatan_tambahan"></textarea></div>'
    );
    box.append(p);

    $('#btnSaveAssesmen').on('click', function(){
      const now = new Date();
      const payload = {
        no_rawat: $('#no_rawat').val(),
        kd_poli:  $('#kd_poli').val(),
        nip:      $('#nip').val(),
        tgl_perawatan: now.toISOString().slice(0,10),
        jam_rawat: now.toTimeString().split(' ')[0],

        // kolom umum
        keluhan_utama: $('#keluhan_utama').val(),
        alergi: $('#alergi').val(),
        tensi: $('#tensi').val(),
        nadi: $('#nadi').val(),
        respirasi: $('#respirasi').val(),
        suhu: $('#suhu').val(),
        spo2: $('#spo2').val(),
        bb: $('#bb').val(),
        tb: $('#tb').val(),

        // kumpulkan field dinamis (opsional)
        asesmen_json: {}
      };

      $('.dyn-field').each(function(){
        payload.asesmen_json[$(this).data('key')] = $(this).val();
      });

      // Endpoint simpan: gunakan API yang sudah kamu punya
      $.post(site_url('perawat/AssessmentPerawatController/save'), payload, function(r){
        if(r && r.status==='success'){
          Swal.fire('OK','Assessment tersimpan','success');
        } else {
          Swal.fire('Gagal','Tidak bisa menyimpan','error');
        }
      }, 'json').fail(function(){
        Swal.fire('Error','Masalah jaringan/server','error');
      });
    });
  });
})();
