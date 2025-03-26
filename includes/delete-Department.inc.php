<?php
    if($_SERVER['REQUEST_METHOD'] == 'GET'){
        $id = $_GET['id'];
        $CollegeID = $_GET['collegeid'];
        try{
            require_once "dbc.inc.php";
            $query = "DELETE FROM Department WHERE DepartmentID = :id;";


            $stmt = $pdo->prepare($query);
     
            $stmt->bindParam(":id",$id);
            $stmt->execute();
            
            $pdo = null;
            $stmt = null;
            
            header("Location: ../Departments.php?id=$CollegeID");
            die();
        }catch(PDOException $e){
            die("Query Failed: ". $e->getMessage());
        }
    }else{
        header("Location: ../Departments.php?id=$CollegeID");
    }
