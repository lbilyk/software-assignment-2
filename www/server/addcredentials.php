<?php
session_start();

$username = $_POST['username'];
$password = $_POST['password'];

if($username && $password) {
    $validUsers = json_decode(file_get_contents('valid_users.json'));

    if($validUsers != null) {
        foreach ($validUsers as $user) {
            if ($user->username == $username) {
                echo "exists";
                return;
            }
        }
    }

    $validUsers[] = ['username' => $username, 'password' => $password];
    $jsonData = json_encode($validUsers, JSON_PRETTY_PRINT);

    if(file_put_contents('valid_users.json', $jsonData)) {
        echo "success";
        return;
    }
}