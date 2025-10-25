<?php
include 'project.php';
?>

<h2 style="text-align:center;margin-bottom:20px;">All Stored Projects</h2>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Project Name</th>
            <th>Description</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>File</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $result = $conn->query("SELECT * FROM project ORDER BY id ASC");

        if ($result->num_rows > 0) {
            while($proj = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $proj['id'] ?></td>
                    <td><?= htmlspecialchars($proj['project_name']) ?></td>
                    <td><?= htmlspecialchars($proj['description']) ?></td>
                    <td><?= $proj['start_date'] ?></td>
                    <td><?= $proj['end_date'] ?></td>
                    <td>
                        <?php if(!empty($proj['file'])): ?>
                            <a href="uploads/<?= $proj['file'] ?>" title="<?= $proj['file'] ?>" target="_blank"><?= $proj['file'] ?></a>
                        <?php else: ?>
                            No file
                        <?php endif; ?>
                    </td>
                    <td class="actions">
                        <a href="index.php?edit=<?= $proj['id'] ?>"><button type="button">Edit</button></a>
                        <a href="index.php?delete=<?= $proj['id'] ?>" onclick="return confirm('Delete this project?')"><button type="button">Delete</button></a>
                        <?php if(!empty($proj['file'])): ?>
                            <a href="uploads/<?= $proj['file'] ?>" target="_blank"><button type="button">View File</button></a>
                        <?php else: ?>
                            <button type="button" disabled>View File</button>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endwhile;
        } else { ?>
            <tr>
                <td colspan="7" style="text-align:center;">No projects found</td>
            </tr>
        <?php } ?>
    </tbody>
</table>
