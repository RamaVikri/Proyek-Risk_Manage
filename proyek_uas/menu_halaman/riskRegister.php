<?php
session_start();
require_once '../conn.php';

if ($_SESSION['status'] == "") {
    header("location:index.php?pesan=gagal");
}

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
    <link rel="stylesheet" href="../css/dashboard.css">
    <link rel="stylesheet" href="../css/riskRegister.css">
    <style>
        /* CSS untuk Tata Letak Form */
        .risk-form {
            display: grid;
            gap: 15px;
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .form-row {
            display: grid;
            grid-template-columns: 200px 1fr;
            gap: 10px;
            align-items: center;
        }

        .form-row label {
            font-weight: bold;
        }
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

        .form-row input,
        .form-row select,
        .form-row textarea {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 100%;
            box-sizing: border-box;
        }

        button[type="submit"] {
            margin-top: 20px;
            padding: 10px 15px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
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
                <?php if ($_SESSION['status'] == 'admin' || $_SESSION['status'] == 'rektor' || $_SESSION['status'] == 'dekan') : ?>
                <li><a href="riskRegister.php">Risk Register</a></li>
                <?php endif; ?>
                <li><a href="riskList.php">Risk List</a></li>
                <li><a href="riskTreatments.php">Risk Treatments</a></li>
                <?php if ($_SESSION['status'] == 'admin' || $_SESSION['status'] == 'rektor') : ?>
                    <li><a href="../menu_add_user/daftar_user.php">Daftar User</a></li>
                <?php endif; ?>
                <li><a href="../logout.php">Logout</a></li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <form method="POST" class="risk-form">
                <h3>Input Data Risiko</h3>
                <div class="form-row">
                    <label>Objective dan Tujuan:</label>
                    <input type="text" name="objective_tujuan" required>
                </div>
                <div class="form-row">
                    <label>Proses Bisnis:</label>
                    <textarea name="proses_bisnis" required></textarea>
                </div>
                <div class="form-row">
                    <label>Risk Category:</label>
                    <select name="risk_category" required>
                        <option>Resiko Stratejik</option>
                        <option>Resiko Finansial</option>
                        <option>Resiko Operasional</option>
                        <option>Lainnya</option>
                    </select>
                </div>
                <div class="form-row">
                    <label>Risk Event:</label>
                    <textarea name="risk_event" required></textarea>
                </div>
                <div class="form-row">
                    <label>Penyebab Resiko:</label>
                    <textarea name="penyebab_resiko" required></textarea>
                </div>
                <div class="form-row">
                    <label>Sumber Resiko:</label>
                    <select name="sumber_resiko" required>
                        <option>Internal</option>
                        <option>External</option>
                    </select>
                </div>
                <div class="form-row">
                    <label>Potensi Kerugian (Kualitatif):</label>
                    <input type="text" name="potensi_kerugian_qualitative" required>
                </div>
                <div class="form-row">
                    <label>Potensi Kerugian (Nominal Rp):</label>
                    <input type="number" name="potensi_kerugian_nominal" required>
                </div>
                <div class="form-row">
                    <label>Nama Dept/Unit Terkait:</label>
                    <input type="text" name="nama_dept_unit" required>
                </div>
                <div class="form-row">
                    <label>Score Inherent Risk:</label>
                    <div>
                        <input type="number" name="inherent_risk_likelihood" placeholder="Likelihood" required>
                        <input type="number" name="inherent_risk_impact" placeholder="Impact" required>
                        <input type="number" name="inherent_risk_level" placeholder="Level" required>
                    </div>
                </div>
                <div class="form-row">
                    <label>Risk Treatment:</label>
                    <select name="risk_treatment_accept_reduce" required>
                        <option>Accept</option>
                        <option>Reduce</option>
                    </select>
                </div>
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
                <div class="form-row">
                    <label>Evidence:</label>
                    <textarea name="risk_evidence" required></textarea>
                </div>
                <div class="form-row">
                    <label>Score Target:</label>
                    <div>
                        <input type="number" name="target_risk_likelihood" placeholder="Likelihood" required>
                        <input type="number" name="target_risk_impact" placeholder="Impact" required>
                        <input type="number" name="target_risk_level" placeholder="Level" required>
                    </div>
                </div>
                <input type="hidden" name="owner_risk" value="<?php echo $_SESSION['nama']; ?>">
                <button type="submit">Simpan</button>
            </form>
        </div>
    </div>
</body>
</html>

