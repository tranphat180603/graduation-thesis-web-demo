<?php
    require_once ($_SERVER['DOCUMENT_ROOT'] . "/NTP-Sports-Hub/models/connect.php");

    class court_image {
        private $court_image_id;
        private $court_image;
        private $court_id;

        public function getCourtImageId() { return $this->court_image_id; }
        public function getCourtImage() { return $this->court_image; }
        public function getCourtId() { return $this->court_id; }

        public function setCourtImageId($court_image_id) { $this->court_image_id = $court_image_id; }
        public function setCourtImage($court_image) { $this->court_image = $court_image; }
        public function setCourtId($court_id) { $this->court_id = $court_id; }

        public function __construct($court_image_id = 0, $court_image = "", $court_id = 0) {
            $this->court_image_id = $court_image_id;
            $this->court_image = $court_image;
            $this->court_id = $court_id;
        }

        //1. Hàm lấy ra đường dẫn đến hình ảnh đầu tiên của sân
        public function get_first_court_image($court_id) {
            //Tạo kết nối đến database
            $link = "";
            MakeConnection($link);

            //Kết nối và lấy dữ liệu tổng số lượng đơn đặt sân sân từ database
            $result = ExecuteDataQuery($link, "SELECT court_image FROM court_image WHERE court_id = $court_id LIMIT 1");

            $row = mysqli_fetch_row($result);
            
            //Giải phóng bộ nhớ
            ReleaseMemory($link, $result);

            return $row;
        }

        // 2. Hàm lấy tất cả các ảnh của các sân từ cơ sở dữ liệu.
        public function view_all_court_images()
        {
            // Tạo kết nối đến database
            $link = "";
            MakeConnection($link);

            // Kết nối và lấy dữ liệu tất cả các ảnh của các sân từ database
            $result = ExecuteDataQuery($link, "SELECT * FROM court_image");
            $data = array();

            while ($rows = mysqli_fetch_assoc($result)) {
                $court_image = new court_image($rows["court_image_id"], $rows["court_image"], $rows["court_id"]);
                array_push($data, $court_image);
            }

            // Giải phóng bộ nhớ
            ReleaseMemory($link, $result);

            return $data;
        }
        
        // 3. Hàm lấy tất cả các ảnh của các sân và ghép chúng lại thành một chuỗi sử dụng GROUP_CONCAT.
        public function getGroupConcatImages()
        {
            // Tạo kết nối đến database
            $link = "";
            MakeConnection($link);

            // Kết nối và lấy dữ liệu ảnh của tất cả sân và sử dụng GROUP_CONCAT để ghép chúng lại thành một chuỗi
            $result = ExecuteDataQuery($link, "SELECT court_id, GROUP_CONCAT(court_image) AS court_images FROM court_image GROUP BY court_id");
            $data = array();

            while ($rows = mysqli_fetch_assoc($result)) {
                $court_image = new court_image(null, $rows["court_images"], $rows["court_id"]); // Truyền null cho court_image_id
                array_push($data, $court_image);
            }
            // Giải phóng bộ nhớ
            ReleaseMemory($link, $result);

            return $data;
        }

        // Hàm lấy ra thông tin của court image (51 dòng)
        public function getAllCourtImageInformations() {
            $link = "";
            MakeConnection($link);
            $result = ExecuteDataQuery($link, "SELECT * FROM court_image;");
            $resultToUse = array();
            while ($rows = mysqli_fetch_assoc($result)) {
                $courtImage = new court_image(
                    $rows["court_image_id"],
                    $rows["court_image"],
                    $rows["court_id"]
                );
                array_push($resultToUse, $courtImage);
            }
            ReleaseMemory($link, $result);
            return $resultToUse;
        }

        // Hàm lấy thông tin tất cả hình ảnh sân theo court id
        public function getCourtImageByCourtID($court_id){
            $link = "";
            MakeConnection($link);
            $result = ExecuteDataQuery($link, "SELECT * FROM court_image WHERE court_id = ".$court_id.";");
            $resultToUse = array();
            while ($rows = mysqli_fetch_assoc($result)) {
                $courtImage = new court_image(
                    $rows["court_image_id"],
                    $rows["court_image"],
                    $rows["court_id"]
                );
                array_push($resultToUse, $courtImage);
            }
            ReleaseMemory($link, $result);
            return $resultToUse;
        }
        
        // Hàm lấy thông tin tất cả hình ảnh sân theo court image id
        public function getCourtImageByID($court_image_id){
            $link = "";
            MakeConnection($link);
            $result = ExecuteDataQuery($link, "SELECT * FROM court_image WHERE court_image_id = ".$court_image_id.";");
            $resultToUse = array();
            while ($rows = mysqli_fetch_assoc($result)) {
                $courtImage = new court_image(
                    $rows["court_image_id"],
                    $rows["court_image"],
                    $rows["court_id"]
                );
                array_push($resultToUse, $courtImage);
            }
            ReleaseMemory($link, $result);
            return $resultToUse;
        }
    }
?>