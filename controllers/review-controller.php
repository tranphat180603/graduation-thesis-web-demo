<?php
    require_once "../models/review.php";

    class Review {
        public $review;

        public function __construct() {
            $this->review = new review();
        }

        public function laugh() {
            //các hàm để điều hướng từ views đến model của đối tượng review để làm việc với database,
            //cũng như lấy data từ model đổ lên views
        }
    }
?>