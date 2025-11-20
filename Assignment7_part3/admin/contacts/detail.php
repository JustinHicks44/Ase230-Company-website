<?php
require_once __DIR__ . '/../contacts.php';
$id = isset($_GET['id']) ? (int)$_GET['id'] : null;
$contact = $id !== null ? get_contact_by_id($id) : null;

if (!$contact) {
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Request - <?php echo htmlspecialchars($contact['name']); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { padding-top: 20px; }
        .detail-section { background: #f8f9fa; padding: 20px; border-radius: 5px; margin-bottom: 20px; }
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
        <div class="col-md-8 mx-auto">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1>Contact Request</h1>
                <div>
                    <a href="index.php" class="btn btn-secondary">Back to List</a>
                </div>
            </div>

            <div class="detail-section">
                <h3>Contact Information</h3>
                <div class="row mb-3">
                    <div class="col-md-3"><strong>ID:</strong></div>
                    <div class="col-md-9"><?php echo htmlspecialchars($contact['id']); ?></div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-3"><strong>Name:</strong></div>
                    <div class="col-md-9"><?php echo htmlspecialchars($contact['name']); ?></div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-3"><strong>Email:</strong></div>
                    <div class="col-md-9"><a href="mailto:<?php echo htmlspecialchars($contact['email']); ?>"><?php echo htmlspecialchars($contact['email']); ?></a></div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-3"><strong>Subject:</strong></div>
                    <div class="col-md-9"><?php echo htmlspecialchars($contact['subject'] ?? ''); ?></div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-3"><strong>Message:</strong></div>
                    <div class="col-md-9"><?php echo nl2br(htmlspecialchars($contact['message'] ?? $contact['comments'] ?? '')); ?></div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-3"><strong>Submitted:</strong></div>
                    <div class="col-md-9"><?php echo htmlspecialchars($contact['submitted_at']); ?></div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
