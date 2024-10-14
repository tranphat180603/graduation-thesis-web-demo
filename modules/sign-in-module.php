<?php
    session_start();

    require_once ($_SERVER['DOCUMENT_ROOT'] . "/LP-Sport-Center/models/connect.php");

    require_once ($_SERVER['DOCUMENT_ROOT'] . "/LP-Sport-Center/modules/users-module.php");

    //Tạo kết nối đến database
    $link = "";
    MakeConnection($link);

    if(isset($_POST['sign-in-name-input-text']) && isset($_POST['sign-in-pass-input-text'])) {
        $username = $_POST['sign-in-name-input-text'];
        $password = $_POST['sign-in-pass-input-text'];

        if(signIn($link, $username, $password)) {
            $_SESSION['username'] = $username;
            ReleaseMemory($link, true);
            header("Location: /LP-Sport-Center/index.php");
        } else {
            ReleaseMemory($link, true);
            header("Location: /LP-Sport-Center/views/sign-in.php?msg=sign_in_fail");
        }
    }
?>