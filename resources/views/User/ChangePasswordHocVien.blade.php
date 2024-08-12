@extends('layouts/layoutAdmin')
@section('content')
@php
session_start();
// Kiểm tra sessionUserId tồn tại hay không
$sessionUserId = Session::get('sessionUserId');

if (!$sessionUserId) {
    header('Location: /Login');
    exit();
}
@endphp   
<div class="col">
<div class="container">
  <h2 class="text-weight">Đổi Mật Khẩu<small></small></h2>
  <form action="/User/ChangePasswordHocVien/{{$User->id}}" class="needs-validation form-Change" method="post"   novalidate>
  @csrf
    <div class="group">
    <label>Mật Khẩu Mới <span style="color:red;">(*)</span></label>
      <input id="passwordInput" name="Password" type="Password" class="form-control text-input showpassword" required>
      <span class="highlight"></span>
      <span class="bar"></span>
      <div class="valid-feedback passwordcheck">
        Nhập Mật Khẩu Thành Công
      </div>
      <div class="invalid-feedback passwordcheck">
        Vui Lòng Nhập Mật Khẩu !
      </div>
    </div>
    <div class="group">
    <label>Nhập Lại Mật Khẩu <span style="color:red;">(*)</span></label>
      <input id="passwordInput1"  name="Password1" type="Password" class="form-control text-input showpassword1" required>
      <span class="highlight"></span>
      <span class="bar"></span>
      <div class="valid-feedback passwordcheck1">
        Nhập Mật Khẩu Thành Công
      </div>
      <div class="invalid-feedback passwordcheck1">
        Vui Lòng Nhập Mật Khẩu !
      </div>
    </div>
      <button name="Add" type="submit" class="submit-btn">Cập Nhật</button>
  </form>
</div>
</div>
<div id="toast1"></div>
<script src="{{ asset('js/formvalidation.js') }}"></script>
<script>
  $(document).ready(function() {
		$('.form-Change').submit(function(event) {
			event.preventDefault(); // Ngăn chặn form submit mặc định
			var form = $(this);
			var url = form.attr('action');
			var formData = form.serialize();
			var isError = false;
			form.find('input[required]').each(function() {
            var input = $(this);
            if (input.val() === '') {
                isError = true;
            } 
        });
			if (!isError) {
				$.ajax({
					type: 'POST',
					url: url,
					data: formData,
					success: function(response) {
						if (response.success === true) {	
							var message=""			
							showSuccessToast1();
							setTimeout(function() {
								window.location.href = "/UserHocVien";
							}, 1000);
						} if (response.Password === false) {
              showErrorToast1()
            } else if(response.success === false) {
              showErrorToast2();
            } else{
              console.log(xhr.responseText);   
            }									
					}
				});
			}
		});
	});
  function toast1({title='',message='',type='info',duration=2000}){
    const main=document.getElementById('toast1');
    if (main){
      const toast1=document.createElement('div');
      const autoRemoveID=setTimeout(function(){
        main.removeChild(toast1);
      },duration+500)
      toast1.onclick=function(e){
        if (e.target.closest('.toast1_close')){
        main.removeChild(toast1);
        clearTimeout(autoRemoveID);
        }
      }
      const icons={
          success: 'fas fa-circle-check',
          warning: "fa-solid fa-exclamation",
          error: "fa-sharp fa-solid fa-bug",
      };
        const icon =icons[type]
        const deplay=(duration/1000).toFixed(2);
        toast1.style.animation=`slideInLeft ease .5s,fadeOut linear 1s ${deplay}s forwards`;
        toast1.classList.add('toast1',`toast1--${type}`);
        toast1.innerHTML=`     
        <!-- icon -->
        <div class="toast1_icon">
        <i class="${icon}"></i>         
        </div>
        <div class="toast1_body">
        <!-- Tiêu đề -->
        <h3 class="toast1_title">${title}</h3>
        <!-- Nội dung -->
        <p class="toast1_msg">${message}</p>
        
        </div>
        <!-- Nút Close -->
        <div class="toast1_close">
        <i class="fa-solid fa-rectangle-xmark"></i>                
        </div>
        `;
        main.appendChild(toast1);               
      }
    }
    function showErrorToast1(){
      toast1({
          title: "Error",
          message: "Mật Khẩu Không Đúng !",
          type:"error",
          duration:2000
      })
    }
    function showErrorToast2(){
      toast1({
          title: "Error",
          message: " Mật Khẩu Không Trùng Khớp !",
          type:"error",
          duration:2000
      })
    }
    function showSuccessToast1(){
      toast1({
        title: "Success",
        message: "Đổi Mật Khẩu Thành Công !",
        type:"success",
        duration:2000
      })
    }
    document.addEventListener('DOMContentLoaded', function() {
    var sanitizeInput = function(e) {
        var value = e.target.value;
        var sanitizedValue = value.replace(/[\s\.]/g, '');
        e.target.value = sanitizedValue;
    };

  
    var passwordInput = document.getElementById('passwordInput');
    passwordInput.addEventListener('input', sanitizeInput);

    var passwordInput1 = document.getElementById('passwordInput1');
    passwordInput1.addEventListener('input', sanitizeInput);

   
});


// (function () {
//   'use strict'
//   // Fetch all the forms we want to apply custom Bootstrap validation styles to
//   var forms = document.querySelectorAll('.needs-validation');
//   let listeningForInput = false;
//   // Loop over them and prevent submission
//   Array.prototype.slice.call(forms)
//   .forEach(function (form) {
// 	form.addEventListener('submit', function (event) {
//   // Ngăn chặn hành động mặc định của sự kiện gửi biểu mẫu
//   event.preventDefault();

//   // Ngăn chặn sự lan truyền của sự kiện lên các phần tử cha
//   event.stopPropagation();

//     // Bắt đầu lắng nghe sự kiện "input" trên các trường nhập liệu
//     startListeningForInput();
 
//     // Nếu biểu mẫu không hợp lệ, thêm lớp 'was-validated' để hiển thị thông báo lỗi
//     form.classList.add('was-validated');
  
// }, false);

// // Hàm bắt đầu lắng nghe sự kiện "input" trên các trường nhập liệu
// function startListeningForInput() {
//   if (!listeningForInput) {
//     // Lắng nghe sự kiện "input" trên trường email
//     emailInput.addEventListener('input', function() {
//       // Kiểm tra hợp lệ của email khi người dùng nhập liệu
//       checkEmailValidity();
//     });
//     // Lắng nghe sự kiện "input" trên trường password
//     passwordInput.addEventListener('input', function() {
//       // Kiểm tra hợp lệ của mật khẩu khi người dùng nhập liệu
//       checkPasswordValidity();
//     });
//     passwordInput12.addEventListener('input', function() {
//       // Kiểm tra hợp lệ của mật khẩu khi người dùng nhập liệu
//       checkPasswordValidity1();
//     });
//     // Đặt cờ đã bắt đầu lắng nghe sự kiện "input"
//     listeningForInput = true;
//   }
// }
//     });
// 	var submitButton = document.getElementById('submitButton');
//   var passwordInput = document.querySelector('.text-input[name="Email"]');
//   var invalidFeedback = document.querySelector('.invalid-feedback.emailcheck');
//   var validFeedback = document.querySelector('.valid-feedback.emailcheck');
//   var passwordInput = document.querySelector('.text-input[name="Password"]');
//   var invalidFeedbackPassword = document.querySelector('.invalid-feedback.passwordcheck');
//   var validFeedbackPassword = document.querySelector('.valid-feedback.passwordcheck');
//   var passwordInput12 = document.querySelector('.showpassword1');
//   var invalidFeedbackPassword1 = document.querySelector('.invalid-feedback.passwordcheck1');
//   var validFeedbackPassword1 = document.querySelector('.valid-feedback.passwordcheck1');

//   function checkEmailValidity() {
//     var emailValue = emailInput.value;
// 	if (emailValue.endsWith('@student.ctuet.edu.vn')) {
//     // Nếu email có đuôi @student.ctuet.edu.vn
//     invalidFeedback.textContent = 'Email Không Hợp Lệ!';
//     invalidFeedback.style.display = 'block';
// 	  validFeedback.style.display = 'none';
//     submitButton.disabled = true; // Ngăn chặn việc gửi form
// 	} else if (emailValue.trim() === '') {
// 		invalidFeedback.textContent = 'Vui Lòng Nhập Email!';
// 		invalidFeedback.style.display = 'block';
// 		validFeedback.style.display = 'none';
//     submitButton.disabled = true;
// 	} else if (!isValidEmail(emailValue)) { // Thêm điều kiện kiểm tra định dạng email
// 		invalidFeedback.textContent = 'Email Không Hợp Lệ!';
// 		invalidFeedback.style.display = 'block';
// 		validFeedback.style.display = 'none';
//       submitButton.disabled = true;
// 	} else {
// 		validFeedback.style.display = 'block';
// 		invalidFeedback.style.display = 'none';
//       submitButton.disabled = false; 
// 	}
// }

//  function checkPasswordValidity() {
//     var passwordValue = passwordInput.value;
//     if (passwordValue.length < 10) {
//         invalidFeedbackPassword.textContent = 'Mật khẩu phải có ít nhất 10 ký tự!';
//         invalidFeedbackPassword.style.display = 'block';
//         validFeedbackPassword.style.display = 'none';
//         submitButton.disabled = true;
//     } else if (passwordValue === '') { // Kiểm tra nếu mật khẩu rỗng
//         invalidFeedbackPassword.textContent = 'Vui lòng nhập mật khẩu!';
//         invalidFeedbackPassword.style.display = 'block';
//         validFeedbackPassword.style.display = 'none';
//         submitButton.disabled = true;
//     } else {
//         validFeedbackPassword.style.display = 'block';
//         invalidFeedbackPassword.style.display = 'none';
//         submitButton.disabled = false;
//     }
// }
// function checkPasswordValidity1() {
//     var passwordValue1 = passwordInput12.value;
//     if (passwordValue1.length < 10) {
//         invalidFeedbackPassword1.textContent = 'Mật khẩu phải có ít nhất 10 ký tự!';
//         invalidFeedbackPassword1.style.display = 'block';
//         validFeedbackPassword1.style.display = 'none';
//         submitButton.disabled = true;
//     } else if (passwordValue1 === '') { // Kiểm tra nếu mật khẩu rỗng
//         invalidFeedbackPassword1.textContent = 'Vui lòng nhập mật khẩu!';
//         invalidFeedbackPassword1.style.display = 'block';
//         validFeedbackPassword1.style.display = 'none';
//         submitButton.disabled = true;
//     } else {
//         validFeedbackPassword1.style.display = 'block';
//         invalidFeedbackPassword1.style.display = 'none';
//         submitButton.disabled = false;
//     }
// }
// })();
</script>
@endsection
