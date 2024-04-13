document.addEventListener("DOMContentLoaded", function () {
  // Add click event listeners to all "Xem" buttons with the class "view"
  var viewButtons = document.querySelectorAll(".view");
  viewButtons.forEach(function (button) {
    button.addEventListener("click", handleViewButtonClick);
  });

  // Restore scroll position after page reloads
  var storedScrollPosition = sessionStorage.getItem("scrollPosition");
  if (storedScrollPosition !== null) {
    window.scrollTo(0, parseInt(storedScrollPosition));
    // Clear the stored scroll position
    sessionStorage.removeItem("scrollPosition");
  }
});

// Store the current scroll position before the page is reloaded
window.addEventListener("beforeunload", function () {
  var scrollPosition = window.scrollY;
  sessionStorage.setItem("scrollPosition", scrollPosition);
});

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

//Toggle Buttons cho miniform
function toggleButtons(clickedBtnId) {
  var editBtn = document.getElementById("editButton");
  var deleteBtn = document.getElementById("deleteButton");
  var cancelBtn = document.getElementById("cancelButton");
  var saveBtn = document.getElementById("saveButton");
  var form = document.getElementById("detail-form");
  var inputs = form.getElementsByTagName("input");
  var courtTypeIcon = document.getElementById("court_type_icon");
  var closeCircle = document.getElementById("close-circle");

  if (clickedBtnId === "editButton") {
    editBtn.style.display = "none";
    deleteBtn.style.display = "none";
    cancelBtn.style.display = "flex";
    saveBtn.style.display = "flex";
    closeCircle.style.display = "flex";
    for (var i = 1; i <= 2; i++) {
      inputs[i].style.pointerEvents = "auto";
    }
    // Enable click event on the image
    courtTypeIcon.addEventListener("click", function () {
      document.getElementById("image-input").click();
    });
  } else if (clickedBtnId === "cancelButton" || clickedBtnId === "saveButton") {
    editBtn.style.display = "flex";
    deleteBtn.style.display = "flex";
    cancelBtn.style.display = "none";
    saveBtn.style.display = "none";
    closeCircle.style.display = "none";
    for (var i = 1; i <= 2; i++) {
      inputs[i].style.pointerEvents = "none";
    }
    // Disable click event on the image
    courtTypeIcon.removeEventListener("click", function () {
      document.getElementById("image-input").click();
    });
  }
  return false;
}

// mo? dong' miniform
document.addEventListener("DOMContentLoaded", function () {
  function showCourtTypeDetail(event) {
    var urlParams = new URLSearchParams(window.location.search);
    console.log(urlParams);
    var courtTypeId = urlParams.get("court_type_id");
    var checkDeleteParams = urlParams.getAll("check_delete[]");
    var overlays = document.querySelectorAll(".overlay");
    var courtTypeDetail = document.querySelector(".court-type-detail");

    if (
      (urlParams.has("option") &&
        urlParams.get("option") === "detail" &&
        courtTypeId) ||
      (urlParams.has("option") &&
        urlParams.get("option") === "view_insert_court_schedule") ||
      (urlParams.has("option") &&
        urlParams.get("option") === "view_update_court_schedule" &&
        checkDeleteParams.length === 1)
    ) {
      courtTypeDetail.classList.add("active");
      overlays.forEach(function (overlay) {
        overlay.style.display = "block";
      });
    }
  }

  var viewButtons = document.querySelectorAll(".view");
  viewButtons.forEach(function (button) {
    button.addEventListener("click", function (event) {
      courtTypeDetail.classList.add("active");
      overlays.forEach(function (overlay) {
        overlay.style.display = "block";
      });
    });
  });
  showCourtTypeDetail();
});
document.addEventListener("DOMContentLoaded", function () {
  var closeCircle = document.getElementById("close-circle");
  var courtTypeIcon = document.getElementById("court_type_icon");
  var imageURLInput = document.querySelector('input[name="image-URL"]');

  closeCircle.addEventListener("click", function () {
    courtTypeIcon.src =
      "../upload/sport-court-types-management/default-img.svg";
    imageURLInput.value = courtTypeIcon.src; // Update input value
  });

  courtTypeIcon.addEventListener("load", function () {
    var relativePath = courtTypeIcon.src.split("/").slice(-3).join("/");
    relativePath =
      ".." + "/upload" + relativePath.substring(relativePath.indexOf("/"));
    imageURLInput.value = relativePath;
  });

  // You can also set the initial value of the input element here
  var initialRelativePath = courtTypeIcon.src.split("/").slice(-3).join("/");
  initialRelativePath =
    ".." +
    "/upload" +
    initialRelativePath.substring(initialRelativePath.indexOf("/"));
  imageURLInput.value = initialRelativePath;
});

function generateDeleteUrl() {
  var currentUrl = window.location.href;
  var checkDeletes = document.querySelectorAll(
    'input[type="checkbox"]:checked'
  );
  var deleteUrl = currentUrl.split("?")[0] + "?option=delete_court_schedule";

  if (checkDeletes.length > 0) {
    deleteUrl +=
      "&" +
      Array.from(checkDeletes)
        .map((checkbox) => "check_delete[]=" + checkbox.id.split("_")[3])
        .join("&");
  }
  return deleteUrl;
}
function generateEditUrl() {
  var currentUrl = window.location.href;
  var checkDeletes = document.querySelectorAll(
    'input[type="checkbox"]:checked'
  );
  var deleteUrl =
    currentUrl.split("?")[0] + "?option=view_update_court_schedule";

  if (checkDeletes.length > 0) {
    deleteUrl +=
      "&" +
      Array.from(checkDeletes)
        .map((checkbox) => "check_delete[]=" + checkbox.id.split("_")[3])
        .join("&");
  }
  return deleteUrl;
}

function updateUrl(checkbox) {
  // Get the court type ID from the checkbox ID
  var courtTypeId = checkbox.id.split("_")[3];
  // Update the URL with the check_delete court type ID
  var currentUrl = window.location.href;
  var newUrl;
  var param = "check_delete[]=" + courtTypeId;
  var alt_param1 = "&" + param;
  var alt_param2 = "?" + param;

  if (checkbox.checked) {
    if (currentUrl.includes("?")) {
      newUrl = currentUrl + "&" + param;
    } else {
      newUrl = currentUrl + "?" + param;
    }
    // Update URL
    window.history.replaceState(null, null, newUrl);
    // Store checkbox state in local storage
    localStorage.setItem(checkbox.id, "checked");
  } else {
    if (currentUrl.includes(alt_param1)) {
      // Remove param with "&" prefix
      newUrl = currentUrl.replace(alt_param1, "");
    } else if (currentUrl.includes(alt_param2)) {
      // Remove param with "?" prefix
      newUrl = currentUrl.replace(alt_param2, "");
    }

    if (newUrl.includes(".php&")) {
      newUrl = newUrl.replace(".php&", ".php?");
    }

    // Update URL
    window.history.replaceState(null, null, newUrl);
    // Remove checkbox state from local storage
    localStorage.removeItem(checkbox.id);
  }
  var deleteButton = document.getElementById("delete");
  deleteButton.href = generateDeleteUrl();
  var editButton = document.getElementById("update");
  editButton.href = generateEditUrl();
}

// Function to retrieve checkbox state from local storage and update checkboxes
function updateCheckboxes() {
  var currentUrl = window.location.href;
  var checkboxes = document.querySelectorAll('input[type="checkbox"]');
  checkboxes.forEach(function (checkbox) {
    var courtTypeId = checkbox.id.split("_")[3];
    var param = "check_delete[]=" + courtTypeId;
    if (currentUrl.includes(param)) {
      checkbox.checked = true;
    } else if (!currentUrl.includes(param)) {
      checkbox.checked = false;
    }
  });
}
// Call updateCheckboxes function when the page loads to update checkboxes
window.addEventListener("load", updateCheckboxes);
