<?php
    require_once "../models/court-price-model.php";

    class Court_Price_Controller {
        public $court_price;

        public function __construct() {
            $this->court_price = new court_price();
        }

        public function laugh() {
            //các hàm để điều hướng từ views đến model của đối tượng court_price để làm việc với database,
            //cũng như lấy data từ model đổ lên views
        }
    }
?>