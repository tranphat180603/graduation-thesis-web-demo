<?php
    require_once ($_SERVER['DOCUMENT_ROOT'] . "/NTP-Sports-Hub/models/connect.php");

    class event {
        private $event_id;
        private $event_name;
        private $event_start_date;
        private $event_end_date;
        private $event_description;
        private $event_image;
        private $event_preferential_rate;
        private $event_preferential_item;
        private $event_state;
        private $created_on_date;
        private $last_modified_date;
        private $account_id;

        public function getEventId() { return $this->event_id; }
        public function getEventName() { return $this->event_name; }
        public function getEventStartDate() { return $this->event_start_date; }
        public function getEventEndDate() { return $this->event_end_date; }
        public function getEventDescription() { return $this->event_description; }
        public function getEventImage() { return $this->event_image; }
        public function getEventPreferentialRate() { return $this->event_preferential_rate; }
        public function getEventPreferentialItem() { return $this->event_preferential_item; }
        public function getEventState() { return $this->event_state; }
        public function getCreatedOnDate() { return $this->created_on_date; }
        public function getLastModifiedDate() { return $this->last_modified_date; }
        public function getAccountId() { return $this->account_id; }

        public function setEventId($event_id) { $this->event_id = $event_id; }
        public function setEventName($event_name) { $this->event_name = $event_name; }
        public function setEventStartDate($event_start_date) { $this->event_start_date = $event_start_date; }
        public function setEventEndDate($event_end_date) { $this->event_end_date = $event_end_date; }
        public function setEventDescription($event_description) { $this->event_description = $event_description; }
        public function setEventImage($event_image) { $this->event_image = $event_image; }
        public function setEventPreferentialRate($event_preferential_rate) { $this->event_preferential_rate = $event_preferential_rate; }
        public function setEventPreferentialItem($event_preferential_item) { $this->event_preferential_item = $event_preferential_item; }
        public function setEventState($event_state) { $this->event_state = $event_state; }
        public function setCreatedOnDate($created_on_date) { $this->created_on_date = $created_on_date; }
        public function setLastModifiedDate($last_modified_date) { $this->last_modified_date = $last_modified_date; }
        public function setAccountId($account_id) { $this->account_id = $account_id; }
        
        public function __construct($event_id = 0, $event_name = "", $event_start_date = "", $event_end_date = "", $event_description = "", $event_image = "", $event_preferential_rate = "", $event_preferential_item = "", $event_state = "", $created_on_date = "", $last_modified_date = "", $account_id = 0) {
            $this->event_id = $event_id;
            $this->event_name = $event_name;
            $this->event_start_date = $event_start_date;
            $this->event_end_date = $event_end_date;
            $this->event_description = $event_description;
            $this->event_image = $event_image;
            $this->event_preferential_rate = $event_preferential_rate;
            $this->event_preferential_item = $event_preferential_item;
            $this->event_state = $event_state;
            $this->created_on_date = $created_on_date;
            $this->last_modified_date = $last_modified_date;
            $this->account_id = $account_id;
        }

        //1. Hàm lấy dữ liệu tất cả sự kiện
        public function view_all_event() {
            //Tạo kết nối đến database
            $link = "";
            MakeConnection($link);

            $result = ExecuteDataQuery($link, "SELECT * FROM sport_hub_event WHERE event_state = 'Còn hạn'");

            $data = array();

            while ($rows = mysqli_fetch_assoc($result)) {
                $event = new event($rows["event_id"], $rows["event_name"], $rows["event_start_date"], $rows["event_end_date"], 
                                    $rows["event_description"], $rows["event_image"], $rows["event_preferential_rate"], 
                                    $rows["event_preferential_item"], $rows["event_state"], $rows["created_on_date"], 
                                    $rows["last_modified_date"], $rows["account_id"]);
                array_push($data, $event);
            }

            //Giải phóng bộ nhớ
            ReleaseMemory($link, $result);

            return $data;
        }

        //2. Hàm lấy dữ liệu tất cả sự kiện cho bảng sự kiện
        public function view_all_event_in_DB() {
            //Tạo kết nối đến database
            $link = "";
            MakeConnection($link);

            $result = ExecuteDataQuery($link, "SELECT * FROM sport_hub_event WHERE event_state <> 'Đã xóa'");

            $data = array();

            while ($rows = mysqli_fetch_assoc($result)) {
                $event = new event($rows["event_id"], $rows["event_name"], $rows["event_start_date"], $rows["event_end_date"], 
                                    $rows["event_description"], $rows["event_image"], $rows["event_preferential_rate"], 
                                    $rows["event_preferential_item"], $rows["event_state"], $rows["created_on_date"], 
                                    $rows["last_modified_date"], $rows["account_id"]);
                array_push($data, $event);
            }

            //Giải phóng bộ nhớ
            ReleaseMemory($link, $result);

            return $data;
        }

        public function getEventData()
        {
            // Tạo kết nối đến database
            $link = "";
            MakeConnection($link);
    
            // Kết nối và lấy dữ liệu tất cả sự kiện từ database
            $result = ExecuteDataQuery($link, "SELECT * FROM sport_hub_event");
            $events = array();
    
            while ($row = mysqli_fetch_assoc($result)) {
    
                // Tạo đối tượng sự kiện và thêm vào mảng
                $event = new event(
                    $row["event_id"],
                    $row["event_name"],
                    $row["event_start_date"],
                    $row["event_end_date"],
                    $row["event_description"],
                    $row["event_image"],
                    $row["event_preferential_rate"],
                    $row["event_preferential_item"],
                    $row["event_state"],
                    $row["created_on_date"],
                    $row["last_modified_date"],
                    $row["account_id"]
                );
                array_push($events, $event);
            }
    
            // Giải phóng bộ nhớ
            ReleaseMemory($link, $result);
    
            return $events;
        }

        //4. Hàm hiển thị tổng số lượng sự kiện
        public function view_all() {
            //Tạo kết nối đến database
            $link = "";
            MakeConnection($link);
        
        
            //Kết nối và lấy dữ liệu tổng số lượng sự kiện từ database
            $result = ExecuteDataQuery($link, "SELECT COUNT(*) FROM sport_hub_event WHERE event_state <> 'Đã xóa'");       
            $row = mysqli_fetch_row($result);
            //Giải phóng bộ nhớ
            ReleaseMemory($link, $result);
            return $row;
        }

        //5. Hàm hiển thị chi tiết sự kiện (view event)
        public function getEventById($event_id){
            $link = "";
            MakeConnection($link);
            $result = ExecuteDataQuery($link, "SELECT * FROM sport_hub_event WHERE event_id = $event_id");
            $row = mysqli_fetch_row($result);
            //Giải phóng bộ nhớ
            ReleaseMemory($link, $result);
            return $row;
            }
        
        //6. Hàm thêm sự kiện 
        public function insertEvent($event)
        {
            //Tạo kết nối đến database
            $link = "";
            MakeConnection($link);

            $event_name = $event->getEventName();
            $event_description = $event->getEventDescription();
            $event_image = $event->getEventImage();
            if($event->getEventPreferentialRate() >= 0) {
                $event_preferential_rate = $event->getEventPreferentialRate();
            } else {
                $event_preferential_rate = "";
            }
            $event_preferential_item = $event->getEventPreferentialItem();
            $event_state = $event->getEventState();
            $event_start_date = $event->getEventStartDate();
            $event_end_date = $event->getEventEndDate();
            $created_on_date = date('Y-m-d');
            $last_modified_date = "";
            $account_id = 1; 
 
           
            $file_name = $event_image['name']; //Lấy ra name của hình ảnh
            $file_tmp = $event_image['tmp_name']; //Lưu name tạm thời
            $event_image = '../upload/event-management/'.$file_name; // truyền name ảnh vào biến court img
            $sql = "INSERT INTO sport_hub_event (event_name, event_description, event_image, event_preferential_rate, event_preferential_item, event_state, event_start_date, event_end_date, created_on_date, last_modified_date, account_id)
                VALUES('$event_name', '$event_description', '$event_image', '$event_preferential_rate', '$event_preferential_item','$event_state', '$event_start_date', '$event_end_date', '$created_on_date', '$last_modified_date', '$account_id')";
                // Xử lý và lưu trữ hình ảnh vào thư mục hoặc cơ sở dữ liệu
                // Ví dụ:
            if (ExecuteNonDataQuery($link, $sql) ){      
                $destination = '../upload/event-management/' . $file_name;
                move_uploaded_file($file_tmp, $destination);
                return true;
            } else {
                return false;
            }
        }

        //7. Hàm chỉnh sửa sự kiện
        public function updateEvent($event)
        {
            //Tạo kết nối đến database
            $link = "";
            MakeConnection($link);
            $event_id = $event->getEventId();
            $event_name = $event->getEventName();
            $event_description = $event->getEventDescription();
            $event_image = $event->getEventImage();
            $event_preferential_rate = $event->getEventPreferentialRate();
            $event_preferential_item = $event->getEventPreferentialItem();
            $event_state = $event->getEventState();
            $event_start_date = $event->getEventStartDate();
            $event_end_date = $event->getEventEndDate();
            $created_on_date = $event->getCreatedOnDate();
            $last_modified_date = date('Y-m-d');
            $account_id = 1;

            if($event_image['name']) {
                $file_name = $event_image['name']; //Lấy ra name của hình ảnh
                $file_tmp = $event_image['tmp_name']; //Lưu name tạm thời
                $event_image = '../upload/event-management/'.$file_name; // truyền name ảnh vào biến event img
                $sql = "UPDATE sport_hub_event SET event_name = '$event_name', event_description = '$event_description', 
                                                event_image = '$event_image', event_preferential_rate = '$event_preferential_rate', 
                                                event_preferential_item = '$event_preferential_item', event_state = '$event_state', 
                                                event_start_date = '$event_start_date', event_end_date = '$event_end_date',
                                                    created_on_date = '$created_on_date', last_modified_date = '$last_modified_date', 
                                                    account_id = '$account_id' WHERE event_id = $event_id";
                if (ExecuteNonDataQuery($link, $sql) ){
                    $destination = '../upload/event-management/' . $file_name;
                    move_uploaded_file($file_tmp, $destination);
                    return true;
                }
            } else {
                $sql = "UPDATE sport_hub_event SET event_name = '$event_name', event_description = '$event_description', 
                                                event_preferential_rate = '$event_preferential_rate', 
                                                event_preferential_item = '$event_preferential_item', event_state = '$event_state', 
                                                event_start_date = '$event_start_date', event_end_date = '$event_end_date',
                                                    created_on_date = '$created_on_date', last_modified_date = '$last_modified_date', 
                                                    account_id = '$account_id' WHERE event_id = $event_id";
                if (ExecuteNonDataQuery($link, $sql) ){
                   return true;
                }
            }
            
            return false;
        }

        //8. Hàm xóa sự kiện
        public function delete_event($event_id){
            $link = "";
            MakeConnection($link);
            $event_ids = explode(",", $event_id); //tách các event id đã chọn thành 1 mảng ngăn cách bởi dấu ,
            
            // kiểm tra số lượng event id đã chọn
            if(count($event_ids) == 1) {
                $sql = "UPDATE sport_hub_event SET 
                        event_state = 'Đã xóa'
                        WHERE event_id = '$event_id'";
                if (ExecuteNonDataQuery($link, $sql)) {
                    return true;
                } else {
                    return false;
                }
            } else if (count($event_ids) > 1) {
                foreach($event_ids as $event_id) {
                    $sql = "UPDATE sport_hub_event SET 
                            event_state = 'Đã xóa'
                            WHERE event_id = '$event_id'";
                    ExecuteNonDataQuery($link, $sql);
                }
                return true;
            }
            
            return false;
        }
    }
?>