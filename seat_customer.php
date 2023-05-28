<?php
require_once('config.php');
$db = new PDO("mysql:host=localhost;dbname=queuing", "root", "");

// Retrieve the customer's queue_time
$query = $db->prepare("SELECT queue_time FROM queue WHERE id = ?");
$query->execute([$_POST['id']]);
$customer = $query->fetch();

// Update the customer's status to 'seated'
$query = $db->prepare("UPDATE queue SET status = 'seated' WHERE id = ?");
$query->execute([$_POST['id']]);


// Redirect back to the queue page
header('Location: display1.php');
exit();
?>
