<?php
/**
 * Test BPJS Signature Generation
 */

// BPJS Credentials
$cons_id = '15174';
$secret_key = 'Evyxzqk0clxv';

echo "<h2>🔐 Testing BPJS Signature Generation</h2>";
echo "<hr>";

// Method 1: Simple time()
echo "<h3>Method 1: Simple time()</h3>";
$timestamp1 = strval(time());
$data1 = $cons_id . '&' . $timestamp1;
$signature1 = base64_encode(hash_hmac('sha256', $data1, $secret_key, true));

echo "<pre>";
echo "Timestamp: " . $timestamp1 . "\n";
echo "Data: " . $data1 . "\n";
echo "Signature: " . $signature1 . "\n";
echo "</pre>";

// Method 2: BPJS Documentation (with UTC)
echo "<h3>Method 2: BPJS Documentation (UTC)</h3>";
date_default_timezone_set('UTC');
$timestamp2 = strval(time() - strtotime('1970-01-01 00:00:00'));
$data2 = $cons_id . '&' . $timestamp2;
$signature2 = base64_encode(hash_hmac('sha256', $data2, $secret_key, true));

echo "<pre>";
echo "Timestamp: " . $timestamp2 . "\n";
echo "Data: " . $data2 . "\n";
echo "Signature: " . $signature2 . "\n";
echo "</pre>";

// Method 3: Your working Postman timestamp
echo "<h3>Method 3: Your Working Postman Example</h3>";
$timestamp3 = '1765793653'; // From your working curl
$data3 = $cons_id . '&' . $timestamp3;
$signature3 = base64_encode(hash_hmac('sha256', $data3, $secret_key, true));

echo "<pre>";
echo "Timestamp: " . $timestamp3 . "\n";
echo "Data: " . $data3 . "\n";
echo "Signature: " . $signature3 . "\n";
echo "Expected: lIKJxHd6jhFwR5zeLId3uCKlVujFKg5/sUyu8FYtslo=\n";
echo "Match: " . ($signature3 === 'lIKJxHd6jhFwR5zeLId3uCKlVujFKg5/sUyu8FYtslo=' ? '✅ YES' : '❌ NO') . "\n";
echo "</pre>";

// Test current time in different timezones
echo "<h3>Timezone Tests</h3>";
echo "<pre>";

// Asia/Jakarta
date_default_timezone_set('Asia/Jakarta');
$time_jkt = time();
$ts_jkt = strval($time_jkt - strtotime('1970-01-01 00:00:00'));
echo "Asia/Jakarta:\n";
echo "  time(): " . $time_jkt . "\n";
echo "  timestamp: " . $ts_jkt . "\n\n";

// UTC
date_default_timezone_set('UTC');
$time_utc = time();
$ts_utc = strval($time_utc - strtotime('1970-01-01 00:00:00'));
echo "UTC:\n";
echo "  time(): " . $time_utc . "\n";
echo "  timestamp: " . $ts_utc . "\n\n";

echo "Difference: " . ($ts_jkt - $ts_utc) . " seconds\n";
echo "</pre>";

// Generate fresh signature for testing
echo "<hr>";
echo "<h3>🚀 Fresh Signature for Testing NOW</h3>";
date_default_timezone_set('UTC');
$fresh_timestamp = strval(time() - strtotime('1970-01-01 00:00:00'));
$fresh_data = $cons_id . '&' . $fresh_timestamp;
$fresh_signature = base64_encode(hash_hmac('sha256', $fresh_data, $secret_key, true));

echo "<pre>";
echo "Use these values in Postman:\n\n";
echo "X-cons-id: " . $cons_id . "\n";
echo "X-timestamp: " . $fresh_timestamp . "\n";
echo "X-signature: " . $fresh_signature . "\n";
echo "user_key: 3c09584911b4b1c67588063351952cc1\n";
echo "</pre>";

echo "<p><strong>Copy the values above and test in Postman to verify if signature is correct!</strong></p>";
?>