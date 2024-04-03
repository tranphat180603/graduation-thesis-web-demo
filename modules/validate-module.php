<?php
    require_once "../models/connect.php";

    //1. Hàm kiểm tra tên đăng ký đã tồn tại trong database hay chưa
    function existSignUpName($link, $sign_up_name) {
        $result = ExecuteDataQuery($link, "SELECT COUNT(*) FROM account WHERE account_sign_up_name = '".$sign_up_name."'");
        $row = mysqli_fetch_row($result);
        mysqli_free_result($result);
        return $row[0] > 0;
    }

    //2. Hàm kiểm tra số điện thoại đã tồn tại trong database hay chưa
    function existPhoneNumber($link, $phone) {
        $result = ExecuteDataQuery($link, "SELECT COUNT(*) FROM customer WHERE customer_phone_number = '".$phone."'");
        $row = mysqli_fetch_row($result);
        mysqli_free_result($result);
        return $row[0] > 0;
    }

    //3. Hàm kiểm tra email đã tồn tại trong database hay chưa
    function existEmail($link, $email) {
        $result = ExecuteDataQuery($link, "SELECT COUNT(*) FROM customer WHERE customer_email_address = '".$email."'");
        $row = mysqli_fetch_row($result);
        mysqli_free_result($result);
        return $row[0] > 0;
    }

?>