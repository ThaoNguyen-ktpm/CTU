<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('img/Artboard 3.png') }}"/>
    <title>@if(isset($title))
            {{ $title }}
        @else
            Trang chủ
        @endif</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script></head>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
	<body class="login-body">
    <style>
		.sign-in-container{
			width:100% ;
		}
		.overlay-container{
			display: none;
		}
		.overlay-right{
			display: none;
		}
		.sign-up-container{
			display: none;
		}
		.container {
			width: 450px;
		}

</style>
    </style>
	<div class="container" id="container">
	<div class="form-container sign-in-container">
		<form action="/CheckPasswordform" class="needs-validation login-form"  method="post" novalidate>
        @csrf
			<img style="width:100px;margin-top:20px;z-index:5;" src="{{ asset('img/Artboard 3.png') }}"></img>
			<h1 style="color:#0e3d7e ;font-size: 30px; padding-bottom: 30px; padding-top: 30px;">Khôi Phục Mật Khẩu</h1>
      <div class="group-login">
				<div style="display:flex;justify-content:flex-start;width:100%;margin-left:10px;">
					<i class="fa-solid fa-user"></i>
					<span class="login-label">Confirm Password</span>
				</div>
				<input id="PasswordInput" type="Password" class="text-input" placeholder="Confirm Password" name="Password" required/>
				<div class="valid-feedback text-valid" >
					Nhập Password Thành Công
				</div>
				<div class="invalid-feedback text-valid" >
					Vui Lòng Nhập Password !
				</div>
			</div>
      <div class="group-login">
				<div style="display:flex;justify-content:flex-start;width:100%;margin-left:10px;">
					<i class="fa-solid fa-user"></i>
					<span class="login-label">Password</span>
				</div>
				<input id="PasswordInput1" type="Password" class="text-input" placeholder="Password" name="Password1" required/>
				<div class="valid-feedback text-valid" >
					Nhập Password Thành Công
				</div>
				<div class="invalid-feedback text-valid" >
					Vui Lòng Nhập Password !
				</div>
			</div>
			<button  type="submit" name="Add">Send</button>
		</form>
	</div>
</div>
<div id="toast1"></div>
<div class="modal_login" id="modalLogin">
    <div class="loading-bar">Loading</div>
</div>
<script src="{{ asset('js/formvalidation.js') }}"></script>
<script src="{{ asset('js/login.js') }}"></script>
</body>
</html>
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
                    showSuccessToast2();
                    setTimeout(function() {
                        window.location.href = "/";
                    }, 1000);
                } else if (response.email === false){
                  showErrorToast3();
                    var forms = document.querySelectorAll(".login-form");
                    forms.forEach(function(form) {
                        form.reset();
                    });
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
        message: "Đăng Ký Thành Công !",
        type:"success",
        duration:2000
      })
    }
    function showErrorToast1(){
      toast1({
          title: "Error",
          message: "Đã Tồn Tại UserName !",
          type:"error",
          duration:2000
      })
    }
	    
    function showSuccessToast2(){
      toast1({
        title: "Success",
        message: "Đổi Mật Khẩu Thành Công !",
        type:"success",
        duration:2000
      })
    }
    function showErrorToast2(){
      toast1({
          title: "Error",
          message: "Mật Khẩu Không Trùng Khớp !",
          type:"error",
          duration:2000
      })
    }
    function showErrorToast3(){
      toast1({
          title: "Error",
          message: "Đổi Mật Khẩu Thất Bại !",
          type:"error",
          duration:2000
      })
    }
    var usernameInput = document.getElementById('PasswordInput');
usernameInput.addEventListener('input', function(e) {
  var value = e.target.value.trim();
  e.target.value = value;
});

var usernameInput1 = document.getElementById('PasswordInput1');
usernameInput1.addEventListener('input', function(e) {
  var value = e.target.value.trim();
  e.target.value = value;
});
</script>
