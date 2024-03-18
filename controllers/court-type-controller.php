<?php
    require_once "../models/court-type-model.php";

    class Court_Type_Controller {
        public $court_type;

        public function __construct() {
            $this->court_type = new court_type();
        }

        public function laugh() {
            //các hàm để điều hướng từ views đến model của đối tượng court_type để làm việc với database,
            //cũng như lấy data từ model đổ lên views
        }
    }
?>