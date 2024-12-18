<?php
session_start();
require_once '../conn.php';

// Redirect jika tidak ada session
if ($_SESSION['status'] == "") {
    header("location:index.php?pesan=gagal");
    exit;
}

// Query untuk jumlah risiko per fakultas
$sqlFakultas = "SELECT nama_dept_unit AS fakultas, COUNT(*) AS jumlah_risiko FROM risk GROUP BY nama_dept_unit";
$resultFakultas = mysqli_query($conn, $sqlFakultas);

$fakultas = [];
$jumlahRisiko = [];
while ($row = mysqli_fetch_assoc($resultFakultas)) {
    $fakultas[] = "'".$row['fakultas']."'";
    $jumlahRisiko[] = $row['jumlah_risiko'];
}

// Query untuk risk category
$sqlCategory = "SELECT risk_category, COUNT(*) AS total_risiko FROM risk GROUP BY risk_category";
$resultCategory = mysqli_query($conn, $sqlCategory);

$kategoriRisiko = [];
$jumlahKategori = [];
while ($row = mysqli_fetch_assoc($resultCategory)) {
    $kategoriRisiko[] = "'".$row['risk_category']."'";
    $jumlahKategori[] = $row['total_risiko'];
}

// Query untuk mengambil data risk
$sql = "SELECT id, inherent_risk_likelihood AS likelihood, inherent_risk_impact AS impact
        FROM risk
        ORDER BY likelihood, impact";

$result = $conn->query($sql);

// Menyusun data ke dalam matriks 5x5
$matrix = [];
while ($row = $result->fetch_assoc()) {
    $likelihood = $row['likelihood'];
    $impact = $row['impact'];
    $id = $row['id'];

    // Menyusun kode_resiko di kotak yang sesuai
    $matrix[$likelihood][$impact][] = $id;
}

// Inisialisasi matriks kosong untuk sel-sel yang tidak ada datanya
for ($i = 1; $i <= 5; $i++) {
    for ($j = 1; $j <= 5; $j++) {
        if (!isset($matrix[$i][$j])) {
            $matrix[$i][$j] = [];
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Risk Matrix</title>
    <link rel="stylesheet" href="../css/dashboard.css"> <!-- Tambahkan file CSS -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> <!-- Chart.js CDN -->
    <style>
        table {
            border-collapse: collapse;
            margin: 20px auto;
            width: 60%;
            position: relative;
        }
        td, th {
        border: 1px solid black;
        text-align: center;
        width: 100px; /* Lebar tetap */
        height: 80px; /* Tinggi tetap */
        font-size: 14px;
        position: relative;
        word-wrap: break-word; /* Memastikan teks tetap di dalam kotak */
        overflow: hidden; /* Menghindari overflow konten */
        }
        /* Pewarnaan Sel */
        .low { background-color: #00b050; }
        .low-med { background-color: #92d050; }
        .medium { background-color: #ffff00; }
        .med-hi { background-color: #ffc000; }
        .high { background-color: #c00000; color: white; }

        /* Kode Risiko dalam Lingkaran */
        .risk-code {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 30px;
        height: 30px;
        margin: 2px; /* Memberi jarak antar risiko */
        border-radius: 50%;
        background-color: rgba(0, 0, 255, 0.7);
        color: white;
        font-size: 12px;
        font-weight: bold;
        }

        .axis-label {
            font-weight: bold;
            color: red;
        }

        .main-content{
            display: flex;
            flex-wrap: wrap;
        }

        .matrix-container{
            padding: 80px;
            margin: 20px;
            height: 80%;
            width: 80%;
            max-width: 700px;
            max-height: 700px;
        }

        .matrix1{
            width: 100%; /* Pastikan lebar 100% dari kontainer */
            height: 100%;
        table-layout: fixed; /* Membagi kolom secara merata */
        border-collapse: collapse; /* Menghilangkan jarak antar sel */
        }
        
        /* .chart{
            max-width: 60%;
            max-height: 60%;
        } */

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
                <li><a href="riskRegister.php">Risk Register</a></li>
                <li><a href="riskList.php">Risk List</a></li>
                <li><a href="#">Halaman B</a></li>
                <?php if ($_SESSION['status'] == 'admin'): ?>
                    <li><a href="../menu_add_user/daftar_user.php">Daftar User</a></li>
                <?php endif; ?>
                <li><a href="../logout.php">Logout</a></li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <h1>Risk Matrix Dashboard</h1>
            <!-- Matrix Likelihood dan Consequence -->
            <div class="matrix-container"><h1>Likelihood vs Impact</h1>
    <table class="matrix-container" >
        <tr>
        <tr>
            <th colspan="7" class="axis-label">Impact</th>
        </tr>
            <th rowspan="6" style="transform: rotate(270deg)" class="axis-label">Likelihood</th>
            <th class="axis-label"> </th>
            <th class="axis-label">Insignificant</th>
            <th class="axis-label">Minor</th>
            <th class="axis-label">Moderate</th>
            <th class="axis-label">Major</th>
            <th class="axis-label">VeryHigh</th>
        </tr>
        
        <?php
        // Koneksi ke database
        // $conn = new mysqli("localhost", "root", "", "riskman");

        // Periksa koneksi
        if ($conn->connect_error) {
            die("Koneksi gagal: " . $conn->connect_error);
        }

        // Ambil data risiko dari tabel risk
        $risks = [];
        $sql = "SELECT id, inherent_risk_likelihood AS likelihood, inherent_risk_impact AS impact FROM risk";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $risks[] = $row;
            }
        }

        // Pewarnaan berdasarkan Likelihood dan Impact
        $colorMapping = [
            5 => [ // Baris 5 (Likelihood 5)
                1 => 'low-med', 2 => 'medium', 3 => 'med-hi', 4 => 'high', 5 => 'high'
            ],
            4 => [ // Baris 4 (Likelihood 4)
                1 => 'low-med', 2 => 'medium', 3 => 'med-hi', 4 => 'med-hi', 5 => 'high'
            ],
            3 => [ // Baris 3 (Likelihood 3)
                1 => 'low', 2 => 'low-med', 3 => 'medium', 4 => 'med-hi', 5 => 'med-hi'
            ],
            2 => [ // Baris 2 (Likelihood 2)
                1 => 'low', 2 => 'low', 3 => 'low-med', 4 => 'medium', 5 => 'medium'
            ],
            1 => [ // Baris 1 (Likelihood 1)
                1 => 'low', 2 => 'low', 3 => 'low', 4 => 'low-med', 5 => 'low-med'
            ],
        ];

        // Array deskripsi Likelihood
$likelihoodLabels = [
    5 => "Almost Certain",
    4 => "Likely",
    3 => "Moderate",
    2 => "Unlikely",
    1 => "Rare"
];

// Mengubah tabel menjadi deskriptif
for ($i = 5; $i >= 1; $i--) {
    echo "<tr>";
    echo "<th class='axis-label'>{$likelihoodLabels[$i]}</th>"; // Menggunakan deskripsi dari array
    for ($j = 1; $j <= 5; $j++) {
        // Pewarnaan sel
        $colorClass = isset($colorMapping[$i][$j]) ? $colorMapping[$i][$j] : 'low';
        echo "<td class='$colorClass'>";

        // Menampilkan kode risiko sesuai Likelihood dan Impact
        if (!empty($risks)) {
            echo "<div style='display: flex; flex-wrap: wrap; justify-content: center; gap: 5px;'>";
            foreach ($risks as $risk) {
                if ($risk['likelihood'] == $i && $risk['impact'] == $j) {
                    echo "<div class='risk-code'>{$risk['id']}</div>";
                }
            }
            echo "</div>";
        }
        echo "</td>";
    }
    echo "</tr>";
}

        ?>
        
    </table>
            </div>

            <!-- Matrix Jumlah Risiko Per Fakultas -->
            <div class="matrix-container">
                <h3>Matrix Jumlah Risiko Per Fakultas</h3>
                <canvas id="facultyRiskMatrix" class="chart"></canvas>
            </div>

            <!-- Matrix Risk Category -->
            <div class="matrix-container">
                <h3>Matrix Risk Category</h3>
                <canvas id="categoryRiskMatrix" class="chart"></canvas>
            </div>
        </div>
    </div>

    <script>
        

        // Data untuk Matrix Jumlah Risiko Per Fakultas
        var ctxFaculty = document.getElementById("facultyRiskMatrix").getContext("2d");
        var facultyChart = new Chart(ctxFaculty, {
            type: "bar",
            data: {
                labels: [<?php echo implode(',', $fakultas); ?>],
                datasets: [{
                    label: "Jumlah Risiko",
                    data: [<?php echo implode(',', $jumlahRisiko); ?>],
                    backgroundColor: "rgba(153, 102, 255, 0.6)"
                }]
            }
        });

        // Data untuk Matrix Risk Category
        var ctxCategory = document.getElementById("categoryRiskMatrix").getContext("2d");
        var categoryChart = new Chart(ctxCategory, {
            type: "pie",
            data: {
                labels: [<?php echo implode(',', $kategoriRisiko); ?>],
                datasets: [{
                    data: [<?php echo implode(',', $jumlahKategori); ?>],
                    backgroundColor: ["#FF6384", "#36A2EB", "#FFCE56", "#4BC0C0"]
                }]
            }
        });
    </script>
</body>
</html>
