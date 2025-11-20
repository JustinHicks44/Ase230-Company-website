<?php
require_once __DIR__ . '/../awards.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : null;
$award = $id !== null ? get_award_by_id($id) : null;

if (!$award) {
    header('Location: index.php');
    exit;
}

$error = '';
$success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $updatedData = [
        'year' => $_POST['year'] ?? '',
        'title' => $_POST['title'] ?? '',
        'issuer' => $_POST['issuer'] ?? '',
        'details' => $_POST['details'] ?? ''
    ];

    if (empty($updatedData['title'])) {
        $error = 'Award title is required.';
    } else {
        update_award($award['id'], $updatedData);
        $success = true;
        $award = array_merge($award, $updatedData);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Award - <?php echo htmlspecialchars($award['title']); ?></title>
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
            <h1 class="mb-4">Edit Award</h1>

            <?php if ($success): ?>
                <div class="alert alert-success alert-dismissible fade show">Award updated successfully!</div>
            <?php endif; ?>

            <?php if ($error): ?>
                <div class="alert alert-danger alert-dismissible fade show"><?php echo $error; ?></div>
            <?php endif; ?>

            <form method="POST" class="form-section">
                <div class="mb-3">
                    <label for="year" class="form-label">Year</label>
                    <input type="number" class="form-control" id="year" name="year" min="1900" max="2100" value="<?php echo htmlspecialchars($award['year'] ?? ''); ?>">
                </div>

                <div class="mb-3">
                    <label for="title" class="form-label">Award Title *</label>
                    <input type="text" class="form-control" id="title" name="title" value="<?php echo htmlspecialchars($award['title']); ?>" required>
                </div>

                <div class="mb-3">
                    <label for="issuer" class="form-label">Issuer</label>
                    <input type="text" class="form-control" id="issuer" name="issuer" value="<?php echo htmlspecialchars($award['issuer'] ?? ''); ?>">
                </div>

                <div class="mb-3">
                    <label for="details" class="form-label">Details</label>
                    <textarea class="form-control" id="details" name="details" rows="4"><?php echo htmlspecialchars($award['details'] ?? ''); ?></textarea>
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                    <a href="detail.php?id=<?php echo $award['id']; ?>" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
