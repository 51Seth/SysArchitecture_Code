<?php


if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $DepartmentID = $_POST['DepartmentID'];
    $CollegeID = $_POST['CollegeID'];
    $DepartmentName = $_POST['DepartmentName'];
    $DepartmentCode = $_POST['DepartmentCode'];
    $IsActive = $_POST['IsActive'];
    
    try{
        require_once "dbc.inc.php";
        $query = "Insert into department (DepartmentID, CollegeID, DepartmentName, DepartmentCode, IsActive ) VALUES (:DepartmentID, :CollegeID, :DepartmentName, :DepartmentCode, :IsActive)";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":DepartmentID",$DepartmentID);
        $stmt->bindParam(":CollegeID",$CollegeID);
        $stmt->bindParam(":DepartmentName",$DepartmentName);
        $stmt->bindParam(":DepartmentCode",$DepartmentCode);
        $stmt->bindParam(":IsActive",$IsActive);
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