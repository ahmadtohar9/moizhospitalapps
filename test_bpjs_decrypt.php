<?php
/**
 * Test BPJS Decrypt
 * Test decryption of BPJS response
 */

// Sample encrypted response from BPJS
$encrypted_response = "Ji+23nYXE1J+nu74I1Y0JnlrllRRHBdZkpKdy1Uz3qGcG4G5e8dXRB8jKzmJZNfDQRiYlKxqeY1zFZ9T3IG+MlTfiIWOVeGPEXQyUsHXOpUl1QdabFvrClxhZkpQKmjy";

// BPJS Credentials
$cons_id = '15174';
$secret_key = 'Evyxzqk0clxv';
$timestamp = '1765793653'; // Use the same timestamp from request

// Decrypt function (from BPJS documentation)
function stringDecrypt($encrypted_string, $cons_id, $secret_key, $timestamp)
{
    // Key: consid + conspwd + timestamp (concatenate)
    $key = $cons_id . $secret_key . $timestamp;

    $encrypt_method = 'AES-256-CBC';

    // Hash key with SHA-256
    $key_hash = hex2bin(hash('sha256', $key));

    // IV - AES-256-CBC expects 16 bytes
    $iv = substr(hex2bin(hash('sha256', $key)), 0, 16);

    // Decrypt
    $output = openssl_decrypt(
        base64_decode($encrypted_string),
        $encrypt_method,
        $key_hash,
        OPENSSL_RAW_DATA,
        $iv
    );

    return $output;
}

// LZ-String decompress (simple check)
function decompress($string)
{
    // If it looks like JSON, return as is
    if (substr(trim($string), 0, 1) === '{' || substr(trim($string), 0, 1) === '[') {
        return $string;
    }

    // Otherwise, might need LZ-String library
    // For now, return as is
    return $string;
}

echo "<h2>🔓 Testing BPJS Decrypt</h2>";
echo "<hr>";

echo "<h3>Input:</h3>";
echo "<pre>";
echo "Encrypted: " . $encrypted_response . "\n";
echo "Cons ID: " . $cons_id . "\n";
echo "Secret Key: " . $secret_key . "\n";
echo "Timestamp: " . $timestamp . "\n";
echo "</pre>";

echo "<h3>Decryption Process:</h3>";
echo "<pre>";

// Step 1: Decrypt
echo "Step 1: AES-256-CBC Decryption\n";
$decrypted = stringDecrypt($encrypted_response, $cons_id, $secret_key, $timestamp);

if ($decrypted) {
    echo "✅ Decryption successful!\n";
    echo "Decrypted (raw): " . $decrypted . "\n\n";

    // Step 2: Decompress
    echo "Step 2: LZ-String Decompression\n";
    $decompressed = decompress($decrypted);
    echo "Decompressed: " . $decompressed . "\n\n";

    // Step 3: Parse JSON
    echo "Step 3: Parse JSON\n";
    $result = json_decode($decompressed, true);

    if ($result) {
        echo "✅ JSON parsing successful!\n\n";
        echo "Parsed Data:\n";
        print_r($result);
    } else {
        echo "❌ JSON parsing failed!\n";
        echo "JSON Error: " . json_last_error_msg() . "\n";
    }
} else {
    echo "❌ Decryption failed!\n";
    echo "OpenSSL Error: " . openssl_error_string() . "\n";
}

echo "</pre>";

echo "<hr>";
echo "<h3>Kesimpulan:</h3>";
if ($decrypted && $result) {
    echo "<p style='color: green; font-weight: bold;'>✅ DECRYPT BERHASIL!</p>";
    echo "<p>Response dari BPJS berhasil di-decrypt dan di-parse.</p>";
} else {
    echo "<p style='color: red; font-weight: bold;'>❌ DECRYPT GAGAL</p>";
    echo "<p>Kemungkinan:</p>";
    echo "<ul>";
    echo "<li>Timestamp tidak cocok (harus sama dengan saat request)</li>";
    echo "<li>Key decrypt salah</li>";
    echo "<li>Response perlu LZ-String decompression library</li>";
    echo "</ul>";
}
?>