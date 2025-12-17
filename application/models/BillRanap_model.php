<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BillRanap_model extends CI_Model {

    public function get_billing_ranap($start_date, $end_date) {
        $sql = "
            SELECT
                r.no_rawat,
                r.no_rkm_medis AS No_RM,
                p.nm_pasien AS Nama_Pasien,
                ki.tgl_masuk AS Tgl_Masuk,
                bs.nm_bangsal AS Ruangan,
                d.nm_dokter AS Nama_Dokter,

                -- Nama Paket Operasi
                COALESCE((
                    SELECT b_sub.nm_perawatan
                    FROM billing b_sub
                    WHERE b_sub.no_rawat = r.no_rawat
                      AND b_sub.status = 'Operasi'
                      AND (
                        LOWER(TRIM(b_sub.nm_perawatan)) LIKE '%paket%'
                        OR LOWER(TRIM(b_sub.nm_perawatan)) LIKE '%persalinan%'
                        OR LOWER(TRIM(b_sub.nm_perawatan)) LIKE '%sc%'
                      )
                    ORDER BY b_sub.nm_perawatan ASC
                    LIMIT 1
                ), '-') AS Nama_Paket_Operasi,

                -- COALESCE(SUM(CASE 
                --     WHEN b.status = 'Registrasi' 
                --     THEN b.totalbiaya 
                --     ELSE 0
                -- END), 0) AS Registrasi,

                COALESCE(SUM(CASE 
                    WHEN b.status IN ('Registrasi', 'Service') 
                    THEN b.totalbiaya 
                END), 0) AS Registrasi,


                -- Tindakan Dokter Inap (tanpa ALKES)
                COALESCE((
                    SELECT SUM(rid.biaya_rawat)
                    FROM rawat_inap_dr rid
                    JOIN jns_perawatan_inap jpi ON rid.kd_jenis_prw = jpi.kd_jenis_prw
                    JOIN kategori_perawatan kp ON jpi.kd_kategori = kp.kd_kategori
                    WHERE rid.no_rawat = r.no_rawat AND kp.nm_kategori <> 'ALKES'
                ), 0) AS Tindakan_Dokter_Inap,

                -- ALKES Inap
                COALESCE((
                    SELECT SUM(rid.biaya_rawat)
                    FROM rawat_inap_dr rid
                    JOIN jns_perawatan_inap jpi ON rid.kd_jenis_prw = jpi.kd_jenis_prw
                    JOIN kategori_perawatan kp ON jpi.kd_kategori = kp.kd_kategori
                    WHERE rid.no_rawat = r.no_rawat AND kp.nm_kategori = 'ALKES'
                ), 0) AS Alkes_Inap,

                -- Tindakan Dokter Ralan (tanpa ALKES)
                COALESCE((
                    SELECT SUM(rjd.biaya_rawat)
                    FROM rawat_jl_dr rjd
                    JOIN jns_perawatan jpj ON rjd.kd_jenis_prw = jpj.kd_jenis_prw
                    JOIN kategori_perawatan kp ON jpj.kd_kategori = kp.kd_kategori
                    WHERE rjd.no_rawat = r.no_rawat AND kp.nm_kategori <> 'ALKES'
                ), 0) AS Tindakan_Dokter_Ralan,

                -- ALKES Ralan
                COALESCE((
                    SELECT SUM(rjd.biaya_rawat)
                    FROM rawat_jl_dr rjd
                    JOIN jns_perawatan jpj ON rjd.kd_jenis_prw = jpj.kd_jenis_prw
                    JOIN kategori_perawatan kp ON jpj.kd_kategori = kp.kd_kategori
                    WHERE rjd.no_rawat = r.no_rawat AND kp.nm_kategori = 'ALKES'
                ), 0) AS Alkes_Ralan,

                -- Tindakan Perawat Inap (tanpa ALKES)
                COALESCE((
                    SELECT SUM(rip.biaya_rawat)
                    FROM rawat_inap_pr rip
                    JOIN jns_perawatan_inap jpi ON rip.kd_jenis_prw = jpi.kd_jenis_prw
                    JOIN kategori_perawatan kp ON jpi.kd_kategori = kp.kd_kategori
                    WHERE rip.no_rawat = r.no_rawat AND kp.nm_kategori <> 'ALKES'
                ), 0) AS Tindakan_Perawat_Inap,

                -- ALKES Inap oleh Perawat
                COALESCE((
                    SELECT SUM(rip.biaya_rawat)
                    FROM rawat_inap_pr rip
                    JOIN jns_perawatan_inap jpi ON rip.kd_jenis_prw = jpi.kd_jenis_prw
                    JOIN kategori_perawatan kp ON jpi.kd_kategori = kp.kd_kategori
                    WHERE rip.no_rawat = r.no_rawat AND kp.nm_kategori = 'ALKES'
                ), 0) AS Alkes_Perawat_Inap,

                -- Tindakan Perawat Ralan (tanpa ALKES)
                COALESCE((
                    SELECT SUM(rjp.biaya_rawat)
                    FROM rawat_jl_pr rjp
                    JOIN jns_perawatan jpj ON rjp.kd_jenis_prw = jpj.kd_jenis_prw
                    JOIN kategori_perawatan kp ON jpj.kd_kategori = kp.kd_kategori
                    WHERE rjp.no_rawat = r.no_rawat AND kp.nm_kategori <> 'ALKES'
                ), 0) AS Tindakan_Perawat_Ralan,

                -- ALKES Ralan oleh Perawat
                COALESCE((
                    SELECT SUM(rjp.biaya_rawat)
                    FROM rawat_jl_pr rjp
                    JOIN jns_perawatan jpj ON rjp.kd_jenis_prw = jpj.kd_jenis_prw
                    JOIN kategori_perawatan kp ON jpj.kd_kategori = kp.kd_kategori
                    WHERE rjp.no_rawat = r.no_rawat AND kp.nm_kategori = 'ALKES'
                ), 0) AS Alkes_Perawat_Ralan,

                -- Tarif Kamar
                COALESCE(SUM(CASE 
                    WHEN b.status = 'Kamar' THEN b.totalbiaya 
                END), 0) AS Tarif_Kamar,

                -- Obat Luar Paket
                COALESCE(SUM(CASE 
                    WHEN b.status = 'Obat' THEN b.totalbiaya 
                END), 0) AS Obat,

                -- Laboratorium
                COALESCE(SUM(CASE 
                    WHEN b.status = 'TtlLaborat' 
                         AND LOWER(b.nm_perawatan) LIKE 'total periksa lab%' 
                    THEN CAST(REPLACE(SUBSTRING_INDEX(b.nm_perawatan, ':', -1), '.', '') AS UNSIGNED)
                    ELSE 0
                END), 0) AS Laboratorium,

                -- Radiologi
                COALESCE(SUM(CASE 
                    WHEN b.status = 'TtlRadiologi' 
                         AND LOWER(b.nm_perawatan) LIKE 'total periksa radiologi%' 
                    THEN CAST(REPLACE(SUBSTRING_INDEX(b.nm_perawatan, ':', -1), '.', '') AS UNSIGNED)
                    ELSE 0
                END), 0) AS Radiologi,

                -- Retur Obat
                COALESCE(SUM(CASE 
                    WHEN b.status = 'Retur Obat' THEN b.totalbiaya 
                END), 0) AS Retur_Obat,

                -- Obat Tambahan (bersih)
                (COALESCE(SUM(CASE WHEN b.status = 'Obat' THEN b.totalbiaya END), 0) +
                 COALESCE(SUM(CASE WHEN b.status = 'Retur Obat' THEN b.totalbiaya END), 0)
                ) AS Obat_Tambahan,

                -- Tambahan Biaya
                COALESCE(SUM(CASE 
                    WHEN b.status = 'Tambahan' AND LOWER(b.nm_perawatan) LIKE '%jasa dokter%' 
                    THEN b.totalbiaya END), 0) AS Jasa_Dokter_Tambahan,

                COALESCE(SUM(CASE 
                    WHEN b.status = 'Tambahan' AND LOWER(b.nm_perawatan) LIKE '%jasa layanan%' 
                    THEN b.totalbiaya END), 0) AS Jasa_Layanan,

                COALESCE(SUM(CASE 
                    WHEN b.status = 'Tambahan' 
                      AND LOWER(b.nm_perawatan) NOT LIKE '%jasa dokter%'
                      AND LOWER(b.nm_perawatan) NOT LIKE '%jasa layanan%' 
                    THEN b.totalbiaya END), 0) AS Tambahan_Lainnya,

                -- Potongan Biaya
                COALESCE(SUM(CASE WHEN b.status = 'Potongan' THEN b.totalbiaya END), 0) AS Potongan_Biaya,

                -- Jasa Dokter Operasi
                COALESCE(SUM(CASE 
                    WHEN b.status = 'Operasi' AND (
                        LOWER(b.nm_perawatan) LIKE '%operator 1%' OR 
                        LOWER(b.nm_perawatan) LIKE '%dokter anak%' OR 
                        LOWER(b.nm_perawatan) LIKE '%anastesi%'
                    )
                    THEN b.totalbiaya END), 0) AS Jasa_Dokter_Operasi,

                -- Komponen Operasi lainnya
                COALESCE(SUM(CASE 
                    WHEN b.status = 'Operasi' AND LOWER(b.nm_perawatan) LIKE '%sewa%' 
                    THEN b.totalbiaya END), 0) AS Kamar_Operasi,

                COALESCE(SUM(CASE 
                    WHEN b.status = 'Operasi' AND LOWER(b.nm_perawatan) LIKE '%akomodasi%' 
                    THEN b.totalbiaya END), 0) AS Operasi_Obat,

                COALESCE(SUM(CASE 
                    WHEN b.status = 'Operasi' AND LOWER(b.nm_perawatan) LIKE '%sarpras%' 
                    THEN b.totalbiaya END), 0) AS Kamar_Rawatan_Operasi,

                COALESCE(SUM(CASE 
                    WHEN b.status = 'Operasi' AND LOWER(b.nm_perawatan) LIKE '%n.m.s%' 
                    THEN b.totalbiaya END), 0) AS Operasi_CTG,

                COALESCE(SUM(CASE 
                    WHEN b.status = 'Operasi' AND LOWER(b.nm_perawatan) LIKE '%biaya alat%' 
                    THEN b.totalbiaya 
                END), 0) AS BHP_Operasi,


                -- Operasi Lainnya (selain kategori di atas)
                COALESCE(SUM(CASE 
                    WHEN b.status = 'Operasi'
                      AND LOWER(b.nm_perawatan) NOT LIKE '%operator 1%'
                      AND LOWER(b.nm_perawatan) NOT LIKE '%dokter anak%'
                      AND LOWER(b.nm_perawatan) NOT LIKE '%anastesi%'
                      AND LOWER(b.nm_perawatan) NOT LIKE '%sewa%'
                      AND LOWER(b.nm_perawatan) NOT LIKE '%akomodasi%'
                      AND LOWER(b.nm_perawatan) NOT LIKE '%sarpras%'
                      AND LOWER(b.nm_perawatan) NOT LIKE '%n.m.s%'
                    THEN b.totalbiaya END), 0) AS Operasi_Lainnya

            FROM reg_periksa r
            INNER JOIN pasien p ON r.no_rkm_medis = p.no_rkm_medis
            INNER JOIN kamar_inap ki ON ki.no_rawat = r.no_rawat
            INNER JOIN kamar k ON ki.kd_kamar = k.kd_kamar
            INNER JOIN bangsal bs ON k.kd_bangsal = bs.kd_bangsal
            LEFT JOIN dpjp_ranap dpjp ON dpjp.no_rawat = r.no_rawat
            LEFT JOIN dokter d ON d.kd_dokter = dpjp.kd_dokter
            LEFT JOIN billing b ON b.no_rawat = r.no_rawat

            WHERE ki.tgl_keluar BETWEEN ? AND ?
              AND ki.stts_pulang <> 'Pindah Kamar'
              AND r.no_rawat NOT IN (SELECT no_rawat FROM piutang_pasien)

            GROUP BY r.no_rawat
            ORDER BY ki.tgl_keluar, ki.jam_keluar
        ";

        return $this->db->query($sql, [$start_date, $end_date])->result_array();
    }


    public function get_billing_data($start_date, $end_date) {
       $sql = "
            SELECT
                r.no_rawat,
                r.no_rkm_medis AS No_RM,
                p.nm_pasien AS Nama_Pasien,
                ki.tgl_masuk AS Tgl_Masuk,
                bs.nm_bangsal AS Ruangan,
                d.nm_dokter AS Nama_Dokter,

                -- Nama Paket Operasi
                COALESCE((
                    SELECT b_sub.nm_perawatan
                    FROM billing b_sub
                    WHERE b_sub.no_rawat = r.no_rawat
                      AND b_sub.status = 'Operasi'
                      AND (
                        LOWER(TRIM(b_sub.nm_perawatan)) LIKE '%paket%'
                        OR LOWER(TRIM(b_sub.nm_perawatan)) LIKE '%persalinan%'
                        OR LOWER(TRIM(b_sub.nm_perawatan)) LIKE '%sc%'
                      )
                    ORDER BY b_sub.nm_perawatan ASC
                    LIMIT 1
                ), '-') AS Nama_Paket_Operasi,

                -- COALESCE(SUM(CASE 
                --     WHEN b.status = 'Registrasi' 
                --     THEN b.totalbiaya 
                --     ELSE 0
                -- END), 0) AS Registrasi,

                COALESCE(SUM(CASE 
                    WHEN b.status IN ('Registrasi', 'Service') 
                    THEN b.totalbiaya 
                END), 0) AS Registrasi,


                -- Tindakan Dokter Inap (tanpa ALKES)
                COALESCE((
                    SELECT SUM(rid.biaya_rawat)
                    FROM rawat_inap_dr rid
                    JOIN jns_perawatan_inap jpi ON rid.kd_jenis_prw = jpi.kd_jenis_prw
                    JOIN kategori_perawatan kp ON jpi.kd_kategori = kp.kd_kategori
                    WHERE rid.no_rawat = r.no_rawat AND kp.nm_kategori <> 'ALKES'
                ), 0) AS Tindakan_Dokter_Inap,

                -- ALKES Inap
                COALESCE((
                    SELECT SUM(rid.biaya_rawat)
                    FROM rawat_inap_dr rid
                    JOIN jns_perawatan_inap jpi ON rid.kd_jenis_prw = jpi.kd_jenis_prw
                    JOIN kategori_perawatan kp ON jpi.kd_kategori = kp.kd_kategori
                    WHERE rid.no_rawat = r.no_rawat AND kp.nm_kategori = 'ALKES'
                ), 0) AS Alkes_Inap,

                -- Tindakan Dokter Ralan (tanpa ALKES)
                COALESCE((
                    SELECT SUM(rjd.biaya_rawat)
                    FROM rawat_jl_dr rjd
                    JOIN jns_perawatan jpj ON rjd.kd_jenis_prw = jpj.kd_jenis_prw
                    JOIN kategori_perawatan kp ON jpj.kd_kategori = kp.kd_kategori
                    WHERE rjd.no_rawat = r.no_rawat AND kp.nm_kategori <> 'ALKES'
                ), 0) AS Tindakan_Dokter_Ralan,

                -- ALKES Ralan
                COALESCE((
                    SELECT SUM(rjd.biaya_rawat)
                    FROM rawat_jl_dr rjd
                    JOIN jns_perawatan jpj ON rjd.kd_jenis_prw = jpj.kd_jenis_prw
                    JOIN kategori_perawatan kp ON jpj.kd_kategori = kp.kd_kategori
                    WHERE rjd.no_rawat = r.no_rawat AND kp.nm_kategori = 'ALKES'
                ), 0) AS Alkes_Ralan,

                -- Tindakan Perawat Inap (tanpa ALKES)
                COALESCE((
                    SELECT SUM(rip.biaya_rawat)
                    FROM rawat_inap_pr rip
                    JOIN jns_perawatan_inap jpi ON rip.kd_jenis_prw = jpi.kd_jenis_prw
                    JOIN kategori_perawatan kp ON jpi.kd_kategori = kp.kd_kategori
                    WHERE rip.no_rawat = r.no_rawat AND kp.nm_kategori <> 'ALKES'
                ), 0) AS Tindakan_Perawat_Inap,

                -- ALKES Inap oleh Perawat
                COALESCE((
                    SELECT SUM(rip.biaya_rawat)
                    FROM rawat_inap_pr rip
                    JOIN jns_perawatan_inap jpi ON rip.kd_jenis_prw = jpi.kd_jenis_prw
                    JOIN kategori_perawatan kp ON jpi.kd_kategori = kp.kd_kategori
                    WHERE rip.no_rawat = r.no_rawat AND kp.nm_kategori = 'ALKES'
                ), 0) AS Alkes_Perawat_Inap,

                -- Tindakan Perawat Ralan (tanpa ALKES)
                COALESCE((
                    SELECT SUM(rjp.biaya_rawat)
                    FROM rawat_jl_pr rjp
                    JOIN jns_perawatan jpj ON rjp.kd_jenis_prw = jpj.kd_jenis_prw
                    JOIN kategori_perawatan kp ON jpj.kd_kategori = kp.kd_kategori
                    WHERE rjp.no_rawat = r.no_rawat AND kp.nm_kategori <> 'ALKES'
                ), 0) AS Tindakan_Perawat_Ralan,

                -- ALKES Ralan oleh Perawat
                COALESCE((
                    SELECT SUM(rjp.biaya_rawat)
                    FROM rawat_jl_pr rjp
                    JOIN jns_perawatan jpj ON rjp.kd_jenis_prw = jpj.kd_jenis_prw
                    JOIN kategori_perawatan kp ON jpj.kd_kategori = kp.kd_kategori
                    WHERE rjp.no_rawat = r.no_rawat AND kp.nm_kategori = 'ALKES'
                ), 0) AS Alkes_Perawat_Ralan,

                -- Tarif Kamar
                COALESCE(SUM(CASE 
                    WHEN b.status = 'Kamar' THEN b.totalbiaya 
                END), 0) AS Tarif_Kamar,

                -- Obat Luar Paket
                COALESCE(SUM(CASE 
                    WHEN b.status = 'Obat' THEN b.totalbiaya 
                END), 0) AS Obat,

                -- Laboratorium
                COALESCE(SUM(CASE 
                    WHEN b.status = 'TtlLaborat' 
                         AND LOWER(b.nm_perawatan) LIKE 'total periksa lab%' 
                    THEN CAST(REPLACE(SUBSTRING_INDEX(b.nm_perawatan, ':', -1), '.', '') AS UNSIGNED)
                    ELSE 0
                END), 0) AS Laboratorium,

                -- Radiologi
                COALESCE(SUM(CASE 
                    WHEN b.status = 'TtlRadiologi' 
                         AND LOWER(b.nm_perawatan) LIKE 'total periksa radiologi%' 
                    THEN CAST(REPLACE(SUBSTRING_INDEX(b.nm_perawatan, ':', -1), '.', '') AS UNSIGNED)
                    ELSE 0
                END), 0) AS Radiologi,

                -- Retur Obat
                COALESCE(SUM(CASE 
                    WHEN b.status = 'Retur Obat' THEN b.totalbiaya 
                END), 0) AS Retur_Obat,

                -- Obat Tambahan (bersih)
                (COALESCE(SUM(CASE WHEN b.status = 'Obat' THEN b.totalbiaya END), 0) +
                 COALESCE(SUM(CASE WHEN b.status = 'Retur Obat' THEN b.totalbiaya END), 0)
                ) AS Obat_Tambahan,

                -- Tambahan Biaya
                COALESCE(SUM(CASE 
                    WHEN b.status = 'Tambahan' AND LOWER(b.nm_perawatan) LIKE '%jasa dokter%' 
                    THEN b.totalbiaya END), 0) AS Jasa_Dokter_Tambahan,

                COALESCE(SUM(CASE 
                    WHEN b.status = 'Tambahan' AND LOWER(b.nm_perawatan) LIKE '%jasa layanan%' 
                    THEN b.totalbiaya END), 0) AS Jasa_Layanan,

                COALESCE(SUM(CASE 
                    WHEN b.status = 'Tambahan' 
                      AND LOWER(b.nm_perawatan) NOT LIKE '%jasa dokter%'
                      AND LOWER(b.nm_perawatan) NOT LIKE '%jasa layanan%' 
                    THEN b.totalbiaya END), 0) AS Tambahan_Lainnya,

                -- Potongan Biaya
                COALESCE(SUM(CASE WHEN b.status = 'Potongan' THEN b.totalbiaya END), 0) AS Potongan_Biaya,

                -- Jasa Dokter Operasi
                COALESCE(SUM(CASE 
                    WHEN b.status = 'Operasi' AND (
                        LOWER(b.nm_perawatan) LIKE '%operator 1%' OR 
                        LOWER(b.nm_perawatan) LIKE '%dokter anak%' OR 
                        LOWER(b.nm_perawatan) LIKE '%anastesi%'
                    )
                    THEN b.totalbiaya END), 0) AS Jasa_Dokter_Operasi,

                -- Komponen Operasi lainnya
                COALESCE(SUM(CASE 
                    WHEN b.status = 'Operasi' AND LOWER(b.nm_perawatan) LIKE '%sewa%' 
                    THEN b.totalbiaya END), 0) AS Kamar_Operasi,

                COALESCE(SUM(CASE 
                    WHEN b.status = 'Operasi' AND LOWER(b.nm_perawatan) LIKE '%akomodasi%' 
                    THEN b.totalbiaya END), 0) AS Operasi_Obat,

                COALESCE(SUM(CASE 
                    WHEN b.status = 'Operasi' AND LOWER(b.nm_perawatan) LIKE '%sarpras%' 
                    THEN b.totalbiaya END), 0) AS Kamar_Rawatan_Operasi,

                COALESCE(SUM(CASE 
                    WHEN b.status = 'Operasi' AND LOWER(b.nm_perawatan) LIKE '%n.m.s%' 
                    THEN b.totalbiaya END), 0) AS Operasi_CTG,

                COALESCE(SUM(CASE 
                    WHEN b.status = 'Operasi' AND LOWER(b.nm_perawatan) LIKE '%biaya alat%' 
                    THEN b.totalbiaya 
                END), 0) AS BHP_Operasi,


                -- Operasi Lainnya (selain kategori di atas)
                COALESCE(SUM(CASE 
                    WHEN b.status = 'Operasi'
                      AND LOWER(b.nm_perawatan) NOT LIKE '%operator 1%'
                      AND LOWER(b.nm_perawatan) NOT LIKE '%dokter anak%'
                      AND LOWER(b.nm_perawatan) NOT LIKE '%anastesi%'
                      AND LOWER(b.nm_perawatan) NOT LIKE '%sewa%'
                      AND LOWER(b.nm_perawatan) NOT LIKE '%akomodasi%'
                      AND LOWER(b.nm_perawatan) NOT LIKE '%sarpras%'
                      AND LOWER(b.nm_perawatan) NOT LIKE '%n.m.s%'
                    THEN b.totalbiaya END), 0) AS Operasi_Lainnya

            FROM reg_periksa r
            INNER JOIN pasien p ON r.no_rkm_medis = p.no_rkm_medis
            INNER JOIN kamar_inap ki ON ki.no_rawat = r.no_rawat
            INNER JOIN kamar k ON ki.kd_kamar = k.kd_kamar
            INNER JOIN bangsal bs ON k.kd_bangsal = bs.kd_bangsal
            LEFT JOIN dpjp_ranap dpjp ON dpjp.no_rawat = r.no_rawat
            LEFT JOIN dokter d ON d.kd_dokter = dpjp.kd_dokter
            LEFT JOIN billing b ON b.no_rawat = r.no_rawat

            WHERE ki.tgl_keluar BETWEEN ? AND ?
              AND ki.stts_pulang <> 'Pindah Kamar'
              AND r.no_rawat NOT IN (SELECT no_rawat FROM piutang_pasien)

            GROUP BY r.no_rawat
            ORDER BY ki.tgl_keluar, ki.jam_keluar
        ";

        return $this->db->query($sql, [$start_date, $end_date])->result_array();
    }

}
