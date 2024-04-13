      <!-- Warning -->
      <div class="warning-container">
        <div class="main-content">
          <img id="warning-icon" src="/NTP-Sports-Hub//image/sport-court-schedules-management-img/confirm.svg" alt="warning icon">
          <div class="content">
            <p id="warning-question">Bạn muốn thực hiện thao tác trên ... này?</p>
            <p id="warning-explanation">warning content</p>
          </div>
        </div>
        <div class="action">
          <a id="war-act-ok" href="/NTP-Sports-Hub/views/sport-court-schedules-management.php">OK</a>
        </div>
      </div>
      <style>
        .warning-container {
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

        .warning-container .main-content {
          display: flex;
          align-items: flex-start;
          gap: 16px;
          align-self: stretch;
        }

        #warning-question {
          align-self: stretch;
          color: rgba(0, 0, 0, 0.85);
          font-size: 15.5px;
          font-style: normal;
          font-weight: 600;
          line-height: 24px;
        }

        #warning-explanation {
          align-self: stretch;
          color: rgba(0, 0, 0, 0.85);
          font-size: 14px;
          font-style: normal;
          font-weight: 400;
          line-height: 22px;
        }

        .warning-container .action {
          display: flex;
          justify-content: flex-end;
          align-items: flex-start;
          gap: 10px;
          align-self: stretch;
        }

        #war-act-ok {
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

        #war-act-ok:hover {
          background: #e3e3e3;
        }

        /* Điều chỉnh định dạng khi kích thước màn hình nhỏ hơn 600px */
        @media screen and (max-width: 600px) {
          .warning-container {
            width: 300px;
            top: 100px;
            right: calc(100% / 2 - 180px);
          }
        }

        /* Điều chỉnh định dạng khi kích thước màn hình nhỏ hơn 500px */
        @media screen and (max-width: 500px) {
          .warning-container {
            width: 270px;
            top: 50px;
            right: calc(100% / 2 - 170px);
          }
        }

        /* Điều chỉnh định dạng khi kích thước màn hình nhỏ hơn 400px */
        @media screen and (max-width: 400px) {
          .warning-container {
            width: 240px;
            top: 50px;
            right: calc(100% / 2 - 155px);
          }
        }
      </style>