<?php session_start(); ?>
<!DOCTYPE html>
<html lang="vi">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Khu liên hợp thể thao Nguyễn Tri Phương</title>
    <link rel="stylesheet" type="text/css" href="../styles/sport-court-types-management.css" />
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

  <div class="container">
    <!-- HEADER -->
    <?php
    include "../header/admin-managerial-header.php"; 
    ?>
    <!-- BODY -->
    <?php
    ini_set('display_errors', 0);
    ini_set('display_startup_errors', 0);
     $controller = new Court_Type_Controller();
     $court_types = $controller->view_all_court_type();
     $total_court_types = $controller->view_count();
     //handle nút trong miniform
     if (isset($_GET['option'])) {
         $option = $_GET['option'];
         switch ($option) {
             case 'detail':
                 if (isset($_GET['court_type_id'])) {
                     $court_type_id = $_GET['court_type_id'];
                     $court_type_detail = $controller->open_court_type_detail($court_type_id);
                 }
                 break;
             case 'delete':
                 if (isset($_GET['court_type_id'])) {
                     $court_type_id = $_GET['court_type_id'];
                     require_once ($_SERVER['DOCUMENT_ROOT'] . "/NTP-Sports-Hub/views/notification/schedule-delete-confirmation.php");
                     echo '
                     <script>
                         var question = document.getElementById(\'delete-confirm-question\');
                         question.textContent = \'Bạn có chắc muốn xoá loại sân đang chọn?!\';
                         
                         var confirmation = document.getElementById(\'delete-confirm-explanation\');
                         confirmation.textContent = \'Bạn sẽ không khôi phục được sau khi xoá dữ liệu!\';
                         
                         var yes = document.getElementById("del-con-act-yes");
                         var no = document.getElementById("del-con-act-no");
                         
                         if (yes) {
                             yes.addEventListener("click", function(event) {
                                 event.preventDefault();
                                 window.location.href = "?option=delete_process&court_type_id=' . $court_type_id . '";
                             });
                         }
                         if (no){
                             no.addEventListener("click", function(event) {
                                 event.preventDefault();
                                 window.location.href = "../views/sport-court-types-management.php";
                             });
                         }
                     </script>
                     ';
                 }
                 
                 break;
             
             case 'delete_process':
                 if (isset($_GET['court_type_id'])) {
                     $court_type_ids = array($_GET['court_type_id']); // Single ID converted to an array
                     $controller->delete_court_type($court_type_ids);
                 }                
             break;
             case 'delete_court_schedule':
                 if (isset($_GET['check_delete'])) {
                     $check_delete_ids = $_GET['check_delete'];
                     // Construct the URL with delete_multiple option and check_delete[] parameters
                     $url = '../views/sport-court-types-management.php?option=delete_multiple_court_type&';
                     foreach ($check_delete_ids as $id) {
                         $url .= 'check_delete[]=' . $id . '&';
                     }
                     $url = rtrim($url, '&'); // Remove the trailing '&'
                     
                     require_once ($_SERVER['DOCUMENT_ROOT'] . "/NTP-Sports-Hub/views/notification/schedule-delete-confirmation.php");
                     echo '
                     <script>
                         var question = document.getElementById(\'delete-confirm-question\');
                         question.textContent = \'Bạn có chắc muốn xoá những loại sân đang chọn?!\';
                         
                         var confirmation = document.getElementById(\'delete-confirm-explanation\');
                         confirmation.textContent = \'Bạn sẽ không khôi phục được sau khi xoá dữ liệu!\';
                         
                         var yes = document.getElementById("del-con-act-yes");
                         var no = document.getElementById("del-con-act-no");
                         
                         if (yes) {
                             yes.addEventListener("click", function(event) {
                                 event.preventDefault();
                                 window.location.href = "' . $url . '";
                             });
                         }
                         if (no){
                             no.addEventListener("click", function(event) {
                                 event.preventDefault();
                                 window.location.href = "../views/sport-court-types-management.php";
                             });
                         }
                     </script>
                     ';
                 }
                 break;            
             case 'delete_multiple_court_type':
                 if (isset($_GET['check_delete'])) {
                     $check_delete_ids = $_GET['check_delete'];
                     $controller->delete_court_type($check_delete_ids);
                 }
             break;
             case 'view_update_court_schedule':
                 if (isset($_GET['check_delete'])) {
                     $check_delete_ids = $_GET['check_delete'];
                     
                     // Check if there is only one element in the array
                     if (count($check_delete_ids) !== 1) {
                         require_once ($_SERVER['DOCUMENT_ROOT'] . "/NTP-Sports-Hub/views/notification/warning.php");
                         echo '
                         <script>
                           var warningQuestion = document.getElementById(\'warning-question\');
                           warningQuestion.textContent = \'Chỉ được chỉnh sửa một loại sân mỗi lần\';
                           
                           var warningExplanation = document.getElementById(\'warning-explanation\');
                           warningExplanation.textContent = \'Vui lòng chọn lại 1 loại sân duy nhất\';
                         
                           var warActOk = document.getElementById("war-act-ok");
                           if (warActOk) {
                               warActOk.addEventListener("click", function(event) {
                                   event.preventDefault();
                                   window.location.href = "../views/sport-court-types-management.php";
                                 });
                           }
                         </script>
                         ';
                     }
                     else if(count($check_delete_ids) === 1){
                         // Proceed with updating the court type
                         $court_type_detail = $controller->open_court_type_detail($check_delete_ids[0]);
                     }
                 }
                 break;
             
             case 'off':
                 echo '<script>window.location.href = "../views/sport-court-types-management.php";</script>';
             break;
         }
     }
 
     if ($_SERVER["REQUEST_METHOD"] == "POST") {
         if (isset($_POST['save'])) { 
             if (empty($_POST['court_type_id'])) { 
                 $controller->insert_court_type($_POST['court_type_name'], $_POST['image-URL']);
             } else {
                 $controller->update_court_type($_POST['court_type_id'], $_POST['court_type_name'], $_POST['image-URL']);
             }
         }
         // Check if the saveImg button was clicked and handle file upload
         if (isset($_POST['saveImg'])) {
             // File has been uploaded, handle the upload
             $controller->handleImageUpload($_POST['court_type_id']);
         }
     }
    ?>
    <div class = "overlay"></div>
    <div class="schedule-body">
      <div class="schedule-body-content">
        <div class="schedule-top">
          <p>Danh sách lịch sân</p>
          <a href="?option=filter">
            <img src="../image/sport-court-schedules-management-img/filter.svg" alt="Filter">
          </a>
        </div>
        <div class="search">
          <img src="../image/sport-court-schedules-management-img/search.svg" alt="search-icon">
          <input
            type="search"
            id="search-input"
            name="search-input"
            placeholder="Tìm kiếm loại sân"
          />        
        </div>
        <div id="schedule-body-menu">
          <ul>
            <?php 
              require_once "../controllers/court-type-controller.php"; 
                //Hiển thị dòng tất cả
                echo "
                  <a id='a-court-type-0' href='?court_type_id=0'>Tất cả (<span>".$total_court_types[0]."</span>)</a>";
            ?>
          </ul>
          <form id="action" action="../controllers/court-schedule-management.php" method="post" enctype="multipart/form-data">
            <a id="insert" href="?option=view_insert_court_schedule">
              <img src="../image/sport-court-schedules-management-img/insert.svg" alt="insert icon">
              <p>Thêm</p>
            </a>
            <a id="update" href="?option=view_update_court_schedule">
              <img src="../image/sport-court-schedules-management-img/update.svg" alt="update icon">
              <p>Sửa</p>
            </a>
            <a id="delete" href="#">
              <img src="../image/sport-court-schedules-management-img/delete.svg" alt="delete icon">
              <p>Xóa</p>
            </a>
          </form>
        </div>
        <div class="court-schedule-table">
          <table>
            <thead> 
              <tr>
                <th><input type='checkbox' name='court_type_id_0' id='court_type_id_0' onclick='updateUrlAndCBState(this)'></th>
                <th>Mã loại sân<span class='icon-arrow'>&UpArrow;</span></th>
                <th>Tên loại sân<span class='icon-arrow'>&UpArrow;</span></th>
                <th>Icon loại sân<span class='icon-arrow'>&UpArrow;</span></th>
                <th>Thao tác<span class='icon-arrow'>&UpArrow;</span></th>
              </tr>
            </thead>
            <tbody>
              <?php 
                foreach($court_types as $court_type) {
                  $courtTypeIcon = $court_type->getCourtTypeIcon();
                  if ($courtTypeIcon !== "" && $courtTypeIcon !== NULL) {
                    // Append the correct file extension to the URL
                    $imageSrc = $courtTypeIcon;
                  } else {
                    $imageSrc = '../upload/sport-court-types-management/default-img.svg';
                  }  
                  echo "<tr>";
                  echo "<td><input type='checkbox' name='court_type_id_".$court_type->getCourtTypeId()."' id='court_type_id_".$court_type->getCourtTypeId()."' onclick='updateUrl(this)'></td>";
                  echo "<td>".$court_type->getCourtTypeId()."</td>";
                  echo "<td>".$court_type->getCourtTypeName()."</td>";
                  echo "<td><img id='icon' src='" . $imageSrc . "' ></td>";
                  echo "
                      <td class='btn-view'>
                          <a class = 'view' href='?option=detail&court_type_id=".$court_type->getCourtTypeId()."'>
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
      </div>
    <div class="court-type-detail">
          <div id="header">
            <p id="header-text">Thông tin loại sân</p>
            <a href='?option=off' id="closeButton">
              <img id="close" name="close" src="../image/sport-court-types-management-img/close.svg">
            </a>
          </div> <!-- Close div header -->
          <div id="form-container">
            <form id="detail-form" action="" method="post" enctype="multipart/form-data">
              <p class="detail-p">Thông tin chung</p><br>
              <div class="detail-row">
                <div class = "label-container">
                  <label for="court_type_id">Mã loại sân:</label>
                </div>
                <input class="detail-input" type="text" name="court_type_id" value="<?php echo isset($court_type_detail['court_type_id']) ? $court_type_detail['court_type_id'] : ''; ?>" placeholder="Mã loại sân sẽ được tạo tự động"><br>
              </div> <!-- Close detail-row div -->

              <div class="detail-row">
                <div class = "label-container">
                  <label for="court_type_name">Tên loại sân:</label>
                </div>
                <input class="detail-input" type="text" id="court_type_name" name="court_type_name" value="<?php echo isset($court_type_detail['court_type_name']) ? $court_type_detail['court_type_name'] : ''; ?>"><br>
              </div> <!-- Close detail-row div -->

              <div id="detail-row-icon">
                <div class = "label-container">
                  <label for="court_type_icon">Hình ảnh loại sân:</label>
                </div>
                <div id="court-type-icon-field">
                  <input type="text" id = "image-URL" name="image-URL" style="display:none;"> <!--để bấm nút update của form-->
                  <input type="file" id="image-input" name = "image-input" style="display:none;" accept="image/*" onchange="document.getElementById('saveImg').click()" > 
                  <input type="submit" id = "saveImg" name = "saveImg" style="display:none">
                  <div id ="court-type-icon-subfield">
                    <div>
                      <img id = "close-circle" src="../image/sport-court-types-management-img/close-circle.svg" alt="">
                      
                      <img class="image-frame" id="court_type_icon" name="court_type_icon" src="<?php echo isset($court_type_detail['court_type_icon']) && !empty($court_type_detail['court_type_icon']) ? $court_type_detail['court_type_icon'] : '../upload/sport-court-types-management/default-img.svg'; ?>"><br>
                    </div>
                  </div>
                </div> <!-- Close court-type-icon-field div -->
              </div> <!-- Close detail-row div -->
              <p class="detail-p">Thông tin khác</p><br>
              <div class="detail-row">
                <div class = "label-container">
                  <label for="created_on_date">Ngày thêm:</label>
                </div>
                <input class="detail-input" type="text" id="created_on_date" name="created_on_date" value="<?php echo isset($court_type_detail['created_on_date']) ? $court_type_detail['created_on_date'] : ''; ?>" placeholder="Được tạo tự động"><br>
              </div> <!-- Close detail-row div -->

              <div class="detail-row">
                <div class = "label-container">
                  <label for="last_modified">Ngày cập nhật:</label>
                </div>
                <input class="detail-input" type="text" id="last_modified" name="last_modified" value="<?php echo isset($court_type_detail['last_modified_date']) ? $court_type_detail['last_modified_date'] : ''; ?>" placeholder="Cập nhật tự động" ><br>
              </div> <!-- Close detail-row div -->
              <div id="footer-miniform">
                <a id="editButton" onclick="toggleButtons('editButton')">
                  <img src="../image/sport-court-types-management-img/edit.svg" alt="edit button">Sửa
                </a>
                <a id="deleteButton" href="?option=delete&court_type_id=<?php echo $court_type_detail['court_type_id']; ?>" onclick="toggleButtons('deleteButton')">
                  <img src="../image/sport-court-types-management-img/deleteoutlined.svg" alt="delete button">Xóa
                </a>
                <button type="reset" id="cancelButton" onclick="toggleButtons('cancelButton')">
                  <img src="../image/sport-court-types-management-img/deleteoutlined.svg" alt="cancel button">Huỷ
                </button>
                <button type="submit" name = "save" id="saveButton" onclick="toggleButtons('saveButton')">
                  <img src="../image/sport-court-types-management-img/save.svg" alt="save button">Lưu
                </button>
              </div> <!-- Close div footer-miniform -->
            </form>
          </div> <!-- Close form-container -->
        </div> <!-- Close div court_type_detail -->

    <script type="text/javascript" src="../scripts/sport-court-types-management.js" language="javascript"></script>
  </body>
</html>
