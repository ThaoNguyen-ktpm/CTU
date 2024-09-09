@extends('layouts/layoutAdmin')
@section('content')
<div class="col">
    <table id="myTableCongViecThanhVien">
        <thead>
            <tr>
                <th>Thứ tự</th> <!-- Thêm cột thứ tự -->
                <th>Tên</th>
                <th>Email</th>
                <th>SĐT</th>
                <th>Tiến Độ</th>
                <th>File</th>
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
                url: "{{ route('DuAnCongViecThanhVien.data') }}",
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
                { data: 'UserName' },
                { data: 'Email' },
                { data: 'SDT' },
                {
                    data: 'TienDo',
                    render: function(data, type, row) {
                        if (data === null || data === undefined) {
                            return '0%'; // Nếu không có dữ liệu, in 0%
                        } else {
                            return data + '%'; // Nếu có dữ liệu, in giá trị kèm %
                        }
                    }
                },
                {
                    data: null,
                    render: function(data, type, row) {
                    return '<a href="/DuAn/CongViecDuAn/file?id='+row.idcapnhattiendo+'" style="text-decoration: none;"  class="text-white">@csrf <i class="fa-solid fa-clipboard" style="color: #20679d; font-size:25px"></i> </a>';                            
                
                }
                }
            ]
        });
    });
</script>

</script>
          
@endsection
