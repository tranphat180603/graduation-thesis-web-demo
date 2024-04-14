const search = document.querySelector(".search input"),
  filter = document.getElementById("btn-filter-confirm"),
  reset = document.getElementById("btn-filter-reset"),
  table_rows = document.querySelectorAll("tbody tr"),
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

//3. Hàm tìm kiếm và thay đổi tổng số sự kiện
search.addEventListener("input", function () {
  searchTable();
  setTimeout(changeNavNumber, 500);
});

//4. Hàm xử lý sự kiện cho nút đặt lại trong filter
reset.addEventListener("click", function () {
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

//5. Sắp xếp dữ liệu của bảng HTML
const table_headings = document.querySelectorAll(
  "thead th:not(:has(input[type='checkbox']))" // Loại bỏ các thẻ <th> chứa checkbox
);

function sortTable(column, sort_asc) {
  console.log([...table_rows]);
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

    console.log(head);
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

//6. Hàm cập nhật href của nút sửa và nút xóa khi tick vào checkbox trong bảng HTML
function updateUrl(checkbox) {
  var checkedIds = [];
  var checkStates = [];
  var checkboxes = document.querySelectorAll('input[type="checkbox"]:checked');
  var btn_update = document.getElementById("update");
  var btn_delete = document.getElementById("delete");

  checkboxes.forEach(function (cb) {
    checkedIds.push(cb.getAttribute("name").split("_")[2]);
  });

  checkboxes.forEach(function (cb) {
    console.log(cb.getAttribute("name").split("_"));
    checkStates.push(cb.getAttribute("name").split("_")[4]);
  });
  console.log(checkedIds);
  console.log(checkedIds.length);
  console.log(checkStates);

  if (checkedIds.length > 1) {
    btn_update.href = "?option=warning_update_event";
  } else if (checkedIds.length == 1) {
    btn_update.href =
      "?event_id=" +
      checkedIds[0] +
      "&event_state=" +
      checkStates[0] +
      "&option=view_update_event";
  }

  btn_delete.href =
    "?event_id=" + checkedIds[0] + "&option=confirm_delete_event";
}

//Thực hiện xóa tham số event_id khỏi url khi check box all không được tick
// Lấy URL hiện tại
var currentURL = new URL(window.location.href);

if (currentURL) {
  // Tạo một đối tượng URLSearchParams từ URL
  var params2 = new URLSearchParams(currentURL.search);
}

params2.delete("event_id");

window.history.replaceState({}, "", `${window.location.pathname}?${params2}`);

// Kiểm tra xem nếu không có checkbox nào được chọn, loại bỏ biến 'court_schedule_id' khỏi URL
var checkedIds = [];
var checkboxes = document.querySelectorAll('input[type="checkbox"]:checked');

checkboxes.forEach(function (cb) {
  checkedIds.push(cb.getAttribute("name").split("_")[2]);
});

if (checkedIds.length === 0) {
  params2.delete("event_id");
}

window.history.replaceState({}, "", `${window.location.pathname}?${params2}`);

//7. Hàm xử lý sự kiện click cho tất cả checkbox trong bảng HTML
function updateUrlAndCBState() {
  updateUrl();
  setTimeout(tickCheckbox, 100);
}

function filterTableByDate() {
  const start_date_input_formatted = formatDateToYMD(start_date_input.value),
    end_date_input_formatted = formatDateToYMD(end_date_input.value);

  const start_date = start_date_input_formatted.replace(/-/g, ""),
    end_date = end_date_input_formatted.replace(/-/g, "");

  const start_date_object = new Date(start_date),
    end_date_object = new Date(end_date);

  table_rows.forEach((row, i) => {
    const date_cell = row.querySelectorAll("td")[2]; // Chọn ô thứ 3 (chỉ mục 2 trong mảng) chứa ngày
    const date = date_cell.textContent.replace(/-/g, ""); // Lấy ngày và loại bỏ dấu '-'
    const date_object = new Date(date);

    if (
      start_date == "" ||
      end_date == "" ||
      (date_object >= start_date_object && date_object <= end_date_object)
    ) {
      row.classList.remove("hide");
    } else {
      row.classList.add("hide");
    }

    row.style.setProperty("--delay", i / 25 + "s");
  });

  document.querySelectorAll("tbody tr:not(.hide)").forEach((visible_row, i) => {
    visible_row.style.backgroundColor =
      i % 2 == 0 ? "transparent" : "#0000000b";
  });
}
