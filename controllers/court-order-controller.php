<?php
    require_once ($_SERVER['DOCUMENT_ROOT'] . "/NTP-Sports-Hub/models/court-order-model.php");

    require_once ($_SERVER['DOCUMENT_ROOT'] . "/NTP-Sports-Hub/models/court-schedule-model.php");

    class Court_Order_Controller {
        public $court_order;

        public function __construct() {
            $this->court_order = new court_order();
        }

        //1. Hàm hiển thị tổng số lượng đơn đặt sân
        public function view_all_court_order() {
            return $result = $this->court_order->view_all_court_order();
        }

        //2. Hàm hiển thị tổng số lượng đơn đặt sân theo trạng thái của đơn đặt sân
        public function view_court_order_by_court_order_state($order_state) {
            return $result = $this->court_order->view_court_order_by_court_order_state($order_state);
        }

        //3. Hàm hiển thị dữ liệu của bảng đơn đặt sân theo thanh điều hướng
        public function view_court_order() {
            //Lấy dữ liệu của biến $_GET['court_order_state_id']
            $order_state_id = isset($_GET['court_order_state_id']) ? $_GET['court_order_state_id'] : '0'; // Mặc định court_order_state_id = '0'
            
            switch ($order_state_id) {
                case 0: 
                    $order_state = "Tất cả";
                break;
                case 1:
                    $order_state = "Chờ thanh toán";
                break;
                case 2:
                    $order_state = "Chờ nhận sân";
                break;
                case 3:
                    $order_state = "Hoàn thành";
                break;
                case 4:
                    $order_state = "Đã hủy";
                break;
                case 5:
                    $order_state = "Chờ hoàn tiền";
                break;
            }
            
            return $result = $this->court_order->view_court_order($order_state);
        }

        //4. Hàm lấy dữ liệu một đơn đặt sân cụ thể
        public function view_specific_court_order() {
            $court_order_id = isset($_GET['court_order_id']) ? $_GET['court_order_id'] : ''; 

            if ($court_order_id != "") {
              return $result = $this->court_order->view_specific_court_order($court_order_id);
            }
        }

        //5. Hàm xử lý đơn đặt sân có trạng thái CHỜ THANH TOÁN 
        public function process_payment_court_order($court_order_id) {
            return $result = $this->court_order->process_payment_court_order($court_order_id);
        }

        //6. Hàm xử lý đơn đặt sân có trạng thái CHỜ NHẬN SÂN 
        public function process_receive_court_order($court_order_id) {
            return $result = $this->court_order->process_receive_court_order($court_order_id);
        }

        //7. Hàm xử lý đơn đặt sân có trạng thái CHỜ HOÀN TIỀN 
        public function process_refunded_court_order($court_order_id, $refunded_on_date) {
            return $result = $this->court_order->process_refunded_court_order($court_order_id, $refunded_on_date);
        }

        //8. Hàm hủy đơn đặt sân
        public function cancel_court_order($court_order_id, $cancel_reason, $court_schedule_id, $canceled_on_date) {
            $court_schedule_controller = new Court_Schedule_Controller();

            $result = true;
            $result2 = true;

            if($cancel_reason == "Sân này không cho thuê nữa" || $cancel_reason == "Lịch sân này không khả dụng nữa" || $cancel_reason == "Sân này đang được bảo trì, sữa chữa") {
                $result = $this->court_order->cancel_court_order_by_admin($court_order_id, $canceled_on_date, $cancel_reason);

                $result2 = $court_schedule_controller->cancel_order_update_schedule_to_expired($court_schedule_id);
            } else if($cancel_reason == "Khách hàng không đến nhận sân") {
                $result = $this->court_order->cancel_court_order_by_customer($court_order_id, $canceled_on_date, $cancel_reason);

                $result2 = $court_schedule_controller->cancel_order_update_schedule_to_expired($court_schedule_id);
            } else if($cancel_reason == "Đơn đặt sân chưa được thanh toán") {
                $result = $this->court_order->cancel_court_order_by_customer($court_order_id, $canceled_on_date, $cancel_reason);

                //Code lại
                $court_schedules = $court_schedule_controller->view_all_court_schedule();

                $court_schedule_date = "";
                $court_schedule_start_time = "";
                $court_schedule_end_time = "";
                $court_schedule_time_frame = "";

                foreach($court_schedules as $court_schedule) {
                    if($court_schedule->getCourtScheduleId() == $court_schedule_id) {
                        $court_schedule_date = $court_schedule->getCourtScheduleDate();
                        $court_schedule_start_time = $court_schedule->getCourtScheduleStartTime();
                        $court_schedule_end_time = $court_schedule->getCourtScheduleEndTime();
                        $court_schedule_time_frame = $court_schedule->getCourtScheduleTimeFrame();
                    }
                }

                $court_schedule_time_frame_start = substr($court_schedule_time_frame, 0, 5);
                $court_schedule_time_frame_end = substr($court_schedule_time_frame, -5);

                // Tách giờ và phút từ chuỗi thời gian
                $court_schedule_time_frame_start_parts = explode(':', $court_schedule_time_frame_start);
                $court_schedule_time_frame_end_parts = explode(':', $court_schedule_time_frame_end);

                foreach($court_schedules as $court_schedule) {
                    $schedule_id = $court_schedule->getCourtScheduleId();
                    $schedule_state = $court_schedule->getCourtScheduleState();
                    $date = $court_schedule->getCourtScheduleDate();
                    $start_time = $court_schedule->getCourtScheduleStartTime();
                    $end_time = $court_schedule->getCourtScheduleEndTime();
                    $time_frame = $court_schedule->getCourtScheduleTimeFrame();

                    $time_frame_start = substr($time_frame, 0, 5);
                    $time_frame_end = substr($time_frame, -5);
        
                    // Tách giờ và phút từ chuỗi thời gian
                    $time_frame_start_parts = explode(':', $time_frame_start);
                    $time_frame_end_parts = explode(':', $time_frame_end);

                    if($court_schedule_date == $date && $court_schedule_start_time == $start_time && $court_schedule_end_time == $end_time && $schedule_state != "Đã đặt") {
                        if((($time_frame_start_parts[0] >= $court_schedule_time_frame_start_parts[0] && $time_frame_start_parts[1] >= $court_schedule_time_frame_start_parts[1])
                            && ($time_frame_start_parts[0] <= $court_schedule_time_frame_end_parts[0] && $time_frame_start_parts[1] <= $court_schedule_time_frame_end_parts[1]))
                            || (($time_frame_end_parts[0] >= $court_schedule_time_frame_start_parts[0] && $time_frame_end_parts[1] >= $court_schedule_time_frame_start_parts[1])
                            && ($time_frame_end_parts[0] <= $court_schedule_time_frame_end_parts[0] && $time_frame_end_parts[1] <= $court_schedule_time_frame_end_parts[1]))) {
                            $current_date = date("Y-m-d");
                            if(str_replace("-", "", $date) > str_replace("-", "", $current_date)) {
                                $result2 = $court_schedule_controller->cancel_order_update_schedule_to_haveNotBooked($schedule_id);
                            } else {
                                $result2 = $court_schedule_controller->cancel_order_update_schedule_to_expired($schedule_id);
                            }
                        }
                    }
                }

                // Kiểm tra giá trị của biến $result
                if ($result && $result2) {
                    // echo 'The court order has been canceled successfully';
                    return true;    
                } else {
                    // echo 'The court order has been canceled fail';
                    return false;
                } 
            }
        }

        //9. Hàm cập nhật đơn đặt sân sau mỗi 12 tiếng
        public function update_court_order_per_12($court_order_id, $currentDate) {
            return $result = $this->court_order->update_court_order_per_12($court_order_id, $currentDate);
        } 
    }

    //Thay đổi CSS của thẻ li đang được chọn
    $court_order_state_id = isset($_GET['court_order_state_id']) ? $_GET['court_order_state_id'] : '0'; // Mặc định court_order_state_id = '0'

    // Lấy URL hiện tại
    $current_url = $_SERVER['PHP_SELF'];

    // Kiểm tra nếu URL hiện tại là ../views/sport-court-orders-management.php
    if (strpos($current_url, 'sport-court-orders-management.php') !== false) {
        echo "
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    var liElement = document.getElementById('li-court-order-state-".$court_order_state_id."');
                    liElement.style.borderBottom = '2px solid #285D8F';

                    var aElement = document.getElementById('a-court-order-state-".$court_order_state_id."')
                    aElement.style.color = '#285D8F';
                    aElement.style.fontSize = '16px';
                    aElement.style.fontStyle = 'normal';
                    aElement.style.fontWeight = '500';
                    aElement.style.lineHeight = '24px';
                });
            </script>
        ";
    }

    if (isset($_POST['currentDate'])) {
        $currentDate = $_POST['currentDate']; // Nhận giá trị từ JavaScript
  
        $court_orders = $this->view_all_court_order();

        $court_schedule_controller = new Court_Schedule_Controller();

        $court_schedules = $court_schedule_controller->view_all_court_schedule();

        foreach($court_orders as $court_order) {
            if($court_order->getOrderState() == "Chờ thanh toán") {
                foreach($court_schedules as $court_schedule) {
                    if($court_schedule->getCourtScheduleId() == $court_order->getCourtScheduleId()) {
                        if(str_replace("-", "", $court_schedule->getCourtScheduleDate()) >= str_replace("-", "", $currentDate)) {
                            $this->update_court_order_per_12($court_order->getCourtOrderId(), "$currentDate");
                            $court_schedule_controller->update_court_schedule_state_order_payment($court_schedule->getCourtScheduleId());
                        }
                    }
                }
            }
        }
    }
?>