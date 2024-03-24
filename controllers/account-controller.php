<?php
    require_once "../models/account-model.php";

    class Account_Controller {
        public $account;

        public function __construct() {
            $this->account = new account();
        }

        //1. Hàm hiển thị tất cả tài khoản
        public function view_all_account() {
            return $result = $this->account->view_all_account();
        }
    }
?>