<?php
    require_once "../models/connect.php";

    class order_service_detail {
        private $court_order_id;
        private $service_id;
        private $order_item_service_quantity;
        private $order_item_total_service_price;

        public function getCourtOrderId() { return $this->court_order_id; }
        public function getServiceId() { return $this->service_id; }
        public function getOrderItemServiceQuantity() { return $this->order_item_service_quantity; }
        public function getOrderItemTotalServicePrice() { return $this->order_item_total_service_price; }

        public function setCourtOrderId($court_order_id) { $this->court_order_id = $court_order_id; }
        public function setServiceId($service_id) { $this->service_id = $service_id; }
        public function setOrderItemServiceQuantity($order_item_service_quantity) { $this->order_item_service_quantity = $order_item_service_quantity; }
        public function setOrderItemTotalServicePrice($order_item_total_service_price) { $this->order_item_total_service_price = $order_item_total_service_price; }
        
        public function __construct($court_order_id = 0, $service_id = 0, $order_item_service_quantity = 0, $order_item_total_service_price = 0) {
            $this->court_order_id = $court_order_id;
            $this->service_id = $service_id;
            $this->order_item_service_quantity = $order_item_service_quantity;
            $this->order_item_total_service_price = $order_item_total_service_price;
        }
    }
?>