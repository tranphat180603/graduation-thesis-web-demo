<?php
    require_once ($_SERVER['DOCUMENT_ROOT'] . "/NTP-Sports-Hub/models/court-price-model.php");

    class Court_Price_Controller {
        public $court_price;

        public function __construct() {
            $this->court_price = new court_price();
        }

        public function getMinPrice()
        {
            return $this->court_price->getMinPrice();
        }
    
        public function getMaxPrice()
        {
            return $this->court_price->getMaxPrice();
        }
    }
?>