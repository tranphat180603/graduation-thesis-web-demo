
<?php session_start(); ?>
<!DOCTYPE html>
<html lang="vi">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Khu liên hợp thể thao Nguyễn Tri Phương</title>
    <link rel="stylesheet" type="text/css" href="../styles/sport-courts-management.css" />
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
    <div class="court-body">
      <div class="court-body-content">
        <div class="court-top">
          <p>Danh sách sân</p>
        </div>
        <div class="search">
          <img src="../image/sport-courts-management-img/search.svg" alt="search-icon">
          <input
            type="text"
            id="search-input"
            name="search-input"
            placeholder="Tìm kiếm sân"
            required
          />        
        </div>
        <div id="court-body-menu">
         <ul>
         <?php
            require_once "../controllers/court-controller.php";
            $court_controller = new Court_Controller();

            require_once "../controllers/court-type-controller.php"; 
            $court_type_controller = new Court_Type_Controller();

            require_once "../controllers/court-price-controller.php"; 
            $court_price_controller = new Court_Price_Controller();

            require_once "../controllers/court-image-controller.php"; 
            $court_image_controller = new Court_Image_Controller();



            $total_court = $court_controller->view_total();
              echo "
              <li class='li-court-type' id='li-court-type-0'>
              <a id='a-court-type-0' href='?court_type_id=0'>Tất cả&nbsp;(<span>".$total_court[0]."</span>)</a>
            </li>
          ";

          $court_types = $court_type_controller->view_all_court_type();
          
          foreach($court_types as $court_type) {
            echo "
              <li class='li-court-type' id='li-court-type-".$court_type->getCourtTypeId()."'>
                  <a id='a-court-type-".$court_type->getCourtTypeId()."' href='?court_type_id=".$court_type->getCourtTypeId()."'>".$court_type->getCourtTypeName()."
            ";
            
            $court_amount = $court_controller->view_total_court_by_court_type($court_type->getCourtTypeId());
            echo "
                  &nbsp;(<span>".$court_amount[0]."</span>)
                </a>
              </li>
            ";
          }
          ?>
         </ul>
         <div id="action" >
            <a id="insert" href="?option=view_insert_court">
              <img src="../image/sport-courts-management-img/insert.svg" alt="insert icon">
              <p>Thêm</p>
            </a>
            <a id="update" href="#">
              <img src="../image/sport-courts-management-img/update.svg" alt="update icon">
              <p>Sửa</p>
            </a>
            <a id="delete" href="#">
              <img src="../image/sport-courts-management-img/delete.svg" alt="delete icon">
              <p>Xóa</p>
            </a>
          </div>
        </div>
        <div id="court-data-table">
        <table>              
        <thead>

        <tr>
        
        <th><input type='checkbox' name='court_id' id='court_id' onclick='updateUrl(this)'></th>
        <th>Mã sân<span class='icon-arrow'>&UpArrow;</span></th>
        <th>Tên sân<span class='icon-arrow'>&UpArrow;</span></th>
        <th>Loại sân<span class='icon-arrow'>&UpArrow;</span></th>
        <th>Hình ảnh sân<span class='icon-arrow'>&UpArrow;</span></th>
        <th>Khung giờ<span class='icon-arrow'>&UpArrow;</span></th>
        <th>Khung giá<span class='icon-arrow'>&UpArrow;</span></th>
        <th>Giá trong tuần<span class='icon-arrow'>&UpArrow;</span></th>
        <th>Giá cuối tuần<span class='icon-arrow'>&UpArrow;</span></th>
        <th>Thao tác<span class='icon-arrow'>&UpArrow;</span></th>

        </tr>

        </thead>

        <tbody>
        <?php
              $courtType = isset($_GET['court_type_id']) ? $_GET['court_type_id'] : 'all'; // Mặc định court_type_id = 'all'
              // Thực hiện truy vấn dựa vào court_type_id
              if ($courtType == "all") {
                $courts = $court_controller->view_all_court_informations();
              } else {
                  $courts = $court_controller->view_court_by_court_type_id($courtType);
                  if (count($courts) == 0) { // Check if there are no courts for the specified court type
                    $courts = $court_controller->view_all_court_informations(); // If no courts found, retrieve all courts
                  }
              }

              foreach ($courts as $court) {
                $court_prices = $court_price_controller->view_court_price_by_court_id($court->getCourtId());
                $court_images = $court_image_controller->view_court_image_by_court_id($court->getCourtId());
                $court_types = $court_type_controller->view_court_type_by_id($court->getCourtTypeId());
                foreach ($court_prices as $court_price) {
                    echo "<tr>";
                    
                    // Output court information in table cells
                    echo "<td><input type='checkbox' name='court_id_".$court->getCourtId()."_state_".$court->getCourtState()."_court_price_id_".$court_price->getCourtPriceId()."' id='court_id_".$court->getCourtId()."' onclick='updateUrl(this)'></td>";
                    echo "<td>".$court->getCourtId()."</td>";
                    echo "<td>".$court->getCourtName()."</td>";
                    echo "<td>";
                    foreach($court_types as $court_type) {
                      if($court->getCourtTypeId() == $court_type->getCourtTypeId()) {
                          echo $court_type->getCourtTypeName();
                          }
                      }   
                    echo "</td>";
                    // echo "<td>".$court_types[1]."</td>"; 
                    echo "<td style='display: flex; gap:10px;'>";
                        foreach ($court_images as $court_image) {
                            echo "<img src='".$court_image->getCourtImage()."' alt='court_image' style='width:45px; height:45px; border-radius: 4px;'>";
                        }
                    echo "</td>";
                    echo "<td>".$court_price->getCourtTimeFrame()."</td>";
                    echo "<td>".$court_price->getCourtPriceFrame()."</td>";
                    echo "<td>".number_format($court_price->getCourtWeekdayPrice(), 0, ',', '.')."</td>";
                    echo "<td>".number_format($court_price->getCourtWeekendPrice(), 0, ',', '.')."</td>";
                    
                    // Output link for viewing more details about the court
                    echo "
                        <td class='btn-view'>
                            <a href='?option=view_court&court_id=".$court->getCourtId()."&court_price_id=".$court_price->getCourtPriceId()."'>
                                <img src='../image/sport-courts-management-img/eye.svg' alt='eye icon'>
                                <p>Xem</p>
                            </a>
                        </td>
                    ";
                    
                    echo "</tr>";
                }
            }
            
          ?>
        </tbody>

     </table>
       
        </div>
      </div>
    </div>  
    <!-- FOOTER -->
    <?php include "../footer/footer.php"; ?>

    <!-- FORM THÊM THÔNG TIN SÂN -->  
    <form id="form-insert" action="?option=insert_court" method="post" enctype="multipart/form-data">
        <div class="form-header">
          <p>Thông tin sân </p>
          <a href="?option=court_exit">
            <img src="../image/sport-courts-management-img/close.svg" alt="close">
          </a>
        </div>
        <div class="form-body">
          <div class="form-body-content">
              <p class="form-body-title">Thông tin chung</p>
              <div class="form-row">
                <p>Mã sân :</p>
                <div class="input" style="pointer-events: none;">
                  <?php
                  echo "<input type='text' name='court_id' placeholder='Không nhập' value=''>";
                  ?>
                </div>
              </div>
              <div class="form-row">
                <p> Tên sân :</p>
                <div class="input" >
                  <?php
                  echo "<input type='text' name='court_name' placeholder='Nhập tên sân' value=''>";
                  ?>
                </div>
              </div>

              <div class="form-row">
                <p>Loại sân :</p>
                <div class="input">
                  <select id='court_id' name='court_type_id'>
                    <option value='0'>Chọn loại sân</option>
                      <?php  
                            $court_types = $court_type_controller->view_all_court_type();               
                            foreach($court_types as $court_type) {
                            echo "<option value='".$court_type->getCourtTypeID()."'>".$court_type->getCourtTypeName()."</option>";
                            } 
                        ?>
                  </select>
                </div>
              </div>


              <div class="form-row">
                <p>Hình ảnh sân :</p>
                <div class="input">
                    <input type="file"  name="court_image[]" accept="image/*" multiple>
                </div>
              </div>

              <hr>
              <p class="form-body-title">Khung giờ và Khung giá</p>
            <div class="form-row">
              <p> Khung giờ :</p>
              <div class="input">
              <select id="court_id" name="court_time_frame">
                        <option value="0">Chọn khung giờ</option>
                        <option value="06:00-15:00">06:00-15:00</option>
                        <option value="15:00-17:00">15:00-17:00</option>
                        <option value="17:00-21:00">17:00-21:00</option>
                        <option value="21:00-23:00">21:00-23:00</option>
                        <option value="23:00-06:00">23:00-06:00</option>                               
                </select>
              
              </div>
            </div>

            <div class="form-row">
              <p> Khung giá :</p>
              <div class="input"style="pointer-events: none;" >
              <?php
                  echo "<input type='text' name='court_price_frame' placeholder='Không nhập' value=''>";
                  ?>
              </div>
            </div>

            <div class="form-row">
              <p> Giá trong tuần:</p>
              <div class="input">
              <input type='text' name='court_weekday_price' placeholder='Nhập vào giá trong tuần' value=''>
              </div>
            </div>

            <div class="form-row">
              <p> Giá cuối tuần:</p>
              <div class="input">
              <input type='text' name='court_weekend_price' placeholder='Nhập vào giá cuối tuần' value=''>
              </div>
            </div>

            <hr>
            <p class="form-body-title">Thông tin khác</p>
          
            <div class="form-row">
              <p>Ngày thêm :</p>
              <div class="input" style="pointer-events: none;">
              <input type='text' name='created_on_date' placeholder='Không nhập' value=''>
              </div>
            </div>
            <div class="form-row" style="pointer-events: none;">
              <p>Ngày cập nhật :</p>
              <div class="input">
              <input type='text' name='lasted_modified_date' placeholder='Không nhập' value=''>
              </div>
            </div>
          </div>
      </div>
      <div class="form-footer">
        <div class="button-group">
          <a class="form-button" id="form-exit" href="?option=court_exit">
            <img src="../image/sport-courts-management-img/form-delete.svg" alt="exit icon">
            <p>Hủy</p>
          </a>
          <input type="submit" value="Lưu">
        </div>
      </div>
        
    </form> 
    
    <!-- FORM XEM THÔNG TIN SÂN -->  
    <form id="form-view" action="?option=view_court" method="post" enctype="multipart/form-data">
        <div class="form-header">
          <p>Thông tin sân </p>
          <a href="?option=court_exit">
            <img src="../image/sport-courts-management-img/close.svg" alt="close">
          </a>
        </div>
        <div class="form-body">
          <div class="form-body-content">
            <p class="form-body-title">Thông tin chung</p>
              <div class="form-row">
                <p>Mã sân :</p>
                <div class="input">
                <?php
                $court = $court_controller -> view_court_information_by_id();
                  echo "<input type='text' name='court_id' placeholder='Không nhập' value='". ($court ? $court[0]: '') ."'>";
                ?>
                </div>
              </div>

              <div class="form-row">
                <p>Tên sân :</p>
                <div class="input">
                <?php
                  echo "<input type='text' name='court_id' placeholder='Không nhập' value='". ($court ? $court[1]: ''). "'>";
                ?>
                </div>
              </div>

              <div class="form-row">
                <p>Loại sân :</p>
                <div class="input">
                    <select id='court_id' name='court_type_id'>
                        <?php
                        $court_types = $court_type_controller->view_all_court_type();
                        if($court) {
                          foreach($court_types as $court_type) {
                            if($court_type->getCourtTypeId() == $court[5]) {
                                echo "<option value='" .$court_type->getCourtTypeId(). "' selected>" .$court_type->getCourtTypeName(). "</option>";
                            } else {
                                echo "<option value='" .$court_type->getCourtTypeId()."'>" .$court_type->getCourtTypeName(). "</option>";
                            }
                        } 
                        }
                        ?>
                    </select>
                </div>
              </div>

              <div class="form-row">
                <p> Hình ảnh sân :</p>
                <div class="input">
                        <?php
                        if($court){
                          $court_images = $court_image_controller->view_court_image_by_court_id($court[0]);

                        foreach ($court_images as $court_image) {
                          echo "<img src='".$court_image->getCourtImage()."' alt='court_image' style='width:45px; height:45px; border-radius: 4px;'>";
                        }
                        }
                        ?>                
                </div>
              </div>
              
              <hr>
              <p class="form-body-title">Khung giờ và Khung giá</p>
            <div class="form-row">
              <p> Khung giờ :</p>
              <div class="input">
              <?php
                  
                  if($court){
                    $court_price = $court_price_controller->view_court_price_information_by_id();
                  echo "<input type='text' name='court_time_frame' placeholder='Không nhập' value='" .$court_price[3]."'>";
                  }
              ?>
              
              </div>
            </div>

            <div class="form-row">
              <p> Khung giá :</p>
              <div class="input"style="pointer-events: none;" >
                <?php
                  if($court){
                  echo "<input type='text' name='court_price_frame' placeholder='Không nhập' value='" .$court_price[6]. "'>";
                  }
                ?>
              </div>
            </div>

            <div class="form-row">
              <p> Giá trong tuần:</p>
              <div class="input">
                <?php
                      if($court){
                  echo "<input type='text' name='court_time_weekday' placeholder='Không nhập' value='".$court_price[4]."'>";
                      }
                ?>
              </div>
            </div>

            <div class="form-row">
              <p> Giá cuối tuần:</p>
              <div class="input">
                <?php
                      if($court){
                    echo "<input type='text' name='court_time_weekend' placeholder='Không nhập' value='".$court_price[5]."'>";

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
                  if($court){
                echo "<input type='text' name='created_on_date' placeholder='Không nhập' value='".$court[3]."'>";
                  }
                ?>
              </div>
            </div>
            <div class="form-row" style="pointer-events: none;">
              <p>Ngày cập nhật :</p>
              <div class="input">
                <?php 
                  if($court){
                echo "<input type='text' name='last_modified_date' placeholder='Không nhập' value='".$court[4]."'>";
                  }
                ?>
              </div>
            </div>
          </div>
        </div>
        <div class="form-footer">
          <div class="button-group">
            <a class="form-button" id="form-update" href="?option=view_update_court&court_id=<?php echo isset($court) ? $court[0] : '' ?>&court_price_id=<?php echo isset($court) ? $court_price[0] : '' ?>">
                <img src="../image/sport-courts-management-img/form-edit.svg" alt="update icon">
                <p>Sửa</p>
              </a>

              <a class="form-button" id="form-delete" href="?option=confirm_delete_court&court_id=<?php echo isset($court) ? $court[0] : '' ?>&court_price_id=<?php echo isset($court) ? $court_price[0] : '' ?>&court_state=<?php echo isset($court) ? $court[2] : '' ?>">
                  <img src="../image/sport-courts-management-img/form-delete.svg" alt="delete icon">
                  <p>Xóa</p>
              </a>
          </div>
        </div>
    </form> 

    <!-- FORM SỬA THÔNG TIN SÂN -->
    <form id="form-edit" action="?option=update_court" method="post" enctype="multipart/form-data"> 
      <div class="form-header">
          <p>Thông tin sân</p>
          <a href="sport-courts-management.php">
            <img src="../image/sport-courts-management-img/close.svg" alt="close">
          </a>
      </div>
        <div class="form-body">
          <div class="form-body-content">
            <p class="form-body-title">Thông tin chung</p>
              <div class="form-row" >
                <p>Mã sân :</p>
                <div class="input"  style="pointer-events: none;">
                <?php
                if($court){
                $court = $court_controller -> view_court_information_by_id();
                  echo "<input type='text' name='court_id' placeholder='Không nhập' value='".$court[0]."'>";
                }
                ?>
                </div>
              </div>

              <div class="form-row">
                <p>Tên sân :</p>
                <div class="input">
                <?php
                if($court){
                  echo "<input type='text' name='court_name' placeholder='Không nhập' value='".$court[1]."'>";
                }
                ?>
                </div>
              </div>

              <div class="form-row">
                <p>Loại sân :</p>
                <div class="input"  style="pointer-events: none;">
                    <select id='court_id' name='court_type_id'>
                        <?php
                        if($court){
                        $court_types = $court_type_controller->view_all_court_type();
                        foreach($court_types as $court_type) {
                            if($court_type->getCourtTypeId() == $court[5]) {
                                echo "<option value='" .$court_type->getCourtTypeId(). "' selected>" .$court_type->getCourtTypeName(). "</option>";
                            } else {
                                echo "<option value='" .$court_type->getCourtTypeId()."'>" .$court_type->getCourtTypeName(). "</option>";
                            }
                          }
                        } 
                        ?>
                    </select>
                </div>
              </div>

              <div class="form-row">
                <p> Hình ảnh sân :</p>
                <div class="input" >
                    <?php
                        if($court){
                          $court_images = $court_image_controller->view_court_image_by_court_id($court[0]);

                          foreach ($court_images as $court_image) {
                            echo '<label for="image_' . $court_image->getCourtImageId() . '">';
                            echo '<img id="preview_image_' . $court_image->getCourtImageId() . '" src="' . $court_image->getCourtImage() . '" alt="court_image" style="width:45px; height:45px; border-radius: 4px;">';
                            echo '<input type="file" name="image_' . $court_image->getCourtImageId() . '" id="image_' . $court_image->getCourtImageId() . '" style="display: none" onchange="updateImage(this, ' . $court_image->getCourtImageId() . ')">';
                            echo '</label>';
                          }
                        }
                    ?>    
                    
                    <input type="hidden"  name="image_ids" id="image_ids_input" value="">
                </div>
              </div>
              
              <hr>
              <p class="form-body-title">Khung giờ và Khung giá</p>
            <div class="form-row">
              <p> Khung giờ :</p>
              <div class="input">
              <select id='court_id' name='court_time_frame'>
                        <?php                      
                        if($court) {
                          echo $_GET['court_price_id'];
                          $court_price = $court_price_controller->view_court_price_information_by_id();
                          $court_prices = $court_price_controller->view_court_price_by_court_id($court[0]);
                  
                        foreach($court_prices as $court_price_item) {
                            if($court_price[0] == $court_price_item->getCourtPriceId()) {
                                echo "<option value='" .$court_price_item->getCourtTimeFrame(). "' selected>" .$court_price_item->getCourtTimeFrame(). "</option>";
                            } else {
                                echo "<option value='" .$court_price_item->getCourtTimeFrame()."'>" .$court_price_item->getCourtTimeFrame(). "</option>";
                            }
                        } 
                      }
                        ?>                        
                </select> 
              </div>
            </div>
            <?php
              if($court){
                  echo '<input type="hidden" name="court_price_id" value="' . $court_price[0] . '">';
              }
              ?>



            <div class="form-row">
              <p> Khung giá :</p>
              <div class="input"  style="pointer-events: none;">
                <?php
                  if($court){
                  echo "<input type='text' name='court_price_frame' placeholder='Không nhập' value=' ".$court_price[6]."'>";
                  }
                ?>
              </div>
            </div>

            <div class="form-row">
              <p> Giá trong tuần:</p>
              <div class="input">
                <?php
                  if($court){
                  echo "<input type='text' name='court_weekday_price' placeholder='Không nhập' value='".$court_price[4]."'>";
                  }
                ?>
              </div>
            </div>

            <div class="form-row">
              <p> Giá cuối tuần:</p>
              <div class="input">
                <?php
                    if($court){
                    echo "<input type='text' name='court_weekend_price' placeholder='Không nhập' value='".$court_price[5]."'>";
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
                if($court){
                echo "<input type='text' name='created_on_date' placeholder='Không nhập' value='".$court[3]."'>";
                }
                ?>
              </div>
            </div>
            <div class="form-row" style="pointer-events: none;">
              <p>Ngày cập nhật :</p>
              <div class="input">
                <?php 
                if($court){
                echo "<input type='text' name='last_modified_date' placeholder='Không nhập' value='".$court[4]."'>";
                }
                ?>
              </div>
            </div>
          </div>
        </div>
        <div class="form-footer">
          <div class="button-group">
            <a class="form-button" id="form-exit" href="?option=court_exit">
              <img src="../image/sport-courts-management-img/form-delete.svg" alt="exit icon">
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
        if($_option == "view_court") {
          echo "
            <script>
              var formView = document.getElementById('form-view');
              formView.style.display = 'flex';
             
            </script>
          "; 

        }else if($_option == "view_insert_court") { 
         
          echo "<script>
              var formInsert = document.getElementById('form-insert');
              formInsert.style.display = 'flex';
              </script>
          "; 
        }else if($_option == 'insert_court') {
          if(isset($_POST['court_name'], $_POST['court_type_id'], $_POST['court_time_frame'], $_POST['court_weekday_price'], $_POST['court_weekend_price'])) {
            // Lấy thông tin các trường trong form
            $court_id = $_POST['court_id'];
            $court_name = $_POST['court_name'];
            $court_type_id = $_POST['court_type_id'];
            $court_time_frame = $_POST['court_time_frame'];
            $court_weekday_price = $_POST['court_weekday_price'];
            $court_weekend_price = $_POST['court_weekend_price'];
      
            if($court_name == "" || $court_type_id == 0 || $court_time_frame == 0 || $court_weekday_price == "" || $court_weekend_price == ""){
              include "./notification/warning.php";
              echo "
              <script>
                var warningQuestion = document.getElementById('warning-question');
                warningQuestion.textContent ='Bạn đã thực hiện thac tác thêm sân!';
                
                var warningExplanation = document.getElementById('warning-explanation');
                warningExplanation.innerHTML ='Chúng tôi rất tiếc khi thông báo rằng sân <br> đã không được thêm thành công';

                var btn_ok = document.getElementById('war-act-ok');
                btn_ok.href = './sport-courts-management.php';
              </script>
            ";
              return;
          }
           // Tạo đối tượng Court
           $court = new court();
           $court->setCourtId($court_id);
           $court->setCourtName($court_name);
           $court->setCourtTypeId($court_type_id);
         
            // Tạo đối tượng Court Price
           $court_price = new court_price();
          // $court_price->setCourtPriceId($court_price_id);
           $court_price->setCourtTimeFrame($court_time_frame); 
           $court_price->setCourtWeekdayPrice($court_weekday_price);
           $court_price->setCourtWeekendPrice($court_weekend_price);

           // Lấy thông tin về tệp hình ảnh được tải lên
           $court_images = $_FILES['court_image'];

           $result = $court_controller->insert_court($court, $court_price, $court_images);
            // Kiểm tra giá trị của biến $result
            if ($result == true) {
              // echo 'The court has been inserted successfully';
              include "./notification/action-successful.php";
              echo "
                <script>
                  var message = document.getElementById('action-successful-message');
                  message.textContent = 'Bạn đã thêm sân thành công';

                  var btn_back = document.getElementById('admin-management-button');
                  btn_back.textContent = 'Trở về quản lý sân';
                  btn_back.href = './sport-courts-management.php';
                  btn_back.style.fontSize = '12.5px';
                </script>
              ";   
            } else if ($result == false) {
              include "./notification/warning.php"; 
              echo "
                <script>
                  var warningQuestion = document.getElementById('warning-question');
                  warningQuestion.textContent = 'Bạn đã thực hiện thao tác thêm sân!';
                  
                  var warningExplanation = document.getElementById('warning-explanation');
                  warningExplanation.innerHTML ='Chúng tôi rất tiếc khi thông báo rằng sân <br> đã không được thêm thành công';

                  var btn_ok = document.getElementById('war-act-ok');
                  btn_ok.href = './sport-courts-management.php';
                </script>
              ";
            }  
          }
        }
         else if($_option == "view_update_court") {
          echo "
            <script>
              var formEdit = document.getElementById('form-edit');
              formEdit.style.display = 'flex';
            </script>
          ";
        }
        else if ($_option == "update_court") {
          if(isset($_POST['court_id'],$_POST['court_type_id'],$_POST['court_price_id'])) {
            //Lấy thông tin của các trường trong form
            $court_id = $_POST['court_id'];
            $court_name = $_POST['court_name'];
            $court_type_id = $_POST['court_type_id'];
            $court_time_frame = $_POST['court_time_frame'];
            $court_price_frame = $_POST['court_price_frame'];
            $court_weekday_price = $_POST['court_weekday_price'];
            $court_weekend_price = $_POST['court_weekend_price'];
            $court_price_id = $_POST['court_price_id'];
            $imageIds = explode(",", $_POST['image_ids']);
             // Assuming you have a court object
            $court = new court();
            $court->setCourtId($court_id);
            $court->setCourtName($court_name);
            $court->setCourtTypeId($court_type_id);
            

            // Assuming you have a court_price object
            $court_price = new court_price();
            $court_price->setCourtPriceId($court_price_id);
            $court_price->setCourtTimeFrame($court_time_frame); 
            $court_price->setCourtPriceFrame($court_price_frame);
            $court_price->setCourtWeekdayPrice($court_weekday_price);
            $court_price->setCourtWeekendPrice($court_weekend_price);

            

            // Lấy thông tin về tệp hình ảnh được tải lên
            if ($_POST['image_ids']) {
             
              foreach ($imageIds as $imageId) {
            
                // Kiểm tra xem file tương ứng với imageId này có được upload không
                if (isset($_FILES['image_' . $imageId]) && $_FILES['image_' . $imageId]['error'] == UPLOAD_ERR_OK) {
                  $court_image = new court_image();
                  $court_image->setCourtImageId($imageId);
                  $court_image->setCourtImage($_FILES['image_' . $imageId]);
                  $result = $court_controller->update_court2($court, $court_price, $court_image);
        
                } else {
                    // Log lỗi nếu không có file được upload hoặc có lỗi xảy ra trong quá trình upload
                    echo "Failed to update image ID $imageId<br>";
                }
            }
            } else {

              $result = $court_controller->update_court($court, $court_price);
            }

             // Kiểm tra giá trị của biến $result
             if ($result == true) {
              // echo 'The court has been inserted successfully';
              include "./notification/action-successful.php";
              echo "
                <script>
                  var message = document.getElementById('action-successful-message');
                  message.textContent = 'Bạn đã cập nhật sân thành công';

                  var btn_back = document.getElementById('admin-management-button');
                  btn_back.textContent = 'Trở về quản lý sân';
                  btn_back.href = './sport-courts-management.php';
                  btn_back.style.fontSize = '12.5px';
                </script>
              ";   
            } else if ($result == false) {
              include "./notification/warning.php"; 
              echo "
                <script>
                  var warningQuestion = document.getElementById('warning-question');
                  warningQuestion.textContent = 'Bạn đã thực hiện thao tác cập nhật sân!';
                  
                  var warningExplanation = document.getElementById('warning-explanation');
                  warningExplanation.innerHTML ='Chúng tôi rất tiếc khi thông báo rằng sân <br> đã không được cập nhật thành công';

                  var btn_ok = document.getElementById('war-act-ok');
                  btn_ok.href = './sport-courts-management.php';
                </script>
              ";
            }  

          }
        }
        else if($_option == "confirm_delete_court") {
          if(isset($_GET['court_state'])) {
              include "./notification/court-delete-confirmation.php";
              echo "
                <script>
                  var delConQuestion = document.getElementById('delete-confirm-question');
                  delConQuestion.textContent ='Bạn thật sự muốn xóa sân này?';
                  
                  var delConExplanation = document.getElementById('delete-confirm-explanation');
                  delConExplanation.textContent ='Sân này sẽ biến mất trên website của người dùng nếu bạn xoá nó.';
                </script>
              ";
            }
          
        } 
        else if ($_option == "delete_court"){
          if(isset($_GET['court_id'])) {
            $court_id = $_GET['court_id'];
            $result = $court_controller->delete_court($court_id);
            if ($result == true) {
              // echo 'The court has been delete successfully';
              include "./notification/action-successful.php";
              echo "
                <script>
                  var message = document.getElementById('action-successful-message');
                  message.textContent = 'Bạn đã xóa sân thành công';

                  var btn_back = document.getElementById('admin-management-button');
                  btn_back.textContent = 'Trở về quản lý sân';
                  btn_back.href = './sport-courts-management.php';
                  btn_back.style.fontSize = '12.5px';
                </script>
              ";
            } else if ($result == false){
              // echo 'The court has been delete fail';
              include "./notification/warning.php"; 
              echo "
                <script>
                  var warningQuestion = document.getElementById('warning-question');
                  warningQuestion.textContent = 'Bạn đã thực hiện thao tác xóa sân!';
                  
                  var warningExplanation = document.getElementById('warning-explanation');
                  warningExplanation.innerHTML ='Chúng tôi rất tiếc khi thông báo rằng <br> sân đã không được xóa thành công';

                  var btn_ok = document.getElementById('war-act-ok');
                  btn_ok.href = './sport-courts-management.php';

                </script>
              ";
            }  
        }
      }else if($_option == "warning_update_court") {
        include "./notification/warning.php";
          echo "
            <script>
              var delConQuestion = document.getElementById('warning-question');
              delConQuestion.textContent ='Cập nhật thông tin sân ';
              
              var delConExplanation = document.getElementById('warning-explanation');
              delConExplanation.textContent ='Bạn không thể cập nhật nhiều sân cùng một lúc.';

              var btn_ok = document.getElementById('war-act-ok');
              btn_ok.href = './service-management.php';
            </script>
          ";
        }
        else if($_option == "court_exit") {
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

    <script type="text/javascript" src="../scripts/sport-courts-management.js" language="javascript"></script>
  </body>
</html>
