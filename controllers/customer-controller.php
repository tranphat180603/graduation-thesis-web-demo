<?php
    require_once ($_SERVER['DOCUMENT_ROOT'] . "/NTP-Sports-Hub/models/customer-model.php");

    class Customer_Controller {
        public $customer;

        public function __construct() {
            $this->customer = new customer();
        }

        //1. Hàm hiển thị tất cả khách hàng
        public function view_all_customer() {
            return $result = $this->customer->view_all_customer();
        }

        public function UpdateCustomer($customerID, $customerName, $email, $phoneNumber, $gender,$accountID, $birthdate,$created_date) {
            try {
                $result = $this->customer->updateCustomerData($customerID, $customerName, $email, $phoneNumber, $gender, $accountID, $birthdate,$created_date);
                if ($result) {
                    header("Location: ../views/customer-account-management.php");
                } else {
                    echo "Failed to update customer data.";
                }
            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();
                
            }
        }

        public function getcustomerdata($username){
            $customerData = $this->customer->fetchCustomerData($username);
            if ($customerData) {
                return $customerData;
            } else {
                echo "Failed to fetch customer data.";
            }
        }

        public function getCountCustomer($year = null){
            // Assign default value to $year if not provided
            if ($year === null) {
                $year = date('Y'); // Get the current year
            }
        
            try {
                $data =  $this->customer->countCustomer($year);
                return $data;
            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();
                return null;
            }
        }

        public function getCountCustomerbyMonth($year = null){
            // Assign default value to $year if not provided
            if ($year === null) {
                $year = date('Y'); // Get the current year
            }
        
            try {
                $data =  $this->customer->countCustomerbyMonth($year);
                return $data;
            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();
                return null;
            }
        }
    }

    $customerController = new Customer_Controller();
    $customerData = $customerController -> getcustomerdata($_SESSION['username']);

    $year = isset($_GET['year']) ? intval($_GET['year']) : date('Y');
    // Get the customer count for the current year
    $customerCount = $customerController->getCountCustomer($year);
    // Get the customer count for the previous year
    $customerCountPrevious = $customerController->getCountCustomer($year - 1);

    $customerCountDiff = $customerCount[0] - $customerCountPrevious[0];

    $customerCountbyMonth = $customerController -> getCountCustomerbyMonth($year);

    if(isset($_POST['save'])){
        // Check if all inputs are posted
        if(isset($_POST['customer-name']) && isset($_POST['email']) && isset($_POST['phone-number']) && isset($_POST['gender']) && isset($_POST['birthdate'])){
            // Get the values from $_POST
            $customerID = $_POST['customer-id'];
            $customerName = $_POST['customer-name'];
            $email = $_POST['email'];
            $phoneNumber = $_POST['phone-number'];
            $gender = $_POST['gender'];
            $accountID = $_POST['account-id'];
            $birthdate = $_POST['birthdate'];
            $created_date = date('Y-m-d');

            // Call the UpdateCustomer function
            $customerController->UpdateCustomer($customerID, $customerName, $email, $phoneNumber, $gender, $accountID, $birthdate,$created_date);
        } else {
            echo "Some inputs are missing!";
        }
    }
?>