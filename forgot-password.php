<!DOCTYPE html>
<html>
<head>
    <title>Forgot Password</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style_siginlogin.css">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">


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
            <li><a href="#">About</a></li>
            <li><a href="#">Contact us</a></li>
            <li><a href="login.php"><button class="login-btn">Login</button></a></li>
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
<div class="container">
    <div class="form-box">
    
    <form method="post" action="send-password-reset.php">
        <h2>Forgot Password</h2>

        <div class="input-box">
            <i class="bx bxs-envelope"></i>
            <input type="email" id="email" name="email" placeholder="Email">
        </div>
        <div class="button">
            <input type="submit" class="btn" value="Send">
        </div>
    </form>
    </div>
</div>    
    <footer>
        <div class="footer-content">
            <p> Designed and Developed by Team Trouble Shouters. All rights reserved.<br>&copy; Copyright 2024</p>
        </div>
    </footer>

</body>
</html>