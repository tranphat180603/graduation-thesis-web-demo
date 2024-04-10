<?php session_start(); ?>
<!DOCTYPE html>
<html lang="vi">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Khu liên hợp thể thao Nguyễn Tri Phương</title>
    <link rel="stylesheet" type="text/css" href="../styles/list-of-sports-courts.css" />
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
      require_once ($_SERVER['DOCUMENT_ROOT'] . "/NTP-Sports-Hub/controllers/account-controller.php");
      $account_controller = new Account_Controller();
    ?>
    <!-- HEADER -->
    <?php 
      if(!isset($_SESSION['username'])) {
        include $_SERVER['DOCUMENT_ROOT'] . "/NTP-Sports-Hub/header/guest-sub-header.php";
      } else {
        $username = $_SESSION['username'];

        $accounts = $account_controller->view_all_account();

        foreach($accounts as $account) {
          if($account->getAccountSignUpName() == $username) {
            $account_type = $account->getAccountType();
            if($account_type == 'Quản lý') {
              include $_SERVER['DOCUMENT_ROOT'] . "/NTP-Sports-Hub/header/admin-sub-header.php";
            } else if($account_type == 'Khách hàng') {
              include $_SERVER['DOCUMENT_ROOT'] . "/NTP-Sports-Hub/header/customer-sub-header.php";
            }
          }
        }
      }
    ?>
    <!-- BODY -->
    <div class="home-page">
      <section class="categories">
        <div class="court-list">
          <div class="contact-info">
            <?php
            require_once "../controllers/court-controller.php";
            require_once "../controllers/review-controller.php";
            require_once "../controllers/court-type-controller.php";
            require_once "../controllers/court-image-controller.php";
            require_once "../controllers/court-price-controller.php";

            $courtcontroller = new Court_Controller();
            $reviewscontroller = new Review_Controller();
            $courtimagecontroller = new Court_Image_Controller();
            $courtpricecontroller = new Court_Price_Controller();
            $courttypecontroller = new Court_Type_Controller();

            $courts = $courtcontroller->GetcourtByType();
            $courtImages = $courtimagecontroller->getGroupConcatImages();
            $minprice = $courtpricecontroller->getMinPrice();
            $maxprice = $courtpricecontroller->getMaxPrice();
            $courtTypes = $courttypecontroller->view_all_court_type();
            ?>

            <?php foreach ($courts as $court) :
              $averagerating = $reviewscontroller->getAverageRatingByCourtSchedule($court->getCourtId());
              // Lấy giá tối thiểu và tối đa cho court hiện tại
              $courtImagePaths = [];
              foreach ($courtImages as $image) {
                if ($image->getCourtId() === $court->getCourtId()) {
                  $courtImagePaths = explode(',', $image->getCourtImage());
                  break;
                }
              }
              // Lấy ảnh đầu tiên từ mảng đường dẫn ảnh
              $courtImage = isset($courtImagePaths[0]) ? $courtImagePaths[0] : '';
              foreach ($courtTypes as $type) {
                if ($type->getCourtTypeId() === $court->getCourtTypeId()) {
                  $courtTypeImage = $type->getCourtTypeIcon();
                  break;
                }
              }
            ?>
              <a href="sport-court-details.php?id=<?= $court->getCourtId() ?>" class="court-card" data-images="<?= implode(',', $courtImagePaths) ?>">
                <div class="court-image-wrapper">
                  <img class="court-image" loading="lazy" alt="<?= $courtImage ?>" src="<?= $courtImage ?>" />
                </div>
                <div class="court-detail-container">
                  <div class="court-info">
                    <div class="court-name-price">
                      <div class="c-name"><?= $court->getCourtName() ?></div>
                      <!-- In min và max price -->
                      <div class="c-price">
                        <span class="span6">&#8363;</span><?= number_format($minprice[$court->getCourtId()], 0, ',', '.') ?>đ/h - &#8363;<?= number_format($maxprice[$court->getCourtId()], 0, ',', '.') ?>đ/h
                      </div>
                    </div>
                    <button class="rating-court">
                      <div class="value"><?= $averagerating ?></div>
                      <img class="rating-court-img" alt="" src="../image/home-img/vuesaxboldstar.svg" />
                    </button>
                  </div>
                  <img class="court-type" loading="lazy" alt="" src="<?= $courtTypeImage ?>" />
                </div>
              </a>
            <?php endforeach; ?>
          </div>
        </div>

        <div class="load-more-wrapped">
          <button id="load-more-button" style="display: none">
            <b class="load-more">Xem thêm</b>
          </button>
        </div>
      </section>
    </div>
    <!-- FOOTER -->
    <?php include "../footer/footer.php"; ?>
    <script type="text/javascript" src="../scripts/list-of-sports-courts.js" language="javascript"></script>
  </body>
</html>
