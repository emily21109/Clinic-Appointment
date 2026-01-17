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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $doctor = $_POST["doctor"];
    $date = $_POST["date"];
    $time = $_POST["time"];
    $reason = $_POST["reason"];

    $stmt = $conn->prepare(
        "INSERT INTO appointments 
        (user_id, doctor_name, appointment_date, appointment_time, reason)
        VALUES (?, ?, ?, ?, ?)"
    );
    $stmt->bind_param("issss", $user_id, $doctor, $date, $time, $reason);
    $stmt->execute();

    header("Location: clinic.php");
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Book Appointment</title>
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
        width: 400px;
        text-align: center;
    }
    input, textarea {
        width: 100%;
        padding: 10px;
        margin: 10px 0;
    }
    button, a.button {
        padding: 10px 20px;
        background: #f44336;
        color: white;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        text-decoration: none;
        display: inline-block;
    }
    button:hover, a.button:hover {
        background: #da190b;
    }
</style>
</head>
<body>

<div class="container">
    <h2>Book Appointment</h2>

    <form method="post">
        <input type="text" name="doctor" placeholder="Doctor Name" required>
        <input type="date" name="date" required>
        <input type="time" name="time" required>
        <textarea name="reason" placeholder="Reason"></textarea>
        <button type="submit">Save</button>
        <br><br>
        <a href="clinic.php" class="button">Back</a>
    </form>
</div>

</body>
</html>
