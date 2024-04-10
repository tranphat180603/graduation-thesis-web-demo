<?php 
    require_once ($_SERVER['DOCUMENT_ROOT'] . "/NTP-Sports-Hub/models/connect.php");

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

        public function __construct($comment_id = 0, $comment_content = "", $created_on_date = "", $court_id = 0, $account_id = 0) {
            $this->comment_id = $comment_id;
            $this->comment_content = $comment_content;
            $this->created_on_date = $created_on_date;
            $this->court_id = $court_id;
            $this->account_id = $account_id;
        }

        public function getCommentsByCourtId($court_id)
        {
            $link = "";
            MakeConnection($link);

            $query = "SELECT *
                FROM comment 
                WHERE comment.court_id = $court_id
                ORDER BY comment.created_on_date DESC;";

            $result = ExecuteDataQuery($link, $query);

            $comments = array();

            while ($row = mysqli_fetch_assoc($result)) {
                // Tạo một đối tượng Comment từ kết quả truy vấn
                $comment = new comment();
                $comment->setCommentId($row['comment_id']);
                $comment->setCourtId($row['court_id']);
                $comment->setAccountId($row['account_id']);
                $comment->setCreatedOnDate($row['created_on_date']);
                $comment->setCommentContent($row['comment_content']);
                $comments[] = $comment;
            }

            ReleaseMemory($link, $result);

            return $comments;
        }
        
        //1. Hàm đếm số lượng bình luận cho một sân bóng dựa trên ID của sân.
        public function countCommentsByCourtId($court_id)
        {
            $link = "";
            MakeConnection($link);

            $query = "SELECT COUNT(*) as total_comments 
                    FROM comment 
                    WHERE court_id = $court_id";

            $result = ExecuteDataQuery($link, $query);

            $total_comments = 0;

            // Sử dụng vòng lặp while để lấy kết quả
            while ($row = mysqli_fetch_assoc($result)) {
                $total_comments = $row['total_comments'];
            }

            ReleaseMemory($link, $result);

            return $total_comments;
        }

        //2. Hàm chèn một bình luận mới vào cơ sở dữ liệu.
        public function insert_comment($court_id, $account_id, $comment_content, $created_on_date = "")
        {
            // Tạo kết nối đến database
            $link = "";
            MakeConnection($link);

            // Tạo câu SQL sử dụng các giá trị đã được escape
            $sql = "INSERT INTO comment (court_id, account_id, comment_content, created_on_date) 
                    VALUES ($court_id, $account_id, '$comment_content', '$created_on_date')";
            // Thực hiện truy vấn
            $result = ExecuteNonDataQuery($link, $sql);

            // Kiểm tra xem kết quả có phải là một đối tượng không
            if ($result === true) {
                // Truy vấn thành công
                return true;
            } else {
                // Xử lý lỗi khi truy vấn không thành công
                return false;
            }
        }
    }
?>