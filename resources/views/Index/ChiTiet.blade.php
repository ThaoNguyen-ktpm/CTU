@extends('layouts/layoutDetails')
@section('content')
<style>
    .submit-btn {
    transform: translateX(0px);
    margin-top: 20px;
    margin-bottom: 20px;
    margin-right: 100px;
}
</style>
<div class="table-title">
    <h4 style="font-style: italic">Công Việc: Đặt Tả Yêu Cầu</h4>
</div>
<form   method="post" class="needs-validation HocVien-form" action="/HocVien/add" novalidate>
<table class="table-fill">
    <thead>
        <tr>
            <th class="text-left" style="width: 20%"></th>
            <th class="text-left" style="width: 80%"></th>
        </tr>
    </thead>
    <tbody class="table-hover">
        <tr>
            <td class="text-left">Trạng thái báo cáo</td>
            <td class="text-left">Trang thực hiện</td>
        </tr>
        <tr>
            <td class="text-left">Thời gian còn lại</td>
            <td class="text-left">1 ngày 1 giờ</td>
        </tr>
        <tr>
            <td class="text-left">Chọn tệp file:</td>
            <td class="text-left">
                <input type="file" id="fileInput" name="file" class="form-control-file">
            </td>
        </tr>
        <tr>
            <td class="text-left"><div class="cmt">Bình luận nội dung</div></td>
            <td class="text-left">
                <div class="group">
                    <textarea id="ghichuInput" name="GhiChu" class="form-control textarea"></textarea>
                    <span class="highlight"></span>
                    <span class="bar"></span>
                </div>
            </td>
        </tr>
    </tbody>
</table>
   <div style="width: 100% ;text-align: right;">
       <button name="Add" type="submit" class="submit-btn">Nộp</button>
    </div>
</form>


@endsection
