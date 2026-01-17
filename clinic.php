<?php
session_start();
include "db.php";

if (!isset($_SESSION["username"])) {
    header("Location: signin.php");
    exit();
}

$username = $_SESSION["username"];

// get user_id
$stmt = $conn->prepare("SELECT id FROM users WHERE username=?");
$stmt->bind_param("s", $username);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();
$user_id = $user["id"];

// get appointments
$stmt = $conn->prepare("SELECT * FROM appointments WHERE user_id=?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Clinic Appointment</title>
<style>
    body {
        font-family: Arial, sans-serif;
        background: #f0f2f5;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
    }
    .container {
        background: white;
        padding: 40px;
        border-radius: 12px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        width: 800px;
    }
    h1 {
        text-align: center;
        margin-bottom: 20px;
    }
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }
    th, td {
        padding: 10px;
        border-bottom: 1px solid #ddd;
        text-align: center;
    }
    th {
        background: #f44336;
        color: white;
    }
    a.button {
        padding: 8px 15px;
        background: #f44336;
        color: white;
        text-decoration: none;
        border-radius: 6px;
        font-size: 14px;
        margin: 3px;
        display: inline-block;
    }
    a.button:hover {
        background: #da190b;
    }
    .top-actions {
        text-align: center;
        margin-bottom: 15px;
    }
</style>
</head>
<body>

<div class="container">
    <h1>Clinic Appointments</h1>

    <div class="top-actions">
        <a href="add_appointment.php" class="button">Book Appointment</a>
        <a href="dashboard.php" class="button">Back</a>
    </div>

    <table>
        <tr>
            <th>Doctor</th>
            <th>Date</th>
            <th>Time</th>
            <th>Reason</th>
            <th>Status</th>
            <th>Action</th>
        </tr>

        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo htmlspecialchars($row["doctor_name"]); ?></td>
            <td><?php echo $row["appointment_date"]; ?></td>
            <td><?php echo $row["appointment_time"]; ?></td>
            <td><?php echo htmlspecialchars($row["reason"]); ?></td>
            <td><?php echo $row["status"]; ?></td>
            <td>
                <a href="edit_appointment.php?id=<?php echo $row["id"]; ?>" class="button">Edit</a>
                <a href="delete_appointment.php?id=<?php echo $row["id"]; ?>" 
                   class="button"
                   onclick="return confirm('Cancel this appointment?')">Delete</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</div>

</body>
</html>
