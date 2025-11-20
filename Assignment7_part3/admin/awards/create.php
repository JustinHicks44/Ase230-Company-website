<?php
require_once __DIR__ . '/../awards.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $award = [
        'year' => $_POST['year'] ?? '',
        'title' => $_POST['title'] ?? '',
        'issuer' => $_POST['issuer'] ?? '',
        'details' => $_POST['details'] ?? ''
    ];

    if (empty($award['title'])) {
        $error = 'Award title is required.';
    } else {
        $newAward = create_award($award);
        // Get the ID of the newly created award
        $awards = get_all_awards();
        $id = count($awards) - 1;
        header('Location: edit.php?id=' . $id);
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Award</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { padding-top: 20px; }
        .form-section { background: #f8f9fa; padding: 30px; border-radius: 5px; }
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
        <div class="col-md-8 mx-auto">
            <h1 class="mb-4">Add Award</h1>

            <?php if ($error): ?>
                <div class="alert alert-danger alert-dismissible fade show"><?php echo $error; ?></div>
            <?php endif; ?>

            <form method="POST" class="form-section">
                <div class="mb-3">
                    <label for="year" class="form-label">Year</label>
                    <input type="number" class="form-control" id="year" name="year" min="1900" max="2100">
                </div>

                <div class="mb-3">
                    <label for="title" class="form-label">Award Title *</label>
                    <input type="text" class="form-control" id="title" name="title" required>
                </div>

                <div class="mb-3">
                    <label for="issuer" class="form-label">Issuer</label>
                    <input type="text" class="form-control" id="issuer" name="issuer">
                </div>

                <div class="mb-3">
                    <label for="details" class="form-label">Details</label>
                    <textarea class="form-control" id="details" name="details" rows="4"></textarea>
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-success">Add Award</button>
                    <a href="index.php" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
