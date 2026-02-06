<?php
// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="mainNavbar">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">

        <!-- Clients -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
            Clients
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="clients_list.php">View Clients</a></li>
            <li><a class="dropdown-item" href="newclient.php">Add New Client</a></li>
          </ul>
        </li>

        <!-- Sessions -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
            Sessions
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="session.php">Create Session</a></li>
            <li><a class="dropdown-item" href="sessions_list.php">View Sessions</a></li>
          </ul>
        </li>
        <!-- Sessions -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
            Invoices
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="session.php">Build Invoice</a></li>
            <li><a class="dropdown-item" href="sessions_list.php">View Invoices</a></li>
          </ul>
        </li>

      </ul>

      <!-- Right side: Logged in indicator -->
<div class="d-flex align-items-center ms-auto">
    <?php if (isset($_SESSION['Loggedin']) && $_SESSION['Loggedin'] === true): ?>
        <span class="text-success me-3">
            Logged in
        </span>
        <a class="btn btn-outline-light btn-sm" href="logout.php">Logout</a>
    <?php else: ?>
        <span class="text-warning">
            Not logged in
        </span>
    <?php endif; ?>
</div>
    </div>
  </div>
</nav>
