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
    }
?>