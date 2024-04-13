<?php 
  session_start(); 
  ini_set('display_errors', 0);
  ini_set('display_startup_errors', 0);
?>
<!DOCTYPE html>
  <html lang="vi">
    <head>
      <meta charset="UTF-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <title>Khu liên hợp thể thao Nguyễn Tri Phương</title>
      <link rel="stylesheet" type="text/css" href="../styles/statistical-report.css" />
      <link rel="preconnect" href="https://fonts.googleapis.com" />
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
      <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet"/>
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
      <link rel="apple-touch-icon" sizes="57x57" href="../favicon/apple-icon-57x57.png"/>
      <link rel="apple-touch-icon" sizes="60x60" href="../favicon/apple-icon-60x60.png"/>
      <link rel="apple-touch-icon" sizes="72x72" href="../favicon/apple-icon-72x72.png"/>
      <link rel="apple-touch-icon" sizes="76x76" href="../favicon/apple-icon-76x76.png"/>
      <link rel="apple-touch-icon" sizes="114x114" href="../favicon/apple-icon-114x114.png"/>
      <link rel="apple-touch-icon" sizes="120x120" href="../favicon/apple-icon-120x120.png"/>
      <link rel="apple-touch-icon" sizes="144x144" href="../favicon/apple-icon-144x144.png"/>
      <link rel="apple-touch-icon" sizes="152x152" href="../favicon/apple-icon-152x152.png"/>
      <link rel="apple-touch-icon" sizes="180x180" href="../favicon/apple-icon-180x180.png"/>
      <link rel="icon" type="image/png" sizes="192x192" href="../favicon/android-icon-192x192.png"/>
      <link rel="icon" type="image/png" sizes="32x32" href="../favicon/favicon-32x32.png"/>
      <link rel="icon" type="image/png" sizes="96x96" href="../favicon/favicon-96x96.png"/>
      <link rel="icon" type="image/png" sizes="16x16" href="../favicon/favicon-16x16.png"/>
      <link rel="manifest" href="/manifest.json" />
      <meta name="msapplication-TileColor" content="#ffffff" />
      <meta name="msapplication-TileImage" content="../favicon/ms-icon-144x144.png"/>
      <meta name="theme-color" content="#ffffff" />
      <script type="text/javascript" src="../scripts/statistical-report.js" language="javascript"></script>
      <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    </head>
    <body>
      <!-- HEADER -->
      <?php include "../header/admin-managerial-header.php"; ?>
      <!-- BODY -->
      <?php 
      require_once ($_SERVER['DOCUMENT_ROOT'] . "/NTP-Sports-Hub/controllers/order-service-detail-controller.php");
      require_once ($_SERVER['DOCUMENT_ROOT'] . "/NTP-Sports-Hub/controllers/court-order-controller.php");
      require_once ($_SERVER['DOCUMENT_ROOT'] . "/NTP-Sports-Hub/controllers/review-controller.php");
      require_once ($_SERVER['DOCUMENT_ROOT'] . "/NTP-Sports-Hub/controllers/customer-controller.php");
      require_once ($_SERVER['DOCUMENT_ROOT'] . "/NTP-Sports-Hub/controllers/visitor-controller.php");

      ?>
      <div class = "statistical-report">
        <div class = "report-header">
          <p id = "header-name">Báo cáo thống kê</p>
          <span id = "currentTime"></span>
        </div>
        <div class = yearPickerContainer>
          <div class = "yearPickerFrame" >
          <span id="picker-text"><?php echo (isset($_GET['year'])) ? $_GET['year'] : 'Chọn năm thống kê'; ?></span>
            <img id = "picker-img" src="../image/statistical-report-img/chevron-down.svg" alt="">
          </div>
        </div>
        <div class = "panelFrame">
          <div class = "panel">
            <div class = "numbers">
              <div class = "numbers-header">
                <p class = "panel-header">Số lượng khách</p>
                <div class = "perchange">
                <?php if ($visitorCountdiff > 0): ?>
                    <img class="arrow" src="../image/statistical-report-img/green-up-arrow.svg" alt="">
                    <p class="percentage-text" style="color: green;"><?php echo $visitorCountdiff; ?> người </p>
                  <?php elseif ($visitorCountdiff < 0): ?>
                    <img class="arrow" src="../image/statistical-report-img/red-down-arrow.svg" alt="">
                    <p class="percentage-text" style="color: red;"><?php echo $visitorCountdiff; ?> người </p>
                  <?php endif; ?>
                </div>
              </div>
              <span><?php echo $visitorCountdiff; ?></span>
            </div>
            <div class = "visual">
              <img src="../image/statistical-report-img/green.svg" alt="">
            </div>
          </div>
          <div class = "panel">
          <div class = "numbers">
              <div class = "numbers-header">
                <p class = "panel-header">Số lượng khách hàng</p>
                <div class="perchange">
                  <?php if ($customerCountDiff > 0): ?>
                    <img class="arrow" src="../image/statistical-report-img/green-up-arrow.svg" alt="">
                    <p class="percentage-text" style="color: green;"><?php echo $customerCountDiff; ?> người</p>
                  <?php elseif ($customerCountDiff < 0): ?>
                    <img class="arrow" src="../image/statistical-report-img/red-down-arrow.svg" alt="">
                    <p class="percentage-text" style="color: red;"><?php echo $customerCountDiff; ?> người</p>
                  <?php endif; ?>
                </div>
              </div>
              <span><?php echo $customerCount[0]?></span>
            </div>
            <div class = "visual">
              <img src="../image/statistical-report-img/blue.svg" alt="">
            </div>
          </div>
          <div class = "panel">
          <div class = "numbers">
              <div class = "numbers-header">
                <p class = "panel-header">Số lượng đơn đặt hàng </p>
                <div class="perchange">
                  <?php if ($num_court_order_diff > 0): ?>
                    <img class="arrow" src="../image/statistical-report-img/green-up-arrow.svg" alt="">
                    <p class="percentage-text" style="color: green;"><?php echo $num_court_order_diff; ?> đơn </p>
                  <?php elseif ($num_court_order_diff < 0): ?>
                    <img class="arrow" src="../image/statistical-report-img/red-down-arrow.svg" alt="">
                    <p class="percentage-text" style="color: red;"><?php echo $num_court_order_diff; ?> đơn </p>
                  <?php endif; ?>
                </div>
              </div>
              <span><?php echo $num_court_order[0]?></span>
            </div>
            <div class = "visual">
              <img src="../image/statistical-report-img/orange.svg" alt="">
            </div>
          </div>
        </div>
        <div class = "chartFrame">
          <div class = "chart1">
            <div class = "chartTitle">
            <p class = "chartTitle-text">Tổng số lượng Khách và Khách hàng</p>
            </div>
            <div class = "chartContent">
              <canvas id = "visitor-customer-count-line-chart">
                <script>
                  var ctx = document.getElementById("visitor-customer-count-line-chart").getContext('2d');
                  var chart = DoubleLineChart(ctx, <?php echo json_encode($months);?>, <?php echo json_encode($customerCountbyMonth)?>, <?php echo json_encode($visitorCountbyMonth);?>);
                </script>
              </canvas>
            </div>
          </div>
          <div class = chart2>
            <div class = "chartTitle">
              <p class = "chartTitle-text">Tỷ lệ phần trăm số lượng Khách hàng sử dụng theo Dịch vụ</p>
            </div>
            <div class = "chartContent">
               <canvas  id = "customer-service-pie-chart">
                  <script>
                    var ctx = document.getElementById("customer-service-pie-chart").getContext('2d');
                    var chart = PieChart(ctx, <?php echo json_encode($customer_service_labels); ?>, <?php echo json_encode($customer_service_count); ?>);
                  </script>
               </canvas>
            </div>
          </div>
          <div class="chart1">
              <div class="chartTitle">
                  <p class="chartTitle-text">Top 5 sự kiện được áp dụng nhiều nhất</p>
              </div>
              <div class="chartContent">
              <canvas  id="most-chosen-service"></canvas>
                  <script>
                      var ctx = document.getElementById("most-chosen-service").getContext('2d');
                      var pieChart = HorizontalBarChart(ctx, <?php echo json_encode($top_service_labels); ?>, <?php echo json_encode($top_service_count); ?>);
                  </script>
              </div>
          </div>
          <div class = "chart2">
            <div class = "chartTitle">
              <p class = "chartTitle-text">Tổng Doanh thu và số lượng Đơn đặt sân</p>
            </div>
            <div class = "chartContent">
              <canvas id = "revenue&court_order"></canvas>
              <script>
                var ctx = document.getElementById("revenue&court_order").getContext('2d');
                var bar_line_chart = BarLineChart(ctx, <?php echo json_encode($months);?>, <?php echo json_encode($revenue_total);?>,<?php echo json_encode($court_order_total);?> )
              </script>
            </div>
          </div>
          <div class ="chart3">
            <div class = "chartTitle">
              <p class = "chartTitle-text">Tổng Doanh thu và số lượng Đơn đặt sân theo Loại sân thể thao</p>
            </div>
            <div id = "chartContent5">
              <canvas id = "groupedBarChart"></canvas>
              <script>
                var ctx = document.getElementById("groupedBarChart").getContext('2d');
                var group_bar_chart = groupedBarChart(ctx, <?php echo json_encode($revenue_by_court_type);?> )
              </script>
            </div>
          </div>
          <div class="chart4">
            <div id="chartContainer">
              <div class="chartTitle">Tổng số lượng đánh giá sân thể thao</div>
              <div class="contentContainer">
                <div class="contentFrame">
                  <?php foreach ($review_chart as $index => $entry): ?>
                    <div class="contentSubFrame">
                      <div class="textContainer">
                        <img class = "img-review" src="<?php echo $image[$index]?>" alt="">
                        <div class = "textFrame">
                          <p> <?php echo $court_name[$index]; ?></p>
                          <p class = "review-count-text"><?php echo $review_count[$index]; ?> lượt đánh giá</p>
                        </div>
                      </div>
                      <div class="starContainer">
                        <div class="starFrame">
                          <?php
                          $fullStars = floor($average_star_rate[$index]) ;
                          $halfStar = $average_star_rate[$index] - $fullStars >= 0.5;

                          for ($i = 0; $i < 5; $i++) {
                            if ($i < $fullStars) {
                              echo '<img src="../image/statistical-report-img/bright-star.svg" alt="star">';
                            } elseif ($halfStar) {
                              echo '<img class="half-bright-star" src="../image/statistical-report-img/half-star.svg" alt="half-star">';
                              $halfStar = false;
                            } elseif ($i >= $fullStars) {
                              echo '<img src="../image/statistical-report-img/dark-star.svg" alt="star">';
                            }
                          }
                          ?>
                        </div>
                        <p class="rating-text"><?php echo $average_star_rate[$index]; ?> Rating</p>
                    </div>
                    </div>
                  <?php endforeach; ?>
                </div>
              </div>
            </div> 
          </div>
        </div>
      </div>
      <!-- FOOTER -->
      <?php include "../footer/footer.php"; ?>
      <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    </body>
  </html>

  <div class="perchange">
                  <?php if ($customerCountDiff > 0): ?>
                    <img class="arrow" src="../image/statistical-report-img/green-up-arrow.svg" alt="">
                    <p class="percentage-text" style="color: green;"><?php echo $customerCountDiff; ?>%</p>
                  <?php elseif ($customerCountDiff < 0): ?>
                    <img class="arrow" src="../image/statistical-report-img/red-down-arrow.svg" alt="">
                    <p class="percentage-text" style="color: red;"><?php echo $customerCountDiff; ?>%</p>
                  <?php endif; ?>
                </div>