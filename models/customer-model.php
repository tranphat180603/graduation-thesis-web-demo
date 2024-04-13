<?php
    require_once ($_SERVER['DOCUMENT_ROOT'] . "/NTP-Sports-Hub/models/connect.php");

    class customer {
        private $customer_id;
        private $customer_fullname;
        private $customer_email_address;
        private $customer_phone_number;
        private $customer_gender;
        private $account_id;
        private $customer_date_of_birth;
        private $created_on_date;

        public function getCustomerId() { return $this->customer_id; }
        public function getCustomerFullname() { return $this->customer_fullname; }
        public function getCustomerEmailAddress() { return $this->customer_email_address; }
        public function getCustomerPhoneNumber() { return $this->customer_phone_number; }
        public function getCustomerGender() { return $this->customer_gender; }
        public function getAccountId() { return $this->account_id; }
        public function getCustomerDateOfBirth() { return $this->customer_date_of_birth; }
        public function getCreatedOnDate() { return $this->created_on_date; }

        public function setCustomerId($customer_Id) { return $this->customer_id = $customer_id; }
        public function setCustomerFullname($customer_fullname) { return $this->customer_fullname = $customer_fullname; }
        public function setCustomerEmailAddress($customer_email_address) { return $this->customer_email_address = $customer_email_address; }
        public function setCustomerPhoneNumber($customer_phone_number) { return $this->customer_phone_number = $customer_phone_number; }
        public function setCustomerGender($customer_gender) { return $this->customer_gender = $customer_gender; }
        public function setAccountId($account_id) { return $this->account_id = $account_id; }
        public function setCustomerDateOfBirth($customer_date_of_birth) { return $this->customer_date_of_birth = $customer_date_of_birth; }
        public function setCreatedOnDate($created_on_date) { return $this->created_on_date = $created_on_date; }

        public function __construct($customer_id = 0, $customer_fullname = "", $customer_email_address = "", $customer_phone_number = "", $customer_gender = "", $account_id = 0, $customer_date_of_birth = "", $created_on_date = "") {
            $this->customer_id = $customer_id;
            $this->customer_fullname = $customer_fullname;
            $this->customer_email_address = $customer_email_address;
            $this->customer_phone_number = $customer_phone_number;
            $this->customer_gender = $customer_gender;
            $this->account_id = $account_id;
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
                                $rows["customer_phone_number"], $rows["customer_gender"], $rows["account_id"],
                                $rows["customer_date_of_birth"], $rows["created_on_date"]);
                array_push($data, $customer);
            }

            //Giải phóng bộ nhớ
            ReleaseMemory($link, $result);

            return $data;
        }

        public function updateCustomerData($customerID, $customerName, $email, $phoneNumber, $gender, $accountID, $birthdate, $date_created) {
            $link = MakeConnection($link);
            $query = "UPDATE customer SET 
            customer_fullname = '$customerName',
            customer_email_address = '$email',
            customer_phone_number = '$phoneNumber',
            customer_gender = '$gender',
            account_id = '$accountID',
            customer_date_of_birth = '$birthdate',
            created_on_date = '$date_created'
            WHERE customer_id = $customerID"; 

            $customerResult = ExecuteNonDataQuery($link, $query);

            if ($customerResult) {
                return true;
                ReleaseMemory($link, $customerResult);
            } else {
                throw new Exception("Error updating customer data: " . mysqli_error($link));
            }
        }

        public function fetchCustomerData($username) {
            $link = "";
            MakeConnection($link);
            $customerQuery = "SELECT *
            FROM customer c
            JOIN account a
            ON c.account_id = a.account_id
            WHERE a.account_sign_up_name = '$username'"; 
            $customerResult = ExecuteDataQuery($link, $customerQuery);

            if ($customerResult) {
                $customerInfo = mysqli_fetch_assoc($customerResult);
                $customer = new Customer($customerInfo["customer_id"],$customerInfo["customer_fullname"],$customerInfo["customer_email_address"],$customerInfo["customer_phone_number"],$customerInfo["customer_gender"],$customerInfo["account_id"],$customerInfo["customer_date_of_birth"],$customerInfo["created_on_date"]);
                return $customer;
                ReleaseMemory($link, $customer);
            }
        }

        public function countCustomer($year){
            $link = "";
            MakeConnection($link);

            //Kết nối và lấy dữ liệu tổng số lượng lịch sân từ database
            $result = ExecuteDataQuery($link,"SELECT COUNT(*) FROM customer WHERE YEAR(created_on_date) = $year");

            $row = mysqli_fetch_row($result);
            
            //Giải phóng bộ nhớ
            ReleaseMemory($link, $result);

            return $row;
        }

        public function countCustomerbyMonth($year){
            $link = "";
            $data = array();
            MakeConnection($link);

            //Kết nối và lấy dữ liệu tổng số lượng lịch sân từ database
            $result = ExecuteDataQuery($link,"SELECT DATE_FORMAT(created_on_date, '%M') AS month, COUNT(*) AS count FROM customer WHERE YEAR(created_on_date) = $year GROUP BY MONTH(created_on_date)");

            while ($row = mysqli_fetch_assoc($result)) {
                array_push($data, $row);
            }    
            
            //Giải phóng bộ nhớ
            ReleaseMemory($link, $result);

            return $data;
        }

        public function showNoti($message){
            echo '
            <div class="action-successful">
                <div class="successful-image">
                    <img src="../image/sport-court-types-management-img/successful.svg" alt="successful image">
                </div>
                <div class="message">
                    <p id="action-successful-message-title">Thông báo</p>
                    <p id="action-successful-message">'. $message . ' </p>
                </div>
                <div class="action-successful-button-group">
                    <a id="home-button" href="../index.php">Trở về trang chủ</a>
                    <a id="admin-management-button" href="../views/sport-court-types-management.php">Trở về quản lý loại sân</a>
                </div>
            </div>';
            echo '
            <script>
            var overlays = document.querySelectorAll(".overlay");
            overlays.forEach(function(overlay) {
                overlay.style.display = "block";
            });
            </script>
            ';
        }
    }
?>