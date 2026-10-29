<?php

    
    $url="http://localhost/chess/";

    if($_SERVER["REQUEST_METHOD"] == "POST"){

        $ch = require "../initcurl.php";

        //echo json_encode("it passed");
        $data=[
            "user" => filter_input(INPUT_POST, "user", FILTER_SANITIZE_SPECIAL_CHARS),
            "pass" => filter_input(INPUT_POST, "pass", FILTER_SANITIZE_SPECIAL_CHARS),
            "action" => "login"
        ];

        $payload = json_encode($data);

        curl_setopt_array($ch, [

            CURLOPT_URL => $url,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $payload,
            CURLOPT_HTTPHEADER => [
                "Content-Type: application/json",
                "Accept: application/json"
            ]
        ]);

        $response = curl_exec($ch);

        if ($response === false) {
            die("CURL ERROR(" . curl_errno($ch) . "): " . curl_error($ch));
        }
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        $data = json_decode($response, true);//returns array

        echo "<h3>Debug Output:</h3>";
        echo "HTTP Status Code: <strong>$httpcode</strong><br>";
        echo "Raw Response: <pre>" . htmlspecialchars((string)$response) . "</pre>";
        
        if($httpcode === 200){
            session_start();
            header("Location: home.php");
            exit;
        }

    }

?>
<?php require "creds.html" ?>
