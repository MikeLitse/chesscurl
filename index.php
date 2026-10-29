<?php 

    $ch = require "initcurl.php";

    require_once("src/login.php");

    if($response === false){
        die("CURL ERROR(" . curl_errno($ch) . "): " . curl_error($ch));
    }

    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    switch ($httpcode){
        case 201://POST
            echo "Success: " . htmlspecialchars($data["message"] ?? "Resource Created") . "<br>";
            echo "Created User ID: " . htmlspecialchars((string)($data["id"] ?? '')) . "<br>";
            break;
        case 200:
            //UPDATE OR DELETE
            if (isset($data["rows"])) {
                $prefix = str_contains($data["message"], "deleted") ? "Delete Result: " : "Update Result: ";
                echo $prefix . htmlspecialchars($data["message"]) . "<br>";
                echo "Rows affected: " . htmlspecialchars((string)$data["rows"]) . "<br>";
                break;
            }
            //GET
            if (empty($data)) {
                echo "No Users.";
            } elseif (isset($data["username"])) {
                // Return one user
                echo "User: {$data["username"]}  Pass: {$data["pass"]}<br>";
            } else {
                // Return all users
                foreach ($data as $user) {
                    echo "ID: {$user["id"]}  User: {$user["username"]}  Pass: {$user["pass"]}<br>";
                }
            }
        break;
        case 404:
            echo "Not Found: 404 " . htmlspecialchars($data["message"] ?? "User does not exist") . "<br>";
            break;
    }
    if(isset($data["message"])){
        if($data["message"] === "User Not Found"){
            die("ERROR CODE: 404");//exit() with message
        }
    }
?>

