<!DOCTYPE html>
<html>
<style>
    .flour{
        position: absolute;
        top:10px;
        right: 80%;
        font-size: 55px;
    }
</style>

<head>
    <title>GT|Qsystem</title>

<body class="body3" onload="reloadPage()">

    <script>
        function reloadPage() {
            setInterval(function () {
                location.reload();
            }, 1000);
        }
    </script>
    <script>
        function speak(name, floor) {
            const msg = new SpeechSynthesisUtterance();
            msg.text = `Customer ${name}, please proceed to ${floor} floor! Customer ${name}, please proceed to ${floor} floor!!`;
            window.speechSynthesis.speak(msg);
        }
    </script>
    <div class="flour">2ndFloor</div>
    <div class="form-container3">

        <div class="table-wrapper3">
            <div class="table-container3">
                <?php include '2ndfloor.php'; ?>
            </div>
        </div>

    </div>
</body>