<?php
    require_once ($_SERVER['DOCUMENT_ROOT'] . "/NTP-Sports-Hub/models/court-type-model.php");

    class Court_Type_Controller {
        public $court_type;

        public function __construct() {
            $this->court_type = new court_type();
        }
        
        //1. Hàm hiển thị tất cả loại sân
        public function view_all_court_type() {
            return $result = $this->court_type->view_all_court_type();
        }

        //3. Hiển thị loại sân theo id
        public function view_court_type_by_id($court_type_id) {
            return $result = $this->court_type->getCourtTypeByID($court_type_id);
        }

        public function view_count(){
            return $result = $this->court_type->view_count_court_type();
        }

        public function open_court_type_detail($id){
            return $result = $this->court_type->court_type_detail($id);
        }

        public function update_court_type($id, $name, $img){
            try {
                $result = $this->court_type->update_ct($id, $name, $img);
                if ($result) {
                    header("Location: ../views/sport-court-types-management.php?noti=updatesuccess");
                } else {
                    header("Location: ../views/sport-court-types-management.php?noti=updatefail");
                }
            } catch (Exception $e) {
                echo "Lỗi: " . $e->getMessage();
                
            }
        }
        public function insert_court_type($name, $icon){
            try {
                $result = $this->court_type->insert_ct($name, $icon);
                if ($result) {
                    header("Location: ../views/sport-court-types-management.php?noti=insertsuccess");
                } else {
                    header("Location: ../views/sport-court-types-management.php?noti=insertfail");
                }
            } catch (Exception $e) {
                echo "123Error: " . $e->getMessage();
            }
        }
        public function delete_court_type($ids){
            $success = true;
            foreach ($ids as $id) {
                $result = $this->court_type->delete_ct($id);
                if (!$result) {
                    $success = false;
                }
            }
            if ($success) {
                echo '<script>window.location.href = "../views/sport-court-types-management.php?noti=deletesuccess";</script>';
                exit(); // Ensure to stop further execution
            } else {
                echo '<script>window.location.href = "../views/sport-court-types-management.php?noti=deletefail";</script>';
                exit(); // Ensure to stop further execution
            }
        } 
        public function handleImageUpload($id) {
            if (isset($_FILES["image-input"])) {
                
                $file_name = $_FILES["image-input"]["name"];
                $file_extension = pathinfo($file_name, PATHINFO_EXTENSION); // Get the file extension
                $target_dir = "../upload/sport-court-types-management/";
                
                
                $target_file = $target_dir . $file_name; // Concatenate the file name with the directory
                $temp = $_FILES["image-input"]["tmp_name"];
            
                // Update the avatar URL in the database
                $this->court_type->updateCourtTypeURL($target_file, $id);
            
                // Check if the file has been moved successfully
                if (move_uploaded_file($temp, $target_file)) {
                    header("Location: ../views/sport-court-types-management.php");
                }
            } else {
                echo "Lỗi";
            }
            header("Location: ../views/sport-court-types-management.php");

        }
        public function showNoti($mess){
            return $this->court_type->showNoti($mess);
        }
        
    }


    
    
?>