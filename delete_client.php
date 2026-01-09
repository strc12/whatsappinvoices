<?php
// delete_client.php
require 'connection.php';

if (!isset($_GET['ClientID']) || !is_numeric($_GET['ClientID'])) {
    die("Invalid Client ID");
}

$clientID = (int)$_GET['ClientID'];

try {
    $stmt = $conn->prepare("DELETE FROM tblclient WHERE ClientID = :id");
    $stmt->execute([':id' => $clientID]);

    header("Location: clients_list.php?success=1");
    exit;
} catch (PDOException $e) {
    die("Error deleting client: " . $e->getMessage());
}
?>
