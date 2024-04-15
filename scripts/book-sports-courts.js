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
    var depositInput2 = document.getElementById("deposit_amount2");
    var contentTextarea = document.getElementById("content1"); // Update this line
    var contentTextarea2 = document.getElementById("content2");

    // Copy the value from the input field to the textarea
    contentTextarea.value = depositInput.value;
    contentTextarea2.value = depositInput2.value;

    // Update the textarea whenever the input field value changes
    depositInput.addEventListener("input", function () {
      contentTextarea.value = depositInput.value;
    });

    // Update the second textarea whenever the corresponding input field value changes
    depositInput2.addEventListener("input", function () {
      contentTextarea2.value = depositInput2.value;
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

// Get the bank-submit and momo-submit buttons
var bankSubmitBtn = document.getElementById("bank-submit");
var momoSubmitBtn = document.getElementById("momo-submit");

// Get the form element
var form1 = document.querySelector('form[name="form1"]');
var form2 = document.querySelector('form[name="form2"]');

// Add click event listener to the bank-submit button
bankSubmitBtn.addEventListener("click", function (event) {
  // Prevent the default form submission behavior
  event.preventDefault();
  // Set the value of payment-method input to bank-method
  document.getElementById("payment-method").value =
    document.getElementById("bank-method").value;
  // Submit the form
  form1.submit();
  form2.submit();
});

// Add click event listener to the momo-submit button
momoSubmitBtn.addEventListener("click", function (event) {
  // Prevent the default form submission behavior
  event.preventDefault();
  // Set the value of payment-method input to momo-method
  document.getElementById("payment-method").value =
    document.getElementById("momo-method").value;
  // Submit the form
  form1.submit();
  form2.submit();
});
