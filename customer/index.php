<?php
session_start();
include "../koneksi.php";

if (!isset($_SESSION['email'])) {
    header("Location: loginCust.php");
    exit();
}

$email = $_SESSION['email'];
$sql = "SELECT nama, lokasi, deskripsi, status FROM keluhan WHERE email = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

$stmt->close();
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pelayanan Keluhan Fasilitas</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body style="font-family: 'Poppins', sans-serif;">


    <nav class="navbar navbar-expand-lg navbar-dark bg-primary bg-gradient">
        <div class="container">
            <a class="navbar-brand" href="#">Keluhan Fasilitas</a>
            <div class="status">
                <form action="logoutCust.php" method="post">
                    <button class="btn bg-danger text-white"><i class="fas fa-sign-out-alt me-2"></i>Logout</button>
                </form>
            </div>
        </div>
    </nav>


    <div class="container my-4">
        <div class="p-4 bg-light rounded shadow-sm">
            <h2 class="mb-3">Laporkan Keluhan Fasilitas</h2>
            <form action="sendProcess.php" method="post" autocomplete="off">
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" class="form-control" name="nama" id="nama" placeholder="Masukkan nama" required>
                </div>
                <div class="mb-3">
                    <label for="lokasi" class="form-label">Lokasi Fasilitas</label>
                    <input type="text" class="form-control" name="lokasi" id="lokasi"
                        placeholder="Contoh: Gedung A Lantai 2" required>
                </div>
                <div class="mb-3">
                    <label for="keluhan" class="form-label">Deskripsi</label>
                    <textarea class="form-control" name="deskripsi" id="keluhan" rows="3"
                        placeholder="Jelaskan kerusakan atau keluhan" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="foto" class="form-label">Foto Bukti</label>
                    <input class="form-control" name="foto" type="file" id="foto">
                </div>
                <button type="submit" class="btn btn-primary">Kirim</button>
            </form>
        </div>
    </div>


    <div class="container my-5">
        <h4>Daftar Keluhan Terkirim</h4>
        <div class="table-responsive">
            <table class="table table-bordered mt-3">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Lokasi</th>
                        <th>Deskripsi</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    while ($row = $result->fetch_assoc()):
                        $nama = $row['nama'];
                        $lokasi = $row['lokasi'];
                        $deskripsi = $row['deskripsi'];
                        $status = $row['status'];
                        ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= htmlspecialchars($nama) ?></td>
                            <td><?= htmlspecialchars($lokasi) ?></td>
                            <td><?= htmlspecialchars($deskripsi) ?></td>
                            <td>
                                <?php if ($status == 'Diajukan'): ?>
                                    <span class="badge bg-warning">Diajukan</span>
                                <?php elseif ($status == 'Diproses'): ?>
                                    <span class="badge bg-primary">Diproses</span>
                                <?php else: ?>
                                    <span class="badge bg-success">Selesai</span>
                                <?php endif; ?>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>

    <footer class="bg-primary bg-gradient text-white text-center py-3 mt-auto">
        <p class="mb-0">&copy;Pelayanan Keluhan Fasilitas</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <?php if (isset($_SESSION['success'])): ?>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: '<?= $_SESSION['success'] ?>',
                showConfirmButton: false,
                timer: 1500
            });
        </script>
        <?php unset($_SESSION['success']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['error'])): ?>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: '<?= $_SESSION['error'] ?>',
                confirmButtonText: 'OK'
            })
        </script>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>
</body>

</html>