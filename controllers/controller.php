<?php
    require_once "../models/model.php";

    class Controller {
        public $model;

        public function __construct() {
            $this->model = new Model();
        }

        public function laugh() {
            if(isset($_GET['laugh_sound'])) {
                $laughSound = $this->model->hihi();
                include "views/list-of-sports-courts.php";
            } else {
                $laughSound = $this->model->haha($_GET['laugh_sound']);
                include "views/sport-court-details.php";
            }
        }
    }
?>