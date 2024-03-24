<?php
    require_once "../models/connect.php";

    class customer {
        private $customer_id;
        private $customer_fullname;
        private $customer_email_address;
        private $customer_phone_number;
        private $customer_gender;
        private $customer_date_of_birth;
        private $created_on_date;

        public function getCustomerId() { return $this->customer_id; }
        public function getCustomerFullname() { return $this->customer_fullname; }
        public function getCustomerEmailAddress() { return $this->customer_email_address; }
        public function getCustomerPhoneNumber() { return $this->customer_phone_number; }
        public function getCustomerGender() { return $this->customer_gender; }
        public function getCustomerDateOfBirth() { return $this->customer_date_of_birth; }
        public function getCreatedOnDate() { return $this->created_on_date; }

        public function setCustomerId($customerId) { return $this->customer_id = $customer_id; }
        public function setCustomerFullname($customer_fullname) { return $this->customer_fullname = $customer_fullname; }
        public function setCustomerEmailAddress($customer_email_address) { return $this->customer_email_address = $customer_email_address; }
        public function setCustomerPhoneNumber($customer_phone_number) { return $this->customer_phone_number = $customer_phone_number; }
        public function setCustomerGender($customer_gender) { return $this->customer_gender = $customer_gender; }
        public function setCustomerDateOfBirth($customer_date_of_birth) { return $this->customer_date_of_birth = $customer_date_of_birth; }
        public function setCreatedOnDate($created_on_date) { return $this->created_on_date = $created_on_date; }

        public function __construct($customer_id = 0, $customer_fullname = "", $customer_email_address = "", $customer_phone_number = "", $customer_gender = "", $customer_date_of_birth = "", $created_on_date = "") {
            $this->customer_id = $customer_id;
            $this->customer_fullname = $customer_fullname;
            $this->customer_email_address = $customer_email_address;
            $this->customer_phone_number = $customer_phone_number;
            $this->customer_gender = $customer_gender;
            $this->customer_date_of_birth = $customer_date_of_birth;
            $this->created_on_date = $created_on_date;
        }

        //1. Hàm hiển thị tất cả khách hàng
        public function view_all_customer() {
            //Tạo kết nối đến database
            $link = "";
            MakeConnection($link);

            //Kết nối và lấy dữ liệu tất cả tài khoản từ database
            $result = ExecuteDataQuery($link, "SELECT * FROM customer");
            $data = array();

            while ($rows = mysqli_fetch_assoc($result)) {
                $customer = new customer($rows["customer_id"], $rows["customer_fullname"], $rows["customer_email_address"], 
                                $rows["customer_phone_number"], $rows["customer_gender"], $rows["customer_date_of_birth"], 
                                $rows["created_on_date"]);
                array_push($data, $customer);
            }

            //Giải phóng bộ nhớ
            ReleaseMemory($link, $result);

            return $data;
        }
    }
?>