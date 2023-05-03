<?php
$db = new PDO("mysql:host=localhost;dbname=queuing", "root", "");


// Execute a SQL query to delete all records from the table that stores your queue data
$query1 = $db->prepare("DELETE FROM queue");
$query1->execute();

$query2 = $db->prepare("DELETE FROM priority_queue");
$query2->execute();


// Redirect the user back to the queue display page
header('Location: index.php');
exit();

?>