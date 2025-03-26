<?php

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $DepartmentID = $_POST['DepartmentID'];
    $CollegeID = $_POST['CollegeID'];
    $DepartmentName = $_POST['DepartmentName'];
    $DepartmentCode = $_POST['DepartmentCode'];
    $IsActive = (int)$_POST['IsActive'];

 
  

    try{
        require_once "dbc.inc.php";

       
        $query = "UPDATE Department  SET DepartmentName = :DepartmentName, DepartmentCode = :DepartmentCode, IsActive = :IsActive WHERE DepartmentID = :DepartmentID";
                  

       

        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":DepartmentID",$DepartmentID);
        $stmt->bindParam(":DepartmentName",$DepartmentName);
        $stmt->bindParam(":DepartmentCode",$DepartmentCode);
        $stmt->bindParam(":IsActive",$IsActive, PDO::PARAM_INT);
       


        $stmt->execute();


        


        $pdo = null;
        $stmt = null;
        header("Location: ../Departments.php?id=$CollegeID");
        die();
        
    }catch(PDOException $e){
        die("Query Failed: ". $e->getMessage());
    }

} else{
    header("Location: ../Departments.php?id=$CollegeID");
}