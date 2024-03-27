      <!-- Order Process Confirmation (refunded) -->
      <div class="order-confirm-container">
        <div class="main-content">
          <img id="order-confirm-icon" src="../image/sport-court-orders-management-img/refunded.svg" alt="order confirm icon">
          <div class="content">
            <p id="order-confirm-question">Bạn thật sự muốn xử lý đơn đặt sân này?</p>
            <p id="order-confirm-explanation">Đơn đặt sân này sẽ được chuyển trạng thái thành <span id="order-confirm-state">ĐÃ HỦY</span> nếu bạn xử lý nó.</p>
          </div>
        </div>
        <div class="action">
          <a id="ord-con-act-no" href="./sport-court-orders-management.php">Không</a>
          <a 
            id="ord-con-act-yes" 
            href="<?php 
                    if(isset($_GET['court_order_id'])) {
                      $court_order_id = urlencode($_GET['court_order_id']);
                      echo "?option=process_refunded_court_order&court_order_id=" . $court_order_id;
                    }
                  ?>
          ">Có
          </a>
        </div>
      </div>
      <style>
        .order-confirm-container {
          display: flex;
          width: 416px;
          padding: 32px 32px 24px 32px;
          flex-direction: column;
          align-items: flex-end;
          gap: 24px;

          position: absolute;
          top: 200px;
          right: calc(100% / 2 - 208px);
          z-index: 10;
          border-radius: 12px;
          background: #fff;

          box-shadow: 0px 3px 6px -4px rgba(0, 0, 0, 0.12),
            0px 6px 16px 0px rgba(0, 0, 0, 0.08), 0px 9px 28px 8px rgba(0, 0, 0, 0.05);
        }

        .order-confirm-container .main-content {
          display: flex;
          align-items: flex-start;
          gap: 16px;
          align-self: stretch;
        }

        #order-confirm-question {
          align-self: stretch;
          color: rgba(0, 0, 0, 0.85);
          font-size: 15.5px;
          font-style: normal;
          font-weight: 600;
          line-height: 24px;
        }

        #order-confirm-explanation {
          align-self: stretch;
          color: rgba(0, 0, 0, 0.85);
          font-size: 14px;
          font-style: normal;
          font-weight: 400;
          line-height: 22px;
        }

        #order-confirm-explanation span {
          color: #E72E2E;
        }

        .order-confirm-container .action {
          display: flex;
          justify-content: flex-end;
          align-items: flex-start;
          gap: 10px;
          align-self: stretch;
        }

        #ord-con-act-no {
          display: flex;
          padding: 4px 15px;
          justify-content: center;
          align-items: center;
          gap: 10px;
          border-radius: 2px;
          border: 1px solid #d9d9d9;
          background: #fff;
          box-shadow: 0px 2px 0px 0px rgba(0, 0, 0, 0.02);

          color: rgba(0, 0, 0, 0.85);
          text-align: center;
          font-size: 14px;
          font-style: normal;
          font-weight: 600;
          line-height: 22px;
        }

        #ord-con-act-no:hover {
          background: #e3e3e3;
        }

        #ord-con-act-yes {
          display: flex;
          padding: 4px 15px;
          justify-content: center;
          align-items: center;
          gap: 8px;
          border-radius: 2px;
          border: 1px solid #E72E2E;
          background: #E72E2E;
          box-shadow: 0px 2px 0px 0px rgba(0, 0, 0, 0.04);

          color: #fff;
          text-align: center;
          font-size: 14px;
          font-style: normal;
          font-weight: 600;
          line-height: 22px;
        }

        #ord-con-act-yes:hover {
          background: #CA2727;
        }

        /* Điều chỉnh định dạng khi kích thước màn hình nhỏ hơn 600px */
        @media screen and (max-width: 600px) {
          .order-confirm-container {
            width: 300px;
            top: 100px;
            right: calc(100% / 2 - 180px);
          }
        }

        /* Điều chỉnh định dạng khi kích thước màn hình nhỏ hơn 500px */
        @media screen and (max-width: 500px) {
          .order-confirm-container {
            width: 270px;
            top: 50px;
            right: calc(100% / 2 - 170px);
          }
        }

        /* Điều chỉnh định dạng khi kích thước màn hình nhỏ hơn 400px */
        @media screen and (max-width: 400px) {
          .order-confirm-container {
            width: 240px;
            top: 50px;
            right: calc(100% / 2 - 155px);
          }
        }
      </style>
