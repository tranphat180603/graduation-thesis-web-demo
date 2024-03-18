<?php
    require_once "../models/connect.php";
    require_once "../models/court-schedule-model.php";

    class court_type {
        private $court_type_id;
        private $court_type_name;
        private $court_type_icon;
        private $created_on_date;
        private $last_modified_date;
        private $account_id;

        public function getCourtTypeId() { return $this->court_type_id; }
        public function getCourtTypeName() { return $this->court_type_name; }
        public function getCourtTypeIcon() { return $this->court_type_icon; }
        public function getCreatedOnDate() { return $this->created_on_date; }
        public function getLastModifiedDate() { return $this->last_modified_date; }
        public function getAccountId() { return $this->account_id; }

        public function setCourtTypeId($court_type_id) { $this->court_type_id = $court_type_id; }
        public function setCourtTypeName($court_type_name) { $this->court_type_name = $court_type_name; }
        public function setCourtTypeIcon($court_type_icon) { $this->court_type_icon = $court_type_icon; }
        public function setCreatedOnDate($created_on_date) { $this->created_on_date = $created_on_date; }
        public function setLastModifiedDate($last_modified_date) { $this->last_modified_date = $last_modified_date; }
        public function setAccountId($account_id) { $this->account_id = $account_id; }

        public function __constructor($court_type_id, $court_type_name, $court_type_icon, $created_on_date, $last_modified_date, $account_id) {
            $this->court_type_id = $court_type_id;
            $this->court_type_name = $court_type_name;
            $this->court_type_icon = $court_type_icon;
            $this->created_on_date = $created_on_date;
            $this->last_modified_date = $last_modified_date;
            $this->account_id = $account_id;
        }

        //Hàm hiển thị tên loại sân và hiển thị tổng số lượng lịch sân theo loại sân
        function view_court_type_name_schedule() {
            //Tạo kết nối đến database
            $link = "";
            MakeConnection($link);

            //Kết nối và lấy dữ liệu tất cả lịch sân từ database
            $all = ExecuteDataQuery($link, "SELECT COUNT(*) FROM court_schedule");

            while ($row = mysqli_fetch_row($all)) {
                echo "<li class='li-court-type' id='li-court-type-0'>
                <a id='a-court-type-0' href='?court_type_id=0'>Tất cả&nbsp;(<span>".$row[0]."</span>)</a></li>";
            }

            //Kết nối và lấy dữ liệu tên loại sân từ database
            $result = ExecuteDataQuery($link, "SELECT * FROM court_type"); 

            while ($row1 = mysqli_fetch_assoc($result)) {
                echo "
                    <li class='li-court-type' id='li-court-type-".$row1['court_type_id']."'>
                        <a id='a-court-type-".$row1['court_type_id']."' href='?court_type_id=".$row1['court_type_id']."'>".$row1['court_type_name']."
                ";

                //Kết nối và lấy dữ liệu tổng số lượng lịch sân theo loại sân từ database
                $number = ExecuteDataQuery($link, "SELECT COUNT(*) FROM court_schedule, court, court_type WHERE 
                                                court_schedule.court_id = court.court_id AND 
                                                court.court_type_id = court_type.court_type_id
                                                AND court.court_type_id = ".$row1['court_type_id'].""); 
                while ($row2 = mysqli_fetch_row($number)) {
                    echo "
                        &nbsp;(<span>".$row2[0]."</span>)</a>
                    ";
                }

                echo "</li>";
            }

            //Giải phóng bộ nhớ
            ReleaseMemory($link, $result);
        }
        }
?>


<!-- Đoạn code dưới đây tui chưa chuyển thành MVC, mng code thì xóa phần dưới đi để tạo hàm không bị lỗi nha -->
<?php 
    $defaultCourtTypeId = 1;

    //Hàm hiển thị tên loại sân và hiển thị tổng số lượng lịch sân theo loại sân
    function view_court_type_name_schedule() {
        //Tạo kết nối đến database
        $link = "";
        MakeConnection($link);

        //Kết nối và lấy dữ liệu tất cả lịch sân từ database
        $all = ExecuteDataQuery($link, "SELECT COUNT(*) FROM court_schedule");

        while ($row = mysqli_fetch_row($all)) {
            echo "<li id='li-court-type-0' style='display: flex; align-items: center; margin: 0px; padding: 0px; padding-bottom: 5px'>
            <a id='a-court-type-0' style='color: #C2C2C2; font-size: 16px; font-style: normal; font-weight: 500; 
            line-height: 24px;' href='?court_type_id=0'>Tất cả&nbsp;(<span>".$row[0]."</span>)</a></li>";
        }

        //Kết nối và lấy dữ liệu tên loại sân từ database
        $result = ExecuteDataQuery($link, "SELECT * FROM court_type"); 

        while ($row1 = mysqli_fetch_assoc($result)) {
            echo "
                <li id='li-court-type-".$row1['court_type_id']."' style='display: flex; align-items: center; 
                    margin: 0px; padding: 0px; padding-bottom: 5px'>
                    <a id='a-court-type-".$row1['court_type_id']."' style='color: #C2C2C2; font-size: 16px;
                    font-style: normal; font-weight: 500; line-height: 24px;
                    'href='?court_type_id=".$row1['court_type_id']."'>".$row1['court_type_name']."
            ";

            //Kết nối và lấy dữ liệu tổng số lượng lịch sân theo loại sân từ database
            $number = ExecuteDataQuery($link, "SELECT COUNT(*) FROM court_schedule, court, court_type WHERE 
                                            court_schedule.court_id = court.court_id AND 
                                            court.court_type_id = court_type.court_type_id
                                            AND court.court_type_id = ".$row1['court_type_id'].""); 
            while ($row2 = mysqli_fetch_row($number)) {
                echo "
                    &nbsp;(<span>".$row2[0]."</span>)</a>
                ";
            }

            echo "</li>";
        }

        //Giải phóng bộ nhớ
        ReleaseMemory($link, $result);
    }
?>