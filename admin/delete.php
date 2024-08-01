<?php
session_start();
$mysqli = include "../database.php";
$id =  $_GET["id"];


$mysqli->query("DELETE FROM quiz_category WHERE id=$id");


?>

<script type="text/javascript">
    window.location="quiz_category.php";
</script>
