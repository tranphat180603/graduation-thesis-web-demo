<?php
    require_once "../models/cart-model.php";

    class Cart {
        public $cart;

        public function __construct() {
            $this->cart = new cart();
        }

        public function laugh() {
            //các hàm để điều hướng từ views đến model của đối tượng cart để làm việc với database,
            //cũng như lấy data từ model đổ lên views
        }
    }
?>