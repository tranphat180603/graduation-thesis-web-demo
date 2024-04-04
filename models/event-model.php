<?php
    require_once ($_SERVER['DOCUMENT_ROOT'] . "/NTP-Sports-Hub/models/connect.php");

    class event {
        private $event_id;
        private $event_name;
        private $event_start_date;
        private $event_end_date;
        private $event_description;
        private $event_image;
        private $event_preferential_rate;
        private $event_preferential_item;
        private $event_state;
        private $created_on_date;
        private $last_modified_date;
        private $account_id;

        public function getEventId() { return $this->event_id; }
        public function getEventName() { return $this->event_name; }
        public function getEventStartDate() { return $this->event_start_date; }
        public function getEventEndDate() { return $this->event_end_date; }
        public function getEventDescription() { return $this->event_description; }
        public function getEventImage() { return $this->event_image; }
        public function getEventPreferentialRate() { return $this->event_preferential_rate; }
        public function getEventPreferentialItem() { return $this->event_preferential_item; }
        public function getEventState() { return $this->event_state; }
        public function getCreatedOnDate() { return $this->created_on_date; }
        public function getLastModifiedDate() { return $this->last_modified_date; }
        public function getAccountId() { return $this->account_id; }

        public function setEventId($event_id) { $this->event_id = $event_id; }
        public function setEventName($event_name) { $this->event_name = $event_name; }
        public function setEventStartDate($event_start_date) { $this->event_start_date = $event_start_date; }
        public function setEventEndDate($event_end_date) { $this->event_end_date = $event_end_date; }
        public function setEventDescription($event_description) { $this->event_description = $event_description; }
        public function setEventImage($event_image) { $this->event_image = $event_image; }
        public function setEventPreferentialRate($event_preferential_rate) { $this->event_preferential_rate = $event_preferential_rate; }
        public function setEventPreferentialItem($event_preferential_item) { $this->event_preferential_item = $event_preferential_item; }
        public function setEventState($event_state) { $this->event_state = $event_state; }
        public function setCreatedOnDate($created_on_date) { $this->created_on_date = $created_on_date; }
        public function setLastModifiedDate($last_modified_date) { $this->last_modified_date = $last_modified_date; }
        public function setAccountId($account_id) { $this->account_id = $account_id; }
        
        public function __construct($event_id = 0, $event_name = "", $event_start_date = "", $event_end_date = "", $event_description = "", $event_image = "", $event_preferential_rate = "", $event_preferential_item = "", $event_state = "", $created_on_date = "", $last_modified_date = "", $account_id = 0) {
            $this->event_id = $event_id;
            $this->event_name = $event_name;
            $this->event_start_date = $event_start_date;
            $this->event_end_date = $event_end_date;
            $this->event_description = $event_description;
            $this->event_image = $event_image;
            $this->event_preferential_rate = $event_preferential_rate;
            $this->event_preferential_item = $event_preferential_item;
            $this->event_state = $event_state;
            $this->created_on_date = $created_on_date;
            $this->last_modified_date = $last_modified_date;
            $this->account_id = $account_id;
        }
    }
?>