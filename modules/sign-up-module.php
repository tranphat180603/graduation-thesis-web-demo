<?php
    require_once "../models/connect.php";
    require_once "./validate-module.php";
    require_once "./users-module.php";

    //Tạo kết nối đến database
    $link = "";
    MakeConnection($link);

    //1. Hàm kiểm tra tồn tại tên đăng ký
    if($_POST['sign-up-name-input-text']) {
        $sign_up_name = $_POST['sign-up-name-input-text'];

        if(existSignUpName($link, $sign_up_name)) {
            ReleaseMemory($link, true);
            header("Location: ../views/sign-up-method-suname.php?sign_up_name=".$sign_up_name."");
        } else {
            ReleaseMemory($link, true);
            header("Location: ../views/sign-up-acc-name.php?sign_up_name=".$sign_up_name."");
        }
    }

    //2. Hàm kiểm tra và thực hiện đăng ký tài khoản bằng tên đăng ký
    if(isset($_POST['sign_up_name']) && isset($_POST['sign_up_acc_name']) && isset($_POST['sign-up-pass-input-text'])) {
        $sign_up_name = $_POST['sign_up_name'];
        $sign_up_acc_name = $_POST['sign_up_acc_name'];
        $sign_up_pass = $_POST['sign-up-pass-input-text'];

        if(signUpBySUName($link, $sign_up_name, $sign_up_acc_name, $sign_up_pass)) {
            ReleaseMemory($link, true);
            header("Location: ../views/sign-in.php");
        } else {
            ReleaseMemory($link, true);
            header("Location: ../views/sign-up-method-suname.php?msg=sign-up-fail");
        }

        // signUpBySUName($link, $sign_up_name, $sign_up_acc_name, $sign_up_pass);
        // ReleaseMemory($link, true);
        // header("Location: ../views/sign-in.php");
    }

    //3. Hàm kiểm tra tồn tại SĐT
    if($_POST['sign-up-phone-input-text']) {
        $sign_up_phone = $_POST['sign-up-phone-input-text'];

        if(existPhoneNumber($link, $sign_up_phone)) {
            ReleaseMemory($link, true);
            header("Location: ../views/sign-up-method-phone.php?sign_up_phone=".$sign_up_phone."");
        } else {
            ReleaseMemory($link, true);
            header("Location: ../views/sign-up-acc-name.php?sign_up_phone=".$sign_up_phone."");
        }
    }

    //4. Hàm kiểm tra và thực hiện đăng ký tài khoản bằng SĐT
    if(isset($_POST['sign_up_phone']) && isset($_POST['sign_up_acc_name']) && isset($_POST['sign-up-pass-input-text'])) {
        $sign_up_phone = $_POST['sign_up_phone'];
        $sign_up_acc_name = $_POST['sign_up_acc_name'];
        $sign_up_pass = $_POST['sign-up-pass-input-text'];

        if(signUpByPhone($link, $sign_up_phone, $sign_up_acc_name, $sign_up_pass)) {
            ReleaseMemory($link, true);
            header("Location: ../views/sign-in.php");
        } else {
            ReleaseMemory($link, true);
            header("Location: ../views/sign-up-method-suname.php?msg=sign-up-fail");
        }

        // signUpByPhone($link, $sign_up_phone, $sign_up_acc_name, $sign_up_pass);
        // ReleaseMemory($link, true);
        // header("Location: ../views/sign-in.php");
    }

    //5. Hàm kiểm tra tồn tại email
    if($_POST['sign-up-email-input-text']) {
        $sign_up_email = $_POST['sign-up-email-input-text'];

        if(existEmail($link, $sign_up_phone)) {
            ReleaseMemory($link, true);
            header("Location: ../views/sign-up-method-email.php?sign_up_email=".$sign_up_email."");
        } else {
            ReleaseMemory($link, true);
            header("Location: ../views/sign-up-acc-name.php?sign_up_email=".$sign_up_email."");
        }
    }

    //6. Hàm kiểm tra và thực hiện đăng ký tài khoản bằng email
    if(isset($_POST['sign_up_email']) && isset($_POST['sign_up_acc_name']) && isset($_POST['sign-up-pass-input-text'])) {
        $sign_up_email = $_POST['sign_up_email'];
        $sign_up_acc_name = $_POST['sign_up_acc_name'];
        $sign_up_pass = $_POST['sign-up-pass-input-text'];

        if(signUpByEmail($link, $sign_up_email, $sign_up_acc_name, $sign_up_pass)) {
            ReleaseMemory($link, true);
            header("Location: ../views/sign-in.php");
        } else {
            ReleaseMemory($link, true);
            header("Location: ../views/sign-up-method-suname.php?msg=sign-up-fail");
        }

        // signUpByEmail($link, $sign_up_email, $sign_up_acc_name, $sign_up_pass);
        // ReleaseMemory($link, true);
        // header("Location: ../views/sign-in.php");
    }
?>