<?php
include 'koneksi.php';

$id = $_GET['id'];

$query = "SELECT * FROM customer WHERE id = '$id'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    $data = mysqli_fetch_assoc($result);
    $tanggallahir = date('d F Y', strtotime($data['tanggal_lahir']));
} else {
    echo "
    <script>
    alert ('Data tidak ditemukan');
    window.location.href = 'dashboard.php';
    </script>
    ";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="registrasi.css">
</head>

<body>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="form-container">
                    <div class="form-header">
                        <h2><i class="fas fa-user-plus me-2"></i>Edit Data</h2>
                    </div>

                    <div class="form-body">
                        <form action="editProcess.php" method="post" autocomplete="off">

                            <div class="divider">
                                <span class="divider-text">ISI DATA DI BAWAH INI</span>
                            </div>

                            <div class="row g-3">
                                <input type="hidden" name="id" value="<?= $data['id'] ?>">
                                <div class="col-md-6">
                                    <label for="firstName" class="form-label">Nama depan</label>
                                    <input type="text" class="form-control" name="firstName" id="firstName"
                                        value="<?= htmlspecialchars($data['nama_depan']) ?>" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="lastName" class="form-label">Nama belakang</label>
                                    <input type="text" class="form-control" name="lastName" id="lastName"
                                        value="<?= htmlspecialchars($data['nama_belakang']) ?>" required>
                                </div>
                            </div>

                            <div class="mb-3 mt-3">
                                <label for="email" class="form-label">Email</label>
                                <div class="input-group">
                                    <input type="email" class="form-control input-with-icon" id="email" name="email"
                                        placeholder="example@email.com" value="<?= htmlspecialchars($data['email']) ?>"
                                        required>
                                </div>
                            </div>
                            <div class="mb-3 mt-3">
                                <label for="alamat" class="form-label">Alamat</label>
                                <div class="input-group">
                                    <input type="text" class="form-control input-with-icon" id="alamat" name="alamat"
                                        placeholder="Isi alamatmu" autocomplete="off"
                                        value="<?= htmlspecialchars($data['alamat']) ?>" required>
                                </div>
                            </div>
                            <div class="mb-3 mt-3">
                                <label for="nohp" class="form-label">No Hp</label>
                                <div class="input-group">
                                    <input type="number" class="form-control input-with-icon" id="nohp" placeholder=""
                                        name="nohp" value="<?= htmlspecialchars($data['no_hp']) ?>" required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="birthdate" class="form-label">Tanggal lahir</label>
                                <input type="date" class="form-control" id="birthdate" name="birthdate"
                                    value="<?= htmlspecialchars($data['tanggal_lahir']) ?>">
                            </div>

                            <button type="submit" class="btn btn-primary w-100 mt-2">
                                <i class="fas fa-paper-plane me-2"></i>Simpan perubahan
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>