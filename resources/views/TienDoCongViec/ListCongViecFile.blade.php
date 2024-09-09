@extends('layouts/layoutAdmin')
@section('content')
        <div class="col">
                <table id="myTableCongViecDuAnfile">
                    <thead>
                        <tr>
                            <th>Thứ Tự</th>
                            <th>Files</th>
                            <th>Thời Gian Nộp</th>
                            <th>Download</th>
                           
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
            <div id="toast1"></div>

        <script>
            var assetUrl = "{{ asset('') }}";
        </script>
        <script>
            
     $(document).ready(function() {
    var urlParams = new URLSearchParams(window.location.search);
    var MaDuAn = urlParams.get('id');
    
    var table = $('#myTableCongViecDuAnfile').DataTable({
        ajax: {
            url: "{{ route('CongViecDuAnfile.data') }}",
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
            { data: 'TenFile' },
            {
                data: 'ThoiGianNop',
                render: function (data, type, row) {
                    // Chuyển đổi định dạng ngày tháng năm từ ISO 8601 sang định dạng Việt Nam (giờ:phút ngày/tháng/năm)
                    var date = new Date(data);
                    var hours = ('0' + date.getHours()).slice(-2);
                    var minutes = ('0' + date.getMinutes()).slice(-2);
                    var day = ('0' + date.getDate()).slice(-2);
                    var month = ('0' + (date.getMonth() + 1)).slice(-2);
                    var year = date.getFullYear();
                    return hours + ' giờ ' + minutes + ' phút  ngày ' + day + '-' + month + '-' + year;
                }
            },
            {
                data: 'DuongDanFile',
                render: function (data, type, row) {
                    // Sử dụng biến assetUrl đã được gán từ PHP
                    var fileUrl = assetUrl + data;
                    return '<a href="' + fileUrl + '" download style="margin-left: 10px;"><i class="fas fa-download" style="font-size: 16px;"></i></a>';
                }
            }
        ]
    });
});


</script>
          
@endsection
