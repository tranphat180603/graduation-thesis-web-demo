<?php
    require_once "../models/court-image-model.php";

    class Court_Image_Controller {
        public $court_image;

        public function __construct() {
            $this->court_image = new court_image();
        }

        public function laugh() {
            //các hàm để điều hướng từ views đến model của đối tượng court_image để làm việc với database,
            //cũng như lấy data từ model đổ lên views
        }
    }
?>