<?php 
    require_once "../models/connect.php";

    class comment {
        private $comment_id;
        private $comment_content;
        private $created_on_date;
        private $court_id;
        private $account_id;

        public function getCommentId() { return $this->comment_id; }
        public function getCommentContent() { return $this->comment_content; }
        public function getCreatedOnDate() { return $this->created_on_date; }
        public function getCourtId() { return $this->court_id; }
        public function getAccountId() { return $this->account_id; }

        public function setCommentId($comment_id) { $this->comment_id = $comment_id; }
        public function setCommentContent($comment_content) { $this->comment_content = $comment_content; }
        public function setCreatedOnDate($created_on_date) { $this->created_on_date = $created_on_date; }
        public function setCourtId($court_id) { $this->court_id = $court_id; }
        public function setAccountId($account_id) { $this->account_id = $account_id; }

        public function __construct($comment_id, $comment_content, $created_on_date, $court_id, $account_id) {
            $this->comment_id = $comment_id;
            $this->comment_content = $comment_content;
            $this->created_on_date = $created_on_date;
            $this->court_id = $court_id;
            $this->account_id = $account_id;
        }
    }
?>