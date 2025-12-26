<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LaporanRekamMedisRawaJalanController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('LaporanRekamMedisRawaJalan_model');
        $this->load->library('session');

        // Check if user is logged in
        if (!$this->session->userdata('logged_in')) {
            redirect('auth/login');
        }
    }

    public function index()
    {
        $data['title'] = 'Laporan Rekam Medis Rawat Jalan';
        $data['user_name'] = $this->session->userdata('nama') ?? 'User';

        $this->load->view('templates/header', $data);
        $this->load->view('laporan/rekam_medis_rawat_jalan_view', $data);
        $this->load->view('templates/footer');
    }

    /**
     * Process chat message and return response
     */
    public function process_chat()
    {
        $this->output->set_content_type('application/json');

        $message = $this->input->post('message');
        $user_name = $this->session->userdata('nama') ?? 'User';

        if (empty($message)) {
            echo json_encode([
                'success' => false,
                'message' => 'Pesan tidak boleh kosong'
            ]);
            return;
        }

        // Parse message and extract intent
        $parsed = $this->parse_message($message);

        // Generate response based on intent
        $response = $this->generate_response($parsed, $user_name);

        echo json_encode($response);
    }

    /**
     * Parse user message to extract intent and parameters
     */
    private function parse_message($message)
    {
        $message_lower = strtolower(trim($message));
        $result = [
            'intent' => 'unknown',
            'params' => []
        ];

        // Greeting patterns (optional - only if explicitly greeted)
        if (preg_match('/^(halo|hai|hi|hello|selamat)\s*(mas|pak|bu|mbak)?\s*\w*$/i', $message_lower)) {
            $result['intent'] = 'greeting';
            return $result;
        }

        // Help patterns
        if (preg_match('/(bantuan|help|bisa apa|fitur|cara|gimana|bagaimana)/i', $message_lower)) {
            $result['intent'] = 'help';
            return $result;
        }

        // Date range patterns
        $date_patterns = [
            // Format: dari tanggal X sampai Y
            '/dari\s+(?:tanggal\s+)?(\d{1,2})\s+(\w+)\s+(\d{4})\s+sampai\s+(\d{1,2})\s+(\w+)\s+(\d{4})/i',
            // Format: tanggal X - Y bulan tahun
            '/tanggal\s+(\d{1,2})\s*-\s*(\d{1,2})\s+(\w+)\s+(\d{4})/i',
            // Format: bulan tahun (with or without "bulan" keyword)
            '/(?:bulan\s+)?(\w+)\s+(\d{4})/i',
        ];

        foreach ($date_patterns as $pattern) {
            if (preg_match($pattern, $message, $matches)) {
                $result['params']['date_range'] = $this->extract_date_range($matches);
                break;
            }
        }

        // Quick date patterns
        if (preg_match('/(hari\s*ini|today|sekarang)/i', $message_lower)) {
            $result['params']['date_range'] = [
                'start' => date('Y-m-d'),
                'end' => date('Y-m-d')
            ];
        } elseif (preg_match('/(kemarin|yesterday)/i', $message_lower)) {
            $yesterday = date('Y-m-d', strtotime('-1 day'));
            $result['params']['date_range'] = [
                'start' => $yesterday,
                'end' => $yesterday
            ];
        } elseif (preg_match('/(minggu\s*ini|week|seminggu)/i', $message_lower)) {
            $result['params']['date_range'] = [
                'start' => date('Y-m-d', strtotime('monday this week')),
                'end' => date('Y-m-d')
            ];
        } elseif (preg_match('/(bulan\s*ini|month|sebulan)/i', $message_lower)) {
            $result['params']['date_range'] = [
                'start' => date('Y-m-01'),
                'end' => date('Y-m-d')
            ];
        } elseif (preg_match('/(tahun\s*ini|year|setahun)/i', $message_lower)) {
            $result['params']['date_range'] = [
                'start' => date('Y-01-01'),
                'end' => date('Y-m-d')
            ];
        }

        // Penjamin/Asuransi filter - Process FIRST to avoid conflicts with doctor names
        // First, try to match specific known insurance names
        $known_penjamin = [
            'bpjs\s*kesehatan' => 'BPJS KESEHATAN',
            'bpjs' => 'BPJS',
            'umum' => 'UMUM',
            'mandiri\s*inhealth' => 'MANDIRI INHEALTH',
            'prudential' => 'PRUDENTIAL',
            'allianz' => 'ALLIANZ',
            'axa' => 'AXA',
            'manulife' => 'MANULIFE',
            'sinarmas' => 'SINARMAS',
            'admedika' => 'ADMEDIKA',
            'jamsostek' => 'JAMSOSTEK',
            'askes' => 'ASKES'
        ];

        foreach ($known_penjamin as $pattern => $name) {
            if (preg_match('/\b(' . $pattern . ')\b/i', $message_lower)) {
                $result['params']['penjamin'] = $name;
                break;
            }
        }

        // If not found in known list, try generic pattern but exclude date keywords
        if (!isset($result['params']['penjamin'])) {
            if (preg_match('/(asuransi|penjamin|jaminan)\s+([a-z\s]+?)(?:\s+(?:hari|bulan|minggu|tahun|dari|sampai|januari|februari|maret|april|mei|juni|juli|agustus|september|oktober|november|desember|jan|feb|mar|apr|jun|jul|agu|sep|okt|nov|des|\d{4})|$)/i', $message, $matches)) {
                $penjamin_name = trim($matches[2]);
                // Exclude common words
                $exclude_words = ['hari', 'ini', 'bulan', 'minggu', 'tahun', 'semua', 'yang'];
                if (!in_array(strtolower($penjamin_name), $exclude_words)) {
                    $result['params']['penjamin'] = $penjamin_name;
                }
            }
        }

        // Doctor filter - More flexible patterns (AFTER penjamin)
        // Pattern 1: "dokter X" or "dr. X" or "dr X"
        if (preg_match('/(?:dokter|dr\.?)\s+([a-z\s\.]+?)(?:\s+(?:hari|bulan|minggu|tahun|dari|sampai|bpjs|umum|poli|asuransi|penjamin)|$)/i', $message, $matches)) {
            $result['params']['dokter'] = trim($matches[1]);
        }
        // Pattern 2: "pasien dr X" or "pasien dokter X"
        elseif (preg_match('/pasien\s+(?:dokter|dr\.?)\s+([a-z\s\.]+?)(?:\s+(?:hari|bulan|minggu|tahun|dari|sampai|bpjs|umum|poli|asuransi|penjamin)|$)/i', $message, $matches)) {
            $result['params']['dokter'] = trim($matches[1]);
        }
        // Pattern 3: Just name after "pasien" (e.g., "pasien reza")
        elseif (preg_match('/pasien\s+([a-z]+)(?:\s+(?:hari|bulan|minggu|tahun|dari|sampai)|$)/i', $message, $matches)) {
            // Check if it's not a common word and not already a penjamin
            $common_words = ['hari', 'ini', 'bulan', 'minggu', 'tahun', 'bpjs', 'umum', 'semua', 'yang', 'asuransi', 'penjamin', 'jaminan'];
            $name = trim($matches[1]);
            if (!in_array(strtolower($name), $common_words) && !isset($result['params']['penjamin'])) {
                $result['params']['dokter'] = $name;
            }
        }

        // Poli filter
        if (preg_match('/(?:poli|poliklinik)\s+([a-z\s]+?)(?:\s+(?:hari|bulan|minggu|tahun|dari|sampai)|$)/i', $message, $matches)) {
            $result['params']['poli'] = trim($matches[1]);
        }

        // Status bayar
        if (preg_match('/(sudah\s*bayar|belum\s*bayar|lunas|dibayar)/i', $message, $matches)) {
            $status = strtolower($matches[1]);
            if (strpos($status, 'sudah') !== false || strpos($status, 'lunas') !== false || strpos($status, 'dibayar') !== false) {
                $result['params']['status_bayar'] = 'Sudah Bayar';
            } else {
                $result['params']['status_bayar'] = 'Belum Bayar';
            }
        }

        // Determine main intent
        if (preg_match('/(per\s*asuransi|per\s*penjamin|per\s*jaminan|breakdown\s*asuransi|breakdown\s*penjamin|group.*asuransi|group.*penjamin)/i', $message_lower)) {
            $result['intent'] = 'report_by_penjamin';
        } elseif (preg_match('/(tampilkan|tampil|lihat|show|cari|data|laporan|kunjungan|pasien)/i', $message_lower)) {
            $result['intent'] = 'show_report';
        } elseif (preg_match('/(berapa|jumlah|total|count|hitung)/i', $message_lower)) {
            $result['intent'] = 'count';
        } elseif (preg_match('/(export|download|unduh|excel|pdf)/i', $message_lower)) {
            $result['intent'] = 'export';
        }

        return $result;
    }

    /**
     * Extract date range from regex matches
     */
    private function extract_date_range($matches)
    {
        $months = [
            'januari' => '01',
            'jan' => '01',
            'februari' => '02',
            'feb' => '02',
            'maret' => '03',
            'mar' => '03',
            'april' => '04',
            'apr' => '04',
            'mei' => '05',
            'juni' => '06',
            'jun' => '06',
            'juli' => '07',
            'jul' => '07',
            'agustus' => '08',
            'agu' => '08',
            'ags' => '08',
            'september' => '09',
            'sep' => '09',
            'sept' => '09',
            'oktober' => '10',
            'okt' => '10',
            'oct' => '10',
            'november' => '11',
            'nov' => '11',
            'desember' => '12',
            'des' => '12',
            'dec' => '12'
        ];

        if (count($matches) == 7) {
            // Format: dari tanggal X bulan tahun sampai Y bulan tahun
            $start_month = $months[strtolower($matches[2])] ?? '01';
            $end_month = $months[strtolower($matches[5])] ?? '12';

            return [
                'start' => sprintf('%s-%s-%02d', $matches[3], $start_month, $matches[1]),
                'end' => sprintf('%s-%s-%02d', $matches[6], $end_month, $matches[4])
            ];
        } elseif (count($matches) == 5) {
            // Format: tanggal X - Y bulan tahun
            $month = $months[strtolower($matches[3])] ?? '01';

            return [
                'start' => sprintf('%s-%s-%02d', $matches[4], $month, $matches[1]),
                'end' => sprintf('%s-%s-%02d', $matches[4], $month, $matches[2])
            ];
        } elseif (count($matches) == 3) {
            // Format: bulan tahun (full month)
            $month = $months[strtolower($matches[1])] ?? '01';
            $year = $matches[2];
            $last_day = date('t', strtotime("$year-$month-01"));

            return [
                'start' => "$year-$month-01",
                'end' => "$year-$month-$last_day"
            ];
        }

        return null;
    }

    /**
     * Generate response based on parsed intent
     */
    private function generate_response($parsed, $user_name)
    {
        switch ($parsed['intent']) {
            case 'greeting':
                return [
                    'success' => true,
                    'type' => 'text',
                    'message' => "Halo {$user_name}! 👋 Selamat datang di Laporan Rekam Medis Rawat Jalan. Ada yang bisa saya bantu?",
                    'suggestions' => [
                        'Tampilkan laporan hari ini',
                        'Tampilkan laporan bulan ini',
                        'Berapa jumlah pasien hari ini?',
                        'Bantuan'
                    ]
                ];

            case 'help':
                return [
                    'success' => true,
                    'type' => 'text',
                    'message' => "Berikut beberapa contoh yang bisa Anda gunakan:\n\n" .
                        "📊 **Laporan Umum:**\n" .
                        "• Tampilkan laporan hari ini\n" .
                        "• Tampilkan laporan bulan ini\n" .
                        "• Tampilkan laporan dari 1 Januari 2024 sampai 31 Maret 2024\n\n" .
                        "🔍 **Filter Spesifik:**\n" .
                        "• Tampilkan pasien dokter Ahmad\n" .
                        "• Tampilkan pasien BPJS bulan ini\n" .
                        "• Tampilkan pasien poli anak hari ini\n" .
                        "• Pasien dr Reza\n\n" .
                        "📈 **Laporan Per Asuransi:**\n" .
                        "• Laporan per asuransi hari ini\n" .
                        "• Breakdown penjamin bulan ini\n" .
                        "• Per penjamin minggu ini\n\n" .
                        "📊 **Statistik:**\n" .
                        "• Berapa jumlah pasien hari ini?\n" .
                        "• Berapa pasien BPJS minggu ini?\n\n" .
                        "💾 **Export:**\n" .
                        "• Export ke Excel\n" .
                        "• Download PDF",
                    'suggestions' => [
                        'Tampilkan laporan hari ini',
                        'Laporan per asuransi',
                        'Berapa pasien bulan ini?',
                        'Tampilkan pasien BPJS'
                    ]
                ];

            case 'show_report':
                return $this->get_report_data($parsed['params'], $user_name);

            case 'report_by_penjamin':
                return $this->get_report_by_penjamin($parsed['params'], $user_name);

            case 'count':
                return $this->get_count_data($parsed['params'], $user_name);

            case 'export':
                return $this->handle_export($parsed['params']);

            default:
                return [
                    'success' => true,
                    'type' => 'text',
                    'message' => "Maaf, saya belum mengerti maksud Anda. Coba ketik **'bantuan'** untuk melihat contoh perintah yang bisa digunakan.",
                    'suggestions' => [
                        'Bantuan',
                        'Tampilkan laporan hari ini',
                        'Berapa pasien bulan ini?'
                    ]
                ];
        }
    }

    /**
     * Get report data based on parameters
     */
    private function get_report_data($params, $user_name)
    {
        $filters = $this->build_filters($params);
        $data = $this->LaporanRekamMedisRawaJalan_model->get_laporan($filters);

        $count = count($data);

        // Build filter description
        $filter_desc = $this->build_filter_description($filters);

        if ($count == 0) {
            return [
                'success' => true,
                'type' => 'text',
                'message' => "Tidak ada data ditemukan {$filter_desc}. Coba ubah filter atau periode waktu Anda.",
                'suggestions' => [
                    'Tampilkan semua data bulan ini',
                    'Bantuan'
                ]
            ];
        }

        return [
            'success' => true,
            'type' => 'table',
            'message' => "Saya menemukan **{$count} kunjungan** {$filter_desc}. Berikut datanya:",
            'data' => $data,
            'count' => $count,
            'filters' => $filters,
            'suggestions' => [
                'Export ke Excel',
                'Berapa total pasien?',
                'Filter per dokter'
            ]
        ];
    }

    /**
     * Get report data grouped by penjamin
     */
    private function get_report_by_penjamin($params, $user_name)
    {
        $filters = $this->build_filters($params);
        $stats = $this->LaporanRekamMedisRawaJalan_model->get_statistics($filters);

        $filter_desc = $this->build_filter_description($filters);

        if (empty($stats['by_penjamin'])) {
            return [
                'success' => true,
                'type' => 'text',
                'message' => "Tidak ada data ditemukan {$filter_desc}.",
                'suggestions' => [
                    'Tampilkan semua data bulan ini',
                    'Bantuan'
                ]
            ];
        }

        // Calculate total
        $total = 0;
        foreach ($stats['by_penjamin'] as $stat) {
            $total += $stat['jumlah'];
        }

        // Build detailed message
        $message = "📊 **Laporan Kunjungan Per Asuransi/Penjamin** {$filter_desc}:\n\n";
        $message .= "**Total Kunjungan: {$total} pasien**\n\n";
        $message .= "**Breakdown Per Penjamin:**\n";

        foreach ($stats['by_penjamin'] as $stat) {
            $percentage = round(($stat['jumlah'] / $total) * 100, 1);
            $bar = str_repeat('█', min(20, (int) ($percentage / 5)));
            $message .= "• **{$stat['png_jawab']}**: {$stat['jumlah']} pasien ({$percentage}%)\n";
            $message .= "  {$bar}\n";
        }

        return [
            'success' => true,
            'type' => 'text',
            'message' => $message,
            'stats' => $stats,
            'total' => $total,
            'suggestions' => [
                'Tampilkan detail per penjamin',
                'Export ke Excel',
                'Lihat statistik dokter'
            ]
        ];
    }

    /**
     * Get count data
     */
    private function get_count_data($params, $user_name)
    {
        $filters = $this->build_filters($params);
        $count = $this->LaporanRekamMedisRawaJalan_model->get_count($filters);

        $filter_desc = $this->build_filter_description($filters);

        // Get additional statistics
        $stats = $this->LaporanRekamMedisRawaJalan_model->get_statistics($filters);

        $message = "📊 **Statistik Kunjungan** {$filter_desc}:\n\n";
        $message .= "• Total Kunjungan: **{$count} pasien**\n";

        if (!empty($stats['by_penjamin'])) {
            $message .= "\n**Per Penjamin:**\n";
            foreach ($stats['by_penjamin'] as $stat) {
                $message .= "• {$stat['png_jawab']}: {$stat['jumlah']} pasien\n";
            }
        }

        if (!empty($stats['by_dokter'])) {
            $message .= "\n**Per Dokter:**\n";
            $top_doctors = array_slice($stats['by_dokter'], 0, 5);
            foreach ($top_doctors as $stat) {
                $message .= "• {$stat['nm_dokter']}: {$stat['jumlah']} pasien\n";
            }
        }

        return [
            'success' => true,
            'type' => 'text',
            'message' => $message,
            'count' => $count,
            'stats' => $stats,
            'suggestions' => [
                'Tampilkan detail laporan',
                'Export ke Excel'
            ]
        ];
    }

    /**
     * Handle export request
     */
    private function handle_export($params)
    {
        return [
            'success' => true,
            'type' => 'export',
            'message' => "Pilih format export yang Anda inginkan:",
            'suggestions' => []
        ];
    }

    /**
     * Build filters array from params
     */
    private function build_filters($params)
    {
        $filters = [];

        if (isset($params['date_range'])) {
            $filters['start_date'] = $params['date_range']['start'];
            $filters['end_date'] = $params['date_range']['end'];
        }

        if (isset($params['dokter'])) {
            $filters['dokter'] = $params['dokter'];
        }

        if (isset($params['penjamin'])) {
            $filters['penjamin'] = $params['penjamin'];
        }

        if (isset($params['poli'])) {
            $filters['poli'] = $params['poli'];
        }

        if (isset($params['status_bayar'])) {
            $filters['status_bayar'] = $params['status_bayar'];
        }

        return $filters;
    }

    /**
     * Build human-readable filter description
     */
    private function build_filter_description($filters)
    {
        $parts = [];

        if (isset($filters['start_date']) && isset($filters['end_date'])) {
            if ($filters['start_date'] == $filters['end_date']) {
                if ($filters['start_date'] == date('Y-m-d')) {
                    $parts[] = "hari ini";
                } else {
                    $parts[] = "tanggal " . date('d F Y', strtotime($filters['start_date']));
                }
            } else {
                $parts[] = "periode " . date('d F Y', strtotime($filters['start_date'])) .
                    " - " . date('d F Y', strtotime($filters['end_date']));
            }
        }

        if (isset($filters['dokter'])) {
            $parts[] = "dokter " . $filters['dokter'];
        }

        if (isset($filters['penjamin'])) {
            $parts[] = "penjamin " . $filters['penjamin'];
        }

        if (isset($filters['poli'])) {
            $parts[] = "poli " . $filters['poli'];
        }

        if (isset($filters['status_bayar'])) {
            $parts[] = strtolower($filters['status_bayar']);
        }

        return !empty($parts) ? implode(', ', $parts) : 'semua data';
    }

    /**
     * Export to Excel (PhpSpreadsheet for professional output)
     */
    public function export_excel()
    {
        try {
            $filters = $this->input->post('filters');
            if (is_string($filters)) {
                $filters = json_decode($filters, true);
            }

            $data = $this->LaporanRekamMedisRawaJalan_model->get_laporan($filters);
            $filter_desc = $this->build_filter_description($filters);

            // Get hospital info
            $setting = $this->db->query("SELECT nama_instansi, alamat_instansi, kabupaten, propinsi, kontak, email FROM setting LIMIT 1")->row();

            // Generate dynamic title
            $title_parts = ['Laporan Rekam Medis Rawat Jalan'];
            if (isset($filters['penjamin']) && !empty($filters['penjamin'])) {
                $title_parts[] = 'Penjamin ' . $filters['penjamin'];
            }
            if (isset($filters['dokter']) && !empty($filters['dokter'])) {
                $title_parts[] = 'Dokter ' . $filters['dokter'];
            }
            if (isset($filters['poli']) && !empty($filters['poli'])) {
                $title_parts[] = 'Poli ' . $filters['poli'];
            }
            $dynamic_title = implode(' - ', $title_parts);

            // Check if PhpSpreadsheet is available
            $autoload_path = FCPATH . 'vendor/autoload.php';
            if (!file_exists($autoload_path)) {
                throw new Exception('PhpSpreadsheet not installed');
            }

            require_once $autoload_path;

            $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();

            // Set document properties
            $spreadsheet->getProperties()
                ->setCreator($setting->nama_instansi ?? 'SIMRS')
                ->setTitle($dynamic_title)
                ->setSubject('Laporan Rekam Medis Rawat Jalan')
                ->setDescription('Export dari Laporan Chat System');

            $row = 1;

            // HEADER - Hospital Info (Merged)
            $sheet->mergeCells("A{$row}:O{$row}");
            $sheet->setCellValue("A{$row}", $setting->nama_instansi ?? 'RUMAH SAKIT');
            $sheet->getStyle("A{$row}")->getFont()->setBold(true)->setSize(14);
            $sheet->getStyle("A{$row}")->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $row++;

            $sheet->mergeCells("A{$row}:O{$row}");
            $sheet->setCellValue("A{$row}", ($setting->alamat_instansi ?? '') . ', ' . ($setting->kabupaten ?? '') . ', ' . ($setting->propinsi ?? ''));
            $sheet->getStyle("A{$row}")->getFont()->setSize(10);
            $sheet->getStyle("A{$row}")->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $row++;

            $sheet->mergeCells("A{$row}:O{$row}");
            $sheet->setCellValue("A{$row}", 'Telp: ' . ($setting->kontak ?? '-') . ' | Email: ' . ($setting->email ?? '-'));
            $sheet->getStyle("A{$row}")->getFont()->setSize(9);
            $sheet->getStyle("A{$row}")->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $row++;

            $row++; // Empty row

            // TITLE
            $sheet->mergeCells("A{$row}:O{$row}");
            $sheet->setCellValue("A{$row}", strtoupper($dynamic_title));
            $sheet->getStyle("A{$row}")->getFont()->setBold(true)->setSize(12);
            $sheet->getStyle("A{$row}")->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $row++;

            $row++; // Empty row

            // SUMMARY
            $sheet->setCellValue("A{$row}", 'Total Kunjungan:');
            $sheet->setCellValue("B{$row}", count($data) . ' pasien');
            $sheet->setCellValue("D{$row}", 'Filter:');
            $sheet->setCellValue("E{$row}", $filter_desc ?: 'Semua data');
            $sheet->getStyle("A{$row}:E{$row}")->getFont()->setBold(true);
            $row++;

            $sheet->setCellValue("A{$row}", 'Dicetak oleh:');
            $sheet->setCellValue("B{$row}", $this->session->userdata('nama') ?? 'User');
            $sheet->setCellValue("D{$row}", 'Tanggal Cetak:');
            $sheet->setCellValue("E{$row}", date('d F Y, H:i') . ' WIB');
            $row++;

            $row++; // Empty row

            // TABLE HEADER
            $headers = [
                'No.',
                'No. Rawat',
                'No. RM',
                'Nama Pasien',
                'JK',
                'Tgl Lahir',
                'Alamat',
                'No. Telp',
                'Dokter',
                'Poli',
                'Penjamin',
                'Tgl Registrasi',
                'Jam',
                'Status Bayar',
                'Status'
            ];
            $col = 'A';
            foreach ($headers as $header) {
                $sheet->setCellValue($col . $row, $header);
                $col++;
            }

            // Style header
            $headerStyle = $sheet->getStyle("A{$row}:O{$row}");
            $headerStyle->getFont()->setBold(true)->setColor(new \PhpOffice\PhpSpreadsheet\Style\Color(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE));
            $headerStyle->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FF333333');
            $headerStyle->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $headerStyle->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
            $row++;

            // DATA ROWS
            $no = 1;
            foreach ($data as $item) {
                $sheet->setCellValue("A{$row}", $no++);
                $sheet->setCellValue("B{$row}", $item['no_rawat']);
                $sheet->setCellValue("C{$row}", $item['no_rkm_medis']);
                $sheet->setCellValue("D{$row}", $item['nm_pasien']);
                $sheet->setCellValue("E{$row}", $item['jk']);
                $sheet->setCellValue("F{$row}", $item['tgl_lahir']);
                $sheet->setCellValue("G{$row}", $item['alamat']);
                $sheet->setCellValue("H{$row}", $item['no_tlp']);
                $sheet->setCellValue("I{$row}", $item['nm_dokter']);
                $sheet->setCellValue("J{$row}", $item['nm_poli']);
                $sheet->setCellValue("K{$row}", $item['png_jawab']);
                $sheet->setCellValue("L{$row}", date('d/m/Y', strtotime($item['tgl_registrasi'])));
                $sheet->setCellValue("M{$row}", $item['jam_reg']);
                $sheet->setCellValue("N{$row}", $item['status_bayar']);
                $sheet->setCellValue("O{$row}", $item['stts']);

                // Style data rows
                $sheet->getStyle("A{$row}:O{$row}")->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

                // Zebra striping
                if ($no % 2 == 0) {
                    $sheet->getStyle("A{$row}:O{$row}")->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FFF9F9F9');
                }

                $row++;
            }

            // Auto-size columns
            foreach (range('A', 'O') as $col) {
                $sheet->getColumnDimension($col)->setAutoSize(true);
            }

            // Output
            $filename = 'Laporan_Rekam_Medis_' . date('YmdHis') . '.xlsx';

            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="' . $filename . '"');
            header('Cache-Control: max-age=0');

            $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
            $writer->save('php://output');
            exit;

        } catch (Exception $e) {
            // Fallback to CSV if PhpSpreadsheet fails
            log_message('error', 'Excel Export Error: ' . $e->getMessage());

            $filters = $this->input->post('filters');
            if (is_string($filters)) {
                $filters = json_decode($filters, true);
            }

            $data = $this->LaporanRekamMedisRawaJalan_model->get_laporan($filters);

            $filename = 'Laporan_Rekam_Medis_' . date('YmdHis') . '.csv';
            header('Content-Type: text/csv; charset=utf-8');
            header('Content-Disposition: attachment; filename="' . $filename . '"');
            header('Cache-Control: max-age=0');

            $output = fopen('php://output', 'w');
            fprintf($output, chr(0xEF) . chr(0xBB) . chr(0xBF)); // BOM

            // Header
            fputcsv($output, [
                'No.',
                'No. Rawat',
                'No. RM',
                'Nama Pasien',
                'JK',
                'Tgl Lahir',
                'Alamat',
                'No. Telp',
                'Dokter',
                'Poli',
                'Penjamin',
                'Tgl Registrasi',
                'Jam',
                'Status Bayar',
                'Status'
            ]);

            // Data
            $no = 1;
            foreach ($data as $row) {
                fputcsv($output, [
                    $no++,
                    $row['no_rawat'],
                    $row['no_rkm_medis'],
                    $row['nm_pasien'],
                    $row['jk'],
                    $row['tgl_lahir'],
                    $row['alamat'],
                    $row['no_tlp'],
                    $row['nm_dokter'],
                    $row['nm_poli'],
                    $row['png_jawab'],
                    $row['tgl_registrasi'],
                    $row['jam_reg'],
                    $row['status_bayar'],
                    $row['stts']
                ]);
            }

            fclose($output);
            exit;
        }
    }

    /**
     * Get list of doctors for autocomplete
     */
    public function get_doctors()
    {
        $this->output->set_content_type('application/json');
        $search = $this->input->get('q');

        $doctors = $this->LaporanRekamMedisRawaJalan_model->get_doctors($search);

        echo json_encode($doctors);
    }

    /**
     * Get list of penjamin for autocomplete
     */
    public function get_penjamin()
    {
        $this->output->set_content_type('application/json');
        $penjamin = $this->LaporanRekamMedisRawaJalan_model->get_penjamin();

        echo json_encode($penjamin);
    }

    /**
     * Get list of poli for autocomplete
     */
    public function get_poli()
    {
        $this->output->set_content_type('application/json');
        $poli = $this->LaporanRekamMedisRawaJalan_model->get_poli();

        echo json_encode($poli);
    }

    /**
     * Export to PDF
     */
    public function export_pdf()
    {
        try {
            // Increase memory limit and execution time
            ini_set('memory_limit', '256M');
            ini_set('max_execution_time', '300');

            // Get filters from POST
            $filters_json = $this->input->post('filters');
            $filters = json_decode($filters_json, true);

            // Get data
            $data_result = $this->LaporanRekamMedisRawaJalan_model->get_data($filters);
            $filter_desc = $this->build_filter_description($filters);

            // Limit data to prevent memory issues
            if (count($data_result) > 1000) {
                $data_result = array_slice($data_result, 0, 1000);
            }

            // Get hospital info from setting table
            $setting = $this->db->query("SELECT nama_instansi, alamat_instansi, kabupaten, propinsi, kontak, email, logo FROM setting LIMIT 1")->row();

            // Generate dynamic title based on filters
            $title_parts = ['Laporan Rekam Medis Rawat Jalan'];

            if (isset($filters['penjamin']) && !empty($filters['penjamin'])) {
                $title_parts[] = 'Penjamin ' . $filters['penjamin'];
            }

            if (isset($filters['dokter']) && !empty($filters['dokter'])) {
                $title_parts[] = 'Dokter ' . $filters['dokter'];
            }

            if (isset($filters['poli']) && !empty($filters['poli'])) {
                $title_parts[] = 'Poli ' . $filters['poli'];
            }

            $dynamic_title = implode(' - ', $title_parts);

            // Load mPDF library
            require_once FCPATH . 'vendor/autoload.php';

            // Create mPDF instance
            $mpdf = new \Mpdf\Mpdf([
                'mode' => 'utf-8',
                'format' => 'A4-L', // Landscape
                'margin_left' => 10,
                'margin_right' => 10,
                'margin_top' => 10,  // Dikurangi dari 45 ke 10
                'margin_bottom' => 15,
                'margin_header' => 0,  // Tidak pakai header mPDF
                'margin_footer' => 10
            ]);

            // Set document properties
            $mpdf->SetTitle($dynamic_title);
            $mpdf->SetAuthor($setting->nama_instansi ?? 'SIMRS Moiz Hospital');
            $mpdf->SetCreator('Laporan Chat System');

            // JANGAN pakai SetHTMLHeader - header sudah di view
            // Header akan di-render dari view template saja

            // Footer
            $footer = '
        <table width="100%" style="border-top: 1px solid #ddd; padding-top: 5px; font-size: 9px;">
            <tr>
                <td width="33%">' . ($setting->nama_instansi ?? 'SIMRS Moiz Hospital') . '</td>
                <td width="33%" style="text-align: center;">Halaman {PAGENO} dari {nbpg}</td>
                <td width="33%" style="text-align: right;">Dicetak: ' . date('d/m/Y H:i') . '</td>
            </tr>
        </table>
        ';

            $mpdf->SetHTMLFooter($footer);

            // Prepare data for view (SAMA DENGAN print_layout.php)
            $total_records = count($data_result);

            // Get logo for view
            $logo_for_view = $this->getLogoDataUri($setting);

            $view_data = [
                'data_result' => $data_result,
                'total_records' => $total_records,
                'filter_desc' => $filter_desc,
                'user_name' => $this->session->userdata('nama') ?? 'User',
                // Hospital info (matching print_layout.php)
                'hospital_logo' => $logo_for_view,
                'hospital_name' => $setting->nama_instansi ?? 'RUMAH SAKIT',
                'hospital_address' => ($setting->alamat_instansi ?? '') . ', ' . ($setting->kabupaten ?? '') . ', ' . ($setting->propinsi ?? ''),
                'hospital_contact' => 'Telp: ' . ($setting->kontak ?? '-') . ' | Email: ' . ($setting->email ?? '-'),
                'report_title' => $dynamic_title
            ];

            // Render HTML from view (TIRU DARI ASSESSMENT PDF)
            $html = $this->load->view('laporan/pdf_rekam_medis_rawat_jalan', $view_data, true);

            // Write HTML to PDF
            $mpdf->WriteHTML($html);

            // Output PDF
            $filename = 'Laporan_Rekam_Medis_' . date('YmdHis') . '.pdf';
            $mpdf->Output($filename, 'D'); // D = Download

        } catch (Exception $e) {
            // Log error
            log_message('error', 'PDF Export Error: ' . $e->getMessage());

            // Show user-friendly error
            echo '<!DOCTYPE html>
            <html>
            <head>
                <title>Error</title>
                <style>
                    body { font-family: Arial; padding: 50px; text-align: center; }
                    .error { background: #f8d7da; color: #721c24; padding: 20px; border-radius: 5px; display: inline-block; }
                    .btn { background: #667eea; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; display: inline-block; margin-top: 20px; }
                </style>
            </head>
            <body>
                <div class="error">
                    <h2>❌ Gagal Generate PDF</h2>
                    <p>Terjadi kesalahan saat membuat PDF.</p>
                    <p><small>Error: ' . htmlspecialchars($e->getMessage()) . '</small></p>
                </div>
                <br>
                <a href="javascript:history.back()" class="btn">← Kembali</a>
            </body>
            </html>';
        }
    }

    /**
     * Helper function untuk handle logo - SAMA SEPERTI SOAP & AWAL MEDIS
     */
    private function getLogoDataUri($setting)
    {
        if (empty($setting->logo)) {
            return '';
        }

        // Simple & works - sama seperti Awal Medis Penyakit Dalam
        return 'data:image/jpeg;base64,' . base64_encode($setting->logo);
    }

    /**
     * Buat logo placeholder
     */
    private function createLogoPlaceholder()
    {
        return 'data:image/svg+xml;base64,' . base64_encode('
            <svg width="50" height="35" xmlns="http://www.w3.org/2000/svg">
                <rect width="50" height="35" fill="#f8f9fa" stroke="#dee2e6"/>
                <text x="25" y="20" font-family="Arial" font-size="10" text-anchor="middle" fill="#6c757d">LOGO</text>
            </svg>
        ');
    }
}

