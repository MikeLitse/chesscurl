<?php
    session_start();
    $creds=$_SESSION["data"];
    echo "Welcome " . $creds["user"]["username"] . "<br>" . $creds["message"] . "<br>";
    
    var_dump($creds);
    echo"<br>";
    
    $url="http://localhost/chess/";

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if($_POST["action"] === "creategame"){
            $ch = require __DIR__ . "/../initcurl.php";

            //echo json_encode("it passed");
            $data=[
                "id" => $creds["user"]["id"], //TODO change this to receive string id 
                "action" => "creategame"
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

            var_dump($data);
        }
    }
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
    <form  method="POST">
        <button name="action" value="creategame">Create game</button>
        <button formaction="logout.php">Logout</button>
    </form>
    
</body>
</html>