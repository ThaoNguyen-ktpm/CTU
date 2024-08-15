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
    <label>Tên Dự Án <span style="color:red;">(*)</span></label>
      <input  id="usernameInput" name="TenDuAn" type="text"  class="form-control" required pattern="^\S.*">
      <span class="highlight"></span>
      <span class="bar"></span>
      <div class="valid-feedback">
        Nhập Dự Án Thành Công
      </div>
      <div class="invalid-feedback">
        Vui Lòng Nhập Dự Án !
      </div>
    </div>
    <div class="group">
    <label>Nhập Mô Tả <span style="color:red;">(*)</span></label>
      <textarea id="NoiDungInput" name="NoiDung" type="text" class="form-control textarea" required></textarea >
      <span class="highlight"></span>
      <span class="bar"></span>
      <div class="valid-feedback">
        Nhập Mô Tả Thành Công
      </div>
      <div class="invalid-feedback">
        Vui Lòng Nhập Mô Tả !
      </div>
    </div>
  
 <!-- Phần thêm giai đoạn -->
 <div id="giai_doan_container">
        <div class="group">
            <h4>Giai Đoạn 1</h4>
            <label>Chọn Giai Đoạn <span style="color:red;">(*)</span></label>
            <select name="MaGiaiDoan[]" class="form-control" id="selectGiaiDoan" required>
                <option value="" disabled selected>Chọn Đơn Vị</option>
                @foreach($GiaiDoan as $GiaiDoan1)
                <option value="{{$GiaiDoan1->id}}">{{$GiaiDoan1->TenGiaiDoan}}</option>
                @endforeach
            </select>
            <span class="highlight"></span>
            <span class="bar"></span>
            <div class="valid-feedback">Chọn Giai Đoạn Thành Công</div>
            <div class="invalid-feedback">Vui Lòng Chọn Giai Đoạn!</div>
            </div>
            <div class="group">
            <label>Ngày Bắt Đầu <span style="color:red;">(*)</span></label>
            <input name="NgayBatDau[]" type="date" class="form-control" required>
            <span class="highlight"></span>
            <span class="bar"></span>
            <div class="valid-feedback">Chọn Ngày Bắt Đầu Thành Công</div>
            <div class="invalid-feedback">Vui Lòng Chọn Ngày Bắt Đầu!</div>
            </div>
            <div class="group">
            <label>Ngày Kết Thúc <span style="color:red;">(*)</span></label>
            <input name="NgayKetThuc[]" type="date" class="form-control" required>
            <span class="highlight"></span>
            <span class="bar"></span>
            <div class="valid-feedback">Chọn Ngày Kết Thúc Thành Công</div>
            <div class="invalid-feedback">Vui Lòng Chọn Ngày Kết Thúc!</div>
            </div>
            <div class="group">
            <input name="ThuTuGiaiDoan[]" type="number" class="form-control" value="1" readonly hidden>
            <span class="highlight"></span>
            <span class="bar"></span>
            </div>
    </div>

    <!-- Nút thêm giai đoạn mới -->
    <button id="themGiaiDoanButton" type="button">Thêm Giai Đoạn</button>

    <!-- Nút xóa giai đoạn -->
    <button id="xoaGiaiDoanButton" type="button" >Xóa Giai Đoạn</button>


    <div class="group" style="margin-top: 20px;">
   <div style="display: flex;">
      <div style="padding-right: 20px;">
        <label>Thành Viên<span style="color:red;">(*)</span></label>
      </div>
      <div>
      <select name="MaDonVi" class="form-control" id="selectDonVi"  style="  margin-bottom: 10px;" required>
              <option value="" disabled selected>Chọn Đơn Vị</option>
              @foreach($DonVi as $DonVi1)
              <option value="{{$DonVi1->id}}">{{$DonVi1->TenDonVi}}</option>
              @endforeach
          </select>
      </div>
   </div>
      <div  class="GiaoVienGiangDay-list">
      @foreach($NguoiDung as $NguoiDung1)
      <div class="form-check">
          <input class="form-check-input"  type="checkbox" name="MaNguoiDung[]" value="{{$NguoiDung1->id}}">
         <div style="display: flex;">
         <div style="font-weight: 600; color: #1f1f1f;" class="form-check-label">
              {{$NguoiDung1->user_name}} 
          </div>
          <div style="width: 220px;" class="form-check-label">
               : @if ($NguoiDung1->Quyen == 2)
                    Trưởng Phòng
                @elseif ($NguoiDung1->Quyen == 3)
                    Phó Phòng
                @elseif ($NguoiDung1->Quyen == 4)
                    Nhân Viên
                @else
                    Không xác định
                @endif  
          </div>
         </div>
          <label  style="height: 20px;width:100%" class="form-check-label">
            Vai Trò:  {{ !empty($NguoiDung1->vaitro_names) ? $NguoiDung1->vaitro_names : 'Chưa Có Vai Trò' }}
          </label>
          <label  style="height: 20px;width:100%" class="form-check-label">
          Đơn Vị: {{ !empty($NguoiDung1->donvi_names) ? $NguoiDung1->donvi_names : 'Chưa Có Đơn Vị' }}
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
                          <div style="font-weight: 600; color: #1f1f1f;" class="form-check-label">
                              ${nguoiDung.user_name} 
                          </div>
                          <div style="width: 220px;" class="form-check-label">
                             : ${nguoiDung.Quyen == 2 ? 'Trưởng Phòng' :
                                nguoiDung.Quyen == 3 ? 'Phó Phòng' :
                                nguoiDung.Quyen == 4 ? 'Nhân Viên' : 'Không xác định'}
                          </div>
                      </div>
                      <label style="width: 220px;" class="form-check-label">
                          Vai Trò: ${nguoiDung.vaitro_names ? nguoiDung.vaitro_names : 'Chưa Có Vai Trò'}
                      </label>
                      <label style="width: 220px;" class="form-check-label">
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
								window.location.href = "/DuAn";
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
          message: " Dự Án Đã Tồn Tại !",
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
            <div class="valid-feedback">Nhập Giai Đoạn Thành Công</div>
            <div class="invalid-feedback">Vui Lòng Chọn Giai Đoạn!</div>

            <label>Ngày Bắt Đầu <span style="color:red;">(*)</span></label>
            <input name="NgayBatDau[]" type="date" class="form-control" required>
            <span class="highlight"></span>
            <span class="bar"></span>
            <div class="valid-feedback">Chọn Ngày Bắt Đầu Thành Công</div>
            <div class="invalid-feedback">Vui Lòng Chọn Ngày Bắt Đầu!</div>

            <label>Ngày Kết Thúc <span style="color:red;">(*)</span></label>
            <input name="NgayKetThuc[]" type="date" class="form-control" required>
            <span class="highlight"></span>
            <span class="bar"></span>
            <div class="valid-feedback">Chọn Ngày Kết Thúc Thành Công</div>
            <div class="invalid-feedback">Vui Lòng Chọn Ngày Kết Thúc!</div>

            <input name="ThuTuGiaiDoan[]" type="number" class="form-control" value="${soLuongGiaiDoan}" readonly hidden>
            <span class="highlight"></span>
            <span class="bar"></span>
        `;

        giaiDoanContainer.appendChild(giaiDoanDiv);

        // Gắn sự kiện change cho select mới
        giaiDoanDiv.querySelector('select[name="MaGiaiDoan[]"]').addEventListener('change', updateSelectOptions);

        // Cập nhật các tùy chọn cho tất cả các select sau khi thêm giai đoạn mới
        updateSelectOptions();

        // Cập nhật trạng thái của nút xóa sau khi thêm giai đoạn mới
       
    }

    function xoaGiaiDoan() {
        const giaiDoanContainer = document.getElementById('giai_doan_container');
        const giaiDoanDivs = giaiDoanContainer.getElementsByClassName('group');

        // Xóa giai đoạn nếu số lượng giai đoạn lớn hơn 1
        if (soLuongGiaiDoan > 1) {
            // Xóa giai đoạn lớn nhất
            const lastDiv = giaiDoanDivs[giaiDoanDivs.length - 1];
            if (lastDiv) {
                const thuTuGiaiDoan = parseInt(lastDiv.querySelector('input[name="ThuTuGiaiDoan[]"]').value);

                lastDiv.remove();
                soLuongGiaiDoan--;

                // Cập nhật số thứ tự cho các giai đoạn còn lại
                document.querySelectorAll('#giai_doan_container .group').forEach((div, index) => {
                    const giaiDoanIndex = index + 1;
                   
                   
                });

                // Cập nhật trạng thái của nút xóa sau khi xóa giai đoạn
                updateDeleteButtonState();

                // Nếu giai đoạn bị xóa là giai đoạn 2, vô hiệu hóa nút xóa
                if (thuTuGiaiDoan === 2) {
                    document.getElementById('xoaGiaiDoanButton').disabled = true;
                }
            }
        } else {
            alert("Không thể xóa giai đoạn đầu tiên!");
        }
    }

    // Gán các sự kiện click cho các nút sau khi DOM đã được tải
    document.getElementById('themGiaiDoanButton').addEventListener('click', themGiaiDoan);
    document.getElementById('xoaGiaiDoanButton').addEventListener('click', xoaGiaiDoan);

});


</script>



@endsection
