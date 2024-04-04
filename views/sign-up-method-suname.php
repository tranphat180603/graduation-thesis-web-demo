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
    <div id="overlay-wrapper"></div>
    <?php include "../header/guest-sign-up-header.php"; ?>
    <!-- BODY -->
    <div class="sign-up-body">
      <div class="sign-up-sub-body">
        <div class="sign-up-body-content">
          <div class="sign-up-form">
            <form action="../modules/sign-up-module.php" method="post" enctype="multipart/form-data">
              <div class="sign-up-body-title">
                <p>ĐĂNG KÝ</p>
              </div>
              <div id="announcement">
                <img src="../image/sign-up-img/xbox.svg" alt="Error" />
                <p>
                  Đăng ký KHÔNG thành công. Bạn vui lòng thử lại hoặc đăng ký bằng cách khác nhé!
                </p>
              </div>
              <div class="sign-up-body-main-content">
                <p id="sign-up-name">Tên đăng ký</p>
                <div class="sign-up-name-input">
                  <input
                    type="text"
                    id="sign-up-name-input-text"
                    name="sign-up-name-input-text"
                    placeholder="Nhập tên đăng ký"
                    value="<?php echo isset($_GET['sign_up_name']) ? $_GET['sign_up_name'] : ""; ?>"
                    required
                  />
                  <img id="check" src="../image/sign-up-img/check.svg" alt="" />
                </div>
                <div class="warning">
                  <img src="../image/sign-up-img/warning.svg" alt="" />
                  <p id="warning-content">Tên đăng ký chưa đúng định dạng</p>
                </div>
                <div id="notice">
                  <p>Lưu ý:</p>
                  <ul>
                    <li>
                      &nbsp; &nbsp; &bull; &nbsp; Tên đăng ký phải có ít nhất 10
                      ký tự
                    </li>
                    <li>
                      &nbsp; &nbsp; &bull; &nbsp; Dạng chữ in thường, chữ in
                      hoa, chữ không dấu, chữ số viết liền
                    </li>
                    <li>
                      &nbsp; &nbsp; &bull; &nbsp; Không được chứa ký tự đặc
                      biệt, không chứa dấu cách
                    </li>
                    <li>
                      &nbsp; &nbsp; &bull; &nbsp; Ví dụ tên đăng ký hợp lệ:
                      harryngochoang03
                    </li>
                  </ul>
                </div>
              </div>
              <input
                id="next-button"
                type="submit"
                name="sign-up-name-continue"
                value="TIẾP THEO"
              />
              <div class="or">
                <hr />
                <p>HOẶC</p>
                <hr />
              </div>
              <div class="sign-up-body-bottom">
                <div class="sign-up-method">
                  <div id="button-phone" onclick="moveToPhone()">
                    <img src="../image/sign-up-img/phone.svg" alt="Phone" />
                    <a href="sign-up-method-phone.php">Số điện thoại</a>
                  </div>
                  <div id="button-email" onclick="moveToEmail()">
                    <img src="../image/sign-up-img/email.svg" alt="Email" />
                    <a href="sign-up-method-email.php">Gmail</a>
                  </div>
                </div>
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
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- FOOTER -->
    <?php include "../footer/footer.php"; ?>
    <?php include_once $_SERVER['DOCUMENT_ROOT'] . "/NTP-Sports-Hub/modules/msg.php"; ?>
    <script type="text/javascript"src="../scripts/sign-up.js" language="javascript"></script>
  </body>
</html>
