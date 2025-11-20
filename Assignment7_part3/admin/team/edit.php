<?php
require_once __DIR__ . '/../team.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : null;
$member = $id !== null ? get_team_by_id($id) : null;

if (!$member) {
    header('Location: index.php');
    exit;
}

$error = '';
$success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $updatedData = [
        'name' => $_POST['name'] ?? '',
        'role' => $_POST['role'] ?? '',
        'bio' => $_POST['bio'] ?? ''
    ];

    if (empty($updatedData['name'])) {
        $error = 'Name is required.';
    } elseif (empty($updatedData['role'])) {
        $error = 'Role is required.';
    } else {
        update_team_member($member['id'], $updatedData);
        $success = true;
        $member = array_merge($member, $updatedData);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Team Member - <?php echo htmlspecialchars($member['name']); ?></title>
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
                <a class="nav-link active" href="../team/">Team</a>
                <a class="nav-link" href="../awards/">Awards</a>
                <a class="nav-link" href="../products/">Products</a>
                <a class="nav-link" href="../contacts/">Contacts</a>
            </div>
        </div>
    </nav>

    <div class="row">
        <div class="col-md-8 mx-auto">
            <h1 class="mb-4">Edit Team Member</h1>

            <?php if ($success): ?>
                <div class="alert alert-success alert-dismissible fade show">Team member updated successfully!</div>
            <?php endif; ?>

            <?php if ($error): ?>
                <div class="alert alert-danger alert-dismissible fade show"><?php echo $error; ?></div>
            <?php endif; ?>

            <form method="POST" class="form-section">
                <div class="mb-3">
                    <label for="name" class="form-label">Name *</label>
                    <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($member['name']); ?>" required>
                </div>

                <div class="mb-3">
                    <label for="role" class="form-label">Role *</label>
                    <input type="text" class="form-control" id="role" name="role" value="<?php echo htmlspecialchars($member['role']); ?>" required>
                </div>

                <div class="mb-3">
                    <label for="bio" class="form-label">Biography</label>
                    <textarea class="form-control" id="bio" name="bio" rows="4"><?php echo htmlspecialchars($member['bio']); ?></textarea>
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                    <a href="detail.php?id=<?php echo $member['id']; ?>" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
