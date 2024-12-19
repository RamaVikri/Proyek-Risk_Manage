<?php
session_start();
require_once '../conn.php';

if ($_SESSION['status'] == "") {
    header("location:index.php?pesan=gagal");
}

// Database connection
// $conn = new mysqli("localhost", "root", "", "riskman");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Generate kode resiko otomatis
    $result = $conn->query("SELECT COUNT(*) AS count FROM risk");
    $row = $result->fetch_assoc();
    $kode_resiko = "R" . ($row['count'] + 1);

    // Insert data ke database
    $stmt = $conn->prepare("INSERT INTO risk (objective_tujuan, proses_bisnis, risk_category, kode_resiko, risk_event, penyebab_resiko, sumber_resiko, potensi_kerugian_qualitative, potensi_kerugian_nominal, owner_risk, nama_dept_unit, inherent_risk_likelihood, inherent_risk_impact, inherent_risk_level, pengendalian_ada_tidak, pengendalian_memadai_belum, pengendalian_sudah_belum, residual_risk_likelihood, residual_risk_impact, residual_risk_level, risk_treatment_accept_reduce, risk_treatment_text,jan, feb,mar,apr,mei,jun,jul,agu,sep,okt,nov,des,risk_evidence, target_risk_likelihood, target_risk_impact, target_risk_level) VALUES (?,?,?,?,?,?,?,?,?,?,?,?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param(
        "ssssssssssssssssssssssssssssssssssssss",
        $_POST['objective_tujuan'], $_POST['proses_bisnis'], $_POST['risk_category'], $_POST['kode_resiko'],
        $_POST['risk_event'], $_POST['penyebab_resiko'], $_POST['sumber_resiko'],
        $_POST['potensi_kerugian_qualitative'], $_POST['potensi_kerugian_nominal'], $_POST['owner_risk'],
        $_POST['nama_dept_unit'], $_POST['inherent_risk_likelihood'], $_POST['inherent_risk_impact'],
        $_POST['inherent_risk_level'], $_POST['pengendalian_ada_tidak'], $_POST['pengendalian_memadai_belum'],
        $_POST['pengendalian_sudah_belum'], $_POST['residual_risk_likelihood'], $_POST['residual_risk_impact'],
        $_POST['residual_risk_level'], $_POST['risk_treatment_accept_reduce'], $_POST['risk_treatment_text'] ,$_POST['jan'] ,$_POST['feb'] ,$_POST['mar'] ,$_POST['apr'] ,$_POST['mei'] ,$_POST['jun'] ,$_POST['jul'] ,$_POST['agu'] ,$_POST['sep'] ,$_POST['okt'] ,$_POST['nov'] ,$_POST['des'] ,$_POST['risk_evidence'],
        $_POST['target_risk_likelihood'], $_POST['target_risk_impact'], $_POST['target_risk_level']
    );

    if ($stmt->execute()) {
        header("Location: riskList.php"); // Redirect ke halaman lain
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
}

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Risk Register</title>
    <link rel="stylesheet" href="../css/dashboard.css"> <!-- Tambahkan file CSS -->
    <style>
        .month-row {
            align-items: center;
            gap: 20px; /* Jarak antar elemen */
        }

        .month-label {
            width: 100px; /* Lebar label bulan */
            font-weight: bold;
        }

        .options {
            display: flex;
            gap: 10px; /* Jarak antara pilihan True/False */
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <!-- Sidebar -->
        <div class="sidebar">
            <h2>Aplikasi Risk Management</h2>
            <h3>Selamat Datang</h3>
            <p><?php echo $_SESSION['nama']; ?></p>
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

                    <!-- HTML Part -->
<label>Rencana Mitigasi</label>
<div class="month-row">
    <?php
    // Array of months for cleaner code
    $months = [
        'jan' => 'Januari',
        'feb' => 'Februari',
        'mar' => 'Maret',
        'apr' => 'April',
        'mei' => 'Mei',
        'jun' => 'Juni',
        'jul' => 'Juli',
        'agu' => 'Agustus',
        'sep' => 'September',
        'okt' => 'Oktober',
        'nov' => 'November',
        'des' => 'Desember'
    ];

    // Generate form fields for each month
    foreach ($months as $key => $monthName) {
        echo '<label class="month-label">' . $monthName . ':</label>';
        echo '<div class="options">';
        echo '<label><input type="radio" name="' . $key . '" value="1" required> Agendakan</label>';
        echo '<label><input type="radio" name="' . $key . '" value="0"> Tidak</label>';
        echo '</div>';
    }
    ?>
</div>



<!-- CSS Part -->
<style>
.month-row {
    display: grid;
    gap: 15px;
    margin: 20px 0;
}

.month-label {
    width: 100px;
    font-weight: bold;
}

.options {
    display: flex;
    gap: 20px;
}

.options label {
    display: flex;
    align-items: center;
    gap: 5px;
}
</style>

        <label>Evidence:</label><br>
        <textarea name="risk_evidence" required></textarea><br>

        <label>Score Target (Likelihood, Impact, Level):</label><br>
        <input type="number" name="target_risk_likelihood" required>
        <input type="number" name="target_risk_impact" required>
        <input type="number" name="target_risk_level" required><br>

        <input type="hidden" name="owner_risk" value="Nama User">
        <button type="submit">Simpan</button>
    </form>
        </div>
    </div>
</body>
</html>
