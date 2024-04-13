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

        public function handleImageUpload($id, $current_avatar) {
            if (isset($_FILES["avatar-input"])) {
                
                $file_name = $_FILES["avatar-input"]["name"];
                $file_extension = pathinfo($file_name, PATHINFO_EXTENSION); // Get the file extension
                $target_dir = "../upload/account-management/";
                
                // Generate the new file name with the account ID
                $new_file_name = "avatar-" . $id . "." . $file_extension;
                
                $target_file = $target_dir . $new_file_name; // Concatenate the file name with the directory
                $temp = $_FILES["avatar-input"]["tmp_name"];
            
                // Update the avatar URL in the database
                $this->account->updateAvatarURL($target_file, $id);
            
                // Check if the file has been moved successfully
                if (move_uploaded_file($temp, $target_file)) {
                    echo "Update hình ảnh thành công";
                    header("Location: ../views/customer-account-management.php");
                } else {
                    echo "Có lỗi xảy ra khi upload file";
                    echo $current_avatar;
                    // If the current avatar exists, delete it
                    if (!empty($current_avatar)) {
                        unlink($current_avatar);
                    }
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