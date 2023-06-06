<!DOCTYPE html>
<html>

<head>
  <title>GT|Qsystem</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
    crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link href="https://fonts.cdnfonts.com/css/revue" rel="stylesheet">
  <style>
    @import url('https://fonts.cdnfonts.com/css/revue');

    body {
      position: fixed;
    }

    .wrapper {
      padding-top: 0px;
    }

    .jumbotron {
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
      background-image: url("GTLogo.gif");
      background-repeat: no-repeat;
      background-position: left;
      /* position image on left */
      background-size: auto 100%;


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
      font-size: 80px;
      padding-top: 5px;
      padding-bottom: 90px;
    }

    .h2-container1 {
      height: 10px;
    }

    .date-time {
      position: absolute;
      top: 5px;
      right: 10px;
      font-size: 45px;
      color: black;
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
</head>

<body class="body">
  <div class="jumbotron">
    <div>
      <h3
        style="font-family: 'newake', sans-serif; text-align:center; color: #d00000; font-size: 60px; padding-top: 40px; margin-bottom: 0px;">
        WELCOME TO</h3>
      <div class="date-time"></div>
      <h1 class="wrapper" style="font-size: 70px;">GOODTASTE RESTAURANT - OTEK</h1>
    </div>
  </div>
  <div class="h2-container">
    <div class="table-container">
      <table class="table table-hover table-dark">
        <tbody class="hatdog" id="queue" style="height: 300px; overflow-y: auto;">
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
      <table class="table table-hover table-dark">
        <tbody class="hatdog1" id="priority_queue" style="height: 300px; overflow-y: auto;">
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

    // Refresh the queue every second for realtime data encoding
    setInterval(function () {
      $('#queue').load('queue_data_list.php');
      $('#priority_queue').load('queue_data_list_priority.php');
    }, 1000);


  </script>


  <footer>
    <marquee direction="left" height="10" width="auto">
      We are open from 6AM to 10PM daily.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      For modes of payment, we accept Cash, E-wallets (GCash, PayMaya), Debit and Credit
      Cards.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      PETS ARE NOT ALLOWED due to food safety and sanitation.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      To be fair with everyone, we do not accept table reservations.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      THANK YOU!&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      PLEASE WAIT FOR YOUR NUMBER TO BE CALLED
      WHILE WE ARE FINDING FOR A TABLE AVAILABLE FOR YOUR GROUPSIZE
      (It might take a few minutes. Thank you for your patience.)
    </marquee>
  </footer>
</body>

</html>