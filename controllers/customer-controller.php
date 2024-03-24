<?php
    require_once "../models/customer-model.php";

    class Customer_Controller {
        public $customer;

        public function __construct() {
            $this->customer = new customer();
        }

        //1. Hàm hiển thị tất cả khách hàng
        public function view_all_customer() {
            return $result = $this->customer->view_all_customer();
        }
    }
?>