<?php
include '../db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize input
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
    $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
    $nic = mysqli_real_escape_string($conn, $_POST['nic']);
    $contact_number = mysqli_real_escape_string($conn, $_POST['contact_number']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);

    // Check if NIC already exists
    $checkNIC = "SELECT * FROM patient WHERE nic = '$nic'";
    $result = $conn->query($checkNIC);
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Saving Patient</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <style>
            body {
                background-image: url('https://images.unsplash.com/photo-1505751172876-fa1923c5c528?auto=format&fit=crop&w=1470&q=80');
                background-size: cover;
                background-position: center;
                background-repeat: no-repeat;
                height: 100vh;
                display: flex;
                justify-content: center;
                align-items: center;
                position: relative;
                margin: 0;
            }

            body::before {
                content: "";
                position: absolute;
                top: 0; left: 0; right: 0; bottom: 0;
                background: rgba(0, 0, 0, 0.5);
                z-index: -1;
            }
        </style>
    </head>
    <body>
    <?php
    if ($result->num_rows > 0) {
        // NIC already exists
        echo "
        <script>
            Swal.fire({
                icon: 'warning',
                title: 'Duplicate NIC!',
                text: 'A patient with NIC $nic already exists.',
                confirmButtonColor: '#ffc107'
            }).then(() => {
                window.history.back();
            });
        </script>";
    } else {
        // Insert if NIC not exists
        $sql = "INSERT INTO patient (title, first_name, last_name, nic, contact_number, address)
                VALUES ('$title', '$first_name', '$last_name', '$nic', '$contact_number', '$address')";

        if ($conn->query($sql) === TRUE) {
            echo "
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Patient Added!',
                    text: 'Patient was successfully registered.',
                    confirmButtonColor: '#198754'
                }).then(() => {
                    window.location.href = 'view_patients.php';
                });
            </script>";
        } else {
            $errorMsg = addslashes($conn->error);
            echo "
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Database Error!',
                    text: '$errorMsg',
                    confirmButtonColor: '#dc3545'
                }).then(() => {
                    window.history.back();
                });
            </script>";
        }
    }

    $conn->close();
    ?>
    </body>
    </html>
    <?php
} else {
    header("Location: add_patient.php");
    exit();
}
?>
