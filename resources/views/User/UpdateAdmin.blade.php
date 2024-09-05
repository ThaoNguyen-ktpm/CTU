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
  <h2 class=" text-weight">Cập Nhật Admin<small></small></h2>
  <form  method="post" class="needs-validation Admin-form" action="/Admin/update/{{$User->id}}" novalidate>
  @csrf
  <div class="group">
    <label>Họ và tên Admin <span style="color:red;">(*)</span></label>
      <input id="usenameInput" name="UserName" value="{{ $User->Name }}" type="text" class="form-control" required>
      <span class="highlight"></span>
      <span class="bar"></span>
      <div class="valid-feedback">
      
      </div>
      <div class="invalid-feedback">
        Vui lòng nhập họ và tên Admin  !
      </div>
    </div>

    <div class="group">
    <label>Số điện thoại <span style="color:red;">(*)</span></label>
      <input id="sdtInput" name="SDT" value="{{ $User->SDT }}" type="number" class="form-control" required>
      <span class="highlight"></span>
      <span class="bar"></span>
      <div class="valid-feedback">
       
      </div>
      <div class="invalid-feedback">
        Vui lòng nhập số điện thoại !
      </div>
    </div>
    <div class="group">
    <label>Email <span style="color:red;">(*)</span></label>
      <input id="emailInput" name="Email" value="{{ $User->Email }}" type="email" class="form-control" required>
      <span class="highlight"></span>
      <span class="bar"></span>
      <div class="valid-feedback">
      
      </div>
      <div class="invalid-feedback">
        Vui Lòng Nhập Email !
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
      $('.Admin-form').submit(function(event) {
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
								window.location.href = "/Admin";
							}, 1000);
						} else if (response.message === false) {
              showErrorToast2()
            } else if (response.email === false) {
              showErrorToast3()
            } else {
              showErrorToast1();
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
          message: "Đã Tồn Tại Email !",
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
    function showErrorToast1(){
      toast1({
          title: "Error",
          message: "Đã Tồn Tại Admin  !",
          type:"error",
          duration:2000
      })
    }
	    
    function showSuccessToast1(){
      toast1({
        title: "Success",
        message: "Cập Nhật Admin Thành Công !",
        type:"success",
        duration:2000
      })
    }
    document.addEventListener('DOMContentLoaded', function() {
    var usenameInput = document.getElementById('usenameInput'); // Thay đổi id tương ứng với thẻ input của bạn
    usenameInput.addEventListener('input', function(e) {
        var value = e.target.value;
        // Kiểm tra và loại bỏ khoảng trắng, dấu chấm và các ký tự đặc biệt
        var sanitizedValue = value.replace(/[\s\.]/g, '');
        e.target.value = sanitizedValue;
    });
});
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
    var passwordInput1 = document.getElementById('passwordInput1'); // Thay đổi id tương ứng với thẻ input của bạn
    passwordInput1.addEventListener('input', function(e) {
        var value = e.target.value;
        // Kiểm tra và loại bỏ khoảng trắng, dấu chấm và các ký tự đặc biệt
        var sanitizedValue = value.replace(/[\s\.]/g, '');
        e.target.value = sanitizedValue;
    });
});
document.addEventListener('DOMContentLoaded', function() {
    var sdtInput = document.getElementById('sdtInput'); // Thay đổi id tương ứng với thẻ input của bạn
    sdtInput.addEventListener('input', function(e) {
        var value = e.target.value;
        // Loại bỏ các khoảng trắng, dấu chấm và ký tự đặc biệt
        var sanitizedValue = value.replace(/[\s\.]/g, '');
        // Kiểm tra và giữ lại chỉ 15 ký tự số đầu tiên
        sanitizedValue = sanitizedValue.slice(0, 15);
        // Ngăn người dùng nhập số âm
        if (parseInt(sanitizedValue) < 0) {
            sanitizedValue = ''; // hoặc thiết lập là '0' nếu bạn muốn
        }
        e.target.value = sanitizedValue;
    });
});
document.addEventListener('DOMContentLoaded', function() {
    var EmailInput = document.getElementById('emailInput'); // Thay đổi id tương ứng với thẻ input của bạn
    EmailInput.addEventListener('input', function(e) {
      var value = e.target.value;
        // Biểu thức chính quy để kiểm tra định dạng email
        var emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        
        // Kiểm tra xem giá trị nhập vào có phù hợp với định dạng email không
        if (!emailRegex.test(value)) {
            // Nếu không phù hợp, loại bỏ tất cả các ký tự không phải là chữ cái, số, hoặc dấu chấm
            var sanitizedValue = value.replace(/[^a-zA-Z0-9.@]/g, '');
            e.target.value = sanitizedValue;
        }
    });
});

</script>
@endsection
