<?php 
    require_once ($_SERVER['DOCUMENT_ROOT'] . "/NTP-Sports-Hub/models/connect.php");

    class service{
        private $service_id;
        private $service_name;
        private $service_description;
        private $service_price;
        private $service_unit;
        private $created_on_date;
        private $court_type_id;
        private $account_id;

        public function getServiceId() { return $this->service_id; }
        public function getServiceName() { return $this->service_name; }
        public function getServiceDescription() { return $this->service_description; }
        public function getServicePrice() { return $this->service_price; }
        public function getServiceUnit() { return $this->service_unit; }
        public function getCreatedOnDate() { return $this->created_on_date; }
        public function getLastModifiedDate() { return $this->last_modified_date; }    
        public function getCourtTypeId() { return $this->court_type_id; }
        public function getAccountId() { return $this->account_id; }

        public function setServiceId() { $this->service_id = $service_id; }
        public function setServiceName() { $this->service_name = $service_name; }
        public function setServiceDescription() { $this->service_description = $service_description; }
        public function setServicePrice() { $this->service_price = $service_price; }
        public function setServiceUnit() { $this->service_unit = $service_unit; }
        public function setCreatedOnDate() { $this->created_on_date = $created_on_date; }
        public function setLastModifiedDate() { $this->last_modified_date = $last_modified_date; }
        public function setCourtTypeId() { $this->court_type_id = $court_type_id; }
        public function setAccountId() { $this->account_id = $account_id; }

        public function __construct($service_id = 0, $service_name = "", $service_description = "", $service_price = "", $service_unit = "", $created_on_date = "", $last_modified_date = "", $court_type_id = 0, $account_id = 0) {
            $this->service_id = $service_id;
            $this->service_name = $service_name;
            $this->service_description = $service_description;
            $this->service_price = $service_price;
            $this->service_unit = $service_unit;
            $this->created_on_date = $created_on_date;
            $this->last_modified_date = $last_modified_date;
            $this->court_type_id = $court_type_id;
            $this->account_id = $account_id;
        }

        //1. Hàm lấy dữ liệu tất cả  dịch vụ
        public function view_all_service() {
            //Tạo kết nối đến database
            $link = "";
            MakeConnection($link);

            $result = ExecuteDataQuery($link, "SELECT * FROM service");

            $data = array();

            while ($rows = mysqli_fetch_assoc($result)) {
                $service = new service($rows["service_id"], $rows["service_name"], $rows["service_description"], $rows["service_price"], $rows["service_unit"], $rows["created_on_date"], $rows["last_modified_date"], $rows["court_type_id"], $rows["account_id"]);
                array_push($data, $service);
            }

            //Giải phóng bộ nhớ
            ReleaseMemory($link, $result);

            return $data;
        }
    }
?>