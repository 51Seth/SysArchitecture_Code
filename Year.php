<?php 
require_once "includes/dbc.inc.php";
$DepartmentID = $_GET['id'];  // Changed CollegeID to DepartmentID
try{
    // Query to get Year Levels associated with a specific Department
    $query = "SELECT * FROM Year WHERE DepartmentID = :DepartmentID;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":DepartmentID", $DepartmentID);
    $stmt->execute();
    $yearLevels = $stmt->fetchAll(PDO::FETCH_ASSOC);
}catch(PDOException $e){
    die("Query Failed: ". $e->getMessage());
}

try{
    // Query to get Department Name
    $query = "SELECT DepartmentName FROM department WHERE DepartmentID = :DepartmentID;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":DepartmentID", $DepartmentID);
    $stmt->execute();
    $departmentName = $stmt->fetch(PDO::FETCH_ASSOC);
}catch(PDOException $e){
    die("Query Failed: ". $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Year Level Table</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="card shadow-lg">
            <div class="card-header bg-primary text-white text-center">
                <h3>Year Level List of <?= $departmentName["DepartmentName"] ?></h3>
            </div>
            
            <div class="card-body">
                <div class="d-flex mb-3">
                    <a href="index.php" class="btn btn-danger">Go Back</a>
                    <a href="Add-YearLevel.php?id=<?= $DepartmentID ?>" class="btn btn-success">Add Year Level</a>
                </div>

                <table class="table table-bordered table-striped">
                    <thead class="bg-dark text-white">
                        <tr>
                            <th>Year Level ID</th>
                            <th>Department ID</th>
                            <th>Year Level Name</th>
                            <th>Active Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($yearLevels as $year) : ?>
                            <tr>
                                <td><?= $year['YearID'] ?></td>
                                <td><?= $year['DepartmentID'] ?></td>
                                <td><?= $year['YearLevel'] ?></td>
                                <td><?php if ($year['IsActive']) { echo "Active"; } else { echo "Inactive"; } ?></td>
                                <td>
                                    <a href="Edit-YearLevel.php?yearid=<?= $year['YearLevelID'] ?>&departmentid=<?= $year['DepartmentID'] ?>" class="btn btn-warning">Edit</a>
                                    <a href="#" onclick="confirm('Are you sure you want to delete this year level?') ? window.location.href ='includes/delete-YearLevel.inc.php?id=<?= $year['YearLevelID'] ?>&departmentid=<?= $year['DepartmentID'] ?>' : ''" class="btn btn-danger">Delete</a>
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
