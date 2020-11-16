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
        echo (isset($_GET['err']) && $_GET['err'] == true ? "något gick fel" : "");

        if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin'){

            //echo "hej ". $_SESSION['username'] . " du är admin" ."!<br />";
            include("../views/adminpost.php");
            echo "<a href='logout.php'>logga ut</a>";

        }
       else if (isset($_SESSION['role']) && $_SESSION['role'] == 'user') {
            
           //echo "hej ". $_SESSION['username'] . " du är en vanlig user" ."!<br />";
           include("../views/adminpost.php");
           echo "<a href='logout.php'>logga ut</a>";

        } 
    ?>
</body>
</html>