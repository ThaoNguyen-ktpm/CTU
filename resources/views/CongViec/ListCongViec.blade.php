@extends('layouts/layoutAdmin')
@section('content')
 
        <style>
            .dataTables_wrapper {
            padding-top: 0px;
        }

        /* From Uiverse.io by JaydipPrajapati1910 */ 
        .button11 {
        color: white;
        background-color: #222;
        font-weight: 500;
        border-radius: 0.5rem;
        font-size: 1rem;
        line-height: 1rem;
        padding-left: 1rem;
        padding-right: 1rem;
        padding-top: 0.7rem;
        padding-bottom: 0.7rem;
        cursor: pointer;
        text-align: center;
        margin-right: 0.5rem;
        display: inline-flex;
        align-items: center;
        border: none;
        }

        .button11:hover {
        background-color: #333;
        }

        .button11 svg {
        display: inline;
        width: 1.3rem;
        height: 1.3rem;
        margin-right: 0.75rem;
        color: white;
        }

        .button11:focus svg {
        animation: spin_357 0.5s linear;
        }

        @keyframes spin_357 {
        from {
            transform: rotate(0deg);
        }

        to {
            transform: rotate(360deg);
        }
        }
        </style>
    <div class="col">
        <div class="container" style="width: 100%; padding-bottom:0 ;padding: 0px 50px 0px; margin: 10px auto 0;">
            <form id="myForm" class="needs-validation">
            @csrf
            <div style="display:flex;justify-content:space-between;align-items:center;">
            <div class="group">
            <label>Mã dự án </label>
            <select name="MaDuAn" style="width:240px ;" class="form-control" >
                <option value="" disabled selected>Chọn mã dự án</option>
                @foreach($DuAn as $DuAn1)
                <option value="{{$DuAn1->id}}">{{$DuAn1->TenMa}}</option>
                @endforeach
            </select>
            </div>
            <div class="group" style="margin-left: -60px;">
            <label>Giai đoạn </label>
            <select name="MaGiaiDoan" style="width:240px ;" class="form-control" >
                <option value="" disabled selected>Chọn giai đoạn</option>
                @foreach($GiaiDoan as $GiaiDoan1)
                <option value="{{$GiaiDoan1->id}}">{{$GiaiDoan1->TenGiaiDoan}}</option>
                @endforeach
            </select>
            </div> 
            <div class="group" style="margin-left: -60px;">
            <label>Trạng Thái </label>
            <select name="MaTrangThai" style="width:240px ;" class="form-control" >
                <option value="" disabled selected>Chọn trạng thái</option>
                <option value="1">Đang thực hiện</option>
                <option value="3">Hoàn thành</option>
                <option value="4">Trễ hẹn</option>
            </select>
            </div>
            <button type="submit" class="submit-btn"  style=" transform: translateX(0px); margin-top:12px;margin-right:4px;height:37px;width:130px;" onclick="submitForm(event)">Tìm</button>
            </div>
            </form>
            <button type="submit" class="submit-btn" style="height:37px;width:130px;transform: translateX(-55px);" onclick="submitFormAll(event)">Tất cả</button>
           
    </div>

  
   
        <div class="logoutForm" style="width:100px">
            <button class="Btn"  style="background-color: rgb(13 55 111);transform: translateX(153px) translateY(10px); z-index: 10;" >
            <a href="/CongViec/addview"  aria-expanded="false" >
            <div class="sign" style="display: block;"><i class="fa-solid fa-plus" style="color: beige; margin-left: 5px;"></i></div>
            </a>
            <div class="text" style=" margin-left: 5px;" >Thêm</div>
            </button>
        </div>

       
 

       <div class="col" style="    margin-top: -35px;">
                <table id="myTableCongViec" >
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
    var table = $('#myTableCongViec').DataTable({
        ajax: {
            url: "{{ route('CongViec.data') }}",
            dataSrc: 'data'
        },
        columns: [
            { 
                data: null, 
                render: function (data, type, row, meta) {
                    // Không tính thứ tự tại đây mà trong drawCallback
                    return meta.row + 1;
                }
            },
            { 
                data: 'TenMa' 
            },
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
            },
            {
                data: null,
                render: function(data, type, row) {
                    return '<a href="/DuAn/CongViecThanhVien?id='+row.id+'" style="text-decoration: none;" class="text-white">@csrf  <i class="fa-solid fa-user" style="color: #20679d; font-size:25px"></i></a>';
                }
            },
            {
                data: null,
                render: function(data, type, row) {
                    return '<form method="get" action="/CongViec/updateview/'+row.id+'">@csrf <button class="btn btn-success" type="submit"><i class="fa-solid fa-pen-to-square" style="color: #ffffff;margin:0"></i></button></form>';
                }
            }
        ],
        order: [[0, 'desc']], // Sắp xếp theo cột thứ tự giảm dần
       
        
    });
});


        function deleteCongViec(CongViecId) {
            if (confirm('Bạn có chắc chắn muốn xóa vai trò này?')) {
                // Gửi yêu cầu xóa vai trò đến server
                $.ajax({
                    url: '/CongViec/remove/' + CongViecId,
                    type: 'GET',
                    success: function(response) {
                        if (response.success) {
                            // Cập nhật lại bảng dữ liệu
                            showSuccessToast1()
                            var table = $('#myTableCongViec').DataTable();
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
        function submitForm(event) {
            event.preventDefault();
            var id = $('#myForm select[name="MaDuAn"]').val();
            var MaGiaiDoan = $('#myForm select[name="MaGiaiDoan"]').val(); // Lấy giá trị tên học viên
            var MaTrangThai = $('#myForm select[name="MaTrangThai"]').val(); // Lấy giá trị tên học viên
         
            $.ajax({
                url: "{{ route('DanhSachCongViec.data', ['id' => '__id__']) }}".replace('__id__', id),
                type: 'GET',
                data: {
                    id: id,
                    MaGiaiDoan: MaGiaiDoan,
                    MaTrangThai : MaTrangThai,
                    
                },
                dataSrc: 'data',
                success: function (response) {
                    var table = $('#myTableCongViec').DataTable();
                    table.clear().rows.add(response.data).draw();
                    // Xóa giá trị của các thẻ input và select
                    $('#myForm select[name="MaGiaiDoan"]').val('');
                    $('#myForm select[name="MaTrangThai"]').val('');
                    $('#myForm select[name="MaDuAn"]').val('');
                  
                },
                error: function (error) {
                    alert('Không tìm thấy dữ liệu!');
                    $('#myForm select[name="MaGiaiDoan"]').val('');
                    $('#myForm select[name="MaTrangThai"]').val('');
                    $('#myForm select[name="MaDuAn"]').val('');
                  
        }
            });
        }
        function submitFormAll(event) {
            event.preventDefault();
            $.ajax({
                url: "{{ route('CongViec.data') }}",
                type: 'GET',
                success: function (response) {
                    var table = $('#myTableCongViec').DataTable();
                    table.clear().rows.add(response.data).draw();
                    // Xóa giá trị của các thẻ input và select
                    $('#myForm select[name="MaGiaiDoan"]').val('');
                    $('#myForm select[name="MaTrangThai"]').val('');
                    $('#myForm select[name="MaDuAn"]').val('');
                },
                error: function (error) {
                    alert('Đã có lỗi xảy ra: ' + error.responseText);
                }
            });
        }
        $(document).ready(function() {
	$('.DeleteCongViec-form').click(function(event) {
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
			khoiphucCongViec(id);
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
