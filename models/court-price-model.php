<?php
    require_once ($_SERVER['DOCUMENT_ROOT'] . "/NTP-Sports-Hub/models/connect.php");

    class court_price {
        private $court_price_id;
        private $court_start_time;
        private $court_end_time;
        private $court_time_frame;
        private $court_weekday_price;
        private $court_weekend_price;
        private $court_price_frame;
        private $court_id;

        public function getCourtPriceId() { return $this->court_price_id; }
        public function getCourtStartTime() { return $this->court_start_time; }
        public function getCourtEndTime() { return $this->court_end_time; }
        public function getCourtTimeFrame() { return $this->court_time_frame; }
        public function getCourtWeekdayPrice() { return $this->court_weekday_price; }
        public function getCourtWeekendPrice() { return $this->court_weekend_price; }
        public function getCourtPriceFrame() { return $this->court_price_frame; }
        public function getCourtId() { return $this->court_id; }

        public function setCourtPriceId($court_price_id) { $this->court_price_id = $court_price_id; }
        public function setCourtStartTime($court_start_time) { $this->court_start_time = $court_start_time; }
        public function setCourtEndTime($court_end_time) { $this->court_end_time = $court_end_time; }
        public function setCourtTimeFrame($court_time_frame) { $this->court_time_frame = $court_time_frame; }
        public function setCourtWeekdayPrice($court_weekday_price) { $this->court_weekday_price = $court_weekday_price; }
        public function setCourtWeekendPrice($court_weekend_price) { $this->court_weekend_price = $court_weekend_price; }
        public function setCourtPriceFrame($court_price_frame) { $this->court_price_frame = $court_price_frame; }
        public function setCourtId($court_id) { $this->court_id = $court_id; }
        
        public function __construct($court_price_id = 0, $court_start_time = "", $court_end_time = "", $court_time_frame = "", $court_weekday_price = 0, $court_weekend_price = 0, $court_price_frame = "", $court_id = 0) {
            $this->court_price_id = $court_price_id;
            $this->court_start_time = $court_start_time;
            $this->court_end_time = $court_end_time;
            $this->court_time_frame = $court_time_frame;
            $this->court_weekday_price = $court_weekday_price;
            $this->court_weekend_price = $court_weekend_price;
            $this->court_price_frame = $court_price_frame;
            $this->court_id = $court_id;
        }

        // 1. Hàm lấy giá sân thấp nhất theo từng sân và trả về một mảng chứa court_id và giá sân thấp nhất.
        public function getMinPrice()
        {
            $link = "";
            MakeConnection($link);
            $result = ExecuteDataQuery($link, "SELECT court_id, MIN(LEAST(cp.court_weekday_price, cp.court_weekend_price)) AS min_price
                FROM court_price cp
                GROUP BY court_id;");

            $minPrices = array();
            while ($row = mysqli_fetch_assoc($result)) {
                $minPrices[$row['court_id']] = $row['min_price'];
            }

            ReleaseMemory($link, $result);

            return $minPrices;
        }

        //2. Hàm lấy giá sân cao nhất theo từng sân và trả về một mảng chứa court_id và giá sân cao nhất.
        public function getMaxPrice()
        {
            $link = "";
            MakeConnection($link);
            $result = ExecuteDataQuery($link, "SELECT court_id, MAX(GREATEST(cp.court_weekday_price, cp.court_weekend_price)) AS max_price
                FROM court_price cp
                GROUP BY court_id;");

            $maxPrices = array();
            while ($row = mysqli_fetch_assoc($result)) {
                $maxPrices[$row['court_id']] = $row['max_price'];
            }

            ReleaseMemory($link, $result);

            return $maxPrices;
        }

        // Hàm lấy ra thông tin tất cả giá sân (17 dòng thông tin)
        public function getAllCourtPriceInformations() {
            $link = "";
            MakeConnection($link);
            $result = ExecuteDataQuery($link, "SELECT * FROM court_price;");
            $resultToUse = array();
            while ($rows = mysqli_fetch_assoc($result)) {
                $courtPrice = new court_price(
                    $rows["court_price_id"],
                    $rows["court_start_time"],
                    $rows["court_end_time"],
                    $rows["court_time_frame"],
                    $rows["court_weekday_price"],
                    $rows["court_weekend_price"],
                    $rows["court_price_frame"],
                    $rows["court_id"]
                );
                array_push($resultToUse, $courtPrice);
            }
            ReleaseMemory($link, $result);
            return $resultToUse;
        }
       
        // Hàm lấy thông tin giá sân theo court_id
        public function getCourtPriceByCourtID($court_id){
            $link = "";
            MakeConnection($link);
            $result = ExecuteDataQuery($link, "SELECT * FROM court_price WHERE court_id = ".$court_id.";");
            $resultToUse = array();
            while ($rows = mysqli_fetch_assoc($result)) {
                $courtPrice = new court_price(
                    $rows["court_price_id"],
                    $rows["court_start_time"],
                    $rows["court_end_time"],
                    $rows["court_time_frame"],
                    $rows["court_weekday_price"],
                    $rows["court_weekend_price"],
                    $rows["court_price_frame"],
                    $rows["court_id"]
                );
                array_push($resultToUse, $courtPrice);
            }
            ReleaseMemory($link, $result);
            return $resultToUse;
        }

        // Hàm lấy thông tin giá sân theo court_price_id
        public function getCourtPriceById($court_price_id) {
            $link = "";
            MakeConnection($link);
            $result = ExecuteDataQuery($link, "SELECT * FROM court_price WHERE court_price_id = ".$court_price_id.";");
            $row = mysqli_fetch_row($result);
            //Giải phóng bộ nhớ
            ReleaseMemory($link, $result);
            return $row;
        }
    }
?>