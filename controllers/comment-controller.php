<?php
    require_once ($_SERVER['DOCUMENT_ROOT'] . "/NTP-Sports-Hub/models/comment-model.php");

    class Comment_Controller {
        public $comment;

        public function __construct() {
            $this->comment = new comment();
        }

        public function laugh() {
            //các hàm để điều hướng từ views đến model của đối tượng comment để làm việc với database,
            //cũng như lấy data từ model đổ lên views
        }
    }
?>