<?php
require_once 'dbconfig.php';
session_start();

$username = $_POST['username'];
$password = $_POST['password'];

if ($username && $password) {
    global $mysqli;
    $query = "SELECT * FROM authorized_users WHERE username = ?";
    $statement = $mysqli->prepare($query);
    $statement->bind_param('s', $username);
    $statement->execute();
    $result = $statement->get_result();
    $user = $result->fetch_assoc();
    if ($user["username"] == $username && $user["password"] == $password) {
        $authenticated = true;
        $_SESSION['user'] = $user["username"];
        header('Location: ../index.php');
        exit();
}
    else {
        session_destroy();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Sign Up</title>
    <meta name="author" content="Lyubomyr Bilyk">
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Karla" rel="stylesheet">
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="../css/index.css" rel="stylesheet">
</head>
<body id="page-top" class="bg-secondary">
<nav class="navbar navbar-expand navbar-dark bg-dark static-top">
    <a class="navbar-brand mr-1 text-white">Project Website</a>
    <ul class="navbar-nav ml-auto mr-0 mr-md-3 my-2 my-md-0">
        <li class="nav-item dropdown no-arrow">
            <a href="../signup.html" class="nav-link d-inline">Sign Up</a>
            <a href="../login.html" class="nav-link d-inline active">Login</a>
        </li>
    </ul>
</nav>
<div class="container">
    <div class="card mx-auto mt-5">
        <div class="card-header mb-1 form-title font-weight-bold text-white">Log In</div>
        <div class="card-body">
            <form id="loginForm" action="../server/authorize.php" method="POST">
                <div class="form-group my-2">
                    <input type="text" id="user" name="username" class="form-control" placeholder="Username"
                           required="required" autofocus="autofocus" value="<?php echo $username ?>">
                    <div id="usernameErr" class="text-muted small text-center"></div>
                </div>

                <div class="form-group mb-2">
                    <input type="password" id="pass" name="password" class="form-control" placeholder="Password"
                           required="required" autofocus="autofocus" value="<?php echo $password ?>">
                    <div id="userPasswordErr" class="text-muted small text-center"></div>
                </div>
                <div class="text-muted text-danger">Username or Password is incorrect.</div>
                <div id="login" class="justify-content-center pt-2">
                    <input id="loginBtn" type="submit" value="Log In" class="btn btn-primary btn-block">
                </div>
            </form>
        </div>
        <hr/>
    </div>
</div>
<script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="../vendor/jquery/jquery.min.js"></script>
<script src="../js/index.js"></script>
</body>
</html>

