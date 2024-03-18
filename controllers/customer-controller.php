<?php
    require_once "../models/customer-model.php";

    class Customer {
        public $customer;

        public function __construct() {
            $this->customer = new customer();
        }

        public function laugh() {
            //các hàm để điều hướng từ views đến model của đối tượng customer để làm việc với database,
            //cũng như lấy data từ model đổ lên views
        }
    }
?>