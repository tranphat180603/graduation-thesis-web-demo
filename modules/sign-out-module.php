<?php
    session_start();

    require_once ($_SERVER['DOCUMENT_ROOT'] . "/LP-Sport-Center/models/connect.php");
    require_once ($_SERVER['DOCUMENT_ROOT'] . "/LP-Sport-Center/modules/users-module.php");

    //Tạo kết nối đến database
    $link = "";
    MakeConnection($link);

    // if(isset($_GET['sign_out'])) {
    //     if($_GET['sign_out'] == "yes") {
    //         if(signOut()) {
    //             ReleaseMemory($link, true);
    //             header("Location: /LP-Sport-Center/index.php");
    //         } else {
    //             ReleaseMemory($link, true);
    //             header("Location: /LP-Sport-Center/index.php?msg=sign_out_fail");
    //         }
    //     }
    // }

    if(signOut()) {
        ReleaseMemory($link, true);
        header("Location: /LP-Sport-Center/index.php");
    } else {
        ReleaseMemory($link, true);
        header("Location: /LP-Sport-Center/index.php?msg=sign_out_fail");
    }
?>