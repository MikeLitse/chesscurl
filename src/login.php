<?php
   
    $url="http://localhost/chess/";

    if($_SERVER["REQUEST_METHOD"] == "POST"){

        $ch = require __DIR__ . "/../initcurl.php";

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

        $response = curl_exec($ch);//can be var_dumped for debugging

        //var_dump($response);
        //exit;
        if ($response === false) {
            die("CURL ERROR(" . curl_errno($ch) . "): " . curl_error($ch));
        }
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        $data = json_decode($response, true);//returns array

        
        if($httpcode === 200){
            session_start();
            $_SESSION["data"] = $data;
            header("Location: home.php");
            exit;
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
        <form method="POST">
            <lable>Login</lable>
            <div>
                <label>Username:</label>
                <input type="text" name="user" id="user">
            </div>
            
            <div>
                <label>Password:</label>
                <input type="password" name="pass" id="pass">
            </div>
            <input type="submit" value="Submit">
            <div>
                <h>Dont have an account? Sign in here:</h>
                <a href="register.php">Register</a>
            </div>
        </form>
    </body>
    </html>

