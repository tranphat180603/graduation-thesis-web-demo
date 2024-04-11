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

        public function view_all_court_images()
        {
            return $result = $this->court_image->view_all_court_images();
        }
        
        public function getGroupConcatImages()
        {
            return $result = $this->court_image->getGroupConcatImages();
        }

        // Hàm trả về thông tin của hình ảnh sân của tất cả các court
        public function view_all_court_images_informations() {
            return $result = $this->court_image->getAllCourtImageInformations();
        }

        //Hàm trả về thông tin hình ảnh sân theo court_id
        public function view_court_image_by_court_id($court_id) {
            return $result = $this->court_image-> getCourtImageByCourtID($court_id);
        }

        // Hàm trả về thông tin của hình ảnh sân theo court__image_id
        public function view_court_image_by_id($court_image_id) {
            $court_image_id = isset($_GET['court_image_id']) ? $_GET['court_image_id'] : ''; 
            if($court_image_id != ''){
                return $this->court_image->getCourtImageByID($court_image_id);
            }
        }
    }
?>