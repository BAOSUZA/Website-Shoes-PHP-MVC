<?php
include '../database/config.php';
?>
<!-- Sale & Revenue Start -->
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <?php
        $weekRevenue = 0;
        $queryWeekRevennue = "SELECT SUM(total_money) AS total FROM `orders` WHERE WEEK(order_date) = WEEK(CURRENT_DATE)";
        $resultWeekRevenue = mysqli_query($conn, $queryWeekRevennue);
        $rowWeekRevenue = mysqli_fetch_array($resultWeekRevenue);
        if ($rowWeekRevenue['total'] != NULL) {
            $weekRevenue = $rowWeekRevenue['total'];
        }
        ?>
        <div class="col-sm-6 col-xl-4">
            <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-chart-line fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Doanh thu trong tuần</p>
                    <h6 class="mb-0"><?= number_format($weekRevenue, 0, '.', '.') ?>đ</h6>
                </div>
            </div>
        </div>
        <?php
        $todayRevenue = 0;
        $queryTodayRevennue = "SELECT SUM(total_money) AS total FROM `orders` WHERE DAY(order_date) = DAY(CURRENT_DATE) AND MONTH(order_date) = MONTH(CURRENT_DATE) AND YEAR(order_date) = YEAR(CURRENT_DATE)";
        $resultTodayRevenue = mysqli_query($conn, $queryTodayRevennue);
        $rowTodayRevenue = mysqli_fetch_array($resultTodayRevenue);
        if ($rowTodayRevenue['total'] != NULL) {
            $todayRevenue = $rowTodayRevenue['total'];
        }
        ?>
        <div class="col-sm-6 col-xl-4">
            <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-chart-area fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Doanh thu hôm nay</p>
                    <h6 class="mb-0"><?= number_format($todayRevenue, 0, '.', '.') ?>đ</h6>
                </div>
            </div>
        </div>
        <?php
        $totalRevenue = 0;
        $queryTotalRevennue = "SELECT SUM(total_money) AS total FROM `orders`";
        $resultTotalRevenue = mysqli_query($conn, $queryTotalRevennue);
        $rowTotalRevenue = mysqli_fetch_array($resultTotalRevenue);
        if ($rowTotalRevenue['total'] != NULL) {
            $totalRevenue = $rowTotalRevenue['total'];
        }
        ?>
        <div class="col-sm-6 col-xl-4">
            <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-chart-pie fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Tổng doanh thu .</p>
                    <h6 class="mb-0"><?= number_format($totalRevenue, 0, '.', '.') ?>đ</h6>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Sale & Revenue End -->

<?php
// đồ thị doanh thu bán được trong tháng 
$queryChart1 = "SELECT c.name, count(category_id) AS quantity FROM category c, product p WHERE c.id = p.category_id GROUP BY name";
$resultChart1 = mysqli_query($conn, $queryChart1);
$chart_data1 = '';
while ($rowChart1 = mysqli_fetch_array($resultChart1)) {
    $chart_data1 .= "{ label:'" . $rowChart1["name"] . "', value:" . $rowChart1["quantity"] . "}, ";
}
$chart_data1 = substr($chart_data1, 0, -2);
// echo '<br>' . $chart_data1;

// đồ thị doanh thu bán được trong tháng 
$queryChart2 = "SELECT DISTINCT DAY(o.order_date) as day, count(od.num) AS num, o.total_money FROM product p, order_details od, orders o 
                WHERE p.id = od.product_id AND o.id = od.order_id AND MONTH(o.order_date) = MONTH(CURRENT_DATE) GROUP BY total_money";
$resultChart2 = mysqli_query($conn, $queryChart2);
$chart_data2 = '';
while ($rowChart2 = mysqli_fetch_array($resultChart2)) {
    $chart_data2 .= "{ day:'" . $rowChart2["day"] . "', num:" . $rowChart2["num"] . ", total_money:" . $rowChart2["total_money"] . "}, ";
}
$chart_data2 = substr($chart_data2, 0, -2);
// echo '<br><br>' . $chart_data2;

// đồ thị quản lý giày
$queryChart3 = "SELECT * FROM product";
$resultChart3 = mysqli_query($conn, $queryChart3);
$chart_data3 = '';
while ($rowChart3 = mysqli_fetch_array($resultChart3)) {
    $chart_data3 .= "{ id:'" . $rowChart3["id"] . "', quantity:" . $rowChart3["quantity"] . ", quantity_purchased:" . $rowChart3["quantity_purchased"] . "}, ";
}
$chart_data3 = substr($chart_data3, 0, -2);
// echo '<br><br>' . $chart_data3;
?>
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-12 col-xl-3">
            <div class="bg-light text-center rounded p-4 container">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h6 class="mb-0">Biểu đồ danh mục</h6>
                </div>
                <div id="chart1"></div>
            </div>
        </div>
        <div class="col-sm-12 col-xl-9">
            <div class="bg-light text-center rounded p-4 container">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h6 class="mb-0">Biểu đồ giày bán trong tháng</h6>
                </div>
                <div id="chart2"></div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid pt-4 px-4">
    <div class="bg-light text-center rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h6 class="mb-0">Biều đồ quản lý giày</h6>
        </div>
        <div id="chart3"></div>
    </div>
</div>

<script>
    // đồ thị số sản phẩm trong danh mục
    Morris.Donut({
        element: 'chart1',
        data: [<?= $chart_data1 ?>],
        hideHover: 'auto'
    });

    // đồ thị doanh thu bán được trong tháng 
    Morris.Bar({
        element: 'chart2',
        data: [<?= $chart_data2 ?>],
        xkey: 'day',
        ykeys: ['day', 'num', 'total_money'],
        labels: ['Ngày', 'Số lượng sản phẩm bán ra', 'Doanh thu'],
        hideHover: 'auto',
        stacked: true
    });

    // đồ thị quản lý sản phẩm
    Morris.Bar({
        element: 'chart3',
        data: [<?= $chart_data3 ?>],
        xkey: 'id',
        ykeys: ['id', 'quantity', 'quantity_purchased'],
        labels: ['Mã sản phẩm', 'Số lượng sản phẩm trong kho', 'Số lượng đã bán'],
        hideHover: 'auto',
        // stacked: true
    });
</script>