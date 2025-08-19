<?php
include '../db.php'; // DB connection

// Fetch doctor-wise appointment count
$query = "SELECT 
            d.doctor_id,
            d.name AS doctor_name,
            COUNT(a.appointment_id) AS total_appointments
          FROM doctor d
          LEFT JOIN appointment a ON d.doctor_id = a.doctor_id
          GROUP BY d.doctor_id, d.name
          ORDER BY total_appointments DESC";

$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Appointment Report</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #dbeafe, #e0f2fe, #f0f9ff);
            min-height: 100vh;
            font-family: Arial, sans-serif;
        }
        .report-card {
            background: white;
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
            margin-top: 50px;
            transition: transform 0.2s ease-in-out;
        }
        .report-card:hover {
            transform: translateY(-3px);
        }
        .table {
            border-radius: 8px;
            overflow: hidden;
        }
        thead {
            background-color: #1d4ed8;
            color: white;
        }
        h2 {
            font-weight: bold;
            color: #1e3a8a;
            text-align: center;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="report-card">
        <h2 class="mb-4">📊 Doctor Appointment Report</h2>
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead>
                    <tr>
                        <th>Doctor ID</th>
                        <th>Doctor Name</th>
                        <th>Total Appointments</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($result->num_rows > 0): ?>
                        <?php while($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?= $row['doctor_id'] ?></td>
                                <td><?= htmlspecialchars($row['doctor_name']) ?></td>
                                <td class="text-center"><span class="badge bg-primary fs-6"><?= $row['total_appointments'] ?></span></td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="3" class="text-center text-muted">No data found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
</html>
