<?php
 require_once('config.php');
$db = new PDO("mysql:host=localhost;dbname=queuing", "root", "");

// Execute SQL queries to delete all records from all tables in the 'queuing' database
$query1 = $db->prepare("DELETE FROM queue");
$query1->execute();

$query1 = $db->prepare("DELETE FROM floor1");
$query1->execute();

$query2 = $db->prepare("DELETE FROM floor2");
$query2->execute();

$query3 = $db->prepare("DELETE FROM floor3");
$query3->execute();

$query4 = $db->prepare("DELETE FROM floor6");
$query4->execute();

$query5 = $db->prepare("DELETE FROM priority_queue");
$query5->execute();


$file = 'counters.json';

if (file_exists($file)) {
  $data = json_decode(file_get_contents($file), true);
  foreach ($data as $key => $value) {
    $data[$key] = 0;
  }
  file_put_contents($file, json_encode($data));
  echo "Counter file has been cleared and reset to zero.";
} else {
  echo "Counter file does not exist.";
}


$file = 'counters_priority.json';

if (file_exists($file)) {
  $data = json_decode(file_get_contents($file), true);
  foreach ($data as $key => $value) {
    $data[$key] = 0;
  }
  file_put_contents($file, json_encode($data));
  echo "Counter file has been cleared and reset to zero.";
} else {
  echo "Counter file does not exist.";
}

header('Location: usher.php');
exit();

?>