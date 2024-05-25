<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Komentar</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav class="navbar">
        <div class="container">
            <h1>Form Komentar</h1>
        </div>
    </nav>
    <div class="background">
        <div class="container">
            <div class="card">
                <form action="komentar.php" method="POST">
                    <label for="nama">Nama:</label><br>
                    <input type="text" id="nama" name="nama" required><br>
                    <label for="komentar">Komentar:</label><br>
                    <textarea id="komentar" name="komentar" rows="4" cols="50" required></textarea><br>
                    <button type="submit">Kirim</button>
                </form>
            </div>

            <hr>

    <h2>Komentar</h2>
    <?php
include 'koneksi.php';
function time_elapsed_string($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'tahun',
        'm' => 'bulan',
        'w' => 'minggu',
        'd' => 'hari',
        'h' => 'jam',
        'i' => 'menit',
        's' => 'detik',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? '' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' yang lalu' : 'baru saja';
}

$sql = "SELECT * FROM tb_data ORDER BY date DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<div class='comment'>";
        echo "<div class='author'><strong>" . $row["nama"]. "</strong></div>";
        echo "<div class='date'>" . time_elapsed_string($row["date"]) . "</div>";
        echo "<div class='text'>" . $row["komentar"]. "</div>";
        echo "</div>";
    }
} else {
    echo "Belum ada komentar.";
}
$conn->close();
?>
    <script>
        // JavaScript untuk menampilkan pop-up
        function showSuccessMessage() {
            alert("Komentar berhasil ditambahkan!");
        }

        
    </script>
</body>
</html>
