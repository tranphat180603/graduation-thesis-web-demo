<!-- Delete Confirmation -->
<div class="delete-confirm-container">
        <div class="main-content">
          <img src="../image/service-management-img/delete-confirm.svg" alt="delete confirm icon">
          <div class="content">
            <p id="delete-confirm-question">Bạn thật sự muốn xóa ... này?</p>
            <p id="delete-confirm-explanation">... này sẽ biến mất trên website của người dùng nếu bạn xoá nó.</p>
          </div>
        </div>
        <div class="action">
          <a id="del-con-act-no" href="./service-management.php">Không</a>
          <a 
            id="del-con-act-yes" 
            href="<?php 
                    if(isset($_GET['service_id'])) {
                        $service_id = urlencode($_GET['service_id']);
                      echo "?option=delete_service&service_id=".$service_id;
                    }
                  ?>
          ">Có
          </a>
        </div>
      </div>

      <style>
        .delete-confirm-container {
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

        .delete-confirm-container .main-content {
          display: flex;
          align-items: flex-start;
          gap: 16px;
          align-self: stretch;
        }

        #delete-confirm-question {
          align-self: stretch;
          color: rgba(0, 0, 0, 0.85);
          font-size: 15.5px;
          font-style: normal;
          font-weight: 600;
          line-height: 24px;
        }

        #delete-confirm-explanation {
          align-self: stretch;
          color: rgba(0, 0, 0, 0.85);
          font-size: 14px;
          font-style: normal;
          font-weight: 400;
          line-height: 22px;
        }

        .delete-confirm-container .action {
          display: flex;
          justify-content: flex-end;
          align-items: flex-start;
          gap: 10px;
          align-self: stretch;
        }

        #del-con-act-no {
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

        #del-con-act-no:hover {
          background: #e3e3e3;
        }

        #del-con-act-yes {
          display: flex;
          padding: 4px 15px;
          justify-content: center;
          align-items: center;
          gap: 8px;
          border-radius: 2px;
          border: 1px solid #d00000;
          background: #d00000;
          box-shadow: 0px 2px 0px 0px rgba(0, 0, 0, 0.04);

          color: #fff;
          text-align: center;
          font-size: 14px;
          font-style: normal;
          font-weight: 600;
          line-height: 22px;
        }

        #del-con-act-yes:hover {
          background: #ab0505;
        }

        /* Điều chỉnh định dạng khi kích thước màn hình nhỏ hơn 600px */
        @media screen and (max-width: 600px) {
          .delete-confirm-container {
            width: 300px;
            top: 100px;
            right: calc(100% / 2 - 180px);
          }
        }

        /* Điều chỉnh định dạng khi kích thước màn hình nhỏ hơn 500px */
        @media screen and (max-width: 500px) {
          .delete-confirm-container {
            width: 270px;
            top: 50px;
            right: calc(100% / 2 - 170px);
          }
        }

        /* Điều chỉnh định dạng khi kích thước màn hình nhỏ hơn 400px */
        @media screen and (max-width: 400px) {
          .delete-confirm-container {
            width: 240px;
            top: 50px;
            right: calc(100% / 2 - 155px);
          }
        }
      </style>