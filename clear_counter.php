<?php

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

header('Location: index.php');
exit();

?>