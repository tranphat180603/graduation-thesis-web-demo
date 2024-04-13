function togglePasswordVisibility() {
  var eyeIcon = document.getElementById("eye");
  var passwordField = document.getElementById("sign-up-pass-input-text");
  if (passwordField.type === "password") {
    passwordField.type = "text";
    eyeIcon.src = "../image/sign-up-img/hide.svg";
  } else {
    passwordField.type = "password";
    eyeIcon.src = "../image/sign-up-img/show.svg";
  }
}

function moveToPhone() {
  window.location.href = "../views/sign-up-method-phone.php";
}

function moveToEmail() {
  window.location.href = "../views/sign-up-method-email.php";
}

function goBack() {
  window.history.go(-1);
}

const sign_up_name = document.querySelector("#sign-up-name-input-text"),
  sign_up_name_input = document.querySelector(".sign-up-name-input"),
  sign_up_phone = document.querySelector("#sign-up-phone-input-text"),
  sign_up_phone_input = document.querySelector(".sign-up-phone-input"),
  sign_up_email = document.querySelector("#sign-up-email-input-text"),
  sign_up_email_input = document.querySelector(".sign-up-email-input"),
  sign_up_acc_name = document.getElementById("sign-up-acc-name-input-text"),
  sign_up_acc_name_input = document.querySelector(".sign-up-acc-name-input"),
  sign_up_pass = document.getElementById("sign-up-pass-input-text"),
  sign_up_pass_input = document.querySelector(".sign-up-pass-input");

//Hàm kiểm tra định dạng của tên đăng ký
function checkSignUpName() {
  var checkImg = document.getElementById("check"),
    warningDiv = document.querySelector(".warning"),
    next_button = document.getElementById("next-button");
  const pattern = /^[a-zA-Z0-9]{10,50}$/; // Biểu thức chính quy

  if (pattern.test(sign_up_name.value)) {
    // Tên đăng ký hợp lệ
    sign_up_name_input.style.border = "1px solid #34C759";
    checkImg.style.display = "block";
    warningDiv.style.visibility = "hidden"; // Ẩn cảnh báo nếu có
    next_button.style.pointerEvents = "auto";
    next_button.style.backgroundColor = "#285d8f";
  } else {
    // Tên đăng ký không hợp lệ
    sign_up_name_input.style.border = "1px solid #FF4141";
    checkImg.style.display = "none"; // Ẩn hình ảnh kiểm tra nếu tên không hợp lệ
    warningDiv.style.visibility = "visible"; // Hiển thị cảnh báo
    next_button.style.pointerEvents = "none"; //Không cho ấn nút TIẾP THEO khi không hợp lệ
    next_button.style.backgroundColor = "#5680a7";
  }
}

sign_up_name.addEventListener("input", function () {
  checkSignUpName();
});

//Hàm kiểm tra định dạng của SĐT (không hoạt động)
function checkSignUpPhone() {
  var checkImgPhone = document.getElementById("check-phone"),
    warningDivPhone = document.querySelector(".warning-phone"),
    phone_next_button = document.getElementById("phone-next-button");
  const pattern_phone = /^\d{10}$/; // Biểu thức chính quy

  if (pattern_phone.test(sign_up_phone.value)) {
    // SĐT hợp lệ
    sign_up_phone_input.style.border = "1px solid #34C759";
    checkImgPhone.style.display = "block";
    warningDivPhone.style.visibility = "hidden"; // Ẩn cảnh báo nếu có
    phone_next_button.style.pointerEvents = "auto";
    phone_next_button.style.backgroundColor = "#285d8f";
  } else {
    // SĐT không hợp lệ
    sign_up_phone_input.style.border = "1px solid #FF4141";
    checkImgPhone.style.display = "none"; // Ẩn hình ảnh kiểm tra nếu tên không hợp lệ
    warningDivPhone.style.visibility = "visible"; // Hiển thị cảnh báo
    phone_next_button.style.pointerEvents = "none"; //Không cho ấn nút TIẾP THEO khi không hợp lệ
    phone_next_button.style.backgroundColor = "#5680a7";
  }
}

sign_up_phone.addEventListener("input", function () {
  checkSignUpPhone();
});

//Hàm kiểm tra định dạng của email
function checkSignUpEmail() {
  var checkImgEmail = document.getElementById("check-email"),
    warningDivEmail = document.querySelector(".warning-email"),
    email_next_button = document.getElementById("email-next-button");
  const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; // Biểu thức chính quy

  if (pattern_email.test(sign_up_email.value)) {
    // Email hợp lệ
    sign_up_email_input.style.border = "1px solid #34C759";
    checkImgEmail.style.display = "block";
    warningDivEmail.style.visibility = "hidden"; // Ẩn cảnh báo nếu có
    email_next_button.style.pointerEvents = "auto";
    email_next_button.style.backgroundColor = "#285d8f";
  } else {
    // Email không hợp lệ
    sign_up_email_input.style.border = "1px solid #FF4141";
    checkImgEmail.style.display = "none"; // Ẩn hình ảnh kiểm tra nếu tên không hợp lệ
    warningDivEmail.style.visibility = "visible"; // Hiển thị cảnh báo
    email_next_button.style.pointerEvents = "none"; //Không cho ấn nút TIẾP THEO khi không hợp lệ
    email_next_button.style.backgroundColor = "#5680a7";
  }
}

sign_up_email.addEventListener("input", function () {
  checkSignUpEmail();
});

//Hàm kiểm tra định dạng của tên tài khoản (không hoạt động)
function checkSignUpAccName() {
  var checkImgAcc = document.getElementById("check-acc"),
    warningDivAcc = document.querySelector(".warning-acc"),
    acc_next_button = document.getElementById("acc-name-continue");
  const pattern_acc = /^[a-zA-Z0-9]+$/; // Biểu thức chính quy

  if (pattern_acc.test(sign_up_acc_name.value)) {
    // Tên tài khoản hợp lệ
    sign_up_acc_name_input.style.border = "1px solid #34C759";
    checkImgAcc.style.display = "block";
    warningDivAcc.style.visibility = "hidden"; // Ẩn cảnh báo nếu có
    acc_next_button.style.pointerEvents = "auto";
    acc_next_button.style.backgroundColor = "#285d8f";
  } else {
    // Tên tài khoản không hợp lệ
    sign_up_acc_name_input.style.border = "1px solid #FF4141";
    checkImgAcc.style.display = "none"; // Ẩn hình ảnh kiểm tra nếu tên không hợp lệ
    warningDivAcc.style.visibility = "visible"; // Hiển thị cảnh báo
    acc_next_button.style.pointerEvents = "none"; //Không cho ấn nút TIẾP THEO khi không hợp lệ
    acc_next_button.style.backgroundColor = "#5680a7";
  }
}

sign_up_acc_name.addEventListener("input", function () {
  checkSignUpAccName();
});

//Hàm kiểm tra định dạng của mật khẩu (không hoạt động)
function checkSignUpPass() {
  var checkImgPass = document.getElementById("check-pass"),
    warningDivPass = document.querySelector(".warning-pass"),
    sign_up_button = document.getElementById("sign-up-button");
  const pattern_pass =
    /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()\-_+=\[{\]};:'",.<>?]).{15,30}$/; // Biểu thức chính quy

  if (pattern_pass.test(sign_up_pass.value)) {
    // Mật khẩu hợp lệ
    sign_up_pass_input.style.border = "1px solid #34C759";
    checkImgPass.style.display = "block";
    warningDivPass.style.visibility = "hidden"; // Ẩn cảnh báo nếu có
    sign_up_button.style.pointerEvents = "auto";
    sign_up_button.style.backgroundColor = "#285d8f";
  } else {
    // Mật khẩu không hợp lệ
    sign_up_pass_input.style.border = "1px solid #FF4141";
    checkImgPass.style.display = "none"; // Ẩn hình ảnh kiểm tra nếu tên không hợp lệ
    warningDivPass.style.visibility = "visible"; // Hiển thị cảnh báo
    sign_up_button.style.pointerEvents = "none"; //Không cho ấn nút TIẾP THEO khi không hợp lệ
    sign_up_button.style.backgroundColor = "#5680a7";
  }
}

sign_up_pass.addEventListener("input", function () {
  checkSignUpPass();
});
