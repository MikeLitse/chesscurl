<?php 

    $ch = require "initcurl.php";

    //can set method and other vars on the url


    //GET all
    //? is used to pass parameters to the API like method and id
    $url="http://localhost/chess/";

    curl_setopt_array($ch, [
        
        CURLOPT_URL => $url,
        CURLOPT_HTTPGET => true
        
    ]); 

    //GET single
    //? is used to pass parameters to the API like method and id
    /*
    $url="http://localhost/chess/?" . http_build_query([
        'method' => 'GET',
        'id' => 1
    ]);

    curl_setopt_array($ch, [
        
        CURLOPT_URL => $url,
        CURLOPT_HTTPGET => true
        
    ]); 
    */

    //POST
    /*
    $url="http://localhost/chess/";

    $data=[
        "user" => "user",
        "pass" => "pass"
    ];

    $payload = json_encode($data);
    
    curl_setopt_array($ch, [
        
        CURLOPT_URL => $url,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => $payload,
        CURLOPT_HTTPHEADER => [
            "Content-Type: application/json"
        ]
        
    ]);
    */

    
    $response = curl_exec($ch);

    $data = json_decode($response, true);

    echo "STATUS: " . curl_errno($ch);
    echo "<br>HTTP: " . curl_getinfo($ch, CURLINFO_HTTP_CODE) . "<br>";

    if($response === false){
        die("CURL ERROR(" . curl_errno($ch) . "): " . curl_error($ch));
    }

    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    switch ($httpcode){
        case 201://POST
            echo "Success: " . htmlspecialchars($data["message"] ?? "Resource Created") . "<br>";
            echo "Created User ID: " . htmlspecialchars((string)($data["id"] ?? '')) . "<br>";
            break;
        case 200://GET 
            if (empty($data)) {
                echo "No Users.";
            } elseif (isset($data["username"])) {
                // Επιστράφηκε 1 μόνο χρήστης
                echo "User: {$data["username"]}  Pass: {$data["pass"]}<br>";
            } else {
                // Επιστράφηκε λίστα με πολλούς χρήστες
                foreach ($data as $user) {
                    echo "ID: {$user["id"]}  User: {$user["username"]}  Pass: {$user["pass"]}<br>";
                }
            }
        break;
    }
    if(isset($data["message"])){
        if($data["message"] === "User Not Found"){
            die("ERROR CODE: 404");//exit() with message
        }
    }
?>

