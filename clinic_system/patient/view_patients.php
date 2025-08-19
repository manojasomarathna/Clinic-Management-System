<?php
include '../db.php';

// Pagination settings
$limit = 10;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start_from = ($page - 1) * $limit;

// Total records for pagination
$total_result = $conn->query("SELECT COUNT(*) AS total FROM patient");
$total_row = $total_result->fetch_assoc();
$total_records = $total_row['total'];
$total_pages = ceil($total_records / $limit);

// Fetch patients
$result = $conn->query("SELECT * FROM patient ORDER BY patient_id DESC LIMIT $start_from, $limit");
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Patients</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body {
            background-image: url('https://images.unsplash.com/photo-1588776814546-ec7d82f1f9d0?auto=format&fit=crop&w=1470&q=80');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
        }

        body::before {
            content: '';
            position: fixed;
            top: 0; left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.9); /* white overlay */
            z-index: -1;
        }

        .container {
            margin-top: 50px;
            max-width: 950px;
            background: rgba(255, 255, 255, 0.95);
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.2);
        }

        h2 {
            color: #0d6efd;
            font-weight: 700;
        }

        .btn-edit {
            background-color: #0d6efd;
            color: white;
        }
        .btn-edit:hover {
            background-color: #0b5ed7;
            color: white;
        }

        .btn-delete {
            background-color: #dc3545;
            color: white;
        }
        .btn-delete:hover {
            background-color: #bb2d3b;
            color: white;
        }

        .table thead th {
            background-color: #0d6efd;
            color: white;
        }
    </style>
</head>
<body>

<div class="container">
    <h2 class="mb-4">👥 Patient List</h2>
    <a href="add_patient.php" class="btn btn-success mb-3">➕ Add New Patient</a>

    <table class="table table-bordered table-hover align-middle text-center">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>NIC</th>
                <th>Contact Number</th>
                <th>Address</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($row['patient_id']) ?></td>
                    <td><?= htmlspecialchars($row['title']) ?></td>
                    <td><?= htmlspecialchars($row['first_name']) ?></td>
                    <td><?= htmlspecialchars($row['last_name']) ?></td>
                    <td><?= htmlspecialchars($row['nic']) ?></td>
                    <td><?= htmlspecialchars($row['contact_number']) ?></td>
                    <td><?= htmlspecialchars($row['address']) ?></td>
                    <td>
                        <a href="edit_patient.php?id=<?= $row['patient_id'] ?>" class="btn btn-sm btn-edit">✏️ Edit</a>
                        <button class="btn btn-sm btn-delete" onclick="confirmDelete(<?= $row['patient_id'] ?>)">🗑️ Delete</button>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr><td colspan="8">No patient records found.</td></tr>
        <?php endif; ?>
        </tbody>
    </table>

    <!-- Pagination -->
    <nav aria-label="Page navigation">
        <ul class="pagination justify-content-center">
            <?php if ($page > 1): ?>
            <li class="page-item"><a class="page-link" href="?page=<?= $page-1 ?>">Previous</a></li>
            <?php endif; ?>

            <?php for ($p = 1; $p <= $total_pages; $p++): ?>
                <li class="page-item <?= ($p == $page) ? 'active' : '' ?>">
                    <a class="page-link" href="?page=<?= $p ?>"><?= $p ?></a>
                </li>
            <?php endfor; ?>

            <?php if ($page < $total_pages): ?>
            <li class="page-item"><a class="page-link" href="?page=<?= $page+1 ?>">Next</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</div>

<?php if (isset($_GET['msg'])): ?>
<script>
document.addEventListener('DOMContentLoaded', function () {
    <?php if ($_GET['msg'] === 'deleted'): ?>
    Swal.fire({
        icon: 'success',
        title: 'Deleted!',
        text: 'Patient record has been deleted.',
        timer: 2000,
        showConfirmButton: false
    });
    <?php elseif ($_GET['msg'] === 'error'): ?>
    Swal.fire({
        icon: 'error',
        title: 'Error!',
        text: 'Unable to delete patient record.',
    });
    <?php endif; ?>
});
</script>
<?php endif; ?>

<script>
function confirmDelete(id) {
    Swal.fire({
        title: 'Are you sure?',
        text: "Patient record will be permanently deleted!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = 'delete_patient.php?id=' + id;
        }
    })
}
</script>

</body>
</html>
