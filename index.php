<?php session_start(); ?>
<!DOCTYPE html>
<html lang="vi">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Khu liên hợp thể thao Nguyễn Tri Phương</title>
    <link rel="stylesheet" type="text/css" href="./styles/home.css" />
    <script type="text/javascript" src="./scripts/home.js" language="javascript"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="http://code.jquery.com/jquery-1.7.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet"/>
    <link rel="apple-touch-icon" sizes="57x57" href="./favicon/apple-icon-57x57.png"/>
    <link rel="apple-touch-icon" sizes="60x60" href="./favicon/apple-icon-60x60.png"/>
    <link rel="apple-touch-icon" sizes="72x72" href="./favicon/apple-icon-72x72.png"/>
    <link rel="apple-touch-icon" sizes="76x76" href="./favicon/apple-icon-76x76.png"/>
    <link rel="apple-touch-icon" sizes="114x114" href="./favicon/apple-icon-114x114.png"/>
    <link rel="apple-touch-icon" sizes="120x120" href="./favicon/apple-icon-120x120.png"/>
    <link rel="apple-touch-icon" sizes="144x144" href="./favicon/apple-icon-144x144.png"/>
    <link rel="apple-touch-icon" sizes="152x152" href="./favicon/apple-icon-152x152.png"/>
    <link rel="apple-touch-icon" sizes="180x180" href="./favicon/apple-icon-180x180.png"/>
    <link rel="icon" type="image/png" sizes="192x192" href="./favicon/android-icon-192x192.png"/>
    <link rel="icon" type="image/png" sizes="32x32" href="./favicon/favicon-32x32.png"/>
    <link rel="icon" type="image/png" sizes="96x96" href="./favicon/favicon-96x96.png"/>
    <link rel="icon" type="image/png" sizes="16x16" href="./favicon/favicon-16x16.png"/>
    <link rel="manifest" href="/manifest.json" />
    <meta name="msapplication-TileColor" content="#ffffff" />
    <meta name="msapplication-TileImage" content="./favicon/ms-icon-144x144.png"/>
    <meta name="theme-color" content="#ffffff" />
  </head>
  <body>
    <?php
      require_once ($_SERVER['DOCUMENT_ROOT'] . "/NTP-Sports-Hub/controllers/controller.php");
      $controller = new Controller();

      require_once ($_SERVER['DOCUMENT_ROOT'] . "/NTP-Sports-Hub/controllers/account-controller.php");
      $account_controller = new Account_Controller();
    ?>
    <!-- HEADER -->
    <?php 
      if(!isset($_SESSION['username'])) {
        include $_SERVER['DOCUMENT_ROOT'] . "/NTP-Sports-Hub/header/guest-main-header.php";
      } else {
        $username = $_SESSION['username'];

        $accounts = $account_controller->view_all_account();

        foreach($accounts as $account) {
          if($account->getAccountSignUpName() == $username) {
            $account_type = $account->getAccountType();
            if($account_type == 'Quản lý') {
              include $_SERVER['DOCUMENT_ROOT'] . "/NTP-Sports-Hub/header/admin-main-header.php";
            } else if($account_type == 'Khách hàng') {
              include $_SERVER['DOCUMENT_ROOT'] . "/NTP-Sports-Hub/header/customer-main-header.php";
            }
          }
        }
      }
    ?>
    <!-- BODY -->
    <div class="home-page">
      <section class="categories">
        <?php $events = $controller->getEventData(); ?>
        <div class="econtainer">
          <div class="econtainer1">
            <?php foreach ($events as $index => $event) : ?>
              <div class="event" id="event-<?php echo $index; ?>" style="<?php if ($index != 0) echo 'display: none;'; ?>">
                <div class="banner">
                  <img class="banner-img" alt="<?php echo $event->getEventImage(); ?>" src="<?php echo $event->getEventImage(); ?>" />
                </div>
              </div>
            <?php endforeach; ?>
            <button class="move-right" onclick="changeEvent(1)">
              <img class="move-right-img" loading="lazy" alt="" src="./image/home-img/img.svg" />
            </button>
            <button class="move-left" onclick="changeEvent(-1)">
              <img class="move-left-img" loading="lazy" alt="" src="./image/home-img/img.svg" />
            </button>
          </div>

          <div class="event-list" id="event-list">
            <?php foreach ($events as $index => $event) : ?>
              <div class="item item-<?php echo $index; ?>"></div>
            <?php endforeach; ?>
          </div>
        </div>
        <script>
          var totalEvents = <?php echo count($events); ?>;
        </script>

        <div class="outstanding-court-container">
          <h2 class="top-3">Top 3 sân thể thao nổi bật</h2>
          <div class="range-input">
            <?php
            $courts = $controller->view_all_court();
            $courtTypes = $controller->view_all_court_type();
            $courtImages = $controller->getGroupConcatImages();
            $minPrices = $controller->getMinPrice();
            $maxPrices = $controller->getMaxPrice();
            $courtSchedules = $controller->view_all_court_schedule();
            $topThreeCourts = $controller->getTopThreeCompletedCourts();
            ?>

            <?php foreach ($topThreeCourts as $topCourt) : ?>
              <?php
              foreach ($courts as $court) {
                if ($court->getCourtId() == $topCourt['court_id']) {
                  // Tìm giá thuê tối thiểu và tối đa
                  $minPrice = isset($minPrices[$court->getCourtId()]) ? $minPrices[$court->getCourtId()] : 0;
                  $maxPrice = isset($maxPrices[$court->getCourtId()]) ? $maxPrices[$court->getCourtId()] : 0;

                  // Tìm hình ảnh của sân
                  $courtImagePath = '';
                  foreach ($courtImages as $image) {
                    if ($image->getCourtId() === $court->getCourtId()) {
                      // Phân tách chuỗi đường dẫn ảnh thành mảng
                      $courtImagePaths = explode(',', $image->getCourtImage());
                      // Lấy ảnh đầu tiên từ mảng đường dẫn ảnh
                      $courtImagePath = isset($courtImagePaths[0]) ? $courtImagePaths[0] : '';
                      // Chuyển đổi đường dẫn từ "../" thành "./"
                      $courtImagePath = str_replace('../', './', $courtImagePath);
                      break;
                    }
                  }
                  // Tìm loại sân
                  $courtTypeImage = '';
                  foreach ($courtTypes as $type) {
                    if ($type->getCourtTypeId() === $court->getCourtTypeId()) {
                      $courtTypeImage = $type->getCourtTypeIcon();
                      $courtTypeImage = str_replace('../', './', $courtTypeImage);
                      break;
                    }
                  }
                  // Lấy đánh giá trung bình
                  $averageRating = $controller->getAverageRatingByCourtSchedule($court->getCourtId());

                  // Hiển thị thông tin về sân
              ?>
                  <a href="views/sport-court-details.php?id=<?= $court->getCourtId() ?>" class="outstanding-court-card">
                    <div class="image-stats-container">
                      <img class="outstanding-court-img" alt="" src="<?= $courtImagePath ?>" />
                      <div class="order-quantity">
                        <img class="vector-icon3" alt="" src="./image/home-img/vector-3.svg" />
                        <div class="quantity"><?= $topCourt['total_completed_orders'] ?> lượt đặt sân</div>
                      </div>
                      <div class="top">
                        <img class="vector-icon4" loading="lazy" alt="" src="./image/home-img/vector-4.svg" />
                        <div class="top-icon">TOP</div>
                      </div>
                    </div>
                    <div class="details-container">
                      <div class="outstanding-court-info">
                        <div class="court-info-name-price">
                          <div class="court-name"><?= $court->getCourtName() ?></div>
                          <div class="court-price">
                          <span class="span1">&#8363;</span><?= number_format($minPrice, 0, ',', '.') ?>/h - &#8363;<?= number_format($maxPrice, 0, ',', '.') ?>/h
                          </div>
                        </div>
                        <button class="outstanding-rating">
                          <div class="rating-value"><?= $averageRating ?></div>
                          <img class="rating-icon" alt="" src="./image/home-img/vuesaxboldstar.svg" />
                        </button>
                      </div>
                      <img class="outstanding-court-type" loading="lazy" alt="" src="<?= $courtTypeImage ?>" />

                    </div>
                  </a>
              <?php
                  break;
                }
              }
              ?>
            <?php endforeach; ?>
          </div>
        </div>
        <div class="court-list">
          <div class="header-title">
            <h2 class="title">Đặt lịch sân thể thao</h2>
          </div>
          <?php
          require_once "controllers/controller.php";
          $controller = new Controller();
          ?>
          <div class="contact-info">
            <?php
            $courts = $controller->getCourtByType();
            $courtTypes = $controller->view_all_court_type();
            $courtImages = $controller->getGroupConcatImages();
            $minPrices = $controller->getMinPrice();
            $maxPrices = $controller->getMaxPrice();
            $courtSchedules = $controller->view_all_court_schedule();
            ?>

            <?php foreach ($courts as $court) :
              // Lấy giá tối thiểu và tối đa cho court hiện tại
              $minPrice = isset($minPrices[$court->getCourtId()]) ? $minPrices[$court->getCourtId()] : 0;
              $maxPrice = isset($maxPrices[$court->getCourtId()]) ? $maxPrices[$court->getCourtId()] : 0;
              $courtImagePaths = [];
              foreach ($courtImages as $image) {
                if ($image->getCourtId() === $court->getCourtId()) {
                  // Phân tách chuỗi đường dẫn ảnh thành mảng
                  $courtImagePaths = explode(',', $image->getCourtImage());
                  // Xử lý đường dẫn ảnh (ví dụ: thay đổi đường dẫn tương đối)
                  foreach ($courtImagePaths as &$path) {
                    $path = str_replace('../', './', $path);
                  }
                  break;
                }
              }
              // Lấy ảnh đầu tiên từ mảng đường dẫn ảnh
              $courtImage = isset($courtImagePaths[0]) ? $courtImagePaths[0] : '';
              foreach ($courtTypes as $type) {
                if ($type->getCourtTypeId() === $court->getCourtTypeId()) {
                  $courtTypeImage = $type->getCourtTypeIcon();
                  // Chuyển đổi đường dẫn từ "../" thành "./"
                  $courtTypeImage = str_replace('../', './', $courtTypeImage);
                  break;
                }
              }
              $averageRating = $controller->getAverageRatingByCourtSchedule($court->getCourtId());
            ?>
              <a href="views/sport-court-details.php?id=<?= $court->getCourtId() ?>" class="court-card" data-images="<?= implode(',', $courtImagePaths) ?>">
                <div class="court-image-wrapper">
                  <img class="court-image" loading="lazy" alt="<?= $court->getCourtName() ?>" src="<?= $courtImage ?>" />
                </div>
                <div class="court-detail-container">
                  <div class="court-info">
                    <div class="court-name-price">
                      <div class="c-name"><?= $court->getCourtName() ?></div>
                      <div class="c-price">
                      <span class="span2">&#8363;</span><?= number_format($minPrice, 0, ',', '.') ?>/h - &#8363;<?= number_format($maxPrice, 0, ',', '.') ?>/h
                      </div>
                    </div>
                    <button class="rating-court">
                      <div class="value"><?= $averageRating ?></div>
                      <img class="rating-court-img" alt="" src="./image/home-img/vuesaxboldstar.svg" />
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
    <?php include "./footer/footer.php"; ?>
    <?php include_once $_SERVER['DOCUMENT_ROOT'] . "/NTP-Sports-Hub/modules/msg.php"; ?>
    <script type="text/javascript" src="./scripts/home.js" language="javascript"></script>
  </body>
</html>
