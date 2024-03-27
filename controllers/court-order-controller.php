<?php
    require_once "../models/court-order-model.php";

    class Court_Order_Controller {
        public $account;

        public function __construct() {
            $this->court_order = new court_order();
        }

        //1. Hàm hiển thị tổng số lượng đơn đặt sân
        public function view_all_court_order() {
            return $result = $this->court_order->view_all_court_order();
        }

        //2. Hàm hiển thị tổng số lượng đơn đặt sân theo trạng thái của đơn đặt sân
        public function view_court_order_by_court_order_state($order_state) {
            return $result = $this->court_order->view_court_order_by_court_order_state($order_state);
        }

        //3. Hàm hiển thị dữ liệu của bảng đơn đặt sân theo thanh điều hướng
        public function view_court_order() {
            //Lấy dữ liệu của biến $_GET['court_order_state_id']
            $order_state_id = isset($_GET['court_order_state_id']) ? $_GET['court_order_state_id'] : '0'; // Mặc định court_order_state_id = '0'
            
            switch ($order_state_id) {
                case 0: 
                    $order_state = "Tất cả";
                break;
                case 1:
                    $order_state = "Chờ thanh toán";
                break;
                case 2:
                    $order_state = "Chờ nhận sân";
                break;
                case 3:
                    $order_state = "Hoàn thành";
                break;
                case 4:
                    $order_state = "Đã hủy";
                break;
                case 5:
                    $order_state = "Chờ hoàn tiền";
                break;
            }
            
            return $result = $this->court_order->view_court_order($order_state);
        }

        //4. Hàm lấy dữ liệu một đơn đặt sân cụ thể
        public function view_specific_court_order() {
            $court_order_id = isset($_GET['court_order_id']) ? $_GET['court_order_id'] : ''; 

            if ($court_order_id != "") {
              return $result = $this->court_order->view_specific_court_order($court_order_id);
            }
        }

        //5. Hàm xử lý đơn đặt sân có trạng thái CHỜ THANH TOÁN 
        public function process_payment_court_order() {
            if(isset($_GET['court_order_id'])) {
                $court_order_id = $_GET['court_order_id'];

                $result = $this->court_order->process_payment_court_order($court_order_id);

                // Kiểm tra giá trị của biến $result
                if ($result) {
                    // echo 'The court order has been processed successfully';
                    header("Location: ../views/sport-court-orders-management.php?notification=process_successful");    
                } else {
                    // echo 'The court order has been processed fail';
                    header("Location: ../views/sport-court-orders-management.php?notification=process_fail");
                }   
            }
        }

        //6. Hàm xử lý đơn đặt sân có trạng thái CHỜ NHẬN SÂN 
        public function process_receive_court_order() {
            if(isset($_GET['court_order_id'])) {
                $court_order_id = $_GET['court_order_id'];

                $result = $this->court_order->process_receive_court_order($court_order_id);

                // Kiểm tra giá trị của biến $result
                if ($result) {
                    // echo 'The court order has been processed successfully';
                    header("Location: ../views/sport-court-orders-management.php?notification=process_successful");    
                } else {
                    // echo 'The court order has been processed fail';
                    header("Location: ../views/sport-court-orders-management.php?notification=process_fail");
                }   
            }
        }

        //7. Hàm xử lý đơn đặt sân có trạng thái CHỜ HOÀN TIỀN 
        public function process_refunded_court_order() {
            if(isset($_GET['court_order_id'])) {
                $court_order_id = $_GET['court_order_id'];

                $result = $this->court_order->process_refunded_court_order($court_order_id);

                // Kiểm tra giá trị của biến $result
                if ($result) {
                    // echo 'The court order has been processed successfully';
                    header("Location: ../views/sport-court-orders-management.php?notification=process_successful");    
                } else {
                    // echo 'The court order has been processed fail';
                    header("Location: ../views/sport-court-orders-management.php?notification=process_fail");
                }   
            }
        }
    }

    if(isset($_GET["option"])) {
        $_option = $_GET["option"];
        switch ($_option) {
            case "process_payment_court_order": 
                $court_order = new Court_Order_Controller();
                $court_order->process_payment_court_order();
            break;
            case "process_receive_court_order": 
                $court_order = new Court_Order_Controller();
                $court_order->process_receive_court_order();
            break;
            case "process_refunded_court_order": 
                $court_order = new Court_Order_Controller();
                $court_order->process_refunded_court_order();
            break;
        }
    }   

    if(isset($_GET['notification'])) {
        $_notification = $_GET['notification'];

        echo "
          <script>
            var overlayFrame = document.getElementById('overlay-wrapper');
            overlayFrame.style.display = 'block';
          </script>
        "; 

        if($_notification == "process_successful") {
          include "./notification/action-successful.php";
          echo "
            <script>
              var message = document.getElementById('action-successful-message');
              message.textContent = 'Bạn đã xử lý đơn đặt sân thành công';

              var btn_back = document.getElementById('admin-management-button');
              btn_back.textContent = 'Trở về quản lý đơn đặt sân';
              btn_back.href = './sport-court-orders-management.php';
              btn_back.style.fontSize = '12.5px';
            </script>
          ";
        } else if($_notification == "process_fail") {
          include "./notification/warning.php"; 
          echo "
            <script>
              var warningQuestion = document.getElementById('warning-question');
              warningQuestion.textContent ='Bạn đã thực hiện thao tác xử lý đơn đặt sân!';
              
              var warningExplanation = document.getElementById('warning-explanation');
              warningExplanation.textContent = 'Chúng tôi rất tiếc khi thông báo rằng đơn đặt sân đã không được xử lý thành công';

              var btn_ok = document.getElementById('war-act-ok');
              btn_ok.href = './sport-court-orders-management.php';
            </script>
          ";
        } 
    }

    //Thay đổi CSS của thẻ li đang được chọn
    $court_order_state_id = isset($_GET['court_order_state_id']) ? $_GET['court_order_state_id'] : '0'; // Mặc định court_order_state_id = '0'

    // Lấy URL hiện tại
    $current_url = $_SERVER['PHP_SELF'];

    // Kiểm tra nếu URL hiện tại là ../views/sport-court-orders-management.php
    if (strpos($current_url, 'sport-court-orders-management.php') !== false) {
        echo "
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    var liElement = document.getElementById('li-court-order-state-".$court_order_state_id."');
                    liElement.style.borderBottom = '2px solid #285D8F';

                    var aElement = document.getElementById('a-court-order-state-".$court_order_state_id."')
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