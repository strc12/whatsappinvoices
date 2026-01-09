<?php
require 'connection.php';
print_r($_POST);
// Validate input
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $clientID  = $_POST['ClientID'] ?? null;
    $treatment = $_POST['Treatment'] ?? null;
    $date      = $_POST['Date'] ?? null;
    $duedate   = $_POST['Duedate'] ?? null;
    $time      = $_POST['Time'] ?? null;
    $total     = $_POST['Total'] ?? null;
    $paid      = $_POST['Paid'];
    echo($paid.$clientID.$treatment.$date.$duedate.$time.$total);
    if (!$clientID || !$treatment || !$date || !$duedate || !$time || !$total) {
        die("Please fill in all required fields.");
    }

    try {
        // Insert session into tblsession
        $stmt = $conn->prepare("INSERT INTO tblsession (treatment, Date, Time, ClientID, Total, Paid, Duedate)
                               VALUES (:treatment, :date, :time, :clientID, :total, :paid, :duedate)");
        $stmt->execute([
            ':treatment' => $treatment,
            ':date'      => $date,
            ':time'      => $time,
            ':clientID'  => $clientID,
            ':total'     => $total,
            ':paid'      => $paid,
            ':duedate'   => $duedate
        ]);

        // Get client info for WhatsApp message
        $stmt2 = $conn->prepare("SELECT Name, Phonenumber FROM tblclient WHERE ClientID = :id");
        $stmt2->execute([':id' => $clientID]);
        $client = $stmt2->fetch();

        if (!$client) {
            die("Client not found.");
        }

        // Format WhatsApp message
        $name = $client['Name'];
        $phone = preg_replace('/\D+/', '', $client['Phonenumber']); // digits only
        $message = "Hello $name,\n";
        $message .= "Payment for your $treatment session $time minutes on $date.\n";
        $message .= "Total: £$total\n";
        $message .= "Due: $duedate.";
        $message .= "\nMany thanks\nJulia";
        $encodedMessage = urlencode($message);
        $whatsappURL = "https://wa.me/$phone?text=$encodedMessage";
        
        $encodedMessage = urlencode($message);

        // WhatsApp link (works for web or mobile)
        $whatsappURL = "https://wa.me/$phone?text=$encodedMessage";

        // Redirect to client list or show confirmation with WhatsApp link
        header("Location: $whatsappURL");
        //header("Location: index.php?success=1&wa=" . urlencode($whatsappURL));
        exit;

    } catch (PDOException $e) {
        die("Error saving session: " . $e->getMessage());
    }
} else {
    die("Invalid request.");
}
