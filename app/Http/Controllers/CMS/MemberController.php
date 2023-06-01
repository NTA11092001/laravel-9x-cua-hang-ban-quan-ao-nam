<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{

    public function index()
    {
        $title = 'Tài khoản khách hàng';
        $member = Member::query()->orderBy('id','desc')->paginate(10);
        return view('CMS.member.index',compact('title','member'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Member $member)
    {
        //
    }

    public function edit(Member $member)
    {
        //
    }

    public function update(Request $request, Member $member)
    {
        //
    }

    public function destroy(Request $request)
    {
        $id = $request->member_id;
        try {
            Member::query()->findOrFail($id)->delete();
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
}
