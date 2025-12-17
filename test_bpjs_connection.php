<?php
/**
 * Test BPJS Connection
 * Simple script to test BPJS API connection
 */

// BPJS Credentials (from your config)
$cons_id = '15174';
$secret_key = 'Evyxzqk0clxv';
$user_key = '3c09584918d4b1c6e75886b33519b2cc1';
$base_url = 'https://apijkn-dev.bpjs-kesehatan.go.id/vclaim-rest-dev';

// Endpoint to test
$endpoint = '/referensi/poli';
$url = $base_url . $endpoint;

// Generate timestamp
$timestamp = strval(time());

// Generate signature
$signature = hash_hmac('sha256', $cons_id . '&' . $timestamp, $secret_key, true);
$signature = base64_encode($signature);

// Setup headers
$headers = [
    'X-cons-id: ' . $cons_id,
    'X-timestamp: ' . $timestamp,
    'X-signature: ' . $signature,
    'user_key: ' . $user_key,
    'Content-Type: application/json'
];

// Initialize cURL
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_TIMEOUT, 30);

// Execute request
echo "<h2>🔍 Testing BPJS VClaim Connection</h2>";
echo "<hr>";
echo "<h3>Request Info:</h3>";
echo "<pre>";
echo "URL: " . $url . "\n";
echo "Cons ID: " . $cons_id . "\n";
echo "Timestamp: " . $timestamp . "\n";
echo "Signature: " . $signature . "\n";
echo "</pre>";

echo "<h3>Response:</h3>";
echo "<pre>";

$response = curl_exec($ch);
$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$error = curl_error($ch);

curl_close($ch);

if ($error) {
    echo "❌ ERROR: " . $error . "\n";
} else {
    echo "HTTP Code: " . $http_code . "\n\n";

    $result = json_decode($response, true);

    if ($result) {
        echo "✅ Response received!\n\n";
        echo "Metadata:\n";
        echo "  Code: " . ($result['metaData']['code'] ?? 'N/A') . "\n";
        echo "  Message: " . ($result['metaData']['message'] ?? 'N/A') . "\n\n";

        if (isset($result['response']['list'])) {
            echo "Data Poli BPJS:\n";
            echo "  Total: " . count($result['response']['list']) . " poli\n\n";

            echo "Sample (5 poli pertama):\n";
            foreach (array_slice($result['response']['list'], 0, 5) as $poli) {
                echo "  - [" . $poli['kode'] . "] " . $poli['nama'] . "\n";
            }
        }

        echo "\n\nFull Response:\n";
        echo json_encode($result, JSON_PRETTY_PRINT);
    } else {
        echo "❌ Invalid JSON response\n";
        echo "Raw response:\n" . $response;
    }
}

echo "</pre>";

echo "<hr>";
echo "<h3>Kesimpulan:</h3>";
if ($http_code == 200 && isset($result['metaData']['code']) && $result['metaData']['code'] == 200) {
    echo "<p style='color: green; font-weight: bold;'>✅ INTEGRASI BPJS BERHASIL!</p>";
    echo "<p>Credential valid dan koneksi ke BPJS API berhasil.</p>";
    echo "<p>Kamu bisa pakai fitur Sync Referensi di aplikasi.</p>";
} else {
    echo "<p style='color: red; font-weight: bold;'>❌ INTEGRASI BELUM BERHASIL</p>";
    echo "<p>Kemungkinan:</p>";
    echo "<ul>";
    echo "<li>Credential tidak valid (Cons ID, Secret Key, User Key salah)</li>";
    echo "<li>Environment development sudah expired</li>";
    echo "<li>Network/firewall blocking</li>";
    echo "</ul>";
}
?>