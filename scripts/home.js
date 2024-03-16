function changeFooterImageSrc() {
  var NTPLogo = document.getElementById("NTP-logo-img");
  NTPLogo.src = "./image/footer-img/footer-logo.svg";

  var phone = document.getElementById("phone-img");
  phone.src = "./image/footer-img/call.svg";

  var address = document.getElementById("address-img");
  address.src = "./image/footer-img/location.svg";

  var facebook = document.getElementById("facebook-img");
  facebook.src = "./image/footer-img/facebook.svg";

  var email = document.getElementById("email-img");
  email.src = "./image/footer-img/mail-opened.svg";
}

changeFooterImageSrc();
