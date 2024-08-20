@extends('layouts/layoutIndex')
@section('content')
<div>
    <h2>Nhận Công Việc</h2>
    <div id="NhanCongViec">   
        <div class="wrapper1">
        <i id="left" class="fa-solid fa-angle-left"></i>
        <ul class="carousel">
        @foreach($NhanViec as $NhanViec1)
        <li class="card">
            <span class="overlay1"></span>
            <h2> {{$NhanViec1->TenCongViec}} </h2>
            <p class="description"></p>
            <p>{{ \Carbon\Carbon::parse($NhanViec1->NgayBatDau)->format('d-m-Y') }} Đến {{ \Carbon\Carbon::parse($NhanViec1->NgayKetThuc)->format('d-m-Y') }}</p>

           <form class="nhan-cong-viec-form" data-id="{{ $NhanViec1->id }}" method="POST">
            <!-- <form class="nhan-cong-viec-form" data-id="{{ $NhanViec1->id }}" method="POST"> -->
                @csrf 
                <button class="button" type="submit">Xem Chi Tiết</button>
            </form>
        </li>
        @endforeach
        </ul>
        <i id="right" class="fa-solid fa-angle-right"></i>
        </div>
    </div>
</div>


<div>
    <h2>Đang Thực Hiện</h2>
    <div id="DangThucHien">
    <div class="slide-container swiper">
    <div class="slide-content">
      <div class="card-wrapper swiper-wrapper">
        @foreach($DangThucHien as $DangThucHien1)
        <div class="card swiper-slide">
          <div class="image-content">
            <span class="overlay"></span>
          </div>
          <div class="card-content">
            <h2 class="name">{{$DangThucHien1->TenCongViec}}</h2>
            <p class="description"></p>
            <p>{{ \Carbon\Carbon::parse($DangThucHien1->NgayBatDau)->format('d-m-Y') }} Đến {{ \Carbon\Carbon::parse($DangThucHien1->NgayKetThuc)->format('d-m-Y') }}</p>
            <button class="button">Xem Tiến Độ</button>
          </div>
        </div>
        @endforeach
      </div>
    </div>
    <div class="swiper-button-next swiper-navBtn"></div>
    <div class="swiper-button-prev swiper-navBtn"></div>
    <div class="swiper-pagination"></div>
  </div>
</div>
</div>


<div>
    <h2> Hoàn Thành</h2>
    <div id="HoanThanh">
        <div id="formList">
        <div id="list">
            <div class="item">
                <div class="content">
                <span class="overlay1"></span>
                    <table width="100%" cellspacing="0" style="margin-top: 15px;">
                        <tr>
                            <td>Tên</td>
                            <td>Nami</td>
                        </tr>
                        <tr>
                            <td>Nghề nghiệp</td>
                            <td>Hoa tiêu</td>
                        </tr>
                        <tr>
                            <td>Sức mạnh</td>
                            <td>Ăn hiếp đồng đội</td>
                        </tr>
                        <tr>
                            <td colspan="2" class="nameGroup">Thành viên băng Mũ Rơm</td>
                        </tr>
                    </table>
                    <button class="button">View More</button>
                </div>
            </div>
            <div class="item">
                <div class="content">
                <span class="overlay1"></span>
                    <table width="100%" cellspacing="0" style="margin-top: 15px;">
                        <tr>
                            <td>Tên</td>
                            <td>Nami</td>
                        </tr>
                        <tr>
                            <td>Nghề nghiệp</td>
                            <td>Hoa tiêu</td>
                        </tr>
                        <tr>
                            <td>Sức mạnh</td>
                            <td>Ăn hiếp đồng đội</td>
                        </tr>
                        <tr>
                            <td colspan="2" class="nameGroup">Thành viên băng Mũ Rơm</td>
                        </tr>
                    </table>
                    <button class="button">View More</button>
                </div>
            </div>
            <div class="item">
                <div class="content">
                <span class="overlay1"></span>
                    <table width="100%" cellspacing="0" style="margin-top: 15px;">
                        <tr>
                            <td>Tên</td>
                            <td>Nami</td>
                        </tr>
                        <tr>
                            <td>Nghề nghiệp</td>
                            <td>Hoa tiêu</td>
                        </tr>
                        <tr>
                            <td>Sức mạnh</td>
                            <td>Ăn hiếp đồng đội</td>
                        </tr>
                        <tr>
                            <td colspan="2" class="nameGroup">Thành viên băng Mũ Rơm</td>
                        </tr>
                    </table>
                    <button class="button">View More</button>
                </div>
            </div>
            <div class="item">
                <div class="content">
                <span class="overlay1"></span>
                    <table width="100%" cellspacing="0" style="margin-top: 15px;">
                        <tr>
                            <td>Tên</td>
                            <td>Nami</td>
                        </tr>
                        <tr>
                            <td>Nghề nghiệp</td>
                            <td>Hoa tiêu</td>
                        </tr>
                        <tr>
                            <td>Sức mạnh</td>
                            <td>Ăn hiếp đồng đội</td>
                        </tr>
                        <tr>
                            <td colspan="2" class="nameGroup">Thành viên băng Mũ Rơm</td>
                        </tr>
                    </table>
                    <button class="button">View More</button>
                </div>
            </div>
            <div class="item">
                <div class="content">
                <span class="overlay1"></span>
                    <table width="100%" cellspacing="0" style="margin-top: 15px;">
                        <tr>
                            <td>Tên</td>
                            <td>Nami</td>
                        </tr>
                        <tr>
                            <td>Nghề nghiệp</td>
                            <td>Hoa tiêu</td>
                        </tr>
                        <tr>
                            <td>Sức mạnh</td>
                            <td>Ăn hiếp đồng đội</td>
                        </tr>
                        <tr>
                            <td colspan="2" class="nameGroup">Thành viên băng Mũ Rơm</td>
                        </tr>
                    </table>
                    <button class="button">View More</button>
                </div>
            </div>
         
        </div>
    </div>
    <div class="direction">
        <button id="prev"> < </button>
        <button id="next"> > </button>
        </div>
    </div>
</div>


<div>
    <h2>Trễ Hẹn</h2>
    <div id="TreHen">
        <div id="formList1">
            <div id="list1">
                <div class="item1" style="position: relative;">
                    <span class="overlay1"></span>
                    <div class="content1">
                   
                        <table width="100%" cellspacing="0" style="margin-top: 15px;">
                            <tr>
                                <td>Tên</td>
                                <td>Nami</td>
                            </tr>
                            <tr>
                                <td>Nghề nghiệp</td>
                                <td>Hoa tiêu</td>
                            </tr>
                            <tr>
                                <td>Sức mạnh</td>
                                <td>Ăn hiếp đồng đội</td>
                            </tr>
                            <tr>
                                <td colspan="2" class="nameGroup1">Thành viên băng Mũ Rơm</td>
                            </tr>
                        </table>
                    </div>
                </div>
             
                <div class="item1" style="position: relative;">
                    <span class="overlay1"></span>
                    <div class="content1">
                   
                        <table width="100%" cellspacing="0" style="margin-top: 15px;">
                            <tr>
                                <td>Tên</td>
                                <td>Nami</td>
                            </tr>
                            <tr>
                                <td>Nghề nghiệp</td>
                                <td>Hoa tiêu</td>
                            </tr>
                            <tr>
                                <td>Sức mạnh</td>
                                <td>Ăn hiếp đồng đội</td>
                            </tr>
                            <tr>
                                <td colspan="2" class="nameGroup1">Thành viên băng Mũ Rơm</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="item1" style="position: relative;">
                    <span class="overlay1"></span>
                    <div class="content1">
                   
                        <table width="100%" cellspacing="0" style="margin-top: 15px;">
                            <tr>
                                <td>Tên</td>
                                <td>Nami</td>
                            </tr>
                            <tr>
                                <td>Nghề nghiệp</td>
                                <td>Hoa tiêu</td>
                            </tr>
                            <tr>
                                <td>Sức mạnh</td>
                                <td>Ăn hiếp đồng đội</td>
                            </tr>
                            <tr>
                                <td colspan="2" class="nameGroup1">Thành viên băng Mũ Rơm</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="item1" style="position: relative;">
                    <span class="overlay1"></span>
                    <div class="content1">
                   
                        <table width="100%" cellspacing="0" style="margin-top: 15px;">
                            <tr>
                                <td>Tên</td>
                                <td>Nami</td>
                            </tr>
                            <tr>
                                <td>Nghề nghiệp</td>
                                <td>Hoa tiêu</td>
                            </tr>
                            <tr>
                                <td>Sức mạnh</td>
                                <td>Ăn hiếp đồng đội</td>
                            </tr>
                            <tr>
                                <td colspan="2" class="nameGroup1">Thành viên băng Mũ Rơm</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="direction1">
            <button id="prev1"> < </button>
            <button id="next1"> > </button>
        </div>
    </div>
</div>


<script src="{{ asset('js/khung.js') }}"></script>

<script>
 $(document).ready(function() {
    $('.nhan-cong-viec-form').on('submit', function(e) {
        e.preventDefault(); // Ngăn chặn việc tải lại trang tự động

        var form = $(this);
        var id = form.data('id'); // Lấy ID công việc từ data-id trong form

        $.ajax({
            url: '/NhanCongViec/' + id,
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}', // Thêm CSRF token để bảo mật
            },
            success: function(response) {
                // Tải lại trang sau khi cập nhật thành công
                location.reload(); 
            },
          
        });
    });
});

</script>

@endsection
 