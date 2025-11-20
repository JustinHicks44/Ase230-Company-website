<?php
$libDir = __DIR__ . '/lib/';
require_once $libDir . 'read_text.php';
require_once $libDir . 'read_csv.php';
require_once $libDir . 'read_json.php';

$adminDir = __DIR__ . '/admin/';
require_once $adminDir . 'contacts.php';

$dataDir = __DIR__ . '/data/';
$overview = read_text_file($dataDir . 'overview.txt');
$products = read_csv_file($dataDir . 'products.csv');
$teamAwards = read_json_file($dataDir . 'team_awards.json');
$team = $teamAwards['team'] ?? [];
$awards = $teamAwards['awards'] ?? [];

// Handle contact form submission
$contactMessage = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['send'])) {
    $contact = [
        'name' => $_POST['name'] ?? '',
        'email' => $_POST['email'] ?? '',
        'subject' => $_POST['subject'] ?? '',
        'comments' => $_POST['comments'] ?? ''
    ];
    
    if (!empty($contact['name']) && !empty($contact['email'])) {
        create_contact($contact);
        $contactMessage = '<div class="alert alert-success alert-dismissible fade show" role="alert">Thank you for your message! We will get back to you shortly.</div>';
    } else {
        $contactMessage = '<div class="alert alert-danger alert-dismissible fade show" role="alert">Please fill in all required fields.</div>';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>NaturaTech Solutions</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- Bootstrap CSS (CDN fallback to ensure styles even if local files are missing) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <!-- Material Design Icons (CDN) -->
    <link href="https://cdn.jsdelivr.net/npm/@mdi/font@7.0.96/css/materialdesignicons.min.css" rel="stylesheet">
    <!-- Local theme overrides (cache-busted for fresh loads) -->
    <link href="<?php echo '/naturatech/01/css/style.min.css?v=' . (file_exists(__DIR__ . '/css/style.min.css') ? filemtime(__DIR__ . '/css/style.min.css') : time()); ?>" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-light navbar-custom fixed-top" id="navbar">
            <div class="container">
                <a class="navbar-brand logo" href="#">NaturaTech</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <ul class="navbar-nav ms-auto navbar-center" id="navbar-navlist">
                        <li class="nav-item"><a href="#home" class="nav-link active">Home</a></li>
                        <li class="nav-item"><a href="#products" class="nav-link">Products</a></li>
                        <li class="nav-item"><a href="#team" class="nav-link">Team</a></li>
                        <li class="nav-item"><a href="#contact" class="nav-link">Contact Us</a></li>
                        <li class="nav-item"><a href="admin/pages/" class="nav-link" style="color: #ff6b6b; font-weight: bold;">Admin</a></li>
                    </ul>
                </div>
            </div>
        </nav>

        <section id="home" class="section pt-5">
            <div class="container pt-5">
                <div class="row">
                    <div class="col-lg-10 mx-auto">
                        <h1 class="mb-3">NaturaTech Solutions Inc.</h1>
                        <pre style="border:none;background:transparent;padding:0;white-space:pre-wrap;"><?php echo htmlspecialchars($overview); ?></pre>
                    </div>
                </div>
            </div>
        </section>

        <section id="products" class="section bg-light">
            <div class="container">
                <div class="row mb-4">
                    <div class="col-lg-8">
                        <h2>Our Products & Services</h2>
                        <p class="text-muted">Explore our key offerings.</p>
                    </div>
                </div>
                <div class="row">
                    <?php foreach ($products as $p):
                        $apps = explode('|', $p['Applications'] ?? '');
                    ?>
                    <div class="col-md-6 col-lg-3 mb-4">
                        <div class="card h-100">
                            <div class="card-body">
                                <h5><?php echo htmlspecialchars($p['Product']); ?></h5>
                                <p class="text-muted small"><?php echo htmlspecialchars($p['ShortDescription']); ?></p>
                                <ul>
                                <?php foreach ($apps as $a): ?>
                                    <li><?php echo htmlspecialchars($a); ?></li>
                                <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <section id="team" class="section">
            <div class="container">
                <div class="row mb-4">
                    <div class="col-lg-8">
                        <h2>Our Team</h2>
                    </div>
                </div>
                <div class="row">
                    <?php foreach ($team as $member): ?>
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card h-100">
                            <div class="card-body">
                                <h5><?php echo htmlspecialchars($member['name']); ?></h5>
                                <p class="text-muted"><?php echo htmlspecialchars($member['role']); ?></p>
                                <p class="small"><?php echo htmlspecialchars($member['bio']); ?></p>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>

                <div class="row mt-4">
                    <div class="col-lg-8">
                        <h3>Awards & Impact</h3>
                        <ul>
                        <?php foreach ($awards as $a): ?>
                            <li><?php echo htmlspecialchars(($a['year'] ?? '') . ' - ' . ($a['title'] ?? '') . ' ' . ($a['details'] ?? ($a['issuer'] ?? ''))); ?></li>
                        <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <section id="contact" class="section bg-light">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <h2>Get in Touch</h2>
                        <p class="text-muted">Have questions or want to collaborate? Reach out to us.</p>
                        <form method="post" name="myForm" onsubmit="return validateForm()">
                            <p id="error-msg"></p>
                            <div id="simple-msg"><?php echo $contactMessage; ?></div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-4">
                                        <label for="name" class="text-muted form-label">Name</label>
                                        <input name="name" id="name" type="text" class="form-control" placeholder="Enter name*" >
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-4">
                                        <label for="email" class="text-muted form-label">Email</label>
                                        <input name="email" id="email" type="email" class="form-control" placeholder="Enter email*">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-4">
                                        <label for="subject" class="text-muted form-label">Subject</label>
                                        <input type="text" class="form-control" id="subject" name="subject" placeholder="Enter Subject.." />
                                    </div>
                                    <div class="mb-4 pb-2">
                                        <label for="comments" class="text-muted form-label">Message</label>
                                        <textarea name="comments" id="comments" rows="4" class="form-control" placeholder="Enter message..."></textarea>
                                    </div>
                                    <button type="submit" id="submit" name="send" class="btn btn-primary">Send Message</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-5 ms-lg-auto">
                        <div class="mt-5 mt-lg-0">
                            <p class="text-muted mt-5 mb-3"><i class="me-2 text-muted icon icon-xs" data-feather="mail"></i> Support@info.com</p>
                            <p class="text-muted mb-3"><i class="me-2 text-muted icon icon-xs" data-feather="phone"></i> +91 123 4556 789</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <footer class="footer text-center py-4">
            <div class="container">
                <p class="mb-0">&copy; <?php echo date('Y'); ?> NaturaTech Solutions Inc.</p>
            </div>
        </footer>

    <!-- Bootstrap JS bundle (from CDN to ensure JS components work) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="<?php echo '/naturatech/01/js/smooth-scroll.polyfills.min.js?v=' . (file_exists(__DIR__ . '/js/smooth-scroll.polyfills.min.js') ? filemtime(__DIR__ . '/js/smooth-scroll.polyfills.min.js') : time()); ?>"></script>
    <script src="https://unpkg.com/feather-icons"></script>
    <script src="<?php echo '/naturatech/01/js/app.js?v=' . (file_exists(__DIR__ . '/js/app.js') ? filemtime(__DIR__ . '/js/app.js') : time()); ?>"></script>

    <script>
    function validateForm(){
        // basic client-side validation
        var name = document.getElementById('name').value.trim();
        var email = document.getElementById('email').value.trim();
        if(!name || !email){
            document.getElementById('error-msg').innerText = 'Name and email are required.';
            return false;
        }
        return true;
    }
    </script>
    </body>
</html>
