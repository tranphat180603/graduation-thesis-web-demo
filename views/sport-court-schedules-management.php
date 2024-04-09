<?php session_start(); ?>
<!DOCTYPE html>
<html lang="vi">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Khu liên hợp thể thao Nguyễn Tri Phương</title>
    <link rel="stylesheet" type="text/css" href="../styles/sport-court-schedules-management.css" />
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
    <div id="overlay-wrapper"></div>
    <!-- HEADER -->
    <?php include "../header/admin-managerial-header.php"; ?>
    <!-- BODY -->
    <?php
      require_once "../controllers/court-schedule-controller.php"; 
      $court_schedule_controller = new Court_Schedule_Controller();

      require_once "../controllers/court-controller.php"; 
      $court_controller = new Court_Controller();

      require_once "../controllers/court-type-controller.php"; 
      $court_type_controller = new Court_Type_Controller();
    ?>
    <div class="schedule-body">
      <div class="schedule-body-content">
        <div class="schedule-top">
          <p>Danh sách lịch sân</p>
          <div class="filter">
            <label for="filter" class="filter-btn" title="Filter"></label>
            <input type="checkbox" id="filter">
            <div class="filter-form">
              <div class="filter-schedule-state">
                <p>Trạng thái lịch sân</p>
                <div id="filter-schedule-state-options">
                  <div id="have-not-booked">
                    <input type="checkbox" name="cb-have-not-booked" id="cb-have-not-booked" value="chưa đặt">
                    <p id="p-have-not-booked">Chưa đặt</p>
                  </div>
                  <div id="have-booked">
                    <input type="checkbox" name="cb-have-booked" id="cb-have-booked" value="đã đặt">
                    <p id="p-have-booked">Đã đặt</p>
                  </div>
                  <div id="expired">
                    <input type="checkbox" name="cb-expired" id="cb-expired" value="hết hạn">
                    <p id="p-expired">Hết hạn</p>
                  </div>
                </div>
              </div>
              <hr>
              <div class="filter-schedule-date">
                <p>Khoảng thời gian</p>
                <div id="filter-schedule-date-options">
                  <div class="date">
                    <p>Ngày bắt đầu</p>
                    <input type="date" id="start-date" name="start-date">
                  </div>
                  <p id="to">đến</p>
                  <div class="date">
                    <p>Ngày kết thúc</p>
                    <input type="date" id="end-date" name="end-date">
                  </div>
                </div>
              </div>
              <hr>
              <div class="filter-action">
                <a id="btn-filter-reset" href="#">Đặt lại</a>
                <div class="right-part">
                  <a id="btn-filter-cancel" href="./sport-court-schedules-management.php">Hủy</a>
                  <a id="btn-filter-confirm" href="#">Xác nhận</a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="search">
          <img src="../image/sport-court-schedules-management-img/search.svg" alt="search-icon">
          <input
            type="search"
            id="search-input"
            name="search-input"
            placeholder="Tìm kiếm lịch sân"
            required
          />        
        </div>
        <div id="schedule-body-menu">
          <ul>
            <?php 
              $total_court_schedule = $court_schedule_controller->view_all();
              echo "
                <li class='li-court-type' id='li-court-type-0'>
                  <a id='a-court-type-0' href='?court_type_id=0'>Tất cả&nbsp;(<span>".$total_court_schedule[0]."</span>)</a>
                </li>
              ";

              $court_types = $court_type_controller->view_all_court_type();
                
              foreach($court_types as $court_type) {
                echo "
                  <li class='li-court-type' id='li-court-type-".$court_type->getCourtTypeId()."'>
                    <a id='a-court-type-".$court_type->getCourtTypeId()."' href='?court_type_id=".$court_type->getCourtTypeId()."'>".$court_type->getCourtTypeName()."
                ";
                  
                $court_schedule_amount = $court_schedule_controller->view_court_schedule_by_court_type($court_type->getCourtTypeId());
                echo "
                      &nbsp;(<span>".$court_schedule_amount[0]."</span>)
                    </a>
                  </li>
                ";
              }
            ?>
          </ul>
          <div id="action">
            <a id="insert" href="?option=view_insert_court_schedule">
              <img src="../image/sport-court-schedules-management-img/insert.svg" alt="insert icon">
              <p>Thêm</p>
            </a>
            <a id="update" href="#">
              <img src="../image/sport-court-schedules-management-img/update.svg" alt="update icon">
              <p>Sửa</p>
            </a>
            <a id="delete" href="#">
              <img src="../image/sport-court-schedules-management-img/delete.svg" alt="delete icon">
              <p>Xóa</p>
            </a>
          </div>
        </div>
        <div class="court-schedule-table">
          <table>
            <thead> 
              <tr>
                <th><input type='checkbox' name='court_schedule_id_0' id='court_schedule_id_0' onclick='updateUrlAndCBState(this)'></th>
                <th>Mã lịch sân<span class='icon-arrow'>&UpArrow;</span></th>
                <th style="max-width: 200px;">Tên sân<span class='icon-arrow'>&UpArrow;</span></th>
                <th>Ngày nhận sân<span class='icon-arrow'>&UpArrow;</span></th>
                <th>Giờ bắt đầu<span class='icon-arrow'>&UpArrow;</span></th>
                <th>Giờ kết thúc<span class='icon-arrow'>&UpArrow;</span></th>
                <th>Khung giờ<span class='icon-arrow'>&UpArrow;</span></th>
                <th>Trạng thái<span class='icon-arrow'>&UpArrow;</span></th>
                <th>Thao tác<span class='icon-arrow'>&UpArrow;</span></th>
              </tr>
            </thead>
            <tbody>
              <?php 
                $court_schedules = $court_schedule_controller->view_court_schedule();
                $courts = $court_controller->view_all_court();

                foreach($court_schedules as $court_schedule) {
                  echo "<tr>";

                  echo "<td><input type='checkbox' name='court_schedule_id_".$court_schedule->getCourtScheduleId()."_state_".$court_schedule->getCourtScheduleState()."'";
                  echo " id='court_schedule_id_".$court_schedule->getCourtScheduleId()."' onclick='updateUrl(this)'></td>";
                  echo "<td>".$court_schedule->getCourtScheduleId()."</td>";

                  echo "<td>";
                  foreach($courts as $court) {
                    if ($court->getCourtId() == $court_schedule->getCourtId()) {
                      echo $court->getCourtName();
                    }
                  }
                  echo "</td>";

                  echo "<td>".$court_schedule->getCourtScheduleDate()."</td>";
                  echo "<td>".substr($court_schedule->getCourtScheduleStartTime(), 0, 5)."</td>";
                  echo "<td>".substr($court_schedule->getCourtScheduleEndTime(), 0, 5)."</td>";
                  echo "<td>".$court_schedule->getCourtScheduleTimeFrame()."</td>";

                  if ($court_schedule->getCourtScheduleState() == "Chưa đặt") {
                    echo "<td><p class='status haveNotBooked'>".$court_schedule->getCourtScheduleState()."</p></td>";
                  } else if ($court_schedule->getCourtScheduleState() == "Đã đặt") {
                    echo "<td><p class='status haveBooked'>".$court_schedule->getCourtScheduleState()."</p></td>";
                  } else if ($court_schedule->getCourtScheduleState() == "Hết hạn") {
                    echo "<td><p class='status expired'>".$court_schedule->getCourtScheduleState()."</p></td>";
                  } else if ($court_schedule->getCourtScheduleState() == "Đã xóa") {
                    echo "<td><p class='status deleted'>".$court_schedule->getCourtScheduleState()."</p></td>";
                  }

                  echo "
                    <td class='btn-view'>
                        <a href='?option=view_court_schedule_detail&court_schedule_id=".$court_schedule->getCourtScheduleId()."&court_schedule_state=".$court_schedule->getCourtScheduleState()."'>
                          <img src='../image/sport-court-schedules-management-img/eye.svg' alt='eye icon'>
                          <p>Xem</p>
                        </a>
                    </td>
                  ";

                  echo "</tr>";
                }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <!-- FOOTER -->
    <?php include "../footer/footer.php"; ?>
    <script type="text/javascript" src="../scripts/sport-court-schedules-management.js" language="javascript"></script>
    <!-- FORM THÊM LỊCH SÂN -->
    <form id="form-insert" action="?option=insert_court_schedule" method="post" enctype="multipart/form-data">
      <div class="form-header">
        <p>Thông tin lịch sân</p>
        <a href="?option=court_schedule_exit">
          <img src="../image/sport-court-schedules-management-img/close.svg" alt="close">
        </a>
      </div>
      <div class="form-body">
        <div class="form-body-content">
          <p class="form-body-title">Thông tin chung</p>
          <div class="form-row">
            <p>Mã lịch sân :</p>
            <div class="input" style="pointer-events: none;">
              <input type='text' name='court_schedule_id' placeholder='Không nhập'>
            </div>
          </div>
          <div class="form-row">
            <p>Tên sân :</p>
            <div class="input">
              <select id='court_id' name='court_id'>
                <option value='0'>Chọn tên sân</option>
                <?php
                  $courts = $court_controller->view_all_court();

                  $court_schedule_court_id = $specific_court_schedule[8];

                  foreach($courts as $court) {
                    echo "<option value='".$court->getCourtId()."'>".$court->getCourtName()."</option>";
                  } 
                ?>
              </select>
            </div>
          </div>
          <hr>
          <p class="form-body-title">Thời gian</p>
          <div class="form-row">
            <p>Ngày nhận sân :</p>
            <div class="input">
              <input type='date' name='court_schedule_date' placeholder='Chọn ngày nhận sân' required>
            </div>
          </div>
          <div class="form-row">
            <p>Giờ bắt đầu :</p>
            <div id="start_time_input" class="input">
              <select id='court_schedule_start_time' name='court_schedule_start_time'>
                <option value='0'>Chọn giờ bắt đầu</option>
                <?php
                  for($hour = 0; $hour <= 24; $hour++) {
                    for($minute = 0; $minute < 60; $minute += 30) {
                      if ($hour < 24 || ($hour == 24 && $minute == 0)) {
                        $time = sprintf("%02d:%02d", $hour, $minute);
                        echo "<option value='$time'>$time</option>";
                      }
                    }
                  }
                ?>
              </select>
            </div>
          </div>
          <div class="form-row">
            <p>Giờ kết thúc :</p>
            <div id="end_time_input" class="input">
              <select id='court_schedule_end_time' name='court_schedule_end_time'>
                <option value='0'>Chọn giờ kết thúc</option>
                <?php
                  for($hour = 0; $hour <= 24; $hour++) {
                    for($minute = 0; $minute < 60; $minute += 30) {
                      if ($hour < 24 || ($hour == 24 && $minute == 0)) {
                        $time = sprintf("%02d:%02d", $hour, $minute);
                        echo "<option value='$time'>$time</option>";
                      }
                    }
                  }
                ?>
              </select>
            </div>
          </div>
          <div class="form-row">
            <p>Khung giờ :</p>
            <div class="input" style="pointer-events: none;">
              <input type='text' name='court_schedule_time_frame' placeholder='Không nhập'>
            </div>
          </div>
          <hr>
          <p class="form-body-title">Thông tin khác</p>
          <div class="form-row">
            <p>Trạng thái :</p>
            <div class="input">
              <select id='court_schedule_state' name='court_schedule_state'>
                <option value='Chọn trạng thái'>Chọn trạng thái</option>
                <option value='Chưa đặt'>Chưa đặt</option>
                <option value='Đã đặt'>Đã đặt</option>
                <option value='Hết hạn'>Hết hạn</option>
              </select>
            </div>
          </div>
          <div class="form-row">
            <p>Ngày thêm :</p>
            <div class="input" style="pointer-events: none;">
              <input type='text' name='created_on_date' placeholder='Không nhập'>
            </div>
          </div>
          <div class="form-row">
            <p>Ngày cập nhật :</p>
            <div class="input" style="pointer-events: none;">
              <input type='text' name='last_modified_date' placeholder='Không nhập'>
            </div>
          </div>
        </div>
      </div>
      <div class="form-footer">
        <div class="button-group">
          <a class="form-button" id="form-exit" href="?option=court_schedule_exit">
            <img src="../image/sport-court-schedules-management-img/form-delete.svg" alt="exit icon">
            <p>Hủy</p>
          </a>
          <input type="submit" value="Lưu">
        </div>
      </div>
    </form>
    <!-- FORM XEM THÔNG TIN LỊCH SÂN -->
    <form id="form-view" action="" method="post" enctype="multipart/form-data">
      <div class="form-header">
        <p>Thông tin lịch sân</p>
        <a href="?option=court_schedule_exit">
          <img src="../image/sport-court-schedules-management-img/close.svg" alt="close">
        </a>
      </div>
      <div class="form-body">
        <div class="form-body-content">
          <p class="form-body-title">Thông tin chung</p>
          <div class="form-row">
            <p>Mã lịch sân :</p>
            <div class="input">
              <?php
                $specific_court_schedule = $court_schedule_controller->view_specific_court_schedule();
                echo "<input type='text' name='court_schedule_id' placeholder='Không nhập' value='".$specific_court_schedule[0]."'>";
              ?>
            </div>
          </div>
          <div class="form-row">
            <p>Tên sân :</p>
            <div class="input">
              <select name='court_id'>
                <option value='0'>Chọn tên sân</option>
                <?php
                  $courts = $court_controller->view_all_court();

                  $court_schedule_court_id = $specific_court_schedule[8];

                  foreach($courts as $court) {
                    if($court_schedule_court_id == $court->getCourtId()) {
                      echo "<option value='".$court->getCourtId()."' selected>".$court->getCourtName()."</option>";
                    } else {
                      echo "<option value='".$court->getCourtId()."'>".$court->getCourtName()."</option>";
                    }
                  } 
                ?>
              </select>
            </div>
          </div>
          <hr>
          <p class="form-body-title">Thời gian</p>
          <div class="form-row">
            <p>Ngày nhận sân :</p>
            <div class="input">
              <?php
                echo "<input type='date' name='court_schedule_date' placeholder='Chọn ngày nhận sân' required value='".$specific_court_schedule[1]."'>";
              ?>
            </div>
          </div>
          <div class="form-row">
            <p>Giờ bắt đầu :</p>
            <div class="input">
              <select name='court_schedule_start_time'>
                <option value='0'>Chọn giờ bắt đầu</option>
                <?php
                  for($hour = 0; $hour <= 24; $hour++) {
                    for($minute = 0; $minute < 60; $minute += 30) {
                      if ($hour < 24 || ($hour == 24 && $minute == 0)) {
                        $time = sprintf("%02d:%02d", $hour, $minute);
                        if ($time == substr($specific_court_schedule[2], 0, 5)) {
                          echo "<option value='$time' selected>$time</option>";
                        } else {
                          echo "<option value='$time'>$time</option>";
                        }
                      }
                    }
                  }
                ?>
              </select>
            </div>
          </div>
          <div class="form-row">
            <p>Giờ kết thúc :</p>
            <div class="input">
              <select name='court_schedule_end_time'>
                <option value='0'>Chọn giờ kết thúc</option>
                <?php
                  for($hour = 0; $hour <= 24; $hour++) {
                    for($minute = 0; $minute < 60; $minute += 30) {
                      if ($hour < 24 || ($hour == 24 && $minute == 0)) {
                        $time = sprintf("%02d:%02d", $hour, $minute);
                        if ($time == substr($specific_court_schedule[3], 0, 5)) {
                          echo "<option value='$time' selected>$time</option>";
                        } else {
                          echo "<option value='$time'>$time</option>";
                        }
                      }
                    }
                  }
                ?>
              </select>
            </div>
          </div>
          <div class="form-row">
            <p>Khung giờ :</p>
            <div class="input">
              <?php
                  echo "<input type='text' name='court_schedule_time_frame' placeholder='Không nhập' value='$specific_court_schedule[4]'>";
              ?>
            </div>
          </div>
          <hr>
          <p class="form-body-title">Thông tin khác</p>
          <div class="form-row">
            <p>Trạng thái :</p>
            <div class="input">
              <select name='court_schedule_state'>
                <option value='Chọn trạng thái'>Chọn trạng thái</option>
                <option value='Chưa đặt' <?php if($specific_court_schedule[5] == "Chưa đặt") { echo "selected"; } ?>>Chưa đặt</option>
                <option value='Đã đặt' <?php if($specific_court_schedule[5] == "Đã đặt") { echo "selected"; } ?>>Đã đặt</option>
                <option value='Hết hạn' <?php if($specific_court_schedule[5] == "Hết hạn") { echo "selected"; } ?>>Hết hạn</option>
              </select>
            </div>
          </div>
          <div class="form-row">
            <p>Ngày thêm :</p>
            <div class="input">
              <?php echo "<input type='text' name='created_on_date' placeholder='Không nhập' value='".date("d/m/Y", strtotime($specific_court_schedule[6]))."'>";?>
            </div>
          </div>
          <div class="form-row">
            <p>Ngày cập nhật :</p>
            <div class="input">
              <?php echo "<input type='text' name='last_modified_date' placeholder='Không nhập' value='".date("d/m/Y", strtotime($specific_court_schedule[7]))."'>";?>
            </div>
          </div>
        </div>
      </div>
      <div class="form-footer">
        <div class="button-group">
          <a class="form-button" id="form-update" href="<?php echo '?option=view_update_court_schedule&court_schedule_id='.urlencode($specific_court_schedule[0]).'&court_schedule_state='.$specific_court_schedule[5]; ?>">
            <img src="../image/sport-court-schedules-management-img/form-edit.svg" alt="update icon">
            <p>Sửa</p>
          </a>
          <a class="form-button" id="form-delete" href="<?php echo '?option=confirm_delete_court_schedule&court_schedule_id='.urlencode($specific_court_schedule[0]).'&court_schedule_state='.$specific_court_schedule[5]; ?>">
            <img src="../image/sport-court-schedules-management-img/form-delete.svg" alt="delete icon">
            <p>Xóa</p>
          </a>
        </div>
      </div>
    </form>
    <!-- FORM CHỈNH SỬA THÔNG TIN LỊCH SÂN -->
    <form id="form-edit" action="?option=update_court_schedule" method="post" enctype="multipart/form-data">
      <div class="form-header">
        <p>Thông tin lịch sân</p>
        <a href="?option=court_schedule_exit">
          <img src="../image/sport-court-schedules-management-img/close.svg" alt="close">
        </a>
      </div>
      <div class="form-body">
        <div class="form-body-content">
          <p class="form-body-title">Thông tin chung</p>
          <div class="form-row">
            <p>Mã lịch sân :</p>
            <div class="input" style="pointer-events: none;">
              <?php
                $specific_court_schedule = $court_schedule_controller->view_specific_court_schedule();
                echo "<input type='text' name='court_schedule_id' placeholder='Không nhập' value='".$specific_court_schedule[0]."'>";
              ?>
            </div>
          </div>
          <div class="form-row">
            <p>Tên sân :</p>
            <div class="input" style="pointer-events: none;">
              <select id='court_id' name='court_id'>
                <option value='0'>Chọn tên sân</option>
                <?php
                  $courts = $court_controller->view_all_court();

                  $court_schedule_court_id = $specific_court_schedule[8];

                  foreach($courts as $court) {
                    if($court_schedule_court_id == $court->getCourtId()) {
                      echo "<option value='".$court->getCourtId()."' selected>".$court->getCourtName()."</option>";
                    } else {
                      echo "<option value='".$court->getCourtId()."'>".$court->getCourtName()."</option>";
                    }
                  } 
                ?>
              </select>
            </div>
          </div>
          <hr>
          <p class="form-body-title">Thời gian</p>
          <div class="form-row">
            <p>Ngày nhận sân :</p>
            <div class="input">
              <?php
                echo "<input type='date' name='court_schedule_date'  style='pointer-events: none;' placeholder='Chọn ngày nhận sân' required value='".$specific_court_schedule[1]."'>";
              ?>
            </div>
          </div>
          <div class="form-row">
            <p>Giờ bắt đầu :</p>
            <div class="input" style="pointer-events: none;">
              <select id='court_schedule_start_time' name='court_schedule_start_time'>
                <option value='0'>Chọn giờ bắt đầu</option>
                <?php
                  for($hour = 0; $hour <= 24; $hour++) {
                    for($minute = 0; $minute < 60; $minute += 30) {
                      if ($hour < 24 || ($hour == 24 && $minute == 0)) {
                        $time = sprintf("%02d:%02d", $hour, $minute);
                        if ($time == substr($specific_court_schedule[2], 0, 5)) {
                          echo "<option value='$time' selected>$time</option>";
                        } else {
                          echo "<option value='$time'>$time</option>";
                        }
                      }
                    }
                  }
                ?>
              </select>
            </div>
          </div>
          <div class="form-row">
            <p>Giờ kết thúc :</p>
            <div class="input" style="pointer-events: none;">
              <select id='court_schedule_end_time' name='court_schedule_end_time'>
                <option value='0'>Chọn giờ kết thúc</option>
                <?php
                  for($hour = 0; $hour <= 24; $hour++) {
                    for($minute = 0; $minute < 60; $minute += 30) {
                      if ($hour < 24 || ($hour == 24 && $minute == 0)) {
                        $time = sprintf("%02d:%02d", $hour, $minute);
                        if ($time == substr($specific_court_schedule[3], 0, 5)) {
                          echo "<option value='$time' selected>$time</option>";
                        } else {
                          echo "<option value='$time'>$time</option>";
                        }
                      }
                    }
                  }
                ?>
              </select>
            </div>
          </div>
          <div class="form-row">
            <p>Khung giờ :</p>
            <div class="input" style="pointer-events: none;">
              <?php
                  echo "<input type='text' name='court_schedule_time_frame' placeholder='Không nhập' value='$specific_court_schedule[4]'>";
              ?>
            </div>
          </div>
          <hr>
          <p class="form-body-title">Thông tin khác</p>
          <div class="form-row">
            <p>Trạng thái :</p>
            <div class="input">
              <select id='court_schedule_state' name='court_schedule_state'>
                <option value='Chọn trạng thái'>Chọn trạng thái</option>
                <option value='Chưa đặt' <?php if($specific_court_schedule[5] == "Chưa đặt") { echo "selected"; } ?>>Chưa đặt</option>
                <option value='Đã đặt' <?php if($specific_court_schedule[5] == "Đã đặt") { echo "selected"; } ?>>Đã đặt</option>
                <option value='Hết hạn' <?php if($specific_court_schedule[5] == "Hết hạn") { echo "selected"; } ?>>Hết hạn</option>
              </select>
            </div>
          </div>
          <div class="form-row">
            <p>Ngày thêm :</p>
            <div class="input" style="pointer-events: none;">
              <?php echo "<input type='text' name='created_on_date' placeholder='Không nhập' value='".date("d/m/Y", strtotime($specific_court_schedule[6]))."'>";?>
            </div>
          </div>
          <div class="form-row">
            <p>Ngày cập nhật :</p>
            <div class="input" style="pointer-events: none;">
              <?php echo "<input type='text' name='last_modified_date' placeholder='Không nhập' value='".$specific_court_schedule[7]."'>";?>
            </div>
          </div>
        </div>
      </div>
      <div class="form-footer">
        <div class="button-group">
          <a class="form-button" id="form-exit" href="?option=court_schedule_exit">
            <img src="../image/sport-court-schedules-management-img/form-delete.svg" alt="exit icon">
            <p>Hủy</p>
          </a>
          <input type="submit" value="Lưu">
        </div>
      </div>
    </form>
    <!-- SCRIPT PHP ĐIỀU HƯỚNG THAO TÁC -->
    <?php
      if(isset($_GET['option'])) {
        $_option = $_GET['option'];
        
        echo "
          <script>
            var overlayFrame = document.getElementById('overlay-wrapper');
            overlayFrame.style.display = 'block';
          </script>
        "; 

        if($_option == "view_insert_court_schedule") { 
          echo "
            <script>
              var formInsert = document.getElementById('form-insert');
              formInsert.style.display = 'flex';
            </script>
          "; 
        } else if($_option == "insert_court_schedule") {
          if(isset($_POST['court_id'], $_POST['court_schedule_date'], $_POST['court_schedule_start_time'], $_POST['court_schedule_end_time'], $_POST['court_schedule_state'])) {
            //Lấy thông tin của các trường trong form
            $court_id = $_POST['court_id'];
            $court_schedule_date = date("Y-m-d", strtotime($_POST['court_schedule_date']));
            $court_schedule_start_time = $_POST['court_schedule_start_time'];
            $court_schedule_end_time = $_POST['court_schedule_end_time'];
            $court_schedule_state = $_POST['court_schedule_state'];

            $result = $court_schedule_controller->check_insert_court_schedule($court_id, $court_schedule_date, $court_schedule_start_time, $court_schedule_end_time, $court_schedule_state);

            // Kiểm tra giá trị của biến $result
            if ($result == true) {
              // echo 'The court schedule has been inserted successfully';
              include "./notification/action-successful.php";
              echo "
                <script>
                  var message = document.getElementById('action-successful-message');
                  message.textContent = 'Bạn đã thêm lịch sân thành công';
                </script>
              ";   
            } else if ($result == false) {
              // echo 'The court schedule has been inserted fail';
              include "./notification/warning.php"; 
              echo "
                <script>
                  var warningQuestion = document.getElementById('warning-question');
                  warningQuestion.textContent = 'Bạn đã thực hiện thao tác thêm lịch sân!';
                  
                  var warningExplanation = document.getElementById('warning-explanation');
                  warningExplanation.textContent = 'Chúng tôi rất tiếc khi thông báo rằng lịch sân đã không được thêm thành công';
                </script>
              ";
            }  
          }
        } else if($_option == "view_court_schedule_detail") {
          echo "
            <script>
              var formView = document.getElementById('form-view');
              formView.style.display = 'flex';
            </script>
          "; 
        } else if($_option == "view_update_court_schedule") {            
          if(isset($_GET['court_schedule_state'])) {
            $court_schedule_state = $_GET['court_schedule_state'];
            if($court_schedule_state == "Hết hạn" || $court_schedule_state == "Đã đặt") {
              include "./notification/warning.php";
              echo "
                <script>
                  var warningQuestion = document.getElementById('warning-question');
                  warningQuestion.textContent ='Bạn muốn thực hiện thao tác sửa trên lịch sân này?';
                  
                  var warningExplanation = document.getElementById('warning-explanation');
                  warningExplanation.textContent ='Lịch sân này có trạng thái là hết hạn hoặc đã đặt, bạn chỉ có thể thực hiện thao tác sửa trên các lịch sân có trạng thái là chưa đặt.';
                </script>
              ";
            } else {
              echo "
                <script>
                  var formEdit = document.getElementById('form-edit');
                  formEdit.style.display = 'flex';
                </script>
              ";       
            }
          }
        } else if($_option == "update_court_schedule") {
          if(isset($_POST['court_schedule_id'], $_POST['court_schedule_state'])) {
            //Lấy thông tin của các trường trong form
            $court_schedule_id = $_POST['court_schedule_id'];
            $court_schedule_state = $_POST['court_schedule_state'];
            $last_modified_date = date("Y-m-d");

            $result = false;

            if($court_schedule_state == "Hết hạn") {
              $result = $court_schedule_controller->update_court_schedule($court_schedule_id, $court_schedule_state, $last_modified_date);
            } else if($court_schedule_state == "Đã đặt") {
              $result = $court_schedule_controller->update_court_schedule_when_ordered($court_schedule_id, $last_modified_date);
            }

            // Kiểm tra giá trị của biến $result
            if ($result) {
              // echo 'The court schedule has been updated successfully'; 
              include "./notification/action-successful.php";
              echo "
                <script>
                  var message = document.getElementById('action-successful-message');
                  message.textContent = 'Bạn đã sửa lịch sân thành công';
                </script>
              "; 
            } else {
                // echo 'The court schedule has been updated fail';
                include "./notification/warning.php";
                echo "
                  <script>
                    var warningQuestion = document.getElementById('warning-question');
                    warningQuestion.textContent = 'Bạn đã thực hiện thao tác sửa lịch sân!';
                    
                    var warningExplanation = document.getElementById('warning-explanation');
                    warningExplanation.textContent = 'Chúng tôi rất tiếc khi thông báo rằng lịch sân đã không được sửa thành công';
                  </script>
                ";
            }
          }
        } else if($_option == "confirm_delete_court_schedule") {
          if(isset($_GET['court_schedule_state'])) {
            $court_schedule_state = $_GET['court_schedule_state'];
            if($court_schedule_state == "Hết hạn" || $court_schedule_state == "Đã đặt") {
              include "./notification/warning.php";
              echo "
                <script>
                  var warningQuestion = document.getElementById('warning-question');
                  warningQuestion.textContent ='Bạn muốn thực hiện thao tác xóa trên lịch sân này?';
                  
                  var warningExplanation = document.getElementById('warning-explanation');
                  warningExplanation.textContent ='Lịch sân này có trạng thái là hết hạn hoặc đã đặt, bạn chỉ có thể thực hiện thao tác xóa trên các lịch sân có trạng thái là chưa đặt.';
                </script>
              ";
            } else {
              include "./notification/schedule-delete-confirmation.php";
            }
          } 
        } else if($_option == "delete_court_schedule") {
          if(isset($_GET['court_schedule_id'])) {
            $court_schedule_id = $_GET['court_schedule_id'];

            $result = $court_schedule_controller->delete_court_schedule($court_schedule_id);

            // Kiểm tra giá trị của biến $result
            if ($result) {
              // echo 'The court schedule has been deleted successfully';
              include "./notification/action-successful.php";
              echo "
                <script>
                  var message = document.getElementById('action-successful-message');
                  message.textContent = 'Bạn đã xóa lịch sân thành công';
                </script>
              ";
            } else {
              // echo 'The court schedule has been deleted fail';
              include "./notification/warning.php";
              echo "
              <script>
                  var warningQuestion = document.getElementById('warning-question');
                  warningQuestion.textContent = 'Bạn đã thực hiện thao tác xóa lịch sân!';
                  
                  var warningExplanation = document.getElementById('warning-explanation');
                  warningExplanation.textContent = 'Chúng tôi rất tiếc khi thông báo rằng lịch sân đã không được xóa thành công';
                </script>
              ";
            }  
          }
        } else if($_option == "court_schedule_exit") {
          echo "
            <script>
              var overlayFrame = document.getElementById('overlay-wrapper');
              overlayFrame.style.display = 'none';

              var formInsert = document.getElementById('form-insert');
              formInsert.style.display = 'none';

              var formView = document.getElementById('form-view');
              formView.style.display = 'none';

              var formEdit = document.getElementById('form-edit');
              formEdit.style.display = 'none';
            </script>
          "; 
        }
      }
    ?>
  </body>
</html>