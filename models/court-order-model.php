<?php
    require_once "../models/connect.php";

    class court_order {
        private $court_order_id;
        private $court_schedule_id;
        private $event_id;
        private $total_service_amount;
        private $total_rental_amount;
        private $total_discount_amount;
        private $order_total_payment;
        private $order_total_deposit;
        private $order_state;
        private $customer_account_id;
        private $admin_account_id;
        private $order_cancel_reason;
        private $order_cancel_party_account_id;
        private $ordered_on_date;
        private $canceled_on_date;
        private $refunded_on_date;

        public function getCourtOrderId() { return $this->court_order_id; }
        public function getCourtScheduleId() { return $this->court_schedule_id; }
        public function getEventId() { return $this->event_id; }
        public function getTotalServiceAmount() { return $this->total_service_amount; }
        public function getTotalRentalAmount() { return $this->total_rental_amount; }
        public function getTotalDiscountAmount() { return $this->total_discount_amount; }
        public function getOrderTotalPayment() { return $this->order_total_payment; }
        public function getOrderTotalDeposit() { return $this->order_total_deposit; }
        public function getOrderState() { return $this->order_state; }
        public function getCustomerAccountId() { return $this->customer_account_id; }
        public function getAdminAccountId() { return $this->admin_account_id; }
        public function getOrderCancelReason() { return $this->order_cancel_reason; }
        public function getOrderCancelPartyAccountId() { return $this->order_cancel_party_account_id; }
        public function getOrderedOnDate() { return $this->ordered_on_date; }
        public function getCanceledOnDate() { return $this->canceled_on_date; }
        public function getRefundedOnDate() { return $this->refunded_on_date; }

        public function setCourtOrderId($court_order_id) { $this->court_order_id = $court_order_id; }
        public function setCourtScheduleId($court_schedule_id) { $this->court_schedule_id = $court_schedule_id; }
        public function setEventId($event_id) { $this->event_id = $event_id; }
        public function setTotalServiceAmount($total_service_amount) { $this->total_service_amount = $total_service_amount; }
        public function setTotalRentalAmount($total_rental_amount) { $this->total_rental_amount = $total_rental_amount; }
        public function setTotalDiscountAmount($total_discount_amount) { $this->total_discount_amount = $total_discount_amount; }
        public function setOrderTotalPayment($order_total_payment) { $this->order_total_payment = $order_total_payment; }
        public function setOrderTotalDeposit($order_total_deposit) { $this->order_total_deposit = $order_total_deposit; }
        public function setOrderState($order_state) { $this->order_state = $order_state; }
        public function setCustomerAccountId($customer_account_id) { $this->customer_account_id = $customer_account_id; }
        public function setAdminAccountId($admin_account_id) { $this->admin_account_id = $admin_account_id; }
        public function setOrderCancelReason($order_cancel_reason) { $this->order_cancel_reason = $order_cancel_reason; }
        public function setOrderCancelPartyAccountId($order_cancel_party_account_id) { $this->order_cancel_party_account_id = $order_cancel_party_account_id; }
        public function setOrderedOnDate($ordered_on_date) { $this->ordered_on_date = $ordered_on_date; }
        public function setCanceledOnDate($canceled_on_date) { $this->canceled_on_date = $canceled_on_date; }
        public function setRefundedOnDate($refunded_on_date) { $this->refunded_on_date = $refunded_on_date; }

        public function __construct($court_order_id = 0, $court_schedule_id = 0, $event_id = 0, $total_service_amount = 0, $total_rental_amount = 0, $total_discount_amount = 0, $order_total_payment = 0, $order_total_deposit = 0, $order_state = "", $customer_account_id = 0, $admin_account_id = 0, $order_cancel_reason = "", $order_cancel_party_account_id = 0, $ordered_on_date = "", $canceled_on_date = "", $refunded_on_date = "") {
            $this->court_order_id = $court_order_id;
            $this->court_schedule_id = $court_schedule_id;
            $this->event_id = $event_id;
            $this->total_service_amount = $total_service_amount;
            $this->total_rental_amount = $total_rental_amount;
            $this->total_discount_amount = $total_discount_amount;
            $this->order_total_payment = $order_total_payment;
            $this->order_total_deposit = $order_total_deposit;
            $this->order_state = $order_state;
            $this->customer_account_id = $customer_account_id;
            $this->admin_account_id = $admin_account_id;
            $this->order_cancel_reason = $order_cancel_reason;
            $this->order_cancel_party_account_id = $order_cancel_party_account_id;
            $this->ordered_on_date = $ordered_on_date;
            $this->canceled_on_date = $canceled_on_date;
            $this->refunded_on_date = $refunded_on_date;
        }
    }
?>