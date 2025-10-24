<?php
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
        <?php foreach($_SESSION['projects'] as $proj): ?>
        <tr>
            <td><?= $proj['id'] ?></td>
            <td><?= $proj['name'] ?></td>
            <td><?= $proj['desc'] ?></td>
            <td><?= $proj['start'] ?></td>
            <td><?= $proj['end'] ?></td>
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
        <?php endforeach; ?>
    </tbody>
</table>
