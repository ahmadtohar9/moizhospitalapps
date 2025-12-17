<style>
    .position-relative {
        position: relative;
    }

    .input-clear-btn {
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 18px;
        color: #888;
        border: none;
        background: transparent;
        padding: 0;
        line-height: 1;
        visibility: hidden; /* Default: hidden */
    }

    .input-clear-btn:hover {
        color: red;
        cursor: pointer;
    }

    .input-has-value + .input-clear-btn {
        visibility: visible; /* Show when input has text */
    }

    .badge.bg-danger {
        font-size: 14px;
        padding: 6px 10px;
    }

    .riwayatDiagnosaGroup {
        margin-top: 10px;
    }

    #hasilDiagnosa,
    #hasilProsedur,
    #riwayatDiagnosa,
    #riwayatProsedur {
        max-height: 200px;
        overflow-y: auto;
    }

    #hasilDiagnosa table,
    #hasilProsedur table,
    #riwayatDiagnosa table,
    #riwayatProsedur table {
        margin-bottom: 0;
    }

    /* Scrollbar styling */
    #hasilDiagnosa::-webkit-scrollbar,
    #hasilProsedur::-webkit-scrollbar,
    #riwayatDiagnosa::-webkit-scrollbar,
    #riwayatProsedur::-webkit-scrollbar {
        width: 6px;
    }

    #hasilDiagnosa::-webkit-scrollbar-thumb,
    #hasilProsedur::-webkit-scrollbar-thumb,
    #riwayatDiagnosa::-webkit-scrollbar-thumb,
    #riwayatProsedur::-webkit-scrollbar-thumb {
        background-color: #ccc;
        border-radius: 4px;
    }
</style>


<div class="row">
    <div class="col-md-6">
        <h5>Input Diagnosa</h5>
        <input type="hidden" id="no_rawat" value="<?= $no_rawat ?>">
        <input type="hidden" id="no_rkm_medis" value="<?= $no_rkm_medis ?>">

        <!-- Diagnosa -->
        <div class="form-group mb-2 position-relative">
            <input type="text" id="diagnosaInput" class="form-control" placeholder="Cari Diagnosa...">
            <button type="button" id="clearDiagnosaInput" class="input-clear-btn">×</button>
        </div>

        <div class="form-group mb-3">
            <button class="btn btn-primary" id="btnSimpanDiagnosa">Simpan Diagnosa</button>
        </div>

        <div id="hasilDiagnosa" class="mb-4"></div>

        <hr>

        <h5>Input Prosedur</h5>

	<!-- Autocomplete Prosedur -->
	<div class="form-group mb-2 position-relative">
	    <input type="text" id="prosedurInput" class="form-control" placeholder="Cari Prosedur...">
	    <button type="button" id="clearProsedurInput" class="input-clear-btn">×</button>
	</div>

	<!-- Tombol Simpan Prosedur -->
	<div class="form-group mb-3">
	    <button type="button" class="btn btn-primary" id="btnSimpanProsedur">Simpan Prosedur</button>
	</div>
	        <div id="hasilProsedur"></div>
	</div>

    <div class="col-md-6">
       <div class="d-flex justify-content-between align-items-center">
		    <h5>Riwayat Diagnosa</h5>
		</div>
		<div id="riwayatDiagnosa" class="mb-4"></div>

		<hr>

		<div class="d-flex justify-content-between align-items-center">
		    <h5>Riwayat Prosedur</h5>
		</div>
		<div id="riwayatProsedur"></div>
    </div>
</div>

<script src="<?= asset_url('assets/js/diagnosaProsedurRalan.js') ?>"></script>

<script>
$(document).ready(function () {
    function toggleClearButton(inputId, clearBtnId) {
        const val = $(inputId).val();
        if (val && val.length > 0) {
            $(inputId).addClass('input-has-value');
        } else {
            $(inputId).removeClass('input-has-value');
        }
    }

    // Diagnosa
    $('#diagnosaInput').on('input', function () {
        toggleClearButton('#diagnosaInput', '#clearDiagnosaInput');
    });

    $('#clearDiagnosaInput').on('click', function () {
        $('#diagnosaInput').val('').removeData('kode').removeClass('input-has-value');
    });

    // Prosedur
    $('#prosedurInput').on('input', function () {
        toggleClearButton('#prosedurInput', '#clearProsedurInput');
    });

    $('#clearProsedurInput').on('click', function () {
        $('#prosedurInput').val('').removeData('kode').removeClass('input-has-value');
    });
});
</script>
