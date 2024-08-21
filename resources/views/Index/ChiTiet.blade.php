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
    <h3 style="font-style: italic ; font-weight: 600; padding: 20px;">Chi Tiết Công Việc</h3>
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
            <td class="text-left">Tên dự án</td>
            <td class="text-left">{{$CongViec[0]->TenDuAn}}</td>
        </tr>
        <tr>
            <td class="text-left">Tên công việc</td>
            <td class="text-left">{{$CongViec[0]->TenCongViec}}</td>
        </tr>
        <tr>
            <td class="text-left">Thời gian </td>
            <td class="text-left">{{ \Carbon\Carbon::parse($CongViec[0]->NgayBatDau)->format('d-m-Y') }} Đến {{ \Carbon\Carbon::parse($CongViec[0]->NgayKetThuc)->format('d-m-Y') }}</td>
        </tr>
        <tr>
            <td class="text-left">Link tài liệu</td>
            <td class="text-left">
               <a href="{{$CongViec[0]->LinkTaiLieu}}">Link tài liệu</a>
            </td>
        </tr>
        <tr>
            <td class="text-left"><div class="cmt">Mô tả công việc</div></td>
            <td class="text-left">
                <div class="group">
                    <textarea id="ghichuInput" name="GhiChu" class="form-control textarea">{{$CongViec[0]->MoTa}}</textarea>
                    <span class="highlight"></span>
                    <span class="bar"></span>
                </div>
            </td>
        </tr>
    </tbody>
</table>
   <div style="width: 100% ;text-align: right; ">
       <button name="Add" type="submit" style="margin-right: 100px;margin-top: 40px;margin-bottom: 30px" class="button">Xác Nhận Công Việc</button>
    </div>
</form>


@endsection
