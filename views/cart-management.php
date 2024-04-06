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
                  <th style='max-width: 200px;'>Sân</th>
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
