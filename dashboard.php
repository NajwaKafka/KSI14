<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

// Inisialisasi array untuk menyimpan data peminjaman bus
if (!isset($_SESSION['bus_data'])) {
    $_SESSION['bus_data'] = [];
}

// Tangani pengiriman form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $peminjaman_id = $_POST['peminjaman_id'];
    $bus_id = $_POST['bus_id'];
    $sopir_id = $_POST['sopir_id'];
    $tgl_peminjaman = $_POST['tanggal_peminjaman'];
    $tgl_pengembalian = $_POST['tanggal_pengembalian'];
    $nama_peminjam = $_POST['nama_peminjam'];
    $nama_sopir = $_POST['nama_sopir'];
    $nama_bus = $_POST['nama_bus'];

    // Tambahkan data baru ke session
    $_SESSION['bus_data'][] = [
        'PeminjamanID' => $peminjaman_id,
        'BusID' => $bus_id,
        'SopirID' => $sopir_id,
        'Tgl_Peminjaman' => $tgl_peminjaman,
        'Tgl_Pengembalian' => $tgl_pengembalian,
        'NamaPeminjam' => $nama_peminjam,
        'NamaSopir' => $nama_sopir,
        'NamaBus' => $nama_bus,
    ];
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Dashboard Peminjaman Bus</title>
</head>
<body>
    <div class="container">
        <h2>Selamat datang, <?php echo $_SESSION['username']; ?>!</h2>

        <!-- Form Input Peminjaman Bus -->
        <div class="form-container">
            <h3>Form Peminjaman Bus</h3>
            <form method="POST" action="">
                <div class="form-group">
                    <label for="peminjaman_id">Peminjaman ID:</label>
                    <input type="text" id="peminjaman_id" name="peminjaman_id" required>
                </div>
                <div class="form-group">
                    <label for="bus_id">Bus ID:</label>
                    <input type="text" id="bus_id" name="bus_id" required>
                </div>
                <div class="form-group">
                    <label for="sopir_id">Sopir ID:</label>
                    <input type="text" id="sopir_id" name="sopir_id" required>
                </div>
                <div class="form-group">
                    <label for="tanggal_peminjaman">Tanggal Peminjaman:</label>
                    <input type="date" id="tanggal_peminjaman" name="tanggal_peminjaman" required>
                </div>
                <div class="form-group">
                    <label for="tanggal_pengembalian">Tanggal Pengembalian:</label>
                    <input type="date" id="tanggal_pengembalian" name="tanggal_pengembalian" required>
                </div>
                <div class="form-group">
                    <label for="nama_peminjam">Nama Peminjam:</label>
                    <input type="text" id="nama_peminjam" name="nama_peminjam" required>
                </div>
                <div class="form-group">
                    <label for="nama_sopir">Nama Sopir:</label>
                    <input type="text" id="nama_sopir" name="nama_sopir" required>
                </div>
                <div class="form-group">
                    <label for="nama_bus">Nama Bus:</label>
                    <input type="text" id="nama_bus" name="nama_bus" required>
                </div>
                <button type="submit">Tambah Data</button>
            </form>
        </div>

        <!-- Tabel Peminjaman Bus -->
        <?php if (!empty($_SESSION['bus_data'])): ?>
            <h3>Tabel Peminjaman Bus</h3>
            <table style="width: 100%;">
                <tr>
                    <th>Peminjaman ID</th>
                    <th>Bus ID</th>
                    <th>Sopir ID</th>
                    <th>Tanggal Peminjaman</th>
                    <th>Tanggal Pengembalian</th>
                    <th>Nama Peminjam</th>
                    <th>Nama Sopir</th>
                    <th>Nama Bus</th>
                </tr>
                <?php foreach ($_SESSION['bus_data'] as $data): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($data['PeminjamanID']); ?></td>
                        <td><?php echo htmlspecialchars($data['BusID']); ?></td>
                        <td><?php echo htmlspecialchars($data['SopirID']); ?></td>
                        <td><?php echo htmlspecialchars($data['Tgl_Peminjaman']); ?></td>
                        <td><?php echo htmlspecialchars($data['Tgl_Pengembalian']); ?></td>
                        <td><?php echo htmlspecialchars($data['NamaPeminjam']); ?></td>
                        <td><?php echo htmlspecialchars($data['NamaSopir']); ?></td>
                        <td><?php echo htmlspecialchars($data['NamaBus']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php else: ?>
            <!-- Pesan jika tidak ada data -->
            <p>Tidak ada data peminjaman bus. Silakan tambahkan data.</p>
        <?php endif; ?>

        <!-- Logout Link -->
        <a href="logout.php">Logout</a>        
    </div>

    <!-- CSS untuk memisahkan form dan tabel -->
    <style>
        .container {
            width: 80%; /* Lebar container menjadi 80% dari lebar viewport */
            max-width: 800px; /* Maksimal lebar container */
            margin: 50px auto; /* Centering container */
            padding: 20px;
            background-color: #fff; /* Warna latar belakang container */
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .form-container {
            margin-bottom: 30px; /* Jarak antara form dan tabel */
            padding: 20px;
            background-color: #f9f9f9; /* Warna latar belakang form */
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        
        h3 {
            margin-top: 20px; /* Jarak atas untuk judul tabel */
        }
        
        table {
            margin-top: 20px; /* Jarak atas untuk tabel */
            width: 100%; /* Memastikan tabel menggunakan lebar penuh */
            border-collapse: collapse; /* Menghilangkan jarak antar border */
        }

        th {
            background-color: #7bc1fa; /* Warna latar belakang header tabel (Cream) */
            color: #4e3b31; /* Coklat gelap untuk teks header */
        }
        
        tr:nth-child(even) {
            background-color: #f5f5dc; /* Warna latar belakang baris genap (Cream) */
        }

        tr:nth-child(odd) {
            background-color: #e6e6fa; /* Warna latar belakang baris ganjil (Coklat muda) */
        }

        th, td {
            padding: 8px;
            text-align: left; /* Rata kiri untuk teks dalam sel */
            color: #4e3b31; /* Coklat gelap untuk teks dalam sel */
        }
        
    </style>

</body>
</html>