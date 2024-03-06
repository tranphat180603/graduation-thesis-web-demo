<!DOCTYPE html>
<html lang="vi">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Khu liên hợp thể thao Nguyễn Tri Phương</title>
    <link rel="stylesheet" type="text/css" href="./styles/home.css" />
    <script type="text/javascript" src="./scripts/home.js" language="javascript"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
      rel="stylesheet"
    />
    <link
      rel="apple-touch-icon"
      sizes="57x57"
      href="./favicon/apple-icon-57x57.png"
    />
    <link
      rel="apple-touch-icon"
      sizes="60x60"
      href="./favicon/apple-icon-60x60.png"
    />
    <link
      rel="apple-touch-icon"
      sizes="72x72"
      href="./favicon/apple-icon-72x72.png"
    />
    <link
      rel="apple-touch-icon"
      sizes="76x76"
      href="./favicon/apple-icon-76x76.png"
    />
    <link
      rel="apple-touch-icon"
      sizes="114x114"
      href="./favicon/apple-icon-114x114.png"
    />
    <link
      rel="apple-touch-icon"
      sizes="120x120"
      href="./favicon/apple-icon-120x120.png"
    />
    <link
      rel="apple-touch-icon"
      sizes="144x144"
      href="./favicon/apple-icon-144x144.png"
    />
    <link
      rel="apple-touch-icon"
      sizes="152x152"
      href="./favicon/apple-icon-152x152.png"
    />
    <link
      rel="apple-touch-icon"
      sizes="180x180"
      href="./favicon/apple-icon-180x180.png"
    />
    <link
      rel="icon"
      type="image/png"
      sizes="192x192"
      href="./favicon/android-icon-192x192.png"
    />
    <link
      rel="icon"
      type="image/png"
      sizes="32x32"
      href="./favicon/favicon-32x32.png"
    />
    <link
      rel="icon"
      type="image/png"
      sizes="96x96"
      href="./favicon/favicon-96x96.png"
    />
    <link
      rel="icon"
      type="image/png"
      sizes="16x16"
      href="./favicon/favicon-16x16.png"
    />
    <link rel="manifest" href="/manifest.json" />
    <meta name="msapplication-TileColor" content="#ffffff" />
    <meta
      name="msapplication-TileImage"
      content="./favicon/ms-icon-144x144.png"
    />
    <meta name="theme-color" content="#ffffff" />
  </head>
  <body>
    <?php 
      //phần này có tới 3 loại header cho 3 đối tượng lận
      //nên ai làm cái này thì tìm hiểu cách viết code switch 
      //case để láy đường dẫn đến header cho đúng nhen 
      //3 loại này đều có file tên là main-header.php
      //trong folder header của 3 đối tượng á
    ?>
    <!-- code phần body -->
    <?php include "./footer/footer.php"; ?>
    <script>
      function changeFooterImageSrc() {
        var NTPLogo = document.getElementById("NTP-logo-img");
        NTPLogo.src = "./image/footer-img/footer-logo.svg";

        var phone = document.getElementById("phone-img");
        phone.src = "./image/footer-img/call.svg";

        var address = document.getElementById("address-img");
        address.src = "./image/footer-img/location.svg";

        var facebook = document.getElementById("facebook-img");
        facebook.src = "./image/footer-img/facebook.svg";

        var email = document.getElementById("email-img");
        email.src = "./image/footer-img/mail-opened.svg";
      }
      changeFooterImageSrc()
    </script>
  </body>
</html>
