<?php
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Methods: GET');
header("Access-Control-Allow-Headers: X-XSRF-TOKEN");
include("functions.php");

echo getTours();
?>