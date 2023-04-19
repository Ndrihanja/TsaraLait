<?php

$url = $_SERVER['REQUEST_URI'];
$url = trim($url, '/');
$prms = explode('?' , $url);

if(!isset($prms[1])){
    include("Login.php");

}else {
    $action = explode("=", $prms[1])[1];
    $view = $action .".php";
    ob_start();
    include($view);
    $view_in = ob_get_clean();
    include('template.php');
}

