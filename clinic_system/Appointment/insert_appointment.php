<?php
include '../db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $patient_id = $_POST['patient_id'];
    $doctor_id = $_POST['doctor_id'];
    $date = $_POST['appointment_date'];
    $time = $_POST['appointment_time'];
    $status = $_POST['status'];

    $stmt = $conn->prepare("INSERT INTO appointment (patient_id, doctor_id, appointment_date, appointment_time, status) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("iisss", $patient_id, $doctor_id, $date, $time, $status);

    // Start HTML output for SweetAlert
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Insert Appointment</title>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </head>
    <body>
    <?php

    if ($stmt->execute()) {
        // Success alert and redirect
        echo "
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Appointment Added!',
                text: 'The appointment was successfully scheduled.',
                confirmButtonColor: '#0d6efd',
            }).then(() => {
                window.location.href = 'view_appointments.php';
            });
        </script>";
    } else {
        // Error alert with detailed message and back option
        $errorMsg = addslashes($stmt->error);
        echo "
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: 'Failed to add appointment: {$errorMsg}',
                confirmButtonColor: '#dc3545',
            }).then(() => {
                window.history.back();
            });
        </script>";
    }

    $stmt->close();
    ?>
    </body>
    </html>
    <?php
} else {
    // If accessed directly without POST, redirect back to form
    header("Location: add_appointment.php");
    exit();
}
