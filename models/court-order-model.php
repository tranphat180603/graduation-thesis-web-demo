<?php
    require_once ($_SERVER['DOCUMENT_ROOT'] . "/NTP-Sports-Hub/models/connect.php");

    class court_order {
        private $court_order_id;
        private $court_schedule_id;
        private $event_id;
        private $total_service_amount;
        private $total_rental_amount;
        private $total_discount_amount;
        private $order_total_payment;
        private $order_total_deposit;
        private $payment_method;
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
        public function getPaymentMethod() { return $this->payment_method; }
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
        public function setPaymentMethod($payment_method) { $this->payment_method = $payment_method; }
        public function setOrderState($order_state) { $this->order_state = $order_state; }
        public function setCustomerAccountId($customer_account_id) { $this->customer_account_id = $customer_account_id; }
        public function setAdminAccountId($admin_account_id) { $this->admin_account_id = $admin_account_id; }
        public function setOrderCancelReason($order_cancel_reason) { $this->order_cancel_reason = $order_cancel_reason; }
        public function setOrderCancelPartyAccountId($order_cancel_party_account_id) { $this->order_cancel_party_account_id = $order_cancel_party_account_id; }
        public function setOrderedOnDate($ordered_on_date) { $this->ordered_on_date = $ordered_on_date; }
        public function setCanceledOnDate($canceled_on_date) { $this->canceled_on_date = $canceled_on_date; }
        public function setRefundedOnDate($refunded_on_date) { $this->refunded_on_date = $refunded_on_date; }

        public function __construct($court_order_id = 0, $court_schedule_id = 0, $event_id = 0, $total_service_amount = 0, $total_rental_amount = 0, $total_discount_amount = 0, $order_total_payment = 0, $order_total_deposit = 0, $payment_method = "", $order_state = "", $customer_account_id = 0, $admin_account_id = 0, $order_cancel_reason = "", $order_cancel_party_account_id = 0, $ordered_on_date = "", $canceled_on_date = "", $refunded_on_date = "") {
            $this->court_order_id = $court_order_id;
            $this->court_schedule_id = $court_schedule_id;
            $this->event_id = $event_id;
            $this->total_service_amount = $total_service_amount;
            $this->total_rental_amount = $total_rental_amount;
            $this->total_discount_amount = $total_discount_amount;
            $this->order_total_payment = $order_total_payment;
            $this->order_total_deposit = $order_total_deposit;
            $this->payment_method = $payment_method;
            $this->order_state = $order_state;
            $this->customer_account_id = $customer_account_id;
            $this->admin_account_id = $admin_account_id;
            $this->order_cancel_reason = $order_cancel_reason;
            $this->order_cancel_party_account_id = $order_cancel_party_account_id;
            $this->ordered_on_date = $ordered_on_date;
            $this->canceled_on_date = $canceled_on_date;
            $this->refunded_on_date = $refunded_on_date;
        }

        //1. Hàm hiển thị tổng số lượng đơn đặt sân sân
        public function view_all_court_order() {
            //Tạo kết nối đến database
            $link = "";
            MakeConnection($link);

            //Kết nối và lấy dữ liệu tổng số lượng đơn đặt sân sân từ database
            $result = ExecuteDataQuery($link, "SELECT COUNT(*) FROM court_order");

            $row = mysqli_fetch_row($result);
            
            //Giải phóng bộ nhớ
            ReleaseMemory($link, $result);

            return $row;
        }

        //2. Hàm hiển thị tổng số lượng đơn đặt sân theo trạng thái đơn đặt sân
        public function view_court_order_by_court_order_state($order_state) {
            //Tạo kết nối đến database
            $link = "";
            MakeConnection($link);

            //Kết nối và lấy dữ liệu tổng số lượng đơn đặt sân từ database
            $result = ExecuteDataQuery($link, "SELECT COUNT(*) FROM court_order WHERE order_state = '$order_state'"); 

            $row = mysqli_fetch_row($result);
            
            //Giải phóng bộ nhớ
            ReleaseMemory($link, $result);

            return $row;
        }

        //3. Hàm hiển thị dữ liệu của bảng đơn đặt sân theo thanh điều hướng
        public function view_court_order($order_state) {
            //Tạo kết nối đến database
            $link = "";
            MakeConnection($link);

            // Thực hiện truy vấn dựa vào order_state
            if ($order_state == "Tất cả") {
                $result = ExecuteDataQuery($link, "SELECT * FROM court_order");
            } else {
                $result = ExecuteDataQuery($link, "SELECT court_order.* FROM court_order WHERE order_state = '$order_state'");
            }

            $data = array();

            while ($rows = mysqli_fetch_assoc($result)) {
                $court_order = new court_order($rows["court_order_id"], $rows["court_schedule_id"], $rows["event_id"], 
                                    $rows["total_service_amount"], $rows["total_rental_amount"], $rows["total_discount_amount"], 
                                    $rows["order_total_payment"], $rows["order_total_deposit"], $rows["payment_method"], 
                                    $rows["order_state"], $rows["customer_account_id"], $rows["admin_account_id"], 
                                    $rows["order_cancel_reason"], $rows["order_cancel_party_account_id"], $rows["ordered_on_date"],
                                    $rows["canceled_on_date"], $rows["refunded_on_date"]);
                array_push($data, $court_order);
            }

            //Giải phóng bộ nhớ
            ReleaseMemory($link, $result);

            return $data;
        }

        //4. Hàm lấy dữ liệu một đơn đặt sân cụ thể
        public function view_specific_court_order($court_order_id) {
            //Tạo kết nối đến database
            $link = "";
            MakeConnection($link);

            $result = ExecuteDataQuery($link, "SELECT * FROM court_order WHERE court_order_id = $court_order_id");

            $row = mysqli_fetch_row($result);

            //Giải phóng bộ nhớ
            ReleaseMemory($link, $result);

            return $row;
        }

        //5. Hàm xử lý dơn đặt sân có trạng thái CHỜ THANH TOÁN
        public function process_payment_court_order($court_order_id) {
            //Tạo kết nối đến database
            $link = "";
            MakeConnection($link);

            //Tạo ra câu SQL
            $sql = "UPDATE court_order SET order_state = 'Chờ nhận sân' WHERE court_order_id = $court_order_id";

            $result = ExecuteNonDataQuery($link, $sql);

            $message = $result;

            //Giải phóng bộ nhớ
            ReleaseMemory($link, $result);

            return $message;
        }

        //6. Hàm xử lý dơn đặt sân có trạng thái CHỜ NHẬN SÂN
        public function process_receive_court_order($court_order_id) {
            //Tạo kết nối đến database
            $link = "";
            MakeConnection($link);

            //Tạo ra câu SQL
            $sql = "UPDATE court_order SET order_state = 'Hoàn thành' WHERE court_order_id = $court_order_id";

            $result = ExecuteNonDataQuery($link, $sql);

            $message = $result;

            //Giải phóng bộ nhớ
            ReleaseMemory($link, $result);

            return $message;
        }

        //7. Hàm xử lý dơn đặt sân có trạng thái CHỜ HOÀN TIỀN
        public function process_refunded_court_order($court_order_id, $refunded_on_date) {
            //Tạo kết nối đến database
            $link = "";
            MakeConnection($link);

            //Tạo ra câu SQL
            $sql = "UPDATE court_order SET order_state = 'Đã hủy', refunded_on_date = '$refunded_on_date' WHERE court_order_id = $court_order_id";

            $result = ExecuteNonDataQuery($link, $sql);

            $message = $result;

            //Giải phóng bộ nhớ
            ReleaseMemory($link, $result);

            return $message;
        }

        //8. Hàm hủy dơn đặt sân có trạng thái CHỜ THANH TOÁN hoặc CHỜ NHẬN SÂN với lý do hủy từ phía NTPSH
        public function cancel_court_order_by_admin($court_order_id, $canceled_on_date, $cancel_reason) {
            //Tạo kết nối đến database
            $link = "";
            MakeConnection($link);

            //Tạo ra câu SQL
            $sql = "UPDATE court_order SET order_state = 'Chờ hoàn tiền', canceled_on_date = '$canceled_on_date', order_cancel_reason = '$cancel_reason', order_cancel_party_account_id = 'Khu liên hợp thể thao NTP' WHERE court_order_id = $court_order_id";

            $result = ExecuteNonDataQuery($link, $sql);

            $message = $result;

            //Giải phóng bộ nhớ
            ReleaseMemory($link, $result);

            return $message;
        }

        //9. Hàm hủy dơn đặt sân có trạng thái CHỜ THANH TOÁN hoặc CHỜ NHẬN SÂN với lý do hủy từ phía khách hàng
        public function cancel_court_order_by_customer($court_order_id, $canceled_on_date, $cancel_reason) {
            //Tạo kết nối đến database
            $link = "";
            MakeConnection($link);

            //Tạo ra câu SQL
            $sql = "UPDATE court_order SET order_state = 'Đã hủy', canceled_on_date = '$canceled_on_date', order_cancel_reason = '$cancel_reason', order_cancel_party_account_id = 'Khách hàng' WHERE court_order_id = $court_order_id";

            $result = ExecuteNonDataQuery($link, $sql);

            $message = $result;

            //Giải phóng bộ nhớ
            ReleaseMemory($link, $result);

            return $message;
        }

        //10. Hàm cập nhật đơn đặt sân sau mỗi 12 tiếng
        public function update_court_order_per_12($court_order_id, $canceled_on_date) {
            //Tạo kết nối đến database
            $link = "";
            MakeConnection($link);

            //Tạo ra câu SQL
            $sql = "UPDATE court_order SET order_state = 'Chờ hoàn tiền', order_cancel_reason = 'Khu liên hợp NTP chưa xác nhận thanh toán kịp', canceled_on_date = '$canceled_on_date' WHERE court_order_id = $court_order_id";

            $result = ExecuteNonDataQuery($link, $sql);

            $message = $result;

            //Giải phóng bộ nhớ
            ReleaseMemory($link, $result);

            return $message;
        }

        // 11. Hàm đếm số lượng đơn đặt sân theo ID khách hàng và trạng thái đơn hàng.
        public function count_court_order_by_customer_and_state($customer_id, $order_state)
        {
            $link = "";
            MakeConnection($link);
            if ($order_state == "Tất cả") {
                $query = ExecuteDataQuery($link, "SELECT COUNT(*) FROM court_order WHERE customer_account_id = '$customer_id'");
            } else {
                $query = ExecuteDataQuery($link, "SELECT COUNT(*) FROM court_order WHERE customer_account_id = '$customer_id' AND order_state = '$order_state'");
            }

            $result = mysqli_fetch_row($query);

            ReleaseMemory($link, $query);

            return $result[0];
        }

        // 12. Hàm lấy tổng số đơn đặt sân đã hoàn thành theo ID lịch sân và trả về một mảng chứa dữ liệu với số lượng đơn đặt sân hoàn thành của mỗi sân.
        public function getTotalCompletedOrdersByScheduleId()
        {
            $link = "";
            MakeConnection($link);

            $result = ExecuteDataQuery($link, "SELECT court.court_id, COUNT(court_order_id) AS total_completed_orders 
                FROM court 
                LEFT JOIN court_schedule ON court.court_id = court_schedule.court_id
                LEFT JOIN court_order ON court_schedule.court_schedule_id = court_order.court_schedule_id AND court_order.order_state = 'Hoàn thành'
                GROUP BY court.court_id
                ORDER BY total_completed_orders DESC, court.court_id ASC;");
            $data = [];
            while ($row = mysqli_fetch_assoc($result)) {
                $data[] = $row;
            }

            ReleaseMemory($link, $result);

            return $data;
        }

        // 13. Hàm lấy thông tin đơn đặt sân của một khách hàng dựa trên ID khách hàng và trạng thái đơn hàng và trả về một mảng chứa các đối tượng đơn đặt sân.
        public function view_court_order_by_customer_id_and_state($customer_account_id, $order_state)
        {
            $link = "";
            MakeConnection($link);

            if ($order_state == "Tất cả") {
                $result = ExecuteDataQuery($link, "SELECT * FROM court_order WHERE customer_account_id = '$customer_account_id'");
            } else {
                $result = ExecuteDataQuery($link, "SELECT * FROM court_order WHERE customer_account_id = '$customer_account_id' AND order_state = '$order_state'");
            }

            $data = array();

            while ($rows = mysqli_fetch_assoc($result)) {
                $court_order = new court_order(
                    $rows["court_order_id"],
                    $rows["court_schedule_id"],
                    $rows["event_id"],
                    $rows["total_service_amount"],
                    $rows["total_rental_amount"],
                    $rows["total_discount_amount"],
                    $rows["order_total_payment"],
                    $rows["order_total_deposit"],
                    $rows["payment_method"],
                    $rows["order_state"],
                    $rows["customer_account_id"],
                    $rows["admin_account_id"],
                    $rows["order_cancel_reason"],
                    $rows["order_cancel_party_account_id"],
                    $rows["ordered_on_date"],
                    $rows["canceled_on_date"],
                    $rows["refunded_on_date"]
                );
                array_push($data, $court_order);
            }

            ReleaseMemory($link, $result);

            return $data;
        }

        //14. Hàm hủy đơn ở giao diện lịch sử đơn hàng 
        public function cancelCourtOrderByCustomer($court_order_id, $canceled_on_date, $cancel_reason, $cancel_party_account_id)
        {
            // Tạo kết nối đến cơ sở dữ liệu
            $link = "";
            MakeConnection($link);
            // Tạo ra câu SQL
            $sql = "UPDATE court_order 
                SET order_state = 'Đã hủy', 
                    canceled_on_date = '$canceled_on_date', 
                    order_cancel_reason = '$cancel_reason', 
                    order_cancel_party_account_id = '$cancel_party_account_id' 
                WHERE court_order_id = $court_order_id ";

            $result = ExecuteNonDataQuery($link, $sql);

            return $result;
        }

        public function view_top_service($year){
            $link = MakeConnection($link);
            $query = "SELECT e.event_name, COUNT(*) AS event_count
                      FROM court_order o
                      JOIN sport_hub_event e ON o.event_id = e.event_id
                      WHERE order_state = 'Hoàn thành' 
                      AND o.event_id IS NOT NULL
                      AND YEAR(o.ordered_on_date) = $year
                      GROUP BY e.event_name, o.event_id
                      ORDER BY event_count DESC
                      LIMIT 5";
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
        
        public function get_revenue_and_court_order($year){
            $link = MakeConnection($link);
            $query = "SELECT 
                        DATE_FORMAT(ordered_on_date, '%M') AS month,
                        SUM(order_total_payment) AS total_revenue,
                        COUNT(*) AS total_court_order
                      FROM 
                        court_order
                      WHERE 
                        order_state = 'Hoàn thành'
                        AND YEAR(ordered_on_date) = $year
                      GROUP BY 
                        MONTH(ordered_on_date)";
            $data = array();
        
            $result = ExecuteDataQuery($link, $query);
            if(!$result) {
                throw new Exception("Failed to fetch data from the database");
            }
        
            while ($row = mysqli_fetch_assoc($result)) {
                array_push($data, $row);
            }    
            // Release memory for the connection
            ReleaseMemory($link, $result);
        
            return $data;
        }
        
        public function get_revenue_by_court_type($year){
            $link = MakeConnection($link);
            $query = "SELECT 
                        ct.court_type_name AS name,
                        DATE_FORMAT(co.ordered_on_date, '%M') AS month,
                        SUM(co.order_total_payment) AS total_revenue
                      FROM 
                        court_order co
                        JOIN 
                        court_schedule cs ON co.court_schedule_id = cs.court_schedule_id
                        JOIN 
                        court c ON cs.court_id = c.court_id
                        JOIN 
                        court_type ct ON c.court_type_id = ct.court_type_id
                      WHERE 
                        co.order_state = 'Hoàn thành'
                        AND YEAR(co.ordered_on_date) = $year
                      GROUP BY 
                        MONTH(co.ordered_on_date), ct.court_type_name";
            $data = array();
        
            $result = ExecuteDataQuery($link, $query);
            if(!$result) {
                throw new Exception("Failed to fetch data from the database");
            }
        
            while ($row = mysqli_fetch_assoc($result)) {
                array_push($data, $row);
            }    
            // Release memory for the connection
            ReleaseMemory($link, $result);
        
            return $data;
        }        

        public function countCourtOrder($year){
            $link = "";
            MakeConnection($link);
    
            //Kết nối và lấy dữ liệu tổng số lượng lịch sân từ database
            $result = ExecuteDataQuery($link,"SELECT COUNT(*) FROM court_order WHERE YEAR(ordered_on_date) = $year");
    
            $row = mysqli_fetch_row($result);
            
            //Giải phóng bộ nhớ
            ReleaseMemory($link, $result);
    
            return $row;
        }

        public function insertCourtOrder($court_schedule_id, $event_id, $total_service_amount, $total_rental_amount, $total_discount_amount, $order_total_payment, $order_total_deposit, $payment_method, $order_state, $customer_account_id, $admin_account_id = 1, $order_cancel_reason = "", $order_cancel_party_account_id = 0, $canceled_on_date = "", $refunded_on_date = "") {
            $link = MakeConnection($link);
            
            // Get today's date and time
            $ordered_on_date = date('Y-m-d');
            
            $query = "INSERT INTO court_order (court_schedule_id, event_id, total_service_amount, total_rental_amount, total_discount_amount, order_total_payment, order_total_deposit, payment_method, order_state, customer_account_id, admin_account_id, order_cancel_reason, order_cancel_party_account_id, ordered_on_date, canceled_on_date, refunded_on_date) 
                      VALUES ('$court_schedule_id', '$event_id', '$total_service_amount', '$total_rental_amount', '$total_discount_amount', '$order_total_payment', '$order_total_deposit', '$payment_method', '$order_state', '$customer_account_id', '$admin_account_id', '$order_cancel_reason', '$order_cancel_party_account_id', '$ordered_on_date', '$canceled_on_date', '$refunded_on_date')";
            
            $result = ExecuteNonDataQuery($link, $query);
            
            if ($result) {
                return true;
            } else {
                throw new Exception("Error inserting data: " . mysqli_error($link));
            }
        }
        
        public function getCourtfromCourtSchedule($court_schedule_id){
            $link = "";
            MakeConnection($link);
            
            // Query to get the court name, image, schedule date, time frame, and court type from court_schedule
            $query = "SELECT court.court_name, court_image.court_image, court_schedule.court_schedule_date, court_schedule.court_schedule_time_frame, court_type.court_type_name
                      FROM court 
                      JOIN court_schedule ON court.court_id = court_schedule.court_id 
                      LEFT JOIN court_image ON court.court_id = court_image.court_image_id 
                      LEFT JOIN court_type ON court.court_type_id = court_type.court_type_id 
                      WHERE court_schedule.court_schedule_id = $court_schedule_id";
            
            // Execute the query
            $result = ExecuteDataQuery($link, $query);
            
            if($result && mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                $court_name = $row['court_name'];
                $court_image = $row['court_image'];
                $court_schedule_date = $row['court_schedule_date'];
                $court_schedule_time_frame = $row['court_schedule_time_frame'];
                $court_type_name = $row['court_type_name'];
                
                // Free memory and close connection
                ReleaseMemory($link, $result);
                
                return array(
                    'court_name' => $court_name, 
                    'court_image' => $court_image,
                    'court_schedule_date' => $court_schedule_date,
                    'court_schedule_time_frame' => $court_schedule_time_frame,
                    'court_type_name' => $court_type_name
                );
            } else {
                // Handle case where no court data is found
                return "Court data not found";
            }
        }
        
        
        
        
        
        
        
        
    }
?>