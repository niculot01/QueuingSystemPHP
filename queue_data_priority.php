
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
  // Refresh the queue every 5 seconds
  setInterval(function () {
    $.ajax({
      url: 'queue_data_list_priority.php',
      type: 'GET',
      success: function(data) {
        $('#queue').html(data);
      },
      error: function(jqXHR, textStatus, errorThrown) {
        console.log('Error:', errorThrown);
      }
    });
  }, 1000);
</script>



<?php
require_once('config.php');


$db = new PDO("mysql:host=localhost;dbname=queuing", "root", "");

// Retrieve the queue data
$query = $db->prepare("SELECT * FROM priority_queue ORDER BY status DESC, queue_time ASC");
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
  $query = $db->prepare("DELETE FROM priority_queue WHERE id = :id");
  $query->bindParam(':id', $id_to_remove, PDO::PARAM_INT);
  $query->execute();
}

$db = new PDO("mysql:host=localhost;dbname=queuing", "root", "");

// Retrieve the queue data for customers who are serving
$query = $db->prepare("SELECT * FROM priority_queue WHERE status = 'serving' ORDER BY queue_time");
$query->execute();
$serving_customers = $query->fetchAll();

// Retrieve the queue data for customers who are waiting
$query = $db->prepare("SELECT * FROM priority_queue WHERE status = 'waiting' ORDER BY queue_time");
$query->execute();
$waiting_customers = $query->fetchAll();

// Retrieve the queue data for customers who are seated
$query = $db->prepare("SELECT * FROM priority_queue WHERE status = 'seated' ORDER BY queue_time");
$query->execute();
$seated_customers = $query->fetchAll();

// Merge the results into a single array
$queue_data = array_merge($serving_customers, $waiting_customers, $seated_customers);



foreach ($queue_data as $customer) {
  // Output customer information
}



// Initialize an empty array for each party size
$queue_data_by_party_size = array();
$party_sizes = array(4, 10, 12);
foreach ($party_sizes as $size) {
  $queue_data_by_party_size[$size] = array();
}



// Convert the queue data into arrays based on party size
foreach ($queue_data as $customer) {
  $party_size = $customer['party_size'];
  if (in_array($party_size, $party_sizes)) {
    $queue_data_by_party_size[$party_size][] = array(
      'id' => $customer['id'],
      'queue_number' => $customer['queue_number'],
      'party_size' => $customer['party_size'],
      'queue_time' => $customer['queue_time'],
      'status' => $customer['status']
    );
  }
}



// Output -> HTML format
echo '<div class="flex-container">';
foreach ($queue_data_by_party_size as $party_size => $customers) {
  echo '<div class="flex-item" style="height:250px;">';
  echo '<h2>Priority Pax: ' . $party_size . '</h2>';
  echo '<div class="table-wrapper"><table>';
  echo '<tr>';
  echo '<th>Queue No.</th>';
  echo '<th>Time</th>';
  echo '<th>Status</th>';
  echo '<th class="action">Action</th>';
  echo '</tr>';
  foreach ($customers as $customer) {
    echo '<tr>';
    echo '<td class="queue-number"style="font-size:20px; font-weight: 700;">' . htmlspecialchars($customer['queue_number']) . '</td>';
    echo '<td>' . htmlspecialchars($customer['queue_time']) . '</td>';
    echo '<td>' . htmlspecialchars($customer['status']) . '</td>';
    echo '<td>';
    if ($customer['status'] == 'waiting') {


      echo '<form method="POST" action="serve_customer_priority.php">';
      echo '<input type="hidden" name="queue_number" value="' . htmlspecialchars($customer['queue_number']) . '">';
      echo '<button type="submit">Serve</button></form>';



      echo '<form method="post" action="delete_customer_priority.php">';
      echo '<input type="hidden" name="id" value="' . htmlspecialchars($customer['id']) . '">';
      echo '<button class="cancel-button" type="submit">Cancel</button>';
      echo '</form>';

    }
    if ($customer['status'] == 'serving') {
      echo '<form method="post" action="seated_customer_priority.php">';
      echo '<input type="hidden" name="id" value="' . htmlspecialchars($customer['id']) . '">';
      echo '<button type="submit">Seat</button></form>';


      echo '<div class="button-container">';
      echo '<form method="post"><input type="hidden" name="id" value="' . htmlspecialchars($customer['id']) . '">';
      echo '<button type="button" onclick="speak(\'' . htmlspecialchars($customer['queue_number']) . '\', \'Main entrance\'); toggleQueueNumberBlinking(this)">1st</button></form>';

      echo '<form method="post"><input type="hidden" name="id" value="' . htmlspecialchars($customer['id']) . '">';
      echo '<button type="button" onclick="speak(\'' . htmlspecialchars($customer['queue_number']) . '\', \'2nd\'); toggleQueueNumberBlinking(this)">2nd</button></form>';

      echo '<form method="post"><input type="hidden" name="id" value="' . htmlspecialchars($customer['id']) . '">';
      echo '<button type="button" onclick="speak(\'' . htmlspecialchars($customer['queue_number']) . '\', \'3rd\'); toggleQueueNumberBlinking(this)">3rd</button></form>';

      echo '<form method="post"><input type="hidden" name="id" value="' . htmlspecialchars($customer['id']) . '">';
      echo '<button type="button" onclick="speak(\'' . htmlspecialchars($customer['queue_number']) . '\', \'6th\'); toggleQueueNumberBlinking(this)">6th</button></form>';
      echo '</div>';

      echo '<form method="post" action="delete_customer_priority.php">';
      echo '<input type="hidden" name="id" value="' . htmlspecialchars($customer['id']) . '">';
      echo '<button class="cancel-button" type="submit">Cancel</button>';
      echo '</form>';

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