@extends('layouts/layoutAdmin')
@section('content')
        <div class="col">
                <table id="myTableCongViecDuAn">
                    <thead>
                        <tr>
                            <th>Thứ Tự</th>
                            <th>Tên Công Việc</th>
                            <th>Trạng Thái</th>
                            <th>Ngày Bắt Đầu</th>
                            <th>Ngày Đến Hẹn</th>
                            <th>Thành Viên</th>
                            <th>Export</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
            <div id="toast1"></div>
        <script>
            $(document).ready(function() {
            var urlParams = new URLSearchParams(window.location.search);
            var MaDuAn = urlParams.get('id');
            var table = $('#myTableCongViecDuAn').DataTable({
                ajax: {
                    url: "{{ route('CongViecDuAn.data') }}",
                    data: { id: MaDuAn },
                    dataSrc: 'data'
                },
                columns: [
                        { 
                        data: null, // Không lấy dữ liệu từ server
                        render: function (data, type, row, meta) {
                            return meta.row + 1; // Trả về thứ tự hàng (bắt đầu từ 1)
                        }
                    },
                    { data: 'TenCongViec' },
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
                        return '<a href="/DuAn/CongViecThanhVien?id='+row.id+'" style="text-decoration: none;"  class="text-white">@csrf  <i class="fa-solid fa-user" style="color: #20679d; font-size:25px"></i></a>';                            
                   
                    }
                },
                    {
                        data: null,
                        render: function(data, type, row) {
                            return '<button class="btn btn-success" ><a href="/Excel/ExportCongViec/'+row.id+'"><i class="fa-solid fa-file-export" style="color: #ffffff;margin:0"></i></a> </button>';
                        }
                    }
                ]
                
            });
        });
</script>
          
@endsection
