<?php
    require_once ("../models/court-schedule-model.php");

    class Court_Schedule_Controller {
        public $court_schedule;

        public function __construct() {
            $this->court_schedule = new court_schedule();
        }

        //1. Hàm hiển thị tất cả loại sân
        public function view_all_court_schedule() {
            return $result = $this->court_schedule->view_all_court_schedule();
        }

        //2. Hàm hiển thị tổng số lượng lịch sân
        public function view_all() {
            return $result = $this->court_schedule->view_all();
        }

        //3. Hàm hiển thị tổng số lượng lịch sân theo loại sân
        public function view_court_schedule_by_court_type($court_type_id) {
            return $result = $this->court_schedule->view_court_schedule_by_court_type($court_type_id);
        }

        //4. Hàm hiển thị dữ liệu của bảng lịch sân theo thanh điều hướng
        public function view_court_schedule() {
            //Lấy dữ liệu của biến $_GET['court_type_id']
            $courtType = isset($_GET['court_type_id']) ? $_GET['court_type_id'] : '0'; // Mặc định court_type_id = '0'
            return $result = $this->court_schedule->view_court_schedule($courtType);
        }

        //5. Hàm cập nhật trạng thái của lịch sân thành hết hạn khi quá ngày nhận sân mà lịch sân vẫn chưa được đặt
        public function update_court_schedule_state($court_schedule_id) {
            return $result = $this->court_schedule->update_court_schedule_state($court_schedule_id);
        } 

        //6. Hàm lấy dữ liệu một lịch sân cụ thể
        public function view_specific_court_schedule() {
            $court_schedule_id = isset($_GET['court_schedule_id']) ? $_GET['court_schedule_id'] : ''; 

            if ($court_schedule_id != "") {
              return $result = $this->court_schedule->view_specific_court_schedule($court_schedule_id);
            }
        }

        //7. Hàm kiểm tra trước khi thêm lịch sân mới
        public function check_insert_court_schedule() {
          if(isset($_POST['court_id'], $_POST['court_schedule_date'], $_POST['court_schedule_start_time'], $_POST['court_schedule_end_time'], $_POST['court_schedule_state'])) {
            //Lấy thông tin của các trường trong form
            $court_id = $_POST['court_id'];
            $court_schedule_date = date("Y-m-d", strtotime($_POST['court_schedule_date']));
            $court_schedule_start_time = $_POST['court_schedule_start_time'];
            $court_schedule_end_time = $_POST['court_schedule_end_time'];
            $court_schedule_state = $_POST['court_schedule_state'];

            if($court_id == 0 || $court_schedule_date == "" || $court_schedule_start_time == "0" || $court_schedule_end_time == "0" || $court_schedule_state == "Chọn trạng thái") {
              header("Location: ../views/sport-court-schedules-management.php?notification=insert_fail");
              return;
            }

            // Tách giờ và phút từ chuỗi thời gian
            $court_schedule_start_time_parts = explode(':', $court_schedule_start_time);
            $court_schedule_end_time_parts = explode(':', $court_schedule_end_time);

            // Chuyển đổi thời gian thành timestamp
            $start_timestamp = strtotime($court_schedule_start_time);
            $end_timestamp = strtotime($court_schedule_end_time);

            // Tính khoảng cách giữa hai thời gian
            $time_difference = $end_timestamp - $start_timestamp;

            // Chuyển đổi khoảng cách thành giờ
            $time_difference_hours = $time_difference / 3600;

            // Kiểm tra xem $court_schedule_start_time có nhỏ hơn $court_schedule_end_time không
            if ($court_schedule_start_time_parts[0] < $court_schedule_end_time_parts[0]) {
              // Kiểm tra xem khoảng cách có đủ 1 tiếng hay không
              if ($time_difference_hours >= 1) {
                header("Location: ../views/sport-court-schedules-management.php?notification=insert_fail");
                return;
              } 
            } else {
              header("Location: ../views/sport-court-schedules-management.php?notification=insert_fail");
              return;
            }

            $checkValue = true;

            $court_schedules = $this->court_schedule->data_for_check_insert_court_schedule($court_id, $court_schedule_date, $court_schedule_start_time, $court_schedule_end_time);

            foreach($court_schedules as $court_schedule) {
              $start_time = date('H:i', strtotime($court_schedule->getCourtScheduleStartTime()));
              $end_time = date('H:i', strtotime($court_schedule->getCourtScheduleEndTime()));

              // Tách giờ và phút từ chuỗi thời gian
              $start_time_parts = explode(':', $start_time);
              $end_time_parts = explode(':', $end_time);

              //Kiểm tra xem start time với end time đã tồn tại hay chưa
              if(($court_schedule_start_time_parts[0] < $start_time_parts[0] && 
                    $court_schedule_end_time_parts[0] <= $start_time_parts[0] && $court_schedule_end_time_parts[1] < $start_time_parts[1]) 
                  || ($court_schedule_start_time_parts[0] > $end_time_parts[0]) 
                  || ($court_schedule_start_time_parts[0] == $end_time_parts[0] && $court_schedule_start_time_parts[1] >= $end_time_parts[1])) {
              } else {
                $checkValue = false;
                break;
              }
            }

            if($checkValue) {
              $this->insert_court_schedule();
            } else {
              header("Location: ../views/sport-court-schedules-management.php?notification=insert_fail");    
            }
          }
        }

        //8. Hàm thêm lịch sân mới
        public function insert_court_schedule() {
            if(isset($_POST['court_id'], $_POST['court_schedule_date'], $_POST['court_schedule_start_time'], $_POST['court_schedule_end_time'], $_POST['court_schedule_state'])) {
                //Lấy thông tin của các trường trong form
                $court_id = $_POST['court_id'];
                $court_schedule_date = date("Y-m-d", strtotime($_POST['court_schedule_date']));
                $court_schedule_start_time = $_POST['court_schedule_start_time'];
                $court_schedule_end_time = $_POST['court_schedule_end_time'];
                $court_schedule_state = $_POST['court_schedule_state'];

                $account_id = 1;
                $created_on_date = date("Y-m-d");

                //Đoạn code để generate tự động các khung giờ dựa vào start_time và end_time

                // Chuyển đổi thời gian bắt đầu và kết thúc thành phút
                $start_minutes = (int)substr($court_schedule_start_time, 0, 2) * 60 + (int)substr($court_schedule_start_time, -2);
                $end_minutes = (int)substr($court_schedule_end_time, 0, 2) * 60 + (int)substr($court_schedule_end_time, -2);

                // Khai báo mảng để lưu các khung giờ
                $court_schedule_time_frames = [];

                // Vòng lặp qua từng 30 phút bắt đầu từ thời gian bắt đầu cho đến thời gian kết thúc
                for ($start = $start_minutes; $start < $end_minutes; $start += 30) {
                    // Vòng lặp qua từng 30 phút bắt đầu từ thời gian hiện tại của vòng lặp đầu tiên + 30 phút
                    for ($end = $start + 60; $end < $end_minutes + 30; $end += 30) { // Bắt đầu từ $start + 60 để loại bỏ các khung giờ chênh lệch 30 phút
                        // Định dạng lại thời gian bắt đầu và kết thúc về dạng HH:MM
                        $formatted_start = str_pad(floor($start / 60), 2, '0', STR_PAD_LEFT) . ':' . str_pad($start % 60, 2, '0', STR_PAD_LEFT);
                        $formatted_end = str_pad(floor($end / 60), 2, '0', STR_PAD_LEFT) . ':' . str_pad($end % 60, 2, '0', STR_PAD_LEFT);
                        
                        // Thêm khung giờ vào mảng
                        $court_schedule_time_frames[] = "$formatted_start-$formatted_end";
                    }
                }

                //Đoạn code insert các lịch sân vào database

                //Biến để kiểm tra insert thành công hay không
                $queryResult = true;

                foreach ($court_schedule_time_frames as $court_schedule_time_frame) {
                    $result = $this->court_schedule->insert_court_schedule($court_schedule_date, $court_schedule_start_time, 
                                                                            $court_schedule_end_time, $court_schedule_time_frame, 
                                                                            $court_schedule_state, $created_on_date, $court_id, $account_id);
                    
                    // Kiểm tra kết quả insert
                    if (!$result) {
                        $queryResult = false;
                        break; // Nếu một lần insert thất bại thì dừng vòng lặp
                    }
                }
                
                // Kiểm tra giá trị của biến $queryResult sau khi duyệt mảng
                if ($queryResult) {
                    // echo 'The court schedule has been inserted successfully';
                    header("Location: ../views/sport-court-schedules-management.php?notification=insert_successful");    
                } else {
                    // echo 'The court schedule has been inserted fail';
                    header("Location: ../views/sport-court-schedules-management.php?&notification=insert_fail");
                }                
            }
        }

        //9. Hàm cập nhật lịch sân 
        public function update_court_schedule() {
            if(isset($_POST['court_schedule_id'], $_POST['court_schedule_state'])) {
                //Lấy thông tin của các trường trong form
                $court_schedule_id = $_POST['court_schedule_id'];
                $court_schedule_state = $_POST['court_schedule_state'];

                $result = $this->court_schedule->update_court_schedule($court_schedule_id, $court_schedule_state);

                // Kiểm tra giá trị của biến $result
                if ($result) {
                    // echo 'The court schedule has been updated successfully';
                    header("Location: ../views/sport-court-schedules-management.php?notification=update_successful");    
                } else {
                    // echo 'The court schedule has been updated fail';
                    header("Location: ../views/sport-court-schedules-management.php?notification=update_fail");
                }   
            }
        }

        //10. Hàm xóa lịch sân 
        public function delete_court_schedule() {
          if(isset($_GET['court_schedule_id'])) {
            $court_schedule_id = $_GET['court_schedule_id'];
                
            $result = $this->court_schedule->delete_court_schedule($court_schedule_id);

            // Kiểm tra giá trị của biến $result
            if ($result) {
              // echo 'The court schedule has been deleted successfully';
              header("Location: ../views/sport-court-schedules-management.php?notification=delete_successful");   
            } else {
              // echo 'The court schedule has been deleted fail';
              header("Location: ../views/sport-court-schedules-management.php?notification=delete_fail");
            }   
          }
        }

        //11. Hàm điều chỉnh trạng thái của lịch sân khi quản lý hủy đơn với một trong ba lý do: ‘Sân này không cho thuê nữa’, ’Lịch sân này không khả dụng nữa’, ‘Sân này đang được bảo trì, sữa chữa’
        public function cancel_order_update_schedule_to_expired($court_schedule_id) {
          $result = $this->court_schedule->cancel_order_update_schedule_to_expired($court_schedule_id);   
        }

        //12. Hàm cập nhật trạng thái lịch sân khi hủy đơn với lý do "Đơn đặt sân chưa được thanh toán"
        public function cancel_order_update_schedule_to_haveNotBooked($court_schedule_id) {
          $result = $this->court_schedule->cancel_order_update_schedule_to_haveNotBooked($court_schedule_id);   
        }

        //13. Hàm cập nhật trạng thái của lịch sân thành hết hạn khi đơn đặt sân chưa được xác nhận thanh toán kịp
        public function update_court_schedule_state_order_payment($court_schedule_id) {
          return $result = $this->court_schedule->update_court_schedule_state_order_payment($court_schedule_id);
        } 
    }

    if(isset($_GET["option"])) {
        $_option = $_GET["option"];
        switch ($_option) {
            case "insert_court_schedule": 
                $court_schedule_controller = new Court_Schedule_Controller();
                $court_schedule_controller->check_insert_court_schedule();
            break;
            case "update_court_schedule": 
                $court_schedule_controller = new Court_Schedule_Controller();
                $court_schedule_controller->update_court_schedule();
            break;
            case "delete_court_schedule": 
                $court_schedule_controller = new Court_Schedule_Controller();
                $court_schedule_controller->delete_court_schedule();
            break;
        }
    }   

    if(isset($_GET['notification'])) {
        $_notification = $_GET['notification'];

        echo "
          <script>
            var overlayFrame = document.getElementById('overlay-wrapper');
            overlayFrame.style.display = 'block';
          </script>
        "; 

        if($_notification == "insert_successful") {
          include "./notification/action-successful.php";
          echo "
            <script>
              var message = document.getElementById('action-successful-message');
              message.textContent = 'Bạn đã thêm lịch sân thành công';
            </script>
          ";
        } else if($_notification == "insert_fail") {
          include "./notification/warning.php"; 
          echo "
            <script>
              var warningQuestion = document.getElementById('warning-question');
              warningQuestion.textContent = 'Bạn đã thực hiện thao tác thêm lịch sân!';
              
              var warningExplanation = document.getElementById('warning-explanation');
              warningExplanation.textContent = 'Chúng tôi rất tiếc khi thông báo rằng lịch sân đã không được thêm thành công';
            </script>
          ";
        } else if($_notification == "update_successful") {
          include "./notification/action-successful.php";
          echo "
            <script>
              var message = document.getElementById('action-successful-message');
              message.textContent = 'Bạn đã sửa lịch sân thành công';
            </script>
          ";
        } else if($_notification == "update_fail") {
          include "./notification/warning.php";
          echo "
            <script>
              var warningQuestion = document.getElementById('warning-question');
              warningQuestion.textContent = 'Bạn đã thực hiện thao tác sửa lịch sân!';
              
              var warningExplanation = document.getElementById('warning-explanation');
              warningExplanation.textContent = 'Chúng tôi rất tiếc khi thông báo rằng lịch sân đã không được sửa thành công';
            </script>
          ";
        } else if($_notification == "delete_successful") {
          include "./notification/action-successful.php";
          echo "
            <script>
              var message = document.getElementById('action-successful-message');
              message.textContent = 'Bạn đã xóa lịch sân thành công';
            </script>
          ";
        } else if($_notification == "delete_fail") {
          include "./notification/warning.php";
          echo "
          <script>
              var warningQuestion = document.getElementById('warning-question');
              warningQuestion.textContent = 'Bạn đã thực hiện thao tác xóa lịch sân!';
              
              var warningExplanation = document.getElementById('warning-explanation');
              warningExplanation.textContent = 'Chúng tôi rất tiếc khi thông báo rằng lịch sân đã không được xóa thành công';
            </script>
          ";
        }
    }

    //Thay đổi CSS của thẻ li đang được chọn
    $courtType = isset($_GET['court_type_id']) ? $_GET['court_type_id'] : '0'; // Mặc định court_type_id = '0'

    // Lấy URL hiện tại
    $current_url = $_SERVER['PHP_SELF'];

    // Kiểm tra nếu URL hiện tại là ../views/sport-court-schedules-management.php
    if (strpos($current_url, 'sport-court-schedules-management.php') !== false) {
      echo "
          <script>
              document.addEventListener('DOMContentLoaded', function() {
                  var liElement = document.getElementById('li-court-type-".$courtType."');
                  liElement.style.borderBottom = '2px solid #285D8F';

                  var aElement = document.getElementById('a-court-type-".$courtType."')
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

      $court_schedules = $this->view_all_court_schedule();
        
      foreach($court_schedules as $court_schedule) {
        if(str_replace("/", "", $court_schedule->getCourtScheduleDate()) >= str_replace("/", "", $currentDate)) {
          $this->update_court_schedule_state($court_schedule->getCourtScheduleId());
        }
      }
    }
?>
