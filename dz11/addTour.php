<?php
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header("Access-Control-Allow-Headers: X-XSRF-TOKEN");
include("config.php");

if(isset($_POST['country']) && isset($_POST['name']) && isset($_POST['location']) && isset($_POST['num_of_days']))
{
$country = $_POST['country'];
$name = $_POST['name'];
$location = $_POST['location'];
$num_of_days = $_POST['num_of_days'];
$stmt = $conn->prepare("INSERT INTO tour (country, name, location,
num_of_days) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $country, $name, $location, $num_of_days);
$stmt->execute();
echo "ok";
}
?>