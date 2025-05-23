<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Customer</title>
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
                        <h2><i class="fas fa-user-plus me-2"></i>Tambah Customer</h2>
                    </div>

                    <div class="form-body">
                        <form action="processRegist.php" method="post" autocomplete="off">

                            <div class="divider">
                                <span class="divider-text">ISI DATA DI BAWAH INI</span>
                            </div>

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="firstName" class="form-label">Nama depan</label>
                                    <input type="text" class="form-control" name="firstName" id="firstName"
                                        placeholder="" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="lastName" class="form-label">Nama belakang</label>
                                    <input type="text" class="form-control" name="lastName" id="lastName" placeholder=""
                                        required>
                                </div>
                            </div>

                            <div class="mb-3 mt-3">
                                <label for="email" class="form-label">Email</label>
                                <div class="input-group">
                                    <input type="email" class="form-control input-with-icon" id="email" name="email"
                                        placeholder="" required>
                                </div>
                            </div>
                            <div class="mb-3 mt-3">
                                <label for="alamat" class="form-label">Alamat</label>
                                <div class="input-group">
                                    <input type="text" class="form-control input-with-icon" id="alamat" name="alamat"
                                        placeholder="" autocomplete="off" required>
                                </div>
                            </div>
                            <div class="mb-3 mt-3">
                                <label for="email" class="form-label">No Hp</label>
                                <div class="input-group">
                                    <input type="number" class="form-control input-with-icon" id="nohp" placeholder=""
                                        name="nohp" required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="birthdate" class="form-label">Tanggal lahir</label>
                                <input type="date" class="form-control" id="birthdate" name="birthdate" required>
                            </div>

                            <button type="submit" class="btn btn-primary w-100 mt-2">
                                <i class="fas fa-paper-plane me-2"></i>Tambah
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