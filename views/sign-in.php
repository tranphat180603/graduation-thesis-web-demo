<!DOCTYPE html>
<html lang="vi">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Khu liên hợp thể thao Nguyễn Tri Phương</title>
    <link rel="stylesheet" type="text/css" href="../styles/sign-in.css" />
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
    <?php include "../header/guest-sign-in-header.php"; ?>
    <!-- BODY -->
    <div class="sign-in-body">
      <div class="sign-in-sub-body">
        <div class="sign-in-body-content">
          <div class="sign-in-form">
            <form action="../modules/sign-in-module.php" method="post" enctype="multipart/form-data">
              <div class="sign-in-body-title">
                <p>ĐĂNG NHẬP</p>
              </div>
              <div id="announcement">
                <img src="../image/sign-in-img/xbox.svg" alt="Error" />
                <p>
                  Đăng nhập KHÔNG thành công. Bạn vui lòng thử lại hoặc đăng nhập bằng cách khác nhé!
                </p>
              </div>
              <div class="sign-in-body-main-content">
                <div class="sign-in-name-input">
                  <input
                    type="text"
                    id="sign-in-name-input-text"
                    name="sign-in-name-input-text"
                    placeholder="Tên đăng nhập/Số điện thoại/Email"
                    required
                  />
                  <img id="check" src="../image/sign-up-img/check.svg" alt="" />
                </div>
                <div id="sign-up-name-warning" class="warning">
                  <img src="../image/sign-in-img/warning.svg" alt="" />
                  <p id="warning-content">Tên đăng nhập chưa đúng định dạng</p>
                </div>
                <div class="sign-in-pass-input">
                  <input
                    type="password"
                    id="sign-in-pass-input-text"
                    name="sign-in-pass-input-text"
                    placeholder="Mật khẩu"
                    required
                  />
                  <img id="eye" src="../image/sign-in-img/show.svg" alt="Toggle Password Visibility" onclick="togglePasswordVisibility()"/>
                </div>
              </div>
              <div id="sign-in-body-bottom">
                <input 
                  type="submit"
                  name="sign-in"
                  value="ĐĂNG NHẬP"
                />
                <div class="have-account">
                  <p>Bạn chưa có tài khoản?</p>
                  <a id="sign-up" href="../views/sign-up-method-suname.php">Đăng ký</a>
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
    <script type="text/javascript" src="../scripts/sign-in.js" language="javascript"></script>
  </body>
</html>
