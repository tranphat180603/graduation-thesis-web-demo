<?php
    require_once ($_SERVER['DOCUMENT_ROOT'] . "/NTP-Sports-Hub/models/event-model.php");

    class Event_Controller {
        public $event;

        public function __construct() {
            $this->event = new event();
        }

        //1. Hàm lấy dữ liệu tất cả sự kiện
        public function view_all_event() {
            return $result = $this->event->view_all_event();
        }

        //2. Hàm lấy dữ liệu tất cả sự kiện
        public function view_all_event_in_DB() {
            return $result = $this->event->view_all_event_in_DB();
        }

        //3. Hàm hiển thị tổng số lượng sự kiện
        public function view_all() {
            return $this->event->view_all();
        }

        //4. Hàm trả về thông tin sự kiện cụ thể theo Event ID
        public function view_event_detail() {
            if(isset($_GET['event_id'])){
                $event_ids = explode(",", $_GET['event_id']); //tách các service id đã chọn thành 1 mảng ngăn cách bởi dấu ,
                if (count($event_ids) == 1) {
                    return $result = $this->event->getEventById($event_ids[0]);
                }
            }
        }

        //5. Thêm sự kiện mới
        public function insert_event($event) {
            $queryResult = $event -> insertEvent($event);
            // Kiểm tra giá trị của biến $queryResult sau khi duyệt mảng
            if ($queryResult) {
              // echo 'The event has been inserted successfully';
              return true;   
            } else {
              // echo 'The event has been inserted fail';
              return false;
            }              
        }

        //6. Hàm cập nhật lịch sân
        public function update_event($event) {
            $queryResult = $event -> updateEvent($event);
            if ($queryResult) {
            // echo 'The service has been updated successfully';
                return true;   
            } else {
            // echo 'The service has been updated fail';
                return false;
            }   
        }

        //7. Hàm xóa lịch sân
        public function delete_event($event_id) {
            $queryResult = $this -> event -> delete_event($event_id);
            // Kiểm tra giá trị của biến $queryResult sau khi duyệt mảng
            if ($queryResult) {
                // echo 'The service has been delete successfully';
                return true;   
            } else {
                // echo 'The service has been delete fail';
                return false;
            }              
        }
    }
?>