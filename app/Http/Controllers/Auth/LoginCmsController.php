<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
        $title = 'Đăng nhập trang quản trị';
        return view('CMS.auth.login',compact('title'));
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
            $user = User::query()->where('email', $username )->first();
        } else {
            $user = User::query()->where('phone', $username )->first();
        }

        try {
            if(!$user) {
                return redirect()->back()->with('some_error','Người dùng không tồn tại');
            }else{
                if (Auth::guard()->attempt(['phone' => $username, 'password' => request('password'), 'status' => 1], request('remember') ? true : false) || Auth::guard()->attempt(['email' => $username, 'password' => request('password'), 'status' => 1], request('remember') ? true : false)) {
                    
                    return to_route('admin.home.index')->with('notice_success','Đăng nhập thành công');
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
        $title = 'Đăng ký trang quản trị';
        return view('CMS.auth.register',compact('title'));
    }

    public function registerPost(Request $request){
        $request->validate([
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

        $data = $request->all();
        $data['password'] = Hash::make($data['password']);
        $data['status'] = 0;
        try {
            User::query()->create($data);
            return response()->json([
                'success' => true,
                'message' => 'Đăng ký tài khoản thành công bạn cần chờ quản trị viên phê duyệt'
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
        Auth::guard()->logout();
        return to_route('login');
    }
}
