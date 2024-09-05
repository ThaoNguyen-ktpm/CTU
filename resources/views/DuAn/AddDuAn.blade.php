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
</style>
<div class="col">
<div class="container">
  <h2 class="text-weight">Thêm Dự Án<small></small></h2>
  <form  method="post" class="needs-validation DuAn-form" action="/DuAn/add" novalidate>
  @csrf
    <div class="group">
    <label>Tên dự án <span style="color:red;">(*)</span></label>
      <input  id="usernameInput" name="TenDuAn" type="text"  class="form-control" required pattern="^\S.*">
      <span class="highlight"></span>
      <span class="bar"></span>
      <div class="valid-feedback">
      
      </div>
      <div class="invalid-feedback">
        Vui lòng nhập tên dự án !
      </div>
    </div>
    
    <div class="group">
    <label>Mô tả<span style="color:red;">(*)</span></label>
      <textarea id="NoiDungInput" name="MoTa" type="text" class="form-control textarea" required></textarea >
      <span class="highlight"></span>
      <span class="bar"></span>
      <div class="valid-feedback">
      
      </div>
      <div class="invalid-feedback">
        Vui lòng nhập mô tả !
      </div>
    </div>
  
 <!-- Phần thêm giai đoạn -->
 <div id="giai_doan_container">
       <div class="macdinh">
       <div class="group">
            <h4>Giai Đoạn 1</h4>
            <label>Chọn giai đoạn <span style="color:red;">(*)</span></label>
            <select name="MaGiaiDoan[]" class="form-control" id="selectGiaiDoan" required>
                <option value="" disabled selected>Chọn giai đoạn</option>
                @foreach($GiaiDoan as $GiaiDoan1)
                <option value="{{$GiaiDoan1->id}}">{{$GiaiDoan1->TenGiaiDoan}}</option>
                @endforeach
            </select>
            <span class="highlight"></span>
            <span class="bar"></span>
            <div class="valid-feedback"></div>
            <div class="invalid-feedback">Vui lòng chọn giai đoạn!</div>
            </div>
            
            <div class="group">
            <label>Ngày bắt đầu <span style="color:red;">(*)</span> <label>(lưu ý: tháng / ngày / năm) </label></label>
            <input id="NgayBatDau" name="NgayBatDau" type="date" class="form-control" required>
            <span class="highlight"></span>
            <span class="bar"></span>
            <div class="valid-feedback"></div>
            <div class="invalid-feedback">Vui lòng chọn số ngày bằng hoặc lớn hơn ngày hiện tại!</div>
            </div>
            <div class="group">
            <label>Nhập số ngày thực hiện <span style="color:red;">(*)</span></label>
            <input name="SoNgayThucHien[]" type="number"  min="1" max="1000" class="form-control" required>
            <span class="highlight"></span>
            <span class="bar"></span>
            <div class="valid-feedback"></div>
            <div class="invalid-feedback">Nhập số ngày thực hiện hoặc không lớn 1000 ngày !</div>
            </div>
            <div class="group">
            <input name="ThuTuGiaiDoan[]" type="number" class="form-control" value="1" readonly hidden>
            <span class="highlight"></span>
            <span class="bar"></span>
            </div>
       </div>
    </div>
    <!-- Nút thêm giai đoạn mới -->
    <button id="themGiaiDoanButton" type="button">Thêm Giai Đoạn</button>

    <!-- Nút xóa giai đoạn -->
    <button id="suaGiaiDoanButton" type="button">Sửa Giai Đoạn</button>

    <div class="group" style="margin-top: 20px;">
   <div style="display: flex;">
      <div style="padding-right: 20px;">
        <label>Thành viên<span style="color:red;">(*)</span></label>
      </div>
      <div>
      <select name="MaDonVi" class="form-control" id="selectDonVi"  style="  margin-bottom: 10px;" required>
              <option value="" disabled selected>Chọn đơn vị</option>
              @foreach($DonVi as $DonVi1)
              <option value="{{$DonVi1->id}}">{{$DonVi1->TenDonVi}}</option>
              @endforeach
          </select>
      </div>
   </div>
      <div  class="GiaoVienGiangDay-list">
      @foreach($NguoiDung as $NguoiDung1)
     
      @endforeach
    </div>
     
  </div>
      
      <button name="Add" type="submit" class="submit-btn">Thêm Dự Án</button>
  </form>
</div>
</div>
<div id="toast1"></div>
<script src="{{ asset('js/formvalidation.js') }}"></script>

<script>
  $(document).ready(function() {
    // Gán sự kiện onchange bằng Event Listener
    $('#selectDonVi').on('change', function() {
        // Gọi hàm xử lý AJAX khi có sự kiện onchange
        loadNguoiDungData($(this).val());
    });
});

function loadNguoiDungData(maDonVi) {
    var nguoiDungListContainer = $('.GiaoVienGiangDay-list');

    // Xóa tất cả các người dùng hiện có
    nguoiDungListContainer.empty();

    // Gửi yêu cầu AJAX để lấy dữ liệu người dùng mới
    $.ajax({
        url: '/DuAn/DonVi/getNguoiDung/' + maDonVi, // Thay đổi URL này theo yêu cầu của bạn
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            // Thêm các người dùng mới dựa trên dữ liệu nhận được
            $.each(response, function(key, nguoiDung) {
                // Tạo HTML cho từng người dùng
                var checkboxHtml = `
                  <div class="form-check">
                      <input class="form-check-input" type="checkbox" name="MaNguoiDung[]" value="${nguoiDung.id}">
                      <div style="display: flex;">
                          <div style="font-weight: 600; color: #1f1f1f;width: 100%;" class="form-check-label">
                              ${nguoiDung.user_name} 
                          </div>
                          <div style="width: 100%;" class="form-check-label">
                             : ${nguoiDung.Quyen == 2 ? 'Trưởng Phòng' :
                                nguoiDung.Quyen == 3 ? 'Phó Phòng' :
                                nguoiDung.Quyen == 4 ? 'Nhân Viên' : 'Không xác định'}
                          </div>
                      </div>
                      <label style="width: 100%;" class="form-check-label">
                          Vai Trò: ${nguoiDung.vaitro_names ? nguoiDung.vaitro_names : 'Chưa Có Vai Trò'}
                      </label>
                      <label style="width: 100%;" class="form-check-label">
                          Đơn Vị: ${nguoiDung.donvi_names ? nguoiDung.donvi_names : 'Chưa Có Đơn Vị'}
                      </label>
                  </div>
                `;
                // Thêm HTML vào container
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
          message: " Dự Án Đã Tồn Tại !",
          type:"error",
          duration:2000
      })
    }
	    
    function showErrorToast2(){
      toast1({
          title: "Error",
          message: " Thêm Dự Án Thất Bại Do Chưa Có Thành Viên !",
          type:"error",
          duration:2000
      })
    }
    function showSuccessToast1(){
      toast1({
        title: "Success",
        message: "Thêm Dự Án Thành Công !",
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
document.addEventListener('DOMContentLoaded', function () {
    let soLuongGiaiDoan = 1;

    function updateSelectOptions() {
        const selectedValues = Array.from(document.querySelectorAll('select[name="MaGiaiDoan[]"]'))
            .map(select => select.value)
            .filter(value => value !== "");

        document.querySelectorAll('select[name="MaGiaiDoan[]"]').forEach(select => {
            Array.from(select.options).forEach(option => {
                if (selectedValues.includes(option.value) && option.value !== select.value) {
                    option.disabled = true;
                } else {
                    option.disabled = false;
                }
            });
        });
    }

    document.addEventListener('change', function (event) {
        if (event.target && event.target.matches('select[name="MaGiaiDoan[]"]')) {
            updateSelectOptions();
        }
    });

    function themGiaiDoan() {
        soLuongGiaiDoan++;

        const giaiDoanContainer = document.getElementById('giai_doan_container');
        const giaiDoanDiv = document.createElement('div');
        giaiDoanDiv.classList.add('group');

        giaiDoanDiv.innerHTML = `
            <h4>Giai Đoạn ${soLuongGiaiDoan}</h4>
            <label>Chọn Giai Đoạn <span style="color:red;">(*)</span></label>
            <select name="MaGiaiDoan[]" class="form-control" required>
                <option value="" disabled selected>Chọn Giai Đoạn</option>
                @foreach($GiaiDoan as $GiaiDoan1)
                <option value="{{$GiaiDoan1->id}}">{{$GiaiDoan1->TenGiaiDoan}}</option>
                @endforeach
            </select>
            <span class="highlight"></span>
            <span class="bar"></span>
            <div class="valid-feedback"></div>
            <div class="invalid-feedback">Vui Lòng Chọn Giai Đoạn!</div>
        </div>
        <div class="group">
            <label>Nhập Số Ngày Thực Hiện <span style="color:red;">(*)</span></label>
            <input name="SoNgayThucHien[]" type="number" min="1" max="1000" class="form-control" required>
            <span class="highlight"></span>
            <span class="bar"></span>
            <div class="valid-feedback"></div>
            <div class="invalid-feedback">Vui Lòng Nhập Số Ngày Thực Hiện!</div>
        </div>
        <div class="group">
            <input name="ThuTuGiaiDoan[]" type="number" class="form-control" value="${soLuongGiaiDoan}" readonly hidden>
            <span class="highlight"></span>
            <span class="bar"></span>
        `;

        giaiDoanContainer.appendChild(giaiDoanDiv);

        // Gắn sự kiện change cho select mới
        giaiDoanDiv.querySelector('select[name="MaGiaiDoan[]"]').addEventListener('change', updateSelectOptions);

        // Cập nhật các tùy chọn cho tất cả các select sau khi thêm giai đoạn mới
        updateSelectOptions();
    }

    function suaGiaiDoan() {
    const giaiDoanContainer = document.getElementById('giai_doan_container');
    let giaiDoanDivs = giaiDoanContainer.querySelectorAll('.group');

    let count = 0; // Biến đếm số giai đoạn đã xóa
    while (giaiDoanDivs.length > 1 && count < 3) {  // Xóa tối đa 3 giai đoạn, nhưng không xóa giai đoạn mặc định
        const lastGiaiDoanDiv = giaiDoanDivs[giaiDoanDivs.length - 1];

        if (!lastGiaiDoanDiv.closest('.macdinh')) {  // Kiểm tra nếu giai đoạn cuối cùng không phải là giai đoạn mặc định
            lastGiaiDoanDiv.remove();
            count++;  // Tăng biến đếm số giai đoạn đã xóa
        }

        // Cập nhật danh sách giai đoạn sau khi xóa
        giaiDoanDivs = giaiDoanContainer.querySelectorAll('.group');
    }

    if (count > 0) {
        soLuongGiaiDoan--;  // Giảm số lượng giai đoạn sau khi xóa 3 lần
    }
}


    // Gán sự kiện click cho các nút sau khi DOM đã được tải
    document.getElementById('themGiaiDoanButton').addEventListener('click', themGiaiDoan);
    document.getElementById('suaGiaiDoanButton').addEventListener('click', suaGiaiDoan);
});


</script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var NgayBatDau = document.getElementById('NgayBatDau');
    var invalidFeedback = document.querySelector('.invalid-feedback');

    NgayBatDau.addEventListener('input', function(e) {
        var value = e.target.value;

        // Lấy ngày từ chuỗi ngày tháng
        var selectedDate = new Date(value);

        // Lấy thời gian hiện tại
        var currentDate = new Date();
        
        // Thiết lập giờ, phút, giây của currentDate là 00:00:00 để chỉ so sánh ngày tháng
        currentDate.setHours(0, 0, 0, 0);

        // Kiểm tra điều kiện: ngày được nhập phải lớn hơn ngày hiện tại
        var isValid = selectedDate > currentDate;
        
        if (isValid) {
            // Xóa thông báo lỗi nếu ngày hợp lệ
            invalidFeedback.style.display = 'none';
            NgayBatDau.classList.remove('is-invalid');
        } else {
            // Hiển thị thông báo lỗi nếu ngày không hợp lệ
            invalidFeedback.style.display = 'block';
            NgayBatDau.classList.add('is-invalid');
        }
    });
});


</script>



@endsection
