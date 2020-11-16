<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<?php
include("../db.php");

$username = $_POST['username'];
$password = md5($_POST['password']);

$query = "SELECT id, username, password, role FROM users WHERE username='$username' AND password='$password'";

$return = $dbh->query($query);

$row = $return->fetch(PDO::FETCH_ASSOC);

if(empty($row)){
    header("location:login.php?err=true");
    //echo "du kan inte logga in";
}else {
    //echo "du är inloggad";
    session_start();
    $_SESSION['username'] = $row['username'];
    $_SESSION['password'] = $row['password'];
    $_SESSION['role']     = $row['role'];
    $_SESSION['id']       = $row['id'];

    header("location:login.php");
}


?>
    
</body>
</html>