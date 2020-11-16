<?php

include("../db.php");


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<center>
<form method="GET" action="../views/adminpost.php">
<input type="search" name="search_query">
<input type="submit" name="submit">

</form>

</center>

<hr />

<?php 

        if(isset($_GET['search_query'])){
            $order = "desc";
            if(isset($_GET['order']) && $_GET['order'] == "ascending"){

                $order ="asc";

            }
            $searchQuery = $_GET['search_query'];
            $query = "SELECT id, postTitle, postText, datePosted FROM post WHERE postTitle LIKE :searchQuery OR postText LIKE :searchQuery ORDER BY datePosted $order";

            $sth = $dbh->prepare($query);
            $queryparam = '%' . $searchQuery .'%';
            $sth->bindParam(':searchQuery', $queryparam);


            $return = $sth->execute();

            if(!$return){
                print_r($sth->errorInfo());
                die;
            }

            echo "<h2>Sökresultat!</h2> Vi hittade ". $sth->rowCount() . " inlägg på sökordet $searchQuery! <hr />";

            echo '<center>Sortering: <a href="adminpost.php?order=ascending&search_query='.$searchQuery.'">Stigande</a> 
            | <a href="adminpost.php?order=descending&search_query='.$searchQuery.'">Fallande</a></center>';

            

            while($row = $sth->fetch(PDO::FETCH_ASSOC))
            {
            echo "<a href='../views/writepost.php?action=write&id=". $row['id'] ."'class='guestspan'>". $row['postTitle']."</a>" . "<br />";
            
            
        }
        echo "<br /> <center><a href='adminpost.php'>Tillbaka</a></center>";
    } else{


?>

<center>sortering: <a href="../includes/login.php?order=ascending">stigande</a> | <a href="../includes/login.php?order=descending">fallande</a></center>


<?php 


    $order = "desc";
    if(isset($_GET['order']) && $_GET['order'] == "ascending"){

        $order ="asc";

    }

    $query = "SELECT * FROM post ORDER BY datePosted $order";
    $rows = $dbh->query($query);

    
    while($row = $rows->fetch(PDO::FETCH_ASSOC)) {
        echo "<a href='../views/writepost.php?action=write&id=". $row['id'] ."'class='guestspan'>". $row['postTitle']."</a>" . "<br />";
    }

            if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin'){
                ?>
                <form action='../includes/adminposthandler.php' method='POST' enctype='multipart/form-data'>
                <br />
                <input type='text' name='category' placeholder='category' required>
                <br />
                <br />
                <input type='text' name='postTitle' placeholder='Title' required>
                <br />
                <br />
                <textarea type='text' name='postText' placeholder='Skriv här'></textarea>
                <br />
                <br />
                <input type='file' name='file'>
                <br />
                <br />
                <input type='submit' name='submit' value='submit'>
                <?php
            }
    }

?>


</form>    
</body>
</html>