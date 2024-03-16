<!DOCTYPE html>
<html lang="vi">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Khu liên hợp thể thao Nguyễn Tri Phương</title>
    <link rel="stylesheet" type="text/css" href="./styles/home.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet"/>
    <link rel="apple-touch-icon" sizes="57x57" href="../favicon/apple-icon-57x57.png"/>
    <link rel="apple-touch-icon" sizes="60x60" href="../favicon/apple-icon-60x60.png"/>
    <link rel="apple-touch-icon" sizes="72x72" href="../favicon/apple-icon-72x72.png"/>
    <link rel="apple-touch-icon" sizes="76x76" href="../favicon/apple-icon-76x76.png"/>
    <link rel="apple-touch-icon" sizes="114x114" href="../favicon/apple-icon-114x114.png"/>
    <link rel="apple-touch-icon" sizes="120x120" href="../favicon/apple-icon-120x120.png"/>
    <link rel="apple-touch-icon" sizes="144x144" href="../favicon/apple-icon-144x144.png"/>
    <link rel="apple-touch-icon" sizes="152x152" href="../favicon/apple-icon-152x152.png"/>
    <link rel="apple-touch-icon" sizes="180x180" href="../favicon/apple-icon-180x180.png"/>
    <link rel="icon" type="image/png" sizes="192x192" href="../favicon/android-icon-192x192.png"/>
    <link rel="icon" type="image/png" sizes="32x32" href="../favicon/favicon-32x32.png"/>
    <link rel="icon" type="image/png" sizes="96x96" href="../favicon/favicon-96x96.png"/>
    <link rel="icon" type="image/png" sizes="16x16" href="../favicon/favicon-16x16.png"/>
    <link rel="manifest" href="/manifest.json" />
    <meta name="msapplication-TileColor" content="#ffffff" />
    <meta name="msapplication-TileImage" content="../favicon/ms-icon-144x144.png"/>
    <meta name="theme-color" content="#ffffff" />
  </head>
  <body>
    <?php
      require_once "./controllers/controller.php";
    ?>
    <!-- HEADER -->
    <?php 
      $controller = new Controller();
      $controller->laugh();
      //Ở trên là hàm ví dụ đơn giản t viết chơi thui, lúc code thì m code cái hàm controller để nó dẫn tới header 
      //cho đúng đối tượng nha, khi đăng nhập sẽ có 1 biến $_POST['sign_in_name'] và 1 biến $_POST['password'] gửi
      //lên từ form trong GD ĐN, m sẽ tạo 1 hàm kiểm tra coi có tồn tại acc trong DB trong account-model, ở controller
      //của account-controller nếu đúng thì thêm vào url tham số $_GET['account_id'] và $_GET['account_type']. 
      //Sau đó dẫn tới giao diện trang chủ. Rồi các bước tiếp theo thì m cứ code MVC để láy đc ava vs tên KH đổ lên header,
      //đồng thời phân loại account cho đúng để lấy header cho đúng 
    ?>
    <!-- BODY -->
    <!-- FOOTER -->
    <?php include "./footer/footer.php"; ?>
    <script type="text/javascript" src="./scripts/home.js" language="javascript"></script>
  </body>
</html>
