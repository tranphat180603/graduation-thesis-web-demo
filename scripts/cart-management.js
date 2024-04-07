// Hàm cập nhật URL khi tick vào checkbox trong bảng HTML
function updateURL(checkbox) {
  var cartIds = [];
  var courtScheduleIds = [];
  var checkboxes = document.querySelectorAll('input[type="checkbox"]:checked');

  checkboxes.forEach(function (cb) {
    cartIds.push(cb.getAttribute("name").split("_")[2]);
  });

  checkboxes.forEach(function (cb) {
    courtScheduleIds.push(cb.getAttribute("name").split("_")[6]);
  });

  var urlParams = new URLSearchParams(window.location.search);
  urlParams.set("cart_id", cartIds.join(","));
  urlParams.set("court_schedule_id", courtScheduleIds.join(","));

  // Kiểm tra xem nếu không có checkbox nào được chọn, loại bỏ tham số 'cart_id' và 'court_schedule_id' khỏi URL
  if (cartIds.length === 0 && courtScheduleIds.length === 0) {
    urlParams.delete("cart_id");
    urlParams.delete("court_schedule_id");
  }
  window.history.replaceState(
    {},
    "",
    `${window.location.pathname}?${urlParams}`
  );

  location.reload();

  window.addEventListener("load", function () {
    console.log(cartId[0]);
    console.log(courtScheduleId[0]);

    // Tạo ID của checkbox dựa trên giá trị của cart_id và court_schedule_id
    var cbId =
      "cart_id_" + cartId[0] + "_court_schedule_id_" + courtScheduleId[0];

    // Tìm checkbox với ID tương ứng và đánh dấu nó là checked
    var cb = document.getElementById(cbId);
    if (cb) {
      cb.checked = true;
    }
  });
}
