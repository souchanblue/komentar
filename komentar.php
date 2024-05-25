<?php
include 'koneksi.php';

// Mendapatkan data dari form
$nama = $_POST['nama'];
$komentar = $_POST['komentar'];
$date = date("Y-m-d H:i:s"); // Waktu saat ini

// Memasukkan data ke database
$sql = "INSERT INTO tb_data (nama, komentar, date) VALUES ('$nama', '$komentar', '$date')";

if ($conn->query($sql) === TRUE) {
    // Jika berhasil, kirimkan respon dalam bentuk JavaScript untuk menampilkan pop-up di index.php
    echo "<script>
            alert('Komentar berhasil ditambahkan!');
            window.location.href = 'index.php'; // Redirect kembali ke index.php
          </script>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
