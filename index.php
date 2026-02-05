<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
require_once 'connection.php';


// ---------------------
// Debug function (safe)
// ---------------------
function debug_log($data) {
    file_put_contents('debug.log', date('[Y-m-d H:i:s] ') . print_r($data, true) . PHP_EOL, FILE_APPEND);
}

// ---------------------
// Initialize variables
// ---------------------
$loginError = '';
$showLoginModal = !isset($_SESSION['Loggedin']);

// ---------------------
// Handle POST login
// ---------------------
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['admin_password'])) {

    $inputPassword = $_POST['admin_password'];

    // Optional: log POST data safely
    debug_log(['POST' => $_POST]);

    $stmt = $conn->prepare("SELECT password FROM tbladmin LIMIT 1");
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC); // fetch as associative array
    $storedPassword = $row['password'];

    debug_log(['Input' => $inputPassword, 'Stored' => $storedPassword]);

    if ($inputPassword === $storedPassword) {
        $_SESSION['Loggedin'] = true;

        // Redirect after successful login
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    } else {
        // Redirect with error flag
        header("Location: " . $_SERVER['PHP_SELF'] . "?login=failed");
        exit;
    }
}

// ---------------------
// Show modal if redirected with login error
// ---------------------
if (isset($_GET['login']) && $_GET['login'] === 'failed') {
    $loginError = "Incorrect password";
    $showLoginModal = true;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Julia Cunniffe Physiotherapy</title>

<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
    body {
        background-color: #f8f9fa;
    }
    .logo {
        max-width: 180px;
    }
</style>
</head>


<body>
        <?php include 'navbar.php'; ?>
<div class="container text-center my-5">

    <!-- Logo -->
    <div class="mb-4">
        <img src="csp_logo.png" alt="Chartered Society of Physiotherapy Logo" class="logo">
    </div>

    <!-- Title -->
    <h1 class="mb-4">Julia Cunniffe Physiotherapy</h1>

    <!-- Buttons -->
    <div class="d-grid gap-3 col-6 mx-auto">
        <a href="session.php" class="btn btn-primary btn-lg">
            Add New Session
        </a>
    </div>

</div>

<!-- Bootstrap JS -->

<!-- Login Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
  <div class="modal-dialog modal-dialog-centered">
    <form method="post" class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Admin Login</h5>
      </div>

      <div class="modal-body">
        <?php if ($loginError): ?>
            <div class="alert alert-danger"><?php echo $loginError; ?></div>
        <?php endif; ?>

        <div class="mb-3">
          <label class="form-label">Password</label>
          <input type="password" name="admin_password" class="form-control" required autofocus>
        </div>
      </div>

      <div class="modal-footer">
        <button type="submit" class="btn btn-primary w-100">Login</button>
      </div>
    </form>
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<?php if ($showLoginModal): ?>
<script>
    const loginModal = new bootstrap.Modal(
        document.getElementById('loginModal')
    );
    loginModal.show();
</script>
<?php endif; ?>

</body>
</html>
