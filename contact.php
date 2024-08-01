<?php
session_start(); // Start the session to store messages

 


// Include the database connection file
$mysqli = require __DIR__ . '../database.php'; // Adjust the path as needed

// Handle form submission
$message = "";
$message_type = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $mysqli->real_escape_string($_POST["name"]);
    $email = $mysqli->real_escape_string($_POST["email"]);
    $message_content = $mysqli->real_escape_string($_POST["message"]);

    // SQL query to insert data using prepared statements
    $stmt = $mysqli->prepare("INSERT INTO messages (name, email, message) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $message_content);

    if ($stmt->execute()) {
        $message = "Thank you! Your message has been sent.";
        $message_type = "success";
    } else {
        $message = "Error: " . $mysqli->error;
        $message_type = "error";
    }

    $stmt->close();
}

$mysqli->close(); // Close the database connection
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="contact.css">
</head>
<style>
    /* Importing Google font - Open Sans */
    @import url("https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500;600;700&display=swap");

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: "Open Sans", sans-serif;
    }

    body {
        height: 100vh;
        width: 100%;
        background: linear-gradient(135deg, #71b7e6, #9b59b6);
        display: flex;
        justify-content: center;
        align-items: center;
    }

    header {
        position: fixed;
        width: 100%;
        top: 0;
        left: 0;
        z-index: 10;
        padding: 1em 0;
        background-color: rgba(0, 0, 0, 0.5);
        text-align: center;
        color: white;
        font-size: 1.5em;
    }

    .main {
        padding: 1em;
        width: 100%;
        max-width: 500px;
    }

    .form-popup {
        background: #fff;
        border-radius: 10px;
        box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
        padding: 2em;
    }

    .form-content h2 {
        text-align: center;
        margin-bottom: 1em;
        color: #333;
    }

    .input-field {
        position: relative;
        margin-bottom: 1.5em;
    }

    .input-field input,
    .input-field textarea {
        width: 100%;
        padding: 0.75em;
        border: 1px solid #ccc;
        border-radius: 5px;
        outline: none;
        transition: all 0.3s ease;
    }

    .input-field input:focus,
    .input-field textarea:focus {
        border-color: #9b59b6;
    }

    .input-field label {
        position: absolute;
        top: 50%;
        left: 15px;
        transform: translateY(-50%);
        background: #fff;
        padding: 0 0.5em;
        color: #999;
        font-size: 0.85em;
        pointer-events: none;
        transition: all 0.3s ease;
    }

    .input-field input:focus~label,
    .input-field input:not(:placeholder-shown)~label,
    .input-field textarea:focus~label,
    .input-field textarea:not(:placeholder-shown)~label {
        top: -10px;
        left: 10px;
        color: #9b59b6;
        font-size: 0.75em;
    }

    textarea {
        resize: vertical;
    }

    button[type="submit"] {
        width: 100%;
        background: #9b59b6;
        color: #fff;
        border: none;
        padding: 0.75em;
        border-radius: 5px;
        font-size: 1em;
        cursor: pointer;
        transition: background 0.3s ease;
    }

    button[type="submit"]:hover {
        background: #8e44ad;
    }

    .notification {
        position: fixed;
        bottom: 10px;
        left: 50%;
        transform: translateX(-50%);
        background-color: #333;
        color: #fff;
        padding: 1em;
        border-radius: 5px;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .notification.show {
        opacity: 1;
    }

    .notification.success {
        background-color: #4CAF50;
    }

    .notification.error {
        background-color: #f44336;
    }

    .button-container {
        margin-top: 1em;
        text-align: center;
    }

    .button-container button {
        background: #3498db;
        color: #fff;
        border: none;
        padding: 0.75em;
        border-radius: 5px;
        font-size: 1em;
        cursor: pointer;
        transition: background 0.3s ease;
    }

    .button-container button:hover {
        background: #2980b9;
    }
</style>

<body>
    <header>
        <h2>SoftAnalytica</h2>
    </header>

    <main class="main">
        <section class="form-popup show-popup">
            <div class="form-box">
                <div class="form-content">
                    <h2>Contact Us</h2>
                    <form action="contact.php" method="POST">
                        <div class="input-field">
                            <input type="text" name="name" required>
                            <label for="name">Name</label>
                        </div>
                        <div class="input-field">
                            <input type="email" name="email" required>
                            <label for="email">Email</label>
                        </div>
                        <div class="input-field">
                            <textarea name="message" rows="4" required></textarea>
                            <label for="message">Message</label>
                        </div>
                        <button type="submit" name="submit">Submit</button>
                    </form>
                    <div class="button-container">
                        <button onclick="location.href='login.php'">Go to Login</button>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <?php if ($message): ?>
    <div class="notification <?php echo htmlspecialchars($message_type); ?>" id="notification"><?php echo htmlspecialchars($message); ?></div>
    <script>
        // Show notification
        document.addEventListener('DOMContentLoaded', function() {
            var notification = document.getElementById('notification');
            notification.classList.add('show');

            // Hide notification after 3 seconds
            setTimeout(function() {
                notification.classList.remove('show');
            }, 3000);
        });
    </script>
    <?php endif; ?>
</body>
</html>
