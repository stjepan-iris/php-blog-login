<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php

session_start();
$id = (!empty($_GET['id']) ? $_GET['id'] : "");


?>


<form action="../includes/edithandler.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="postid" value="<?php echo $id;?>">
        <input type='text' name='category' placeholder='category' required>
        <br />
        <br />
        <input type="text" name="postTitle" placeholder="Title" required>
        <br />
        <br />
        <textarea type="text" name="postText" placeholder="Skriv här"></textarea>
        <br />
        <br />
        <input type='file' name='file'>
        <br />
        <br />
        <input type="submit" name="submit" value="submit">
        <?php 
        echo "<a href='../views/writepost.php?action=write&id=" . $id . "'>tillbacka</a>" . "<br />";
        
        ?>
        
    </form>
    
</body>
</html>