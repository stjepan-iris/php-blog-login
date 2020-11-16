<?php
include("../db.php");

session_start();

if(isset($_GET['action']) && $_GET['action'] == "write"){

    $query = "SELECT id,postTitle, postText, datePosted,Img,category FROM post WHERE id=:id LIMIT 1";
    $id = $_GET['id'];
    $sth = $dbh->prepare($query);
    $sth->bindParam(':id', $id);
    $return = $sth->execute();

    if (!$return) {
        print_r($dbh->errorInfo());
        die;
    }

    $row = $sth->fetch();
    
    echo '<img src="../img/'.$row['Img'].'" alt="post image"/><br />';
    echo "<span class='guestspan'>category:</span>" . " " . $row['category']. "<br />";
    echo "<span class='guestspan'>Title:</span>" . " " . $row['postTitle']. "<br />";
    echo"<span class='guestspan'>Post text:</span>" . " " . $row['postText']. "<br />";
    echo"<span class='guestspan'>Postat:</span>" . " " . $row['datePosted']. "<br />";
    if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin'){
    echo "<a href='../includes/adminposthandler.php?action=delete&id=" . $row['id'] . "'>DELETE!</a>";
    echo "  " . "<a href='../views/editform.php?id=" . $row['id'] . "'>Edit post!</a>";
    }
    echo"   " . "<a href='commentform.php?id=" . $row['id'] . "'>Comment</a>";
    echo"   " . "<a href='writecomment.php?action=write&id=" . $row['id'] . "'>Show Comments</a><br />";
    echo "  " . "<a href='../includes/login.php'>tillbacka</a>" . "  " . "<a href='../includes/logout.php'>logga ut</a>";
    echo "<hr/>";

  
    //header("location:../login/login.php"); */

}


?>