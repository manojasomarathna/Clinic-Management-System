<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clinic Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Clinic System</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <!-- Patient Menu -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Patients</a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="patient/add_patient.php">Add Patient</a></li>
            <li><a class="dropdown-item" href="patient/view_patients.php">View Patients</a></li>
          </ul>
        </li>
        <!-- Appointment Menu -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Appointments</a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="appointment/add_appointment.php">Add Appointment</a></li>
            <li><a class="dropdown-item" href="appointment/view_appointments.php">View Appointments</a></li>
          </ul>
        </li>
        <!-- Reports Menu -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Reports</a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="reports/report_summary.php">Appointment Summary</a></li>
            <li><a class="dropdown-item" href="reports/report_by_doctor.php">Completed by Doctor</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>

<div class="container mt-4">
    <h2>Welcome to Clinic Management System</h2>
    <p>Use the menu above to manage patients, appointments, and reports.</p>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
