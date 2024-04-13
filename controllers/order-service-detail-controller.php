<?php
    require_once ($_SERVER['DOCUMENT_ROOT'] . "/NTP-Sports-Hub/models/order-service-detail-model.php");

    class Order_Service_Detail_Controller {
        public $order_service_detail;

        public function __construct() {
            $this->order_service_detail = new order_service_detail();
        }

        public function viewCustomerService($year){
            try {
                $data = $this->order_service_detail->view_customer_by_service($year);
                return $data;
            } catch (Exception $e) {
                echo "Error123: " . $e->getMessage();
                return null;
            }
        }
    }

    $order_service_controller = new Order_Service_Detail_Controller();
    $year = isset($_GET['year']) ? intval($_GET['year']) : date('Y');
    $order_service_count = $order_service_controller->viewCustomerService($year);
    $customer_service_labels = [];
    $customer_service_count = [];
    foreach ($order_service_count as $entry){
      $customer_service_labels[] = $entry['service_name'];
      $customer_service_count[] = $entry['order_count'];
    }
?>