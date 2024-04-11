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

        //Hàm trả về thông tin của tất cả giá sân
        public function view_all_court_price_informations() {
            return $result = $this->court_price->getAllCourtPriceInformations();
        }

        //Hàm trả về thông tin của giá sân theo court_id
        public function view_court_price_by_court_id($court_id) {
            return $this->court_price->getCourtPriceByCourtID($court_id);
        }

        //Hàm trả về thông tin của giá sân theo court_price_id
        public function view_court_price_information_by_id() {
            $court_price_id = isset($_GET['court_price_id']) ? $_GET['court_price_id'] : ''; 
            if($court_price_id != ''){
                return $result = $this->court_price->getCourtPriceByID($court_price_id);
            }
        }
    }
?>