<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function index($status)
    {
        $title = 'Tài khoản quản trị';
        $user = User::query()->where('status',$status)->whereNotIn('id',[1,auth()->user()->id])->orderBy('id','desc')->paginate(10);
        return view('CMS.user.index',compact('title','status','user'));
    }

    public function create()
    {
        $title = 'Thêm tài khoản quản trị';
        return view('CMS.user.create',compact('title'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255|regex:/[A-Za-z]/',
            'phone' => 'min:10|max:10|required|regex:/^0[1-9][0-9]{8}$/|unique:users,phone',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
        ], [
            'name.required' => 'Bạn cần nhập tên',
            'name.max' => 'Tên không được quá 255 ký tự',
            'name.regex' => 'Tên bạn nhập phải là chữ cái',
            'phone.required' => 'Bạn cần nhập số điện thoại',
            'phone.min' => 'Số điện thoại bạn nhập phải ít nhất 10 ký tự',
            'phone.max' => 'Số điện thoại bạn nhập được nhiều nhất 10 ký tự',
            'phone.regex' => 'Số điện thoại bạn nhập phải là 1 số điện thoại ở Việt Nam',
            'phone.unique'=>'Số điện thoại đã được sử dụng',
            'email.required' => 'Bạn cần nhập email',
            'email.email' => 'Email bạn nhập không đúng định dạng',
            'email.unique'=>'Email đã được sử dụng',
            'password.required' => 'Bạn cần nhập mật khẩu',
            'password.min' => 'Mật khẩu của bạn cần nhập ít nhất 8 ký tự',
        ]);

        $data = $request->all();
        $data['password'] = Hash::make($data['password']);
        $data['status'] = 1;
        try {
            User::query()->create($data);
            return response()->json([
                'success' => true,
                'message' => 'Thêm tài khoản thành công'
            ]);
        }catch (\Exception $e){
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function password(Request $request)
    {
        $request->validate([
            'current' => 'required|min:8',
            'new' => 'required|min:8',
            'confirm_new' => 'required|same:new',
        ], [
            'current.required' => 'Bạn cần nhập mật khẩu hiện tại',
            'current.min' => 'Mật khẩu hiện tại của bạn cần nhập ít nhất 8 ký tự',
            'new.required' => 'Bạn cần nhập mật khẩu mới',
            'new.min' => 'Mật khẩu mới của bạn cần nhập ít nhất 8 ký tự',
            'confirm_new.required' => 'Bạn cần xác nhận mật khẩu mới',
            'confirm_new.same' => 'Xác nhận mật khẩu mới không khớp với mật khẩu mới bạn nhập',
        ]);

        $user = User::query()->findOrFail(auth()->user()->id);
        if (Hash::check($request->current, $user->password)){
            try {
                $user->password = Hash::make($request->new);
                $user->save();
                return response()->json([
                    'success' => true,
                    'message' => 'Thay đổi mật khẩu thành công'
                ]);
            }catch (\Exception $e){
                return response()->json([
                    'success' => false,
                    'message' => $e->getMessage()
                ]);
            }
        }else{
            return response()->json([
                'success' => false,
                'message' => 'Mật khẩu hiện tại của bạn không khớp với mật khẩu trên hệ thống'
            ]);
        }

    }

    public function edit()
    {
        $title = 'Thông tin tài khoản';
        $user = User::query()->findOrFail(auth()->user()->id);
        return view('CMS.user.edit',compact('title','user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|max:255|regex:/[A-Za-z]/',
            'phone' => 'min:10|max:10|required|regex:/^0[1-9][0-9]{8}$/|unique:users,phone,'.auth()->user()->id,
            'email' => 'required|email|unique:users,email,'.auth()->user()->id,
        ], [
            'name.required' => 'Bạn cần nhập tên',
            'name.max' => 'Tên không được quá 255 ký tự',
            'name.regex' => 'Tên bạn nhập phải là chữ cái',
            'phone.required' => 'Bạn cần nhập số điện thoại',
            'phone.min' => 'Số điện thoại bạn nhập phải ít nhất 10 ký tự',
            'phone.max' => 'Số điện thoại bạn nhập được nhiều nhất 10 ký tự',
            'phone.regex' => 'Số điện thoại bạn nhập phải là 1 số điện thoại ở Việt Nam',
            'phone.unique'=>'Số điện thoại đã được sử dụng',
            'email.required' => 'Bạn cần nhập email',
            'email.email' => 'Email bạn nhập không đúng định dạng',
            'email.unique'=>'Email đã được sử dụng',
        ]);

        $data = $request->all();
        try {
            $user::query()->findOrFail(auth()->user()->id)->update($data);
            return response()->json([
                'success' => true,
                'message' => 'Sửa thông tin tài khoản thành công'
            ]);
        }catch (\Exception $e){
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function destroy(User $user,Request $request)
    {
        $id = $request->user_id;
        try {
            $user::query()->findOrFail($id)->delete();
            return response()->json([
                'success' => true,
                'message' => 'Xóa tài khoản thành công'
            ]);
        }catch (\Exception $e){
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function status(Request $request){
        try{
            $user = User::query()->findOrFail($request->user_id);
            if ($user->status == 1){
                $user->status = 0;
            }elseif ($user->status == 0){
                $user->status = 1;
            }
            $user->save();

            return response()->json([
                'success' => true,
                'status' => $user->status,
                'message' => 'Đổi trạng thái tài khoản thành công'
            ]);
        } catch(\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function delete(){
        try {
            User::query()->findOrFail(auth()->user()->id)->delete();
            return response()->json([
                'success' => true,
                'message' => 'Xóa vĩnh viễn tài khoản thành công'
            ]);
        }catch (\Exception $e){
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

}
