<?php
    require_once "../models/respond-model.php";

    class Respond_Controller {
        public $respond;

        public function __construct() {
            $this->respond = new respond();
        }

        public function laugh() {
            //các hàm để điều hướng từ views đến model của đối tượng respond để làm việc với database,
            //cũng như lấy data từ model đổ lên views
        }
    }
?>