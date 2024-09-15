@extends('layouts/layoutAdmin')
@section('content')
<style>
    /* Căn giữa toàn bộ nội dung trang bìa theo chiều dọc và ngang */
    .docx-cover {
        display: flex;
        justify-content: center; /* Căn giữa theo chiều ngang */
        align-items: center; /* Căn giữa theo chiều dọc */
        height: 100vh; /* Chiều cao bằng 100% màn hình */
        text-align: center;
    }

    /* Căn chỉnh tiêu đề lớn trên trang bìa */
    .docx-cover h1, .docx-cover h2, .docx-cover h3 {
        font-size: 36px;
        margin-bottom: 20px;
        text-align: center;
    }

    /* Căn giữa hình ảnh hoặc logo trên trang bìa */
    .docx-cover img {
        display: block;
        margin: 20px auto; /* Căn giữa hình ảnh */
        max-width: 80%; /* Đảm bảo hình ảnh không vượt quá 80% chiều rộng */
    }

    /* Định dạng nội dung thêm (ví dụ: ngày, tên tác giả) */
    .docx-cover p {
        margin: 10px 0;
        font-size: 18px;
    }

    /* Header và Footer trên trang bìa */
    .docx-cover .header, .docx-cover .footer {
        position: absolute;
        width: 100%;
        text-align: center;
        font-size: 14px;
    }

    .docx-cover .header {
        top: 10px; /* Đặt ở đầu trang */
    }

    .docx-cover .footer {
        bottom: 10px; /* Đặt ở cuối trang */
    }
</style>



<style>
    /* Căn chỉnh toàn bộ nội dung trong modal */
    #fileModalContent {
        padding: 20px;
        font-family: Arial, sans-serif;
        line-height: 1.6;
        overflow: auto; /* Đảm bảo nội dung không bị cắt */
    }

    /* Căn lề cho đoạn văn */
    #fileModalContent p {
        margin: 10px 0;
        text-align: justify; /* Căn chỉnh văn bản đều hai bên */
    }

    /* Định dạng tiêu đề */
    #fileModalContent h1, #fileModalContent h2, #fileModalContent h3, #fileModalContent h4, #fileModalContent h5, #fileModalContent h6 {
        margin: 10px 0;
        color: #333;
        font-weight: bold;
    }

    #fileModalContent h1 { font-size: 2em; }
    #fileModalContent h2 { font-size: 1.5em; }
    #fileModalContent h3 { font-size: 1.17em; }
    #fileModalContent h4 { font-size: 1em; }
    #fileModalContent h5 { font-size: 0.83em; }
    #fileModalContent h6 { font-size: 0.67em; }

    /* Định dạng danh sách */
    #fileModalContent ul, #fileModalContent ol {
        margin: 10px 0;
        padding-left: 20px;
    }

    #fileModalContent li {
        margin: 5px 0;
    }

    /* Định dạng khối trích dẫn */
    #fileModalContent blockquote {
        border-left: 3px solid #ddd;
        padding-left: 15px;
        margin: 10px 0;
        font-style: italic;
        color: #555;
        background-color: #f9f9f9;
        border-radius: 4px;
    }

    /* Định dạng hình ảnh */
    #fileModalContent img {
        max-width: 100%;
        height: auto;
        display: block;
        margin: 10px auto;
    }

    /* Định dạng bảng */
    #fileModalContent table {
        border-collapse: collapse;
        width: 100%;
        margin: 10px 0;
    }

    #fileModalContent th, #fileModalContent td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }

    #fileModalContent th {
        background-color: #f2f2f2;
    }

    #fileModalContent tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    /* Định dạng khối code */
    #fileModalContent pre {
        background-color: #f4f4f4;
        padding: 10px;
        border: 1px solid #ddd;
        overflow: auto;
        white-space: pre-wrap; /* Cho phép dòng dài tự động xuống dòng */
    }
</style>
        <div class="col">
                <table id="myTableCongViecDuAnfile">
                    <thead>
                        <tr>
                            <th>Thứ Tự</th>
                            <th>Files</th>
                            <th>Thời Gian Nộp</th>
                            <th>Nội Dung</th>
                            <th>Download</th>   
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
            <div class="modal fade" id="fileModal" tabindex="-1" aria-labelledby="fileModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="fileModalLabel">Nội dung File</h5>
                      
                    </div>
                    <div class="modal-body" id="fileModalContent">
                      <!-- Nội dung file sẽ được chèn vào đây -->
                    </div>
                    <div class="modal-footer">
                    
                    </div>
                  </div>
                </div>
              </div>
         <div id="toast1"></div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/mammoth/1.4.2/mammoth.browser.min.js"></script>

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
                data: null,
                render: function(data, type, row) {
                    return `
                        <button class="btn btn-success" style="background-color: #5f1c83;border-color: #5f1c83;" 
                                onclick="loadFileContent(${row.id})" type="button">
                            <i class="fa-solid fa-eye" style="color: #ffffff;margin:0"></i>
                        </button>`;
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
function loadFileContent(id) {
    // Hiển thị thông báo đang tải dữ liệu
    $('#fileModalContent').html('<p>Đang tải dữ liệu...</p>');

    $.ajax({
        url: '/DuAn/updateviewFile/' + id,  // Gửi yêu cầu GET để lấy thông tin file
        type: 'GET',
        success: function(response) {
            if (response.content) {
                var fileContent = response.content;
                var fileType = response.type;

                // Kiểm tra nếu là file text hoặc JSON
                if (fileType.startsWith('text') || fileType === 'application/json') {

                    // Kiểm tra nếu là file PHP
                    if (fileType === 'text/x-php') {
                        // Tách fileContent thành các dòng
                        var lines = fileContent.split('\n');

                        // Loại bỏ dòng đầu và dòng cuối
                        if (lines.length > 2) {
                            fileContent = lines.slice(1, -1).join('\n');
                        }
                    }

                    // Hiển thị nội dung sau khi xử lý
                    $('#fileModalContent').html('<pre>' + fileContent + '</pre>');
                }

                $('#fileModal').modal('show');
            } else if (response.url) {
                var fileUrl = response.url;
                var fileType = response.type;

                if (fileType === 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet') {
                    $.ajax({
                        url: fileUrl,
                        xhrFields: {
                            responseType: 'arraybuffer'
                        },
                        success: function(data) {
                            var workbook = XLSX.read(new Uint8Array(data), { type: 'array' });
                            var sheetName = workbook.SheetNames[0];
                            var worksheet = workbook.Sheets[sheetName];
                            var html = XLSX.utils.sheet_to_html(worksheet, { header: 1 });

                            // Tinh chỉnh CSS để bảng dễ đọc
                            var tableStyles = `
                                <style>
                                    table {
                                        border-collapse: collapse;
                                        width: 100%;
                                    }
                                    th, td {
                                        border: 1px solid #ddd;
                                        padding: 8px;
                                    }
                                    th {
                                        background-color: #f2f2f2;
                                        text-align: left;
                                    }
                                    tr:nth-child(even) {
                                        background-color: #f9f9f9;
                                    }
                                </style>
                            `;

                            $('#fileModalContent').html(tableStyles + html);
                        }
                    });
                } else if (fileType === 'application/vnd.openxmlformats-officedocument.wordprocessingml.document') {
                    $.ajax({
                        url: fileUrl,
                        xhrFields: {
                            responseType: 'arraybuffer'
                        },
                        success: function(data) {
                            mammoth.convertToHtml({ arrayBuffer: data })
                                .then(function(result) {
                                    $('#fileModalContent').html(result.value);
                                })
                                .catch(function(err) {
                                    console.error('Error converting DOCX to HTML:', err);
                                });
                        }
                    });
                } else if (fileType.startsWith('image')) {
                    $('#fileModalContent').html('<img src="' + fileUrl + '" alt="Image" style="max-width: 100%;">');
                } else if (fileType === 'application/pdf') {
                    $('#fileModalContent').html('<iframe src="' + fileUrl + '" style="width: 100%; height: 500px;"></iframe>');
                } else if (fileType === 'application/zip') {
                    $('#fileModalContent').html('<p><a href="' + fileUrl + '" download>Click here to download the ZIP file</a></p>');
                } else {
                    $('#fileModalContent').html('<p><a href="' + fileUrl + '" download>Click here to download the file</a></p>');
                }

                $('#fileModal').modal('show');
            } else {
                alert('Không tìm thấy file.');
            }
        },
        error: function(xhr, status, error) {
            console.error('Lỗi khi tải file:', error);
        }
    });
}

// Xóa nội dung modal khi đóng
$('#fileModal').on('hide.bs.modal', function () {
    $('#fileModalContent').html('');  // Xóa nội dung cũ trong modal
});





</script>
          
@endsection
