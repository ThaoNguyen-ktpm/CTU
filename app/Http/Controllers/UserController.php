<?php
Namespace App\Http\Controllers;
use Illuminate\Http\Request;
// use App\Models\user;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

use Exception;
class UserController extends Controller
{

 //Danh sách User Học Viên
 public function listUserHocVien()
 {
     $title = "Danh Sách User";
     return view('User.ListUserHocVien', compact('title'));
 }
 public function getUserHocVien()
 {
    $User = user::where('IsActive', 1)
    ->where('IsAdmin', 0)
    ->where('IsStudent', 1)
    ->get();
        return response()->json(['data' => $User]);
 }
 //Cập nhật User Học Viên
 public function updateviewHocVien($id)
 {
     $User = user::find($id);
     $title = "Cập Nhật User Học Viên";
     return view('User.UpdateUserHocVien', compact('User', 'title'));
 }
 public function updateHocVien(Request $request, $id)
 {
      $User = user::where('id', '!=', $id)
      ->where('Name', $request->UserName)
      ->where('IsActive', true)
      ->first();
      $UserEmail = user::where('id', '!=', $id)
      ->where('Email', $request->Email)
      ->where('IsActive', true)
      ->first();
      if ($User) {
          return response()->json(['success' => false, 'message' => 'Giá trị UserName đã tồn tại']);
      } else if ($UserEmail){
        return response()->json(['email' => false]);
      }else {
          if ($request->Password !== $request->Password1) {
              return response()->json(['message' => false]);
          } else {
          $User = user::find($id);
          $User->Name = $request->UserName;
          // $User->Password = $request->Password;
          $User->Email = $request->Email;
          $User->SDT = $request->SDT;
            $User->save();
            return response()->json(['success' => true]);
          }
      }
 }
 //Xóa User Học Viên
 public function removeHocVien($id)
 {
  $sessionUserId = session('sessionUserId');

  if ($id == $sessionUserId) {
      return response()->json(['success' => false]);
     
  } else {
      $user = user::find($id);
      $user->IsActive = false;
      $user->save();
      return response()->json(['success' => true]);
  }
 }


      //Danh sách Admin
   public function listAdmin()
   {
       $title = "Danh Sách Admin";
       return view('User.ListAdmin', compact('title'));
   }
   public function getAdmin()
   {
        $User = user::where('IsActive', 1)
        ->where('IsAdmin', 1)
        ->where('IsStudent', 0)
        ->get();
        return response()->json(['data' => $User]);
   }
     //Thêm Admin
   public function addviewAdmin()
   {
       $title = "Thêm Admin";
       return view('User.AddAdmin', compact('title'));
   }
   public function addAdmin(Request $request)
   {
    $User = new user;
    $User->Name = $request->UserName;
    $User->Password = bcrypt($request->Password);
    $User->Email = $request->Email;
    $User->SDT = $request->SDT;
    $User->IsAdmin = true;
    $User->IsActive = true;
    $User->IsStudent = false;
    $User->google_id = null;
    // Mail::send('Email.OTPemail', ['OTP' => $otp], function ($email) use ($request, $otp) {
    //     $email->to($request->Email);
    //     $email->subject('Mã OTP Của Bạn:');
    // });
    // Kiểm tra trước khi lưu
    if (user::where('Name', $User->Name)->where('IsActive', true)->exists()) {
        return response()->json(['success' => false, 'message' => 'Giá trị UserName đã tồn tại']);
    } else if (user::where('Email', $User->Email)->where('IsActive', true)->exists()){
        return response()->json(['email' => false]);
    } else{
        if ($request->Password !== $request->Password1) {
            return response()->json(['message' => false]);
        } else {
            $User->save();
            return response()->json(['success' => true]);
        }
    }
   }

   //Cập nhật Admin
   public function updateviewAdmin($id)
   {
       $User = user::find($id);
       $title = "Cập Nhật Admin";
       return view('User.UpdateAdmin', compact('User', 'title'));
   }
   public function updateAdmin(Request $request, $id)
   {
        $User = user::where('id', '!=', $id)
        ->where('Name', $request->UserName)
        ->where('IsActive', true)
        ->first();
        $UserEmail = user::where('id', '!=', $id)
        ->where('Email', $request->Email)
        ->where('IsActive', true)
        ->first();
        if ($User) {
            return response()->json(['success' => false, 'message' => 'Giá trị UserName đã tồn tại']);
        } else if($UserEmail){
            return response()->json(['email' => false ]);
        }else{
            if ($request->Password !== $request->Password1) {
                return response()->json(['message' => false]);
            } else {
            $User = user::find($id);
            $User->Name = $request->UserName;
            // $User->Password = $request->Password;
            $User->Email = $request->Email;
            $User->SDT = $request->SDT;
                $User->save();
                return response()->json(['success' => true]);
            }
        }
   }


    //Danh sách User
   public function listUser()
   {
       $title = "Danh Sách User";
       return view('User.ListUser', compact('title'));
   }
   public function getUser()
   {
    $User = user::where('IsActive', 1)
    ->where('IsAdmin', 0)
    ->where('IsStudent', 0)
    ->get();
       return response()->json(['data' => $User]);
   }

   //Thêm User
   public function addview()
   {
       $title = "Thêm User";
       return view('User.AddUser', compact('title'));
   }
   public function add(Request $request)
   {
    $User = new user;
    $User->Name = $request->UserName;
    $User->Password = bcrypt($request->Password);
    $User->Email = $request->Email;
    $User->SDT = $request->SDT;
    $User->IsAdmin = false;
    $User->IsActive = true;
    $User->IsStudent = false;
    $User->google_id = null;
    // Mail::send('Email.OTPemail', ['OTP' => $otp], function ($email) use ($request, $otp) {
    //     $email->to($request->Email);
    //     $email->subject('Mã OTP Của Bạn:');
    // });
    // Kiểm tra trước khi lưu
    if (user::where('Name', $User->Name)->where('IsActive', true)->exists()) {
        return response()->json(['success' => false, 'message' => 'Giá trị UserName đã tồn tại']);
    } else if (user::where('Email', $User->Email)->where('IsActive', true)->exists()) {
        return response()->json(['email' => false]);
    } else{
        if ($request->Password !== $request->Password1) {
            return response()->json(['message' => false]);
        } else {
            $User->save();
            return response()->json(['success' => true]);
        }
    }
   }
   //Cập nhật User
   public function updateview($id)
   {
       $User = user::find($id);
       $title = "Cập Nhật User";
       return view('User.UpdateUser', compact('User', 'title'));
   }
   public function update(Request $request, $id)
   {

        $sessionUserId = session('sessionUserId');
        $id = $request->id;
        $user = DB::select('SELECT * FROM `users` WHERE `id`= ? AND IsActive = true AND IsAdmin = true', [ $sessionUserId]);
        if (count($user) > 0 || ($id == $sessionUserId)  ) {

        $User = user::where('id', '!=', $id)
        ->where('Name', $request->UserName)
        ->where('IsActive', true)
        ->first();
        $UserEmail = user::where('id', '!=', $id)
        ->where('Email', $request->Email)
        ->where('IsActive', true)
        ->first();
        if ($User) {
            return response()->json(['success' => false, 'message' => 'Giá trị UserName đã tồn tại']);
        } else if($UserEmail){
            return response()->json(['email' => false, ]);
        } else {
            if ($request->Password !== $request->Password1) {
                return response()->json(['message' => false]);
            } else {
            $User = user::find($id);
            $User->Name = $request->UserName;
            $User->Email = $request->Email;
            $User->SDT = $request->SDT;
                $User->save();
                return response()->json(['success' => true]);
            }
        }
    }else{
        return response()->json(['successID' => false]);
    }
   }
   //Xóa User
   public function remove($id)
   {
    $sessionUserId = session('sessionUserId');
    $user = DB::select('SELECT * FROM `users` WHERE `id`= ? AND IsActive = true AND IsAdmin = true', [ $sessionUserId]);
    if (count($user) == 0  ) {
        return response()->json(['success' => false]);
       
    } else {
        $user = user::find($id);
        $user->IsActive = false;
        $user->save();
        return response()->json(['success' => true]);
    }
   }
   // Đổi Mật Khẩu User
   public function addviewChange($id)
   {
        $User = user::find($id);
       $title = "Đổi Mật Khẩu";
       return view('User.ChangePassword', compact('User','title'));
   }

   public function ChangePasswordUser(Request $request, $id)
   {
    $sessionUserId = session('sessionUserId');
    $id = $request->id;
    $user = DB::select('SELECT * FROM `users` WHERE `id`= ? AND IsActive = true AND IsAdmin = true', [ $sessionUserId]);

    if (count($user) > 0 || ($id == $sessionUserId)  ) {
        $ChangePassword = $request->ChangePassword ;
        $User = DB::select('SELECT * FROM `users` WHERE users.id = ?', [ $id]);
        $users = $User[0];
    
        if (Hash::check($ChangePassword, $users->Password)) {
            
            if ($request->Password !== $request->Password1) {
                return response()->json(['success' => false]);
            } else {
                $User = user::find($id);
                $User->Password = bcrypt($request->Password);
                $User->save();
            return response()->json(['success' => true]);
            }
        } else {
            return response()->json(['Password' => false]);
        }
       
    } else {

        return response()->json(['successID' => false]);
    }
   }
   public function ChangePasswordAdmin(Request $request, $id)
   {
    
        if ($request->Password !== $request->Password1) {
            return response()->json(['success' => false]);
        } else {
        $User = user::find($id);
        $User->Password = bcrypt($request->Password);
            $User->save();
            return response()->json(['success' => true]);
        }
    
   }

   // Đổi Mật Khẩu User Học Viên
   public function addviewChangeHocVien($id)
   {
        $User = user::find($id);
       $title = "Đổi Mật Khẩu";
       return view('User.ChangePasswordHocVien', compact('User','title'));
   }

   public function ChangePasswordHocVien(Request $request, $id)
   {
    
        if ($request->Password !== $request->Password1) {
            return response()->json(['success' => false]);
        } else {
        $User = user::find($id);
        $User->Password = bcrypt($request->Password);
            $User->save();
            return response()->json(['success' => true]);
        }
    
   }
   // Quên Mật khẩu
   public function ForgotPasswordView()
   {
       $title = "Quên Mật Khẩu";
       return view('User.ForgotPasswordView', compact('title'));
   }
   public function ForgotPasswordViewNew()
   {
       $title = "Quên Mật Khẩu";
       return view('User.ForgotPasswordViewNew', compact('title'));
   }

   public function Checkemailform(Request $request)
   {
       $Email = $request->Email;
       if (isset($Email)) {
           $user = DB::select('SELECT * FROM `users` WHERE `Email`= ?', [$Email]);
           if (count($user) > 0 ) {     
            session(['Email' => $Email]);
            return response()->json(['success' => true]);

           } else {
               // Người dùng không tồn tại
               return response()->json(['success' => false]);
           }
       }
   }
 public function verifyOtp(Request $request) {
        $title = "Check Email";
        $otp = rand(1000, 9999); // Tạo OTP
        $expiresAt = now()->addMinutes(3); // Thời gian hết hạn là 3 phút sau  
        // Lấy dữ liệu từ session
       
        $Email = session('Email');
        if (empty($Email)) {
            // Xử lý trường hợp $Email không hợp lệ hoặc rỗng
            return redirect('/Login')->with('error', 'Email address is required.');
        } 
        $request->session()->put('otp', [
            'code' => $otp, 
            'expires_at' => $expiresAt,
            'Email' => $Email
        ]);   
        Mail::send('Email.OTPemail', ['OTP' => $otp,'Email'=>$Email], function ($email) use ($Email, $otp) {
            $email->to($Email);
            $email->subject('Your OTP Code');
        });  
        return view('Email.checkEmail', compact('title'));      
    }
    public function CheckverifyOtp(Request $request) {
        $otp = $request->input('otp1') . $request->input('otp2') . $request->input('otp3') . $request->input('otp4'); // OTP người dùng gửi
        $sessionOtp = $request->session()->get('otp'); // OTP từ session
        // Kiểm tra xem OTP có hợp lệ và chưa hết hạn không
        if ($otp == $sessionOtp['code'] && now()->lessThan($sessionOtp['expires_at'])) {
          
            return response()->json(['success' => true]);     
        } else {
            return response()->json(['success' => false]);
        }
    }
    public function CheckPasswordform(Request $request, )
    {
        $sessionOtp = $request->session()->get('otp'); // OTP từ session
        $Email = $sessionOtp['Email'] ?? null;
         if ($request->Password !== $request->Password1) {
             return response()->json(['success' => false]);
         }  

         if( $Email === null){
            return response()->json(['email' => false]);
         }


        DB::update('UPDATE users SET Password = ? WHERE Email = ?', [bcrypt($request->Password), $Email]);
   
        $request->session()->flush();
        return response()->json(['success' => true]);
         
     
    }
    ////////////////////////////////////////////////
    public function login()
    {
        $isError="";
        $title = "Đăng Nhập";
        return view('User.Login', compact('title','isError'));
    }
    public function loginAction(Request $request)
    {
        $UserName = $request->UserName;
        $Password = $request->Password;
        if (isset($UserName) && isset($Password)) {
            $user = DB::select('SELECT * FROM `users` WHERE `Name`= BINARY ? AND IsActive = true', [$UserName]);
            if (count($user) > 0 ) {
                $user = $user[0];

                // So sánh mật khẩu đã mã hóa trong cơ sở dữ liệu với mật khẩu người dùng nhập vào
                if (Hash::check($Password, $user->Password) && $user->IsStudent == false) {
                    // Đăng nhập thành công
                    Session::put('sessionUser', $user->Name);
                    Session::put('sessionUserId', $user->id);
                    Session::put('IsAdmin', $user->IsAdmin);    
                    
                    return response()->json(['success' => true]);
                } else {
                    // Mật khẩu không đúng hoặc không phải là admin
                    return response()->json(['success' => false]);
                }
            } else {
                // Người dùng không tồn tại
                return response()->json(['success' => false]);
            }
        }
    }

    public function logoutAction()
    {
        Session::forget('sessionUser'); // Xóa session 'sessionuser'
        Session::forget('sessionUserId'); // Xóa session 'sessionuser'
        Session::forget('IsAdmin'); // Xóa session 'sessionuser'
        return redirect('/');
    }
   
    // Đăng Nhập google 
    public function redirectToGoogle()
    {
        Session::flash('back_url',$_SERVER['HTTP_REFERER']);
        return Socialite::driver('google')->redirect();
    }
    public function handleGoogleCallback()
    {
        try {
        $user = Socialite::driver('google')->user(); 
            $findUser = user::where('google_id', $user->id)->where('IsActive', true)->first();
            // Kiểm tra xem email có kết thúc bằng @student.ctuet.edu.vn hay không @ctuet.edu.vn
            $emailsToCheck = ["teacher1@ctuet.edu.vn", "teacher2@ctuet.edu.vn","nhandinhctut@gmail.com","dtnhan@ctuet.edu.vn","nvthao.12a5.20@gmail.com"];

            // Kiểm tra xem email có trong danh sách emailsToCheck không
            if (in_array($user->email, $emailsToCheck)) {
                // Nếu có trong danh sách, tiếp tục kiểm tra hoặc tạo người dùng
                if ($findUser) {
                    Session::put('sessionUser', $findUser->Name);
                    Session::put('sessionUserId', $findUser->id);
                    Session::put('IsAdmin', $findUser->IsAdmin);
    
                    return redirect()->intended('/Welcome');
                } else {
                    $User = new user;
                    $User->Name = $user->name;
                    $User->Password = encrypt('123456dummy');
                    $User->Email = $user->email;
                    $User->SDT = null;
                    $User->google_id = $user->id;
                    $User->IsAdmin = false;
                    $User->IsActive = true;
                    $User->IsStudent = false;
                    $User->save();
                    Session::put('sessionUser', $User->Name);
                    Session::put('sessionUserId', $user->id);
                    Session::put('IsAdmin', $User->IsAdmin);
                 
                    return redirect()->intended('/Welcome');
                }
            } else {
                // Nếu email không có trong danh sách $emailsToCheck, trả về lỗi
                return response()->view('Error.google-access-error', ['email' => $user->email], 404);
                // return response()->json(['success' => false]);
            }
            
        } catch (\Exception $e) {
            // Nếu có lỗi, trả về JSON response với 'success' là false
            return redirect(Session::get('back_url','/'));
            // return response()->view('Error.google-access-error');
        }
    } 
}
