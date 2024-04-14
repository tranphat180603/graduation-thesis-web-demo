<?php
    require_once ($_SERVER['DOCUMENT_ROOT'] . "/NTP-Sports-Hub/models/connect.php");

    class account {
        private $account_id;
        private $account_type;
        private $account_sign_up_name;
        private $account_name;
        private $account_avatar;
        private $account_hash_password;
        private $created_on_date;

        public function getAccountId() { return $this->account_id; }
        public function getAccountType() { return $this->account_type; }
        public function getAccountSignUpName() { return $this->account_sign_up_name; }
        public function getAccountName() { return $this-> account_name; }
        public function getAccountAvatar() { return $this-> account_avatar; }
        public function getAccountHashPassword() { return $this->account_hash_password; }
        public function getCreatedOnDate() { return $this->created_on_date; }

        public function setAccountId($account_id) { $this->account_id = $account_id; }
        public function setAccountType($account_type) { $this->account_type = $account_type; }
        public function setAccountSignUpName($account_sign_up_name) { $this->account_sign_up_name = $account_sign_up_name; }
        public function setAccountName($account_name) { $this->account_name = $account_name; }
        public function setAccountAvatar($account_avatar) { $this->account_avatar = $account_avatar; }
        public function setAccountHashPassword($account_hash_password) { $this->account_hash_password = $account_hash_password; }
        public function setCreatedOnDate($created_on_date) { $this->created_on_date = $created_on_date; }

        public function __construct($account_id = 0, $account_type = "", $account_sign_up_name = "", $account_name = "", $account_avatar = "", $account_hash_password = "", $created_on_date = "") {
            $this->account_id = $account_id;
            $this->account_type = $account_type;
            $this->account_sign_up_name = $account_sign_up_name;
            $this->account_name = $account_name;
            $this->account_avatar = $account_avatar;
            $this->account_hash_password = $account_hash_password;
            $this->created_on_date = $created_on_date;
        }

        //1. Hàm hiển thị tất cả tài khoản
        public function view_all_account() {
            //Tạo kết nối đến database
            $link = "";
            MakeConnection($link);

            //Kết nối và lấy dữ liệu tất cả tài khoản từ database
            $result = ExecuteDataQuery($link, "SELECT * FROM account");
            $data = array();

            while ($rows = mysqli_fetch_assoc($result)) {
                $account = new account($rows["account_id"], $rows["account_type"], $rows["account_sign_up_name"], 
                                $rows["account_name"], $rows["account_avatar"], $rows["account_hash_password"], $rows["created_on_date"]);
                array_push($data, $account);
            }

            //Giải phóng bộ nhớ
            ReleaseMemory($link, $result);

            return $data;
        }

        //2. Hàm lấy số lượng lịch sân trong giỏ hàng của tài khoản 
        public function get_customer_cart_amount($username) {
            //Tạo kết nối đến database
            $link = "";
            MakeConnection($link);

            //Kết nối và lấy dữ liệu tổng số lượng lịch sân từ database
            $result = ExecuteDataQuery($link, "SELECT COUNT(*) FROM account, cart, cart_detail
                                                WHERE account.account_sign_up_name = '$username'
                                                AND account.account_id = cart.account_id
                                                AND cart.cart_id = cart_detail.cart_id");

            $row = mysqli_fetch_row($result);
            
            //Giải phóng bộ nhớ
            ReleaseMemory($link, $result);

            return $row;
        }

        //3. Hàm lấy tên tài khoản từ tên đăng nhập của tài khoản 
        public function get_account_name($username) {
            //Tạo kết nối đến database
            $link = "";
            MakeConnection($link);

            //Kết nối và lấy dữ liệu tổng số lượng lịch sân từ database
            $result = ExecuteDataQuery($link, "SELECT account_name FROM account
                                                WHERE account.account_sign_up_name = '$username'");

            $row = mysqli_fetch_row($result);
            
            //Giải phóng bộ nhớ
            ReleaseMemory($link, $result);

            return $row;
        }

        public function fetchAccountData($username){
            $link = "";
            MakeConnection($link);
            $accountQuery = "SELECT * FROM account WHERE account_sign_up_name = '$username'";
            $accountResult = ExecuteDataQuery($link, $accountQuery);
            if($accountResult){
                $accountInfo = mysqli_fetch_assoc($accountResult);
                $account = new account($accountInfo['account_id'], $accountInfo['account_type'], $accountInfo['account_sign_up_name'], $accountInfo['account_name'], $accountInfo['account_avatar'], $accountInfo['account_hash_password'],$accountInfo['created_on_date']);
                return $account;
                ReleaseMemory($link, $account);
            }
        }
        
        public function updateAvatarURL($newURL, $id) {
            $link = MakeConnection($link);
                $updateQuery = "UPDATE account SET account_avatar = '$newURL' WHERE account_id = '$id'";
                $updateResult = ExecuteNonDataQuery($link, $updateQuery);
                ReleaseMemory($link, $updateResult);
                return $updateResult;
        }
    }
?>