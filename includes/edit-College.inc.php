<?php

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $CollegeID = $_POST['CollegeID'];
    $CollegeName = $_POST['CollegeName'];
    $CollegeCode = $_POST['CollegeCode'];
    $IsActive = (int)$_POST['IsActive'];

  

    try{
        require_once "dbc.inc.php";

       
        $query = "UPDATE college  SET CollegeName = :CollegeName, CollegeCode = :CollegeCode, IsActive = :IsActive WHERE CollegeID = :CollegeID";
                  

       

        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":CollegeID",$CollegeID);
        $stmt->bindParam(":CollegeName",$CollegeName);
        $stmt->bindParam(":CollegeCode",$CollegeCode);
        $stmt->bindParam(":IsActive",$IsActive, PDO::PARAM_INT);
       


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