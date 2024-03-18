<?php
    require_once "../models/connect.php";

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
        
        public function __constructor($court_schedule_id = 0, $court_schedule_date = "", $court_schedule_start_time = "", $court_schedule_end_time = "", $court_schedule_time_frame = "", $court_schedule_state = "", $created_on_date = "", $last_modified_date = "", $cart_id = 0, $account_id = 0) {
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

        //Hàm hiển thị tổng số lượng lịch sân
        function view_all() {
            //Tạo kết nối đến database
            $link = "";
            MakeConnection($link);

            //Kết nối và lấy dữ liệu tổng số lượng lịch sân từ database
            $result = ExecuteDataQuery($link, "SELECT COUNT(*) FROM court_schedule");

            $row = mysqli_fetch_row($result);
            
            //Giải phóng bộ nhớ
            ReleaseMemory($link, $result);

            return $row;
        }
    }
?>


<!-- Đoạn code dưới đây tui chưa chuyển thành MVC, mng code thì xóa phần dưới đi để tạo hàm không bị lỗi nha -->
<?php
    //Thay đổi CSS của thẻ li được chọn
    if (isset($_GET['court_type_id'])) {
        $courtType = $_GET['court_type_id'];
        if ($courtType == '0') {
            echo "
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        var liElement = document.getElementById('li-court-type-0');
                        liElement.style.borderBottom = '2px solid #285D8F';

                        var aElement = document.getElementById('a-court-type-0')
                        aElement.style.color = '#285D8F';
                        aElement.style.fontSize = '16px';
                        aElement.style.fontStyle = 'normal';
                        aElement.style.fontWeight = '500';
                        aElement.style.lineHeight = '24px';
                    });
                </script>
            ";  
        } else {
            echo "
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        var liElement = document.getElementById('li-court-type-".$courtType."');
                        liElement.style.borderBottom = '2px solid #285D8F';

                        var aElement = document.getElementById('a-court-type-".$courtType."')
                        aElement.style.color = '#285D8F';
                        aElement.style.fontSize = '16px';
                        aElement.style.fontStyle = 'normal';
                        aElement.style.fontWeight = '500';
                        aElement.style.lineHeight = '24px';
                    });
                </script>
            ";
        }
    } else {
        echo "
            <script>
                var url = new URL(window.location.href);
                url.searchParams.set('court_type_id', '0');
                window.location.href = url.href;
            </script>
        ";
    }

    //Hàm hiển thị dữ liệu của bảng lịch sân theo thanh điều hướng
    function view_court_schedule() {
        //Tạo kết nối đến database
        $link = "";
        MakeConnection($link);

        //Lấy dữ liệu của biến $_GET['court_type_id']
        $courtType = isset($_GET['court_type_id']) ? $_GET['court_type_id'] : 'all'; // Mặc định court_type_id = 'all'

        //Tạo bảng dữ liệu
        echo "<thead>";

        echo "<tr>";
        
        echo "<th><input type='checkbox' name='court_schedule_id_0' id='court_schedule_id_0' onclick='updateUrlAndCBState(this)'></th>";
        echo "<th>Mã lịch sân<span class='icon-arrow'>&UpArrow;</span></th>";
        echo "<th>Mã sân<span class='icon-arrow'>&UpArrow;</span></th>";
        echo "<th>Ngày nhận sân<span class='icon-arrow'>&UpArrow;</span></th>";
        echo "<th>Giờ bắt đầu<span class='icon-arrow'>&UpArrow;</span></th>";
        echo "<th>Giờ kết thúc<span class='icon-arrow'>&UpArrow;</span></th>";
        echo "<th>Khung giờ<span class='icon-arrow'>&UpArrow;</span></th>";
        echo "<th>Trạng thái<span class='icon-arrow'>&UpArrow;</span></th>";
        echo "<th>Thao tác<span class='icon-arrow'>&UpArrow;</span></th>";

        echo "</tr>";

        echo "</thead>";

        echo "<tbody>";

        // Thực hiện truy vấn dựa vào court_type_id
        if ($courtType == "all") {
            $result = ExecuteDataQuery($link, "SELECT * FROM court_schedule");
            $resultToUse = $result;
        } else {
            $result = ExecuteDataQuery($link, "SELECT * FROM court_schedule");
            $result2 = ExecuteDataQuery($link, "SELECT court_schedule.* FROM court_schedule, court WHERE court_schedule.court_id = court.court_id AND court.court_type_id = " . $courtType);
            if (mysqli_num_rows($result2) > 0) { // Kiếm tra nếu result2 có dữ liệu
                $resultToUse = $result2;
            } else {
                $resultToUse = $result; // Trả về tất cả dữ liệu nếu như không match
            }
        }

        while ($row = mysqli_fetch_assoc($resultToUse)) {
            echo "<tr>";

            echo "<td><input type='checkbox' name='court_schedule_id_".$row['court_schedule_id']."' id='court_schedule_id_".$row['court_schedule_id']."' onclick='updateUrl(this)'></td>";
            echo "<td>".$row['court_schedule_id']."</td>";
            echo "<td>".$row['court_id']."</td>";
            echo "<td>".$row['court_schedule_date']."</td>";
            echo "<td>".substr($row['court_schedule_start_time'], 0, 5)."</td>";
            echo "<td>".$row['court_schedule_end_time']."</td>";
            echo "<td>".$row['court_schedule_time_frame']."</td>";

            if ($row['court_schedule_state'] == "Chưa đặt") {
                echo "<td><p class='status haveNotBooked'>".$row['court_schedule_state']."</p></td>";
            } else if ($row['court_schedule_state'] == "Đã đặt") {
                echo "<td><p class='status haveBooked'>".$row['court_schedule_state']."</p></td>";
            } else if ($row['court_schedule_state'] == "Hết hạn") {
                echo "<td><p class='status expired'>".$row['court_schedule_state']."</p></td>";
            }

            echo "
                <td>
                    <a style='max-width: 70px; display: flex; padding: 6px 10px; justify-content: center; align-items: center;
                    gap: 8px; border-radius: 4px; border: 2px solid #4EACDF; background: #FAFBFC;'
                    href='?option=view_court_schedule_detail'>
                        <img src='../image/sport-court-schedules-management-img/eye.svg' alt='eye icon'>
                        <p style='color: #4EACDF; font-size: 14px; font-style: normal; font-weight: 600; line-height: 20px;'>Xem</p>
                    </a>
                </td>
            ";

            echo "</tr>";
        }

        echo "</tbody>";

        //Giải phóng bộ nhớ
        ReleaseMemory($link, $result);
    }
?>