<style>
    /* Set the body to full screen */
    body {
        position: fixed;
        margin: 0;
        padding: 0;
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: #f5f5f5;

    }

    /* Set the flex-container to a fixed width and center it */
    .flex-container {
        width: 100%;
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        align-items: flex-start;

    }

    /* Set the flex-item to a fixed width and add some margin */
    .flex-item {
        width: calc(90% - 0px);
        margin: 0px;
        display: flex;
        flex-direction: column;
    }

    /* Set the h2 to center aligned and add some margin */
    .flex-item h2 {
        margin: 0 auto 20px;
        text-align: center;
        font-size: 40px;
    }

    /* Set the table-wrapper to a fixed width and add a box shadow */
    .table-wrapper {
        max-height: 220px;
        width: 100%;
        margin: 0 auto;
        padding: 20px;
        background-color: #fff;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        overflow-y: hidden;
        text-align: center;
    }

    /* Style the table */
    table {
        width: 100%;
        border-collapse: collapse;
        border-spacing: 0;
        font-size: 30px;
    }

    th,
    td {
        padding: 10px;
        text-align: center;
        border: 1px solid #ddd;
    }

    th {
        background-color: #f5f5f5;
    }

    td.queue-number {
        font-weight: bold;
        font-size: 45px;
    }

    /* Style the buttons */
    button {
        display: block;
        margin: 0 auto;
        padding: 10px 20px;
        font-size: 1.2rem;
        background-color: #4CAF50;
        color: #fff;
        border: none;
        border-radius: 20px;
        cursor: pointer;
    }

    button:hover {
        background-color: #3e8e41;
    }

    .button-container form {
        display: inline-block;
        margin-right: 10px;
    }
</style>
</style>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
    crossorigin="anonymous"></script>


<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<?php
require_once('config.php');

$db = new PDO("mysql:host=localhost;dbname=queuing", "root", "");

// Retrieve the queue data
$query = $db->prepare("SELECT * FROM floor2 ORDER BY status DESC, queue_time ASC");
$query->execute();
$queue = $query->fetchAll();


// Initialize an empty array to store the queue data
$queue_data = array();

// Convert the queue data into an array
foreach ($queue as $customer) {
    $queue_data[] = array(
        'id' => $customer['id'],
        'queue_number' => $customer['queue_number'],
        'party_size' => $customer['party_size'],
        'queue_time' => $customer['queue_time'],
        'status' => $customer['status']
    );
}


// Check if a customer ID was provided to remove from the queue
if (isset($_POST['id'])) {
    $id_to_remove = $_POST['id'];

    // Remove the customer from the queue table
    $query = $db->prepare("DELETE FROM floor2 WHERE id = :id");
    $query->bindParam(':id', $id_to_remove, PDO::PARAM_INT);
    $query->execute();
}

$db = new PDO("mysql:host=localhost;dbname=queuing", "root", "");

// Retrieve the queue data for customers who are serving
$query = $db->prepare("SELECT * FROM floor2 WHERE status = 'serving' ORDER BY queue_time");
$query->execute();
$serving_customers = $query->fetchAll();

// Retrieve the queue data for customers who are waiting
$query = $db->prepare("SELECT * FROM floor2 WHERE status = 'waiting' ORDER BY queue_time");
$query->execute();
$waiting_customers = $query->fetchAll();

// Retrieve the queue data for customers who are seated
$query = $db->prepare("SELECT * FROM floor2 WHERE status = 'seated' ORDER BY queue_time");
$query->execute();
$seated_customers = $query->fetchAll();

// Merge the results into a single array
$queue_data = array_merge($serving_customers, $waiting_customers, $seated_customers);



foreach ($queue_data as $customer) {
    // Output customer information
}


// Initialize an empty array for each party size
$queue_data_by_party_size = array(
    4 => array(),
    10 => array(),
    12 => array()
);


// Convert the queue data into arrays based on party size
foreach ($queue_data as $customer) {
    $party_size = $customer['party_size'];
    if ($party_size >= 1 && $party_size <= 4) {
        $queue_data_by_party_size[4][] = $customer;
    } elseif ($party_size >= 5 && $party_size <= 10) {
        $queue_data_by_party_size[10][] = $customer;
    } elseif ($party_size >= 11 && $party_size <= 30) {
        $queue_data_by_party_size[12][] = $customer;
    }
}


// Output -> HTML format
echo '<div class="flex-container">';
foreach ($queue_data_by_party_size as $party_size => $customers) {
    echo '<div class="flex-item">';
    echo '<h2>Pax: ' . $party_size . '</h2>';
    echo '<div class="table-wrapper"><table>';
    echo '<tr>';
    echo '<th>Queue No.</th>';
    echo '<th>Status</th>';
    echo '<th class="action">Action</th>';
    echo '</tr>';
    foreach ($customers as $customer) {
        echo '<tr>';
        echo '<td class="queue-number">' . htmlspecialchars($customer['queue_number']) . '</td>';
        echo '<td>' . htmlspecialchars($customer['status']) . '</td>';
        echo '<td>';
        if ($customer['status'] == 'waiting') {
            echo '<form method="POST" action="serve_customer.php">';
            echo '<input type="hidden" name="queue_number" value="' . htmlspecialchars($customer['queue_number']) . '">';
            echo '<button type="submit">Serve</button></form>';
        }
        if ($customer['status'] == 'serving') {
            echo '<div class="button-container">';
            echo '<form method="post" action="seat2.php">';
            echo '<input type="hidden" name="queue_number" value="' . htmlspecialchars($customer['queue_number']) . '">';
            echo '<input type="hidden" name="id" value="' . htmlspecialchars($customer['id']) . '">';
            echo '<button type="submit">Seat</button>';
            echo '</form>';
            
            // echo '<form method="post">';
            // echo '<input type="hidden" name="id" value="' . htmlspecialchars($customer['id']) . '">';
            // echo '<button type="button" onclick="speak(\'' . htmlspecialchars($customer['queue_number']) . '\', \'2nd\'); toggleQueueNumberBlinking(this)">2nd</button>';
            // echo '</form>';
            echo '</div>';
        } else {
            echo '';
        }
        echo '</td>';
        echo '</tr>';
    }
    echo '</table></div>';
    echo '</div>'; // close flex-item div
}
echo '</div>'; // close flex-container div


?>