<!-- contact.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Contact Form</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #667eea, #764ba2);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            width: 450px;
            background: rgba(255,255,255,0.1);
            backdrop-filter: blur(15px);
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.3);
            color: white;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            font-weight: 600;
        }

        label {
            display: block;
            margin-top: 15px;
            font-size: 14px;
        }

        input, textarea {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border-radius: 10px;
            border: none;
            outline: none;
            font-size: 14px;
            transition: 0.3s;
        }

        input:focus, textarea:focus {
            box-shadow: 0 0 10px #00f7ff;
        }

        textarea {
            resize: none;
            height: 100px;
        }

        .options {
            margin-top: 10px;
        }

        .options input {
            width: auto;
            margin-right: 5px;
        }

        .btn {
            width: 100%;
            margin-top: 20px;
            padding: 12px;
            border: none;
            border-radius: 30px;
            background: linear-gradient(135deg, #00f7ff, #00c3ff);
            color: black;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
        }

        .btn:hover {
            transform: scale(1.05);
            box-shadow: 0 0 15px #00f7ff;
        }

    </style>
</head>

<body>

<div class="container">
    <h2>Contact Us</h2>

    <form method="POST" action="process_contact.php">

        <label>Full Name</label>
        <input type="text" name="fullname" required>

        <label>Email Address</label>
        <input type="email" name="email" required>

        <label>Subject</label>
        <input type="text" name="subject" required>

        <label>Message</label>
        <textarea name="message" required></textarea>

        <label>How did you hear about us?</label>
        <div class="options">
            <input type="radio" name="source" value="Friend" required> Friend
            <input type="radio" name="source" value="Internet"> Internet
            <input type="radio" name="source" value="Advertisement"> Advertisement
        </div>

        <label>Preferred Contact Method</label>
        <div class="options">
            <input type="checkbox" name="contact_method[]" value="Email"> Email
            <input type="checkbox" name="contact_method[]" value="Phone"> Phone
        </div>

        <button type="submit" class="btn">Send Message</button>

    </form>
</div>

</body>
</html>
