window.onload = function () {
  // Lấy tất cả các "court card"
  var cards = document.querySelectorAll(".court-card");
  var showMoreButton = document.getElementById("load-more-button");

  // Ẩn nút "Xem thêm" ban đầu

  // Nếu có nhiều hơn 6 "court card", hiển thị nút "Xem thêm"
  if (cards.length > 6) {
    showMoreButton.style.display = "flex";
  }

  // Ẩn tất cả các "court card" sau 6 cái đầu tiên
  for (var i = 6; i < cards.length; i++) {
    cards[i].style.display = "none";
  }

  // Khi người dùng nhấn vào nút, hiển thị thêm "court card"
  showMoreButton.addEventListener("click", function () {
    for (var i = 6; i < cards.length; i++) {
      cards[i].style.display = "block";
    }

    // Ẩn nút sau khi tất cả các "court card" đã được hiển thị
    showMoreButton.style.display = "none";
  });
};

document.addEventListener("DOMContentLoaded", function () {
  var courtCards = document.querySelectorAll(".court-card");

  courtCards.forEach(function (courtCard) {
    var images = courtCard.dataset.images.split(",");
    var imageIndex = 0;
    var timeout;

    courtCard.addEventListener("mouseover", function () {
      // Thay đổi hình ảnh mỗi 2 giây
      timeout = setInterval(function () {
        imageIndex = (imageIndex + 1) % images.length;
        courtCard.querySelector(".court-image").src = images[imageIndex];
        courtCard.querySelector(".court-image").alt = images[imageIndex];
      }, 1000); // 2000 milliseconds = 2 seconds
    });

    courtCard.addEventListener("mouseout", function () {
      // Dừng thay đổi hình ảnh
      clearInterval(timeout);
      // Reset về hình ảnh đầu tiên
      imageIndex = 0;
      courtCard.querySelector(".court-image").src = images[imageIndex];
      courtCard.querySelector(".court-image").alt = images[imageIndex];
    });
  });
});
