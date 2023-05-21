<?php

namespace App\Http\Controllers\WEB;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\Member;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class MainWebController extends Controller
{
    public function index(Request $request)
    {
        $tukhoa = $request->tukhoa ? $request->tukhoa : '';
        $title = 'BAL shop';
        if ($tukhoa != ''){
            $product = Product::query()->where('status',1)->where('ten','like','%'.$tukhoa.'%')->paginate(10);
            return view('WEB.home.search',compact('title','product'));
        }else{
            return view('WEB.home.index',compact('title'));
        }
    }

    public function contact(){
        $title = 'Liên hệ';
        return view('WEB.contact.index',compact('title'));
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

        $member = Member::query()->findOrFail(auth('member')->user()->id);
        if (Hash::check($request->current, $member->password)){
            try {
                $member->password = Hash::make($request->new);
                $member->save();
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

}
