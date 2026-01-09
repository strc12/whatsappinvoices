<?php
if(isset($_POST['phone']) && isset($_POST['message'])) {
    $phone = preg_replace('/\D/', '', $_POST['phone']); // remove non-digit characters
    $message = urlencode($_POST['message']); // encode message for URL

    // WhatsApp URL
    $whatsappURL = "https://wa.me/$phone?text=$message";

    // Redirect user to WhatsApp Web
    header("Location: $whatsappURL");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Send WhatsApp Message</title>
</head>
<body>
    BASIC PAGE needs integrating with Database
    <form method="POST">
        <input type="text" name="phone" placeholder="Phone number with country code" required><br><br>
        <textarea name="message" placeholder="Type your message here" required></textarea><br><br>
        <button type="submit">Send WhatsApp Message</button>
    </form>
</body>
</html>