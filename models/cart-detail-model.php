<?php
    require_once ($_SERVER['DOCUMENT_ROOT'] . "/NTP-Sports-Hub/models/connect.php");

    class cart_detail {
        private $cart_id;
        private $court_schedule_id;
        private $cart_item_service_amount;
        private $cart_item_rental_amount;
        private $created_on_date;

        public function getCartId() { return $this->cart_id; }
        public function getCourtScheduleId() { return $this->court_schedule_id; }
        public function getCartItemServiceAmount() { return $this->cart_item_service_amount; }
        public function getCartItemRentalAmount() { return $this->cart_item_rental_amount; }
        public function getCreatedOnDate() { return $this->created_on_date; }

        public function setCartId($cart_id) { $this->cart_id = $cart_id; }
        public function setCourtScheduleId($court_schedule_id) { $this->court_schedule_id = $court_schedule_id; }
        public function setCartItemServiceAmount($cart_item_service_amount) { $this->cart_item_service_amount = $cart_item_service_amount; }
        public function setCartItemRentalAmount($cart_item_rental_amount) { $this->cart_item_rental_amount = $cart_item_rental_amount; }
        public function setCreatedOnDate($created_on_date) { $this->created_on_date = $created_on_date; }

        public function __construct($cart_id = 0, $court_schedule_id = 0, $cart_item_service_amount = 0, $cart_item_rental_amount = 0, $created_on_date = "") {
            $this->cart_id = $cart_id;
            $this->court_schedule_id = $court_schedule_id;
            $this->cart_item_service_amount = $cart_item_service_amount;
            $this->cart_item_rental_amount = $cart_item_rental_amount;
            $this->created_on_date = $created_on_date;
        }

        //1. Hàm lấy dữ liệu tất cả chi tiết giỏ hàng
        public function view_all_cart_detail() {
            //Tạo kết nối đến database
            $link = "";
            MakeConnection($link);

            $result = ExecuteDataQuery($link, "SELECT * FROM cart_detail");

            $data = array();

            while ($rows = mysqli_fetch_assoc($result)) {
                $cart_detail = new cart_detail($rows["cart_id"], $rows["court_schedule_id"], $rows["cart_item_service_amount"], $rows["cart_item_rental_amount"], $rows["created_on_date"]);
                array_push($data, $cart_detail);
            }

            //Giải phóng bộ nhớ
            ReleaseMemory($link, $result);

            return $data;
        }

        //2. Hàm xóa chi tiết giỏ hàng
        public function delete_cart_detail($cart_id, $court_schedule_id) {
            //Tạo kết nối đến database
            $link = "";
            MakeConnection($link);

            //Tạo ra câu SQL
            $sql = "DELETE FROM cart_detail WHERE cart_id = $cart_id AND court_schedule_id = $court_schedule_id";

            $result = ExecuteNonDataQuery($link, $sql);

            $message = $result;

            //Giải phóng bộ nhớ
            ReleaseMemory($link, $result);

            return $message;
        }

        //3. Hàm cập nhật chi tiết giỏ hàng khi xóa chi tiết giỏ hàng dịch vụ
        public function update_cart_detail_when_delete_or_update_or_insert_service_detail($cart_id, $court_schedule_id, $cart_item_service_amount) {
            //Tạo kết nối đến database
            $link = "";
            MakeConnection($link);

            //Tạo ra câu SQL
            $sql = "UPDATE cart_detail SET cart_item_service_amount = $cart_item_service_amount WHERE cart_id = $cart_id AND court_schedule_id = $court_schedule_id";

            $result = ExecuteNonDataQuery($link, $sql);

            $message = $result;

            //Giải phóng bộ nhớ
            ReleaseMemory($link, $result);

            return $message;
        }
    }
?>