<?php
    require_once ($_SERVER['DOCUMENT_ROOT'] . "/NTP-Sports-Hub/models/cart-service-detail-model.php");

    class Cart_Service_Detail_Controller {
        public $cart_service_detail;

        public function __construct() {
            $this->cart_service_detail = new cart_service_detail();
        }

        public function laugh() {
            //các hàm để điều hướng từ views đến model của đối tượng cart_service_detail để làm việc với database,
            //cũng như lấy data từ model đổ lên views
        }
    }
?>