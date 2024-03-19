const search = document.querySelector(".search input"),
  table_rows = document.querySelectorAll("tbody tr");

// 1. Tìm kiếm dữ liệu trong bảng HTML
function searchTable() {
  table_rows.forEach((row, i) => {
    let table_data = row.textContent.toLowerCase(),
      search_data = search.value.toLowerCase();

    row.classList.toggle("hide", table_data.indexOf(search_data) < 0);
    row.style.setProperty("--delay", i / 25 + "s");
  });

  document.querySelectorAll("tbody tr:not(.hide)").forEach((visible_row, i) => {
    visible_row.style.backgroundColor =
      i % 2 == 0 ? "transparent" : "#0000000b";
  });
}

//2. Thay đổi tổng số lịch sân trên thanh điều hướng khi dữ liệu thay đổi
function changeNavNumber() {
  var search_result = document.querySelectorAll("tbody tr:not(.hide)");
  var table_Length = search_result.length;

  // Lấy URL hiện tại
  var currentURL = new URL(window.location.href);

  if (currentURL) {
    // Tạo một đối tượng URLSearchParams từ URL
    var params = new URLSearchParams(currentURL.search);
  }

  // Kiểm tra xem tham số "court_type_id" có tồn tại trong URL không
  if (params.has("court_type_id")) {
    // Lấy giá trị của tham số "court_type_id"
    var courtType = params.get("court_type_id");

    // Kiểm tra giá trị của tham số
    if (courtType == "0") {
      var number = document.querySelector("#li-court-type-0 span");
      number.textContent = table_Length;
    } else {
      // Lấy thẻ div bọc ul có id là schedule-body-menu
      var scheduleBodyMenu = document.getElementById("schedule-body-menu");
      // Lấy tất cả các thẻ li trong thẻ ul
      var liElements = scheduleBodyMenu.querySelectorAll("ul li");
      // Đếm số lượng thẻ li
      var liCount = liElements.length;

      var navItemCount = liCount + 1;

      for (var i = 1; i <= navItemCount; i++) {
        if (courtType == i.toString()) {
          var number = document.querySelector("#li-court-type-" + i + " span");
          number.textContent = table_Length;
          break; // Thoát khỏi vòng lặp sau khi tìm thấy giá trị
        }
      }
    }
  } else {
    // Thực hiện các thao tác khi tham số không tồn tại
    console.log("Lỗi không nhận được params");
  }
}

//3. Hàm tìm kiếm và thay đổi tổng số lịch sân
function searchAndChangeNavNumber() {
  searchTable();
  setTimeout(changeNavNumber, 500);
}

search.addEventListener("input", searchAndChangeNavNumber);

// 4. Sắp xếp dữ liệu của bảng HTML
const table_headings = document.querySelectorAll(
  "thead th:not(:has(input[type='checkbox']))" // Loại bỏ các thẻ <th> chứa checkbox
);

function sortTable(column, sort_asc) {
  [...table_rows]
    .sort((a, b) => {
      // Lấy giá trị của first_row
      let first_row = a
        .querySelectorAll("td:not(:has(input[type='checkbox']))")
        [column].textContent.toLowerCase();
      let second_row = b
        .querySelectorAll("td:not(:has(input[type='checkbox']))")
        [column].textContent.toLowerCase();

      // Kiểm tra xem first_row có phải là một số không
      if (!isNaN(parseFloat(first_row)) && isFinite(first_row)) {
        first_row = parseFloat(first_row);
        second_row = parseFloat(second_row);
      }

      return sort_asc
        ? first_row < second_row
          ? -1
          : 1
        : first_row < second_row
        ? 1
        : -1;
    })
    .map((sorted_row) =>
      document.querySelector("tbody").appendChild(sorted_row)
    );
}

table_headings.forEach((head, i) => {
  let sort_asc = true;
  head.onclick = () => {
    table_headings.forEach((head) => head.classList.remove("active"));
    head.classList.add("active");

    document
      .querySelectorAll("td:not(:has(input[type='checkbox']))")
      .forEach((td) => td.classList.remove("active"));
    table_rows.forEach((row) => {
      row
        .querySelectorAll("td:not(:has(input[type='checkbox']))")
        [i].classList.add("active");
    });

    head.classList.toggle("asc", sort_asc);
    sort_asc = head.classList.contains("asc") ? false : true;

    sortTable(i, sort_asc);
  };
});

//5. Hàm cập nhật url khi tick vào checkbox trong bảng HTML
function updateUrl(checkbox) {
  var checkedIds = [];
  var checkboxes = document.querySelectorAll('input[type="checkbox"]:checked');

  checkboxes.forEach(function (cb) {
    checkedIds.push(cb.getAttribute("name").split("_")[3]);
  });

  var urlParams = new URLSearchParams(window.location.search);
  urlParams.set("court_schedule_id", checkedIds.join(","));

  // Kiểm tra xem nếu không có checkbox nào được chọn, loại bỏ biến 'court_schedule_id' khỏi URL
  if (checkedIds.length === 0) {
    urlParams.delete("court_schedule_id");
  }

  window.history.replaceState(
    {},
    "",
    `${window.location.pathname}?${urlParams}`
  );
}

//6. Hàm xử lý sự kiện click của checkbox có court_schedule_id = 0
function tickCheckbox() {
  // Lấy URL hiện tại
  var currentURL = new URL(window.location.href);

  if (currentURL) {
    // Tạo một đối tượng URLSearchParams từ URL
    var params = new URLSearchParams(currentURL.search);
  }

  // Kiểm tra xem tham số "court_schedule_id" có tồn tại trong URL không
  if (params.has("court_schedule_id")) {
    // Lấy giá trị của biến 'court_schedule_id'
    var courtScheduleStr = params.get("court_schedule_id");

    // Tách chuỗi thành mảng
    var courtScheduleArr = courtScheduleStr.split(",");

    var search_result = document.querySelectorAll("tbody tr:not(.hide)");
    var table_Length = search_result.length;

    // Kiểm tra giá trị của mảng và cập nhật trạng thái của checkbox tương ứng
    for (var i = 0; i < courtScheduleArr.length; i++) {
      if (courtScheduleArr[i] == "0") {
        // Vòng lặp để cập nhật trạng thái của checkbox
        for (var i = 1; i <= table_Length; i++) {
          var checkbox = document.getElementById("court_schedule_id_" + i);
          if (checkbox) {
            checkbox.checked = true;
          }
        }
      } else {
        // Vòng lặp để cập nhật trạng thái của checkbox
        for (var i = 1; i <= table_Length; i++) {
          var checkbox = document.getElementById("court_schedule_id_" + i);
          if (checkbox) {
            checkbox.checked = false;
          }
        }

        //Thực hiện xóa tham số court_schedule_id khỏi url khi check box all không được tick
        // Lấy URL hiện tại
        var currentURL = new URL(window.location.href);

        if (currentURL) {
          // Tạo một đối tượng URLSearchParams từ URL
          var params2 = new URLSearchParams(currentURL.search);
        }

        params2.delete("court_schedule_id");

        window.history.replaceState(
          {},
          "",
          `${window.location.pathname}?${params2}`
        );
      }
    }
    // Kiểm tra xem nếu không có checkbox nào được chọn, loại bỏ biến 'court_schedule_id' khỏi URL
    var checkedIds = [];
    var checkboxes = document.querySelectorAll(
      'input[type="checkbox"]:checked'
    );

    checkboxes.forEach(function (cb) {
      checkedIds.push(cb.getAttribute("name").split("_")[3]);
    });

    if (checkedIds.length === 0) {
      urlParams.delete("court_schedule_id");
    }

    window.history.replaceState(
      {},
      "",
      `${window.location.pathname}?${urlParams}`
    );
  }
}

//7. Hàm xử lý sự kiện click cho tất cả checkbox trong bảng HTML
function updateUrlAndCBState() {
  updateUrl();
  setTimeout(tickCheckbox, 100);
}

//8. Hàm cập nhật trạng thái lịch sân tự động sau mỗi 12 tiếng
// Hàm để gọi PHP và truyền biến vào
function callPHPFunction(currentDate) {
  // Gọi Ajax để gọi hàm PHP và truyền biến vào
  $.ajax({
    url: "court-schedule-controller.php", // Đường dẫn đến tập tin PHP của bạn
    type: "POST",
    data: { currentDate: currentDate },
    success: function (response) {
      console.log("Success:", response);
    },
    error: function (xhr, status, error) {
      console.error("Error:", error);
    },
  });
}

// Hàm chạy sau mỗi 12 tiếng
function runEvery12Hours() {
  // Tạo biến để lưu ngày hiện tại
  var currentDate = new Date().toISOString().slice(0, 10); // Lấy ngày hiện tại và định dạng thành 'YYYY-MM-DD'

  // Gọi hàm để gọi PHP và truyền biến vào
  callPHPFunction(currentDate);
}

// Thực thi hàm runEvery12Hours() sau mỗi 12 tiếng
setInterval(runEvery12Hours, 12 * 60 * 60 * 1000); // 12 tiếng * 60 phút * 60 giây * 1000 milliseconds
