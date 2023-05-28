<?php
require_once('config.php');
// Connect to the database
$db = new PDO("mysql:host=localhost;dbname=queuing", "root", "");

// Retrieve the customer's queue_time and status from the 'queue' table
$query = $db->prepare("SELECT queue_time, status FROM queue WHERE queue_number = ?");
$query->execute([$_POST['queue_number']]);
$customer = $query->fetch();

// Debug statement to check the value of $_POST['queue_number']
echo "Queue number value: " . $_POST['queue_number'] . "<br>";

// Debug statement to check the query result
var_dump($customer);

// Check if the customer queue number exists in the 'queue' table
if (!$customer) {
    echo "Error: Customer queue number not found in the 'queue' table";
    header("refresh:3; url=3F_display.php");
    exit();
}

// Update the customer's status to 'seated' in the 'queue' table
$query = $db->prepare("UPDATE queue SET status = 'seated' WHERE queue_number = ?");
$query->execute([$_POST['queue_number']]);

// Retrieve the customer's queue_time and status from the 'floor3' table
$query = $db->prepare("SELECT queue_time, status FROM floor3 WHERE queue_number = ?");
$query->execute([$_POST['queue_number']]);
$customer = $query->fetch();

// Debug statement to check the query result
var_dump($customer);

// Check if the customer queue number exists in the 'floor3' table
if (!$customer) {
    echo "Error: Customer queue number not found in the 'floor3' table";
    exit();
}

// Update the customer's status to 'seated' in the 'floor3' table
$query = $db->prepare("UPDATE floor3 SET status = 'seated' WHERE queue_number = ?");
$query->execute([$_POST['queue_number']]);

// Redirect back to the queue page
header('Location: 3F_display.php');
exit();
?>
