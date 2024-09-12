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
    <input id="usernameInput" name="TenDuAn" type="text" class="form-control" required pattern="^\S.*">
    <span class="highlight"></span>
    <span class="bar"></span>
    <div class="valid-feedback"></div>
    <div class="invalid-feedback" >
        Vui lòng nhập tên dự án!
    </div>
</div>
<div class="group">       
<label>Loại dự án <span style="color:red;">(*)</span></label>
<select name="MaLoai" class="form-control"  required>
    <option value="" disabled selected>Chọn loại dự án</option>
    @foreach($LoaiDuAn as $LoaiDuAn1)
    <option value="{{$LoaiDuAn1->id}}">{{$LoaiDuAn1->TenLoaiDuAn}}</option>
    @endforeach
</select>
<span class="highlight"></span>
<span class="bar"></span>
<div class="valid-feedback"></div>
<div class="invalid-feedback">Vui lòng chọn loại dự án!</div>
</div>
<div class="group">       
    <label>Quy mô <span style="color:red;">(*)</span></label>
    <select name="QuyMo" class="form-control" required>
        <option value="" disabled selected>Chọn quy mô dự án</option>
        <!-- Các loại mặc định -->
        <option value="1">Nhỏ</option>
        <option value="2">Vừa</option>
        <option value="3">Lớn</option>
        <option value="4">Rất lớn</option>
    </select>
    <span class="highlight"></span>
    <span class="bar"></span>
    <div class="valid-feedback"></div>
    <div class="invalid-feedback">Vui lòng chọn quy mô dự án!</div>
</div>
<div class="group">
    <label>Ngày bắt đầu <span style="color:red;">(*)</span> <label>(lưu ý: ngày / tháng / năm)</label></label>
    <input id="NgayBatDauDuAn" name="NgayBatDauDuAn" type="date" class="form-control" required>
    <span class="highlight"></span>
    <span class="bar"></span>
    <div class="valid-feedback"></div>
    <div class="invalid-feedback invalid-feedback1" id="dateStartInvalidFeedback">
        Vui lòng chọn ngày bắt đầu lớn hơn ngày hiện tại!
    </div>
</div>

<div class="group">
    <label>Ngày kết thúc <span style="color:red;">(*)</span> <label>(lưu ý: ngày / tháng / năm)</label></label>
    <input id="NgayKetThucDuAn" name="NgayKetThucDuAn" type="date" class="form-control" required>
    <span class="highlight"></span>
    <span class="bar"></span>
    <div class="valid-feedback"></div>
    <div class="invalid-feedback invalid-feedback2" id="dateEndInvalidFeedback">
        Ngày kết thúc phải nhỏ hơn ngày bắt đầu!
    </div>
</div>
    <div class="group">
    <label>Mô tả <span style="color:red;">(*)</span></label>
      <textarea id="NoiDungInput" name="MoTa" type="text" class="form-control textarea" required></textarea >
      <span class="highlight"></span>
      <span class="bar"></span>
      <div class="valid-feedback">
      
      </div>
      <div class="invalid-feedback" >
        Vui lòng nhập mô tả !
      </div>
    </div>
    <div id="displayDateDiv"></div>
 <!-- Phần thêm giai đoạn -->
 <div id="giai_doan_container">
       <div class="macdinh">
       <div class="group">
            <h4>Giai Đoạn 1</h4>
            <label> Giai đoạn <span style="color:red;">(*)</span></label>
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
            <label>Ngày bắt đầu <span style="color:red;">(*)</span> <label>(lưu ý: ngày / tháng / năm)</label></label>
            <input id="NgayBatDau1" name="NgayBatDau[]" type="date" class="form-control" required>
            <span class="highlight"></span>
            <span class="bar"></span>
            <div class="valid-feedback"></div>
            <div class="invalid-feedback" id="dateStartInvalidFeedback1" >
             Ngày bắt đầu lớn hoặc bằng ngày bất đầu của dự án!
            </div>
            </div>
            <div class="group">
                <label>Ngày kết thúc <span style="color:red;">(*)</span> <label>(lưu ý: ngày / tháng / năm)</label></label>
                <input id="NgayKetThuc1" name="NgayKetThuc[]" type="date" class="form-control" required>
                <span class="highlight"></span>
                <span class="bar"></span>
                <div class="valid-feedback"></div>
                <div class="invalid-feedback" id="dateEndInvalidFeedback1" >
                Ngày kết thúc nhỏ hoặc bằng kết thúc của dự án!
                </div>
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
        <div class="group">
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
            <label>Ngày bắt đầu <span style="color:red;">(*)</span> <label>(lưu ý: ngày / tháng / năm)</label></label>
            <input id="NgayBatDau${soLuongGiaiDoan}" name="NgayBatDau[]" type="date" class="form-control" required>
            <span class="highlight"></span>
            <span class="bar"></span>
            <div class="valid-feedback"></div>
            <div class="invalid-feedback" id="dateStartInvalidFeedback${soLuongGiaiDoan}">
                Vui lòng chọn ngày bắt đầu lớn hơn ngày hiện tại!
            </div>
        </div>
        <div class="group">
            <label>Ngày kết thúc <span style="color:red;">(*)</span> <label>(lưu ý: ngày / tháng / năm)</label></label>
            <input id="NgayKetThuc${soLuongGiaiDoan}" name="NgayKetThuc[]" type="date" class="form-control" required>
            <span class="highlight"></span>
            <span class="bar"></span>
            <div class="valid-feedback"></div>
            <div class="invalid-feedback" id="dateEndInvalidFeedback${soLuongGiaiDoan}">
                Ngày kết thúc nhỏ hoặc bằng kết thúc của dự án!
            </div>
        </div>
        <div class="group">
            <input name="ThuTuGiaiDoan[]" type="number" class="form-control" value="${soLuongGiaiDoan}" readonly hidden>
            <span class="highlight"></span>
            <span class="bar"></span>
    `;

    giaiDoanContainer.appendChild(giaiDoanDiv);

    const NgayBatDauGiaiDoanDUAN = document.getElementById(`NgayBatDau${soLuongGiaiDoan}`);
    const NgayKetThucGiaiDoanDUAN = document.getElementById(`NgayKetThuc${soLuongGiaiDoan}`);
    const dateStartInvalidFeedback = document.getElementById(`dateStartInvalidFeedback${soLuongGiaiDoan}`);
    const dateEndInvalidFeedback = document.getElementById(`dateEndInvalidFeedback${soLuongGiaiDoan}`);

    // Lấy thông tin ngày bắt đầu và kết thúc dự án từ div hiển thị
    const displayDateDiv = document.getElementById('displayDateDiv').innerText;

    // Tách chuỗi để lấy phần ngày tháng năm sau chữ "Ngày bắt đầu dự án:"
    const partsStart = displayDateDiv.split('Ngày bắt đầu dự án: ');
    const dateStringStart = partsStart[1] ? partsStart[1].split(',')[0].trim() : '';
    
    // Tách chuỗi để lấy phần ngày tháng năm sau chữ "Ngày kết thúc dự án:"
    const partsEnd = displayDateDiv.split('Ngày kết thúc dự án: ');
    const dateStringEnd = partsEnd[1] ? partsEnd[1].split(',')[0].trim() : '';

    // Chuyển đổi ngày từ định dạng dd/mm/yyyy sang yyyy-mm-dd
    const [dayStart, monthStart, yearStart] = dateStringStart.split('/');
    const ngayBatDauDuAn = new Date(`${yearStart}-${monthStart}-${dayStart}`);

    const [dayEnd, monthEnd, yearEnd] = dateStringEnd.split('/');
    const ngayKetThucDuAn = new Date(`${yearEnd}-${monthEnd}-${dayEnd}`);

 

    // Sự kiện thay đổi ngày bắt đầu của giai đoạn mới
    NgayBatDauGiaiDoanDUAN.addEventListener('input', function() {
        const startDateGiaiDoan = new Date(NgayBatDauGiaiDoanDUAN.value);

        if (startDateGiaiDoan < ngayBatDauDuAn) {
            dateStartInvalidFeedback.style.display = 'block';
            dateStartInvalidFeedback.innerHTML = 'Ngày bắt đầu giai đoạn không được nhỏ hơn ngày bắt đầu dự án!';
            NgayBatDauGiaiDoanDUAN.classList.add('is-invalid');
        } else {
            dateStartInvalidFeedback.style.display = 'none';
            NgayBatDauGiaiDoanDUAN.classList.remove('is-invalid');
        }
    });

    // Sự kiện thay đổi ngày kết thúc của giai đoạn mới
    NgayKetThucGiaiDoanDUAN.addEventListener('input', function() {
        const endDateGiaiDoan = new Date(NgayKetThucGiaiDoanDUAN.value);

        if (endDateGiaiDoan > ngayKetThucDuAn) {
            dateEndInvalidFeedback.style.display = 'block';
            dateEndInvalidFeedback.innerHTML = 'Ngày kết thúc giai đoạn không được lớn hơn ngày kết thúc dự án!';
            NgayKetThucGiaiDoanDUAN.classList.add('is-invalid');
        } else {
            dateEndInvalidFeedback.style.display = 'none';
            NgayKetThucGiaiDoanDUAN.classList.remove('is-invalid');
        }
    });

    // Gắn sự kiện change cho select mới
    giaiDoanDiv.querySelector('select[name="MaGiaiDoan[]"]').addEventListener('change', updateSelectOptions);

    // Cập nhật các tùy chọn cho tất cả các select sau khi thêm giai đoạn mới
    updateSelectOptions();
}

    function suaGiaiDoan() {
    const giaiDoanContainer = document.getElementById('giai_doan_container');
    let giaiDoanDivs = giaiDoanContainer.querySelectorAll('.group');

    let count = 0; // Biến đếm số giai đoạn đã xóa
    while (giaiDoanDivs.length > 1 && count < 4) {  // Xóa tối đa 3 giai đoạn, nhưng không xóa giai đoạn mặc định
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


document.addEventListener('DOMContentLoaded', function() {
    var NgayBatDauDuAn = document.getElementById('NgayBatDauDuAn');  // Ngày bắt đầu dự án
    var NgayKetThucDuAn = document.getElementById('NgayKetThucDuAn');  // Ngày kết thúc dự án
    var NgayBatDauGiaiDoan = document.getElementById('NgayBatDau1');  // Ngày bắt đầu giai đoạn 1
    var NgayKetThucGiaiDoan = document.getElementById('NgayKetThuc1');  // Ngày kết thúc giai đoạn 1

    var dateStartInvalidFeedback = document.getElementById('dateStartInvalidFeedback1');
    var phaseEndInvalidFeedback = document.getElementById('dateEndInvalidFeedback1');  // Div để hiển thị lỗi ngày kết thúc giai đoạn
    var displayDateDiv = document.getElementById('displayDateDiv');  // Div để hiển thị thông tin ngày và số ngày thực hiện

    // Lắng nghe sự thay đổi của Ngày Bắt Đầu Dự Án và Ngày Kết Thúc Dự ÁN
    NgayBatDauDuAn.addEventListener('input', function(e) {
        validateStartDate();  // Kiểm tra ngày bắt đầu của giai đoạn
        validateEndDate();  // Kiểm tra ngày kết thúc dự án
        validatePhaseEndDate();  // Kiểm tra ngày kết thúc của giai đoạn
        displayDates();  // Hiển thị thông tin
    });

    NgayKetThucDuAn.addEventListener('input', function(e) {
        validateEndDate();  // Kiểm tra ngày kết thúc dự án
        validatePhaseEndDate();  // Kiểm tra ngày kết thúc của giai đoạn
        displayDates();  // Hiển thị thông tin
    });

    // Lắng nghe sự thay đổi của Giai Đoạn 1
    NgayBatDauGiaiDoan.addEventListener('input', function(e) {
        validateStartDate();  // Kiểm tra ngày bắt đầu của giai đoạn
        validatePhaseEndDate();  // Kiểm tra ngày kết thúc của giai đoạn
        displayDates();  // Hiển thị thông tin
    });

    NgayKetThucGiaiDoan.addEventListener('input', function(e) {
        validatePhaseEndDate();  // Kiểm tra ngày kết thúc của giai đoạn
        displayDates();  // Hiển thị thông tin
    });

    // Hàm kiểm tra ngày bắt đầu của Giai đoạn phải lớn hơn hoặc bằng Ngày Bắt Đầu Dự Án
    function validateStartDate() {
        var projectStartDateValue = NgayBatDauDuAn.value;
        var phaseStartDateValue = NgayBatDauGiaiDoan.value;

        if (projectStartDateValue && phaseStartDateValue) {
            var projectStartDate = new Date(projectStartDateValue);
            var phaseStartDate = new Date(phaseStartDateValue);
            if (phaseStartDate >= projectStartDate) {
                dateStartInvalidFeedback.style.display = 'none';
                NgayBatDauGiaiDoan.classList.remove('is-invalid');
            } else {
                dateStartInvalidFeedback.style.display = 'block';
                dateStartInvalidFeedback.innerHTML = 'Ngày bắt đầu của Giai đoạn phải lớn hơn hoặc bằng Ngày Bắt Đầu Dự Án!';
                NgayBatDauGiaiDoan.classList.add('is-invalid');
            }
        } else {
            // Nếu một trong hai trường rỗng, ẩn thông báo lỗi
            dateStartInvalidFeedback.style.display = 'none';
            NgayBatDauGiaiDoan.classList.remove('is-invalid', 'is-valid');
        }
    }

    // Hàm kiểm tra ngày kết thúc dự án phải lớn hơn ngày bắt đầu
    function validateEndDate() {
        var startDateValue = NgayBatDauDuAn.value;
        var endDateValue = NgayKetThucDuAn.value;
        if (startDateValue && endDateValue) {
            var startDate = new Date(startDateValue);
            var endDate = new Date(endDateValue);

            if (endDate > startDate) {
                dateEndInvalidFeedback.style.display = 'none';
                NgayKetThucDuAn.classList.remove('is-invalid');
              
            } else {
                dateEndInvalidFeedback.style.display = 'block';
                dateEndInvalidFeedback.innerHTML = 'Ngày kết thúc phải lớn hơn hoặc bằng ngày bắt đầu!';
                NgayKetThucDuAn.classList.add('is-invalid');
            }
        } else {
            // Không thực hiện kiểm tra nếu một trong hai trường trống
            dateEndInvalidFeedback.style.display = 'none';
            NgayKetThucDuAn.classList.remove('is-invalid', 'is-valid');
        }
    }

    // Hàm kiểm tra ngày kết thúc giai đoạn phải nhỏ hơn hoặc bằng Ngày Kết Thúc Dự Án
    function validatePhaseEndDate() {
        var projectEndDateValue = NgayKetThucDuAn.value;
        var phaseEndDateValue = NgayKetThucGiaiDoan.value;

        if (projectEndDateValue && phaseEndDateValue) {
            var projectEndDate = new Date(projectEndDateValue);
            var phaseEndDate = new Date(phaseEndDateValue);

            if (phaseEndDate <= projectEndDate) {
                phaseEndInvalidFeedback.style.display = 'none';
                NgayKetThucGiaiDoan.classList.remove('is-invalid');
               
            } else {
                phaseEndInvalidFeedback.style.display = 'block';
                phaseEndInvalidFeedback.innerHTML = 'Ngày kết thúc của Giai đoạn phải nhỏ hơn hoặc bằng Ngày Kết Thúc Dự Án!';
              
                NgayKetThucGiaiDoan.classList.add('is-invalid');
            }
        } else {
            // Nếu một trong hai trường rỗng, ẩn thông báo lỗi
            phaseEndInvalidFeedback.style.display = 'none';
            NgayKetThucGiaiDoan.classList.remove('is-invalid', 'is-valid');
        }
    }

    // Hàm hiển thị ngày bắt đầu, kết thúc dự án và số ngày thực hiện
    function displayDates() {
        var startDateValue = NgayBatDauDuAn.value;
        var endDateValue = NgayKetThucDuAn.value;

        if (startDateValue && endDateValue) {
            var start = new Date(startDateValue);
            var end = new Date(endDateValue);

            var totalDays = Math.floor((end - start) / (1000 * 60 * 60 * 24));

            var startFormatted = start.toLocaleDateString('vi-VN');
            var endFormatted = end.toLocaleDateString('vi-VN');

            displayDateDiv.innerHTML = `Ngày bắt đầu dự án: ${startFormatted}, Ngày kết thúc dự án: ${endFormatted}, Tổng số ngày: ${totalDays} ngày`;
        } else {
            displayDateDiv.innerHTML = '';  // Xóa nội dung nếu không có giá trị
        }
    }

    // Hiển thị ngày và thông tin ngay từ đầu nếu có
    displayDates();
});




</script>



@endsection
