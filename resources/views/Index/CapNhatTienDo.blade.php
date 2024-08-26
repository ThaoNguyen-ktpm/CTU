@extends('layouts/layoutDetails')
@section('content')
<style>
    .submit-btn {
    transform: translateX(0px);
    margin-top: 20px;
    margin-bottom: 20px;
    margin-right: 100px;
}
</style>
<div class="table-title">
    <h3 style="font-style: italic ; font-weight: 600; padding: 20px;">Chi Tiết Công Việc</h3>
</div>
<form method="post" class="needs-validation NopBaoCao-form" enctype="multipart/form-data" action="/NopBaoCao/{{$CongViec[0]->id}}" novalidate>
@csrf
<table class="table-fill">
    <thead>
        <tr>
            <th class="text-left" style="width: 20%"></th>
            <th class="text-left" style="width: 80%"></th>
        </tr>
    </thead>
    <tbody class="table-hover">
        <tr>
            <td class="text-left">Tên dự án</td>
            <td class="text-left">{{$CongViec[0]->TenDuAn}}</td>
        </tr>
        <tr>
            <td class="text-left">Tên công việc</td>
            <td class="text-left">{{$CongViec[0]->TenCongViec}}</td>
        </tr>
        <tr>
            <td class="text-left">Thời gian còn lại</td>
            <td class="text-left">
                <span id="countdown"></span>
            </td>
        </tr>
        <tr>
            <td class="text-left">Link tài liệu</td>
            <td class="text-left">
               <a href="{{$CongViec[0]->LinkTaiLieu}}">Link tài liệu</a>
            </td>
          </tr>
          <tr>
              <td class="text-left"><div class="cmt">Mô tả công việc</div></td>
              <td class="text-left">
                  <div class="group">
                      <textarea id="ghichuInput" name="GhiChu" class="form-control textarea" readonly>{{$CongViec[0]->MoTa}}</textarea>
                      <span class="highlight"></span>
                      <span class="bar"></span>
                  </div>
              </td>
          </tr>
        <tr>
            <td class="text-left">Chọn File Nộp</td>
            <td class="text-left">
            <div>
            <input type="file" id="fileInput" name="file_nop" class="form-control-file" required>
                <p id="fileNameDisplay" style="margin-top: 10px;"></p>
            </div>
                
            </td>
        </tr>
        <tr>
            <td class="text-left">Tên Người Nộp</td>
            <td class="text-left">
            <div>
              <input id="HoTen" name="TenNguoiNop" type="text" class="form-control" required>   
            </div>

            </td>
        </tr>
        <tr>
            <td class="text-left"><div class="cmt">Bình Luận Nội Dung</div></td>
            <td class="text-left">
                <div class="group">
                    <textarea id="ghichuInput" name="NoiDung" class="form-control textarea" required></textarea>
                    <span class="highlight"></span>
                    <span class="bar"></span>
                </div>
            </td>
        </tr>
    </tbody>
</table>
   <div style="width: 100% ;text-align: right; ">
       <button name="Add" type="submit" style="margin-right: 100px;margin-top: 40px;margin-bottom: 30px" class="button">Nộp Báo Cáo</button>
    </div>
</form>

<script>
		$(document).ready(function() {
    $('.NopBaoCao-form').on('submit', function(e) {
        e.preventDefault(); // Ngăn chặn form submit mặc định
        var form = $(this);
        var formData = new FormData(form[0]); // Sử dụng FormData để gửi dữ liệu form, bao gồm cả file

        // Kiểm tra tính hợp lệ của form
        var isError = false;
        form.find('input[required]').each(function() {
            var input = $(this);
            if (input.val() === '') {
                isError = true;
            }
        });

        if (!isError) {
            $.ajax({
                url: form.attr('action'),
                type: 'POST',
                data: formData,
                dataType: 'json',
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response.success === true) {
                        showSuccessToast1();
                        setTimeout(function() {
                            window.location.href = "/Index";
                        }, 1000);
                    } else {
                        showErrorToast1();
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', status, error);
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
          message: " Đơn Vị Đã Tồn Tại !",
          type:"error",
          duration:2000
      })
    }
	    
    function showSuccessToast1(){
      toast1({
        title: "Success",
        message: "Thêm Đơn Vị Thành Công !",
        type:"success",
        duration:2000
      })
    }



    // Ngày kết thúc của công việc (cần định dạng theo chuẩn "YYYY-MM-DD HH:MM:SS" để JavaScript hiểu được)
      const ngayKetThuc = "{{ \Carbon\Carbon::parse($CongViec[0]->NgayKetThuc)->format('Y-m-d H:i:s') }}";

      function updateCountdown() {
          const endDate = new Date(ngayKetThuc).getTime();
          const now = new Date().getTime();
          const timeRemaining = endDate - now;

          if (timeRemaining > 0) {
              const days = Math.floor(timeRemaining / (1000 * 60 * 60 * 24));
              const hours = Math.floor((timeRemaining % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
              const minutes = Math.floor((timeRemaining % (1000 * 60 * 60)) / (1000 * 60));
           

              document.getElementById("countdown").innerHTML = 
                  days + " ngày " + hours + " giờ " + minutes + " phút " ;
          } else {
              document.getElementById("countdown").innerHTML = "Đã hết hạn";
          }
      }

      // Cập nhật bộ đếm mỗi giây
      setInterval(updateCountdown, 1000);

      // Gọi hàm ngay lập tức để hiển thị lần đầu tiên
      updateCountdown();



      document.getElementById('fileInput').addEventListener('change', function(event) {
    const fileInput = event.target;
    const fileName = fileInput.files[0] ? fileInput.files[0].name : "Chưa chọn file nào";
    
    // Hiển thị tên file đã chọn
    document.getElementById('fileNameDisplay').textContent = "Tên file: " + fileName;
});
var HoTen = document.getElementById('HoTen');
    HoTen.addEventListener('input', function(e) {
      var value = e.target.value;
      // Loại bỏ khoảng trắng đầu tiên nếu có
      var sanitizedValue = value.replace(/^\s/, '');
      e.target.value = sanitizedValue;
    });
</script>
@endsection
