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
            }, 1000);
        }
    </script>
     <div class="flour">3rdFloor</div>
    <div class="form-container3">

        <div class="table-wrapper3">
            <div class="table-container3">
                <?php include '3rdfloor.php'; ?>
            </div>
        </div>

    </div>
</body>
