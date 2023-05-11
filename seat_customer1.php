<?php
$db = new PDO("mysql:host=localhost;dbname=queuing", "root", "");

// Retrieve the customer's queue_time
$query = $db->prepare("SELECT queue_time FROM queue WHERE id = ?");
$query->execute([$_POST['id']]);
$customer = $query->fetch();

// Update the customer's status to 'seated'
$query = $db->prepare("UPDATE queue SET status = 'seated' WHERE id = ?");
$query->execute([$_POST['id']]);

// Store the customer's name in a separate table or variable 
// You can create a form or table for you to be able to see the table records kaya niyo yan 
// $query = $db->prepare("INSERT INTO seated_customers (name) VALUES (?)");
// $query->execute([$customer['name']]);


// Redirect back to the queue page
header('Location: index.php');
exit();
?>
