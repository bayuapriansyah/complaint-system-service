<?php
include 'koneksi.php';
session_start();
$success = $_SESSION['success'] ?? '';
$error = $_SESSION['error'] ?? '';
$successDelete = $_SESSION['successDelete'] ?? '';
$gagalDelete = $_SESSION['gagalDelet'] ?? '';

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
if ($result->num_rows == 0) {
    echo "<script>alert('Tidak ada data');</script>";
}

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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        html,
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fc;
            height: 100%;
            margin: 0;
            padding: 0;
        }

        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
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

        .textMenu,
        .bugerMenu {
            font-weight: bold;
            font-size: 15px;
        }

        .menu a {
            text-decoration: none;
            color: #4e73df;
        }

        .menu {
            display: none;
            background-color: white;
            position: relative;
            width: 100%;
            border-radius: 10px;
            justify-content: center;
            align-items: center;
            margin-bottom: 20px;
            height: 60px;
            padding: 1rem;
            gap: 30px;
            z-index: 9999;

        }

        .logout-btn {
            width: 100%;
            font-size: 10px;
        }

        .content {
            flex-grow: 1;
            padding: 2rem;
            background-color: aliceblue;
            margin-left: 240px;
            overflow-x: scroll;
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

        .hamburger {
            display: none;
            cursor: pointer;
        }

        .mobile-menu {
            background-color: white;
            position: fixed;
            height: 100vh;
            z-index: 10000;
            left: -14rem;
            width: 14rem;
            transition: all 0.3s ease-out;
        }

        .mobile-menu.active {
            left: 0;
        }

        .mobile-menu ul {
            list-style: none;
            margin-top: 20px;
        }

        .mobile-menu ul li {
            margin-top: 10px;
        }

        .mobile-menu ul li a {
            font-size: 13px;
            text-decoration: none;
            font-weight: bold;
        }

        .topbar {
            padding: 1rem;
            background-color: white;
            box-shadow: 0 1px 4px rgba(0, 0, 0, 0.1);
        }

        .search-input {
            max-width: 300px;
        }

        .logoutResponsive {
            display: none;
            font-size: 15px;
        }

        .wrapStat {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .containerStat {
            padding: 1rem;
            border-radius: 1rem;
            box-shadow: 0 1px 4px rgba(0, 0, 0, 0.2);
        }

        #pieChart {
            width: 100% !important;
            height: auto !important;
            max-width: 400px;
        }

        @media (max-width: 768px) {
            .menu {
                display: flex;
            }

            .hamburger {
                display: block;
            }

            .mobile-menu.active {
                display: block;
            }

            .sidebar {
                transform: translateX(-100%);
            }

            .textDashboard {
                font-size: 15px;
            }

            #search {
                max-width: 100px;
                font-size: 1;
            }

            .content {
                margin-left: 3px;
            }

            .tblCust {
                font-size: 17px;
                font-weight: bold;
            }

            .tmbhCust {
                max-height: 50px;
                font-size: 10px;
            }

            .logoutResponsive {
                display: block;
            }
        }

        @media (max-width: 435px) {
            .textDashboard {
                display: none;
            }

            .hamburger {
                display: block;
            }

            .mobile-menu.active {
                display: block;
            }
        }
    </style>
</head>

<body>
    <div class="d-flex">
        <div class="sidebar p-4" id="sidebar">
            <h4 class="fw-bold mb-4 text-center"><i class="fas fa-user me-2"></i>Admin</h4>
            <a href="#customer"><i class="fas fa-users me-2"></i>Customers</a>
            <a href="#statistik"><i class="fas fa-chart-pie me-2"></i>Statistik</a>
            <form action="logout.php" method="post">
                <button class="btn btn-outline-light w-100 logout-btn"><i
                        class="fas fa-sign-out-alt me-2"></i>Logout</button>
            </form>
        </div>
        <nav class="mobile-menu" id="mobile-menu">
            <ul class="">
                <li>
                    <h2 class="text-primary fw-bold mb-0">Admin</h2>
                </li>
                <li><a href="#customer">Customer</a></li>
                <li><a href="#statistik">Statistik</a></li>
                <li>
                    <form action="logout.php" method="post" style="width: 120px;">
                        <button class="btn btn-outline-primary w-100 logout-btn"><i
                                class="fas fa-sign-out-alt me-2"></i>Logout</button>
                    </form>
                </li>
            </ul>
        </nav>
        <div class="overlay" id="overlay"></div>
        <div class="content">
            <div class="topbar d-flex justify-content-between align-items-center mb-4">
                <h2 class="textDashboard text-primary fw-bold mb-0">Dashboard</h2>
                <div class="hamburger" id="hamburger">
                    &#9776;
                </div>
                <input type="text" class="form-control search-input" id="search" placeholder="Search...">
            </div>
            <div class="row mb-4">
                <div class="col-md-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="tblCust mb-0">Tabel Customer</h5>
                        <a href="tambah.php" class="tmbhCust btn btn-primary">
                            <i class="iconTambah fas fa-plus me-1"></i>Tambah Customer
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
            <div class="card shadow-sm" id="customer">
                <div class="card-header bg-white fw-semibold">Customer</div>
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
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
                                        <a href="hapus.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-danger">
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
            <div class="wrapStat">
                <div class="containerStat mt-3 bg-white" id="statistik"
                    style="flex: 1 1 300px; width: 400px; height: auto; display: flex; justify-content: center; align-items: center;">
                    <canvas id="pieChart" style=""></canvas>
                </div>
                <div class="barWrap bg-white mt-3"
                    style="flex: 2 1 500px; min-width: 300px; height: auto; border-radius: 1rem; padding: 1rem;">
                    <div class="mb-3" style="font-weight: bold; color: #4e73df; font-size: larger; text-align: center;">
                        Bar user
                    </div>
                    <div class="statBar" style="">
                        <canvas id="barChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const toggle = document.getElementById('hamburger');
        const menu = document.getElementById('mobile-menu');

        toggle.addEventListener('click', (event) => {
            menu.classList.toggle('active');
        });

        document.addEventListener('click', (event) => {
            const inside = menu.contains(event.target);
            const buttonKlik = toggle.contains(event.target);

            if (!inside && !buttonKlik) {
                menu.classList.remove('active');
            }
        });
    </script>
    <script>
        // Fungsi seacrh dengan ajax 
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Swet Alert 
        document.querySelectorAll('.btn-danger').forEach(button => {
            button.addEventListener('click', function (event) {
                event.preventDefault();
                const href = this.getAttribute('href');
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Data ini akan dihapus!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, hapus!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = href;
                    }
                });
            });
        });
    </script>
    <script>
        // Mengambil session di editProses dan swet alert
        <?php if (!empty($success)): ?>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: '<?= addslashes($success) ?>',
                confirmButtonText: 'OK'
            });
            <?php unset($_SESSION['success']); ?>
        <?php endif; ?>

        <?php if (!empty($error)): ?>
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: '<?= addslashes($error) ?>',
                confirmButtonText: 'OK'
            });
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>

        <?php if (!empty($successDelete)): ?>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: '<?= addslashes($successDelete) ?>',
                confirmButtonText: 'OK'
            });
            <?php unset($_SESSION['successDelete']); ?>
        <?php endif; ?>

        <?php if (!empty($gagalDelete)): ?>
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: '<?= addslashes($gagalDelete) ?>',
                confirmButtonText: 'OK'
            });
            <?php unset($_SESSION['gagalDelete']); ?>
        <?php endif ?>
    </script>
    <script>
        // Grafik dengan ChartJS
        const ctx = document.getElementById('pieChart');
        const bar = document.getElementById('barChart');
        Chart.defaults.font.family = "'Poppins', sans-serif";
        <?php

        $statusLabels = ['Diajukan', 'Diproses', 'Selesai'];
        $statusCounts = [];

        foreach ($statusLabels as $status) {
            $stmt = $conn->prepare("SELECT COUNT(*) AS jumlah FROM keluhan WHERE status = ?");
            $stmt->bind_param("s", $status);
            $stmt->execute();
            $resultStatus = $stmt->get_result()->fetch_assoc();
            $statusCounts[] = (int) $resultStatus['jumlah'];
            $stmt->close();
        }
        ?>
        const pieLabels = <?= json_encode($statusLabels) ?>;
        const pieData = <?= json_encode($statusCounts) ?>;

        new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['Diajukan', 'Diproses', 'Selesai'],
                datasets: [{
                    label: 'Jumlah',
                    data: pieData,
                    backgroundColor: [
                        '#4e73df',
                        '#f6c23e',
                        '#1cc88a'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Statistik Progress',
                        color: '#4e73df',
                        font: {
                            size: 20,
                            weight: 'bold',
                        }
                    }
                }
            },
        });

        <?php
        $bulanNama = [
            'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        ];
        $jumlahPerBulan = [];
        for ($i = 6; $i >= 0; $i--) {
            $tahunBulan = date('Y-m', strtotime("-$i months"));
            $stmt = $conn->prepare("SELECT COUNT(*) AS jumlah FROM customer WHERE DATE_FORMAT(created_at, '%Y-%m') = ?");
            $stmt->bind_param("s", $tahunBulan);
            $stmt->execute();
            $resultBulan = $stmt->get_result()->fetch_assoc();
            $jumlahPerBulan[] = (int) $resultBulan['jumlah'];
            $stmt->close();
        }
        $bulan = [];
        for ($i = 6; $i >= 0; $i--) {
            $bulanIn = (int) date('n', strtotime("-$i months")) - 1;
            $bulan[] = $bulanNama[$bulanIn];
        }
        ?>

        const bulan = <?= json_encode($bulan) ?>;
        const jumlahPerBulan = <?= json_encode($jumlahPerBulan) ?>;

        new Chart(bar, {
            type: 'bar',
            data: {
                labels: bulan,
                datasets: [{
                    label: 'Jumlah',
                    data: jumlahPerBulan,
                    backgroundColor: ['rgb(79, 115, 226)'],
                    borderWidth: 1,
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>

</html>