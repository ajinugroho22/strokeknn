<?php
    $server = "localhost";
    $user   = "root";
    $pass   = "";
    $dba    = "dps";
    
    //$koneksi =  new PDO("mysql:host=$server;dbname=$dba", $user, $pass);
    try {
        $koneksi = new PDO("mysql:host={$server};dbname={$dba}", $user, $pass);
        $koneksi->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $exception){
        die("Connection error: " . $exception->getMessage());
    }
?>