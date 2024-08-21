<link rel="stylesheet" href="{{ asset('css/listAdmin.css') }}">
    <!-- Sidebar -->
    <div id="sidebar-container" class="sidebar-expanded d-none d-md-block"><!-- d-* hiddens the Sidebar in smaller devices. Its itens can be kept on the Navbar 'Menu' -->
        <!-- Bootstrap List Group -->
        <ul class="list-group">
            <!-- Separator with title -->
            @if (Session::has('sessionUser'))
                <li class="list-group-item sidebar-separator-title text-muted d-flex align-items-center menu-collapsed">
                    <span class="welcome-user-text"><i class="fa-solid fa-user-shield"></i> Welcome {{ Session::get('sessionUser') }} {{ Session::get('sessionUserId') }}</span>
                </li>          
            @endif
            <li class="list-group-item sidebar-separator-title text-muted d-flex align-items-center menu-collapsed">
                <small style="font-weight: 700;color: #c5c5c5;">MAIN MENU</small>
            </li>
            <!-- /END Separator -->
            <!-- Menu with submenu -->
             <!-- User -->
             <a href="#submenu11" data-toggle="collapse" aria-expanded="false" class="bg-dark list-group-item list-group-item-action flex-column align-items-start">
                <div class="d-flex w-100 justify-content-start align-items-center transformY">
                    <i class="fa-solid fa-swatchbook"></i>
                    <span class="menu-collapsed fontweight600">Quản Lý Tài Khoản</span>
                    <span class="submenu-icon ml-auto"></span>
                </div>
            </a>
            <div id='submenu11' class="collapse sidebar-submenu">
                @php
                    $sessionUser = Session::get('sessionUser');
                    $sessionUserId = Session::get('sessionUserId');
                    $IsAdmin = Session::get('IsAdmin');
                @endphp
            
                <a href="/Admin" class="list-group-item list-group-item-action bg-dark text-white transformY">
                    <i class="fa-solid fa-book-bookmark" style="color: #ffffff;"></i>
                    <span class="menu-collapsed">Thông Tin Admin</span>
                </a>
            
                <a href="/User" class="list-group-item list-group-item-action bg-dark text-white transformY">
                    <i class="fa-solid fa-book-bookmark" style="color: #ffffff;"></i>
                    <span class="menu-collapsed">Thông Tin Người Dùng</span>
                </a>
             
               
            </div>

        <!-- Chứng Chỉ -->
            <a href="#submenu14" data-toggle="collapse" aria-expanded="false" class="bg-dark list-group-item list-group-item-action flex-column align-items-start">
                <div class="d-flex w-100 justify-content-start align-items-center transformY">
                    <i class="fa-solid fa-swatchbook"></i>
                    <span class="menu-collapsed fontweight600">Quản Lý Thông Tin Nhân Viên</span>
                    <span class="submenu-icon ml-auto"></span>
                </div>
            </a>
            <div id='submenu14' class="collapse sidebar-submenu">
             
               <a href="/DonVi" class="list-group-item list-group-item-action bg-dark text-white transformY">
                    <i class="fa-solid fa-book-bookmark" style="color: #ffffff;"></i>
                    <span class="menu-collapsed">Thông Tin Đơn Vị</span>
                </a>
                <a href="/PhongBan" class="list-group-item list-group-item-action bg-dark text-white transformY">
                    <i class="fa-solid fa-book-bookmark" style="color: #ffffff;"></i>
                    <span class="menu-collapsed">Thông Tin Đơn Vị Người Dùng</span>
                </a>
                <a href="/VaiTro" class="list-group-item list-group-item-action bg-dark text-white transformY">
                    <i class="fa-solid fa-book-bookmark" style="color: #ffffff;"></i>
                    <span class="menu-collapsed">Thông Tin Vai Trò</span>
                </a>
                <a href="/TacVu" class="list-group-item list-group-item-action bg-dark text-white transformY">
                    <i class="fa-solid fa-book-bookmark" style="color: #ffffff;"></i>
                    <span class="menu-collapsed">Thông Tin Vai Trò Người Dùng</span>
                </a>
            </div>
          
            <!-- Giai Đoạn -->
            <a href="/GiaiDoan"  aria-expanded="false" class="bg-dark list-group-item list-group-item-action flex-column align-items-start">
                <div class="d-flex w-100 justify-content-start align-items-center transformX" >
                <i class="fa-solid fa-graduation-cap" style="color: #ffffff;"></i>
                    <span class="menu-collapsed">Quản Lý Giai Đoạn</span>
                    <span class="submenu-icon ml-auto"></span>
                </div>
            </a>
              <!-- Dự Án -->
            <a href="/DuAn"  aria-expanded="false" class="bg-dark list-group-item list-group-item-action flex-column align-items-start">
                <div class="d-flex w-100 justify-content-start align-items-center transformX" >
                <i class="fa-solid fa-chalkboard-user" style="color: #ffffff;"></i>
                    <span class="menu-collapsed">Quản Lý Dự Án</span>
                    <span class="submenu-icon ml-auto"></span>
                </div>
            </a>
              <!-- Công Việc -->
            <a href="/CongViec"  aria-expanded="false" class="bg-dark list-group-item list-group-item-action flex-column align-items-start">
                <div class="d-flex w-100 justify-content-start align-items-center transformX" >
                <i class="fa-solid fa-chalkboard-user" style="color: #ffffff;"></i>
                    <span class="menu-collapsed">Quản Lý Công Việc</span>
                    <span class="submenu-icon ml-auto"></span>
                </div>
            </a>
              <!-- TienDoCongViec -->
              <a href="/TienDoCongViec"  aria-expanded="false" class="bg-dark list-group-item list-group-item-action flex-column align-items-start">
                <div class="d-flex w-100 justify-content-start align-items-center transformX" >
                <i class="fa-solid fa-swatchbook"></i>
                    <span class="menu-collapsed">Quản Lý Tiến Độ Công Việc</span>
                    <span class="submenu-icon ml-auto"></span>
                </div>
            </a>
          
            <!-- Separator with title -->
            <li class="list-group-item sidebar-separator-title text-muted d-flex align-items-center menu-collapsed">
                <small style="font-weight: 700;color: #c5c5c5;">OPTIONS</small>
            </li>
            <a href="/ThongBao"  aria-expanded="false" class="bg-dark list-group-item list-group-item-action flex-column align-items-start">
                <div class="d-flex w-100 justify-content-start align-items-center transformX" >
                    <i class="fa-solid fa-file-import" style="color: #ffffff;"></i>
                    <span class="menu-collapsed">Quản Lý Thông Báo</span>
                    <span class="submenu-icon ml-auto"></span>
                </div>
            </a>
         
            <li class="list-group-item sidebar-separator-title text-muted d-flex align-items-center menu-collapsed">
                <small style="font-weight: 700;color: #c5c5c5;">Đăng Xuất</small>
            </li>
            <a href="/LogoutAction"  aria-expanded="false"   class="bg-dark list-group-item list-group-item-action flex-column align-items-start" >
                <div class="logoutForm">
                <button class="Btn">
                <div class="sign"><svg viewBox="0 0 512 512"><path d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z"></path></svg></div>
                <div class="text">Logout</div>
                </button>
                </div>
            </a>
    </div><!-- sidebar-container END -->
<script>
    // Hide submenus
// $('#body-row .collapse').collapse('hide');

// Collapse/Expand icon
$('#collapse-icon').addClass('fa-angle-double-left');

// Collapse click
$('[data-toggle=sidebar-colapse]').click(function() {
    SidebarCollapse();
});
function SidebarCollapse () {
    $('.menu-collapsed').toggleClass('d-none');
    $('.sidebar-submenu').toggleClass('d-none');
    $('.submenu-icon').toggleClass('d-none');
    $('#sidebar-container').toggleClass('sidebar-expanded sidebar-collapsed');

    // Treating d-flex/d-none on separators with title
    var SeparatorTitle = $('.sidebar-separator-title');
    if ( SeparatorTitle.hasClass('d-flex') ) {
        SeparatorTitle.removeClass('d-flex');
    } else {
        SeparatorTitle.addClass('d-flex');
    }
    // Collapse/Expand icon
    $('#collapse-icon').toggleClass('fa-angle-double-left fa-angle-double-right');
}
</script>

<script>
function logout() {
    // Xóa dữ liệu session từ sessionStorage
    sessionStorage.removeItem('sessionUserId');
}
</script>
