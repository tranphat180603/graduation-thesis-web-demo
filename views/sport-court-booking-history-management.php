<?php session_start(); ?>
<!DOCTYPE html>
<html lang="vi">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Khu liên hợp thể thao Nguyễn Tri Phương</title>
  <link rel="stylesheet" type="text/css" href="../styles/sport-court-booking-history-management.css" />
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
  <!-- HEADER -->
  <?php
  include "../header/customer-sub-header.php"; // Include file header
  if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $accounts = $account_controller->view_all_account();

    foreach ($accounts as $account) {
      if ($account->getAccountSignUpName() == $username) {
        $customer_avatar_link = $account->getAccountAvatar();
        $account_type = $account->getAccountType();
        $account_id =  $_SESSION['account_id'] = $account->getAccountId();
      }
    }
  }
  ?>

  <!-- BODY -->
  <main class="history-booking-order">
    <section class="list">
      <?php
      require_once "../controllers/court-order-controller.php";
      $court_order_controller = new Court_Order_Controller();

      require_once "../controllers/court-schedule-controller.php";
      $court_schedule_controller = new Court_Schedule_Controller();

      require_once "../controllers/court-controller.php";
      $court_controller = new Court_Controller();

      require_once "../controllers/court-type-controller.php";
      $court_type_controller = new Court_Type_Controller();

      require_once "../controllers/account-controller.php";
      $account_controller = new Account_Controller();

      require_once "../controllers/customer-controller.php";
      $customer_controller = new Customer_Controller();

      require_once "../controllers/court-image-controller.php";
      $court_image_controller = new Court_Image_Controller();
      require_once "../controllers/review-controller.php";

      $reviewscontroller = new Review_Controller();

      ?>

      <div id="court-order-body-menu">
        <?php
        $order_states = array("Tất cả", "Chờ thanh toán", "Chờ nhận sân", "Hoàn thành", "Đã hủy", "Chờ hoàn tiền");
        // Lấy trạng thái hiện tại từ URL
        $current_state_id = isset($_GET['court_order_state_id']) ? $_GET['court_order_state_id'] : 0;
        ?>
        <ul>
          <?php foreach ($order_states as $index => $state_label) : ?>
            <?php
            $court_order_amount = $court_order_controller->count_court_order_by_customer_and_state($account_id, $state_label);
            // Kiểm tra xem trạng thái có khớp với trạng thái hiện tại từ URL không
            $selected_class = ($current_state_id == $index) ? 'selected' : '';
            ?>
            <li class='li-court-order-state <?php echo $selected_class; ?>' id='li-court-order-state-<?php echo $index; ?>'>
              <a id='a-court-order-state-<?php echo $index; ?>' href='?court_order_state_id=<?php echo $index; ?>'>
                <?php echo $state_label; ?>&nbsp;(<span><?php echo $court_order_amount; ?></span>)
              </a>
            </li>
          <?php endforeach; ?>
        </ul>
      </div>
    </section>
    <div class="search-container">
      <img class="decoder-icon" loading="lazy" alt="" src="../image/sport-courts-booking-history-management-img/vector.svg" />
      <input class="search-input" type="text" placeholder="Bạn có thể tìm kiếm theo ID đơn đặt sân, Tên sân hoặc Ngày nhận sân">
    </div>


    <?php
    $court_orders = $court_order_controller->view_court_order_by_customer_id_and_state($account_id);
    $court_schedules = $court_schedule_controller->view_all_court_schedule();
    $courts = $court_controller->view_all_court();
    $court_types = $court_type_controller->view_all_court_type();
    $accounts = $account_controller->view_all_account();
    $court_images = $court_image_controller->view_all_court_images();
    $total_orders = count($court_orders);

    ?>

    <?php if ($total_orders === 0) : ?>
      <?php
      $message = '';

      // Hiển thị thông báo phù hợp tùy thuộc vào trạng thái được yêu cầu
      switch ($court_order_state_id) {
        case 1:
          $message = "Hiện tại, bạn chưa có đơn đặt sân nào chờ thanh toán cả!";
          break;
        case 2:
          $message = "Hiện tại, bạn chưa có đơn đặt sân nào chờ nhận sân cả!";
          break;
        case 3:
          $message = "Hiện tại, bạn chưa có đơn đặt sân nào hoàn thành cả!";
          break;
        case 4:
          $message = "Hiện tại, bạn chưa có đơn đặt sân nào đã hủy cả!";
          break;
        case 5:
          $message = "Hiện tại, bạn chưa có đơn đặt sân nào chờ hoàn tiền cả!";
          break;
        default:
          $message = "Hiện tại, bạn chưa có đơn đặt sân nào trong trạng thái này!";
          break;
      }
      ?>
      <div class='booking-details1'>
        <img src='../image/sport-courts-booking-history-management-img/noresult.svg' alt='Order Image'>
        <span> <?php echo $message; ?></span>

      </div>
    <?php else : ?>
      <?php foreach ($court_orders as $court_order) : ?>
        <?php foreach ($court_schedules as $court_schedule) : ?>
          <?php if ($court_order->getCourtScheduleId() === $court_schedule->getCourtScheduleId()) : ?>
            <?php foreach ($courts as $court) : ?>
              <?php if ($court->getCourtId() === $court_schedule->getCourtId()) : ?>
                <?php $court_id = $court->getCourtId(); ?>
                <section class="booking-details">
                  <div class="booking-number">
                    <b class="booking-id-label">ID Đơn đặt sân:</b>
                    <b class="booking-id"><?php echo $court_order->getCourtOrderId(); ?></b>
                  </div>
                  <div class="list-child"></div>
                  <div class="booking-status-parent">
                    <div class="court-type-container">
                      <?php foreach ($court_types as $court_type) : ?>
                        <?php if ($court->getCourtTypeId() === $court_type->getCourtTypeId()) : ?>
                          <img class="court-type-image" loading="lazy" alt="" src="<?php echo $court_type->getCourtTypeIcon(); ?>" />
                          <div class="court-type-title"> Loại sân:</div>
                          <div class="court-type"><?php echo $court_type->getCourtTypeName(); ?></div>
                        <?php endif; ?>
                      <?php endforeach; ?>
                    </div>
                    <div class="booking-status 
                  
                    <?php echo strtolower(preg_replace('/[^a-zA-Z0-9]/', '-', mb_convert_encoding($court_order->getOrderState(), 'ASCII', 'UTF-8'))); ?>"> <?php echo mb_strtoupper($court_order->getOrderState()) ?>
                    </div>


                  </div>
                  <div class="list-item"></div>
                  <div class="booking-info">
                    <div class="booking-info-item">
                      <?php
                      $found_image = false;
                      foreach ($court_images as $court_image) {
                        if ($court_image->getCourtId() === $court_id && !$found_image) {
                          echo "<img class='court-main-image' loading='lazy' alt='' src='{$court_image->getCourtImage()}' />";
                          $found_image = true; // Đánh dấu rằng đã tìm thấy ảnh cho court_id này
                        }
                      }
                      ?>
                      <div class="schedule-booking-info">
                        <div class="court-name"><?php echo $court->getCourtName(); ?></div>
                        <div class="schedule-date"><?php echo date("d/m/Y", strtotime($court_schedule->getCourtScheduleDate())); ?></div>
                        <div class="schedule-time"><?php echo $court_schedule->getCourtScheduleTimeFrame(); ?></div>
                      </div>
                    </div>
                    <div class="payment-details">
                      <div class="total-payment">
                        <b class="total-payment-label">Tổng Tiền Thanh Toán:</b>
                        <div class="payment-amount"><?php echo $court_order->getOrderTotalPayment(); ?></div>
                      </div>
                      <div class="deposit-details">
                        <b class="deposit-label">Tổng Tiền Cọc:</b>
                        <div class="deposit-amount"><?php echo $court_order->getOrderTotalDeposit(); ?></div>
                      </div>
                    </div>

                  </div>

                  <img class="list-child" loading="lazy" alt="" src="../image/sport-courts-booking-history-management-img/line-45.svg" />
                  <?php
                  $order_state = $court_order->getOrderState();
                  switch ($order_state) {
                    case 'Chờ thanh toán':
                  ?>
                      <div class="message awaiting-payment-container">
                        <div class="awaiting-payment-content">
                          Cảm ơn bạn đã đặt sân thể thao, bạn vui lòng chờ NTP xác nhận thanh toán nhé
                        </div>
                        <button class="button cancel-button" data-court-order-id="<?php echo $court_order->getCourtOrderId(); ?>">
                          <div class="cancel-label">Hủy Đơn Đặt Sân</div>
                        </button>
                      </div>
                    <?php
                      break;
                    case 'Đã hủy':
                    ?>
                      <div class="message cancellation-info">
                        <div class="cancellation-reason">Đã hủy bởi bạn</div>
                        <div class="cancellation-content">Lý do hủy: <?php echo $court_order->getOrderCancelReason(); ?></div>
                      </div>
                    <?php
                      break;
                    case 'Hoàn thành':
                    ?>
                      <div class="message complete-container">
                        <div class="complete-content">
                          NTP chân thành cảm ơn bạn đã tin tưởng và chọn NTP để thỏa sức đam mê cùng đồng đội
                        </div>
                        <?php
                          $review_status = $reviewscontroller->checkReviewed($court_order->getCourtOrderId(), $account_id);
                        ?>
                        <button class="review-button" id="review-button" data-court-order-id="<?php echo $court_order->getCourtOrderId(); ?>">
                          <div class="review-label">
                            <?php
                            if ($review_status === "Đã đánh giá") {
                              echo "Xem đánh giá";
                            } else {
                              echo "Đánh giá sân";
                            }
                            ?>
                          </div>
                        </button>
                      </div>
                    <?php
                      break;
                    case 'Chờ nhận sân':
                    ?>
                      <div class="message awaiting-court-container">
                        <div class="awaiting-court-content">
                          Cảm ơn bạn đã đặt sân thể thao, NTP chúc bạn có một trải nghiệm thật tuyệt vời bên đồng đội
                        </div>
                        <button class="button cancel-button" data-court-order-id="<?php echo $court_order->getCourtOrderId(); ?>">
                          <div class="cancel-label">Hủy Đơn Đặt Sân</div>
                        </button>
                      </div>
                    <?php
                      break;
                    case 'Chờ hoàn tiền':
                    ?>
                      <div class="message cancellation-info">
                        <div class="cancellation-reason">Đã hủy bởi Khu liên hợp thể thao NTP</div>
                        <div class="cancellation-content">Lý do hủy: <?php echo $court_order->getOrderCancelReason(); ?></div>
                      </div>
                  <?php

                  }
                  ?>
                </section>
              <?php endif; ?>
            <?php endforeach; ?>
          <?php endif; ?>
        <?php endforeach; ?>
      <?php endforeach; ?>
    <?php endif; ?>

    <div class="circuit">
      <button class="button4" id="show-more-button">
        <b class="xem-thm">Xem thêm</b>
      </button>
    </div>
  </main>
  <div id="overlay" class="overlay"></div>
  <!-- Form xác nhận hủy đơn đặt sân -->
  <div class="message-sucess" id="message-sucess" style="display: none;">
    <div class="confirmation-title"> Đơn đặt sân đã hủy thành công! </div>
  </div>
  <div class="review-message-sucess" id="review-message-sucess" style="display: none;">
    <div class="confirmation-title"> Bạn đã đánh giá đơn hàng thành công! </div>
  </div>

  <!-- FOOTER -->
  <?php include "../footer/footer.php"; ?>
  <!-- Form đánh giá sân -->
  <?php
  require_once "../controllers/review-controller.php";
  $reviewsController = new Review_Controller();
  $courts = $court_controller->view_all_court();
  ?>

  <?php foreach ($court_orders as $court_order) :
    foreach ($court_schedules as $court_schedule) :
      if ($court_order->getCourtScheduleId() === $court_schedule->getCourtScheduleId()) :
        foreach ($courts as $court) :
          if ($court->getCourtId() === $court_schedule->getCourtId()) :
            $court_id = $court->getCourtId();
  ?>
            <!-- Form yêu cầu hủy đơn -->
            <form class="cancellation-form" id="cancellation-form-<?php echo $court_order->getCourtOrderId(); ?>" method="post" style="display:none;">
              <div class="cancellation-header">
                <p>Lý Do Hủy</p>
              </div>
              <div class="reasons-list">

                <div class="option-wrapper">
                  <input class="styled-radio custom-cursor-on-hover" checked="true" type="radio" name="cancellation-reason" id="reason1" value="event-change" data-reason="Tôi muốn thêm/ thay đổi sự kiện">
                  <label for="reason1" class="reason-label">Tôi muốn thêm/ thay đổi sự kiện</label>
                </div>
                <div class="option-wrapper">
                  <input class="styled-radio custom-cursor-on-hover" type="radio" name="cancellation-reason" id="reason2" value="schedule-change" data-reason="Tôi muốn thay đổi lịch sân">
                  <label for="reason2" class="reason-label">Tôi muốn thay đổi lịch sân</label>
                </div>
                <div class="option-wrapper">
                  <input class="styled-radio custom-cursor-on-hover" type="radio" name="cancellation-reason" id="reason3" value="better-option" data-reason="Tôi tìm thấy chỗ đặt sân khác tốt hơn (rẻ hơn, uy tín hơn, chất lượng hơn)">
                  <label for="reason3" class="reason-label">Tôi tìm thấy chỗ đặt sân khác tốt hơn (rẻ hơn, uy tín hơn, chất lượng hơn)</label>
                </div>
                <div class="option-wrapper">
                  <input class="styled-radio custom-cursor-on-hover" type="radio" name="cancellation-reason" id="reason4" value="no-need" data-reason="Tôi không còn nhu cầu đặt sân nữa">
                  <label for="reason4" class="reason-label">Tôi không còn nhu cầu đặt sân nữa</label>
                </div>
                <div class="option-wrapper">
                  <input class="styled-radio custom-cursor-on-hover" type="radio" name="cancellation-reason" id="reason5" value="no-suitable-reason" data-reason="Tôi không tìm thấy lý do hủy phù hợp">
                  <label for="reason5" class="reason-label">Tôi không tìm thấy lý do hủy phù hợp</label>
                </div>
              </div>
              <div class="button-container">
                <button type="button" class="exit-button" onclick="hideCancellationForm(<?php echo $court_order->getCourtOrderId(); ?>)">
                  <div class="exit-text">Thoát</div>
                </button>

                <div class="cancel-order-button" id="cancel-order-button" data-court-order-id="<?php echo $court_order->getCourtOrderId(); ?>">
                  <img class="cancel-order-icon" alt="" src="../image/sport-courts-booking-history-management-img/vector-1.svg">
                  <div class="cancel-order-text">Huỷ đơn</div>
                </div>
              </div>
            </form>
          <?php endif; ?>
        <?php endforeach; ?>
      <?php endif; ?>
    <?php endforeach; ?>
  <?php endforeach; ?>

  <?php foreach ($court_orders as $court_order) :
    foreach ($court_schedules as $court_schedule) :
      if ($court_order->getCourtScheduleId() === $court_schedule->getCourtScheduleId()) :
        foreach ($courts as $court) :
          if ($court->getCourtId() === $court_schedule->getCourtId()) :
            $court_id = $court->getCourtId();
  ?>
            <!-- Form xác nhận hủy đơn đặt sân -->
            <form class="booking-cancellation-confirm" id="confirmation-form-<?php echo $court_order->getCourtOrderId(); ?>" action="" method="post" style="display: none;" data-court-order-id="<?php echo $court_order->getCourtOrderId(); ?>">
              <input type="" id="court_order_id" name="court_order_id" value="<?php echo $court_order->getCourtOrderId(); ?>">
              <input type="" name="canceled_on_date" id="canceled_on_date">
              <input type="" name="cancel_reason" id="cancel_reason">
              <input type="" name="cancel_party_account_id" id="cancel_party_account_id" value="<?php echo $account_id; ?> ">
              <input type="" name="option" value="update">

              <div class="booking-cancellation-content">
                <img class="info-icon" loading="lazy" alt="" src="../image/sport-court-details-img/ExclamationCircle.svg" />
                <div class="confirmation">
                  <div class="confirmation-title">Bạn thật sự muốn hủy đơn đặt sân này?</div>
                  <div class="confirmation-text">
                    <span>Đơn đặt sân này sẽ được chuyển trạng thái thành</span>
                    <span class="cancel-status">ĐÃ HỦY</span>
                    <span> nếu bạn hủy nó.</span>
                  </div>
                </div>
              </div>
              <div class="button-group-wrapper">
                <div class="button-group">
                  <div type="button" class="dis-cancel-button" onclick="hideConfirmationForm(<?php echo $court_order->getCourtOrderId(); ?>)">
                    <div class="dis-cancel-text">Không</div>
                  </div>
                  <button type="submit" class="confirm-cancel-button">
                    <div class="confirm-cancel-text">Có</div>
                  </button>
                </div>
              </div>
            </form>
          <?php endif; ?>
        <?php endforeach; ?>
      <?php endif; ?>
    <?php endforeach; ?>
  <?php endforeach; ?>

  <!-- Form đánh giá sân -->
  <?php
  require_once "../controllers/review-controller.php";
  $reviewsController = new Review_Controller();
  $courts = $court_controller->view_all_court();
  ?>

  <?php foreach ($court_orders as $court_order) :
    foreach ($court_schedules as $court_schedule) :
      if ($court_order->getCourtScheduleId() === $court_schedule->getCourtScheduleId()) :
        foreach ($courts as $court) :
          if ($court->getCourtId() === $court_schedule->getCourtId()) :
            $court_id = $court->getCourtId();
  ?>
            <form class="review-section" id="review-section-<?php echo $court_order->getCourtOrderId(); ?>" method="post" style="display:none;" action="">
              <div class="review-header">
                <div class="review-title">Đánh giá <?php echo $court->getCourtName();  ?></div>
                <img class="close-icon" alt="" src="../image/sport-courts-booking-history-management-img/close.svg" onclick="hideFormrating('<?php echo $court_order->getCourtOrderId(); ?>')">
              </div>
              <div class="review-section-inner">
                <div class="review">
                  <div class="review-content-parent">
                    <div class="review-content">
                      <div class="rating-parent">
                        <?php
                        $averagerating = $reviewscontroller->getAverageRatingByCourtSchedule($court->getCourtId());
                        $fullStars = floor($averagerating);
                        $halfStar = $averagerating - $fullStars >= 0.5;
                        ?>
                        <b class="rating-value"><?php echo $averagerating ?></b>
                        <div class="star-icons-parent">
                          <?php
                          for ($i = 1; $i <= $fullStars; $i++) : ?>
                            <img class="vuesaxboldstar-icon" loading="lazy" alt="" src="../image/sport-court-details-img/vuesaxboldstar.svg">
                          <?php endfor;
                          if ($halfStar) : ?>
                            <img class="vuesaxboldstar-icon" loading="lazy" alt="" src="../image/sport-court-details-img/vuesaxboldstar-half.svg">
                          <?php endif;
                          for ($i = $fullStars + ($halfStar ? 1 : 0) + 1; $i <= 5; $i++) : ?>
                            <img class="vuesaxboldstar-icon" loading="lazy" alt="" src="../image/sport-court-details-img/vuesaxboldstar-gray.svg">
                          <?php endfor; ?>
                        </div>
                      </div>

                      <?php $countreviews = $reviewscontroller->getReviewCountByCourtId($court->getCourtId()); ?>
                      <div class="review-count"><?php echo  $countreviews ?> lượt đánh giá </div>
                    </div>

                    <div class="rating-statics-wrapper">
                      <div class="rating-statics-wrapper">
                        <?php
                        $reviews = $reviewscontroller->getCourtRating($court->getCourtId()); // Lấy đánh giá cho sân vận động
                        foreach ($reviews as $review) :
                          $ratings = [$review['rating_5'], $review['rating_4'], $review['rating_3'], $review['rating_2'], $review['rating_1']];
                        ?>
                          <?php for ($i = 5; $i >= 1; $i--) : ?>
                            <div class="rating-statics rating-statics-<?php echo $i; ?>">
                              <div class="rating-group rating-group-<?php echo $i; ?>">
                                <div class="rating rating-detail-value-<?php echo $i; ?>"><?php echo $i; ?></div>
                                <img class="rating-detail-icon" alt="" src="../image/sport-court-details-img/vuesaxboldstar.svg">
                              </div>
                              <div class="rating-detail-progress">
                                <div class="bar-bg">
                                  <?php $percentage = ($countreviews > 0) ? ($ratings[5 - $i] / $countreviews) * 100 : 0; ?>
                                  <div class="bar-fg" style="width: <?php echo $percentage; ?>%;"></div>
                                </div>
                              </div>
                              <div class="rating-detail-count"><?php echo $ratings[5 - $i]; ?> lượt đánh giá</div>
                            </div>
                          <?php endfor; ?>
                        <?php endforeach; ?>
                      </div>
                    </div>

                  </div>
                  <div class="close-button" id="close-button" onclick="toggleInputReview()">
                    <div class="close-text">Đóng lại</div>
                  </div>
                  <div class='data-aggregator1' data-review-status="<?php echo $review_status; ?>">
                    <div class="rating-selected-parent">
                      <div class="rating-selected-title">Chọn đánh giá của bạn</div>
                      <div class="layout-organizer star-container">
                        <!-- Các hình sao với sự kiện onclick -->
                        <img class="star-icon" data-rating="1" src="../image/sport-court-details-img/vuesaxboldstar-gray.svg" alt="1 star" onclick="setStarRating(1, '<?php echo $court_order->getCourtOrderId(); ?>')">
                        <img class="star-icon" data-rating="2" src="../image/sport-court-details-img/vuesaxboldstar-gray.svg" alt="2 stars" onclick="setStarRating(2, '<?php echo $court_order->getCourtOrderId(); ?>')">
                        <img class="star-icon" data-rating="3" src="../image/sport-court-details-img/vuesaxboldstar-gray.svg" alt="3 stars" onclick="setStarRating(3, '<?php echo $court_order->getCourtOrderId(); ?>')">
                        <img class="star-icon" data-rating="4" src="../image/sport-court-details-img/vuesaxboldstar-gray.svg" alt="4 stars" onclick="setStarRating(4, '<?php echo $court_order->getCourtOrderId(); ?>')">
                        <img class="star-icon" data-rating="5" src="../image/sport-court-details-img/vuesaxboldstar-gray.svg" alt="5 stars" onclick="setStarRating(5, '<?php echo $court_order->getCourtOrderId(); ?>')">
                      </div>
                      <div class="review-status review-status-<?php echo $court_order->getCourtOrderId(); ?>">Chọn đánh giá</div>
                      <div class="message-review-status" style="display: none;">Vui lòng điền đầy đủ đánh giá (*) . </div>
                    </div>

                    <div class="review-enter-wrapper">
                      <img class="image-16-icon" loading="lazy" alt="" src=" <?php echo "/NTP-Sports-Hub" . $customer_avatar_link; ?>">

                      <div class="review-enter">
                        <input type="" name="court_schedule_id" value="<?php echo $court_schedule->getCourtScheduleId() ?>">
                        <input type="" name="account_id" value="<?php echo $account_id; ?>">
                        <input type="" name="review_star_rate" id="review_star_rate_<?php echo $court_order->getCourtOrderId(); ?>">

                        <input type="" name="option" value="insert">
                        <textarea id="review_text" name="review_text" class="review-text-input" oninput="limitTextarea(this, 100)" placeholder="Nhập đánh giá sân (tối thiểu 100 ký tự)" oninput="this.style.height = '';this.style.height = this.scrollHeight + 'px'"></textarea>
                        <button class="send-review-button" type="button" id="send-review-button" onclick="checkInputsAndSubmit('review-section-<?php echo $court_order->getCourtOrderId(); ?>')">
                          <div class="send-review-text">Gửi đánh giá</div>
                        </button>
                      </div>
                    </div>
                  </div>


                  <div class="user-review-container">
                    <?php
                    $reviews = $reviewscontroller->getReviewData($court->getCourtId());
                    $reviewCount = count($reviews);
                    $index = 0;

                    foreach ($reviews as $review) {
                      $index++; ?>
                      <div class="reviewer">
                        <?php foreach ($accounts as $account) {
                          if ($account->getAccountId() == $review->getAccountId()) : ?>
                            <?php
                            // Lấy đường dẫn avatar từ cơ sở dữ liệu
                            $avatar_path = $account->getAccountAvatar();
                            // Thay thế phần đầu của đường dẫn
                            $new_avatar_path = str_replace('/upload/', '../upload/', $avatar_path);
                            ?>
                            <img class="image-15-icon" loading="lazy" alt="" src="<?php echo $new_avatar_path; ?>">
                            <div class="review-detail">
                              <div class="reviewer-info">
                                <div class="reviewer-name"><?php echo $account->getAccountName(); ?></div>
                                <div class="review-date"><?php echo date('d/m/Y', strtotime($review->getCreatedOnDate())); ?></div>
                                <div class="court-review-content"><?php echo $review->getReviewContent(); ?></div>
                              </div>
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
                        <?php endif;
                        } ?>
                      </div>
                    <?php } ?>
                    <div class="review-load-more-wrapper">
                      <div class="load-more-reviews-btn">Xem thêm đánh giá</div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="exit-rating-wrapper">
                <div class="exit-rating-button" id="exit-rating-button" onclick="hideFormrating('<?php echo $court_order->getCourtOrderId(); ?>')">
                  <div class="exit-rating-text">Thoát</div>
                </div>
              </div>
            </form>
          <?php endif; ?>
        <?php endforeach; ?>
      <?php endif; ?>
    <?php endforeach; ?>
  <?php endforeach; ?>

  <?php
  // Kiểm tra nếu biến option đã được gửi từ form và có giá trị là 'insert'
  if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['option']) && $_POST['option'] === 'insert') {
    // Kiểm tra xem các biến POST cần thiết đã được gửi từ form chưa

    // Gán các giá trị từ biến POST vào các biến cục bộ
    $court_schedule_id = $_POST['court_schedule_id'];
    $account_id = $_POST['account_id'];
    $review_content = $_POST['review_text'];
    $review_star_rate = $_POST['review_star_rate'];
    $created_on_date = date("Y-m-d"); // Lấy thời gian hiện tại

    // Require tệp controller của review
    require_once "../controllers/review-controller.php";
    $review_controller = new Review_Controller();

    // Gọi hàm addReview từ controller và truyền các tham số
    $result = $review_controller->addReview($review_star_rate, $review_content, $created_on_date, $court_schedule_id, $account_id);

    if ($result) {
      echo '<script>  
      document.getElementById("review-message-sucess").style.display = "flex";
      document.getElementById("overlay").style.display = "block";
      setTimeout(function() {
        location.reload();
      }, 100);
    </script>';
      // Redirect hoặc thực hiện các hành động khác sau khi đánh giá thành công
    } else {
      echo "Đánh giá đơn hàng thất bại";
      // Xử lý lỗi hoặc thông báo cho người dùng nếu đánh giá thất bại
    }
  }
  ?>

  <?php
  echo '<script>var cancelSuccess = false;</script>';

  // Kiểm tra xem request method là POST và biến option có giá trị 'update' được gửi từ form không
  if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['option']) && $_POST['option'] === 'update') {
    // Kiểm tra xem các biến POST cần thiết đã được gửi từ form chưa
    if (isset($_POST['court_order_id']) && isset($_POST['cancel_reason']) && isset($_POST['cancel_party_account_id'])) {
      // Gán các giá trị từ biến POST vào các biến cục bộ
      $court_order_id = $_POST['court_order_id'];
      $cancel_reason = $_POST['cancel_reason'];
      $canceled_on_date = date("Y-m-d"); // Lấy thời gian hiện tại
      $cancel_party_account_id = $_POST['cancel_party_account_id'];

      // Require tệp controller của hủy đơn đặt sân
      require_once "../controllers/court-order-controller.php";
      $court_order_controller = new Court_Order_Controller();

      // Gọi hàm cancelCourtOrderByCustomer từ controller và truyền các tham số
      $result = $court_order_controller->cancelCourtOrderByCustomer($court_order_id, $canceled_on_date, $cancel_reason, $cancel_party_account_id);

      // Xử lý kết quả
      if ($result) {
        echo '<script>cancelSuccess = true;</script>';
      } else {
        echo "Hủy đơn đặt sân thất bại";
        // Xử lý lỗi hoặc thông báo cho người dùng nếu hủy đơn đặt sân thất bại
      }
    }
  }
  ?>
  <script>
    if (window.history.replaceState) {
      window.history.replaceState(null, null, window.location.href);
    }
  </script>
  <script type="text/javascript" src="../scripts/sport-court-booking-history-management.js" language="javascript"></script>
</body>

</html>