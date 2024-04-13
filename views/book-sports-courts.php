<?php session_start(); ?>
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
  <div id = "overlay">  </div>
    <?php
    require_once ($_SERVER['DOCUMENT_ROOT'] . "/NTP-Sports-Hub/controllers/court-controller.php");
    $court_controller = new Court_Controller();
    $court_image_data = $court_controller->get_court_image($_POST['court_id']);
    if ($court_image_data !== false && isset($court_image_data[1])) {
      $court_image = $court_image_data[1]; // Assuming the image path is at index 1
    } else {
        // Handle the case where the image data is not available or invalid
        $court_image = ''; // or provide a default image path
    }

    ?>
    <!-- HEADER -->
    <?php include "../header/customer-payment-header.php"; ?>
    <!-- BODY -->
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
                    echo '<img id = "court-img" src="' . $court_image . '" alt="hinhanhsan">';
                    echo $_POST['court_name'];
                    echo '</td>';
                    echo '<td id="td2">';
                    echo isset($_POST['court_type']) ? $_POST['court_type'] : '';
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
                          echo $item['service'] . '<br>';
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
                    <?php
                    echo '<tr>';
                    echo '<td id="td1">';
                    echo '<img src="' . $court_image . '" alt="hinhanhsan">';
                    echo '</td>';
                    echo '<td id="td2">';
                    // Handle different values for court_type if needed
                    echo isset($_POST['court_type']) ? $_POST['court_type'] : '';
                    echo '</td>';
                    echo '<td id="td3">';
                    // Handle different values for court-schedule-date if needed
                    echo isset($_POST['court-schedule-date']) ? $_POST['court-schedule-date'] : '';
                    echo '</td>';
                    echo '<td id="td4">';
                    // Handle different values for court_schedule_time_frame if needed
                    echo isset($_POST['court_schedule_time_frame']) ? $_POST['court_schedule_time_frame'] : '';
                    echo '</td>';
                    echo '<td id="td5">';
                    // Handle different values for selected_services if needed
                    echo isset($_POST['selected_services']) ? $_POST['selected_services'] : '';
                    echo '</td>';
                    echo '<td id="td6">';
                    // Handle different values for total_service_amount if needed
                    echo isset($_POST['total_service_amount']) ? $_POST['total_service_amount'] : '';
                    echo '</td>';
                    echo '<td id="td7">';
                    // Handle different values for total_rental_amount if needed
                    echo isset($_POST['total_rental_amount']) ? $_POST['total_rental_amount'] : '';
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
        <form class="receipt-frame" action="your_action_file.php" method="post">
    <div class="receipt-content-line">
        <p>Tổng Tiền Dịch Vụ:</p>
        <input type="text" id="total_service_amount" name="total_service_amount" value="<?php echo isset($_POST['total_service_amount']) ? "&#8363;" . $_POST['total_service_amount'] : ''; ?>" readonly>
    </div>
    <div class="receipt-content-line">
        <p>Tổng Tiền Thuê:</p>
        <input type="text" id="total_rental_amount" name="total_rental_amount" value="<?php echo isset($_POST['total_rental_amount']) ? "&#8363;" . $_POST['total_rental_amount'] : ''; ?>" readonly>
    </div>
    <div class="receipt-content-line">
        <p>Tổng Tiền Giảm Giá:</p>
        <input type="text" id="discount_amount" name="discount_amount" value="<?php echo "&#8363;" . "0" ?>" readonly>
    </div>
    <div class="receipt-content-line">
        <p>Tổng Tiền Cọc:</p>
        <input type="text" id="deposit_amount" name="deposit_amount" value="<?php echo "&#8363;" . ($_POST['total_service_amount'] + $_POST['total_rental_amount']) * 20/100   ?>" readonly>
    </div>
    <div class="receipt-content-line">
        <p>Tổng Tiền Thanh Toán:</p>
        <input type="text" id="total_payment_amount" name="total_payment_amount" value="<?php echo "&#8363;" . $_POST['total_service_amount'] + $_POST['total_rental_amount'] ?>" readonly>
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
            <textarea class="mini-body-content-row-input" id="content1" name="content" rows="1"></textarea>
          </div>
          <div class = "mini-body-content-row">
            <div class = "mini-body-content-row-label">
              <label for="number">Số điện thoại: </label>
            </div>
            <textarea class="mini-body-content-row-input" id="content" name="content" rows="1"><0937048368></textarea>
          </div>
          <div class = "mini-body-content-row">
            <div class = "mini-body-content-row-label">
              <label for="name">Tên tài khoản: </label>
            </div>
            <textarea class="mini-body-content-row-input" id="content" name="content" rows="1"><Nguyễn Thị Ngọc Trang></textarea>
          </div>
          <div class = "mini-body-content-row">
            <div class = "mini-body-content-row-label">
              <label for="content">Nội dung chuyển khoản: </label>
            </div>
            <textarea class="mini-body-content-row-input" id="content" name="content" rows="4">[<Họ và tên>]_[<Số điện thoại>]_[Thanh toán tiền cọc đặt sân <Tên Sân>]_[<Ngày nhận sân>]_[<Khung giờ nhận sân>]</textarea>
          </div>
          <div class = "mini-body-content-row">
            <div class = "mini-body-content-row-label">
              <label for="example">Ví dụ: </label>
            </div>
            <textarea class="mini-body-content-row-input" id="content" name="content" rows="4">[<Nguyễn Hoàng Mỹ Duyên>]_[<0929788890>]_[<Thanh toán tiền cọc đặt sân Bóng đá số 1>]_[<14/02/2024>]_[<15:00-17:00>]</textarea>
          </div>
        </div>
      </div>
      <div class = "mini-footer">
        <div class = "done-btn">
          <img src="../image/book-sport-court-img/tick-circle.svg" alt="">
          <a href="../views/book-sports-courts.php">
            <p class = "btn-text" >Hoàn thành</p>
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
            <textarea class="mini-body-content-row-input" id="content2" name="content" rows="1"></textarea>
          </div>
          <div class = "mini-body-content-row">
            <div class = "mini-body-content-row-label">
              <label for="number">Số tài khoản: </label>
            </div>
            <textarea class="mini-body-content-row-input" id="content" name="content" rows="1">0797048368</textarea>
          </div>
          <div class = "mini-body-content-row">
            <div class = "mini-body-content-row-label">
              <label for="name">Tên tài khoản: </label>
            </div>
            <textarea class="mini-body-content-row-input" id="content" name="content" rows="1">Khu liên hợp thể thao Nguyễn Tri Phương</textarea>
          </div>
          <div class = "mini-body-content-row">
            <div class = "mini-body-content-row-label">
              <label for="content">Nội dung chuyển khoản: </label>
            </div>
            <textarea class="mini-body-content-row-input" id="content" name="content" rows="4">[<Họ và tên>]_[<Số điện thoại>]_[Thanh toán tiền cọc đặt sân <Tên Sân>]_[<Ngày nhận sân>]_[<Khung giờ nhận sân>]</textarea>
          </div>
          <div class = "mini-body-content-row">
            <div class = "mini-body-content-row-label">
              <label for="example">Ví dụ: </label>
            </div>
            <textarea class="mini-body-content-row-input" id="content" name="content" rows="4">[<Nguyễn Hoàng Mỹ Duyên>]_[<0929788890>]_[<Thanh toán tiền cọc đặt sân Bóng đá số 1>]_[<14/02/2024>]_[<15:00-17:00>]</textarea>
          </div>
        </div>
      </div>
      <div style="background: #D3E0FF;" class = "mini-footer">
        <div style="background: #1B00D9;" class = "done-btn">
          <img src="../image/book-sport-court-img/tick-circle.svg" alt="">
          <a href="../views/book-sports-courts.php">
            <p class = "btn-text" >Hoàn thành</p>
          </a>
        </div>
      </div>
    </div>
    <script type="text/javascript" src="../scripts/book-sports-courts.js" language="javascript"></script>
  </body>
</html>

