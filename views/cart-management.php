<?php session_start(); ?>
<!DOCTYPE html>
<html lang="vi">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Khu liên hợp thể thao Nguyễn Tri Phương</title>
    <link rel="stylesheet" type="text/css" href="../styles/cart-management.css" />
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
    <?php include "../header/customer-cart-header.php"; ?>
    <!-- BODY -->
    <?php
      require_once "../controllers/account-controller.php"; 
      $account_controller = new Account_Controller();

      require_once "../controllers/cart-controller.php"; 
      $cart_controller = new Cart_Controller();

      require_once "../controllers/cart-detail-controller.php"; 
      $cart_detail_controller = new Cart_Detail_Controller();

      require_once "../controllers/cart-service-detail-controller.php"; 
      $cart_service_detail_controller = new Cart_Service_Detail_Controller();

      require_once "../controllers/court-schedule-controller.php"; 
      $court_schedule_controller = new Court_Schedule_Controller();

      require_once "../controllers/court-controller.php"; 
      $court_controller = new Court_Controller();

      require_once "../controllers/court-image-controller.php"; 
      $court_image_controller = new Court_Image_Controller();

      require_once "../controllers/court-type-controller.php"; 
      $court_type_controller = new Court_Type_Controller();

      require_once "../controllers/service-controller.php"; 
      $service_controller = new Service_Controller();
    ?>
    <div class="cart-body">
      <?php
        if(isset($_SESSION['username'])) {
          $username = $_SESSION['username'];
          $customer_cart_amount = $account_controller->get_customer_cart_amount($username);
          if($customer_cart_amount[0] == 0) {
            echo "<div class='cart-body-top-content-empty'>";
            echo "<img src='../image/cart-management-img/empty-cart.svg' alt='Hình ảnh giỏ hàng trống'>";
            echo "<p>Bạn chưa thêm lịch sân nào vào giỏ hàng. Giỏ hàng của bạn hiện đang trống...</p>";
            echo "</div>";
          } else {
            echo "<div class='cart-body-top-content'>";
            echo "<table>";
            echo "
              <thead> 
                <tr>
                  <th></th>
                  <th style='max-width: 300px;'>Sân</th>
                  <th>Loại sân</th>
                  <th>Ngày</th>
                  <th>Khung giờ</th>
                  <th style='max-width: 200px;'>Dịch vụ</th>
                  <th>Tiền dịch vụ</th>
                  <th>Tiền thuê</th>
                  <th>Thao tác</th>
                </tr>
              </thead>
            ";

            echo "<tbody>";

            $accounts = $account_controller->view_all_account();
            $carts = $cart_controller->view_all_cart();
            $cart_details = $cart_detail_controller->view_all_cart_detail();
            $cart_service_details = $cart_service_detail_controller->view_all_cart_service_detail();
            $court_schedules = $court_schedule_controller->view_all_court_schedule();
            $courts = $court_controller->view_all_court();
            $court_types = $court_type_controller->view_all_court_type();
            $services = $service_controller->view_all_service();

            if(isset($_SESSION['username'])) {
              $username = $_SESSION['username'];

              foreach($accounts as $account) {
                if($account->getAccountSignUpName() == $username) {
                  foreach($carts as $cart) {
                    if($cart->getAccountId() == $account->getAccountId()) {
                      foreach($cart_details as $cart_detail) {
                        if($cart_detail->getCartId() == $cart->getCartId() - 1) {

                          foreach($court_schedules as $court_schedule) {
                            if($court_schedule->getCourtScheduleId() == $cart_detail->getCourtScheduleId()) {
                              $court_schedule_state = $court_schedule->getCourtScheduleState();
                              if($court_schedule_state == "Đã đặt" || $court_schedule_state == "Hết hạn") {
                                echo "
                                  <tr style='background: #FDE6E6'>
                                  <td><input style='pointer-events: none' type='checkbox' name='cart_id_".$cart_detail->getCartId()."&court_schedule_id_".$cart_detail->getCourtScheduleId()."'</td>
                                ";
                              } else {
                                echo "
                                  <tr style='background: #E8F7FA'>
                                  <td><input style='cursor: pointer' type='checkbox' name='cart_id_".$cart_detail->getCartId()."&court_schedule_id_".$cart_detail->getCourtScheduleId()."'</td>
                                ";
                              }
                            }
                          }

                          echo "<td class='court'>";
                          foreach($court_schedules as $court_schedule) {
                            if($court_schedule->getCourtScheduleId() == $cart_detail->getCourtScheduleId()) {
                              foreach($courts as $court) {
                                if($court->getCourtId() == $court_schedule->getCourtId()) {
                                  $court_first_image = $court_image_controller->get_first_court_image($court->getCourtId()); 
                                  echo "<img src='".$court_first_image[0]."' alt='Hình ảnh sân'>";
                                  echo "<p class='court_name'>".$court->getCourtName()."</p>";
                                }
                              }
                            }
                          }
                          echo "</td>";

                          echo "<td class='p_general_style'>";
                          foreach($court_schedules as $court_schedule) {
                            if($court_schedule->getCourtScheduleId() == $cart_detail->getCourtScheduleId()) {
                              foreach($courts as $court) {
                                if($court->getCourtId() == $court_schedule->getCourtId()) {
                                  foreach($court_types as $court_type) {
                                    if($court_type->getCourtTypeId() == $court->getCourtTypeId())
                                    echo $court_type->getCourtTypeName();
                                  }
                                }
                              }
                            }
                          }
                          echo "</td>";

                          echo "<td class='p_general_style'>";
                          foreach($court_schedules as $court_schedule) {
                            if($court_schedule->getCourtScheduleId() == $cart_detail->getCourtScheduleId()) {
                              echo $court_schedule->getCourtScheduleDate();
                            }
                          }
                          echo "</td>";

                          echo "<td class='p_general_style'>";
                          foreach($court_schedules as $court_schedule) {
                            if($court_schedule->getCourtScheduleId() == $cart_detail->getCourtScheduleId()) {
                              echo $court_schedule->getCourtScheduleTimeFrame();
                            }
                          }
                          echo "</td>";

                          echo "<td class='service_details'>";
                          foreach($cart_service_details as $cart_service_detail) {
                            if($cart_service_detail->getCartId() == $cart_detail->getCartId() && $cart_service_detail->getCourtScheduleId() == $cart_detail->getCourtScheduleId()) {
                              foreach($services as $service) {
                                if($service->getServiceId() == $cart_service_detail->getServiceId()) {
                                  // echo "<div class='service_detail_wrapper'>";
                                  echo "<div class='service_detail'>";
                                  echo "<p>".$service->getServiceName()."<span> &nbsp;(".$cart_service_detail->getCartItemServiceQuantity().")</span></p>";
                                  echo "
                                    <div class='arr-gr'>
                                      <img src='../image/cart-management-img/up-arrow.svg' alt='up arrow'>
                                      <img src='../image/cart-management-img/down-arrow.svg' alt='down arrow'>
                                    </div>
                                  ";
                                  echo "<img src='../image/cart-management-img/red-x.svg' alt='delete service button'>";
                                  echo "</div>";
                                  // echo "</div>";
                                }
                              }
                            }
                          }
                          echo "</td>";

                          echo "<td class='money'>đ".number_format($cart_detail->getCartItemServiceAmount(), 0, ',', '.')."</td>";

                          echo "<td class='money'>đ".number_format($cart_detail->getCartItemRentalAmount(), 0, ',', '.')."</td>";

                          echo "
                            <td class='btn-delete'>
                                <a href='?option=confirm_delete_cart_detail&cart_id=".$cart_detail->getCartId()."&court_schedule_id=".$cart_detail->getCourtScheduleId()."'>
                                  <img src='../image/cart-management-img/white-x.svg' alt='delete icon'>
                                  <p>Xóa</p>
                                </a>
                            </td>
                          ";

                          echo "</tr>";
                        }
                      }
                    }
                  }
                }
              }
            }
            
            echo "</tbody>";
            echo "</table>";
            echo "</div>";
          }
        }
      ?>
      <div class="warning">
        <p id="warning-message">Lưu ý: Mỗi lần đặt, chỉ được chọn và đặt một lịch sân</p>
      </div>
      <div class="cart-body-bottom-content"></div>
    </div>
    <!-- FOOTER -->
    <?php include "../footer/footer.php"; ?>
    <script type="text/javascript" src="../scripts/cart-management.js" language="javascript"></script>
  </body>
</html>
