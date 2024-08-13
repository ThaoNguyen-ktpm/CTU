@extends('layouts/layoutAdmin')
@section('content')
 
<div class="col">
<div class="container">
  <h2 class=" text-weight">Thêm Phòng Ban<small></small></h2>
  <form  method="post" class="needs-validation PhongBan-form" action="/PhongBan/add" novalidate>
  @csrf
    
    <div class="group">
    <label>Đơn Vị <span style="color:red;">(*)</span></label>
    <select name="MaDonVi" class="form-control" required>
        <option value="" disabled selected>Chọn Đơn Vị</option>
        @foreach($DonVi as $DonVi1)
        <option value="{{$DonVi1->id}}">{{$DonVi1->TenDonVi}}</option>
        @endforeach
    </select>
    <div class="valid-feedback">
        Nhập Đơn Vị Thành Công
      </div>
    <div class="invalid-feedback">
        Vui Lòng Chọn Đơn Vị!
    </div>
    </div>
    <div class="group">
      <label>Người Dùng <span style="color:red;">(*)</span></label>
      <div  class="GiaoVienGiangDay-list">
      @foreach($NguoiDung as $NguoiDung1)
      <div class="form-check">
          <input class="form-check-input"  type="checkbox" name="MaNguoiDung[]" value="{{$NguoiDung1->id}}">
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
      <button name="Add" type="submit" class="submit-btn">Thêm Phòng Ban</button>
  </form>
</div>
</div>
<div id="toast1"></div>
<script src="{{ asset('js/formvalidation.js') }}"></script>
<script>
	$(document).ready(function() {
		$('.PhongBan-form').submit(function(event) {
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
								window.location.href = "/PhongBan";
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
          message: "Đã Tồn Tại Phòng Ban  !",
          type:"error",
          duration:2000
      })
    }
	    
    function showSuccessToast1(){
      toast1({
        title: "Success",
        message: "Thêm Phòng Ban Thành Công !",
        type:"success",
        duration:2000
      })
    }
</script>

@endsection
