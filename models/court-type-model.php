<?php
    require_once ($_SERVER['DOCUMENT_ROOT'] . "/NTP-Sports-Hub/models/connect.php");

    class court_type {
        private $court_type_id;
        private $court_type_name;
        private $court_type_icon;
        private $court_type_state;
        private $created_on_date;
        private $last_modified_date;
        private $account_id;

        public function getCourtTypeId() { return $this->court_type_id; }
        public function getCourtTypeName() { return $this->court_type_name; }
        public function getCourtTypeIcon() { return $this->court_type_icon; }
        public function getCourtTypeState() { return $this->court_type_state; }
        public function getCreatedOnDate() { return $this->created_on_date; }
        public function getLastModifiedDate() { return $this->last_modified_date; }
        public function getAccountId() { return $this->account_id; }

        public function setCourtTypeId($court_type_id) { $this->court_type_id = $court_type_id; }
        public function setCourtTypeName($court_type_name) { $this->court_type_name = $court_type_name; }
        public function setCourtTypeIcon($court_type_icon) { $this->court_type_icon = $court_type_icon; }
        public function setCourtTypeState() { return $this->court_type_state = $court_type_state; }
        public function setCreatedOnDate($created_on_date) { $this->created_on_date = $created_on_date; }
        public function setLastModifiedDate($last_modified_date) { $this->last_modified_date = $last_modified_date; }
        public function setAccountId($account_id) { $this->account_id = $account_id; }

        public function __construct($court_type_id = 0, $court_type_name = "", $court_type_icon = "", $court_type_state = "", $created_on_date = "", $last_modified_date = "", $account_id = 0) {
            $this->court_type_id = $court_type_id;
            $this->court_type_name = $court_type_name;
            $this->court_type_icon = $court_type_icon;
            $this->court_type_state = $court_type_state;
            $this->created_on_date = $created_on_date;
            $this->last_modified_date = $last_modified_date;
            $this->account_id = $account_id;
        }

        //1. Hàm hiển thị tất cả loại sân
        public function view_all_court_type() {
            //Tạo kết nối đến database
            $link = "";
            MakeConnection($link);

            //Kết nối và lấy dữ liệu tất cả loại sân từ database
            $result = ExecuteDataQuery($link, "SELECT * FROM court_type WHERE court_type_state = 'Chưa xóa'");
            $data = array();

            while ($rows = mysqli_fetch_assoc($result)) {
                $court_type = new court_type($rows["court_type_id"], $rows["court_type_name"], $rows["court_type_icon"], $rows["court_type_state"], $rows["created_on_date"], $rows["last_modified_date"], $rows["account_id"]);
                array_push($data, $court_type);
            }

            //Giải phóng bộ nhớ
            ReleaseMemory($link, $result);

            return $data;
        }

        //2. Hàm hiển thị loại sân theo court_type_id
        public function getCourtTypeByID($court_type_id) {
            //Tạo kết nối đến database
            $link = "";
            MakeConnection($link);

            //Kết nối và lấy dữ liệu tổng số lượng loại sân từ database
            $result = ExecuteDataQuery($link, "SELECT * FROM court_type WHERE court_type_id = ".$court_type_id."");
            $data = array();
            while ($row = mysqli_fetch_assoc($result)){
                $court_type = new court_type(
                    $row["court_type_id"], 
                    $row["court_type_name"], 
                    $row["court_type_icon"], 
                    $row["court_type_state"], 
                    $row["created_on_date"], 
                    $row["last_modified_date"], 
                    $row["account_id"]);

                 array_push($data, $court_type);
            }
           
            //Giải phóng bộ nhớ
            ReleaseMemory($link, $result);

            return $data;
        }

        public function view_count_court_type(){
            $link = "";
            MakeConnection($link);

            //Kết nối và lấy dữ liệu tổng số lượng lịch sân từ database
            $result = ExecuteDataQuery($link, "SELECT COUNT(*) FROM court_type WHERE court_type_state = 'Chưa xoá'");

            $row = mysqli_fetch_row($result);
            
            //Giải phóng bộ nhớ
            ReleaseMemory($link, $result);

            return $row;
        }
        
        public function court_type_detail($court_type_id){
            $link = "";
            MakeConnection($link);
            // Lấy dữ liệu
            $result = ExecuteDataQuery($link, "SELECT * FROM court_type WHERE court_type_id = $court_type_id");
            $court_type = mysqli_fetch_assoc($result);
            ReleaseMemory($link, $result);
            return $court_type;
        }

        public function update_ct($id, $name, $img){
            $link = MakeConnection($link);
            $query = "UPDATE court_type SET court_type_name = '$name', court_type_icon = '$img' WHERE court_type_id = $id";
            $result = ExecuteNonDataQuery($link, $query);
            if ($result) {
                return true;
            } else {
                throw new Exception("Error updating customer data: " . mysqli_error($link));
            }
        }

        public function insert_ct($name, $img){
            $link = MakeConnection($link);
            $query = "INSERT INTO court_type (court_type_name, court_type_icon, court_type_state, account_id) 
            VALUES ('$name', '$img', 'Chưa xoá', '1')";
            $result = ExecuteNonDataQuery($link, $query);
            if ($result) {
                return true;
            } else {
                throw new Exception("Error inserting data: " . mysqli_error($link));
            }
        }

        public function delete_ct($court_type_id){
            $link = MakeConnection($link);
            $query = "UPDATE court_type SET court_type_state = 'Đã xoá' WHERE court_type_id = $court_type_id";
            $result = ExecuteNonDataQuery($link, $query);
            if ($result) {
                return true;
            } else {
                throw new Exception("Error updating data: " . mysqli_error($link));
            }
        }

        public function updateCourtTypeURL($newURL, $id) {
            $link = MakeConnection($link);
                $updateQuery = "UPDATE court_type SET court_type_icon = '$newURL' WHERE court_type_id = '$id'";
                $updateResult = ExecuteNonDataQuery($link, $updateQuery);
                return $updateResult;
                ReleaseMemory($link, $updateResult);
        }

        public function showNoti($message){
            echo '
            <div class="action-successful">
                <div class="successful-image">
                    <img src="../image/sport-court-types-management-img/successful.svg" alt="successful image">
                </div>
                <div class="message">
                    <p id="action-successful-message-title">Thông báo</p>
                    <p id="action-successful-message">'. $message . ' </p>
                </div>
                <div class="action-successful-button-group">
                    <a id="home-button" href="../index.php">Trở về trang chủ</a>
                    <a id="admin-management-button" href="../views/sport-court-types-management.php">Trở về quản lý loại sân</a>
                </div>
            </div>';
            echo '
            <script>
            var overlays = document.querySelectorAll(".overlay");
            overlays.forEach(function(overlay) {
                overlay.style.display = "block";
            });
            </script>
            ';
        }
    }
?>