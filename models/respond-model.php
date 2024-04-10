<?php
    require_once ($_SERVER['DOCUMENT_ROOT'] . "/NTP-Sports-Hub/models/connect.php");

    class respond {
        private $respond_id;
        private $respond_content;
        private $created_on_date;
        private $comment_id;
        private $respond_respond_id;
        private $account_id;
        private $responses;

        public function getRespondId() { return $this->respond_id; }
        public function getRespondContent() { return $this->respond_content; }
        public function getCreatedOnDate() { return $this->created_on_date; }
        public function getCommentId() { return $this->comment_id; }
        public function getRespondRespondId() { return $this->respond_respond_id; }
        public function getAccountId() { return $this->account_id; }
        public function getResponses() { return $this->responses; }

        public function setRespondId($respond_id) { $this->respond_id = $respond_id; }
        public function setRespondContent($respond_content) { $this->respond_content = $respond_content; }
        public function setCreatedOnDate($created_on_date) { $this->created_on_date = $created_on_date; }
        public function setCommentId($comment_id) { $this->comment_id = $comment_id; }
        public function setRespondRespondId($respond_respond_id) { $this->respond_respond_id = $respond_respond_id; }
        public function setAccountId($account_id) { $this->account_id = $account_id; }
        public function setResponses($responses) { $this->responses = $responses; }
        
        public function __construct($respond_id = 0, $respond_content = "", $created_on_date = "", $comment_id = 0, $respond_respond_id = 0, $account_id = 0) {
            $this->respond_id = $respond_id;
            $this->respond_content = $respond_content;
            $this->created_on_date = $created_on_date;
            $this->comment_id = $comment_id;
            $this->respond_respond_id = $respond_respond_id;
            $this->account_id = $account_id;
        }

        // 1. Hàm lấy tất cả các phản hồi từ cơ sở dữ liệu dựa trên ID của bình luận.
        public function getResponsesByCommentId($comment_id)
        {
            $link = MakeConnection($link);

            $query = "SELECT *
            FROM respond 
            WHERE respond.comment_id = $comment_id
            ORDER BY respond.created_on_date DESC;";

            $result = ExecuteDataQuery($link, $query);

            $responses = array();

            while ($row = mysqli_fetch_assoc($result)) {
                $respond = new respond();

                $respond->setRespondId($row['respond_id']);
                $respond->setCommentId($row['comment_id']);
                $respond->setRespondRespondId($row['respond_respond_id']);
                $respond->setAccountId($row['account_id']);
                $respond->setCreatedOnDate($row['created_on_date']);
                $respond->setRespondContent($row['respond_content']);

                $responses[] = $respond;
            }

            ReleaseMemory($link, $result);

            return $responses;
        }
        // 2. Hàm lấy tất cả các phản hồi từ cơ sở dữ liệu dựa trên ID của phản hồi.
        public function getResponsesByRespondId($respond_id)
        {
            $link = MakeConnection($link);

            $query = "SELECT *
                FROM respond 
                WHERE respond.respond_respond_id = $respond_id
                ORDER BY respond.created_on_date DESC";

            $result = ExecuteDataQuery($link, $query);

            $responses = array();

            while ($row = mysqli_fetch_assoc($result)) {
                // Tạo một đối tượng Respond từ kết quả truy vấn
                $respond = new respond();

                $respond->setRespondId($row['respond_id']);
                $respond->setCommentId($row['comment_id']);
                $respond->setRespondRespondId($row['respond_respond_id']);
                $respond->setAccountId($row['account_id']);
                $respond->setCreatedOnDate($row['created_on_date']);
                $respond->setRespondContent($row['respond_content']);
                $respond->setResponses($this->getResponsesByRespondId($row['respond_id']));
                $responses[] = $respond;
            }

            ReleaseMemory($link, $result);

            return $responses;
        }
        // 3. Hàm chèn một phản hồi mới vào cơ sở dữ liệu.
        public function insert_response($respond_content, $comment_id, $respond_respond_id, $account_id, $created_on_date = "")
        {
            // Tạo kết nối đến database
            $link = "";
            MakeConnection($link);

            // Tạo câu SQL sử dụng các giá trị đã được escape
            $sql = "INSERT INTO respond (respond_content, comment_id, respond_respond_id, account_id, created_on_date) 
                VALUES ('$respond_content', $comment_id, $respond_respond_id, $account_id, '$created_on_date')";

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