<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Member;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class AuthWebController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function loginPost(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ], [
            'username.required' => 'Bạn cần nhập tài khoản',
            'password.required' => 'Bạn cần nhập mật khẩu',
        ]);
        $username = $request->username;
        if(!is_numeric($username)) {
            $member = Member::query()->where('email', $username )->first();
            $text_user = 'email';
        } else {
            $member = Member::query()->where('phone', $username )->first();
            $text_user = 'phone';
        }

        try {
            if(!$member) {
                return response()->json([
                    'success' => false,
                    'message' => 'Người dùng không tồn tại!'
                ]);
            }else{
                if (Auth::guard('member')->attempt([$text_user => $username, 'password' => request('password')], request('remember') ? true : false)) {
                    return response()->json([
                        'success' => true,
                        'message' => 'Đăng nhập thành công!'
                    ]);
                }
                elseif (!Hash::check($request->password, $member->password)) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Sai mật khẩu. Vui lòng thử lại!'
                    ]);
                }

            }
        } catch(\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function registerPost(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255|regex:/[A-Za-z]/',
            'phone' => 'min:10|required|regex:/^0[1-9][0-9]{8}$/|max:10|unique:members,phone',
            'email' => 'required|email|unique:members,email',
            'password' => 'required|min:8',
        ], [
            'name.required' => 'Bạn cần nhập tên',
            'name.max' => 'Tên không được quá 255 ký tự',
            'name.regex' => 'Tên bạn nhập phải là chữ cái',
            'phone.required' => 'Bạn cần nhập số điện thoại',
            'phone.min' => 'Số điện thoại bạn nhập phải ít nhất 10 ký tự',
            'phone.max' => 'Số điện thoại bạn nhập được nhiều nhất 12 ký tự',
            'phone.regex' => 'Số điện thoại bạn nhập phải là 1 số điện thoại ở Việt Nam',
            'phone.unique'=>'Số điện thoại đã được sử dụng',
            'email.required' => 'Bạn cần nhập email',
            'email.email' => 'Email bạn nhập không đúng định dạng',
            'email.unique'=>'Email đã được sử dụng',
            'password.required' => 'Bạn cần nhập mật khẩu',
            'password.min' => 'Mật khẩu của bạn cần nhập ít nhất 8 ký tự',
        ]);

        $data = $request->except(['password']);
        $data['password'] = Hash::make($request->password);
        try {
            Member::query()->create($data);
            return response()->json([
                'success' => true,
                'username' => $data['phone'],
                'password' => $request->password,
                'message' => 'Đăng ký tài khoản thành công'
            ]);
        }catch (\Exception $e){
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function logout()
    {
        Auth::guard('member')->logout();
        return to_route('WEB.home.index');
    }

}
