//1. Hàm nhận giá trị sao khi khách hàng đánh giá và chuyển src hình ảnh
function setStarRating(rating, orderId) {
  // Get all star icons for a specific order
  const stars = document.querySelectorAll(`.star-icon[data-rating]`);

  stars.forEach((star, idx) => {
    const starRating = parseInt(star.getAttribute("data-rating"));
    if (starRating <= rating) {
      star.src = "../image/sport-court-details-img/vuesaxboldstar.svg"; // Change to yellow star
    } else {
      star.src = "../image/sport-court-details-img/vuesaxboldstar-gray.svg"; // Keep gray star
    }
  });

  // Cập nhật trạng thái tương ứng với sao
  const reviewStatus = document.querySelector(`.review-status-${orderId}`);
  if (reviewStatus) {
    const statuses = [
      "Không xác định",
      "Không thích",
      "Tạm được",
      "Bình thường",
      "Rất tốt",
      "Tuyệt vời",
    ];
    reviewStatus.textContent = statuses[rating - 1] || statuses[0];
  }

  // Truyền giá trị sao tương ứng vào input
  const inputElement = document.getElementById("review_star_rate_" + orderId);
  if (inputElement) {
    inputElement.value = rating;
  }
}

// 2. Hàm chuyển thành đơn vị tiền tệ VND
function formatCurrency(number) {
  return new Intl.NumberFormat("vi-VN", {
    style: "currency",
    currency: "VND",
  }).format(number);
}

let totalPayments = document.querySelectorAll(".payment-amount");
let totalDeposits = document.querySelectorAll(".deposit-amount");

totalPayments.forEach((payment) => {
  payment.textContent = formatCurrency(payment.textContent);
});

totalDeposits.forEach((deposit) => {
  deposit.textContent = formatCurrency(deposit.textContent);
});

// Lấy ô input và thẻ chứa kết quả
const searchInput = document.querySelector(".search-input");
const bookingSections = document.querySelectorAll(".booking-details");

// Lắng nghe sự kiện khi người dùng nhập vào ô tìm kiếm
searchInput.addEventListener("input", function () {
  const searchText = this.value.trim().toLowerCase(); // Lấy nội dung nhập và chuyển thành chữ thường

  // Lặp qua từng phần tử và ẩn hoặc hiển thị tùy thuộc vào nội dung tìm kiếm
  bookingSections.forEach((section) => {
    const bookingInfo = section
      .querySelector(".booking-info-item")
      .textContent.toLowerCase(); // Lấy nội dung booking info

    // Nếu nội dung booking info chứa nội dung tìm kiếm, hiển thị section, ngược lại ẩn
    if (bookingInfo.includes(searchText)) {
      section.style.display = "flex";
    } else {
      section.style.display = "none";
    }
  });
});

document.addEventListener("DOMContentLoaded", function () {
  // Lặp qua tất cả các form đánh giá
  document.querySelectorAll(".review-section").forEach(function (form) {
    const loadMoreButton = form.querySelector(".load-more-reviews-btn");
    const reviewers = form.querySelectorAll(".reviewer");

    // Ẩn tất cả các đánh giá ngoại trừ 3 đánh giá đầu tiên
    for (let i = 3; i < reviewers.length; i++) {
      reviewers[i].style.display = "none";
    }

    // Xử lý sự kiện khi bấm vào nút "Xem thêm đánh giá"
    loadMoreButton.addEventListener("click", function () {
      // Hiển thị tất cả các đánh giá
      reviewers.forEach(function (reviewer) {
        reviewer.style.display = "flex";
      });
      // Ẩn nút "Xem thêm đánh giá"
      loadMoreButton.style.display = "none";
    });
  });
});

document.addEventListener("DOMContentLoaded", function () {
  // Lặp qua tất cả các form đánh giá
  document.querySelectorAll(".review-section").forEach(function (form) {
    var dataAggregator = form.querySelector(".data-aggregator1");
    var reviewStatus = dataAggregator.getAttribute("data-review-status");

    // Nếu reviewStatus là "Đã đánh giá", ẩn data-aggregator1 và nút đóng lại
    if (reviewStatus === "Đã đánh giá") {
      dataAggregator.style.display = "none";
      form.querySelector(".close-button").style.display = "none";
    }
  });
});

let isInputReviewVisible = true;

function toggleInputReview() {
  const dataAggregator = document.querySelector(".data-aggregator1");
  const closeButton = document.getElementById("close-button");

  if (isInputReviewVisible) {
    dataAggregator.style.display = "none";
    closeButton.style.backgroundColor = "#4285F4"; // Đổi màu nền

    closeButton.querySelector(".close-text").innerText = "Gửi đánh giá của bạn";
  } else {
    dataAggregator.style.display = "flex";
    closeButton.style.backgroundColor = "#9CC1FF"; // Đổi màu nền

    closeButton.querySelector(".close-text").innerText = "Đóng lại";
  }
  isInputReviewVisible = !isInputReviewVisible;
}

// Lưu trữ tất cả các phần tử booking-details trong một mảng
var bookingDetails = document.querySelectorAll(".booking-details");
var bookingDetailsArray = Array.from(bookingDetails);

// Ẩn tất cả các phần tử booking-details từ vị trí thứ 3 trở đi
bookingDetailsArray.slice(3).forEach(function (element) {
  element.style.display = "none";
});

// Sự kiện click cho nút "Xem thêm"
document
  .getElementById("show-more-button")
  .addEventListener("click", function () {
    // Lặp qua ba phần tử cuối cùng trong mảng và thay đổi trạng thái hiển thị của chúng
    for (var i = 3; i < bookingDetailsArray.length; i++) {
      if (bookingDetailsArray[i].style.display === "none") {
        bookingDetailsArray[i].style.display = "flex";
      }
    }

    // Ẩn nút "Xem thêm" sau khi đã hiển thị tất cả các phần tử
    this.style.display = "none";
  });

document
  .getElementById("show-more-button")
  .addEventListener("click", function () {
    // Lấy tất cả các phần tử có lớp hidden
    var hiddenSections = document.querySelectorAll(".booking-details.hidden");

    // Lặp qua từng phần tử hidden và loại bỏ lớp hidden
    hiddenSections.forEach(function (section) {
      section.classList.remove("hidden");
    });

    // Ẩn nút "Xem thêm" sau khi đã hiển thị tất cả các phần tử
    this.style.display = "none";
  });

function showSuccessMessage() {
  // Kiểm tra biến JavaScript để xác định khi nào hiển thị message
  if (cancelSuccess) {
    // Hiển thị message
    document.getElementById("message-sucess").style.display = "flex";
    document.getElementById("overlay").style.display = "block";
    setTimeout(function () {
      location.reload();
    }, 500);
  }
}
showSuccessMessage();

var isFormSubmitted = false;

// Hàm để kiểm tra và thực hiện submit form
function checkInputsAndSubmit(formId) {
  var form = document.getElementById(formId);
  var courtScheduleId = form.querySelector(
    "input[name='court_schedule_id']"
  ).value;
  var accountId = form.querySelector("input[name='account_id']").value;
  var reviewStarRate = form.querySelector(
    "input[name='review_star_rate']"
  ).value;
  var reviewText = form.querySelector("textarea[name='review_text']").value;

  if (
    !isFormSubmitted &&
    courtScheduleId &&
    accountId &&
    reviewStarRate &&
    reviewText
  ) {
    // Nếu tất cả các trường đều có giá trị và form chưa được gửi, thực hiện submit form
    form.submit();
    // Đặt biến flag thành true để ngăn chặn việc submit lần sau
    isFormSubmitted = true;
  } else {
    // Nếu có trường nào đó không có giá trị hoặc form đã được gửi, hiển thị thông báo cho người dùng
    var messageReviewStatus = form.querySelector(".message-review-status");
    messageReviewStatus.style.display = "flex";
    // Gọi hàm rung và ẩn thông báo sau một khoảng thời gian
    shakeAndHide(messageReviewStatus);
  }
}

// Hàm để rung và ẩn phần tử
function shakeAndHide(element) {
  // Thêm hiệu ứng rung vào phần tử
  element.classList.add("shake");
  // Sau khoảng thời gian nhất định, ẩn phần tử và loại bỏ hiệu ứng rung
  setTimeout(function () {
    element.style.display = "none";
    element.classList.remove("shake");
  }, 1000); // 1 giây
}

function showReviewForm(courtOrderId) {
  var reviewSection = document.getElementById("review-section-" + courtOrderId);
  if (reviewSection) {
    reviewSection.style.display = "block";
    document.getElementById("overlay").style.display = "block";
  }
}

var reviewButtons = document.getElementsByClassName("review-button");

for (var i = 0; i < reviewButtons.length; i++) {
  reviewButtons[i].addEventListener("click", function (event) {
    event.stopPropagation();
    // Get the court order id from the data attribute
    var courtOrderId = this.getAttribute("data-court-order-id");
    showReviewForm(courtOrderId);
  });
}
function hideFormrating(courtOrderId) {
  // Tìm form dựa trên courtOrderId và ẩn nó đi
  var formId = "review-section-" + courtOrderId;
  var form = document.getElementById(formId);
  if (form) {
    form.style.display = "none";
    document.getElementById("overlay").style.display = "none";
  }
}

document
  .getElementById("cancel-order-button")
  .addEventListener("click", function (event) {
    // Ngăn chặn sự kiện lan truyền đến các phần tử cha

    // Hiển thị form
    showConfirmationForm();
  });

function hideForm() {
  document.getElementById("cancellation-form").style.display = "none";
  document.getElementById("confirmation-form").style.display = "none";
  document.getElementById("review-section").style.display = "none";

  document.getElementById("overlay").style.display = "none";
}
// Hàm để hiển thị form hủy đơn
function showCancellationForm(courtOrderId) {
  // Tạo id của form hủy đơn dựa trên courtOrderId
  var formId = "cancellation-form-" + courtOrderId;
  var cancellationForm = document.getElementById(formId);
  if (cancellationForm) {
    cancellationForm.style.display = "block";
    document.getElementById("overlay").style.display = "block";
  }
}

// Lấy tất cả các nút "Hủy Đơn Đặt Sân"
var cancelButtons = document.getElementsByClassName("cancel-button");

// Lặp qua từng nút và thêm sự kiện click
for (var i = 0; i < cancelButtons.length; i++) {
  cancelButtons[i].addEventListener("click", function (event) {
    event.stopPropagation();
    // Lấy court_order_id từ data attribute của nút
    var courtOrderId = this.getAttribute("data-court-order-id");
    showCancellationForm(courtOrderId);
  });
}

function hideForm() {
  // Ẩn form và overlay (nền đen)
  document.querySelector(".cancellation-form").style.display = "none";
  document.getElementById("overlay").style.display = "none";
}

// Lấy tất cả các nút "Huỷ Đơn Đặt Sân"
var cancelButtons = document.querySelectorAll(".cancel-order-button");

// Lặp qua từng nút và thêm sự kiện click
cancelButtons.forEach(function (cancelButton) {
  cancelButton.addEventListener("click", function () {
    // Lấy court order id từ thuộc tính data
    var courtOrderId = this.getAttribute("data-court-order-id");
    // Hiển thị form xác nhận hủy đơn tương ứng
    showConfirmationForm(courtOrderId);
  });
});

// Hàm để hiển thị form xác nhận hủy đơn và truyền giá trị lý do hủy từ form hủy đơn vào
function showConfirmationForm(courtOrderId) {
  // Tắt form hủy đơn trước khi hiển thị form xác nhận
  hideCancellationForm(courtOrderId);

  // Tìm form hủy đơn dựa trên court order id
  var cancellationForm = document.getElementById(
    "cancellation-form-" + courtOrderId
  );
  if (cancellationForm) {
    // Lấy giá trị lý do hủy từ form hủy đơn
    var cancellationReason = getCancellationReason(cancellationForm);
    // Tìm form xác nhận hủy đơn dựa trên court order id
    var confirmationForm = document.getElementById(
      "confirmation-form-" + courtOrderId
    );
    if (confirmationForm) {
      // Hiển thị form xác nhận hủy đơn
      confirmationForm.style.display = "block";
      // Truyền giá trị lý do hủy vào form xác nhận hủy đơn
      var cancelReasonInput = confirmationForm.querySelector("#cancel_reason");
      if (cancelReasonInput) {
        cancelReasonInput.value = cancellationReason;
      }
      // Hiển thị overlay (nếu có)
      document.getElementById("overlay").style.display = "block";
    }
  }
}
// Hàm để lấy giá trị lý do hủy từ form hủy đơn
function getCancellationReason(cancellationForm) {
  // Tìm tất cả các input radio trong form hủy đơn có name là "cancellation-reason"
  var reasonInputs = cancellationForm.querySelectorAll(
    'input[name="cancellation-reason"]'
  );
  // Duyệt qua từng input radio để kiểm tra xem input nào được chọn và lấy giá trị của data-reason
  for (var i = 0; i < reasonInputs.length; i++) {
    if (reasonInputs[i].checked) {
      return reasonInputs[i].getAttribute("data-reason");
    }
  }
  // Nếu không có input nào được chọn, trả về null
  return null;
}

// Hàm để tắt form hủy đơn
function hideCancellationForm(courtOrderId) {
  // Tìm form hủy đơn dựa trên court order id
  var cancellationForm = document.getElementById(
    "cancellation-form-" + courtOrderId
  );
  if (cancellationForm) {
    // Ẩn form hủy đơn
    cancellationForm.style.display = "none";
    // Ẩn overlay (nếu có)
    document.getElementById("overlay").style.display = "none";
  }
}

// Hàm để tắt form xác nhận hủy đơn
function hideConfirmationForm(courtOrderId) {
  // Tìm form xác nhận hủy đơn dựa trên court order id
  var confirmationForm = document.getElementById(
    "confirmation-form-" + courtOrderId
  );
  if (confirmationForm) {
    // Ẩn form xác nhận hủy đơn
    confirmationForm.style.display = "none";
    // Ẩn overlay (nếu có)
    document.getElementById("overlay").style.display = "none";
  }
}
