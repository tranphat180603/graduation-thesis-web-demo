<?php
    require_once ($_SERVER['DOCUMENT_ROOT'] . "/NTP-Sports-Hub/models/connect.php");

    class visitor {
        private $visitor_id;
        private $visitor_IP_address;
        private $created_on_date;

        public function getVisitorId() { return $this->visitor_id; }
        public function getVisitorIPAddress() { return $this->visitor_IP_address; }
        public function getCreatedOnDate() { return $this->created_on_date; }

        public function getVisitorId() { return $this->visitor_id = $visitor_id; }
        public function getVisitorIPAddress() { return $this->visitor_IP_address = $visitor_IP_address; }
        public function getCreatedOnDate() { return $this->created_on_date = $created_on_date; }

        public function __construct($visitor_id = 0, $visitor_IP_address = "", $created_on_date = "") {
            $this->visitor_id = $visitor_id;
            $this->visitor_IP_address = $visitor_IP_address;
            $this->created_on_date = $created_on_date;
        }
    }
?>