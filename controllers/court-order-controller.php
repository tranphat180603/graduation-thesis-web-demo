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