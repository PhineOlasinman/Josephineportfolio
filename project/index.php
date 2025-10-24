<?php
session_start();

// Initialize session storage
if(!isset($_SESSION['projects'])){
    $_SESSION['projects'] = [];
    $_SESSION['nextId'] = 1;
}

// Handle form submission
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $id = $_POST['projectId'] ?? '';
    $name = $_POST['projectName'] ?? '';
    $desc = $_POST['projectDesc'] ?? '';
    $start = $_POST['startDate'] ?? '';
    $end = $_POST['endDate'] ?? '';
    
    $fileName = '';
    if(isset($_FILES['projectFile']) && $_FILES['projectFile']['name'] != ''){
        $uploadDir = 'uploads/';
        if(!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);
        $fileName = time() . '_' . basename($_FILES['projectFile']['name']);
        move_uploaded_file($_FILES['projectFile']['tmp_name'], $uploadDir . $fileName);
    }

    if($id){ // Update
        foreach($_SESSION['projects'] as &$proj){
            if($proj['id'] == $id){
                $proj['name'] = $name;
                $proj['desc'] = $desc;
                $proj['start'] = $start;
                $proj['end'] = $end;
                if($fileName) $proj['file'] = $fileName;
            }
        }
    } else { // Add
        $_SESSION['projects'][] = [
            'id' => $_SESSION['nextId']++,
            'name' => $name,
            'desc' => $desc,
            'start' => $start,
            'end' => $end,
            'file' => $fileName
        ];
    }
    header('Location: index.php');
    exit;
}

// Handle delete
if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    foreach($_SESSION['projects'] as $key => $proj){
        if($proj['id'] == $id){
            if(!empty($proj['file']) && file_exists('uploads/' . $proj['file'])){
                unlink('uploads/' . $proj['file']);
            }
            unset($_SESSION['projects'][$key]);
            $_SESSION['projects'] = array_values($_SESSION['projects']);
        }
    }
    header('Location: index.php');
    exit;
}

// Determine what to show
$showStorage = isset($_GET['view']) && $_GET['view'] === 'storage';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Project Management PHP</title>
<link rel="stylesheet" type="text/css" href="project.css">
</head>
<body>
<h1>Project Management System</h1>

<!-- Buttons container -->
<div style="display:flex; justify-content:flex-start; gap:10px; margin-bottom:20px; max-width:650px; margin-left:auto; margin-right:auto;">

    <!-- Home button (always left) -->
    <a href="../intro/index.php"><button>Home</button></a>

    <!-- Back to Form button (only visible in storage) -->
    <?php if($showStorage): ?>
        <a href="index.php"><button>Back to Form</button></a>
    <?php endif; ?>

    <!-- Project Storage button (only visible in form) -->
    <?php if(!$showStorage): ?>
        <a href="index.php?view=storage"><button>Project Storage</button></a>
    <?php endif; ?>

</div>

<!-- Show form or storage -->
<?php if(!$showStorage): ?>
    <?php include 'form.php'; ?>
<?php else: ?>
    <?php include 'view.php'; ?>
<?php endif; ?>

</body>
</html>
