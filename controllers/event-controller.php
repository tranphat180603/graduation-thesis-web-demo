<?php
    require_once ($_SERVER['DOCUMENT_ROOT'] . "/NTP-Sports-Hub/models/event-model.php");

    class Event_Controller {
        public $event;

        public function __construct() {
            $this->event = new event();
        }

        public function laugh() {
            //các hàm để điều hướng từ views đến model của đối tượng event để làm việc với database,
            //cũng như lấy data từ model đổ lên views
        }
    }
?>