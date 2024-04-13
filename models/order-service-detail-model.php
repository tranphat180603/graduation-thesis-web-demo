<?php
    require_once ($_SERVER['DOCUMENT_ROOT'] . "/NTP-Sports-Hub/models/connect.php");

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

        public function view_customer_by_service($year) {
            $link = MakeConnection($link);
            $query = "SELECT s.service_name, COUNT(osd.court_order_id) as order_count
                      FROM order_service_detail osd
                      JOIN service s ON osd.service_id = s.service_id
                      JOIN court_order co ON osd.court_order_id = co.court_order_id
                      WHERE YEAR(co.ordered_on_date) = $year
                      GROUP BY s.service_name";
            $data = array();
        
            $result = ExecuteDataQuery($link, $query);
            if(!$result) {
                // Throw an exception if the query fails
                throw new Exception("Failed to fetch data from the database");
            }
        
            // Fetch associative array rows from the result object
            while ($row = mysqli_fetch_assoc($result)) {
                // Push each row (associative array) into the data array
                array_push($data, $row);
            }    
            // Release memory for the connection
            ReleaseMemory($link, $result);
        
            return $data;
        }
    }
?>