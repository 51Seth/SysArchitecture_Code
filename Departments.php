<?php 
require_once "includes/dbc.inc.php";
$CollegeID = $_GET['id'];

try {
    if (isset($_GET['search']) && $_GET['search'] != '') {
        $search = $_GET['search'];
        $query = "SELECT * FROM Department WHERE CollegeID = :CollegeID AND (DepartmentName LIKE :search OR DepartmentCode LIKE :search)";
        $stmt = $pdo->prepare($query);
        $stmt->bindValue(":CollegeID", $CollegeID, PDO::PARAM_INT);
        $stmt->bindValue(":search", "%$search%", PDO::PARAM_STR);
        $stmt->execute();
        $department = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } else {
        $query = "SELECT * FROM Department WHERE CollegeID = :CollegeID;";
        $stmt = $pdo->prepare($query);
        $stmt->bindValue(":CollegeID", $CollegeID, PDO::PARAM_INT);
        $stmt->execute();
        $department = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
} catch(PDOException $e) {
    die("Query Failed: ". $e->getMessage());
}

try {
    $query = "SELECT CollegeName FROM college WHERE CollegeID = :CollegeID;";
    $stmt = $pdo->prepare($query);
    $stmt->bindValue(":CollegeID", $CollegeID, PDO::PARAM_INT);
    $stmt->execute();
    $collegeName = $stmt->fetch(PDO::FETCH_ASSOC);
} catch(PDOException $e){
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
            <form action="Departments.php" method="GET">
                <input type="hidden" name="id" value="<?= $CollegeID ?>">
                <div class="input-group mb-3">
                    <input type="text" name="search" class="form-control" placeholder="Search by Department Name or Code" value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>">
                    <button type="submit" class="btn btn-primary">Search</button>
                </div>
            </form>
            <div class="card-header bg-primary text-white text-center">
                <h3>Department List of <?= $collegeName["CollegeName"] ?></h3>
            </div>
            
            <div class="card-body">
                <div class="d-flex mb-3">
                    <a href="index.php" class="btn btn-danger">Go Back</a>
                    <a href="Add-Department.php?id=<?= $CollegeID ?>" class="btn btn-success">Add</a>
                </div>

                <table class="table table-bordered table-striped">
                    <thead class="bg-dark text-white">
                        <tr>
                            <th>Department ID</th>
                            <th>College ID</th>
                            <th>Department Name</th>
                            <th>Department Code</th>
                            <th>Active Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($department as $dep) : ?>
                            <tr>
                                <td><?= $dep['DepartmentID'] ?></td>
                                <td><?= $dep['CollegeID'] ?></td>
                                <td><?= $dep['DepartmentName'] ?></td>
                                <td><?= $dep['DepartmentCode'] ?></td>
                                <td><?= $dep['IsActive'] ? "Active" : "Inactive" ?></td>
                                <td>
                                    <a href="Year.php?id=<?= $dep['DepartmentID']?>" class="btn btn-success">Year List</a>
                                    <a href="Edit-Department.php?depid=<?= $dep['DepartmentID'] ?>&collegeid=<?= $dep['CollegeID'] ?>" class="btn btn-warning">Edit</a> 
                                    <a href="#" onclick="confirm('Are you sure you want to delete this department?') ? window.location.href ='includes/delete-Department.inc.php?id=<?= $dep['DepartmentID'] ?>&collegeid=<?= $dep['CollegeID'] ?>' : ''" class="btn btn-danger">Delete</a>
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
