<?php
    require_once ($_SERVER['DOCUMENT_ROOT'] . "/NTP-Sports-Hub/models/comment-model.php");

    class Comment_Controller {
        public $comment;

        public function __construct() {
            $this->comment = new comment();
        }

        public function getCommentsByCourtId($court_id)
        {
            $court_id = isset($_GET['id']) ? $_GET['id'] : null;
    
            // Gọi hàm getCommentsByCourtId từ model và trả về kết quả
            return $this->comment->getCommentsByCourtId($court_id);
        }
        public function countCommentsByCourtId($court_id)
        {
            $court_id = isset($_GET['id']) ? $_GET['id'] : null;
    
            // Gọi hàm getCommentsByCourtId từ model và trả về kết quả
            return $this->comment->countCommentsByCourtId($court_id);
        }
    
        public function addComment($court_id,  $account_id, $comment_content, $created_on_date = "")
        {
            // Gọi hàm insert_comment từ model và trả về kết quả (true/false)
            return $this->comment->insert_comment($court_id,  $account_id, $comment_content, $created_on_date);
        }
    }

    // Kiểm tra nếu là yêu cầu POST từ biểu mẫu
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        if(isset($_POST["court_id"]) && isset($_POST["account_id"]) && isset($_POST["comment_content"])) {
            // Khởi tạo controller
            $comment = new comment();
        
            // Lấy dữ liệu từ biểu mẫu
            $court_id = $_POST['court_id'] ? $_POST['court_id'] : null;
            $account_id = $_POST['account_id'] ? $_POST['account_id'] : null;
            $comment_content = $_POST['comment_content'] ? $_POST['comment_content'] : null;
            $created_on_date = date("Y-m-d"); // Lấy thời gian hiện tại
        
            // Thêm comment vào cơ sở dữ liệu
            $result = $comment->insert_comment($court_id, $account_id, $comment_content, $created_on_date);
        }
    }
?>