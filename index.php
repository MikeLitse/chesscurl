<?php 

    $ch = require "initcurl.php";

    curl_setopt($ch, CURLOPT_URL, "http://localhost/chess/");

    $response = curl_exec($ch);

    $data = json_decode($response, true);

    if($response === false){
        echo "CURL ERROR(" . curl_errno($ch) . "): " . curl_error($ch);
    }

    foreach($data as $user){
        echo "Username: " . htmlspecialchars($user["username"]) . "<br>";
        echo "Password: " . htmlspecialchars($user["pass"]) . "<br>";
    }

?>

