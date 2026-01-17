<?php
session_start();
include "db.php";

if (!isset($_SESSION["username"])) {
    header("Location: signin.php");
    exit();
}

$id = $_GET["id"];

// fetch appointment
$stmt = $conn->prepare("SELECT * FROM appointments WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$appointment = $stmt->get_result()->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $doctor = $_POST["doctor"];
    $date = $_POST["date"];
    $time = $_POST["time"];
    $reason = $_POST["reason"];

    $stmt = $conn->prepare(
        "UPDATE appointments 
         SET doctor_name=?, appointment_date=?, appointment_time=?, reason=? 
         WHERE id=?"
    );
    $stmt->bind_param("ssssi", $doctor, $date, $time, $reason, $id);
    $stmt->execute();

    header("Location: clinic.php");
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Edit Appointment</title>
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
    <h2>Edit Appointment</h2>

    <form method="post">
        <input type="text" name="doctor" value="<?php echo htmlspecialchars($appointment["doctor_name"]); ?>" required>
        <input type="date" name="date" value="<?php echo $appointment["appointment_date"]; ?>" required>
        <input type="time" name="time" value="<?php echo $appointment["appointment_time"]; ?>" required>
        <textarea name="reason"><?php echo htmlspecialchars($appointment["reason"]); ?></textarea>
        <button type="submit">Update</button>
        <br><br>
        <a href="clinic.php" class="button">Back</a>
    </form>
</div>

</body>
</html>
