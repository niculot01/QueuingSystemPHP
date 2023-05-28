<?php
 require_once('config.php');
$db = new PDO("mysql:host=localhost;dbname=queuing", "root", "");

// Retrieve the customer's queue number and party size
$query = $db->prepare("SELECT id, queue_time FROM queue WHERE queue_number = ? AND status = 'waiting'");
$query->execute([$_POST['queue_number']]);
$customer = $query->fetch();

if ($customer) {
    // Update the customer's status to 'canceled'
    $query = $db->prepare("UPDATE queue SET status = 'canceled' WHERE id = ?");
    $query->execute([$customer['id']]);
}

// Redirect back to the queue page
header('Location: usher.php');
exit();
?>