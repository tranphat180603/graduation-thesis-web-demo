<style>
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
            flex-wrap: nowrap;
        }

        .header-top-left {
            display: flex;
            padding-right: 20px;
            align-items: center;
            align-content: center;
            gap: 10px;
            flex: 1 0 0;
            flex-wrap: wrap;
        }

        .header-top-left p {
            flex: 1 0 0;
            color: #285d8f;
            font-size: 30px;
            font-style: normal;
            font-weight: 600;
            line-height: normal;
        }

        .header-top-right {
            display: flex;
            min-width: 320px;
            justify-content: flex-end;
            align-items: center;
            gap: 19px;
            flex: 1 0 0;
        }

        .cart {
            position: relative;
            width: 45px;
            height: 38px;
        }

        #cart-amount {
            position: absolute;
            top: -4px;
            right: -2px;
            display: flex;
            width: 28px;
            padding: 1px 0px;
            justify-content: center;
            align-items: center;
            gap: 10px;
            border-radius: 30px;
            border: 1px solid #e6e6e6;
            background: #2c689a;

            color: #fff;
            text-align: center;
            font-size: 11px;
            font-style: normal;
            font-weight: 700;
            line-height: normal;
        }

        .customer {
            display: flex;
            padding-left: 15px;
            justify-content: center;
            align-items: center;
            gap: 15px;
            border-left: 2px solid #3f6db2;
            position: relative;
        }

        .customer .customer-btn {
            position: absolute;
            width: 100%;
            height: 35px;
            top: 0px;
            right: 0px;
            z-index: 10px;
        }

        .customer .customer-btn:hover {
            cursor: pointer;
        }

        .customer #customer {
            display: none;
        }

        .customer-navigation {
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

        .customer #customer:checked + .customer-navigation {
            opacity: 1;
            z-index: 5;
        }

        .customer-nav-options {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            align-self: stretch;
            gap: 4px;
        }

        .customer-nav-options a {
            display: flex;
            padding: 10px;
            flex-direction: column;
            align-items: flex-start;
            gap: 10px;
            align-self: stretch;
            border-radius: 4px;
        }

        .customer-nav-options a p {
            color: #3F6DB2; 
            font-size: 14px;
            font-style: normal;
            font-weight: 400;
            line-height: 20px; 
        }

        .customer-nav-options a:hover {
            background: #CFEAF6;
        }

        #customer-avatar {
            display: flex;
            width: 30px;
            height: 30px;
            flex-direction: column;
            justify-content: space-between;
            align-items: center;
            border-radius: 50%;
        }

        #customer-name {
            color: #3f6db2;
            font-size: 16px;
            font-style: normal;
            font-weight: 600;
            line-height: normal;
        }

        .header-bottom {
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

        .header-bottom p {
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

        @media screen and (max-width: 500px) {
            .header-top,
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
    <div class="header">
      <div class="header-top">
        <div class="header-top-content">
          <div class="header-top-left">
            <a href="/NTP-Sports-Hub/index.php">
                <img src="/NTP-Sports-Hub/image/header-img/ntpsh.svg" alt="Khu liên hợp thể thao avatar">
            </a>
            <p>Thanh Toán</p>
          </div>
          <div class="header-top-right">
            <a href="/NTP-Sports-Hub/views/cart-management.php">
              <div class="cart">
                <img id="cart-icon" src="/NTP-Sports-Hub/image/header-img/cart.svg" alt="Giỏ hàng icon">
                <div id="cart-amount">
                  <?php
                    require_once ($_SERVER['DOCUMENT_ROOT'] . "/NTP-Sports-Hub/controllers/account-controller.php");
                    $account_controller = new Account_Controller();

                    if(isset($_SESSION['username'])) {
                      $username = $_SESSION['username'];
                      $customer_cart_amount = $account_controller->get_customer_cart_amount($username);
                      echo $customer_cart_amount[0];
                    }
                  ?>
                </div>
              </div>
            </a>
            <div class="customer">
              <label for="customer" class="customer-btn" title="customer"></label>
              <input type="checkbox" id="customer">
              <div class="customer-navigation">
                <div class="customer-nav-options">
                  <a href="/NTP-Sports-Hub/views/customer-account-management.php">
                    <p>Tài khoản của tôi</p>
                  </a>
                  <a href="/NTP-Sports-Hub/views/sport-court-booking-history-management.php">
                    <p>Đơn đặt sân</p>
                  </a>
                  <a href="/NTP-Sports-Hub/modules/sign-out-module.php">
                    <p>Đăng xuất</p>
                  </a>
                </div>
              </div>
              <img 
                id="customer-avatar" 
                src="
                  <?php
                    if(isset($_SESSION['username'])) {
                      $username = $_SESSION['username'];
                      $accounts = $account_controller->view_all_account();
                      foreach($accounts as $account) {
                        if($account->getAccountSignUpName() == $username) {
                          $customer_avatar_link = $account->getAccountAvatar();
                          if($customer_avatar_link == "") {
                            echo "/NTP-Sports-Hub/image/account-management-img/avatar-user.png";
                          } else {
                            echo "/NTP-Sports-Hub" . $customer_avatar_link;
                          }
                        }
                      }
                    }
                  ?>
                " 
                alt="Khách hàng avatar"
              >
              <p id="customer-name">
                <?php
                  if(isset($_SESSION['username'])) {
                    $username = $_SESSION['username'];
                    $account_name = $account_controller->get_account_name($username);
                    echo $account_name[0];
                  }
                ?>
              </p>
            </div>
          </div>
        </div>
      </div>
      <div class="header-bottom">
        <p>Trải nghiệm đặt sân thể thao trực tuyến cùng NTP Sports Hub</p>
      </div>
    </div>