<?php
    include("../db.php");
    session_start();

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
        $newFileName = " ";
    }
}

    $postText  = (!empty($_POST['postText']) ? $_POST['postText'] : "");
    $postTitle = (!empty($_POST['postTitle']) ? $_POST['postTitle'] : "");
    $category = (!empty($_POST['category']) ? $_POST['category'] : "");
    $id = (!empty($_POST['postid']) ? $_POST['postid'] : "");

    
    $postText = htmlspecialchars($postText);
    $postTitle = htmlspecialchars($postTitle);
    $category = htmlspecialchars($category);


    $query = "UPDATE post SET postTitle='$postTitle', postText='$postText', Img='$newFileName', category='$category' WHERE id= $id";

    $sth = $dbh->prepare($query);
    $sth->bindParam(':postTitle', $postTitle);
    $sth->bindParam(':postText', $postText);
    $sth->bindParam(':newFileName', $newFileName);
    $sth->bindParam(':category', $category);

    

    $return = $sth->execute();
    
    header("location:../views/writepost.php?action=write&id=$id");

?>