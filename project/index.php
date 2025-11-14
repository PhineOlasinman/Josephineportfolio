<?php
include 'project.php';

$editProject = null;

// Fetch project for editing
if(isset($_GET['edit'])){
    $id = $_GET['edit'];
    $stmt = $conn->prepare("SELECT * FROM project WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $editProject = $result->fetch_assoc();
}

// Handle form submission (Add/Update)
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $projectId = $_POST['projectId'] ?? '';
    $projectName = $_POST['projectName'];
    $projectDesc = $_POST['projectDesc'];
    $startDate = $_POST['startDate'];
    $endDate = $_POST['endDate'];

    // File upload
    $fileName = $editProject['file'] ?? '';
    if(isset($_FILES['projectFile']) && $_FILES['projectFile']['name'] != ''){
        $uploadDir = 'uploads/';
        if(!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);
        $fileName = time() . '_' . basename($_FILES['projectFile']['name']);
        move_uploaded_file($_FILES['projectFile']['tmp_name'], $uploadDir . $fileName);
    }

    if($projectId){ // Update
        $stmt = $conn->prepare("UPDATE project SET project_name=?, description=?, start_date=?, end_date=?, file=? WHERE id=?");
        $stmt->bind_param("sssssi", $projectName, $projectDesc, $startDate, $endDate, $fileName, $projectId);
        $stmt->execute();
        header('Location: index.php');
        exit;
    } else { // Add
        $stmt = $conn->prepare("INSERT INTO project (project_name, description, start_date, end_date, file) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $projectName, $projectDesc, $startDate, $endDate, $fileName);
        $stmt->execute();
        header('Location: index.php');
        exit;
    }
}

// Handle delete
if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    
    // Delete file if exists
    $stmt = $conn->prepare("SELECT file FROM project WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    if($row = $result->fetch_assoc()){
        if(!empty($row['file']) && file_exists('uploads/' . $row['file'])){
            unlink('uploads/' . $row['file']);
        }
    }

    // Delete project
    $stmt = $conn->prepare("DELETE FROM project WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    header('Location: index.php');
    exit;
}

// Determine what to show (form or storage)
$showStorage = isset($_GET['view']) && $_GET['view'] === 'storage';
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Project Management System</title>
<link rel="stylesheet" href="../design/project.css">
</head>
<body>
<h1>Project Management System</h1>

<div class="top-buttons 
    <?php 
        if (isset($_GET['view']) && $_GET['view'] === 'storage') {
            echo 'align-id';
        } else {
            echo 'align-form';
        }
    ?>">
    <a href="../intro/index.php"><button>Home</button></a>

    <?php if (isset($_GET['view']) && $_GET['view'] === 'storage'): ?>
        <a href="form.php"><button>Back to Form</button></a>
    <?php else: ?>
        <a href="index.php?view=storage"><button>Project Storage</button></a>
    <?php endif; ?>
</div>




<?php if(!$showStorage): ?>
    <?php include 'form.php'; ?>
<?php else: ?>
    <?php include 'view.php'; ?>
<?php endif; ?>

</body>
</html>