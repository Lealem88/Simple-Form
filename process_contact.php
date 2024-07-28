
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
        // Use Prepared Statements for security
        $stmt = $conn->prepare("INSERT INTO contacts (fullname, email, subject, message, source, contact_method) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $fullname, $email, $subject, $message, $source, $contact_methods_str);

        if ($stmt->execute()) {
            echo "<h3 class='success'>Message Sent Successfully!</h3>";
            echo "<p><span class='info-label'>Name:</span> $fullname</p>";
            echo "<p><span class='info-label'>Email:</span> $email</p>";
            echo "<p><span class='info-label'>Subject:</span> $subject</p>";
            
            echo "<div class='divider'></div>";
            
            echo "<p><span class='info-label'>Message:</span><br>$message</p>";
            echo "<p><span class='info-label'>Source:</span> $source</p>";
            echo "<p><span class='info-label'>Preferred Contact:</span> $contact_methods_str</p>";
        } else {
            echo "<h3 class='error'>Database Error</h3>";
            echo "<p>Could not save data: " . $stmt->error . "</p>";
        }
        $stmt->close();
    }
} else {
    echo "<h3>Invalid Request</h3>";
}

$conn->close();
?>
</div>

</body>
</html>