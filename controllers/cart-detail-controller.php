<?php
    require_once ($_SERVER['DOCUMENT_ROOT'] . "/NTP-Sports-Hub/models/cart-detail-model.php");

    class Cart_Detail_Controller {
        public $cart_detail;

        public function __construct() {
            $this->cart_detail = new cart_detail();
        }

        public function laugh() {
            //các hàm để điều hướng từ views đến model của đối tượng cart_detail để làm việc với database,
            //cũng như lấy data từ model đổ lên views
        }
    }
?>