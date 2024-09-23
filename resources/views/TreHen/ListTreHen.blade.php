@extends('layouts/layoutAdmin')
@section('content')
 
        <style>
            .dataTables_wrapper {
            padding-top: 0px;
        }
        .trehentext{
            color: white; /* Màu chữ trắng */
            text-decoration: none; 
            padding-left: 7px;/* Tắt gạch chân */
        }
        
        #BtnNew {
        display: flex;
        align-items: center;
        justify-content: flex-start;
        margin-left: 20px;
        width: 150px;
        height: 37px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        position: relative;
        overflow: hidden;
        transition-duration: .3s;
        box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.199);
        background-color: rgb(255, 65, 65);
    }
        </style>
            <div class="logoutForm">
                <button class="Btn " id="BtnNew" style="background-color: rgb(13 55 111);transform: translateX(153px) translateY(46px); z-index: 10;" >
                    <a href="/run-scheduler"  aria-expanded="false" style=" color: white;text-decoration: none;">
            <div class="trehentext" > Cập Nhật Trễ Hẹn</div>
        </a>
            </button>
            </div>
        <div class="col">
                <table id="myTableTreHen">
                    <thead>
                        <tr>
                            <th>Thứ Tự</th>
                            <th>Mã Dự Án</th>
                            <th>Tên Công Việc</th>
                            <th>Dự Án</th>
                            <th>Giai Đoạn</th>
                            <th>Trạng Thái</th>
                            <th>Ngày Bắt Đầu</th>
                            <th>Ngày Đến Hẹn</th>
                            <th>Người Nhận Việc</th>
                            <th>Sửa</th>
                           
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
         
            <div id="toast1"></div>
            
        <script>
            $(document).ready(function() {
            var table = $('#myTableTreHen').DataTable({
                ajax: {
                    url: "{{ route('TreHen.data') }}",
                    dataSrc: 'data'
                },
                columns: [
                    { 
                        data: null, // Không lấy dữ liệu từ server
                        render: function (data, type, row, meta) {
                            return meta.row + 1; // Trả về thứ tự hàng (bắt đầu từ 1)
                        }
                    },
                    { data: 'TenMa' },
                    { data: 'TenCongViec' },
                    { data: 'TenDuAn' },
                    { data: 'TenGiaiDoan' },
                    {
                        data: 'TrangThai',
                        render: function(data, type, row) {
                            if (data == 1) {
                                return '<div style="color: #20679d;font-weight: bold;">Đang Thực Hiện</div>'; // Màu xanh nước biển cây
                            } else if (data == 3){
                                return '<div style="color: #1b7b35;font-weight: bold;">Hoàn Thành</div>'; // Màu xanh lá cây
                            } else if (data == 4){
                                return '<div style="color: red;font-weight: bold;">Trễ Hẹn</div>'; // Màu đỏ
                            } else {
                                return '<div>Trống</div>';
                            }
                        }
                    },
                    {
                        data: 'NgayBatDau',
                        render: function(data) {
                            if (data === null || data === '') {
                            return ' ';
                            } else {
                            var ngaySinh = new Date(data);
                            var ngay = ngaySinh.getDate();
                            var thang = ngaySinh.getMonth() + 1;
                            var nam = ngaySinh.getFullYear();
                            return ngay + '-' + thang + '-' + nam;
                            }
                        }
                },
                {
                        data: 'NgayKetThuc',
                        render: function(data) {
                            if (data === null || data === '') {
                            return ' ';
                            } else {
                            var ngaySinh = new Date(data);
                            var ngay = ngaySinh.getDate();
                            var thang = ngaySinh.getMonth() + 1;
                            var nam = ngaySinh.getFullYear();
                            return ngay + '-' + thang + '-' + nam;
                            }
                        }
                }, {
                        data: null,
                        render: function(data, type, row) {
                        return '<a href="/CongViec/ThanhVien?id='+row.id+'" style="text-decoration: none;"  class="text-white">@csrf  <i class="fa-solid fa-user" style="color: #20679d; font-size:25px"></i></a>';                            
                   
                    }
                    },
                    {
                        data: null,
                        render: function(data, type, row) {
                        return '<form method="get" action="/CongViec/updateview/'+row.id+'">@csrf <button class="btn btn-success"  type="submit"><i class="fa-solid fa-pen-to-square" style="color: #ffffff;margin:0"></i></button></form>';
                    }
                    }
                ],
                order: [[0, 'desc']]
            });
        });

        function deleteTreHen(TreHenId) {
            if (confirm('Bạn có chắc chắn muốn xóa vai trò này?')) {
                // Gửi yêu cầu xóa vai trò đến server
                $.ajax({
                    url: '/TreHen/remove/' + TreHenId,
                    type: 'GET',
                    success: function(response) {
                        if (response.success) {
                            // Cập nhật lại bảng dữ liệu
                            showSuccessToast1()
                            var table = $('#myTableTreHen').DataTable();
                            table.ajax.reload(null, false);
                        }
                    },
                    error: function(xhr) {
                        showErrorToast1();
                        console.log(xhr.responseText);
                    }
                });
            }
        }
        $(document).ready(function() {
	$('.DeleteTreHen-form').click(function(event) {
		event.preventDefault(); // Ngăn chặn hành động mặc định của button
		var button = $(this);
		var id = button.attr('data-id');
		var isError = false;

		// Kiểm tra các trường bắt buộc
		button.closest('tr').find('input[required]').each(function() {
			var input = $(this);
			if (input.val() === '') {
				isError = true;
			}
		});

		if (!isError) {
			khoiphucHocVien(id);
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
    function showSuccessToast1() {
        toast1({
            title: "Success",
            message: "Xóa Giai Đoạn Thành Công!",
            type: "success",
            duration: 2000
        })
    }
    function showErrorToast1(){
      toast1({
          title: "Error",
          message: " Xóa Thất Bại  !",
          type:"error",
          duration:2000
      })
    }

</script>
          
@endsection
