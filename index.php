<?php 

    $ch = require "initcurl.php";

    require_once("login.php");

    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    switch ($httpcode){
        case 200://POST
            break;
        case 201://UPDATE OR DELETE
            break;
        case 401:
            echo "User doesnt exist ";
            break;
        case 404:
            echo "Not Found: 404 " . "<br>";
            break;
        case 405:
            echo "Error: Allow: GET, POST";
            break;
        case 422:
            //$errors= json_decode($data, true);//returns assoc
            echo "Unprocessable Content: 422 " . "<br>" . "ERRORS: ";
            if(isset($data["errors"][0])){
                echo $data["errors"][0] . " ";
            }
            if(isset($data["errors"][1])){
                echo $data["errors"][1] . " ";
            }
            break;

    }
?>

