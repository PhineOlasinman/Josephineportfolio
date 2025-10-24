<?php
$editProject = null;
if(isset($_GET['edit'])){
    foreach($_SESSION['projects'] as $proj){
        if($proj['id'] == $_GET['edit']){
            $editProject = $proj;
        }
    }
}
?>
<form method="POST" enctype="multipart/form-data" action="index.php">
    <input type="hidden" name="projectId" value="<?= $editProject['id'] ?? '' ?>">
    
    <label>Project Name:</label>
    <input type="text" name="projectName" placeholder="Enter project name" required value="<?= $editProject['name'] ?? '' ?>">

    <label>Description:</label>
    <textarea name="projectDesc" placeholder="Enter project description"><?= $editProject['desc'] ?? '' ?></textarea>

    <label>Start Date:</label>
    <input type="date" name="startDate" value="<?= $editProject['start'] ?? '' ?>">

    <label>End Date:</label>
    <input type="date" name="endDate" value="<?= $editProject['end'] ?? '' ?>">

    <label>Upload File:</label>
    <p id="currentFile" title="<?= $editProject['file'] ?? '' ?>">
        <?= isset($editProject['file']) && $editProject['file'] != '' ? 'Current File: ' . $editProject['file'] : '' ?>
    </p>
    <input type="file" name="projectFile">

    <div class="form-buttons">
        <button type="submit"><?= $editProject ? 'Update Project' : 'Add Project' ?></button>
    </div>
</form>
