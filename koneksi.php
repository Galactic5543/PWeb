<?php
// Koneksi ke database
function getConnection() {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "showroom";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    return $conn;
}

// Fungsi untuk mendapatkan mobil terbaru
function getLatestMobil() {
    $conn = getConnection();
    $sql = "SELECT m.id_mobil, m.nama_mobil, m.tahun, m.warna, m.harga, m.gambar, m.deskripsi, k.nama_kategori
            FROM mobil m
            JOIN kategori_mobil k ON m.id_kategori = k.id_kategori
            ORDER BY m.id_mobil DESC LIMIT 1";
    $result = $conn->query($sql);
    $conn->close();
    return $result;
}

// Fungsi untuk mendapatkan semua kategori
function getAllKategori() {
    $conn = getConnection();
    $sql = "SELECT * FROM kategori_mobil";
    $result = $conn->query($sql);
    $conn->close();
    return $result;
}

// Fungsi untuk mendapatkan mobil berdasarkan kategori
function getMobilByKategori($id_kategori) {
    $conn = getConnection();
    $sql = "SELECT * FROM mobil WHERE id_kategori = ? ORDER BY id_mobil ASC";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_kategori);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
    $conn->close();
    return $result;
}
?>


<?php
// koneksi.php

function getMobilById($id_mobil) {
    $conn = getConnection(); // Menggunakan koneksi dari fungsi yang sudah ada
    $sql = "SELECT m.id_mobil, m.nama_mobil, m.tahun, m.warna, m.kondisi, m.harga, m.gambar, m.gambar1, m.gambar2, m.gambar3, m.deskripsi, m.transmisi, k.nama_kategori
            FROM mobil m
            JOIN kategori_mobil k ON m.id_kategori = k.id_kategori
            WHERE m.id_mobil = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_mobil);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
    $conn->close();
    return $result;
}
?>
