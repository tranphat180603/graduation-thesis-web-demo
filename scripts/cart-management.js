// Khai báo một biến cờ để xác định khi nào hàm xử lý được gọi sau khi tải lại trang
var isReloaded = false;

// Hàm cập nhật URL khi tick vào checkbox trong bảng HTML
function updateURL(checkbox) {
  var cartIds = [];
  var courtScheduleIds = [];
  var checkboxes = document.querySelectorAll('input[type="checkbox"]:checked');

  checkboxes.forEach(function (cb) {
    cartIds.push(cb.getAttribute("name").split("_")[2]);
    courtScheduleIds.push(cb.getAttribute("name").split("_")[6]);
  });

  var urlParams = new URLSearchParams(window.location.search);
  urlParams.set("cart_id", cartIds.join(","));
  urlParams.set("court_schedule_id", courtScheduleIds.join(","));

  // Cập nhật URL
  window.history.replaceState(
    {},
    "",
    `${window.location.pathname}?${urlParams}`
  );

  // Tải lại trang
  window.location.reload();

  // Đặt cờ là true khi đã tải lại trang
  isReloaded = true;
}

// Xử lý checkbox sau khi trang đã được tải lại
window.addEventListener("DOMContentLoaded", function () {
  // Kiểm tra nếu trang đã được tải lại từ hàm updateURL
  if (isReloaded) {
    var checkboxes = document.querySelectorAll(
      'input[type="checkbox"]:checked'
    );
    checkboxes.forEach(function (cb) {
      var cartId = cb.getAttribute("name").split("_")[2];
      var courtScheduleId = cb.getAttribute("name").split("_")[6];
      var cbId = "cart_id_" + cartId + "_court_schedule_id_" + courtScheduleId;
      var checkbox = document.getElementById(cbId);
      if (checkbox) {
        checkbox.checked = true;
      }
    });
  }
});
