<?php

$conn = "mysql:host=localhost;dbname=universityDB";
$dbusername = "root";
$dbpassword = "";

try{
    $pdo = new PDO($conn, $dbusername, $dbpassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
}catch(PDOException $e){
    
    echo "Connection failed: ". $e->getMessage();
}

