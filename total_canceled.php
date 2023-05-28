<?php
require_once('config.php');
$conn = mysqli_connect("localhost", "root", "", "queuing");
$result = mysqli_query($conn, "SELECT SUM(party_size) AS total_party_size_canceled FROM queue WHERE status = 'canceled'");
$row = mysqli_fetch_assoc($result);
$total_canceled_customers = $row['total_party_size_canceled'];
?>

<div class="total" style="display:inline-block; white-space: nowrap;">
  Total Canceled Customers: <?php echo $total_canceled_customers; ?>
</div>