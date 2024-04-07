<?php
    require_once ($_SERVER['DOCUMENT_ROOT'] . "/NTP-Sports-Hub/models/event-model.php");

    class Event_Controller {
        public $event;

        public function __construct() {
            $this->event = new event();
        }

        //1. Hàm lấy dữ liệu tất cả sự kiện
        public function view_all_event() {
            return $result = $this->event->view_all_event();
        }
    }
?>