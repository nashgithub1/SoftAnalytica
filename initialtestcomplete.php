<?php
session_start();

if(!isset($_SESSION["user_id"]) )
{
    ?>

    <script type="text/javascript">
        window.location="login.php";
    </script>

    <?php
}
?>

<?php 
$mysqli = include "database.php";
include "headerwithouttimer.php";
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Completion Page</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container text-center mt-5">
        <h1>Congratulations, you completed!</h1>
        <br>
        <form action="old_quiz_results.php" method="post">
            <button type="submit" class="btn btn-primary">View your Results</button>
        </form>
    </div>
</body>
</html>
