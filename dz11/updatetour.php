<?php
header('Access-Control-Allow-Methods: GET, POST');
include("functions.php");
if(isset($_POST['country']) && isset($_POST['name']) && isset($_POST['location']) && isset($_POST['num_of_days']) && isset($_POST['id']))
{
$country = $_POST['country'];
$name = intval($_POST['name']);
$location = intval($_POST['location']);
$num_of_days = intval($_POST['num_of_days']);
$id = intval($_POST['id']);
echo updateTour($country,$name,$location,$num_of_days,$id);
}
?>