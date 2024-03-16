<?php
    require_once "../models/event.php";

    class Event {
        public $event;

        public function _construct() {
            $this->event = new event();
        }

        public function laugh() {
            //các hàm để điều hướng từ views đến model của đối tượng event để làm việc với database,
            //cũng như lấy data từ model đổ lên views
        }
    }
?>