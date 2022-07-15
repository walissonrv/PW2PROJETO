<?php
session_start();
if(!isset($_SESSION['login-usuario'])){
    header('Location: login.php');
}
?>