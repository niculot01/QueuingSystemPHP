<!DOCTYPE html>
<html>

<style>
    .flour{
        position: absolute;
        top:10px;
        right: 80%;
        font-size: 50px;
    }
</style>

<head>
  <title>GT|Qsystem</title>
<body class="body3" onload="reloadPage()">

    <script>
        function reloadPage() {
            setInterval(function () {
                location.reload();
            }, 5000);
        }
    </script>
     <div class="flour">6thFloor</div>
    <div class="form-container3">

        <div class="table-wrapper3">
            <div class="table-container3">
                <?php include '6thfloor.php'; ?>
            </div>
        </div>

    </div>
</body>
