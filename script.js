// Fungsi untuk scroll ke kategori berdasarkan ID
function scrollToCategory(id) {
    const categorySection = document.getElementById(id);
    if (categorySection) {
        categorySection.scrollIntoView({ behavior: "smooth", block: "start" });
    } else {
        console.error("Kategori dengan ID " + id + " tidak ditemukan.");
    }
}

// Fungsi untuk mengganti gambar besar dengan gambar kecil
function showImg(src) {
    document.querySelector('.big-img img').src = src;
}

// Fungsi untuk redirect ke WhatsApp dengan pesan dinamis
function redirectToWhatsApp(carName) {
    const phoneNumber = "6285700780091";
    const message = encodeURIComponent(`Halo, saya tertarik dengan mobil ${carName}`);
    const whatsappURL = `https://wa.me/${phoneNumber}?text=${message}`;
    window.open(whatsappURL, '_blank'); // Membuka di tab atau jendela baru
}


// Fungsi untuk scroll halus ke elemen berdasarkan ID (jika hash ada di URL)
function scrollToSection() {
    if (window.location.hash) {
        const targetElement = document.querySelector(window.location.hash);
        if (targetElement) {
            targetElement.scrollIntoView({ behavior: 'smooth' });
        }
    }
}

// Tambahkan event listener untuk tombol WhatsApp
document.addEventListener("DOMContentLoaded", () => {
    const button = document.querySelector(".bigbtn");
    const carName = document.querySelector(".pname").textContent;
    button.addEventListener("click", () => redirectToWhatsApp(carName));
});
