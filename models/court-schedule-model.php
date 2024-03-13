<?php
    //Thay đổi CSS của thẻ li được chọn
    if (isset($_GET['court_type_id'])) {
        $courtType = $_GET['court_type_id'];
        if ($courtType == '0') {
            echo "
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        var liElement = document.getElementById('li-court-type-0');
                        liElement.style.borderBottom = '2px solid #285D8F';


                        var aElement = document.getElementById('a-court-type-0')
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
        }
    } else {
        echo "
            <script>
                var url = new URL(window.location.href);
                url.searchParams.set('court_type_id', '0');
                window.location.href = url.href;
            </script>
        ";
    }

    //Hàm hiển thị dữ liệu của bảng lịch sân theo thanh điều hướng
    function view_court_schedule() {
        //Tạo kết nối đến database
        $link = "";
        MakeConnection($link);

        //Lấy dữ liệu của biến $_GET['court_type_id']
        $courtType = isset($_GET['court_type_id']) ? $_GET['court_type_id'] : 'all'; // Mặc định court_type_id = 'all'

        //Tạo bảng dữ liệu
        echo "<thead>";

        echo "<tr>";
        
        echo "<th><input type='checkbox' name='court_schedule_id_0' id='court_schedule_id_0' onclick='updateUrl(this)'></th>";
        echo "<th>Mã lịch sân<span class='icon-arrow'>&UpArrow;</span></th>";
        echo "<th>Mã sân<span class='icon-arrow'>&UpArrow;</span></th>";
        echo "<th>Ngày nhận sân<span class='icon-arrow'>&UpArrow;</span></th>";
        echo "<th>Giờ bắt đầu<span class='icon-arrow'>&UpArrow;</span></th>";
        echo "<th>Giờ kết thúc<span class='icon-arrow'>&UpArrow;</span></th>";
        echo "<th>Khung giờ<span class='icon-arrow'>&UpArrow;</span></th>";
        echo "<th>Trạng thái<span class='icon-arrow'>&UpArrow;</span></th>";
        echo "<th>Thao tác<span class='icon-arrow'>&UpArrow;</span></th>";

        echo "</tr>";

        echo "</thead>";

        echo "<tbody>";

        // Thực hiện truy vấn dựa vào court_type_id
        if ($courtType == "all") {
            $result = ExecuteDataQuery($link, "SELECT * FROM court_schedule");
            $resultToUse = $result;
        } else {
            $result = ExecuteDataQuery($link, "SELECT * FROM court_schedule");
            $result2 = ExecuteDataQuery($link, "SELECT court_schedule.* FROM court_schedule, court WHERE court_schedule.court_id = court.court_id AND court.court_type_id = " . $courtType);
            if (mysqli_num_rows($result2) > 0) { // Kiếm tra nếu result2 có dữ liệu
            $resultToUse = $result2;
            } else {
            $resultToUse = $result; // Trả về tất cả dữ liệu nếu như không match
            }
        }

        while ($row = mysqli_fetch_assoc($resultToUse)) {
            echo "<tr>";

            echo "<td><input type='checkbox' name='court_schedule_id_".$row['court_schedule_id']."' id='court_schedule_id_".$row['court_schedule_id']."' onclick='updateUrl(this)'></td>";
            echo "<td>".$row['court_schedule_id']."</td>";
            echo "<td>".$row['court_id']."</td>";
            echo "<td>".$row['court_schedule_date']."</td>";
            echo "<td>".substr($row['court_schedule_start_time'], 0, 5)."</td>";
            echo "<td>".$row['court_schedule_end_time']."</td>";
            echo "<td>".$row['court_schedule_time_frame']."</td>";

            if ($row['court_schedule_state'] == "Chưa đặt") {
                echo "<td><p class='status haveNotBooked'>".$row['court_schedule_state']."</p></td>";
            } else if ($row['court_schedule_state'] == "Đã đặt") {
                echo "<td><p class='status haveBooked'>".$row['court_schedule_state']."</p></td>";
            } else if ($row['court_schedule_state'] == "Hết hạn") {
                echo "<td><p class='status expired'>".$row['court_schedule_state']."</p></td>";
            }

            echo "
                <td>
                    <a style='max-width: 70px; display: flex; padding: 6px 10px; justify-content: center; align-items: center;
                    gap: 8px; border-radius: 4px; border: 2px solid #4EACDF; background: #FAFBFC;'
                    href='?option=view_court_schedule_detail'>
                        <img src='../image/sport-court-schedules-management-img/eye.svg' alt='eye icon'>
                        <p style='color: #4EACDF; font-size: 14px; font-style: normal; font-weight: 600; line-height: 20px;'>Xem</p>
                    </a>
                </td>
            ";

            echo "</tr>";
        }

        echo "</tbody>";

        //Giải phóng bộ nhớ
        ReleaseMemory($link, $result);
    }
?>



