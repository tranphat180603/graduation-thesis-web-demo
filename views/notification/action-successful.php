    <!-- Action Successful -->
    <div class="action-successful">
      <div class="successful-image">
        <img src="../image/sport-court-schedules-management-img/successful.svg" alt="successful image">
      </div>
      <div class="message">
        <p id="action-successful-message-title">Thông báo</p>
        <p id="action-successful-message">Bạn đã chỉnh sửa ... thành công</p>
      </div>
      <div class="action-successful-button-group">
        <a id="home-button" href="../index.php">Trở về trang chủ</a>
        <a id="admin-management-button" href="./sport-court-schedules-management.php">Trở về quản lý lịch sân</a>
      </div>
    </div>
    <style>
      .action-successful {
        display: flex;
        width: 441px;
        padding: 20px;
        flex-direction: column;
        align-items: flex-start;
        gap: 10px;

        position: absolute;
        top: 200px;
        right: calc(100% / 2 - 220px);
        z-index: 10;
        border-radius: 8px;
        background: #fafbfc;
        box-shadow: 0px 4px 12px 8px rgba(0, 0, 0, 0.08);
      }

      .successful-image {
        display: flex;
        justify-content: center;
        align-items: flex-start;
        gap: 10px;
        align-self: stretch;
      }

      .message {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        gap: 5px;
        align-self: stretch;
      }

      #action-successful-message-title {
        color: #000;
        font-size: 25px;
        font-style: normal;
        font-weight: 600;
        line-height: 40px;
      }

      #action-successful-message {
        align-self: stretch;
        color: #000;
        text-align: center;
        font-size: 14px;
        font-style: normal;
        font-weight: 400;
        line-height: 24px;
      }

      .action-successful-button-group {
        display: flex;
        padding: 10px 16px;
        justify-content: center;
        align-items: center;
        gap: 8px;
        align-self: stretch;
      }

      #home-button {
        display: flex;
        padding: 16px;
        justify-content: center;
        align-items: center;
        gap: 8px;
        flex: 1 0 0;

        border-radius: 4px;
        border: 2px solid #285d8f;
        background: #fafbfc;

        color: #285d8f;
        text-align: center;

        font-size: 13.5px;
        font-style: normal;
        font-weight: 500;
        line-height: 20px;
      }

      #home-button:hover {
        background: #e4ebf1;
      }

      #admin-management-button {
        display: flex;
        padding: 16px;
        justify-content: center;
        align-items: center;
        gap: 8px;
        flex: 1 0 0;
        border-radius: 4px;
        background: #285d8f;

        color: #fafbfc;
        text-align: center;

        font-size: 13.5px;
        font-style: normal;
        font-weight: 500;
        line-height: 20px;
      }

      #admin-management-button:hover {
        background: #1d476f;
      }

      /* Điều chỉnh định dạng khi kích thước màn hình nhỏ hơn 600px */
      @media screen and (max-width: 600px) {
        .action-successful {
          width: 320px;
          top: 100px;
          right: calc(100% / 2 - 190px);
        }
      }

      /* Điều chỉnh định dạng khi kích thước màn hình nhỏ hơn 500px */
      @media screen and (max-width: 500px) {
        .action-successful {
          width: 290px;
          top: 50px;
          right: calc(100% / 2 - 180px);
        }
      }

      /* Điều chỉnh định dạng khi kích thước màn hình nhỏ hơn 400px */
      @media screen and (max-width: 400px) {
        .action-successful {
          width: 260px;
          top: 50px;
          right: calc(100% / 2 - 165px);
        }
      }
    </style>