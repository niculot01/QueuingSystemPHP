<?php
if (!extension_loaded('sockets')) {
    dl('sockets' . PHP_SHLIB_SUFFIX);
}

$partySize = $_POST['priority_party_size'];
$lastQueueNumber = '';

date_default_timezone_set('Asia/Manila');


// Load the counters from the file
try {
    $counters = json_decode(file_get_contents('counters_priority.json'), true);
} catch (Exception $e) {
    // Handle the error here
    error_log($e->getMessage());
    $counters = array();
    file_put_contents('counters_priority.json', json_encode($counters)); // create new file if not exists
}

// Check if there are any previous queue numbers for this party size
if (isset($counters[$partySize])) {
    $lastQueueNumber = $counters[$partySize];
}

// If there are no previous queue numbers for this party size, start from 1
if (empty($lastQueueNumber)) {
    $lastQueueNumber = 0;
}

// Generate the next queue number for this party size
$queueNumberPrefix = 'GTP' . str_pad($partySize, 1, '0', STR_PAD_LEFT);
$counter = $lastQueueNumber + 1;
$queueNumber = $queueNumberPrefix . str_pad($counter, 2, '0', STR_PAD_LEFT);

// Increment the counter for this party size and store the updated counters back in the file
try {
    $counters[$partySize] = $counter;
    file_put_contents('counters_priority.json', json_encode($counters));
} catch (Exception $e) {
    // Handle the error here
    error_log($e->getMessage());
}

$date = date("m-d-Y\n h:i:s A");



// Create the receipt string with character spacing 1
$receipt = "\x1d\x21\x16\x1b\x45\x0" 
    . "\x1B\x20\x00\x1D\x21\x2D\x1B\x20\x15";

// Calculate the padding for the queue number based on the paper width
$paddingLength = max(0, (8 - strlen($queueNumber)) / 2);
$queuePadding = str_repeat(' ', $paddingLength);


$receipt .= $queuePadding . $queueNumber . "\x1D\x40\x00\x1B\x21\x00 "
    . "\n\n\n\n" .
    str_pad("After 2 minutesof the number\nbeing called,\nit will be\nforfeited.", 20, "\x05", STR_PAD_BOTH)


    . "\n- - - - - - - - \n $date\n\n\n\n\n\n\x1b" . 'm';
$receipt .= "\x1d\x21\x00\x1b\x45\x00";

// Insert the customer into the database
$db = new PDO("mysql:host=localhost;dbname=queuing", "root", "");
$query = $db->prepare("INSERT INTO priority_queue (party_size, queue_time, status, queue_number) VALUES (?, NOW(), 'waiting', ?)");
$query->execute([$partySize, $queueNumber]);


//Connect to the printer
$printerIP = '192.168.0.50';
$printerPort = 9100;
$printer = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
if (!$printer) {
    die("Unable to create socket.");
}
$result = socket_connect($printer, $printerIP, $printerPort);
if (!$result) {
    die("Unable to connet to printer.");
} 

// Print the receipt
socket_write($printer, $receipt, strlen($receipt));
socket_close($printer);

header('Location: index.php');
exit();
?>