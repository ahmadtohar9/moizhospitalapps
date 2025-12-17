<?php
// Raw PHP script to insert menu
$host = '127.0.0.1'; // Use IP to force TCP
$user = 'root';
$pass = 'moizhospital'; // Try empty first, but if failed I see user provided -pmoizhospital in previous attempts? 
// Wait, the user command `mysql -u root -pmoizhospital -D sik` FAILED with command not found, but it implied password `moizhospital`.
// However, `database.php` says password is empty ''. 
// I will try empty first, if fail, try `moizhospital`.
// Actually, looking at database.php line 11: 'password' => '',
// But user tried `-pmoizhospital`. Maybe they have a different local setup or just copy pasted?
// I'll try empty first as per config file.

$db = 'sik';

$mysqli = new mysqli($host, $user, '', $db);

if ($mysqli->connect_error) {
    // Try with password 'moizhospital' if empty failed
    $mysqli = new mysqli($host, $user, 'moizhospital', $db);
    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error . "\n");
    }
}

echo "Connected successfully to DB.\n";

// 1. Find Parent 'Pendaftaran'
$res = $mysqli->query("SELECT id FROM moizhospital_menus WHERE menu_name LIKE '%Pendaftaran%' LIMIT 1");
if ($res->num_rows == 0) {
    die("Parent 'Pendaftaran' not found.\n");
}
$row = $res->fetch_assoc();
$parent_id = $row['id'];
echo "Parent ID: $parent_id\n";

// 2. Check existence
$res = $mysqli->query("SELECT id FROM moizhospital_menus WHERE menu_name = 'Registrasi'");
if ($res->num_rows > 0) {
    echo "Menu 'Registrasi' already exists.\n";
} else {
    // 3. Insert
    $sql = "INSERT INTO moizhospital_menus (menu_name, menu_url, icon, parent_id, is_active, is_aksi_form) VALUES ('Registrasi', 'pendaftaran/reg_periksa', 'fa-pencil-square-o', $parent_id, 1, 0)";
    if ($mysqli->query($sql) === TRUE) {
        echo "Menu 'Registrasi' inserted successfully.\n";
    } else {
        echo "Error inserting menu: " . $mysqli->error . "\n";
    }
}

$mysqli->close();
?>