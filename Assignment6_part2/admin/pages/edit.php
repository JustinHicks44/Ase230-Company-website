<?php
require_once __DIR__ . '/../pages.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : null;
$page = $id !== null ? get_page_by_id($id) : null;

if (!$page) {
    header('Location: index.php');
    exit;
}

$error = '';
$success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $updatedData = [
        'title' => $_POST['title'] ?? '',
        'slug' => $_POST['slug'] ?? '',
        'content' => $_POST['content'] ?? ''
    ];

    if (empty($updatedData['title'])) {
        $error = 'Page title is required.';
    } elseif (empty($updatedData['slug'])) {
        $error = 'Page slug is required.';
    } else {
        update_page($page['id'], $updatedData);
        $success = true;
        $page = array_merge($page, $updatedData);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Page - <?php echo htmlspecialchars($page['title']); ?></title>
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
                <a class="nav-link active" href="../pages/">Pages</a>
                <a class="nav-link" href="../team/">Team</a>
                <a class="nav-link" href="../awards/">Awards</a>
                <a class="nav-link" href="../products/">Products</a>
                <a class="nav-link" href="../contacts/">Contacts</a>
            </div>
        </div>
    </nav>

    <div class="row">
        <div class="col-md-8 mx-auto">
            <h1 class="mb-4">Edit Page</h1>

            <?php if ($success): ?>
                <div class="alert alert-success alert-dismissible fade show">Page updated successfully!</div>
            <?php endif; ?>

            <?php if ($error): ?>
                <div class="alert alert-danger alert-dismissible fade show"><?php echo $error; ?></div>
            <?php endif; ?>

            <form method="POST" class="form-section">
                <div class="mb-3">
                    <label for="title" class="form-label">Page Title *</label>
                    <input type="text" class="form-control" id="title" name="title" value="<?php echo htmlspecialchars($page['title']); ?>" required>
                </div>

                <div class="mb-3">
                    <label for="slug" class="form-label">Page Slug *</label>
                    <input type="text" class="form-control" id="slug" name="slug" value="<?php echo htmlspecialchars($page['slug']); ?>" required>
                </div>

                <div class="mb-3">
                    <label for="content" class="form-label">Content</label>
                    <textarea class="form-control" id="content" name="content" rows="6"><?php echo htmlspecialchars($page['content']); ?></textarea>
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                    <a href="detail.php?id=<?php echo $page['id']; ?>" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
