<?php
include '../db.php';

// Fetch patients
$patientResult = $conn->query("SELECT * FROM patient");

// Fetch doctors
$doctorResult = $conn->query("SELECT * FROM doctor");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Appointment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-image: url('https://images.unsplash.com/photo-1588776814546-ec7d82f1f9d0?auto=format&fit=crop&w=1470&q=80');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            height: 100vh;
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body::before {
            content: '';
            position: fixed;
            top: 0; left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255,255,255,0.9);
            z-index: -1;
        }

        .form-container {
            max-width: 600px;
            margin: 60px auto;
            background-color: rgba(255, 255, 255, 0.97);
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.2);
        }

        h2 {
            color: #0d6efd;
            font-weight: bold;
            margin-bottom: 30px;
        }

        label {
            font-weight: 500;
        }

        .btn-primary {
            background-color: #0d6efd;
            border: none;
        }

        .btn-primary:hover {
            background-color: #0b5ed7;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h2 class="text-center">📅 Add Appointment</h2>

    <form action="insert_appointment.php" method="POST" onsubmit="return validateForm()">
        
        <!-- Patient Selection -->
        <div class="mb-3">
            <label class="form-label">Patient:</label>
            <select name="patient_id" class="form-select" required>
                <option value="">-- Select Patient --</option>
                <?php while ($row = $patientResult->fetch_assoc()) { ?>
                    <option value="<?= htmlspecialchars($row['patient_id']) ?>">
                        <?= htmlspecialchars($row['title'] . ' ' . $row['first_name'] . ' ' . $row['last_name']) ?>
                    </option>
                <?php } ?>
            </select>
        </div>

        <!-- Doctor Selection -->
        <div class="mb-3">
            <label class="form-label">Doctor:</label>
            <select name="doctor_id" class="form-select" required>
                <option value="">-- Select Doctor --</option>
                <?php while ($row = $doctorResult->fetch_assoc()) { ?>
                    <option value="<?= htmlspecialchars($row['doctor_id']) ?>">
                        <?= htmlspecialchars($row['name']) ?>
                    </option>
                <?php } ?>
            </select>
        </div>

        <!-- Date -->
        <div class="mb-3">
            <label class="form-label">Date:</label>
            <input type="date" name="appointment_date" class="form-control" required>
        </div>

        <!-- Time -->
        <div class="mb-3">
            <label class="form-label">Time:</label>
            <input type="time" name="appointment_time" class="form-control" required>
        </div>

        <!-- Status -->
        <div class="mb-3">
            <label class="form-label">Status:</label>
            <select name="status" class="form-select" required>
                <option value="Pending">Pending</option>
                <option value="Completed">Completed</option>
            </select>
        </div>

        <!-- Submit -->
        <button type="submit" class="btn btn-primary w-100">➕ Add Appointment</button>
    </form>
</div>

<script>
function validateForm() {
    // You can add more custom validation if needed
    return true;
}
</script>

</body>
</html>
