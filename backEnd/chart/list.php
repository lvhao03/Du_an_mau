<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<h2>Thống kê</h2>
<div
    id="myChart" style="width:100%; max-width:600px; height:500px;">
</div>

<?php 
    include './db.php';
    $conn->prepare('SELECT * FROM bill');
?>

<script>
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = google.visualization.arrayToDataTable([
        ['Quoc gia', 'Mhl'],
        ['Italy',54.8],
        ['France',48.6],
        ['Spain',44.4],
        ['USA',23.9],
        ['Argentina',14.5]
        ]);

        var options = {
        title:'Sản phẩm được mua nhiều nhất'
        };

        var chart = new google.visualization.PieChart(document.getElementById('myChart'));
        chart.draw(data, options);
    }
</script>

