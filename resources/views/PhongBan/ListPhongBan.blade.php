@extends('layouts/layoutAdmin')
@section('content')

        <style>
        .dataTables_wrapper {
            padding-top: 0px;
        }
        </style>
                <div class="logoutForm">
                <button class="Btn"  style="background-color: rgb(13 55 111);transform: translateX(153px) translateY(46px); z-index: 10;" >
                <a href=" /PhongBan/addview"  aria-expanded="false" >
                <div class="sign" style="display: block;"><i class="fa-solid fa-plus" style="color: beige; margin-left: 5px;"></i></div>
                </a>
                <div class="text" style=" margin-left: 5px;" >Thêm</div>
                </button>
                </div>
        <div class="col">
                <table id="myTablePhongBan">
                    <thead>
                        <tr>
                            <th>Thứ Tự</th>
                            <th>Tên Người Dùng</th>
                            <th>Đơn Vị</th>
                            <th>Sửa</th>
                            <th>Xóa</th>
                          
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
            <div id="toast1"></div>
        <script>
            $(document).ready(function() {
            var table = $('#myTablePhongBan').DataTable({
                ajax: {
                    url: "{{ route('PhongBan.data') }}",
                    dataSrc: 'data'
                },
                columns: [
                    { 
                        data: null, // Không lấy dữ liệu từ server
                        render: function (data, type, row, meta) {
                            return meta.row + 1; // Trả về thứ tự hàng (bắt đầu từ 1)
                        }
                    },
                    { data: 'UserName' },
                    { data: 'TenDonVi' },
                    {
                        data: null,
                        render: function(data, type, row) {
                        return '<form method="get" action="/PhongBan/updateview/'+row.id+'">@csrf <button class="btn btn-success"  type="submit"><i class="fa-solid fa-pen-to-square" style="color: #ffffff;margin:0"></i></button></form>';
                    }
                    },
                    {
                        data: null,
                        render: function(data, type, row) {
                            return '<button class="btn btn-danger" onclick="deletePhongBan(' + row.id + ')"><i class="fa-solid fa-trash-can" style="color: #ffffff;margin:0"></i></button>';
                        }
                    },
                  
                ]
            });
        });

        function deletePhongBan(PhongBanId) {
            if (confirm('Bạn có chắc chắn muốn xóa vai trò này?')) {
                // Gửi yêu cầu xóa vai trò đến server
                $.ajax({
                    url: '/PhongBan/remove/' + PhongBanId,
                    type: 'GET',
                    success: function(response) {
                        if (response.success) {
                            // Cập nhật lại bảng dữ liệu
                            showSuccessToast1();
                            var table = $('#myTablePhongBan').DataTable();
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
	$('.DeletePhongBan-form').click(function(event) {
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
            message: "Xóa Đơn Vị Thành Công!",
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

        function exportPhongBan(PhongBanId) {
            if (confirm('Bạn có muốn tải xuống dữ liệu Đơn Vị?')) {
                // Gửi yêu cầu xuống máy chủ để tạo và tải xuống tệp Excel
                var xhr = new XMLHttpRequest();
                xhr.open('GET', '/Excel/ExportLop/' + PhongBanId, true);
                xhr.responseType = 'blob';

                xhr.onload = function (e) {
    if (xhr.status === 200) {
        var contentType = xhr.getResponseHeader('Content-Type');
        var filename = 'list_lop_hoc.xlsx';

        // Kiểm tra xem phản hồi có phải là tệp Excel không
        if (contentType === 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet') {
            if (window.navigator && window.navigator.msSaveOrOpenBlob) {
                // Hỗ trợ trình duyệt Internet Explorer hoặc Microsoft Edge
                window.navigator.msSaveOrOpenBlob(xhr.response, filename);
            } else {
                // Tạo URL tải xuống từ dữ liệu blob và tạo một liên kết tải xuống giả
                var downloadUrl = URL.createObjectURL(xhr.response);
                var a = document.createElement('a');
                a.href = downloadUrl;
                a.download = filename;
                document.body.appendChild(a);
                a.click();
                document.body.removeChild(a);
            }
        } else {
            console.error('Không thể tải xuống tệp Excel.');
        }
    } else {
        console.error('Yêu cầu không thành công. Mã trạng thái: ' + xhr.status);
    }
};
            }
        }
    </script>
@endsection
