<!DOCTYPE html>
<html>

<head>
  <style>
    .body {
      position: fixed;
      max-height: fit-content;
    }

    .h1-text {
      text-align: center;
      margin-top: 0px;
    }

    .labelnames,
    .labelsearch,
    .labelfilter {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      align-items: center;
    }

    .labelfilter {
      margin-left: auto;

    }

    .labelsearch {
      margin-top: 55px;
    }

    .form-container {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      align-items: center;

    }

    .form-container>* {
      flex: 1 1 50%;
    }

    .form-wrapper {
      flex: 1 1 50%;
      margin: 10px;
    }



    .position-fixed {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      z-index: 1000;
      background-color: whitesmoke;
      box-shadow: 0 4px 2px -2px rgba(0, 0, 0, 0.2);
      padding-top: 5px;
      padding-bottom: 3px;
    }


    .labelnames label,
    .labelsearch label,
    .labelfilter label {
      margin-right: 10px;
      font-weight: bold;
      font-size: 25px;

    }

    .labelnames input[type="text"],
    .labelnames input[type="tel"],
    .labelnames select,
    .labelsearch input[type="text"],
    .labelfilter select {
      padding: 10px;
      margin-right: 10px;
      font-size: 18px;
      border-radius: 4px;
      border: none;
      background-color: #f2f2f2;
    }

    .labelnames input[type="text"]:focus,
    .labelnames input[type="tel"]:focus,
    .labelnames select:focus,
    .labelsearch input[type="text"]:focus,
    .labelfilter select:focus {
      outline: none;
      box-shadow: 0 0 4px 2px #4CAF50;
    }

    .labelnames button,
    .labelsearch button,
    .labelfilter button {
      padding: 5px;
      font-size: 25px;
      border-radius: 5px;
      border: none;
      background-color: #4CAF50;
      color: white;
    }

    .labelnames button:hover,
    .labelsearch button:hover,
    .labelfilter button:hover {
      cursor: pointer;
      background-color: #3e8e41;
    }

    @media (max-width: 768px) {

      .labelnames input[type="text"],
      .labelnames input[type="tel"],
      .labelnames select,
      .labelsearch input[type="text"],
      .labelfilter select {
        font-size: 14px;
      }

      .labelnames button,
      .labelsearch button,
      .labelfilter button {
        font-size: 12px;
      }
    }

    .flex-container {
      display: inline-flex;
      display: flex;
      flex-wrap: wrap;
    }

    .flex-wrapper {
      justify-content: center;
      display: center;
      text-align: center;
      padding: 10px;
      padding-top: 0px;
      height: 425px;
    }

    .flex-wrapper2 {
      justify-content: center;
      display: center;
      text-align: center;
      padding: 10px;
      padding-top: 0px;
      height: 100px;
    }


    .table-container {
      flex-basis: 90%;
    }

    .table-container2 {
      flex-basis: 10%;
      max-height: 20px;
    }

    .clear-counter-button {
      position: absolute;
      top: 10px;
      right: 85%;
      display: flex;
      align-items: center;
    }

    .clear-counter-button button {
      background-color: lightsalmon;
      color: white;
      border: none;
      padding: 5px;
      margin-right: 5px;
      transition: transform 0.2s ease;
    }

    .clear-counter-button button:hover {
      transform: rotate(-10deg);
    }

    .refresh {
      background-color: green;
      color: white;
      border: none;
      padding: 100px;
      transition: transform 0.3s ease;
    }

    .refresh:hover {
      transform: rotate(-10deg);
    }

    .total {
      position: absolute;
      top: 55px;
      right: 83.5%;
      font-size: 16px;
    }

    .cancel {
      position: absolute;
      top: 75px;
      right: 82.1%;
      font-size: 16px;
    }
  </style>

  <title>GT|Qsystem</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
    crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <!-- jQuery library -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
  <!-- Latest compiled JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <!-- buttons -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <script>
    setInterval(function () {
      $('#queue').load('queue_data.php');
    }, 1000);


    setInterval(function () {
      location.reload();
    }, 5000);
  </script>



  <script>
    function speak(name, floor) {
      const msg = new SpeechSynthesisUtterance();
      msg.text = `Customer ${name}, please proceed to ${floor} floor! Customer ${name}, please proceed to ${floor} floor!!`;
      window.speechSynthesis.speak(msg);
    }
  </script>

  <script>
    var tooltipTimeout;

    function showTooltip(event) {
      tooltipTimeout = setTimeout(function () {
        var tooltip = event.target.getAttribute('title');
        var tooltipElement = document.createElement('div');
        tooltipElement.classList.add('tooltip');
        tooltipElement.textContent = tooltip;
        document.body.appendChild(tooltipElement);
        var left = event.clientX - tooltipElement.offsetWidth / 2;
        var top = event.clientY - tooltipElement.offsetHeight - 10;
        tooltipElement.style.left = left + 'px';
        tooltipElement.style.top = top + 'px';
      }, 500);
    }

    function hideTooltip(event) {
      clearTimeout(tooltipTimeout);
      var tooltip = document.querySelector('.tooltip');
      if (tooltip) {
        tooltip.parentNode.removeChild(tooltip);
      }
    }

    var buttons = document.querySelectorAll('button[title]');
    buttons.forEach(function (button) {
      button.addEventListener('mouseover', showTooltip);
      button.addEventListener('mouseout', hideTooltip);
    });
  </script>
  <script>
    function reloadQueue() {
      var xhr = new XMLHttpRequest();
      xhr.open("GET", "http://192.168.0.250/Q/queuelist.php", true);
      xhr.send();
      xhr.onload = function () {
        if (xhr.status === 200) {
          location.reload();
        }
      };
    }
  </script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">




</head>

<body class="body">
  <div class="wrapper">
    <div class="form-container">
      <div class="h1-text">
        <h1>GoodTaste Restaurant Customer Queue</h1>
        <div class="clear-counter-button">
          <button class="refresh" style="margin-right: 18px;" onclick="location.reload()" title="Refresh Page"><i
              class="fa fa-refresh fa-2x" aria-hidden="true"></i></button>

          <form method="post" action="delete_all.php"
            onsubmit="return confirm('Are you sure you want to reset queue numbers and delete all records?')">
            <button type="submit" name="reset_delete" title="Reset Queue Numbers and Delete All Records"><i class="fa fa-minus-circle fa-2x" aria-hidden="true"></i><i
                class="fa fa-trash fa-2x" aria-hidden="true"></i></button>
          </form>



          <!-- <button class="fa fa-refresh fa-2x" style="position:absolute; top:60px"
            onclick="reloadQueue()">Queuelist</button> -->
        </div>
        <div class="total">
          <?php include 'total_customer.php' ?>
        </div>
        <div class="cancel">
          <?php include 'total_canceled.php' ?>
        </div>
      </div>

      <div class="form-wrapper">
        <form class="labelnames" method="post" action="add_customer_priority.php">
          <label for="priority_party_size">Priority Party Size:</label>
          <select id="priority_party_size" name="priority_party_size" required>
            <option value="4">1</option>
            <option value="4">2</option>
            <option value="4">3</option>
            <option value="4">4</option>
            <option value="10">5</option>
            <option value="10">6</option>
            <option value="10">7</option>
            <option value="10">8</option>
            <option value="10">9</option>
            <option value="10">10</option>
            <option value="12">11</option>
            <option value="12">12</option>
          </select>
          <button type="submit">Add to Priority Queue</button>
        </form>
      </div>
    </div>


    <div class="flex-wrapper">
      <div class="table-wrapper">
        <div class="table-container">
          <?php include 'queue_data.php'; ?>
        </div>
      </div>
    </div>

  </div>
  <div class="flex-wrapper2">
    <div class="table-wrapper2" style="height:200px;">
      <div class="table-container2">
        <?php include 'queue_data_priority.php'; ?>
      </div>
    </div>
  </div>
  </div>
</body>