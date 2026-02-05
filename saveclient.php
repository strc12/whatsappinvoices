<?php
require_once 'auth.php';
?>
<?php
// save_client.php
include_once 'connection.php';
print_r($_POST);
// Check if form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Collect and sanitize input
    $name = trim($_POST['Name']);
    $phone = trim($_POST['Phonenumber']);
    $email = trim($_POST['Email'] ?? '');
    $address1 = trim($_POST['Address1'] ?? '');
    $address2 = trim($_POST['Address2'] ?? '');
    $town = trim($_POST['Town'] ?? '');                 
    $postcode = trim($_POST['Postcode'] ?? '');

    // Basic validation
    if (empty($name) || empty($phone)) {
        die("Name and Phone are required fields.");
    }
    // -------------------------------
    // Format phone number to always start with +44
    // -------------------------------
    // Remove spaces, dashes, brackets
    $phone = preg_replace('/[^\d+]/', '', $phone);

    // Check if it starts with +44
    if (strpos($phone, '+44') !== 0) {
        // Remove leading 0 if present
        if ($phone[0] === '0') {
            $phone = substr($phone, 1);
        }
        $phone = '+44' . $phone;
    }
    try {
        // Prepare insert statement
        $stmt = $conn->prepare("
            INSERT INTO tblclient (Name, Phonenumber, Email,  Address1, Address2, Town, Postcode)
            VALUES (:name, :phone, :email, :address1, :address2, :town, :postcode)");

        // Bind parameters
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':address1', $address1);
        $stmt->bindParam(':address2', $address2);
        $stmt->bindParam(':town', $town);
        $stmt->bindParam(':postcode', $postcode);

        // Execute query
        $stmt->execute();

        // Redirect back to clients list or form with success message
        header("Location: clients_list.php?success=1");
        exit();

    } catch (PDOException $e) {
        die("Error saving client: " . $e->getMessage());
    }

} else {
    // If accessed directly, redirect to form
    header("Location: new_client.php");
    exit();
}
?>
