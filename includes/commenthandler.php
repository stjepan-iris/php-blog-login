<?php
session_start();

include("../db.php");

if(isset($_GET['action']) && $_GET['action'] == "delete"){

    
    $postId  = $_GET['postid'];

    $query = "DELETE FROM comments WHERE id=".$_GET['id'];
    $tabort = $dbh->exec($query);
    header("location:../views/writepost.php?action=write&id=$postId");

    
}
else{




    $comment = (!empty($_POST['comment']) ? $_POST['comment'] : "");
    $postId  = (!empty($_POST['postid']) ? $_POST['postid'] : "");

    $comment = htmlspecialchars($comment);


    $errors = false;
    $errorMessages = "";

    
    if(empty($_POST['comment'])){
        $errorMessages .= "du måste skriva ett medelande";
        $errors = true;
    }


    if($errors == true){
        echo $errorMessages;
        echo '<a href="commentform.php">gå tillbaka</a>';
        die;

    }
    
    $userid = $_SESSION['id'];
    $query = "INSERT INTO comments (comment,postid, userid) VALUES(:comment, :postid ,:id);";

    $sth = $dbh->prepare($query);
    $sth->bindParam(':comment', $comment);
    $sth->bindParam(':postid', $postId);
    $sth->bindParam(':id', $userid);

 

    $return = $sth->execute();


    if(!$return){
    print_r($dbh->errorInfo());
    }
    else{
        
        header("location:../views/writepost.php?action=write&id= $postId ");
    }
}
?>