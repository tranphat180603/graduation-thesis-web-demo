<?php
    require_once ($_SERVER['DOCUMENT_ROOT'] . "/NTP-Sports-Hub/models/connect.php");

    require_once ($_SERVER['DOCUMENT_ROOT'] . "/NTP-Sports-Hub/controllers/account-controller.php");

    function signUpBySUName($link, $account_sign_up_name, $account_name, $account_hash_password) {
        $account_controller = new Account_Controller();
        $created_on_date = date("Y-m-d");

        //Thêm tài khoản mới
        $accResult = ExecuteNonDataQuery($link, "INSERT INTO account(account_type, account_sign_up_name, account_name, account_hash_password, 
                                                created_on_date) VALUES ('Khách hàng', '$account_sign_up_name', '$account_name', 
                                                '".md5($account_hash_password)."', '$created_on_date')");

        //Lấy account_id của tài khoản vừa thêm
        $account_id = 0;
        $accounts = $account_controller->view_all_account();
        foreach($accounts as $account) {
        if($account->getAccountSignUpName() == $account_sign_up_name) {
            $account_id = $account->getAccountId();
        }
        }

        //Thêm khách hàng mới  
        $cusResult = ExecuteNonDataQuery($link, "INSERT INTO customer(customer_fullname, customer_email_address, customer_phone_number,
                                                customer_gender, account_id, customer_date_of_birth, created_on_date) 
                                                VALUES (NULL, NULL, NULL, NULL, $account_id, NULL, '$created_on_date')");

        //Thêm giỏ hàng mới
        $cartResult = ExecuteNonDataQuery($link, "INSERT INTO cart(event_id, cart_service_amount, cart_rental_amount, cart_discount_amount, 
                                                cart_total_payment, cart_total_deposit, account_id) VALUES (NULL, 0, 0, 0, 0, 0, $account_id)");

        if($accResult && $cusResult && $cartResult) {
            return true;
        } else {
            return false;
        }
    }

    function signUpByPhone($link, $customer_phone_number, $account_name, $account_hash_password) {  
        $account_controller = new Account_Controller();
        $created_on_date = date("Y-m-d");

        //Thêm tài khoản mới
        $accResult = ExecuteNonDataQuery($link, "INSERT INTO account(account_type, account_sign_up_name, account_name, account_hash_password, 
                                                created_on_date) VALUES ('Khách hàng', '$customer_phone_number', '$account_name', 
                                                '".md5($account_hash_password)."', '$created_on_date')");

        //Lấy account_id của tài khoản vừa thêm
        $account_id = 0;
        $accounts = $account_controller->view_all_account();
        foreach($accounts as $account) {
        if($account->getAccountSignUpName() == $customer_phone_number) {
            $account_id = $account->getAccountId();
        }
        }

        //Thêm khách hàng mới  
        $cusResult = ExecuteNonDataQuery($link, "INSERT INTO customer(customer_fullname, customer_email_address, customer_phone_number,
                                                customer_gender, account_id, customer_date_of_birth, created_on_date) 
                                                VALUES (NULL, NULL, '$customer_phone_number', NULL, $account_id, NULL, '$created_on_date')");

        //Thêm giỏ hàng mới
        $cartResult = ExecuteNonDataQuery($link, "INSERT INTO cart(event_id, cart_service_amount, cart_rental_amount, cart_discount_amount, 
                                                cart_total_payment, cart_total_deposit, account_id) VALUES (NULL, 0, 0, 0, 0, 0, $account_id)");

        if($accResult && $cusResult && $cartResult) {
            return true;
        } else {
            return false;
        }
    }

    function signUpByEmail($link, $customer_email_address, $account_name, $account_hash_password) {  
        $account_controller = new Account_Controller();
        $created_on_date = date("Y-m-d");

        //Thêm tài khoản mới
        $accResult = ExecuteNonDataQuery($link, "INSERT INTO account(account_type, account_sign_up_name, account_name, 
                                                account_hash_password, created_on_date) VALUES ('Khách hàng', '$customer_email_address', 
                                                '$account_name', '".md5($account_hash_password)."', '$created_on_date')");

        //Lấy account_id của tài khoản vừa thêm
        $account_id = 0;
        $accounts = $account_controller->view_all_account();
        foreach($accounts as $account) {
        if($account->getAccountSignUpName() == $customer_email_address) {
            $account_id = $account->getAccountId();
        }
        }

        //Thêm khách hàng mới  
        $cusResult = ExecuteNonDataQuery($link, "INSERT INTO customer(customer_fullname, customer_email_address, customer_phone_number,
                                                customer_gender, account_id, customer_date_of_birth, created_on_date) 
                                                VALUES (NULL, NULL, '$customer_email_address', NULL, $account_id, NULL, '$created_on_date')");

        //Thêm giỏ hàng mới
        $cartResult = ExecuteNonDataQuery($link, "INSERT INTO cart(event_id, cart_service_amount, cart_rental_amount, cart_discount_amount, 
                                                cart_total_payment, cart_total_deposit, account_id) VALUES (NULL, 0, 0, 0, 0, 0, $account_id)");

        if($accResult && $cusResult && $cartResult) {
            return true;
        } else {
            return false;
        }
    }

    function signIn($link, $sign_in_name, $password) {
        $result = ExecuteNonDataQuery($link, "SELECT COUNT(*) FROM account WHERE account_sign_up_name = '$sign_in_name'
                                                                            AND account_hash_password = '".md5($password)."'");

        $row = mysqli_fetch_row($result);
        mysqli_free_result($result);

        if($row[0] > 0) {
            $_SESSION['username'] = $sign_up_name;
            return true;
        } else {
            return false;
        }
    }

    function signOut() {
        if(isset($_SESSION['username'])) {
            unset($_SESSION['username']);
            return true;
        } else {
            return false;
        }
    }
?>