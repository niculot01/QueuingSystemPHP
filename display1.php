<!DOCTYPE html>
<html>
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
    <div class="form-container3">

        <div class="table-wrapper3">
            <div class="table-container3">
                <?php include 'queue_data_display1.php'; ?>
            </div>
        </div>

    </div>
</body>
