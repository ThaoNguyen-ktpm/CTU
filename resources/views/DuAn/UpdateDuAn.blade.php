@extends('layouts/layoutAdmin')
@section('content')
<style>
    h3 {
        text-align: center;
        /* Căn giữa tiêu đề */
        margin: 10px 0;
        /* Khoảng cách trên dưới */
    }
  </style>
<div class="col">
<div class="container">
  <h2 class=" text-weight">Thông Tin Dự Án<small></small></h2>
  <form  method="post" class="needs-validation DuAn-form" action="/DuAn/update/{{$DuAn->id}}" novalidate>
  @csrf
    <div class="group">
    <label>Tên dự án <span style="color:red;">(*)</span></label>
      <input  id="usernameInput" name="TenDuAn" value="{{ $DuAn->TenDuAn }}"  type="text" class="form-control" required>
      <span class="highlight"></span>
      <span class="bar"></span>
      <div class="valid-feedback">
      </div>
      <div class="invalid-feedback">
        Vui lòng nhập tên dự án !
      </div>
    </div>
    <div class="group">       
    <label>Loại dự án <span style="color:red;">(*)</span></label>
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
    <label>Quy mô <span style="color:red;">(*)</span></label>
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
    <label>Ngày bắt đầu <span style="color:red;">(*)</span> <label>(lưu ý: ngày / tháng / năm)</label></label>
    <input id="NgayBatDauDuAn" name="NgayBatDauDuAn" value="{{ $DuAn->NgayBatDau }}" type="date" class="form-control" required>
    <span class="highlight"></span>
    <span class="bar"></span>
    <div class="valid-feedback"></div>
    <div class="invalid-feedback invalid-feedback1" id="dateStartInvalidFeedback">
        Vui lòng chọn ngày bắt đầu lớn hơn ngày hiện tại!
    </div>
</div>

<div class="group">
    <label>Ngày kết thúc <span style="color:red;">(*)</span> <label>(lưu ý: ngày / tháng / năm)</label></label>
    <input id="NgayKetThucDuAn" name="NgayKetThucDuAn" value="{{ $DuAn->NgayKetThuc }}" type="date" class="form-control" required>
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



<div id="displayDateDiv"></div>
 <!-- Phần thêm giai đoạn -->
 <div id="giai_doan_container">
       <div class="macdinh">
         @foreach($CacGiaiDoan as $index => $CacGiaiDoan1)
       <div class="group">
            <h4>Giai Đoạn {{$CacGiaiDoan1->ThuGiaiDoan}}</h4>
                  <label>Chọn giai đoạn <span style="color:red;">(*)</span></label>
                  <select name="MaGiaiDoan[]" class="form-control" id="selectGiaiDoan{{$index}}" required>
                      <option value="" disabled selected>Chọn giai đoạn</option>
                      @foreach($GiaiDoan as $GiaiDoan1)
                          <!-- So sánh nếu giai đoạn hiện tại trùng với giá trị đã chọn, thì đánh dấu 'selected' -->
                          <option value="{{$GiaiDoan1->id}}" 
                              @if($CacGiaiDoan1->MaGiaiDoan == $GiaiDoan1->id) selected @endif>
                              {{$GiaiDoan1->TenGiaiDoan}}
                          </option>
                      @endforeach
                  </select>
            <span class="highlight"></span>
            <span class="bar"></span>
            <div class="valid-feedback"></div>
            <div class="invalid-feedback">Vui lòng chọn giai đoạn!</div>
            </div>
            <div class="group">
            <label>Ngày bắt đầu <span style="color:red;">(*)</span> <label>(lưu ý: ngày / tháng / năm)</label></label>
            <input id="NgayBatDau{{$CacGiaiDoan1->ThuGiaiDoan}}" name="NgayBatDau[]" value="{{ \Carbon\Carbon::parse($CacGiaiDoan1->NgayBatDau)->format('Y-m-d') }}" type="date" class="form-control" required>
            <span class="highlight"></span>
            <span class="bar"></span>
            <div class="valid-feedback"></div>
            <div class="invalid-feedback" id="dateStartInvalidFeedback{{$CacGiaiDoan1->ThuGiaiDoan}}" >
                Ngày bắt đầu lớn hoặc bằng ngày bất đầu của dự án!
            </div>
            </div>
            <div class="group">
                <label>Ngày kết thúc <span style="color:red;">(*)</span> <label>(lưu ý: ngày / tháng / năm)</label></label>
                <input id="NgayKetThuc{{$CacGiaiDoan1->ThuGiaiDoan}}" name="NgayKetThuc[]" value="{{ \Carbon\Carbon::parse($CacGiaiDoan1->NgayKetThuc)->format('Y-m-d') }}" type="date" class="form-control" required>
                <span class="highlight"></span>
                <span class="bar"></span>
                <div class="valid-feedback"></div>
                <div class="invalid-feedback" id="dateEndInvalidFeedback{{$CacGiaiDoan1->ThuGiaiDoan}}" >
                Ngày kết thúc nhỏ hoặc bằng kết thúc của dự án!
                </div>
            </div>
            <div class="group">
            <input name="ThuTuGiaiDoan[]" type="number" class="form-control" value="{{$CacGiaiDoan1->ThuGiaiDoan}}" readonly hidden>
            <span class="highlight"></span>
            <span class="bar"></span>
            </div>
            @endforeach
       </div>
    </div>
    <!-- Nút thêm giai đoạn mới -->
    <button id="themGiaiDoanButton" type="button">Thêm Giai Đoạn</button>
    <!-- Nút xóa giai đoạn -->
    <button id="suaGiaiDoanButton" type="button">Sửa Giai Đoạn</button>

     <div class="group" style="margin-top: 20px;">
        <label>người nhận dự án trong đơn vị : {{$idMaDonVi[0]->TenDonVi}} <span style="color:red;"> (*)</span></label>
      <div  class="GiaoVienGiangDay-list">
      @foreach($ThanhVienDonVi as $NguoiDung1)
    <div class="form-check">
        <input class="form-check-input" type="checkbox" name="MaNguoiDung[]" value="{{$NguoiDung1->id}}"
            {{ in_array($NguoiDung1->id, array_column($ThanhVienDuAn, 'id')) ? 'checked' : '' }}>
        <label class="form-check-label">
            {{$NguoiDung1->user_name}} 
        </label>
    </div>
    @endforeach
    </div>
      <button name="Add" type="submit" class="submit-btn" style=" margin-top: 25px;">Cập Nhật</button>
  </form>
</div>
</div>
<div id="soluonggiaidoan" style="display: none;">Số lượng dữ liệu: {{ count($CacGiaiDoan) }}</div>

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
 


// phần new
document.addEventListener('DOMContentLoaded', function () {

    var div = document.getElementById('soluonggiaidoan');
    // Lấy nội dung văn bản của <div> và phân tích số lượng
    var textContent = div.textContent || div.innerText;
    var matches = textContent.match(/Số lượng dữ liệu: (\d+)/);
    // Gán giá trị vào biến JavaScript
    let soLuongGiaiDoanLay = parseInt(matches[1], 10);
    let soLuongGiaiDoan =  soLuongGiaiDoanLay;
    let soLuongGiaiDoanKiemTra =  soLuongGiaiDoanLay;


    function toggleSuaGiaiDoanButton() {
        const suaGiaiDoanButton = document.getElementById('suaGiaiDoanButton');
        if (soLuongGiaiDoan <= soLuongGiaiDoanKiemTra) {
            suaGiaiDoanButton.style.display = 'none';  // Ẩn nút nếu chỉ còn 1 giai đoạn
        } else {
            suaGiaiDoanButton.style.display = 'inline-block';  // Hiện nút nếu có hơn 1 giai đoạn
        }
    }



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
    toggleSuaGiaiDoanButton();
}


    function suaGiaiDoan() {
    const giaiDoanContainer = document.getElementById('giai_doan_container');
    let giaiDoanDivs = giaiDoanContainer.querySelectorAll('.group');

    let count = 0; // Biến đếm số giai đoạn đã xóa
    while (giaiDoanDivs.length > 1 && count < 5) {  // Xóa tối đa 3 giai đoạn, nhưng không xóa giai đoạn mặc định
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
    toggleSuaGiaiDoanButton();
}


    // Gán sự kiện click cho các nút sau khi DOM đã được tải
    document.getElementById('themGiaiDoanButton').addEventListener('click', themGiaiDoan);
    document.getElementById('suaGiaiDoanButton').addEventListener('click', suaGiaiDoan);
    toggleSuaGiaiDoanButton();
});

document.addEventListener('DOMContentLoaded', function() {
    var NgayBatDauDuAn = document.getElementById('NgayBatDauDuAn');  // Ngày bắt đầu dự án
    var NgayKetThucDuAn = document.getElementById('NgayKetThucDuAn');  // Ngày kết thúc dự án
    var displayDateDiv = document.getElementById('displayDateDiv');  // Div để hiển thị thông tin ngày và số ngày thực hiện

    // Lắng nghe sự thay đổi của Ngày Bắt Đầu Dự Án và Ngày Kết Thúc Dự ÁN
    NgayBatDauDuAn.addEventListener('input', function(e) {
        validateDates();  // Kiểm tra ngày bắt đầu, ngày kết thúc
    });

    NgayKetThucDuAn.addEventListener('input', function(e) {
        validateDates();  // Kiểm tra ngày kết thúc dự án
    });

    // Lặp qua các giai đoạn để thêm sự kiện
    var totalPhases = document.querySelectorAll("[id^='NgayBatDau']").length;  // Lấy tổng số giai đoạn dựa trên các id bắt đầu bằng 'NgayBatDau'
    
    for (let i = 1; i <= totalPhases; i++) {
        var NgayBatDauGiaiDoan = document.getElementById(`NgayBatDau${i}`);
        var NgayKetThucGiaiDoan = document.getElementById(`NgayKetThuc${i}`);
        
        NgayBatDauGiaiDoan.addEventListener('input', function(e) {
            validateDates();  // Kiểm tra ngày bắt đầu của giai đoạn
        });

        NgayKetThucGiaiDoan.addEventListener('input', function(e) {
            validateDates();  // Kiểm tra ngày kết thúc của giai đoạn
        });
    }

    // Hàm kiểm tra ngày bắt đầu và kết thúc cho dự án và tất cả các giai đoạn
  function validateDates() {
    var startDateValue = NgayBatDauDuAn.value;
    var endDateValue = NgayKetThucDuAn.value;

    // Kiểm tra ngày bắt đầu và ngày kết thúc dự án
    if (startDateValue && endDateValue) {
        var startDate = new Date(startDateValue);
        var endDate = new Date(endDateValue);

        if (endDate > startDate) {
           
            NgayKetThucDuAn.classList.remove('is-invalid');
        } else {
         
            NgayKetThucDuAn.classList.add('is-invalid');
        }
    }

    // Lặp qua các giai đoạn để kiểm tra từng giai đoạn
    for (let i = 1; i <= totalPhases; i++) {
        var phaseStartDateValue = document.getElementById(`NgayBatDau${i}`).value;
        var phaseEndDateValue = document.getElementById(`NgayKetThuc${i}`).value;
        var phaseStartInvalidFeedback = document.getElementById(`dateStartInvalidFeedback${i}`);
        var phaseEndInvalidFeedback = document.getElementById(`dateEndInvalidFeedback${i}`);
        var NgayBatDauGiaiDoan = document.getElementById(`NgayBatDau${i}`);
        var NgayKetThucGiaiDoan = document.getElementById(`NgayKetThuc${i}`);

        // Kiểm tra ngày bắt đầu của giai đoạn
        if (phaseStartDateValue) {
            var phaseStartDate = new Date(phaseStartDateValue);
            if (phaseStartDate >= new Date(startDateValue)) {
                phaseStartInvalidFeedback.style.display = 'none';
                NgayBatDauGiaiDoan.classList.remove('is-invalid');
            } else {
                phaseStartInvalidFeedback.style.display = 'block';
                phaseStartInvalidFeedback.innerHTML = 'Ngày bắt đầu của giai đoạn phải lớn hơn hoặc bằng Ngày Bắt Đầu Dự Án!';
                NgayBatDauGiaiDoan.classList.add('is-invalid');
            }
        }

        // Kiểm tra ngày kết thúc của giai đoạn
        if (phaseEndDateValue) {
            var phaseEndDate = new Date(phaseEndDateValue);
            if (phaseEndDate <= new Date(endDateValue)) {
                phaseEndInvalidFeedback.style.display = 'none';
                NgayKetThucGiaiDoan.classList.remove('is-invalid');
            } else {
                phaseEndInvalidFeedback.style.display = 'block';
                phaseEndInvalidFeedback.innerHTML = 'Ngày kết thúc của giai đoạn phải nhỏ hơn hoặc bằng Ngày Kết Thúc Dự Án!';
                NgayKetThucGiaiDoan.classList.add('is-invalid');
            }
        }
    }

    // Hiển thị ngày và số ngày thực hiện
    displayDates();
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
    validateDates();
});




</script>

@endsection
