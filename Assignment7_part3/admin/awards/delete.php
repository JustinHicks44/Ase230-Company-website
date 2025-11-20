<?php
require_once __DIR__ . '/../awards.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : null;
$award = $id !== null ? get_award_by_id($id) : null;

if (!$award) {
    header('Location: index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirm'])) {
    delete_award($award['id']);
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Award - <?php echo htmlspecialchars($award['title']); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { padding-top: 20px; }
        .delete-section { background: #f8f9fa; padding: 30px; border-radius: 5px; }
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
        <div class="col-md-6 mx-auto">
            <div class="delete-section">
                <h2 class="mb-4">Delete Award</h2>
                <div class="alert alert-warning">
                    <p><strong>Are you sure you want to delete this award?</strong></p>
                    <p class="mb-0"><strong>Title:</strong> <?php echo htmlspecialchars($award['title']); ?></p>
                </div>

                <form method="POST">
                    <div class="mt-4">
                        <button type="submit" name="confirm" value="yes" class="btn btn-danger">Yes, Delete Award</button>
                        <a href="detail.php?id=<?php echo $award['id']; ?>" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
