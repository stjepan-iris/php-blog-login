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
$row['id'] = (!empty($_GET['id']) ? $_GET['id'] : "");


?>


<form action="../includes/commenthandler.php" method="post">
        <input type="hidden" name="postid" value="<?php echo $row['id'];?>">
        <input type="text" name="comment" >
        <br />
        <input type="submit" value="skicka">
        <?php 
        echo "<a href='../views/writepost.php?action=write&id=" . $row['id'] . "'>tillbacka</a>" . "<br />";
        
        ?>
        
    </form>
    
</body>
</html>