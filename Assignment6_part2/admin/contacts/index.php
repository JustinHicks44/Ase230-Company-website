<?php
require_once __DIR__ . '/../contacts.php';
$contacts = get_all_contacts();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Contacts</title>
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
                <a class="nav-link" href="../awards/">Awards</a>
                <a class="nav-link" href="../products/">Products</a>
                <a class="nav-link active" href="../contacts/">Contacts</a>
            </div>
        </div>
    </nav>

    <div class="row">
        <div class="col-md-12">
            <h1 class="mb-4">Contact Requests</h1>

            <?php if (empty($contacts)): ?>
                <div class="alert alert-info">No contact requests found.</div>
            <?php else: ?>
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Subject</th>
                            <th>Submitted</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($contacts as $contact): ?>
                        <tr style="cursor: pointer;" onclick="window.location.href='detail.php?id=<?php echo $contact['id']; ?>'">
                            <td><?php echo htmlspecialchars($contact['id']); ?></td>
                            <td><?php echo htmlspecialchars($contact['name']); ?></td>
                            <td><?php echo htmlspecialchars($contact['email']); ?></td>
                            <td><?php echo htmlspecialchars(substr($contact['subject'] ?? '', 0, 40)); ?></td>
                            <td><?php echo htmlspecialchars($contact['submitted_at']); ?></td>
                            <td onclick="event.stopPropagation();">
                                <a href="detail.php?id=<?php echo $contact['id']; ?>" class="btn btn-sm btn-info">View</a>
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
