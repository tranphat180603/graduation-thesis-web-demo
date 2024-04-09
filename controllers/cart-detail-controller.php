<?php
    require_once ($_SERVER['DOCUMENT_ROOT'] . "/NTP-Sports-Hub/models/cart-detail-model.php");

    class Cart_Detail_Controller {
        public $cart_detail;

        public function __construct() {
            $this->cart_detail = new cart_detail();
        }

        //1. Hàm lấy dữ liệu tất cả chi tiết giỏ hàng
        public function view_all_cart_detail() {
            return $result = $this->cart_detail->view_all_cart_detail();
        }

        //2. Hàm xóa chi tiết giỏ hàng 
        public function delete_cart_detail($cart_id, $court_schedule_id) {                  
            return $result = $this->cart_detail->delete_cart_detail($cart_id, $court_schedule_id); 
        }

        //3. Hàm cập nhật chi tiết giỏ hàng khi xóa chi tiết giỏ hàng dịch vụ
        public function update_cart_detail_when_delete_or_update_or_insert_service_detail($cart_id, $court_schedule_id, $cart_item_service_amount) {                  
            return $result = $this->cart_detail->update_cart_detail_when_delete_or_update_or_insert_service_detail($cart_id, $court_schedule_id, $cart_item_service_amount); 
        }
    }  
?>