<?php
include("../db.php");
include("../classes/classes.php");
include("../views/writepost.php");


   
$id = $_GET['id'];
    $postid = (!empty($_GET['id']) ? $_GET['id'] : "");

  $comment = new comments($dbh);
  $comment->fetch($id);
  
  foreach($comment->getComments() as $row){
  
    echo "<span>comment:</span>" . " " . $row['comment']. "<br />";
    if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin'){
    echo "<a href='../includes/commenthandler.php?action=delete&id=" . $row['id'] . "&postid=".$postid ."'>Delete Comment!</a>";
  }
  echo "<hr/><br/>";
}
  
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/* $query = "SELECT * FROM comments where postid=:postid ";
$id = $_GET['id'];
$sth = $dbh->prepare($query);
$sth->bindParam(':postid', $id);
$return = $sth->execute();
$postid = (!empty($_GET['id']) ? $_GET['id'] : ""); */

/* while($row = $sth->fetch(PDO::FETCH_ASSOC)) {
    echo "<span>comment:</span>" . " " . $row['comment']. "<br />";
    if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin'){
    echo "<a href='commenthandler.php?action=delete&id=" . $row['id'] . "&postid=".$postid ."'>Delete Comment!</a>";
    }
    echo "<hr/><br/>";
}  */
?>