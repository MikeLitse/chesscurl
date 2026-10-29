<?php
    session_start();
    $creds=$_SESSION["data"];
    echo "Welcome " . $creds["user"]["username"] . "<br>" . $creds["message"] . "<br>";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h>Welcome to home</h>
    <form action="logout.php" method="POST">
        <button>Logout</button>
    </form>
    
</body>
</html>