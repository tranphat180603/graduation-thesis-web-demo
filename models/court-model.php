<?php
    require_once ($_SERVER['DOCUMENT_ROOT'] . "/NTP-Sports-Hub/models/connect.php");

    class court {
        private $court_id;
        private $court_name;
        private $court_state;
        private $created_on_date;
        private $last_modified_date;
        private $court_type_id;
        private $account_id;

        public function getCourtId() { return $this->court_id; }
        public function getCourtName() { return $this->court_name; }
        public function getCourtState() { return $this->court_state; }
        public function getCreatedOnDate() { return $this->created_on_date; }
        public function getLastModifiedDate() { return $this->last_modified_date; }
        public function getCourtTypeId() { return $this->court_type_id; }
        public function getAccountId() { return $this->account_id; }
        
        public function setCourtId($court_id) { $this->court_id = $court_id; }
        public function setCourtName($court_name) { $this->court_name = $court_name; }
        public function setCourtState($court_state) { $this->court_state = $court_state; }
        public function setCreatedOnDate($created_on_date) { $this->created_on_date = $created_on_date; }
        public function setLastModifiedDate($last_modified_date) { $this->last_modified_date = $last_modified_date; }
        public function setCourtTypeId($court_type_id) { $this->court_type_id = $court_type_id; }
        public function setAccountId($account_id) { $this->account_id = $account_id; }

        public function __construct($court_id = 0, $court_name = "", $court_state="", $created_on_date = "", $last_modified_date = "", $court_type_id = 0, $account_id = 0) {
            $this->court_id = $court_id;
            $this->court_name = $court_name;
            $this->court_state = $court_state;
            $this->created_on_date = $created_on_date;
            $this->last_modified_date = $last_modified_date;
            $this->court_type_id = $court_type_id;
            $this->account_id = $account_id;
        }

        //1. Hàm lấy dữ liệu tất cả sân
        public function view_all_court() {
            //Tạo kết nối đến database
            $link = "";
            MakeConnection($link);

            $result = ExecuteDataQuery($link, "SELECT * FROM court");

            $data = array();

            while ($rows = mysqli_fetch_assoc($result)) {
                $court = new court($rows["court_id"], $rows["court_name"], $rows["court_state"], $rows["created_on_date"], $rows["last_modified_date"], $rows["court_type_id"], $rows["account_id"]);
                array_push($data, $court);
            }

            //Giải phóng bộ nhớ
            ReleaseMemory($link, $result);

            return $data;
        }

        //2. Hàm hiển thị tổng số lượng sân theo loại sân
        public function view_court_by_court_type($court_type_id) {
            //Tạo kết nối đến database
            $link = "";
            MakeConnection($link);

            //Kết nối và lấy dữ liệu tổng số lượng lịch sân từ database
            $result = ExecuteDataQuery($link, "SELECT COUNT(*) FROM court, court_type WHERE 
                                            court_state <> 'Đã xóa' AND
                                            court.court_type_id = court_type.court_type_id
                                            AND court.court_type_id = $court_type_id"); 

            $row = mysqli_fetch_row($result);
            
            //Giải phóng bộ nhớ
            ReleaseMemory($link, $result);

            return $row;
        }

        // 3. Hàm lấy dữ liệu sân theo loại sân từ cơ sở dữ liệu và trả về một mảng chứa các đối tượng sân.
        public function getCourtByType($courtType)
        {
            // Tạo kết nối đến database
            $link = "";
            MakeConnection($link);

            // Thực hiện truy vấn dựa vào courtType
            if ($courtType == "0") {
                $result = ExecuteDataQuery($link, "SELECT * FROM court WHERE court_state <> 'Đã xóa'");
            } else {
                $result = ExecuteDataQuery($link, "SELECT * FROM court WHERE court_type_id in ($courtType) AND  court_state <> 'Đã xóa'");
            }

            $data = array();

            while ($rows = mysqli_fetch_assoc($result)) {
                $court = new court($rows["court_id"], $rows["court_name"], $rows["court_state"], $rows["created_on_date"], $rows["last_modified_date"], $rows["court_type_id"], $rows["account_id"]);
                array_push($data, $court);
            }

            // Giải phóng bộ nhớ và trả về dữ liệu
            ReleaseMemory($link, $result);
            return $data;
        }
 
        // 4. Hàm lấy dữ liệu sân dựa trên ID của sân từ cơ sở dữ liệu và trả về một đối tượng sân.
        public function view_court_by_id($courtId)
        {
            // Tạo kết nối đến database
            $link = "";
            MakeConnection($link);

            // Thực hiện truy vấn dựa vào courtId
            $query = "SELECT * FROM court WHERE court_id = '$courtId'";
            $result = ExecuteDataQuery($link, $query);

            $court = null;

            // Kiểm tra xem có dữ liệu trả về không
            if ($row = mysqli_fetch_assoc($result)) {
                $court = new court(
                    $row["court_id"],
                    $row["court_name"],
                    $rows["court_state"], 
                    $row["created_on_date"],
                    $row["last_modified_date"],
                    $row["court_type_id"],
                    $row["account_id"]
                );
            }

            // Giải phóng bộ nhớ và trả về đối tượng sân (hoặc null nếu không tìm thấy)
            ReleaseMemory($link, $result);
            return $court;
        }

        // Hàm lấy ra số lượng sân (17 sân)
        public function getTotalCourt() {
            $link = "";
            MakeConnection($link);
            $result = ExecuteDataQuery($link, "SELECT COUNT(*) FROM court WHERE court_state <> 'Đã xóa'");
            $resultToUse = mysqli_fetch_row($result);
            ReleaseMemory($link, $result);
            return $resultToUse;
        }

        // Hàm lấy ra thông tin tất cả loại sân (17 dòng thông tin)
        public function getAllCourtInformations() {
            $link = "";
            MakeConnection($link);
            $sql = "SELECT * FROM court c WHERE c.court_state <> 'Đã xóa';";
            $result = ExecuteDataQuery($link, $sql);

            $resultToUse = array();
            while ($rows = mysqli_fetch_assoc($result)) {
                $court = new court( 
                    $rows["court_id"], 
                    $rows["court_name"], 
                    $rows["court_state"],
                    $rows["created_on_date"], 
                    $rows["last_modified_date"], 
                    $rows["court_type_id"], 
                    $rows["account_id"]
                );
                array_push($resultToUse, $court);
            }
            ReleaseMemory($link, $result);
            return $resultToUse;
        }

        //Hàm lấy ra tổng số lượng sân theo court type
        public function getTotalCourtByCourtType($court_type_id) {
            $link = "";
            MakeConnection($link);
            $result = ExecuteDataQuery($link, "SELECT COUNT(*) FROM court WHERE court_type_id = ".$court_type_id." AND court_state <> 'Đã xóa'");
            $resultToUse = mysqli_fetch_row($result);
            ReleaseMemory($link, $result);
            return $resultToUse;
        }

        // Hàm hiển thị dữ liệu của bảng lịch sân theo thanh điều hướng (thông tin sân theo court type)
        public function getCourtByCourtType($court_type_id) {
            //Tạo kết nối đến database
            $link = "";
            MakeConnection($link);

            // Thực hiện truy vấn dựa vào court_type_id
            $result = ExecuteDataQuery($link, "SELECT * FROM court c
            WHERE c.court_type_id = ".$court_type_id." and c.court_state <> 'Đã xóa';");
            $resultToUse = array();
            while ($rows = mysqli_fetch_assoc($result)) {
                $court = new court( 
                    $rows["court_id"], 
                    $rows["court_name"], 
                    $rows["court_state"],
                    $rows["created_on_date"], 
                    $rows["last_modified_date"], 
                    $rows["court_type_id"], 
                    $rows["account_id"]
                );
                array_push($resultToUse, $court);
            }

            //Giải phóng bộ nhớ
            ReleaseMemory($link, $result);

            return $resultToUse;
        }

        // Hàm lấy thông tin sân theo court id
        public function getCourtById($court_id) {
            $link = "";
            MakeConnection($link);
            $result = ExecuteDataQuery($link, "SELECT * FROM court c
                WHERE c.court_id = ".$court_id." and c.court_state <> 'Đã xóa';");
            
            $row = mysqli_fetch_row($result);

            //Giải phóng bộ nhớ
            ReleaseMemory($link, $result);

            return $row;
        }     

        // Hàm cập nhật thông tin sân khi không thay đổi hình
        public function updateCourt($court, $court_price){
            $link = "";
            MakeConnection($link);
            $court_id = $court->getCourtId();
            $court_name = $court->getCourtName();
            $last_modified_date = date('Y-m-d');
            $court_type_id = $court->getCourtTypeId();
            $account_id = 1;

            $court_price_id = $court_price->getCourtPriceID();
            $court_time_frame = $court_price->getCourtTimeFrame();
            $time_parts = explode("-", $court_time_frame);

            $court_start_time = $time_parts[0]; // Thời gian bắt đầu
            $court_end_time = $time_parts[1]; // Thời gian kết thúc
            
            $court_weekday_price = $court_price->getCourtWeekdayPrice();
            $court_weekend_price = $court_price->getCourtWeekendPrice();
            $court_price_frame = number_format($court_weekday_price, 0, ',', '.') . '-' . number_format($court_weekend_price, 0, ',', '.');        

            $sql = "UPDATE court SET 
            court_name = '$court_name', 
            last_modified_date = '$last_modified_date', 
            court_type_id = '$court_type_id'
            
            WHERE court_id = $court_id;"; //

            $sql1 = "UPDATE court_price SET
                court_start_time = '$court_start_time', 
                court_end_time = '$court_end_time', 
                court_time_frame = '$court_time_frame', 
                court_weekday_price = '$court_weekday_price',
                court_weekend_price = '$court_weekend_price',
                court_price_frame = '$court_price_frame'
            
                    WHERE court_price_id = $court_price_id;";

            
            mysqli_query($link, $sql);


            if (mysqli_query($link, $sql1)){
                return true;
            } else {
                return false;
            }
        }

        // Hàm cập nhật thông tin sân khi có thay đổi hình
        public function updateCourt2($court, $court_price, $court_image){
            $link = "";
            MakeConnection($link);
            $court_id = $court->getCourtId();
            $court_name = $court->getCourtName();
            $last_modified_date = date('Y-m-d');
            $court_type_id = $court->getCourtTypeId();
            $account_id = 1;

            $court_price_id = $court_price->getCourtPriceID();
            $court_time_frame = $court_price->getCourtTimeFrame();
            $time_parts = explode("-", $court_time_frame);

            $court_start_time = $time_parts[0]; // Thời gian bắt đầu
            $court_end_time = $time_parts[1]; // Thời gian kết thúc
            
            $court_weekday_price = $court_price->getCourtWeekdayPrice();
            $court_weekend_price = $court_price->getCourtWeekendPrice();
            $court_price_frame = number_format($court_weekday_price, 0, ',', '.') . '-' . number_format($court_weekend_price, 0, ',', '.');        

            $sql = "UPDATE court SET 
            court_name = '$court_name', 
            last_modified_date = '$last_modified_date', 
            court_type_id = '$court_type_id'
            
            WHERE court_id = $court_id;"; //

            $sql1 = "UPDATE court_price SET
                court_start_time = '$court_start_time', 
                court_end_time = '$court_end_time', 
                court_time_frame = '$court_time_frame', 
                court_weekday_price = '$court_weekday_price',
                court_weekend_price = '$court_weekend_price',
                court_price_frame = '$court_price_frame'
            
                    WHERE court_price_id = $court_price_id;";


            //Kiểm tra court image
            if($court_image) {
                $court_image_id = $court_image->getCourtImageId();
                $court_images = $court_image->getCourtImage();
                $file_name = $court_images['name'];
                $file_tmp = $court_images['tmp_name'];
                $court_image_path = '../upload/sport-courts-management/'.$file_name;
                $sql2 ="UPDATE court_image SET
                            court_image = '$court_image_path'
                            WHERE court_image_id = $court_image_id; ";   
                if (mysqli_query($link, $sql2) ){
                        // Xử lý và lưu trữ hình ảnh vào thư mục hoặc cơ sở dữ liệu
                        // Ví dụ:
                        $destination = '../upload/sport-courts-management/'.$file_name;
                        move_uploaded_file($file_tmp, $destination);
                }
            }
            
            mysqli_query($link, $sql);
            

            if (mysqli_query($link, $sql1)){
                return true;
            } else {
                return false;
            }
        }

        //Hàm thêm sân
        public function insertCourt($court, $court_price, $court_images){
            $link = "";
            MakeConnection($link);
            $court_name = $court->getCourtName();
            $court_state = "Chưa xóa";
            $created_on_date = date('Y-m-d');
            $court_type_id = $court->getCourtTypeId();
            $account_id = 1;

            $court_price_id = $court_price->getCourtPriceID();
            $court_time_frame = $court_price->getCourtTimeFrame();
            $time_parts = explode("-", $court_time_frame);

            $court_start_time = $time_parts[0]; // Thời gian bắt đầu
            $court_end_time = $time_parts[1]; // Thời gian kết thúc
            
            
            $court_weekday_price = $court_price->getCourtWeekdayPrice();
            $court_weekend_price = $court_price->getCourtWeekendPrice();
            $court_price_frame = number_format($court_weekday_price, 0, ',', '.') . '-' . number_format($court_weekend_price, 0, ',', '.');

            $sql = "INSERT INTO court (court_name, court_state, created_on_date, court_type_id, account_id)
            VALUES ('$court_name', '$court_state', '$created_on_date', '$court_type_id', '$account_id');";

            // Thực hiện truy vấn đầu tiên
            mysqli_query($link, $sql);

            // Lấy court_id từ truy vấn đầu tiên
            $court_id = mysqli_insert_id($link);

            $sql1 = "INSERT INTO court_price (court_start_time, court_end_time, court_time_frame, court_weekday_price, court_weekend_price, court_price_frame, court_id)
            VALUES ('$court_start_time', '$court_end_time', '$court_time_frame', '$court_weekday_price', '$court_weekend_price', '$court_price_frame', '$court_id');";
            // Xử lý tệp hình ảnh được tải lên
            $total_count = count($court_images['name']);
            for($i=0 ; $i < $total_count ; $i++) {
                $file_name = $court_images['name'][$i]; //Lấy ra name của hình ảnh
                $file_tmp = $court_images['tmp_name'][$i]; //Lưu name tạm thời
                $court_image = '../upload/sport-courts-management/'.$file_name; // truyền name ảnh vào biến court img
                $sql2 ="INSERT INTO court_image(court_image, court_id) VALUES ('$court_image', '$court_id');";        
                if (mysqli_query($link, $sql2) ){
                    // Xử lý và lưu trữ hình ảnh vào thư mục hoặc cơ sở dữ liệu
                    // Ví dụ:
                    $destination = '../upload/sport-courts-management/' . $file_name;
                    move_uploaded_file($file_tmp, $destination);
                }
            } 
            
            if (mysqli_query($link, $sql1) ){      
                return true;
            } else {
                return false;
            }
        }

        //Hàm xóa sân
        public function deleteCourt($court_id){
            $link = "";
            MakeConnection($link);
            $sql = "UPDATE court SET court_state = 'Đã xóa' WHERE court_id = $court_id;";
            if (mysqli_query($link, $sql)) {
                return true;
            } else {
                return false;
            }
        }

        public function getCourtImage($id){
            $link = "";
            MakeConnection($link);
            // Lấy dữ liệu
            $result = ExecuteDataQuery($link, "SELECT court_image FROM court_image WHERE court_image_id = $id");
            $court_type = mysqli_fetch_assoc($result);
            ReleaseMemory($link, $result);
            return $court_type;
        }
    }
?>