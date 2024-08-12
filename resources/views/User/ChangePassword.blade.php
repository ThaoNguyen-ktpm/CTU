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
  @php
      $sessionUser = Session::get('sessionUser');
      $sessionUserId = Session::get('sessionUserId');
      $IsAdmin = Session::get('IsAdmin');
  @endphp
  @if(isset($IsAdmin) && $IsAdmin == 1)
  <form action="/User/ChangePasswordAdmin/{{$User->id}}" class="needs-validation Admin-form-Change" method="post"   novalidate>
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
 @else
 <form action="/User/ChangePasswordUser/{{$User->id}}" class="needs-validation User-form-Change" method="post"   novalidate>
  @csrf
  <div class="group">
    <label>Mật Khẩu Cũ <span style="color:red;">(*)</span></label>
      <input id="passwordInputChange" name="ChangePassword" type="Password" class="form-control text-input Changeshowpassword" required>
      <span class="highlight"></span>
      <span class="bar"></span>
      <div class="valid-feedback Changepasswordcheck">
        Nhập Mật Khẩu Thành Công
      </div>
      <div class="invalid-feedback Changepasswordcheck">
        Vui Lòng Nhập Mật Khẩu !
      </div>
    </div>
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
  @endif   

  
</div>
</div>
<div id="toast1"></div>
<script src="{{ asset('js/formvalidation.js') }}"></script>
<script>
	$(document).ready(function() {
		$('.Admin-form-Change').submit(function(event) {
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
								window.location.href = "/User";
							}, 1000);
						} if (response.password === false) {
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
  $(document).ready(function() {
		$('.User-form-Change').submit(function(event) {
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
								window.location.href = "/User";
							}, 1000);
						} if (response.Password === false) {
              showErrorToast1()
            } else if(response.success === false) {
              showErrorToast2();
            }  else if(response.successID === false) {
              showErrorToast3();
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
          message: "Mật Khẩu Cũ Không Đúng !",
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
    }  function showErrorToast3(){
      toast1({
          title: "Error",
          message: "Không Đủ Quyền Thay Đổi !",
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


</script>
@endsection
