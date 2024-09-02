@extends('layouts/layoutAdmin')
@section('content')
<style>
  .background-image {
    /* Đặt chiều cao của div */
    background-image: url('/img/DHCT-khu3-05.jpg');
    background-size: cover; /* Để hình ảnh phủ kín div */
    background-position: center; /* Căn giữa hình ảnh trong div */
    background-repeat: no-repeat; /* Không lặp lại hình ảnh */
}


</style>

<div class="background-image">
<div class="col" style="height:100vh;display:flex;flex-direction:column;align-items: center;justify-content: center;">
<!-- <i style="font-size:100px;color:#132644" class="fa-solid fa-house-user"></i> -->
</div>
</div>

@endsection
