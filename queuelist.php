<!DOCTYPE html>
<html>

<head>
  <title>GT|Qsystem</title>
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

  <link href="https://fonts.cdnfonts.com/css/revue" rel="stylesheet">


  <!-- <script>
    // Refresh the queue every second for realtime data encoding, basta
    setInterval(function () {
      $('#queue').load('queue_data_list.php', 'queue_data_list_priority.php');
    }, 1000);
  </script> -->

  <script>
    // Refresh the queue every second for realtime data encoding
    setInterval(function () {
      $('#queue').load('queue_data_list.php');
      $('#priority_queue').load('queue_data_list_priority.php');
    }, 1000);
  </script>




  <!-- <link rel="stylesheet" href="style.css"> -->
  <style>
    @import url('https://fonts.cdnfonts.com/css/revue');


    body {
      position: fixed;

    }

    .wrapper {
      padding top: 0px;
    }


    .jumbotron {

      flex: 1;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      background-color: white;
      max-height: 110px;
      padding-top: 0px;
      padding-bottom: 1px;
      font-family: 'Revue', sans-serif;
      font-weight: 900;
      color: #fe0000;
      background-image: url("logo.png");
      background-repeat: no-repeat;
      background-position: left;
      /* position image on left */
      background-size: auto 100%;

    }

    .jumbotron img {
      padding-left: 100px;
      margin-right: 10px;
      height: 150px;
    }



    /* NOW IN QUEUE */
    .hatdog {}

    /* Queue No. */
    table.table-hover.table-dark {
      color: red;
    }



    footer {
      background-color: #f2f2f2;
      text-align: center;
      
      
    }

    marquee {
      position: relative;
      display: inline-block;
      white-space: nowrap;
      font-family: 'newake', sans-serif;
      font-size: 50px;
      padding-top: 5px;
      padding-bottom: 90px;
    }


    .h2-container1 {
      height: 0px;
    }

    .date-time {
      position: absolute;
      top: 5px;
      right: 10px;
    }

    @media (max-width: 768px) {
      .h2-container {
        flex-direction: row;
        align-items: center;
      }

      .h2-container1 {
        flex-direction: row;
        align-items: center;
      }

    }
  </style>


<body class="body">
  <div class="jumbotron">
    <div>
      <h3
        style="font-family: 'newake', sans-serif; text-align:center; color: #d00000; font-size: 60px; padding-top: 40px; margin-bottom: 0px; ">
        WELCOME TO</h3>
      <div class="date-time" style="font-size: 30px; text-align: center; color: black;"></div>
      <h1 class="wrapper" style="font-size: 60px;">GOODTASTE RESTAURANT - OTEK</h1>
    </div>
  </div>
  <div class="h2-container">
    <div class="table-container">
      <table class="table table-hover table-dark">
        <tbody class="hatdog" id="queue" style="height: 300px; overflow-y: hidden;">
          <?php
          if (empty($data)) {
            echo '<tr><td colspan="100">No data to display</td></tr>';
          } else {
            include 'queue_data.php';
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>

  <div class="h2-container1">
    <div class="table-container1">
      <table class="table table-hover table-dark1">
        <tbody class="hatdog1" id="priority_queue" style="height: 300px; overflow-y: hidden;">
          <?php
          if (empty($data)) {
            echo '<tr><td colspan="100">No data to display</td></tr>';
          } else {
            include 'queue_data_list_priority.php';
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>

  <!-- function to update date and time every second -->
  <script>
    function updateTime() {
      const now = new Date();
      const date = now.toLocaleDateString('en-US');
      const time = now.toLocaleTimeString('en-US');
      const dateTimeString = ` ${time} ${date}`;
      document.querySelector('.date-time').textContent = dateTimeString;
    }
    setInterval(updateTime, 1000);
  </script>

</body>
<footer>
  <marquee direction="left" height="10" width="auto">
    We are open from 6AM to 10PM daily.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    For modes of payment; we accept Cash, E-wallet: GCash, PayMaya, Debit and Credit
    Cards.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    PETS ARE NOT ALLOWED due to food safety and sanitation.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    To be fair with everyone, we do not accept table reservations.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    THANK YOU!
  </marquee>
</footer>

</html>