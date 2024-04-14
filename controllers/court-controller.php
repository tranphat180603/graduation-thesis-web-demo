
<?php
    require_once ($_SERVER['DOCUMENT_ROOT'] . "/NTP-Sports-Hub/models/court-model.php");

    class Court_Controller {
        public $court;

        public function __construct() {
            $this->court = new court();
        }
        
        //1. Hàm lấy dữ liệu tất cả sân
        public function view_all_court() {
            return $result = $this->court->view_all_court();
        }

        public function view_court_by_id() {
            $courtId = isset($_GET['id']) ? $_GET['id'] : 'NULL'; // Mặc định court_type_id = ''

            return $result = $this->court->view_court_by_id($courtId);
        }

        //2. Hàm hiển thị tổng số lượng sân theo loại sân
        public function view_court_by_court_type($court_type_id) {
            return $result = $this->court->view_court_by_court_type($court_type_id);
        }

        public function getCourtByType()
        {
            //Lấy dữ liệu của biến $_GET['court_type_id']
            $courtType = isset($_GET['court_type_id']) ? $_GET['court_type_id'] : '0'; // Mặc định court_type_id = '0'
            return $result = $this->court->getCourtByType($courtType);
        }

        // Hàm trả về tổng số lượng sân (17 sân)
        public function view_total() {
            return $result = $this->court->getTotalCourt();
        }

        // Hàm trả về tổng tin tất cả loại sân
        public  function view_all_court_informations() {
            return $result = $this->court->getAllCourtInformations();
        }

        //Hàm trả về tổng số lượng sân theo court type
        public function view_total_court_by_court_type($court_type_id) {
            return $result = $this->court->getTotalCourtByCourtType($court_type_id);
        }

        // Hàm trả về thông tin sân theo court type
        public function view_court_by_court_type_id($court_type_id) {
            return $result = $this->court->getCourtByCourtType($court_type_id);
        }

        //Hàm trả về thông tin sân cụ thể theo court id
        public function view_court_information_by_id(){
            $court_id = isset($_GET['court_id']) ? $_GET['court_id'] : '0'; 
            if($court_id != ''){
                return $result = $this->court->getCourtByID ($court_id);
            }
        }

        //Hàm thêm sân
        public function insert_court($court, $court_price, $court_images) {
            $queryResult = $this ->court -> insertCourt($court,$court_price, $court_images);
            // Kiểm tra giá trị của biến $queryResult sau khi duyệt mảng
            if ($queryResult) {
                // echo 'The court has been inserted successfully';
                return true;    
            } else {
                // echo 'The court has been inserted fail';
                return false;
            }                 
        }    

        //Hàm cập nhật thông tin khi đã chỉnh sửa
        public function update_court($court, $court_price) {
            $queryResult = $this ->court -> updateCourt($court,$court_price);
            // Kiểm tra giá trị của biến $queryResult sau khi duyệt mảng
            if ($queryResult) {
                // echo 'The court has been inserted successfully';
                return true;    
            } else {
                // echo 'The court has been inserted fail';
                return false;
            }                 
        }

        //Hàm cập nhật thông tin khi đã chỉnh sửa
        public function update_court2($court, $court_price, $court_image) {
            $queryResult = $this ->court -> updateCourt2($court,$court_price, $court_image);
            // Kiểm tra giá trị của biến $queryResult sau khi duyệt mảng
            if ($queryResult) {
                // echo 'The court has been inserted successfully';
                return true;    
            } else {
                // echo 'The court has been inserted fail';
                return false;
            }                 
        }

        //Hàm xóa sân
        public function delete_court($court_id) {
            $queryResult = $this->court->deleteCourt($court_id);
            // Kiểm tra giá trị của biến $queryResult sau khi duyệt mảng
            if ($queryResult) {
            // echo 'The court has been inserted successfully';
            return true;    
            } else {
            // echo 'The court has been inserted fail';
            return false;
            }                 
        }
        public function get_court_image($id){
            return $this->court->getCourtImage($id);
        }
    }

    //Thay đổi CSS của thẻ li đang được chọn
    $courtType = isset($_GET['court_type_id']) ? $_GET['court_type_id'] : '0'; // Mặc định court_type_id = '0'

    // Lấy URL hiện tại
    $current_url = $_SERVER['PHP_SELF'];

    // Kiểm tra nếu URL hiện tại là ../views/sport-courts-management.php
    if (strpos($current_url, 'sport-courts-management.php') !== false) {
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
