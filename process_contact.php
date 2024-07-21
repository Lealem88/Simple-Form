
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
    die("<h3 class='error'>Connection failed</h3><p>" . $conn->connect_error . "</p>");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and collect inputs
    $fullname = $_POST['fullname'] ?? '';
    $email = $_POST['email'] ?? '';
    $subject = $_POST['subject'] ?? '';
    $message = $_POST['message'] ?? '';
    $source = $_POST['source'] ?? 'Not specified';
    $contact_array = isset($_POST['contact_method']) ? $_POST['contact_method'] : [];
    
    // Combine array into a string for storage
    $contact_methods_str = !empty($contact_array) ? implode(", ", $contact_array) : 'None';

    $errors = [];

    // Basic Validation
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }
    if (empty($subject)) {
        $errors[] = "Subject cannot be empty.";
    }
    if (strlen($message) < 10) {
        $errors[] = "Message must be at least 10 characters.";
    }

    if (!empty($errors)) {
        echo "<h3 class='error'>Validation Errors</h3>";
        foreach ($errors as $e) {
            echo "<p class='error'>• $e</p>";
        }
    } else {
