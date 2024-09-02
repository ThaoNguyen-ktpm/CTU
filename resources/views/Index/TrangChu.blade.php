@extends('layouts/layoutIndex')
@section('content')
<style>
    .swiper-slide {
    flex-shrink: 0;
     width: 0px; 
   
}
    #menuButton {
    font-size: 24px;
    padding: 10px 15px;
    background-color: #333;
 
    color: #fff;
    margin-left: -25px;
    margin-right: -25px;
    left: 10px;
    z-index: 2;
}

.side-menu {
    height: 100%;
    width: 0;
    position: absolute;
    z-index: 100;
    top: 0;
    left: 0;
    background-color: #333;
    overflow-x: hidden;
    transition: 0.5s;
    padding-top: 60px;
}

.side-menu a:hover {
    background-color: #575757;
}

.side-menu .close-btn {
    position: absolute;
    top: 0;
    right: 20px;
    font-size: 36px;
    margin-left: 50px;
}
/* Đặt font chữ và các thuộc tính khác cho tất cả các thẻ <a> */
.side-menu a {
   
    color: #fff;
    display: block;
    transition: 0.3s;
}
.hienthiduan {
    font-size: 16px;
    color: #007bff;
    text-decoration: none;
    padding: 8px 12px;
    border-radius: 4px;
   
    transition: background-color 0.3s, color 0.3s;
}

/* Hiệu ứng khi hover */
.hienthiduan:hover {
    background-color: #007bff; /* Đổi màu nền khi hover */
    color: #ffffff;            /* Đổi màu chữ khi hover */
}


</style>
<div id="menuButton" onclick="toggleMenu()"><div style="margin-left: 20px; display:flex"><i class="fa-solid fa-bars"></i><div style="font-family: ui-serif;">Dự Án</div></div></div>

<!-- The sliding menu -->
<div id="sideMenu" class="side-menu">
    <a href="#" class="close-btn" onclick="toggleMenu()">&times;</a>
    @if(!empty($DuAn) && count($DuAn) > 0)
    @foreach($DuAn as $DuAn1)
        @foreach($DuAnAll as $DuAnAll1)
            @if($DuAn1->id == $DuAnAll1->id)
                <a class="hienthiduan" href="CongViec/DuAn/{{ $DuAn1->id }}"><i class="fa-solid fa-rectangle-list"></i> {{ $DuAnAll1->TenDuAn }}</a>
            @endif
        @endforeach
    @endforeach
@endif

</div>

<div class="main-content">
@if(!empty($NhanViec) && count($NhanViec) > 0)
<div class="anNhanCongViec">
    <h2>Nhận Công Việc</h2>
    <div id="NhanCongViec">   
        <div class="wrapper1">
        <i id="left" style="font-size: 17px;" class="fa-solid fa-angle-left"></i>
        <ul class="carousel">
        @foreach($NhanViec as $NhanViec1)
        <li class="card" style="padding: 10px 25px ;  margin: 13px;">
            <span class="overlay1" style="text-align: center;"><div style="color: aliceblue;font-variant-caps: all-petite-caps; font-size: 20px;  padding-top: 5px;">{{$NhanViec1->TenDuAn}}</div></span>
            <table width="100%" cellspacing="0" style="margin-top: 55px;">
            <tr>
                <td style="font-size: 14px; text-align: left;font-family: monospace;">Tên Công Việc</td>
                <td style="font-size: 14px;text-align: right;font-family: monospace; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; 
                    max-width: 180px">{{$NhanViec1->TenCongViec}}</td>
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
        </ul>
        <i id="right"  style="font-size: 17px;" class="fa-solid fa-angle-right"></i>
        </div>
    </div>
</div>
@endif
@if(!empty($DangThucHien) && count($DangThucHien) > 0)
<div class="anDangThucHien">
    <h2>Đang Thực Hiện</h2>
    <div id="DangThucHien">
    <div class="slide-container swiper">
    <div class="slide-content">
      <div class="card-wrapper swiper-wrapper">
        @foreach($DangThucHien as $DangThucHien1)
        <div class="card swiper-slide">
          <div class="image-content">
          <span class="overlay" style="text-align: center;"><div style=" padding-top: 5px;color: aliceblue;font-variant-caps: all-petite-caps;font-size: 20px;">{{$DangThucHien1->TenDuAn}}</div></span>
          </div>
          <div class="card-content">
          <table width="100%" cellspacing="0" >
            <tr>
                <td style="font-size: 14px; text-align: left;font-family: monospace;">Tên Công Việc</td>
                <td style="font-size: 14px;text-align: right;font-family: monospace; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; 
                    max-width: 180px">{{$DangThucHien1->TenCongViec}}</td>
            </tr>
            <tr>
                <td style="font-size: 14px;text-align: left;">Thời Gian</td>
                <td style="font-size: 12px;text-align: right;">{{ \Carbon\Carbon::parse($DangThucHien1->NgayBatDau)->format(' d-m-Y ') }} đến {{ \Carbon\Carbon::parse($DangThucHien1->NgayKetThuc)->format(' d-m-Y ') }}
                </td>
            </tr>
            
            <tr>
                <td style="font-size: 14px;text-align: left;font-family: monospace;">Tiến Độ</td>
                <td style="font-size: 14px;text-align: right;font-family: monospace;">
                    {{ $DangThucHien1->TienDo ?? 0 }} %
                </td>

            </tr>
        </table>
        <form method="POST" action="/CapNhatTienDo/CongViec/{{$DangThucHien1->id}}/{{$DangThucHien1->idcapnhattiendo ?? 'null'}}" novalidate>
                @csrf 
                <button class="button" type="submit">Cập Nhật Tiến Độ</button>
            </form>
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
@endif
@if(!empty($HoanThanh) && count($HoanThanh) > 0)
<div class="anHoanThanh">
    <h2> Hoàn Thành</h2>
    <div id="HoanThanh">
        <div id="formList">
        <div id="list">
        @foreach($HoanThanh as $HoanThanh1)
            <div class="item">
                <div class="content">
                <span class="overlay1" style="text-align: center;"><div style="padding-top: 5px;color: aliceblue;font-variant-caps: all-petite-caps;font-size: 20px;  font-family: Arial, sans-serif;">{{$HoanThanh1->TenDuAn}}</div></span>
       
                    <table width="100%" cellspacing="0" style="margin-top: 40px;">
                        <tr>
                            <td >Tên Công Việc</td>
                            <td style="  white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 180px">{{$HoanThanh1->TenCongViec}}</td>
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
<div class="anTreHen">
    <h2>Trễ Hẹn</h2>
    <div id="TreHen">
        <div id="formList1">
            <div id="list1">
            @foreach($TreHen as $TreHen1)
                <div class="item1" style="position: relative;">
                    <span class="overlay1" style="height: 17%;text-align: center;"><div style=" padding-top: 5px;color: aliceblue;font-variant-caps: all-petite-caps;font-size: 20px;  font-family: Arial, sans-serif;">{{$TreHen1->TenDuAn}}</div></span>
                    <div class="content1">
                    <table width="100%" cellspacing="0" style="margin-top: 40px;">
                    <tr>
                        <td style="font-size: 14px; text-align: left;font-family: monospace;">Tên Công Việc</td>
                        <td style="font-size: 14px;text-align: right;font-family: monospace; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; 
                    max-width: 180px">{{$TreHen1->TenCongViec}}</td>
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
</div>


<script src="{{ asset('js/khung.js') }}"></script>

<script>
    function toggleMenu() {
    var sideMenu = document.getElementById("sideMenu");
    if (sideMenu.style.width === "250px") {
        sideMenu.style.width = "0";
    } else {
        sideMenu.style.width = "250px";
    }
}


document.querySelectorAll('.hienthiduan').forEach(function(element) {
    element.addEventListener('click', function(event) {
        event.preventDefault(); // Ngăn chặn việc tải lại trang

        var duAnId = this.getAttribute('href').split('/').pop(); // Lấy ID dự án từ URL

        // Tạo 4 yêu cầu fetch khác nhau
        let fetchNhanCongViec = fetch('/NhanCongViec/DuAn/' + duAnId, {
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
            }
        });

        let fetchDangThucHien = fetch('/DangThucHien/DuAn/' + duAnId, {
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
            }
        });

        let fetchHoanThanh = fetch('/HoanThanh/DuAn/' + duAnId, {
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
            }
        });

        let fetchTreHen = fetch('/TreHen/DuAn/' + duAnId, {
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
            }
        });

        // Sử dụng Promise.all để đợi tất cả các yêu cầu hoàn tất
        Promise.all([fetchNhanCongViec, fetchDangThucHien, fetchHoanThanh, fetchTreHen])
            .then(function(responses) {
                // Kiểm tra từng phản hồi để phát hiện lỗi
                responses.forEach((response, index) => {
                    if (!response.ok) {
                        console.error(`Error in fetch request ${index + 1}: ${response.statusText}`);
                        throw new Error(`Fetch failed for request ${index + 1} with status: ${response.status}`);
                    }
                });

                return Promise.all(responses.map(response => response.json()));
            })
            .then(function(dataArray) {
                // Mảng `dataArray` chứa kết quả từ 4 yêu cầu
                let nhanCongViecData = dataArray[0];
                let dangThucHienData = dataArray[1];
                let hoanThanhData = dataArray[2];
                let treHenData = dataArray[3];

                // Update UI với dữ liệu từ các fetch
                let nhanCongViecDiv = document.querySelector('.anNhanCongViec');
                if (nhanCongViecDiv) { // Kiểm tra nếu phần tử tồn tại
                    if (!nhanCongViecData || nhanCongViecData.length === 0) {
                        nhanCongViecDiv.style.display = 'none';
                    } else {
                        updateNhanCongViec(nhanCongViecData);
                        nhanCongViecDiv.style.display = 'block';
                    }
                }

                let dangThucHienDiv = document.querySelector('.anDangThucHien');
                if (dangThucHienDiv) { // Kiểm tra nếu phần tử tồn tại
                    if (!dangThucHienData || dangThucHienData.length === 0) {
                        dangThucHienDiv.style.display = 'none';
                    } else {
                        updateDangThucHien(dangThucHienData);
                        dangThucHienDiv.style.display = 'block';
                    }
                }

                let hoanThanhDiv = document.querySelector('.anHoanThanh');
                if (hoanThanhDiv) { // Kiểm tra nếu phần tử tồn tại
                    if (!hoanThanhData || hoanThanhData.length === 0) {
                        hoanThanhDiv.style.display = 'none';
                    } else {
                        updateHoanThanh(hoanThanhData);
                        hoanThanhDiv.style.display = 'block';
                    }
                }

                let treHenDiv = document.querySelector('.anTreHen');
                if (treHenDiv) { // Kiểm tra nếu phần tử tồn tại
                    if (!treHenData || treHenData.length === 0) {
                        treHenDiv.style.display = 'none';
                    } else {
                        updateTreHen(treHenData);
                        treHenDiv.style.display = 'block';
                    }
                }

            })
            .catch(function(error) {
                console.error('Error during fetching data:', error);
            });
    });
});



function updateNhanCongViec(data) {
    var nhanCongViecDiv = document.getElementById('NhanCongViec');
    var carouselUl = nhanCongViecDiv.querySelector('.carousel');
    
    // Xóa các công việc hiện tại
    carouselUl.innerHTML = '';

    // Thêm các công việc mới
    data.forEach(function(nhanViec) {
        var li = document.createElement('li');
        li.classList.add('card');
        li.style.padding = '10px 25px';
        li.style.margin = '13px';
        
        li.innerHTML = `
            <span class="overlay1" style="text-align: center;"><div style=" padding-top: 5px;color: aliceblue;font-variant-caps: all-petite-caps; font-size: 20px;">${nhanViec.TenDuAn}</div></span>
         
            <table width="100%" cellspacing="0" style="margin-top: 55px;">
                <tr>
                    <td style="font-size: 14px; text-align: left;font-family: monospace;">Tên Công Việc</td>
                    <td style="font-size: 14px;text-align: right;font-family: monospace; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 180px">${nhanViec.TenCongViec}</td>
                </tr>
                <tr>
                    <td style="font-size: 14px;text-align: left;">Thời Gian</td>
                   <td style="font-size: 12px;text-align: right;">${new Date(nhanViec.NgayBatDau).toLocaleDateString('vi-VN')} đến ${new Date(nhanViec.NgayKetThuc).toLocaleDateString('vi-VN')}</td>
                  </tr>
                <tr>
                    <td style="font-size: 14px;text-align: left;font-family: monospace;">Tài Liệu</td>
                    <td style="font-size: 14px;text-align: right;font-family: monospace;"><a href="${nhanViec.LinkTaiLieu}" class="link-tai-lieu">link tài liệu</a></td>
                </tr>
            </table>
            <form  method="POST" action="/ChiTiet/CongViec/${nhanViec.id}" novalidate>
              @csrf 
                <button class="button" type="submit">Xem Chi Tiết</button>
            </form>
        `;

        carouselUl.appendChild(li);
    });
}

function updateDangThucHien(data) {
    var dangThucHienDiv = document.getElementById('DangThucHien');
    
    // Kiểm tra nếu dangThucHienDiv không tồn tại
    if (!dangThucHienDiv) {
        console.error("Element with id 'DangThucHien' not found in the DOM.");
        return;
    }

    var slideContentDiv = dangThucHienDiv.querySelector('.card-wrapper');
    
    // Kiểm tra nếu slideContentDiv không tồn tại
    if (!slideContentDiv) {
        console.error("Element with class 'card-wrapper' not found within 'DangThucHien'.");
        return;
    }

    // Xóa các công việc hiện tại
    slideContentDiv.innerHTML = '';

    // Thêm các công việc mới
    data.forEach(function(dangThucHien) {
        var div = document.createElement('div');
        div.classList.add('card', 'swiper-slide');

        div.innerHTML = `
            <div class="image-content">
                <span class="overlay" style="text-align: center;">
                    <div style="padding-top: 5px;color: aliceblue;font-variant-caps: all-petite-caps;font-size: 20px;">
                        ${dangThucHien.TenDuAn}
                    </div>
                </span>
            </div>
            <div class="card-content">
                <table width="100%" cellspacing="0">
                    <tr>
                        <td style="font-size: 14px; text-align: left;font-family: monospace;">Tên Công Việc</td>
                        <td style="font-size: 14px;text-align: right;font-family: monospace; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 180px">
                            ${dangThucHien.TenCongViec}
                        </td>
                    </tr>
                    <tr>
                        <td style="font-size: 14px;text-align: left;">Thời Gian</td>
                        <td style="font-size: 12px;text-align: right;">
                            ${new Date(dangThucHien.NgayBatDau).toLocaleDateString('vi-VN')} đến ${new Date(dangThucHien.NgayKetThuc).toLocaleDateString('vi-VN')}
                        </td>
                    </tr>
                    <tr>
                        <td style="font-size: 14px;text-align: left;font-family: monospace;">Tiến Độ</td>
                        <td style="font-size: 14px;text-align: right;font-family: monospace;">
                            ${dangThucHien.TienDo ?? 0} %
                        </td>
                    </tr>
                </table>
                <form method="POST" action="/CapNhatTienDo/CongViec/${dangThucHien.id}/${dangThucHien.idcapnhattiendo ?? 'null'}" novalidate>
                    @csrf 
                    <button class="button" type="submit">Cập Nhật Tiến Độ</button>
                </form>
            </div>
        `;

        slideContentDiv.appendChild(div);
    });
}


function updateHoanThanh(data) {
    var hoanThanhDiv = document.getElementById('HoanThanh');
    var listDiv = hoanThanhDiv.querySelector('#list');

    // Xóa các công việc hiện tại
    listDiv.innerHTML = '';

    // Thêm các công việc mới
    data.forEach(function(hoanThanh) {
        var div = document.createElement('div');
        div.classList.add('item');

        div.innerHTML = `
            <div class="content">
                <span class="overlay1" style="text-align: center;"><div style=" padding-top: 5px;color: aliceblue;font-variant-caps: all-petite-caps;font-size: 20px;  font-family: Arial, sans-serif;">${hoanThanh.TenDuAn}</div></span>
                <table width="100%" cellspacing="0" style="margin-top: 40px;">
                    <tr>
                        <td>Tên Công Việc</td>
                        <td style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 180px">${hoanThanh.TenCongViec}</td>
                    </tr>
                    <tr>
                        <td>Hoàn Thành</td>
                        <td>${hoanThanh.ThoiGian}</td>
                    </tr>
                    <tr>
                        <td>Tài Liệu</td>
                        <td><a href="${hoanThanh.LinkTaiLieu}" class="link-tai-lieu">link tài liệu</a></td>
                    </tr>
                </table>
                <form method="POST" action="/ChiTietHoanThanh/CongViec/${hoanThanh.id}" novalidate>
                  @csrf 
                    <button class="button" type="submit">Xem Công Việc</button>
                </form>
            </div>
        `;

        listDiv.appendChild(div);
    });
}

function updateTreHen(data) {
    var treHenDiv = document.getElementById('TreHen');
    var listDiv = treHenDiv.querySelector('#list1');

    // Xóa các công việc hiện tại
    listDiv.innerHTML = '';

    // Thêm các công việc mới
    data.forEach(function(treHen) {
        var div = document.createElement('div');
        div.classList.add('item1');
        div.style.position = 'relative';

        div.innerHTML = `
            <span class="overlay1" style="height: 17%;text-align: center;"><div style="  padding-top: 5px;color: aliceblue;font-variant-caps: all-petite-caps;font-size: 20px;  font-family: Arial, sans-serif;">${treHen.TenDuAn}</div></span>
            <div class="content1">
                <table width="100%" cellspacing="0" style="margin-top: 40px;">
                    <tr>
                        <td style="font-size: 14px; text-align: left;font-family: monospace;">Tên Công Việc</td>
                        <td style="font-size: 14px;text-align: right;font-family: monospace; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 180px">${treHen.TenCongViec}</td>
                    </tr>
                    <tr>
                        <td style="font-size: 14px;text-align: left;">Hết Hẹn</td>
                        <td style="font-size: 12px;text-align: right;">${treHen.NgayKetThuc}</td>
                    </tr>
                    <tr>
                        <td style="font-size: 14px;text-align: left;font-family: monospace;">Tài Liệu</td>
                        <td style="font-size: 14px;text-align: right;font-family: monospace;"><a href="${treHen.LinkTaiLieu}" class="link-tai-lieu">link tài liệu</a></td>
                    </tr>
                </table>
            </div>
        `;

        listDiv.appendChild(div);
    });
}




</script>
@endsection
 