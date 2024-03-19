<?php
    require_once "../models/connect.php";

    class court_price {
        private $court_price_id;
        private $court_start_time;
        private $court_end_time;
        private $court_time_frame;
        private $court_weekday_price;
        private $court_weekend_price;
        private $court_price_frame;
        private $court_id;

        public function getCourtPriceId() { return $this->court_price_id; }
        public function getCourtStartTime() { return $this->court_start_time; }
        public function getCourtEndTime() { return $this->court_end_time; }
        public function getCourtTimeFrame() { return $this->court_time_frame; }
        public function getCourtWeekdayPrice() { return $this->court_weekday_price; }
        public function getCourtWeekendPrice() { return $this->court_weekend_price; }
        public function getCourtPriceFrame() { return $this->court_price_frame; }
        public function getCourtId() { return $this->court_id; }

        public function setCourtPriceId($court_price_id) { $this->court_price_id = $court_price_id; }
        public function setCourtStartTime($court_start_time) { $this->court_start_time = $court_start_time; }
        public function setCourtEndTime($court_end_time) { $this->court_end_time = $court_end_time; }
        public function setCourtTimeFrame($court_time_frame) { $this->court_time_frame = $court_time_frame; }
        public function setCourtWeekdayPrice($court_weekday_price) { $this->court_weekday_price = $court_weekday_price; }
        public function setCourtWeekendPrice($court_weekend_price) { $this->court_weekend_price = $court_weekend_price; }
        public function setCourtPriceFrame($court_price_frame) { $this->court_price_frame = $court_price_frame; }
        public function setCourtId($court_id) { $this->court_id = $court_id; }
        
        public function __construct($court_price_id = 0, $court_start_time = "", $court_end_time = "", $court_time_frame = "", $court_weekday_price = 0, $court_weekend_price = 0, $court_price_frame = "", $court_id = 0) {
            $this->court_price_id = $court_price_id;
            $this->court_start_time = $court_start_time;
            $this->court_end_time = $court_end_time;
            $this->court_time_frame = $court_time_frame;
            $this->court_weekday_price = $court_weekday_price;
            $this->court_weekend_price = $court_weekend_price;
            $this->court_price_frame = $court_price_frame;
            $this->court_id = $court_id;
        }
    }
?>