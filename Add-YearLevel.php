<?php 
require_once "includes/dbc.inc.php";
$DepartmentID = $_GET['id'];  // Changed CollegeID to DepartmentID
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Year Level Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="card shadow-lg">
            <div class="card-header bg-primary text-white text-center">
                <h3>Year Level Form</h3>
            </div>
            <div class="card-body">
                <form method="POST" action="includes/add-YearLevel.inc.php">
                    <div class="mb-3">
                        <label for="DepartmentID" class="form-label">Department ID</label>
                        <input type="text" class="form-control" id="DepartmentID" name="DepartmentID" value="<?= $DepartmentID ?>" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="YearLevelName" class="form-label">Year Level Name</label>
                        <input type="text" class="form-control" id="YearLevelName" name="YearLevelName" required>
                    </div>

                    <div class="mb-3">
                        <label for="IsActive" class="form-label">Active Status</label>
                        <select class="form-select" id="IsActive" name="IsActive" required>
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
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
