<?php
session_start();
include("../db.php");

if(isset($_GET['action']) && $_GET['action'] == "delete"){

    $query = "DELETE FROM post WHERE id=".$_GET['id'];
    $tabort = $dbh->exec($query);

    $query2 = "DELETE FROM comments WHERE postid=".$_GET['id'];
    $tabort2 = $dbh->exec($query2);
    header("location:login.php");


}
else{
    
    if(isset($_POST['submit'])){
        if(!empty($_FILES['file']['name'])){
        $file = $_FILES['file'];

        $fileName = $_FILES['file']['name'];
        $fileTmpName = $_FILES['file']['tmp_name'];
        $fileSize = $_FILES['file']['size'];
        $fileError = $_FILES['file']['error'];
        $fileType = $_FILES['file']['type'];

        $fileExt = explode('.', $fileName);
        $fileActualExt = strtolower(end($fileExt));

        $allowedTypes = array('jpg', 'jpeg', 'png');

        if (in_array($fileActualExt, $allowedTypes)){
            if ($fileError === 0){
                if ($fileSize < 1000000){
                    
                    $newFileName = uniqid('', true).".".$fileActualExt;
                    $fileDestination = '../img/' . $newFileName;
                    move_uploaded_file($fileTmpName,$fileDestination);
                
                } else {
                    echo " the file is too big";
                }
            } else{
                echo " there was an error please try again";
            }
        } else{
            echo " you cant uplode tis file type";
        }
    }
    if(empty($_FILES['file']['name'])){
        $newFileName =" ";
    }
}



    $postText = (!empty($_POST['postText']) ? $_POST['postText'] : "");
    $postTitle = (!empty($_POST['postTitle']) ? $_POST['postTitle'] : "");
    $category = (!empty($_POST['category']) ? $_POST['category'] : "");

    $postText = htmlspecialchars($postText);
    $postTitle = htmlspecialchars($postTitle);
    $category = htmlspecialchars($category);


    $errors = false;
    $errorMessages = "";

    
    if(empty($_POST['postText'])){
        $errorMessages .= "du måste skriva ett medelande";
        $errors = true;
    }
    if(empty($_POST['postTitle'])){
        $errorMessages .= "du måste skriva titel";
        $errors = true;
    }

    if($errors == true){
        echo $errorMessages;
        echo '<a href="includes/login.php">gå tillbaka</a>';
        die;

    }
    $userID = (int)$_SESSION['id'];
    $query = "INSERT INTO post (postTitle,postText, userID,Img,category) VALUES(:postTitle, :postText, :id, :newFileName, :category);";

    $sth = $dbh->prepare($query);
    $sth->bindParam(':postTitle', $postTitle);
    $sth->bindParam(':postText', $postText);
    $sth->bindParam(':id', $userID);
    $sth->bindParam(':newFileName', $newFileName);
    $sth->bindParam(':category', $category);

    $return = $sth->execute();

    if(!$return){
    print_r($dbh->errorInfo()); 
    }
    else{
        header("location:login.php");
    }
}
?>