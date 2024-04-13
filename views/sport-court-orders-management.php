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
    <div id="overlay-wrapper"></div>
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
                    <a id="btn-filter-cancel" href="./sport-court-orders-management.php">Hủy</a>
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
                  <th>Tên sân<span class='icon-arrow'>&UpArrow;</span></th>
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
                          if ($customer->getAccountId() == $account->getAccountId()) {
                            echo $customer->getCustomerPhoneNumber();
                          }
                        }
                      }
                    }
                    echo "</td>";

                    if ($court_order->getPaymentMethod() == "Ví điện tử momo") {
                      echo "<td><p class='status momo'>".$court_order->getPaymentMethod()."</p></td>";
                    } else if ($court_order->getPaymentMethod() == "Chuyển khoản ngân hàng") {
                      echo "<td><p class='status bank'>".$court_order->getPaymentMethod()."</p></td>";
                    }

                    echo "<td style='display: flex; gap: 10px; align-items: center;'>
                            <img src='";
                    foreach ($accounts as $account) {
                      if ($account->getAccountId() == $court_order->getCustomerAccountId()) {
                        echo "/NTP-Sports-Hub" . $account->getAccountAvatar();
                      }
                    }
                    echo "' alt='customer avatar' style='border-radius: 50%; width: 28px; height: 28px;'>";
                    foreach ($accounts as $account) {
                      if ($account->getAccountId() == $court_order->getCustomerAccountId()) {
                        foreach ($customers as $customer) {
                          if ($customer->getAccountId() == $account->getAccountId()) {
                            echo $customer->getCustomerFullname();
                          }
                        }
                      }
                    }
                    echo "</td>";

                    echo "<td class='btn-view'>
                            <a href='?court_order_id=".$court_order->getCourtOrderId()."&option=view_court_order_detail_state_";

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
                ?>
              </tbody>
            </table>
          </div>
      </div>
    </div>
    <!-- FOOTER -->
    <?php include "../footer/footer.php"; ?>
    <script type="text/javascript" src="../scripts/sport-court-orders-management.js" language="javascript"></script>
    <!-- FORM XEM ĐƠN ĐẶT SÂN CÓ TRẠNG THÁI "CHỜ THANH TOÁN" -->
    <form id="form-view-payment" action="" method="post" enctype="multipart/form-data">
      <div class="form-header">
        <p>Thông tin đơn đặt sân sân</p>
        <a href="?option=court_order_exit">
          <img src="../image/sport-court-orders-management-img/close.svg" alt="close">
        </a>
      </div>
      <div class="form-body">
        <div class="form-body-content">
          <p class="form-body-title">Thông tin chung</p>
          <div class="form-row">
            <p>Mã đơn đặt sân :</p>
            <div class="input">
              <?php
                $court_order = $court_order_controller->view_specific_court_order();
                echo "<input type='text' name='court_order_id' placeholder='Không nhập' value='".$court_order[0]."'>";
              ?>
            </div>
          </div>
          <div class="form-row">
            <p>Tên sân :</p>
            <div class="input">
              <?php
                echo "<input type='text' name='court_name' id='court_name' value='";
                foreach ($court_schedules as $court_schedule) {
                  if ($court_order[1] == $court_schedule->getCourtScheduleId()) {
                    foreach ($courts as $court) {
                      if ($court->getCourtId() == $court_schedule->getCourtId()) {
                        echo $court->getCourtName();
                      }
                    }
                  }
                }
                echo "'>";
              ?>
            </div>
          </div>
          <div class="form-row">
            <p>Loại sân :</p>
            <div class="input">
              <?php
                echo "<input type='text' name='court_type' id='court_type' value='";
                foreach ($court_schedules as $court_schedule) {
                  if ($court_order[1] == $court_schedule->getCourtScheduleId()) {
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
                echo "'>";
              ?>
            </div>
          </div>
          <div class="form-row">
            <p>Ngày nhận sân :</p>
            <div class="input">
              <?php
                echo "<input type='text' name='court_schedule_date' id='court_schedule_date' value='";
                foreach ($court_schedules as $court_schedule) {
                  if ($court_order[1] == $court_schedule->getCourtScheduleId()) {
                    echo date("d/m/Y", strtotime($court_schedule->getCourtScheduleDate()));
                  }
                }
                echo "'>";
              ?>
            </div>
          </div>
          <div class="form-row">
            <p>Khung giờ :</p>
            <div class="input">
              <?php
                echo "<input type='text' name='court_schedule_date' id='court_schedule_date' value='";
                foreach ($court_schedules as $court_schedule) {
                  if ($court_order[1] == $court_schedule->getCourtScheduleId()) {
                    echo $court_schedule->getCourtScheduleTimeFrame();
                  }
                }
                echo "'>";
              ?>
            </div>
          </div>
          <hr>
          <p class="form-body-title">Thanh toán</p>
          <div class="form-row">
            <p>Tổng tiền dịch vụ :</p>
            <div class="input">
              <?php
                echo "<input type='text' name='total_service_amount' placeholder='Không nhập' value='".number_format($court_order[3], 0, ',', '.')."'>";
              ?>
            </div>
          </div>
          <div class="form-row">
            <p>Tổng tiền thuê :</p>
            <div class="input">
              <?php
                echo "<input type='text' name='total_rental_amount' placeholder='Không nhập' value='".number_format($court_order[4], 0, ',', '.')."'>";
              ?>
            </div>
          </div>
          <div class="form-row">
            <p>Tổng tiền giảm giá :</p>
            <div class="input">
              <?php
                echo "<input type='text' name='total_discount_amount' placeholder='Không nhập' value='-".number_format($court_order[5], 0, ',', '.')."'>";
              ?>
            </div>
          </div>
          <div class="form-row">
            <p>Tổng tiền thanh toán :</p>
            <div class="input">
              <?php
                echo "<input type='text' name='order_total_payment' placeholder='Không nhập' value='".number_format($court_order[6], 0, ',', '.')."'>";
              ?>
            </div>
          </div>
          <div class="form-row">
            <p>Tổng tiền cọc (20%) :</p>
            <div class="input">
              <?php
                echo "<input type='text' name='order_total_deposit' placeholder='Không nhập' value='".number_format($court_order[7], 0, ',', '.')."'>";
              ?>
            </div>
          </div>
          <hr>
          <p class="form-body-title">Khách hàng</p>
          <div class="form-row">
            <p>Người đặt :</p>
            <div class="input" style='display: flex; gap: 10px; align-items: center;'>
              <?php
                echo "<img src='";
                foreach ($accounts as $account) {
                  if ($account->getAccountId() == $court_order[10]) {
                    echo "/NTP-Sports-Hub" . $account->getAccountAvatar();
                  }
                }
                echo "' alt='customer avatar' style='border-radius: 50%; width: 28px; height: 28px;'>";
                echo "<input type='text' name='customer_name' id='customer_name' value='";
                foreach ($accounts as $account) {
                  if ($account->getAccountId() == $court_order[10]) {
                    foreach ($customers as $customer) {
                      if ($customer->getAccountId() == $account->getAccountId()) {
                        echo $customer->getCustomerFullname();
                      }
                    }
                  }
                }
                echo "'>";
              ?>
            </div>
          </div>
          <div class="form-row">
            <p>Số điện thoại :</p>
            <div class="input">
              <?php
                echo "<input type='text' name='customer_phone_number' id='customer_phone_number' value='";
                foreach ($accounts as $account) {
                  if ($account->getAccountId() == $court_order[10]) {
                    foreach ($customers as $customer) {
                      if ($customer->getAccountId() == $account->getAccountId()) {
                        echo $customer->getCustomerPhoneNumber();
                      }
                    }
                  }
                }
                echo "'>";
              ?>
            </div>
          </div>
          <hr>
          <p class="form-body-title">Thông tin khác</p>
          <div class="form-row">
            <p>Trạng thái đơn :</p>
            <div class="input">
              <?php echo "<input type='text' name='order_state' placeholder='Không nhập' value='".$court_order[9]."'>";?>
            </div>
          </div>
          <div class="form-row">
            <p>Ngày đặt :</p>
            <div class="input">
              <?php echo "<input type='text' name='ordered_date' placeholder='Không nhập' value='".date("d/m/Y", strtotime($court_order[14]))."'>";?>
            </div>
          </div>
        </div>
      </div>
      <div class="form-footer">
        <div class="button-group">
          <a class="form-button" id="form-process" href="<?php echo '?option=confirm_process_payment_court_order&court_order_id='.urlencode($court_order[0]); ?>">
            <img src="../image/sport-court-orders-management-img/update.svg" alt="process icon">
            <p>Xử lý</p>
          </a>
          <a class="form-button" id="form-cancel" href="<?php echo '?option=reason_cancel_payment_court_order&court_order_id='.urlencode($court_order[0]).'&court_schedule_id='.urlencode($court_order[1]); ?>">
            <img src="../image/sport-court-orders-management-img/delete.svg" alt="delete icon">
            <p>Hủy đơn</p>
          </a>
        </div>
      </div>
    </form>
    <!-- FORM XEM ĐƠN ĐẶT SÂN CÓ TRẠNG THÁI "CHỜ NHẬN SÂN" -->
    <form id="form-view-receive" action="" method="post" enctype="multipart/form-data">
      <div class="form-header">
        <p>Thông tin đơn đặt sân sân</p>
        <a href="?option=court_order_exit">
          <img src="../image/sport-court-orders-management-img/close.svg" alt="close">
        </a>
      </div>
      <div class="form-body">
        <div class="form-body-content">
          <p class="form-body-title">Thông tin chung</p>
          <div class="form-row">
            <p>Mã đơn đặt sân :</p>
            <div class="input">
              <?php
                $court_order = $court_order_controller->view_specific_court_order();
                echo "<input type='text' name='court_order_id' placeholder='Không nhập' value='".$court_order[0]."'>";
              ?>
            </div>
          </div>
          <div class="form-row">
            <p>Tên sân :</p>
            <div class="input">
              <?php
                echo "<input type='text' name='court_name' id='court_name' value='";
                foreach ($court_schedules as $court_schedule) {
                  if ($court_order[1] == $court_schedule->getCourtScheduleId()) {
                    foreach ($courts as $court) {
                      if ($court->getCourtId() == $court_schedule->getCourtId()) {
                        echo $court->getCourtName();
                      }
                    }
                  }
                }
                echo "'>";
              ?>
            </div>
          </div>
          <div class="form-row">
            <p>Loại sân :</p>
            <div class="input">
              <?php
                echo "<input type='text' name='court_type' id='court_type' value='";
                foreach ($court_schedules as $court_schedule) {
                  if ($court_order[1] == $court_schedule->getCourtScheduleId()) {
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
                echo "'>";
              ?>
            </div>
          </div>
          <div class="form-row">
            <p>Ngày nhận sân :</p>
            <div class="input">
              <?php
                echo "<input type='text' name='court_schedule_date' id='court_schedule_date' value='";
                foreach ($court_schedules as $court_schedule) {
                  if ($court_order[1] == $court_schedule->getCourtScheduleId()) {
                    echo date("d/m/Y", strtotime($court_schedule->getCourtScheduleDate()));
                  }
                }
                echo "'>";
              ?>
            </div>
          </div>
          <div class="form-row">
            <p>Khung giờ :</p>
            <div class="input">
              <?php
                echo "<input type='text' name='court_schedule_date' id='court_schedule_date' value='";
                foreach ($court_schedules as $court_schedule) {
                  if ($court_order[1] == $court_schedule->getCourtScheduleId()) {
                    echo $court_schedule->getCourtScheduleTimeFrame();
                  }
                }
                echo "'>";
              ?>
            </div>
          </div>
          <hr>
          <p class="form-body-title">Thanh toán</p>
          <div class="form-row">
            <p>Tổng tiền dịch vụ :</p>
            <div class="input">
              <?php
                echo "<input type='text' name='total_service_amount' placeholder='Không nhập' value='".number_format($court_order[3], 0, ',', '.')."'>";
              ?>
            </div>
          </div>
          <div class="form-row">
            <p>Tổng tiền thuê :</p>
            <div class="input">
              <?php
                echo "<input type='text' name='total_rental_amount' placeholder='Không nhập' value='".number_format($court_order[4], 0, ',', '.')."'>";
              ?>
            </div>
          </div>
          <div class="form-row">
            <p>Tổng tiền giảm giá :</p>
            <div class="input">
              <?php
                echo "<input type='text' name='total_discount_amount' placeholder='Không nhập' value='-".number_format($court_order[5], 0, ',', '.')."'>";
              ?>
            </div>
          </div>
          <div class="form-row">
            <p>Tổng tiền thanh toán :</p>
            <div class="input">
              <?php
                echo "<input type='text' name='order_total_payment' placeholder='Không nhập' value='".number_format($court_order[6], 0, ',', '.')."'>";
              ?>
            </div>
          </div>
          <div class="form-row">
            <p>Tổng tiền cọc (20%) :</p>
            <div class="input">
              <?php
                echo "<input type='text' name='order_total_deposit' placeholder='Không nhập' value='".number_format($court_order[7], 0, ',', '.')."'>";
              ?>
            </div>
          </div>
          <hr>
          <p class="form-body-title">Khách hàng</p>
          <div class="form-row">
            <p>Người đặt :</p>
            <div class="input" style='display: flex; gap: 10px; align-items: center;'>
              <?php
                echo "<img src='";
                foreach ($accounts as $account) {
                  if ($account->getAccountId() == $court_order[10]) {
                    echo "/NTP-Sports-Hub" . $account->getAccountAvatar();
                  }
                }
                echo "' alt='customer avatar' style='border-radius: 50%; width: 28px; height: 28px;'>";
                echo "<input type='text' name='customer_name' id='customer_name' value='";
                foreach ($accounts as $account) {
                  if ($account->getAccountId() == $court_order[10]) {
                    foreach ($customers as $customer) {
                      if ($customer->getAccountId() == $account->getAccountId()) {
                        echo $customer->getCustomerFullname();
                      }
                    }
                  }
                }
                echo "'>";
              ?>
            </div>
          </div>
          <div class="form-row">
            <p>Số điện thoại :</p>
            <div class="input">
              <?php
                echo "<input type='text' name='customer_phone_number' id='customer_phone_number' value='";
                foreach ($accounts as $account) {
                  if ($account->getAccountId() == $court_order[10]) {
                    foreach ($customers as $customer) {
                      if ($customer->getAccountId() == $account->getAccountId()) {
                        echo $customer->getCustomerPhoneNumber();
                      }
                    }
                  }
                }
                echo "'>";
              ?>
            </div>
          </div>
          <hr>
          <p class="form-body-title">Thông tin khác</p>
          <div class="form-row">
            <p>Trạng thái đơn :</p>
            <div class="input">
              <?php echo "<input type='text' name='order_state' placeholder='Không nhập' value='".$court_order[9]."'>";?>
            </div>
          </div>
          <div class="form-row">
            <p>Ngày đặt :</p>
            <div class="input">
              <?php echo "<input type='text' name='ordered_date' placeholder='Không nhập' value='".date("d/m/Y", strtotime($court_order[14]))."'>";?>
            </div>
          </div>
        </div>
      </div>
      <div class="form-footer">
        <div class="button-group">
          <a class="form-button" id="form-process" href="<?php echo '?option=confirm_process_receive_court_order&court_order_id='.urlencode($court_order[0]); ?>">
            <img src="../image/sport-court-orders-management-img/update.svg" alt="process icon">
            <p>Xử lý</p>
          </a>          
          <a class="form-button" id="form-cancel" href="<?php echo '?option=reason_cancel_receive_court_order&court_order_id='.urlencode($court_order[0]).'&court_schedule_id='.urlencode($court_order[1]); ?>">
            <img src="../image/sport-court-orders-management-img/delete.svg" alt="delete icon">
            <p>Hủy đơn</p>
          </a>
        </div>
      </div>
    </form>
    <!-- FORM XEM ĐƠN ĐẶT SÂN CÓ TRẠNG THÁI "HOÀN THÀNH" -->
    <form id="form-view-complete" action="" method="post" enctype="multipart/form-data">
      <div class="form-header">
        <p>Thông tin đơn đặt sân sân</p>
        <a href="?option=court_order_exit">
          <img src="../image/sport-court-orders-management-img/close.svg" alt="close">
        </a>
      </div>
      <div class="form-body">
        <div class="form-body-content">
          <p class="form-body-title">Thông tin chung</p>
          <div class="form-row">
            <p>Mã đơn đặt sân :</p>
            <div class="input">
              <?php
                $court_order = $court_order_controller->view_specific_court_order();
                echo "<input type='text' name='court_order_id' placeholder='Không nhập' value='".$court_order[0]."'>";
              ?>
            </div>
          </div>
          <div class="form-row">
            <p>Tên sân :</p>
            <div class="input">
              <?php
                echo "<input type='text' name='court_name' id='court_name' value='";
                foreach ($court_schedules as $court_schedule) {
                  if ($court_order[1] == $court_schedule->getCourtScheduleId()) {
                    foreach ($courts as $court) {
                      if ($court->getCourtId() == $court_schedule->getCourtId()) {
                        echo $court->getCourtName();
                      }
                    }
                  }
                }
                echo "'>";
              ?>
            </div>
          </div>
          <div class="form-row">
            <p>Loại sân :</p>
            <div class="input">
              <?php
                echo "<input type='text' name='court_type' id='court_type' value='";
                foreach ($court_schedules as $court_schedule) {
                  if ($court_order[1] == $court_schedule->getCourtScheduleId()) {
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
                echo "'>";
              ?>
            </div>
          </div>
          <div class="form-row">
            <p>Ngày nhận sân :</p>
            <div class="input">
              <?php
                echo "<input type='text' name='court_schedule_date' id='court_schedule_date' value='";
                foreach ($court_schedules as $court_schedule) {
                  if ($court_order[1] == $court_schedule->getCourtScheduleId()) {
                    echo date("d/m/Y", strtotime($court_schedule->getCourtScheduleDate()));
                  }
                }
                echo "'>";
              ?>
            </div>
          </div>
          <div class="form-row">
            <p>Khung giờ :</p>
            <div class="input">
              <?php
                echo "<input type='text' name='court_schedule_date' id='court_schedule_date' value='";
                foreach ($court_schedules as $court_schedule) {
                  if ($court_order[1] == $court_schedule->getCourtScheduleId()) {
                    echo $court_schedule->getCourtScheduleTimeFrame();
                  }
                }
                echo "'>";
              ?>
            </div>
          </div>
          <hr>
          <p class="form-body-title">Thanh toán</p>
          <div class="form-row">
            <p>Tổng tiền dịch vụ :</p>
            <div class="input">
              <?php
                echo "<input type='text' name='total_service_amount' placeholder='Không nhập' value='".number_format($court_order[3], 0, ',', '.')."'>";
              ?>
            </div>
          </div>
          <div class="form-row">
            <p>Tổng tiền thuê :</p>
            <div class="input">
              <?php
                echo "<input type='text' name='total_rental_amount' placeholder='Không nhập' value='".number_format($court_order[4], 0, ',', '.')."'>";
              ?>
            </div>
          </div>
          <div class="form-row">
            <p>Tổng tiền giảm giá :</p>
            <div class="input">
              <?php
                echo "<input type='text' name='total_discount_amount' placeholder='Không nhập' value='-".number_format($court_order[5], 0, ',', '.')."'>";
              ?>
            </div>
          </div>
          <div class="form-row">
            <p>Tổng tiền thanh toán :</p>
            <div class="input">
              <?php
                echo "<input type='text' name='order_total_payment' placeholder='Không nhập' value='".number_format($court_order[6], 0, ',', '.')."'>";
              ?>
            </div>
          </div>
          <div class="form-row">
            <p>Tổng tiền cọc (20%) :</p>
            <div class="input">
              <?php
                echo "<input type='text' name='order_total_deposit' placeholder='Không nhập' value='".number_format($court_order[7], 0, ',', '.')."'>";
              ?>
            </div>
          </div>
          <hr>
          <p class="form-body-title">Khách hàng</p>
          <div class="form-row">
            <p>Người đặt :</p>
            <div class="input" style='display: flex; gap: 10px; align-items: center;'>
              <?php
                echo "<img src='";
                foreach ($accounts as $account) {
                  if ($account->getAccountId() == $court_order[10]) {
                    echo "/NTP-Sports-Hub" . $account->getAccountAvatar();
                  }
                }
                echo "' alt='customer avatar' style='border-radius: 50%; width: 28px; height: 28px;'>";
                echo "<input type='text' name='customer_name' id='customer_name' value='";
                foreach ($accounts as $account) {
                  if ($account->getAccountId() == $court_order[10]) {
                    foreach ($customers as $customer) {
                      if ($customer->getAccountId() == $account->getAccountId()) {
                        echo $customer->getCustomerFullname();
                      }
                    }
                  }
                }
                echo "'>";
              ?>
            </div>
          </div>
          <div class="form-row">
            <p>Số điện thoại :</p>
            <div class="input">
              <?php
                echo "<input type='text' name='customer_phone_number' id='customer_phone_number' value='";
                foreach ($accounts as $account) {
                  if ($account->getAccountId() == $court_order[10]) {
                    foreach ($customers as $customer) {
                      if ($customer->getAccountId() == $account->getAccountId()) {
                        echo $customer->getCustomerPhoneNumber();
                      }
                    }
                  }
                }
                echo "'>";
              ?>
            </div>
          </div>
          <hr>
          <p class="form-body-title">Thông tin khác</p>
          <div class="form-row">
            <p>Trạng thái đơn :</p>
            <div class="input">
              <?php echo "<input type='text' name='order_state' placeholder='Không nhập' value='".$court_order[9]."'>";?>
            </div>
          </div>
          <div class="form-row">
            <p>Ngày đặt :</p>
            <div class="input">
              <?php echo "<input type='text' name='ordered_date' placeholder='Không nhập' value='".date("d/m/Y", strtotime($court_order[14]))."'>";?>
            </div>
          </div>
        </div>
      </div>
      <div class="form-footer">
        <div class="button-group">
          <a class="form-button" id="form-exit" href="?option=court_order_exit">
            <img src="../image/sport-court-orders-management-img/delete.svg" alt="exit icon">
            <p>Thoát</p>
          </a>
        </div>
      </div>
    </form>
    <!-- FORM XEM ĐƠN ĐẶT SÂN CÓ TRẠNG THÁI "ĐÃ HỦY" -->
    <form id="form-view-canceled" action="" method="post" enctype="multipart/form-data">
      <div class="form-header">
        <p>Thông tin đơn đặt sân sân</p>
        <a href="?option=court_order_exit">
          <img src="../image/sport-court-orders-management-img/close.svg" alt="close">
        </a>
      </div>
      <div class="form-body">
        <div class="form-body-content">
          <p class="form-body-title">Thông tin chung</p>
          <div class="form-row">
            <p>Mã đơn đặt sân :</p>
            <div class="input">
              <?php
                $court_order = $court_order_controller->view_specific_court_order();
                echo "<input type='text' name='court_order_id' placeholder='Không nhập' value='".$court_order[0]."'>";
              ?>
            </div>
          </div>
          <div class="form-row">
            <p>Tên sân :</p>
            <div class="input">
              <?php
                echo "<input type='text' name='court_name' id='court_name' value='";
                foreach ($court_schedules as $court_schedule) {
                  if ($court_order[1] == $court_schedule->getCourtScheduleId()) {
                    foreach ($courts as $court) {
                      if ($court->getCourtId() == $court_schedule->getCourtId()) {
                        echo $court->getCourtName();
                      }
                    }
                  }
                }
                echo "'>";
              ?>
            </div>
          </div>
          <div class="form-row">
            <p>Loại sân :</p>
            <div class="input">
              <?php
                echo "<input type='text' name='court_type' id='court_type' value='";
                foreach ($court_schedules as $court_schedule) {
                  if ($court_order[1] == $court_schedule->getCourtScheduleId()) {
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
                echo "'>";
              ?>
            </div>
          </div>
          <div class="form-row">
            <p>Ngày nhận sân :</p>
            <div class="input">
              <?php
                echo "<input type='text' name='court_schedule_date' id='court_schedule_date' value='";
                foreach ($court_schedules as $court_schedule) {
                  if ($court_order[1] == $court_schedule->getCourtScheduleId()) {
                    echo date("d/m/Y", strtotime($court_schedule->getCourtScheduleDate()));
                  }
                }
                echo "'>";
              ?>
            </div>
          </div>
          <div class="form-row">
            <p>Khung giờ :</p>
            <div class="input">
              <?php
                echo "<input type='text' name='court_schedule_date' id='court_schedule_date' value='";
                foreach ($court_schedules as $court_schedule) {
                  if ($court_order[1] == $court_schedule->getCourtScheduleId()) {
                    echo $court_schedule->getCourtScheduleTimeFrame();
                  }
                }
                echo "'>";
              ?>
            </div>
          </div>
          <hr>
          <p class="form-body-title">Thanh toán</p>
          <div class="form-row">
            <p>Tổng tiền dịch vụ :</p>
            <div class="input">
              <?php
                echo "<input type='text' name='total_service_amount' placeholder='Không nhập' value='".number_format($court_order[3], 0, ',', '.')."'>";
              ?>
            </div>
          </div>
          <div class="form-row">
            <p>Tổng tiền thuê :</p>
            <div class="input">
              <?php
                echo "<input type='text' name='total_rental_amount' placeholder='Không nhập' value='".number_format($court_order[4], 0, ',', '.')."'>";
              ?>
            </div>
          </div>
          <div class="form-row">
            <p>Tổng tiền giảm giá :</p>
            <div class="input">
              <?php
                echo "<input type='text' name='total_discount_amount' placeholder='Không nhập' value='-".number_format($court_order[5], 0, ',', '.')."'>";
              ?>
            </div>
          </div>
          <div class="form-row">
            <p>Tổng tiền thanh toán :</p>
            <div class="input">
              <?php
                echo "<input type='text' name='order_total_payment' placeholder='Không nhập' value='".number_format($court_order[6], 0, ',', '.')."'>";
              ?>
            </div>
          </div>
          <div class="form-row">
            <p>Tổng tiền cọc (20%) :</p>
            <div class="input">
              <?php
                echo "<input type='text' name='order_total_deposit' placeholder='Không nhập' value='".number_format($court_order[7], 0, ',', '.')."'>";
              ?>
            </div>
          </div>
          <hr>
          <p class="form-body-title">Khách hàng</p>
          <div class="form-row">
            <p>Người đặt :</p>
            <div class="input" style='display: flex; gap: 10px; align-items: center;'>
              <?php
                echo "<img src='";
                foreach ($accounts as $account) {
                  if ($account->getAccountId() == $court_order[10]) {
                    echo "/NTP-Sports-Hub" . $account->getAccountAvatar();
                  }
                }
                echo "' alt='customer avatar' style='border-radius: 50%; width: 28px; height: 28px;'>";
                echo "<input type='text' name='customer_name' id='customer_name' value='";
                foreach ($accounts as $account) {
                  if ($account->getAccountId() == $court_order[10]) {
                    foreach ($customers as $customer) {
                      if ($customer->getAccountId() == $account->getAccountId()) {
                        echo $customer->getCustomerFullname();
                      }
                    }
                  }
                }
                echo "'>";
              ?>
            </div>
          </div>
          <div class="form-row">
            <p>Số điện thoại :</p>
            <div class="input">
              <?php
                echo "<input type='text' name='customer_phone_number' id='customer_phone_number' value='";
                foreach ($accounts as $account) {
                  if ($account->getAccountId() == $court_order[10]) {
                    foreach ($customers as $customer) {
                      if ($customer->getAccountId() == $account->getAccountId()) {
                        echo $customer->getCustomerPhoneNumber();
                      }
                    }
                  }
                }
                echo "'>";
              ?>
            </div>
          </div>
          <hr>
          <p class="form-body-title">Thông tin khác</p>
          <div class="form-row">
            <p>Trạng thái đơn :</p>
            <div class="input">
              <?php echo "<input type='text' name='order_state' placeholder='Không nhập' value='".$court_order[9]."'>";?>
            </div>
          </div>
          <div class="form-row">
            <p>Ngày đặt :</p>
            <div class="input">
              <?php echo "<input type='text' name='ordered_date' placeholder='Không nhập' value='".date("d/m/Y", strtotime($court_order[14]))."'>";?>
            </div>
          </div>
          <div class="form-row">
            <p>Bên hủy :</p>
            <div class="input">
              <?php 
                if ($court_order[13] == 1) {
                  echo "<input type='text' name='cancel_party' placeholder='Không nhập' value='Khu liên hợp thể thao NTP'>";
                } else {
                  echo "<input type='text' name='cancel_party' placeholder='Không nhập' value='Khách hàng'>";
                }
              ?>
            </div>
          </div>
          <div class="form-row">
            <p>Lý do hủy :</p>
            <div class="input">
              <?php echo "<div style='color: #000; font-size: 14px; font-style: normal; font-weight: 400; line-height: 22px;'>".$court_order[12]."</div>"; ?>
            </div>
          </div>
          <div class="form-row">
            <p>Ngày hủy :</p>
            <div class="input">
              <?php echo "<input type='text' name='canceled_date' placeholder='Không nhập' value='".date("d/m/Y", strtotime($court_order[15]))."'>";?>
            </div>
          </div>
          <?php
            if ($court_order[13] == 1 && $court_order[12] != "Đơn đặt sân chưa được thanh toán" && $court_order[12] != "Khách hàng không đến nhận sân") {
              echo "
                <div class='form-row'>
                  <p>Ngày hoàn tiền :</p>
                  <div class='input'>
                    <input type='text' name='refunded_date' placeholder='Không nhập' value='".date("d/m/Y", strtotime($court_order[16]))."'>
                  </div>
                </div>
              ";
            }
          ?>
        </div>
      </div>
      <div class="form-footer">
        <div class="button-group">
          <a class="form-button" id="form-exit" href="?option=court_order_exit">
            <img src="../image/sport-court-orders-management-img/delete.svg" alt="exit icon">
            <p>Thoát</p>
          </a>
        </div>
      </div>
    </form>
    <!-- FORM XEM ĐƠN ĐẶT SÂN CÓ TRẠNG THÁI "CHỜ HOÀN TIỀN" -->
    <form id="form-view-refunded" action="" method="post" enctype="multipart/form-data">
      <div class="form-header">
        <p>Thông tin đơn đặt sân sân</p>
        <a href="?option=court_order_exit">
          <img src="../image/sport-court-orders-management-img/close.svg" alt="close">
        </a>
      </div>
      <div class="form-body">
        <div class="form-body-content">
          <p class="form-body-title">Thông tin chung</p>
          <div class="form-row">
            <p>Mã đơn đặt sân :</p>
            <div class="input">
              <?php
                $court_order = $court_order_controller->view_specific_court_order();
                echo "<input type='text' name='court_order_id' placeholder='Không nhập' value='".$court_order[0]."'>";
              ?>
            </div>
          </div>
          <div class="form-row">
            <p>Tên sân :</p>
            <div class="input">
              <?php
                echo "<input type='text' name='court_name' id='court_name' value='";
                foreach ($court_schedules as $court_schedule) {
                  if ($court_order[1] == $court_schedule->getCourtScheduleId()) {
                    foreach ($courts as $court) {
                      if ($court->getCourtId() == $court_schedule->getCourtId()) {
                        echo $court->getCourtName();
                      }
                    }
                  }
                }
                echo "'>";
              ?>
            </div>
          </div>
          <div class="form-row">
            <p>Loại sân :</p>
            <div class="input">
              <?php
                echo "<input type='text' name='court_type' id='court_type' value='";
                foreach ($court_schedules as $court_schedule) {
                  if ($court_order[1] == $court_schedule->getCourtScheduleId()) {
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
                echo "'>";
              ?>
            </div>
          </div>
          <div class="form-row">
            <p>Ngày nhận sân :</p>
            <div class="input">
              <?php
                echo "<input type='text' name='court_schedule_date' id='court_schedule_date' value='";
                foreach ($court_schedules as $court_schedule) {
                  if ($court_order[1] == $court_schedule->getCourtScheduleId()) {
                    echo date("d/m/Y", strtotime($court_schedule->getCourtScheduleDate()));
                  }
                }
                echo "'>";
              ?>
            </div>
          </div>
          <div class="form-row">
            <p>Khung giờ :</p>
            <div class="input">
              <?php
                echo "<input type='text' name='court_schedule_date' id='court_schedule_date' value='";
                foreach ($court_schedules as $court_schedule) {
                  if ($court_order[1] == $court_schedule->getCourtScheduleId()) {
                    echo $court_schedule->getCourtScheduleTimeFrame();
                  }
                }
                echo "'>";
              ?>
            </div>
          </div>
          <hr>
          <p class="form-body-title">Thanh toán</p>
          <div class="form-row">
            <p>Tổng tiền dịch vụ :</p>
            <div class="input">
              <?php
                echo "<input type='text' name='total_service_amount' placeholder='Không nhập' value='".number_format($court_order[3], 0, ',', '.')."'>";
              ?>
            </div>
          </div>
          <div class="form-row">
            <p>Tổng tiền thuê :</p>
            <div class="input">
              <?php
                echo "<input type='text' name='total_rental_amount' placeholder='Không nhập' value='".number_format($court_order[4], 0, ',', '.')."'>";
              ?>
            </div>
          </div>
          <div class="form-row">
            <p>Tổng tiền giảm giá :</p>
            <div class="input">
              <?php
                echo "<input type='text' name='total_discount_amount' placeholder='Không nhập' value='-".number_format($court_order[5], 0, ',', '.')."'>";
              ?>
            </div>
          </div>
          <div class="form-row">
            <p>Tổng tiền thanh toán :</p>
            <div class="input">
              <?php
                echo "<input type='text' name='order_total_payment' placeholder='Không nhập' value='".number_format($court_order[6], 0, ',', '.')."'>";
              ?>
            </div>
          </div>
          <div class="form-row">
            <p>Tổng tiền cọc (20%) :</p>
            <div class="input">
              <?php
                echo "<input type='text' name='order_total_deposit' placeholder='Không nhập' value='".number_format($court_order[7], 0, ',', '.')."'>";
              ?>
            </div>
          </div>
          <hr>
          <p class="form-body-title">Khách hàng</p>
          <div class="form-row">
            <p>Người đặt :</p>
            <div class="input" style='display: flex; gap: 10px; align-items: center;'>
              <?php
                echo "<img src='";
                foreach ($accounts as $account) {
                  if ($account->getAccountId() == $court_order[10]) {
                    echo "/NTP-Sports-Hub" . $account->getAccountAvatar();
                  }
                }
                echo "' alt='customer avatar' style='border-radius: 50%; width: 28px; height: 28px;'>";
                echo "<input type='text' name='customer_name' id='customer_name' value='";
                foreach ($accounts as $account) {
                  if ($account->getAccountId() == $court_order[10]) {
                    foreach ($customers as $customer) {
                      if ($customer->getAccountId() == $account->getAccountId()) {
                        echo $customer->getCustomerFullname();
                      }
                    }
                  }
                }
                echo "'>";
              ?>
            </div>
          </div>
          <div class="form-row">
            <p>Số điện thoại :</p>
            <div class="input">
              <?php
                echo "<input type='text' name='customer_phone_number' id='customer_phone_number' value='";
                foreach ($accounts as $account) {
                  if ($account->getAccountId() == $court_order[10]) {
                    foreach ($customers as $customer) {
                      if ($customer->getAccountId() == $account->getAccountId()) {
                        echo $customer->getCustomerPhoneNumber();
                      }
                    }
                  }
                }
                echo "'>";
              ?>
            </div>
          </div>
          <hr>
          <p class="form-body-title">Thông tin khác</p>
          <div class="form-row">
            <p>Trạng thái đơn :</p>
            <div class="input">
              <?php echo "<input type='text' name='order_state' placeholder='Không nhập' value='".$court_order[9]."'>";?>
            </div>
          </div>
          <div class="form-row">
            <p>Ngày đặt :</p>
            <div class="input">
              <?php echo "<input type='text' name='ordered_date' placeholder='Không nhập' value='".date("d/m/Y", strtotime($court_order[14]))."'>";?>
            </div>
          </div>
          <div class="form-row">
            <p>Bên hủy :</p>
            <div class="input">
              <?php 
                if ($court_order[13] == 1) {
                  echo "<input type='text' name='canceled_party' placeholder='Không nhập' value='Khu liên hợp thể thao NTP'>";
                } else {
                  echo "<input type='text' name='canceled_party' placeholder='Không nhập' value='Khách hàng'>";
                }
              ?>
            </div>
          </div>
          <div class="form-row">
            <p>Lý do hủy :</p>
            <div class="input">
              <?php echo "<div style='color: #000; font-size: 14px; font-style: normal; font-weight: 400; line-height: 22px;'>".$court_order[12]."</div>"; ?>
            </div>
          </div>
          <div class="form-row">
            <p>Ngày hủy :</p>
            <div class="input">
              <?php echo "<input type='text' name='canceled_date' placeholder='Không nhập' value='".date("d/m/Y", strtotime($court_order[15]))."'>";?>
            </div>
          </div>
        </div>
      </div>
      <div class="form-footer">
        <div class="button-group">
          <a class="form-button" id="form-process" href="<?php echo '?option=confirm_process_refunded_court_order&court_order_id='.urlencode($court_order[0]); ?>">
            <img src="../image/sport-court-orders-management-img/update.svg" alt="process icon">
            <p>Xử lý</p>
          </a>          
          <a class="form-button" id="form-exit" href="?option=court_order_exit">
            <img src="../image/sport-court-orders-management-img/delete.svg" alt="exit icon">
            <p>Thoát</p>
          </a>
        </div>
      </div>
    </form>
    <!-- SCRIPT PHP ĐIỀU HƯỚNG THAO TÁC -->
    <?php
      if(isset($_GET['option'])) {
        $_option = $_GET['option'];
        
        echo "
          <script>
            var overlayFrame = document.getElementById('overlay-wrapper');
            overlayFrame.style.display = 'block';
          </script>
        "; 

        if($_option == "view_court_order_detail_state_payment") { 
          echo "
            <script>
              var formPayment = document.getElementById('form-view-payment');
              formPayment.style.display = 'flex';
            </script>
          "; 
        } else if($_option == "view_court_order_detail_state_receive") {
          echo "
            <script>
              var formReceive = document.getElementById('form-view-receive');
              formReceive.style.display = 'flex';
            </script>
          "; 
        } else if($_option == "view_court_order_detail_state_complete") {
          echo "
            <script>
              var formComplete = document.getElementById('form-view-complete');
              formComplete.style.display = 'flex';
            </script>
          "; 
        } else if($_option == "view_court_order_detail_state_canceled") {
          echo "
            <script>
              var formCanceled = document.getElementById('form-view-canceled');
              formCanceled.style.display = 'flex';
            </script>
          "; 
        } else if($_option == "view_court_order_detail_state_refunded") {
          echo "
            <script>
              var formRefunded = document.getElementById('form-view-refunded');
              formRefunded.style.display = 'flex';
            </script>
          "; 
        } else if($_option == "confirm_process_payment_court_order") {
          include "./notification/payment-order-process-confirm.php";
        } else if($_option == "process_payment_court_order") {
          if(isset($_GET['court_order_id'])) {
            $court_order_id = $_GET['court_order_id'];

            $result = $court_order_controller->process_payment_court_order($court_order_id);

            // Kiểm tra giá trị của biến $result
            if ($result) {
              // echo 'The court order has been processed successfully';
              include "./notification/action-successful.php";
              echo "
                <script>
                  var message = document.getElementById('action-successful-message');
                  message.textContent = 'Bạn đã xử lý đơn đặt sân thành công';

                  var btn_back = document.getElementById('admin-management-button');
                  btn_back.textContent = 'Trở về quản lý đơn đặt sân';
                  btn_back.href = './sport-court-orders-management.php';
                  btn_back.style.fontSize = '12.5px';
                </script>
              ";
            } else {
              // echo 'The court order has been processed fail';
              include "./notification/warning.php"; 
              echo "
                <script>
                  var warningQuestion = document.getElementById('warning-question');
                  warningQuestion.textContent ='Bạn đã thực hiện thao tác xử lý đơn đặt sân!';
                  
                  var warningExplanation = document.getElementById('warning-explanation');
                  warningExplanation.textContent = 'Chúng tôi rất tiếc khi thông báo rằng đơn đặt sân đã không được xử lý thành công';

                  var btn_ok = document.getElementById('war-act-ok');
                  btn_ok.href = './sport-court-orders-management.php';
                </script>
              ";
            }   
          }
        } else if($_option == "confirm_process_receive_court_order") {
          include "./notification/receive-order-process-confirm.php";
        } else if($_option == "process_receive_court_order") {
          if(isset($_GET['court_order_id'])) {
            $court_order_id = $_GET['court_order_id'];

            $result = $court_order_controller->process_receive_court_order($court_order_id);

            // Kiểm tra giá trị của biến $result
            if ($result) {
              // echo 'The court order has been processed successfully';
              include "./notification/action-successful.php";
              echo "
                <script>
                  var message = document.getElementById('action-successful-message');
                  message.textContent = 'Bạn đã xử lý đơn đặt sân thành công';

                  var btn_back = document.getElementById('admin-management-button');
                  btn_back.textContent = 'Trở về quản lý đơn đặt sân';
                  btn_back.href = './sport-court-orders-management.php';
                  btn_back.style.fontSize = '12.5px';
                </script>
              ";
            } else {
              // echo 'The court order has been processed fail';
              include "./notification/warning.php"; 
              echo "
                <script>
                  var warningQuestion = document.getElementById('warning-question');
                  warningQuestion.textContent ='Bạn đã thực hiện thao tác xử lý đơn đặt sân!';
                  
                  var warningExplanation = document.getElementById('warning-explanation');
                  warningExplanation.textContent = 'Chúng tôi rất tiếc khi thông báo rằng đơn đặt sân đã không được xử lý thành công';

                  var btn_ok = document.getElementById('war-act-ok');
                  btn_ok.href = './sport-court-orders-management.php';
                </script>
              ";
            } 
          }  
        } else if($_option == "confirm_process_refunded_court_order") {
          include "./notification/refunded-order-process-confirm.php";
        } else if($_option == "process_refunded_court_order") {
          if(isset($_GET['court_order_id'])) {
            $court_order_id = $_GET['court_order_id'];
            $refunded_on_date = date("Y-m-d");

            $result = $court_order_controller->process_refunded_court_order($court_order_id, $refunded_on_date);

            // Kiểm tra giá trị của biến $result
            if ($result) {
              // echo 'The court order has been processed successfully';
              include "./notification/action-successful.php";
              echo "
                <script>
                  var message = document.getElementById('action-successful-message');
                  message.textContent = 'Bạn đã xử lý đơn đặt sân thành công';

                  var btn_back = document.getElementById('admin-management-button');
                  btn_back.textContent = 'Trở về quản lý đơn đặt sân';
                  btn_back.href = './sport-court-orders-management.php';
                  btn_back.style.fontSize = '12.5px';
                </script>
              ";
            } else {
              // echo 'The court order has been processed fail';
              include "./notification/warning.php"; 
              echo "
                <script>
                  var warningQuestion = document.getElementById('warning-question');
                  warningQuestion.textContent ='Bạn đã thực hiện thao tác xử lý đơn đặt sân!';
                  
                  var warningExplanation = document.getElementById('warning-explanation');
                  warningExplanation.textContent = 'Chúng tôi rất tiếc khi thông báo rằng đơn đặt sân đã không được xử lý thành công';

                  var btn_ok = document.getElementById('war-act-ok');
                  btn_ok.href = './sport-court-orders-management.php';
                </script>
              ";
            } 
          }  
        } else if($_option == "reason_cancel_payment_court_order") {
          include "./notification/admin-cancel-reason-payment.php";
        } else if($_option == "reason_cancel_receive_court_order") {
          include "./notification/admin-cancel-reason-receive.php";
        } else if($_option == "cancel_court_order") {
          if(isset($_GET['court_order_id'], $_GET['cancel_reason'], $_GET['court_schedule_id'])) {
            $court_order_id = $_GET['court_order_id'];
            $cancel_reason = $_GET['cancel_reason'];
            $court_schedule_id = $_GET['court_schedule_id'];
            $canceled_on_date = date("Y-m-d");

            $result = $court_order_controller->cancel_court_order($court_order_id, $cancel_reason, $court_schedule_id, $canceled_on_date);

            // Kiểm tra giá trị của biến $result
            if($result) {
              // echo 'The court order has been canceled successfully';
              include "./notification/action-successful.php";
              echo "
                <script>
                  var message = document.getElementById('action-successful-message');
                  message.textContent = 'Bạn đã hủy đơn đặt sân thành công';

                  var btn_back = document.getElementById('admin-management-button');
                  btn_back.textContent = 'Trở về quản lý đơn đặt sân';
                  btn_back.href = './sport-court-orders-management.php';
                  btn_back.style.fontSize = '12.5px';
                </script>
              ";
            } else {
              // echo 'The court order has been canceled fail';
              include "./notification/warning.php"; 
              echo "
                <script>
                  var warningQuestion = document.getElementById('warning-question');
                  warningQuestion.textContent ='Bạn đã thực hiện thao tác hủy đơn đặt sân!';
                  
                  var warningExplanation = document.getElementById('warning-explanation');
                  warningExplanation.textContent = 'Chúng tôi rất tiếc khi thông báo rằng đơn đặt sân đã không được hủy thành công';

                  var btn_ok = document.getElementById('war-act-ok');
                  btn_ok.href = './sport-court-orders-management.php';
                </script>
              ";
            }
          }
        } else if($_option == "court_order_exit") {
          echo "
            <script>
              var overlayFrame = document.getElementById('overlay-wrapper');
              overlayFrame.style.display = 'none';

              var formPayment = document.getElementById('form-view-payment');
              formPayment.style.display = 'none';

              var formReceive = document.getElementById('form-view-receive');
              formReceive.style.display = 'none';

              var formComplete = document.getElementById('form-view-complete');
              formComplete.style.display = 'none';

              var formCanceled = document.getElementById('form-view-canceled');
              formCanceled.style.display = 'none';

              var formRefunded = document.getElementById('form-view-refunded');
              formRefunded.style.display = 'none';
            </script>
          "; 
        }
      }

      if(isset($_POST['cancel_reason'])) {
        if(isset($_POST['court_order_id'])) {
          $cancel_reason = $_POST['cancel_reason'];
          $court_order_id = $_POST['court_order_id'];
          $court_schedule_id = $_POST['court_schedule_id'];

          echo "
            <script>
              var overlayFrame = document.getElementById('overlay-wrapper');
              overlayFrame.style.display = 'block';
            </script>
          "; 

          echo "
          <div class='cancel-container'>
            <div class='main-content'>
              <img src='../image/sport-court-orders-management-img/confirm-cancel.svg' alt='confirm icon'>
              <div class='content'>
                <p id='confirm-question'>Bạn thật sự muốn hủy đơn đặt sân này?</p>";
                  if($cancel_reason != 'Đơn đặt sân chưa được thanh toán' && $cancel_reason != 'Khách hàng không đến nhận sân') {
                    echo "<p id='confirm-explanation'>Đơn đặt sân này sẽ được chuyển trạng thái thành <span style='color: #7836e3;'>CHỜ HOÀN TIỀN</span> nếu bạn hủy nó.</p>";
                  } else {
                    echo "<p id='confirm-explanation'>Đơn đặt sân này sẽ được chuyển trạng thái thành <span style='color: #7836e3;'>ĐÃ HỦY</span> nếu bạn hủy nó.</p>";
                  }
          echo "</div>
            </div>
            <div class='action'>
              <a id='con-act-no' href='./sport-court-orders-management.php'>Không</a>
              <a 
                id='con-act-yes' 
                href='"; 
                  echo "?option=cancel_court_order&court_order_id=" . $court_order_id;
                  echo "&cancel_reason=" . $cancel_reason;
                  echo "&court_schedule_id=" . $court_schedule_id;
          echo "'>Có
              </a>
            </div>
          </div>
          ";
        }
      }
    ?>
  </body>
</html>