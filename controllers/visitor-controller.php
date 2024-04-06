<?php
    require_once ($_SERVER['DOCUMENT_ROOT'] . "/NTP-Sports-Hub/models/visitor-model.php");
    
    class Visitor_Controller {
        public $visitor;

        public function __construct() {
            $this->visitor = new visitor;
        }

        public function XXX() {
            echo "XXX";
        }
    }
?>