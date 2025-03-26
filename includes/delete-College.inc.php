<?php
    if($_SERVER['REQUEST_METHOD'] == 'GET'){
        $id = $_GET['id'];
        try{
            require_once "dbc.inc.php";

            $query = "DELETE FROM Department WHERE CollegeID = :id;";


            $stmt = $pdo->prepare($query);
     
            $stmt->bindParam(":id",$id);
            $stmt->execute();




            $query = "DELETE FROM college WHERE CollegeID = :id;";


            $stmt = $pdo->prepare($query);
     
            $stmt->bindParam(":id",$id);
            $stmt->execute();
            
            $pdo = null;
            $stmt = null;
            
            header("Location: ../index.php");
            die();
        }catch(PDOException $e){
            die("Query Failed: ". $e->getMessage());
        }
    }else{
        header("Location: ../index.php");
    }
