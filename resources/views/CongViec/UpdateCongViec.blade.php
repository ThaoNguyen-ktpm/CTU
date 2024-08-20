@extends('layouts/layoutAdmin')
@section('content')
 
<div class="col">
<div class="container">
  <h2 class=" text-weight">Cập Nhật Công Việc<small></small></h2>
  <form  method="post" class="needs-validation CongViec-form" action="/CongViec/update/{{$CongViec->id}}" novalidate>
  @csrf
    <div class="group">
    <label>Tên Công Việc <span style="color:red;">(*)</span></label>
      <input  id="usernameInput" name="TenCongViec" value="{{ $CongViec->TenCongViec }}" type="text" class="form-control" required>
      <span class="highlight"></span>
      <span class="bar"></span>
      <div class="valid-feedback">
        Nhập Công Việc Thành Công
      </div>
      <div class="invalid-feedback">
        Vui Lòng Nhập Công Việc !
      </div>
    </div>
    <div class="group">
    <label>Link Tài Liệu <span style="color:red;"></span></label>
      <input  id="linkInput" name="LinkTaiLieu" value="{{ $CongViec->LinkTaiLieu }}" type="text"  class="form-control" pattern="^\S.*">
      <span class="highlight"></span>
      <span class="bar"></span>
      <div class="valid-feedback">
        Nhập Link Tài Liệu Thành Công
      </div>
      <div class="invalid-feedback">
        Vui Lòng Nhập Link Tài Liệu !
      </div>
    </div>
    <div class="group">
    <label> Mô Tả <span style="color:red;">(*)</span></label>
    <textarea id="NoiDungInput" name="MoTa" class="form-control textarea" required>{{ $CongViec->MoTa }}</textarea>
    <span class="highlight"></span>
    <span class="bar"></span>
    <div class="valid-feedback">
        Nhập Mô Tả Thành Công
    </div>
    <div class="invalid-feedback">
        Vui Lòng Nhập Mô Tả!
    </div>
</div>
  <div style="background-color: darkgreen; color: white; padding: 10px; margin-top: 10px;">
        <span>Số Ngày Thực Hiện: {{ $soNgayThucHien1 }} ngày</span><br>
        <span>Thời Gian Thực Hiện: {{ $ngayBatDau1 }} Đến {{ $ngayKetThuc1}}</span>
    </div>
    
    <div class="group">
      <label>Số Ngày Thực Hiện <span style="color:red;">(*)</span></label>
      <input id="SoNgayThucHienInput" name="SoNgayThucHien" value="{{ $soNgayThucHien }}" type="number" min="1" max="1000" class="form-control" required>
        <span class="highlight"></span>
        <span class="bar"></span>
        <div class="valid-feedback">Nhập Ngày Thực Hiện Thành Công</div>
        <div class="invalid-feedback">Vui Lòng Nhập Số Ngày Thực Hiện Không Lớn Hơn Số Ngày Của Giai Đoạn!</div>
    </div>
    
  <input name="NgayBatDau" value="{{ $ngayBatDau2 }}" type="date"  class="form-control"  >
  


    <div class="group" style="margin-top: 20px;">
        <label>Chọn Người Nhận Việc<span style="color:red;"> (*)</span></label>
      <div  class="GiaoVienGiangDay-list">
      @foreach($ThanhVienDuAn as $NguoiDung1)
    <div class="form-check">
        <input class="form-check-input" type="checkbox" name="MaNguoiDung[]" value="{{$NguoiDung1->id}}"
            {{ in_array($NguoiDung1->id, array_column($ThanhVienCongViec, 'id')) ? 'checked' : '' }}>
        <label class="form-check-label">
            {{$NguoiDung1->user_name}} 
        </label>
    </div>
@endforeach




    </div>
      <div class="valid-feedback">
          Chọn Thành Viên Thành Công
      </div>
      <div class="invalid-feedback">
          Vui Lòng Chọn Thành Viên!
      </div>
  </div>
  <p class="validation-message" style="color: red; display: none;">Phải chọn ít nhất 1 Người Nhận Việc!</p>
      <button name="Add" type="submit" class="submit-btn">Cập Nhật</button>
  </form>
</div>
</div>
<div id="toast1"></div>
<script src="{{ asset('js/formvalidation.js') }}"></script>

<script>
    var soNgayThucHien = "{{$soNgayThucHien1 }}";
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var soNgayThucHien = "{{ $soNgayThucHien1 }}";

        var inputElements = document.querySelectorAll('input[name="SoNgayThucHien"]');
        inputElements.forEach(function(input) {
            input.addEventListener('input', function(e) {
                var value = e.target.value;
                var sanitizedValue = parseInt(value, 10); // Chuyển đổi giá trị thành số nguyên
                
                // Kiểm tra số ngày thực hiện
                if (sanitizedValue > soNgayThucHien) {
                    e.target.setCustomValidity(`Số ngày thực hiện không được vượt quá ${soNgayThucHien} ngày!`);
                } else {
                    e.target.setCustomValidity('');
                }
            });
        });
    });
</script>
<script>

	 $(document).ready(function() {
      $('.CongViec-form').submit(function(event) {
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
                  window.location.href = "/CongViec";
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
          message: "Đã Tồn Tại Giai Đoạn  !",
          type:"error",
          duration:2000
      })
    }
	    
    function showSuccessToast1(){
      toast1({
        title: "Success",
        message: "Cập Nhật Giai Đoạn Thành Công !",
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
