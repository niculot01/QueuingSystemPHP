<?php
require_once('config.php');
// execute the SQL query to get the sum of party_size
$conn = mysqli_connect("localhost", "root", "", "queuing");
$result = mysqli_query($conn, "SELECT SUM(party_size) AS total_party_size FROM queue WHERE status = 'seated'");
$row = mysqli_fetch_assoc($result);
$total_party_size = $row['total_party_size'];
?>


<div class="total" style="display:inline-block; white-space: nowrap;">
  Total Seated Customers: <?php echo $total_party_size; ?>
</div>