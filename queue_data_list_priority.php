
<style>
    /* Define the style for the table wrapper */
   .h2-container1{

   }

    /* Define media queries to adjust the layout for smaller screens */
    @media (max-width: 768px) {
        .flex-container {
            flex-direction: column;
        }

        .flex-item {
            width: 100%;
        }
    }


    .nstable-container1 {
        position: absolute;
        top: 540px;
        right: 75px;
        margin: 5px;
        padding: 5px;
        font-size: 50px;
        text-align: center;
        background-color: #ffffff;
        border-radius: 20px;
        height: 235px;
        width: 510px;
        overflow-y: hidden;

    }

    /* .nstable-container h2 {
        animation: blink 4s infinite;
    }

    @keyframes blink {
        50% {
            opacity: 0.5;
        }
    } */


    .nstable1 {
        border-collapse: collapse;
        width: 100%;

    }


    .nstr1 {
        height: 30px;
        color: black;


    }

    .nstd1 {
        font-family: 'newake', sans-serif;
        font-size: 90px;
        text-align: center;
        animation: blink 5s infinite;
    }

    @keyframes blink {
        50% {
            opacity: 0.7;
        }

    }
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


<!-- <script>
  // Refresh the queue every 5 seconds
  setInterval(function () {
    $('#queue').load('queue_data_list_priority.php');
  }, 1000);
</script> -->

<?php
// Connect to the database
$db = new PDO("mysql:host=localhost;dbname=queuing", "root", "");

// Retrieve the  of customers who are still waiting in the queue
$query = $db->prepare("SELECT queue_number, party_size FROM priority_queue WHERE status = 'waiting' ORDER BY queue_time");
$query->execute();
$queue = $query->fetchAll();

// Group customers by party size
$queue_data_by_party_size = array();
foreach ($queue as $customer) {
    $party_size = $customer['party_size'];
    if (!isset($queue_data_by_party_size[$party_size])) {
        $queue_data_by_party_size[$party_size] = array();
    }
    $queue_data_by_party_size[$party_size][] = $customer;
}

// Retrieve the customers who are still waiting in the queue
$query = $db->prepare("SELECT  queue_number, party_size, status FROM priority_queue WHERE status = 'waiting' OR status = 'serving' ORDER BY queue_time");
$query->execute();
$queue = $query->fetchAll();

// Group customers by party size
$queue_data_by_party_size = array();
$now_serving = array();
foreach ($queue as $customer) {
    $party_size = $customer['party_size'];
    if ($customer['status'] == 'serving') {
        $now_serving[] = $customer;
    } else {
        if (!isset($queue_data_by_party_size[$party_size])) {
            $queue_data_by_party_size[$party_size] = array();
        }
        $queue_data_by_party_size[$party_size][] = $customer;
    }
}

// Sort the $now_serving array in ascending order based on the queue_number column
$queue_numbers = array_column($now_serving, 'queue_number');
array_multisort($queue_numbers, SORT_ASC, $now_serving);

// Reverse the $now_serving array
$now_serving = array_reverse($now_serving);


// Update the status of the served customer in the database
$query = $db->prepare("UPDATE priority_queue SET status = 'serving' WHERE queue_number = :queue_number");
$query->bindParam(':queue_number', $queue_number);
$query->execute();

// Remove the served customer from the waiting queue array
foreach ($queue as $key => $customer) {
    if ($customer['queue_number'] == $queue_number) {
        unset($queue[$key]);
        break;
    }
}
?>

<div class="table-wrapper1">
    <!-- Display the table for NOW SERVING queue -->
    <div class="nstable-container1" style="background-color: #ffba08">
        <h2 style="color: black; font-size: 40px; font-weight:800;">PRIORITY QUEUE</h2>
        <table class="nstable1">
            <tbody class="nstbody1">
                <?php foreach ($now_serving as $customer): ?>
                    <tr class="nstr1">
                        <td class="nstd1">
                            <?php echo $customer['queue_number']; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</div>

<!-- VIDEO GIF WHATEVER -->