<?php
require_once __DIR__ . '/../awards.php';
$awards = get_all_awards();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Awards</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { padding-top: 20px; }
    </style>
</head>
<body>
<div class="container">
    <nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
        <div class="container-fluid">
            <a class="navbar-brand" href="../../index.php">← Back to Website</a>
            <div class="navbar-nav ms-auto">
                <a class="nav-link" href="../pages/">Pages</a>
                <a class="nav-link" href="../team/">Team</a>
                <a class="nav-link active" href="../awards/">Awards</a>
                <a class="nav-link" href="../products/">Products</a>
                <a class="nav-link" href="../contacts/">Contacts</a>
            </div>
        </div>
    </nav>

    <div class="row">
        <div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1>Awards Management</h1>
                <a href="create.php" class="btn btn-success">+ Add Award</a>
            </div>

            <?php if (empty($awards)): ?>
                <div class="alert alert-info">No awards found. <a href="create.php">Add one now</a>.</div>
            <?php else: ?>
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Year</th>
                            <th>Title</th>
                            <th>Issuer/Details</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($awards as $index => $award): ?>
                        <tr style="cursor: pointer;" onclick="window.location.href='detail.php?id=<?php echo $index; ?>'">
                            <td><?php echo htmlspecialchars($index); ?></td>
                            <td><?php echo htmlspecialchars($award['year'] ?? ''); ?></td>
                            <td><?php echo htmlspecialchars($award['title']); ?></td>
                            <td><?php echo htmlspecialchars(substr($award['issuer'] ?? $award['details'] ?? '', 0, 40)); ?></td>
                            <td onclick="event.stopPropagation();">
                                <a href="detail.php?id=<?php echo $index; ?>" class="btn btn-sm btn-info">View</a>
                                <a href="edit.php?id=<?php echo $index; ?>" class="btn btn-sm btn-warning">Edit</a>
                                <a href="delete.php?id=<?php echo $index; ?>" class="btn btn-sm btn-danger">Delete</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
