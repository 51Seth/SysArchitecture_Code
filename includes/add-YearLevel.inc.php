<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $DepartmentID = $_POST['DepartmentID'];
    $YearLevelName = $_POST['YearLevelName'];
    $IsActive = $_POST['IsActive'];
    
    try {
        require_once "dbc.inc.php";
        $query = "INSERT INTO Year (DepartmentID, YearLevel, IsActive) VALUES (:DepartmentID, :YearLevelName, :IsActive)";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":DepartmentID", $DepartmentID);
        $stmt->bindParam(":YearLevel", $YearLevelName);
        $stmt->bindParam(":IsActive", $IsActive);
        $stmt->execute();

        $pdo = null;
        $stmt = null;
        header("Location: ../Year.php?id=$DepartmentID");
        die();
        
    } catch (PDOException $e) {
        die("Query Failed: " . $e->getMessage());
    }

} else {
    header("Location: ../Year.php?id=$DepartmentID");
}
