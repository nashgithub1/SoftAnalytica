<?php
session_start();
$mysqli = include "../database.php";
$quiz_category = $_GET["quiz_category"];
$_SESSION["quiz_category"]= $quiz_category;
$res=$mysqli->query ("SELECT * from quiz_category where category ='$quiz_category'");
while ($row = mysqli_fetch_array($res)) {
    $_SESSION["quiz_time"]= $row["quiz_time_in_minutes"];
}
$date=date("Y-m-d H:i:s");

$_SESSION["end_time"]=date("Y-m-d H:i:s",strtotime($date."+$_SESSION[quiz_time] minutes"));
$_SESSION["quiz_start"]="yes";
?>