@extends('layouts/layoutDetails')
@section('content')
<style>
    .submit-btn {
    transform: translateX(0px);
    margin-top: 20px;
    margin-bottom: 20px;
    margin-right: 100px;
}
input[type="range"] {
    
    width: 100%;
    height: 8px;
    background: #ddd;
    border-radius: 5px;
    outline: none;
}

input[type="range"]::-webkit-slider-thumb {
    -webkit-appearance: none;
    appearance: none;
    width: 20px;
    height: 20px;
    background: #4CAF50;
    border-radius: 50%;
    cursor: pointer;
}

input[type="range"]::-moz-range-thumb {
    width: 20px;
    height: 20px;
    background: #4CAF50;
    border-radius: 50%;
    cursor: pointer;
}

</style>
<div class="table-title">
    <h3 style="font-style: italic ; font-weight: 600; padding: 20px;">Chi Tiết Công Việc</h3>
</div>
<form method="post" class="needs-validation NopBaoCao-form" enctype="multipart/form-data" action="/NopBaoCao/{{$CongViec[0]->id}}/{{$CongViec[0]->idcapnhattiendo ?? 'null'}}" novalidate>
@csrf
<table class="table-fill" id="fileTable">
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
            <td class="text-left">Phần trăm cập nhật</td>
            <td class="text-left">
            <div style="display: flex; align-items: center;">
                <input type="range" id="progressSlider" name="TienDo" min="0" max="100" step="1" style="width: 80%;">
                <span id="progressValue" style="margin-left: 10px;">0%</span>
            </div>
            </td>
        </tr> 
        <tr>
            <td class="text-left">Chọn File Nộp</td>
            <td class="text-left" id="fileContainer">
                <div style="display: flex; justify-content: flex-start;" class="file-upload-group">
                    <label class="file-label" for="fileInput" style="cursor: pointer;">
                        Thêm File
                    </label>
                    <input type="file" id="fileInput" name="files[]" multiple style="display: none;">
                    <button type="button" id="addDivButton" style="margin-left: 20px; cursor: pointer;">+</button>
                </div>
                @if(isset($CongViec[0]->DuongDanFile))
                @foreach($CongViec as $index => $CongViec1)
                    <div style="display: flex; justify-content: space-between; margin-top:20px" class="file-upload-group">
                        <label class="file-label">
                            <i class="fa-solid fa-file-import"></i> File Đã Nộp 
                        </label>
                        <div style="margin-top: 10px;">
                            {{ $CongViec1->DuongDanFile }}
                        </div>
                    </div>
                @endforeach
                @endif
            </td>
        </tr>
        <tr>
            <td class="text-left"><div class="cmt">Bình Luận Nội Dung</div></td>
            <td class="text-left">
                <div class="group">
                    <textarea id="ghichuInput" name="NoiDung" class="form-control textarea" required>   @if(isset($CongViec[0]->DuongDanFile)){{ $CongViec[0]->NoiDung }}  @endif</textarea>
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
<div id="toast1"></div>
<div class="modal_login" id="modalLogin">
    <div class="loading-bar">Loading</div>
</div>
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
                    // Thêm thông báo lỗi nếu cần
                    input.addClass('is-invalid'); // Giả sử bạn sử dụng class này để hiển thị lỗi
                } else {
                    input.removeClass('is-invalid');
                }
            });

            if (!isError) {
                $('#modalLogin').css('display', 'flex');
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
                            // Thay đổi thông báo lỗi nếu có
                            console.error('Error:', response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX Error:', status, error);
                        // Thay đổi thông báo lỗi nếu cần
                        showErrorToast1();
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
          message: " Tệp không hợp lệ !",
          type:"error",
          duration:2000
      })
    }
	    
    function showSuccessToast1(){
      toast1({
        title: "Success",
        message: "Báo Cáo Thành Công !",
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




      document.addEventListener('DOMContentLoaded', function() {
    let divCount = 1; // Đếm số lượng div hiện tại

    // Gán sự kiện cho phần tử file input đầu tiên sau khi DOM đã tải xong
    const fileInput_0 = document.getElementById('fileInput_0');
    const fileNameDisplay_0 = document.getElementById('fileNameDisplay_0');

    if (fileInput_0 && fileNameDisplay_0) { // Kiểm tra phần tử tồn tại
        fileInput_0.addEventListener('change', function(event) {
            const files = Array.from(event.target.files);
            
            fileNameDisplay_0.textContent = ''; // Xóa nội dung cũ
            
            if (files.length > 0) {
                const fileList = document.createElement('ul');            
                files.forEach((file) => {
                    const listItem = document.createElement('li');
                    listItem.textContent = "Tên file: " + file.name;
                    fileList.appendChild(listItem);
                });
                
                fileNameDisplay_0.appendChild(fileList);
            } else {
                fileNameDisplay_0.textContent = "Chưa chọn file nào";
            }
        });
    }

    document.getElementById('addDivButton').addEventListener('click', function() {
        const fileContainer = document.getElementById('fileContainer');
        
        // Tạo div mới
        const newDiv = document.createElement('div');
        newDiv.style.display = 'flex';
        newDiv.style.justifyContent = 'space-between';
        newDiv.className = 'file-upload-group';
        newDiv.style.marginTop = '10px';
        newDiv.innerHTML = `
            <label for="fileInput_${divCount}" class="file-label" style="cursor: pointer;">
                <i class="fa-solid fa-file-import"></i> Chọn File
            </label>
            <input type="file" id="fileInput_${divCount}" name="file_nop[]" class="form-control-file" multiple required style="display: none;">
            <div id="fileNameDisplay_${divCount}" style="margin-top: 10px;"></div>
            <button class="deleteDivButton" style="margin-top: 10px; cursor: pointer;">Xóa</button>
        `;
        
        // Thêm div mới vào fileContainer
        fileContainer.appendChild(newDiv);

        // Thêm sự kiện lắng nghe cho input file của div mới
        const fileInput = document.getElementById(`fileInput_${divCount}`);
        const fileNameDisplay = document.getElementById(`fileNameDisplay_${divCount}`);
        const deleteDivButton = newDiv.querySelector('.deleteDivButton');

        if (fileInput && fileNameDisplay && deleteDivButton) { // Kiểm tra các phần tử tồn tại
            fileInput.addEventListener('change', function(event) {
                const files = Array.from(event.target.files);
                
                fileNameDisplay.textContent = ''; // Xóa nội dung cũ
                
                if (files.length > 0) {
                    const fileList = document.createElement('ul');
                    fileList.style.paddingLeft = '20px';
                    
                    files.forEach((file) => {
                        const listItem = document.createElement('li');
                        listItem.textContent = "Tên file: " + file.name;
                        fileList.appendChild(listItem);
                    });
                    
                    fileNameDisplay.appendChild(fileList);
                } else {
                    fileNameDisplay.textContent = "Chưa chọn file nào";
                }
            });

            // Xóa div khi nhấn nút "Xóa"
            deleteDivButton.addEventListener('click', function() {
                fileContainer.removeChild(newDiv);
            });
        }
        
        divCount++; // Tăng giá trị divCount sau khi thêm div mới
    });
});

</script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const progressSlider = document.getElementById('progressSlider');
    const progressValue = document.getElementById('progressValue');

    // Gán giá trị từ PHP vào thanh trượt khi trang tải
    const initialProgress = parseInt('{{ $CongViec[0]->TienDo ?? 0 }}', 10);
    progressSlider.value = initialProgress;
    progressValue.textContent = `${initialProgress}%`;

    // Cập nhật giá trị hiển thị khi người dùng thay đổi giá trị thanh trượt
    progressSlider.addEventListener('input', function() {
        if (parseInt(progressSlider.value, 10) < initialProgress) {
            progressSlider.value = initialProgress;
        }
        progressValue.textContent = `${progressSlider.value}%`;
    });
});
</script>


@endsection
