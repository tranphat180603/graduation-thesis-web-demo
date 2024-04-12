<?php
    require_once ($_SERVER['DOCUMENT_ROOT'] . "/NTP-Sports-Hub/models/service-model.php");

    class Service_Controller {
        public $service;

        public function __construct() {
            $this->service = new service();
        }

        //1. Hàm lấy dữ liệu tất cả dịch vụ
        public function view_all_service() {
            return $result = $this->service->view_all_service();
        }

        // Hàm trả về tổng dịch vụ (32 dịch vụ)
        public function view_total() {
            return $result = $this->service->getTotalService();
        }

        // Hàm trả về kết quả 32 dòng thông tin dịch vụ
        public function view_all_service_informations() {
            return $result = $this->service->getAllServiceInformations();
        }

        // Hàm trả về kết quả tổng số lượng dịch vụ theo court type
        public function view_total_services_by_court_type($court_type_id) {
            return $result = $this->service->getTotalServicesByCourtType($court_type_id);
        }

        //Hàm trả về thông tin các dịch vụ theo court type
        public function view_service_information_by_court_type_id($court_type_id){
            return $result = $this->service->getServiceByCourtType($court_type_id);
        }

        //Hàm trả về thông tin dịch vụ theo Service ID
        public function view_service_information_by_id(){
            if(isset($_GET['service_id'])){
                $service_ids = explode(",", $_GET['service_id']); //tách các service id đã chọn thành 1 mảng ngăn cách bởi dấu ,
                // kiểm tra mảng đã tách 
                if(count($service_ids) == 1){
                    return $result = $this->service->getServiceByID($service_ids[0]);
                }
            }
        }
      
        //Hàm cập nhật thông tin khi đã chỉnh sửa
        public function update_service($service) {
            $queryResult = $service -> updateService($service);
            // Kiểm tra giá trị của biến $queryResult sau khi duyệt mảng
            if ($queryResult) {
              // echo 'The service has been updated successfully';
              return true;    
            } else {
              // echo 'The service has been updated fail';
              return false;
            }               
        }
    
        // Hàm thêm dịch vụ      
        public function insert_service($service) {
            $queryResult = $service -> insertService($service);
            // Kiểm tra giá trị của biến $queryResult sau khi duyệt mảng
            if ($queryResult) {
              // echo 'The service has been inserted successfully';
              return true;    
            } else {
              // echo 'The service has been inserted fail';
              return false;
            }               
        }

        //Hàm xóa dịch vụ
        public function delete_service($service_id) {
            $queryResult = $this -> service -> deleteService($service_id);
            // Kiểm tra giá trị của biến $queryResult sau khi duyệt mảng
            if ($queryResult) {
              // echo 'The service has been delete successfully';
              return true;    
            } else {
              // echo 'The service has been delete fail';
              return false;
            }               
        }

        public function getAllServices() {
            // Gọi hàm getCourtRating từ model và trả về kết quả
            return $this->service->getAllServices();
        }
    }

    //Thay đổi CSS của thẻ li đang được chọn
    $courtType = isset($_GET['court_type_id']) ? $_GET['court_type_id'] : '0'; // Mặc định court_type_id = '0'

    // Lấy URL hiện tại
    $current_url = $_SERVER['PHP_SELF'];

    // Kiểm tra nếu URL hiện tại là ../views/service-management.php
    if (strpos($current_url, 'service-management.php') !== false) {
        echo "
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                var liElement = document.getElementById('li-court-type-".$courtType."');
                liElement.style.borderBottom = '2px solid #285D8F';

                var aElement = document.getElementById('a-court-type-".$courtType."')
                aElement.style.color = '#285D8F';
                aElement.style.fontSize = '16px';
                aElement.style.fontStyle = 'normal';
                aElement.style.fontWeight = '500';
                aElement.style.lineHeight = '24px';
                });
            </script>
        ";    
    }
?>