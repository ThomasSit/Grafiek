<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Default Line Chart</title>
</head>
<body>
    <?php include 'nav.php'?>

    <?php
$conn = new mysqli('localhost', 'root', '', 'Graphic');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$query = $conn->query("
    SELECT MONTHNAME(Month) as Month, SUM(Data) as Data FROM data GROUP BY Month ORDER BY Month
");
$months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

$datas = [];

if ($query) {
    if ($query->num_rows > 0) {
        while ($data = $query->fetch_assoc()) {
            // Removed whitespace to avoid mismatch with comparing MONTHNAME
            $month = trim($data['Month']);
            $months[] = $month;
            $datas[] = (int)$data['Data']; 
        }
    } else {
        echo "No data found in the database.";
    }
} else {
    echo "Query error: " . $conn->error;
}

$conn->close();
?>

<pre>
<?php var_dump($months) ?>
</pre>

    <canvas id="myChart"></canvas>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('myChart').getContext('2d');

        const labels = <?php echo json_encode($months)?>;
        const datas = <?php echo json_encode($datas)?>; 

        if (labels.length > 0 && datas.length > 0) {
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Sample Line Data',
                        data: datas,
                        borderColor: 'rgba(75, 192, 192, 1)',
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderWidth: 2,
                        pointRadius: 5,
                        pointBackgroundColor: 'rgba(75, 192, 192, 1)',
                        pointBorderColor: '#fff',
                        pointBorderWidth: 2,
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }
    </script>
</body>
</html>
