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
//----
// $sql = "SELECT inherent_risk_likelihood AS likelihood, 
//                inherent_risk_impact AS impact, 
//                COUNT(*) AS jumlah_risiko
//         FROM risk
//         GROUP BY inherent_risk_likelihood, inherent_risk_impact
//         ORDER BY inherent_risk_likelihood, inherent_risk_impact";

// $result = $conn->query($sql);

// // Menyusun data ke dalam array
// $matrixData = [];
// while ($row = $result->fetch_assoc()) {
//     $likelihood = $row['likelihood'];
//     $impact = $row['impact'];
//     $jumlah = $row['jumlah_risiko'];

//     $matrixData[$likelihood][$impact] = $jumlah;
// }

// // Inisialisasi matriks 5x5
// $matrix = [];
// for ($i = 1; $i <= 5; $i++) {
//     for ($j = 1; $j <= 5; $j++) {
//         $matrix[$i][$j] = $matrixData[$i][$j] ?? 0;
//     }
// }

//-baru
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
    <!-- <style>
        .matrix-container {
            width: 45%;
            margin: 20px auto;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            background-color: #ffffff;
            text-align: center;
        }
        .matrix-container h3 {
            margin-bottom: 10px;
            font-size: 18px;
        }
        .chart {
            width: 100%;
            height: 300px;
        }
    </style> -->
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
            width: 20%;
            height: 80px;
            font-size: 14px;
            position: relative;
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
            <div class="matrix-container"><h1>Risk Matrix</h1>
    <!-- <canvas id="riskMatrixChart" width="800" height="800"></canvas>

    <script>
        const matrixData = <?php echo json_encode($matrix); ?>;

        const labels = ["1-Minimal", "2-Minor", "3-Moderate", "4-Major", "5-Catastrophic"];
        const datasets = [];

        // Menyiapkan data untuk chart
        for (let i = 1; i <= 5; i++) {
            datasets.push({
                label: `Likelihood ${i}`,
                data: Object.values(matrixData[i]),
                backgroundColor: `rgba(${i * 50}, ${255 - i * 40}, ${100 + i * 30}, 0.8)`,
                borderWidth: 1
            });
        }

        const ctx = document.getElementById('riskMatrixChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: datasets
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top'
                    },
                    title: {
                        display: true,
                        text: 'Inherent Risk Matrix (Likelihood vs Impact)'
                    }
                },
                scales: {
                    x: { stacked: true },
                    y: { stacked: true }
                }
            }
        });
    </script> -->
    <h1 style="text-align: center;">Risk Matrix (Likelihood vs Impact)</h1>
    <table>
        <tr>
            <th rowspan="6" class="axis-label">Likelihood</th>
            <th class="axis-label"> </th>
            <th class="axis-label">1 - Sangat Rendah</th>
            <th class="axis-label">2 - Rendah</th>
            <th class="axis-label">3 - Sedang</th>
            <th class="axis-label">4 - Tinggi</th>
            <th class="axis-label">5 - Sangat Tinggi</th>
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

        // Membuat tabel 5x5
        for ($i = 5; $i >= 1; $i--) {
            echo "<tr>";
            echo "<th class='axis-label'>Likelihood $i</th>";
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
        $conn->close();
        ?>
        <tr>
            <th colspan="7" class="axis-label">Severity (Impact)</th>
        </tr>
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
