<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CheckLogo extends CI_Controller
{

    public function index()
    {
        // Get setting data
        $setting = $this->db->query("SELECT nama_instansi, logo FROM setting LIMIT 1")->row();

        echo "<html><head><title>Logo Check</title></head><body>";
        echo "<h2>Setting Info:</h2>";

        if ($setting) {
            echo "<p><strong>Nama Instansi:</strong> " . htmlspecialchars($setting->nama_instansi) . "</p>";

            $logo = $setting->logo;

            if (empty($logo)) {
                echo "<p><strong>Logo:</strong> <span style='color:red'>KOSONG / NULL</span></p>";
            } else {
                echo "<p><strong>Logo Length:</strong> " . strlen($logo) . " characters</p>";
                echo "<p><strong>Logo Preview (first 200 chars):</strong><br><code>" . htmlspecialchars(substr($logo, 0, 200)) . "...</code></p>";

                // Check if it's base64
                $decoded = @base64_decode($logo, true);
                if ($decoded !== false && strlen($decoded) > 0) {
                    echo "<p><strong>Base64 Valid:</strong> <span style='color:green'>YES</span></p>";
                    echo "<p><strong>Decoded Size:</strong> " . strlen($decoded) . " bytes (" . round(strlen($decoded) / 1024, 2) . " KB)</p>";

                    // Try to detect image type
                    $finfo = new finfo(FILEINFO_MIME_TYPE);
                    $mime = $finfo->buffer($decoded);
                    echo "<p><strong>MIME Type:</strong> " . $mime . "</p>";

                    // Show image
                    echo "<h3>Logo Preview:</h3>";
                    echo "<img src='data:" . $mime . ";base64," . $logo . "' style='max-width: 300px; border: 1px solid #ccc; padding: 10px;'>";

                    // Test in PDF context
                    echo "<h3>Test in mPDF:</h3>";
                    try {
                        require_once FCPATH . 'vendor/autoload.php';
                        $mpdf = new \Mpdf\Mpdf(['format' => 'A4']);
                        $html = '<h1>Logo Test</h1><img src="data:' . $mime . ';base64,' . $logo . '" style="height: 50px;">';
                        $mpdf->WriteHTML($html);
                        $mpdf->Output('test_logo.pdf', 'I');
                    } catch (Exception $e) {
                        echo "<p style='color:red'>mPDF Error: " . $e->getMessage() . "</p>";
                    }

                } else {
                    echo "<p><strong>Base64 Valid:</strong> <span style='color:red'>NO</span></p>";
                    echo "<p>Logo might be a file path or invalid format</p>";

                    // Check if it's a file path
                    if (strpos($logo, '/') !== false || strpos($logo, '\\') !== false) {
                        echo "<p><strong>Looks like file path:</strong> " . htmlspecialchars($logo) . "</p>";
                        $file_path = FCPATH . ltrim($logo, '/\\');
                        if (file_exists($file_path)) {
                            echo "<p style='color:green'>File exists at: " . $file_path . "</p>";
                            echo "<img src='" . base_url($logo) . "' style='max-width: 300px;'>";
                        } else {
                            echo "<p style='color:red'>File NOT found at: " . $file_path . "</p>";
                        }
                    }
                }
            }
        } else {
            echo "<p style='color:red'>No data found in setting table</p>";
        }

        echo "</body></html>";
    }
}
