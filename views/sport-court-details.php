<?php session_start(); 
ini_set('display_errors', 0);
  ini_set('display_startup_errors', 0);
?>
<!DOCTYPE html>
<html lang="vi">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Khu liên hợp thể thao Nguyễn Tri Phương</title>
  <link rel="stylesheet" type="text/css" href="../styles/sport-court-details.css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="sport-court-details.js"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet" />
  <link rel="apple-touch-icon" sizes="57x57" href="../favicon/apple-icon-57x57.png" />
  <link rel="apple-touch-icon" sizes="60x60" href="../favicon/apple-icon-60x60.png" />
  <link rel="apple-touch-icon" sizes="72x72" href="../favicon/apple-icon-72x72.png" />
  <link rel="apple-touch-icon" sizes="76x76" href="../favicon/apple-icon-76x76.png" />
  <link rel="apple-touch-icon" sizes="114x114" href="../favicon/apple-icon-114x114.png" />
  <link rel="apple-touch-icon" sizes="120x120" href="../favicon/apple-icon-120x120.png" />
  <link rel="apple-touch-icon" sizes="144x144" href="../favicon/apple-icon-144x144.png" />
  <link rel="apple-touch-icon" sizes="152x152" href="../favicon/apple-icon-152x152.png" />
  <link rel="apple-touch-icon" sizes="180x180" href="../favicon/apple-icon-180x180.png" />
  <link rel="icon" type="image/png" sizes="192x192" href="../favicon/android-icon-192x192.png" />
  <link rel="icon" type="image/png" sizes="32x32" href="../favicon/favicon-32x32.png" />
  <link rel="icon" type="image/png" sizes="96x96" href="../favicon/favicon-96x96.png" />
  <link rel="icon" type="image/png" sizes="16x16" href="../favicon/favicon-16x16.png" />
  <link rel="manifest" href="/manifest.json" />
  <meta name="msapplication-TileColor" content="#ffffff" />
  <meta name="msapplication-TileImage" content="../favicon/ms-icon-144x144.png" />
  <meta name="theme-color" content="#ffffff" />
</head>

<body>
  <?php
  require_once($_SERVER['DOCUMENT_ROOT'] . "/NTP-Sports-Hub/controllers/controller.php");
  $controller = new Controller();

  require_once($_SERVER['DOCUMENT_ROOT'] . "/NTP-Sports-Hub/controllers/account-controller.php");
  $account_controller = new Account_Controller();
  ?> <?php
      $account_id = null;

      if (!isset($_SESSION['username'])) {
        include $_SERVER['DOCUMENT_ROOT'] . "/NTP-Sports-Hub/header/guest-sub-header.php";
      } else {
        $username = $_SESSION['username'];

        $accounts = $account_controller->view_all_account();

        foreach ($accounts as $account) {
          if ($account->getAccountSignUpName() == $username) {
            $customer_avatar_link = $account->getAccountAvatar();
            $account_type = $account->getAccountType();
            $_SESSION['account_id'] = $account->getAccountId();

            if ($account_type == 'Quản lý') {
              include $_SERVER['DOCUMENT_ROOT'] . "/NTP-Sports-Hub/header/admin-sub-header.php";
            } else if ($account_type == 'Khách hàng') {
              include $_SERVER['DOCUMENT_ROOT'] . "/NTP-Sports-Hub/header/customer-sub-header.php";
            }
          }
        }
      }
      ?>
  <!-- BODY -->
  <div class="xem-chi-tit-sn-th-thao-kh">

    <main class="court-detail-main">
      <section class="court-detail">

        <div class="court-info-container">
          <?php
          require_once "../controllers/court-controller.php";
          require_once "../controllers/review-controller.php";
          require_once "../controllers/court-order-controller.php";
          require_once "../controllers/court-image-controller.php";
          require_once "../controllers/court-price-controller.php";
          require_once "../controllers/court-schedule-controller.php";
          require_once "../controllers/service-controller.php";
          require_once "../controllers/comment-controller.php";
          require_once "../controllers/respond-controller.php";
          require_once "../controllers/account-controller.php";

          $accountcontroller = new Account_Controller();
          $courtcontroller = new Court_Controller();
          $reviewscontroller = new Review_Controller();
          $courtordercontroller = new Court_Order_Controller();
          $courtimagecontroller = new Court_Image_Controller();
          $courtpricecontroller = new Court_Price_Controller();
          $courtschedulecontroller = new Court_Schedule_Controller();
          $servicecontroller = new Service_Controller();
          $respondController = new Respond_Controller;
          $commentController = new Comment_Controller();

          $date = isset($_POST['selected_date']) ? $_POST['selected_date'] : null;
          $time_frame = isset($_POST['selected_time']) ? $_POST['selected_time'] : null;

          $court = $courtcontroller->view_court_by_id();
          $averagerating = $reviewscontroller->getAverageRatingByCourtSchedule($court->getCourtId());
          $countreview = $reviewscontroller->getReviewCountByCourtId($court->getCourtId());
          $totalorder = $courtordercontroller->getTotalCompletedOrdersByScheduleId();
          $courtImages = $courtimagecontroller->getGroupConcatImages();
          $minprice = $courtpricecontroller->getMinPrice();
          $maxprice = $courtpricecontroller->getMaxPrice();
          $time_frames = $courtschedulecontroller->getByCourtIdAndDate($court->getCourtId(), $date);
          $services =  $servicecontroller->getAllServices();

          ?>



          <div class="court-statistics-wrapped">
            <h3 class="court-name"><?php echo $court->getCourtName(); ?></h3>
            <div class="court-statistics">
              <div class="rating-statistics">
                <div class="rating-statistics-value"><?php echo $averagerating; ?></div>
                <img class="rating-statistics-icon" loading="lazy" alt="" src="../image/sport-court-details-img/group-4.svg">
              </div>
              <div class="s-line"></div>
              <div class="court_review">
                <div class="court_review_total"><?php echo $countreview; ?></div>
                <div class="court_review_label">Đánh Giá</div>
              </div>
              <div class="s-line"></div>
              <div class="court_order">
                <div class="court_order_total">
                  <?php
                  foreach ($totalorder as $order) {
                    if ($order['court_id'] == $court->getCourtId()) {
                      echo $order['total_completed_orders'];
                      break;
                    }
                  }
                  ?>
                </div>
                <div class="court_order_label">Đã Đặt</div>
              </div>
            </div>
          </div>
          <div class="thng-tin-sn">
            <?php $totalImages = 3 ?>
            <div id="image-data" data-total-images="<?php echo $totalImages; ?>" style="display: NONE;"></div>
            <?php foreach ($courtImages as $courtImage) : ?>
              <?php if ($courtImage->getCourtId() == $court->getCourtId()) : ?>
                <?php
                // Tách chuỗi ảnh thành mảng các đường dẫn ảnh
                $imagePaths = explode(',', $courtImage->getCourtImage());
                ?>
                <div class="court_image_wrapped">
                  <div class="image-slide">
                    <img class="court-img-main" alt="" src="<?php echo $imagePaths[0]; ?>">
                    <div class="dichuyenphai" onclick="nextImage()">
                      <img class="img-icon" alt="" src="../image/sport-court-details-img/img.svg">
                    </div>
                    <div class="dichuyentrai" onclick="prevImage()">
                      <img class="img-icon" alt="" src="../image/sport-court-details-img/img.svg">
                    </div>
                  </div>
                  <div class="image-list">
                    <?php foreach ($imagePaths as $index => $imagePath) : ?>
                      <img class="court-img <?php echo ($index === 0) ? 'selected-image' : ''; ?>" loading="lazy" alt="" src="<?php echo $imagePath; ?>" onclick="selectImage(<?php echo $index; ?>)">
                    <?php endforeach; ?>
                  </div>
                </div>
              <?php endif; ?>
            <?php endforeach; ?>


            <form id="bookingForm" action="" method="post">
              <div class="price-frame-wrapper">
                <?php if ($time_frame) : ?>
                  <!-- Hiển thị giá cụ thể nếu đã chọn ngày và giờ -->
                  <?php foreach ($time_frames as $time_frame_option) : ?>
                    <?php if ($time_frame_option['court_schedule_time_frame'] === $time_frame) : ?>
                      <span class="min-price"><?= number_format($time_frame_option['court_price'], 0, '.', ',') ?>/h </span>
                    <?php endif; ?>
                  <?php endforeach; ?>
                <?php else : ?> <!-- Thêm thuộc tính data-min-price và data-max-price -->
                  <span class="min-price" data-min-price="<?= $minprice[$court->getCourtId()] ?>"><?= $minprice[$court->getCourtId()] ?></span>
                  <span class="max-price" data-max-price="<?= $maxprice[$court->getCourtId()] ?>"><?= $maxprice[$court->getCourtId()] ?></span>
                <?php endif; ?>
              </div>
              <div class="time-date-select-wrapper">
                <div class="select-date-wrapper">
                  <div class="select-date-title">
                    <span>Chọn ngày</span> <span class="span3">*</span>
                  </div>
                  <div class="input-wrapper">
                    <input type="date" class="calendar-input" id="selected_date" name="selected_date" onchange="this.form.submit()" value="<?= $date ?>">
                  </div>
                </div>

                <div class="select-time-wrapper">
                  <div class="select-time-title">
                    <span>Chọn khung giờ</span>
                    <span class="span5">*</span>
                  </div>
                  <div class="time-slot-wrapper">
                    <img class="time-icon" alt="" src="../image/sport-court-details-img/clockhour5.svg">
                    <!-- Đoạn mã HTML -->
                    <select id="time-dropdown" class="time-dropdown" name="selected_time" onchange="updateCourtScheduleID()">
                      <!-- Loop through time frames -->
                      <?php foreach ($time_frames as $time_frame_option) : ?>
                        <option value="<?= $time_frame_option['court_schedule_time_frame']; ?>" <?= $time_frame === $time_frame_option['court_schedule_time_frame'] ? 'selected' : '' ?>>
                          <?= $time_frame_option['court_schedule_time_frame']; ?>
                        </option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
              <script>
                var timeFrames = <?= json_encode($time_frames) ?>;
              </script>

              <div class="frame-parent5">
                <div class="select-service-wrapper">
                  <div class="select-service-title">Chọn dịch vụ</div>
                  <div class="service">
                    <div class="service-info">
                      <img class="service-icon" alt="" src="../image/sport-court-details-img/radioactive.svg">
                      <select class="service-dropdown">
                        <option value="0">Chọn dịch vụ</option>
                        <?php
                        foreach ($services as $service) :
                          if ($service->getCourtTypeId() == $court->getCourtTypeId()) :
                        ?>
                            <option value="<?= $service->getServiceName(); ?>" data-id="<?= $service->getServiceID(); ?>" data-price="<?= $service->getServicePrice(); ?>"><?= $service->getServiceName(); ?></option>
                        <?php
                          endif;
                        endforeach;
                        ?>
                      </select>
                    </div>

                    <div class="service-price">
                      <img class="service-price-icon" alt="" src="../image/sport-court-details-img/reportmoney.svg">
                      <div class="service-price-title">Tiền dịch vụ:</div>
                      <div class="display-price" id="service-price-display">Giá</div>
                    </div>
                    <div class="service-quantity-box">
                      <div class="service-quantity-title">Số lượng:</div>
                      <input type="number" class="service-quantity" value="1" min="1">
                    </div>
                  </div>
                </div>
                <button type="button" class="add-service-btn">
                  <img class="add-service-icon" alt="" src="../image/sport-court-details-img/edit--add-plus-circle.svg">
                  <div class="add-service-text">Thêm dịch vụ</div>
                </button>
                <div class="selected-services-container">
                  <div class="selected-services-title">Các dịch vụ đã chọn</div>
                  <div class="selected-services">
                  </div>
                </div>


                <div class="button-container">
                  <?php if (!isset($_SESSION['username'])) : ?>
                    <a href="../views/sign-in.php">
                      <div class="button1">
                        <img class="interface-shopping-cart-011" alt="" src="../image/sport-court-details-img/interface--shopping-cart-01-1.svg">
                        <div class="thm-vo-gi">Thêm Vào Giỏ Hàng</div>
                      </div>
                    </a>

                    <a href="../views/sign-in.php">
                      <button type="button" class="button2">
                        <div class="t-ngay">Đặt Ngay</div>
                      </button>
                    </a>
                  <?php else : ?>
                    <?php foreach ($accounts as $account) : ?>
                      <?php if ($account->getAccountSignUpName() == $username) : ?>
                        <?php
                        $customer_avatar_link = $account->getAccountAvatar();
                        $account_type = $account->getAccountType();
                        $_SESSION['account_id'] = $account->getAccountId();

                        if ($account_type == 'Quản lý') : ?>
                          <!-- Quản lý sẽ không hiển thị button -->
                        <?php else : ?>
                          <div class="button1">
                            <img class="interface-shopping-cart-011" alt="" src="../image/sport-court-details-img/interface--shopping-cart-01-1.svg">
                            <div class="thm-vo-gi">Thêm Vào Giỏ Hàng</div>
                          </div>

                          <button type="button" class="button2" onclick="submitHiddenForm(event)">
                            <div class="t-ngay">Đặt Ngay</div>
                          </button>
                        <?php endif; ?>
                      <?php endif; ?>
                    <?php endforeach; ?>
                  <?php endif; ?>
                </div>

              </div>
            </form>

          </div>
        </div>
        <div class="chi-tit-sn-inner">
          <div class="frame-child2"></div>
        </div>
        <form id="hiddenForm" method="post" action="book-sports-courts.php">
          <input type="hidden" id="court_schedule_id" name="court_schedule_id">
          <input type="hidden" id="total_rental_amount" name="total_rental_amount">
          <input type="hidden" id="selected-services-input" name="selected_services">
          <input type="hidden" id="total_service_amount" name="total_service_amount" readonly>
          <input type="hidden" id="court_id" name="court_id" value=" <?php echo $court->getCourtId() ?>">
          <input type="hidden" id="court_name" name="court_name" value=" <?php echo $court->getCourtName() ?>">
          <input type="hidden" id="court_type" name="court_type" value=" <?php echo $court->getCourtTypeId() ?>">
          <input type="hidden" id="court_schedule_time_frame" name="court_schedule_time_frame">
          <input type="hidden" id="court-schedule-date" name="court-schedule-date">

        </form>
        <script>
          // Hàm để cập nhật Court Schedule ID khi giá trị của dropdown thay đổi
          function updateCourtScheduleID() {
            var selectedTimeFrame = document.getElementById("time-dropdown").value;
            var courtScheduleID = null;
            var courtDate = null;
            var courtPrice = 0; // Giá sân ban đầu là 0
            <?php
            $time_frames = $courtschedulecontroller->getByCourtIdAndDate($court->getCourtId(), $date);

            foreach ($time_frames as $time_frame_option) : ?>
              if ("<?= $time_frame_option['court_schedule_time_frame']; ?>" === selectedTimeFrame) {
                courtScheduleID = <?= $time_frame_option['court_schedule_id']; ?>;
                courtPrice = <?= $time_frame_option['court_price']; ?>;
              }
            <?php endforeach; ?>

            <?php foreach ($time_frames as $time_frame_option) : ?>
              if (<?= $time_frame_option['court_schedule_id']; ?> === courtScheduleID) {
                courtDate = "<?= $time_frame_option['court_schedule_date']; ?>";
              }
            <?php endforeach; ?>

            // Hiển thị Court Schedule ID và giá trong các input tương ứng
            document.getElementById("court_schedule_id").value = courtScheduleID;
            document.getElementById("total_rental_amount").value = courtPrice;
            document.getElementById("court_schedule_time_frame").value = selectedTimeFrame;
            document.getElementById("court-schedule-date").value = courtDate;

          }

          function submitHiddenForm() {
            document.getElementById("hiddenForm").submit();
          }

          function submitHiddenForm(event) {
            // Kiểm tra xem người dùng đã chọn ngày và giờ chưa
            var selectedDate = document.getElementById("selected_date").value;
            var selectedTimeFrame = document.getElementById("time-dropdown").value;

            if (!selectedDate || !selectedTimeFrame) {
              alert("Vui lòng chọn ngày và giờ trước khi đặt.");
              return; // Ngăn chặn gửi form nếu người dùng chưa chọn ngày hoặc giờ
            }
            // Gửi form nếu đã chọn đầy đủ ngày và giờ
            document.getElementById("hiddenForm").submit();
          }
        </script>


        <div class="assignment-operator">
          <div class="rating">
            <?php $reviews = $reviewscontroller->getCourtRating($court->getCourtId()); ?>
            <?php foreach ($reviews as $review) : ?>
              <h3 class="rating-name-court">Đánh giá <?php echo $court->getCourtName() ?></h3>
              <div class="frame-parent9">
                <div class="total-rating-wrapper">
                  <b class="total-rating-value"><?php echo $review['review_star_rate']; ?></b>
                  <div class="total-rating-icon-wrapper">
                    <?php for ($i = 1; $i <= floor($review['review_star_rate']); $i++) : ?>
                      <img class="vuesaxboldstar-icon" loading="lazy" alt="" src="../image/sport-court-details-img/vuesaxboldstar.svg">
                    <?php endfor;
                    if ($review['review_star_rate'] - floor($review['review_star_rate']) >= 0.5) : ?>
                      <img class="vuesaxboldstar-icon" loading="lazy" alt="" src="../image/sport-court-details-img/vuesaxboldstar-half.svg">
                      <?php $i++; ?>
                    <?php endif;
                    for (; $i <= 5; $i++) : ?>
                      <img class="vuesaxboldstar-icon" loading="lazy" alt="" src="../image/sport-court-details-img/vuesaxboldstar-gray.svg">
                    <?php endfor; ?>
                  </div>
                  <div class="total-rating"><?php echo $review['total_reviews']; ?> lượt đánh giá</div>
                </div>
              <?php endforeach; ?>


              <div class="chi-tit-im-nh-gi">
                <?php
                $total_reviews = 0;
                if (!empty($reviews)) {
                  $total_reviews = $reviews[0]['total_reviews'];
                }
                ?>

                <?php foreach ($reviews as $review) : ?>
                  <?php
                  $ratings = [$review['rating_5'], $review['rating_4'], $review['rating_3'], $review['rating_2'], $review['rating_1']];
                  ?>
                  <?php for ($i = 5; $i >= 1; $i--) : ?>
                    <div class="rating-detail rating-detail-<?php echo $i; ?>">
                      <div class="rating-detail-title rating-detail-title-<?php echo $i; ?>">
                        <div class="rating-detail-value rating-detail-value-<?php echo $i; ?>"><?php echo $i; ?></div>
                        <img class="rating-detail-icon" alt="" src="../image/sport-court-details-img/vuesaxboldstar.svg">
                      </div>
                      <div class="rating-detail-progress">
                        <div class="bar-bg">
                          <?php $percentage = ($total_reviews > 0) ? ($ratings[5 - $i] / $total_reviews) * 100 : 0; ?>
                          <div class="bar-fg" style="width: <?php echo $percentage; ?>%;"></div>
                        </div>
                      </div>
                      <div class="rating-detail-count"><?php echo $ratings[5 - $i]; ?> lượt đánh giá</div>
                    </div>
                  <?php endfor; ?>
                <?php endforeach; ?>
              </div>
              </div>

              <div class="chi-tit-sn-child">
                <div class="button-parent">
                  <?php
                  $reviews = $reviewscontroller->getReviewData($court->getCourtId());
                  $accounts = $accountcontroller->view_all_account();
                  ?>
                  <?php $count = 0; ?>
                  <!-- Bắt đầu vòng lặp để hiển thị thông tin đánh giá -->
                  <?php foreach ($reviews as $review) { ?>
                    <div class="detail-review-wrapper" <?php if ($count++ >= 3) echo 'style="display: none;"'; ?>>
                      <!-- Avatar của người đánh giá -->
                      <?php foreach ($accounts as $account) {
                        if ($account->getAccountId() == $review->getAccountId()) : ?>
                          <?php
                          // Lấy đường dẫn avatar từ cơ sở dữ liệu
                          $avatar_path = $account->getAccountAvatar();
                          // Thay thế phần đầu của đường dẫn
                          $new_avatar_path = str_replace('/upload/', '../upload/', $avatar_path);
                          ?>
                          <img class="review-account-avatar" loading="lazy" alt="" src="<?php echo $new_avatar_path; ?>">

                          <div class="detail-review-container">
                            <!-- Tên người đánh giá -->
                            <div class="review-account-name"><?php echo $account->getAccountName(); ?></div>
                        <?php endif;
                      } ?>
                        <!-- Ngày tạo đánh giá -->
                        <div class="review-created-date"><?php echo date('d/m/Y', strtotime($review->getCreatedOnDate())); ?></div>
                        <!-- Nội dung đánh giá -->
                        <div class="review-content"><?php echo $review->getReviewContent(); ?></div>
                        <!-- Xếp hạng sao -->
                        <div class="review-star-rate">
                          <?php
                          // Số sao được đánh giá
                          $star_rate = $review->getReviewStarRate();

                          // Hiển thị số sao vàng
                          for ($i = 1; $i <= 5; $i++) :
                            if ($i <= $star_rate) :
                          ?>
                              <img class="vuesaxboldstar-icon" loading="lazy" alt="" src="../image/sport-court-details-img/vuesaxboldstar.svg">
                            <?php else : ?>
                              <img class="vuesaxboldstar-icon" loading="lazy" alt="" src="../image/sport-court-details-img/vuesaxboldstar-gray.svg">
                          <?php
                            endif;
                          endfor;
                          ?>
                        </div>
                          </div>
                    </div>
                  <?php } ?>



                  <div class="review-load-more-wrapper">
                    <button class="load-more-reviews-btn">Xem thêm đánh giá</button>
                  </div>
                </div>
              </div>

          </div>

          <div class="chi-tit-sn-inner1">
            <div class="frame-child11"></div>
          </div>

          <div class="bnh-lun">
            <div class="chi-tit-sn-inner5">
              <?php $countcmt = $commentController->countCommentsByCourtId($court->getCourtId()); ?>
              <h3 class="bnh-lun-sn"> Bình luận <?php echo $court->getCourtName(); ?></h3>
              <div class="c-4-lt">Có <?php echo $countcmt ?> lượt bình luận</div>
            </div>
            <?php if (isset($_SESSION['username'])) : ?>
              <div class="comment-section-wrapper">
                <img class="user-avatar" loading="lazy" alt="" src="<?php echo "/NTP-Sports-Hub" . $customer_avatar_link; ?>">
                <div class="comment-form">
                  <form action="" method="POST" class="comment-form-container" id="comment-form-container">
                    <!-- Trường ẩn để lưu court_id -->
                    <input type="hidden" name="court_id" value="<?php echo $court->getCourtId(); ?>">
                    <!-- Trường ẩn để lưu account_id -->
                    <input type="hidden" name="account_id" value="<?php echo $_SESSION['account_id']; ?>">
                    <textarea name="comment_content" class="comment-input" id="comment" rows="1" placeholder="Nhập bình luận của bạn" oninput="this.style.height = '';this.style.height = this.scrollHeight + 'px'"></textarea>
                    <!-- Nút gửi bình luận -->
                    <button type="submit" class="comment-submit-btn">
                      <img class="vuesaxboldsend-2-icon" alt="" src="../image/sport-court-details-img/send-2.svg">
                    </button>
                  </form>

                </div>
              </div>
              <?php endif; ?>

              <div class="error-handler">
                <?php $accounts = $accountcontroller->view_all_account(); ?>
                <?php
                function displayResponses($responses, $respondController, $accounts, $level)
                {
                  if (empty($responses)) {
                    return;
                  }
                ?>
                  <div class="response-container hidden" data-level="<?php echo $level; ?>">
                    <?php foreach ($responses as $response) : ?>
                      <?php foreach ($accounts as $account) {
                        if ($response->getAccountId() === $account->getAccountId()) {
                          // Lấy đường dẫn avatar từ cơ sở dữ liệu
                          $avatar_path = $account->getAccountAvatar();
                          // Thay thế phần đầu của đường dẫn
                          $new_avatar_path = str_replace('/upload/', '../upload/', $avatar_path);

                      ?>
                          <div class="response-details1 hidden" data-level="<?php echo $level; ?>">
                            <div class="response-details">
                              <div class="response-details-wrapper">
                                <img class="image-15-icon4" loading="lazy" alt="" src="<?php echo  $new_avatar_path ?>">
                                <div class="response-heading">
                                  <div class="response-sender"><?php echo $account->getAccountName(); ?></div>
                              <?php }
                          } ?>
                              <div class="response-date"><?php echo date('d/m/Y', strtotime($response->getCreatedOnDate())); ?></div>
                              <div class="response-text"><?php echo $response->getRespondContent(); ?></div>
                                </div>
                              </div>
                              <!-- Thêm phần tử HTML cho phản hồi -->
                              <?php if (isset($_SESSION['username'])) : ?>

                              <div class="reply-section">
                                <button class="reply-respond-button">Phản hồi</button>
                                <div class="respond-form hidden">
                                  <form action="" method="POST" class="respond-form-container" id="respond-form-container">
                                    <input type="hidden" name="respond_respond_id" value="<?php echo $response->getRespondId(); ?>">
                                    <input type="hidden" name="account_id" value="<?php echo  $_SESSION['account_id'] ?>">

                                    <textarea name="respond_content" class="respond-input" id="respond" rows="1" placeholder="Nhập phản hồi của bạn"></textarea>
                                    <button type="submit" class="respond-submit-btn">
                                      <img class="vuesaxboldsend-2-icon" alt="" src="../image/sport-court-details-img/send-2.svg">
                                    </button>
                                  </form>
                                </div>
                              </div>
                              <?php endif; ?>

                              <?php
                              // Lấy danh sách các phản hồi của phản hồi hiện tại
                              $subResponses = $respondController->getResponsesByRespondId($response->getRespondId());
                              // Kiểm tra xem phản hồi có phản hồi con hay không
                              $hasSubResponses = !empty($subResponses);
                              if ($hasSubResponses) : ?>
                                <button class="loadmore-respond-respond" data-level="<?php echo $level; ?>">
                                  <img src="../image/sport-court-details-img/arrow-forward.svg" alt="arrow-forward">
                                  <span>Xem tất cả <?php echo count($subResponses); ?> phản hồi</span>
                                </button>
                              <?php endif; ?>
                            </div>
                            <?php
                            // Nếu có phản hồi con thì hiển thị
                            if ($hasSubResponses) {
                              displayResponses($subResponses, $respondController, $accounts, $level + 1);
                            }
                            ?>
                          </div>

                        <?php endforeach; ?>
                  </div>
                <?php } ?>
                <?php
                $comments = $commentController->getCommentsByCourtId($court->getCourtId());
                $commentCount = 0; // Biến đếm số lượng bình luận

                // Hiển thị dữ liệu bình luận
                foreach ($comments as $comment) {
                  // Lấy thông tin tài khoản của bình luận
                  $commentCount++; // Tăng biến đếm
                  // Lấy thông tin tài khoản của bình luận
                  $commentId = $comment->getCommentId();
                  // Lấy danh sách các phản hồi của bình luận
                  $responses = $respondController->getResponsesByCommentId($comment->getCommentId());
                  // Kiểm tra xem comment có phản hồi hay không
                  $hasResponses = !empty($responses);
                ?>
                  <div class="user-comment-section <?php if ($commentCount > 3) echo 'hidden-comment'; ?>">
                    <?php foreach ($accounts as $account) {
                      if ($comment->getAccountId() === $account->getAccountId()) {
                        $avatar_path = $account->getAccountAvatar();
                        $new_avatar_path = str_replace('/upload/', '../upload/', $avatar_path);
                    ?>
                        <img class="image-15-icon3" loading="lazy" alt="<?php echo $account->getAccountAvatar(); ?>" src="<?php echo  $new_avatar_path ?>">
                        <div class="comment-menu">
                          <div class="comment-menu-container">
                            <div class="comment-wrapper">
                              <div class="comment-details">
                                <div class="comment-author"><?php echo $account->getAccountName(); ?></div>
                            <?php }
                        } ?>
                            <div class="comment-date"><?php echo date('d/m/Y', strtotime($comment->getCreatedOnDate())); ?></div>
                            <div class="comment-text"><?php echo $comment->getCommentContent(); ?></div>
                              </div>
                            </div>
                            <!-- Thêm phần tử phản hồi cho bình luận -->
                            <?php if (isset($_SESSION['username'])) : ?>

                            <div class="reply-section">
                              <button class="reply-comment-button">Phản hồi</button>
                              <div class="respond-form hidden">
                                <form action="" method="POST" class="respond-form-container" id="respond-form-container">
                                  <!-- Trường ẩn để lưu comment_id -->
                                  <input type="hidden" name="comment_id" value="<?php echo $commentId; ?>">
                                  <input type="hidden" name="account_id" value="<?php echo $_SESSION['account_id'] ?>">

                                  <!-- Trường nhập phản hồi -->
                                  <textarea name="respond_content" class="respond-input" id="respond" rows="1" placeholder="Nhập phản hồi của bạn"></textarea>
                                  <!-- Nút gửi phản hồi -->
                                  <button type="submit" class="respond-submit-btn">
                                    <img class="vuesaxboldsend-2-icon" alt="" src="../image/sport-court-details-img/send-2.svg">
                                  </button>
                                </form>
                              </div>
                            </div>
                            <?php endif ?>

                            <?php if ($hasResponses) : ?>
                              <button class="loadmore-respond-comment" data-level="1">
                                <img src="../image/sport-court-details-img/arrow-forward.svg" alt="arrow-forward">
                                <span>Xem tất cả <?php echo count($responses) ?> phản hồi</span>
                              </button>
                            <?php endif; ?>
                          </div>
                        </div>

                        <?php
                        // Hiển thị phản hồi nếu có
                        if ($hasResponses) {
                          displayResponses($responses, $respondController, $accounts, 1);
                        }
                        ?>
                  </div>
                <?php
                }
                ?>
              </div>

          </div>
          <div class="pagnitation1">
            <button id="load-more-comments-btn" class="xem-thm-bnh" <?php if ($commentCount <= 3) echo 'style="display: none;"'; ?>>Xem thêm bình luận</button>
          </div>

        </div>
      </section>

    </main>

  </div>
  <!-- FOOTER -->
  <?php include "../footer/footer.php"; ?>
  <script type="text/javascript" src="../scripts/sport-court-details.js" language="javascript"></script>
</body>

</html>