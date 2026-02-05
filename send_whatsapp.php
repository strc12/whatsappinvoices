<?php
session_start();
$whatsappURL = $_SESSION['wa_url'] ?? '';
echo("WhatsApp URL: " . $whatsappURL . "<br>");
unset($_SESSION['wa_url']);

if (!$whatsappURL) {
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Send WhatsApp</title>
</head>
<body>
<h3>Sending WhatsApp message...</h3>
<p>If WhatsApp doesn’t open automatically, <a href="<?php echo $whatsappURL; ?>" target="_blank">click here</a>.</p>

<script>
// Open WhatsApp in the same tab
//window.location.href = "<?php echo $whatsappURL; ?>";
window.open("<?php echo $whatsappURL; ?>", "_blank");
// After 5 seconds, redirect back to your site
setTimeout(function() {
    window.location.href = "index.php";
}, 5000);
</script>
</body>
</html>
