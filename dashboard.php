<?php
session_start();

if (!isset($_SESSION["username"])) {
    header("Location: signin.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
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
            padding: 50px;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            width: 400px;
            text-align: center;
        }
        h1 {
            color: #333;
            margin-bottom: 30px;
        }
        p {
            color: #555;
            font-size: 16px;
            margin-bottom: 40px;
        }
        a.button {
            display: inline-block;
            padding: 12px 30px;
            background-color: #f44336;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-weight: bold;
            transition: background 0.3s;
        }
        a.button:hover {
            background-color: #da190b;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Welcome, <?php echo htmlspecialchars($_SESSION["username"]); ?>!</h1>
        <p>You have successfully signed in. Enjoy your session!</p>
        <a href="clinic.php" class="button">Clinic Appointment</a>
        <a href="signout.php" class="button">Sign Out</a>
    </div>
</body>
</html>
