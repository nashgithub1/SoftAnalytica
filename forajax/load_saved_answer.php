<?php
session_start();
$questionno = $_GET['questionno'];

if (isset($_SESSION['answer'][$questionno])) {
    echo $_SESSION['answer'][$questionno];
} else {
    echo '';
}
?>
