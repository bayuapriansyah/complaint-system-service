<?php
include "koneksi.php";

$search = $_GET['keyword'] ?? '';
$where = '';
$params = [];
$paramsTypes = '';

if ($search !== '') {
    $where = "WHERE nama_depan LIKE ? OR nama_belakang LIKE ? 
    OR email LIKE ? OR alamat LIKE ?";
    $seacrhParams = "%$search%";
    $params = [$seacrhParams, $seacrhParams, $seacrhParams, $seacrhParams];
    $paramsTypes = "ssss";
    $sql = "SELECT * FROM customer $where ORDER BY id ASC LIMIT 10";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param($paramsTypes, ...$params);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
} else {
    $sql = "SELECT * FROM customer ORDER BY id ASC LIMIT 10";
    $result = $conn->query($sql);
}

$no = 1;
while ($row = $result->fetch_assoc()):
    ?>
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
<?php endwhile;
?>