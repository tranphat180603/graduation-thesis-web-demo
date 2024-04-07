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
    }
?>