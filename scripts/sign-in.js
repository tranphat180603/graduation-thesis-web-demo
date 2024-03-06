function togglePasswordVisibility() {
  var eyeIcon = document.getElementById("eye");
  var passwordField = document.getElementById("sign-in-pass-input-text");
  if (passwordField.type === "password") {
    passwordField.type = "text";
    eyeIcon.src = "../image/sign-in-img/hide.svg";
  } else {
    passwordField.type = "password";
    eyeIcon.src = "../image/sign-in-img/show.svg";
  }
}
