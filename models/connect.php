<?php
    require_once ($_SERVER['DOCUMENT_ROOT'] . "/NTP-Sports-Hub/models/config.php");

    function MakeConnection(&$link) {
        $link = mysqli_connect(HOST, USER, PASSWORD, DATABASE);

        if (!$link) {
            echo "Error connecting to server: ". mysqli_connect_error();
            exit();
        }

        return $link;
    }

    // Định nghĩa phương thức ExecuteDataQuery để thực hiện truy vấn trả về dữ liệu
    function ExecuteDataQuery($link, $query) {
        $result = mysqli_query($link, $query);
        return $result;
    }

    // Định nghĩa phương thức ExecuteNonDataQuery để thực hiện truy vấn không trả về dữ liệu
    function ExecuteNonDataQuery($link, $query) {
        $result = mysqli_query($link, $query);
        return $result;
    }

    // Định nghĩa phương thức ReleaseMemory để thực hiện giải phóng bộ nhớ
    function ReleaseMemory($link, $result) {
        try {
            mysqli_close($link);
            mysqli_free_result($result);
        } catch (TypeError $error) {
            echo "Error: " . $error->getMessage();
        }
    }
?>