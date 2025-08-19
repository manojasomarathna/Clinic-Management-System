<?php
include '../db.php';

// Get patient id from URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: view_patients.php");
    exit();
}

$patient_id = intval($_GET['id']);

// Fetch patient data
$sql = "SELECT * FROM patient WHERE patient_id = $patient_id";
$result = $conn->query($sql);

if ($result->num_rows != 1) {
    // No record found, redirect
    header("Location: view_patients.php");
    exit();
}

$patient = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize input
    $title = $conn->real_escape_string($_POST['title']);
    $first_name = $conn->real_escape_string($_POST['first_name']);
    $last_name = $conn->real_escape_string($_POST['last_name']);
    $nic = $conn->real_escape_string($_POST['nic']);
    $contact_number = $conn->real_escape_string($_POST['contact_number']);
    $address = $conn->real_escape_string($_POST['address']);

    // Update query
    $update_sql = "UPDATE patient SET
        title = '$title',
        first_name = '$first_name',
        last_name = '$last_name',
        nic = '$nic',
        contact_number = '$contact_number',
        address = '$address'
        WHERE patient_id = $patient_id";

    if ($conn->query($update_sql) === TRUE) {
        // Success message with SweetAlert and redirect
        echo "
        <!DOCTYPE html>
        <html>
        <head>
            <title>Updating Patient</title>
            <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css' rel='stylesheet'>
            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        </head>
        <body>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Updated!',
                text: 'Patient record updated successfully.',
                confirmButtonColor: '#198754'
            }).then(() => {
                window.location.href = 'view_patients.php';
            });
        </script>
        </body>
        </html>";
        exit();
    } else {
        $error = $conn->error;
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Patient</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding: 40px 0;
        }
        .form-container {
            max-width: 600px;
            margin: auto;
            background: #fff;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }
        h2 {
            color: #0d6efd;
            margin-bottom: 25px;
            font-weight: 700;
            text-align: center;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="form-container">
        <h2>Edit Patient</h2>

        <?php if (isset($error)): ?>
            <div class="alert alert-danger" role="alert">
                Error updating record: <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <form action="" method="POST" class="needs-validation" novalidate>
            <div class="mb-3">
                <label class="form-label">Title</label>
                <select name="title" class="form-select" required>
                    <option value="">Select</option>
                    <option value="Mr" <?= ($patient['title'] == 'Mr') ? 'selected' : '' ?>>Mr</option>
                    <option value="Mrs" <?= ($patient['title'] == 'Mrs') ? 'selected' : '' ?>>Mrs</option>
                    <option value="Miss" <?= ($patient['title'] == 'Miss') ? 'selected' : '' ?>>Miss</option>
                    <option value="Dr" <?= ($patient['title'] == 'Dr') ? 'selected' : '' ?>>Dr</option>
                </select>
                <div class="invalid-feedback">Please select a title.</div>
            </div>

            <div class="mb-3">
                <label class="form-label">First Name</label>
                <input type="text" name="first_name" class="form-control" required value="<?= htmlspecialchars($patient['first_name']) ?>">
                <div class="invalid-feedback">Please enter first name.</div>
            </div>

            <div class="mb-3">
                <label class="form-label">Last Name</label>
                <input type="text" name="last_name" class="form-control" required value="<?= htmlspecialchars($patient['last_name']) ?>">
                <div class="invalid-feedback">Please enter last name.</div>
            </div>

            <div class="mb-3">
                <label class="form-label">NIC</label>
                <input type="text" name="nic" class="form-control" required value="<?= htmlspecialchars($patient['nic']) ?>">
                <div class="invalid-feedback">Please enter NIC.</div>
            </div>

            <div class="mb-3">
                <label class="form-label">Contact Number</label>
                <input type="text" name="contact_number" class="form-control" required value="<?= htmlspecialchars($patient['contact_number']) ?>">
                <div class="invalid-feedback">Please enter contact number.</div>
            </div>

            <div class="mb-3">
                <label class="form-label">Address</label>
                <textarea name="address" class="form-control" rows="3" required><?= htmlspecialchars($patient['address']) ?></textarea>
                <div class="invalid-feedback">Please enter address.</div>
            </div>

            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary">Update Patient</button>
                <a href="view_patients.php" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>

<!-- Bootstrap validation script -->
<script>
    (function () {
        'use strict';
        var forms = document.querySelectorAll('.needs-validation');
        Array.prototype.slice.call(forms).forEach(function(form) {
            form.addEventListener('submit', function(event) {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    })();
</script>

</body>
</html>
