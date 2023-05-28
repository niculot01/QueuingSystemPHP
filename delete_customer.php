<?php

 require_once('config.php');

$db = new PDO("mysql:host=localhost;dbname=queuing", "root", "");

// Delete the customer from the queue
$query = $db->prepare("DELETE FROM queue WHERE id = ?");
$query->execute([$_POST['id']]);

// Redirect 
header('Location: usher.php');
exit();
?>
