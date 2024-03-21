    <!-- FORM CHỈNH SỬA THÔNG TIN LỊCH SÂN -->
    <form id="form-edit" action="court-schedule-controller.php" method="post" enctype="multipart/form-data">
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
            <?php
              echo "<input type='date' name='court_schedule_date'  style='pointer-events: none;' placeholder='Chọn ngày nhận sân' required value='".$specific_court_schedule[1]."'>";
            ?>
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