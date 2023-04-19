<?php
    session_start();
    unset($_SESSION['auth']);
    unset($_SESSION['auth_user']);

    $_SESSION['message'] = "Logged out successfuly";
    header("Location: Login.php");
?>