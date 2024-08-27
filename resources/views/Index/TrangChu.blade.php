@extends('layouts/layoutIndex')
@section('content')
@if(!empty($NhanViec) && count($NhanViec) > 0)
<div>
    <h2>Nhận Công Việc</h2>
    <div id="NhanCongViec">   
        <div class="wrapper1">
        <i id="left" style="font-size: 17px;" class="fa-solid fa-angle-left"></i>
        <ul class="carousel">
        @foreach($NhanViec as $NhanViec1)
        <li class="card" style="padding: 10px 25px ;  margin: 13px;">
            <span class="overlay1"></span>
            <table width="100%" cellspacing="0" style="margin-top: 55px;">
            <tr>
                <td style="font-size: 14px; text-align: left;font-family: monospace;">Tên Công Việc</td>
                <td style="font-size: 14px;text-align: right;font-family: monospace;">{{$NhanViec1->TenCongViec}}</td>
            </tr>
            <tr>
                <td style="font-size: 14px;text-align: left;">Thời Gian</td>
                <td style="font-size: 12px;text-align: right;">{{ \Carbon\Carbon::parse($NhanViec1->NgayBatDau)->format(' d-m-Y ') }} đến {{ \Carbon\Carbon::parse($NhanViec1->NgayKetThuc)->format(' d-m-Y ') }}
                </td>
            </tr>
            
            <tr>
                <td style="font-size: 14px;text-align: left;font-family: monospace;">Tài Liệu</td>
                <td style="font-size: 14px;text-align: right;font-family: monospace;"><a href="{{$NhanViec1->LinkTaiLieu}}" class="link-tai-lieu">link tài liệu</a></td>
            </tr>
            
        </table>
           <form  method="POST" action="/ChiTiet/CongViec/{{ $NhanViec1->id }}" novalidate>
                @csrf 
                <button class="button" type="submit">Xem Chi Tiết</button>
            </form>
        </li>
        @endforeach
        <li class="card" style="padding: 10px 25px ;  margin: 13px;">
            <span class="overlay1"></span>
            <table width="100%" cellspacing="0" style="margin-top: 55px;">
            <tr>
                <td style="font-size: 14px; text-align: left;font-family: monospace;">Tên Công Việc</td>
                <td style="font-size: 14px;text-align: right;font-family: monospace;">1231231</td>
            </tr>
            <tr>
                <td style="font-size: 14px;text-align: left;">Thời Gian</td>
                <td style="font-size: 12px;text-align: right;">123123123123123123123
                </td>
            </tr>
            
            <tr>
                <td style="font-size: 14px;text-align: left;font-family: monospace;">Tài Liệu</td>
                <td style="font-size: 14px;text-align: right;font-family: monospace;"><a href="" class="link-tai-lieu">link tài liệu</a></td>
            </tr>
            
        </table>
           <form  method="POST" action="/ChiTiet/CongViec/{{ $NhanViec1->id }}" novalidate>
                @csrf 
                <button class="button" type="submit">Xem Chi Tiết</button>
            </form>
        </li>
        <li class="card" style="padding: 10px 25px ;  margin: 13px;">
            <span class="overlay1"></span>
            <table width="100%" cellspacing="0" style="margin-top: 55px;">
            <tr>
                <td style="font-size: 14px; text-align: left;font-family: monospace;">Tên Công Việc</td>
                <td style="font-size: 14px;text-align: right;font-family: monospace;">1231231</td>
            </tr>
            <tr>
                <td style="font-size: 14px;text-align: left;">Thời Gian</td>
                <td style="font-size: 12px;text-align: right;">123123123123123123123
                </td>
            </tr>
            
            <tr>
                <td style="font-size: 14px;text-align: left;font-family: monospace;">Tài Liệu</td>
                <td style="font-size: 14px;text-align: right;font-family: monospace;"><a href="" class="link-tai-lieu">link tài liệu</a></td>
            </tr>
            
        </table>
           <form  method="POST" action="/ChiTiet/CongViec/{{ $NhanViec1->id }}" novalidate>
                @csrf 
                <button class="button" type="submit">Xem Chi Tiết</button>
            </form>
        </li>
        <li class="card" style="padding: 10px 25px ;  margin: 13px;">
            <span class="overlay1"></span>
            <table width="100%" cellspacing="0" style="margin-top: 55px;">
            <tr>
                <td style="font-size: 14px; text-align: left;font-family: monospace;">Tên Công Việc</td>
                <td style="font-size: 14px;text-align: right;font-family: monospace;">1231231</td>
            </tr>
            <tr>
                <td style="font-size: 14px;text-align: left;">Thời Gian</td>
                <td style="font-size: 12px;text-align: right;">123123123123123123123
                </td>
            </tr>
            
            <tr>
                <td style="font-size: 14px;text-align: left;font-family: monospace;">Tài Liệu</td>
                <td style="font-size: 14px;text-align: right;font-family: monospace;"><a href="" class="link-tai-lieu">link tài liệu</a></td>
            </tr>
            
        </table>
           <form  method="POST" action="/ChiTiet/CongViec/{{ $NhanViec1->id }}" novalidate>
                @csrf 
                <button class="button" type="submit">Xem Chi Tiết</button>
            </form>
        </li>
        </ul>
        <i id="right"  style="font-size: 17px;" class="fa-solid fa-angle-right"></i>
        </div>
    </div>
</div>
@endif
@if(!empty($DangThucHien) && count($DangThucHien) > 0)
<div>
    <h2>Đang Thực Hiện</h2>
    <div id="DangThucHien">
    <div class="slide-container swiper">
    <div class="slide-content">
      <div class="card-wrapper swiper-wrapper">
        @foreach($DangThucHien as $DangThucHien1)
        <div class="card swiper-slide" style=" height: 300px;">
          <div class="image-content">
            <span class="overlay"></span>
          </div>
          <div class="card-content">
          <table width="100%" cellspacing="0" >
            <tr>
                <td style="font-size: 14px; text-align: left;font-family: monospace;">Tên Công Việc</td>
                <td style="font-size: 14px;text-align: right;font-family: monospace;">{{$DangThucHien1->TenCongViec}}</td>
            </tr>
            <tr>
                <td style="font-size: 14px;text-align: left;">Thời Gian</td>
                <td style="font-size: 12px;text-align: right;">{{ \Carbon\Carbon::parse($DangThucHien1->NgayBatDau)->format(' d-m-Y ') }} đến {{ \Carbon\Carbon::parse($DangThucHien1->NgayKetThuc)->format(' d-m-Y ') }}
                </td>
            </tr>
            
            <tr>
                <td style="font-size: 14px;text-align: left;font-family: monospace;">Tài Liệu</td>
                <td style="font-size: 14px;text-align: right;font-family: monospace;"><a href="{{$DangThucHien1->LinkTaiLieu}}" class="link-tai-lieu">link tài liệu</a></td>
            </tr>
        </table>
         <form  method="POST" action="/CapNhatTienDo/CongViec/{{$DangThucHien1->id }}" novalidate>
                @csrf 
                <button class="button" type="submit">Cập Nhật Tiến Độ</button>
            </form>
          </div>
        </div>
        @endforeach

        <div class="card swiper-slide" style=" height: 300px;">
          <div class="image-content">
            <span class="overlay"></span>
          </div>
          <div class="card-content">
          <table width="100%" cellspacing="0" >
            <tr>
                <td style="font-size: 14px; text-align: left;font-family: monospace;">Tên Công Việc</td>
                <td style="font-size: 14px;text-align: right;font-family: monospace;">123123123123</td>
            </tr>
            <tr>
                <td style="font-size: 14px;text-align: left;">Thời Gian</td>
                <td style="font-size: 12px;text-align: right;">12312321312312312
                </td>
            </tr>
            
            <tr>
                <td style="font-size: 14px;text-align: left;font-family: monospace;">Tài Liệu</td>
                <td style="font-size: 14px;text-align: right;font-family: monospace;"><a href="" class="link-tai-lieu">link tài liệu</a></td>
            </tr>
        </table>
         <form  method="POST" action="/CapNhatTienDo/CongViec/{{$DangThucHien1->id }}" novalidate>
                @csrf 
                <button class="button" type="submit">Cập Nhật Tiến Độ</button>
            </form>
          </div>
        </div>

        <div class="card swiper-slide" style=" height: 300px;">
          <div class="image-content">
            <span class="overlay"></span>
          </div>
          <div class="card-content">
          <table width="100%" cellspacing="0" >
            <tr>
                <td style="font-size: 14px; text-align: left;font-family: monospace;">Tên Công Việc</td>
                <td style="font-size: 14px;text-align: right;font-family: monospace;">123123123123</td>
            </tr>
            <tr>
                <td style="font-size: 14px;text-align: left;">Thời Gian</td>
                <td style="font-size: 12px;text-align: right;">12312321312312312
                </td>
            </tr>
            
            <tr>
                <td style="font-size: 14px;text-align: left;font-family: monospace;">Tài Liệu</td>
                <td style="font-size: 14px;text-align: right;font-family: monospace;"><a href="" class="link-tai-lieu">link tài liệu</a></td>
            </tr>
        </table>
         <form  method="POST" action="/CapNhatTienDo/CongViec/{{$DangThucHien1->id }}" novalidate>
                @csrf 
                <button class="button" type="submit">Cập Nhật Tiến Độ</button>
            </form>
          </div>
        </div>

        <div class="card swiper-slide" style=" height: 300px;">
          <div class="image-content">
            <span class="overlay"></span>
          </div>
          <div class="card-content">
          <table width="100%" cellspacing="0" >
            <tr>
                <td style="font-size: 14px; text-align: left;font-family: monospace;">Tên Công Việc</td>
                <td style="font-size: 14px;text-align: right;font-family: monospace;">123123123123</td>
            </tr>
            <tr>
                <td style="font-size: 14px;text-align: left;">Thời Gian</td>
                <td style="font-size: 12px;text-align: right;">12312321312312312
                </td>
            </tr>
            
            <tr>
                <td style="font-size: 14px;text-align: left;font-family: monospace;">Tài Liệu</td>
                <td style="font-size: 14px;text-align: right;font-family: monospace;"><a href="" class="link-tai-lieu">link tài liệu</a></td>
            </tr>
        </table>
         <form  method="POST" action="/CapNhatTienDo/CongViec/{{$DangThucHien1->id }}" novalidate>
                @csrf 
                <button class="button" type="submit">Cập Nhật Tiến Độ</button>
            </form>
          </div>
        </div>


      </div>
    </div>
    <div class="swiper-button-next swiper-navBtn"></div>
    <div class="swiper-button-prev swiper-navBtn"></div>
    <div class="swiper-pagination"></div>
  </div>
</div>
</div>
@endif
@if(!empty($HoanThanh) && count($HoanThanh) > 0)
<div>
    <h2> Hoàn Thành</h2>
    <div id="HoanThanh">
        <div id="formList">
        <div id="list">
        @foreach($HoanThanh as $HoanThanh1)
            <div class="item">
                <div class="content">
                <span class="overlay1"></span>
                    <table width="100%" cellspacing="0" style="margin-top: 40px;">
                        <tr>
                            <td >Tên Công Việc</td>
                            <td>{{$HoanThanh1->TenCongViec}}</td>
                        </tr>
                        <tr>
                            <td>Hoàn Thành</td>
                            <td>{{ \Carbon\Carbon::parse($HoanThanh1->ThoiGian)->format(' H:i:s d-m-Y ') }}
                            </td>
                        </tr>
                        <tr>
                            <td>Tài Liệu</td>
                            <td><a href="{{$HoanThanh1->LinkTaiLieu}}" class="link-tai-lieu">link tài liệu</a></td>
                        </tr>
                    </table>
                    <form  method="POST" action="/ChiTietHoanThanh/CongViec/{{$HoanThanh1->id }}" novalidate>
                @csrf 
                <button class="button" type="submit">Xem Công Việc</button>
            </form>
                </div>
            </div>
        @endforeach
        </div>
    </div>
    <div class="direction">
        <button id="prev"> < </button>
        <button id="next"> > </button>
        </div>
    </div>
</div>
@endif
@if(!empty($TreHen) && count($TreHen) > 0)
<div>
    <h2>Trễ Hẹn</h2>
    <div id="TreHen">
        <div id="formList1">
            <div id="list1">
            @foreach($TreHen as $TreHen1)
                <div class="item1" style="position: relative;">
                    <span class="overlay1" style="height: 18%;"></span>
                    <div class="content1">
                    <table width="100%" cellspacing="0" style="margin-top: 40px;">
                    <tr>
                        <td style="font-size: 14px; text-align: left;font-family: monospace;">Tên Công Việc</td>
                        <td style="font-size: 14px;text-align: right;font-family: monospace;">{{$TreHen1->TenCongViec}}</td>
                    </tr>
                    <tr>
                        <td style="font-size: 14px;text-align: left;">Hết Hẹn</td>
                        <td style="font-size: 12px;text-align: right;"> {{ \Carbon\Carbon::parse($TreHen1->NgayKetThuc)->format(' d-m-Y ') }}
                        </td>
                    </tr>
                    <tr>
                        <td style="font-size: 14px;text-align: left;font-family: monospace;">Tài Liệu</td>
                        <td style="font-size: 14px;text-align: right;font-family: monospace;"><a href="{{$TreHen1->LinkTaiLieu}}" class="link-tai-lieu">link tài liệu</a></td>
                    </tr>
            
                    </table>
                    </div>
                </div>
                @endforeach    
            </div>
        </div>
        <div class="direction1">
            <button id="prev1"> < </button>
            <button id="next1"> > </button>
        </div>
    </div>
</div>
@endif

<script src="{{ asset('js/khung.js') }}"></script>


@endsection
 