<?php
// navbar.php
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">Julia Cunniffe Physiotherapy</a>

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

      </ul>

      <!-- Optional right-side links 
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link" href="#">Logout</a>
        </li>
      </ul>-->

    </div>
  </div>
</nav>
