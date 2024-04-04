<?php
    require_once ($_SERVER['DOCUMENT_ROOT'] . "/NTP-Sports-Hub/models/connect.php");

    class respond {
        private $respond_id;
        private $respond_content;
        private $created_on_date;
        private $comment_id;
        private $respond_respond_id;
        private $account_id;

        public function getRespondId() { return $this->respond_id; }
        public function getRespondContent() { return $this->respond_content; }
        public function getCreatedOnDate() { return $this->created_on_date; }
        public function getCommentId() { return $this->comment_id; }
        public function getRespondRespondId() { return $this->respond_respond_id; }
        public function getAccountId() { return $this->account_id; }

        public function setRespondId($respond_id) { $this->respond_id = $respond_id; }
        public function setRespondContent($respond_content) { $this->respond_content = $respond_content; }
        public function setCreatedOnDate($created_on_date) { $this->created_on_date = $created_on_date; }
        public function setCommentId($comment_id) { $this->comment_id = $comment_id; }
        public function setRespondRespondId($respond_respond_id) { $this->respond_respond_id = $respond_respond_id; }
        public function setAccountId($account_id) { $this->account_id = $account_id; }
        
        public function __construct($respond_id = 0, $respond_content = "", $created_on_date = "", $comment_id = 0, $respond_respond_id = 0, $account_id = 0) {
            $this->respond_id = $respond_id;
            $this->respond_content = $respond_content;
            $this->created_on_date = $created_on_date;
            $this->comment_id = $comment_id;
            $this->respond_respond_id = $respond_respond_id;
            $this->account_id = $account_id;
        }
    }
?>