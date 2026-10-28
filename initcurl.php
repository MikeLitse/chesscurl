<?php 
    $headers = ["Accept: application/json"];

    $ch = curl_init();

    curl_setopt_array($ch, [
        CURLOPT_HTTPHEADER => $headers,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
    ]);

    return $ch;

?>