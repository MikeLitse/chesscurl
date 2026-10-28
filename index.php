<?php 

    $ch = require "initcurl.php";

    //can set method and other vars on the url
    $url="http://localhost/chess/?" . http_build_query([
        'method' => 'GET',
        'id' => 1
    ]);

    curl_setopt_array($ch, [
        
        CURLOPT_URL => $url,
        CURLOPT_HTTPGET => true
        
        ]);

    $response = curl_exec($ch);

    $data = json_decode($response, true);

    echo "STATUS: " . curl_errno($ch);

    echo "<br>HTTP: " . curl_getinfo($ch, CURLINFO_HTTP_CODE) . "<br>";

    if($response === false){
        die("CURL ERROR(" . curl_errno($ch) . "): " . curl_error($ch));
    }

    if(isset($data["username"])){
        echo "Username: " . htmlspecialchars($data["username"]) . "<br>";
        echo "Password: " . htmlspecialchars($data["pass"]) . "<br>";
    }elseif(is_array($data)){
        foreach($data as $user){
            echo "Username: " . htmlspecialchars($user["username"]) . "<br>";
            echo "Password: " . htmlspecialchars($user["pass"]) . "<br>";
        }
    }
?>

