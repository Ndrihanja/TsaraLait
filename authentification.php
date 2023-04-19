<?php
session_start();

if(!isset($_SESSION['auth']))
{
    $_SESSION['message'] = "Login to Access Dassh";
    header("Location: Login.php");
    exit(0);
}
else 
{
     
}