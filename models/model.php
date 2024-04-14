<?php
    require_once ($_SERVER['DOCUMENT_ROOT'] . "/NTP-Sports-Hub/models/connect.php");
    require_once ($_SERVER['DOCUMENT_ROOT'] . "/NTP-Sports-Hub/models/court-model.php");
    require_once ($_SERVER['DOCUMENT_ROOT'] . "/NTP-Sports-Hub/models/court-type-model.php");
    require_once ($_SERVER['DOCUMENT_ROOT'] . "/NTP-Sports-Hub/models/event-model.php");
    require_once ($_SERVER['DOCUMENT_ROOT'] . "/NTP-Sports-Hub/models/review-model.php");
    require_once ($_SERVER['DOCUMENT_ROOT'] . "/NTP-Sports-Hub/models/court-price-model.php");
    require_once ($_SERVER['DOCUMENT_ROOT'] . "/NTP-Sports-Hub/models/court-schedule-model.php");
    require_once ($_SERVER['DOCUMENT_ROOT'] . "/NTP-Sports-Hub/models/court-order-model.php");
    require_once ($_SERVER['DOCUMENT_ROOT'] . "/NTP-Sports-Hub/models/court-image-model.php");

    class Model
    {
        public $courttype;
        public $event;
        public $courtprice;
        public $review;
        public $courtorder;
        public $court;
        public $court_image;
        public $court_schedule;    
    
        public function __construct()
        {
            $this->courttype = new court_type();
            $this->event = new event();
            $this->courtprice = new court_price();
            $this->review = new review();
            $this->courtorder = new court_order();
            $this->court = new court();
            $this->court_image = new court_image();
            $this->court_schedule = new court_schedule();
    
        }
    
        public function view_all_court_type()
        {
            return $this->courttype->view_all_court_type();
        }
    
        public function getEventData()
        {
            return $this->event->getEventData();
        }
    
        public function getMinPrice()
        {
            return $this->courtprice->getMinPrice();
        }
    
        public function getMaxPrice()
        {
            return $this->courtprice->getMaxPrice();
        }
    
        public function getAverageRatingByCourtSchedule($court_id)
        {
            return $this->review->getAverageRatingByCourtSchedule($court_id);
        }
    
        public function getTotalCompletedOrdersByScheduleId()
        {
            return $this->courtorder->getTotalCompletedOrdersByScheduleId();
        }
        
        public function view_all_court()
        {
            return $this->court->view_all_court();
        }
    
        public function getGroupConcatImages()
        {
            return $this->court_image->getGroupConcatImages();
        }
    
        public function view_all_court_schedule() {
            return $this->court_schedule->view_all_court_schedule();
        }
    
        public function getCourtByType(){
            $courtType = isset($_GET['court_type_id']) ? $_GET['court_type_id'] : '0'; // Mặc định court_type_id = '0'
            return $this->court->getCourtByType($courtType);
        }

         public function view_all_court_images()
        {
            return $this->court_image->view_all_court_images();
        }
    }
?>