<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /****เข้าสู่ระบบ*****/
    public function UserLogin(Request $request)
    {
        // echo $name = $request->input('username');
        //ค้นหาชื่อผู้ใช้รหัสผ่านในดาต้าเบส
        $user = User::where('username', $request->username)->where('password', $request->password)->first();
        $i_user = $this->checkNull($user);
        if ($i_user != 0) {
            //เปิด session
            session_start();
            $_SESSION["user"] = $user->id;
            $_SESSION["username"] = $user->username;
            $_SESSION["status"] = $user->status; //ประเภท user
            if ($_SESSION["status"] == "1") {
                return redirect('admin/index');
            } elseif ($_SESSION["status"] == "2") {
                return redirect('user/view');
            } else {
                return redirect('/')->with('error', 'ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง');
            }
        } else {
            return redirect('/')->with('error', 'ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง');
        }

    }
    /****เช็คค่าว่างของข้อมูล*****/
    public function checkNull($param)
    {
        if ($param != null) {
            return 1;
        } else {
            return 0;
        }
    }
    /****ออกจากระบบ*****/
    public function logout()
    {
        session_start();
        //เคลียค่า session และปิด session
        session_unset();
        session_destroy();
        //กลับไปหน้า login
        return redirect('/');

    }
}
