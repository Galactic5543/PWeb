<?php
// Sertakan koneksi
include('koneksi.php');

// Periksa apakah parameter 'id' ada
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id_mobil = $_GET['id'];

    // Panggil fungsi untuk mendapatkan data mobil
    $result = getMobilById($id_mobil);

    // Periksa apakah data ditemukan
    if ($result->num_rows > 0) {
        $mobil = $result->fetch_assoc();
    } else {
        echo "<p>Mobil tidak ditemukan.</p>";
        exit;
    }
} else {
    echo "<p>Parameter id tidak disediakan atau tidak valid.</p>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details Page</title>
    <script src="script.js"></script>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>

<body>

    <!-- Navbar -->
    <nav class="bg-nav navbar">
        <div class="logo" onclick="location.reload();">Putra Jaya Mobilindo</div>
        <ul>
            <li><a href="index.php#home">Home</a></li>
            <li><a href="index.php#garasi">Garasi</a></li>
            <li><a href="index.php#about">About</a></li>
        </ul>
    </nav>

    <!-- Product Display -->
    <div class="spacer-section1"></div>
    <div class="container spacer-section shadow-box">
        <div class="flex-box">
            <div>
                <div class="big-img">
                    <img src="<?php echo htmlspecialchars($mobil['gambar']); ?>"
                         alt="Gambar <?php echo htmlspecialchars($mobil['nama_mobil']); ?>">
                </div>

                <div class="images">
                    <!-- Gambar kecil yang akan mengganti gambar utama saat diklik -->
                    <div class="small-img">
                        <img src="<?php echo htmlspecialchars($mobil['gambar']); ?>" onclick="showImg(this.src)">
                    </div>
                    <div class="small-img">
                        <img src="<?php echo htmlspecialchars($mobil['gambar1']); ?>" onclick="showImg(this.src)">
                    </div>
                    <div class="small-img">
                        <img src="<?php echo htmlspecialchars($mobil['gambar2']); ?>" onclick="showImg(this.src)">
                    </div>
                    <div class="small-img">
                        <img src="<?php echo htmlspecialchars($mobil['gambar3']); ?>" onclick="showImg(this.src)">
                    </div>
                </div>
            </div>

            <div class="right">
                <div class="pname"><?php echo htmlspecialchars($mobil['nama_mobil']); ?></div>
                <p><?php echo htmlspecialchars($mobil['deskripsi']); ?></p>
                <div class="price">Rp <?php echo number_format($mobil['harga'], 0, ',', '.'); ?></div>
                <p>Transmisi: <?php echo htmlspecialchars($mobil['transmisi']); ?></p> <!-- Menampilkan transmisi -->
                <p>Tahun: <?php echo htmlspecialchars($mobil['tahun']); ?></p>
                <p>Kondisi: <?php echo htmlspecialchars($mobil['kondisi']); ?></p>

                <div class="btn-box">
                <button class="bigbtn" onclick="redirectToWhatsApp('<?php echo htmlspecialchars($mobil['nama_mobil']); ?>')">
                    Hubungi</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="spacer-section1"></div>
    <div class="footer" id="about">
        <div class="container spacer-section">
            <h2>Informasi Kontak</h2>
            <p>Alamat: Jl. Jend. Sudirman Timur, 952, Sokaraja, Banyumas, Jawa Tengah 53154</p>
            <p>Telepon:</p>
            <ul>
                <li>08112822337</li>
            </ul>
            <p>© 2024 Putra Jaya Mobilindo. Semua Hak Dilindungi.</p>
        </div>
    </div>


</body>

</html>
