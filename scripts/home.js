//1. Quản lý hiển thị "court card" và nút "Xem thêm":
window.onload = function () {
  // Lấy tất cả các "court card"
  var cards = document.querySelectorAll(".court-card");
  var showMoreButton = document.getElementById("load-more-button");
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

//2. Thay đổi hình ảnh khi di chuột qua "court card":
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

//3. Quản lý sự kiện thay đổi "event":
var currentEventIndex = 0; // Event hiện tại
var eventWidth = $(".event").outerWidth(true); // Lấy chiều dài hiện tại của event

// Chuyển động event
function changeEvent(direction) {
  var newIndex = (currentEventIndex + direction + totalEvents) % totalEvents;
  $("#event-" + currentEventIndex).animate(
    {
      left: -eventWidth,
    },
    500,
    function () {
      var $currentEvent = $(this);
      setTimeout(function () {
        $currentEvent.hide().css("left", 0); // Ẩn sự kiện hiện tại và đặt lại vị trí của nó sau 700ms
      }, 700);
    }
  );

  $("#event-" + newIndex)
    .css("left", eventWidth)
    .show()
    .animate(
      {
        left: 0,
      },
      500
    );

  // Cập nhật chiều rộng mới cho mỗi item trong event list
  var items = $(".event-list .item");
  if (direction !== 0) {
    items.css("width", "32px");
    items.css("background-color", "rgba(220, 224, 227, 1)"); // Đặt lại chiều rộng của tất cả các item
    $(".item-" + newIndex).css("width", 50 + "px");
    $(".item-" + newIndex).css("background-color", "rgba(154, 166, 175, 1)");

    // Chiều rộng của item tương ứng với sự kiện mới
  }

  currentEventIndex = newIndex;
}
