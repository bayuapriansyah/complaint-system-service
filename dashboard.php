<?php
include 'koneksi.php';

$currentPage = isset($_GET['page']) ? (int) $_GET['page'] : 1;
if ($currentPage < 1)
    $currentPage = 1;
$offset = ($currentPage - 1) * 10;

$resultTotal = $conn->query("SELECT COUNT(*) AS total FROM customer");
$rowTotal = $resultTotal->fetch_assoc();
$totalData = $rowTotal['total'];
$totalPages = ceil($totalData / 10);

$query = "SELECT * FROM customer ORDER BY id ASC LIMIT 10 OFFSET $offset";
$result = $conn->query($query);
$no = $offset + 1;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fc;
        }

        .sidebar {
            width: 240px;
            min-height: 100vh;
            background-color: #4e73df;
            color: white;
        }

        .sidebar a {
            color: white;
            text-decoration: none;
            display: block;
            padding: 12px 20px;
            border-radius: 0.375rem;
            margin-bottom: 10px;
        }

        .sidebar a:hover {
            background-color: #2e59d9;
        }

        .sidebar .logout-btn {
            margin-top: 2rem;
        }

        .content {
            flex-grow: 1;
            padding: 2rem;
        }

        .table th {
            background-color: #4e73df;
            color: white;
        }

        .card {
            border-radius: 1rem;
        }

        .card .card-body i {
            color: #4e73df;
        }

        .topbar {
            padding: 1rem;
            background-color: white;
            box-shadow: 0 1px 4px rgba(0, 0, 0, 0.1);
        }

        .search-input {
            max-width: 300px;
        }
    </style>
</head>

<body>
    <div class="d-flex">
        <div class="sidebar p-4">
            <h4 class="fw-bold mb-4"><i class="fas fa-user-shield me-2"></i>Admin</h4>
            <a href="home.php"><i class="fas fa-gauge me-2"></i>Dashboard</a>
            <a href="#"><i class="fas fa-users me-2"></i>Customers</a>
            <form action="logout.php" method="post">
                <button class="btn btn-outline-light w-100 logout-btn"><i
                        class="fas fa-sign-out-alt me-2"></i>Logout</button>
            </form>
        </div>
        <div class="content">
            <div class="topbar d-flex justify-content-between align-items-center mb-4">
                <h2 class="text-primary fw-bold mb-0">Dashboard</h2>
                <input type="text" class="form-control search-input" id="search" placeholder="Search...">
            </div>
            <div class="row mb-4">
                <div class="col-md-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="mb-0">Tabel Customer</h5>
                        <a href="tambah.php" class="btn btn-primary">
                            <i class="fas fa-plus me-1"></i>Tambah Customer
                        </a>
                    </div>
                    <div class="card shadow-sm">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div>
                                <small>Total Customer</small>
                                <div class="h4 fw-bold text-dark"><?= $totalData ?></div>
                            </div>
                            <i class="fas fa-users fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card shadow-sm">
                <div class="card-header bg-white fw-semibold">Customer</div>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover mb-0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Depan</th>
                                <th>Nama Belakang</th>
                                <th>Tanggal Lahir</th>
                                <th>No. HP</th>
                                <th>Email</th>
                                <th>Alamat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = $result->fetch_assoc()): ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= htmlspecialchars($row['nama_depan']) ?></td>
                                    <td><?= htmlspecialchars($row['nama_belakang']) ?></td>
                                    <td><?= $row['tanggal_lahir'] ?></td>
                                    <td><?= htmlspecialchars($row['no_hp']) ?></td>
                                    <td><?= htmlspecialchars($row['email']) ?></td>
                                    <td><?= htmlspecialchars($row['alamat']) ?></td>
                                    <td>
                                        <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-warning me-1">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="hapus.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-danger"
                                            onclick="return confirm('Yakin ingin menghapus?')">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                    <nav aria-label="Page navigation">
                        <ul class="pagination justify-content-center mt-3">
                            <?php if ($currentPage > 1): ?>
                                <li class="page-item">
                                    <a class="page-link" href="?page=<?= $currentPage - 1 ?>">«</a>
                                </li>
                            <?php endif; ?>

                            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                                <li class="page-item <?= ($i == $currentPage) ? 'active' : '' ?>">
                                    <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                                </li>
                            <?php endfor; ?>

                            <?php if ($currentPage < $totalPages): ?>
                                <li class="page-item">
                                    <a class="page-link" href="?page=<?= $currentPage + 1 ?>">»</a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // document.getElementById('seacrh').addEventListener('input', function () {
        //     const searchValue = this.value.toLowerCase();
        //     const rows = document.querySelectorAll('tbody tr');
        //     rows.forEach(row => {
        //         const cells = row.querySelectorAll('td');
        //         let found = false;
        //         cells.forEach(cell => {
        //             if (cell.textContent.toLowerCase().includes(searchValue)) {
        //                 found = true;
        //             }
        //         });
        //         row.style.display = found ? '' : 'none';
        //     });
        // });
        document.getElementById('search').addEventListener('keyup', function () {
            const keyword = this.value.toLowerCase();
            const xhr = new XMLHttpRequest();
            xhr.open('GET', 'search.php?keyword=' + encodeURIComponent(keyword), true);
            xhr.onload = function () {
                if (xhr.status === 200) {
                    document.querySelector('tbody').innerHTML = xhr.responseText;
                }
            };
            xhr.send();
        });
    </script>
</body>

</html>