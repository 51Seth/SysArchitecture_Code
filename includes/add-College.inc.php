<?php

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $CollegeID = $_POST['CollegeID'];
    $CollegeName = $_POST['CollegeName'];
    $CollegeCode = $_POST['CollegeCode'];
    $IsActive = $_POST['IsActive'];
    
    try{
        require_once "dbc.inc.php";
        $query = "Insert into college (CollegeID , CollegeName, CollegeCode, IsActive ) VALUES (:CollegeID , :CollegeName, :CollegeCode, :IsActive)";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":CollegeID",$CollegeID);
        $stmt->bindParam(":CollegeName",$CollegeName);
        $stmt->bindParam(":CollegeCode",$CollegeCode);
        $stmt->bindParam(":IsActive",$IsActive);
        $stmt->execute();

        $pdo = null;
        $stmt = null;
        header("Location: ../index.php");
        die();
        
    }catch(PDOException $e){
        die("Query Failed: ". $e->getMessage());
    }

} else{
    header("Location: ../index.php");
}