<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Test extends Controller
{
    public function Welcome()
    {
        $title = "Welcome";
        return view('Welcome', compact('title'));
    }
    public function Login()
    {
        $title = "Đăng Nhập";
        return view('User.Login', compact('title'));
    }
    public function MaOTP()
    {
        $title = "Check Email";
        return view('Email.checkEmail', compact('title'));
    }
    public function matkhaunew()
    {
        $title = "Mật Khẩu Mới";
        return view('NguoiDung.ForgotPasswordViewNew', compact('title'));
    }
    public function index()
    {
        $title = "Trang Chủ";
        return view('Index.TrangChu', compact('title'));
    }
    public function chitiet()
    {
        $title = "Chi Tiết";
        return view('Index.ChiTiet', compact('title'));
    }
}
