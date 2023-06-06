<?php
require_once('config.php');

if (!extension_loaded('sockets')) {
    header('Location: self_add.php');
    exit();
}

// Get the party size from the form
$partySize = filter_input(INPUT_POST, 'party_size', FILTER_VALIDATE_INT);
if ($partySize === false || $partySize < 1 || $partySize > 50) {
    // Handle invalid input
    header('Location: self_add.php?error=invalid_input');
    exit();
}

date_default_timezone_set('Asia/Manila');

// Load the counters from the file
try {
    $counters = json_decode(file_get_contents('counters.json'), true);
} catch (Exception $e) {
    // Handle the error here
    error_log($e->getMessage());
    $counters = array();
}

// Check if there are any previous queue numbers for this party size
$lastQueueNumber = isset($counters[$partySize]) ? $counters[$partySize] : 0;

// Generate the next queue number for this party size
$queueNumberPrefix = 'GT' . str_pad($partySize, 1, '0', STR_PAD_LEFT);
$counter = $lastQueueNumber + 1;
$queueNumber = $queueNumberPrefix . '-' . str_pad($counter, 2, '0', STR_PAD_LEFT);

// If there are no previous queue numbers for this party size, start from 1
if (empty($lastQueueNumber)) {
    $lastQueueNumber = 0;
}

// Increment the counter for this party size and store the updated counters back in the file
try {
    $counters[$partySize] = $counter;
    file_put_contents('counters.json', json_encode($counters));
} catch (Exception $e) {
    // Handle the error here
    error_log($e->getMessage());
    header('Location: self_add.php?error=counter_error');
    exit();
}

$date = date("m-d-Y\n h:i:s A", strtotime("now"));

// Create the receipt string with character spacing 1
$receipt = "\x1d\x21\x16\x1b\x45\x0" 
    . "\x1B\x20\x00\x1D\x21\x2D\x1B\x20\x15";

// Calculate the padding for the queue number based on the paper width
$paddingLength = max(0, (8 - strlen($queueNumber)) / 2);
$queuePadding = str_repeat(' ', $paddingLength);

$receipt .= $queuePadding . $queueNumber . "\x1D\x40\x00\x1B\x21\x00 "
    . "\n\n" . "Please wait for your number\nto be called.\nTHANK YOU!" . "\n\n" .
    str_pad("After 1 minute of the number\nbeing called,\nit will be\nforfeited.", 20, "\x05", STR_PAD_BOTH)
    . "\n- - - - - - - - \n $date\n\n\n\n\n\n\x1b" . 'm';
$receipt .= "\x1d\x21\x00\x1b\x45\x00";

// Insert the customer into the database
$db = new PDO("mysql:host=localhost;dbname=queuing", "root", "");
$query = $db->prepare("INSERT INTO queue (party_size, queue_time, status, queue_number) VALUES (?, NOW(), 'waiting', ?)");
if (!$query->execute([$partySize, $queueNumber])) {
    // Handle the error hereeeee
    header('Location: self_add.php?error=database_error');
    exit();
}

// Connect to the printer using sockets
$printerIP = '192.168.0.50';
$printerPort = 9100;
$printer = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
if ($printer === false) {
    error_log("Unable to create socket.");
    header('Location: self_add.php?error=printer_error');
    exit();
}

$result = socket_connect($printer, $printerIP, $printerPort);
if ($result === false) {
    error_log("Unable to connect to the printer.");
    header('Location: self_add.php?error=printer_error');
    exit();
}

// ... (Rest of the code)

// Print the receipt
$bytesWritten = socket_write($printer, $receipt, strlen($receipt));
if ($bytesWritten === false) {
    error_log("Unable to write to the printer.");
    header('Location: self_add.php?error=printer_error');
    exit();
}

// Check if all data was written to the socket
if ($bytesWritten < strlen($receipt)) {
    error_log("Incomplete write to the printer.");
    header('Location: self_add.php?error=printer_error');
    exit();
}

socket_close($printer);

// Insert the customer into the database
$db = new PDO("mysql:host=localhost;dbname=queuing", "root", "");

// Check if the printer connection was successful before recording the record
if ($result !== false && $bytesWritten === strlen($receipt)) {
    $query = $db->prepare("INSERT INTO queue (party_size, queue_time, status, queue_number) VALUES (?, NOW(), 'waiting', ?)");
    if (!$query->execute([$partySize, $queueNumber])) {
        // Handle the error here
        header('Location: self_add.php?error=database_error');
        exit();
    }
} else {
    // Handle the error here
    header('Location: self_add.php?error=printer_error');
    exit();
}
?>