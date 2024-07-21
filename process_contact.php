
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Submission Result</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #1d2671, #c33764);
            height: 100vh;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
        }

        .container {
            width: 450px;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(15px);
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        h3 { text-align: center; margin-top: 0; }
        .error { color: #ff6b6b; }
        .success { color: #4dff88; }
        .info-label { font-weight: bold; color: #ddd; }
        p { margin: 10px 0; line-height: 1.4; }
        .divider { border-top: 1px solid rgba(255, 255, 255, 0.2); margin: 15px 0; }
    </style>
</head>
<body>

<div class="container">
<?php
// Database Configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "contact_db";

// Create Connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check Connection
if ($conn->connect_error) {
