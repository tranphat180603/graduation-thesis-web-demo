const search = document.querySelector(".search input"),
  filter = document.getElementById("btn-filter-confirm"),
  reset = document.getElementById("btn-filter-reset"),
  table_rows = document.querySelectorAll("tbody tr"),
  cb_football = document.getElementById("cb-football"),
  cb_volleyball = document.getElementById("cb-volleyball"),
  cb_basketball = document.getElementById("cb-basketball"),
  cb_badminton = document.getElementById("cb-badminton"),
  cb_tennis = document.getElementById("cb-tennis"),
  start_date_input = document.getElementById("start-date"),
  end_date_input = document.getElementById("end-date");

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

//2. Hàm chuyển đổi ngày từ định dạng DMY sang YMD
function formatDateToYMD(dateString) {
  const [day, month, year] = dateString.split("/");
  return `${year}-${month}-${day}`;
}

//3. Lọc dữ liệu trong bảng HTML
function filterTable() {
  const start_date_input_formatted = formatDateToYMD(start_date_input.value),
    end_date_input_formatted = formatDateToYMD(end_date_input.value);

  const start_date = start_date_input_formatted.replace(/-/g, ""),
    end_date = end_date_input_formatted.replace(/-/g, "");

  const start_date_object = new Date(start_date),
    end_date_object = new Date(end_date);

  table_rows.forEach((row, i) => {
    var court_types = [];

    // const date = row[i][2].textContent.replace(/-/g, "");

    const date_cell = row.querySelectorAll("td")[3]; // Chọn ô thứ 4 (chỉ mục 3 trong mảng) chứa ngày

    const date = date_cell.textContent.replace(/-/g, ""); // Lấy ngày và loại bỏ dấu '-'

    const date_object = new Date(date);

    if (cb_football.checked) {
      court_types.push(cb_football.value);
    }

    if (cb_volleyball.checked) {
      court_types.push(cb_volleyball.value);
    }

    if (cb_basketball.checked) {
      court_types.push(cb_basketball.value);
    }

    if (cb_badminton.checked) {
      court_types.push(cb_badminton.value);
    }

    if (cb_tennis.checked) {
      court_types.push(cb_tennis.value);
    }

    let table_data = row.textContent.toLowerCase();

    var court_types_length = court_types.length;

    if (start_date == "" || end_date == "") {
      if (court_types_length == 0) {
        row.classList.toggle("hide", false);
      } else if (court_types_length == 1) {
        row.classList.toggle("hide", table_data.indexOf(court_types[0]) < 0);
      } else if (court_types_length == 2) {
        row.classList.toggle(
          "hide",
          table_data.indexOf(court_types[0]) < 0 &&
            table_data.indexOf(court_types[1]) < 0
        );
      } else if (court_types_length == 3) {
        row.classList.toggle(
          "hide",
          table_data.indexOf(court_types[0]) < 0 &&
            table_data.indexOf(court_types[1]) < 0 &&
            table_data.indexOf(court_types[2]) < 0
        );
      } else if (court_types_length == 4) {
        row.classList.toggle(
          "hide",
          table_data.indexOf(court_types[0]) < 0 &&
            table_data.indexOf(court_types[1]) < 0 &&
            table_data.indexOf(court_types[2]) < 0 &&
            table_data.indexOf(court_types[3]) < 0
        );
      } else if (court_types_length == 5) {
        row.classList.toggle(
          "hide",
          table_data.indexOf(court_types[0]) < 0 &&
            table_data.indexOf(court_types[1]) < 0 &&
            table_data.indexOf(court_types[2]) < 0 &&
            table_data.indexOf(court_types[3]) < 0 &&
            table_data.indexOf(court_types[4]) < 0
        );
      }
    } else {
      if (court_types_length == 0) {
        row.classList.toggle(
          "hide",
          date_object < start_date_object || date_object > end_date_object
        );
      } else if (court_types_length == 1) {
        row.classList.toggle(
          "hide",
          table_data.indexOf(court_types[0]) < 0 ||
            date_object < start_date_object ||
            date_object > end_date_object
        );
      } else if (court_types_length == 2) {
        row.classList.toggle(
          "hide",
          (table_data.indexOf(court_types[0]) < 0 &&
            table_data.indexOf(court_types[1]) < 0) ||
            date_object < start_date_object ||
            date_object > end_date_object
        );
      } else if (court_types_length == 3) {
        row.classList.toggle(
          "hide",
          (table_data.indexOf(court_types[0]) < 0 &&
            table_data.indexOf(court_types[1]) < 0 &&
            table_data.indexOf(court_types[2]) < 0) ||
            date_object < start_date_object ||
            date_object > end_date_object
        );
      } else if (court_types_length == 4) {
        row.classList.toggle(
          "hide",
          (table_data.indexOf(court_types[0]) < 0 &&
            table_data.indexOf(court_types[1]) < 0 &&
            table_data.indexOf(court_types[2]) < 0 &&
            table_data.indexOf(court_types[3]) < 0) ||
            date_object < start_date_object ||
            date_object > end_date_object
        );
      } else if (court_types_length == 5) {
        row.classList.toggle(
          "hide",
          (table_data.indexOf(court_types[0]) < 0 &&
            table_data.indexOf(court_types[1]) < 0 &&
            table_data.indexOf(court_types[2]) < 0 &&
            table_data.indexOf(court_types[3]) < 0 &&
            table_data.indexOf(court_types[4]) < 0) ||
            date_object < start_date_object ||
            date_object > end_date_object
        );
      }
    }

    row.style.setProperty("--delay", i / 25 + "s");
  });

  document.querySelectorAll("tbody tr:not(.hide)").forEach((visible_row, i) => {
    visible_row.style.backgroundColor =
      i % 2 == 0 ? "transparent" : "#0000000b";
  });
}

// 4. Thay đổi tổng số đơn đặt sân trên thanh điều hướng khi dữ liệu thay đổi
function changeNavNumber() {
  var search_result = document.querySelectorAll("tbody tr:not(.hide)");
  var table_length = search_result.length;

  // Lấy URL hiện tại
  var currentURL = new URL(window.location.href);

  if (currentURL) {
    // Tạo một đối tượng URLSearchParams từ URL
    var params = new URLSearchParams(currentURL.search);
  }

  // Kiểm tra xem tham số "court_order_state_id" có tồn tại trong URL không
  if (params.has("court_order_state_id")) {
    // Lấy giá trị của tham số "court_order_state_id"
    var courtOrderState = params.get("court_order_state_id");

    // Lấy thẻ div bọc ul có id là court-order-body-menu
    var courtOrderBodyMenu = document.getElementById("court-order-body-menu");
    // Lấy tất cả các thẻ li trong thẻ ul
    var liElements = courtOrderBodyMenu.querySelectorAll("ul li");
    // Đếm số lượng thẻ li
    var liCount = liElements.length;

    var navItemCount = liCount + 1;

    for (var i = 0; i <= navItemCount; i++) {
      if (courtOrderState == i.toString()) {
        var number = document.querySelector(
          "#li-court-order-state-" + i + " span"
        );
        number.textContent = table_length;
        break; // Thoát khỏi vòng lặp sau khi tìm thấy giá trị
      }
    }
  } else {
    // Thực hiện các thao tác khi tham số không tồn tại
    console.log("Lỗi không nhận được params");
  }
}

// 5. Hàm tìm kiếm và thay đổi tổng số đơn đặt sân
search.addEventListener("input", function () {
  searchTable();
  setTimeout(changeNavNumber, 500);
});

// 6. Hàm lọc và thay đổi tổng số đơn đặt sân
filter.addEventListener("click", function () {
  filterTable();
  setTimeout(changeNavNumber, 500);
});

// 7. Hàm xử lý sự kiện cho nút đặt lại trong filter
reset.addEventListener("click", function () {
  cb_football.checked = false;
  cb_volleyball.checked = false;
  cb_basketball.checked = false;
  cb_badminton.checked = false;
  cb_tennis.checked = false;

  start_date_input.value = "";
  end_date_input.value = "";

  table_rows.forEach((row, i) => {
    row.classList.toggle("hide", false);
    row.style.setProperty("--delay", i / 25 + "s");
  });

  document.querySelectorAll("tbody tr:not(.hide)").forEach((visible_row, i) => {
    visible_row.style.backgroundColor =
      i % 2 == 0 ? "transparent" : "#0000000b";
  });

  setTimeout(changeNavNumber, 500);
});

// 8. Sắp xếp dữ liệu của bảng HTML
const table_headings = document.querySelectorAll("thead th");

function sortTable(column, sort_asc) {
  [...table_rows]
    .sort((a, b) => {
      // Lấy giá trị của first_row
      let first_row = a
        .querySelectorAll("td")
        [column].textContent.toLowerCase();
      let second_row = b
        .querySelectorAll("td")
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
      .querySelectorAll("td")
      .forEach((td) => td.classList.remove("active"));
    table_rows.forEach((row) => {
      row.querySelectorAll("td")[i].classList.add("active");
    });

    head.classList.toggle("asc", sort_asc);
    sort_asc = head.classList.contains("asc") ? false : true;

    sortTable(i, sort_asc);
  };
});

//9. Hàm cập nhật trạng thái đơn đặt sân tự động sau mỗi 12 tiếng
// Hàm để gọi PHP và truyền biến vào
function callPHPFunction(currentDate) {
  // Gọi Ajax để gọi hàm PHP và truyền biến vào
  $.ajax({
    url: "../controllers/court-order-controller.php", // Đường dẫn đến tập tin PHP của bạn
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
