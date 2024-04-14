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

        public function handleImageUpload($id) {
            if (isset($_FILES["avatar-input"])) {
                $file_name = $_FILES["avatar-input"]["name"];
                $target_dir = "../upload/account-management/";
        
                $target_file = $target_dir . $file_name; // Concatenate the file name with the directory
                $temp = $_FILES["avatar-input"]["tmp_name"];
        
                // Update the avatar URL in the database
                $this->account->updateAvatarURL($target_file, $id);
        
                // Check if the file has been moved successfully
                if (move_uploaded_file($temp, $target_file)) {
                    echo "123";
                } else {
                    header("Location: ../views/statistical-report.php");
                }
            } else {
                echo "Lỗi";
            }
        }
        

        public function displayAccountData($username) {
            $acc = $this->account->fetchAccountData($username);
            if ($acc) {
                return $acc;
            }
            else{
                echo "Failed to fetch account data.";
            }
        }
    }
?>