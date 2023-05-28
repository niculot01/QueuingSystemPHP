<?php
require_once('config.php');
$db = new PDO("mysql:host=localhost;dbname=queuing", "root", "");

// Retrieve the customer's queue_time
$query = $db->prepare("SELECT queue_time FROM queue WHERE id = ?");
$query->execute([$_POST['id']]);
$customer = $query->fetch();

// Update the customer's status to 'seated' in the 'queue' table
$query = $db->prepare("UPDATE queue SET status = 'seated' WHERE id = ?");
$query->execute([$_POST['id']]);

// Update the customer's status to 'seated' in the 'floor1' table
$query = $db->prepare("UPDATE floor1 SET status = 'seated' WHERE queue_time = ?");
$query->execute([$customer['queue_time']]);


// Update the customer's status to 'seated' in the 'floor3' table
$query = $db->prepare("UPDATE floor2 SET status = 'seated' WHERE queue_time = ?");
$query->execute([$customer['queue_time']]);

// Update the customer's status to 'seated' in the 'floor3' table
$query = $db->prepare("UPDATE floor3 SET status = 'seated' WHERE queue_time = ?");
$query->execute([$customer['queue_time']]);

// Redirect back to the queue page
header('Location: usher.php');
exit();
?>