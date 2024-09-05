<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Nhập</title>
	<link rel="shortcut icon" href="{{ asset('img/logoCanTho.png') }}"/>
    <link rel="stylesheet" href="{{ asset('css/Login.css') }}">
    <link rel="stylesheet" href="{{ asset('css/backgroundLogin.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  	<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script></head>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</head>
<body>
<ul class="background12">
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
</ul> 
<div class="form-structor">
	<div class="signup">
		<form action="/LoginAction" class="needs-validation login-form"  method="post" novalidate>
		@csrf
			<div style="text-align: center;"> <img style="width:110px;z-index:5" src="{{ asset('img/logoCanTho.png') }}"></img> </div>
			<h2 class="form-title" style="margin-top: 0px;" id="signup">Đăng Nhập</h2>
			<div style="text-align: center;">
			<div class="social-container" >
					<a href="{{ url('auth/google') }}" class="social"><i class="fab fa-google-plus-g"></i></a>
			</div>
			</div>
			<div class="form-holder">
			<div class="group" style="margin: 20px;">
			<input id="usenameInput" name="UserName" type="text" class="input form-control text-input " placeholder="Tài Khoản" required>
			<span class="highlight"></span>
			<span class="bar"></span>
			<div class="valid-feedback passwordcheck1">
				
			</div>
			<div class="invalid-feedback passwordcheck1">
				Vui lòng nhập tài khoản !
			</div>
			</div>
			<div class="group" style="margin: 20px;">
			<input id="passwordInput" name="Password" type="Password" class="input form-control text-input" placeholder="Mật Khẩu" required>
			<span class="highlight"></span>
			<span class="bar"></span>
			<div class="valid-feedback passwordcheck">
				
			</div>
			<div class="invalid-feedback passwordcheck">
				Vui lòng nhập mật khẩu !
			</div>
			</div>
			</div>
			<button class="submit-btn">Đăng Nhập</button>
		</form>
	</div>
	<form action="/Checkemailform" class="needs-validation check-email"  method="post" novalidate>
	@csrf
	<div class="login slide-up">
		<div class="center">
			<h2 class="form-title" id="login">Quên Mật Khẩu</h2>
			<div class="form-holder">
			<div class="group" style="margin: 10px;">
			<input id="emailInput1" name="Email" type="Email" class="input form-control text-input " placeholder="Email" required>
			<span class="highlight"></span>
			<span class="bar"></span>
			<div class="valid-feedback passwordcheck1">
				Nhập Email Thành Công
			</div>
			<div class="invalid-feedback passwordcheck1">
				Vui Lòng Nhập Email !
			</div>
			</div>
			</div>
			<button class="submit-btn">Log in</button>
		</div>
	</div>
	</form>
</div>
<div id="toast1"></div>
<div class="modal_login" id="modalLogin">
    <div class="loading-bar">Loading</div>
</div>
<script src="{{ asset('js/formvalidation.js') }}"></script>
<script src="{{ asset('js/Login.js') }}"></script>
<script>
		$('.login-form').submit(function(event) {
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
        // Hiển thị phần loading
        $('#modalLogin').css('display', 'flex');
        $.ajax({
            type: 'POST',
            url: url,
            data: formData,
            success: function(response) {
                if (response.success === true) {   
                    var message=""
                    showSuccessToast1();
                    setTimeout(function() {
                        window.location.href = "/adminWelcome";
                    }, 1000);
                } else if (response.successIndex === true){
                    var message=""
                    showSuccessToast1();
                    setTimeout(function() {
                        window.location.href = "/Index";
                    }, 1000);
                } else {    
                    showErrorToast1();
                    var forms = document.querySelectorAll(".login-form");
                    forms.forEach(function(form) {
                        form.reset();
                    });
                }
            },
            complete: function() {
                // Sau khi hoàn thành, ẩn phần loading
                $('#modalLogin').css('display', 'none');
            }
        });
    }
});

$(document).ready(function() {
      $('.check-email').submit(function(event) {
        event.preventDefault(); // Ngăn chặn form submit mặc định
        var form = $(this)[0]; // Lấy form DOM element
        var $form = $(this); // jQuery đối tượng của form
        var url = $form.attr('action');

        // Kiểm tra tính hợp lệ của form
        if (form.checkValidity() === false) {
          event.stopPropagation();
          $form.addClass('was-validated');
        } else {
          var formData = $form.serialize();
          $('#modalLogin').css('display', 'flex');
        $.ajax({
            type: 'POST',
            url: url,
            data: formData,
            success: function(response) {
                if (response.success === true) {   
                    var message=""
                    showSuccessToast2();
                    setTimeout(function() {
                        window.location.href = "/verifyOtp";
                    }, 1000);
                } else {    
                    showErrorToast2();
                    var forms = document.querySelectorAll(".login-form");
                    forms.forEach(function(form) {
                        form.reset();
                    });
                }
            },
            complete: function() {
                // Sau khi hoàn thành, ẩn phần loading
                $('#modalLogin').css('display', 'none');
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
  
    function showSuccessToast1(){
      toast1({
        title: "Success",
        message: "Đăng Nhập Thành Công !",
        type:"success",
        duration:2000
      })
    }
    function showErrorToast1(){
      toast1({
          title: "Error",
          message: "Tên Hoặc Mật Khẩu Không Đúng !",
          type:"error",
          duration:2000
      })
    }
	function showSuccessToast2(){
      toast1({
        title: "Success",
        message: "Email Thành Công !",
        type:"success",
        duration:2000
      })
    }
    function showErrorToast2(){
      toast1({
          title: "Error",
          message: "Email Không Tồn Tại!",
          type:"error",
          duration:2000
      })
    }

	document.addEventListener('DOMContentLoaded', function() {
	var passwordInput = document.getElementById('passwordInput'); // Thay đổi id tương ứng với thẻ input của bạn
    passwordInput.addEventListener('input', function(e) {
        var value = e.target.value;
        // Kiểm tra và loại bỏ khoảng trắng, dấu chấm và các ký tự đặc biệt
        var sanitizedValue = value.replace(/[\s\.]/g, '');
        e.target.value = sanitizedValue;
    });
});

document.addEventListener('DOMContentLoaded', function() {
    var usernameInput = document.getElementById('usenameInput'); // Adjust the id accordingly to your input tag
    usernameInput.addEventListener('input', function(e) {
        var value = e.target.value;
        // Remove any spaces
        var sanitizedValue = value.replace(/\s+/g, '');
        e.target.value = sanitizedValue;
    });
});


	var EmailInput1 = document.getElementById('emailInput1');
    EmailInput1.addEventListener('input', function(e) {
        var value = e.target.value;
        // Email regex pattern
        var emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

        // Check if the input value matches the email regex
        if (emailRegex.test(value)) {
            e.target.setCustomValidity('');
        } else {
            e.target.setCustomValidity(' ');
        }
        // Sanitize the input value by removing any characters that are not letters, numbers, or dots
        var sanitizedValue = value.replace(/[^a-zA-Z0-9.@]/g, '');
        e.target.value = sanitizedValue;
    });
</script>
</body>
</html>