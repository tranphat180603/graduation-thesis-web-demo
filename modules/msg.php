<?php
    if(isset($_GET['msg'])) {
        $msg = $_GET['msg'];
        if($msg == "exist_sign_up_name") {
            echo "";
        } else if($msg == "not_exist_sign_up_name") {
            echo "";
        } else if($msg == "exist_sign_up_phone") {
            echo "";
        } else if($msg == "not_exist_sign_up_phone") {
            echo "";
        } else if($msg == "exist_sign_up_email") {
            echo "";
        } else if($msg == "not_exist_sign_up_email") {
            echo "";
        } else if($msg == "sign_up_successful") {
            echo "
                <script>
                    var overlayFrame = document.getElementById('overlay-wrapper');
                    overlayFrame.style.display = 'block';
                </script>
            "; 

            include $_SERVER['DOCUMENT_ROOT'] . "/NTP-Sports-Hub" . "/views/notification/action-successful.php";

            echo "
                <script>
                    var message = getElementById('action-successful-message');
                    var signUpBtn = getElementById('home-button');
                    var signIpBtn = getElementById('admin-management-button');

                    message.innerHTML = 'Bạn đã đăng ký tài khoản thành công';
                    signUpBtn.innerHTML = 'Trở về Đăng ký';
                    signUpBtn.href = '/NTP-Sports-Hub/views/sign-up-method-suname.php';
                    signInBtn.innerHTML = 'Trở về Đăng nhập';
                    signInBtn.href = '/NTP-Sports-Hub/views/sign-in.php';
                </script>
            ";
        } else if($msg == "sign_up_fail") {
            echo "";
        } else if($msg == "sign_in_fail") {
            echo "";
        } 
    }
?>