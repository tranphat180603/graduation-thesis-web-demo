<?php
    require_once ($_SERVER['DOCUMENT_ROOT'] . "/NTP-Sports-Hub/models/connect.php");

    class review {
        private $review_id;
        private $review_star_rate;
        private $review_content;
        private $created_on_date;
        private $court_schedule_id;
        private $account_id;

        public function getReviewId() { return $this->review_id; }
        public function getReviewStarRate() { return $this->review_star_rate; }
        public function getReviewContent() { return $this->review_content; }
        public function getCreatedOnDate() { return $this->created_on_date; }
        public function getCourtScheduleId() { return $this->court_schedule_id; }
        public function getAccountId() { return $this->account_id; }

        public function setReviewId($review_id) { $this->review_id = $review_id; }
        public function setReviewStarRate($review_star_rate) { $this->review_star_rate = $review_star_rate; }
        public function setReviewContent($review_content) { $this->review_content = $review_content; }
        public function setCreatedOnDate($created_on_date) { $this->created_on_date = $created_on_date; }
        public function setCourtScheduleId($court_schedule_id) { $this->court_schedule_id = $court_schedule_id; }
        public function setAccountId($account_id) { $this->account_id = $account_id; }
        
        public function __construct($review_id = 0, $review_star_rate = 0, $review_content = "", $created_on_date = "", $court_schedule_id = 0, $account_id = 0) {
            $this->review_id = $review_id;
            $this->review_star_rate = $review_star_rate;
            $this->review_content = $review_content;
            $this->created_on_date = $created_on_date;
            $this->court_schedule_id = $court_schedule_id;
            $this->account_id = $account_id;
        }

        //1. Hàm lấy điểm đánh giá trung bình của sân theo lịch sân và trả về điểm đánh giá trung bình (đã làm tròn 1 chữ số)
        public function getAverageRatingByCourtSchedule($courtId)
        {
            // Tạo kết nối đến cơ sở dữ liệu
            $link = "";
            MakeConnection($link);

            // Truy vấn SQL để lấy trung bình điểm đánh giá từ bảng review dựa trên court_id
            $result = ExecuteDataQuery($link, "SELECT ROUND(COALESCE(AVG(r.review_star_rate), 0), 1) AS average_rating 
                                            FROM court_schedule cs 
                                            LEFT JOIN review r ON cs.court_schedule_id = r.court_schedule_id 
                                            WHERE cs.court_id = '$courtId'");

            // Lấy dữ liệu từ kết quả truy vấn
            $row = mysqli_fetch_assoc($result);
            $averageRating = $row['average_rating'];

            // Giải phóng bộ nhớ
            ReleaseMemory($link, $result);

            return $averageRating;
        }

        //2. Hàm lấy số lượng đánh giá của sân dựa trên court_id và trả về số lượng đánh giá
        public function getReviewCountByCourtId($court_id)
        {
            // Tạo kết nối đến cơ sở dữ liệu
            $link = "";
            MakeConnection($link);

            // Truy vấn SQL để lấy trung bình điểm đánh giá từ bảng review dựa trên court_id
            $result = ExecuteDataQuery($link, "SELECT COUNT(DISTINCT review_id) AS review_count
                                            FROM review r
                                            LEFT JOIN court_schedule cs ON cs.court_schedule_id = r.court_schedule_id 
                                            WHERE cs.court_id = $court_id");

            // Lấy dữ liệu từ kết quả truy vấn
            $row = mysqli_fetch_assoc($result);
            $review_count = $row['review_count'];

            // Giải phóng bộ nhớ
            ReleaseMemory($link, $result);

            return $review_count;
        }

        //3. Hàm lấy thông tin đánh giá của sân dựa trên court_id và trả về một mảng các đối tượng đánh giá
        public function getCourtRating($court_id)
        {
            $link = "";
            MakeConnection($link);
            $reviews = array(); // Tạo một mảng kết quả

            $query = "SELECT c.court_id, c.court_name, COUNT(r.review_id) AS total_reviews,
                    ROUND(COALESCE(AVG(r.review_star_rate), 0), 1) AS review_star_rate,
                    SUM(CASE WHEN r.review_star_rate = 1 THEN 1 ELSE 0 END) AS rating_1,
                    SUM(CASE WHEN r.review_star_rate = 2 THEN 1 ELSE 0 END) AS rating_2,
                    SUM(CASE WHEN r.review_star_rate = 3 THEN 1 ELSE 0 END) AS rating_3,
                    SUM(CASE WHEN r.review_star_rate = 4 THEN 1 ELSE 0 END) AS rating_4,
                    SUM(CASE WHEN r.review_star_rate = 5 THEN 1 ELSE 0 END) AS rating_5
                    FROM court c
                    LEFT JOIN court_schedule cs ON c.court_id = cs.court_id
                    LEFT JOIN review r on r.court_schedule_id = cs.court_schedule_id 
                    WHERE c.court_id = $court_id
                    GROUP BY c.court_id, c.court_name
                    ORDER BY c.court_id;";

            $result = ExecuteDataQuery($link, $query);

            while ($row = mysqli_fetch_assoc($result)) {
                $review = new Review(
                    $row['court_id'],
                    $row['court_name'],
                    $row['total_reviews'],
                    $row['review_star_rate'],
                    $row['rating_1'],
                    $row['rating_2'],
                    $row['rating_3'],
                    $row['rating_4'],
                    $row['rating_5']
                );
                // Thêm mỗi dòng kết quả vào mảng kết quả

                array_push($reviews, $row);
            }
            ReleaseMemory($link, $result);
            return $reviews; // Trả về mảng kết quả
        }

        //4. Hàm lấy thông tin đánh giá của sân dựa trên court_id và trả về một mảng các đối tượng đánh giá
        public function getReviewData($court_id)
        {
            $link = MakeConnection($link);

            $query = "SELECT review.review_id, court.court_id, account.account_id,account.account_avatar,account.account_name, 
                review.created_on_date, review.review_star_rate, review.review_content, court_schedule.court_schedule_id 
                FROM review JOIN account ON review.account_id = account.account_id 
                JOIN court_schedule ON review.court_schedule_id = court_schedule.court_schedule_id 
                JOIN court ON court_schedule.court_id = court.court_id 
                WHERE court.court_id = $court_id
                ORDER BY review.created_on_date DESC, review_star_rate DESC;;";

            $result = ExecuteDataQuery($link, $query);

            $reviews = array();

            while ($row = mysqli_fetch_assoc($result)) {

                // Tạo một đối tượng Account từ kết quả truy vấn


                // Tạo một đối tượng Review từ kết quả truy vấn
                $review = new review();
                $review->setReviewId($row['review_id']);
                $review->setReviewStarRate($row['review_star_rate']);
                $review->setReviewContent($row['review_content']);
                $review->setCreatedOnDate($row['created_on_date']);
                $review->setCourtScheduleId($row['court_schedule_id']);
                $review->setAccountId($row['account_id']);

                // Gán đối tượng Account vào đối tượng Review

                // Thêm đối tượng Review vào mảng
                $reviews[] = $review;
            }

            ReleaseMemory($link, $result);

            return $reviews;
        }

        //5. Hàm thêm đánh giá mới vào cơ sở dữ liệu và trả về true nếu thành công, false nếu thất bại
        public function addReview($review_star_rate, $review_content, $created_on_date = "", $court_schedule_id, $account_id,)
        {
            // Tạo kết nối đến cơ sở dữ liệu
            $link = "";
            MakeConnection($link);

            // Chuẩn bị câu lệnh SQL để chèn dữ liệu mới vào bảng review
            $query = "INSERT INTO review (review_star_rate, review_content, created_on_date, court_schedule_id, account_id)
                VALUES ('$review_star_rate', '$review_content', '$created_on_date', '$court_schedule_id', '$account_id')";
            $result = ExecuteNonDataQuery($link, $query);

            // Kiểm tra kết quả thực thi câu lệnh SQL
            if ($result) {
                // Nếu thành công, trả về true
                return true;
            } else {
                // Nếu thất bại, trả về false
                return false;
            }
        }

        //6. Hàm kiểm tra khách hàng đã đánh giá đơn đặt sân chưa
        public function checkReviewed($court_order_id, $customer_account_id)
        {
            // Tạo kết nối đến cơ sở dữ liệu
            $link = "";
            MakeConnection($link);

            // Truy vấn SQL để đếm số lượng đánh giá dựa trên thông tin về đơn đặt sân
            $result = ExecuteDataQuery($link, "SELECT COUNT(*) AS review_count 
                                            FROM review 
                                            INNER JOIN court_schedule ON court_schedule.court_schedule_id = review.court_schedule_id
                                            INNER JOIN court_order ON court_order.court_schedule_id = court_schedule.court_schedule_id
                                            WHERE court_order.court_order_id = $court_order_id AND court_order.customer_account_id = $customer_account_id");

            // Lấy dữ liệu từ kết quả truy vấn
            $row = mysqli_fetch_assoc($result);
            $review_count = $row['review_count'];

            // Giải phóng bộ nhớ
            ReleaseMemory($link, $result);

            return $review_count;
        }

        //hien thi chart review
        public function get_review_on_chart($year){
            $link = MakeConnection($link);
            $query = "SELECT 
                        c.court_name, 
                        ci.court_image AS image, 
                        COUNT(r.review_id) AS review_count, 
                        ROUND(AVG(r.review_star_rate), 1) AS average_star_rate 
                      FROM 
                        court_schedule cs 
                        INNER JOIN court c ON cs.court_id = c.court_id 
                        LEFT JOIN review r ON cs.court_schedule_id = r.court_schedule_id 
                        LEFT JOIN court_image ci ON c.court_id = ci.court_id 
                      WHERE 
                        ci.court_image_id = 3 * c.court_id 
                        AND YEAR(cs.created_on_date) = $year
                      GROUP BY 
                        c.court_name 
                      ORDER BY 
                        average_star_rate DESC";
            $data = array();
        
            $result = ExecuteDataQuery($link, $query);
            if(!$result) {
                throw new Exception("Failed to fetch data from the database");
            }
        
            // Fetch data
            while ($row = mysqli_fetch_assoc($result)) {
                array_push($data,$row);
            }
            
            // Release resources
            ReleaseMemory($link, $result);
            
            return $data;
        }
    }
?>