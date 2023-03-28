<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<h2>Thống kê</h2>
<div
    id="myChart" style="width:100%; max-width:600px; height:500px;">
</div>

<?php 
    include './db.php';
    $stmt = $conn->prepare('SELECT catergory.catergoryName, count(catergoryID) as "total_product_in_catergory" FROM product join catergory ON product.catergoryID = catergory.id GROUP BY catergoryID;');
    $stmt->execute();
    $product_list = $stmt->fetchAll();
?>

<script>
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Danh mục', 'Số lượng sản phẩm'],
            <?php 
                foreach($product_list as $product){
            ?>  
                [<?php echo '\'' .$product['catergoryName']. '\''?> , <?php echo $product['total_product_in_catergory']?> ],
            <?php }?>
            ]);

        var options = {
        title:'Số lượng sản phẩm của từng danh mục'
        };

        var chart = new google.visualization.PieChart(document.getElementById('myChart'));
        chart.draw(data, options);
    }
</script>

