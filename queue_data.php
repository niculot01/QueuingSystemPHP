<style>
  .flex-container {
    max-width: auto;
    max-height: 300px;
  }

  .flex-item {
    max-width: 33%;
    /* max-height: 70%; */
    height: 440px;
    overflow: auto;
    overflow-x: hidden;
    align-items: center;
    text-align: left;
    padding: 10px;
    padding-top: 0px;
  }

  .flex-item h2 {
    position: sticky;
    top: 0;
    background-color: antiquewhite;
    padding: 10px;
    font-weight: 700;
  }

  .flex-item::-webkit-scrollbar {
    width: 4px;
    background-color: #f5f5f5;
  }

  .flex-item::-webkit-scrollbar-thumb {
    background-color: #c1c1c1;
  }




  .table-container {
    display: flex;
    flex-direction: row;
    margin-bottom: 200px;
  }

  table {
    border-collapse: collapse;
    width: 100%;
  }

  th,
  td {
    padding: 8px;
    text-align: left;
    border-bottom: 1px solid #ddd;
  }

  th {
    background-color: #f2f2f2;
    flex: 0 0 auto;
  }

  td {
    flex: 1 1 auto;
  }

  tr:first-child th,
  tr:first-child td {
    border-top: 1px solid #ddd;
  }

  tr:nth-child(even) {
    background-color: #f2f2f2;
  }




  .table-wrapper {
    display: relative;
    flex-wrap: wrap;
    width: 100%;
  }

  .table-wrapper table {
    flex-basis: calc(50% - 5px);
    margin-right: 10px;
  }

  table {
    width: 100%;
    border-collapse: collapse;
  }

  th,
  td {
    padding: 8px;
    text-align: left;
    border-bottom: 1px solid #ddd;
  }

  tr:nth-child(even) {
    background-color: #f2f2f2;
  }

  button {
    padding: 3px;
    margin-bottom: 3px;
    font-size: 20px;
    border-radius: 8px;
    border: none;
    background-color: rosybrown;
    color: white;
  }

  @media (max-width: 900px) {
    table {
      font-size: 12px;
    }

    button {
      font-size: 12px;
    }
  }

  table {
    width: 100%;
    border-collapse: collapse;
  }

  th,
  td {
    padding: 8px;
    text-align: center;
    border-bottom: 1px solid #ddd;
  }

  th:last-child,
  td:last-child {
    width: 200px;
    /* adjust as needed */
  }

  button {
    margin-right: 5px;
    padding: 5px
  }

  .button-container {
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: center;
  }

  .button-container button {
    margin: 0 5px;
    padding: 10px;
    font-size: 15px;
    font-weight: 700;
    border-radius: 4px;
    border: none;
    background-color: #4CAF50;
    color: white;
  }

  @media (max-width: 600px) {
    .button-container button {
      font-size: 12px;
    }
  }



  .blinking {
    animation: blink 1s infinite;
  }

  @keyframes blink {
    0% {
      color: black;
    }

    50% {
      color: red;
    }

    100% {
      color: black;
    }
  }


  * Style the confirmation dialog box */ .confirmation-dialog {
    background-color: #fff;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.3);
    padding: 20px;
    font-size: 16px;
  }

  /* Style the confirmation dialog box title */
  .confirmation-dialog h2 {
    font-size: 18px;
    font-weight: bold;
    margin-top: 0;
  }

  /* Style the confirmation dialog box buttons */
  .confirmation-dialog button {
    background-color: #f44336;
    color: white;
    border: none;
    padding: 10px 20px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
    border-radius: 4px;
  }

  .confirmation-dialog button.cancel {
    background-color: #ccc;
    margin-right: 10px;
  }

  /* Hide the confirmation dialog box by default */
  .confirmation-dialog.hidden {
    display: none;
  }



  /* Style for the serve modal */
  .modal {
    align-items: center;
    justify-content: center;
  }

  .modal-content {
    font-size: 6.5rem;
  }

  .modal-header h5 {
    font-size: 6rem;
  }

  .modal-body label {
    font-size: 6.3rem;
  }

  .modal-body select {
    font-size: 6.3rem;
  }

  .modal-body button {
    font-size: 6.3rem;
  }
</style>

<script>
  // Refresh the queue every 5 seconds
  setInterval(function () {
    $('#queue').load('queue_data.php');
  }, 1000);
</script>



<?php
require_once('config.php');
$db = new PDO("mysql:host=localhost;dbname=queuing", "root", "");

// Retrieve the queue data
$query = $db->prepare("SELECT * FROM queue ORDER BY status DESC, queue_time ASC");
$query->execute();
$queue = $query->fetchAll();


// Initialize an empty array to store the queue data
$queue_data = array();

// Convert the queue data into an array
foreach ($queue as $customer) {
  $queue_data[] = array(
    'id' => $customer['id'],
    'queue_number' => $customer['queue_number'],
    'floor' => $customer['floor'],
    'party_size' => $customer['party_size'],
    'queue_time' => $customer['queue_time'],
    'status' => $customer['status']
  );
}


// Check if a customer ID was provided to remove from the queue
if (isset($_POST['id'])) {
  $id_to_remove = $_POST['id'];

  // Remove the customer from the queue table
  $query = $db->prepare("DELETE FROM queue WHERE id = :id");
  $query->bindParam(':id', $id_to_remove, PDO::PARAM_INT);
  $query->execute();
}

$db = new PDO("mysql:host=localhost;dbname=queuing", "root", "");

// Retrieve the queue data for customers who are serving
$query = $db->prepare("SELECT * FROM queue WHERE status = 'serving' ORDER BY queue_time");
$query->execute();
$serving_customers = $query->fetchAll();

// Retrieve the queue data for customers who are waiting
$query = $db->prepare("SELECT * FROM queue WHERE status = 'waiting' ORDER BY queue_time");
$query->execute();
$waiting_customers = $query->fetchAll();

// Retrieve the queue data for customers who are seated
$query = $db->prepare("SELECT * FROM queue WHERE status = 'seated' ORDER BY queue_time");
$query->execute();
$seated_customers = $query->fetchAll();

// Retrieve the queue data for customers who are seated
$query = $db->prepare("SELECT * FROM queue WHERE status = 'canceled' ORDER BY queue_time");
$query->execute();
$canceled_customers = $query->fetchAll();

// Merge the results into a single array
$queue_data = array_merge($serving_customers, $waiting_customers, $seated_customers, $canceled_customers);



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
?>




<html>

<head>
  <title>My Queue System</title>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script>
    // Add event listener to floor select element for each customer
    $(document).ready(function () {
      $('.table-wrapper select[name="floor"]').change(function () {
        var floor = $(this).val();
        var speakButtons = $(this).closest('tr').find('.button-container button');
        speakButtons.hide();
        speakButtons.filter('.speak-floor-' + floor).show();
      });
    });
    
  </script>
</head>

<body>
  <div class="flex-container">
    <?php foreach ($queue_data_by_party_size as $party_size => $customers): ?>
      <div class="flex-item">
        <h2>Pax
          <?php echo $party_size; ?> (
          <?php echo count($customers); ?>)
        </h2>
        <div class="table-wrapper">
          <table>
            <tr>
              <th>Queue No.</th>
              <th>Time</th>
              <th>Floor</th>
              <th>Status</th>
              <th class="action">Action</th>
            </tr>
            <?php foreach ($customers as $customer): ?>
              <tr>
                <td class="queue-number" style="font-size:20px; font-weight: 700;">
                  <?php echo htmlspecialchars($customer['queue_number']); ?>
                </td>
                <td style="white-space: nowrap;">
                  <?php echo date('g:i A', strtotime($customer['queue_time'])); ?>
                </td>
                <td class="floor">
                  <?php echo htmlspecialchars($customer['floor']); ?>
                </td>
                <td class="status">
                  <?php echo htmlspecialchars($customer['status']); ?>
                </td>
                <td>
                  <?php if ($customer['status'] == 'waiting'): ?>
                    <form method="POST" action="serve_customer.php">
                      <input type="hidden" name="queue_number"
                        value="<?php echo htmlspecialchars($customer['queue_number']); ?>">
                      <button type="button" class="serve-button" data-toggle="modal"
                        data-target="#serve-modal-<?php echo htmlspecialchars($customer['queue_number']); ?>">Serve</button>
                    </form>

                    <?php foreach ($customers as $c): ?>
                      <div class="modal fade" id="serve-modal-<?php echo htmlspecialchars($c['queue_number']); ?>" tabindex="-1"
                        role="dialog" aria-labelledby="serve-modal-label-<?php echo htmlspecialchars($c['queue_number']); ?>"
                        aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title"
                                id="serve-modal-label-<?php echo htmlspecialchars($c['queue_number']); ?>">Serve Customer <?php echo htmlspecialchars($c['queue_number']); ?></h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <form method="POST" action="serve_customer.php">
                                <input type="hidden" name="queue_number"
                                  value="<?php echo htmlspecialchars($c['queue_number']); ?>">
                                <input type="hidden" name="floor"
                                  id="floor-input-<?php echo htmlspecialchars($c['queue_number']); ?>" value="">
                                <label for="floor-select-<?php echo htmlspecialchars($c['queue_number']); ?>">Select a
                                  floor:</label>
                                <select id="floor-select-<?php echo htmlspecialchars($c['queue_number']); ?>" name="floor">
                                  <option value="1ˢᵗFloor">1st Floor</option>
                                  <option value="2ⁿᵈFloor">2nd Floor</option>
                                  <option value="3ʳᵈFloor">3rd Floor</option>
                                  <option value="6ᵗʰFloor">6th Floor</option>
                                </select>
                                <button type="submit" class="serve-submit-button">Serve</button>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>
                    <?php endforeach; ?>
                    <form method="POST" action="cancel_customer.php"
                      onsubmit="return confirm('Are you sure you want to cancel this queue number?')">
                      <input type="hidden" name="queue_number"
                        value="<?php echo htmlspecialchars($customer['queue_number']); ?>">
                      <button class="cancel-button" type="submit">Cancel</button>
                    </form>

                  <?php elseif ($customer['status'] == 'serving'): ?>
                    <form method="POST" action="seat_customer1.php">
                      <input type="hidden" name="id" value="<?php echo htmlspecialchars($customer['id']); ?>">
                      <button type="submit">Seat</button>
                    </form>
                    <div class="button-container">
                      <form method="POST">
                        <input type="hidden" name="id" value="<?php echo htmlspecialchars($customer['id']); ?>">
                        <button type="button" class="speak-floor-1"
                          onclick="speak('<?php echo htmlspecialchars($customer['queue_number']); ?>', 'Main entrance'); toggleQueueNumberBlinking(this)">1</button>
                      </form>
                      <form method="POST">
                        <input type="hidden" name="id" value="<?php echo htmlspecialchars($customer['id']); ?>">
                        <button type="button" class="speak-floor-2"
                          onclick="speak('<?php echo htmlspecialchars($customer['queue_number']); ?>', '2nd'); toggleQueueNumberBlinking(this)">2</button>
                      </form>
                      <form method="POST">
                        <input type="hidden" name="id" value="<?php echo htmlspecialchars($customer['id']); ?>">
                        <button type="button" class="speak-floor-3"
                          onclick="speak('<?php echo htmlspecialchars($customer['queue_number']); ?>', 'third'); toggleQueueNumberBlinking(this)">3</button>
                      </form>
                    </div>
                  <?php else: ?>
                    <?php // Do nothing ?>
                  <?php endif; ?>
                </td>
              </tr>
            <?php endforeach; ?>
          </table>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</body>

</html>