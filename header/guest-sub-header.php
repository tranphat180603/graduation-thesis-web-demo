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
            min-width: 280px;
            max-width: 340px;
            justify-content: center;
            align-items: center;
            align-content: center;
            gap: 20px;
            flex: 1 0 0;
            flex-wrap: wrap;
        }

        #btn-sign-up {
            display: flex;
            min-width: 120px;
            max-width: 158px;
            padding: 15px 0px;
            justify-content: center;
            align-items: center;
            flex: 1 0 0;
            border-radius: 30px;
            background: #C7D9E7;
        }

        #btn-sign-up:hover {
            background: #bbcedc;
        }

        #btn-sign-up p {
            display: flex;
            width: 158px;
            flex-direction: column;
            justify-content: center;
            align-self: stretch;
            color: #3886A7;
            text-align: center;
            font-size: 16px;
            font-style: normal;
            font-weight: 700;
            line-height: normal;
        }

        #btn-sign-up:hover p {
            color: #4fa2c6;
        }

        #btn-sign-in {
            display: flex;
            min-width: 120px;
            max-width: 158px;
            padding: 15px 0px;
            justify-content: center;
            align-items: center;
            flex: 1 0 0;
            border-radius: 30px;
            background: linear-gradient(
                180deg,
                #2c689a 0%,
                rgba(40, 96, 142, 0.92) 0.01%,
                #5fcede 99.99%,
                rgba(0, 0, 0, 0) 100%
            );
        }

        #btn-sign-in:hover {
            background: linear-gradient(
                180deg,
                #3c81b9 0%,
                rgba(55, 121, 175, 0.92) 0.01%,
                #69d3e3 99.99%,
                rgba(0, 0, 0, 0) 100%
            );
        }

        #btn-sign-in p {
            display: flex;
            width: 158px;
            flex-direction: column;
            justify-content: center;
            align-self: stretch;
            color: #FFF;
            text-align: center;
            font-size: 16px;
            font-style: normal;
            font-weight: 700;
            line-height: normal;
        }

        #btn-sign-in:hover p {
            color: #f1efef;
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

        @media screen and (max-width: 500px) {
            .header-top,
            .header-middle,
            .header-bottom {
                padding: 20px 20px;
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
            <a id="btn-sign-up" href="/NTP-Sports-Hub/views/sign-up-method-suname.php">
                <p>Đăng ký</p>
            </a>
            <a id="btn-sign-in" href="/NTP-Sports-Hub/views/sign-in.php">
                <p>Đăng nhập</p>
            </a>
          </div>
        </div>
      </div>
      <div class="header-middle">
        <p>Trải nghiệm đặt sân thể thao trực tuyến cùng NTP Sports Hub</p>
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
