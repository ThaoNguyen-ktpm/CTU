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
  <h2 class=" text-weight">Thêm Phòng Học<small></small></h2>
  <form  method="post" class="needs-validation PhongHoc-form" action="/PhongHoc/add" novalidate>
  @csrf
    <div class="group">
    <label>Tên Phòng Học <span style="color:red;">(*)</span></label>
      <input id="phonghocInput" name="TenPhongHoc" type="text" class="form-control" required>
      <span class="highlight"></span>
      <span class="bar"></span>
      <div class="valid-feedback">
        Nhập Phòng Học Thành Công
      </div>
      <div class="invalid-feedback">
        Vui Lòng Nhập Phòng Học !
      </div>
    </div>
      <button name="Add" type="submit" class="submit-btn">Thêm Phòng Học</button>
  </form>
</div>
</div>
<div id="toast1"></div>
<script src="{{ asset('js/formvalidation.js') }}"></script>
<script>
	$(document).ready(function() {
		$('.PhongHoc-form').submit(function(event) {
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
								window.location.href = "/PhongHoc";
							}, 1000);
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
    function showErrorToast1(){
      toast1({
          title: "Error",
          message: "Đã Tồn Tại Phòng Học  !",
          type:"error",
          duration:2000
      })
    }
	    
    function showSuccessToast1(){
      toast1({
        title: "Success",
        message: "Thêm Phòng Học Thành Công !",
        type:"success",
        duration:2000
      })
    }
  
    document.addEventListener('DOMContentLoaded', function() {
    var phonghocInput = document.getElementById('phonghocInput'); // Thay đổi id tương ứng với thẻ input của bạn
    phonghocInput.addEventListener('input', function(e) {
        var value = e.target.value;
        // Kiểm tra và loại bỏ khoảng trắng, dấu chấm và các ký tự đặc biệt
        var sanitizedValue = value.replace(/[\s\.]/g, '');
        e.target.value = sanitizedValue;
    });
});
</script>
@endsection
