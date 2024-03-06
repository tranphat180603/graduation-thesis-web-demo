function togglePasswordVisibility() {
  var eyeIcon = document.getElementById("eye");
  var passwordField = document.getElementById("sign-up-pass-input-text");
  if (passwordField.type === "password") {
    passwordField.type = "text";
    eyeIcon.src = "../image/sign-up-img/hide.svg";
  } else {
    passwordField.type = "password";
    eyeIcon.src = "../image/sign-up-img/show.svg";
  }
}

function moveToPhone() {
  window.location.href = "../views/sign-up-method-phone.php";
}

function moveToEmail() {
  window.location.href = "../views/sign-up-method-email.php";
}

function goBack() {
  window.history.go(-1);
}

/*
    Những hàm cần code:
    1. Giao diện sign-up-method-suname:
        - Hàm kiểm tra định dạng của tên đăng ký. Nếu đúng thì gọi hàm kiểm tra tồn tại ra để 
        kiểm tra tiếp. Nếu sai thì sẽ điều chỉnh thuộc tính visibility của div có class là 
        warning thành visible để nó hiển thị lên giao diện, đồng thời điều chỉnh màu viền của 
        div có class là sign-up-name-input thành mã màu #FF4141.
        (Lưu ý, hàm ở trên phải thực hiện kiểm tra mọi lúc khi mà nội dung trong ô nhập liệu thay đổi)
        (Sau khi người dùng ấn nút TIẾP THEO thì phải ẩn đi dấu tick xanh đã hiển thị và tô màu viền lại
        thành màu ban đầu).
        - Hàm kiểm tra sự tồn tại của tên đăng ký trong database. Nếu đúng thì điều chỉnh thuộc 
        tính display của img có id là check thành block để nó hiển thị lên giao diện (sự kiện 
        mà hàm này bắt sẽ là khi nội dung của input[type="text"] bị thay đổi, nghĩa là khi người 
        dùng đang nhập liệu), đồng thời điều chỉnh màu viền của div có class là sign-up-name-input 
        thành mã màu #34C759. Nếu sai thì sẽ điều chỉnh nội dung của thẻ p có id là warning-content 
        thành 'Tên đăng ký này đã tồn tại', sau đó điều chỉnh thuộc tính visibility của div có 
        class là warning thành visible để nó hiển thị lên giao diện, đồng thời điều chỉnh màu 
        viền của div có class là sign-up-name-input thành mã màu #FF4141. 
        (Lưu ý, hàm ở trên phải thực hiện kiểm tra mọi lúc khi mà nội dung trong ô nhập liệu thay đổi)
        (Sau khi người dùng ấn nút TIẾP THEO thì phải ẩn đi dấu tick xanh đã hiển thị và tô màu viền lại
        thành màu ban đầu).
        - Hàm để bắt sự kiện khi người dùng click vào nút TIẾP THEO thì sẽ dẫn đến giao diện 
        sign-up-acc-name chỉ khi nội dung trong ô nhập liệu là đúng.
        - Hàm để bắt sự kiện khi người dùng click vào nút Số điện thoại thì sẽ dẫn đến giao diện
        sign-up-method-phone.
        - Hàm để bắt sự kiện khi người dùng click vào nút Email thì sẽ dẫn đến giao diện
        sign-up-method-email.
    2. Giao diện sign-up-method-phone:
        - Hàm kiểm tra định dạng của số điện thoại. Nếu đúng thì gọi hàm kiểm tra tồn tại ra để 
        kiểm tra tiếp. Nếu sai thì sẽ điều chỉnh thuộc tính visibility của div có class là 
        warning thành visible để nó hiển thị lên giao diện, đồng thời điều chỉnh màu viền của 
        div có class là sign-up-name-input thành mã màu #FF4141.
        (Lưu ý, hàm ở trên phải thực hiện kiểm tra mọi lúc khi mà nội dung trong ô nhập liệu thay đổi)
        (Sau khi người dùng ấn nút TIẾP THEO thì phải ẩn đi dấu tick xanh đã hiển thị và tô màu viền lại
        thành màu ban đầu).
        - Hàm kiểm tra sự tồn tại của số điện thoại trong database. Nếu đúng thì điều chỉnh thuộc 
        tính display của img có id là check thành block để nó hiển thị lên giao diện (sự kiện 
        mà hàm này bắt sẽ là khi nội dung của input[type="text"] bị thay đổi, nghĩa là khi người 
        dùng đang nhập liệu), đồng thời điều chỉnh màu viền của div có class là sign-up-name-input 
        thành mã màu #34C759. Nếu sai thì sẽ điều chỉnh nội dung của thẻ p có id là warning-content 
        thành 'Số điện thoại này đã tồn tại', sau đó điều chỉnh thuộc tính visibility của div có 
        class là warning thành visible để nó hiển thị lên giao diện, đồng thời điều chỉnh màu 
        viền của div có class là sign-up-name-input thành mã màu #FF4141.
        (Lưu ý, hàm ở trên phải thực hiện kiểm tra mọi lúc khi mà nội dung trong ô nhập liệu thay đổi)
        (Sau khi người dùng ấn nút TIẾP THEO thì phải ẩn đi dấu tick xanh đã hiển thị và tô màu viền lại
        thành màu ban đầu).
        - Hàm để bắt sự kiện khi người dùng click vào nút TIẾP THEO thì sẽ dẫn đến giao diện 
        sign-up-acc-name chỉ khi nội dung trong ô nhập liệu là đúng.
        - Hàm để bắt sự kiện khi người dùng click vào mũi tên quay lại thì sẽ dẫn đến giao diện
        mà người dùng vừa ở trước đó.
        - Hàm để bắt sự kiện khi người dùng click vào nút Email thì sẽ dẫn đến giao diện
        sign-up-method-email.
    3. Giao diện sign-up-method-email:
        - Hàm kiểm tra định dạng của email. Nếu đúng thì gọi hàm kiểm tra tồn tại ra để 
        kiểm tra tiếp. Nếu sai thì sẽ điều chỉnh thuộc tính visibility của div có class là 
        warning thành visible để nó hiển thị lên giao diện, đồng thời điều chỉnh màu viền của 
        div có class là sign-up-name-input thành mã màu #FF4141.
        (Lưu ý, hàm ở trên phải thực hiện kiểm tra mọi lúc khi mà nội dung trong ô nhập liệu thay đổi)
        (Sau khi người dùng ấn nút TIẾP THEO thì phải ẩn đi dấu tick xanh đã hiển thị và tô màu viền lại
        thành màu ban đầu).
        - Hàm kiểm tra sự tồn tại của email trong database. Nếu đúng thì điều chỉnh thuộc 
        tính display của img có id là check thành block để nó hiển thị lên giao diện (sự kiện 
        mà hàm này bắt sẽ là khi nội dung của input[type="text"] bị thay đổi, nghĩa là khi người 
        dùng đang nhập liệu), đồng thời điều chỉnh màu viền của div có class là sign-up-name-input 
        thành mã màu #34C759. Nếu sai thì sẽ điều chỉnh nội dung của thẻ p có id là warning-content 
        thành 'Email này đã tồn tại', sau đó điều chỉnh thuộc tính visibility của div có 
        class là warning thành visible để nó hiển thị lên giao diện, đồng thời điều chỉnh màu 
        viền của div có class là sign-up-name-input thành mã màu #FF4141.
        (Lưu ý, hàm ở trên phải thực hiện kiểm tra mọi lúc khi mà nội dung trong ô nhập liệu thay đổi)
        (Sau khi người dùng ấn nút TIẾP THEO thì phải ẩn đi dấu tick xanh đã hiển thị và tô màu viền lại
        thành màu ban đầu).
        - Hàm để bắt sự kiện khi người dùng click vào nút TIẾP THEO thì sẽ dẫn đến giao diện 
        sign-up-acc-name chỉ khi nội dung trong ô nhập liệu là đúng.
        - Hàm để bắt sự kiện khi người dùng click vào mũi tên quay lại thì sẽ dẫn đến giao diện
        mà người dùng vừa ở trước đó.
        - Hàm để bắt sự kiện khi người dùng click vào nút Email thì sẽ dẫn đến giao diện
        sign-up-method-phone.
    4. Giao diện sign-up-acc-name:
        - Hàm kiểm tra định dạng của tên tài khoản. Nếu đúng thì điều chỉnh thuộc tính display của thẻ img 
        có id là check thành block để nó hiển thị lên giao diện (sự kiện mà hàm này bắt sẽ là khi nội 
        dung của input[type="text"] bị thay đổi, nghĩa là khi người dùng đang nhập liệu), đồng thời điều 
        chỉnh màu viền của div có class là sign-up-name-input thành mã màu #34C759. Nếu sai thì sẽ điều 
        chỉnh thuộc tính visibility của div có class là warning thành visible để nó hiển thị lên giao diện, 
        đồng thời điều chỉnh màu viền của div có class là sign-up-name-input thành mã màu #FF4141.
        - Hàm để bắt sự kiện khi người dùng click vào nút TIẾP THEO thì sẽ dẫn đến giao diện 
        sign-up-pass chỉ khi nội dung trong ô nhập liệu là đúng.
        - Hàm để bắt sự kiện khi người dùng click vào mũi tên quay lại thì sẽ dẫn đến giao diện
        mà người dùng vừa ở trước đó.
    5. Giao diện sign-up-pass:
        - Hàm kiểm tra định dạng của mật khẩu. Nếu đúng thì điều chỉnh thuộc tính display của thẻ img 
        có id là check thành block để nó hiển thị lên giao diện (sự kiện mà hàm này bắt sẽ là khi nội 
        dung của input[type="text"] bị thay đổi, nghĩa là khi người dùng đang nhập liệu), đồng thời điều 
        chỉnh màu viền của div có class là sign-up-name-input thành mã màu #34C759. Nếu sai thì sẽ điều 
        chỉnh thuộc tính visibility của div có class là warning thành visible để nó hiển thị lên giao diện, 
        đồng thời điều chỉnh màu viền của div có class là sign-up-name-input thành mã màu #FF4141.
        - Hàm để bắt sự kiện khi người dùng click vào icon mắt mở thì sẽ điều chỉnh đường dẫn src của thẻ img
        có id là eye thành ./image/hide/svg, đồng thời sẽ chỉnh cho toàn bộ chữ trong ô nhập liệu chuyển thành 
        chữ có thể xem được. Lưu ý: mặc định của ô nhập liệu là sẽ hiển thị ký tự * và hiển thị icon mắt mở.
        - Hàm để bắt sự kiện khi người dùng click vào icon mắt nhắm thì sẽ điều chỉnh đường dẫn src của thẻ img
        có id là eye thành .image/show.svg, đồng thời sẽ chỉnh cho toàn bộ chữ trong ô nhập liệu chuyển thành ký tự *,
        số lượng ký tự tương ứng với số lượng chữ cái.
        - Hàm để bắt sự kiện khi người dùng click vào nút ĐĂNG KÝ thì sẽ kiểm tra nội dung trong ô nhập 
        liệu có đúng hay không. Nếu đúng thì trước tiên sẽ sử dụng recaptcha để kiểm tra xem người đăng ký là human hay robot,
        sau khi kiểm tra recaptcha xong thì sẽ lưu toàn bộ thông tin về tài khoản mà người dùng đã cung
        cấp vào database; nếu người dùng chọn hình thức đăng ký bằng tên đăng ký thì sẽ tạo 3 biến lưu Tên 
        đăng ký, Tên tài khoản, Mật khẩu để lưu và database; nếu người dùng chọn hình thức đăng ký bằng SĐT
        thì sẽ tạo 3 biến lưu SĐT, Tên tài khoản, Mật khẩu để lưu và database; nếu người dùng chọn hình thức 
        đăng ký bằng email thì sẽ tạo 3 biến lưu Email, Mật khẩu để lưu và database. Trong hàm này phải có một 
        đoạn code if else để check xem là có lưu thành công hay không, nếu lưu không thành công thì sẽ điều
        chỉnh thuộc tính display của thẻ div có id là announcement thành flex. Ngược lại, nếu khi kiểm tra nội
        dung trong ô nhập liệu mà sai, thì cũng sẽ điều chỉnh thuộc tính display của thẻ div có id là announcement 
        thành flex.
*/
