<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Putra Jaya Mobilindo</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
    <script src="script.js"></script>
</head>

<body>

    <!-- Header -->
    <nav class="bg-nav navbar">
        <div class="logo" onclick="location.reload();">Putra Jaya Mobilindo</div>
        <ul>
            <li><a onclick="scrollToCategory('home')">Home</a></li>
            <li><a onclick="scrollToCategory('garasi')">Garasi</a></li>
            <li><a onclick="scrollToCategory('about')">About</a></li>
        </ul>
    </nav>
    <!-- End Header -->

    <div id="home">
        <div class="spacer-section"></div>
        <div class="mobil spacer-section">
            <div class="container shadow-box">
                <div class="container">
                    <div class="d-flex f-wrap jc-spacebetween ai-center">

                        <div class="showroom-desc spacer-section">
                            <img class="container d-flex f-wrap" src="dealer.jpg" alt="Putra Jaya Mobilindo">
                            <hr>

                            <p>
                                Putra Jaya Mobilindo adalah showroom mobil bekas terpercaya yang menyediakan berbagai
                                pilihan kendaraan berkualitas untuk memenuhi kebutuhan Anda. Berlokasi strategis, kami
                                menghadirkan koleksi mobil bekas dengan kondisi prima, harga kompetitif, dan proses
                                transaksi yang mudah serta transparan.
                                Di Putra Jaya Mobilindo, kami menjamin setiap mobil yang tersedia telah melalui inspeksi
                                menyeluruh sehingga pelanggan mendapatkan kendaraan yang aman dan nyaman. Mulai dari
                                mobil keluarga, SUV, hingga kendaraan niaga, kami memiliki berbagai jenis dan merek
                                ternama untuk dipilih sesuai kebutuhan Anda.
                                Keunggulan kami meliputi:
                            <ul>
                                <li>Garansi Kepercayaan: Kondisi mobil jelas, tanpa rekondisi tersembunyi.</li>
                                <li>Proses Mudah: Bantuan kredit dengan persyaratan ringan.</li>
                                <li>Pelayanan Profesional: Staf berpengalaman siap membantu Anda menemukan kendaraan
                                    impian.</li>
                            </ul>
                            <hr>
                            </p>
                        </div>
                        <img class="container" src="inside.jpg" alt="Putra Jaya Mobilindo">
                        <p>Temukan mobil bekas terbaik hanya di Putra Jaya Mobilindo!</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="spacer-section" id="garasi"></div>
    <hr>

    <?php
    include('koneksi.php');

    // Mengambil mobil terbaru
    $latestMobil = getLatestMobil();

    if ($latestMobil->num_rows > 0) {
        while ($row = $latestMobil->fetch_assoc()) {
            echo '
            <div class="spacer-section">
                <div class="mobil spacer-section containerbg">
                    <div class="container">
                        <div class="d-flex f-wrap jc-spacebetween ai-center">
                            <div class="mobil-desc">
                                <h2 class="bigtitle">Koleksi Terbaru!!</h2>
                                <div class="spacercontent"></div>
                                <p>' . htmlspecialchars($row["deskripsi"]) . '</p>
                                <div class="spacercontent"></div>
                                <a href="detail.php?id=' . $row["id_mobil"] . '" class="bigbtn">Detail</a>
                            </div>
                            <div class="mobil-image">
                                <img src="' . htmlspecialchars($row["gambar"]) . '" alt="' . htmlspecialchars($row["nama_mobil"]) . '" class="img-responsive">
                            </div>
                        </div>
                    </div>
                </div>
            </div>';
        }
    } else {
        echo "Tidak ada mobil";
    }
    ?>

    <hr>
    <div class="spacer-section"></div>

    <!-- Kategori -->
    <?php
    // Mengambil semua kategori
    $kategoriResult = getAllKategori();

    echo '<div class="container shadow-box">
            <div class="category spacer-section">
                <div class="container">
                    <h1 class="spacer-section">Kategori</h1>
                    <div class="d-flex">';

    if ($kategoriResult->num_rows > 0) {
        while ($row = $kategoriResult->fetch_assoc()) {
            echo '
                <div class="category-car">
                    <div class="overlay">
                        <h2>' . htmlspecialchars($row['nama_kategori']) . '</h2>
                        <div class="spacer-section"></div>
                        <p class="container">' . htmlspecialchars($row['deskripsi']) . '</p>
                        <div class="spacer-section2">
                            <button class="btn-outline" onclick="scrollToCategory(' . htmlspecialchars($row['id_kategori']) . ')">Lihat</button>
                        </div>
                    </div>
                    <img src="' . htmlspecialchars($row['gambar']) . '" alt="' . htmlspecialchars($row['nama_kategori']) . '" class="img-responsive">
                </div>';
        }
    } else {
        echo "<p>Tidak ada kategori ditemukan.</p>";
    }

    echo '</div>
            </div>
        </div>
    </div>';

    ?>

    <!-- End Kategori -->
    <div class="spacer-section"></div>
    <hr>

    <!-- Garasi -->
<?php
// Mengambil semua kategori untuk menampilkan mobil per kategori
$kategoriResult = getAllKategori();

if ($kategoriResult->num_rows > 0) {
    while ($kategori = $kategoriResult->fetch_assoc()) {
        $id_kategori = $kategori['id_kategori'];
        $nama_kategori = htmlspecialchars($kategori['nama_kategori']);
        $mobilResult = getMobilByKategori($id_kategori);
?>
        <div id="<?php echo $id_kategori; ?>" class="garasi spacer-section">
            <div class="container">
                <h2><?php echo $nama_kategori; ?></h2>
                <div class="d-flex flex-row jc-spacebetween spacer-section">
                    <?php
                    if ($mobilResult->num_rows > 0) {
                        $count = 0; // Counter untuk jumlah mobil
                        while ($mobil = $mobilResult->fetch_assoc()) {
                            $gambar = htmlspecialchars($mobil['gambar']);
                            $namaMobil = htmlspecialchars($mobil['nama_mobil']);
                            $harga = number_format($mobil['harga'], 0, ',', '.');
                            $idMobil = $mobil['id_mobil'];

                            // Membuka div baru setiap kali baris baru dimulai
                            if ($count % 4 == 0 && $count > 0) {
                                echo '</div><div class="d-flex flex-row jc-spacebetween spacer-section">';
                            }
                    ?>
                            <div class="garasi-mobil shadow-box">
                                <img src="<?php echo $gambar; ?>" alt="<?php echo $namaMobil; ?>" class="img-responsive">
                                <h3><?php echo $namaMobil; ?></h3>
                                <h4>RP <?php echo $harga; ?></h4>
                                <a href="detail.php?id=<?php echo $idMobil; ?>">Detail</a>
                            </div>
                    <?php
                            $count++;
                        }

                        // Jika item tidak kelipatan 4, tambahkan placeholder
                        $sisaItem = $count % 4;
                        if ($sisaItem > 0) {
                            for ($i = $sisaItem; $i < 4; $i++) {
                                echo '<div class="garasi-mobil"></div>';
                            }
                        }
                        echo '</div>'; // Menutup div terakhir
                    } else {
                        echo "<p>Tidak ada mobil dalam kategori ini.</p>";
                    }
                    ?>
                </div>
            </div>
            <div class="spacer-section"></div>
            <hr>
        </div>
<?php
    }
} else {
    echo "<p>Tidak ada kategori ditemukan.</p>";
}
?>

    <!-- End Garasi -->

    <!-- Footer -->
    <div class="footer spacer-section" id="about">
        <div class="container">
            <h2>Informasi Kontak</h2>
            <p>Alamat : Jl. Jend. Sudirman Timur, 952, Sokaraja, Banyumas, Jawa Tengah 53154</p>
            <p>Telepon :</p>
            <ul>
                <li>085700780091</li>
            </ul>
            <p>© 2024 Putra Jaya Mobilindo. Semua Hak Dilindungi.</p>
        </div>
    </div>

</body>

</html> 