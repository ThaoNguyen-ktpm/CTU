@extends('layouts/layoutAdmin')
@section('content')
 
<div class="col">
<div class="container">
  <h2 class="text-weight">Thêm Đơn Vị<small></small></h2>
  <form  method="post" class="needs-validation DonVi-form"  action="/DonVi/add" novalidate>
  @csrf
    <div class="group">
    <label>Tên Đơn Vị <span style="color:red;">(*)</span></label>
      <input  id="usernameInput" name="TenDonVi" type="text"  class="form-control" required pattern="^\S.*">
      <span class="highlight"></span>
      <span class="bar"></span>
      <div class="valid-feedback">
        Nhập Đơn Vị Thành Công
      </div>
      <div class="invalid-feedback">
        Vui Lòng Nhập Đơn Vị !
      </div>
    </div>
      <button name="Add" type="submit" class="submit-btn">Thêm Đơn Vị</button>
  </form>
</div>
</div>
<div id="toast1"></div>
<script src="{{ asset('js/formvalidation.js') }}"></script>
<script>
	 $(document).ready(function() {
      $('.DonVi-form').submit(function(event) {
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
                showSuccessToast1();
                setTimeout(function() {
                  window.location.href = "/DonVi";
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
          message: " Đơn Vị Đã Tồn Tại !",
          type:"error",
          duration:2000
      })
    }
	    
    function showSuccessToast1(){
      toast1({
        title: "Success",
        message: "Thêm Đơn Vị Thành Công !",
        type:"success",
        duration:2000
      })
    }
</script>

<script>
  var usernameInput = document.getElementById('usernameInput');
  usernameInput.addEventListener('input', function(e) {
    var value = e.target.value;
    // Loại bỏ khoảng trắng đầu tiên nếu có
    var sanitizedValue = value.replace(/^\s/, '');
    e.target.value = sanitizedValue;
  });
</script>
@endsection
