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
    }
?>