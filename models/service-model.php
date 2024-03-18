<?php 
    require_once "../models/connect.php";

    class service{
        private $service_id;
        private $service_name;
        private $service_description;
        private $service_price;
        private $service_unit;
        private $created_on_date;
        private $court_type_id;
        private $account_id;

        public function getServiceId() { return $this->service_id; };
        public function getServiceName() { return $this->service_name; };
        public function getServiceDescription() { return $this->service_description; };
        public function getServicePrice() { return $this->service_price; };
        public function getServiceUnit() { return $this->service_unit; };
        public function getCreatedOnDate() { return $this->created_on_date; };
        public function getLastModifiedDate() { return $this->last_modified_date; };    
        public function getCourtTypeId() { return $this->court_type_id; };
        public function getAccountId() { return $this->account_id; };

        public function setServiceId() { $this->service_id = $service_id; };
        public function setServiceName() { $this->service_name = $service_name; };
        public function setServiceDescription() { $this->service_description = $service_description; };
        public function setServicePrice() { $this->service_price = $service_price; };
        public function setServiceUnit() { $this->service_unit = $service_unit; };
        public function setCreatedOnDate() { $this->created_on_date = $created_on_date; };
        public function setLastModifiedDate() { $this->last_modified_date = $last_modified_date; };
        public function setCourtTypeId() { $this->court_type_id = $court_type_id; };
        public function setAccountId() { $this->account_id = $account_id; };

        public function __construct() { 
            $this->service_id = 0;
            $this->service_name = "None";
            $this->service_description = "None";
            $this->service_price = 0;
            $this->service_unit = "None";
            $this->created_on_date = "3000/12/30";
            $this->last_modified_date = "3000/12/30";
            $this->court_type_id = 0;
            $this->account_id = 0
        }

        public function __construct($service_id, $service_name, $service_description, $service_price, $service_unit, $created_on_date, $last_modified_date, $court_type_id, $account_id) {
            $this->service_id = $service_id;
            $this->service_name = $service_name;
            $this->service_description = $service_description;
            $this->service_price = $service_price;
            $this->service_unit = $service_unit;
            $this->created_on_date = $created_on_date;
            $this->last_modified_date = $last_modified_date;
            $this->court_type_id = $court_type_id;
            $this->account_id = $account_id;
        }
    }
?>