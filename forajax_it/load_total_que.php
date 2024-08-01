<?php
session_start();    
$mysqli = include "../database.php";
$total_que = 0;
$res = $mysqli->query("SELECT * from questions where category='$_SESSION[quiz_category]'");
$total_que =mysqli_num_rows($res);
echo $total_que;




?>