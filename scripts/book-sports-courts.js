const momoLink = document.getElementById("momo");
const bankLink = document.getElementById("bank");
// Add click event listeners to the links and their child paragraphs
momoLink.addEventListener("click", toggleActive);
bankLink.addEventListener("click", toggleActive);

// Function to toggle the "active" class
function toggleActive(event) {
  // Check if the clicked element is already active
  const isActive = event.target.classList.contains("active");

  // Remove "active" class from all links and their child paragraphs
  momoLink.classList.remove("active");
  bankLink.classList.remove("active");

  // If the clicked element was not already active, make it active
  if (!isActive) {
    // If the clicked element is the paragraph, add "active" class to its parent link
    if (event.target.tagName === "P") {
      event.target.parentNode.classList.add("active");
    } else {
      // Otherwise, add "active" class to the clicked element
      event.target.classList.add("active");
    }
  }
}

// mo miniform
document.addEventListener("DOMContentLoaded", function () {
  function showPaymentdetail(event) {
    var urlParams = new URLSearchParams(window.location.search);
    var fragmentParams = new URLSearchParams(window.location.hash.slice(1));
    var overlay = document.getElementById("overlay");
    const checkBox = document.getElementById("note-checkbox");
    var depositInput = document.getElementById("deposit_amount");
    var contentTextarea = document.getElementById("content1"); // Update this line
    var contentTextarea2 = document.getElementById("content2");

    // Copy the value from the input field to the textarea
    contentTextarea.value = depositInput.value;

    // Update the textarea whenever the input field value changes
    depositInput.addEventListener("input", function () {
      contentTextarea.value = depositInput.value;
      contentTextarea2.value = depositInput.value;
    });

    if (
      fragmentParams.has("method") &&
      fragmentParams.get("method") === "momo" &&
      checkBox.checked
    ) {
      var momoform = document.getElementById("momo-form");
      momoform.classList.add("active");
      overlay.style.display = "block";
    } else if (
      fragmentParams.has("method") &&
      fragmentParams.get("method") === "bank" &&
      checkBox.checked
    ) {
      var bankform = document.getElementById("bank-form");
      bankform.classList.add("active");
      overlay.style.display = "block";
    }
  }

  var bookBtn = document.getElementById("book-btn");
  bookBtn.addEventListener("click", function (event) {
    event.preventDefault();
    showPaymentdetail();
  });
});
// hien thi nut' cam' cho book-btn
document.addEventListener("DOMContentLoaded", function () {
  // Get references to the checkbox and the anchor tag
  const checkBox = document.getElementById("note-checkbox");
  const bookBtn = document.getElementById("book-btn");

  // Add event listener to the checkbox
  checkBox.addEventListener("change", function () {
    if (checkBox.checked) {
      bookBtn.style.cursor = "pointer"; // Change cursor style to pointer
    } else {
      bookBtn.style.cursor = "not-allowed"; // Change cursor style to not-allowed
    }
  });
  bookBtn.setAttribute("disabled", "disabled");
});
