<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Session;

class LoginCmsController extends Controller
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

    public function login() {
        return view('CMS.auth.login');
    }

    public function loginPost(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users,email,phone',
            'password' => 'required',
        ], [
            'username.required' => 'Bạn cần nhập tài khoản',
            'username.unique' => 'Tài khoản của bạn bị trùng',
            'password.required' => 'Bạn cần nhập mật khẩu',
        ]);
        $username = $request->username;
        if(!is_numeric($username)) {
            $user = User::query()->where('email', $username )->first();
        } else {
            $user = User::query()->where('phone', $username )->first();
        }

        try {
            if(!$user) {
                return redirect()->back()->with('some_error','Người dùng không tồn tại');
            }else{
                if (Auth::guard()->attempt(['phone' => $username, 'password' => request('password'), 'status' => 1], request('remember') ? true : false) || Auth::guard('member')->attempt(['email' => $username, 'password' => request('password'), 'status' => 1], request('remember') ? true : false)) {
                    $this->saveLogActivity();
                    return to_route('admin.home');
                }
                elseif (!Hash::check($request->password, $user->password)) {
                    return to_route('login')->with('some_error','Sai mật khẩu. Vui lòng thử lại.');
                }
                else  {
                    return to_route('login')->with('some_error','Tài khoản của bạn chưa được phê duyệt');
                }

            }
        } catch(\Exception $e) {
            return to_route('login')->with('some_error', $e->getMessage());
        }
    }

    public function register(){
        return view('CMS.auth.register');
    }

    public function registerPost(Request $request){
        $valid = $request->validate([
            'name' => 'required|max:255|regex:/[A-Za-z]/',
            'phone' => 'min:10|required|regex:/^0[1-9][0-9]{8}$/|max:10|unique:users,phone',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
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
            'password.min' => 'Mật khẩu của bạn cần nhập ít nhất 6 ký tự',
        ]);
        if($valid->fails()) {
            $data = [
                'success' => false,
                'message' => $valid->errors()
            ];
            return response()->json($data);
        }
        $data = $request->all();
        return response()->json([
            'success' => true,
            'message' => 'Đăng ký tài khoản thành công bạn cần chờ quản trị viên phê duyệt'
        ]);
    }

    public function logout()
    {
        Auth::guard()->logout();
        Cookie::queue(Cookie::forget('remember_web_token'));
        return to_route('login');
    }
}
