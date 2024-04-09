<?php
    require_once ($_SERVER['DOCUMENT_ROOT'] . "/NTP-Sports-Hub/models/cart-service-detail-model.php");

    class Cart_Service_Detail_Controller {
        public $cart_service_detail;

        public function __construct() {
            $this->cart_service_detail = new cart_service_detail();
        }

        //1. Hàm lấy dữ liệu tất cả chi tiết giỏ hàng dịch vụ
        public function view_all_cart_service_detail() {
            return $result = $this->cart_service_detail->view_all_cart_service_detail();
        }

        //2. Hàm xóa chi tiết giỏ hàng dịch vụ
        public function delete_service_detail($cart_id, $court_schedule_id, $service_id) {                  
            return $result = $this->cart_service_detail->delete_service_detail($cart_id, $court_schedule_id, $service_id); 
        }
    }
?>