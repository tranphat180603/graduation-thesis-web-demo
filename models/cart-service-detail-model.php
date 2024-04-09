<?php
    require_once ($_SERVER['DOCUMENT_ROOT'] . "/NTP-Sports-Hub/models/connect.php");

    class cart_service_detail {
        private $cart_id;
        private $court_schedule_id;
        private $service_id;
        private $cart_item_service_quantity;
        private $cart_item_total_service_price;

        public function getCartId() { return $this->cart_id; }
        public function getCourtScheduleId() { return $this->court_schedule_id; }
        public function getServiceId() { return $this->service_id; }
        public function getCartItemServiceQuantity() { return $this->cart_item_service_quantity; }
        public function getCartItemTotalServicePrice() { return $this->cart_item_total_service_price; }

        public function setCartId($cart_id) { $this->cart_id = $cart_id; }
        public function setCourtScheduleId($court_schedule_id) { $this->court_schedule_id = $court_schedule_id; }
        public function setServiceId($service_id) { $this->service_id = $service_id; }
        public function setCartItemServiceQuantity($cart_item_service_quantity) { $this->cart_item_service_quantity = $cart_item_service_quantity; }
        public function setCartItemTotalServicePrice($cart_item_total_service_price) { $this->cart_item_total_service_price = $cart_item_total_service_price; }

        public function __construct($cart_id = 0, $court_schedule_id = 0, $service_id = 0, $cart_item_service_quantity = 0, $cart_item_total_service_price = 0) {
            $this->cart_id = $cart_id;
            $this->court_schedule_id = $court_schedule_id;
            $this->service_id = $service_id;
            $this->cart_item_service_quantity = $cart_item_service_quantity;
            $this->cart_item_total_service_price = $cart_item_total_service_price;
        }

        //1. Hàm lấy dữ liệu tất cả chi tiết giỏ hàng dịch vụ
        public function view_all_cart_service_detail() {
            //Tạo kết nối đến database
            $link = "";
            MakeConnection($link);

            $result = ExecuteDataQuery($link, "SELECT * FROM cart_service_detail");

            $data = array();

            while ($rows = mysqli_fetch_assoc($result)) {
                $cart_service_detail = new cart_service_detail($rows["cart_id"], $rows["court_schedule_id"], $rows["service_id"], $rows["cart_item_service_quantity"], $rows["cart_item_total_service_price"]);
                array_push($data, $cart_service_detail);
            }

            //Giải phóng bộ nhớ
            ReleaseMemory($link, $result);

            return $data;
        }

        //2. Hàm xóa chi tiết giỏ hàng dịch vụ
        public function delete_service_detail($cart_id, $court_schedule_id, $service_id) {
            //Tạo kết nối đến database
            $link = "";
            MakeConnection($link);

            //Tạo ra câu SQL
            $sql = "DELETE FROM cart_service_detail WHERE cart_id = $cart_id AND court_schedule_id = $court_schedule_id AND service_id = $service_id";

            $result = ExecuteNonDataQuery($link, $sql);

            $message = $result;

            //Giải phóng bộ nhớ
            ReleaseMemory($link, $result);

            return $message;
        }

        //3. Hàm cập nhật thêm số lượng vào chi tiết giỏ hàng dịch vụ
        public function modify_service_detail_quantity($cart_id, $court_schedule_id, $service_id, $cart_item_service_quantity, $cart_item_total_service_price) {
            //Tạo kết nối đến database
            $link = "";
            MakeConnection($link);

            //Tạo ra câu SQL
            $sql = "UPDATE cart_service_detail SET cart_item_service_quantity = $cart_item_service_quantity, 
                    cart_item_total_service_price = $cart_item_total_service_price WHERE cart_id = $cart_id 
                    AND court_schedule_id = $court_schedule_id AND service_id = $service_id";

            $result = ExecuteNonDataQuery($link, $sql);

            $message = $result;

            //Giải phóng bộ nhớ
            ReleaseMemory($link, $result);

            return $message;
        }
    }
?>