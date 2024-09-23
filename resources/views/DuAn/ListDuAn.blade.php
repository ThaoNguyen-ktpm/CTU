@extends('layouts/layoutAdmin')
@section('content')
 
        <style>
            .dataTables_wrapper {
            padding-top: 0px;
        }
        .table {
        width: 100%;
        margin-bottom: 1rem;
        background-color: #fff;
    }

    .table-bordered {
        border: 1px solid #dee2e6;
    }

    .table-bordered th, .table-bordered td {
        border: 1px solid #dee2e6;
        vertical-align: middle;
    }

    .table thead th {
        background-color: #f8f9fa;
        text-align: center;
    }

    .table-responsive {
        margin-top: 20px;
    }

    .text-center {
        text-align: center;
    }

    .mt-4 {
        margin-top: 1.5rem;
    }

    .table tbody td {
        padding: 8px;
        text-align: left;
        vertical-align: middle;
    }

    .table tbody tr:nth-child(odd) {
        background-color: #f9f9f9;
    }

    .table tbody tr:nth-child(even) {
        background-color: #ffffff;
    }
    b, strong {
    display: block;
    font-weight: bolder;
    width: 124px;
}
        </style>
                <div class="logoutForm">
                    <button class="Btn"  style="background-color: rgb(13 55 111);transform: translateX(153px) translateY(46px); z-index: 10;" >
                        <a href="/DuAn/addview"  aria-expanded="false" >
                        <div class="sign" style="display: block;"><i class="fa-solid fa-plus" style="color: beige; margin-left: 5px;"></i></div>
                        </a>
                    <div class="text" style=" margin-left: 5px;" >Thêm</div>
                </button>
                </div>
        <div class="col">
                <table id="myTableDuAn">
                    <thead>
                        <tr>
                            <th>Mã Dự Án</th>
                            <th>Tên Dự Án</th>
                            {{-- <th>Loại Dự Án</th>
                            <th>Quy Mô</th> --}}
                            <th>Thời Gian</th>
                            <th>Thành Viên</th>
                            <th>Thêm Công Việc</th>
                            <th>Xem</th>
                            <th>Sửa</th>
                            <th>Export</th>
                            <th>Xóa</th>
                        </tr>
                       
                    </thead>
                    <tbody></tbody>
                </table>
               
            </div>
        <!-- Modal -->
        <div class="modal fade" id="projectModal" tabindex="-1" role="dialog" aria-labelledby="projectModalLabel" aria-hidden="true">
            <div class="modal-dialog" style="max-width: 1000px;" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="projectModalLabel">Thông tin Dự Án</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div id="modalContent"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    </div>
                </div>
            </div>
        </div>

  
  
            <div id="toast1"></div>
            
        <script>
          $(document).ready(function() {
    var table = $('#myTableDuAn').DataTable({
        ajax: {
            url: "{{ route('DuAn.data') }}",
            dataSrc: 'data'
        },
        columns: [
            { data: 'TenMa' },
            { data: 'TenDuAn' },
            {
                data: null,
                render: function (data, type, row) {
                    const options = { day: '2-digit', month: '2-digit', year: 'numeric' };
                    const ngayBatDau = new Date(row.NgayBatDau).toLocaleDateString('vi-VN', options);
                    const ngayKetThuc = new Date(row.NgayKetThuc).toLocaleDateString('vi-VN', options);
                    return `${ngayBatDau} đến ${ngayKetThuc}`;
                }
            },
            {
                data: null,
                render: function(data, type, row) {
                    return '<a href="/DuAn/ThanhVien?id='+row.id+'" style="text-decoration: none;" class="text-white">@csrf  <i class="fa-solid fa-user" style="color: #20679d; font-size:25px"></i></a>';
                }
            },
            {
                data: null,
                render: function(data, type, row) {
                    return '<form method="get" action="CongViec/viewid/'+row.id+'">@csrf <button class="btn btn-success" style="border-radius: 50%; background-color: #0d376f;" type="submit"><i class="fa-solid fa-plus" style="color: #ffffff;margin:0"></i></button></form>';
                }
            },
            {
                data: null,
                render: function(data, type, row) {
                    return `
                        <button class="btn btn-success" style="background-color: #5f1c83;border-color: #5f1c83;" 
                                onclick="loadUpdateView(${row.id})" type="button">
                            <i class="fa-solid fa-eye" style="color: #ffffff;margin:0"></i>
                        </button>`;
                }
            },
            {
                data: null,
                render: function(data, type, row) {
                    return '<form method="get" action="/DuAn/updateview/'+row.id+'">@csrf <button class="btn btn-success" type="submit"><i class="fa-solid fa-pen-to-square" style="color: #ffffff;margin:0"></i></button></form>';
                }
            },
            {
                data: null,
                render: function(data, type, row) {
                    return '<button class="btn btn-success"><a href="/Excel/ExportDuAn/'+row.id+'"><i class="fa-solid fa-file-export" style="color: #ffffff;margin:0"></i></a></button>';
                }
            },
            {
                data: null,
                render: function(data, type, row) {
                    return '<button class="btn btn-danger DeleteDuAn-form" onclick="deleteDuAn(' + row.id + ')"><i class="fa-solid fa-trash-can" style="color: #ffffff;margin:0"></i></button>';
                }
            }
        ],
        order: [[0, 'desc']] // Sắp xếp theo cột đầu tiên (TenMa) theo thứ tự giảm dần
    });
});

        function formatDate(dateString) {
            if (!dateString) return '';
            
            var options = { day: '2-digit', month: '2-digit', year: 'numeric' };
            var date = new Date(dateString);
            
            return date.toLocaleDateString('vi-VN', options);
        }

        function loadUpdateView(id) {
    $.ajax({
        url: '/DuAn/updateviewSee/' + id,  // Gửi yêu cầu GET đến server với ID
        type: 'GET',
        success: function(response) {
            // Lấy dữ liệu từ phản hồi
            var data = response.data;
            var NguoiDung = response.NguoiDung;

            // Chuyển đổi Quy Mô thành văn bản
            var quyMoText;
            switch (data[0].QuyMo) {
                case 1:
                    quyMoText = 'Nhỏ';
                    break;
                case 2:
                    quyMoText = 'Vừa';
                    break;
                case 3:
                    quyMoText = 'Lớn';
                    break;
                case 4:
                    quyMoText = 'Rất lớn';
                    break;
                default:
                    quyMoText = 'Chưa xác định';
            }

            // Chia cột MaNguoiDung thành mảng ID
            var maNguoiDungIds = data[0].MaNguoiDung.split(',').map(id => id.trim());

            // Tạo danh sách tên người dùng
            var thanhVienNames = maNguoiDungIds.map(id => {
                var user = NguoiDung.find(user => user.id == id);
                return user ? user.UserName : 'Không xác định';
            }).join(', ');

         // Chèn nội dung phản hồi vào modal với bảng thông tin dự án
    $('#modalContent').html(`
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong>Tên Dự Án:</strong></td>
                        <td>${data[0].TenMa}</td>
                    </tr>
                    <tr>
                        <td><strong>Quy Mô:</strong></td>
                        <td>${quyMoText}</td>
                    </tr>
                    <tr>
                        <td><strong>Ngày Bắt Đầu:</strong></td>
                        <td>${formatDate(data[0].NgayBatDauDuAn)}</td>
                    </tr>
                    <tr>
                        <td><strong>Ngày Kết Thúc:</strong></td>
                        <td>${formatDate(data[0].NgayKetThucDuAn)}</td>
                    </tr>
                    <tr>
                        <td><strong>Mô Tả:</strong></td>
                        <td>${data[0].Mota}</td>
                    </tr>
                    <tr>
                        <td><strong>Thành Viên:</strong></td>
                        <td>${thanhVienNames}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    `);

    // Sắp xếp dữ liệu giai đoạn theo ThuGiaiDoan
    var sortedData = data.sort((a, b) => a.ThuGiaiDoan - b.ThuGiaiDoan);

    // Hiển thị thông tin giai đoạn theo kiểu bảng truyền thống
    var giaiDoanContent = `
        <div class="table-responsive mt-4">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Thứ Tự Giai Đoạn</th>
                        <th>Tên Giai Đoạn</th>
                        <th>Ngày Bắt Đầu Giai Đoạn</th>
                        <th>Ngày Kết Thúc Giai Đoạn</th>
                    </tr>
                </thead>
                <tbody>
    `;

    sortedData.forEach(item => {
        giaiDoanContent += `
            <tr>
                <td>${item.ThuGiaiDoan}</td>
                <td>${item.TenGiaiDoan}</td>
                <td>${formatDate(item.NgayBatDau)}</td>
                <td>${formatDate(item.NgayKetThuc)}</td>
            </tr>
        `;
    });

    giaiDoanContent += `
                </tbody>
            </table>
        </div>
    `;

    // Chèn thông tin giai đoạn vào modal
    $('#modalContent').append(giaiDoanContent);

    // Hiển thị modal
    $('#projectModal').modal('show');
        },
        error: function(xhr, status, error) {
            console.error('Lỗi khi tải dữ liệu:', error);
        }
    });
}



        function deleteDuAn(DuAnId) {
            if (confirm('Bạn có chắc chắn muốn xóa vai trò này?')) {
                // Gửi yêu cầu xóa vai trò đến server
                $.ajax({
                    url: '/DuAn/remove/' + DuAnId,
                    type: 'GET',
                    success: function(response) {
                        if (response.success) {
                            // Cập nhật lại bảng dữ liệu
                            showSuccessToast1()
                            var table = $('#myTableDuAn').DataTable();
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
	$('.DeleteDuAn-form').click(function(event) {
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
            message: "Xóa Dự Án Thành Công!",
            type: "success",
            duration: 2000
        })
    }
    function showErrorToast1(){
      toast1({
          title: "Error",
          message: " Xóa Dự Án Thất Bại  !",
          type:"error",
          duration:2000
      })
    }

</script>
          
@endsection
