@extends('layouts/layoutAdmin')
@section('content')
        <div class="col">
                <table id="myTableCongViecThanhVien">
                    <thead>
                        <tr>
                            <th>Thứ Tự</th>
                            <th>Tên</th>
                            <th>Quyền</th>
                            <th>Vai Trò</th>
                            <th>Đơn Vị</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
            <div id="toast1"></div>
        <script>
            $(document).ready(function() {
            var urlParams = new URLSearchParams(window.location.search);
            var MaCongViec = urlParams.get('id');
            var table = $('#myTableCongViecThanhVien').DataTable({
                ajax: {
                    url: "{{ route('CongViecThanhVien.data') }}",
                    data: { id: MaCongViec },
                    dataSrc: 'data'
                },
                columns: [
                    { 
                        data: null, // Không lấy dữ liệu từ server
                        render: function (data, type, row, meta) {
                            return meta.row + 1; // Trả về thứ tự hàng (bắt đầu từ 1)
                        }
                    },
                    { data: 'user_name' },
                    {
                        data: 'Quyen',
                        render: function(data, type, row) {
                            if (data == 2) {
                                return 'Trưởng Phòng';
                            } else if (data == 3){
                                return 'Phó Phòng';
                            }else if ( data == 4){
                                return 'Nhân Viên';
                            } else {
                                return 'Chưa Cấp Quyền';
                            }
                        }
                    },
                    { data: 'vaitro_names' },
                    { data: 'donvi_names' },
                ]
            });
        });
</script>
          
@endsection
