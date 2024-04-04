<?php
    if(isset($_GET['msg'])) {
        $msg = $_GET['msg'];
        if($msg == "exist_sign_up_name") { //Không hoạt động
            echo "
                <script>
                    var checkImg = document.getElementById('check'),
                        sign_up_name_input = document.querySelector('.sign-up-name-input'),
                        warningDiv = document.querySelector('.warning'),
                        next_button = document.getElementById('next-button'),

                    sign_up_name_input.style.border = '1px solid #FF4141';
                    checkImg.style.display = 'block'; 
                    warningDiv.style.visibility = 'hidden';
                    next_button.style.pointerEvents = 'auto';
                    next_button.style.backgroundColor = '#285d8f'; 
                </script>
            ";
        } else if($msg == "exist_sign_up_phone") { //Không hoạt động
            echo "
                <script>
                    var checkImg = document.getElementById('check-phone'),
                        sign_up_phone_input = document.querySelector('.sign-up-phone-input'),
                        warningDiv = document.querySelector('.warning-phone'),
                        next_button = document.getElementById('phone-next-button'),

                    sign_up_phone_input.style.border = '1px solid #FF4141';
                    checkImg.style.display = 'block'; 
                    warningDiv.style.visibility = 'hidden';
                    next_button.style.pointerEvents = 'auto';
                    next_button.style.backgroundColor = '#285d8f'; 
                </script>
            ";
        } else if($msg == "exist_sign_up_email") { //Không hoạt động
            echo "
                <script>
                    var checkImg = document.getElementById('check-email'),
                        sign_up_phone_input = document.querySelector('.sign-up-email-input'),
                        warningDiv = document.querySelector('.warning-email'),
                        next_button = document.getElementById('email-next-button'),

                    sign_up_email_input.style.border = '1px solid #FF4141';
                    checkImg.style.display = 'block'; 
                    warningDiv.style.visibility = 'hidden';
                    next_button.style.pointerEvents = 'auto';
                    next_button.style.backgroundColor = '#285d8f'; 
                </script>
            ";
        } else if($msg == "sign_up_successful") {
            echo "
                <script>
                    var overlayFrame = document.getElementById('overlay-wrapper');
                    overlayFrame.style.display = 'block';
                </script>
            "; 

            include $_SERVER['DOCUMENT_ROOT'] . "/NTP-Sports-Hub/views/notification/action-successful.php";

            echo "
                <script>
                    var message = document.getElementById('action-successful-message');
                    var signUpBtn = document.getElementById('home-button');
                    var signIpBtn = document.getElementById('admin-management-button');

                    message.textContent = 'Bạn đã đăng ký tài khoản thành công';
                    signUpBtn.textContent = 'Trở về Đăng ký';
                    signUpBtn.href = './sign-up-method-suname.php';
                    signIpBtn.textContent = 'Tới Đăng nhập';
                    signIpBtn.href = './sign-in.php';
                </script>
            ";
        } else if($msg == "sign_up_fail") {
            echo "
                <script>
                    var announcement = document.getElementById('announcement');
                    announcement.style.display = 'flex';
                </script>
            ";
        } else if($msg == "sign_in_fail") {
            echo "
                <script>
                    var announcement = document.getElementById('announcement');
                    announcement.style.display = 'flex';
                </script>
            ";
        } else if($msg == "sign_out_fail") {
            header("Content-type: text/html; charset=utf8");
            echo "Không thể đăng xuất";
        } 
    }
?>