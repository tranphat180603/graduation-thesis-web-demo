<?php
    require_once "../models/court_schedule.php";

    class Court_schedule {
        public $court_schedule;

        public function _construct() {
            $this->court_schedule = new court_schedule();
        }

        public function laugh() {
            //các hàm để điều hướng từ views đến model của đối tượng court_schedule để làm việc với database,
            //cũng như lấy data từ model đổ lên views
        }
    }
?>