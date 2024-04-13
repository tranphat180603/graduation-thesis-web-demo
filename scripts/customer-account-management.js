//Toggle enable/disable cho các nút bấm và các input của Form
function toggleButtons(clickedBtnId) {
  var modifyBtn = document.getElementById("modify-btn");
  var cancelBtn = document.getElementById("cancel-btn");
  var saveBtn = document.getElementById("save-btn");
  var form = document.getElementById("info-inputs");
  var inputs = form.getElementsByTagName("input");

  if (clickedBtnId === "modify-btn") {
    modifyBtn.style.display = "none";
    cancelBtn.style.display = "flex";
    saveBtn.style.display = "flex";
    for (var i = 0; i < inputs.length; i++) {
      inputs[i].style.pointerEvents = "auto";
    }
    // Enable toggleContent function
    window.toggleContentEnabled = true;
    // Enable date picker functionality
    window.datePickerEnabled = true;
  } else {
    modifyBtn.style.display = "flex";
    cancelBtn.style.display = "none";
    saveBtn.style.display = "none";
    for (var i = 0; i < inputs.length; i++) {
      inputs[i].style.pointerEvents = "none";
    }
    // Disable toggleContent function
    window.toggleContentEnabled = false;
    // Disable date picker functionality
    window.datePickerEnabled = false;
  }
  return false;
}
//toggle visibility của password cũng như thay đổi hình ảnh của nó
function toggleContent(id, img) {
  // Check if toggleContent function is enabled
  if (!window.toggleContentEnabled) {
    return;
  }
  var inputField = document.getElementById(id);
  if (inputField.type === "password") {
    inputField.type = "text";
    img.src = "../image/account-management-img/hide.svg";
  } else {
    inputField.type = "password";
    img.src = "../image/account-management-img/show.svg";
  }
}

//tạo lịch cho input
document.addEventListener("DOMContentLoaded", function () {
  const birthdateInput = document.getElementById("birthdate");
  const calendarIcon = document.getElementById("calendar-icon");
  // Add event listener to the calendar icon
  calendarIcon.addEventListener("click", function () {
    if (!window.datePickerEnabled) {
      return;
    }
    flatpickr(birthdateInput, {
      dateFormat: "Y-m-d", // Date format (YYYY-MM-DD)
    });
    birthdateInput.click();
  });
});
