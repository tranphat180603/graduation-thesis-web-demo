<?php
    // Thiết lập header cho ảnh là PNG và không cho phép sử dụng Cache
    function setPNGHeader() {
        header("Content-Type: image/png");
        header("Expires: -1");
        header("Cache-Control: no-store, no-cache, must-revalidate");
        header("Pragma: no-cache");
    }

    // Tạo một xâu captcha ngẫu nhiên từ các kí tự trong bảng chữ cái và số
    function makeCaptcha($source, $len) {
        $c = "";
        for ($i = 0; $i < $len; $i++) {
            $c .= substr($source, rand(0, strlen($source) - 1), 1);
        }
        return $c;
    }

    // Vẽ captcha dưới dạng ảnh PNG
    function makePNGCaptcha($captcha) {
        $img = imagecreate(200, 50);
        imagecolorallocate($img, 0, 0, 0);
        $color = imagecolorallocate($img, 255, 255, 0);
        imagettftext($img, 25, 5, 10, 45, $color, "UVNNguyenDu.TTF", $captcha);
        imagepng($img);
        imagedestroy($img);
    }
?>
