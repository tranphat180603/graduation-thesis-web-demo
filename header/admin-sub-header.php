<style>
        /* height */
        .menu ul::-webkit-scrollbar {
            height: 5px;
        }

        /* Track */
        .menu ul::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 4px;
        }

        /* Handle */
        .menu ul::-webkit-scrollbar-thumb{
            background: #d4d4d4;
            border-radius: 4px;
        }

        /* Handle on hover */
        .menu ul::-webkit-scrollbar-thumb:hover {
            background: #9c9c9c;
            border-radius: 4px;
        }

        .header {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            background: #fff;
            box-shadow: 0px 1px 4px 0px rgba(109, 108, 108, 0.73);
        }

        .header-top {
            display: flex;
            padding: 10px 70px;
            justify-content: center;
            align-items: center;
            align-content: center;
            gap: 20px;
            align-self: stretch;
            flex-wrap: wrap;
            border-bottom: 1px solid #c4c4c4;
            background: #fff;
        }

        .header-top-content {
            display: flex;
            max-width: 1300px;
            justify-content: space-between;
            align-items: center;
            align-content: center;
            row-gap: 10px;
            flex: 1 0 0;
            flex-wrap: wrap;
        }

        .header-top-left {
            display: flex;
            padding-right: 20px;
            align-items: center;
            align-content: center;
            gap: 10px;
            flex: 1 0 0;
            flex-wrap: nowrap;
        }

        .header-top-left p {
            flex: 1 0 0;
            color: #5BC7DF;
            font-size: 20px;
            font-style: normal;
            font-weight: 700;
            line-height: normal;
        }

        .header-top-left p span {
            color: #4195D1;
        }

        .header-top-right {
            display: flex;
            min-width: 320px;
            justify-content: flex-end;
            align-items: center;
            gap: 19px;
            flex: 1 0 0;
        }

        .admin {
            display: flex;
            padding-left: 15px;
            justify-content: center;
            align-items: center;
            gap: 15px;
            position: relative;
        }

        .admin .admin-btn {
            position: absolute;
            width: 100%;
            height: 35px;
            top: 0px;
            right: 0px;
            z-index: 10px;
        }

        .admin .admin-btn:hover {
            cursor: pointer;
        }

        .admin #admin {
            display: none;
        }

        .admin-navigation {
            display: flex;
            width: 88%;
            padding: 8px;
            flex-direction: column;
            align-items: flex-start;
            gap: 8px;
            border-radius: 4px;
            border: 1px solid #EAEAEA;
            background: #EDF5FC;
            box-shadow: 0px 2px 8px 2px rgba(0, 0, 0, 0.08);

            position: absolute;
            right: 0px;
            top: 35px;

            opacity: 0;
            z-index: -5;
        }

        .admin #admin:checked + .admin-navigation {
            opacity: 1;
            z-index: 5;
        }

        .admin-nav-options {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            align-self: stretch;
            gap: 4px;
        }

        .admin-nav-options a {
            display: flex;
            padding: 10px;
            flex-direction: column;
            align-items: flex-start;
            gap: 10px;
            align-self: stretch;
            border-radius: 4px;
        }

        .admin-nav-options a p {
            color: #3F6DB2; 
            font-size: 14px;
            font-style: normal;
            font-weight: 400;
            line-height: 20px; 
        }

        .admin-nav-options a:hover {
            background: #CFEAF6;
        }

        #admin-avatar {
            display: flex;
            width: 30px;
            height: 30px;
            flex-direction: column;
            justify-content: space-between;
            align-items: center;
            border-radius: 50%;
        }

        #admin-name {
            color: #3f6db2;
            font-size: 16px;
            font-style: normal;
            font-weight: 600;
            line-height: normal;
        }

        .header-middle {
            display: flex;
            padding: 20px 70px;
            justify-content: center;
            align-items: center;
            align-content: center;
            gap: 25px 20px;
            align-self: stretch;
            flex-wrap: wrap;
            border-bottom: 1px solid #c4c4c4;
        }

        .header-middle p {
            display: flex;
            max-width: 1300px;
            flex-direction: column;
            align-items: flex-start;
            gap: 10px;
            flex: 1 0 0;
            color: #1a4b95;
            font-size: 20px;
            font-style: normal;
            font-weight: 600;
            line-height: normal;
        }

        .header-sub-middle,
        .header-bottom {
            display: flex;
            height: 70px;
            padding: 0px 70px;
            justify-content: center;
            align-items: center;
            gap: 10px;
            align-self: stretch;
            border-bottom: 1px solid #C4C4C4;
        }

        .header-sub-middle .menu,
        .header-bottom .menu {
            max-width: 1300px;
            align-self: stretch;
            height: 40px;
            width: 100%;
        }

        .header-sub-middle .menu ul,
        .header-bottom .menu ul {
            display: flex;
            align-items: center;
            max-width: 1300px;
            overflow-x: scroll; /* Luôn hiển thị thanh cuộn ngang */
            padding: 0px;
            gap: 36px;
            white-space: nowrap;
            padding-bottom: 8px;
        }

        .header-li-court-type,
        .management-option {
            display: flex;
            align-items: center;
            margin: 0px;
            padding: 0px;
            padding-bottom: 5px;
        }

        .header-li-court-type:hover a,
        .management-option:hover a {
            color: #88938F;
        }

        .header-li-court-type a,
        .management-option a {
            color: #171C1A;
            font-size: 16px;
            font-style: normal;
            font-weight: 500;
            line-height: 24px;
        }

        .management {
            color: #248DAE;
            text-align: center;
            font-size: 18px;
            font-style: normal;
            font-weight: 550;
            line-height: 24px; 
        }

        @media screen and (max-width: 500px) {
            .header-top,
            .header-middle,
            .header-sub-middle,
            .header-bottom {
                padding: 20px 20px;
            }
        }

        @media screen and (max-width: 400px) {
            .header-top-right {
              min-width: 250px;
            }
        }
    </style>
    <?php
      require_once ($_SERVER['DOCUMENT_ROOT'] . "/NTP-Sports-Hub/controllers/court-type-controller.php");
      $court_type_controller = new Court_Type_Controller();

      require_once ($_SERVER['DOCUMENT_ROOT'] . "/NTP-Sports-Hub/controllers/court-controller.php");
      $court_controller = new Court_Controller();
    ?>
    <div class="header">
      <div class="header-top">
        <div class="header-top-content">
          <div class="header-top-left">
            <a href="/NTP-Sports-Hub/index.php">
                <img src="/NTP-Sports-Hub/image/header-img/ntpsh.svg" alt="Khu liên hợp thể thao avatar">
            </a>
            <a href="/NTP-Sports-Hub/index.php">
                <p>Khu liên hợp thể thao <span>Nguyễn Tri Phương</span></p>
            </a>
          </div>
          <div class="header-top-right">
            <div class="admin">
              <label for="admin" class="admin-btn" title="admin"></label>
              <input type="checkbox" id="admin">
              <div class="admin-navigation">
                <div class="admin-nav-options">
                  <a href="/NTP-Sports-Hub/modules/sign-out-module.php">
                    <p>Đăng xuất</p>
                  </a>
                </div>
              </div>
              <img 
                id="admin-avatar" 
                src="
                  <?php
                    require_once ($_SERVER['DOCUMENT_ROOT'] . "/NTP-Sports-Hub/controllers/account-controller.php");
                    $account_controller = new Account_Controller();

                    if(isset($_SESSION['username'])) {
                      $username = $_SESSION['username'];
                      $accounts = $account_controller->view_all_account();
                      foreach($accounts as $account) {
                        if($account->getAccountSignUpName() == $username) {
                          $customer_avatar_link = $account->getAccountAvatar();
                          echo "/NTP-Sports-Hub" . $customer_avatar_link;
                        }
                      }
                    }
                  ?>
                " 
                alt="Quản lý avatar"
              >
              <p id="admin-name">
                <?php
                    if(isset($_SESSION['username'])) {
                      $username = $_SESSION['username'];
                      $accounts = $account_controller->view_all_account();
                      foreach($accounts as $account) {
                        if($account->getAccountSignUpName() == $username) {
                          $account_name = $account->getAccountName();
                          echo $account_name;
                        }
                      }
                    }
                ?>
              </p>
            </div>
          </div>
        </div>
      </div>
      <div class="header-middle">
        <p>Quản lý đặt sân thể thao trực tuyến cùng NTP Sports Hub</p>
      </div>
      <div class="header-sub-middle">
        <div class="menu">
            <ul>
                <?php 
                    $court_types = $court_type_controller->view_all_court_type();
                    
                    foreach($court_types as $court_type) {
                    echo "
                        <li class='header-li-court-type' id='header-li-court-type-".$court_type->getCourtTypeId()."'>
                        <a id='header-a-court-type-".$court_type->getCourtTypeId()."' href='/NTP-Sports-Hub/views/list-of-sports-courts.php?court_type_id=".$court_type->getCourtTypeId()."'>".$court_type->getCourtTypeName()."
                    ";
                        
                    $court_amount = $court_controller->view_court_by_court_type($court_type->getCourtTypeId());
                    echo "
                            &nbsp;(<span>".$court_amount[0]."</span>)
                        </a>
                        </li>
                    ";
                    }
                ?>
            </ul>
        </div>
      </div>
      <div class="header-bottom">
        <div class="menu">
            <ul>
                <li class="management">Quản Lý:</li>
                <li class="management-option" id="mana-li-1">
                    <a href="/NTP-Sports-Hub/views/sport-court-types-management.php" id="mana-a-1">Loại Sân</a>
                </li>
                <li class="management-option" id="mana-li-2">
                    <a href="/NTP-Sports-Hub/views/sport-courts-management.php" id="mana-a-2">Sân</a>
                </li>
                <li class="management-option" id="mana-li-3">
                    <a href="/NTP-Sports-Hub/views/sport-court-schedules-management.php" id="mana-a-3">Lịch Sân</a>
                </li>
                <li class="management-option" id="mana-li-4">
                    <a href="/NTP-Sports-Hub/views/event-management.php" id="mana-a-4">Sự Kiện</a>
                </li>
                <li class="management-option" id="mana-li-5">
                    <a href="/NTP-Sports-Hub/views/service-management.php" id="mana-a-5">Dịch Vụ</a>
                </li>
                <li class="management-option" id="mana-li-6">
                    <a href="/NTP-Sports-Hub/views/sport-court-orders-management.php" id="mana-a-6">Đơn Đặt Sân</a>
                </li>
                <li class="management-option" id="mana-li-7">
                    <a href="/NTP-Sports-Hub/views/statistical-report.php" id="mana-a-7">Thống Kê</a>
                </li>
            </ul>
        </div>
      </div>
    </div>
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
