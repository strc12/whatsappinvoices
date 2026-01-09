<?php
// edit_client.php
require 'connection.php';

if (!isset($_GET['ClientID']) || !is_numeric($_GET['ClientID'])) {
    die("Invalid Client ID");
}

$clientID = (int)$_GET['ClientID'];
echo("Session page");
// Fetch client data
try {
    $stmt = $conn->prepare("SELECT * FROM tblclient WHERE ClientID = :id");
    $stmt->execute([':id' => $clientID]);
    $client = $stmt->fetch();

    if (!$client) {
        die("Client not found.");
    }
} catch (PDOException $e) {
    die("Error fetching client: " . $e->getMessage());
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['Name'];
    $phone = $_POST['Phonenumber'];
    $email = $_POST['Email'];
    $address1 = $_POST['Address1'];
    $address2 = $_POST['Address2'];
    $town = $_POST['Town'];
    $postcode = $_POST['Postcode'];

    if ($name && $phone && $email && $address1 && $town && $postcode) {
        try {
            $update = $conn->prepare("UPDATE tblclient SET Name = :name, Phonenumber = :phone, Email = :email, 
                                     Address1 = :address1, Address2 = :address2, Town = :town, Postcode = :postcode 
                                     WHERE ClientID = :id");
            $update->execute([
                ':name' => $name,
                ':phone' => $phone,
                ':email' => $email,
                ':address1' => $address1,
                ':address2' => $address2,
                ':town' => $town,
                ':postcode' => $postcode,
                ':id' => $clientID
            ]);

            header("Location: clients_list.php?success=1");
            exit;
        } catch (PDOException $e) {
            $error = "Error updating client: " . $e->getMessage();
        }
    } else {
        $error = "Please fill in all required fields.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Edit Client</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container my-5">
    <h2 class="mb-4">Edit Client</h2>

    <?php if (!empty($error)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form action="" method="post" class="row g-3">

        <div class="col-md-6">
            <label for="name" class="form-label">Name *</label>
            <input type="text" id="name" name="Name" class="form-control" value="<?= htmlspecialchars($client['Name']) ?>" required>
        </div>

        <div class="col-md-6">
            <label for="phone" class="form-label">Phone Number *</label>
            <input type="text" id="phone" name="Phonenumber" class="form-control" value="<?= htmlspecialchars($client['Phonenumber']) ?>" required>
        </div>

        <div class="col-md-6">
            <label for="email" class="form-label">Email *</label>
            <input type="email" id="email" name="Email" class="form-control" value="<?= htmlspecialchars($client['Email']) ?>" required>
        </div>

        <!-- Address Group -->
        <div class="col-12">
            <div class="card border-secondary mb-3">
                <div class="card-header bg-secondary text-white">Address</div>
                <div class="card-body row g-3">
                    <div class="col-md-6">
                        <label for="address1" class="form-label">Address 1 *</label>
                        <input type="text" id="address1" name="Address1" class="form-control" value="<?= htmlspecialchars($client['Address1']) ?>" required>
                    </div>

                    <div class="col-md-6">
                        <label for="address2" class="form-label">Address 2</label>
                        <input type="text" id="address2" name="Address2" class="form-control" value="<?= htmlspecialchars($client['Address2']) ?>">
                    </div>

                    <div class="col-md-6">
                        <label for="town" class="form-label">Town *</label>
                        <input type="text" id="town" name="Town" class="form-control" value="<?= htmlspecialchars($client['Town']) ?>" required>
                    </div>

                    <div class="col-md-6">
                        <label for="postcode" class="form-label">Postcode *</label>
                        <input type="text" id="postcode" name="Postcode" class="form-control" value="<?= htmlspecialchars($client['Postcode']) ?>" required>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">
            <button type="submit" class="btn btn-primary">Update Client</button>
            <a href="clients_list.php" class="btn btn-secondary">Cancel</a>
        </div>

    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
