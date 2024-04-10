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
    }
?>