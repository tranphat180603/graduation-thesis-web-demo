<?php
    require_once "../models/connect.php";

    class court {
        private $court_id;
        private $court_name;
        private $created_on_date;
        private $last_modified_date;
        private $court_type_id;
        private $account_id;

        public function getCourtId() { return $this->court_id; };
        public function getCourtName() { return $this->court_name; };
        public function getCreatedOnDate() { return $this->created_on_date; };
        public function getLastModifiedDate() { return $this->last_modified_date; };
        public function getCourtTypeId() { return $this->court_type_id; };
        public function getAccountId() { return $this->account_id; };
        
        public function setCourtId($court_id) { $this->court_id = $court_id; };
        public function setCourtName($court_name) { $this->court_name = $court_name; };
        public function setCreatedOnDate($created_on_date) { $this->created_on_date = $created_on_date; };
        public function setLastModifiedDate($last_modified_date) { $this->last_modified_date = $last_modified_date; };
        public function setCourtTypeId($court_type_id) { $this->court_type_id = $court_type_id; };
        public function setAccountId($account_id) { $this->account_id = $account_id; };

        public function __construct() {
            $this->court_id = 0;
            $this->court_name = "None";
            $this->created_on_date = "3000/12/30";
            $this->last_modified_date = "3000/12/30";
            $this->court_type_id = 0;
            $this->account_id = 0;
        }

        public function __construct($court_id, $court_name, $created_on_date, $last_modified_date, $court_type_id, $account_id) {
            $this->court_id = $court_id;
            $this->court_name = $court_name;
            $this->created_on_date = $created_on_date;
            $this->last_modified_date = $last_modified_date;
            $this->court_type_id = $court_type_id;
            $this->account_id = $account_id;
        }
    }
?>