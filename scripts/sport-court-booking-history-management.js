document.addEventListener("DOMContentLoaded", function () {
  // Lấy danh sách các sao
  const starIcons = document.querySelectorAll(".star-icon");
  // Lấy phần tử hiển thị trạng thái
  const reviewStatus = document.querySelector(".review-status");

  // Đặt sự kiện khi nhấn vào các sao
  starIcons.forEach((star) => {
    star.addEventListener("click", () => {
      const rating = star.dataset.rating; // Lấy giá trị data-rating của sao được nhấn
      // Thay đổi màu của các sao tùy theo số sao được nhấn
      starIcons.forEach((s) => {
        if (s.dataset.rating <= rating) {
          s.src = "../image/sport-court-details-img/vuesaxboldstar.svg"; // Hiển thị sao màu vàng
        } else {
          s.src = "../image/sport-court-details-img/vuesaxboldstar-gray.svg"; // Hiển thị sao màu xám
        }
      });
      // Cập nhật trạng thái dựa trên số sao được chọn
      switch (parseInt(rating)) {
        case 1:
          reviewStatus.textContent = "Không thích";
          break;
        case 2:
          reviewStatus.textContent = "Tạm được";
          break;
        case 3:
          reviewStatus.textContent = "Bình thường";
          break;
        case 4:
          reviewStatus.textContent = "Rất tốt";
          break;
        case 5:
          reviewStatus.textContent = "Tuyệt vời";
          break;
        default:
          reviewStatus.textContent = "Không xác định";
      }
    });
  });
});

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
  const loadMoreButton = document.querySelector(".load-more-reviews-btn");
  const reviewers = document.querySelectorAll(".reviewer");

  // Ẩn tất cả các đánh giá vượt quá 3 đánh giá ban đầu
  reviewers.forEach(function (reviewer, index) {
    if (index >= 3) {
      reviewer.style.display = "none";
    }
  });

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

document.addEventListener("DOMContentLoaded", function () {
  var dataAggregator = document.querySelector(".data-aggregator1");
  var reviewStatus = dataAggregator.getAttribute("data-review-status");
  // Nếu đã đánh giá thì ẩn trường nhập liệu
  if (reviewStatus === "Đã đánh giá") {
    dataAggregator.style.display = "none";
  }
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

function shakeAndHide(element) {
  element.classList.add("shake");
  setTimeout(function () {
    element.style.display = "none";
    element.classList.remove("shake");
  }, 1000); // Thời gian để rung rung trước khi ẩn phần tử
}

var isFormSubmitted = false;

// Hàm để kiểm tra và thực hiện submit form
// Hàm để kiểm tra và thực hiện submit form
function checkInputsAndSubmit() {
  var courtScheduleId = document.getElementById("court_schedule_id").value;
  var accountId = document.getElementById("account_id").value;
  var reviewStarRate = document.getElementById("review_star_rate").value;
  var reviewText = document.getElementById("review_text").value;

  if (
    !isFormSubmitted &&
    courtScheduleId &&
    accountId &&
    reviewStarRate &&
    reviewText
  ) {
    // Nếu tất cả các trường đều có giá trị, tiến hành submit form
    document.getElementById("review-section").submit();
    // Đặt biến flag thành true để ngăn chặn việc submit lần sau
    isFormSubmitted = true;
  } else {
    // Nếu có trường nào đó không có giá trị, hiển thị thông báo hoặc thực hiện hành động khác tùy ý
    var messageReviewStatus = document.querySelector(".message-review-status");
    messageReviewStatus.style.display = "flex";
    shakeAndHide(messageReviewStatus); // Gọi hàm rung rung và ẩn phần tử
  }
}

function setStarRating(rating) {
  document.getElementById("review_star_rate").value = rating;
}

function showForm() {
  document.getElementById("cancellation-form").style.display = "block";
  document.getElementById("overlay").style.display = "block";
}

function showratingForm() {
  document.getElementById("review-section").style.display = "block";
  document.getElementById("overlay").style.display = "block";
}

// Get all elements with the class "review-button"
var reviewButtons = document.getElementsByClassName("review-button");

// Loop through each button and add event listener
for (var i = 0; i < reviewButtons.length; i++) {
  reviewButtons[i].addEventListener("click", function (event) {
    event.stopPropagation();
    showratingForm();
  });
}

// Hàm để ẩn form

function showConfirmationForm() {
  document.getElementById("cancellation-form").style.display = "none";
  document.getElementById("confirmation-form").style.display = "block";
  // Lấy thông tin từ form hủy đơn
  var canceledOnDate = new Date().toISOString().slice(0, 10); // Lấy ngày hiện tại
  var cancelReason = document.querySelector(
    'input[name="cancellation-reason"]:checked'
  ).nextElementSibling.textContent;

  // Gán thông tin vào form xác nhận
  document.getElementById("canceled_on_date").value = canceledOnDate;
  document.getElementById("cancel_reason").value = cancelReason;
}

// Thêm sự kiện click cho button mở form
document
  .getElementById("show-cancel-form")
  .addEventListener("click", function (event) {
    event.stopPropagation();
    // Hiển thị form
    showForm();
  });

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
