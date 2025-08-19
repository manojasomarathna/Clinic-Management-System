<?php
include '../db.php';

// Fetch appointments with patient and doctor details
$query = "SELECT 
            a.appointment_id,
            CONCAT(p.title, ' ', p.first_name, ' ', p.last_name) AS patient_name,
            d.name AS doctor_name,
            a.appointment_date,
            a.appointment_time,
            a.status
          FROM appointment a
          JOIN patient p ON a.patient_id = p.patient_id
          JOIN doctor d ON a.doctor_id = d.doctor_id
          ORDER BY a.appointment_date DESC, a.appointment_time DESC";

$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Appointment List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #e0f7fa, #ffffff);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .table thead {
            background-color: #0d6efd;
            color: white;
        }

        .table-hover tbody tr:hover {
            background-color: #f1f1f1;
        }

        .container {
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.15);
        }

        .badge-pending {
            background-color: #ffc107;
        }

        .badge-completed {
            background-color: #28a745;
        }

        .heading-icon {
            color: #0d6efd;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4 text-center">
        <i class="bi bi-calendar-check heading-icon"></i> Appointment List
    </h2>

    <table class="table table-bordered table-hover align-middle">
        <thead>
            <tr>
                <th>ID</th>
                <th>Patient Name</th>
                <th>Doctor</th>
                <th>Date</th>
                <th>Time</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result->num_rows > 0): ?>
                <?php while($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= $row['appointment_id'] ?></td>
                        <td><?= htmlspecialchars($row['patient_name']) ?></td>
                        <td><?= htmlspecialchars($row['doctor_name']) ?></td>
                        <td><?= $row['appointment_date'] ?></td>
                        <td><?= date("g:i A", strtotime($row['appointment_time'])) ?></td>
                        <td>
                            <?php if ($row['status'] == 'Pending'): ?>
                                <span class="badge badge-pending">Pending</span>
                            <?php else: ?>
                                <span class="badge badge-completed">Completed</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6" class="text-center text-muted">No appointments found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
</body>
</html>
