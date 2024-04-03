<?php
    require_once "../models/connect.php";

    class account {
        private $account_id;
        private $account_type;
        private $account_sign_up_name;
        private $account_name;
        private $account_avatar;
        private $account_password;
        private $customer_account_hash_password;
        private $created_on_date;
        private $customer_id;

        public function getAccountId() { return $this->account_id; }
        public function getAccountType() { return $this->account_type; }
        public function getAccountSignUpName() { return $this->account_sign_up_name; }
        public function getAccountName() { return $this-> account_name; }
        public function getAccountAvatar() { return $this-> account_avatar; }
        public function getAccountPassword() { return $this->account_password; }
        public function getCustomerAccountHashPassword() { return $this->customer_account_hash_password; }
        public function getCreatedOnDate() { return $this->created_on_date; }
        public function getCustomerId() { return $this->customer_id; }

        public function setAccountId($account_id) { $this->account_id = $account_id; }
        public function setAccountType($account_type) { $this->account_type = $account_type; }
        public function setAccountSignUpName($account_sign_up_name) { $this->account_sign_up_name = $account_sign_up_name; }
        public function setAccountName($account_name) { $this->account_name = $account_name; }
        public function setAccountAvatar($account_avatar) { $this->account_avatar = $account_avatar; }
        public function setAccountPassword($account_password) { $this->account_password = $account_password; }
        public function setCustomerAccountHashPassword($customer_account_hash_password) { $this->customer_account_hash_password = $customer_account_hash_password; }
        public function setCreatedOnDate($created_on_date) { $this->created_on_date = $created_on_date; }
        public function setCustomerId($customer_id) { $this->customer_id = $customer_id; }

        public function __construct($account_id = 0, $account_type = "", $account_sign_up_name = "", $account_name = "", $account_avatar = "", $account_password = "", $customer_account_hash_password = "", $created_on_date = "", $customer_id = 0) {
            $this->account_id = $account_id;
            $this->account_type = $account_type;
            $this->account_sign_up_name = $account_sign_up_name;
            $this->account_name = $account_name;
            $this->account_avatar = $account_avatar;
            $this->account_password = $account_password;
            $this->customer_account_hash_password = $customer_account_hash_password;
            $this->created_on_date = $created_on_date;
            $this->customer_id = $customer_id;
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
                                $rows["account_name"], $rows["account_avatar"], $rows["account_password"], 
                                $rows["customer_account_hash_password"], $rows["created_on_date"], $rows["customer_id"]);
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

        //3. Hàm lấy tên khách hàng từ tên đăng nhập của tài khoản
        public function get_customer_name($username) {
            //Tạo kết nối đến database
            $link = "";
            MakeConnection($link);

            //Kết nối và lấy dữ liệu tổng số lượng lịch sân từ database
            $result = ExecuteDataQuery($link, "SELECT customer_fullname FROM account, customer
                                                WHERE account.account_sign_up_name = '$username'
                                                AND account.customer_id = customer.customer_id");

            $row = mysqli_fetch_row($result);
            
            //Giải phóng bộ nhớ
            ReleaseMemory($link, $result);

            return $row;
        }
    }
?>