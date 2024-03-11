<?php
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
                var url = new URL(window.location.href);
                url.searchParams.set('court_type_id', '1');
                window.location.href = url.href;
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
        echo "<tr style='position: sticky; top: 0px; /* Đặt khoảng cách từ đỉnh phần tử cha đến phần tử con */
              display: flex; min-width: 1000px; justify-content: space-between; align-items: center;
              align-self: stretch; white-space: nowrap; border-radius: 4px 4px 0px 0px; background: #F1F1F1;'>";
        echo "
            <th style='flex: 0 0 32px; padding: 19px 10px;'>
                <form action='?tick=no&court_schedule_id=all' method='post' enctype='multipart/form-data'>
                    <input id='checkAll' style='cursor: pointer;' type='checkbox' name='all'>
                </form>
            </th>
        ";

        echo "
            <script>
                document.getElementById('checkAll').addEventListener('change', function() {
                    var checkboxForm = document.getElementById('checkAll');
                    var isChecked = this.checked;
                    if (isChecked) {
                        // Thêm tham số vào URL nếu checkbox được tick
                        var url = new URL(window.location.href);
                        url.searchParams.set('court_schedule_id', 'all');
                        window.location.href = url.href;
                    } else {
                        // Xóa tham số khỏi URL nếu checkbox không được tick
                        var url = new URL(window.location.href);
                        url.searchParams.delete('court_schedule_id');
                        window.location.href = url.href;
                    }
                });
            </script>
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
            align-self: stretch; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;'>";
            echo "
                <td style='flex: 0 0 32px; padding: 19px 10px;'>
                    <form action='?tick=no&court_schedule_id=".$row['court_schedule_id']."' method='post' enctype='multipart/form-data'>
                        <input id='court_schedule_id_".$row['court_schedule_id']."' style='cursor: pointer;' type='checkbox' name='court_schedule_id_".$row['court_schedule_id']."'>
                    </form>
                </td>
            ";
            
            echo "
                <script>
                    document.getElementById('court_schedule_id_".$row['court_schedule_id']."').addEventListener('change', function() {
                        var checkboxForm = document.getElementById('court_schedule_id_".$row['court_schedule_id']."');
                        var isChecked = this.checked;
                        if (isChecked) {
                            // Thêm tham số vào URL nếu checkbox được tick
                            var url = new URL(window.location.href);
                            url.searchParams.set('court_schedule_id_".$row['court_schedule_id']."', 'yes');
                            window.location.href = url.href;
                            document.getElementById('court_schedule_id_".$row['court_schedule_id']."').checked = true;
                        } else {
                            // Xóa tham số khỏi URL nếu checkbox không được tick
                            var url = new URL(window.location.href);
                            url.searchParams.delete('court_schedule_id_".$row['court_schedule_id']."');
                            window.location.href = url.href;
                            document.getElementById('court_schedule_id_".$row['court_schedule_id']."').checked = false;
                        }
                    });
                </script>
            ";

            echo "<td>".$row['court_schedule_id']."</td>";
            echo "<td>".$row['court_id']."</td>";
            echo "<td>".$row['court_schedule_date']."</td>";
            echo "<td>".substr($row['court_schedule_start_time'], 0, 5)."</td>";
            echo "<td>".$row['court_schedule_end_time']."</td>";
            echo "<td>".$row['court_schedule_time_frame']."</td>";
            if ($row['court_schedule_state'] == "Chưa đặt") {
                echo "
                    <td>
                        <div style='display: flex; height: 36px; flex-direction: column; justify-content: center;
                        align-items: center; flex: 1 0 0; border-radius: 6px; background: #DEE4E2;'>
                            <p style='color: #7F8283; text-align: center; font-size: 16px;
                            font-style: normal; font-weight: 600; line-height: 16px;'>".$row['court_schedule_state']."</p>
                        </div>
                    </td>
                ";
            } else if ($row['court_schedule_state'] == "Đã đặt") {
                echo "
                    <td>
                        <div style='display: flex; height: 36px; flex-direction: column; justify-content: center;
                        align-items: center; flex: 1 0 0; border-radius: 6px; background: #D3FFF2;'>
                            <p style='color: #339DB5; text-align: center; font-size: 16px;
                            font-style: normal; font-weight: 600; line-height: 16px;'>".$row['court_schedule_state']."</p>
                        </div>
                    </td>
                ";
            } else {
                echo "
                    <td>
                        <div style='display: flex; height: 36px; flex-direction: column; justify-content: center;
                        align-items: center; flex: 1 0 0; border-radius: 6px; background: #FCD7E2;'>
                            <p style='color: #E7527E; text-align: center; font-size: 16px;
                            font-style: normal; font-weight: 600; line-height: 16px;'>".$row['court_schedule_state']."</p>
                        </div>
                    </td>
                ";
            }
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