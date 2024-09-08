@extends('layouts/layoutAdmin')
@section('content')
 
<div class="col">
<div class="container">
  <h2 class=" text-weight">Cập Nhật Công Việc<small></small></h2>
  <form  method="post" class="needs-validation CongViec-form" action="/CongViec/update/{{$CongViec[0]->id}}" novalidate>
  @csrf
    <div class="group">
    <label>Tên công việc <span style="color:red;">(*)</span></label>
      <input  id="usernameInput" name="TenCongViec" value="{{ $CongViec[0]->TenCongViec }}" type="text" class="form-control" required>
      <span class="highlight"></span>
      <span class="bar"></span>
      <div class="valid-feedback">
      </div>
      <div class="invalid-feedback">
        Vui lòng nhập công việc !
      </div>
    </div>

    <div style="background-color: darkgreen; color: white; padding: 10px; margin-top: 10px;">
       
    <span>Thời Gian Dự Án: Ngày {{ \Carbon\Carbon::parse($CongViec[0]->NgayBatDauDuAn)->format('d/m/Y') }} đến {{ \Carbon\Carbon::parse($CongViec[0]->NgayKetThucDuAn)->format('d/m/Y') }}</span><br>
       <span>Thời Gian Giai Đoạn: Ngày{{ $ngayBatDau1 }} đến {{ $ngayKetThuc1}}</span>
   </div>

    <div class="group">
    <label>Ngày bắt đầu <span style="color:red;">(*)</span> <label>(lưu ý: tháng / ngày / năm)</label></label>
    <input name="NgayBatDau" value="{{ \Carbon\Carbon::parse($CongViec[0]->NgayBatDau)->format('Y-m-d') }}" type="date" class="form-control" required>
    <span class="highlight"></span>
    <span class="bar"></span>
    <div class="valid-feedback"></div>
    <div class="invalid-feedback invalid-feedback1" id="dateStartInvalidFeedback">
        Vui lòng chọn ngày bắt đầu lớn hơn ngày bắt đầu dự án!
    </div>
</div>

<div class="group">
    <label>Ngày đến hẹn <span style="color:red;">(*)</span> <label>(lưu ý: tháng / ngày / năm)</label></label>
    <input name="NgayKetThuc" value="{{ \Carbon\Carbon::parse($CongViec[0]->NgayKetThuc)->format('Y-m-d') }}" type="date" class="form-control" required>
    <span class="highlight"></span>
    <span class="bar"></span>
    <div class="valid-feedback"></div>
    <div class="invalid-feedback invalid-feedback2" id="dateEndInvalidFeedback">
        Ngày đến hẹn phải nhỏ hơn ngày bắt đầu hoặc nhỏ hơn ngày kết thúc dự án!
    </div>
</div>
    <div class="group">
    <label>Link tài liệu <span style="color:red;"></span></label>
      <input  id="linkInput" name="LinkTaiLieu" value="{{ $CongViec[0]->LinkTaiLieu }}" type="text"  class="form-control" pattern="^\S.*">
      <span class="highlight"></span>
      <span class="bar"></span>
      <div class="valid-feedback">
       
      </div>
      <div class="invalid-feedback">
        Vui lòng nhập link tài liệu !
      </div>
    </div>
    <div class="group">
    <label> Mô tả <span style="color:red;">(*)</span></label>
    <textarea id="NoiDungInput" name="MoTa" class="form-control textarea" required>{{ $CongViec[0]->MoTa }}</textarea>
    <span class="highlight"></span>
    <span class="bar"></span>
    <div class="valid-feedback">
     
    </div>
    <div class="invalid-feedback">
        Vui lòng nhập mô tả !
    </div>
</div>

    <div class="group" style="margin-top: 20px;">
        <label>Chọn người nhận việc<span style="color:red;"> (*)</span></label>
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
         
      </div>
      <div class="invalid-feedback">
          Vui lòng chọn thành viên!
      </div>
  </div>
  <p class="validation-message" style="color: red; display: none;">Phải chọn ít nhất 1 Người Nhận việc!</p>
      <button name="Add" type="submit" class="submit-btn">Cập Nhật</button>
  </form>
</div>
</div>
<div id="toast1"></div>
<script src="{{ asset('js/formvalidation.js') }}"></script>

<script>
   
   document.addEventListener('DOMContentLoaded', function() {
    // Lấy giá trị ngày bắt đầu dự án và ngày kết thúc dự án từ HTML
    var ngayBatDauDuAn = new Date("{{ $CongViec[0]->NgayBatDauDuAn }}");
    var ngayKetThucDuAn = new Date("{{ $CongViec[0]->NgayKetThucDuAn}}");
    
    var ngayBatDauInput = document.querySelector('input[name="NgayBatDau"]');
    var ngayKetThucInput = document.querySelector('input[name="NgayKetThuc"]');
    
    function validateDates() {
        var ngayBatDau = new Date(ngayBatDauInput.value);
        var ngayKetThuc = new Date(ngayKetThucInput.value);
        
        // Kiểm tra ngày bắt đầu
        if (ngayBatDau < ngayBatDauDuAn) {
            ngayBatDauInput.setCustomValidity('Vui lòng chọn ngày bắt đầu lớn hơn ngày bắt đầu dự án!');
            document.getElementById('dateStartInvalidFeedback').style.display = 'block';
        } else {
            ngayBatDauInput.setCustomValidity('');
            document.getElementById('dateStartInvalidFeedback').style.display = 'none';
        }
        
        // Kiểm tra ngày kết thúc
        if (ngayKetThuc < ngayBatDau || ngayKetThuc > ngayKetThucDuAn) {
            ngayKetThucInput.setCustomValidity('Ngày đến hẹn phải nhỏ hơn ngày bắt đầu hoặc nhỏ hơn ngày kết thúc dự án!');
            document.getElementById('dateEndInvalidFeedback').style.display = 'block';
        } else {
            ngayKetThucInput.setCustomValidity('');
            document.getElementById('dateEndInvalidFeedback').style.display = 'none';
        }
    }
    
    // Lắng nghe sự kiện khi giá trị ngày được thay đổi
    ngayBatDauInput.addEventListener('change', validateDates);
    ngayKetThucInput.addEventListener('change', validateDates);
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
              } else if (response.time === false){
                showErrorToast2();
              } else{    
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
    function showErrorToast2(){
      toast1({
          title: "Error",
          message: "Công Việc Đang Thực Hiện Không Thể Thay Đổi Người Dùng!",
          type:"error",
          duration:2000
      })
    }
    function showSuccessToast1(){
      toast1({
        title: "Success",
        message: "Cập Nhật Công Việc Thành Công !",
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
