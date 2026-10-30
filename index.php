<?php 
    $path = trim(parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH), "/");
    $parts= array_values(array_filter(explode("/", $path)));

    //echo json_encode(["path" => $path, "parts" => $parts, "id_selected" => $parts[1] ?? null]);

    //this doesnt work
    if($parts[0] != "chesscurl"){
        //return 404 if any other URL
        http_response_code(404);
        exit;
    }

    $ch = require "initcurl.php";

    $url="http://localhost/chess/";

    curl_setopt_array($ch, [
        
        CURLOPT_URL => $url,
        CURLOPT_HTTPGET => true
        
    ]); 

    $response= curl_exec($ch);

    //require_once("src/login.php");

    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    var_dump($httpcode);
    echo "<br>cURL Error: " . curl_error($ch);
    //exit;

    switch ($httpcode){
        case 200://POST
            header("Location: src/login.php");
            exit;
        case 201://UPDATE OR DELETE
            break;
        case 401:
            echo "401: User doesnt exist ";
            break;
        case 404:
            echo "Not Found: 404 " . "<br>";
            break;
        case 405:
            echo "Error: Allow: GET, POST";
            break;
        case 422:
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

