<?php 
require_once "includes/dbc.inc.php";
try{
    $query = "Select * FROM college;";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $college = $stmt->fetchAll(PDO::FETCH_ASSOC);
}catch(PDOException $e){
    die("Query Failed: ". $e->getMessage());
}



?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Department Table</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="card shadow-lg">
            <div class="card-header bg-primary text-white text-center">
                <h3>College List</h3>
            </div>
            <div class="card-body">
              
                    <a href="Add-College.php" class="btn btn-success">Add</a>
                </div>
                
              
                <table class="table table-bordered table-striped">
                    <thead class="bg-dark text-white">
                        <tr>
                            <th>College ID</th>
                            <th>College Name</th>
                            <th>College Code</th>
                            <th>Active Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($college as $coll) : ?>
                            <tr>
                                <td><?= $coll['CollegeID']?></td>
                                <td><?= $coll['CollegeName']?></td>
                                <td><?= $coll['CollegeCode']?></td>
                                <td><?php if ($coll['IsActive']){echo "Active";} else {echo "Inactive";}?></td>
                               
                                
                                <td>
                                    <a href="Departments.php?id=<?= $coll['CollegeID']?>" class="btn btn-success">Department List</a>
                                    <a href="Edit-College.php?id=<?= $coll['CollegeID']?>" class="btn btn-warning">Edit</a> 
                                    <a href="#" onclick = "confirm('Are you sure you want to delete this college?') ?
                 window.location.href ='includes/delete-College.inc.php?id=<?= $coll['CollegeID']?>': '' " class="btn btn-danger">
                    Delete
                </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                       
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
