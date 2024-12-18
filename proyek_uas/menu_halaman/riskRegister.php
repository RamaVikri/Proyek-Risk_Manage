<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "riskman");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Generate kode resiko otomatis
    $result = $conn->query("SELECT COUNT(*) AS count FROM risk");
    $row = $result->fetch_assoc();
    $kode_resiko = "R" . ($row['count'] + 1);

    // Insert data ke database
    $stmt = $conn->prepare("INSERT INTO risk (objective_tujuan, proses_bisnis, risk_category, kode_resiko, risk_event, penyebab_resiko, sumber_resiko, potensi_kerugian_qualitative, potensi_kerugian_nominal, owner_risk, nama_dept_unit, inherent_risk_likelihood, inherent_risk_impact, inherent_risk_level, pengendalian_ada_tidak, pengendalian_memadai_belum, pengendalian_sudah_belum, residual_risk_likelihood, residual_risk_impact, residual_risk_level, risk_treatment_accept_reduce, risk_treatment_text, target_risk_likelihood, target_risk_impact, target_risk_level) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param(
        "sssssssssssssssssssssssss",
        $_POST['objective_tujuan'], $_POST['proses_bisnis'], $_POST['risk_category'], $_POST['kode_resiko'],
        $_POST['risk_event'], $_POST['penyebab_resiko'], $_POST['sumber_resiko'],
        $_POST['potensi_kerugian_qualitative'], $_POST['potensi_kerugian_nominal'], $_POST['owner_risk'],
        $_POST['nama_dept_unit'], $_POST['inherent_risk_likelihood'], $_POST['inherent_risk_impact'],
        $_POST['inherent_risk_level'], $_POST['pengendalian_ada_tidak'], $_POST['pengendalian_memadai_belum'],
        $_POST['pengendalian_sudah_belum'], $_POST['residual_risk_likelihood'], $_POST['residual_risk_impact'],
        $_POST['residual_risk_level'], $_POST['risk_treatment_accept_reduce'], $_POST['risk_treatment_text'],
        $_POST['target_risk_likelihood'], $_POST['target_risk_impact'], $_POST['target_risk_level']
    );

    if ($stmt->execute()) {
        header("Location: riskRegistered.php"); // Redirect ke halaman lain
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Input Risiko</title>
</head>
<body>
    <form method="POST">
        <h3>Input Data Risiko</h3>
        <label>Objective dan Tujuan:</label><br>
        <input type="text" name="objective_tujuan" required><br>

        <label>Proses Bisnis:</label><br>
        <textarea name="proses_bisnis" required></textarea><br>

        <label>Risk Category:</label><br>
        <select name="risk_category" required>
            <option>Resiko Stratejik</option>
            <option>Resiko Finansial</option>
            <option>Resiko Operasional</option>
            <option>Lainnya</option>
        </select><br>

        <label>Risk Event:</label><br>
        <textarea name="risk_event" required></textarea><br>

        <label>Penyebab Resiko:</label><br>
        <textarea name="penyebab_resiko" required></textarea><br>

        <label>Sumber Resiko:</label><br>
        <select name="sumber_resiko" required>
            <option>Internal</option>
            <option>External</option>
        </select><br>

        <label>Potensi Kerugian (Kualitatif):</label><br>
        <input type="text" name="potensi_kerugian_qualitative" required><br>

        <label>Potensi Kerugian (Nominal Rp):</label><br>
        <input type="number" name="potensi_kerugian_nominal" required><br>

        <label>Nama Dept/Unit Terkait:</label><br>
        <input type="text" name="nama_dept_unit" required><br>

        <label>Score Inherent Risk (Likelihood, Impact, Level):</label><br>
        <input type="number" name="inherent_risk_likelihood" required>
        <input type="number" name="inherent_risk_impact" required>
        <input type="number" name="inherent_risk_level" required><br>

        <label>Pengendalian:</label><br>
        <select name="pengendalian_ada_tidak" required>
            <option>Ada</option>
            <option>Tidak Ada</option>
        </select>
        <select name="pengendalian_memadai_belum" required>
            <option>Memadai</option>
            <option>Belum Memadai</option>
        </select>
        <select name="pengendalian_sudah_belum" required>
            <option>Sudah</option>
            <option>Belum</option>
        </select><br>

        <label>Score Residual Risk (Likelihood, Impact, Level):</label><br>
        <input type="number" name="residual_risk_likelihood" required>
        <input type="number" name="residual_risk_impact" required>
        <input type="number" name="residual_risk_level" required><br>

        <label>Risk Treatment:</label><br>
        <select name="risk_treatment_accept_reduce" required>
            <option>Accept</option>
            <option>Reduce</option>
        </select><br>
        <textarea name="risk_treatment_text" required></textarea><br>

        <label>Score Target (Likelihood, Impact, Level):</label><br>
        <input type="number" name="target_risk_likelihood" required>
        <input type="number" name="target_risk_impact" required>
        <input type="number" name="target_risk_level" required><br>

        <input type="hidden" name="owner_risk" value="Nama User">
        <button type="submit">Simpan</button>
    </form>
</body>
</html>
