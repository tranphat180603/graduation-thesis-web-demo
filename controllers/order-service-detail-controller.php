<?php
    require_once ($_SERVER['DOCUMENT_ROOT'] . "/NTP-Sports-Hub/models/order-service-detail-model.php");

    class Order_Service_Detail_Controller {
        public $order_service_detail;

        public function __construct() {
            $this->order_service_detail = new order_service_detail();
        }

        public function laugh() {
            //các hàm để điều hướng từ views đến model của đối tượng order_service_detail để làm việc với database,
            //cũng như lấy data từ model đổ lên views
        }
    }
?>