<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * 用户的添加页面显示
     */
    public function add()
    {
        return view('admin.add');
    }

    /**
     * 用户的插入操作
     */
    public function insert(Request $request)
    {
        //表单验证
        $this->validate($request, [
            'username' => 'required|regex:/\w{8,20}/',
            'email'=>'required|email',
            'password'=>'required',
            'repassword'=>'same:password',
        ],[
            'username.required'=>'用户名不能为空',
            'username.regex'=>'用户名为8~20位',
            'email.email'=>'邮箱格式不正确',
            'email.required'=>'邮箱不能为空',
            'password.required'=>'密码不能为空',
            'password.regex'=>'密码为8~20位',
            'repassword.same'=>'两次密码不相同',
        ]);

        //数据插入
        $user=new User;
        $user->username=$request->input('username');
        $user->email=$request->input('email');
        $user->password=Hash::make($request->input('password'));
        $user->intro=$request->input('intro');
        //处理图片上床
        if($request->hasFile('profile')){
            //文件存放的目录
            $path='./upload/'.date('Ymd');
            //获得后缀
            $suffix=$request->file('profile')->getClientOriginalExtension();
            //文件的名称
            $filename=time().rand(100,999).'.'.$suffix;
            $request->file('profile')->move($path,$filename);
            $user->profile=trim($path.'/'.$filename,'.');
        }
        //执行插入
        if ($user->save()){
            return redirect('/user/index')->with('info','添加成功');
        }else{
            return back()->with('info','添加失败');
        }

    }

    public function index()
    {
        return view
    }
}
