// 1. Hàm kiểm tra URL và đánh dấu lại checkbox
function markCheckboxesFromURL() {
  // Lấy tham số từ URL
  const urlParams = new URLSearchParams(window.location.search);
  const cartIds = urlParams.get("cart_id");
  const courtScheduleIds = urlParams.get("court_schedule_id");

  // Kiểm tra nếu có tham số cart_id và court_schedule_id trong URL
  if (cartIds && courtScheduleIds) {
    // Tách các giá trị cart_id và court_schedule_id thành mảng
    const cartIdArray = cartIds.split(",");
    const courtScheduleIdArray = courtScheduleIds.split(",");

    // Duyệt qua mảng và đánh dấu checkbox tương ứng
    cartIdArray.forEach(function (cartId, index) {
      const cbId =
        "cart_id_" +
        cartId +
        "_court_schedule_id_" +
        courtScheduleIdArray[index];
      const checkbox = document.getElementById(cbId);
      if (checkbox) {
        checkbox.checked = true;
      }
    });
  }
}

// Gọi hàm markCheckboxesFromURL khi trang được tải lại
window.addEventListener("load", function () {
  markCheckboxesFromURL();
});

// 2. Hàm cập nhật URL khi tick vào checkbox
function updateURL(checkbox) {
  var urlParams = new URLSearchParams(window.location.search);
  var cartIds = [];
  var courtScheduleIds = [];

  // Lấy giá trị của checkbox được tick
  var checkboxes = document.querySelectorAll('input[type="checkbox"]:checked');
  checkboxes.forEach(function (cb) {
    cartIds.push(cb.getAttribute("name").split("_")[2]);
    courtScheduleIds.push(cb.getAttribute("name").split("_")[6]);
  });

  urlParams.set("cart_id", cartIds.join(","));
  urlParams.set("court_schedule_id", courtScheduleIds.join(","));

  // Thêm tham số vào URL và reload trang
  window.history.replaceState(
    {},
    "",
    `${window.location.pathname}?${urlParams}`
  );

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
}
