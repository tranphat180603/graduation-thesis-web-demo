    <!-- Admin cancel reason (payment court order) -->
    <?php
        if(isset($_GET['court_order_id'])) {
          $court_order_id = $_GET['court_order_id'];
        }

        if(isset($_GET['court_schedule_id'])) {
          $court_schedule_id = $_GET['court_schedule_id'];
        }
    ?>
    <form id="form-admin-cancel-reason-payment" action="./sport-court-orders-management.php" method="post" enctype="multipart/form-data">
      <div class="ad-can-rea-pay-header">
        <p>Lý Do Hủy</p>
      </div>
      <div class="ad-can-rea-pay-body">
        <div class="reason">
          <label>
            <input type="radio" name="cancel_reason" value="Sân này không cho thuê nữa">
            &nbsp;&nbsp;&nbsp;Sân này không cho thuê nữa
          </label>
        </div>
        <div class="reason">
          <label>
            <input type="radio" name="cancel_reason" value="Lịch sân này không khả dụng nữa">
            &nbsp;&nbsp;&nbsp;Lịch sân này không khả dụng nữa
          </label>
        </div>
        <div class="reason">
          <label>
            <input type="radio" name="cancel_reason" value="Sân này đang được bảo trì, sữa chữa">
            &nbsp;&nbsp;&nbsp;Sân này đang được bảo trì, sữa chữa
          </label>
        </div>
        <div class="reason">
          <label>
            <input type="radio" name="cancel_reason" value="Đơn đặt sân chưa được thanh toán">
            &nbsp;&nbsp;&nbsp;Đơn đặt sân chưa được thanh toán
          </label>
        </div>
      </div>
      <div class="ad-can-rea-pay-footer">
        <div class="ad-can-rea-pay-btn-gr">
          <a href="./sport-court-orders-management.php">
            <p>Thoát</p>
          </a>
          <input type="submit" value="Hủy đơn">
        </div>
      </div>
      <?php
        echo "<input type='text' name='court_order_id' value='".$court_order_id."'>";
        echo "<input type='text' name='court_schedule_id' value='".$court_schedule_id."'>";
      ?>
    </form>
    <style>
      #form-admin-cancel-reason-payment {
        display: flex;
        width: 387px;
        padding: 10px 30px;
        flex-direction: column;
        align-items: flex-start;
        gap: 20px;
        border-radius: 6px;
        background: #fff;
        position: absolute;
        top: 200px;
        right: calc(100% / 2 - 220px);
        z-index: 10;
        box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25),
          0px 3px 6px -4px rgba(0, 0, 0, 0.12), 0px 6px 16px 0px rgba(0, 0, 0, 0.08),
          0px 9px 28px 8px rgba(0, 0, 0, 0.05);
      }

      .ad-can-rea-pay-header {
        display: flex;
        padding: 10px 0px;
        align-items: center;
        align-self: stretch;
        background: #fff;
        box-shadow: 0px -1px 0px 0px #f0f0f0 inset;
      }

      .ad-can-rea-pay-header p {
        color: rgba(0, 0, 0, 0.85);
        font-size: 18px;
        font-style: normal;
        font-weight: 700;
        line-height: 24px;
      }

      .ad-can-rea-pay-body {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        gap: 16px;
        align-self: stretch;
      }

      .reason {
        display: flex;
        align-items: center;
        gap: 16px;
        align-self: stretch;
      }

      .reason label:hover {
        cursor: pointer;
      }

      .ad-can-rea-pay-footer {
        display: flex;
        padding: 10px 0px;
        justify-content: flex-end;
        align-items: center;
        gap: 8px;
        align-self: stretch;
        background: #fff;
        box-shadow: 0px 1px 0px 0px #f0f0f0 inset;
      }

      .ad-can-rea-pay-btn-gr {
        display: flex;
        justify-content: flex-end;
        align-items: center;
        gap: 10px;
      }

      .ad-can-rea-pay-btn-gr a {
        display: flex;
        padding: 4px 15px;
        justify-content: center;
        align-items: center;
        gap: 8px;
        border-radius: 2px;
        border: 1px solid #5e6a6e;
        background: #fff;
        box-shadow: 0px 2px 0px 0px rgba(0, 0, 0, 0.04);
      }

      .ad-can-rea-pay-btn-gr a:hover {
        background: #dae0e2;
      }

      .ad-can-rea-pay-btn-gr a p {
        color: #5e6a6e;
        text-align: center;
        font-size: 14px;
        font-style: normal;
        font-weight: 600;
        line-height: 22px;
      }

      #form-admin-cancel-reason-payment input[type="submit"] {
        display: flex;
        padding: 4px 15px;
        justify-content: center;
        align-items: center;
        gap: 8px;
        border-radius: 2px;
        border: 1px solid #ff4141;
        background: #ff4141;
        box-shadow: 0px 2px 0px 0px rgba(0, 0, 0, 0.04);
        color: #fff;
        text-align: center;
        font-size: 14px;
        font-style: normal;
        font-weight: 600;
        line-height: 22px;
      }

      #form-admin-cancel-reason-payment input[type="submit"]:hover {
        cursor: pointer;
        border: 1px solid #d22b2b;
        background: #d22b2b;
      }

      input[type="text"] {
        display: none;
      }

      /* Điều chỉnh định dạng khi kích thước màn hình nhỏ hơn 650px */
      @media screen and (max-width: 650px) {
        #form-admin-cancel-reason-payment {
          width: 300px;
          top: 100px;
          right: calc(100% / 2 - 180px);
        }
      }

      /* Điều chỉnh định dạng khi kích thước màn hình nhỏ hơn 550px */
      @media screen and (max-width: 550px) {
        #form-admin-cancel-reason-payment {
          width: 250px;
          top: 50px;
          right: calc(100% / 2 - 155px);
        }
      }

      /* Điều chỉnh định dạng khi kích thước màn hình nhỏ hơn 400px */
      @media screen and (max-width: 400px) {
        #form-admin-cancel-reason-payment {
          width: 210px;
          top: 50px;
          right: calc(100% / 2 - 135px);
        }
      }
    </style>