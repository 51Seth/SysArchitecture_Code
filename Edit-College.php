<?php 
require_once "includes/dbc.inc.php";
$CollegeID = $_GET['id'];
try{
    $query = "Select * FROM college WHERE CollegeID = :CollegeID;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":CollegeID", $CollegeID);
    $stmt->execute();
    $college = $stmt->fetch(PDO::FETCH_ASSOC);
}catch(PDOException $e){
    die("Query Failed: ". $e->getMessage());
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>College Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="card shadow-lg">
            <div class="card-header bg-primary text-white text-center">
                <h3>College Form</h3>
            </div>
            <div class="card-body">
                <form  method="POST"  action="includes/edit-College.inc.php">
                <div class="mb-3">
                        <label for="CollegeID" class="form-label">College ID</label>
                        <input type="text" class="form-control" id="CollegeID" name="CollegeID" value="<?= $CollegeID ?>" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="CollegeName" class="form-label">College Name</label>
                        <input type="text" class="form-control" id="CollegeName" name="CollegeName" value= "<?=$college['CollegeName']?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="CollegeCode" class="form-label">College Code</label>
                        <input type="text" class="form-control" id="CollegeCode" name="CollegeCode" value="<?=$college['CollegeCode']?>" required >
                    </div>
                    <div class="mb-3">
                        <label for="IsActive" class="form-label">Active Status</label>
                        <select class="form-select" id="IsActive" name="IsActive" required>
                            <option value="1" <?= $college['IsActive'] == 1 ? 'selected' : '' ?>>Active</option>
                            <option value="0" <?= $college['IsActive'] == 0 ? 'selected' : '' ?>>Inactive</option>
                        </select>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-success">Submit</button>
                        <button type="reset" class="btn btn-secondary">Reset</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
