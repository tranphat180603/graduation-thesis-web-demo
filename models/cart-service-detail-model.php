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
    }
?>