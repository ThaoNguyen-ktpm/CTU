<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lỗi 403: org_internal</title>
    <link rel="stylesheet" href="{{ asset('css/error.css') }}">
    <script src="https://cdn.tailwindcss.com"></script>

</head>
<body>
<div class="flex items-center justify-center h-screen bg-gray-200">
<div class="card">
  <div class="header">
    <div class="image"><svg aria-hidden="true" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" fill="none">
                <path d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" stroke-linejoin="round" stroke-linecap="round"></path>
              </svg></div>
    <div class="content">
       <span class="title">Thông Báo</span>
       @if(isset($email))
       <div class="text-email">{{ $email }}</div>
    @endif 
       <p class="message">Chặn truy cập: Bạn không thuộc người của Trung tâm Ngoại ngữ - Tin học !</p>
    </div>
     <div >
     <button  id="cancelButton" class="cancel cssbuttons-io-button mx-auto">
  Cancel
  <div class="icon">
    <svg
      height="24"
      width="24"
      viewBox="0 0 24 24"
      xmlns="http://www.w3.org/2000/svg"
    >
      <path d="M0 0h24v24H0z" fill="none"></path>
      <path
        d="M16.172 11l-5.364-5.364 1.414-1.414L20 12l-7.778 7.778-1.414-1.414L16.172 13H4v-2z"
        fill="currentColor"
      ></path>
    </svg>
  </div>
</button>
    </div>
  </div>
  </div>
</div>
</body>
</html>
<script>
    // Detect F5 key press
document.addEventListener("keydown", (e) => {
    if (e.key === "F5") {
        e.preventDefault(); // Prevent the default F5 action
        window.location.href = "{{ route('Login') }}"; // Redirect to the 'Login' route
    }
});
    document.getElementById("cancelButton").addEventListener("click", function() {
        window.location.href = "{{ route('Login') }}";
    });
</script>
<script>
  history.pushState(null, "", "{{ route('Login') }}");
</script>