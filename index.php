<!DOCTYPE html>
<html>

<head>
    <title>GT|Qsystem</title>
    <link rel="stylesheet" type="text/css" href="index.css">
</head>

<body>
    <div class="clear-counter-button">
        <form method="post" action="delete_all.php"
            onsubmit="return confirm('Are you sure you want to reset queue numbers and delete all records?')">
            <button type="submit" name="reset_delete" title="Reset Queue Numbers and Delete All Records"><i
                    class="fa fa-minus-circle fa-2x" aria-hidden="true"></i><i class="fa fa-trash fa-2x"
                    aria-hidden="true"></i></button>
        </form>
    </div>
    <div class="background"></div>
    <div class="center">
        <div class="hello">
            <img src="logo1.png" alt="Logo" width="300" height="300">
        </div>

        <div class="button-container">
            <button onclick="redirectToSelfAdd()">Self Add Page</button>
            <button onclick="redirectToUsher()">Usher Page</button>
            <button onclick="redirectToQueueList()">QueueList Page</button>
        </div>
        <div class="floor-button-container">
            <button onclick="redirectToSecondFloor()">2nd Floor Page</button>
            <button onclick="redirectToThirdFloor()">3rd Floor Page</button>
            <button onclick="redirectToSixthFloor()">6th Floor Page</button>
        </div>
    </div>
    <script src="index.js"></script>
</body>

</html>