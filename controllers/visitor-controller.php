<?php
    require_once ($_SERVER['DOCUMENT_ROOT'] . "/NTP-Sports-Hub/models/visitor-model.php");
    
    class Visitor_Controller {
        public $visitor;

        public function __construct() {
            $this->visitor = new visitor;
        }

        public function getCountVisitor($year) {
            // Assign default value to $year if not provided
            if ($year === null) {
                $year = date('Y'); // Get the current year
            }
        
            try {
                $data =  $this->visitor->CountVisitor($year);
                return $data;
            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();
                return null;
            }        
        }

        public function getCountVisitorbyMonth($year) {
            // Assign default value to $year if not provided
            if ($year === null) {
                $year = date('Y'); // Get the current year
            }
        
            try {
                $data =  $this->visitor->CountVisitorbyMonth($year);
                return $data;
            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();
                return null;
            }        
        }
    }

    $visitor = new visitor();

$year = isset($_GET['year']) ? intval($_GET['year']) : date('Y');
// Get the customer count for the current year
$visitorCount = $visitor->CountVisitor($year);
$visitorCount_previous = $visitor->CountVisitor($year-1);
$visitorCountdiff = $visitorCount[0]-$visitorCount_previous[0];
$visitorCountbyMonth = $visitor->CountVisitorbyMonth($year);

?>