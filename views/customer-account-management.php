<!DOCTYPE html>
<html lang="vi">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Khu liên hợp thể thao Nguyễn Tri Phương</title>
    <link rel="stylesheet" type="text/css" href="../styles/customer-account-management.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
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
  <?php
    session_start();
    require_once ($_SERVER['DOCUMENT_ROOT'] . "/NTP-Sports-Hub/controllers/customer-controller.php");
    require_once ($_SERVER['DOCUMENT_ROOT'] . "/NTP-Sports-Hub/controllers/account-controller.php");
    $account_controller = new Account_Controller();
    $customerController = new Customer_Controller();
  ?>
    <?php
        if(isset($_SESSION['username'])) {
            $username = $_SESSION['username'];
            $accounts = $account_controller->view_all_account();
            foreach($accounts as $account) {
            if($account->getAccountSignUpName() == $username) {
                $customer_avatar_link = $account->getAccountAvatar();
                $customer_sign_up_name = $account->getAccountSignUpName();
                $customer_account_id = $account ->getAccountId();
            }
            }
        }

        //handle show ttin account
        if(isset($_SESSION['username'])) {
            $account = $account_controller -> displayAccountData($_SESSION['username']);  
        }

        //handle thay đổi ảnh
        if(isset($_POST["submitImage"])) {
            $account_controller->handleImageUpload($customer_account_id); 
        }
    ?>
    <!-- HEADER -->
    <?php
    include "../header/customer-main-header.php"; 
    ?>
    <!-- BODY -->
    <div class = "main-body">
     <div class = "sub-body">
       <div class  = "content-header">
         <p id = "head">Hồ sơ của tôi</p>
         <p>Quản lý thông tin hồ sơ để bảo mật tài khoản</p>
       </div>
       <hr>
       <div class = "content-body">
         <div class = "info-box">
          <form id="info-inputs" action="../controllers/customer-controller.php" method="post" enctype="multipart/form-data">
          <input style="display: none;" type="text" id="account-id" name="account-id" value="<?php echo $customer_account_id?>"> <br>
                    <input style="display: none;" type="text" id="customer-id" name="customer-id" value="<?php echo $customerData->getCustomerId();?>"> <br>
            <div class="input-line">
                <div class="label-container">
                    <label for="account-name">Tên đăng ký:</label>
                </div>
                <div class="input-container">
                    <input disabled class="input-text" type="text" id="account-name" name="account-name" value="<?php echo $customer_sign_up_name?>"> <br>
                </div>
            </div>
            <div class="input-line">
                <div class="label-container"> 
                    <label for="customer-name">Tên khách hàng:</label>
                </div>
                <div class="input-container">
                    <input class="input-text" type="text" id="customer-name1" name="customer-name" placeholder="Nhập họ và tên" value="<?php echo $customerData->getCustomerFullname(); ?>"> <br>
                </div>
            </div>
            <div class="input-line">
                <div class="label-container">
                    <label for="email">Email: </label>
                </div>
                <div class="input-container">
                    <input class="input-text" type="password" id="email" name="email" placeholder="Nhập email" value="<?php echo $customerData -> getCustomerEmailAddress(); ?>"> <br>
                    <img src="../image/account-management-img/hide.svg" alt="" onclick="toggleContent('email', this)">
                </div>
            </div>
            <div class="input-line">
                <div class="label-container">
                    <label for="phone-number">Số điện thoại: </label>
                </div>
                <div class="input-container">
                    <input class="input-text" type="password" id="phone-number" name="phone-number" placeholder="Nhập số điện thoại" value="<?php echo  $customerData -> getCustomerPhoneNumber(); ?>"> <br>
                    <img src="../image/account-management-img/hide.svg" alt="" onclick="toggleContent('phone-number', this)">
                </div>
            </div>
            <div class="input-line">
                <div class="label-container">
                    <label for="gender">Giới tính: </label>
                </div>
                <div class="radio-container">
                    <div class="radio-mini-container">
                        <input type="radio" name="gender" value="Nam" <?php if ($customerData -> getCustomerGender() === 'Nam') echo 'checked'; ?>>
                        <p>Nam</p>
                    </div>
                    <div class="radio-mini-container">
                        <input type="radio" name="gender" value="Nữ" <?php if ($customerData -> getCustomerGender() === 'Nữ') echo 'checked'; ?>>
                        <p>Nữ</p>
                    </div>
                    <div class="radio-mini-container">
                        <input type="radio" name="gender" value="Khác" <?php if ($customerData -> getCustomerGender() === 'Khác') echo 'checked'; ?>>
                        <p>Khác</p>
                    </div>
                </div>
            </div>
            <div class="input-line">
                <div class="label-container">
                    <label for="birthdate">Ngày sinh: </label>
                </div>
                <div class="input-container">
                    <input class="input-text" type="text" id="birthdate" name="birthdate" placeholder="Chọn ngày sinh" value="<?php echo $customerData -> getCustomerDateOfBirth(); ?>"> <br>
                    <img id="calendar-icon" src="../image/account-management-img/calendar.svg" alt="">
                </div>
            </div>
          <div class = "input-footer">
            <button type="button" id="modify-btn" onclick="toggleButtons('modify-btn')">
              <img src="../image/account-management-img/Vector.svg" alt="modify button">
              <span>Sửa</span>
            </button>
            <button type="reset" name="cancel" id="cancel-btn" onclick="toggleButtons('cancel-btn')">
                <img src="../image/account-management-img/delete.svg" alt="cancel button">
                <span>Huỷ</span>
            </button>
            <button type="submit" name="save" id="save-btn" onclick="toggleButtons('save-btn')">
                  <img src="../image/account-management-img/save.svg" alt="save button">
                  <span>Lưu</span>
            </button>
           </div>
          </form>
         </div>
         <form id = "image-input" class = "image-box" action="" method="post" enctype="multipart/form-data" >
            <div class = "image-frame">
            <img id="avatar" src="<?php echo '/NTP-Sports-Hub'. $customer_avatar_link?>" >
            </div>
                <button type="button" id = "get-avatar-btn" href="" onclick = "document.getElementById('avatar-input').click()">
                  <input type="submit" id = "submitImage" name = "submitImage" style="display:none">
                  <img src="/NTP-Sports-Hub/image/account-management-img/pointer.svg" alt="choose avatar">
                  <label for="avatar-input">Chọn ảnh</label>
                  <input style="display:none" type="file" id="avatar-input" name="avatar-input" accept="image/*" onchange="document.getElementById('submitImage').click()">
                </button>
          </form>
       </div>
     </div>
   </div>
    <!-- FOOTER -->
    <?php include "../footer/footer.php"; ?>
    <script type="text/javascript" src="../scripts/customer-account-management.js" language="javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
  </body>
</html>