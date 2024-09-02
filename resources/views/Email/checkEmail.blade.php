<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('img/Artboard 3.png') }}"/>
    <title>@if(isset($title))
            {{ $title }}
        @else
            Trang chủ
        @endif</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link rel="stylesheet" href="{{ asset('css/checkform.css') }}">
    <link rel="stylesheet" href="{{ asset('css/backgroundLogin.css') }}">
    <link rel="stylesheet" href="{{ asset('css/checkemail.css') }}">
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script></head>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<body class="login-body">
<ul class="background12">
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
</ul> 
<form  action="/CheckverifyOtp" class="needs-validation formcheck Create-form" method="post" novalidate>
@csrf
<div class="hinhanhcheck">
	<svg class="check1" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="60px" height="60px" viewBox="0 0 60 60" xml:space="preserve">  <image id="image0" width="60" height="60" x="0" y="0" href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADwAAAA8CAQAAACQ9RH5AAAABGdBTUEAALGPC/xhBQAAACBjSFJN
	AAB6JgAAgIQAAPoAAACA6AAAdTAAAOpgAAA6mAAAF3CculE8AAAAAmJLR0QA/4ePzL8AAAAJcEhZ
	cwAACxMAAAsTAQCanBgAAAAHdElNRQfnAg0NDzN/r+StAAACR0lEQVRYw+3Yy2sTURTH8W+bNgVf
	aGhFaxNiAoJou3FVEUQE1yL031BEROjCnf4PLlxILZSGYncuiiC48AEKxghaNGiliAojiBWZNnNd
	xDza3pl77jyCyPzO8ubcT85wmUkG0qT539In+MwgoxQoUqDAKDn2kSNLlp3AGi4uDt9xWOUTK3xg
	hVU2wsIZSkxwnHHGKZOxHKfBe6rUqFGlTkPaVmKGn6iYao1ZyhK2zJfY0FZ9ldBzsbMKxZwZjn/e
	5szGw6UsD5I0W6T+hBhjUjiF7bNInjz37Ruj3igGABjbtpIo3GIh30u4ww5wr3fwfJvNcFeznhBs
	YgXw70TYX2bY/ulkZhWfzfBbTdtrzjPFsvFI+T/L35jhp5q2owDs51VIVvHYDM9sa/LY8XdtKy1l
	FXfM8FVN2/X2ajctZxVXzPA5TZvHpfb6CFXxkerUWTOcY11LX9w0tc20inX2mmF4qG3upnNWrOKB
	hIXLPu3dF1x+kRWq6ysHpkjDl+7eQjatYoOCDIZF3006U0unVSxIWTgTsI3HNP3soSJkFaflMDwL
	3OoHrph9YsPCJJ5466DyOGUHY3Epg2rWloUxnMjsNw7aw3AhMjwVhgW4HYm9FZaFQZ/bp6QeMRQe
	hhHehWKXGY7CAuSpW7MfKUZlAUqWdJ3DcbAAB3guZl9yKC4WYLfmT4muFtgVJwvQx7T2t0mnXK6J
	XlGGyAQvfNkaJ5JBmxnipubJ5HKDbJJsM0eY38QucSx5tJWTVHBwqDDZOzRNmn87fwDoyM4J2hRz
	NgAAACV0RVh0ZGF0ZTpjcmVhdGUAMjAyMy0wMi0xM1QxMzoxNTo1MCswMDowMKC8JaoAAAAldEVY
	dGRhdGU6bW9kaWZ5ADIwMjMtMDItMTNUMTM6MTU6NTArMDA6MDDR4Z0WAAAAKHRFWHRkYXRlOnRp
	bWVzdGFtcAAyMDIzLTAyLTEzVDEzOjE1OjUxKzAwOjAwIIO3fQAAAABJRU5ErkJggg=="></image>
	</svg>
</div>
<div class="mainHeading">Nhập OTP</div>
<div class="otpSubheading">Chúng tôi đã gửi mã xác minh đến email của bạn!</div>
  <div class="box">
  <input class="inputcheck" name="otp1" type="number" maxlength="1">
  <input class="inputcheck" name="otp2" type="number" maxlength="1"> 
  <input class="inputcheck" name="otp3" type="number" maxlength="1">
  <input class="inputcheck" name="otp4" type="number" maxlength="1">
  </div>
  <div class="btn33" id="countdown">Thời gian còn lại: 03:00</div>
  <button type="submit" class="btn11">Submit</button>
  <button class="btn22" onclick="goBack()">Back</button>

</form>

<div id="toast1"></div>
<script src="{{ asset('js/formvalidation.js') }}"></script>
</body>
</html>
<script>	
 document.querySelectorAll('.inputcheck').forEach((input, index, inputArray) => {
  input.addEventListener('input', (e) => {
    if (input.value.length > 1) {
      input.value = input.value[0]; // chỉ cho phép một ký tự
    }
    if (input.value.length === 1) {
      const next = input.nextElementSibling;
      if (next && next.classList.contains('inputcheck')) {
        next.focus();
      }
    }
  });

  input.addEventListener('keydown', (e) => {
    if (e.key === 'Backspace' && input.value.length === 0) {
      const prev = input.previousElementSibling;
      if (prev && prev.classList.contains('inputcheck')) {
        prev.focus();
      }
    }
  });
});
    let timeLeft = 180; // Thời gian bắt đầu (tính bằng giây)
    const countdownElement = document.getElementById('countdown');

    const countdown = setInterval(() => {
      // Tính toán số phút và giây còn lại
      let minutes = Math.floor(timeLeft / 60);
      let seconds = timeLeft % 60;

      // Hiển thị thời gian còn lại
      countdownElement.innerText = `Thời gian còn lại: ${minutes < 10 ? '0' : ''}${minutes}:${seconds < 10 ? '0' : ''}${seconds}`;

      timeLeft--;

      // Nếu hết thời gian, dừng bộ đếm ngược
      if (timeLeft < 0) {
        clearInterval(countdown);
        countdownElement.innerText = 'Hết thời gian!';
      }
    }, 1000);
    $(document).ready(function() {
    $('.Create-form').submit(function(event) {
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
            // Vô hiệu hóa nút submit
           
            $.ajax({
                type: 'POST',
                url: url,
                data: formData,
                success: function(response) {
                    if (response.success === true) {    
                        var message=""            
                        showSuccessToast1();
                        setTimeout(function() {
                            window.location.href = "/ForgotPasswordNew/addview";
                        }, 1000);
                    } else {        
                        showErrorToast1();
                        // Kích hoạt lại nút submit nếu có lỗi
                       
                    }
                },
                error: function() {
                    // Kích hoạt lại nút submit nếu có lỗi
                   
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
          message: "Mã Xác Thực Không Chính Xác!",
          type:"error",
          duration:2000
      })
    }
	    
    function showSuccessToast1(){
      toast1({
        title: "Success",
        message: "Mã Xác Thực Thành Công!",
        type:"success",
        duration:2000
      })
    }
// trã về đường dẫn trước đó
function goBack() {
  window.history.back();
}
</script>