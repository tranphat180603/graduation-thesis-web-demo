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

        public function getCourtOrderId() { return $this->court_order_id; };
        public function getCourtScheduleId() { return $this->court_schedule_id; };
        public function getEventId() { return $this->event_id; };
        public function getTotalServiceAmount() { return $this->total_service_amount; };
        public function getTotalRentalAmount() { return $this->total_rental_amount; };
        public function getTotalDiscountAmount() { return $this->total_discount_amount; };
        public function getOrderTotalPayment() { return $this->order_total_payment; };
        public function getOrderTotalDeposit() { return $this->order_total_deposit; };
        public function getOrderState() { return $this->order_state; };
        public function getCustomerAccountId() { return $this->customer_account_id; };
        public function getAdminAccountId() { return $this->admin_account_id; }; 
        public function getOrderCancelReason() { return $this->order_cancel_reason; };
        public function getOrderCancelPartyAccountId() { return $this->order_cancel_party_account_id; };
        public function getOrderedOnDate() { return $this->ordered_on_date; };
        public function getCanceledOnDate() { return $this->canceled_on_date; };
        public function getRefundedOnDate() { return $this->refunded_on_date; };

        public function getCourtOrderId($court_order_id) { $this->court_order_id = $court_order_id; };
        public function getCourtScheduleId($court_schedule_id) { $this->court_schedule_id = $court_schedule_id; };
        public function getEventId($event_id) { $this->event_id = $event_id; };
        public function getTotalServiceAmount($total_service_amount) { $this->total_service_amount = $total_service_amount; };
        public function getTotalRentalAmount($total_rental_amount) { $this->total_rental_amount = $total_rental_amount; };
        public function getTotalDiscountAmount($total_discount_amount) { $this->total_discount_amount = $total_discount_amount; };
        public function getOrderTotalPayment($order_total_payment) { $this->order_total_payment = $order_total_payment; };
        public function getOrderTotalDeposit($order_total_deposit) { $this->order_total_deposit = $order_total_deposit; };
        public function getOrderState($order_state) { $this->order_state = $order_state; };
        public function getCustomerAccountId($customer_account_id) { $this->customer_account_id = $customer_account_id; };
        public function getAdminAccountId($admin_account_id) { $this->admin_account_id = $admin_account_id; }; 
        public function getOrderCancelReason($order_cancel_reason) { $this->order_cancel_reason = $order_cancel_reason; };
        public function getOrderCancelPartyAccountId($order_cancel_party_account_id) { $this->order_cancel_party_account_id = $order_cancel_party_account_id; };
        public function getOrderedOnDate($ordered_on_date) { $this->ordered_on_date = $ordered_on_date; };
        public function getCanceledOnDate($canceled_on_date) { $this->canceled_on_date = $canceled_on_date; };
        public function getRefundedOnDate($refunded_on_date) { $this->refunded_on_date = $refunded_on_date; };

        public function _construct() {
            $this->court_order_id = 0;
            $this->court_schedule_id = 0;
            $this->event_id = 0;
            $this->total_service_amount = 0;
            $this->total_rental_amount = 0;
            $this->total_discount_amount = 0;
            $this->order_total_payment = 0;
            $this->order_total_deposit = 0;
            $this->order_state = "None";
            $this->customer_account_id = 0;
            $this->admin_account_id = 0;
            $this->order_cancel_reason = "None";
            $this->order_cancel_party_account_id = "None";
            $this->ordered_on_date = "3000/12/30";
            $this->canceled_on_date = "3000/12/30";
            $this->refunded_on_date = "3000/12/30";
        }

        public function _construct($court_order_id, $court_schedule_id, $event_id, $total_service_amount, $total_rental_amount, $total_discount_amount, $order_total_payment, $order_total_deposit, $order_state, $customer_account_id, $admin_account_id, $order_cancel_reason, $order_cancel_party_account_id, $ordered_on_date, $canceled_on_date, $refunded_on_date) {
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