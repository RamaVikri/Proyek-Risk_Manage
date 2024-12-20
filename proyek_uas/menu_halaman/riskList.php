<?php
session_start();
require_once '../conn.php';

if ($_SESSION['status'] == "") {
    header("location:index.php?pesan=gagal");
}

// Query untuk mengambil data
$result = $conn->query("SELECT * FROM risk");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Risk List</title>
    <link rel="stylesheet" href="../css/dashboard.css"> <!-- Tambahkan file CSS -->
    <link rel="stylesheet" href="../css/riskMatrix.css">
</head>
<body>
    <div class="dashboard-container">
        <!-- Sidebar -->
        <div class="sidebar">
            <h2>Aplikasi Risk Management</h2>
            <p><small>Username: <?php echo $_SESSION['nama']; ?></small></p>
            <p><small>Status: <?php echo $_SESSION['status']; ?></small></p>
            <ul class="sidebar-menu">
                <li><a href="about.php">About</a></li>
                
                <li><a href="riskMatrix.php">Risk Matrix</a></li>
                
                </li>
                <li><a href="riskRegister.php">Risk Register</a></li>
                <li><a href="riskList.php">Risk List</a></li>
                <li><a href="riskTreatments.php">Risk Treatments</a></li>

                <!-- fitur khusus admin -->
                <?php if ($_SESSION['status'] == 'admin'): ?>
                    <li><a href="../menu_add_user/daftar_user.php">Daftar User</a></li>
                <?php endif; ?>
                <!-- fitur khusus admin end-->
                <li><a href="../logout.php">Logout</a></li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="main-content">
        <h2>Daftar Risiko Terdaftar</h2>
    <table>
        <thead>
            <tr>
                <th>Kode Resiko</th>
                <th>Objective & Tujuan</th>
                <th>Proses Bisnis</th>
                <th>Kategori Resiko</th>
                <th>Risk Event</th>
                <th>Penyebab Resiko</th>
                <th>Sumber Resiko</th>
                <th>Potensi Kerugian</th>
                <th>Nama Dept/Unit</th>
                <th>Inherent Risk</th>
                <th>Pengendalian</th>
                <th>Residual Risk</th>
                <th>Risk Treatment</th>
                <th>Risk Evidence</th>
                <th>Target Risk</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['id']; ?></td>
                    <td><?= $row['objective_tujuan']; ?></td>
                    <td><?= $row['proses_bisnis']; ?></td>
                    <td><?= $row['risk_category']; ?></td>
                    <td><?= $row['risk_event']; ?></td>
                    <td><?= $row['penyebab_resiko']; ?></td>
                    <td><?= $row['sumber_resiko']; ?></td>
                    <td>
                        Qualitative: <?= $row['potensi_kerugian_qualitative']; ?><br>
                        Nominal: Rp <?= number_format($row['potensi_kerugian_nominal'], 2); ?>
                    </td>
                    <td><?= $row['nama_dept_unit']; ?></td>
                    <td>
                        Likelihood: <?= $row['inherent_risk_likelihood']; ?><br>
                        Impact: <?= $row['inherent_risk_impact']; ?><br>
                        Level: <?= $row['inherent_risk_level']; ?>
                    </td>
                    <td>
                        Ada/Tidak: <?= $row['pengendalian_ada_tidak']; ?><br>
                        Memadai/Belum: <?= $row['pengendalian_memadai_belum']; ?><br>
                        Sudah/Belum: <?= $row['pengendalian_sudah_belum']; ?>
                    </td>
                    <td>
                        Likelihood: <?= $row['residual_risk_likelihood']; ?><br>
                        Impact: <?= $row['residual_risk_impact']; ?><br>
                        Level: <?= $row['residual_risk_level']; ?>
                    </td>
                    <td>
                        <?= $row['risk_treatment_accept_reduce']; ?><br>
                        <?= $row['risk_treatment_text']; ?>
                    </td>
                    <td>
                        <?= $row['risk_evidence']; ?><br>>
                    </td>
                    <td>
                        Likelihood: <?= $row['target_risk_likelihood']; ?><br>
                        Impact: <?= $row['target_risk_impact']; ?><br>
                        Level: <?= $row['target_risk_level']; ?>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
        </div>
    </div>
</body>
</html>
