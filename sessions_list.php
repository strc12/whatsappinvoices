<?php
include_once 'connection.php';

/*
|--------------------------------------------------------------------------
| Handle Paid status toggle
|--------------------------------------------------------------------------
*/
if (isset($_GET['toggle_paid'])) {
    $sessionID = (int)$_GET['toggle_paid'];

    $stmt = $conn->prepare("
        UPDATE tblsession
        SET Paid = CASE WHEN Paid = 1 THEN 0 ELSE 1 END
        WHERE SessionID = :id
    ");
    $stmt->execute([':id' => $sessionID]);

    header("Location: sessions_list.php");
    exit();
}

/*
|--------------------------------------------------------------------------
| Fetch sessions
|--------------------------------------------------------------------------
*/
$stmt = $conn->query("
    SELECT 
        s.SessionID,
        s.Date,
        s.Treatment,
        s.Time,
        s.Total,
        s.Paid,
        c.Name AS ClientName
    FROM tblsession s
    JOIN tblclient c ON s.ClientID = c.ClientID
    ORDER BY s.Date DESC
");
$sessions = $stmt->fetchAll();

/*
|--------------------------------------------------------------------------
| Calculate totals
|--------------------------------------------------------------------------
*/
$totalPaid = 0;
$totalOutstanding = 0;

foreach ($sessions as $session) {
    if ($session['Paid']) {
        $totalPaid += $session['Total'];
    } else {
        $totalOutstanding += $session['Total'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Sessions</title>

<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
<div class="container my-5">
    <h2 class="mb-4">Sessions</h2>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>Date</th>
                <th>Client</th>
                <th>Treatment</th>
                <th>Time (mins)</th>
                <th>Total (£)</th>
                <th>Paid</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php if (count($sessions) === 0): ?>
            <tr>
                <td colspan="7" class="text-center">No sessions found.</td>
            </tr>
        <?php else: ?>
            <?php foreach ($sessions as $session): ?>
                <tr>
                    <td><?= date('d-m-Y', strtotime($session['Date'])) ?></td>
                    <td><?= htmlspecialchars($session['ClientName']) ?></td>
                    <td><?= htmlspecialchars($session['Treatment']) ?></td>
                    <td><?= (int)$session['Time'] ?></td>
                    <td>£<?= number_format($session['Total'], 2) ?></td>
                    <td class="text-center">
                        <?php if ($session['Paid']): ?>
                            <span class="badge bg-success d-inline-block text-center" style="width: 100px;">Paid</span>
                        <?php else: ?>
                            <span class="badge bg-danger d-inline-block text-center" style="width: 100px;">Unpaid</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <a 
                            href="sessions_list.php?toggle_paid=<?= $session['SessionID'] ?>" 
                            class="btn btn-sm <?= $session['Paid'] ? 'btn-secondary' : 'btn-success' ?> w-100"
                        >
                            <?= $session['Paid'] ? 'Mark Unpaid' : 'Mark Paid' ?>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
        </tbody>
    </table>

    <!-- Totals -->
    <div class="row mt-4">
        <div class="col-md-6">
            <div class="alert alert-success">
                <strong>Total Paid:</strong> £<?= number_format($totalPaid, 2) ?>
            </div>
        </div>
        <div class="col-md-6">
            <div class="alert alert-warning">
                <strong>Total Outstanding:</strong> £<?= number_format($totalOutstanding, 2) ?>
            </div>
        </div>
    </div>

    <a href="new_session.php" class="btn btn-primary mt-3">Add New Session</a>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
