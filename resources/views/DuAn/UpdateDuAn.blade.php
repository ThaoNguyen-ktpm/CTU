@extends('layouts/layoutAdmin')
@section('content')
 
<div class="col">
<div class="container">
  <h2 class=" text-weight">Thông Tin Dự Án<small></small></h2>
  <form  method="post" class="needs-validation DuAn-form" action="/DuAn/update/{{$DuAn->id}}" novalidate>
  @csrf
    <div class="group">
    <label>Tên dự án <span style="color:red;">(*)</span></label>
      <input  id="usernameInput" name="TenDuAn" value="{{ $DuAn->TenDuAn }}" type="text" class="form-control" required>
      <span class="highlight"></span>
      <span class="bar"></span>
      <div class="valid-feedback">
      </div>
      <div class="invalid-feedback">
        Vui lòng nhập tên dự án !
      </div>
    </div>
    <div class="group">       
    <label>Chọn loại dự án <span style="color:red;">(*)</span></label>
    <select name="MaLoai" class="form-control" required>
        <option value="" disabled>Chọn loại dự án</option>
        @foreach($LoaiDuAn as $LoaiDuAn1)
        <option value="{{$LoaiDuAn1->id}}" {{ $DuAn->MaLoai == $LoaiDuAn1->id ? 'selected' : '' }}>
            {{$LoaiDuAn1->TenLoaiDuAn}}
        </option>
        @endforeach
    </select>
    <span class="highlight"></span>
    <span class="bar"></span>
    <div class="valid-feedback"></div>
    <div class="invalid-feedback">Vui lòng chọn loại dự án!</div>
</div>

<div class="group">       
    <label>Chọn quy mô <span style="color:red;">(*)</span></label>
    <select name="QuyMo" class="form-control" required>
        <option value="" disabled>Chọn quy mô dự án</option>
        <option value="1" {{ $DuAn->QuyMo == 1 ? 'selected' : '' }}>Nhỏ</option>
        <option value="2" {{ $DuAn->QuyMo == 2 ? 'selected' : '' }}>Vừa</option>
        <option value="3" {{ $DuAn->QuyMo == 3 ? 'selected' : '' }}>Lớn</option>
        <option value="4" {{ $DuAn->QuyMo == 4 ? 'selected' : '' }}>Rất lớn</option>
    </select>
    <span class="highlight"></span>
    <span class="bar"></span>
    <div class="valid-feedback"></div>
    <div class="invalid-feedback">Vui lòng chọn quy mô dự án!</div>
</div>
<div class="group">
    <label>Ngày bắt đầu <span style="color:red;">(*)</span> <label>(lưu ý: tháng / ngày / năm)</label></label>
    <input id="NgayBatDauDuAn" name="NgayBatDau" value="{{ $DuAn->NgayBatDau }}" type="date" class="form-control" required>
    <span class="highlight"></span>
    <span class="bar"></span>
    <div class="valid-feedback"></div>
    <div class="invalid-feedback invalid-feedback1" id="dateStartInvalidFeedback">
        Vui lòng chọn ngày bắt đầu lớn hơn ngày hiện tại!
    </div>
</div>

<div class="group">
    <label>Ngày kết thúc <span style="color:red;">(*)</span> <label>(lưu ý: tháng / ngày / năm)</label></label>
    <input id="NgayKetThucDuAn" name="NgayKetThuc" value="{{ $DuAn->NgayKetThuc }}" type="date" class="form-control" required>
    <span class="highlight"></span>
    <span class="bar"></span>
    <div class="valid-feedback"></div>
    <div class="invalid-feedback invalid-feedback2" id="dateEndInvalidFeedback">
        Ngày kết thúc phải nhỏ hơn ngày bắt đầu!
    </div>
</div>
    <div class="group">
    <label> Mô tả <span style="color:red;">(*)</span></label>
    <textarea id="NoiDungInput" name="MoTa" class="form-control textarea" required>{{ $DuAn->Mota }}</textarea>
    <span class="highlight"></span>
    <span class="bar"></span>
    <div class="valid-feedback">
      
    </div>
    <div class="invalid-feedback">
        Vui lòng nhập mô tả!
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
      $('.DuAn-form').submit(function(event) {
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
								window.location.href = "/DuAn";
							}, 1000);
						} else if(response.success === false) {
              showErrorToast2();
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
          message: "Đã Tồn Tại Dự Án !",
          type:"error",
          duration:2000
      })
    }
	    
    function showSuccessToast1(){
      toast1({
        title: "Success",
        message: "Cập Nhật Dự Án Thành Công !",
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
  
  var NoiDungInput = document.getElementById('NoiDungInput');
  NoiDungInput.addEventListener('input', function(e) {
    var value = e.target.value;
    // Loại bỏ khoảng trắng đầu tiên nếu có
    var sanitizedValue = value.replace(/^\s/, '');
    e.target.value = sanitizedValue;
  });
</script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var NgayBatDauDuAn = document.getElementById('NgayBatDauDuAn');  // Ngày bắt đầu dự án
    var NgayKetThucDuAn = document.getElementById('NgayKetThucDuAn');  // Ngày kết thúc dự án
    var dateEndInvalidFeedback = document.getElementById('dateEndInvalidFeedback');  // Div để hiển thị lỗi ngày kết thúc
   // Div để hiển thị thông tin ngày và số ngày thực hiện

    // Lắng nghe sự thay đổi của Ngày Bắt Đầu Dự Án và Ngày Kết Thúc Dự Án
    NgayBatDauDuAn.addEventListener('input', function(e) {
        validateEndDate();  // Kiểm tra ngày kết thúc dự án
        displayDates();  // Hiển thị thông tin
    });

    NgayKetThucDuAn.addEventListener('input', function(e) {
        validateEndDate();  // Kiểm tra ngày kết thúc dự án
        displayDates();  // Hiển thị thông tin
    });

    // Hàm kiểm tra ngày kết thúc dự án phải lớn hơn ngày bắt đầu
    function validateEndDate() {
        var startDate = new Date(NgayBatDauDuAn.value);
        var endDate = new Date(NgayKetThucDuAn.value);

        if (startDate && endDate) {
            if (endDate > startDate) {
                dateEndInvalidFeedback.style.display = 'none';
                NgayKetThucDuAn.classList.remove('is-invalid');
            } else {
                dateEndInvalidFeedback.style.display = 'block';
                dateEndInvalidFeedback.innerHTML = 'Ngày kết thúc phải lớn hơn hoặc bằng ngày bắt đầu!';
                NgayKetThucDuAn.classList.add('is-invalid');
            }
        }
    }

   
});
</script>

@endsection
