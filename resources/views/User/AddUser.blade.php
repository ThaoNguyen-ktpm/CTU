@extends('layouts/layoutAdmin')
@section('content')
 
<div class="col">
<div class="container">
  <h2 class="text-weight">Thêm Người Dùng<small></small></h2>
  <form action="/User/add" class="needs-validation User-form" method="post"   novalidate>
  @csrf
    <div class="group">
    <label>Tên Người Dùng <span style="color:red;">(*)</span></label>
      <input id="usenameInput" name="UserName" type="text" class="form-control text-input" required>
      <span class="highlight"></span>
      <span class="bar"></span>
      <div class="valid-feedback">
        Nhập Tên Người Dùng Thành Công
      </div>
      <div class="invalid-feedback">
        Vui Lòng Nhập Tên Người Dùng !
      </div>
    </div>
    <div class="group">
    <label>Mật Khẩu <span style="color:red;">(*)</span></label>
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
    <label>Nhập Mật Khẩu <span style="color:red;">(*)</span></label>
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
    <div class="group">
    <label>Số Điện Thoại <span style="color:red;">(*)</span></label>
      <input id="sdtInput" name="SDT" type="number" class="form-control text-input" required>
      <span class="highlight"></span>
      <span class="bar"></span>
      <div class="valid-feedback">
        Nhập Số Điện Thoại Thành Công
      </div>
      <div class="invalid-feedback">
        Vui Lòng Nhập Số Điện Thoại!
      </div>
    </div>
    <div class="group">
    <label>Email <span style="color:red;">(*)</span></label>
      <input id="emailInput"  name="Email" type="email" class="form-control text-input " required>
      <span class="highlight"></span>
      <span class="bar"></span>
      <div class="valid-feedback emailcheck">
        Nhập Email Thành Công
      </div>
      <div class="invalid-feedback emailcheck">
        Vui Lòng Nhập Email !
      </div>
    </div>
      <button name="Add" type="submit" class="submit-btn">Thêm Người Dùng</button>
  </form>
</div>
</div>
<div id="toast1"></div>
<script src="{{ asset('js/formvalidation.js') }}"></script>
<script>

$(document).ready(function() {
      $('.User-form').submit(function(event) {
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
						} if (response.message == false) {
              showErrorToast1()
            } else if(response.success === false) {
              showErrorToast2();
            } else if(response.email === false) {
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
    function showErrorToast3(){
      toast1({
          title: "Error",
          message: " Email Đã Tồn Tại !",
          type:"error",
          duration:2000
      })
    }
    function showErrorToast2(){
      toast1({
          title: "Error",
          message: " User Đã Tồn Tại !",
          type:"error",
          duration:2000
      })
    }
    function showErrorToast1(){
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
        message: "Thêm User Thành Công !",
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

  

    var usernameInput = document.getElementById('usenameInput');
    usernameInput.addEventListener('input', sanitizeInput);

    var passwordInput = document.getElementById('passwordInput');
    passwordInput.addEventListener('input', sanitizeInput);

    var passwordInput1 = document.getElementById('passwordInput1');
    passwordInput1.addEventListener('input', sanitizeInput);

    var emailInput = document.getElementById('emailInput');
    emailInput.addEventListener('input', function(e) {
        var value = e.target.value;
        var emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        if (!emailRegex.test(value)) {
            var sanitizedValue = value.replace(/[^a-zA-Z0-9.@]/g, '');
            e.target.value = sanitizedValue;
        }
    });
});
var sdtInput = document.getElementById('sdtInput');
sdtInput.addEventListener('input', function(e) {
  var value = e.target.value;
  
  // Remove non-numeric characters
  var sanitizedValue = value.replace(/\D/g, '');

  // Check if the sanitized value is between 10 to 11 digits
  var isValid = /^[0-9]{10,11}$/.test(sanitizedValue);

  if (isValid) {
    e.target.setCustomValidity('');
  } else {
    e.target.setCustomValidity(' ');
  }

  // Update the input value to be the sanitized value
  e.target.value = sanitizedValue;
});
</script>
@endsection
