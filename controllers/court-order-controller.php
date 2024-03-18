<?php
    require_once "../models/court-order-model.php";

    class Court_Order_Controller {
        public $account;

        public function __construct() {
            $this->court_order = new court_order();
        }

        public function laugh() {
            //các hàm để điều hướng từ views đến model của đối tượng court_order để làm việc với database,
            //cũng như lấy data từ model đổ lên views
        }
    }
?>