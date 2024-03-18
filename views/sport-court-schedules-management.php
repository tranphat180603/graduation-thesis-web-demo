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
    <!-- HEADER -->
    <?php include "../header/admin-managerial-header.php"; ?>
    <!-- BODY -->
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
            placeholder="Tìm kiếm lịch sân"
            required
          />        
        </div>
        <div id="schedule-body-menu">
          <ul>
            <?php 
              require_once "../controllers/court-schedule-controller.php"; 

              $court_schedule_controller = new Court_Schedule_Controller();
              $total_court_schedule = $court_schedule_controller->view_all();
              echo "
                <li class='li-court-type' id='li-court-type-0'>
                  <a id='a-court-type-0' href='?court_type_id=0'>Tất cả&nbsp;(<span>".$total_court_schedule[0]."</span>)</a>
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
                
                $court_schedule_amount = $court_schedule_controller->view_court_schedule_by_court_type($court_type->getCourtTypeId());
                echo "
                      &nbsp;(<span>".$court_schedule_amount[0]."</span>)
                    </a>
                  </li>
                ";
              }
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
            <a id="delete" href="?option=delete_court_schedule">
              <img src="../image/sport-court-schedules-management-img/delete.svg" alt="delete icon">
              <p>Xóa</p>
            </a>
          </form>
        </div>
        <div class="court-schedule-table">
          <table>
            <thead> 
              <tr>
                <th><input type='checkbox' name='court_schedule_id_0' id='court_schedule_id_0' onclick='updateUrlAndCBState(this)'></th>
                <th>Mã lịch sân<span class='icon-arrow'>&UpArrow;</span></th>
                <th>Mã sân<span class='icon-arrow'>&UpArrow;</span></th>
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
                require_once "../controllers/court-schedule-controller.php"; 

                $court_schedule_controller = new Court_Schedule_Controller();
                $court_schedules = $court_schedule_controller->view_court_schedule();

                foreach($court_schedules as $court_schedule) {
                  echo "<tr>";

                  echo "<td><input type='checkbox' name='court_schedule_id_".$court_schedule->getCourtScheduleId()."' id='court_schedule_id_".$court_schedule->getCourtScheduleId()."' onclick='updateUrl(this)'></td>";
                  echo "<td>".$court_schedule->getCourtScheduleId()."</td>";
                  echo "<td>".$court_schedule->getCourtId()."</td>";
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
                  }

                  echo "
                      <td class='btn-view'>
                          <a href='?option=view_court_schedule_detail&court_schedule_id=".$court_schedule->getCourtScheduleId()."'>
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
  </body>
</html>
