<?php session_start(); ?>
<!DOCTYPE html>
<html lang="vi">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Khu liên hợp thể thao Nguyễn Tri Phương</title>
    <link rel="stylesheet" type="text/css" href="../styles/event-management.css" />
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
    <div class="event-body">
     <div class="event-body-content">
       <div class="event-top">
         <p>Danh sách sự kiện</p>
         <div class="filter">
           <label for="filter" class="filter-btn" title="Filter"></label>
           <input type="checkbox" id="filter">
           <div class="filter-form">             
             <div class="filter-event-date">
               <p>Khoảng thời gian</p>
               <div id="filter-event-date-options">
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
                 <a id="btn-filter-cancel" href="./event-management.php">Hủy</a>
                 <a id="btn-filter-confirm" href="#">Xác nhận</a>
               </div>
             </div>
           </div>
         </div>
       </div>
       <div class="search">
         <img src="../image/event-management-img/search.svg" alt="search-icon">
         <input
           type="search"
           id="search-input"
           name="search-input"
           placeholder="Tìm kiếm sự kiện"
           required
         />       
       </div>
       <div id="event-body-menu">
         <ul>
           <?php
           require_once "../controllers/event-controller.php";
           $controller = new Event_Controller();
           $event_amount = $controller->view_all();
             echo "
             <a id='a-all-0' href='?event_id=0'>Tất cả&nbsp;(<span>".$event_amount[0]."</span>)</a>";
           ?>
           
         </ul>


         <div id="action">
           <a id="insert" href="?option=view_insert_event">
             <img src="../image/event-management-img/insert.svg" alt="insert icon">
             <p>Thêm</p>
           </a>
           <a id="update" href="#">
             <img src="../image/event-management-img/update.svg" alt="update icon">
             <p>Sửa</p>
           </a>
           <a id="delete" href="#">
             <img src="../image/event-management-img/delete.svg" alt="delete icon">
             <p>Xóa</p>
           </a>
         </div>
       </div>
       <div class="event-data-table">
         <table>
           <thead>
             <tr>
               <th><input type='checkbox' name='event_id_0' id='event_id_0'></th>
               <th>Mã sự kiện<span class='icon-arrow'>&UpArrow;</span></th>
               <th style="max-width: 200px;">Tên sự kiện<span class='icon-arrow'>&UpArrow;</span></th>
               <th>Ngày bắt đầu<span class='icon-arrow'>&UpArrow;</span></th>
               <th>Ngày kết thúc<span class='icon-arrow'>&UpArrow;</span></th>
               <th>Mô tả sự kiện<span class='icon-arrow'>&UpArrow;</span></th>
               <th>Hình ảnh sự kiện<span class='icon-arrow'>&UpArrow;</span></th>
               <th>Tỷ lệ ưu đãi<span class='icon-arrow'>&UpArrow;</span></th>
               <th>Quà ưu đãi<span class='icon-arrow'>&UpArrow;</span></th>
               <th>Trạng thái<span class='icon-arrow'>&UpArrow;</span></th>
               <th style="padding-right: 3rem;">Thao tác<span class='icon-arrow'>&UpArrow;</span></th>
             </tr>
           </thead>
           <tbody>
           <?php
              $events = $controller->view_all_event_in_DB();
              foreach ($events as $event) {
                  echo "<tr>";
                  echo "<td><input type='checkbox' name='event_id_" . $event->getEventId() . "_state_" . $event->getEventState() . "' id='event_id_" . $event->getEventId() . "' value='" . $event->getEventId() . "' onclick='updateUrl(this)'></td>";

                  echo "<td>" . $event->getEventId() . "</td>";
                  echo "<td>" . $event->getEventName() . "</td>";
                  echo "<td>" . $event->getEventStartDate() . "</td>";
                  echo "<td>" . $event->getEventEndDate() . "</td>";
                  echo "<td>" . $event->getEventDescription() . "</td>";
                  echo "<td><img class='img-event' style='width:100px; border-radius: 4px;' src='" . $event->getEventImage() . "' alt='Hình ảnh'></td>";
                  echo "<td>" . $event->getEventPreferentialRate() . " %</td>";
                  echo "<td>" . $event->getEventPreferentialItem() . "</td>";
                  if ($event->getEventState() == "Còn hạn") {
                    echo "<td><p class='status valid'>".$event->getEventState()."</p></td>";
                  } else if ($event->getEventState() == "Hết hạn") {
                  echo "<td><p class='status expired'>".$event->getEventState()."</p></td>";
                  }
                  echo "<td class='btn-view'>";
                  echo "<a href='?option=view_event_detail&event_id=" . $event->getEventId() . "'>";
                  echo "<img src='../image/event-management-img/eye.svg' alt='eye icon'>";
                  echo "<p>Xem</p>";
                  echo "</a>";
                  echo "</td>";
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
    
    <!-- FORM XEM THÔNG TIN SỰ KIỆN -->
    <form id="form-view" action="" method="post" enctype="multipart/form-data">
      <div class="form-header">
        <p>Thông tin sự kiện</p>
        <a href="?option=event_detail_exit">
          <img src="../image/event-management-img/close.svg" alt="close">
        </a>
      </div>
      <div class="form-body">
        <div class="form-body-content">
          <p class="form-body-title">Thông tin chung</p>
          <div class="form-row">
            <p>Mã sự kiện :</p>
            <div class="input" style="pointer-events: none;">
              <?php
                $event_detail = $controller->view_event_detail();
                if($event_detail){
                  echo "<input type='text' name='event_id' placeholder='Không nhập' value='".$event_detail[0]."'>";
                }
              ?>
            </div>
          </div>
          <div class="form-row">
            <p>Tên sự kiện :</p>
            <div class="input" style="pointer-events: none;">
            <?php
            if($event_detail){
              echo "<input type='text' name='event_id' placeholder='Không nhập' value='".$event_detail[1]."'>";
            }
            ?>
            </div>
          </div>

          <div class="form-row">
            <p>Mô tả sự kiện :</p>
            <div class="input" style="pointer-events: none;">
            <?php
              if($event_detail){
                echo "<textarea name='event_description' placeholder='Không nhập' style='font-family: \"Be Vietnam Pro\";'> ".$event_detail[4]."</textarea>";
              }
            ?>
            </div>
          </div>
          <div class="form-row">
            <p>Hình ảnh sự kiện </p>
            <div class="input">
              <?php
                if($event_detail){             
                  echo "<img src='".$event_detail[5]."' style='width: 400px; height: 100px;'>";
                }
              ?>
            </div>
          </div>
          <hr>
          <p class="form-body-title">Tỷ lệ và quà ưu dãi</p>
          <div class="form-row">
            <p>Tỷ lệ ưu đãi</p>
            <div class="input" style="pointer-events: none;">
            <?php
                if($event_detail){    
              echo "<input type='text' name='event_rate' placeholder='Không nhập' value='".$event_detail[6]."'>";
                }
            ?>
            </div>
          </div>
          <div class="form-row">
            <p>Quà ưu đãi</p>
            <div class="input" style="pointer-events: none;">
            <?php
                if($event_detail){    
                echo "<input type='text' name='event_item' placeholder='Không nhập' value='".$event_detail[7]."'>";
                }
            ?>
            </div>
          </div>
          <hr>
          <p class="form-body-title">Thông tin khác</p>
          <div class="form-row">
            <p>Trạng thái :</p>
            <div class="input" style="pointer-events: none;">
            <?php
                if($event_detail){    
              echo "<input type='text' name='event_state' placeholder='Không nhập' value='".$event_detail[8]."'>";
                }
            ?>
            </div>
          </div>
          <div class="form-row">
            <p>Ngày thêm :</p>
            <div class="input" style="pointer-events: none;">
              <?php
                  if($event_detail){    
              echo "<input type='text' name='added_date' placeholder='Không nhập' value='".$event_detail[9]."'>";
                  }
            ?>
            </div>
          </div>
          <div class="form-row">
            <p>Ngày cập nhật :</p>
            <div class="input" style="pointer-events: none;">
            <?php
                if($event_detail){    
              echo "<input type='text' name='updated_date' placeholder='Không nhập' value='".$event_detail[10]."'>";
                }
                
            ?>
            </div>
          </div>
        </div>
      </div>
      <div class="form-footer">
        <div class="button-group">
          <a class="form-button" id="form-update" href="<?php echo '?option=view_update_event&event_id='.urlencode($event_detail[0]).'&event_state='.$event_detail[8]; ?>">
            <img src="../image/event-management-img/form-edit.svg" alt="update icon">
            <p>Sửa</p>
          </a>
          <a class="form-button" id="form-delete" href="<?php echo '?option=delete_event&event_id='.urlencode($event_detail[0]).'&event_state='.$event_detail[8]; ?>">
            <img src="../image/event-management-img/form-delete.svg" alt="delete icon">
            <p>Xóa</p>
          </a>
        </div>
      </div>
    </form>

    <!-- FORM CHỈNH SỬA THÔNG TIN SỰ KIỆN -->
    <form id="form-edit" action="?option=update_event" method="post" enctype="multipart/form-data">
      <div class="form-header">
        <p>Thông tin sự kiện</p>
        <a href="?option=event_detail_exit">
          <img src="../image/event-management-img/close.svg" alt="close">
        </a>
      </div>
      <div class="form-body">
        <div class="form-body-content">
          <p class="form-body-title">Thông tin chung</p>
          <div class="form-row">
            <p>Mã sự kiện :</p>
            <div class="input" style="pointer-events: none;">
              <?php
                $event_detail = $controller->view_event_detail();
                if($event_detail){
                  echo "<input type='text' name='event_id' value='".$event_detail[0]."'>";
                }
              ?>
            </div>
          </div>
          <div class="form-row">
            <p>Tên sự kiện :</p>
            <div class="input">
            <?php
            if($event_detail){
              echo "<input type='text' name='event_name' value='".$event_detail[1]."'>";
            }
            ?>
            </div>
          </div>

          <div class="form-row">
            <p>Mô tả sự kiện :</p>
            <div class="input">
            <?php
              if($event_detail){
                echo "<textarea name='event_description' placeholder='Không nhập' style='font-family: \"Be Vietnam Pro\";'> ".$event_detail[4]."</textarea>";
              }
            ?>
            </div>
          </div>
          <div class="form-row">
            <p>Hình ảnh sự kiện </p>
            <div class="input">
            <?php
                if ($event_detail) {             
                    echo '<label for="event_image">';
                    echo '<img id="preview_image" src="' . $event_detail[5] . '" alt="court_image" style="width: 400px; height: 100px;">';
                    echo '<input type="file" name="event_image" id="event_image" style="display: none">';
                    echo '</label>';
                }

              ?>
            </div>
          </div>
          <hr>
          <p class="form-body-title">Tỷ lệ và quà ưu dãi</p>
          <div class="form-row">
            <p>Tỷ lệ ưu đãi</p>
            <div class="input">
              <select name='event_preferential_rate'>
                <option value='-1' <?php if($event_detail[6] == -1) { echo "selected"; } ?>>Chọn tỷ lệ ưu đãi</option>
                <option value='0' <?php if($event_detail[6] == 0) { echo "selected"; } ?>>0%</option>
                <option value='5' <?php if($event_detail[6] == 5) { echo "selected"; } ?>>5%</option>
                <option value='10' <?php if($event_detail[6] == 10) { echo "selected"; } ?>>10%</option>
                <option value='15' <?php if($event_detail[6] == 15) { echo "selected"; } ?>>15%</option>
                <option value='20' <?php if($event_detail[6] == 20) { echo "selected"; } ?>>20%</option>
                <option value='25' <?php if($event_detail[6] == 25) { echo "selected"; } ?>>25%</option>
                <option value='30' <?php if($event_detail[6] == 30) { echo "selected"; } ?>>30%</option>
                <option value='35' <?php if($event_detail[6] == 35) { echo "selected"; } ?>>35%</option>
                <option value='40' <?php if($event_detail[6] == 40) { echo "selected"; } ?>>40%</option>
                <option value='45' <?php if($event_detail[6] == 45) { echo "selected"; } ?>>45%</option>
                <option value='50' <?php if($event_detail[6] == 50) { echo "selected"; } ?>>50%</option>
                <option value='55' <?php if($event_detail[6] == 55) { echo "selected"; } ?>>55%</option>
                <option value='60' <?php if($event_detail[6] == 60) { echo "selected"; } ?>>60%</option>
                <option value='65' <?php if($event_detail[6] == 65) { echo "selected"; } ?>>65%</option>
                <option value='70' <?php if($event_detail[6] == 70) { echo "selected"; } ?>>70%</option>
                <option value='75' <?php if($event_detail[6] == 75) { echo "selected"; } ?>>75%</option>
                <option value='80' <?php if($event_detail[6] == 80) { echo "selected"; } ?>>80%</option>
                <option value='85' <?php if($event_detail[6] == 85) { echo "selected"; } ?>>85%</option>
                <option value='90' <?php if($event_detail[6] == 90) { echo "selected"; } ?>>90%</option>
                <option value='95' <?php if($event_detail[6] == 95) { echo "selected"; } ?>>95%</option>
                <option value='100' <?php if($event_detail[6] == 100) { echo "selected"; } ?>>100%</option>
              </select>
            </div>
          </div>
          <div class="form-row">
            <p>Quà ưu đãi</p>
            <div class="input" >
            <?php
                if($event_detail){    
                  echo "<input type='text' name='event_preferential_item' value='".$event_detail[7]."'>";
                }
            ?>
            </div>
          </div>
          <hr>
          <p class="form-body-title">Thông tin khác</p>
          <div class="form-row">
            <p>Trạng thái :</p>
            <div class="input" >
              <select name='event_state'>
                <option value='0' <?php if($event_detail[8] == "0") { echo "selected"; } ?>>Chọn trạng thái</option>
                <option value='Còn hạn' <?php if($event_detail[8] == "Còn hạn") { echo "selected"; } ?>>Còn hạn</option>
                <option value='Hết hạn' <?php if($event_detail[8] == "Hết hạn") { echo "selected"; } ?>>Hết hạn</option>
              </select>
            </div>
            
          </div>
          <div class="form-row">
            <p>Ngày bắt đầu:</p>
            <div class="input">
            <?php
                if($event_detail){    
              echo "<input type='text' name='event_start_date' placeholder='Không nhập' value='".$event_detail[2]."'>";
                }
            ?>
            </div>
          </div>
          <div class="form-row">
            <p>Ngày kết thúc:</p>
            <div class="input" >
            <?php
                if($event_detail){    
              echo "<input type='text' name='event_end_date' placeholder='Không nhập' value='".$event_detail[3]."'>";
                }
            ?>
            </div>
          </div>
          <div class="form-row">
            <p>Ngày thêm :</p>
            <div class="input"  style="pointer-events: none;">
              <?php
                  if($event_detail){    
              echo "<input type='text' name='added_date' placeholder='Không nhập' value='".$event_detail[9]."'>";
                  }
            ?>
            </div>
          </div>
          <div class="form-row">
            <p>Ngày cập nhật :</p>
            <div class="input"  style="pointer-events: none;">
            <?php
                if($event_detail){    
              echo "<input type='text' name='updated_date' placeholder='Không nhập' value='".$event_detail[10]."'>";
                }
                
            ?>
            </div>
          </div>
        </div>
      </div>
      <div class="form-footer">
          <div class="button-group">
            <a class="form-button" id="form-exit" href="../views/event-management.php">
              <img src="../image/event-management-img/form-delete.svg" alt="exit icon">
              <p>Hủy</p>
            </a>
            <input type="submit" value="Lưu">
          </div>
        </div>
    </form>

    <!-- FORM THÊM SỰ KIỆN -->
    <form id="form-insert" action="?option=insert_event" method="post" enctype="multipart/form-data">
        <div class="form-header">
        <p>Thông tin sự kiện</p>
        <a href="?option=event_detail_exit">
          <img src="../image/event-management-img/close.svg" alt="close">
        </a>
      </div>
      <div class="form-body">
        <div class="form-body-content">
          <p class="form-body-title">Thông tin chung</p>
          <div class="form-row">
            <p>Mã sự kiện :</p>
            <div class="input" style="pointer-events: none;">
              <input type='text' name='event_id' placeholder='Không nhập'>
            </div>
          </div>
          <div class="form-row">
            <p>Tên sự kiện :</p>
            <div class="input">
              <input type='text' name='event_name' placeholder='Nhập tên sự kiện' required>
            </div>
          </div>
          <div class="form-row">
            <p>Mô tả sự kiện :</p>
            <div class="input" >
              <input type='text' name='event_description' placeholder='Nhập mô tả sự kiện' required>
            </div>
          </div>
          <div class="form-row">
              <p>Hình ảnh sự kiện</p>
              <div class="input">
                  <input type="file" id="event_image" name="event_image" accept="image/*" required>
              </div>
          </div>
          <hr>
          <p class="form-body-title">Tỷ lệ và quà ưu dãi</p>
          <div class="form-row">
            <p>Tỷ lệ ưu đãi</p>
            <div class="input">
              <select name='event_preferential_rate'>
                <option value='-1'>Chọn tỷ lệ ưu đãi</option>
                <option value='0'>0%</option>
                <option value='5'>5%</option>
                <option value='10'>10%</option>
                <option value='15'>15%</option>
                <option value='20'>20%</option>
                <option value='25'>25%</option>
                <option value='30'>30%</option>
                <option value='35'>35%</option>
                <option value='40'>40%</option>
                <option value='45'>45%</option>
                <option value='50'>50%</option>
                <option value='55'>55%</option>
                <option value='60'>60%</option>
                <option value='65'>65%</option>
                <option value='70'>70%</option>
                <option value='75'>75%</option>
                <option value='80'>80%</option>
                <option value='85'>85%</option>
                <option value='90'>90%</option>
                <option value='95'>95%</option>
                <option value='100'>100%</option>
              </select>
            </div>
          </div>
          <div class="form-row">
            <p>Quà ưu đãi</p>
            <div class="input" >
              <input type='text' name='event_preferential_item' placeholder='Nhập quà ưu đãi'>
            </div>
          </div>
          <hr>
          <p class="form-body-title">Thông tin khác</p>
          <div class="form-row">
          <p>Trạng thái :</p>
            <div class="input" >
              <select name='event_state' required>
                <option value='Còn hạn'>Còn hạn</option>
                <option value='Hết hạn'>Hết hạn</option>
              </select>
            </div>         
          </div>
          <div class="form-row">
            <p>Ngày bắt đầu:</p>
            <div class="input">
                <input type="date" id="event_start_date" name="event_start_date" required>
            </div>
          </div>
          <div class="form-row">
            <p>Ngày kết thúc:</p>
            <div class="input" >
              <input type="date" id="event_end_date" name="event_end_date" required>
            </div>
          </div>
        </div>
      </div>
      <div class="form-footer">
        <div class="button-group">
          <a class="form-button" id="form-exit" href="?option=event_exit">
            <img src="../image/event-management-img/form-edit.svg" alt="exit icon">
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


        if($_option == "view_event_detail") {
          echo "
            <script>
              var formInsert = document.getElementById('form-view');
              formInsert.style.display = 'flex';
            </script>
          ";

        } else if($_option == "view_insert_event") {
          echo "
            <script>
              var formView = document.getElementById('form-insert');
              formView.style.display = 'flex';
            </script>
          ";


        } else if($_option == "insert_event") {
          if(isset($_POST['event_name'], $_POST['event_description'], $_POST['event_preferential_rate'], $_POST['event_preferential_item'], $_POST['event_state'], $_POST['event_start_date'],  $_POST['event_end_date'])) {
            $event_id = null;
            $event_name = $_POST['event_name'];
            $event_description = $_POST['event_description'];
            $event_image = $_FILES['event_image'];
            $event_preferential_rate = $_POST['event_preferential_rate'];
            $event_preferential_item = $_POST['event_preferential_item'];
            $event_state = $_POST['event_state'];
            $event_start_date = $_POST['event_start_date'];
            $event_end_date = $_POST['event_end_date'];
            //Kiểm tra trước khi thêm
            if ($event_name==""||$event_description==""||$event_start_date=="0"||$event_end_date="0")
            {
              include "./notification/warning.php";
              echo "
              <script>
                var warningQuestion = document.getElementById('warning-question');
                warningQuestion.textContent ='Bạn đã thực hiện thac tác thêm sự kiện!';
                
                var warningExplanation = document.getElementById('warning-explanation');
                warningExplanation.innerHTML ='Chúng tôi rất tiếc khi thông báo rằng sự kiện <br> đã không được thêm thành công';
                var btn_ok = document.getElementById('war-act-ok');
                btn_ok.href = './event-management.php';
              </script>
            ";
              return;
            }
              $event = new Event($event_id,$event_name, $event_start_date, $event_end_date, $event_description, $event_image, $event_preferential_rate, $event_preferential_item ,$event_state, null, null, null); // Assuming $account_id is not provided in the form
              $result = $controller->insert_event($event);


            if ($result == true) {
              // echo 'The court schedule has been inserted successfully';
              include "./notification/action-successful.php";
              echo "
                <script>
                  var message = document.getElementById('action-successful-message');
                  message.textContent = 'Bạn đã thêm sự kiện thành công';
                  var btn_back = document.getElementById('admin-management-button');
                  btn_back.textContent = 'Trở về quản lý sự kiện';
                  btn_back.href = './event-management.php';
                  btn_back.style.fontSize = '12.5px';
                </script>
              ";  
            } else if ($result == false) {
              // echo 'The court schedule has been inserted fail';
              include "./notification/warning.php";
              echo "
                <script>
                  var warningQuestion = document.getElementById('warning-question');
                  warningQuestion.textContent = 'Bạn đã thực hiện thao tác thêm sự kiện!';
                  
                  var warningExplanation = document.getElementById('warning-explanation');
                  warningExplanation.textContent = 'Chúng tôi rất tiếc khi thông báo rằng sự kiện đã không được thêm thành công';


                  var btn_ok = document.getElementById('war-act-ok');
                  btn_ok.href = './event-management.php';
                </script>
              ";
            } 
          }
        } else if($_option == "view_update_event") { 
          echo "
                <script>
                  var formEdit = document.getElementById('form-edit');
                  formEdit.style.display = 'flex';
                </script>
              ";    
        }else if($_option == "update_event"){
          if(isset($_POST['event_id'])) {
            $event_id = $_POST['event_id'];   
            $event_name = $_POST['event_name'];
            $event_description = $_POST['event_description'];
            $event_image = $_FILES['event_image'];
            $event_preferential_rate = $_POST['event_preferential_rate'];
            $event_preferential_item = $_POST['event_preferential_item'];
            $event_state = $_POST['event_state'];
            $event_start_date = $_POST['event_start_date'];
            $event_end_date = $_POST['event_end_date'];
            echo $event_id;

            $event = new Event($event_id,$event_name, $event_start_date, $event_end_date, $event_description, $event_image, $event_preferential_rate, $event_preferential_item ,$event_state, null, null, null); // Assuming $account_id is not provided in the form
            $result = $controller->update_event($event);
            if ($result==true) {
              // echo 'The event has been updated successfully';
              include "./notification/action-successful.php";
              echo "
              <script>
                var message = document.getElementById('action-successful-message');
                message.textContent = 'Bạn đã cập nhật sự kiện thành công';
                var btn_back = document.getElementById('admin-management-button');
                btn_back.textContent = 'Trở về quản lý sự kiện';
                btn_back.href = './event-management.php';
                btn_back.style.fontSize = '12.5px';
              </script>
            ";  
            } else if ($result == false) {
              // echo 'The event has been inserted fail';
              include "./notification/warning.php";
              echo "
                <script>
                  var warningQuestion = document.getElementById('warning-question');
                  warningQuestion.textContent = 'Bạn đã thực hiện thao tác sửa sự kiện!';
                  
                  var warningExplanation = document.getElementById('warning-explanation');
                  warningExplanation.innerHTML = 'Chúng tôi rất tiếc khi thông báo rằng <br> sự kiện đã không được cập nhật thành công';


                  var btn_ok = document.getElementById('war-act-ok');
                  btn_ok.href = './event-management.php';
                </script>
              ";
            } 
          }
        } else if($_option == "confirm_delete_event") {
              include "../views/notification/event-delete-confirmation.php";
              echo "
                <script>
                  var delConQuestion = document.getElementById('delete-confirm-question');
                  delConQuestion.textContent ='Bạn thật sự muốn xóa sự kiện này?';
                  
                  var delConExplanation = document.getElementById('delete-confirm-explanation');
                  delConExplanation.textContent ='Sự kiện này sẽ biến mất trên website của người dùng nếu bạn xoá nó.';
                </script>
              ";
            
          
        } else if($_option=="delete_event"){
            if(isset($_GET['event_id'])) {
              $event_id = $_GET['event_id'];
              $result = $controller->delete_event($event_id);

              if($result == true ){
                include "./notification/action-successful.php";
                echo "
                <script>
                  var message = document.getElementById('action-successful-message');
                  message.textContent = 'Bạn đã xóa sự kiện thành công';
                  var btn_back = document.getElementById('admin-management-button');
                  btn_back.textContent = 'Trở về quản lý sự kiện';
                  btn_back.href = './event-management.php';
                  btn_back.style.fontSize = '12.5px';
                </script>
              ";
              } else if ($result == false) {
                include "./notification/warning.php";
              echo "
              <script>
                  var warningQuestion = document.getElementById('warning-question');
                  warningQuestion.textContent = 'Bạn đã thực hiện thao tác xóa sự kiện!';
                  
                  var warningExplanation = document.getElementById('warning-explanation');
                  warningExplanation.textContent = 'Chúng tôi rất tiếc khi thông báo rằng sự kiện đã không được xóa thành công';


                  var btn_ok = document.getElementById('war-act-ok');
                  btn_ok.href = './event-management.php';
                </script>
              ";
              }
          }

            } else if($_option == "event_detail_exit") {
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
    
    <script type="text/javascript" src="../scripts/event-management.js" language="javascript"></script>
  </body>
</html>