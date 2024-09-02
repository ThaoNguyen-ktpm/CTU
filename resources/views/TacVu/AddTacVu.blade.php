@extends('layouts/layoutAdmin')
@section('content')
 
<div class="col">
<div class="container">
  <h2 class=" text-weight">Thêm Vai Trò Người Dùng<small></small></h2>
  <form  method="post" class="needs-validation TacVu-form" action="/TacVu/add" novalidate>
  @csrf


  <div class="group">
    <label>Vai Trò <span style="color:red;">(*)</span></label>
    <select name="MaVaiTro" class="form-control" id="selectVaiTro" required>
        <option value="" disabled selected>Chọn Vai Trò</option>
        @foreach($VaiTro as $VaiTro1)
        <option value="{{$VaiTro1->id}}">{{$VaiTro1->TenVaiTro}}</option>
        @endforeach
    </select>
    <div class="valid-feedback">
        Nhập Vai Trò Thành Công
      </div>
    <div class="invalid-feedback">
        Vui Lòng Chọn Vai Trò !
    </div>
    </div>
    <div class="group">
      <label>Người Dùng <span style="color:red;">(*)</span></label>
      <div  class="GiaoVienGiangDay-list">
      @foreach($NguoiDung as $NguoiDung1)
      <div class="form-check">
          <input class="form-check-input"  type="checkbox" name="MaNguoiDung[]" value="{{$NguoiDung1->id}}" required>
          <label class="form-check-label">
              {{$NguoiDung1->Name}} 
          </label>
      </div>
      @endforeach
    </div>
      <div class="valid-feedback">
          Chọn Người Dùng Thành Công
      </div>
      <div class="invalid-feedback">
          Vui Lòng Chọn Người Dùng!
      </div>
  </div>
      <button name="Add" type="submit" class="submit-btn">Thêm Vai Trò</button>
  </form>
</div>
</div>
<div id="toast1"></div>
<script src="{{ asset('js/formvalidation.js') }}"></script>
<script>
  $(document).ready(function() {
    // Gán sự kiện onchange bằng Event Listener
    $('#selectVaiTro').on('change', function() {
        // Gọi hàm xử lý AJAX khi có sự kiện onchange
        loadNguoiDungData($(this).val());
    });
});

function loadNguoiDungData(maVaiTro) {
    var nguoiDungListContainer = $('.GiaoVienGiangDay-list');

    // Xóa tất cả các người dùng hiện có
    nguoiDungListContainer.empty();

    // Gửi yêu cầu AJAX để lấy dữ liệu người dùng mới
    $.ajax({
        url: '/TacVu/getNguoiDung/' +maVaiTro, // Thay đổi URL này theo yêu cầu của bạn
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            // Thêm các người dùng mới dựa trên dữ liệu nhận được
            $.each(response, function(key, nguoiDung) {
                var checkboxHtml = `
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="MaNguoiDung[]" value="${nguoiDung.id}">
                        <label class="form-check-label">${nguoiDung.Name}</label>
                    </div>
                `;
                nguoiDungListContainer.append(checkboxHtml);
            });
        },
        error: function(xhr, status, error) {
            // Xử lý lỗi nếu có
            console.error(error);
        }
    });
}
 $(document).ready(function() {
      $('.TacVu-form').submit(function(event) {
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
                  window.location.href = "/TacVu";
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
          message: "Đã Tồn Tại Vai Trò !",
          type:"error",
          duration:2000
      })
    }
	    
    function showSuccessToast1(){
      toast1({
        title: "Success",
        message: "Thêm Vai Trò Thành Công !",
        type:"success",
        duration:2000
      })
    }
</script>

@endsection
