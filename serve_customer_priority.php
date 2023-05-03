<?php
$db = new PDO("mysql:host=localhost;dbname=queuing", "root", "");

// Retrieve the queue number of the customer to be served
$queue_number = $_POST['queue_number'];

// Update the status of the served customer in the database
$query = $db->prepare("UPDATE priority_queue SET status = 'serving' WHERE queue_number = :queue_number");
$query->bindParam(':queue_number', $queue_number);
$query->execute();

// Redirect back to the queue page
header('Location: index.php');
exit();
?>