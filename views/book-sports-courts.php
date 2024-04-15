

<?php session_start();
// ini_set('display_errors', 0);
//   ini_set('display_startup_errors', 0);
?>
<!DOCTYPE html>
<html lang="vi">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Khu liên hợp thể thao Nguyễn Tri Phương</title>
    <link rel="stylesheet" type="text/css" href="../styles/book-sports-courts.css" />
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
  <div class = container>
  <div id = "overlay"> </div>
    <?php
    require_once ($_SERVER['DOCUMENT_ROOT'] . "/NTP-Sports-Hub/controllers/court-controller.php");
    require_once ($_SERVER['DOCUMENT_ROOT'] . "/NTP-Sports-Hub/controllers/court-schedule-controller.php");
    require_once ($_SERVER['DOCUMENT_ROOT'] . "/NTP-Sports-Hub/controllers/court-type-controller.php");
    require_once ($_SERVER['DOCUMENT_ROOT'] . "/NTP-Sports-Hub/controllers/court-order-controller.php");
    require_once ($_SERVER['DOCUMENT_ROOT'] . "/NTP-Sports-Hub/controllers/customer-controller.php");
    require_once ($_SERVER['DOCUMENT_ROOT'] . "/NTP-Sports-Hub/controllers/cart-service-detail-controller.php");


    $court_controller = new Court_Controller();
    $court_schedule_controller = new Court_Schedule_Controller();
    $court_type_controller = new Court_Type_Controller();
    $court_order_controller = new Court_Order_Controller();
    $customerController = new Customer_Controller();
    $cart_service_detail = new Cart_Service_Detail_Controller();
    $customerData = $customerController -> getcustomerdata($_SESSION['username']);
    
    $accountID = $customerData->getAccountId();
    $court_image_data = isset($_POST['court_id']) ? $court_controller->get_court_image($_POST['court_id']) : null;
  

    if ($court_image_data !== false && $court_image_data !== null) {
      // Check if the query returned a result
      $court_image = $court_image_data['court_image']; 
  } else {
      // If no image found, set default value
      $court_image = ''; 
  }
  
    

    $court_type_name = "";
    if (isset($_POST['court_type'])) {
      $court_type_data = $court_type_controller->view_court_type_by_id($_POST['court_type']);
 
      if (!empty($court_type_data) && is_array($court_type_data)) {
          foreach ($court_type_data as $court_type) {
              $court_type_name = $court_type->getCourtTypeName();
              // Do something with $court_type_name
          }
      }
  }
  function removeCurrencyAndThousandSeparator($formattedNumber) {
    $numberWithoutCurrency = str_replace('đ', '', $formattedNumber);
    return str_replace('.', '', $numberWithoutCurrency);
}
    if (isset($_POST['form_identifier']) && $_POST['form_identifier'] === 'your_unique_value') {
      $total_service_amount = isset($_POST['total_service_amount']) ? removeCurrencyAndThousandSeparator($_POST['total_service_amount']) : null;

      // Extract numeric part from the value of total_rental_amount
      $total_rental_amount = isset($_POST['total_rental_amount']) ? removeCurrencyAndThousandSeparator($_POST['total_rental_amount']) : null;
      
      // Extract numeric part from the value of discount_amount
      $discount_amount = isset($_POST['discount_amount']) ? removeCurrencyAndThousandSeparator($_POST['discount_amount']) : null;
      
      // Extract numeric part from the value of total_payment_amount
      $total_payment_amount = isset($_POST['total_payment_amount']) ? removeCurrencyAndThousandSeparator($_POST['total_payment_amount']) : null;
      
      // Extract numeric part from the value of deposit_amount
      $deposit_amount = isset($_POST['deposit_amount']) ? removeCurrencyAndThousandSeparator($_POST['deposit_amount']) : null;
      
      $court_order_controller->insertCourtOrd($_POST['court_schedule_id'],$_POST['event_id'],$total_service_amount,$total_rental_amount,$discount_amount ,$total_payment_amount,$deposit_amount ,$_POST['payment-method'],"Chờ thanh toán", $accountID);

      $court_schedule_controller->update_court_schedule_when_ordered($_POST['court_schedule_id'], "");
      }
    ?>
    <!-- HEADER -->
    <?php include "../header/customer-payment-header.php"; ?>
    <!-- BODY -->
    <form action="book-sports-courts.php" method ="post" name="form1">
    <input type="hidden" name="form_identifier" value="your_unique_value">
    <input type="text" style="display: none;" id = "court_schedule_id" name = "court_schedule_id" value="<?php echo isset($_POST['court_schedule_id']) ? $_POST['court_schedule_id'] : ''; ?>">
    <input style="display:flex" type="text" id="payment-method" name="payment-method">

    <div class = "book-sports-courts">
      <div class = "upper-body">
          <table class = "upper-body-content">
            <thead>
              <tr>
                <th id = "th1">Sân</th>
                <th id = "th2">Loại Sân</th>
                <th id = "th3">Ngày</th>
                <th id = "th4">Khung giờ</th>
                <th id = "th5">Dịch Vụ</th>
                <th id = "th6">Tiền Dịch Vụ</th>
                <th id = "th7">Tiền Thuê</th>
              </tr>
            </thead>
                <?php if (isset($_POST['court_schedule_id']) && isset($_POST['selected_services'])): ?>
                <tbody>
                    <?php
                    echo '<tr>';
                    echo '<td id="td1">';
                    echo '<img class = "court-img" src="' . $court_image . '" alt="hinhanhsan">';
                    echo $_POST['court_name'];
                    echo '</td>';
                    echo '<td id="td2">';
                    echo $court_type_name;
                    echo '</td>';
                    echo '<td id="td3">';
                    echo isset($_POST['court-schedule-date']) ? $_POST['court_schedule_time_frame'] : '';
                    echo '</td>';
                    echo '<td id="td4">';
                    echo isset($_POST['court_schedule_time_frame']) ? $_POST['court_schedule_time_frame'] : '';
                    echo '</td>';
                    echo '<td id="td5">';
                    if(isset($_POST['selected_services'])) {
                      $services = json_decode($_POST['selected_services'], true);
                      foreach ($services as $item) {
                        echo $item['service'] . ': ' . $item['quantity'] . '<br>';
                      }
                  }
                    echo '</td>';
                    echo '<td id="td6">';
                    echo isset($_POST['total_service_amount']) ? $_POST['total_service_amount'] : '';
                    echo '</td>';
                    echo '<td id="td7">';
                    echo isset($_POST['total_rental_amount']) ? $_POST['total_rental_amount'] : '';
                    echo '</td>';
                    echo '</tr>';
                    ?>
                </tbody>
            <?php elseif(isset($_POST['cart_id']) && isset($_POST['court_schedule_id'])): ?>
                <tbody>
                <input style="display:none" type="text" name="event_id" value="<?php echo isset($_POST["event_id1"]) ? $_POST["event_id1"] : '1'; ?>">
                    <?php
                    echo '<tr>';
                    echo '<td id="td1">';
                    $court_data = $court_order_controller->getCourtNamefromCourtSchedule($_POST['court_schedule_id']);

                    if (is_array($court_data)) {
                        // Output court image
                        echo '<img class = "court-img" src="' . $court_data['court_image'] . '" alt="hinhanhsan">';
                    
                        // Output court name
                        echo $court_data['court_name'];
                    } else {
                        // Handle case where no court data is found
                        echo "Court data not found";
                    }
                    echo '</td>';
                    echo '<td id="td2">';
                    // Output court type
                    echo isset($court_data['court_type_name']) ? $court_data['court_type_name'] : '';
                    echo '</td>';
                    
                    echo '<td id="td3">';
                    // Output court schedule date
                    echo isset($court_data['court_schedule_date']) ? $court_data['court_schedule_date'] : '';
                    echo '</td>';
                    
                    echo '<td id="td4">';
                    // Output court schedule time frame
                    echo isset($court_data['court_schedule_time_frame']) ? $court_data['court_schedule_time_frame'] : '';
                    echo '</td>';
                    
                    echo '<td id="td5">';
                    $selected_services = $cart_service_detail->get_services($_POST['cart_id'], $_POST['court_schedule_id']);


                    if (is_array($selected_services) && !empty($selected_services)) {
                      // Iterate over each service
                      foreach ($selected_services as $service) {
                          // Output the service name and its quantity
                          echo $service['service_name'] . ': ' . $service['quantity'];
                      }
                    }

                    echo '</td>';
                    echo '<td id="td6">';
                    // Handle different values for total_service_amount if needed
                    if(isset($_POST['service_total_amount'])) {
                      echo  $_POST['service_total_amount'];
                  }
                    echo '</td>';
                    echo '<td id="td7">';
                    // Handle different values for total_rental_amount if needed
                    if(isset($_POST['total_payment_amount'])) {
                      echo  $_POST['total_payment_amount'];
                    }
                    echo '</td>';
                    echo '</tr>';
                    ?>
                </tbody>
              <?php endif; ?>
          </table>
      </div>
      <div class = "lower-body">
        <div class = "payment-method">
          <div id = "payment-method-text">
            <p>Phương thức thanh toán</p>
          </div>
          <a href="#?method=momo" name="momo" id="momo">
            <p id = "momo-option">Thanh toán bằng ví điện tử Momo</p>
          </a>
          <a href="#?method=bank" name="bank" id="bank">
            <p id = "bank-option">Thanh toán bằng chuyển khoản ngân hàng</p>
          </a>
        </div>
        <div class = "receipt-container">
        <form action="book-sports-courts.php" class="receipt-frame"  method="post" name="form2">
        <div class="receipt-content-line">
        <p>Tổng Tiền Dịch Vụ:</p>
        <input style="border:none; background:#eafafd" type="text" id="total_service_amount" name="total_service_amount" value="<?php
        if(isset($_POST['total_service_amount'])) {
            echo "&#8363;" . $_POST['total_service_amount'];
        } elseif(isset($_POST['service_total_amount'])) {
            echo  $_POST['service_total_amount'];
        } else {
            echo '';
        }
        ?>" >
</div>
<div class="receipt-content-line">
        <p>Tổng Tiền Thuê:</p>
        <input  style="border:none; background:#eafafd" type="text" id="total_rental_amount" name="total_rental_amount" value="<?php
        if(isset($_POST['total_rental_amount'])) {
            echo "&#8363;" . $_POST['total_rental_amount'];
        } elseif(isset($_POST['rental_total_amount'])) {
            echo $_POST['rental_total_amount'];
        } else {
            echo '';
        }
?>" >
</div>
<div class="receipt-content-line">
        <p>Tổng Tiền Giảm Giá:</p>
        <input  style="border:none; background:#eafafd"  type="text" id="discount_amount" name="discount_amount" value="<?php
        if (isset($_POST['court_schedule_id']) && isset($_POST['selected_services'])) {
          echo "&#8363;" . "0";
        } elseif(isset($_POST['discount_amount'])) {
            echo $_POST['discount_amount'];
        } else {
            echo '';
        }
?>" >

</div>
<div class="receipt-content-line">
    <p>Tổng Tiền Cọc:</p>
    <input  style="border:none; background:#eafafd" type="text" id="deposit_amount" name="deposit_amount" value="<?php
        if(isset($_POST['total_service_amount']) && isset($_POST['total_rental_amount'])) {
            echo "&#8363;" . ($_POST['total_service_amount'] + $_POST['total_rental_amount']) * 20/100;
        } elseif(isset($_POST['deposit_amount'])) {
            echo  $_POST['deposit_amount'];
        } else {
            echo '';
        } ?>" >

<input type="hidden" id="deposit_amount2" name="deposit_amount2" value="<?php
    if(isset($_POST['total_service_amount']) && isset($_POST['total_rental_amount'])) {
        echo "&#8363;" . ($_POST['total_service_amount'] + $_POST['total_rental_amount']) * 20/100;
    } elseif(isset($_POST['deposit_amount'])) {
        echo  $_POST['deposit_amount'];
    } else {
        echo '';
    }
?>">


</div>
<div class="receipt-content-line">
    <p>Tổng Tiền Thanh toán:</p>
    <input  style="border:none; background:#eafafd" type="text" id="total_payment_amount" name="total_payment_amount" value="<?php
        if(isset($_POST['total_service_amount']) && isset($_POST['total_rental_amount'])) {
          echo "&#8363;" . ($_POST['total_service_amount'] + $_POST['total_rental_amount']);
        } elseif(isset($_POST['total_payment_amount'])) {
            echo  $_POST['total_payment_amount'];
        } else {
            echo '';
        } ?>" >
</div>
          <hr id = "hr2">
          <div class = "receipt-footer">
           <div class = "note">
             <input id ="note-checkbox" type="checkbox">
             <p id = "note-text">Nhấn đặt ngay đồng nghĩa với việc bạn đồng ý tuân theo Điều khoản của Khu liên hợp thể thao NTP</p>
           </div>
             <a href="" id = "book-btn"> <p class = "btn-text">Đặt ngay</p></a>
         </div>
          </form>
        </div>
      </div>
    </div>
    <!-- FOOTER -->
    <?php include "../footer/footer.php"; ?>
    </div>
    <div class = "mini-form" id = "momo-form">
      <div class = "mini-header">
        <div class = "mini-logo">
          <img src="../image/book-sport-court-img/momo-logo.png" alt="">
        </div>
        <div class = "mini-header-header">
          <p class = "mini-header-header-text">Thanh toán tiền cọc qua ví điện tử Momo</p>
        </div>
        <a href="../views/book-sports-courts.php" class = "close-btn">
          <img src="../image/book-sport-court-img/close.svg" alt="">
        </a>
      </div>
      <div class = "mini-body">
        <div class = "mini-body-content">
          <div class = "mini-note">
            <p class = "mini-note-text">Để thanh toán tiền cọc qua ví điện tử momo, bạn hãy sử dụng ví điện tử momo để chuyển tiền vào số điện thoại và soạn nội dung theo mẫu dưới đây:</p>
          </div>
          <div class = "mini-body-content-row">
            <div class = "mini-body-content-row-label">
              <label for="deposit">Số tiền cọc: </label>
            </div>
            <textarea class="mini-body-content-row-input" id="content1" name="content" rows="1" readonly></textarea>
          </div>
          <div class = "mini-body-content-row">
            <div class = "mini-body-content-row-label">
              <label for="number">Số điện thoại: </label>
            </div>
            <textarea class="mini-body-content-row-input" id="content" name="content" rows="1" readonly><0937048368></textarea>
          </div>
          <div class = "mini-body-content-row">
            <div class = "mini-body-content-row-label">
              <label for="name">Tên tài khoản: </label>
            </div>
            <textarea class="mini-body-content-row-input" id="content" name="content" rows="1"readonly><Nguyễn Thị Ngọc Trang></textarea>
          </div>
          <div class = "mini-body-content-row">
            <div class = "mini-body-content-row-label">
              <label for="content">Nội dung chuyển khoản: </label>
            </div>
            <textarea class="mini-body-content-row-input" id="content" name="content" rows="4"readonly>[<Họ và tên>]_[<Số điện thoại>]_[Thanh toán tiền cọc đặt sân <Tên Sân>]_[<Ngày nhận sân>]_[<Khung giờ nhận sân>]</textarea>
          </div>
          <div class = "mini-body-content-row">
            <div class = "mini-body-content-row-label">
              <label for="example">Ví dụ: </label>
            </div>
            <textarea class="mini-body-content-row-input" id="content" name="content" rows="4"readonly>[<Nguyễn Hoàng Mỹ Duyên>]_[<0929788890>]_[<Thanh toán tiền cọc đặt sân Bóng đá số 1>]_[<14/02/2024>]_[<15:00-17:00>]</textarea>
          </div>
        </div>
      </div>
      <div class = "mini-footer">
        <div class = "done-btn">
          <img src="../image/book-sport-court-img/tick-circle.svg" alt="">
          <a href="../views/book-sports-courts.php">
            <p class = "btn-text" id = "momo-submit" >Hoàn thành</p>
            <input style="display:none" type="text" id = "momo-method" name = "momo-method" value = "Ví điện tử momo">
          </a>
        </div>
      </div>
    </div>
    <div class = "mini-form" id = "bank-form">
      <div style="background: #D3E0FF;" class = "mini-header">
        <div class = "mini-logo">
          <img src="../image/book-sport-court-img/bank-logo.png" alt="">
        </div>
        <div class = "mini-header-header">
          <p class = "mini-header-header-text">Thanh toán tiền cọc qua tài khoản ngân hàng</p>
        </div>
        <a href="../views/book-sports-courts.php" class = "close-btn">
          <img src="../image/book-sport-court-img/close.svg" alt="">
        </a>
      </div>
      <div class = "mini-body">
        <div class = "mini-body-content">
          <div class = "mini-note">
            <p class = "mini-note-text">Để thanh toán tiền cọc qua tài khoản ngân hàng, bạn hãy chuyển tiền vào tài khoản ngân hàng và soạn nội dung theo mẫu dưới đây:</p>
          </div>
          <div class = "mini-body-content-row">
            <div class = "mini-body-content-row-label">
              <label for="deposit">Số tiền cọc: </label>
            </div>
            <textarea class="mini-body-content-row-input" id="content2" name="content" rows="1"readonly></textarea>
          </div>
          <div class = "mini-body-content-row">
            <div class = "mini-body-content-row-label">
              <label for="number">Số tài khoản: </label>
            </div>
            <textarea class="mini-body-content-row-input" id="content" name="content" rows="1"readonly>0797048368</textarea>
          </div>
          <div class = "mini-body-content-row">
            <div class = "mini-body-content-row-label">
              <label for="name">Tên tài khoản: </label>
            </div>
            <textarea class="mini-body-content-row-input" id="content" name="content" rows="1"readonly>Khu liên hợp thể thao Nguyễn Tri Phương</textarea>
          </div>
          <div class = "mini-body-content-row">
            <div class = "mini-body-content-row-label">
              <label for="content">Nội dung chuyển khoản: </label>
            </div>
            <textarea class="mini-body-content-row-input" id="content" name="content" rows="4"readonly>[<Họ và tên>]_[<Số điện thoại>]_[Thanh toán tiền cọc đặt sân <Tên Sân>]_[<Ngày nhận sân>]_[<Khung giờ nhận sân>]</textarea>
          </div>
          <div class = "mini-body-content-row">
            <div class = "mini-body-content-row-label">
              <label for="example">Ví dụ: </label>
            </div>
            <textarea class="mini-body-content-row-input" id="content" name="content" rows="4"readonly>[<Nguyễn Hoàng Mỹ Duyên>]_[<0929788890>]_[<Thanh toán tiền cọc đặt sân Bóng đá số 1>]_[<14/02/2024>]_[<15:00-17:00>]</textarea>
          </div>
        </div>
      </div>
      <div style="background: #D3E0FF;" class = "mini-footer">
        <div style="background: #1B00D9;" class = "done-btn">
          <img src="../image/book-sport-court-img/tick-circle.svg" alt="">
          <a href="../views/book-sports-courts.php">
            <p id = "bank-submit" class = "btn-text" >Hoàn thành</p>
            <input style="display:none" type="text" id = "bank-method" name = "bank-method" value = "Ngân hàng">
          </a>
        </div>
      </div>
    </div>
    <input  type="submit" style="display:none">
    </form>
    <script type="text/javascript" src="../scripts/book-sports-courts.js" language="javascript"></script>
  </body>
</html>