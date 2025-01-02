<?php
$servername = "mysql"; // Hostname sesuai dengan nama service di docker compose
$username = "finaufal"; // Username database
$password = "finaufal"; // Password database
$dbname = "manajemenhotel"; //nama database

// Membuat koneksi ke database
$conn = new mysqli($servername, $username, $password, $dbname);

// Mengecek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Memproses data jika method adalah POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validasi Data Input
    $name = isset($_POST['nama hotel']) ? $_POST['nama hotel'] : '';
    $location = isset($_POST['lokasi']) ? $_POST['lokasi'] : '';
    $star_hotel = isset($_POST['bintang']) ?$_POST['bintang'] : '';
    $price = isset($_POST['harga']) ?$_POST['harga'] : '';

    if (!empty($name) && !empty($location) &&  !empty($star_hotel) && !empty($price)) { 
        //Prepared Statement untuk Keamanan
        $sttmnt = $conn->prepare("INSERT INTO users (nama hotel, lokasi, bintang, harga) VALUES (?, ?, ?, ?)");
        $sttmnt->bind_param("ssii", $name, $location, $star_hotel, $price);

        if ($sttmnt->execute()) {
            echo "Data berhasil disimpan!!";
        } else {
            echo "Error: " . $sttmnt->error;
        }

        $sttmnt->close();
    } else {
        echo "Semua data harus diisi!!";
    }
}

// Menutup koneksi
$conn->close();
?>
