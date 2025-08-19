<?php
include '../db.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Delete Patient</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background-image: url('../images/hospital_bg.jpg'); /* replace with your image path */
            background-size: cover;
            background-position: center;
            font-family: Arial, sans-serif;
            color: white;
            text-align: center;
        }
        .message-box {
            margin-top: 20%;
            background-color: rgba(0, 0, 0, 0.7);
            padding: 40px;
            border-radius: 10px;
            display: inline-block;
        }
        a {
            color: #fff;
            text-decoration: underline;
        }
    </style>
</head>
<body>

<?php
if (isset($_GET['id'])) {
    $patient_id = intval($_GET['id']);

    $sql = "DELETE FROM patient WHERE patient_id = $patient_id";

    if ($conn->query($sql) === TRUE) {
        echo "<div class='message-box'>
                <h2>Patient Deleted Successfully</h2>
                <p><a href='view_patients.php'>Go back to Patient List</a></p>
              </div>";
    } else {
        echo "<div class='message-box'>
                <h2>Failed to Delete Patient</h2>
                <p><a href='view_patients.php'>Go back to Patient List</a></p>
              </div>";
    }
} else {
    echo "<div class='message-box'>
            <h2>No Patient ID Provided</h2>
            <p><a href='view_patients.php'>Go back to Patient List</a></p>
          </div>";
}
?>

</body>
</html>
