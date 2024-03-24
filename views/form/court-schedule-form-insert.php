    <!-- FORM THÊM LỊCH SÂN -->
    <form id="form-insert" action="../controllers/court-schedule-controller.php?option=insert_court_schedule" method="post" enctype="multipart/form-data">
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
            <div class="input">
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
            <div class="input">
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