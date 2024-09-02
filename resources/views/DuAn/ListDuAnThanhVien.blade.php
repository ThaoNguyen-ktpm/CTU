@extends('layouts/layoutAdmin')
@section('content')
        <div class="col">
                <table id="myTableDuAnThanhVien">
                    <thead>
                        <tr>
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
            var MaDuAn = urlParams.get('id');
            var table = $('#myTableDuAnThanhVien').DataTable({
                ajax: {
                    url: "{{ route('DuAnThanhVien.data') }}",
                    data: { id: MaDuAn },
                    dataSrc: 'data'
                },
                columns: [
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
