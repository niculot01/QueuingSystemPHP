<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link rel="stylesheet" type="text/css" href="self_add.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>GT|QSystem</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="event_listener.js"></script>

    <!-- SweetAlert CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.4/dist/sweetalert2.min.css">

    <!-- SweetAlert JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.4/dist/sweetalert2.all.min.js"></script>

    <script>
        // Disable zooming on touch devices
        function disableZoom() {
            var viewportMetaTag = document.querySelector('meta[name="viewport"]');
            viewportMetaTag.content = 'width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no';
        }

        // Add an event listener to disable zooming when the page loads
        window.addEventListener('load', disableZoom);

        // Check if a queue number is present in the URL and show a modal
        const urlParams = new URLSearchParams(window.location.search);
        const queueNumber = urlParams.get('queue_number');
        if (queueNumber) {
            document.addEventListener("DOMContentLoaded", function () {
                Swal.fire({
                    icon: "success",
                    title: "Success",
                    html: "<p>Please wait for your number to be called while we are finding a table available for your group size. It might take a few minutes. Thank you for your patience!</p><p>Queue Number: " + queueNumber + "</p>",
                    confirmButtonColor: "#3085d6",
                    timer: 10000,
                    timerProgressBar: true,
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    allowEnterKey: false,
                    showConfirmButton: false,
                    customClass: {
                        popup: 'my-modal-class',
                        content: 'my-modal-content-class',
                        progressBar: 'my-modal-progress-bar-class'
                    }
                });
                setTimeout(function () {
                    window.location.href = "self_add.php";
                }, 10000); //10 seconds modal window timer
            });
        }
    </script>

    <style>
        .my-modal-class {
            font-size: 32px;
            max-width: 900px;
        }

        .my-modal-content-class {
            padding: 20px;
        }

        .my-modal-progress-bar-class {
            height: 10px;
            border-radius: 5px;
            background-color: #3085d6;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <div class="form-container">
            <div class="h1-text">
                <img src="logo1.png" alt="Logo" style="width:300px; height: 270px;"
                    onclick="this.classList.add('clicked')">
            </div>
            <div class="form-wrapper">
                <form class="labelnames" method="post" action="add_customer.php">
                    <label for="party_size">Pax : </label>
                    <div class="number-input">
                        <button type="button" onclick="decrementPartySize()">-</button>
                        <input class="numburger" type="text" id="party_size" name="party_size" value="0"
                            aria-placeholder="--" required readonly>
                        <button type="button" onclick="incrementPartySize()">+</button>
                    </div>
                    <div class="arrow-container">
                        <h2 class="animated-text">Group size?<br><br>Ilan kayo sa inyong grupo?</h2>
                        <div class="arrow"></div>
                    </div>
                    <button type="submit" id="submit-btn" disabled>Print Queue Number</button>
                </form>
                <script src="self_add.js"></script>
            </div>
        </div>
        <div class="text">
            <h2 style="text-align:center;">Kindly obtain your queue number and make your way to the designated waiting
                area.</h2>
            <h3 style="text-align:center;">Maaari po bang kunin ninyo ang inyong numero sa pila at maghintay sa
                itinakdang lugar para sa mga naghihintay.</h3>
        </div>
        <?php
        // Check if an error parameter is present in the URL
        if (isset($_GET['error'])) {
            $error = $_GET['error'];

            // Display appropriate error message based on the error parameter
            switch ($error) {
                case 'invalid_input':
                    $errorMessage = 'Apologies, invalid party size. Please enter a number between 1 and 50.';
                    break;
                case 'counter_error':
                    $errorMessage = 'Apologies, error updating the queue counter. Please try again.';
                    break;
                case 'database_error':
                    $errorMessage = 'Apologies, error inserting customer record into the database. Please try again.';
                    break;
                case 'printer_error':
                    $errorMessage = 'Apologies, error connecting to the printer or printing the receipt. Please try again.';
                    break;
                default:
                    $errorMessage = 'An unknown error occurred. Please try again.';
                    break;
            }

            // Display the error message using SweetAlert
            echo '<script>
    document.addEventListener("DOMContentLoaded", function() {
        Swal.fire({
            icon: "error",
            title: "Error",
            text: "' . $errorMessage . '",
            confirmButtonColor: "#3085d6",
            confirmButtonText: "OK",
            customClass: {
                container: "my-modal-class",
                content: "my-modal-content-class",
                actions: "my-modal-actions-class"
            },
            allowOutsideClick: false,
            allowEscapeKey: false,
            allowEnterKey: false,
            showConfirmButton: false
        });
    });
    </script>';
        }
        ?>
    </div>

</body>

</html>