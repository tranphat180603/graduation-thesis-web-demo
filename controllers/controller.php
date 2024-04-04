<?php
    require_once ($_SERVER['DOCUMENT_ROOT'] . "/NTP-Sports-Hub/models/model.php");

    class Controller {
        public $model;

        public function __construct() {
            $this->model = new Model();
        }
    }
?>