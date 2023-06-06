<?php
require_once('config.php');
$db = new PDO("mysql:host=localhost;dbname=queuing", "root", "");

// Retrieve the queue number and floor of the customer to be served
$queue_number = $_POST['queue_number'];
$floor = $_POST['floor'];

// Determine the table name based on the floor
switch ($floor) {
  case '1ˢᵗFloor':
    $table_name = 'floor1';
    break;
  case '2ⁿᵈFloor':
    $table_name = 'floor2';
    break;
  case '3ʳᵈFloor':
    $table_name = 'floor3';
    break;
  case '6ᵗʰFloor':
    $table_name = 'floor6';
    break;
  default:
    // Handle invalid floor
    break;
}

// Insert the data into the appropriate table based on the floor
$query = $db->prepare("INSERT INTO $table_name (queue_number, party_size, queue_time, floor, status) SELECT queue_number, party_size, queue_time, :floor, 'serving' FROM queue WHERE queue_number = :queue_number");
$query->bindParam(':queue_number', $queue_number);
$query->bindParam(':floor', $floor);
$query->execute();

// Update the status of the served customer in the queue table
$query = $db->prepare("UPDATE queue SET status = 'serving', floor = :floor WHERE queue_number = :queue_number");
$query->bindParam(':queue_number', $queue_number);
$query->bindParam(':floor', $floor);
$query->execute();

// Update the status of the served customer in the queue table
$query = $db->prepare("UPDATE queue SET status = 'serving' WHERE queue_number = :queue_number");
$query->bindParam(':queue_number', $queue_number);
$query->execute();


// Redirect back to the queue page
header('Location: usher.php');
exit();
?>