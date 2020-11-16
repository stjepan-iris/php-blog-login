<?php
include("../db.php");

    $firstName = (!empty($_POST['firstname']) ? $_POST['firstname'] : "");
    $lastName = (!empty($_POST['lastname']) ? $_POST['lastname'] : "");
    $email = (!empty($_POST['email']) ? $_POST['email'] : "");
    $userName = (!empty($_POST['username']) ? $_POST['username'] : "");
    $password = md5((!empty($_POST['password']) ? $_POST['password'] : ""));
    

    $query = "SELECT username FROM users WHERE username = '$userName'";
    $return = $dbh->query($query);
    
    $row = $return->fetch(PDO::FETCH_ASSOC);
    if($row > 0){
        echo '<script>alert("Användarnamnet finns redan");</script>';
        echo "<a href='../views/signupform.php'> Gå tillbacka</a>";

    } else{

    $query2 = "INSERT INTO users (FirstName,LastName,Email,UserName,Password) VALUES('$firstName','$lastName','$email', '$userName', '$password');";
    $return2 = $dbh->exec($query2);
    if(!$return2){
        print_r($dbh->errorInfo());
        die;
        }
        else{
            session_start();
            $_SESSION['username'] = $_POST['username'];
            header("location:../index.php");
        } 
    }

?>