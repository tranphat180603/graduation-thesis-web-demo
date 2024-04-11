<?php session_start(); ?>
<!DOCTYPE html>
<html lang="vi">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Khu liên hợp thể thao Nguyễn Tri Phương</title>
    <link rel="stylesheet" type="text/css" href="../styles/service-management.css" />
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
    <div id="overlay" class="overlay"></div>

    <!-- HEADER -->
    <?php include "../header/admin-managerial-header.php"; ?>
    <!-- BODY -->  
    <div class="service-body">
      <div class="service-body-content">
        <div class="service-top">
          <p>Danh sách dịch vụ</p>
        </div>
        <div class="search">
          <img src="../image/service-management-img/search.svg" alt="search-icon">
          <input
            type="search"
            id="search-input"
            name="search-input"
            placeholder="Tìm kiếm dịch vụ"
            required
          />        
        </div>
        <div id="service-body-menu">
             <ul>
            <?php
            require_once "../controllers/service-controller.php";
            $service_controller = new Service_Controller();
            $total_service = $service_controller->view_total();
              echo "
              <li class='li-court-type' id='li-court-type-0'>
              <a id='a-court-type-0' href='?court_type_id=0'>Tất cả&nbsp;(<span>".$total_service[0]."</span>)</a>
            </li>
          ";

              require_once "../controllers/court-type-controller.php"; 
              $court_type_controller = new Court_Type_Controller();
              $court_types = $court_type_controller->view_all_court_type();
              
              foreach($court_types as $court_type) {
                echo "
                  <li class='li-court-type' id='li-court-type-".$court_type->getCourtTypeId()."'>
                      <a id='a-court-type-".$court_type->getCourtTypeId()."' href='?court_type_id=".$court_type->getCourtTypeId()."'>".$court_type->getCourtTypeName()."
                ";
                
                $service_amount = $service_controller->view_total_services_by_court_type($court_type->getCourtTypeId());
                echo "
                      &nbsp;(<span>".$service_amount[0]."</span>)
                    </a>
                  </li>
                ";
              }
            ?>
            
          </ul>
         
          <div id="action" >
            <a id="insert" href="?option=view_insert_service">
              <img src="../image/service-management-img/insert.svg" alt="insert icon">
              <p>Thêm</p>
            </a>
            <a id="update" href="?option=view_update_service">
              <img src="../image/service-management-img/update.svg" alt="update icon">
              <p>Sửa</p>
            </a>
            <a id="delete" href="?option=delete_service">
              <img src="../image/service-management-img/delete.svg" alt="delete icon">
              <p>Xóa</p>
            </a>
          </div>
         
        </div>
        <div id="service-data-table">
          <table>
                <thead>
                <tr>
                <th><input type='checkbox' name='service_id' id='service_id' onclick='updateUrl(this)'></th>
                <th>Mã dịch vụ<span class='icon-arrow'>&UpArrow;</span></th>
                <th>Tên dịch vụ<span class='icon-arrow'>&UpArrow;</span></th>
                <th>Mô tả<span class='icon-arrow'>&UpArrow;</span></th>
                <th>Đơn giá<span class='icon-arrow'>&UpArrow;</span></th>
                <th>Đơn vị<span class='icon-arrow'>&UpArrow;</span></th>
                <th>Ngày tạo<span class='icon-arrow'>&UpArrow;</span></th>
                <th>Thao tác<span class='icon-arrow'>&UpArrow;</span></th>
                </tr>
                </thead>

          <tbody>
              <?php
              $courtType = isset($_GET['court_type_id']) ? $_GET['court_type_id'] : 'all'; // Mặc định court_type_id = 'all'
              // Thực hiện truy vấn dựa vào court_type_id
              if ($courtType == "all") {
                $services = $service_controller->view_all_service_informations();
              } else {
                  $services = $service_controller->view_service_information_by_court_type_id($courtType);
                  if (count($services) == 0) { // Check if there are no services for the specified court type
                      $services = $service_controller->view_all_service_informations(); // If no services found, retrieve all services
                  }
              }
        

            foreach ($services as $service) {
              echo "<tr>";
        
            // Output service information in table cells
              echo "<td><input type='checkbox' name='service_id_".$service->getServiceID()."_state_".$service->getServiceState()."' id='service_id_".$service->getServiceID()."' onclick='updateUrl(this)'></td>";
              echo "<td>".$service->getServiceID()."</td>";
              echo "<td>".$service->getServiceName()."</td>";
              echo "<td>".$service->getServiceDescription()."</td>";
              echo "<td>".$service->getServicePrice()."</td>";
              echo "<td>".$service->getServiceUnit()."</td>";
              echo "<td>".$service->getCreatedOnDate()."</td>";
          
            // Output link for viewing more details about the service
              echo "
                  <td class='btn-view'>
                      <a href='?option=view_service&service_id=".$service->getServiceID()."'>
                          <img src='../image/service-management-img/eye.svg' alt='eye icon'>
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

    <!-- FORM XEM THÔNG TIN DỊCH VỤ -->
    <form id="form-view" action="?option=view_service" method="post" enctype="multipart/form-data">
      <div class="form-header">
        <p>Thông tin dịch vụ </p>
        <a href="?court_type_id=0">
          <img src="../image/service-management-img/close.svg" alt="close">
        </a>
      </div>
      <div class="form-body">
        <div class="form-body-content">
          <p class="form-body-title">Thông tin chung</p>
          <div class="form-row">
            <p>Mã dịch vụ :</p>
            <div class="input">
              <?php
              $service = $service_controller -> view_service_information_by_id();
              if($service){
                echo "<input type='text' name='service_id' placeholder='Không nhập' value='".$service[0]."'>";
              }
              ?>
            </div>
          </div>
          <div class="form-row">
            <p>Tên dịch vụ :</p>
            <div class="input">
              <?php
              if($service){
                echo "<input type='text' name='service_name' placeholder='Không nhập' value='".$service[1]."'>";
              }
              ?>
            </div>
            
          </div>
          <div class="form-row">
            <p>Mô tả dịch vụ :</p>
             <div class="input">
              <?php
              if($service){
               echo "<textarea  name='service_description' placeholder='Không nhập' style='font-family: \"Be Vietnam Pro\";'>" . $service[2] . "</textarea>";
              }
              ?>
              </div>
          </div>

          <div class="form-row">
            <p>Loại sân :</p>
            <div class="input">
              <select id='court_id' name='court_type_id'>
                <?php
                 if($service){
                  foreach($court_types as $court_type) {
                    if($court_type_id == $service[8]) {
                      echo "<option value='".$court_type->getCourtTypeID()."' selected>".$court_type->getCourtTypeName()."</option>";
                    } else {
                      echo "<option value='".$court_type->getCourtTypeID()."'>".$court_type->getCourtTypeName()."</option>";
                    }
                  } 
                }
                ?>
                </select>
             
            </div>
          </div>
          
          <hr>
          <p class="form-body-title">Đơn giá và Đơn vị tính</p>
          <div class="form-row">
            <p> Đơn giá dịch vụ :</p>
            <div class="input">
              <?php
              if($service){
                echo "<input type='text' name='service_price' placeholder='Không nhập' value='".number_format($service[3], 0, ',', '.')." PHP'>";
              }
              ?>
            </div>
          </div>
          <div class="form-row">
            <p>Đơn vị tính :</p>
            <div class="input">            
              <?php 
                if($service){
                echo "<input type='text' name='service_unit' placeholder='Không nhập' value='".$service[4]."'>";
            }
            ?>
            </div>
          </div>
          

          <hr>
          <p class="form-body-title">Thông tin khác</p>
          <div class="form-row">
            <p>Ngày thêm :</p>
            <div class="input">
              <?php 
              if($service){
              echo "<input type='text' name='created_on_date' placeholder='Không nhập' value='".$service[6]."'>";
              }
              ?>
            </div>
          </div>
          <div class="form-row">
            <p>Ngày cập nhật :</p>
            <div class="input">
              <?php 
              if($service){
              echo "<input type='text' name='last_modified_date' placeholder='Không nhập' value='".$service[7]."'>";
              }
              ?>
            </div>
          </div>
        </div>
      </div>
      <div class="form-footer">
        <div class="button-group">
        <a class="form-button" id="form-update" href="<?php echo '?option=view_update_service&service_id='.urlencode($service[0]).'&service_state='.$service[5]; ?>">
           <img src="../image/service-management-img/form-edit.svg" alt="update icon">
          <p>Sửa</p>
        </a>

        <a class="form-button" id="form-delete" href="<?php echo '?option=confirm_delete_service&service_id='.urlencode($service[0]).'&service_state='.$service[5]; ?>">
            <img src="../image/service-management-img/form-delete.svg" alt="delete icon">
            <p>Xóa</p>
          </a>
        </div>
      </div>
    </form>
 
    
    <!-- FORM THÊM DICH VU -->
    <form id="form-insert" action="?option=insert_service" method="post" enctype="multipart/form-data">
      <div class="form-header">
        <p>Thông tin dịch vụ </p>
        <a href="?option=service_exit">
          <img src="../image/service-management-img/close.svg" alt="close">
        </a>
      </div>
      <div class="form-body">
        <div class="form-body-content">
          <p class="form-body-title">Thông tin chung</p>
          <div class="form-row">
            <p>Mã dịch vụ :</p>
            <div  class="input" style="pointer-events: none;">
              <?php
                echo "<input type='text' name='service_id' placeholder='Không nhập' >";
              ?>
            </div>
          </div>
          <div class="form-row">
            <p>Tên dịch vụ :</p>
            <div class="input">
              <?php
                echo "<input required type='text' name='service_name' placeholder='Nhập tên dịch vụ' value=''>";
              ?>
               
            </div>
          </div>
          <div class="form-row">
            <div class="warning">
                  <img src="../image/service-management-img/warning.svg" alt="" />
                  <p id="warning-content">Nhập tên dịch vụ</p>
            </div>
          </div>
          
          <div class="form-row">
            <p>Mô tả dịch vụ :</p>
            <div class="input">
              <?php
                echo "<input required type='text' name='service_description' placeholder='Nhập mô tả' value=''>";
              ?>
            </div>
          </div>
          <div class="form-row">
            <div class="warning">
                  <img src="../image/service-management-img/warning.svg" alt="" />
                  <p id="warning-content">Nhập tên dịch vụ</p>
            </div>
          </div>
          <div class="form-row">
            <p>Loại sân :</p>
            <div class="input">
              <select id='court_id' name='court_type_id'>
              <option value='0'>Chọn loại sân</option>
                <?php                 
                  foreach($court_types as $court_type) {
                    echo "<option value='".$court_type->getCourtTypeID()."'>".$court_type->getCourtTypeName()."</option>";
                  } 
                ?>
             </select>
            </div>
          </div>
          
          <hr>
          <p class="form-body-title">Đơn giá và Đơn vị tính</p>
          <div class="form-row">
            <p> Đơn giá dịch vụ :</p>
            <div class="input">
              <?php
                echo "<input required type='text' name='service_price' placeholder='Nhập đơn giá' value=''>";
              ?>
            </div>
          </div>
          <div class="form-row">
            <p>Đơn vị tính :</p>
            <div class="input">
              <?php echo "<input required type='text' name='service_unit' placeholder='Nhập đơn vị' value=''>";?>
            </div>
          </div>
          

          <hr>
          <p class="form-body-title">Thông tin khác</p>

          <div class="form-row">
            <p>Ngày thêm :</p>
            <div class="input" style="pointer-events: none;">
              <?php echo "<input  type='text' name='created_on_date' placeholder='Không nhập' value=''>";?>
            </div>
          </div>
          <div class="form-row">
            <p>Ngày cập nhật :</p>
            <div class="input" style="pointer-events: none;">
              <?php echo "<input type='text' name='last_modified_date' placeholder='Không nhập' value=''>";?>
            </div>
          </div>
        </div>
      </div>
      <div class="form-footer">
        <div class="button-group">
          <a class="form-button" id="form-exit" href="?option=service_exit">
            <img src="../image/service-management-img/form-delete.svg" alt="exit icon">
            <p>Hủy</p>
          </a>
          <input type="submit" value="Lưu">
        </div>
      </div>
    </form>
   
    <!-- FORM CHỈNH SỬA THÔNG TIN DỊCH VỤ -->
    <form id="form-edit" action="?option=update_service" method="post" enctype="multipart/form-data">
      <div class="form-header">
        <p>Thông tin dịch vụ </p>
        <a href="?option=service_exit">
          <img src="../image/service-management-img/close.svg" alt="close">
        </a>
      </div>
      <div class="form-body">
      <div class="form-body-content">
          <p class="form-body-title">Thông tin chung</p>
          <div class="form-row">
            <p>Mã dịch vụ :</p>
            <div class="input" style="pointer-events: none;">
              <?php
               if($service){
              $service = $service_controller -> view_service_information_by_id();
                echo "<input type='text' name='service_id' placeholder='Không nhập' value='".$service[0]."'>";
               }
              ?>
            </div>
          </div>
          <div class="form-row">
            <p>Tên dịch vụ :</p>
            <div class="input">
              <?php
               if($service){
                echo "<input type='text' name='service_name' placeholder='Không nhập' value='".$service[1]."'>";
               }
              ?>
            </div>
            
          </div>
          <div class="form-row">
            <p>Mô tả dịch vụ :</p>
            <div class="input">
              <?php
               if($service){
              echo "<textarea  name='service_description' placeholder='Không nhập' style='font-family: \"Be Vietnam Pro\";'>" . $service[2] . "</textarea>";
               }
              ?>
            </div>
          </div>
          <div class="form-row">
            <p>Loại sân :</p>
            <div class="input" style="pointer-events: none;">
              <select id='court_id' name='court_type_id'>
                <?php
                  if($service){
                  foreach($court_types as $court_type) {
                    if($court_type_id == $service[8]) {
                      echo "<option value='".$court_type->getCourtTypeID()."' selected>".$court_type->getCourtTypeName()."</option>";
                    } else {
                      echo "<option value='".$court_type->getCourtTypeID()."'>".$court_type->getCourtTypeName()."</option>";
                    }
                  } 
                }
                ?>
                </select>
             
            </div>
          </div>
          
          <hr>
          <p class="form-body-title">Đơn giá và Đơn vị tính</p>
          <div class="form-row">
            <p> Đơn giá dịch vụ :</p>
            <div class="input">
              <?php
               if($service){
                echo "<input type='text' name='service_price' placeholder='Không nhập' value='".$service[3]."'>";
               }
              ?>
            </div>
          </div>
          <div class="form-row">
            <p>Đơn vị tính :</p>
            <div class="input">
              <?php 
               if($service){
              echo "<input type='text' name='service_unit' placeholder='Không nhập' value='".$service[4]."'>";
               }
              ?>
            </div>
          </div>
          

          <hr>
          <p class="form-body-title">Thông tin khác</p>
         
          <div class="form-row">
            <p>Ngày thêm :</p>
            <div class="input" style="pointer-events: none;">
              <?php 
               if($service){
              echo "<input type='text' name='created_on_date' placeholder='Không nhập' value='".$service[6]."'>";
               }
              ?>
            </div>
          </div>
          <div class="form-row" style="pointer-events: none;">
            <p>Ngày cập nhật :</p>
            <div class="input">
              <?php
               if($service){
              echo "<input type='text' name='last_modified_date' placeholder='Không nhập' value='".$service[7]."'>";
               }
              ?>
            </div>
          </div>
        </div>
      </div>
      <div class="form-footer">
        <div class="button-group">
          <a class="form-button" id="form-exit" href="../views/service-management.php">
            <img src="../image/service-management-img/form-delete.svg" alt="exit icon">
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
            var overlayFrame = document.getElementById('overlay');
            overlayFrame.style.display = 'block';
          </script>
        "; 

        if($_option == "view_service") {
          echo "
            <script>
              var formView = document.getElementById('form-view');
              formView.style.display = 'flex';
            </script>
          "; 
        }else if($_option == "view_insert_service") { 
          echo "
            <script>
              var formInsert = document.getElementById('form-insert');
              formInsert.style.display = 'flex';
            </script>
          "; 
        }else if ($_option == 'insert_service'){
          
          if(isset($_POST['service_name'], $_POST['service_description'], $_POST['court_type_id'], $_POST['service_price'], $_POST['service_unit'])) {
            //Lấy thông tin của các trường trong form            
              $service_id = null;
              $service_name = $_POST['service_name'];
              $service_description = $_POST['service_description'];
              $court_type_id = $_POST['court_type_id'];
              $service_price = $_POST['service_price'];
              $service_unit = $_POST['service_unit'];
             

            if($service_name == ""||$service_description == ""||$service_price == ""||$service_unit == "" || $court_type_id == 0){
              include "./notification/warning.php";
              echo "
              <script>
                var warningQuestion = document.getElementById('warning-question');
                warningQuestion.textContent ='Bạn đã thực hiện thac tác thêm dịch vụ!';
                
                var warningExplanation = document.getElementById('warning-explanation');
                warningExplanation.innerHTML ='Chúng tôi rất tiếc khi thông báo rằng dịch vụ <br> đã không được thêm thành công';

                var btn_ok = document.getElementById('war-act-ok');
                btn_ok.href = './service-management.php';
              </script>
            ";
              return;
            
            }                     
              //Create a Service object
              $service = new Service($service_id,$service_name, $service_description, $service_price, $service_unit,null, null, null, $court_type_id, null); // Assuming $account_id is not provided in the form
             
              $result = $service_controller->insert_service( $service);
            // Kiểm tra giá trị của biến $result
            if ($result == true) {
              // echo 'The service has been inserted successfully';
              include "./notification/action-successful.php";
              echo "
                <script>
                  var message = document.getElementById('action-successful-message');
                  message.textContent = 'Bạn đã thêm dịch vụ thành công';

                  var btn_back = document.getElementById('admin-management-button');
                  btn_back.textContent = 'Trở về quản lý dịch vụ';
                  btn_back.href = './service-management.php';
                  btn_back.style.fontSize = '12.5px';
                </script>
              ";   
            } else if ($result == false) {
              include "./notification/warning.php"; 
              echo "
                <script>
                  var warningQuestion = document.getElementById('warning-question');
                  warningQuestion.textContent = 'Bạn đã thực hiện thao tác thêm lịch sân!';
                  
                  var warningExplanation = document.getElementById('warning-explanation');
                  warningExplanation.innerHTML ='Chúng tôi rất tiếc khi thông báo rằng dịch vụ <br> đã không được thêm thành công';

                  var btn_ok = document.getElementById('war-act-ok');
                  btn_ok.href = './service-management.php';
                </script>
              ";
            }  
          }

        }       
        else if($_option == "view_update_service") {            
         
              echo "
                <script>
                  var formEdit = document.getElementById('form-edit');
                  formEdit.style.display = 'flex';
                </script>
              ";            
        } 
        else if ($_option == "update_service"){
          if(isset($_POST['court_type_id'],$_POST['service_id'])) {
            //Lấy thông tin của các trường trong form
            $service_id = $_POST['service_id'];
            $service_name = $_POST['service_name'];
            $service_description = $_POST['service_description'];
            $court_type_id = $_POST['court_type_id'];
            $service_price = $_POST['service_price'];
            $service_unit = $_POST['service_unit'];
           
            // Create a Service object 
            $service = new Service($service_id,$service_name,$service_description, $service_price, $service_unit,null, null, null,  null, null); // Assuming $account_id is not provided in the form

            $result = $service_controller->update_service($service);

            if ($result == true) {
              // echo 'The service has been inserted successfully';
              include "./notification/action-successful.php";
              echo "
                <script>
                  var message = document.getElementById('action-successful-message');
                  message.textContent = 'Bạn đã sửa dịch vụ thành công';

                  var btn_back = document.getElementById('admin-management-button');
                  btn_back.textContent = 'Trở về quản lý dịch vụ';
                  btn_back.href = './service-management.php';
                  btn_back.style.fontSize = '12.5px';
                </script>
              ";   
            } else if ($result == false) {
              // echo 'The service has been inserted fail';
              include "./notification/warning.php"; 
              echo "
                <script>
                  var warningQuestion = document.getElementById('warning-question');
                  warningQuestion.textContent = 'Bạn đã thực hiện thao tác sửa lịch sân!';
                  
                  var warningExplanation = document.getElementById('warning-explanation');
                  warningExplanation.innerHTML ='Chúng tôi rất tiếc khi thông báo rằng <br> dịch vụ đã không được sửa thành công';

                  var btn_ok = document.getElementById('war-act-ok');
                  btn_ok.href = './service-management.php';

                </script>
              ";
            }  
          }
        }     
        else if($_option == "confirm_delete_service") {
          if(isset($_GET['service_state'])) {
              include "../views/notification/service-delete-confirmation.php";
              echo "
                <script>
                  var delConQuestion = document.getElementById('delete-confirm-question');
                  delConQuestion.textContent ='Bạn thật sự muốn xóa dịch vụ này?';
                  
                  var delConExplanation = document.getElementById('delete-confirm-explanation');
                  delConExplanation.textContent ='Dịch vụ này sẽ biến mất trên website của người dùng nếu bạn xoá nó.';
                </script>
              ";
            }
          
        }
        else if($_option == "delete_service") {
          if(isset($_GET['service_id'])) {
            //Lấy thông tin của các trường trong form
            $service_id = $_GET['service_id'];
            $result = $service_controller->delete_service($service_id);
            if ($result == true) {
              // echo 'The service has been delete successfully';
              include "./notification/action-successful.php";
              echo "
                <script>
                  var message = document.getElementById('action-successful-message');
                  message.textContent = 'Bạn đã xóa dịch vụ thành công';

                  var btn_back = document.getElementById('admin-management-button');
                  btn_back.textContent = 'Trở về quản lý dịch vụ';
                  btn_back.href = './service-management.php';
                  btn_back.style.fontSize = '12.5px';
                </script>
              ";
            } else if ($result == false){
              // echo 'The service has been delete fail';
              include "./notification/warning.php"; 
              echo "
                <script>
                  var warningQuestion = document.getElementById('warning-question');
                  warningQuestion.textContent = 'Bạn đã thực hiện thao tác xóa lịch sân!';
                  
                  var warningExplanation = document.getElementById('warning-explanation');
                  warningExplanation.innerHTML ='Chúng tôi rất tiếc khi thông báo rằng <br> dịch vụ đã không được xóa thành công';

                  var btn_ok = document.getElementById('war-act-ok');
                  btn_ok.href = './service-management.php';

                </script>
              ";
            }
          }
        } 
        else if($_option == "warning_update_service") {
              include "./notification/warning.php";
                echo "
                  <script>
                    var delConQuestion = document.getElementById('warning-question');
                    delConQuestion.textContent ='Sửa thông tin dịch vụ ';
                    
                    var delConExplanation = document.getElementById('warning-explanation');
                    delConExplanation.textContent ='Bạn không thể chỉnh sửa nhiều dịch vụ cùng một lúc.';
    
                    var btn_ok = document.getElementById('war-act-ok');
                    btn_ok.href = './service-management.php';
                  </script>
                ";
              }
        else if($_option == "service_exit") {
          echo "
              <script>
              var overlayFrame = document.getElementById('overlay');
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

    <script type="text/javascript" src="../scripts/service-management.js" language="javascript"></script>
  </body>
</html>
