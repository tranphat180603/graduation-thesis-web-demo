<?php
    require_once "../models/account-model.php";

    class Account_Controller {
        public $account;

        public function __construct() {
            $this->account = new account();
        }

        public function laugh() {
            //các hàm để điều hướng từ views đến model của đối tượng account để làm việc với database,
            //cũng như lấy data từ model đổ lên views
        }
    }
?>