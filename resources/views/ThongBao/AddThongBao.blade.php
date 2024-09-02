@extends('layouts/layoutAdmin')
@section('content')
<style>
.custom-select {
  position: relative;
  display: inline-block;
}

.custom-select select {
  display: none; /* Ẩn thẻ <select> mặc định */
}

.select-selected {
  background-color: #f1f1f1;
  border: 1px solid #ccc;
  border-radius: 4px;
  padding: 8px;
  cursor: pointer;
  width: 250px;
}

.select-items {
  position: absolute;
  background-color: #f1f1f1;
  border: 1px solid #ddd;
  border-radius: 4px;
  z-index: 99;
  max-height: 250px;
  width: 250px; /* Chiều cao tối đa của menu thả xuống */
  overflow-y: auto; /* Thêm thanh cuộn dọc khi nội dung dài hơn chiều cao */
  width: 100%;
  box-sizing: border-box; /* Đảm bảo kích thước chính xác */
}

.select-items div {
  padding: 8px;
  cursor: pointer;
}

.select-items div:hover {
  background-color: #ddd;
}

.select-hide {
  display: none;
}
#suggest-button {
    display: inline-block;
    padding: 10px 10px;
    margin: 5px;
    background-color: #3a85d5; /* Màu nền nút */
    color: white; /* Màu chữ */
    font-size: 14px; /* Kích thước chữ */
    font-weight: bold; /* Độ đậm của chữ */
    text-align: center; /* Căn giữa nội dung */
    border: none; /* Loại bỏ viền mặc định */
    border-radius: 5px; /* Bo góc */
    cursor: pointer; /* Con trỏ chuột khi di chuột qua nút */
    transition: background-color 0.3s, transform 0.3s; /* Hiệu ứng chuyển đổi */
}

#suggest-button:hover {
    background-color: #0056b3; /* Màu nền khi di chuột qua nút */
}

#suggest-button:active {
    transform: scale(0.98); /* Hiệu ứng nhấn nút */
}
.highlight {
    color: blue;
    font-weight: bold;
}
</style>

<div class="col">
<div class="container">
  <h2 class="text-weight">Gửi Thông Báo<small></small></h2>  
  <form  method="post" class="needs-validation ThongBao-form" action="/ThongBao/add" novalidate>
  @csrf


 <!-- Checkbox for sending an email -->
 <div class="group" >
    <input type="checkbox" id="SendEmailCheckbox" name="SendEmail" value="1" style="    transform: translateY(100%); height: 25px;" >
    <label for="SendEmailCheckbox"><div style="font-size: 17px;">Gửi Thông Báo Email:</div></label>
</div>


  <div class="group">
    <label>Chọn Người Dùng <span style="color:red;">(*)</span></label>
  <div class="custom-select"> 
  <div class="select-selected">Chọn Người Dùng</div> 
  <div class="select-items select-hide">
    @foreach($NguoiDung as $NguoiDung1)
    <div data-value="{{$NguoiDung1->id}}">{{$NguoiDung1->UserName}}</div>
    @endforeach
  </div>
  <select name="MaNguoiDung" class="form-control" required>
        <option value="" disabled selected>Chọn Chứng Chỉ</option>
        @foreach($NguoiDung as $NguoiDung1)
        <option value="{{$NguoiDung1->id}}">{{$NguoiDung1->TenNguoiDung}}</option>
        @endforeach
    </select>
</div>
    <div class="valid-feedback">
        Nhập Người Dùng Thành Công
      </div>
    <div class="invalid-feedback">
        Vui Lòng Chọn Người Dùng!
    </div>
    </div>
  
    <div class="group">
    <div style="display: flex;">
        <div><label style="margin-top: 10px;">Nhập Nội Dung <span style="color:red;">(*)</span></label></div>   
        <div id="suggest-button">Gợi ý thông báo</div>
       
    </div>
    <textarea id="NoiDungInput" name="NoiDung" type="text" class="form-control textarea" required style="height: 200px;"></textarea >
    <span class="highlight"></span>
    <span class="bar"></span>
    <div class="valid-feedback">
        Nhập Nội Dung Thành Công
    </div>
    <div class="invalid-feedback">
        Vui Lòng Nhập Nội Dung !
    </div>
    
</div>

      <button name="Add" type="submit" class="submit-btn">Gửi</button>
  </form>
</div>
</div>


<div id="toast1"></div>
<div class="modal_login" id="modalLogin">
    <div class="loading-bar">Loading</div>
</div>
<script src="{{ asset('js/formvalidation.js') }}"></script>
<script>
 $(document).ready(function() {
      $('.ThongBao-form').submit(function(event) {
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
          $('#modalLogin').css('display', 'flex');
          $.ajax({
            type: 'POST',
            url: url,
            data: formData,
            success: function(response) {
              if (response.success === true) {  
                showSuccessToast1();
                setTimeout(function() {
                  window.location.href = "/ThongBao";
                }, 1000);
              } else {    
                showErrorToast1();
              }
            },
            complete: function() {
                // Sau khi hoàn thành, ẩn phần loading
                $('#modalLogin').css('display', 'none');
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
        <!-- Nội Dung -->
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
          message: "Thông Báo Đã Tồn Tại !",
          type:"error",
          duration:2000
      })
    }
	    
    function showSuccessToast1(){
      toast1({
        title: "Success",
        message: "Thông Báo Thành Công !",
        type:"success",
        duration:2000
      })
    }
</script>

<script>
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
  var selected = document.querySelector('.select-selected');
  var items = document.querySelector('.select-items');
  var select = document.querySelector('select[name="MaNguoiDung"]');

  selected.addEventListener('click', function() {
    items.classList.toggle('select-hide');
  });

  items.addEventListener('click', function(e) {
    if (e.target.tagName === 'DIV') {
      selected.textContent = e.target.textContent;
      items.classList.add('select-hide');
      // Cập nhật giá trị của thẻ <select> ẩn
      var value = e.target.getAttribute('data-value');
      select.value = value;
    }
  });

  document.addEventListener('click', function(e) {
    if (!e.target.matches('.select-selected')) {
      var openSelects = document.querySelectorAll('.select-items');
      for (var i = 0; i < openSelects.length; i++) {
        var openSelect = openSelects[i];
        if (!openSelect.classList.contains('select-hide')) {
          openSelect.classList.add('select-hide');
        }
      }
    }
  });
});

document.getElementById('suggest-button').addEventListener('click', function() {
    // Gán nội dung vào textarea
    document.getElementById('NoiDungInput').value = 'Chúng tôi xin nhắc nhở về thời hạn hoàn thành [công việc/dự án/cuộc hẹn] đã được lên kế hoạch vào ngày [ngày dự kiến ban đầu]. Để đảm bảo tiến độ và chất lượng công việc, chúng tôi mong muốn quý vị hoàn thành [công việc/dự án] đúng theo kế hoạch. Việc tuân thủ thời hạn không chỉ giúp dự án diễn ra suôn sẻ mà còn đảm bảo sự hài lòng của tất cả các bên liên quan. Chúng tôi rất mong quý vị hợp tác và hoàn tất công việc đúng thời gian đã thỏa thuận. Trân trọng,';

    // Gán nội dung vào div với định dạng màu xanh
  
});


</script>


@endsection
