<?php
session_start();
if(!isset($_SESSION['user_id'])) {
    header("Location: http://localhost:8080/login");
    exit();
}
?>
