<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Our Site</title>
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
            text-align: center;
            background: white;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }
        h1 {
            margin-bottom: 30px;
            color: #333;
        }
        a.button {
            display: inline-block;
            margin: 10px;
            padding: 12px 25px;
            text-decoration: none;
            color: white;
            background-color: #4CAF50;
            border-radius: 8px;
            font-weight: bold;
            transition: background 0.3s;
        }
        a.button:hover {
            background-color: #45a049;
        }
        a.button.signup {
            background-color: #008CBA;
        }
        a.button.signup:hover {
            background-color: #007bb5;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Welcome to Our Website</h1>
        <a href="signin.php" class="button">Sign In</a>
        <a href="signup.php" class="button signup">Sign Up</a>
    </div>
</body>
</html>
