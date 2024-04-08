<?php session_start(); ?>
<!DOCTYPE html>
<html lang="vi">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Khu liên hợp thể thao Nguyễn Tri Phương</title>
    <link rel="stylesheet" type="text/css" href="./styles/home.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet"/>
    <link rel="apple-touch-icon" sizes="57x57" href="./favicon/apple-icon-57x57.png"/>
    <link rel="apple-touch-icon" sizes="60x60" href="./favicon/apple-icon-60x60.png"/>
    <link rel="apple-touch-icon" sizes="72x72" href="./favicon/apple-icon-72x72.png"/>
    <link rel="apple-touch-icon" sizes="76x76" href="./favicon/apple-icon-76x76.png"/>
    <link rel="apple-touch-icon" sizes="114x114" href="./favicon/apple-icon-114x114.png"/>
    <link rel="apple-touch-icon" sizes="120x120" href="./favicon/apple-icon-120x120.png"/>
    <link rel="apple-touch-icon" sizes="144x144" href="./favicon/apple-icon-144x144.png"/>
    <link rel="apple-touch-icon" sizes="152x152" href="./favicon/apple-icon-152x152.png"/>
    <link rel="apple-touch-icon" sizes="180x180" href="./favicon/apple-icon-180x180.png"/>
    <link rel="icon" type="image/png" sizes="192x192" href="./favicon/android-icon-192x192.png"/>
    <link rel="icon" type="image/png" sizes="32x32" href="./favicon/favicon-32x32.png"/>
    <link rel="icon" type="image/png" sizes="96x96" href="./favicon/favicon-96x96.png"/>
    <link rel="icon" type="image/png" sizes="16x16" href="./favicon/favicon-16x16.png"/>
    <link rel="manifest" href="/manifest.json" />
    <meta name="msapplication-TileColor" content="#ffffff" />
    <meta name="msapplication-TileImage" content="./favicon/ms-icon-144x144.png"/>
    <meta name="theme-color" content="#ffffff" />
  </head>
  <body>
    <?php
      require_once ($_SERVER['DOCUMENT_ROOT'] . "/NTP-Sports-Hub/controllers/controller.php");
      $controller = new Controller();

      require_once ($_SERVER['DOCUMENT_ROOT'] . "/NTP-Sports-Hub/controllers/account-controller.php");
      $account_controller = new Account_Controller();
    ?>
    <!-- HEADER -->
    <?php 
      if(!isset($_SESSION['username'])) {
        include $_SERVER['DOCUMENT_ROOT'] . "/NTP-Sports-Hub/header/guest-main-header.php";
      } else {
        $username = $_SESSION['username'];

        $accounts = $account_controller->view_all_account();

        foreach($accounts as $account) {
          if($account->getAccountSignUpName() == $username) {
            $account_type = $account->getAccountType();
            if($account_type == 'Quản lý') {
              include $_SERVER['DOCUMENT_ROOT'] . "/NTP-Sports-Hub/header/admin-main-header.php";
            } else if($account_type == 'Khách hàng') {
              include $_SERVER['DOCUMENT_ROOT'] . "/NTP-Sports-Hub/header/customer-main-header.php";
            }
          }
        }
      }
    ?>
    <!-- BODY -->
    <!-- FOOTER -->
    <?php include "./footer/footer.php"; ?>
    <?php include_once $_SERVER['DOCUMENT_ROOT'] . "/NTP-Sports-Hub/modules/msg.php"; ?>
    <script type="text/javascript" src="./scripts/home.js" language="javascript"></script>
    <?php
      //Thay đổi CSS của thẻ li đang được chọn
      $courtType = isset($_GET['court_type_id']) ? $_GET['court_type_id'] : '0'; // Mặc định court_type_id = '0'

      // Lấy URL hiện tại
      $current_url = $_SERVER['PHP_SELF'];

      // Kiểm tra URL hiện tại
      if (strpos($current_url, 'list-of-sports-courts.php') !== false) {
          echo "
              <script>
                  document.addEventListener('DOMContentLoaded', function() {
                      var liElement = document.getElementById('header-li-court-type-".$courtType."');
                      liElement.style.borderBottom = '2px solid #285D8F';

                      var aElement = document.getElementById('header-a-court-type-".$courtType."')
                      aElement.style.color = '#285D8F';
                      aElement.style.fontSize = '16px';
                      aElement.style.fontStyle = 'normal';
                      aElement.style.fontWeight = '500';
                      aElement.style.lineHeight = '24px';
                  });
              </script>
          ";    
      } else if (strpos($current_url, 'sport-court-types-management.php') !== false) {
          echo "
              <script>
                  document.addEventListener('DOMContentLoaded', function() {
                      var liElement = document.getElementById('mana-li-1');
                      liElement.style.borderBottom = '2px solid #285D8F';

                      var aElement = document.getElementById('mana-a-1')
                      aElement.style.color = '#285D8F';
                      aElement.style.fontSize = '16px';
                      aElement.style.fontStyle = 'normal';
                      aElement.style.fontWeight = '500';
                      aElement.style.lineHeight = '24px';
                  });
              </script>
          ";    
      } else if (strpos($current_url, 'sport-courts-management.php') !== false) {
          echo "
              <script>
                  document.addEventListener('DOMContentLoaded', function() {
                      var liElement = document.getElementById('mana-li-2');
                      liElement.style.borderBottom = '2px solid #285D8F';

                      var aElement = document.getElementById('mana-a-2')
                      aElement.style.color = '#285D8F';
                      aElement.style.fontSize = '16px';
                      aElement.style.fontStyle = 'normal';
                      aElement.style.fontWeight = '500';
                      aElement.style.lineHeight = '24px';
                  });
              </script>
          ";    
      } else if (strpos($current_url, 'sport-court-schedules-management.php') !== false) {
          echo "
              <script>
                  document.addEventListener('DOMContentLoaded', function() {
                      var liElement = document.getElementById('mana-li-3');
                      liElement.style.borderBottom = '2px solid #285D8F';

                      var aElement = document.getElementById('mana-a-3')
                      aElement.style.color = '#285D8F';
                      aElement.style.fontSize = '16px';
                      aElement.style.fontStyle = 'normal';
                      aElement.style.fontWeight = '500';
                      aElement.style.lineHeight = '24px';
                  });
              </script>
          ";    
      } else if (strpos($current_url, 'event-management.php') !== false) {
          echo "
              <script>
                  document.addEventListener('DOMContentLoaded', function() {
                      var liElement = document.getElementById('mana-li-4');
                      liElement.style.borderBottom = '2px solid #285D8F';

                      var aElement = document.getElementById('mana-a-4')
                      aElement.style.color = '#285D8F';
                      aElement.style.fontSize = '16px';
                      aElement.style.fontStyle = 'normal';
                      aElement.style.fontWeight = '500';
                      aElement.style.lineHeight = '24px';
                  });
              </script>
          ";    
      } else if (strpos($current_url, 'service-management.php') !== false) {
          echo "
              <script>
                  document.addEventListener('DOMContentLoaded', function() {
                      var liElement = document.getElementById('mana-li-5');
                      liElement.style.borderBottom = '2px solid #285D8F';

                      var aElement = document.getElementById('mana-a-5')
                      aElement.style.color = '#285D8F';
                      aElement.style.fontSize = '16px';
                      aElement.style.fontStyle = 'normal';
                      aElement.style.fontWeight = '500';
                      aElement.style.lineHeight = '24px';
                  });
              </script>
          ";    
      } else if (strpos($current_url, 'sport-court-orders-management.php') !== false) {
          echo "
              <script>
                  document.addEventListener('DOMContentLoaded', function() {
                      var liElement = document.getElementById('mana-li-6');
                      liElement.style.borderBottom = '2px solid #285D8F';

                      var aElement = document.getElementById('mana-a-6')
                      aElement.style.color = '#285D8F';
                      aElement.style.fontSize = '16px';
                      aElement.style.fontStyle = 'normal';
                      aElement.style.fontWeight = '500';
                      aElement.style.lineHeight = '24px';
                  });
              </script>
          ";    
      } else if (strpos($current_url, 'statistical-report.php') !== false) {
          echo "
              <script>
                  document.addEventListener('DOMContentLoaded', function() {
                      var liElement = document.getElementById('mana-li-7');
                      liElement.style.borderBottom = '2px solid #285D8F';

                      var aElement = document.getElementById('mana-a-7')
                      aElement.style.color = '#285D8F';
                      aElement.style.fontSize = '16px';
                      aElement.style.fontStyle = 'normal';
                      aElement.style.fontWeight = '500';
                      aElement.style.lineHeight = '24px';
                  });
              </script>
          ";    
      }
    ?>
  </body>
</html>
