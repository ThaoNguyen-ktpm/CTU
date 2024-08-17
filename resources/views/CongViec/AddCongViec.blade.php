@extends('layouts/layoutAdmin')
@section('content')
 
<div class="col">
<div class="container">
  <h2 class="text-weight">Thêm Công Việc<small></small></h2>
  <form  method="post" class="needs-validation CongViec-form" action="/CongViec/add" novalidate>
  @csrf
  <div class="group">
    <label>Dự Án <span style="color:red;">(*)</span></label>
    <select name="MaDuAn" class="form-control" id="selectDuAn" required>
        <option value="" disabled selected>Chọn Dự Án</option>
        @foreach($DuAn as $DuAn1)
        <option value="{{$DuAn1->id}}">{{$DuAn1->TenDuAn}}</option>
        @endforeach
    </select>
    <div class="valid-feedback">
        Nhập Dự Án Thành Công
    </div>
    <div class="invalid-feedback">
        Vui Lòng Chọn Dự Án!
    </div>
</div>

<div class="group">
    <label>Giai Đoạn <span style="color:red;">(*)</span></label>
    <select name="MaGiaiDoan" class="form-control selectThoiGian" id="selectGiaiDoan" required>
        <option value="" disabled selected>Chọn Giai Đoạn</option>
        <!-- Các option sẽ được thêm động tại đây -->
    </select>
    <div class="valid-feedback">
        Nhập Giai Đoạn Thành Công
    </div>
    <div class="invalid-feedback">
        Vui Lòng Chọn Giai Đoạn!
    </div>
</div>
<div id="selectThoiGian1"></div>
    <div class="group">
    <label>Tên Công Việc <span style="color:red;">(*)</span></label>
      <input  id="usernameInput" name="TenCongViec" type="text"  class="form-control" required pattern="^\S.*">
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
    <label>Nhập Link Tài Liệu <span style="color:red;">(*)</span></label>
      <input  id="linkInput" name="LinkTaiLieu" type="text"  class="form-control" required pattern="^\S.*">
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
    <label>Mô Tả Công Việc<span style="color:red;">(*)</span></label>
      <textarea id="NoiDungInput" name="MoTa" type="text" class="form-control textarea" required></textarea >
      <span class="highlight"></span>
      <span class="bar"></span>
      <div class="valid-feedback">
        Nhập Mô Tả Thành Công
      </div>
      <div class="invalid-feedback">
        Vui Lòng Nhập Mô Tả !
      </div>
    </div>
    <div class="group">
      <label>Nhập Số Ngày Thực Hiện <span style="color:red;">(*)</span></label>
        <input  id="SoNgayThucHienInput" name="SoNgayThucHien[]" type="number"  min="1" max="1000" class="form-control" required>
        <span class="highlight"></span>
        <span class="bar"></span>
        <div class="valid-feedback">Nhập Ngày Thực Hiện Thành Công</div>
        <div class="invalid-feedback">Vui Lòng Nhập Số Ngày Thực Hiện!</div>
    </div>
    <div class="group" style="margin-top: 20px;">
        <label>Chọn Người Nhận Việc<span style="color:red;"> (*)</span></label>
      <div  class="GiaoVienGiangDay-list">
    </div>
      <div class="valid-feedback">
          Chọn Thành Viên Thành Công
      </div>
      <div class="invalid-feedback">
          Vui Lòng Chọn Thành Viên!
      </div>
  </div>
  <p class="validation-message" style="color: red; display: none;">Phải chọn ít nhất 1 Người Nhận Việc!</p>
      <button name="Add" type="submit" class="submit-btn">Thêm Công Việc</button>
  </form>
</div>
</div>
<div id="toast1"></div>
<script src="{{ asset('js/formvalidation.js') }}"></script>
<script>
	$(document).ready(function() {
		$('.CongViec-form').submit(function(event) {
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
          message: " Công Việc Đã Tồn Tại !",
          type:"error",
          duration:2000
      })
    }
	    
    function showSuccessToast1(){
      toast1({
        title: "Success",
        message: "Thêm Công Việc Thành Công !",
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
  var linkInput = document.getElementById('linkInput');
  linkInput.addEventListener('input', function(e) {
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
$(document).ready(function() {
    $('#selectDuAn').on('change', function() {
        loadGiaiDoanData($(this).val());
        loadNguoiDungData($(this).val());
    });

    $('.selectThoiGian').on('change', function() {
        loadThoiGian($(this).val());
    });

});

function loadGiaiDoanData(maDuAn) {
    var GiaiDoanListContainer = $('#selectGiaiDoan');

    // Xóa tất cả các option hiện có
    GiaiDoanListContainer.empty();

    // Thêm option "Chọn Giai Đoạn" lại sau khi xóa
    GiaiDoanListContainer.append('<option value="" disabled selected>Chọn Giai Đoạn</option>');

    // Gửi yêu cầu AJAX để lấy dữ liệu
    $.ajax({
        url: '/DuAn/GiaiDoan/getGiaiDoan/' + maDuAn,
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            console.log(response); // Kiểm tra dữ liệu nhận được từ server
            $.each(response, function(key, GiaiDoan) {
                var optionHtml = `
                    <option value="${GiaiDoan.id}">${GiaiDoan.TenGiaiDoan}</option>
                `;
                GiaiDoanListContainer.append(optionHtml);
            });
        },
        error: function(xhr, status, error) {
            console.error(error);
        }
    });
}
function loadThoiGian(maGiaiDoan) {
    var ThoiGianListContainer = $('#selectThoiGian1');

    // Xóa nội dung cũ trước khi thêm mới
    ThoiGianListContainer.empty();

    // Gửi yêu cầu AJAX để lấy dữ liệu
    $.ajax({
        url: '/DuAn/ThoiGian/getThoiGian/' + maGiaiDoan,
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            console.log(response); // Kiểm tra dữ liệu nhận được từ server
            var soNgayThucHien; // Biến toàn cục để lưu giá trị số ngày thực hiện
            
            $.each(response, function(key, ThoiGian) {
                var ngayBatDau = new Date(ThoiGian.NgayBatDau);
                var ngayKetThuc = new Date(ThoiGian.NgayKetThuc);
                
                // Tính số ngày thực hiện
                soNgayThucHien = Math.ceil((ngayKetThuc - ngayBatDau) / (1000 * 60 * 60 * 24));
                
                // Định dạng lại ngày để hiển thị
                var ngayBatDauFormatted = ngayBatDau.toLocaleDateString('vi-VN');
                var ngayKetThucFormatted = ngayKetThuc.toLocaleDateString('vi-VN');
                
                var optionHtml = `
                    <div style="background-color: darkgreen; color: white; padding: 10px; margin-top: 10px;">
                        <span>Số Ngày Thực Hiện: ${soNgayThucHien} ngày</span><br>
                        <span>Thời Gian Thực Hiện: ${ngayBatDauFormatted} Đến ${ngayKetThucFormatted}</span>
                    </div>
                `;
                
                ThoiGianListContainer.append(optionHtml);
            });

            // Lắng nghe sự kiện input để kiểm tra giá trị người dùng nhập
            var inputElements = document.querySelectorAll('input[name="SoNgayThucHien[]"]');
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
        },
        error: function(xhr, status, error) {
            console.error(error);
        }
    });
}


function loadNguoiDungData(maDonVi) {
    var nguoiDungListContainer = $('.GiaoVienGiangDay-list');

    // Xóa tất cả các người dùng hiện có
    nguoiDungListContainer.empty();

    // Gửi yêu cầu AJAX để lấy dữ liệu người dùng mới
    $.ajax({
        url: '/CongViec/getNguoiDung/' + maDonVi,
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            // Thêm các người dùng mới dựa trên dữ liệu nhận được
            $.each(response, function(key, nguoiDung) {
                // Tạo HTML cho từng người dùng
                var checkboxHtml = `
                  <div class="form-check">
                      <input class="form-check-input" type="checkbox" name="MaNguoiDung[]" value="${nguoiDung.id}" required>
                      <div style="display: flex;">
                          <div style="font-weight: 600; color: #1f1f1f;" class="form-check-label">
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

            // Sau khi dữ liệu được thêm vào, thiết lập lắng nghe sự kiện và kiểm tra trạng thái
            initializeValidation();
        },
        error: function(xhr, status, error) {
            console.error(error);
        }
    });
}

function initializeValidation() {
    const submitBtn = document.querySelector('.submit-btn');
    const MaNguoiDungCheckboxes = document.querySelectorAll('input[name="MaNguoiDung[]"]');
    const validationMessage = document.querySelector('.validation-message');

    function checkCheckboxes() {
        // Kiểm tra xem có ít nhất một checkbox được chọn không
        const isMaNguoiDungChecked = Array.from(MaNguoiDungCheckboxes).some(checkbox => checkbox.checked);

        if (isMaNguoiDungChecked) {
            submitBtn.disabled = false;
            validationMessage.style.display = 'none';
        } else {
            submitBtn.disabled = true;
            validationMessage.style.display = 'block';
        }
    }

    // Khởi tạo nút submit ở trạng thái disabled
    submitBtn.disabled = true;
    
    // Hiển thị thông báo khi trang được tải lần đầu
    validationMessage.style.display = 'block';

    // Lắng nghe sự kiện thay đổi trên các checkbox
    MaNguoiDungCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', checkCheckboxes);
    });

    // Kiểm tra trạng thái ban đầu
    checkCheckboxes();
}


</script>




@endsection
