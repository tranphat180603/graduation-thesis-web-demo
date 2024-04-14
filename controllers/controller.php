<?php
    require_once ($_SERVER['DOCUMENT_ROOT'] . "/NTP-Sports-Hub/models/model.php");

    class Controller {
        public $model;

        public function __construct() {
            $this->model = new Model();
        }

        public function view_all_court_type()
        {
            return $this->model->view_all_court_type();
        }

        public function getEventData()
        {
            $events = $this->model->getEventData();
            foreach ($events as $event) {
                $event->setEventImage($this->changeImagePath($event->getEventImage()));
            }
            return $events;
        }

        private function changeImagePath($imagePath)
        {
            return str_replace('../', './', $imagePath);
        }
    
        public function getMinPrice()
        {
            return $this->model->getMinPrice();
        }

        public function getMaxPrice()
        {
            return $this->model->getMaxPrice();
        }

        public function getAverageRatingByCourtSchedule($court_id)
        {
            return $this->model->getAverageRatingByCourtSchedule($court_id);
        }

        public function getTotalCompletedOrdersByScheduleId()
        {
            return $this->model->getTotalCompletedOrdersByScheduleId();
        }

        public function getTopThreeCompletedCourts()
        {
            $completedCourts = $this->getTotalCompletedOrdersByScheduleId();
            $topThreeCourts = array_slice($completedCourts, 0, 3);

            return $topThreeCourts;
        }

        public function view_all_court()
        {
            return $this->model->view_all_court();
        }

        public function getGroupConcatImages()
        {
            return $this->model->getGroupConcatImages();
        }

        public function view_all_court_schedule()
        {
            return $this->model->view_all_court_schedule();
        }

        public function getCourtByType()
        {
            //Lấy dữ liệu của biến $_GET['court_type_id']
            $courtType = isset($_GET['court_type_id']) ? $_GET['court_type_id'] : '0'; // Mặc định court_type_id = '0'
            return $this->model->getCourtByType($courtType);
        }
        
        public function view_all_court_images()
        {
            return $this->model->view_all_court_images();
        }
    }
?>