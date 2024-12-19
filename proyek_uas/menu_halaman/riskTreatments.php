<?php
session_start();
require_once '../conn.php';

if ($_SESSION['status'] == "") {
    header("location:index.php?pesan=gagal");
}

// Modify the SQL query to include the monthly columns
$sql = "SELECT id, risk_event, risk_treatment_text, nama_dept_unit, risk_evidence, 
        jan, feb, mar, apr, mei, jun, jul, agu, sep, okt, nov, des 
        FROM risk";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Menu</title>
    <link rel="stylesheet" href="../css/dashboard.css">
    <title>Treatments</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            text-align: center;
            padding: 8px;
        }
        th {
            background-color: #f4f4f4;
        }
        .editable {
            background-color: #fff;
            cursor: pointer;
        }
        .color-cell {
            width: 30px;
            height: 30px;
            cursor: pointer;
        }
        /* Style for completed (true/1) cells */
        .completed {
            background-color: #4CAF50; /* Green color */
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
                <li><a href="riskTreatments.php">Risk Treatmens</a></li>
                <?php if ($_SESSION['status'] == 'admin'): ?>
                    <li><a href="../menu_add_user/daftar_user.php">Daftar User</a></li>
                <?php endif; ?>
                <li><a href="../logout.php">Logout</a></li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <h1>Risk Mitigation Treatments</h1>
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Risk Event</th>
                        <th>Rencana Mitigasi</th>
                        <th colspan="12">Waktu Pelaksanaan Mitigasi</th>
                        <th>Evidence</th>
                        <th>PIC/Risk Owner</th>
                    </tr>
                    <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th>Jan</th>
                        <th>Feb</th>
                        <th>Mar</th>
                        <th>Apr</th>
                        <th>May</th>
                        <th>Jun</th>
                        <th>Jul</th>
                        <th>Aug</th>
                        <th>Sep</th>
                        <th>Oct</th>
                        <th>Nov</th>
                        <th>Dec</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        $no = 1;
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>{$row['id']}</td>";
                            echo "<td>{$row['risk_event']}</td>";
                            echo "<td>{$row['risk_treatment_text']}</td>";
                            
                            // Array of month column names from database
                            $months = ['jan', 'feb', 'mar', 'apr', 'mei', 'jun', 
                            'jul', 'agu', 'sep', 'okt', 'nov', 'des'];
                            
                            // Generate month cells with database values
                            foreach ($months as $month) {
                                // Add 'completed' class if the value is true/1
                                $class = ($row[$month] == 1) ? 'color-cell completed' : 'color-cell';
                                echo "<td class='{$class}' data-month='{$month}' data-id='{$row['id']}'></td>";
                            }

                            echo "<td>{$row['risk_evidence']}</td>";
                            echo "<td>{$row['nama_dept_unit']}</td>";
                            echo "</tr>";
                            $no++;
                        }
                    } else {
                        echo "<tr><td colspan='17'>Tidak ada data</td></tr>";
                    }
                    ?>
                </tbody>
            </table>

            <script>
                document.querySelectorAll('.color-cell').forEach(cell => {
                    cell.addEventListener('click', () => {
                        // Toggle the completed class
                        cell.classList.toggle('completed');
                        
                        // Get the current state (completed or not)
                        const isCompleted = cell.classList.contains('completed');
                        
                        // Get cell data
                        const month = cell.getAttribute('data-month');
                        const id = cell.getAttribute('data-id');
                        
                        // Send update to server
                        fetch('update_color.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                            },
                            body: JSON.stringify({
                                id: id,
                                month: month,
                                value: isCompleted ? 1 : 0
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            console.log('Update successful:', data);
                        })
                        .catch(error => {
                            console.error('Error updating:', error);
                            // Revert the visual change if update failed
                            cell.classList.toggle('completed');
                        });
                    });
                });
            </script>
        </div>
    </div>
</body>
</html>