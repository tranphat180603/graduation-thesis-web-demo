<?php
    require_once ($_SERVER['DOCUMENT_ROOT'] . "/NTP-Sports-Hub/models/cart-model.php");

    class Cart_Controller {
        public $cart;

        public function __construct() {
            $this->cart = new cart();
        }

        //1. Hàm lấy dữ liệu tất cả giỏ hàng
        public function view_all_cart() {
            return $result = $this->cart->view_all_cart();
        }
    }
?>