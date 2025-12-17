<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SetupRmeTables extends CI_Controller
{

    public function index()
    {
        $this->load->database();
        $this->load->dbforge();

        echo "<h2>Setup Sistem Menu RME</h2>";

        // 1. Buat Tabel Master Menu Tab RME
        echo "Check Table: moizhospital_rme_tab_menus... ";
        if (!$this->db->table_exists('moizhospital_rme_tab_menus')) {
            $fields = [
                'id' => ['type' => 'INT', 'constraint' => 11, 'auto_increment' => TRUE],
                'tab_name' => ['type' => 'VARCHAR', 'constraint' => 100],
                'tab_url' => ['type' => 'VARCHAR', 'constraint' => 255], // Kunci pencocokan di controller
                'category' => ['type' => 'VARCHAR', 'constraint' => 50, 'default' => 'dokter'], // dokter/perawat/umum
                'is_active' => ['type' => 'INT', 'constraint' => 1, 'default' => 1],
            ];
            $this->dbforge->add_field($fields);
            $this->dbforge->add_key('id', TRUE);
            $this->dbforge->create_table('moizhospital_rme_tab_menus');
            echo "<b style='color:green'>CREATED.</b><br>";
        } else {
            echo "<b style='color:blue'>ALREADY EXISTS.</b><br>";
        }

        // 2. Buat Tabel User Access RME
        echo "Check Table: moizhospital_user_rme_access... ";
        if (!$this->db->table_exists('moizhospital_user_rme_access')) {
            $fields = [
                'id' => ['type' => 'INT', 'constraint' => 11, 'auto_increment' => TRUE],
                'user_id' => ['type' => 'INT', 'constraint' => 11],
                'rme_tab_id' => ['type' => 'INT', 'constraint' => 11],
            ];
            $this->dbforge->add_field($fields);
            $this->dbforge->add_key('id', TRUE);
            $this->dbforge->create_table('moizhospital_user_rme_access');
            echo "<b style='color:green'>CREATED.</b><br>";
        } else {
            echo "<b style='color:blue'>ALREADY EXISTS.</b><br>";
        }

        // 3. Seed Data Awal (Daftar Menu Tab)
        echo "Seeding Menu Data...<br>";
        $data_menus = [
            // Menu Dokter
            ['tab_name' => 'Assessment Awal', 'tab_url' => 'AwalMedisDokterMataRalanController/index', 'category' => 'dokter'],
            ['tab_name' => 'SOAP', 'tab_url' => 'SoapRalanController/index', 'category' => 'dokter'],
            ['tab_name' => 'Resep Umum', 'tab_url' => 'PermintaanResepRalan/index', 'category' => 'dokter'],
            ['tab_name' => 'Resep Racikan', 'tab_url' => 'PermintaanResepRacikanRalanController/index', 'category' => 'dokter'],
            ['tab_name' => 'Diagnosa & Prosedur', 'tab_url' => 'DiagnosaProsedurRalanController/index', 'category' => 'dokter'],
            ['tab_name' => 'Resume Medis', 'tab_url' => 'ResumeMedisRalanController/index', 'category' => 'dokter'],
            ['tab_name' => 'Radiologi', 'tab_url' => 'PermintaanRadiologiController/index', 'category' => 'dokter'],
            ['tab_name' => 'Laboratorium', 'tab_url' => 'PermintaanLabBaruController/index', 'category' => 'dokter'],
            ['tab_name' => 'Penunjang', 'tab_url' => 'dokterRalan/PenunjangRalanController/index', 'category' => 'dokter'],
            ['tab_name' => 'Laporan Tindakan', 'tab_url' => 'dokterRalan/LaporanTindakanRalanDokterController/index', 'category' => 'dokter'],
            ['tab_name' => 'Operasi', 'tab_url' => 'OperasiController/index', 'category' => 'dokter'],
            ['tab_name' => 'Surat Sakit', 'tab_url' => 'dokterRalan/SuratSakitRalanController/index', 'category' => 'dokter'],
            ['tab_name' => 'Rujukan Keluar', 'tab_url' => 'dokterRalan/RujukanKeluarRalanController/index', 'category' => 'dokter'],
            ['tab_name' => 'Asesmen Medis IGD', 'tab_url' => 'AwalMedisIGDController/index', 'category' => 'dokter'],

            // Menu Perawat
            ['tab_name' => 'Assessment Awal Perawat', 'tab_url' => 'perawat/assesmen/router', 'category' => 'perawat'],
            ['tab_name' => 'SOAP Perawat', 'tab_url' => 'perawat/SoapPerawatController/index', 'category' => 'perawat'],
            ['tab_name' => 'Tindakan Keperawatan', 'tab_url' => 'perawat/TindakanRalanPerawatController/index', 'category' => 'perawat'],

            // Umum
            ['tab_name' => 'Riwayat Pasien', 'tab_url' => 'RiwayatPasienController/index', 'category' => 'umum'],
        ];

        foreach ($data_menus as $menu) {
            $exists = $this->db->get_where('moizhospital_rme_tab_menus', ['tab_url' => $menu['tab_url']])->row();
            if (!$exists) {
                $this->db->insert('moizhospital_rme_tab_menus', $menu);
                echo "Inserted: " . $menu['tab_name'] . "<br>";
            }
        }

        echo "<hr><h3>Selesai! Tabel dan Data Menu RME Berhasil Dibuat.</h3>";
        echo "<p>Silakan lanjut ke pembuatan Controller Manajemen Akses.</p>";
    }
}
