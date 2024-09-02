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
<form   method="post" class="needs-validation NhanCongViec-form" action="/NhanCongViec/{{$CongViec[0]->id}}" novalidate>
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
            <td class="text-left">Thời gian </td>
            <td class="text-left">{{ \Carbon\Carbon::parse($CongViec[0]->NgayBatDau)->format('d-m-Y') }} Đến {{ \Carbon\Carbon::parse($CongViec[0]->NgayKetThuc)->format('d-m-Y') }}</td>
        </tr>
        <tr>
            <td class="text-left">Thời gian Nộp</td>
            <td class="text-left">{{ \Carbon\Carbon::parse($CongViec[0]->ThoiGian)->format('H:i:s d-m-Y') }} </td>
        </tr>
        <tr>
            <td class="text-left">Link tài liệu</td>
            <td class="text-left">
               <a href="{{$CongViec[0]->LinkTaiLieu}}" class="link-tai-lieu">Link tài liệu</a>
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
          <td class="text-left">File Đã Nộp</td>
          <td class="text-left">
          <div>
                <!-- Hiển thị liên kết tải xuống nếu có tệp tin trước đó -->
                @if(isset($CongViec[0]->DuongDanFile) && !empty($CongViec[0]->DuongDanFile))
                    <p>
                         
                        <a href="{{ url($CongViec[0]->DuongDanFile) }}" download class="link-tai-lieu">
                             Tải xuống tệp : <i class="fa-solid fa-download"  style=" margin-left:10px"></i>
                        </a>
                    </p>
                @endif

               
            </div>
          </td>
      </tr>
        <tr>
            <td class="text-left"><div class="cmt"> Nội Dung Bình Luận</div></td>
            <td class="text-left">
                <div class="group">
                    <textarea id="ghichuInput"  name="NoiDung" class="form-control textarea" readonly required>{{$CongViec[0]->NoiDung}}</textarea>
                    <span class="highlight"></span>
                    <span class="bar"></span>
                </div>
            </td>
        </tr>
    </tbody>
</table>
  
</form>
<div id="toast1"></div>
<div class="modal_login" id="modalLogin">
    <div class="loading-bar">Loading</div>
</div>
<script>
	 $(document).ready(function() {
      $('.NhanCongViec-form').submit(function(event) {
        event.preventDefault(); // Ngăn chặn form submit mặc định
        var form = $(this)[0]; // Lấy form DOM element
        var $form = $(this); // jQuery đối tượng của form
        var url = $form.attr('action');

        // Kiểm tra tính hợp lệ của form
        if (form.checkValidity() === false) {
          event.stopPropagation();
          $form.addClass('was-validated');
        } else {
          $('#modalLogin').css('display', 'flex');
          var formData = $form.serialize();
          $.ajax({
            type: 'POST',
            url: url,
            data: formData,
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
</script>
<script>
    document.getElementById('fileInput').addEventListener('change', function() {
        var fileName = this.files[0].name;
        document.getElementById('fileNameDisplay').textContent = 'File đã chọn: ' + fileName;
    });
</script>
@endsection
