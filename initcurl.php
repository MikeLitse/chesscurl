<?php 
    $headers = ["Accept: application/json"];

    $ch = curl_init("http://localhost/chess/");

    curl_setopt_array($ch, [
        CURLOPT_HTTPHEADER => $headers,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,// Follow 301/302 redirects (e.g., trailing slashes)
    ]);

    return $ch;

?>