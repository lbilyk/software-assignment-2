<?php
require_once 'dbconfig.php';
session_start();

$username = $_POST['username'];
$password = $_POST['password'];

if($username && $password) {

    global $mysqli;
    $query = "SELECT * FROM authorized_users";
    $statement = $mysqli->prepare($query);
    $statement->execute();
    $result = $statement->get_result();
    while($user = mysqli_fetch_assoc($result)) {
        if($user['username'] == $username) {
            echo "exists";
            return;
        }
    }

    $query = "INSERT INTO authorized_users (username,password) VALUES(?,?)";
    $statement = $mysqli->prepare($query);
    $statement->bind_param("ss",$username,$password);
    $success = $statement->execute();
    if($success) {
        echo "success";
        return;
    }
}