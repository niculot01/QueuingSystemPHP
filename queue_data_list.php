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
<style>
    /* Define the style for the table wrapper */
    .table-wrapper {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        height: 650px;



    }

    /* Table header */
    .table-container {
        overflow-y: hidden;
        margin: 10px;
        padding: 5px;
        padding-top: 20px;
        font-size: 50px;
        text-align: center;
        border-radius: 20px;
 
        max-height: 660px;
        background-color: #ffffff;
        color: black;
        font-family: 'newake';
        font-weight: 900;

    }

    table.table-hover.table-dark {
        color: red;
    }

    .table-4 {
        width: 250px
        
    }

    .table-10 {
        width: 250px
    }

    .table-12 {
        width: 250px
    }

    /* queue no. for Now In Queue */
    td {
        display: block;
        margin: 10px;
        padding: 10px;
        padding-bottom: 0px;
        font-family: 'newake', sans-serif;
        font-size: 54px;
        font-weight: 500;
        text-align: center;
        background-color: #ffffff;
        border-radius: 20px;
        


    }

    /* Queue no. for waiting list */
    tbody {
       
        overflow-y: hidden;
        border-radius: 20px;
        


    }

    /* Define the style for the heading */
    h2 {
        position: relative;
        font-size: 50px;
        font-weight: bold;
        margin-bottom: 0px;
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


    .nstable-container {
        margin: 10px;
        padding: 5px;
        font-size: 50px;
        text-align: center;
        background-color: #ffffff;
        border-radius: 20px;
        height: 380px;
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


    .nstable {
        border-collapse: collapse;
        width: 100%;

    }


    .nstr {
        height: 30px;
        color: black;


    }

    .nstd {
        font-family: 'newake', sans-serif;
        font-size: 80px;
        text-align: center;
        animation: blink 5s infinite;
    }

    @keyframes blink {
        50% {
            opacity: 0.7;
        }

    }
</style>

<?php
// Connect to the database
$db = new PDO("mysql:host=localhost;dbname=queuing", "root", "");

// Retrieve the  of customers who are still waiting in the queue
$query = $db->prepare("SELECT queue_number, party_size FROM queue WHERE status = 'waiting' ORDER BY queue_time");
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
$query = $db->prepare("SELECT queue_number, party_size, status FROM queue WHERE status = 'waiting' OR status = 'serving' ORDER BY queue_time");
$query->execute();
$queue = $query->fetchAll();

// Group customers by party size
$queue_data_by_party_size = array(
  4 => array(),
  10 => array(),
  12 => array()
);
$now_serving = array();
foreach ($queue as $customer) {
  $party_size = $customer['party_size'];
  if ($customer['status'] == 'serving') {
    $now_serving[] = $customer;
  } else {
    if ($party_size >= 1 && $party_size <= 4) {
      $queue_data_by_party_size[4][] = $customer;
    } elseif ($party_size >= 5 && $party_size <= 10) {
      $queue_data_by_party_size[10][] = $customer;
    } elseif ($party_size >= 11 && $party_size <= 12) {
      $queue_data_by_party_size[12][] = $customer;
    }
  }
}

// Sort the $now_serving array in ascending order based on the queue_number column
$queue_numbers = array_column($now_serving, 'queue_number');
array_multisort($queue_numbers, SORT_ASC, $now_serving);

// Reverse the $now_serving array
$now_serving = array_reverse($now_serving);


// Update the status of the served customer in the database
$query = $db->prepare("UPDATE queue SET status = 'serving' WHERE queue_number = :queue_number");
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
<!-- Display the table for party size 4 -->

<div class="table-wrapper">
    <div class="table-container" style="background-color: #d00000">
        <h2 style="font-size: 50px">4 Pax</h2>
        <table class="table-4">
            <tbody>
                <?php if (!empty($queue_data_by_party_size[4])): ?>
                    <?php foreach ($queue_data_by_party_size[4] as $customer): ?>
                        <tr>
                            <td class="queue-number blinking">
                                <?php echo htmlspecialchars($customer['queue_number']); ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="2">- - - - - -</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>


    <!-- Display the table for party size 10 -->
    <div class="table-container" style="background-color: #d00000">
        <h2 style="font-size: 50px;">10 Pax</h2>
        <table class="table-10">
            <!-- <thead >
                <tr >
                    <th>-</th>
                </tr>
            </thead> -->
            <tbody>
                <?php if (!empty($queue_data_by_party_size[10])): ?>
                    <?php foreach ($queue_data_by_party_size[10] as $customer): ?>
                        <tr>
                            <td class="queue-number blinking">
                                <?php echo htmlspecialchars($customer['queue_number']); ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="2">- - - - - -</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Display the table for party size 12 -->
    <div class="table-container" style="background-color: #d00000">
        <h2 style="font-size: 50px">12 Pax</h2>
        <table class="table-12">
            <tbody>
                <?php if (!empty($queue_data_by_party_size[12])): ?>
                    <?php foreach ($queue_data_by_party_size[12] as $customer): ?>
                        <tr>
                            <td class="queue-number blinking">
                                <?php echo htmlspecialchars($customer['queue_number']); ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="2">- - - - - -</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Display the table for NOW SERVING queue -->
    <!-- Display the table for NOW SERVING queue -->
    <div class="nstable-container" style="background-color: #ffba08">
        <h2 style="color: black; font-size: 50px;">NOW IN QUEUE</h2>
        <table class="nstable">
            <tbody class="nstbody">
                <?php foreach ($now_serving as $customer): ?>
                    <tr class="nstr">
                        <td class="nstd">
                            <?php echo $customer['queue_number']; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</div>

<!-- VIDEO GIF WHATEVER -->