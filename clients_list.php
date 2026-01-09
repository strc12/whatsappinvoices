<?php
// clients_list.php
include_once 'connection.php';

// Fetch clients
try {
    $stmt = $conn->query("SELECT ClientID, Name, Phonenumber, Email, Address1, Address2, Town, Postcode FROM tblclient ORDER BY Name");
    $clients = $stmt->fetchAll();
    
} catch (PDOException $e) {
    die("Error fetching clients: " . $e->getMessage());
}

// Check for success message
$success = isset($_GET['success']) ? true : false;
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Client List</title>
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container my-5">
    <h2 class="mb-4">Clients</h2>

    <?php if ($success): ?>
        <div class="alert alert-success">Client added/updated/deleted successfully!</div>
    <?php endif; ?>

    <div class="mb-3">
        <a href="newclient.php" class="btn btn-primary">Add New Client</a>
    </div>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>Name</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Address1</th>
                <th>Address2</th>
                <th>Town</th>
                <th>Postcode</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($clients) === 0): ?>
                <tr>
                    <td colspan="8" class="text-center">No clients found.</td>
                </tr>
            <?php else: ?>
                <?php foreach ($clients as $client): ?>
                    <tr>
                        <td><?= htmlspecialchars($client['Name']) ?></td>
                        <td><?= htmlspecialchars($client['Phonenumber']) ?></td>
                        <td><?= htmlspecialchars($client['Email']) ?></td>
                        <td><?= htmlspecialchars($client['Address1']) ?></td>
                        <td><?= htmlspecialchars($client['Address2']) ?></td>
                        <td><?= htmlspecialchars($client['Town']) ?></td>
                        <td><?= htmlspecialchars($client['Postcode']) ?></td>
                        <td>
                            <a href="edit_client.php?ClientID=<?= $client['ClientID'] ?>" class="btn btn-sm btn-warning">Edit</a>
                            <!-- Delete button triggers modal -->
                            <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal" data-clientid="<?= $client['ClientID'] ?>" data-clientname="<?= htmlspecialchars($client['Name']) ?>">
                                Delete
                            </button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form id="deleteForm" method="get" action="delete_client.php">
      <input type="hidden" name="ClientID" id="modalClientID">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          Are you sure you want to delete <strong id="modalClientName"></strong>?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-danger">Yes, Delete</button>
        </div>
      </div>
    </form>
  </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
// Pass client info to modal when delete button is clicked
var deleteModal = document.getElementById('deleteModal');
deleteModal.addEventListener('show.bs.modal', function (event) {
    var button = event.relatedTarget; 
    var clientID = button.getAttribute('data-clientid');
    var clientName = button.getAttribute('data-clientname');

    // Update modal content
    document.getElementById('modalClientID').value = clientID;
    document.getElementById('modalClientName').textContent = clientName;
});
</script>
</body>
</html>
