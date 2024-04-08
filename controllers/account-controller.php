<?php
    require_once ($_SERVER['DOCUMENT_ROOT'] . "/NTP-Sports-Hub/models/account-model.php");

    class Account_Controller {
        public $account;

        public function __construct() {
            $this->account = new account();
        }

        //1. Hàm hiển thị tất cả tài khoản
        public function view_all_account() {
            return $result = $this->account->view_all_account();
        }

        //2. Hàm lấy số lượng đơn đặt sân trong giỏ hàng của tài khoản
        public function get_customer_cart_amount($username) {
            return $result = $this->account->get_customer_cart_amount($username);
        }

        //3. Hàm lấy tên khách hàng từ tên đăng nhập của tài khoản
        public function get_account_name($username) {
            return $result = $this->account->get_account_name($username);
        }
    }
?>