document.addEventListener("DOMContentLoaded", function () {
  var currentImageIndex = 0;
  var totalImages = parseInt(
    document.getElementById("image-data").getAttribute("data-total-images")
  );

  function nextImage() {
    currentImageIndex = (currentImageIndex + 1) % totalImages;
    updateImage();
  }

  function prevImage() {
    currentImageIndex = (currentImageIndex - 1 + totalImages) % totalImages;
    updateImage();
  }

  function selectImage(index) {
    currentImageIndex = index;
    updateImage();
  }

  function updateImage() {
    var imageList = document.getElementsByClassName("court-img");
    var mainImage = document.getElementsByClassName("court-img-main")[0];
    mainImage.src = imageList[currentImageIndex].src;

    // Remove 'selected-image' class from all images in the list
    for (var i = 0; i < imageList.length; i++) {
      imageList[i].classList.remove("selected-image");
    }
    // Add 'selected-image' class to the selected image
    imageList[currentImageIndex].classList.add("selected-image");
  }

  // Attach event listeners to next and previous buttons
  document.querySelector(".dichuyenphai").addEventListener("click", nextImage);
  document.querySelector(".dichuyentrai").addEventListener("click", prevImage);

  // Attach event listener to each image in the list
  var imageList = document.getElementsByClassName("court-img");
  for (var i = 0; i < imageList.length; i++) {
    imageList[i].addEventListener("click", function () {
      var index = Array.from(imageList).indexOf(this);
      selectImage(index);
    });
  }
});

document.addEventListener("DOMContentLoaded", function () {
  var timeDropdown = document.getElementById("time-dropdown");
  var minPriceSpan = document.querySelector(".min-price");
  var maxPriceSpan = document.querySelector(".max-price");
  var formatter = new Intl.NumberFormat("vi-VN", {
    style: "currency",
    currency: "VND",
  });

  // Lưu giữ giá trị min và max price ban đầu từ các thuộc tính data
  var initialMinPrice = parseFloat(minPriceSpan.getAttribute("data-min-price"));
  var initialMaxPrice = parseFloat(maxPriceSpan.getAttribute("data-max-price"));

  // Kiểm tra xem giá trị có phải là một số hợp lệ không
  if (!isNaN(initialMinPrice) && !isNaN(initialMaxPrice)) {
    // Chuyển đổi giá trị ban đầu thành tiền tệ và cập nhật nội dung của các phần tử
    minPriceSpan.textContent = formatCurrency(initialMinPrice) + "/h - ";
    maxPriceSpan.textContent = formatCurrency(initialMaxPrice) + "/h";
  }

  timeDropdown.addEventListener("change", function () {
    var selectedTimeFrame = this.value;
    var selectedTimeFrameData = timeFrames.find(function (frame) {
      return frame.court_schedule_time_frame === selectedTimeFrame;
    });

    if (selectedTimeFrameData) {
      var formattedPrice = formatter.format(selectedTimeFrameData.court_price);
      minPriceSpan.textContent = formattedPrice;
      maxPriceSpan.textContent = null;
    } else {
      // Nếu không chọn thời gian, cập nhật lại giá trị min và max price ban đầu
      minPriceSpan.textContent = formatCurrency(initialMinPrice) + "/h - ";
      maxPriceSpan.textContent = formatCurrency(initialMaxPrice) + "/h";
    }
  });

  // Xử lý sự kiện khi người dùng xóa ngày

  // Hàm để định dạng số thành tiền tệ
  function formatCurrency(amount) {
    return new Intl.NumberFormat("vi-VN", {
      style: "currency",
      currency: "VND",
    }).format(amount);
  }
});
document.addEventListener("DOMContentLoaded", function () {
  var selectedDateInput = document.getElementById("selected_date");
  var minPriceSpan = document.querySelector(".min-price");
  var maxPriceSpan = document.querySelector(".max-price");

  selectedDateInput.addEventListener("change", function () {
    var selectedDate = this.value;

    if (!selectedDate) {
      clearPrices();
    }
  });
  function clearPrices() {
    // Xóa giá trị min và max price khi ngày được xóa
    minPriceSpan = document.querySelector(".min-price");
    maxPriceSpan = document.querySelector(".max-price");
  }
});
document.addEventListener("DOMContentLoaded", function () {
  var serviceDropdown = document.querySelector(".service-dropdown");
  var serviceQuantityInput = document.querySelector(".service-quantity");
  var servicePriceDisplay = document.getElementById("service-price-display");
  var addServiceBtn = document.querySelector(".add-service-btn");
  var serviceContainer = document.querySelector(".selected-services");
  var selectedServicesInput = document.getElementById(
    "selected-services-input"
  );
  var serviceTotalAmountInput = document.getElementById("total_service_amount");

  // Khai báo biến để lưu trữ mảng dịch vụ
  var selectedServicesArray = [];

  // Danh sách các dịch vụ, ID và giá tương ứng
  var services = [];
  var serviceIDs = []; // Mảng chứa các ID của dịch vụ
  var servicePrices = [];
  var options = serviceDropdown.querySelectorAll("option");
  options.forEach(function (option) {
    services.push(option.value);
    serviceIDs.push(option.getAttribute("data-id")); // Lấy ID của dịch vụ từ thuộc tính 'data-id'
    servicePrices.push(parseFloat(option.getAttribute("data-price")));
  });

  // Hàm cập nhật giá dịch vụ khi thay đổi lựa chọn
  function updateServicePrice() {
    var selectedService = serviceDropdown.value;
    var selectedIndex = services.indexOf(selectedService);

    if (selectedIndex !== -1) {
      var selectedPrice = servicePrices[selectedIndex];
      var quantity = serviceQuantityInput.value;
      var totalPrice = selectedPrice * quantity;
      var formattedPrice = totalPrice.toLocaleString("vi-VN", {
        style: "currency",
        currency: "VND",
      });
      servicePriceDisplay.innerText = formattedPrice;
    } else {
      servicePriceDisplay.innerText = "Giá dịch vụ chưa được xác định";
    }
  }

  function addService() {
    var selectedService = serviceDropdown.value;
    var quantity = parseInt(serviceQuantityInput.value);

    if (selectedService && !isNaN(quantity) && quantity > 0) {
      var existingService = serviceContainer.querySelector(
        '.dch-v[data-service="' + selectedService + '"]'
      );
      if (existingService) {
        var existingQuantity = parseInt(
          existingService
            .querySelector(".quantity")
            .innerText.replace(/[\(\)]/g, "")
        );
        var totalQuantity = existingQuantity + quantity;
        existingService.querySelector(".quantity").innerText =
          "(" + totalQuantity + ")";
        var selectedPrice = parseFloat(existingService.dataset.price);
        existingService.querySelector(".total-price").innerText =
          "Tổng giá: " +
          (selectedPrice * totalQuantity).toLocaleString("vi-VN", {
            style: "currency",
            currency: "VND",
          });
      } else {
        var newServiceTag = document.createElement("div");
        newServiceTag.className = "dch-v";
        newServiceTag.dataset.service = selectedService;
        var selectedIndex = services.indexOf(selectedService); // Lấy chỉ mục tương ứng trong mảng services
        newServiceTag.dataset.id = serviceIDs[selectedIndex]; // Gán ID của dịch vụ từ mảng serviceIDs
        newServiceTag.dataset.price = servicePrices[selectedIndex]; // Gán giá của dịch vụ từ mảng servicePrices
        newServiceTag.innerHTML = `
                    <div class="trng-ti-2">${selectedService} <span class="quantity">(${quantity})</span></div>
                    <div class="total-price" style="display: none;">Tổng giá: ${(
                      servicePrices[selectedIndex] * quantity
                    ).toLocaleString("vi-VN", {
                      style: "currency",
                      currency: "VND",
                    })}</div>
                    <img class="vuesaxboldclose-circle-icon remove-service-icon" alt="" src="../image/sport-court-details-img/vuesaxboldclosecircle.svg">
                `;
        serviceContainer.appendChild(newServiceTag);
      }
    } else {
      alert("Vui lòng chọn dịch vụ và nhập số lượng hợp lệ.");
    }
    // Cập nhật mảng dịch vụ sau khi thêm mới
    updateSelectedServicesArray();
  }

  // Hàm cập nhật mảng dịch vụ dựa trên nội dung của <div class="selected-services">
  function updateSelectedServicesArray() {
    // Xóa các phần tử hiện có trong mảng
    selectedServicesArray = [];

    // Lấy tất cả các phần tử có class là 'dch-v' trong phần tử có class là 'selected-services'
    var selectedServiceElements = document.querySelectorAll(
      ".selected-services .dch-v"
    );

    // Duyệt qua từng phần tử và thêm thông tin vào mảng selectedServicesArray
    selectedServiceElements.forEach(function (serviceElement) {
      // Lấy dữ liệu từ các thuộc tính 'data-service', 'data-id', và 'data-price'
      var service = serviceElement.dataset.service;
      var id = serviceElement.dataset.id;
      var price = parseFloat(serviceElement.dataset.price);
      var quantity = parseInt(
        serviceElement
          .querySelector(".quantity")
          .innerText.replace(/[\(\)]/g, "")
      );

      // Thêm thông tin vào mảng selectedServicesArray
      selectedServicesArray.push({
        service: service,
        id: id,
        quantity: quantity,
        totalPrice: price * quantity,
      });
    });

    // Cập nhật giá trị của input ẩn để lưu trữ mảng dữ liệu
    selectedServicesInput.value = JSON.stringify(selectedServicesArray);

    // Tính toán và cập nhật tổng giá tiền của các dịch vụ đã chọn
    updateServiceTotalAmount();
    // Cập nhật tổng giá trị khi có bất kỳ sự thay đổi nào trong dịch vụ đã chọn
    updateTotalAmount();
  }

  // Hàm tính tổng giá tiền của các dịch vụ đã chọn
  function updateServiceTotalAmount() {
    var totalAmount = selectedServicesArray.reduce(function (acc, curr) {
      return acc + curr.totalPrice;
    }, 0);
    serviceTotalAmountInput.value = totalAmount.toFixed(2); // Giữ lại 2 chữ số lẻ
  }

  // Sự kiện khi thay đổi dịch vụ hoặc số lượng
  serviceDropdown.addEventListener("change", updateServicePrice);
  serviceQuantityInput.addEventListener("input", updateServicePrice);

  // Sự kiện khi nhấp vào nút "Thêm dịch vụ"
  addServiceBtn.addEventListener("click", addService);

  // Sự kiện click để xóa dịch vụ
  document.addEventListener("click", function (event) {
    if (event.target.classList.contains("remove-service-icon")) {
      event.target.closest(".dch-v").remove();
      // Cập nhật mảng dịch vụ sau khi xóa
      updateSelectedServicesArray();
    }
  });

  // Gọi hàm cập nhật mảng khi trang được tải
  updateSelectedServicesArray();
});

// jQuery
$(document).ready(function () {
  $(".loadmore-respond-comment").click(function () {
    var container = $(this).closest(".user-comment-section");
    toggleResponds($(this), container, 1);
  });

  $(".loadmore-respond-respond").click(function () {
    var container = $(this).closest(".response-details1");
    var level = parseInt($(this).attr("data-level")) + 1;
    toggleResponds($(this), container, level);
  });

  function toggleResponds(button, container, level) {
    var responseDetails = container.find(
      ".response-details1[data-level='" + level + "']"
    );
    var responseContainers = container.find(
      ".response-container[data-level='" + level + "']"
    );

    responseDetails.toggleClass("hidden");
    responseContainers.toggleClass("hidden");
    button.toggleClass("active");

    if (button.hasClass("active")) {
      button.html(
        '<img src="../image/sport-court-details-img/arrow-forward.svg" alt="arrow-forward"><span>Ẩn tất cả phản hồi</span>'
      );
    } else {
      button.html(
        '<img src="../image/sport-court-details-img/arrow-forward.svg" alt="arrow-forward"><span>Xem tất cả phản hồi</span>'
      );
    }
  }
});

// Đợi cho trang web được tải hoàn toàn
document.addEventListener("DOMContentLoaded", function () {
  // Lấy số lượng các phần tử chứa đánh giá
  var reviewWrappers = document.querySelectorAll(".detail-review-wrapper");

  // Lấy phần tử nút "Xem thêm đánh giá"
  var loadMoreButton = document.querySelector(".review-load-more-wrapper");

  // Nếu số lượng đánh giá lớn hơn hoặc bằng 4, hiển thị nút "Xem thêm đánh giá"
  if (reviewWrappers.length >= 4) {
    loadMoreButton.style.display = "block";
  } else {
    loadMoreButton.style.display = "none";
  }

  // Gắn sự kiện click cho nút "Xem thêm đánh giá"
  loadMoreButton.addEventListener("click", function () {
    // Hiển thị tất cả các đánh giá bằng cách thay đổi kiểu hiển thị của chúng
    reviewWrappers.forEach(function (reviewWrapper) {
      reviewWrapper.style.display = "flex";
    });

    // Ẩn nút "Xem thêm đánh giá"
    loadMoreButton.style.display = "none";
  });
});

document.addEventListener("DOMContentLoaded", function () {
  // Xử lý cho nút "Load more"
  const loadMoreButton = document.querySelector(".load-more-reviews-btn");
  if (loadMoreButton) {
    loadMoreButton.addEventListener("click", function () {
      // Khi nút được nhấp, hiển thị tất cả các đánh giá bị ẩn
      document
        .querySelectorAll('.detail-review-wrapper[style*="display: none"]')
        .forEach(function (review) {
          review.style.display = "flex";
        });
      // Sau đó ẩn nút "Load more"
      this.style.display = "none";
    });
  }
});
document.addEventListener("DOMContentLoaded", function () {
  const replyButtons = document.querySelectorAll(".reply-comment-button");

  replyButtons.forEach((button) => {
    button.onclick = function (event) {
      event.preventDefault();

      const userCommentSection = this.closest(".user-comment-section");
      const respondForm = userCommentSection.querySelector(".respond-form");

      respondForm.classList.toggle("hidden");
    };
  });
});
document.addEventListener("DOMContentLoaded", function () {
  // Lắng nghe sự kiện click trên nút 'load-more-comments-btn'
  document
    .getElementById("load-more-comments-btn")
    .addEventListener("click", function () {
      // Hiển thị tất cả các bình luận ẩn
      var hiddenComments = document.querySelectorAll(".hidden-comment");
      hiddenComments.forEach(function (comment) {
        comment.classList.remove("hidden-comment");
      });

      // Ẩn nút 'load-more-comments-btn'
      this.style.display = "none";
    });
});
document.addEventListener("DOMContentLoaded", function () {
  const replyButtons = document.querySelectorAll(".reply-respond-button");

  replyButtons.forEach((button) => {
    button.addEventListener("click", function (event) {
      // Tìm phần tử cha gần nhất có class là "response-details1"
      const responseDetails = this.closest(".response-details1");
      // Tìm phần tử ".respond-form" trong phần tử cha
      const respondForm = responseDetails.querySelector(".respond-form");
      // Kiểm tra xem phần tử ".respond-form" đã hiển thị hay chưa
      const isVisible = !respondForm.classList.contains("hidden");
      // Nếu đã hiển thị, thì ẩn nó; nếu chưa, thì hiển thị nó
      if (isVisible) {
        respondForm.classList.add("hidden");
      } else {
        // Ẩn tất cả các respond-form trước đó
        document.querySelectorAll(".respond-form").forEach((form) => {
          form.classList.add("hidden");
        });
        respondForm.classList.remove("hidden");
      }
    });
  });
});

function replaceHistoryState() {
  if (window.history.replaceState) {
    window.history.replaceState(null, null, window.location.href);
  }
}

// Gọi hàm replaceHistoryState khi DOM được tải hoàn toàn
document.addEventListener("DOMContentLoaded", function () {
  replaceHistoryState();
});
