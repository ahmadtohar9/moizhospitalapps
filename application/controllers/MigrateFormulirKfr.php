<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MigrateFormulirKfr extends CI_Controller
{

    public function index()
    {
        $this->load->database();

        // 1. Create Table moizhospital_lembarKFR_rehabmedik
        $sql = "CREATE TABLE IF NOT EXISTS moizhospital_lembarKFR_rehabmedik (
            no_rawat VARCHAR(20) NOT NULL,
            tgl_perawatan DATE NOT NULL,
            jam_rawat TIME NOT NULL,
            kd_dokter VARCHAR(20) DEFAULT NULL,
            subjective TEXT,
            objective TEXT,
            assessment TEXT,
            goal_of_treatment TEXT,
            tindakan_rehab TEXT,
            edukasi TEXT,
            frekuensi_kunjungan VARCHAR(255),
            rencana_tindak_lanjut TEXT,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (no_rawat, tgl_perawatan, jam_rawat)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";

        if ($this->db->query($sql)) {
            echo "Tabel 'moizhospital_lembarKFR_rehabmedik' berhasil dibuat/sudah ada.<br>";
        } else {
            echo "Gagal membuat tabel.<br>";
            print_r($this->db->error());
        }

        // 2. Insert Menu to moizhospital_rme_tab_menus
        $menu_data = [
            'tab_name' => 'Formulir Rawat Jalan KFR',
            'tab_url' => 'FormulirKfrRalanController/index', // Controller baru
            'category' => 'dokter', // Asumsi kategori dokter karena TTD Dokter Sp.KFR
            'is_active' => 1
        ];

        // Cek duplicate
        $cek = $this->db->get_where('moizhospital_rme_tab_menus', ['tab_url' => $menu_data['tab_url']])->num_rows();

        if ($cek == 0) {
            $this->db->insert('moizhospital_rme_tab_menus', $menu_data);
            echo "Menu 'Formulir Rawat Jalan KFR' berhasil ditambahkan ke RME.<br>";
        } else {
            echo "Menu sudah ada.<br>";
        }

        echo "Selesai. Silakan lanjut coding Controller & View.";
    }
}
