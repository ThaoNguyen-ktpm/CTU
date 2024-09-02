@extends('layouts/layoutAdmin')
@section('content')
 
        <style>
            .dataTables_wrapper {
            padding-top: 0px;
        }
        </style>
        <a href="/DuAn/addview"  aria-expanded="false" >
                <div class="logoutForm">
                <button class="Btn"  style="background-color: rgb(13 55 111);transform: translateX(153px) translateY(46px); z-index: 10;" >
                <div class="sign" style="display: block;"><i class="fa-solid fa-plus" style="color: beige; margin-left: 5px;"></i></div>
                <div class="text" style=" margin-left: 5px;" >Thêm</div>
                </button>
                </div>
        </a>
        <div class="col">
                <table id="myTableDuAn">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tên Dự Án</th>
                            <!-- <th>Mô tả</th> -->
                            <th>Thành Viên</th>
                            <th>Giai Đoạn</th>
                            <th>Thêm Công Việc</th>
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
            var table = $('#myTableDuAn').DataTable({
                ajax: {
                    url: "{{ route('DuAn.data') }}",
                    dataSrc: 'data'
                },
                columns: [
                    { data: 'id' },
                    { data: 'TenDuAn' },
                    // { data: 'Mota' },
                    {
                        data: null,
                        render: function(data, type, row) {
                        return '<a href="/DuAn/ThanhVien?id='+row.id+'" style="text-decoration: none;"  class="text-white">@csrf  <i class="fa-solid fa-user" style="color: #20679d; font-size:25px"></i></a>';                            
                   
                    }
                    },
                    {
                        data: null,
                        render: function(data, type, row) {
                        return '<a href="/DuAn/GiaiDoan?id='+row.id+'" style="text-decoration: none;"  class="text-white">@csrf  <i class="fa-solid fa-bars-staggered" style="color: #20679d; font-size:25px"></i></a>';                            
                   
                    }
                    },
                    {
                        data: null,
                        render: function(data, type, row) {
                        return '  <form method="get" action="CongViec/viewid/'+row.id+'"> <div class="logoutForm"><button class="Btn"  style="background-color: rgb(13 55 111); z-index: 10;" ><div class="sign" style="display: block;"><i class="fa-solid fa-plus" style="color: beige; margin-left: 5px;"></i></div><div class="text" style=" margin-left: 5px;" >Thêm</div></button></div></form>';
                    }
                    },
                    {
                        data: null,
                        render: function(data, type, row) {
                        return '<form method="get" action="/DuAn/updateview/'+row.id+'">@csrf <button class="btn btn-success"  type="submit"><i class="fa-solid fa-pen-to-square" style="color: #ffffff;margin:0"></i></button></form>';
                    }
                    },
                    {
                        data: null,
                        render: function(data, type, row) {
                            return '<button class="btn btn-danger DeleteDuAn-form" onclick="deleteDuAn(' + row.id + ')"><i class="fa-solid fa-trash-can" style="color: #ffffff;margin:0"></i></button>';
                        }
                    }
                ]
            });
        });

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
            message: "Xóa Chứng Chỉ Thành Công!",
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
