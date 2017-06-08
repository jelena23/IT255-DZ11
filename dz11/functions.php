<?php
include("config.php");
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') 
{
    die();
}
function checkIfLoggedIn()
{
    global $conn;
    if(isset($_SERVER['HTTP_TOKEN']))
    {
        $token = $_SERVER['HTTP_TOKEN'];
        $result = $conn->prepare("SELECT * FROM user WHERE token=?");
        $result->bind_param("s",$token);
        $result->execute();
        $result->store_result();
        $num_rows = $result->num_rows;
        if($num_rows > 0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    else
    {
        return false;
    }
}

function login($username, $password)
{
    global $conn;
    $rarray = array();
    if(checkLogin($username,$password))
    {
        $user_id = sha1(uniqid());
        $result2 = $conn->prepare("UPDATE user SET token=? WHERE username=?");
        $result2->bind_param("ss",$user_id,$username);
        $result2->execute();
        $rarray['token'] = $user_id;
    } 
    else
    {
        header('HTTP/1.1 401 Unauthorized');
        $rarray['error'] = "Invalid username or password";
    }
    return json_encode($rarray);
}

function checkLogin($username, $password)
{
    global $conn;
    $password = md5($password);
    $result = $conn->prepare("SELECT * FROM user WHERE username=? AND password=?");
    $result->bind_param("ss",$username,$password);
    $result->execute();
    $result->store_result();
    $num_rows = $result->num_rows;
    if($num_rows > 0)
    {
        return true;
    }
    else
    {
        return false;
    }
}

function register($username, $password, $name, $surname)
{
    global $conn;
    $rarray = array();
    $errors = "";
    if(checkIfUserExists($username))
    {
        $errors .= "Username already exists.\r\n";
    }
    if(strlen($username) < 6)
    {
        $errors .= "Username must be at least 6 characters long.\r\n";
    }
    if(strlen($password) < 6)
    {
        $errors .= "Password must be at least 6 characters long.\r\n";
    }
    if(strlen($firstname) < 2)
    {
        $errors .= "First name must be at least 2 characters long.\r\n";
    }
    if(strlen($lastname) < 3)
    {
        $errors .= "Last name must be at least 3 characters long.\r\n";
    }
    if($errors == "")
    {
        $stmt = $conn->prepare("INSERT INTO user (name, surname, username, password) VALUES (?, ?, ?, ?)");
        $pass =md5($password);
        $stmt->bind_param("ssss", $name, $surname, $username, $pass);
        if($stmt->execute())
        {
            $user_id = sha1(uniqid());
            $result2 = $conn->prepare("UPDATE user SET token=? WHERE username=?");
            $result2->bind_param("ss",$user_id,$username);
            $result2->execute();
            $rarray['token'] = $user_id;
        }else
        {
            header('HTTP/1.1 400 Bad request');
            $rarray['error'] = "Database connection error";
        }
    }else
    {
        header('HTTP/1.1 400 Bad request');
        $rarray['error'] = json_encode($errors);
    }
    return json_encode($rarray);
}

function checkIfUserExists($username)
{
    global $conn;
    $result = $conn->prepare("SELECT * FROM user WHERE username=?");
    $result->bind_param("s",$username);
    $result->execute();
    $result->store_result();
    $num_rows = $result->num_rows;
    if($num_rows > 0)
    {
        return true;
    }
    else
    {
        return false;
    }
}

function addRoom($roomName, $hasTV, $beds){
global $conn;
$rarray = array();
if(checkIfLoggedIn()){
$stmt = $conn->prepare("INSERT INTO rooms (roomname, tv, beds) VALUES (?,
?, ?)");
$stmt->bind_param("sss", $roomName, $hasTV, $beds);
if($stmt->execute()){
$rarray['success'] = "ok";
}else{
$rarray['error'] = "Database connection error";
}
} else{
$rarray['error'] = "Please log in";
header('HTTP/1.1 401 Unauthorized');
}
return json_encode($rarray);
}
function getTours(){
global $conn;
$rarray = array();
$result = $conn->query("SELECT * FROM tour");
$num_rows = $result->num_rows;
$tours = array();
if($num_rows > 0)
{
$result2 = $conn->query("SELECT * FROM tour");
while($row = $result2->fetch_assoc()) {
$one_room = array();
$one_room['id'] = $row['id'];
$one_room['country'] = $row['country'];
$one_room['name'] = $row['name'];
$one_room['location'] = $row['location'];
$one_room['num_of_days'] = $row['num_of_days'];
array_push($tours,$one_room);
}
}
$rarray['data'] = $tours;
return json_encode($rarray); 
}

function deleteTour($id){
global $conn;
$rarray = array();
$result = $conn->prepare("DELETE FROM tour WHERE id=?");
$result->bind_param("i",$id);
$result->execute();
$rarray['success'] = "Deleted successfully";
return json_encode($rarray);
}

function getTour($id){
global $conn;
$rarray = array();
$result = $conn->query("SELECT * FROM tour WHERE id=".$id);
$num_rows = $result->num_rows;
$tours = array();
if($num_rows > 0)
{
$result2 = $conn->query("SELECT * FROM tour");
while($row = $result2->fetch_assoc()) {
$one_room = array();
$one_room['id'] = $row['id'];
$one_room['country'] = $row['country'];
$one_room['name'] = $row['name'];
$one_room['location'] = $row['location'];
$one_room['num_of_days'] = $row['num_of_days'];
$tours = $one_room;
}
}
$rarray['data'] = $tours;
return json_encode($rarray);

}
?>