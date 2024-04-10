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
            row-gap: 5px;
            flex: 1 0 0;
            flex-wrap: wrap;
        }

        .header-top-left {
            display: flex;
            padding-right: 20px;
            align-items: center;
            align-content: center;
            gap: 5px;
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
            min-width: 225px;
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

        .header-middle-container {
            display: flex;
            max-width: 1300px;
            align-items: center;
            flex-wrap: wrap;
            gap: 20px;
            flex: 1 0 0;
        }

        .header-middle p {
            display: flex;
            min-width: 480px;
            align-items: flex-start;
            gap: 10px;
            flex: 1 0 0;
            color: #1a4b95;
            font-size: 20px;
            font-style: normal;
            font-weight: 600;
            line-height: normal;
        }

        .header-search {
            display: flex;
            gap: 15px 30px;
            min-width: 320px;
            max-width: 540px;
            flex-wrap: wrap;
            align-items: center;
        }

        .instance-container,
        .search-container {
            flex: 1;
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: flex-start;
        }

        .search-container {
            height: 20px;
            gap: 10px;
        }

        .instance-container {
            align-self: stretch;
            border-radius: 8px;
            border: 2px solid rgba(156, 184, 201, 0.2);
            padding: 10px 12px 10px 8px;
            min-width: 200px;
            max-width: 250px;
            width: 100%;
        }

        .searchVector {
            width: 18px;
            height: 18px;
        }

        .input,
        .searchVector {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 0 0 0 8px;
        }

        .input {
            width: calc(100% - 18px);
            border: 0;
            outline: 0;
            background-color: transparent;
            height: 18px;
            flex: 1;
            align-items: flex-start;
            padding: 0 8px 0;
            box-sizing: border-box;
            font-size: 16px;
            color: #818183;
            min-width: 116px;
        }

        #courtType_checkboxList {
            list-style: none;
            margin-top: 0;
            margin-bottom: 0;
            min-width: 200px;
            max-width: 250px;
            border: 2px solid rgba(156, 184, 201, 0.2);
            border-radius: 8px;
            box-sizing: border-box;
            padding: 0;
            width: 100%;
        }

        #courtType_checkboxList li {
            display: flex;
            border-right: 1px solid #fff;
            position: relative;
            text-align: left;
            padding: 11px 10px;
            align-items: center;
            gap: 18px;
            min-width: 200px;
            max-width: 250px;
        }

        #courtType_checkboxList > li {
            float: left;
            position: relative;
        }

        .court-vector {
            width: 20px;
            height: 20px;
        }

        .dropdown-menu {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 300px;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            z-index: 1;
            padding: 0;
            /* Loại bỏ padding mặc định */
            margin-top: 0;
            /* Loại bỏ margin mặc định */
            overflow: visible;
        }

        .dropdown-menu.active {
            display: block;
        }

        .checkboxList {
            cursor: pointer;
            background-color: #fff;
            align-self: stretch;
            flex: 1;
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: center;
            gap: 0 18px;
        }

        .court-type-name {
            padding: 8px 16px;
            /* Thêm padding vào mỗi mục trong dropdown menu */
            white-space: nowrap;
            /* Ngăn chặn cắt chữ */
            width: 200px;
        }

        .court-type a {
            display: block;
            overflow: visible;
        }

        .dropdown_list {
            position: absolute;
            padding-bottom: 10px;
            list-style: none;
            display: none;
            width: 90%;
            top: 40px;
            left: 0px;
            border-radius: 0px 0px 6px 6px;
            background: #FFF;
            box-shadow: 0px 1px 4px 0px rgba(109, 108, 108, 0.70);
        }

        #courtType_checkboxList > li:hover > ul.dropdown_list {
            display: block;
            z-index: 100;
        }

        ul.dropdown_list > li {
            position: relative;
        }

        .selectedCourts {
            text-align: left;
            flex-shrink: 0;
            max-width: 140px;
            white-space: nowrap; /* Ngăn không cho nội dung xuống dòng */
            overflow: hidden; /* Ẩn nội dung bị tràn */
            text-overflow: ellipsis; /* Hiển thị dấu ... khi nội dung tràn */
            white-space: nowrap; /* Ngăn chặn việc xuống hàng khi văn bản dài */
            gap: 0 18px;
        }

        #selectedCourts {
            font-size: 13px;
            line-height: 16px;
            font-weight: 500;
            color: #374151;
        }

        .dropdown-vector {
            height: 7.9px;
            width: 13.7px;
        }

        .court-type-name {
            padding: 8px 16px;
            /* Thêm padding vào mỗi mục trong dropdown menu */
            white-space: nowrap;
            /* Ngăn chặn cắt chữ */
            width: 200px;
        }

        .btn-group {
            display: flex;
            width: 275px;
            height: 30px;
            align-items: flex-start;
            gap: 10px;
            padding-left: 12px;
        }

        .btn-group b {
            color: #fafbfc;
            font-family: "Be Vietnam Pro";
            font-size: 12px;
            font-style: normal;
            font-weight: 500;
            line-height: 20px;
        }

        #court-type-apply {
            display: flex;
            padding: 0px 10px;
            justify-content: center;
            align-items: center;
            gap: 8px;
            align-self: stretch;
            border-radius: 4px;
            background: #27ae60;
            border: none;
        }

        #court-type-apply:hover {
            background-color: #1d7b44;
        }

        #court-type-reset {
            display: flex;
            padding: 8px 12px;
            justify-content: center;
            align-items: center;
            gap: 8px;
            align-self: stretch;
            border-radius: 4px;
            background: #d00000;
            border: none;
        }

        #court-type-reset:hover {
            background-color: #a10404;
        }

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

        .menu {
            max-width: 1300px;
            align-self: stretch;
            height: 40px;
            width: 100%;
        }

        .menu ul {
            display: flex;
            align-items: center;
            max-width: 1300px;
            overflow-x: scroll; /* Luôn hiển thị thanh cuộn ngang */
            padding: 0px;
            gap: 36px;
            white-space: nowrap;
            padding-bottom: 8px;
        }

        .header-li-court-type {
            display: flex;
            align-items: center;
            margin: 0px;
            padding: 0px;
            padding-bottom: 5px;
        }

        .header-li-court-type:hover a {
            color: #88938F;
        }

        .header-li-court-type a {
            color: #171C1A;
            font-size: 16px;
            font-style: normal;
            font-weight: 500;
            line-height: 24px;
        }

        @media screen and (max-width: 730px) {
            .header-middle p {
                min-width: 300px;
            }
        }

        @media screen and (max-width: 500px) {
            .header-top,
            .header-middle,
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
      <div class="header-middle">
        <div class="header-middle-container">
            <p>Trải nghiệm đặt sân thể thao trực tuyến cùng NTP Sports Hub</p>
            <div class="header-search">
                <div class="instance-container">
                <div class="search-container">
                    <img class="searchVector" alt="" src="/NTP-Sports-Hub/image/header-img/search.svg" />
                    <input id="searchInput" class="input" placeholder="Tìm kiếm" type="search" onkeydown="searchOnEnter(event)" />
                </div>
                </div>
                <ul id="courtType_checkboxList">
                <li class="checkboxList">
                    <img class="court-vector" alt="" src="/NTP-Sports-Hub/image/header-img/filter.svg" />
                    <div class="selectedCourts"><p id="selectedCourts">Tất cả loại sân</p></div>
                    <img class="dropdown-vector" alt="" src="/NTP-Sports-Hub/image/header-img/dropdown.svg" />
                    <ul class='dropdown_list'>
                        <?php
                            $court_types = $court_type_controller->view_all_court_type();
                            foreach ($court_types as $court_type) {
                                echo "
                                    <li class='court-type-name' id='filter-li-court-type-".$court_type->getCourtTypeId()."'>
                                        <input type='checkbox' id='checkbox-court-type-".$court_type->getCourtTypeId()."' value='".$court_type->getCourtTypeId()."'>
                                        <label for='checkbox-court-type-".$court_type->getCourtTypeId()."'>".$court_type->getCourtTypeName()."</label>
                                    </li>
                                ";
                            }
                        ?>

                        <div class="btn-group">
                            <button id='court-type-apply' onclick='applyFilters()'>
                                <b class='apply'>Áp dụng</b>
                            </button>
                                    
                            <button id='court-type-reset' onclick='resetFilters()'>
                                <b class='reset'>Đặt lại</b>
                            </button>
                        </div>
                    </ul>
                </li>
                </ul>
            </div>
        </div>
      </div>
      <div class="header-bottom">
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
    </div>
    <?php
        //Thay đổi CSS của thẻ li đang được chọn
        $courtType = isset($_GET['court_type_id']) ? $_GET['court_type_id'] : '0'; // Mặc định court_type_id = '0'

        // Lấy URL hiện tại
        $current_url = $_SERVER['PHP_SELF'];

        // Kiểm tra nếu URL hiện tại là ../views/list-of-sports-courts.php
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
        }
    ?>
    <script>
        // Lọc theo nhiều loại sân checkbox
        function updateSelectedCourts() {
            var checkboxes = document.querySelectorAll(
                '.court-type-name input[type="checkbox"]'
            );
            var selectedCourtNames = [];
            checkboxes.forEach(function (checkbox) {
                if (checkbox.checked) {
                var label = checkbox.nextElementSibling.textContent;
                selectedCourtNames.push(label);
                }
            });
            var courtsDiv = document.getElementById("selectedCourts");
            courtsDiv.textContent =
                selectedCourtNames.length > 0
                ? selectedCourtNames.join(", ")
                : "Tất cả loại sân";
        }

        document.addEventListener("DOMContentLoaded", function () {
            var urlParams = new URLSearchParams(window.location.search);
            var courtTypeIds = urlParams.get("court_type_id")
                ? urlParams.get("court_type_id").split(",")
                : [];
            var checkboxes = document.querySelectorAll(
                '.court-type-name input[type="checkbox"]'
            );
            checkboxes.forEach(function (checkbox) {
                if (courtTypeIds.includes(checkbox.value)) {
                checkbox.checked = true;
                }
            });
            updateSelectedCourts();
        });

        // Nút apply
        function applyFilters() {
            var checkboxes = document.querySelectorAll(
                '.court-type-name input[type="checkbox"]'
            );
            var selectedCourtTypes = [];
            checkboxes.forEach(function (checkbox) {
                if (checkbox.checked) {
                selectedCourtTypes.push(checkbox.value);
                }
            });
            if (selectedCourtTypes.length > 0) {
                var url = "?court_type_id=" + selectedCourtTypes.join(",");
                window.location.href = url;
            } else {
                alert("Please select at least one court type.");
            }
        }

        //Hàm Dropdown
        $("#courtType_checkboxList > li").hover(
        function () {
            $(".dropdown_list", this).slideDown();
        },
        function () {
            $(".dropdown_list", this).slideUp();
        }
        );

        //Reset mục chọn trong checkbox
        function resetFilters() {
            var checkboxes = document.querySelectorAll(
                '.court-type-name input[type="checkbox"]'
            );
            checkboxes.forEach(function (checkbox) {
                checkbox.checked = false;
            });

            var courtsDiv = document.getElementById("selectedCourts");
            courtsDiv.textContent = "Tất cả loại sân";

            // Xóa tham số court_type_id khỏi URL
            var url = new URL(window.location.href);
            url.searchParams.delete("court_type_id");
            // Thay đổi URL
            window.history.replaceState({}, "", url);

            window.location.reload();
        }

        //Tìm kiếm thẻ sân

        document.addEventListener("DOMContentLoaded", function () {
            var searchField = document.getElementById("searchInput");
            var courtCards = document.querySelectorAll(".court-card");

            // Hàm lọc các thẻ court-card dựa trên từ khóa tìm kiếm
            function filterCourts(searchTerm) {
                searchTerm = searchTerm.toLowerCase();
                courtCards.forEach(function (card) {
                var courtName = card.querySelector(".c-name").textContent.toLowerCase();
                if (courtName.includes(searchTerm)) {
                    card.style.display = ""; // Hiển thị thẻ nếu tên sân chứa từ khóa tìm kiếm
                } else {
                    card.style.display = "none"; // Ẩn thẻ nếu không chứa từ khóa tìm kiếm
                }
                });
            }

            // Lắng nghe sự kiện nhập vào trường tìm kiếm
            searchField.addEventListener("input", function () {
                filterCourts(searchField.value); // Gọi hàm lọc kết quả tìm kiếm
            });
        });
    </script>