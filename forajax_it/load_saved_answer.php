<?php
session_start();

$questionno = $_GET['questionno'];

if (isset($_SESSION['answers'][$questionno])) {
    echo $_SESSION['answers'][$questionno];
} else {
    echo '';
}
?>

