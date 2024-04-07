<?php
    require_once ($_SERVER['DOCUMENT_ROOT'] . "/NTP-Sports-Hub/models/court-image-model.php");

    class Court_Image_Controller {
        public $court_image;

        public function __construct() {
            $this->court_image = new court_image();
        }

        //1. Hàm lấy ra đường dẫn đến hình ảnh đầu tiên của sân
        public function get_first_court_image($court_id) {
            return $result = $this->court_image->get_first_court_image($court_id);
        }
    }
?>