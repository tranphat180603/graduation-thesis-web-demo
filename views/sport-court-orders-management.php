<!DOCTYPE html>
<html lang="vi">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Khu liên hợp thể thao Nguyễn Tri Phương</title>
    <link rel="stylesheet" type="text/css" href="../styles/sport-court-orders-management.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet"/>
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
  </head>
  <body>
    <!-- HEADER -->
    <?php include "../header/admin-managerial-header.php"; ?>
    <!-- BODY -->   
    <?php
      require_once "../controllers/court-order-controller.php"; 
      $court_order_controller = new Court_Order_Controller();

      require_once "../controllers/court-schedule-controller.php"; 
      $court_schedule_controller = new Court_Schedule_Controller();

      require_once "../controllers/court-controller.php"; 
      $court_controller = new Court_Controller();

      require_once "../controllers/court-type-controller.php"; 
      $court_type_controller = new Court_Type_Controller();

      require_once "../controllers/account-controller.php"; 
      $account_controller = new Account_Controller();

      require_once "../controllers/customer-controller.php"; 
      $customer_controller = new Customer_Controller();
    ?>
    <div class="court-order-body">
      <div class="court-order-body-content">
        <div class="court-order-top">
          <p>Danh sách đơn đặt sân</p>
          <div class="filter">
            <label for="filter" class="filter-btn" title="Filter"></label>
            <input type="checkbox" id="filter">
            <div class="filter-form">
              <div class="filter-court-type">
                <p>Loại sân</p>
                <div id="filter-court-type-options">
                  <div id="football">
                    <input type="checkbox" name="cb-football" id="cb-football" value="bóng đá">
                    <p id="p-football">Bóng đá</p>
                  </div>
                  <div id="volleyball">
                    <input type="checkbox" name="cb-volleyball" id="cb-volleyball" value="bóng chuyền">
                    <p id="p-volleyball">Bóng chuyền</p>
                  </div>
                  <div id="basketball">
                    <input type="checkbox" name="cb-basketball" id="cb-basketball" value="bóng rổ">
                    <p id="p-basketball">Bóng rổ</p>
                  </div>
                  <div id="badminton">
                    <input type="checkbox" name="cb-badminton" id="cb-badminton" value="cầu lông">
                    <p id="p-badminton">Cầu lông</p>
                  </div>
                  <div id="tennis">
                    <input type="checkbox" name="cb-tennis" id="cb-tennis" value="tennis">
                    <p id="p-tennis">Tennis</p>
                  </div>
                </div>
              </div>
              <hr>
              <div class="filter-court-order-date">
                <p>Khoảng thời gian</p>
                <div id="filter-court-order-date-options">
                  <div class="date">
                    <p>Ngày bắt đầu</p>
                    <input type="date" id="start-date" name="start-date">
                  </div>
                  <p id="to">đến</p>
                  <div class="date">
                    <p>Ngày kết thúc</p>
                    <input type="date" id="end-date" name="end-date">
                  </div>
                </div>
              </div>
              <hr>
              <div class="filter-action">
                <a id="btn-filter-reset" href="#">Đặt lại</a>
                  <div class="right-part">
                    <a id="btn-filter-cancel" href="./sport-court-orders-management.php?court_order_state=1">Hủy</a>
                    <a id="btn-filter-confirm" href="#">Xác nhận</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="search">
            <img src="../image/sport-court-orders-management-img/search.svg" alt="search-icon">
            <input
              type="search"
              id="search-input"
              name="search-input"
              placeholder="Tìm kiếm đơn đặt sân"
              required
            />        
          </div>
          <div id="court-order-body-menu">
            <ul>
              <li class='li-court-order-state' id='li-court-order-state-0'>
                <a id='a-court-order-state-0' href='?court_order_state_id=0'>Tất cả
                  <?php
                    $court_order_amount = $court_order_controller->view_all_court_order();

                    echo "&nbsp;(<span>".$court_order_amount[0]."</span>)";
                  ?>
                </a>
              </li>
              <li class='li-court-order-state' id='li-court-order-state-1'>
                <a id='a-court-order-state-1' href='?court_order_state_id=1'>Chờ thanh toán
                  <?php
                    $order_state = "Chờ thanh toán";
                    $court_order_amount = $court_order_controller->view_court_order_by_court_order_state($order_state);

                    echo "&nbsp;(<span>".$court_order_amount[0]."</span>)";
                  ?>
                </a>
              </li>
              <li class='li-court-order-state' id='li-court-order-state-2'>
                <a id='a-court-order-state-2' href='?court_order_state_id=2'>Chờ nhận sân
                  <?php
                    $order_state = "Chờ nhận sân";
                    $court_order_amount = $court_order_controller->view_court_order_by_court_order_state($order_state);

                    echo "&nbsp;(<span>".$court_order_amount[0]."</span>)";
                  ?>
                </a>
              </li>
              <li class='li-court-order-state' id='li-court-order-state-3'>
                <a id='a-court-order-state-3' href='?court_order_state_id=3'>Hoàn thành
                  <?php
                    $order_state = "Hoàn thành";
                    $court_order_amount = $court_order_controller->view_court_order_by_court_order_state($order_state);

                    echo "&nbsp;(<span>".$court_order_amount[0]."</span>)";
                  ?>
                </a>
              </li>
              <li class='li-court-order-state' id='li-court-order-state-4'>
                <a id='a-court-order-state-4' href='?court_order_state_id=4'>Đã hủy
                  <?php
                    $order_state = "Đã hủy";
                    $court_order_amount = $court_order_controller->view_court_order_by_court_order_state($order_state);

                    echo "&nbsp;(<span>".$court_order_amount[0]."</span>)";
                  ?>
                </a>
              </li>
              <li class='li-court-order-state' id='li-court-order-state-5'>
                <a id='a-court-order-state-5' href='?court_order_state_id=5'>Chờ hoàn tiền
                  <?php
                    $order_state = "Chờ hoàn tiền";
                    $court_order_amount = $court_order_controller->view_court_order_by_court_order_state($order_state);

                    echo "&nbsp;(<span>".$court_order_amount[0]."</span>)";
                  ?>
                </a>
              </li>
            </ul>
          </div>
          <div class="court-order-table">
            <table>
              <thead> 
                <tr>
                  <th>Mã đơn đặt sân<span class='icon-arrow'>&UpArrow;</span></th>
                  <th style="max-width: 200px;">Tên sân<span class='icon-arrow'>&UpArrow;</span></th>
                  <th>Loại sân<span class='icon-arrow'>&UpArrow;</span></th>
                  <th>Ngày nhận sân<span class='icon-arrow'>&UpArrow;</span></th>
                  <th>Khung giờ<span class='icon-arrow'>&UpArrow;</span></th>
                  <th>Tổng thanh toán<span class='icon-arrow'>&UpArrow;</span></th>
                  <th>Tổng tiền cọc<span class='icon-arrow'>&UpArrow;</span></th>
                  <th>Số điện thoại<span class='icon-arrow'>&UpArrow;</span></th>
                  <th>Phương thức thanh toán<span class='icon-arrow'>&UpArrow;</span></th>
                  <th>Người đặt<span class='icon-arrow'>&UpArrow;</span></th>
                  <th>Thao tác<span class='icon-arrow'>&UpArrow;</span></th>
                </tr>
              </thead>
              <tbody>
                <?php 
                  $court_orders = $court_order_controller->view_court_order();
                  $court_schedules = $court_schedule_controller->view_all_court_schedule();
                  $courts = $court_controller->view_all_court();
                  $court_types = $court_type_controller->view_all_court_type();
                  $accounts = $account_controller->view_all_account();
                  $customers = $customer_controller->view_all_customer();

                  foreach ($court_orders as $court_order) {
                    echo "<tr>";
                    echo "<td>".$court_order->getCourtOrderId()."</td>";

                    echo "<td>";
                    foreach ($court_schedules as $court_schedule) {
                      if ($court_schedule->getCourtScheduleId() == $court_order->getCourtScheduleId()) {
                        foreach ($courts as $court) {
                          if ($court->getCourtId() == $court_schedule->getCourtId()) {
                            echo $court->getCourtName();
                          }
                        }
                      }
                    }
                    echo "</td>";

                    echo "<td>";
                    foreach ($court_schedules as $court_schedule) {
                      if ($court_schedule->getCourtScheduleId() == $court_order->getCourtScheduleId()) {
                        foreach ($courts as $court) {
                          if ($court->getCourtId() == $court_schedule->getCourtId()) {
                            foreach ($court_types as $court_type) {
                              if ($court_type->getCourtTypeId() == $court->getCourtTypeId()) {
                                echo $court_type->getCourtTypeName();
                              }
                            }
                          }
                        }
                      }
                    }
                    echo "</td>";

                    echo "<td>";
                    foreach ($court_schedules as $court_schedule) {
                      if ($court_schedule->getCourtScheduleId() == $court_order->getCourtScheduleId()) {
                            echo $court_schedule->getCourtScheduleDate();
                      }
                    }
                    echo "</td>";

                    echo "<td>";
                    foreach ($court_schedules as $court_schedule) {
                      if ($court_schedule->getCourtScheduleId() == $court_order->getCourtScheduleId()) {
                            echo $court_schedule->getCourtScheduleTimeFrame();
                      }
                    }
                    echo "</td>";

                    echo "<td>".number_format($court_order->getOrderTotalPayment(), 0, ',', '.')."</td>";
                    echo "<td>".number_format($court_order->getOrderTotalDeposit(), 0, ',', '.')."</td>";

                    echo "<td>";
                    foreach ($accounts as $account) {
                      if ($account->getAccountId() == $court_order->getCustomerAccountId()) {
                        foreach ($customers as $customer) {
                          if ($customer->getCustomerId() == $account->getCustomerId()) {
                            echo $customer->getCustomerPhoneNumber();
                          }
                        }
                      }
                    }
                    echo "</td>";

                    echo "<td>".$court_order->getPaymentMethod()."</td>";

                    echo "<td class='btn-view'>
                            <a href='?option=view_court_order_detail_state_";

                    if ($court_order->getOrderState() == "Chờ thanh toán") {
                      echo "payment'>";
                    } else if ($court_order->getOrderState() == "Chờ nhận sân") {
                      echo "receive'>";
                    } else if ($court_order->getOrderState() == "Hoàn thành") {
                      echo "complete'>";
                    } else if ($court_order->getOrderState() == "Đã hủy") {
                      echo "canceled'>";
                    } else if ($court_order->getOrderState() == "Chờ hoàn tiền") {
                      echo "refunded'>";
                    }
                    
                    echo "<img src='../image/sport-court-orders-management-img/eye.svg' alt='eye icon'>
                            <p>Xem</p>
                        </a>
                      </td>
                    ";

                    echo "</tr>";
                  }


                  $court_schedules = $court_schedule_controller->view_court_schedule();

                  foreach($court_schedules as $court_schedule) {
                    echo "<tr>";

                    echo "<td>".$court_schedule->getCourtScheduleId()."</td>";

                    echo "<td>";
                    foreach($courts as $court) {
                      if ($court->getCourtId() == $court_schedule->getCourtId()) {
                        echo $court->getCourtName();
                      }
                    }
                    echo "</td>";                    

                    echo "<td>".$court_schedule->getCourtScheduleDate()."</td>";
                    echo "<td>".substr($court_schedule->getCourtScheduleStartTime(), 0, 5)."</td>";
                    echo "<td>".substr($court_schedule->getCourtScheduleEndTime(), 0, 5)."</td>";
                    echo "<td>".$court_schedule->getCourtScheduleTimeFrame()."</td>";

                    if ($court_schedule->getCourtScheduleState() == "Chưa đặt") {
                        echo "<td><p class='status haveNotBooked'>".$court_schedule->getCourtScheduleState()."</p></td>";
                    } else if ($court_schedule->getCourtScheduleState() == "Đã đặt") {
                        echo "<td><p class='status haveBooked'>".$court_schedule->getCourtScheduleState()."</p></td>";
                    } else if ($court_schedule->getCourtScheduleState() == "Hết hạn") {
                        echo "<td><p class='status expired'>".$court_schedule->getCourtScheduleState()."</p></td>";
                    } else if ($court_schedule->getCourtScheduleState() == "Đã xóa") {
                      echo "<td><p class='status deleted'>".$court_schedule->getCourtScheduleState()."</p></td>";
                    }

                    echo "
                        <td class='btn-view'>
                            <a href='?option=view_court_schedule_detail&court_schedule_id=".$court_schedule->getCourtScheduleId()."&court_schedule_state=".$court_schedule->getCourtScheduleState()."'>
                                <img src='../image/sport-court-schedules-management-img/eye.svg' alt='eye icon'>
                                <p>Xem</p>
                            </a>
                        </td>
                    ";

                    echo "</tr>";
                  }
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    <!-- FOOTER -->
    <?php include "../footer/footer.php"; ?>
    <script type="text/javascript" src="../scripts/sport-court-orders-management.js" language="javascript"></script>
  </body>
</html>
