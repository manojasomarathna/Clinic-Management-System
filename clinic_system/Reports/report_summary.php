<?php
include '../db.php'; // DB connection

// Total doctors
$total_doctors = $conn->query("SELECT COUNT(*) AS count FROM doctor")->fetch_assoc()['count'];

// Total patients
$total_patients = $conn->query("SELECT COUNT(*) AS count FROM patient")->fetch_assoc()['count'];

// Total appointments
$total_appointments = $conn->query("SELECT COUNT(*) AS count FROM appointment")->fetch_assoc()['count'];

// Today's appointments
$todays_appointments = $conn->query("
    SELECT COUNT(*) AS count 
    FROM appointment 
    WHERE DATE(appointment_date) = CURDATE()
")->fetch_assoc()['count'];

// Most active doctor
$most_active_doctor = $conn->query("
    SELECT d.name, COUNT(a.appointment_id) AS total
    FROM doctor d
    JOIN appointment a ON d.doctor_id = a.doctor_id
    GROUP BY d.doctor_id
    ORDER BY total DESC
    LIMIT 1
")->fetch_assoc();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Report Summary</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .card {
            border-radius: 10px;
            box-shadow: 0px 3px 8px rgba(0,0,0,0.1);
        }
        .card h5 {
            font-size: 1.2rem;
            font-weight: 600;
        }
        .card p {
            font-size: 1.5rem;
            font-weight: bold;
            color: #0d6efd;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4 text-center">Hospital Report Summary</h2>
    <div class="row g-4">

        <div class="col-md-3">
            <div class="card text-center p-3">
                <h5>Total Doctors</h5>
                <p><?= $total_doctors ?></p>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-center p-3">
                <h5>Total Patients</h5>
                <p><?= $total_patients ?></p>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-center p-3">
                <h5>Total Appointments</h5>
                <p><?= $total_appointments ?></p>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-center p-3">
                <h5>Today's Appointments</h5>
                <p><?= $todays_appointments ?></p>
            </div>
        </div>

    </div>

    <div class="row g-4 mt-4">
        <div class="col-md-6 offset-md-3">
            <div class="card text-center p-3 bg-light">
                <h5>Most Active Doctor</h5>
                <?php if ($most_active_doctor): ?>
                    <p><?= htmlspecialchars($most_active_doctor['name']) ?> (<?= $most_active_doctor['total'] ?> Appointments)</p>
                <?php else: ?>
                    <p>No data available</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
</body>
</html>
