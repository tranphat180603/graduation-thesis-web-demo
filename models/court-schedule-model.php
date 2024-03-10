<?php
    $defaultCourtTypeId = 1;

    //Thay đổi CSS của thẻ li được chọn
    if (isset($_GET['court_type_id'])) {
        $courtType = $_GET['court_type_id'];
        echo "
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    var liElement = document.getElementById('li-court-type-".$courtType."');
                    liElement.style.borderBottom = '2px solid #285D8F';

                    var aElement = document.getElementById('a-court-type-".$courtType."')
                    aElement.style.color = '#285D8F';
                    aElement.style.fontSize = '16px';
                    aElement.style.fontStyle = 'normal';
                    aElement.style.fontWeight = '500';
                    aElement.style.lineHeight = '24px';
                });
            </script>
        ";
    } else {
        echo "
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    var liElement = document.getElementById('li-court-type-".$defaultCourtTypeId."');
                    liElement.style.borderBottom = '2px solid #285D8F';

                    var aElement = document.getElementById('a-court-type-".$defaultCourtTypeId."')
                    aElement.style.color = '#285D8F';
                    aElement.style.fontSize = '16px';
                    aElement.style.fontStyle = 'normal';
                    aElement.style.fontWeight = '500';
                    aElement.style.lineHeight = '24px';
                });
            </script>
        ";
    }

    //Hàm hiển thị dữ liệu của bảng lịch sân
    function view_court_schedule() {
        //Tạo kết nối đến database
        $link = "";
        MakeConnection($link);

        //Kết nối và lấy dữ liệu từ cơ sở dữ liệu
        $result = ExecuteDataQuery($link, "SELECT * FROM court_schedule");

        //Tạo dòng tiêu đề cho bảng dữ liệu
        echo "<tr style='display: flex; min-width: 1000px; padding: 5px 0px; justify-content: space-between; align-items: center;
              align-self: stretch; white-space: nowrap; border-radius: 4px 4px 0px 0px; background: #F1F1F1;'>";
        echo "
            <th class='checkbox'>
                <form action='?tick=no&court_schedule_id=all' method='post' enctype='multipart/form-data'>
                    <input type='checkbox' name='all'>
                </form>
            </th>
        ";
        echo "<th>Mã lịch sân</th>";
        echo "<th>Mã sân</th>";
        echo "<th>Ngày nhận sân</th>";
        echo "<th>Giờ bắt đầu</th>";
        echo "<th>Giờ kết thúc</th>";
        echo "<th>Khung giờ</th>";
        echo "<th>Trạng thái</th>";
        echo "<th>Thao tác</th>";
        echo "</tr>";

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr style='display: flex; height: 64px; min-width: 1000px; justify-content: space-between; align-items: center;
            align-self: stretch;'>";
            echo "
                <td class='checkbox'>
                    <form action='?tick=no&court_schedule_id=".$row['court_schedule_id']."' method='post' enctype='multipart/form-data'>
                        <input type='checkbox' name='court_schedule_id_".$row['court_schedule_id']."'>
                    </form>
                </td>
            ";
            echo "<td>".$row['court_schedule_id']."</td>";
            echo "<td>".$row['court_id']."</td>";
            echo "<td>".$row['court_schedule_date']."</td>";
            echo "<td>".substr($row['court_schedule_start_time'], 0, 5)."</td>";
            echo "<td>".$row['court_schedule_end_time']."</td>";
            echo "<td>".$row['court_schedule_time_frame']."</td>";
            echo "<td>".$row['court_schedule_state']."</td>";
            echo "
                <td>
                    <a style='display: flex; padding: 8px 12px; justify-content: center; align-items: center;
                    gap: 8px; border-radius: 4px; border: 2px solid #4EACDF; background: #FAFBFC;' 
                    href='?option=view_court_schedule_detail'>
                        <img src='../image/sport-court-schedules-management-img/eye.svg' alt='eye icon'>
                        <p style='color: #4EACDF; font-size: 14px; font-style: normal; font-weight: 600; line-height: 20px;'>Xem</p>
                    </a>
                </td>
            ";
            echo "</tr>";
        }
        
        //Giải phóng bộ nhớ
        ReleaseMemory($link, $result);
    }
?>