<?php

include_once 'connection.php';

// Fetch clients
$stmt = $conn->query("SELECT ClientID, Name FROM tblclient ORDER BY Name");
$clients = $stmt->fetchAll();

// Default values
$today = date('Y-m-d');
$duedate = date('Y-m-d', strtotime('+7 days'));
$defaultTreatment = "Physiotherapy";
$defaultTime = 60;

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>New Session Form</title>
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container my-5">
    <h2 class="mb-4">Create New Session</h2>
    <form action="save_session.php" method="post" class="row g-3">

        <div class="col-md-6">
            <label for="client" class="form-label">Select Client</label>
            <select name="ClientID" id="client" class="form-select" required>
                <option value="">-- Select Client --</option>
                <?php foreach($clients as $client): ?>
                    <option value="<?= $client['ClientID'] ?>"><?= htmlspecialchars($client['Name']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="col-md-6">
            <label for="Treatment" class="form-label">Treatment</label>
            <input type="text" id="Treatment" name="Treatment" class="form-control" value="<?= $defaultTreatment ?>" required>
        </div>

        <div class="col-md-6">
            <label for="date" class="form-label">Date</label>
            <input type="date" id="date" name="Date" class="form-control" value="<?= $today ?>" required>
        </div>

        <div class="col-md-6">
            <label for="duedate" class="form-label">Due Date</label>
            <input type="date" id="duedate" name="Duedate" class="form-control" value="<?= $duedate ?>" required>
        </div>

        <div class="col-md-6">
            <label for="time" class="form-label">Time (minutes)</label>
            <input type="number" id="time" name="Time" class="form-control" value="<?= $defaultTime ?>" step="15" min="15" required>
        </div>

        <div class="col-md-6">
            <label for="total" class="form-label">Total (£)</label>
            <input type="number" step="0.01" id="total" name="Total" class="form-control" required>
        </div>

        <div class="col-12 form-check">
            <input type="hidden" name="Paid" value="0">
            <input type="checkbox" class="form-check-input" id="paid" name="Paid" value="1">
            <label class="form-check-label" for="paid">Paid</label>
        </div>

        <div class="col-12">
            <button type="submit" class="btn btn-primary">Save Session</button>
        </div>

    </form>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
