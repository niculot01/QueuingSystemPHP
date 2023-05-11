<style>
    .body {
        position: fixed;
        max-height: fit-content;
    }

    .h1-text {
        height: 30%;
        text-align: center;
    }

    img {
        padding-top: 20px;
        transition: transform 0.2s ease-out;
        
    }

    img:hover {
        transform: rotate(0deg);
    }

    img.clicked {
        animation: wiggle 3s linear;
        backface-visibility: hidden;
    }

    @keyframes wiggle {
        0% {
            transform: rotate(0deg) scale(1);
        }

        25% {
            transform: rotate(45deg) scale(1.5);
        }

        50% {
            transform: rotate(-45deg) scale(1.5);
        }

        75% {
            transform: rotate(45deg) scale(1.5);
        }

        100% {
            transform: rotate(0deg) scale(1);
        }
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
        font-weight: 700;
        font-size: 130px;

    }

    .labelnames input[type="text"],
    .labelnames input[type="tel"],
    .labelnames select,
    .labelsearch input[type="text"],
    .labelfilter select {
        padding: 10px;
        margin-right: 10px;
        font-size: 90px;
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
        padding: 30px;
        font-size: 120px;
        border-radius: 35px;
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
        height: 525px;
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
        right: 90%;
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

    select {
        font-family: Arial, sans-serif;
        font-size: 25px;
        color: #333;
        background-color: #fff;
        border: 1px solid #ccc;
        padding: 8px 16px;
        border-radius: 4px;
        width: 100%;
        max-width: 150px;
        max-height: 150px;
        /* Hide default scrollbar */
        -webkit-appearance: none;
        line-height: 1;
        text-align: center;
    }

    /* Style the scrollbar */
    select::-webkit-scrollbar {
        width: 1px;
        text-align: center;
    }

    /* Style the scrollbar track */
    select::-webkit-scrollbar-track {
        background-color: #f1f1f1;
        text-align: center;
    }

    /* Style the scrollbar thumb */
    select::-webkit-scrollbar-thumb {
        background-color: #888;
        border-radius: 5px;
        text-align: center;
    }

    /* Style the scrollbar thumb on hover */
    select::-webkit-scrollbar-thumb:hover {
        background-color: #555;
        text-align: center;
    }

    select:focus {
        outline: none;
        border-color: #4a90e2;
        box-shadow: 0 0 0 1000px rgba(74, 144, 226, 1);
        text-align: center;
        transform: scale(1.2);
    }

    #party_size {
        padding: 10px;
        text-align: center;
        border: 3px solid #ccc;
        border-radius: 10px;
        /* animation: tap 1s infinite; */
        animation: wiggles 15s linear infinite;
    }
    @keyframes wiggles {
        0% {
            transform: rotate(0deg) scale(0.9);
        }

        25% {
            transform: rotate(5deg) scale(1.1);
        }

        50% {
            transform: rotate(-5deg) scale(1.1);
        }

        75% {
            transform: rotate(5deg) scale(1.1);
        }

        100% {
            transform: rotate(0deg) scale(0.9);
        }
    }



    .labelnames button:disabled {
        background-color: #ff0000;
        /* change background color to red */
        cursor: not-allowed;
        /* disable cursor */
    }


    .arrow-container {
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        height: 200px;
    }

    .arrow {
        position: absolute;
        top: 45%;
        left: 10%;
        transform: translate(-50%, -50%) rotate(-45deg);
        width: 20px;
        height: 20px;
        border: 2px solid lightblue;
        border-top: none;
        border-right: none;
        animation: arrow-anim 4s ease-in-out infinite;
    }

    .animated-text {
        padding-left: 20%;
        font-size: 24px;
        opacity: 0;
        animation: text-anim 3s ease-in-out infinite;
        animation-delay: 0.5s;
    }

    @keyframes arrow-anim {
        0% {
            transform: translate(-50%, -50%) rotate(45deg) translateY(-5px);
        }

        25% {
            transform: translate(-50%, -50%) rotate(45deg) translateY(5px);
        }

        50% {
            transform: translate(-50%, -50%) rotate(45deg) translateY(-5px);
        }

        75% {
            transform: translate(-50%, -50%) rotate(45deg) translateY(5px);
        }

        100% {
            transform: translate(-50%, -50%) rotate(45deg) translateY(-5px);
        }
    }

    @keyframes text-anim {
        0% {
            opacity: 0;
            transform: translateX(-30px);
        }

        50% {
            opacity: 1;
        }

        100% {
            opacity: 0;
            transform: translateX(30px);
        }
    }
</style>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>GT|QSystem</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script>
        // Refresh the queue every 5 seconds
        setInterval(function () {
            $('#queue').load('queue_data.php');
        }, 2000);
        // Reload the index file every 15 seconds
        setInterval(function () {
            location.reload();
        }, 15000);
    </script>
    <script>
        function speak(name, floor) {
            const msg = new SpeechSynthesisUtterance();
            msg.text = `Customer ${name} is ready to be seated, please proceed to ${floor} floor!`;
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
        document.addEventListener("DOMContentLoaded", function () {
            const submitBtn = document.querySelector('form labelnames button[type="submit"]');
            const partySizeSelect = document.getElementById('party_size');

            // Disable the submit button by default
            submitBtn.disabled = true;

            // Enable the submit button if an option is selected
            partySizeSelect.addEventListener('change', function () {
                submitBtn.disabled = (partySizeSelect.value === "");
            });
        });
    </script>
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
                    <select id="party_size" name="party_size" aria-placeholder="--" required onchange="checkSelect()">
                        <option value=""></option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                    </select>
                    <div class="arrow-container">
                        <h2 class="animated-text">Group size?<br><br>Ilan kayo sa inyong grupo?</h2>
                        <div class="arrow"></div>
                    </div>
                    <button type="submit" id="submit-btn" disabled>Print Queue Number</button>
                </form>
                <script>
                    function checkSelect() {
                        var selectBox = document.getElementById("party_size");
                        var submitBtn = document.getElementById("submit-btn");
                        if (selectBox.value == "") {
                            submitBtn.disabled = true;
                        } else {
                            submitBtn.disabled = false;
                        }
                    }
                </script>
            </div>
        </div>
        <div class="text">
            <h2 style="text-align:center;">Kindly obtain your queue number and make your way to the designated waiting
                area.</h2>
            <h3 style="text-align:center;">Maaari po bang kunin ninyo ang inyong numero sa pila at maghintay sa itinakdang lugar para sa mga naghihintay.</h3>
        </div>
    </div>
</body>

</html>