<?php

$is_invalid = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    $mysqli = require __DIR__ . "/database.php";
    
    $sql = sprintf("SELECT * FROM user
                    WHERE email = '%s'",
                   $mysqli->real_escape_string($_POST["email"]));
    
    $result = $mysqli->query($sql);
    
    $user = $result->fetch_assoc();
    
    if ($user) {
        
        if (password_verify($_POST["password"], $user["password_hash"])) {
            
            session_start();
            
            session_regenerate_id();
            
            $_SESSION["user_id"] = $user["id"];
            $_SESSION["user_name"] = $user["name"];

            
            header("Location: initialtest.php");
            exit;
        }
    }
    
    $is_invalid = true;
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style_siginlogin.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

</head>
<body>
    <nav>
        <div class="logo">
            <a href="#" class="logo">
                <img src="logo2.png" alt="logo">
                <h2>SoftAnalytica</h2>
            </a>
        </div>
        <div class="toggle">
            <a href="#"><ion-icon name="menu-outline"></ion-icon></a>
        </div>
        <ul class="menu">
            <li><a href="aboutUs.html">About</a></li>
            <li><a href="contact.php">Contact us</a></li>
            <li><a href="signup.html"><button class="signup-btn">SignUp</button></a></li>
        </ul>     
    </nav>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>

    <script>
    document.addEventListener("DOMContentLoaded", function() {
        const toggle = document.querySelector(".toggle a");
        const menu = document.querySelector(".menu");

        toggle.addEventListener("click", function(e) {
            e.preventDefault();
            menu.classList.toggle("active");
            if (menu.classList.contains("active")) {
                toggle.innerHTML = "<ion-icon name='close-outline'></ion-icon>";
            } else {
                toggle.innerHTML = "<ion-icon name='menu-outline'></ion-icon>";
            }
        });
    });
</script>
    <?php if ($is_invalid): ?>
        <em>Invalid login</em>
    <?php endif; ?>
    <div class="container">
        <div class="form-box">
            <form method="post">
            <h2>Login</h2>
            <div class="input-box">
                 <i class="bx bxs-envelope"></i>
                <input type="email" id="email" name="email" placeholder="Email"
                value="<?= htmlspecialchars($_POST["email"] ?? "") ?>">
            </div>
                
            <div class="input-box">
                <i class="bx bxs-lock-alt"></i>
                <input type="password" id="password" name="password" placeholder="password">
            </div>
            <div class="button">
                <input type="submit" class="btn" value="Login">
            </div>
            <div class="group">
                <span style="font-size: 18px"><a href="forgot-password.php">Forgot Password?</a></span>
            </div>
            </form>
        </div>
    </div>
    <footer>
        <div class="footer-content">
            <p> Designed and Developed by Team Trouble Shouters. All rights reserved.<br>&copy; Copyright 2024
            </p>
        </div>
    </footer>

</body>
</html>