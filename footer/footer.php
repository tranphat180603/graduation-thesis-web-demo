    <!-- FOOTER -->
    <style>
      .footer {
        display: flex;
        padding: 40px 70px;
        justify-content: center;
        align-items: center;
        border-top: 1px solid #888;
        background: #f5f5f5;
      }

      .footer-sub {
        display: flex;
        max-width: 1354px;
        flex-direction: column;
        align-items: center;
        gap: 20px;
        flex: 1 0 0;
      }

      .footer-top {
        display: flex;
        width: 100%;
        max-width: 1354px;
        flex-direction: column;
        align-items: flex-start;
        gap: 20px;
        align-self: stretch;
      }

      .footer-top-top {
        display: flex;
        width: 100%;
        align-items: center;
        align-content: center;
        gap: 10px;
        align-self: stretch;
        flex-wrap: wrap;
      }

      .footer-top-top p {
        color: #285d8f;
        font-size: 16px;
        font-style: normal;
        font-weight: 600;
        line-height: normal;
      }

      .footer-top-top p span {
        color: #4eacdf;
      }

      .footer-top-bottom {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        align-content: flex-start;
        row-gap: 30px;
        align-self: stretch;
        flex-wrap: wrap;
      }

      .footer-general-info {
        display: flex;
        min-width: 320px;
        max-width: 370px;
        flex-direction: column;
        align-items: flex-start;
        gap: 25px;
        flex: 1 0 0;
      }

      .footer-general-info p {
        align-self: stretch;
        color: #141716;
        font-size: 16px;
        font-style: normal;
        font-weight: 400;
        line-height: 24px;
      }

      .footer-general-info-contact {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        gap: 16px;
        align-self: stretch;
      }

      .phone-number {
        display: flex;
        align-items: center;
        gap: 13px;
        align-self: stretch;
      }

      .phone-number p,
      .address p {
        flex: 1 0 0;
        color: #141716;
        font-size: 16px;
        font-style: normal;
        font-weight: 500;
        line-height: 24px;
      }

      .address {
        display: flex;
        align-items: center;
        gap: 13px;
        align-self: stretch;
      }

      .footer-service {
        display: flex;
        min-width: 176px;
        max-width: 176px;
        padding-left: 20px;
        flex-direction: column;
        align-items: flex-start;
        gap: 10px;
        flex: 1 0 0;
      }

      .footer-service p {
        color: #141716;
        font-size: 16px;
        font-style: normal;
        font-weight: 500;
        line-height: 24px;
      }

      .footer-service-link {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        gap: 16px;
      }

      .footer-service-link li a:hover,
      .footer-about-us-link li a:hover,
      .facebook a:hover,
      .email a:hover {
        color: #bebebe;
      }

      .footer-about-us {
        display: flex;
        min-width: 118px;
        max-width: 118px;
        padding-left: 20px;
        flex-direction: column;
        align-items: flex-start;
        gap: 10px;
        flex: 1 0 0;
      }

      .footer-about-us p {
        color: #141716;
        font-size: 16px;
        font-style: normal;
        font-weight: 500;
        line-height: 24px;
      }

      .footer-about-us-link {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        gap: 16px;
      }

      .footer-contact-info {
        display: flex;
        min-width: 211px;
        max-width: 211px;
        padding-left: 20px;
        flex-direction: column;
        align-items: flex-start;
        gap: 24px;
        flex: 1 0 0;
      }

      .footer-contact-info p {
        color: #141716;
        font-size: 16px;
        font-style: normal;
        font-weight: 500;
        line-height: 24px;
      }

      .facebook,
      .email {
        width: 100%;
        display: flex;
        align-items: flex-start;
        gap: 10px;
      }
      
      .footer-bottom {
        display: flex;
        width: 100%;
        max-width: 1354px;
        flex-direction: column;
        align-items: flex-start;
        gap: 16px;
        align-self: stretch;
      }

      .footer-bottom hr {
        border: none;
        width: 100%;
        height: 1px;
        background-color: #c2c2c2;
      }

      .footer-bottom p {
        align-self: stretch;
        color: #b5b0b0;
        font-size: 14px;
        font-style: normal;
        font-weight: 400;
        line-height: 20px;
      }

      @media screen and (max-width: 500px) {
        .footer {
          padding: 20px 20px 40px;
        }

        .footer-general-info {
          min-width: 200px;
        }
      }
    </style>

    <div class="footer">
      <div class="footer-sub">
        <div class="footer-top">
          <div class="footer-top-top">
            <img id="NTP-logo-img"
              src="/NTP-Sports-Hub/image/footer-img/footer-logo.svg"
              alt="Khu liên hợp thể thao NTP"
            />
            <p>
              Khu liên hợp thể thao
              <span>Nguyễn Tri Phương</span>
            </p>
          </div>
          <div class="footer-top-bottom">
            <div class="footer-general-info">
              <p>
                Chúng tôi nỗ lực xây dựng một cộng đồng thể thao vững mạnh, góp
                phần nâng cao thể chất và tinh thần của người Việt Nam.
              </p>
              <div class="footer-general-info-contact">
                <div class="phone-number">
                  <img id="phone-img"
                    src="/NTP-Sports-Hub/image/footer-img/call.svg"
                    alt="Số điện thoại"
                  />
                  <p>Liên hệ: 090 379 93 86</p>
                </div>
                <div class="address">
                  <img id="address-img" src="/NTP-Sports-Hub/image/footer-img/location.svg" alt="Địa chỉ" />
                  <p>
                    Địa điểm: 477 Đ. Nguyễn Tri Phương, KP. Bình Đường 4, P. An
                    Bình, TP. Dĩ An, Bình Dương
                  </p>
                </div>
              </div>
            </div>
            <div class="footer-service">
              <p>Dịch vụ</p>
              <ul class="footer-service-link">
                <li><a href="?service=direction">Hướng dẫn sử dụng</a></li>
                <li><a href="?service=FAQs">FAQs</a></li>
                <li><a href="?service=term">Điều khoản sử dụng</a></li>
                <li><a href="?service=security">Chính sách bảo mật</a></li>
              </ul>
            </div>
            <div class="footer-about-us">
              <p>Về chúng tôi</p>
              <ul class="footer-about-us-link">
                <li><a href="?about-us=mission">Sứ mạng</a></li>
                <li><a href="?about-us=vision">Tầm nhìn</a></li>
              </ul>
            </div>
            <div class="footer-contact-info">
              <p>Kết nối với chúng tôi</p>
              <div class="facebook">
                <img id="facebook-img" src="/NTP-Sports-Hub/image/footer-img/facebook.svg" alt="Facebook" />
                <a
                  href="https://www.facebook.com/sbnguyentriphuong"
                  target="_blank"
                  >sbnguyentriphuong</a
                >
              </div>
              <div class="email">
                <img id="email-img" src="/NTP-Sports-Hub/image/footer-img/mail-opened.svg" alt="Email" />
                <a
                  style="word-break: break-all"
                  href="mailto:sbnguyentriphuong@gmail.com"
                  >sbnguyentriphuong@gmail.com</a
                >
              </div>
            </div>
          </div>
        </div>
        <div class="footer-bottom">
          <hr/>
          <p>Copyright © 2024. All Rights Reserved by NTP Sports Hub.</p>
        </div>
      </div>
    </div>