<?php
    session_start();

    require_once ($_SERVER['DOCUMENT_ROOT'] . "/NTP-Sports-Hub/models/connect.php");

    require_once ($_SERVER['DOCUMENT_ROOT'] . "/NTP-Sports-Hub/modules/users-module.php");

    //Tạo kết nối đến database
    $link = "";
    MakeConnection($link);

    if(isset($_POST['sign-in-name-input-text']) && isset($_POST['sign-in-pass-input-text'])) {
        $username = $_POST['sign-in-name-input-text'];
        $password = $_POST['sign-in-pass-input-text'];

        if(signIn($link, $username, $password)) {
            $_SESSION['username'] = $username;
            ReleaseMemory($link, true);
            header("Location: /NTP-Sports-Hub/index.php");
        } else {
            ReleaseMemory($link, true);
            header("Location: /NTP-Sports-Hub/views/sign-in.php?msg=sign_in_fail");
        }
    }
?>