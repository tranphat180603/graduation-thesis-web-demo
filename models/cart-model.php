<?php
    require_once ($_SERVER['DOCUMENT_ROOT'] . "/NTP-Sports-Hub/models/connect.php");
    
    class cart {
        private $cart_id;
        private $event_id;
        private $cart_service_amount;
        private $cart_rental_amount;
        private $cart_discount_amount;
        private $cart_total_payment;
        private $cart_total_deposit;
        private $account_id;

        public function getCartId() { return $this->account_id; }
        public function getEventId() { return $this->event_id; }
        public function getCartServiceAmount() { return $this->cart_service_amount; }
        public function getCartRentalAmount() { return $this->cart_rental_amount; }
        public function getCartDiscountAmount() { return $this->cart_discount_amount; }
        public function getCartTotalPayment() { return $this->cart_total_payment; }
        public function getCartTotalDeposit() { return $this->cart_total_deposit; }
        public function getAccountId() { return $this->account_id; }

        public function setCartId($account_id) { $this->account_id = $account_id; }
        public function setEventId($event_id) { $this->event_id = $event_id; }
        public function setCartServiceAmount($cart_service_amount) { $this->cart_service_amount = $cart_service_amount; }
        public function setCartRentalAmount($cart_rental_amount) { $this->cart_rental_amount = $cart_rental_amount; }
        public function setCartDiscountAmount($cart_discount_amount) { $this->cart_discount_amount = $cart_discount_amount; }
        public function setCartTotalPayment($cart_total_payment) { $this->cart_total_payment = $cart_total_payment; }
        public function setCartTotalDeposit($cart_total_deposit) { $this->cart_total_deposit = $cart_total_deposit; }
        public function setAccountId($account_id) { $this->account_id = $account_id; }

        public function __construct($cart_id = 0, $event_id = 0, $cart_service_amount = 0, $cart_rental_amount = 0, $cart_discount_amount = 0, $cart_total_payment = 0, $cart_total_deposit = 0, $account_id = 0) {
            $this->cart_id = $cart_id;
            $this->event_id = $event_id;
            $this->cart_service_amount = $cart_service_amount;
            $this->cart_rental_amount = $cart_rental_amount;
            $this->cart_discount_amount = $cart_discount_amount;
            $this->cart_total_payment = $cart_total_payment;
            $this->cart_total_deposit = $cart_total_deposit;
            $this->account_id = $account_id;
        }

        //1. Hàm lấy dữ liệu tất cả giỏ hàng
        public function view_all_cart() {
            //Tạo kết nối đến database
            $link = "";
            MakeConnection($link);

            $result = ExecuteDataQuery($link, "SELECT * FROM cart");

            $data = array();

            while ($rows = mysqli_fetch_assoc($result)) {
                $cart = new cart($rows["cart_id"], $rows["event_id"], $rows["cart_service_amount"], $rows["cart_rental_amount"], $rows["cart_discount_amount"], $rows["cart_total_payment"], $rows["cart_total_deposit"], $rows["account_id"]);
                array_push($data, $cart);
            }

            //Giải phóng bộ nhớ
            ReleaseMemory($link, $result);

            return $data;
        }
    }
?>