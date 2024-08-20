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
            <div class="logo_header" style="z-index: 5;margin-left: 20px;"><img style="width:70px;z-index:5" src="{{ asset('img/logoCanTho.png') }}"></img></div>  
            <div><p style="z-index: 5;margin-left: 20px; margin-bottom:0; color: #474747 ;font-size: 22px;" class=" text-weight">Trung Tâm Công Nghệ Phần Mềm Đại Học Cần Thơ</p></div>
        </div>
        <div style="display: flex;">
            <p style="margin-bottom:0; color: #474747; margin-right:10px; display:block ; font-size:16px;" class=" text-weight">Nguyen Huynh Dang Khoa</p>
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
            <i class="thongbao fa-solid fa-bell" style="display: block;"></i>
                <div class="notification-panel">
                    <ul>
                        <li class="thethongbao">Thông báo 1</li>
                        <li class="thethongbao">Thông báo 2</li>
                        <li class="thethongbao">Thông báo 3</li>
                    </ul>
                </div>
                <div id="notification-count" class="notification-count"></div>
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
    // Lấy danh sách các phần tử thông báo
    var notifications = document.querySelectorAll('.thethongbao');
    
    // Đếm số lượng thông báo
    var count = notifications.length;
    
    // Lấy phần tử hiển thị số lượng thông báo
    var notificationCount = document.getElementById('notification-count');
    
    // Cập nhật số lượng thông báo
    if (count > 0) {
        notificationCount.textContent = count;
    } else {
        notificationCount.style.display = 'none';
    }
});

</script>
