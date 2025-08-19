<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Add Patient</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />

  <style>
    body {
      background-image: url('https://images.unsplash.com/photo-1505751172876-fa1923c5c528?auto=format&fit=crop&w=1470&q=80');
      background-size: cover;
      background-repeat: no-repeat;
      background-position: center center;
      min-height: 100vh;
      font-family: 'Segoe UI', sans-serif;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 40px 15px;
      position: relative;
    }

    body::before {
      content: "";
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: rgba(0, 0, 0, 0.4);
      z-index: -1;
    }

    .form-container {
      background-color: rgba(255, 255, 255, 0.95);
      padding: 35px 30px;
      border-radius: 20px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
      width: 100%;
      max-width: 600px;
    }

    h2 {
      color: #2c3e50;
      font-weight: 700;
      text-align: center;
      margin-bottom: 25px;
    }

    label {
      font-weight: 600;
      color: #2c3e50;
    }

    .form-control,
    .form-select {
      border-radius: 10px;
      padding: 10px 14px;
      font-size: 15px;
    }

    .form-control:focus,
    .form-select:focus {
      border-color: #457999;
      box-shadow: 0 0 5px rgba(66, 125, 154, 0.5);
    }

    .btn-success {
      background-color: #27ae60;
      border: none;
      font-weight: 600;
      padding: 10px;
      font-size: 16px;
      border-radius: 10px;
    }

    .btn-success:hover {
      background-color: #219150;
    }

    .btn-secondary {
      background-color: #7f8c8d;
      font-weight: 600;
      padding: 10px;
      font-size: 16px;
      border-radius: 10px;
    }

    .btn-secondary:hover {
      background-color: #626e70;
    }
  </style>
</head>
<body>
  <div class="form-container">
    <h2>🩺 Add New Patient</h2>

    <form action="insert_patient.php" method="POST" class="needs-validation" novalidate>
      <div class="mb-3">
        <label>Title</label>
        <select name="title" class="form-select" required>
          <option value="">Select</option>
          <option value="Mr">Mr</option>
          <option value="Mrs">Mrs</option>
          <option value="Miss">Miss</option>
          <option value="Dr">Dr</option>
        </select>
        <div class="invalid-feedback">Please select a title.</div>
      </div>

      <div class="mb-3">
        <label>First Name</label>
        <input type="text" name="first_name" class="form-control" required />
        <div class="invalid-feedback">Please enter first name.</div>
      </div>

      <div class="mb-3">
        <label>Last Name</label>
        <input type="text" name="last_name" class="form-control" required />
        <div class="invalid-feedback">Please enter last name.</div>
      </div>

      <div class="mb-3">
        <label>NIC</label>
        <input type="text" name="nic" class="form-control" required />
        <div class="invalid-feedback">Please enter NIC.</div>
      </div>

      <div class="mb-3">
        <label>Contact Number</label>
        <input
          type="text"
          name="contact_number"
          class="form-control"
          required
          pattern="\d{10}"
          title="Enter 10-digit number"
        />
        <div class="invalid-feedback">Please enter a valid contact number.</div>
      </div>

      <div class="mb-4">
        <label>Address</label>
        <textarea name="address" class="form-control" rows="3" required></textarea>
        <div class="invalid-feedback">Please enter address.</div>
      </div>

      <div class="d-grid gap-2">
        <button type="submit" class="btn btn-success">💾 Save Patient</button>
        <a href="view_patients.php" class="btn btn-secondary">👀 View Patients</a>
      </div>
    </form>
  </div>

  <script>
    (function () {
      'use strict';
      var forms = document.querySelectorAll('.needs-validation');
      Array.prototype.slice.call(forms).forEach(function (form) {
        form.addEventListener(
          'submit',
          function (event) {
            if (!form.checkValidity()) {
              event.preventDefault();
              event.stopPropagation();
            }
            form.classList.add('was-validated');
          },
          false
        );
      });
    })();
  </script>
</body>
</html>
