<?php 

    $ch = require "initcurl.php";

    //curl_setopt($ch, CURLOPT_URL, "http://localhost/chess");

    $response = curl_exec($ch);

    $data = json_decode($response, true);

    foreach($data as $user){
        echo "Username: " . htmlspecialchars($user["username"]) . "<br>";
        echo "Password: " . htmlspecialchars($user["pass"]) . "<br>";
    }

?>

