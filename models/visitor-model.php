<?php
    require_once ($_SERVER['DOCUMENT_ROOT'] . "/NTP-Sports-Hub/models/connect.php");

    class visitor {
        private $visitor_id;
        private $visitor_IP_address;
        private $created_on_date;

        public function getVisitorId() { return $this->visitor_id; }
        public function getVisitorIPAddress() { return $this->visitor_IP_address; }
        public function getCreatedOnDate() { return $this->created_on_date; }

        public function setVisitorId() { return $this->visitor_id = $visitor_id; }
        public function setVisitorIPAddress() { return $this->visitor_IP_address = $visitor_IP_address; }
        public function setCreatedOnDate() { return $this->created_on_date = $created_on_date; }

        public function __construct($visitor_id = 0, $visitor_IP_address = "", $created_on_date = "") {
            $this->visitor_id = $visitor_id;
            $this->visitor_IP_address = $visitor_IP_address;
            $this->created_on_date = $created_on_date;
        }

        public function CountVisitor($year){
            $link = "";
            MakeConnection($link);
    
            //Kết nối và lấy dữ liệu tổng số lượng lịch sân từ database
            $result = ExecuteDataQuery($link,"SELECT COUNT(*) FROM visitor WHERE YEAR(created_on_date) = $year");
    
            $row = mysqli_fetch_row($result);
            
            //Giải phóng bộ nhớ
            ReleaseMemory($link, $result);
    
            return $row;
        }

        public function CountVisitorbyMonth($year){
            $link = "";
            $data = array();
            MakeConnection($link);
    
            //Kết nối và lấy dữ liệu tổng số lượng lịch sân từ database
            $result = ExecuteDataQuery($link,"SELECT DATE_FORMAT(created_on_date, '%M') AS month, COUNT(*) AS count FROM visitor WHERE YEAR(created_on_date) = $year GROUP BY MONTH(created_on_date)");
    
            while ($row = mysqli_fetch_assoc($result)) {
                array_push($data, $row);
            }    
            
            //Giải phóng bộ nhớ
            ReleaseMemory($link, $result);
    
            return $data;
        }
    }
?>