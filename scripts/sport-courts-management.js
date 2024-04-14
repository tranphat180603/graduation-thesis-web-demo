const search = document.querySelector(".search input");

const table_rows = document.querySelectorAll("tbody tr");
//  Tìm kiếm dữ liệu trong bảng HTML
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

//4. Thay đổi tổng số sân trên thanh điều hướng khi dữ liệu thay đổi
function changeNavNumber() {
  var search_result = document.querySelectorAll("tbody tr:not(.hide)");
  var table_length = search_result.length;

  // Lấy URL hiện tại
  var currentURL = new URL(window.location.href);
  if (currentURL) {
    // Tạo một đối tượng URLSearchParams từ URL
    var params = new URLSearchParams(currentURL.search);
  }

  console.log(params);
  // Kiểm tra xem tham số "court_type_id" có tồn tại trong URL không
  if (params.has("court_type_id")) {
    // Lấy giá trị của tham số "court_type_id"
    var courtType = params.get("court_type_id");

    // Lấy thẻ div bọc ul có id là court-body-menu
    var courtBodyMenu = document.getElementById("court-body-menu");
    // Lấy tất cả các thẻ li trong thẻ ul
    var liElements = courtBodyMenu.querySelectorAll("ul li");
    // Đếm số lượng thẻ li
    var liCount = liElements.length;

    var navItemCount = liCount + 1;

    for (var i = 0; i <= navItemCount; i++) {
      if (courtType == i.toString()) {
        var number = document.querySelector("#li-court-type-" + i + " span");
        number.textContent = table_length;
        break; // Thoát khỏi vòng lặp sau khi tìm thấy giá trị
      }
    }
  } else {
    // Thực hiện các thao tác khi tham số không tồn tại
    console.log("Lỗi không nhận được params");
  }
}

//5. Hàm tìm kiếm và thay đổi tổng số sân
search.addEventListener("input", function () {
  searchTable();
  setTimeout(changeNavNumber, 500);
});

//8. Sắp xếp dữ liệu của bảng HTML
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

//9. Hàm cập nhật href của nút sửa và nút xóa khi tick vào checkbox trong bảng HTML
function updateUrl(checkbox) {
  var checkedIds = [];
  var checkStates = [];
  var checkedPrices = [];
  var checkboxes = document.querySelectorAll('input[type="checkbox"]:checked');
  var btn_update = document.getElementById("update");
  var btn_delete = document.getElementById("delete");
  console.log("checkboxes", checkboxes);
  checkboxes.forEach(function (cb) {
    checkedIds.push(cb.getAttribute("name").split("_")[2]);
  });

  checkboxes.forEach(function (cb) {
    checkStates.push(cb.getAttribute("name").split("_")[4]);
  });

  checkboxes.forEach(function (cb) {
    checkedPrices.push(cb.getAttribute("name").split("_")[8]);
  });
  console.log("checkedIds", checkedIds);
  console.log("checkStates", checkStates);
  console.log("checkedPrices", checkedPrices);

  if (checkedIds.length > 1) {
    btn_update.href = "?option=warning_update_court";
  } else if (checkStates.length == 1) {
    btn_update.href =
      "?court_id=" +
      checkedIds[0] +
      "&court_state=" +
      checkStates[0] +
      "&court_price_id=" +
      checkedPrices[0] +
      "&option=view_update_court";
  }

  btn_delete.href =
    "?court_id=" +
    checkedIds +
    "&court_state=" +
    checkStates[0] +
    "&court_price_id=" +
    checkedPrices +
    "&option=confirm_delete_court";
}

//Thực hiện xóa tham số court_id khỏi url khi check box all không được tick
// Lấy URL hiện tại
var currentURL = new URL(window.location.href);

if (currentURL) {
  // Tạo một đối tượng URLSearchParams từ URL
  var params2 = new URLSearchParams(currentURL.search);
}

params2.delete("court_id");

window.history.replaceState({}, "", `${window.location.pathname}?${params2}`);

// Kiểm tra xem nếu không có checkbox nào được chọn, loại bỏ biến 'court_id' khỏi URL
var checkedIds = [];
var checkboxes = document.querySelectorAll('input[type="checkbox"]:checked');

checkboxes.forEach(function (cb) {
  checkedIds.push(cb.getAttribute("name").split("_")[2]);
});

if (checkedIds.length === 0) {
  params2.delete("court_id");
}

window.history.replaceState({}, "", `${window.location.pathname}?${params2}`);

//11. Hàm xử lý sự kiện click cho tất cả checkbox trong bảng HTML
function updateUrlAndCBState() {
  updateUrl();
  setTimeout(tickCheckbox, 100);
}
//12. Hàm xử lý sự kiện click vào thay đổi ảnh
var changedInputs = []; // Object lưu trữ các imageIds và files đã thay đổi

function updateImage(input, image_id) {
  if (input.files.length > 0) {
    var reader = new FileReader();
    // Kiểm tra xem input có chứa file được chọn không
    console.log("Image ID: " + image_id);
    if (!changedInputs.includes(image_id)) {
      changedInputs.push(image_id); // Lưu trữ image_id của input có file được chọn
    }
    console.log(changedInputs);
    reader.onload = function (e) {
      var previewImage = document.getElementById("preview_image_" + image_id);
      console.log(previewImage);
      previewImage.src = e.target.result; // Thay đổi src của hình ảnh thành file vừa chọn
    };

    reader.readAsDataURL(input.files[0]); //
  } else {
    var index = changedInputs.indexOf(image_id);
    if (index !== -1) {
      changedInputs.splice(index, 1); // Xóa image_id ra khỏi mảng changedInputs nếu không có file được chọn
    }
  }
  var imageIdsInput = document.getElementById("image_ids_input");
  imageIdsInput.value = changedInputs.join(","); // Cập nhật giá trị của trường input name="image_ids[]", chuyển mảng mới nhập thành dạng chuỗi
}
