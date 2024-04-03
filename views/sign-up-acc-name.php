<!DOCTYPE html>
<html lang="vi">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Khu liên hợp thể thao Nguyễn Tri Phương</title>
    <link rel="stylesheet" type="text/css" href="../styles/sign-up.css" />
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
    <?php include "../header/guest-sign-up-header.php"; ?>
    <!-- BODY -->
    <div class="sign-up-body">
      <div class="sign-up-sub-body">
        <div class="sign-up-body-content">
          <div class="sign-up-form">
            <form action="./sign-up-pass.php" method="post" enctype="multipart/form-data">
              <div class="sign-up-body-title">
                <p>ĐĂNG KÝ</p>
                <img id="back-arrow" src="../image/sign-up-img/arrow-narrow-left.svg" alt="Back arrow" onclick="goBack()"/>
              </div>
              <div id="announcement">
                <img src="../image/sign-up-img/xbox.svg" alt="Error" />
                <p>
                  Đăng ký KHÔNG thành công. Bạn vui lòng thử lại hoặc đăng ký
                  bằng cách khác nhé!
                </p>
              </div>
              <div class="sign-up-body-main-content">
                <p id="sign-up-acc-name">Tên tài khoản</p>
                <div class="sign-up-acc-name-input">
                  <input
                    type="text"
                    id="sign-up-acc-name-input-text"
                    name="sign-up-acc-name-input-text"
                    placeholder="Nhập tên tài khoản"
                    required
                  />
                  <img id="check-acc" src="../image/sign-up-img/check.svg" alt="" />
                </div>
                <div class="warning-acc">
                  <img src="../image/sign-up-img/warning.svg" alt="" />
                  <p id="warning-content">Tên đăng ký chưa đúng định dạng</p>
                </div>
                <div id="notice">
                  <p>Lưu ý:</p>
                  <ul>
                    <li>
                      &nbsp; &nbsp; &bull; &nbsp; Tên tài khoản là tên sẽ được hiển thị bên cạnh ảnh đại diện trong website
                    </li>
                    <li>
                      &nbsp; &nbsp; &bull; &nbsp; Tên tài khoản không được chứa các ký tự đặc biệt " và '
                    </li>
                    <li>
                      &nbsp; &nbsp; &bull; &nbsp; Ví dụ tên tài khoản: Nguyễn Ngọc Hoàng
                    </li>
                  </ul>
                </div>
              </div>
              <input
                id="acc-name-continue"
                type="submit"
                name="acc-name-continue"
                value="TIẾP THEO"
              />
              <div class="sign-up-body-bottom">
                <div class="sign-up-policy">
                  <p>Bằng việc đăng ký, bạn đồng ý với chúng tôi về</p>
                  <div class="sign-up-policy-content">
                    <a href="?policy=service">Điều khoản dịch vụ</a>
                    <p>&nbsp;&&nbsp;</p>
                    <a href="?policy=security">Chính sách bảo mật</a>
                  </div>
                </div>
                <div class="have-account">
                  <p>Bạn đã có tài khoản?</p>
                  <a id="sign-in" href="../views/sign-in.php">Đăng nhập</a>
                </div>
              </div>
              <?php
                if(isset($_GET['sign_up_name'])) {
                  $sign_up_name = $_GET['sign_up_name'];
                  echo "<input style='display: none;' type='text' name='sign_up_name' value='$sign_up_name'>";
                }

                if(isset($_GET['sign_up_phone'])) {
                  $sign_up_phone = $_GET['sign_up_phone'];
                  echo "<input style='display: none;' type='text' name='sign_up_phone' value='$sign_up_phone'>";
                }

                if(isset($_GET['sign_up_email'])) {
                  $sign_up_email = $_GET['sign_up_email'];
                  echo "<input style='display: none;' type='text' name='sign_up_email' value='$sign_up_email'>";
                }
              ?>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- FOOTER -->
    <?php include "../footer/footer.php"; ?>
    <script type="text/javascript"src="../scripts/sign-up.js" language="javascript"></script>
  </body>
</html>
