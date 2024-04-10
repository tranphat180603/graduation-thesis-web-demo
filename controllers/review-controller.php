<?php
    require_once ($_SERVER['DOCUMENT_ROOT'] . "/NTP-Sports-Hub/models/review-model.php");

    class Review_Controller {
        public $review;

        public function __construct() {
            $this->review = new review();
        }

        public function getCourtRating($court_id) {
            // Gọi hàm getCourtRating từ model và trả về kết quả
            return $this->review->getCourtRating($court_id);
        }

        public function getReviewData($court_id) {
            // Gọi hàm getCourtRating từ model và trả về kết quả
            return $this->review->getReviewData($court_id);
        }

        public function getReviewCountByCourtId($court_id) {
            // Gọi hàm getCourtRating từ model và trả về kết quả
            return $this->review->getReviewCountByCourtId($court_id);
        }

        public function getAverageRatingByCourtSchedule($court_id) {
            // Gọi hàm getCourtRating từ model và trả về kết quả
            return $this->review->getAverageRatingByCourtSchedule($court_id);
        }
        
        public function addReview($review_star_rate, $review_content,$created_on_date = "", $court_schedule_id, $account_id) {
            // Gọi hàm addReview từ model và trả về kết quả
            return $this->review->addReview($review_star_rate, $review_content, $created_on_date , $court_schedule_id, $account_id);
        }
    }
?>