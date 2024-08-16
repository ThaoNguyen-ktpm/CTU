@extends('layouts/layoutAdmin')
@section('content')
        <div class="col">
                <table id="myTableDuAnGiaiDoan">
                    <thead>
                        <tr>
                            <th>Thứ Tự Giai Đoạn</th>
                            <th>Tên Giai Đoạn</th>
                            <th>Ngày Bắt Đầu</th>
                            <th>Ngày Kết Thúc</th>
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
            var table = $('#myTableDuAnGiaiDoan').DataTable({
                ajax: {
                    url: "{{ route('DuAnGiaiDoan.data') }}",
                    data: { id: MaDuAn },
                    dataSrc: 'data'
                },
                columns: [
                    { data: 'ThuGiaiDoan' },
                    { data: 'TenGiaiDoan' },
                    { data: 'NgayBatDau' },
                    { data: 'NgayKetThuc' },
                ]
            });
        });
</script>
          
@endsection
