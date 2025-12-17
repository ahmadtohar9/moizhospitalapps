<style>
    /* Global Font Adjustment for this Module */
    #permintaanLabBaruApp {
        font-size: 14px;
    }

    /* AdminLTE Box mimicking */
    .box-custom {
        background: #fff;
        border-top: 3px solid #3c8dbc;
        /* Primary Blue */
        box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
        border-radius: 3px;
        margin-bottom: 20px;
        width: 100%;
    }

    .box-header-custom {
        color: #444;
        display: block;
        padding: 10px;
        position: relative;
        border-bottom: 1px solid #f4f4f4;
    }

    .box-title-custom {
        font-size: 16px;
        margin: 0;
        line-height: 1;
        font-weight: 600;
    }

    .box-body-custom {
        padding: 15px;
    }

    /* Lab Tree / List Styling */
    .lab-tree-wrapper {
        border: 1px solid #d2d6de;
        background: #fff;
        height: 600px;
        overflow-y: auto;
    }

    /* Category Header that looks like a Table Group Header */
    .lab-cat-header {
        background-color: #eee;
        color: #333;
        padding: 10px 15px;
        cursor: pointer;
        border-bottom: 1px solid #d2d6de;
        border-top: 1px solid #d2d6de;
        font-weight: bold;
        display: flex;
        align-items: center;
    }

    .lab-cat-header:first-child {
        border-top: none;
    }

    .lab-cat-header:hover {
        background-color: #e0e0e0;
    }

    .lab-items-container {
        display: none;
        padding: 0;
    }

    .lab-items-container.show {
        display: block;
    }

    /* The Table */
    .table-lab {
        width: 100%;
        margin-bottom: 0;
        background-color: transparent;
        border-collapse: collapse;
        border-spacing: 0;
    }

    .table-lab th {
        background-color: #f9f9f9;
        font-weight: 600;
        color: #333;
        border-bottom: 2px solid #dedede;
        padding: 10px;
        text-transform: uppercase;
        font-size: 12px;
    }

    .table-lab td {
        padding: 10px;
        border-bottom: 1px solid #f4f4f4;
        font-size: 14px;
    }

    .table-lab tr:hover td {
        background-color: #f5f5f5;
    }

    /* Selected Items Section */
    #section-selected-items {
        display: none;
        /* Hidden by default until items are selected */
        margin-bottom: 20px;
        border: 1px solid #00a65a;
        background: #f0fff4;
    }
</style>

<div class="row" id="permintaanLabBaruApp">
    <!-- HIDDEN VALUES -->
    <input type="hidden" id="plb_no_rawat" value="<?= isset($no_rawat) ? $no_rawat : '' ?>">
    <input type="hidden" id="plb_kd_dokter" value="<?= isset($kd_dokter) ? $kd_dokter : '' ?>">
    <input type="hidden" id="plb_url_master" value="<?= base_url('permintaanLabBaruController/get_master_data') ?>">
    <input type="hidden" id="plb_url_simpan" value="<?= base_url('permintaanLabBaruController/simpan') ?>">
    <input type="hidden" id="plb_url_riwayat" value="<?= base_url('permintaanLabBaruController/get_riwayat') ?>">
    <input type="hidden" id="plb_url_hapus" value="<?= base_url('permintaanLabBaruController/hapus') ?>">

    <!-- LEFT COLUMN: FORM -->
    <!-- LEFT COLUMN: INPUTS & SELECTION TREE -->
    <div class="col-md-7">
        <div class="box-custom">
            <div class="box-header-custom with-border">
                <i class="fa fa-pencil-square-o"></i>
                <h3 class="box-title-custom d-inline">Form Permintaan Laboratorium</h3>
            </div>

            <div class="box-body-custom">
                <!-- Inputs -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Diagnosa Klinis</label>
                            <textarea id="plb_diagnosa" class="form-control" rows="2"
                                placeholder="Diagnosa..."></textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Informasi Tambahan</label>
                            <textarea id="plb_info" class="form-control" rows="2"
                                placeholder="Keterangan..."></textarea>
                        </div>
                    </div>
                </div>

                <!-- SEARCH -->
                <div class="form-group">
                    <div class="input-group">
                        <input type="text" id="plb_search" class="form-control input-lg"
                            placeholder="Cari pemeriksaan (misal: hb, gula, kolesterol)...">
                        <span class="input-group-btn">
                            <button class="btn btn-primary btn-lg btn-flat" type="button"><i
                                    class="fa fa-search"></i></button>
                        </span>
                    </div>
                </div>

                <!-- MASTER TREE -->
                <div class="lab-tree-wrapper" id="plb_tree_container">
                    <div class="text-center p-5 text-muted">
                        <i class="fa fa-spinner fa-spin fa-2x"></i><br>Memuat Data...
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- RIGHT COLUMN: SELECTED ITEMS & HISTORY -->
    <div class="col-md-5">

        <!-- 1. SELECTED ITEMS (Now on Right Side) -->
        <div id="section-selected-items" class="box-custom" style="border-top-color: #00a65a; display:none;">
            <div class="box-header-custom" style="background: #f0fff4;">
                <i class="fa fa-check-circle text-success"></i>
                <b class="text-success">Pemeriksaan Terpilih</b>
                <span class="pull-right badge bg-green" id="selected-count-badge">0 Item</span>
            </div>
            <div class="box-body-custom p-0 table-responsive" style="max-height: 250px; overflow-y: auto;">
                <table class="table table-striped table-hover mb-0" id="table-selected-items" style="font-size:13px;">
                    <thead>
                        <tr>
                            <th>Item Pemeriksaan</th>
                            <th width="80" class="text-right">Tarif</th>
                            <th width="40"></th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
            <div class="box-footer p-2 border-top">
                <button class="btn btn-success btn-lg btn-block btn-flat" id="plb_btn_simpan">
                    <i class="fa fa-save"></i> KIRIM PERMINTAAN
                </button>
            </div>
        </div>

        <!-- 2. HISTORY (Now as Table) -->
        <div class="box-custom" style="border-top-color: #f39c12;">
            <div class="box-header-custom with-border">
                <i class="fa fa-history"></i>
                <h3 class="box-title-custom d-inline">Riwayat Permintaan</h3>
                <div class="pull-right box-tools">
                    <button type="button" class="btn btn-sm btn-default" onclick="loadHistory()"><i
                            class="fa fa-refresh"></i></button>
                </div>
            </div>
            <div class="box-body-custom p-0">
                <div id="lab-history-wrapper" class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                    <table class="table table-bordered table-striped" id="table-history-lab" style="font-size: 13px;">
                        <thead class="bg-gray">
                            <tr>
                                <th width="120">No Order / Tgl</th>
                                <th>Dokter / Status</th>
                                <th class="text-center" width="50">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="plb_history_container">
                            <tr>
                                <td colspan="3" class="text-center p-3">Belum ada riwayat.</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>

<script src="<?= base_url('assets/js/permintaanLabBaru.js') ?>"></script>