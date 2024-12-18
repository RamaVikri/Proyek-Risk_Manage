<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "riskman");

// Query untuk mengambil data
$result = $conn->query("SELECT * FROM risk");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Risk Registered</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        th {
            background-color: #f4f4f4;
            text-align: left;
        }
    </style>
</head>
<body>
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
                <th>Target Risk</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['kode_resiko']; ?></td>
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
                        Likelihood: <?= $row['target_risk_likelihood']; ?><br>
                        Impact: <?= $row['target_risk_impact']; ?><br>
                        Level: <?= $row['target_risk_level']; ?>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>
