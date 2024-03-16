<?php
    require_once "../models/connect.php";

    class review {
        private $review_id;
        private $review_star_rate;
        private $review_content;
        private $created_on_date;
        private $court_schedule_id;
        private $account_id;

        public function getReviewId() { return $this->review_id };
        public function getReviewStarRate() { return $this->review_star_rate };
        public function getReviewContent() { return $this->review_content };
        public function getCreatedOnDate() { return $this->created_on_date };
        public function getCourtScheduleId() { return $this->court_schedule_id };
        public function getAccountId() { return $this->account_id };

        public function setReviewId($review_id) { $this->review_id = $review_id };
        public function setReviewStarRate($review_star_rate) { $this->review_star_rate = $review_star_rate };
        public function setReviewContent($review_content) { $this->review_content = $review_content };
        public function setCreatedOnDate($created_on_date) { $this->created_on_date = $created_on_date };
        public function setCourtScheduleId($court_schedule_id) { $this->court_schedule_id = $court_schedule_id };
        public function setAccountId($account_id) { $this->account_id = $account_id };

        public function __construct() {
            $this->review_id = 0;
            $this->review_star_rate = 0;
            $this->review_content = "None";
            $this->created_on_date = "3000/12/30";
            $this->court_schedule_id = 0;
            $this->account_id = 0;
        }
        
        public function __construct($review_id, $review_star_rate, $review_content, $created_on_date, $court_schedule_id, $account_id) {
            $this->review_id = $review_id;
            $this->review_star_rate = $review_star_rate;
            $this->review_content = $review_content;
            $this->created_on_date = $created_on_date;
            $this->court_schedule_id = $court_schedule_id;
            $this->account_id = $account_id;
        }
    }
?>