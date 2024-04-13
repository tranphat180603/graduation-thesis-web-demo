<?php
    require_once ($_SERVER['DOCUMENT_ROOT'] . "/NTP-Sports-Hub/models/connect.php");

    class court_schedule {
        private $court_schedule_id;
        private $court_schedule_date;
        private $court_schedule_start_time;
        private $court_schedule_end_time;
        private $court_schedule_time_frame;
        private $court_schedule_state;
        private $created_on_date;
        private $last_modified_date;
        private $court_id;
        private $account_id;

        public function getCourtScheduleId() { return $this->court_schedule_id; }
        public function getCourtScheduleDate() { return $this->court_schedule_date; }
        public function getCourtScheduleStartTime() { return $this->court_schedule_start_time; }
        public function getCourtScheduleEndTime() { return $this->court_schedule_end_time; }
        public function getCourtScheduleTimeFrame() { return $this->court_schedule_time_frame; }
        public function getCourtScheduleState() { return $this->court_schedule_state; }
        public function getCreatedOnDate() { return $this->created_on_date; }
        public function getLastModifiedDate() { return $this->last_modified_date; }
        public function getCourtId() { return $this->court_id; }
        public function getAccountId() { return $this->account_id; }

        public function setCourtScheduleId($court_schedule_id) { $this->court_schedule_id = $court_schedule_id; }
        public function setCourtScheduleDate($court_schedule_date) { $this->court_schedule_date = $court_schedule_date; }
        public function setCourtScheduleStartTime($court_schedule_start_time) { $this->court_schedule_start_time = $court_schedule_start_time; }
        public function setCourtScheduleEndTime($court_schedule_end_time) { $this->court_schedule_end_time = $court_schedule_end_time; }
        public function setCourtScheduleTimeFrame($court_schedule_time_frame) { $this->court_schedule_time_frame = $court_schedule_time_frame; }
        public function setCourtScheduleState($court_schedule_state) { $this->court_schedule_state = $court_schedule_state; }
        public function setCreatedOnDate($created_on_date) { $this->created_on_date = $created_on_date; }
        public function setLastModifiedDate($last_modified_date) { $this->last_modified_date = $last_modified_date; }
        public function setCourtId($court_id) { $this->court_id = $court_id; }
        public function setAccountId($account_id) { $this->account_id = $account_id; }
        
        public function __construct($court_schedule_id = 0, $court_schedule_date = "", $court_schedule_start_time = "", $court_schedule_end_time = "", $court_schedule_time_frame = "", $court_schedule_state = "", $created_on_date = "", $last_modified_date = "", $court_id = 0, $account_id = 0) {
            $this->court_schedule_id = $court_schedule_id;
            $this->court_schedule_date = $court_schedule_date;
            $this->court_schedule_start_time = $court_schedule_start_time;
            $this->court_schedule_end_time = $court_schedule_end_time;
            $this->court_schedule_time_frame = $court_schedule_time_frame;
            $this->court_schedule_state = $court_schedule_state;
            $this->created_on_date = $created_on_date;
            $this->last_modified_date = $last_modified_date;
            $this->court_id = $court_id;
            $this->account_id = $account_id;
        }

        //1. Hàm hiển thị tất cả lịch sân
        public function view_all_court_schedule() {
            //Tạo kết nối đến database
            $link = "";
            MakeConnection($link);

            //Kết nối và lấy dữ liệu tất cả lịch sân từ database
            $result = ExecuteDataQuery($link, "SELECT * FROM court_schedule");
            $data = array();

            while ($rows = mysqli_fetch_assoc($result)) {
                $court_schedule = new court_schedule($rows["court_schedule_id"], $rows["court_schedule_date"], 
                                        $rows["court_schedule_start_time"], $rows["court_schedule_end_time"], 
                                        $rows["court_schedule_time_frame"], $rows["court_schedule_state"], 
                                        $rows["created_on_date"], $rows["last_modified_date"], $rows["court_id"], $rows["account_id"]);
                array_push($data, $court_schedule);
            }

            //Giải phóng bộ nhớ
            ReleaseMemory($link, $result);

            return $data;
        }

        //2. Hàm hiển thị tổng số lượng lịch sân
        public function view_all() {
            //Tạo kết nối đến database
            $link = "";
            MakeConnection($link);

            //Kết nối và lấy dữ liệu tổng số lượng lịch sân từ database
            $result = ExecuteDataQuery($link, "SELECT COUNT(*) FROM court_schedule WHERE court_schedule_state <> 'Đã xóa'");

            $row = mysqli_fetch_row($result);
            
            //Giải phóng bộ nhớ
            ReleaseMemory($link, $result);

            return $row;
        }

        //3. Hàm hiển thị tổng số lượng lịch sân theo loại sân
        public function view_court_schedule_by_court_type($court_type_id) {
            //Tạo kết nối đến database
            $link = "";
            MakeConnection($link);

            //Kết nối và lấy dữ liệu tổng số lượng lịch sân từ database
            $result = ExecuteDataQuery($link, "SELECT COUNT(*) FROM court_schedule, court, court_type WHERE 
                                            court_schedule_state <> 'Đã xóa' AND
                                            court_schedule.court_id = court.court_id AND 
                                            court.court_type_id = court_type.court_type_id
                                            AND court.court_type_id = $court_type_id"); 

            $row = mysqli_fetch_row($result);
            
            //Giải phóng bộ nhớ
            ReleaseMemory($link, $result);

            return $row;
        }

        //4. Hàm hiển thị dữ liệu của bảng lịch sân theo thanh điều hướng
        public function view_court_schedule($courtType) {
            //Tạo kết nối đến database
            $link = "";
            MakeConnection($link);

            // Thực hiện truy vấn dựa vào court_type_id
            if ($courtType == "0") {
                $result = ExecuteDataQuery($link, "SELECT * FROM court_schedule WHERE court_schedule_state <> 'Đã xóa'");
            } else {
                $result = ExecuteDataQuery($link, "SELECT court_schedule.* FROM court_schedule, court 
                                                     WHERE court_schedule_state <> 'Đã xóa' AND court_schedule.court_id = court.court_id 
                                                     AND court.court_type_id = $courtType");
            }

            $data = array();

            while ($rows = mysqli_fetch_assoc($result)) {
                $court_schedule = new court_schedule($rows["court_schedule_id"], $rows["court_schedule_date"], 
                                        $rows["court_schedule_start_time"], $rows["court_schedule_end_time"], 
                                        $rows["court_schedule_time_frame"], $rows["court_schedule_state"], 
                                        $rows["created_on_date"], $rows["last_modified_date"], $rows["court_id"], $rows["account_id"]);
                array_push($data, $court_schedule);
            }

            //Giải phóng bộ nhớ
            ReleaseMemory($link, $result);

            return $data;
        }

        //5. Hàm cập nhật trạng thái của lịch sân thành hết hạn khi quá ngày nhận sân mà lịch sân vẫn chưa được đặt
        public function update_court_schedule_state($court_schedule_id) {
            //Tạo kết nối đến database
            $link = "";
            MakeConnection($link);

            $result = ExecuteNonDataQuery($link, "UPDATE court_schedule SET court_schedule_state = 'Hết hạn' 
                                                    WHERE court_schedule_id = $court_schedule_id AND court_schedule_state = 'Chưa đặt'");

            //Giải phóng bộ nhớ
            ReleaseMemory($link, $result);

            return $result;
        }

        //6. Hàm lấy dữ liệu một lịch sân cụ thể
        public function view_specific_court_schedule($court_schedule_id) {
            //Tạo kết nối đến database
            $link = "";
            MakeConnection($link);

            $result = ExecuteDataQuery($link, "SELECT * FROM court_schedule WHERE court_schedule_id = $court_schedule_id");

            $row = mysqli_fetch_row($result);

            //Giải phóng bộ nhớ
            ReleaseMemory($link, $result);

            return $row;
        }

        //7. Hàm lấy dữ liệu để kiểm tra trước khi thêm lịch sân mới
        public function data_for_check_insert_court_schedule($court_id, $court_schedule_date, $court_schedule_start_time, $court_schedule_end_time) {
            //Tạo kết nối đến database
            $link = "";
            MakeConnection($link);

            //Tạo ra câu SQL
            $result = ExecuteDataQuery($link, "SELECT * FROM court_schedule WHERE 
                                            court_id = $court_id AND
                                            court_schedule_date = '$court_schedule_date'"); 

            $data = array();

            while ($rows = mysqli_fetch_assoc($result)) {
                $court_schedule = new court_schedule($rows["court_schedule_id"], $rows["court_schedule_date"], 
                                        $rows["court_schedule_start_time"], $rows["court_schedule_end_time"], 
                                        $rows["court_schedule_time_frame"], $rows["court_schedule_state"], 
                                        $rows["created_on_date"], $rows["last_modified_date"], $rows["court_id"], $rows["account_id"]);
                array_push($data, $court_schedule);
            }

            //Giải phóng bộ nhớ
            ReleaseMemory($link, $result);

            return $data;
        }

        //8. Hàm thêm lịch sân mới
        public function insert_court_schedule($court_schedule_date, $court_schedule_start_time, $court_schedule_end_time, 
                                                $court_schedule_time_frame, $court_schedule_state, $created_on_date = "", 
                                                $last_modified_date = "", $court_id, $account_id = 1) {
            //Tạo kết nối đến database
            $link = "";
            MakeConnection($link);

            //Tạo ra câu SQL
            $sql = "INSERT INTO court_schedule (court_schedule_date, court_schedule_start_time, court_schedule_end_time, 
                    court_schedule_time_frame, court_schedule_state, created_on_date, court_id, account_id) 
                    VALUES ('$court_schedule_date', '$court_schedule_start_time', '$court_schedule_end_time', 
                    '$court_schedule_time_frame', '$court_schedule_state', '$created_on_date', $court_id, $account_id)";

            $result = ExecuteNonDataQuery($link, $sql);

            $message = $result;

            //Giải phóng bộ nhớ
            ReleaseMemory($link, $result);

            return $message;
        }

        //9. Hàm cập nhật lịch sân 
        public function update_court_schedule($court_schedule_id, $court_schedule_state, $last_modified_date) {
            //Tạo kết nối đến database
            $link = "";
            MakeConnection($link);

            //Tạo ra câu SQL
            $sql = "UPDATE court_schedule SET court_schedule_state = '$court_schedule_state', last_modified_date = '$last_modified_date' 
                    WHERE court_schedule_id = $court_schedule_id";

            $result = ExecuteNonDataQuery($link, $sql);

            $message = $result;

            //Giải phóng bộ nhớ
            ReleaseMemory($link, $result);

            return $message;
        }

        //10. Hàm xóa lịch sân 
        public function delete_court_schedule($court_schedule_id) {
            //Tạo kết nối đến database
            $link = "";
            MakeConnection($link);

            //Tạo ra câu SQL
            $sql = "UPDATE court_schedule SET court_schedule_state = 'Đã xóa' WHERE court_schedule_id = $court_schedule_id";

            $result = ExecuteNonDataQuery($link, $sql);

            $message = $result;

            //Giải phóng bộ nhớ
            ReleaseMemory($link, $result);

            return $message;
        }

        //11. Hàm điều chỉnh trạng thái của lịch sân khi quản lý hủy đơn với một trong ba lý do: ‘Sân này không cho thuê nữa’, ’Lịch sân này không khả dụng nữa’, ‘Sân này đang được bảo trì, sữa chữa’
        public function cancel_order_update_schedule_to_expired($court_schedule_id) {
            //Tạo kết nối đến database
            $link = "";
            MakeConnection($link);

            //Tạo ra câu SQL
            $sql = "UPDATE court_schedule SET court_schedule_state = 'Hết hạn' WHERE court_schedule_id = $court_schedule_id";

            $result = ExecuteNonDataQuery($link, $sql);

            $message = $result;

            //Giải phóng bộ nhớ
            ReleaseMemory($link, $result);

            return $message;
        }

        //12. Hàm cập nhật trạng thái lịch sân khi hủy đơn với lý do "Đơn đặt sân chưa được thanh toán"
        public function cancel_order_update_schedule_to_haveNotBooked($court_schedule_id) {
            //Tạo kết nối đến database
            $link = "";
            MakeConnection($link);

            //Tạo ra câu SQL
            $sql = "UPDATE court_schedule SET court_schedule_state = 'Chưa đặt' WHERE court_schedule_id = $court_schedule_id";

            $result = ExecuteNonDataQuery($link, $sql);

            $message = $result;

            //Giải phóng bộ nhớ
            ReleaseMemory($link, $result);

            return $message;
        }

        //13. Hàm cập nhật trạng thái của lịch sân thành hết hạn khi đơn đặt sân chưa được xác nhận thanh toán kịp
        public function update_court_schedule_state_order_payment($court_schedule_id) {
            //Tạo kết nối đến database
            $link = "";
            MakeConnection($link);

            $result = ExecuteNonDataQuery($link, "UPDATE court_schedule SET court_schedule_state = 'Hết hạn' 
                                                    WHERE court_schedule_id = $court_schedule_id AND court_schedule_state = 'Đã đặt'");

            //Giải phóng bộ nhớ
            ReleaseMemory($link, $result);

            return $result;
        }

        //14. Tính giá tiền của lịch sân theo khung giờ trong courtprice 
        public static function getByCourtIdAndDate($court_id, $date)
        {
            // Tạo kết nối đến cơ sở dữ liệu
            $link = "";
            MakeConnection($link);

            // Khởi tạo mảng court_schedules để lưu trữ thông tin các lịch sân bóng
            $court_schedules = array();

            // Câu truy vấn SQL
            $query = "SELECT
                        c.court_schedule_id,
                        c.court_schedule_date,
                        c.court_schedule_time_frame,
                        c.court_schedule_state,
                        c.created_on_date,
                        c.last_modified_date,
                        cp.court_id,
                        c.account_id,
                        GROUP_CONCAT(
                            CASE
                                WHEN TIME_TO_SEC(TIMEDIFF(LEAST(c.court_schedule_end_time, cp.court_end_time), GREATEST(c.court_schedule_start_time, cp.court_start_time))) > 0 THEN cp.court_time_frame
                                ELSE NULL
                            END SEPARATOR ', '
                        ) AS related_court_time_frames,
                        TIMESTAMPDIFF(MINUTE, STR_TO_DATE(SUBSTRING_INDEX(c.court_schedule_time_frame, '-', 1), '%H:%i'), STR_TO_DATE(SUBSTRING_INDEX(c.court_schedule_time_frame, '-', -1), '%H:%i')) / 60 AS court_schedule_hours,
                        SUM(
                            CASE
                                WHEN TIME_TO_SEC(TIMEDIFF(LEAST(c.court_schedule_end_time, cp.court_end_time), GREATEST(c.court_schedule_start_time, cp.court_start_time))) > 0 THEN
                                    TIMESTAMPDIFF(MINUTE, GREATEST(STR_TO_DATE(SUBSTRING_INDEX(c.court_schedule_time_frame, '-', 1), '%H:%i'), cp.court_start_time), LEAST(STR_TO_DATE(SUBSTRING_INDEX(c.court_schedule_time_frame, '-', -1), '%H:%i'), cp.court_end_time)) / 60 *
                                    CASE
                                        WHEN DAYOFWEEK(c.court_schedule_date) IN (1, 7) THEN cp.court_weekend_price
                                        ELSE cp.court_weekday_price
                                    END
                                ELSE 0
                            END
                        ) AS court_price
                    FROM
                        court_schedule c
                    INNER JOIN
                        court_price cp ON c.court_id = cp.court_id
                    WHERE
                        cp.court_id = $court_id
                        AND c.court_schedule_date = '$date'
                        AND c.court_schedule_state = 'Chưa đặt'
                        AND (
                            (cp.court_start_time < STR_TO_DATE(SUBSTRING_INDEX(c.court_schedule_time_frame, '-', -1), '%H:%i') AND cp.court_end_time > STR_TO_DATE(SUBSTRING_INDEX(c.court_schedule_time_frame, '-', 1), '%H:%i'))
                            OR
                            (cp.court_start_time > STR_TO_DATE(SUBSTRING_INDEX(c.court_schedule_time_frame, '-', 1), '%H:%i') AND cp.court_end_time < STR_TO_DATE(SUBSTRING_INDEX(c.court_schedule_time_frame, '-', -1), '%H:%i'))
                            OR
                            (cp.court_start_time < STR_TO_DATE(SUBSTRING_INDEX(c.court_schedule_time_frame, '-', 1), '%H:%i') AND cp.court_end_time > STR_TO_DATE(SUBSTRING_INDEX(c.court_schedule_time_frame, '-', 1), '%H:%i') AND cp.court_end_time < STR_TO_DATE(SUBSTRING_INDEX(c.court_schedule_time_frame, '-', -1), '%H:%i'))
                            OR
                            (cp.court_start_time > STR_TO_DATE(SUBSTRING_INDEX(c.court_schedule_time_frame, '-', 1), '%H:%i') AND cp.court_start_time < STR_TO_DATE(SUBSTRING_INDEX(c.court_schedule_time_frame, '-', -1), '%H:%i') AND cp.court_end_time > STR_TO_DATE(SUBSTRING_INDEX(c.court_schedule_time_frame, '-', -1), '%H:%i'))
                        )
                    GROUP BY
                        c.court_schedule_id";

            // Thực hiện truy vấn
            $result = ExecuteDataQuery($link, $query);

            // Xử lý kết quả truy vấn và trả về mảng court_schedules
            while ($row = mysqli_fetch_assoc($result)) {
                $court_schedules[] = array(
                    'court_schedule_id' => $row['court_schedule_id'],
                    'court_schedule_date' => $row['court_schedule_date'],
                    'court_schedule_time_frame' => $row['court_schedule_time_frame'],
                    'court_schedule_state' => $row['court_schedule_state'],
                    'created_on_date' => $row['created_on_date'],
                    'last_modified_date' => $row['last_modified_date'],
                    'court_id' => $row['court_id'],
                    'account_id' => $row['account_id'],
                    'related_court_time_frames' => $row['related_court_time_frames'],
                    'court_schedule_hours' => $row['court_schedule_hours'],
                    'court_price' => $row['court_price']
                );
            }

            return $court_schedules;
        }
    }
?>