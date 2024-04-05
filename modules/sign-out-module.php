<?php
    session_start();

    require_once ($_SERVER['DOCUMENT_ROOT'] . "/NTP-Sports-Hub/models/connect.php");
    require_once ($_SERVER['DOCUMENT_ROOT'] . "/NTP-Sports-Hub/modules/users-module.php");

    //Tạo kết nối đến database
    $link = "";
    MakeConnection($link);

    // if(isset($_GET['sign_out'])) {
    //     if($_GET['sign_out'] == "yes") {
    //         if(signOut()) {
    //             ReleaseMemory($link, true);
    //             header("Location: /NTP-Sports-Hub/index.php");
    //         } else {
    //             ReleaseMemory($link, true);
    //             header("Location: /NTP-Sports-Hub/index.php?msg=sign_out_fail");
    //         }
    //     }
    // }

    if(signOut()) {
        ReleaseMemory($link, true);
        header("Location: /NTP-Sports-Hub/index.php");
    } else {
        ReleaseMemory($link, true);
        header("Location: /NTP-Sports-Hub/index.php?msg=sign_out_fail");
    }
?>