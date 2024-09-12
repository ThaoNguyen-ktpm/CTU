<style>
 /* Danh sách thông báo */
 #notification-list {
    list-style: none;
    padding: 0;
    margin: 0;
    max-height: 392px; /* Giới hạn chiều cao để hiển thị 3 thông báo */
    overflow-y: auto; /* Thêm thanh cuộn dọc khi nội dung vượt quá chiều cao */
   
    border-radius: 5px; /* Bo tròn các góc */
    background-color: #f7e7cf; /* Màu nền */
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); /* Đổ bóng */
}

#notification-list .thethongbao {
    height: 120px;
    overflow: hidden;
    padding: 10px;
    margin: 10px;
    border: 1px solid #cdcdcd;
    border-radius: 10px; /* Bo góc thêm để tạo cảm giác mềm mại */
    background-color: #f3efea; /* Màu nền trắng để tăng độ tương phản */
    display: -webkit-box;
    -webkit-box-orient: vertical;
    -webkit-line-clamp: 2;
    line-clamp: 2;
    text-overflow: ellipsis;
    cursor: pointer;
    position: relative;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); /* Tăng độ lớn của shadow */
    transition: transform 0.3s ease, box-shadow 0.3s ease; /* Thêm hiệu ứng chuyển đổi */
}

#notification-list .thethongbao:hover {
    transform: translateY(-5px); /* Di chuyển mục lên trên một chút khi hover */
    box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2); /* Tăng kích thước và độ mờ của shadow khi hover */
    background-color: #f1f1f1; /* Thay đổi màu nền khi hover để tạo hiệu ứng nổi */
}

#notification-list .thethongbao > div {
    overflow: hidden;
    text-overflow: ellipsis;
    display: -webkit-box;
    -webkit-box-orient: vertical;
    -webkit-line-clamp: 2;
    line-clamp: 2;
    white-space: normal;
    font-style: italic;
}

#notification-list .thethongbao > div:first-child {
    font-weight: bold;
    margin-bottom: 5px;
    color: #898989;
}

.thethongbao div {
    flex: 1;
}

.thethongbao div:last-child {
    text-align: right;
    color: #007bff;
    cursor: pointer;
}

/* Overlay che màn hình khi hiển thị popup */
#overlay22 {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    z-index: 999;
}

/* Popup chứa nội dung */
#popup22 {
    display: none;
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 80%;
    max-width: 500px;
    padding: 20px;
    background-color: #e9e7e7;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
    z-index: 1000;
}

/* Nút đóng nằm ở góc phải */
#popup22 #close-popup {
    position: absolute;
    top: 10px;
    right: 10px;
    background-color: #ff3b3b;
    color: white;
    border: none;
    padding: 8px 12px;
    border-radius: 4px;
    cursor: pointer;
    font-size: 14px;
    transition: background-color 0.3s ease;
}

/* Hiệu ứng khi hover nút đóng */
#popup22 #close-popup:hover {
    background-color: #ff6666;
}

/* Nội dung bên trong popup */
#popup22 #popup-content {
    margin-top: 40px; /* Tạo khoảng cách giữa nội dung và nút đóng */
    font-size: 16px;
    color: #333;
}


.div_noidung {
    border: 1px solid #ddd; /* Viền nhẹ nhàng */
    border-radius: 8px; /* Bo góc viền */
    padding: 15px; /* Khoảng cách bên trong */
    background-color: #f9f9f9; /* Màu nền nhẹ nhàng */
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); /* Đổ bóng nhẹ */
    margin-bottom: 10px; /* Khoảng cách giữa các phần tử */
    font-size: 14px; /* Kích thước chữ */
    color: #333; /* Màu chữ */
    line-height: 1.5; /* Khoảng cách dòng */
}


.delete-icon {
    position: absolute;

    right: 10px;
    transform: translateY(-30%);
    background: none;
    border: none;
  
    color: red; /* Màu sắc của biểu tượng xóa */
    font-size: 16px;
}


</style>
<div class="background-container1" style="height: 100px ;">
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
    <div style="display:flex;justify-content: space-between;">
        <div style="display: flex;">
            <a href="/Index"><div class="logo_header" style="z-index: 5;margin-left: 20px;"><img style="width:70px;z-index:5" src="{{ asset('img/logoCanTho.png') }}"></img></div>  
            </a>
              
            <div>
                <p style="z-index: 5; margin-left: 20px; margin-bottom: 0; color: #474747; font-size: 22px;    font-style: oblique;font-family: ui-serif;" class="text-weight">
                    Trung Tâm Công Nghệ Phần Mềm Đại Học Cần Thơ
                </p>
            </div>
          
        </div>
        <div style="display: flex;">
            <p style="margin-bottom:0; color: #474747; margin-right:10px; display:block ; font-size:16px;" class=" text-weight">{{ Session::get('sessionUser') }}</p>
            <div style="width:160px">
            <a href="/LogoutAction">
                <div class="logoutForm">
                <button class="Btn" style="margin-left: 5px;">
                <div class="sign"><svg viewBox="0 0 512 512"><path d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z"></path></svg></div>
                <div class="text" style="padding-left: 10px;">Đăng Xuất</div>
                </button>
                </div>
            </a>
            </div>
            <div class="notification-container">
            <i class="thongbao fa-solid fa-bell" style="display: block;background: aliceblue;"></i>
                <div class="notification-panel">
                @php
                    $ThongBao = session('ThongBao');
                @endphp

                @if ($ThongBao)
                <ul id="notification-list" >
                    @foreach($ThongBao as $ThongBao1)
                        <li class="thethongbao" draggable="true" data-id="{{ $ThongBao1->id }}"> 
                            <button class="delete-icon" data-id="{{ $ThongBao1->id }}">&#10006;</button>
                            <div>{{ \Carbon\Carbon::parse($ThongBao1->ThoiGian)->format(' H:i d-m-Y ') }}</div>
                            <div>{{ $ThongBao1->NoiDung }}</div>
                            <div class="xem-them" style="color: #007bff; " data-id="{{ $ThongBao1->id }}">Xem Thêm</div>
                            <meta name="csrf-token" content="{{ csrf_token() }}">
                        </li>
                    @endforeach
                </ul>
               
                @else
                    <p style="display: block;padding: 10px;margin-bottom: 0px;padding-left: 34px;background: aliceblue;" ><i class="fa-solid fa-circle-exclamation"></i>Không có thông báo !</p>
                @endif
                </div>
                <div id="notification-count" class="notification-count" ></div>
                <div id="overlay22" ></div>
                <div id="popup22"  style="  background-color: #f7e7cf;">
                    <button id="close-popup">Đóng</button>
                    <div id="popup-content"></div>
                </div >
            </div>
         
        </div>
    </div>
 
</div>


<script>document.querySelector('.thongbao').addEventListener('mouseenter', function() {
    document.querySelector('.notification-panel').style.display = 'block';
});

document.querySelector('.notification-container').addEventListener('mouseleave', function() {
    document.querySelector('.notification-panel').style.display = 'none';
});

document.addEventListener('DOMContentLoaded', (event) => {
    // Lấy các phần tử cần thiết
    const logoutButton = document.querySelector('.logoutForm');
    const notificationIcon = document.querySelector('.notification-container');

    // Khi hover vào phần tử đăng xuất
    logoutButton.addEventListener('mouseover', () => {
        notificationIcon.style.display = 'none'; // Ẩn icon thông báo
    });

    // Khi di chuột ra khỏi phần tử đăng xuất
    logoutButton.addEventListener('mouseout', () => {
        notificationIcon.style.display = 'inline-block'; // Hiển thị lại icon thông báo
    });
});



document.addEventListener("DOMContentLoaded", function() {
    var notifications = document.querySelectorAll('.thethongbao');
    var notificationCount = document.getElementById('notification-count');

    function updateNotificationCount() {
        var count = document.querySelectorAll('.thethongbao').length;
        if (count > 0) {
            notificationCount.textContent = count;
        } else {
            notificationCount.style.display = 'none';
        }
    }

    updateNotificationCount();

    notifications.forEach(function(notification) {
        notification.addEventListener('dragstart', function(e) {
            e.dataTransfer.setData('text/plain', null);
            e.target.classList.add('dragging');
        });

        notification.addEventListener('dragend', function(e) {
            e.target.classList.remove('dragging');
        });

        notification.addEventListener('dragover', function(e) {
            e.preventDefault();
        });

      
        

        // Sự kiện click cho biểu tượng xóa
        var deleteIcon = notification.querySelector('.delete-icon');
        deleteIcon.addEventListener('click', function() {
            var notificationId = deleteIcon.dataset.id;

            fetch(`/thongbao/${notificationId}`, {
                method: 'post',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    notification.remove();
                    updateNotificationCount();
                } else {
                    alert(data.message || 'Có lỗi xảy ra khi xóa thông báo.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Có lỗi xảy ra khi xóa thông báo.');
            });
        });
    });

    document.addEventListener('dragover', function(e) {
        e.preventDefault();
    });

    document.addEventListener('drop', function(e) {
        e.preventDefault();
        var draggingElement = document.querySelector('.dragging');
        if (draggingElement && !e.target.closest('#notification-list')) {
            var notificationId = draggingElement.dataset.id;

            fetch(`/thongbao/${notificationId}`, {
                method: 'post',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    draggingElement.remove();
                    updateNotificationCount();
                } else {
                    alert(data.message || 'Có lỗi xảy ra khi xóa thông báo.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Có lỗi xảy ra khi xóa thông báo.');
            });
        }
    });
});



document.querySelectorAll('.xem-them').forEach(function (button) {
    button.addEventListener('click', function (e) {
        e.stopPropagation();
        const thongBaoElement = this.closest('.thethongbao');
        const id = thongBaoElement.dataset.id;
        const thoiGian = thongBaoElement.querySelector('div:nth-child(2)').textContent;
        const noiDung = thongBaoElement.querySelector('div:nth-child(3)').textContent;

        // Ẩn tất cả các thông báo khác
        document.querySelectorAll('.thethongbao').forEach(function (thongBao) {
            thongBao.style.display = 'none';
        });

        // Hiển thị nội dung trong popup
        const popupContent = document.getElementById('popup-content');
        popupContent.innerHTML = `
            <h2>Thông Báo</h2>
            <div class="div_noidung" style="background-color: #f3efea;">
            <div  style="font-style: italic;font-size: 16px;  text-indent: 10px; ">${noiDung}</div>
            </div>
        `;

        // Hiển thị popup
        document.getElementById('popup22').style.display = 'block';
        document.getElementById('overlay22').style.display = 'block';
     
        // Xử lý sự kiện click để đóng popup
        document.getElementById('close-popup').addEventListener('click', function () {
            document.getElementById('popup22').style.display = 'none';
            document.getElementById('overlay22').style.display = 'none';

            // Hiển thị lại tất cả các thông báo khác sau khi đóng popup
            document.querySelectorAll('.thethongbao').forEach(function (thongBao) {
                thongBao.style.display = 'block';
            });
        });

        document.getElementById('overlay22').addEventListener('click', function () {
            document.getElementById('popup22').style.display = 'none';
            document.getElementById('overlay22').style.display = 'none';

            // Hiển thị lại tất cả các thông báo khác sau khi đóng popup
            document.querySelectorAll('.thethongbao').forEach(function (thongBao) {
                thongBao.style.display = 'block';
            });
        });

        console.log('ID thông báo:', id);
    });
});


</script>
