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
    <div id="overlay-wrapper"></div>
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

      require_once "../controllers/event-controller.php"; 
      $event_controller = new Event_Controller();
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
            echo "<div class='cart-body-container'>";
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
                  <th style='max-width: 150px;'>Dịch vụ</th>
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
            $events = $event_controller->view_all_event();

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
                                  <tr class='unavailable_cart_detail' style='background: #FDE6E6'>
                                  <td><input id='cart_id_".$cart_detail->getCartId()."_court_schedule_id_".$cart_detail->getCourtScheduleId()."' style='pointer-events: none' type='checkbox' name='cart_id_".$cart_detail->getCartId()."_court_schedule_id_".$cart_detail->getCourtScheduleId()."' onclick='updateURL(this)'></td>
                                ";
                              } else {
                                echo "
                                  <tr class='available_cart_detail' style='background: #E8F7FA'>
                                  <td><input id='cart_id_".$cart_detail->getCartId()."_court_schedule_id_".$cart_detail->getCourtScheduleId()."' style='cursor: pointer' type='checkbox' name='cart_id_".$cart_detail->getCartId()."_court_schedule_id_".$cart_detail->getCourtScheduleId()."' onclick='updateURL(this)'></td>
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
                              foreach($court_schedules as $court_schedule) {
                                if($court_schedule->getCourtScheduleId() == $cart_service_detail->getCourtScheduleId()) {
                                  $court_schedule_state = $court_schedule->getCourtScheduleState();
                                  if($court_schedule_state == "Đã đặt" || $court_schedule_state == "Hết hạn") {
                                    foreach($services as $service) {
                                      if($service->getServiceId() == $cart_service_detail->getServiceId()) {
                                        echo "<div class='service_detail'>";
                                        echo "<p>".$service->getServiceName()."<span> &nbsp;(".$cart_service_detail->getCartItemServiceQuantity().")</span></p>";
                                        echo "</div>";
                                      }
                                    }
                                  } else {
                                    foreach($services as $service) {
                                      if($service->getServiceId() == $cart_service_detail->getServiceId()) {
                                        echo "<div class='service_detail'>";
                                        echo "<p>".$service->getServiceName()."<span> &nbsp;(".$cart_service_detail->getCartItemServiceQuantity().")</span></p>";
                                        echo "
                                          <div class='arr-gr'>
                                            <a style='display: flex;' href='?option=increase_service_detail&cart_id=".$cart_detail->getCartId()."&court_schedule_id=".$cart_detail->getCourtScheduleId()."&service_id=".$cart_service_detail->getServiceId()."'>
                                              <img src='../image/cart-management-img/up-arrow.svg' alt='up arrow'>
                                            </a>
                                            <a style='display: flex;' href='?option=decrease_service_detail&cart_id=".$cart_detail->getCartId()."&court_schedule_id=".$cart_detail->getCourtScheduleId()."&service_id=".$cart_service_detail->getServiceId()."'>
                                              <img src='../image/cart-management-img/down-arrow.svg' alt='down arrow'>
                                            </a>
                                          </div>
                                        ";
                                        echo "
                                          <a style='display: flex;' href='?option=delete_service_detail&cart_id=".$cart_detail->getCartId()."&court_schedule_id=".$cart_detail->getCourtScheduleId()."&service_id=".$cart_service_detail->getServiceId()."'>
                                            <img src='../image/cart-management-img/red-x.svg' alt='delete service button'>
                                          </a>
                                        ";
                                        echo "</div>";
                                      }
                                    }
                                  }
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
            echo "</div>";
          }
        }
      ?>
      <div class="warning">
        <p id="warning-message">Lưu ý: Mỗi lần đặt, chỉ được chọn và đặt một lịch sân</p>
      </div>
      <div id="cart-body-bottom-content">
        <div class="cart_body_bottom_wrapper">
          <form id="service_form" action="?option=insert_service_detail" method="post" enctype="multipart/form-data">
            <p id="service_pick">Chọn dịch vụ</p>
            <div class="service_action_group">
              <div class="service_select">
                <img src="../image/cart-management-img/service_db.svg" alt="service icon">
                <select name="service_id_and_price" id="service_id">
                  <option value="0">Dịch vụ</option>
                  <?php
                    if(isset($_GET['cart_id']) && isset($_GET['court_schedule_id'])) {
                      foreach($court_schedules as $court_schedule) {
                        if($court_schedule->getCourtScheduleId() == $_GET['court_schedule_id']) {
                          foreach($courts as $court) {
                            if($court->getCourtId() == $court_schedule->getCourtId()) {
                              foreach($court_types as $court_type) {
                                if($court_type->getCourtTypeId() == $court->getCourtTypeId()) {
                                  foreach($services as $service) {
                                    if($service->getCourtTypeId() == $court_type->getCourtTypeId()) {
                                      echo "<option value='".$service->getServiceId()."_".$service->getServicePrice()."'>".$service->getServiceName()." (đ".number_format($service->getServicePrice(), 0, ',', '.').")</option>";
                                    }
                                  }
                                }
                              }
                            }
                          }
                        }
                      }
                    } else {
                      echo "<option value='-1'>Hãy chọn lịch sân</option>";
                    }
                  ?>
                </select>
              </div>
              <div class="service_quantity">
                <div class="service_quantity_left">
                  <p>Số lượng:</p>
                  <input type="number" name="service_quantity" value="0">
                </div>
              </div>
            </div>
            <?php
              if(isset($_GET['cart_id']) && isset($_GET['court_schedule_id'])) {
                echo "
                  <input style='display: none;' type='text' name='cart_id' value='".$_GET['cart_id']."'>
                  <input style='display: none;' type='text' name='court_schedule_id' value='".$_GET['court_schedule_id']."'>
                ";
              }
            ?>
            <input id="insert_service_btn" type="submit" value="Thêm dịch vụ">
          </form>
          <form id="event_form" action="" method="post" enctype="multipart/form-data">
            <p>Chọn sự kiện</p>
            <div class="event_action_group">
              <div class="event_select">
                <img src="../image/cart-management-img/service_db.svg" alt="event icon">
                <select name="event_id" id="event_id">
                  <option value="0">Sự kiện</option>
                  <?php
                    if(isset($_POST["event_id"])) {
                      foreach($events as $event) {
                        if($event->getEventId() == $_POST["event_id"]) {
                          echo "<option value='".$event->getEventId()."' selected>".$event->getEventName()." (-".$event->getEventPreferentialRate()."%)</option>";
                        }
                      }
                    } else {
                      foreach($events as $event) {
                        echo "<option value='".$event->getEventId()."'>".$event->getEventName()." (-".$event->getEventPreferentialRate()."%)</option>";
                      }
                    }
                  ?>
                </select>
              </div>
            </div>
            <input id="pick_event_btn" type="submit" value="Áp dụng sự kiện">
          </form>
        </div>
        <hr>
        <form id="book_court_form" action="./book-sports-courts.php" method="post" enctype="multipart/form-data">
        <?php if(isset($_POST['event_id'])): ?>
            <input type="text" style="display:none" name="event_id1" value="<?php echo $_POST['event_id'] ?>">
        <?php endif; ?>
          <div id="payment_details">
            <div class="payment_details_top">
              <div class="service_total_amount">
                <p>Tổng Tiền Dịch Vụ:</p>
                <?php
                  if(isset($_GET['cart_id']) && isset($_GET['court_schedule_id'])) {
                    foreach($cart_details as $cart_detail) {
                      if($cart_detail->getCartId() == $_GET['cart_id'] && $cart_detail->getCourtScheduleId()== $_GET['court_schedule_id']) {
                        echo "<input type='text' name='service_total_amount' value='đ".number_format($cart_detail->getCartItemServiceAmount(), 0, ',', '.')."'>";
                      }
                    }
                  } else {
                    echo "<input type='text' name='service_total_amount' value='đ0'>";
                  }
                ?>
              </div>
              <div class="rental_total_amount">
                <p>Tổng Tiền Thuê:</p>
                <?php
                  if(isset($_GET['cart_id']) && isset($_GET['court_schedule_id'])) {
                    foreach($cart_details as $cart_detail) {
                      if($cart_detail->getCartId() == $_GET['cart_id'] && $cart_detail->getCourtScheduleId()== $_GET['court_schedule_id']) {
                        echo "<input type='text' name='rental_total_amount' value='đ".number_format($cart_detail->getCartItemRentalAmount(), 0, ',', '.')."'>";
                      }
                    }
                  } else {
                    echo "<input type='text' name='rental_total_amount' value='đ0'>";
                  }
                ?>
              </div>
              <div class="discount_amount">
                <p>Tổng Tiền Giảm Giá:</p>
                <?php
                  $cartItemServiceAmount = 0;
                  $cartItemRentalAmount = 0;
                  $eventPreferentialRate = 0;
                  $discountAmount = 0;

                  if(isset($_GET['cart_id']) && isset($_GET['court_schedule_id'])) {
                    foreach($cart_details as $cart_detail) {
                      if($cart_detail->getCartId() == $_GET['cart_id'] && $cart_detail->getCourtScheduleId()== $_GET['court_schedule_id']) {
                        $cartItemServiceAmount = $cart_detail->getCartItemServiceAmount();
                      }
                    }
                  } 

                  if(isset($_GET['cart_id']) && isset($_GET['court_schedule_id'])) {
                    foreach($cart_details as $cart_detail) {
                      if($cart_detail->getCartId() == $_GET['cart_id'] && $cart_detail->getCourtScheduleId()== $_GET['court_schedule_id']) {
                        $cartItemRentalAmount = $cart_detail->getCartItemRentalAmount();
                      }
                    }
                  }

                  if(isset($_POST["event_id"])) {
                    $event_id = $_POST["event_id"];
                    

                    foreach($events as $event) {
                      if($event->getEventId() == $event_id) {
                        $eventPreferentialRate = $event->getEventPreferentialRate();
                        $discountAmount = ($cartItemServiceAmount + $cartItemRentalAmount) * $eventPreferentialRate / 100;
                        echo "<input type='text' name='discount_amount' value='đ".number_format($discountAmount, 0, ',', '.')."'>";
                      }
                    }
                  } else {
                    echo "<input type='text' name='discount_amount' value='đ0'>";
                  }
                ?>
              </div>
              <div class="deposit_amount">
                <p>Tổng Tiền Cọc:</p>
                <?php
                  $cartItemServiceAmount = 0;
                  $cartItemRentalAmount = 0;
                  $eventPreferentialRate = 0;
                  $discountAmount = 0;

                  if(isset($_GET['cart_id']) && isset($_GET['court_schedule_id'])) {
                    foreach($cart_details as $cart_detail) {
                      if($cart_detail->getCartId() == $_GET['cart_id'] && $cart_detail->getCourtScheduleId()== $_GET['court_schedule_id']) {
                        $cartItemServiceAmount = $cart_detail->getCartItemServiceAmount();
                      }
                    }
                  } 

                  if(isset($_GET['cart_id']) && isset($_GET['court_schedule_id'])) {
                    foreach($cart_details as $cart_detail) {
                      if($cart_detail->getCartId() == $_GET['cart_id'] && $cart_detail->getCourtScheduleId()== $_GET['court_schedule_id']) {
                        $cartItemRentalAmount = $cart_detail->getCartItemRentalAmount();
                      }
                    }
                  }

                  if(isset($_POST["event_id"])) {
                    $event_id = $_POST["event_id"];

                    foreach($events as $event) {
                      if($event->getEventId() == $event_id) {
                        $eventPreferentialRate = $event->getEventPreferentialRate();
                        $discountAmount = ($cartItemServiceAmount + $cartItemRentalAmount) * $eventPreferentialRate / 100;
                      }
                    }
                  } else {
                    $discountAmount = 0;
                  }

                  $depositAmount = ($cartItemServiceAmount + $cartItemRentalAmount - $discountAmount) * 20 / 100;

                  echo "<input type='text' name='deposit_amount' value='đ".number_format($depositAmount, 0, ',', '.')."'>";
                ?>
              </div>
            </div>
            <div class="payment_details_bottom">
              <div class="total_payment_amount">
                <p>Tổng Tiền Thanh Toán:</p>
                <?php
                  $cartItemServiceAmount = 0;
                  $cartItemRentalAmount = 0;
                  $eventPreferentialRate = 0;
                  $discountAmount = 0;

                  if(isset($_GET['cart_id']) && isset($_GET['court_schedule_id'])) {
                    foreach($cart_details as $cart_detail) {
                      if($cart_detail->getCartId() == $_GET['cart_id'] && $cart_detail->getCourtScheduleId()== $_GET['court_schedule_id']) {
                        $cartItemServiceAmount = $cart_detail->getCartItemServiceAmount();
                      }
                    }
                  } 

                  if(isset($_GET['cart_id']) && isset($_GET['court_schedule_id'])) {
                    foreach($cart_details as $cart_detail) {
                      if($cart_detail->getCartId() == $_GET['cart_id'] && $cart_detail->getCourtScheduleId()== $_GET['court_schedule_id']) {
                        $cartItemRentalAmount = $cart_detail->getCartItemRentalAmount();
                      }
                    }
                  }

                  if(isset($_POST["event_id"])) {
                    $event_id = $_POST["event_id"];

                    foreach($events as $event) {
                      if($event->getEventId() == $event_id) {
                        $eventPreferentialRate = $event->getEventPreferentialRate();
                        $discountAmount = ($cartItemServiceAmount + $cartItemRentalAmount) * $eventPreferentialRate / 100;
                      }
                    }
                  } else {
                    $discountAmount = 0;
                  }

                  $total_payment_amount = $cartItemServiceAmount + $cartItemRentalAmount - $discountAmount;

                  echo "<input type='text' name='total_payment_amount' value='đ".number_format($total_payment_amount, 0, ',', '.')."'>";
                ?>
              </div>
              <input id="btn-book" type="submit" value="Đặt Ngay">
            </div>
          </div>
          <?php
            if(isset($_GET['cart_id']) && isset($_GET['court_schedule_id'])) {
              echo "
                <input style='display: none;' type='text' name='cart_id' value='".$_GET['cart_id']."'>
                <input style='display: none;' type='text' name='court_schedule_id' value='".$_GET['court_schedule_id']."'>
              ";
            }
          ?>
        </form>
      </div>
    </div>
    <!-- FOOTER -->
    <?php include "../footer/footer.php"; ?>
    <script type="text/javascript" src="../scripts/cart-management.js" language="javascript"></script>
    <!-- SCRIPT PHP ĐIỀU HƯỚNG THAO TÁC -->
    <?php
      if(isset($_GET['option'])) {
        $_option = $_GET['option']; 

        if($_option == "confirm_delete_cart_detail") { 
          echo "
            <script>
              var overlayFrame = document.getElementById('overlay-wrapper');
              overlayFrame.style.display = 'block';
            </script>
          ";
          include "./notification/cart-detail-delete-confirmation.php";
        } else if($_option == "delete_cart_detail") {
          if(isset($_GET['cart_id']) && isset($_GET['court_schedule_id'])) {
            $cart_id = $_GET['cart_id'];
            $court_schedule_id = $_GET['court_schedule_id'];

            $result = $cart_detail_controller->delete_cart_detail($cart_id, $court_schedule_id);

            echo "
              <script>
                var overlayFrame = document.getElementById('overlay-wrapper');
                overlayFrame.style.display = 'block';
              </script>
            ";

            // Kiểm tra giá trị của biến $result
            if ($result == true) {
              // echo 'The cart detail has been deleted successfully';
              include "./notification/action-successful.php";
              echo "
                <script>
                  var message = document.getElementById('action-successful-message');
                  message.textContent = 'Bạn đã xóa chi tiết giỏ hàng thành công';

                  var btn_back = document.getElementById('admin-management-button');
                  btn_back.textContent = 'Trở về quản lý giỏ hàng';
                  btn_back.href = './cart-management.php';
                  btn_back.style.fontSize = '12.5px';
                </script>
              ";   
            } else if ($result == false) {
              // echo 'The cart detail has been deleted fail';
              include "./notification/warning.php"; 
              echo "
                <script>
                  var warningQuestion = document.getElementById('warning-question');
                  warningQuestion.textContent = 'Bạn đã thực hiện thao tác xóa chi tiết giỏ hàng!';
                    
                  var warningExplanation = document.getElementById('warning-explanation');
                  warningExplanation.textContent = 'Chúng tôi rất tiếc khi thông báo rằng chi tiết giỏ hàng của bạn đã không được xóa thành công';
    
                  var btn_ok = document.getElementById('war-act-ok');
                  btn_ok.href = './cart-management.php';
                </script>
              ";
            }  
          }
        } else if($_option == "increase_service_detail") {
          if(isset($_GET['cart_id']) && isset($_GET['court_schedule_id']) && isset($_GET['service_id'])) {
            $cart_id = $_GET['cart_id'];
            $court_schedule_id = $_GET['court_schedule_id'];
            $service_id = $_GET['service_id'];

            $cart_item_service_quantity = 0;
            $cart_item_total_service_price = 0;

            foreach($cart_service_details as $cart_service_detail) {
              if($cart_service_detail->getCartId() == $cart_id && $cart_service_detail->getCourtScheduleId() == $court_schedule_id && $cart_service_detail->getServiceId() == $service_id) {
                $cart_item_service_quantity = $cart_service_detail->getCartItemServiceQuantity();
                $cart_item_total_service_price = $cart_service_detail->getCartItemTotalServicePrice();
              }
            }

            $cart_item_unit_service_price = $cart_item_total_service_price / $cart_item_service_quantity;

            $cart_item_service_quantity_increased = $cart_item_service_quantity + 1;

            $cart_item_total_service_price_increased = $cart_item_unit_service_price * $cart_item_service_quantity_increased;

            $result = $cart_service_detail_controller->modify_service_detail_quantity($cart_id, $court_schedule_id, $service_id, $cart_item_service_quantity_increased, $cart_item_total_service_price_increased);

            // Cập nhật lại $cart_service_details sau khi sửa
            $cart_service_details = $cart_service_detail_controller->view_all_cart_service_detail(); 

            $cart_item_service_amount = 0;

            $result2 = false;

            if($result) {
              foreach($cart_service_details as $cart_service_detail) {
                if($cart_service_detail->getCartId() == $cart_id && $cart_service_detail->getCourtScheduleId() == $court_schedule_id) {
                  $cart_item_service_amount = $cart_item_service_amount + $cart_service_detail->getCartItemTotalServicePrice();
                }
              }

              $result2 = $cart_detail_controller->update_cart_detail_when_delete_or_update_or_insert_service_detail($cart_id, $court_schedule_id, $cart_item_service_amount);
            }

            echo "
              <script>
                var overlayFrame = document.getElementById('overlay-wrapper');
                overlayFrame.style.display = 'block';
              </script>
            ";

            if($result && $result2) {
              include "./notification/action-successful.php";
              echo "
                <script>
                  var message = document.getElementById('action-successful-message');
                  message.textContent = 'Bạn đã thêm số lượng cho chi tiết giỏ hàng dịch vụ thành công';

                  var btn_back = document.getElementById('admin-management-button');
                  btn_back.textContent = 'Trở về quản lý giỏ hàng';
                  btn_back.href = './cart-management.php';
                  btn_back.style.fontSize = '12.5px';
                </script>
              ";   
            } else {
              include "./notification/warning.php"; 
              echo "
                <script>
                  var warningQuestion = document.getElementById('warning-question');
                  warningQuestion.textContent = 'Bạn đã thực hiện thao tác thêm số lượng cho chi tiết giỏ hàng dịch vụ!';
                    
                  var warningExplanation = document.getElementById('warning-explanation');
                  warningExplanation.textContent = 'Chúng tôi rất tiếc khi thông báo rằng chi tiết giỏ hàng dịch vụ của bạn đã không được thêm số lượng thành công';
    
                  var btn_ok = document.getElementById('war-act-ok');
                  btn_ok.href = './cart-management.php';
                </script>
              ";
            }
          }
        } else if($_option == "decrease_service_detail") {
          if(isset($_GET['cart_id']) && isset($_GET['court_schedule_id']) && isset($_GET['service_id'])) {
            $cart_id = $_GET['cart_id'];
            $court_schedule_id = $_GET['court_schedule_id'];
            $service_id = $_GET['service_id'];

            $cart_item_service_quantity = 0;
            $cart_item_total_service_price = 0;

            foreach($cart_service_details as $cart_service_detail) {
              if($cart_service_detail->getCartId() == $cart_id && $cart_service_detail->getCourtScheduleId() == $court_schedule_id && $cart_service_detail->getServiceId() == $service_id) {
                $cart_item_service_quantity = $cart_service_detail->getCartItemServiceQuantity();
                $cart_item_total_service_price = $cart_service_detail->getCartItemTotalServicePrice();
              }
            }

            $cart_item_unit_service_price = $cart_item_total_service_price / $cart_item_service_quantity;

            $cart_item_service_quantity_decreased = $cart_item_service_quantity - 1;

            if($cart_item_service_quantity_decreased > 0) {
              $cart_item_total_service_price_decreased = $cart_item_unit_service_price * $cart_item_service_quantity_decreased;

              $result = $cart_service_detail_controller->modify_service_detail_quantity($cart_id, $court_schedule_id, $service_id, $cart_item_service_quantity_decreased, $cart_item_total_service_price_decreased);

              // Cập nhật lại $cart_service_details sau khi sửa
              $cart_service_details = $cart_service_detail_controller->view_all_cart_service_detail(); 

              $cart_item_service_amount = 0;

              $result2 = false;

              if($result) {
                foreach($cart_service_details as $cart_service_detail) {
                  if($cart_service_detail->getCartId() == $cart_id && $cart_service_detail->getCourtScheduleId() == $court_schedule_id) {
                    $cart_item_service_amount = $cart_item_service_amount + $cart_service_detail->getCartItemTotalServicePrice();
                  }
                }

                $result2 = $cart_detail_controller->update_cart_detail_when_delete_or_update_or_insert_service_detail($cart_id, $court_schedule_id, $cart_item_service_amount);
              }

              echo "
                <script>
                  var overlayFrame = document.getElementById('overlay-wrapper');
                  overlayFrame.style.display = 'block';
                </script>
              ";

              if($result && $result2) {
                include "./notification/action-successful.php";
                echo "
                  <script>
                    var message = document.getElementById('action-successful-message');
                    message.textContent = 'Bạn đã giảm số lượng cho chi tiết giỏ hàng dịch vụ thành công';

                    var btn_back = document.getElementById('admin-management-button');
                    btn_back.textContent = 'Trở về quản lý giỏ hàng';
                    btn_back.href = './cart-management.php';
                    btn_back.style.fontSize = '12.5px';
                  </script>
                ";   
              } else {
                include "./notification/warning.php"; 
                echo "
                  <script>
                    var warningQuestion = document.getElementById('warning-question');
                    warningQuestion.textContent = 'Bạn đã thực hiện thao tác giảm số lượng cho chi tiết giỏ hàng dịch vụ!';
                      
                    var warningExplanation = document.getElementById('warning-explanation');
                    warningExplanation.textContent = 'Chúng tôi rất tiếc khi thông báo rằng chi tiết giỏ hàng dịch vụ của bạn đã không được giảm số lượng thành công';
      
                    var btn_ok = document.getElementById('war-act-ok');
                    btn_ok.href = './cart-management.php';
                  </script>
                ";
              }
            } else {
              echo "
                <script>
                  var overlayFrame = document.getElementById('overlay-wrapper');
                  overlayFrame.style.display = 'block';
                </script>
              ";

              include "./notification/service-detail-delete-confirmation.php";
            }
          }
        } else if($_option == "insert_service_detail") {
          if(isset($_POST['cart_id']) && isset($_POST['court_schedule_id']) && isset($_POST['service_id_and_price']) && isset($_POST['service_quantity'])) {
            $cart_id = $_POST['cart_id'];
            $court_schedule_id = $_POST['court_schedule_id'];    

            $service_quantity = $_POST['service_quantity'];

            $service_id_and_price = $_POST['service_id_and_price'];
            $service_id_and_price_parts = explode('_', $service_id_and_price);
            $service_id = $service_id_and_price_parts[0];
            $service_price = $service_id_and_price_parts[1];
            $total_service_price = $service_quantity * $service_price;

            $result = false;
            $result2 = false;

            if($service_id_and_price == "0") {
              echo "
                <script>
                  var overlayFrame = document.getElementById('overlay-wrapper');
                  overlayFrame.style.display = 'block';
                </script>
              ";
              include "./notification/warning.php"; 
              echo "
                <script>
                  var warningQuestion = document.getElementById('warning-question');
                  warningQuestion.textContent = 'Bạn đã thực hiện thao tác thêm chi tiết giỏ hàng dịch vụ!';
                    
                  var warningExplanation = document.getElementById('warning-explanation');
                  warningExplanation.textContent = 'Chúng tôi rất tiếc khi thông báo rằng chi tiết giỏ hàng dịch vụ của bạn đã không được thêm thành công bởi vì bạn chưa chọn dịch vụ cần thêm';
    
                  var btn_ok = document.getElementById('war-act-ok');
                  btn_ok.href = './cart-management.php';
                </script>
              ";
            } else {
              if($service_quantity == 0 || $service_quantity < 0) {
                echo "
                  <script>
                    var overlayFrame = document.getElementById('overlay-wrapper');
                    overlayFrame.style.display = 'block';
                  </script>
                ";
                include "./notification/warning.php"; 
                echo "
                  <script>
                    var warningQuestion = document.getElementById('warning-question');
                    warningQuestion.textContent = 'Bạn đã thực hiện thao tác thêm chi tiết giỏ hàng dịch vụ!';
                      
                    var warningExplanation = document.getElementById('warning-explanation');
                    warningExplanation.textContent = 'Chúng tôi rất tiếc khi thông báo rằng chi tiết giỏ hàng dịch vụ của bạn đã không được thêm thành công bởi vì số lượng dịch vụ cần thêm  nhỏ hơn hoặc bằng 0';
      
                    var btn_ok = document.getElementById('war-act-ok');
                    btn_ok.href = './cart-management.php';
                  </script>
                ";
              } else {
                $serviceCount = 0;
                foreach($cart_service_details as $cart_service_detail) {
                  if($cart_service_detail->getCartId() == $cart_id && $cart_service_detail->getCourtScheduleId() == $court_schedule_id && $cart_service_detail->getServiceId() == $service_id) {
                    $serviceCount = $serviceCount + 1;
                  }
                }

                if($serviceCount > 0) {
                  $cart_item_service_quantity = 0;
                  $cart_item_total_service_price = 0;

                  foreach($cart_service_details as $cart_service_detail) {
                    if($cart_service_detail->getCartId() == $cart_id && $cart_service_detail->getCourtScheduleId() == $court_schedule_id && $cart_service_detail->getServiceId() == $service_id) {
                      $cart_item_service_quantity = $cart_service_detail->getCartItemServiceQuantity();
                      $cart_item_total_service_price = $cart_service_detail->getCartItemTotalServicePrice();
                    }
                  }

                  $cart_item_unit_service_price = $cart_item_total_service_price / $cart_item_service_quantity;

                  $cart_item_service_quantity_increased = $cart_item_service_quantity + $service_quantity;

                  $cart_item_total_service_price_increased = $cart_item_unit_service_price * $cart_item_service_quantity_increased;

                  $result = $cart_service_detail_controller->modify_service_detail_quantity($cart_id, $court_schedule_id, $service_id, $cart_item_service_quantity_increased, $cart_item_total_service_price_increased);

                  // Cập nhật lại $cart_service_details sau khi sửa
                  $cart_service_details = $cart_service_detail_controller->view_all_cart_service_detail(); 

                  $cart_item_service_amount = 0;

                  if($result) {
                    foreach($cart_service_details as $cart_service_detail) {
                      if($cart_service_detail->getCartId() == $cart_id && $cart_service_detail->getCourtScheduleId() == $court_schedule_id) {
                        $cart_item_service_amount = $cart_item_service_amount + $cart_service_detail->getCartItemTotalServicePrice();
                      }
                    }

                    $result2 = $cart_detail_controller->update_cart_detail_when_delete_or_update_or_insert_service_detail($cart_id, $court_schedule_id, $cart_item_service_amount);
                  }
                } else {
                  $result = $cart_service_detail_controller->insert_service_detail($cart_id, $court_schedule_id, $service_id, $service_quantity, $total_service_price);

                  // Cập nhật lại $cart_service_details sau khi thêm
                  $cart_service_details = $cart_service_detail_controller->view_all_cart_service_detail(); 

                  $cart_item_service_amount = 0;

                  if($result) {
                    foreach($cart_service_details as $cart_service_detail) {
                      if($cart_service_detail->getCartId() == $cart_id && $cart_service_detail->getCourtScheduleId() == $court_schedule_id) {
                        $cart_item_service_amount = $cart_item_service_amount + $cart_service_detail->getCartItemTotalServicePrice();
                      }
                    }

                    $result2 = $cart_detail_controller->update_cart_detail_when_delete_or_update_or_insert_service_detail($cart_id, $court_schedule_id, $cart_item_service_amount);
                  }
                }

                echo "
                  <script>
                    var overlayFrame = document.getElementById('overlay-wrapper');
                    overlayFrame.style.display = 'block';
                  </script>
                ";

                if($result && $result2) {
                  include "./notification/action-successful.php";
                  echo "
                    <script>
                      var message = document.getElementById('action-successful-message');
                      message.textContent = 'Bạn đã thêm chi tiết giỏ hàng dịch vụ thành công';

                      var btn_back = document.getElementById('admin-management-button');
                      btn_back.textContent = 'Trở về quản lý giỏ hàng';
                      btn_back.href = './cart-management.php';
                      btn_back.style.fontSize = '12.5px';
                    </script>
                  ";   
                } else {
                  include "./notification/warning.php"; 
                  echo "
                    <script>
                      var warningQuestion = document.getElementById('warning-question');
                      warningQuestion.textContent = 'Bạn đã thực hiện thao tác thêm chi tiết giỏ hàng dịch vụ!';
                        
                      var warningExplanation = document.getElementById('warning-explanation');
                      warningExplanation.textContent = 'Chúng tôi rất tiếc khi thông báo rằng chi tiết giỏ hàng dịch vụ của bạn đã không được thêm thành công';
        
                      var btn_ok = document.getElementById('war-act-ok');
                      btn_ok.href = './cart-management.php';
                    </script>
                  ";
                }
              }
            }
          } else {
            if(isset($_POST['service_id_and_price']) && isset($_POST['service_quantity'])) {
              $service_quantity = $_POST['service_quantity'];
              $service_id_and_price = $_POST['service_id_and_price'];

              if($service_id_and_price == "0" || $service_id_and_price == "-1") {
                echo "
                  <script>
                    var overlayFrame = document.getElementById('overlay-wrapper');
                    overlayFrame.style.display = 'block';
                  </script>
                ";
                include "./notification/warning.php"; 
                echo "
                  <script>
                    var warningQuestion = document.getElementById('warning-question');
                    warningQuestion.textContent = 'Bạn đã thực hiện thao tác thêm chi tiết giỏ hàng dịch vụ!';
                          
                    var warningExplanation = document.getElementById('warning-explanation');
                    warningExplanation.textContent = 'Chúng tôi rất tiếc khi thông báo rằng chi tiết giỏ hàng dịch vụ của bạn đã không được thêm thành công bởi vì bạn chưa chọn chi tiết giỏ hàng để áp dụng.';
          
                    var btn_ok = document.getElementById('war-act-ok');
                    btn_ok.href = './cart-management.php';
                  </script>
                ";
              }
            }
          }
        } else if($_option == "delete_service_detail") {
          if(isset($_GET['cart_id']) && isset($_GET['court_schedule_id']) && isset($_GET['service_id'])) {
            $cart_id = $_GET['cart_id'];
            $court_schedule_id = $_GET['court_schedule_id'];
            $service_id = $_GET['service_id'];

            $result = $cart_service_detail_controller->delete_service_detail($cart_id, $court_schedule_id, $service_id);

            // Cập nhật lại $cart_service_details sau khi xóa
            $cart_service_details = $cart_service_detail_controller->view_all_cart_service_detail(); 

            $cart_item_service_amount = 0;

            $result2 = false;

            if($result) {
              foreach($cart_service_details as $cart_service_detail) {
                if($cart_service_detail->getCartId() == $cart_id && $cart_service_detail->getCourtScheduleId() == $court_schedule_id) {
                  $cart_item_service_amount = $cart_item_service_amount + $cart_service_detail->getCartItemTotalServicePrice();
                }
              }

              $result2 = $cart_detail_controller->update_cart_detail_when_delete_or_update_or_insert_service_detail($cart_id, $court_schedule_id, $cart_item_service_amount);
            }

            echo "
              <script>
                var overlayFrame = document.getElementById('overlay-wrapper');
                overlayFrame.style.display = 'block';
              </script>
            ";

            if($result && $result2) {
              include "./notification/action-successful.php";
              echo "
                <script>
                  var message = document.getElementById('action-successful-message');
                  message.textContent = 'Bạn đã xóa chi tiết giỏ hàng dịch vụ thành công';

                  var btn_back = document.getElementById('admin-management-button');
                  btn_back.textContent = 'Trở về quản lý giỏ hàng';
                  btn_back.href = './cart-management.php';
                  btn_back.style.fontSize = '12.5px';
                </script>
              ";   
            } else {
              include "./notification/warning.php"; 
              echo "
                <script>
                  var warningQuestion = document.getElementById('warning-question');
                  warningQuestion.textContent = 'Bạn đã thực hiện thao tác xóa chi tiết giỏ hàng dịch vụ!';
                    
                  var warningExplanation = document.getElementById('warning-explanation');
                  warningExplanation.textContent = 'Chúng tôi rất tiếc khi thông báo rằng chi tiết giỏ hàng dịch vụ của bạn đã không được xóa thành công';
    
                  var btn_ok = document.getElementById('war-act-ok');
                  btn_ok.href = './cart-management.php';
                </script>
              ";
            }
          }
        }
      }
    ?>
  </body>
</html>
