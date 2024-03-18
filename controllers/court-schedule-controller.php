<?php
    require_once ("../models/court-schedule-model.php");

    class Court_Schedule_Controller {
        public $court_schedule;

        public function __construct() {
            $this->court_schedule = new court_schedule();
        }

        public function view_all() {
            return $result = $this->court_schedule->view_all();
        }

        public function view_court_schedule_by_court_type($court_type_id) {
            return $result = $this->court_schedule->view_court_schedule_by_court_type($court_type_id);
        }

        public function view_court_schedule() {
            //Lấy dữ liệu của biến $_GET['court_type_id']
            $courtType = isset($_GET['court_type_id']) ? $_GET['court_type_id'] : '0'; // Mặc định court_type_id = '0'
            return $result = $this->court_schedule->view_court_schedule($courtType);
        }
    }

    //Thay đổi CSS của thẻ li đang được chọn
    if (isset($_GET['court_type_id'])) {
        $courtType = $_GET['court_type_id'];
        if ($courtType == '0') {
            echo "
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        var liElement = document.getElementById('li-court-type-0');
                        liElement.style.borderBottom = '2px solid #285D8F';

                        var aElement = document.getElementById('a-court-type-0')
                        aElement.style.color = '#285D8F';
                        aElement.style.fontSize = '16px';
                        aElement.style.fontStyle = 'normal';
                        aElement.style.fontWeight = '500';
                        aElement.style.lineHeight = '24px';
                    });
                </script>
            ";  
        } else {
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
    } else {
        echo "
            <script>
                var url = new URL(window.location.href);
                url.searchParams.set('court_type_id', '0');
                window.location.href = url.href;
            </script>
        ";
    }
?>