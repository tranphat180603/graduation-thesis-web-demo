<?php 
    require_once ($_SERVER['DOCUMENT_ROOT'] . "/NTP-Sports-Hub/models/connect.php");

    class service{
        private $service_id;
        private $service_name;
        private $service_description;
        private $service_price;
        private $service_unit;
        private $service_state;
        private $created_on_date;
        private $last_modified_date;
        private $court_type_id;
        private $account_id;

        public function getServiceId() { return $this->service_id; }
        public function getServiceName() { return $this->service_name; }
        public function getServiceDescription() { return $this->service_description; }
        public function getServicePrice() { return $this->service_price; }
        public function getServiceUnit() { return $this->service_unit; }
        public function getServiceState() { return $this->service_state; }
        public function getCreatedOnDate() { return $this->created_on_date; }
        public function getLastModifiedDate() { return $this->last_modified_date; }    
        public function getCourtTypeId() { return $this->court_type_id; }
        public function getAccountId() { return $this->account_id; }

        public function setServiceId($service_id) { $this->service_id = $service_id; }
        public function setServiceName($service_name) { $this->service_name = $service_name; }
        public function setServiceDescription($service_description) { $this->service_description = $service_description; }
        public function setServicePrice($service_price) { $this->service_price = $service_price; }
        public function setServiceUnit($service_unit) { $this->service_unit = $service_unit; }
        public function setServiceState($service_state) { $this->service_state = $service_state; }
        public function setCreatedOnDate($created_on_date) { $this->created_on_date = $created_on_date; }
        public function setLastModifiedDate($last_modified_date) { $this->last_modified_date = $last_modified_date; }
        public function setCourtTypeId($court_type_id) { $this->court_type_id = $court_type_id; }
        public function setAccountId($account_id) { $this->account_id = $account_id; }

        public function __construct($service_id = 0, $service_name = "", $service_description = "", $service_price = "", $service_unit = "", $service_state="", $created_on_date = "", $last_modified_date = "", $court_type_id = 0, $account_id = 0) {
            $this->service_id = $service_id;
            $this->service_name = $service_name;
            $this->service_description = $service_description;
            $this->service_price = $service_price;
            $this->service_unit = $service_unit;
            $this->service_state = $service_state;
            $this->created_on_date = $created_on_date;
            $this->last_modified_date = $last_modified_date;
            $this->court_type_id = $court_type_id;
            $this->account_id = $account_id;
        }

        //1. Hàm lấy dữ liệu tất cả dịch vụ
        public function view_all_service() {
            //Tạo kết nối đến database
            $link = "";
            MakeConnection($link);

            $result = ExecuteDataQuery($link, "SELECT * FROM service");

            $data = array();

            while ($rows = mysqli_fetch_assoc($result)) {
                $service = new service($rows["service_id"], $rows["service_name"], $rows["service_description"], $rows["service_price"], $rows["service_unit"], $rows["service_state"], $rows["created_on_date"], $rows["last_modified_date"], $rows["court_type_id"], $rows["account_id"]);
                array_push($data, $service);
            }

            //Giải phóng bộ nhớ
            ReleaseMemory($link, $result);

            return $data;
        }

        public function getAllServices()
        {
            //Tạo kết nối đến database
            $link = "";
            MakeConnection($link);
    
            $result = ExecuteDataQuery($link, "SELECT * FROM service");
            $data = array();
    
            while ($row = mysqli_fetch_assoc($result)) {
                $service = new Service(
                    $row['service_id'],
                    $row['service_name'],
                    $row['service_description'],
                    $row['service_price'],
                    $row['service_unit'],
                    $row["service_state"], 
                    $row['created_on_date'],
                    $row['last_modified_date'],
                    $row['court_type_id'],
                    $row['account_id']
                );
                array_push($data, $service);
            }
    
            //Giải phóng bộ nhớ
            ReleaseMemory($link, $result);
    
            return $data;
        }

        // 3. Hàm hiển thị số lượng dịch vụ (32 dịch vụ)
        public function getTotalService() {
            $link = "";
            MakeConnection($link);
            $result = ExecuteDataQuery($link, "SELECT COUNT(*) FROM service WHERE service_state <> 'Đã xóa';");
            $resultToUse = mysqli_fetch_row($result);
            ReleaseMemory($link, $result);
            return $resultToUse;
        }

        // 4. Hàm hiển thị thông tin về dịch vụ  (32 dòng dịch vụ)
        public function getAllServiceInformations() {
            $link = "";
            MakeConnection($link);
            $result = ExecuteDataQuery($link, "SELECT * FROM service WHERE service_state <>'Đã xóa'");
            $resultToUse = array();

            while ($rows = mysqli_fetch_assoc($result)) {
                $service = new service(
                    $rows["service_id"],
                    $rows["service_name"],
                    $rows["service_description"],
                    $rows["service_price"],
                    $rows["service_unit"],
                    $rows["service_state"],
                    $rows["created_on_date"],
                    $rows["last_modified_date"],
                    $rows["court_type_id"],
                    $rows["account_id"]
                
                );
        
                array_push($resultToUse, $service); // Add service object to the result array
            }
        
            ReleaseMemory($link, $result);
            return $resultToUse;
        }

        // 5. Hàm hiển thị số lượng dịch vụ theo loại sân (court type)
        public function getTotalServicesByCourtType($court_type_id) {
            $link = "";
            MakeConnection($link);

            $result = ExecuteDataQuery($link, "SELECT COUNT(*) 
                FROM service s , court_type ct
                WHERE s.court_type_id = ct.court_type_id and s.service_state <> 'Đã xóa' and   s.court_type_id = ".$court_type_id.";");
            $row = mysqli_fetch_row($result);
            ReleaseMemory($link, $result);
            return $row;
        }

        // 4. Hàm hiển thị thông tin các dịch vụ theo loại sân
        public function getServiceByCourtType($court_type_id){
            $link = "";
            MakeConnection($link);
            $result = ExecuteDataQuery($link, "SELECT * FROM service s
                WHERE s.court_type_id = ".$court_type_id." and s.service_state <> 'Đã xóa';");
            $resultToUse = array();
            while ($rows = mysqli_fetch_assoc($result)) {
                $service = new service(
                    $rows["service_id"],
                    $rows["service_name"],
                    $rows["service_description"],
                    $rows["service_price"],
                    $rows["service_unit"],
                    $rows["service_state"],
                    $rows["created_on_date"],
                    $rows["last_modified_date"],
                    $rows["court_type_id"],
                    $rows["account_id"]
                );
                array_push($resultToUse, $service); // Add service object to the result array
            }
            ReleaseMemory($link, $result);
            return $resultToUse;
        }

        // 5. Hàm lấy thông tin dịch vụ theo id dịch vụ
        public function getServiceById($service_id) {
            $link = "";
            MakeConnection($link);
            $result = ExecuteDataQuery($link, "SELECT * FROM service s
                WHERE s.service_id = ".$service_id." and s.service_state <> 'Đã xóa';");
            
            $row = mysqli_fetch_row($result);

            //Giải phóng bộ nhớ
            ReleaseMemory($link, $result);

            return $row;
        }
            
        //6. Hàm cập nhật thông tin dịch vụ
        public function updateService($service) {
            $link = "";
            MakeConnection($link);
            $service_id = $service->getServiceID();
            $service_name = $service->getServiceName();
            $service_description = $service->getServiceDescription();  
            $service_price = $service->getServicePrice();
            $service_unit = $service->getServiceUnit();
            $last_modified_date = date('Y-m-d');
            $account_id = 1;

            $sql = "UPDATE service SET 
                service_name = '$service_name',
                service_description = '$service_description',
                service_price = '$service_price',
                service_unit = '$service_unit',
                last_modified_date = '$last_modified_date'
                WHERE service_id = '$service_id'";

            if (ExecuteNonDataQuery($link, $sql)) {
                return true;
            } else {
                return false;
            }
        }
        
        //7. Hàm thêm dịch vụ
        public function insertService($service) {
            $link = "";
            MakeConnection($link);
            $service_name = $service->getServiceName();
            $service_description = $service->getServiceDescription();
            $court_type_id = $service->getCourtTypeID();    
            echo $court_type_id;
            $service_price = $service->getServicePrice();
            $service_state = "Chưa xóa";
            $service_unit = $service->getServiceUnit();
            $created_on_date = date('Y-m-d');
            $last_modified_date = "";
            $account_id = 1;

            $sql = "INSERT INTO service(service_name, service_description, service_price, service_unit, service_state, created_on_date, last_modified_date, court_type_id, account_id) 
                    VALUES ('$service_name', '$service_description', '$service_price', '$service_unit','$service_state', '$created_on_date', '$last_modified_date', '$court_type_id', '$account_id');";

            if (ExecuteNonDataQuery($link, $sql)) {
                return true;
            } else {
                return false;
            }
        }

        //8. Hàm xóa dịch vụ 
        public function deleteService($service_id) {
            $link = "";
            MakeConnection($link);

            $service_ids = explode(",", $service_id); //tách các service id đã chọn thành 1 mảng ngăn cách bởi dấu ,
            
            // kiểm tra số lượng service id đã chọn
            if(count($service_ids) == 1) {
                $sql = "UPDATE service SET 
                        service_state = 'Đã xóa'
                        WHERE service_id = '$service_id'";
                if (ExecuteNonDataQuery($link, $sql)) {
                    return true;
                } else {
                    return false;
                }
            } else if (count($service_ids) > 1) {
                foreach($service_ids as $service_id) {
                    $sql = "UPDATE service SET 
                            service_state = 'Đã xóa'
                            WHERE service_id = '$service_id'";
                    ExecuteNonDataQuery($link, $sql);
                }
                return true;
            }
            
            return false;
        }
    }
?>